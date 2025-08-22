<?php
/**
 * Registrazione dei blocchi custom per Pronti Qua ODV
 */

// Assicurati che non ci sia accesso diretto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra tutti i blocchi custom
 */
function pronti_qua_register_custom_blocks() {
    // Verifica se la funzione register_block_type esiste
    if (!function_exists('register_block_type')) {
        return;
    }

    register_block_type(get_template_directory() . '/blocks/project-progress');
    register_block_type(get_template_directory() . '/blocks/project-card');
    register_block_type(get_template_directory() . '/blocks/impact-counter');
    register_block_type(get_template_directory() . '/blocks/testimonial');
    register_block_type(get_template_directory() . '/blocks/team-member');
    register_block_type(get_template_directory() . '/blocks/alert-banner');
    register_block_type(get_template_directory() . '/blocks/codice-5x1000');
    register_block_type(get_template_directory() . '/blocks/slideshow');

    $slideshow_path = get_template_directory() . '/blocks/slideshow';
    error_log('Slideshow path: ' . $slideshow_path);
        error_log('Block.json exists: ' . (file_exists($slideshow_path . '/block.json') ? 'YES' : 'NO'));

}
add_action('init', 'pronti_qua_register_custom_blocks');

/**
 * Enqueue block editor assets
 */
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

/**
 * Enqueue block frontend assets
 */
function pronti_qua_enqueue_block_assets() {
    wp_enqueue_style(
        'pronti-qua-blocks-style',
        get_template_directory_uri() . '/assets/css/blocks.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('enqueue_block_assets', 'pronti_qua_enqueue_block_assets');

/**
 * Enqueue degli script specifici per blocchi (frontend)
 */
function pronti_qua_enqueue_block_frontend_scripts() {
    // Script slideshow frontend
    wp_enqueue_script(
        'pronti-qua-slideshow-frontend',
        get_template_directory_uri() . '/blocks/slideshow/frontend.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Script per altri blocchi interattivi
    wp_enqueue_script(
        'pronti-qua-blocks-frontend',
        get_template_directory_uri() . '/assets/js/blocks-frontend.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'pronti_qua_enqueue_block_frontend_scripts');

/**
 * Crea categorie custom per i blocchi Pronti Qua
 */
if (!function_exists('pronti_qua_block_categories')) {
    function pronti_qua_block_categories($categories) {
        return array_merge(
            array(
                array(
                    'slug'  => 'pronti-qua',
                    'title' => __('Pronti Qua ODV', 'pronti-qua'),
                    'icon'  => 'heart',
                ),
                array(
                    'slug'  => 'pronti-qua-hero',
                    'title' => __('Hero Sections', 'pronti-qua'),
                    'icon'  => 'cover-image',
                ),
                array(
                    'slug'  => 'pronti-qua-content',
                    'title' => __('Contenuti Speciali', 'pronti-qua'),
                    'icon'  => 'layout',
                ),
            ),
            $categories
        );
    }
    add_filter('block_categories_all', 'pronti_qua_block_categories');
}

/**
 * Registra i pattern personalizzati
 */
function pronti_qua_register_patterns() {
    // Includi i file dei pattern
    if (file_exists(get_template_directory() . '/patterns/hero-patterns.php')) {
        require_once get_template_directory() . '/patterns/hero-patterns.php';
    }
    if (file_exists(get_template_directory() . '/patterns/content-patterns.php')) {
        require_once get_template_directory() . '/patterns/content-patterns.php';
    }
    if (file_exists(get_template_directory() . '/patterns/cta-patterns.php')) {
        require_once get_template_directory() . '/patterns/cta-patterns.php';
    }
    if (file_exists(get_template_directory() . '/patterns/project-patterns.php')) {
        require_once get_template_directory() . '/patterns/project-patterns.php';
    }
}
add_action('init', 'pronti_qua_register_patterns');

/**
 * Aggiungi supporto per colori custom nei blocchi
 */
function pronti_qua_add_block_color_support() {
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Verde Primario', 'pronti-qua'),
            'slug'  => 'verde-primario',
            'color' => '#6f8a2b',
        ),
        array(
            'name'  => __('Azzurro Secondario', 'pronti-qua'),
            'slug'  => 'azzurro-secondario',
            'color' => '#379db2',
        ),
        array(
            'name'  => __('Rosa Accento', 'pronti-qua'),
            'slug'  => 'rosa-accento',
            'color' => '#e66395',
        ),
        array(
            'name'  => __('Giallo Highlight', 'pronti-qua'),
            'slug'  => 'giallo-highlight',
            'color' => '#ded771',
        ),
        array(
            'name'  => __('Scuro', 'pronti-qua'),
            'slug'  => 'dark',
            'color' => '#1f2937',
        ),
        array(
            'name'  => __('Grigio Scuro', 'pronti-qua'),
            'slug'  => 'gray-700',
            'color' => '#374151',
        ),
        array(
            'name'  => __('Grigio Medio', 'pronti-qua'),
            'slug'  => 'gray-500',
            'color' => '#6b7280',
        ),
        array(
            'name'  => __('Grigio Chiaro', 'pronti-qua'),
            'slug'  => 'gray-300',
            'color' => '#d1d5db',
        ),
        array(
            'name'  => __('Grigio Molto Chiaro', 'pronti-qua'),
            'slug'  => 'gray-100',
            'color' => '#f3f4f6',
        ),
        array(
            'name'  => __('Sfondo Chiaro', 'pronti-qua'),
            'slug'  => 'light',
            'color' => '#f8fafc',
        ),
        array(
            'name'  => __('Bianco', 'pronti-qua'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ));

    // Supporto per gradienti custom
    add_theme_support('editor-gradient-presets', array(
        array(
            'name'     => __('Verde-Azzurro', 'pronti-qua'),
            'gradient' => 'linear-gradient(135deg, #6f8a2b 0%, #379db2 100%)',
            'slug'     => 'verde-azzurro',
        ),
        array(
            'name'     => __('Rosa-Giallo', 'pronti-qua'),
            'gradient' => 'linear-gradient(135deg, #e66395 0%, #ded771 100%)',
            'slug'     => 'rosa-giallo',
        ),
    ));
}
add_action('after_setup_theme', 'pronti_qua_add_block_color_support');

/**
 * Aggiungi font sizes personalizzate
 */
function pronti_qua_add_block_font_sizes() {
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Piccolo', 'pronti-qua'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('Normale', 'pronti-qua'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => __('Medio', 'pronti-qua'),
            'size' => 18,
            'slug' => 'medium'
        ),
        array(
            'name' => __('Grande', 'pronti-qua'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => __('Extra Grande', 'pronti-qua'),
            'size' => 32,
            'slug' => 'x-large'
        ),
        array(
            'name' => __('Titolo', 'pronti-qua'),
            'size' => 48,
            'slug' => 'xx-large'
        ),
        array(
            'name' => __('Hero', 'pronti-qua'),
            'size' => 64,
            'slug' => 'xxx-large'
        ),
    ));
}
add_action('after_setup_theme', 'pronti_qua_add_block_font_sizes');

/**
 * Rimuovi blocchi non necessari dall'editor (opzionale)
 */
function pronti_qua_allowed_block_types($allowed_blocks, $editor_context) {
    $allowed_blocks = array(
        // Core blocks essenziali
        'core/paragraph',
        'core/heading',
        'core/image',
        'core/gallery',
        'core/list',
        'core/quote',
        'core/button',
        'core/buttons',
        'core/columns',
        'core/column',
        'core/group',
        'core/cover',
        'core/spacer',
        'core/separator',
        'core/html',
        'core/shortcode',

        // Media
        'core/video',
        'core/audio',
        'core/file',

        // Embed selezionati
        'core/embed',
        'core-embed/youtube',
        'core-embed/vimeo',

        // Custom blocks Pronti Qua
        'pronti-qua/slideshow',
        'pronti-qua/project-progress',
        'pronti-qua/project-card',
        'pronti-qua/impact-counter',
        'pronti-qua/testimonial',
        'pronti-qua/team-member',
        'pronti-qua/alert-banner',
        'pronti-qua/codice-5x1000',

        // Pattern
        'core/pattern',
    );

    return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'pronti_qua_allowed_block_types', 10, 2);

/**
 * Aggiungi stili editor per i blocchi custom
 */
function pronti_qua_add_editor_styles() {
    add_theme_support('editor-styles');

    // Stili editor per blocchi esistenti
    add_editor_style('assets/css/blocks-editor.css');

    // Stili specifici per ogni blocco se esistono
    $blocks_with_editor_styles = array(
        'slideshow',
        'project-progress',
        'project-card',
        'impact-counter',
        'testimonial',
        'team-member',
        'alert-banner',
        'codice-5x1000'
    );

    foreach ($blocks_with_editor_styles as $block) {
        $editor_style_path = "blocks/{$block}/index.css";
        if (file_exists(get_template_directory() . '/' . $editor_style_path)) {
            add_editor_style($editor_style_path);
        }
    }
}
add_action('after_setup_theme', 'pronti_qua_add_editor_styles');

/**
 * Localizza script per blocchi
 */
function pronti_qua_localize_block_scripts() {
    wp_localize_script('pronti-qua-blocks', 'prontiQuaBlocks', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('pronti_qua_blocks_nonce'),
        'themeUrl' => get_template_directory_uri(),
        'colors' => array(
            'verde-primario' => '#6f8a2b',
            'azzurro-secondario' => '#379db2',
            'rosa-accento' => '#e66395',
            'giallo-highlight' => '#ded771',
        ),
    ));
}
add_action('wp_enqueue_scripts', 'pronti_qua_localize_block_scripts');
add_action('enqueue_block_editor_assets', 'pronti_qua_localize_block_scripts');

/**
 * Aggiungi supporto per responsive images nei blocchi
 */
function pronti_qua_add_responsive_image_support() {
    add_theme_support('responsive-embeds');
    add_theme_support('post-thumbnails');

    // Aggiungi size personalizzate per i blocchi
    add_image_size('pronti-qua-slideshow', 800, 400, true);
    add_image_size('pronti-qua-project-card', 400, 300, true);
    add_image_size('pronti-qua-team-member', 300, 300, true);
}
add_action('after_setup_theme', 'pronti_qua_add_responsive_image_support');
?>