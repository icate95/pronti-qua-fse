<?php
/**
 * Custom Post Types con Meta Fields Completi
 * Sostituisci il contenuto di inc/custom-post-types.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrazione Custom Post Type Progetti
 */
function pronti_qua_register_progetti_cpt() {
    $labels = array(
        'name'                  => _x('Progetti', 'Post type general name', 'pronti-qua'),
        'singular_name'         => _x('Progetto', 'Post type singular name', 'pronti-qua'),
        'menu_name'             => _x('Progetti', 'Admin Menu text', 'pronti-qua'),
        'name_admin_bar'        => _x('Progetto', 'Add New on Toolbar', 'pronti-qua'),
        'add_new'               => __('Aggiungi Nuovo', 'pronti-qua'),
        'add_new_item'          => __('Aggiungi Nuovo Progetto', 'pronti-qua'),
        'new_item'              => __('Nuovo Progetto', 'pronti-qua'),
        'edit_item'             => __('Modifica Progetto', 'pronti-qua'),
        'view_item'             => __('Visualizza Progetto', 'pronti-qua'),
        'all_items'             => __('Tutti i Progetti', 'pronti-qua'),
        'search_items'          => __('Cerca Progetti', 'pronti-qua'),
        'not_found'             => __('Nessun progetto trovato.', 'pronti-qua'),
        'not_found_in_trash'    => __('Nessun progetto trovato nel cestino.', 'pronti-qua'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'progetti'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'show_in_nav_menus'  => true,
        'can_export'         => true,
    );

    register_post_type('progetto', $args);
}

/**
 * Registrazione Custom Post Type Eventi
 */
function pronti_qua_register_eventi_cpt() {
    $labels = array(
        'name'                  => _x('Eventi', 'Post type general name', 'pronti-qua'),
        'singular_name'         => _x('Evento', 'Post type singular name', 'pronti-qua'),
        'menu_name'             => _x('Eventi', 'Admin Menu text', 'pronti-qua'),
        'name_admin_bar'        => _x('Evento', 'Add New on Toolbar', 'pronti-qua'),
        'add_new'               => __('Aggiungi Nuovo', 'pronti-qua'),
        'add_new_item'          => __('Aggiungi Nuovo Evento', 'pronti-qua'),
        'new_item'              => __('Nuovo Evento', 'pronti-qua'),
        'edit_item'             => __('Modifica Evento', 'pronti-qua'),
        'view_item'             => __('Visualizza Evento', 'pronti-qua'),
        'all_items'             => __('Tutti gli Eventi', 'pronti-qua'),
        'search_items'          => __('Cerca Eventi', 'pronti-qua'),
        'not_found'             => __('Nessun evento trovato.', 'pronti-qua'),
        'not_found_in_trash'    => __('Nessun evento trovato nel cestino.', 'pronti-qua'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'eventi'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'show_in_nav_menus'  => true,
        'can_export'         => true,
    );

    register_post_type('evento', $args);
}

// Registra i Custom Post Types
add_action('init', 'pronti_qua_register_progetti_cpt');
add_action('init', 'pronti_qua_register_eventi_cpt');

/**
 * Aggiunge meta box per i dettagli dei progetti
 */
function add_project_meta_boxes() {
    add_meta_box(
        'project_details',
        '📋 Dettagli Progetto',
        'project_details_callback',
        'progetto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_boxes');

function project_details_callback($post) {
    wp_nonce_field('save_project_details', 'project_details_nonce');

    // Recupera i valori esistenti
    $category = get_post_meta($post->ID, 'project_category', true);
    $status = get_post_meta($post->ID, 'project_status', true);
    $start_date = get_post_meta($post->ID, 'project_start_date', true);
    $end_date = get_post_meta($post->ID, 'project_end_date', true);
    $goal_amount = get_post_meta($post->ID, 'goal_amount', true);
    $current_amount = get_post_meta($post->ID, 'current_amount', true);
    $manager = get_post_meta($post->ID, 'project_manager', true);
    $beneficiaries = get_post_meta($post->ID, 'project_beneficiaries', true);
    $partners = get_post_meta($post->ID, 'project_partners', true);
    $volunteers_needed = get_post_meta($post->ID, 'volunteers_needed', true);
    $donation_link = get_post_meta($post->ID, 'donation_link', true);

    ?>
    <style>
    .project-meta-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 15px;
    }
    .project-meta-section {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
    .project-meta-section h4 {
        margin: 0 0 15px 0;
        color: #2271b1;
        font-size: 14px;
        text-transform: uppercase;
        border-bottom: 2px solid #2271b1;
        padding-bottom: 5px;
    }
    .project-meta-field {
        margin-bottom: 15px;
    }
    .project-meta-field label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }
    .project-meta-field input,
    .project-meta-field select,
    .project-meta-field textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    .project-meta-field textarea {
        height: 80px;
        resize: vertical;
    }
    .currency-field {
        position: relative;
    }
    .currency-field input {
        padding-left: 25px;
    }
    .currency-symbol {
        position: absolute;
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-weight: bold;
    }
    .full-width {
        grid-column: 1 / -1;
    }
    </style>

    <div class="project-meta-container">
        <!-- Informazioni Base -->
        <div class="project-meta-section">
            <h4>📋 Informazioni Base</h4>

            <div class="project-meta-field">
                <label for="project_category">Categoria</label>
                <select id="project_category" name="project_category">
                    <option value="">Seleziona categoria</option>
                    <option value="raccolta-fondi" <?php selected($category, 'raccolta-fondi'); ?>>Raccolta Fondi</option>
                    <option value="supporto" <?php selected($category, 'supporto'); ?>>Supporto</option>
                    <option value="assistenza" <?php selected($category, 'assistenza'); ?>>Assistenza</option>
                    <option value="formazione" <?php selected($category, 'formazione'); ?>>Formazione</option>
                    <option value="sensibilizzazione" <?php selected($category, 'sensibilizzazione'); ?>>Sensibilizzazione</option>
                </select>
            </div>

            <div class="project-meta-field">
                <label for="project_status">Stato Progetto</label>
                <select id="project_status" name="project_status">
                    <option value="attivo" <?php selected($status, 'attivo'); ?>>Attivo</option>
                    <option value="completato" <?php selected($status, 'completato'); ?>>Completato</option>
                    <option value="in-pausa" <?php selected($status, 'in-pausa'); ?>>In Pausa</option>
                    <option value="pianificazione" <?php selected($status, 'pianificazione'); ?>>In Pianificazione</option>
                </select>
            </div>

            <div class="project-meta-field">
                <label for="project_manager">Responsabile Progetto</label>
                <input type="text" id="project_manager" name="project_manager" value="<?php echo esc_attr($manager); ?>" placeholder="Nome responsabile" />
            </div>
        </div>

        <!-- Timeline -->
        <div class="project-meta-section">
            <h4>📅 Timeline</h4>

            <div class="project-meta-field">
                <label for="project_start_date">Data Inizio</label>
                <input type="date" id="project_start_date" name="project_start_date" value="<?php echo esc_attr($start_date); ?>" />
            </div>

            <div class="project-meta-field">
                <label for="project_end_date">Data Fine Prevista</label>
                <input type="date" id="project_end_date" name="project_end_date" value="<?php echo esc_attr($end_date); ?>" />
            </div>
        </div>

        <!-- Raccolta Fondi -->
        <div class="project-meta-section">
            <h4>💰 Raccolta Fondi</h4>

            <div class="project-meta-field">
                <label for="goal_amount">Obiettivo (€)</label>
                <div class="currency-field">
                    <span class="currency-symbol">€</span>
                    <input type="number" id="goal_amount" name="goal_amount" value="<?php echo esc_attr($goal_amount); ?>" step="0.01" min="0" />
                </div>
            </div>

            <div class="project-meta-field">
                <label for="current_amount">Raccolto (€)</label>
                <div class="currency-field">
                    <span class="currency-symbol">€</span>
                    <input type="number" id="current_amount" name="current_amount" value="<?php echo esc_attr($current_amount); ?>" step="0.01" min="0" />
                </div>
            </div>

            <div class="project-meta-field">
                <label for="donation_link">Link Donazione</label>
                <input type="url" id="donation_link" name="donation_link" value="<?php echo esc_attr($donation_link); ?>" placeholder="https://..." />
            </div>
        </div>

        <!-- Persone -->
        <div class="project-meta-section">
            <h4>👥 Persone Coinvolte</h4>

            <div class="project-meta-field">
                <label for="project_beneficiaries">Beneficiari</label>
                <input type="text" id="project_beneficiaries" name="project_beneficiaries" value="<?php echo esc_attr($beneficiaries); ?>" placeholder="es. 150 famiglie" />
            </div>
        </div>

        <!-- Partner e Volontari -->
        <div class="project-meta-section full-width">
            <h4>🤝 Collaborazioni</h4>

            <div class="project-meta-field">
                <label for="project_partners">Partner e Collaborazioni</label>
                <textarea id="project_partners" name="project_partners" placeholder="Elenca partner, enti, collaborazioni..."><?php echo esc_textarea($partners); ?></textarea>
            </div>

            <div class="project-meta-field">
                <label for="volunteers_needed">Volontari Necessari</label>
                <textarea id="volunteers_needed" name="volunteers_needed" placeholder="Descrivi i ruoli di volontariato necessari..."><?php echo esc_textarea($volunteers_needed); ?></textarea>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Auto-calculate percentage
        function updateProgress() {
            var goal = parseFloat($('#goal_amount').val()) || 0;
            var current = parseFloat($('#current_amount').val()) || 0;
            var percentage = goal > 0 ? Math.round((current / goal) * 100) : 0;

            $('.progress-indicator').remove();
            if (goal > 0 && current >= 0) {
                var color = percentage >= 100 ? '#10b981' : percentage >= 50 ? '#f59e0b' : '#ef4444';
                $('#current_amount').after(
                    '<div class="progress-indicator" style="margin-top: 8px; padding: 8px; background: ' + color + '; color: white; border-radius: 4px; font-weight: bold; text-align: center;">Progresso: ' + percentage + '%</div>'
                );
            }
        }

        $('#goal_amount, #current_amount').on('input', updateProgress);
        updateProgress();
    });
    </script>
    <?php
}

/**
 * Salva i meta fields del progetto
 */
function save_project_details($post_id) {
    if (!isset($_POST['project_details_nonce']) ||
        !wp_verify_nonce($_POST['project_details_nonce'], 'save_project_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Lista dei campi da salvare
    $meta_fields = array(
        'project_category' => 'sanitize_text_field',
        'project_status' => 'sanitize_text_field',
        'project_start_date' => 'sanitize_text_field',
        'project_end_date' => 'sanitize_text_field',
        'goal_amount' => 'floatval',
        'current_amount' => 'floatval',
        'project_manager' => 'sanitize_text_field',
        'project_beneficiaries' => 'sanitize_text_field',
        'project_partners' => 'sanitize_textarea_field',
        'volunteers_needed' => 'sanitize_textarea_field',
        'donation_link' => 'esc_url_raw',
    );

    foreach ($meta_fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            $value = call_user_func($sanitize_function, $_POST[$field]);
            update_post_meta($post_id, $field, $value);
        }
    }
}
add_action('save_post', 'save_project_details');

/**
 * AJAX handler per ottenere meta data del progetto
 */
function get_project_meta_ajax() {
    // Verifica nonce se presente
    if (isset($_GET['nonce'])) {
        check_ajax_referer('pronti_qua_nonce', 'nonce');
    }

    $post_id = intval($_GET['post_id']);

    if (!$post_id || get_post_type($post_id) !== 'progetto') {
        wp_send_json_error('Invalid project ID');
    }

    $meta_data = array(
        'status' => get_post_meta($post_id, 'project_status', true),
        'category' => get_post_meta($post_id, 'project_category', true),
        'start_date' => get_post_meta($post_id, 'project_start_date', true),
        'end_date' => get_post_meta($post_id, 'project_end_date', true),
        'goal_amount' => get_post_meta($post_id, 'goal_amount', true),
        'current_amount' => get_post_meta($post_id, 'current_amount', true),
        'manager' => get_post_meta($post_id, 'project_manager', true),
        'beneficiaries' => get_post_meta($post_id, 'project_beneficiaries', true),
        'partners' => get_post_meta($post_id, 'project_partners', true),
        'volunteers_needed' => get_post_meta($post_id, 'volunteers_needed', true),
        'donation_link' => get_post_meta($post_id, 'donation_link', true),
    );

    // Rimuove valori vuoti
    $meta_data = array_filter($meta_data, function($value) {
        return !empty($value) && $value !== '0';
    });

    wp_send_json_success($meta_data);
}
add_action('wp_ajax_get_project_meta', 'get_project_meta_ajax');
add_action('wp_ajax_nopriv_get_project_meta', 'get_project_meta_ajax');

/**
 * Flush rewrite rules on theme activation
 */
function pronti_qua_rewrite_flush() {
    pronti_qua_register_progetti_cpt();
    pronti_qua_register_eventi_cpt();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'pronti_qua_rewrite_flush');

?>