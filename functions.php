<?php
/**
 * Pronti Qua ODV Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function pronti_qua_theme_setup() {
    // Add theme support
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('custom-logo');

    // Remove core block patterns
    remove_theme_support('core-block-patterns');

    // Add editor style
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'pronti_qua_theme_setup');

// Enqueue theme assets
function pronti_qua_enqueue_assets() {
    wp_enqueue_style(
        'pronti-qua-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // CSS personalizzato
    wp_enqueue_style(
        'pronti-qua-custom',
        get_template_directory_uri() . '/assets/css/theme.css',
        array('pronti-qua-style'),
        wp_get_theme()->get('Version')
    );

    // Google Fonts
    wp_enqueue_style(
        'pronti-qua-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_script(
        'pronti-qua-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'pronti_qua_enqueue_assets');

// Register custom post types
require_once get_template_directory() . '/inc/custom-post-types.php';

// Register custom blocks
require_once get_template_directory() . '/inc/custom-blocks.php';

// Register block patterns
require_once get_template_directory() . '/inc/block-patterns.php';

// Add block categories
function pronti_qua_block_categories($categories) {
    return array_merge(
        $categories,
        [
            [
                'slug' => 'pronti-qua-blocks',
                'title' => __('Pronti Qua Blocks', 'pronti-qua'),
                'icon' => 'heart',
            ],
        ]
    );
}
add_filter('block_categories_all', 'pronti_qua_block_categories');