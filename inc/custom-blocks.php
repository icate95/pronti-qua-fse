

function pronti_qua_register_block_category($categories, $post) {
    return array_merge(
        array(
            array(
                'slug'  => 'pronti-qua',
                'title' => __('Pronti Qua ODV', 'pronti-qua'),
                'icon'  => 'heart',
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'pronti_qua_register_block_category', 10, 2);

function pronti_qua_localize_blocks() {
    wp_localize_script('pronti-qua-blocks', 'prontiQuaBlocks', array(
        'nonce' => wp_create_nonce('pronti_qua_blocks'),
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'strings' => array(
            'copied' => __('Copiato!', 'pronti-qua'),
            'copy' => __('Copia', 'pronti-qua'),
            'close' => __('Chiudi', 'pronti-qua'),
        )
    ));
}
add_action('wp_enqueue_scripts', 'pronti_qua_localize_blocks');