<?php
/**
 * Registrazione Block Patterns
 */

function pronti_qua_register_block_patterns() {
    // Registra le categorie dei pattern
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category('pronti-qua-hero', array(
            'label' => __('Hero Sections', 'pronti-qua'),
        ));

        register_block_pattern_category('pronti-qua-content', array(
            'label' => __('Content Sections', 'pronti-qua'),
        ));

        register_block_pattern_category('pronti-qua-cta', array(
            'label' => __('Call to Action', 'pronti-qua'),
        ));

        register_block_pattern_category('pronti-qua-projects', array(
            'label' => __('Progetti', 'pronti-qua'),
        ));
    }
}
add_action('init', 'pronti_qua_register_block_patterns');

// Include i file dei pattern
require_once get_template_directory() . '/patterns/hero-patterns.php';
require_once get_template_directory() . '/patterns/content-patterns.php';
require_once get_template_directory() . '/patterns/cta-patterns.php';
require_once get_template_directory() . '/patterns/project-patterns.php';