<?php
/**
 * Registrazione dei blocchi custom per Pronti Qua ODV - Versione Fallback
 */

// Assicurati che non ci sia accesso diretto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra il blocco slideshow con fallback PHP-only
 */
function pronti_qua_register_slideshow_fallback() {
    register_block_type('pronti-qua/slideshow', array(
        'title' => 'Slideshow Pronti Qua',
        'description' => 'Slideshow automatico per mostrare progetti e servizi',
        'category' => 'pronti-qua',
        'icon' => 'slides',
        'keywords' => array('slideshow', 'slider', 'pronti-qua'),
        'supports' => array(
            'align' => array('left', 'center', 'right', 'wide', 'full'),
            'spacing' => array(
                'margin' => true,
                'padding' => true
            )
        ),
        'attributes' => array(
            'height' => array(
                'type' => 'number',
                'default' => 400
            ),
            'autoplay' => array(
                'type' => 'boolean',
                'default' => true
            ),
            'interval' => array(
                'type' => 'number',
                'default' => 4000
            ),
            'showIndicators' => array(
                'type' => 'boolean',
                'default' => true
            )
        ),
        'render_callback' => 'pronti_qua_render_slideshow_fallback',
        'editor_script' => null, // Nessun JavaScript complesso per l'editor
        'editor_style' => null,
        'style' => null
    ));
}
add_action('init', 'pronti_qua_register_slideshow_fallback');

/**
 * Render del blocco slideshow
 */
function pronti_qua_render_slideshow_fallback($attributes, $content, $block) {
    $height = $attributes['height'] ?? 400;
    $autoplay = $attributes['autoplay'] ?? true;
    $interval = $attributes['interval'] ?? 4000;
    $showIndicators = $attributes['showIndicators'] ?? true;

    // Ottieni l'URI del tema
    $theme_uri = get_template_directory_uri();

    // Slide predefinite ottimizzate
    $slides = array(
        array(
            'title' => 'I nostri volontari',
            'content' => 'Grazie ai volontari e a chi ci sostiene quotidianamente riusciamo ad ottenere grandi risultati',
            'backgroundColor' => 'verde-primario',
            'imageUrl' => $theme_uri . '/assets/img/slide-volontari.jpeg',
            'imageAlt' => 'Gruppo di volontari dell\'associazione Pronti Qua durante un evento di solidarietà'
        ),
        array(
            'title' => 'Supporto psicologico specializzato',
            'content' => 'Professionisti qualificati accompagnano pazienti e famiglie nel percorso di cura',
            'backgroundColor' => 'rosa-accento',
            'imageUrl' => $theme_uri . '/assets/img/slide-supporto.jpeg',
            'imageAlt' => 'Momento di racconto per facilitare la condivisione'
        ),
        array(
            'title' => 'Le nostre raccolte fondi',
            'content' => 'Eventi e mercatini per sostenere la ricerca e i progetti dell\'associazione',
            'backgroundColor' => 'azzurro-secondario',
            'imageUrl' => $theme_uri . '/assets/img/slide-mercatini.jpeg',
            'imageAlt' => 'Mercatino natalizio e raccolta fondi dell\'associazione Pronti Qua'
        ),
        array(
            'title' => 'Collaborazione con l\'Ospedale Santa Chiara',
            'content' => 'Partnership strategica per migliorare l\'assistenza ai pazienti oncologici',
            'backgroundColor' => 'giallo-highlight',
            'imageUrl' => $theme_uri . '/assets/img/slide-medici.jpeg',
            'imageAlt' => 'Équipe medica dell\'Ospedale Santa Chiara di Trento all\'annuale conferenza'
        ),
        array(
            'title' => 'Sempre pronti per nuovi progetti',
            'content' => 'Idee innovative al servizio di famiglie e pazienti in difficoltà',
            'backgroundColor' => 'verde-primario',
            'imageUrl' => $theme_uri . '/assets/img/slide-crav.jpeg',
            'imageAlt' => 'Presentazione di nuovi progetti dell\'associazione Pronti Qua'
            )
    );

    // Hook per personalizzare le slide
    $slides = apply_filters('pronti_qua_slideshow_slides', $slides, $attributes);

    if (empty($slides)) {
        return '<div class="pronti-qua-slideshow"><p>Nessuna slide configurata.</p></div>';
    }

    // Genera l'output HTML
    ob_start();
    ?>
    <div class="pronti-qua-slideshow">
        <div class="slideshow-container"
             style="height: <?php echo esc_attr($height); ?>px;"
             data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>"
             data-interval="<?php echo esc_attr($interval); ?>"
             data-show-indicators="<?php echo $showIndicators ? 'true' : 'false'; ?>">

            <?php foreach ($slides as $index => $slide): ?>
                <div class="slide <?php echo $index === 0 ? 'active' : ''; ?> <?php echo !empty($slide['imageUrl']) ? 'has-background-image' : 'bg-' . esc_attr($slide['backgroundColor']); ?>"
                     <?php if (!empty($slide['imageUrl'])): ?>
                         style="background: url('<?php echo esc_url($slide['imageUrl']); ?>'); background-size: cover; background-position: center;"
                     <?php endif; ?>>
                </div>
            <?php endforeach; ?>

            <?php if ($showIndicators && count($slides) > 1): ?>
                <div class="slideshow-indicators">
                    <?php foreach ($slides as $index => $slide): ?>
                        <button class="indicator <?php echo $index === 0 ? 'active' : ''; ?>"
                                data-slide="<?php echo esc_attr($index); ?>"
                                aria-label="<?php echo esc_attr(sprintf(__('Vai alla slide %d: %s', 'pronti-qua'), $index + 1, $slide['title'])); ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Enqueue CSS e JavaScript per il slideshow
 */
function pronti_qua_enqueue_slideshow_assets() {
    // CSS del slideshow
    wp_enqueue_style(
        'pronti-qua-slideshow',
        get_template_directory_uri() . '/blocks/slideshow/style-index.css',
        array(),
        filemtime(get_template_directory() . '/blocks/slideshow/style-index.css')
    );

    // JavaScript del slideshow
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
 * Crea categorie custom per i blocchi
 */
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
        ),
        $categories
    );
}
add_filter('block_categories_all', 'pronti_qua_block_categories');

/**
 * Aggiungi editor placeholder per il blocco slideshow
 */
function pronti_qua_slideshow_editor_assets() {
    wp_enqueue_script(
        'pronti-qua-slideshow-editor-placeholder',
        get_template_directory_uri() . '/blocks/slideshow/editor-placeholder.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(get_template_directory() . '/blocks/slideshow/editor-placeholder.js'),
        false
    );
}
add_action('enqueue_block_editor_assets', 'pronti_qua_slideshow_editor_assets');
