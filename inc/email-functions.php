<?php
/**
 * Email Functions
 */

/**
 * Send donation notification to admin
 */
function pronti_qua_send_donation_notification($donation_id) {
    $donation = get_post($donation_id);
    $amount = get_post_meta($donation_id, 'amount', true);
    $donor_name = get_post_meta($donation_id, 'donor_name', true);
    $donor_email = get_post_meta($donation_id, 'donor_email', true);
    $project_id = get_post_meta($donation_id, 'project_id', true);

    $project_title = $project_id ? get_the_title($project_id) : 'Donazione generica';

    $to = get_option('admin_email');
    $subject = 'Nuova donazione ricevuta - €' . $amount;

    $message = "
    <h2>Nuova donazione ricevuta</h2>
    <p><strong>Importo:</strong> €{$amount}</p>
    <p><strong>Donatore:</strong> {$donor_name} ({$donor_email})</p>
    <p><strong>Progetto:</strong> {$project_title}</p>
    <p><strong>Data:</strong> " . current_time('d/m/Y H:i') . "</p>

    <p><a href='" . admin_url('post.php?post=' . $donation_id . '&action=edit') . "'>Visualizza donazione nel pannello admin</a></p>
    ";

    wp_mail($to, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
}

/**
 * Send donation confirmation to donor
 */
function pronti_qua_send_donation_confirmation($donation_id) {
    $amount = get_post_meta($donation_id, 'amount', true);
    $donor_name = get_post_meta($donation_id, 'donor_name', true);
    $donor_email = get_post_meta($donation_id, 'donor_email', true);
    $project_id = get_post_meta($donation_id, 'project_id', true);

    $project_title = $project_id ? get_the_title($project_id) : 'Donazione generica';

    $subject = 'Grazie per la tua donazione - Pronti Qua ODV';

    $message = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #6f8a2b;'>Grazie di cuore, {$donor_name}!</h2>

        <p>La tua donazione di <strong>€{$amount}</strong> è stata ricevuta con successo.</p>

        <div style='background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;'>
            <h3 style='margin-top: 0; color: #379db2;'>Dettagli della donazione</h3>
            <p><strong>Importo:</strong> €{$amount}</p>
            <p><strong>Progetto:</strong> {$project_title}</p>
            <p><strong>Data:</strong> " . current_time('d/m/Y H:i') . "</p>
            <p><strong>ID Donazione:</strong> #PQ{$donation_id}</p>
        </div>

        <p>La tua generosità ci permette di continuare a supportare pazienti oncologici e le loro famiglie. Ogni contributo fa la differenza.</p>

        <p>Riceverai presto la ricevuta fiscale all'indirizzo email fornito.</p>

        <p>Con gratitudine,<br>
        <strong>Il team di Pronti Qua ODV</strong></p>

        <hr style='margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;'>

        <p style='font-size: 12px; color: #6b7280;'>
            Pronti Qua ODV<br>
            Via Roma 123, 38100 Trento (TN)<br>
            CF: 96123456789 | P.IVA: 02987654321<br>
            <a href='" . home_url() . "'>www.prontiqua.org</a>
        </p>
    </div>
    ";

    wp_mail($donor_email, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
}

/**
 * Send support request notification
 */
function pronti_qua_send_support_request_notification($request_id) {
    $request = get_post($request_id);
    $requester_name = get_post_meta($request_id, 'requester_name', true);
    $contact_email = get_post_meta($request_id, 'contact_email', true);
    $contact_phone = get_post_meta($request_id, 'contact_phone', true);
    $urgency = get_post_meta($request_id, 'urgency', true);
    $support_types = get_post_meta($request_id, 'support_types', true);

    // Admin notification
    $to = get_option('admin_email');
    $subject = 'Nuova richiesta di aiuto';
    if ($urgency === 'high') {
        $subject = '🚨 URGENTE - ' . $subject;
    }

    $urgency_labels = [
        'low' => 'Bassa (entro 1 settimana)',
        'medium' => 'Media (entro 2-3 giorni)',
        'high' => 'Alta (entro 24 ore)'
    ];

    $message = "
    <h2>Nuova richiesta di aiuto</h2>
    <p><strong>Da:</strong> {$requester_name}</p>
    <p><strong>Email:</strong> {$contact_email}</p>
    <p><strong>Telefono:</strong> {$contact_phone}</p>
    <p><strong>Urgenza:</strong> {$urgency_labels[$urgency]}</p>
    <p><strong>Tipi di supporto:</strong> " . implode(', ', $support_types) . "</p>

    <h3>Descrizione situazione:</h3>
    <p>{$request->post_content}</p>

    <p><a href='" . admin_url('post.php?post=' . $request_id . '&action=edit') . "'>Gestisci richiesta nel pannello admin</a></p>
    ";

    wp_mail($to, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);

    // Confirmation to requester
    $subject_requester = 'Richiesta di aiuto ricevuta - Pronti Qua ODV';
    $message_requester = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #379db2;'>Ciao {$requester_name},</h2>

        <p>Abbiamo ricevuto la tua richiesta di aiuto e ti contatteremo al più presto.</p>

        <div style='background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;'>
            <p><strong>Numero richiesta:</strong> #AR{$request_id}</p>
            <p><strong>Data:</strong> " . current_time('d/m/Y H:i') . "</p>
            <p><strong>Urgenza:</strong> {$urgency_labels[$urgency]}</p>
        </div>

        <p>Nel frattempo, se hai bisogno di supporto immediato, puoi contattarci:</p>
        <ul>
            <li>📞 Telefono: 0461 123456</li>
            <li>📧 Email: info@prontiqua.org</li>
            <li>🕐 Lun-Ven: 9:00-17:00</li>
        </ul>

        <p>Non sei solo in questo percorso. Siamo qui per aiutarti.</p>

        <p>Un abbraccio,<br>
        <strong>Il team di Pronti Qua ODV</strong></p>
    </div>
    ";

    wp_mail($contact_email, $subject_requester, $message_requester, ['Content-Type: text/html; charset=UTF-8']);
}

/**
 * Send welcome email for newsletter
 */
function pronti_qua_send_welcome_email($email) {
    $subject = 'Benvenuto nella famiglia Pronti Qua ODV';

    $message = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #6f8a2b;'>Benvenuto nella nostra comunità!</h2>

        <p>Grazie per aver scelto di seguire le attività di Pronti Qua ODV.</p>

        <p>Attraverso la nostra newsletter riceverai:</p>
        <ul>
            <li>📢 Aggiornamenti sui nostri progetti</li>
            <li>📖 Storie di speranza e testimonianze</li>
            <li>📅 Eventi e iniziative</li>
            <li>💡 Consigli e risorse utili</li>
        </ul>

        <p>Se vuoi supportare la nostra missione, puoi:</p>
        <div style='text-align: center; margin: 30px 0;'>
            <a href='" . home_url('/dona') . "' style='background: #e66395; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: 600;'>Fai una Donazione</a>
        </div>

        <p>Grazie per essere parte della nostra famiglia!</p>

        <p>Con affetto,<br>
        <strong>Il team di Pronti Qua ODV</strong></p>

        <hr style='margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;'>

        <p style='font-size: 12px; color: #6b7280;'>
            Non vuoi più ricevere le nostre email?
            <a href='" . home_url('/disiscrivi?email=' . urlencode($email)) . "'>Disiscriviti qui</a>
        </p>
    </div>
    ";

    wp_mail($email, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
}

/**
 * Send goal reached notification
 */
function pronti_qua_send_goal_reached_notification($project_id) {
    $project = get_post($project_id);
    $goal_amount = get_post_meta($project_id, 'goal_amount', true);

    $to = get_option('admin_email');
    $subject = '🎉 Obiettivo raggiunto: ' . $project->post_title;

    $message = "
    <h2>🎉 Fantastico! Obiettivo raggiunto!</h2>
    <p>Il progetto <strong>{$project->post_title}</strong> ha raggiunto l'obiettivo di raccolta fondi!</p>

    <p><strong>Importo raccolto:</strong> €" . number_format($goal_amount, 0, ',', '.') . "</p>
    <p><strong>Data raggiungimento:</strong> " . current_time('d/m/Y H:i') . "</p>

    <p>È il momento di celebrare questo traguardo e informare tutti i donatori!</p>

    <p><a href='" . admin_url('post.php?post=' . $project_id . '&action=edit') . "'>Gestisci progetto</a></p>
    ";

    wp_mail($to, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
}