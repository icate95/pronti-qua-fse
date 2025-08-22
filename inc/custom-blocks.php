<?php
/**
 * Custom Blocks Registration - Versione Ultra-Semplificata
 * Sostituisce il contenuto di inc/custom-blocks.php
 */

// Blocco slideshow - Registrazione
function pronti_qua_register_slideshow_block() {
    register_block_type(get_template_directory() . '/blocks/slideshow');
}
add_action('init', 'pronti_qua_register_slideshow_block');

/**
 * Rendering callback per il blocco slideshow - SOLO IMMAGINI
 */
function pronti_qua_render_slideshow($attributes) {
    // Parametri con defaults
    $height = isset($attributes['height']) ? intval($attributes['height']) : 400;
    $autoplay = isset($attributes['autoplay']) ? $attributes['autoplay'] : true;
    $interval = isset($attributes['interval']) ? intval($attributes['interval']) : 4000;
    $showIndicators = isset($attributes['showIndicators']) ? $attributes['showIndicators'] : true;

    // Slide predefinite - PERCORSI CORRETTI .jpeg
    $theme_uri = get_template_directory_uri();
    $slides = [
        [
            'imageUrl' => $theme_uri . '/assets/img/slide-volontari.jpeg',
            'backgroundColor' => 'verde-primario'
        ],
        [
            'imageUrl' => $theme_uri . '/assets/img/slide-supporto.jpeg',
            'backgroundColor' => 'azzurro-secondario'
        ],
        [
            'imageUrl' => $theme_uri . '/assets/img/slide-mercatini.jpeg',
            'backgroundColor' => 'rosa-accento'
        ],
        [
            'imageUrl' => $theme_uri . '/assets/img/slide-medici.jpeg',
            'backgroundColor' => 'giallo-highlight'
        ],
        [
            'imageUrl' => $theme_uri . '/assets/img/slide-crav.jpeg',
            'backgroundColor' => 'verde-primario'
        ]
    ];

    // Validazione parametri
    $height = max(200, min(800, $height));
    $interval = max(1000, min(10000, $interval));

    ob_start();
    ?>
    <div class="pronti-qua-slideshow">
        <div class="slideshow-container"
             style="height: <?php echo esc_attr($height); ?>px;"
             data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>"
             data-interval="<?php echo esc_attr($interval); ?>"
             data-show-indicators="<?php echo $showIndicators ? 'true' : 'false'; ?>">

            <?php foreach ($slides as $index => $slide): ?>
                <div class="slide <?php echo $index === 0 ? 'active' : ''; ?> bg-<?php echo esc_attr($slide['backgroundColor']); ?>"
                     style="background-image: url('<?php echo esc_url($slide['imageUrl']); ?>');">
                    <!-- Nessun contenuto di testo -->
                </div>
            <?php endforeach; ?>

            <?php if ($showIndicators && count($slides) > 1): ?>
                <div class="slideshow-indicators">
                    <?php for ($i = 0; $i < count($slides); $i++): ?>
                        <button class="indicator <?php echo $i === 0 ? 'active' : ''; ?>"
                                data-slide="<?php echo $i; ?>"
                                aria-label="Vai alla slide <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Enqueue assets - Solo i file necessari
 */
function pronti_qua_enqueue_slideshow_assets() {
    // CSS Frontend
    wp_enqueue_style(
        'pronti-qua-slideshow-style',
        get_template_directory_uri() . '/blocks/slideshow/style-index.css',
        array(),
        filemtime(get_template_directory() . '/blocks/slideshow/style-index.css')
    );

    // JavaScript Frontend
    wp_enqueue_script(
        'pronti-qua-slideshow-frontend',
        get_template_directory_uri() . '/blocks/slideshow/frontend.js',
        array(),
        filemtime(get_template_directory() . '/blocks/slideshow/frontend.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'pronti_qua_enqueue_slideshow_assets');
add_action('enqueue_block_assets', 'pronti_qua_enqueue_slideshow_assets');

/**
 * Enqueue editor assets
 */
function pronti_qua_slideshow_editor_assets() {
    // JavaScript Editor
    wp_enqueue_script(
        'pronti-qua-slideshow-editor',
        get_template_directory_uri() . '/blocks/slideshow/index.js',
        array('wp-blocks', 'wp-element', 'wp-block-editor'),
        filemtime(get_template_directory() . '/blocks/slideshow/index.js'),
        false
    );

    // CSS Editor
    wp_enqueue_style(
        'pronti-qua-slideshow-editor-style',
        get_template_directory_uri() . '/blocks/slideshow/index.css',
        array('wp-edit-blocks'),
        filemtime(get_template_directory() . '/blocks/slideshow/index.css')
    );
}
add_action('enqueue_block_editor_assets', 'pronti_qua_slideshow_editor_assets');

/**
 * Categorie blocchi personalizzate
 */
function pronti_qua_block_categories($categories) {
    return array_merge(
        array(
            array(
                'slug'  => 'pronti-qua',
                'title' => __('Pronti Qua ODV', 'pronti-qua'),
                'icon'  => 'heart',
            )
        ),
        $categories
    );
}
add_filter('block_categories_all', 'pronti_qua_block_categories');

/**
 * Debug: Verifica esistenza file immagini
 */
function pronti_qua_check_slide_images() {
    if (current_user_can('manage_options')) {
        $theme_dir = get_template_directory();
        $images = [
            'slide-volontari.jpeg',
            'slide-supporto.jpeg',
            'slide-mercatini.jpeg',
            'slide-medici.jpeg',
            'slide-crav.jpeg'
        ];

        foreach ($images as $image) {
            $path = $theme_dir . '/assets/img/' . $image;
            if (!file_exists($path)) {
                error_log("Slideshow: Immagine mancante - $image in $path");
            }
        }
    }
}
add_action('admin_init', 'pronti_qua_check_slide_images');