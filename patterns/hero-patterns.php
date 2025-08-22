<?php
/**
 * Hero Section Patterns - Aggiornato con blocco Slideshow
 */

// Hero Homepage
register_block_pattern(
    'pronti-qua/hero-homepage',
    array(
        'title'         => __('Hero Homepage', 'pronti-qua'),
        'description'   => __('Hero section principale per la homepage', 'pronti-qua'),
        'categories'    => array('pronti-qua-hero'),
        'content'       => '
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#2d3748"}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#2d3748;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl","left":"var:preset|spacing|md","right":"var:preset|spacing|md"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--3-xl);padding-right:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--3-xl);padding-left:var(--wp--preset--spacing--md)">

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-columns alignwide">

<!-- wp:column {"width":"60%","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg);flex-basis:60%">

<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 5vw, 4rem)","lineHeight":"1.1","fontWeight":"700","fontStyle":"normal"},"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}},"textColor":"white","fontFamily":"playfair"} -->
<h1 class="wp-block-heading has-white-color has-text-color has-playfair-font-family" style="margin-bottom:var(--wp--preset--spacing--md);font-size:clamp(2.5rem, 5vw, 4rem);font-style:normal;font-weight:700;line-height:1.1">Quando il tumore cerebrale cambia tutto, noi ci siamo.<br><mark style="background-color:var(--wp--preset--color--giallo-highlight);color:#2d3748;padding:0.2em 0.4em;">Pronti qua.</mark></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|large","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"var:preset|spacing|lg"}}},"textColor":"gray-300"} -->
<p class="has-gray-300-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--lg);font-size:var(--wp--preset--font-size--large);line-height:1.6">Dal 2019 supportiamo pazienti e famiglie nel percorso più difficile della loro vita, con progetti concreti che fanno davvero la differenza.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|md"},"blockGap":"var:preset|spacing|md"}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--xl);margin-bottom:var(--wp--preset--spacing--md)">

<!-- wp:button {"backgroundColor":"verde-primario","textColor":"white","className":"hero-button-primary","style":{"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}},"typography":{"fontWeight":"600","fontStyle":"normal"},"border":{"radius":"0px"}},"fontSize":"medium"} -->
<div class="wp-block-button hero-button-primary"><a class="wp-block-button__link has-white-color has-verde-primario-background-color has-text-color has-background has-medium-font-size has-custom-font-size wp-element-button" style="border-radius:0px;padding-top:var(--wp--preset--spacing--sm);padding-right:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--lg);font-style:normal;font-weight:600">Scopri i nostri progetti</a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"white","textColor":"dark","className":"hero-button-secondary","style":{"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}},"typography":{"fontWeight":"600","fontStyle":"normal"},"border":{"radius":"0px"}},"fontSize":"medium"} -->
<div class="wp-block-button hero-button-secondary"><a class="wp-block-button__link has-dark-color has-white-background-color has-text-color has-background has-medium-font-size has-custom-font-size wp-element-button" style="border-radius:0px;padding-top:var(--wp--preset--spacing--sm);padding-right:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--lg);font-style:normal;font-weight:600">Contattaci</a></div>
<!-- /wp:button -->

</div>
<!-- /wp:buttons -->

</div>
<!-- /wp:column -->

<!-- wp:column {"width":"40%","style":{"spacing":{"padding":{"top":"var:preset|spacing|md","bottom":"var:preset|spacing|md"}}}} -->
<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--md);flex-basis:40%">

<!-- wp:pronti-qua/slideshow {"height":400,"autoplay":true,"interval":4000,"showIndicators":false,"backgroundColor":"#f8fafc","slides":[{"title":"La nostra storia","content":"In memoria di Roberto e della sua determinazione","backgroundColor":"verde-primario","imageId":null,"imageUrl":"","imageAlt":""},{"title":"Supporto psicologico","content":"Specialisti dedicati per pazienti e famiglie","backgroundColor":"rosa-accento","imageId":null,"imageUrl":"","imageAlt":""},{"title":"Onde di Speranza","content":"Raccolta fondi per strumentazione medica","backgroundColor":"azzurro-secondario","imageId":null,"imageUrl":"","imageAlt":""},{"title":"BussoLà","content":"Rete territoriale per l\'assistenza oncologica","backgroundColor":"giallo-highlight","imageId":null,"imageUrl":"","imageAlt":""}]} /-->

</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->',
    )
);
?>