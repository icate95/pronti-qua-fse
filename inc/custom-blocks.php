<?php
/**
 * Registrazione Custom Blocks
 */

// Registra i custom blocks
function pronti_qua_register_custom_blocks() {
    // Verifica se la funzione register_block_type esiste
    if (!function_exists('register_block_type')) {
        return;
    }

    // Progress Bar Progetto
    register_block_type(get_template_directory() . '/blocks/project-progress');
    
    // Card Progetto
    register_block_type(get_template_directory() . '/blocks/project-card');
    
    // Contatore Impact
    register_block_type(get_template_directory() . '/blocks/impact-counter');
    
    // Testimonianza
    register_block_type(get_template_directory() . '/blocks/testimonial');
    
    // Membro Team
    register_block_type(get_template_directory() . '/blocks/team-member');
    
    // Alert/Banner
    register_block_type(get_template_directory() . '/blocks/alert-banner');
    
    // Codice 5x1000
    register_block_type(get_template_directory() . '/blocks/codice-5x1000');
}
add_action('init', 'pronti_qua_register_custom_blocks');

// Enqueue block editor assets
function pronti_qua_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'pronti-qua-blocks',
        get_template_directory_uri() . '/assets/js/blocks.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        wp_get_theme()->get('Version')
    );
    
    wp_enqueue_style(
        'pronti-qua-blocks-editor',
        get_template_directory_uri() . '/assets/css/blocks-editor.css',
        array('wp-edit-blocks'),
        wp_get_theme()->get('Version')
    );
}
add_action('enqueue_block_editor_assets', 'pronti_qua_enqueue_block_editor_assets');

// Enqueue block frontend assets
function pronti_qua_enqueue_block_assets() {
    wp_enqueue_style(
        'pronti-qua-blocks-style',
        get_template_directory_uri() . '/assets/css/blocks.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('enqueue_block_assets', 'pronti_qua_enqueue_block_assets');

// Il resto del codice esistente...