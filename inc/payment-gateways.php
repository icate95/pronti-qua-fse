<?php
/**
 * Payment Gateway Integrations
 */

/**
 * Create PayPal payment
 */
function pronti_qua_create_paypal_payment($donation_id, $amount) {
    $paypal_mode = get_option('pronti_qua_paypal_mode', 'sandbox'); // sandbox or live
    $client_id = get_option('pronti_qua_paypal_client_id');

    if ($paypal_mode === 'sandbox') {
        $base_url = 'https://api.sandbox.paypal.com';
        $paypal_url = 'https://www.sandbox.paypal.com';
    } else {
        $base_url = 'https://api.paypal.com';
        $paypal_url = 'https://www.paypal.com';
    }

    // Get access token
    $token = pronti_qua_get_paypal_access_token($base_url);

    if (!$token) {
        return false;
    }

    // Create payment
    $payment_data = [
        'intent' => 'sale',
        'payer' => [
            'payment_method' => 'paypal'
        ],
        'transactions' => [
            [
                'amount' => [
                    'total' => number_format($amount, 2, '.', ''),
                    'currency' => 'EUR'
                ],
                'description' => 'Donazione a Pronti Qua ODV',
                'custom' => $donation_id,
                'item_list' => [
                    'items' => [
                        [
                            'name' => 'Donazione',
                            'sku' => 'donation_' . $donation_id,
                            'price' => number_format($amount, 2, '.', ''),
                            'currency' => 'EUR',
                            'quantity' => 1
                        ]
                    ]
                ]
            ]
        ],
        'redirect_urls' => [
            'return_url' => home_url('/grazie-donazione?donation_id=' . $donation_id),
            'cancel_url' => home_url('/donazione-annullata?donation_id=' . $donation_id)
        ]
    ];

    $response = wp_remote_post($base_url . '/v1/payments/payment', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ],
        'body' => json_encode($payment_data),
        'timeout' => 30
    ]);

    if (is_wp_error($response)) {
        error_log('PayPal API Error: ' . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['links'])) {
        foreach ($data['links'] as $link) {
            if ($link['rel'] === 'approval_url') {
                // Save payment ID
                update_post_meta($donation_id, 'paypal_payment_id', $data['id']);
                return $link['href'];
            }
        }
    }

    return false;
}

/**
 * Get PayPal access token
 */
function pronti_qua_get_paypal_access_token($base_url) {
    $client_id = get_option('pronti_qua_paypal_client_id');
    $client_secret = get_option('pronti_qua_paypal_client_secret');

    if (!$client_id || !$client_secret) {
        return false;
    }

    $response = wp_remote_post($base_url . '/v1/oauth2/token', [
        'headers' => [
            'Accept' => 'application/json',
            'Accept-Language' => 'en_US',
            'Authorization' => 'Basic ' . base64_encode($client_id . ':' . $client_secret)
        ],
        'body' => 'grant_type=client_credentials',
        'timeout' => 30
    ]);

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    return isset($data['access_token']) ? $data['access_token'] : false;
}

/**
 * Stripe payment creation
 */
function pronti_qua_create_stripe_payment($donation_id, $amount) {
    $stripe_mode = get_option('pronti_qua_stripe_mode', 'test'); // test or live
    $secret_key = $stripe_mode === 'test' ?
        get_option('pronti_qua_stripe_test_secret_key') :
        get_option('pronti_qua_stripe_live_secret_key');

    if (!$secret_key) {
        return false;
    }

    // Create Stripe checkout session
    $session_data = [
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Donazione a Pronti Qua ODV',
                    ],
                    'unit_amount' => $amount * 100, // Amount in cents
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => home_url('/grazie-donazione?donation_id=' . $donation_id . '&session_id={CHECKOUT_SESSION_ID}'),
        'cancel_url' => home_url('/donazione-annullata?donation_id=' . $donation_id),
        'metadata' => [
            'donation_id' => $donation_id
        ]
    ];

    $response = wp_remote_post('https://api.stripe.com/v1/checkout/sessions', [
        'headers' => [
            'Authorization' => 'Bearer ' . $secret_key,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ],
        'body' => http_build_query($session_data),
        'timeout' => 30
    ]);

    if (is_wp_error($response)) {
        error_log('Stripe API Error: ' . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['url'])) {
        // Save session ID
        update_post_meta($donation_id, 'stripe_session_id', $data['id']);
        return $data['url'];
    }

    return false;
}

/**
 * Handle PayPal webhook
 */
add_action('wp_ajax_nopriv_pronti_qua_paypal_webhook', 'pronti_qua_handle_paypal_webhook');
add_action('wp_ajax_pronti_qua_paypal_webhook', 'pronti_qua_handle_paypal_webhook');

function pronti_qua_handle_paypal_webhook() {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($data['event_type'] === 'PAYMENT.SALE.COMPLETED') {
        $payment_id = $data['resource']['parent_payment'];

        // Find donation by payment ID
        $donations = get_posts([
            'post_type' => 'donation',
            'meta_query' => [
                [
                    'key' => 'paypal_payment_id',
                    'value' => $payment_id,
                    'compare' => '='
                ]
            ]
        ]);

        if (!empty($donations)) {
            $donation_id = $donations[0]->ID;

            // Update donation status
            wp_update_post([
                'ID' => $donation_id,
                'post_status' => 'publish'
            ]);

            update_post_meta($donation_id, 'payment_status', 'completed');
            update_post_meta($donation_id, 'transaction_id', $data['resource']['id']);

            // Update project funding if applicable
            $project_id = get_post_meta($donation_id, 'project_id', true);
            if ($project_id) {
                pronti_qua_update_project_funding($project_id);
            }

            // Send confirmation email
            pronti_qua_send_donation_confirmation($donation_id);
        }
    }

    http_response_code(200);
    exit;
}

/**
 * Handle Stripe webhook
 */
add_action('wp_ajax_nopriv_pronti_qua_stripe_webhook', 'pronti_qua_handle_stripe_webhook');
add_action('wp_ajax_pronti_qua_stripe_webhook', 'pronti_qua_handle_stripe_webhook');

function pronti_qua_handle_stripe_webhook() {
    $input = file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
    $endpoint_secret = get_option('pronti_qua_stripe_webhook_secret');

    // Verify webhook signature
    if ($endpoint_secret) {
        try {
            $event = pronti_qua_verify_stripe_signature($input, $sig_header, $endpoint_secret);
        } catch (Exception $e) {
            http_response_code(400);
            exit;
        }
    } else {
        $event = json_decode($input, true);
    }

    if ($event['type'] === 'checkout.session.completed') {
        $session = $event['data']['object'];
        $donation_id = $session['metadata']['donation_id'];

        if ($donation_id) {
            // Update donation status
            wp_update_post([
                'ID' => $donation_id,
                'post_status' => 'publish'
            ]);

            update_post_meta($donation_id, 'payment_status', 'completed');
            update_post_meta($donation_id, 'transaction_id', $session['payment_intent']);

            // Update project funding
            $project_id = get_post_meta($donation_id, 'project_id', true);
            if ($project_id) {
                pronti_qua_update_project_funding($project_id);
            }

            // Send confirmation
            pronti_qua_send_donation_confirmation($donation_id);
        }
    }

    http_response_code(200);
    exit;
}

/**
 * Update project funding amount
 */
function pronti_qua_update_project_funding($project_id) {
    // Get all completed donations for this project
    $donations = get_posts([
        'post_type' => 'donation',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => 'project_id',
                'value' => $project_id,
                'compare' => '='
            ],
            [
                'key' => 'payment_status',
                'value' => 'completed',
                'compare' => '='
            ]
        ]
    ]);

    $total = 0;
    foreach ($donations as $donation) {
        $amount = get_post_meta($donation->ID, 'amount', true);
        $total += floatval($amount);
    }

    update_post_meta($project_id, 'current_amount', $total);

    // Check if goal is reached
    $goal = get_post_meta($project_id, 'goal_amount', true);
    if ($total >= $goal) {
        update_post_meta($project_id, 'goal_reached', true);
        update_post_meta($project_id, 'goal_reached_date', current_time('mysql'));

        // Send goal reached notification
        pronti_qua_send_goal_reached_notification($project_id);
    }
}