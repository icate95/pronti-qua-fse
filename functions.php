<?php
/**
 * Pronti Qua ODV Theme Functions
 * Adds support for fixed navigation and enhanced WordPress navigation features
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles and scripts
 */
function pronti_qua_enqueue_assets() {
    wp_enqueue_style(
        'pronti-qua-style',
        get_template_directory_uri() . '/assets/css/theme.css',
        array(),
        wp_get_theme()->get('Version')
    );

    // Fixed navigation specific CSS
    wp_enqueue_style(
        'pronti-qua-fixed-nav',
        get_template_directory_uri() . '/assets/css/fixed-navigation.css',
        array('pronti-qua-style'),
        wp_get_theme()->get('Version')
    );

    // Navigation JavaScript
    wp_enqueue_script(
        'pronti-qua-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Pass data to JavaScript
    wp_localize_script('pronti-qua-navigation', 'prontiQuaNav', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('pronti_qua_nonce'),
        'isMobile' => wp_is_mobile(),
        'homeUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'pronti_qua_enqueue_assets');

/**
 * Setup theme support
 */
function pronti_qua_theme_support() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Switch default core markup for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Editor (Gutenberg)
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'pronti-qua'),
        'footer' => __('Footer Menu', 'pronti-qua'),
        'mobile' => __('Mobile Menu', 'pronti-qua'),
    ));
}
add_action('after_setup_theme', 'pronti_qua_theme_support');

/**
 * Register and enqueue editor styles
 */
function pronti_qua_editor_styles() {
    add_editor_style('assets/css/editor-style.css');
}
add_action('admin_init', 'pronti_qua_editor_styles');

/**
 * Add custom classes to navigation menu items
 */
function pronti_qua_nav_menu_css_class($classes, $item, $args, $depth) {
    // Add special class for "Progetti" menu item
    if (in_array('progetti', $classes) ||
        (isset($item->title) && strtolower($item->title) === 'progetti')) {
        $classes[] = 'progetti-menu-item';
    }

    // Add special class for "Dona/Sostienici" menu item
    if (in_array('dona', $classes) ||
        (isset($item->title) && (strtolower($item->title) === 'dona' || strtolower($item->title) === 'sostienici'))) {
        $classes[] = 'dona-menu-item';
    }

    // Add dropdown indicator class for items with children
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'has-dropdown';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'pronti_qua_nav_menu_css_class', 10, 4);

/**
 * Add custom attributes to navigation menu links
 */
function pronti_qua_nav_menu_link_attributes($atts, $item, $args, $depth) {
    // Add aria-expanded for dropdown items
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['aria-expanded'] = 'false';
        $atts['aria-haspopup'] = 'true';
    }

    // Add custom data attributes for special menu items
    if (in_array('progetti-menu-item', $item->classes)) {
        $atts['data-menu-type'] = 'progetti';
    }

    if (in_array('dona-menu-item', $item->classes)) {
        $atts['data-menu-type'] = 'cta';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'pronti_qua_nav_menu_link_attributes', 10, 4);

/**
 * Custom Walker for enhanced navigation
 */
class Pronti_Qua_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Start the element output
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Apply filters
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';

        // Add custom attributes
        $custom_attributes = apply_filters('nav_menu_link_attributes', array(), $item, $args, $depth);
        foreach ($custom_attributes as $attr => $value) {
            $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
        }

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');

        // Add dropdown icon for parent items
        if (in_array('menu-item-has-children', $classes) && $depth === 0) {
            $item_output .= ' <span class="dropdown-icon" aria-hidden="true">▾</span>';
        }

        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Add body classes for navigation state
 */
function pronti_qua_body_classes($classes) {
    // Add class if we're using fixed navigation
    $classes[] = 'has-fixed-navigation';

    // Add mobile class
    if (wp_is_mobile()) {
        $classes[] = 'is-mobile-device';
    }

    // Add class for homepage
    if (is_front_page()) {
        $classes[] = 'is-homepage';
    }

    return $classes;
}
add_filter('body_class', 'pronti_qua_body_classes');

/**
 * Customize navigation block for theme
 */
function pronti_qua_navigation_block_render($block_content, $block) {
    if ($block['blockName'] === 'core/navigation') {
        // Add theme-specific classes
        $block_content = str_replace(
            'wp-block-navigation',
            'wp-block-navigation pronti-qua-navigation',
            $block_content
        );

        // Add accessibility improvements
        $block_content = str_replace(
            '<nav',
            '<nav role="navigation" aria-label="' . __('Main Navigation', 'pronti-qua') . '"',
            $block_content
        );
    }

    return $block_content;
}
add_filter('render_block', 'pronti_qua_navigation_block_render', 10, 2);

/**
 * Add inline styles for dynamic navigation styling
 */
function pronti_qua_navigation_inline_styles() {
    $custom_css = '';

    // Get theme colors from theme.json
    $verde_primario = '#6f8a2b';
    $rosa_accento = '#e66395';

    // Dynamic styles based on customizer or theme options
    if (get_theme_mod('navigation_highlight_color')) {
        $highlight_color = get_theme_mod('navigation_highlight_color');
        $custom_css .= "
            .progetti-menu-item .wp-block-navigation-item__content::after {
                background: {$highlight_color};
            }
        ";
    }

    if (get_theme_mod('navigation_cta_color')) {
        $cta_color = get_theme_mod('navigation_cta_color');
        $custom_css .= "
            .dona-menu-item .wp-block-navigation-item__content,
            .mobile-cta-center .wp-block-button__link {
                background: {$cta_color} !important;
            }
        ";
    }

    if (!empty($custom_css)) {
        wp_add_inline_style('pronti-qua-fixed-nav', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'pronti_qua_navigation_inline_styles');

/**
 * AJAX handler for navigation interactions
 */
function pronti_qua_navigation_ajax() {
    check_ajax_referer('pronti_qua_nonce', 'nonce');

    $action = sanitize_text_field($_POST['nav_action']);

    switch ($action) {
        case 'track_menu_click':
            // Track menu interactions for analytics
            $menu_item = sanitize_text_field($_POST['menu_item']);
            // Add your tracking logic here
            wp_send_json_success(['tracked' => $menu_item]);
            break;

        case 'get_submenu_content':
            // Dynamic submenu content if needed
            $menu_id = intval($_POST['menu_id']);
            // Add your dynamic content logic here
            wp_send_json_success(['content' => 'Dynamic content']);
            break;
    }

    wp_send_json_error('Invalid action');
}
add_action('wp_ajax_pronti_qua_navigation', 'pronti_qua_navigation_ajax');
add_action('wp_ajax_nopriv_pronti_qua_navigation', 'pronti_qua_navigation_ajax');

/**
 * Add customizer options for navigation
 */
function pronti_qua_customize_register($wp_customize) {
    // Navigation section
    $wp_customize->add_section('pronti_qua_navigation', array(
        'title' => __('Navigation Settings', 'pronti-qua'),
        'priority' => 30,
    ));

    // Highlight color for progetti menu
    $wp_customize->add_setting('navigation_highlight_color', array(
        'default' => '#6f8a2b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navigation_highlight_color', array(
        'label' => __('Progetti Highlight Color', 'pronti-qua'),
        'section' => 'pronti_qua_navigation',
    )));

    // CTA button color
    $wp_customize->add_setting('navigation_cta_color', array(
        'default' => '#e66395',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navigation_cta_color', array(
        'label' => __('CTA Button Color', 'pronti-qua'),
        'section' => 'pronti_qua_navigation',
    )));

    // Enable/disable auto-hide on scroll
    $wp_customize->add_setting('navigation_auto_hide', array(
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('navigation_auto_hide', array(
        'label' => __('Auto-hide navigation on scroll', 'pronti-qua'),
        'section' => 'pronti_qua_navigation',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'pronti_qua_customize_register');

/**
 * Add schema markup to navigation
 */
function pronti_qua_navigation_schema() {
    if (is_front_page()) {
        echo '<script type="application/ld+json">';
        echo json_encode(array(
            '@context' => 'https://schema.org',
            '@type' => 'SiteNavigationElement',
            'name' => get_bloginfo('name'),
            'url' => home_url('/')
        ));
        echo '</script>';
    }
}
add_action('wp_head', 'pronti_qua_navigation_schema');

/**
 * Preload critical navigation resources
 */
function pronti_qua_preload_navigation_resources() {
    // Preload navigation CSS
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/css/fixed-navigation.css" as="style">';

    // Preload navigation JS
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/js/navigation.js" as="script">';

    // Preload logo if set
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
        echo '<link rel="preload" href="' . esc_url($logo_url) . '" as="image">';
    }
}
add_action('wp_head', 'pronti_qua_preload_navigation_resources', 1);

/**
 * Remove unnecessary navigation CSS from WordPress core
 */
function pronti_qua_dequeue_unnecessary_styles() {
    // Remove default navigation block styles that conflict
    wp_dequeue_style('wp-block-navigation');

    // Re-enqueue with our custom version
    wp_enqueue_style(
        'wp-block-navigation-custom',
        get_template_directory_uri() . '/assets/css/fixed-navigation.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'pronti_qua_dequeue_unnecessary_styles', 100);

?>