<?php
/**
 * Registrazione Custom Post Types
 */

// Progetti
function pronti_qua_register_progetti_cpt() {
    $labels = array(
        'name'               => 'Progetti',
        'singular_name'      => 'Progetto',
        'menu_name'          => 'Progetti',
        'add_new'            => 'Aggiungi Nuovo',
        'add_new_item'       => 'Aggiungi Nuovo Progetto',
        'edit_item'          => 'Modifica Progetto',
        'new_item'           => 'Nuovo Progetto',
        'view_item'          => 'Visualizza Progetto',
        'search_items'       => 'Cerca Progetti',
        'not_found'          => 'Nessun progetto trovato',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'progetti'),
    );

    register_post_type('progetto', $args);
}
add_action('init', 'pronti_qua_register_progetti_cpt');

// Eventi
function pronti_qua_register_eventi_cpt() {
    $labels = array(
        'name'               => 'Eventi',
        'singular_name'      => 'Evento',
        'menu_name'          => 'Eventi',
        'add_new'            => 'Aggiungi Nuovo',
        'add_new_item'       => 'Aggiungi Nuovo Evento',
        'edit_item'          => 'Modifica Evento',
        'new_item'           => 'Nuovo Evento',
        'view_item'          => 'Visualizza Evento',
        'search_items'       => 'Cerca Eventi',
        'not_found'          => 'Nessun evento trovato',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'eventi'),
    );

    register_post_type('evento', $args);
}
add_action('init', 'pronti_qua_register_eventi_cpt');
