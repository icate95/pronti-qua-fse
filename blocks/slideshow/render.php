<?php
/**
 * Slideshow Block Render Template - Versione Semplificata
 * File: blocks/slideshow/render.php
 */

// Parametri con defaults sicuri
$height = isset($attributes['height']) ? intval($attributes['height']) : 400;
$autoplay = isset($attributes['autoplay']) ? (bool)$attributes['autoplay'] : true;
$interval = isset($attributes['interval']) ? intval($attributes['interval']) : 4000;
$showIndicators = isset($attributes['showIndicators']) ? (bool)$attributes['showIndicators'] : true;

// Validazione parametri
$height = max(200, min(800, $height));
$interval = max(1000, min(10000, $interval));

// Numero di slide (hardcoded per semplicità)
$slide_count = 5;
?>

<div class="pronti-qua-slideshow">
    <div class="slideshow-container"
         style="height: <?php echo esc_attr($height); ?>px;"
         data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>"
         data-interval="<?php echo esc_attr($interval); ?>"
         data-show-indicators="<?php echo $showIndicators ? 'true' : 'false'; ?>">

        <?php for ($i = 1; $i <= $slide_count; $i++): ?>
            <div class="slide <?php echo $i === 1 ? 'active' : ''; ?>">
                <!-- Le immagini sono gestite via CSS -->
            </div>
        <?php endfor; ?>

        <?php if ($showIndicators && $slide_count > 1): ?>
            <div class="slideshow-indicators">
                <?php for ($i = 0; $i < $slide_count; $i++): ?>
                    <button class="indicator <?php echo $i === 0 ? 'active' : ''; ?>"
                            data-slide="<?php echo $i; ?>"
                            aria-label="Vai alla slide <?php echo $i + 1; ?>"></button>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</div>