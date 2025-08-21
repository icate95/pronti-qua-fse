<?php
/**
 * Hero Section Patterns
 */

// Hero Homepage
register_block_pattern(
    'pronti-qua/hero-homepage',
    array(
        'title'         => __('Hero Homepage', 'pronti-qua'),
        'description'   => __('Hero section principale per la homepage', 'pronti-qua'),
        'categories'    => array('pronti-qua-hero'),
        'content'       => '
<!-- wp:cover {"url":"","dimRatio":40,"overlayColor":"dark","minHeight":600,"contentPosition":"center center","isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}}} -->
<div class="wp-block-cover alignfull is-light" style="padding-top:80px;padding-bottom:80px;min-height:600px">
    <span aria-hidden="true" class="wp-block-cover__background has-dark-background-color has-background-dim-40 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xxx-large","textColor":"white"} -->
            <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color has-xxx-large-font-size">Insieme per chi<br><span style="color: var(--wp--preset--color--giallo-highlight);">ha bisogno</span></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","fontSize":"large","textColor":"white","style":{"spacing":{"margin":{"top":"24px","bottom":"32px"}}}} -->
            <p class="has-text-align-center has-white-color has-text-color has-large-font-size" style="margin-top:24px;margin-bottom:32px">Supportiamo pazienti oncologici e le loro famiglie con progetti concreti, vicinanza umana e speranza per il futuro.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"16px"}}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"rosa-accento","textColor":"white","style":{"border":{"radius":"8px"}},"fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size has-medium-font-size">
                    <a class="wp-block-button__link has-white-color has-rosa-accento-background-color has-text-color has-background wp-element-button" href="/dona" style="border-radius:8px">💝 Dona Ora</a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"backgroundColor":"transparent","textColor":"white","style":{"border":{"radius":"8px","color":"#ffffff","width":"2px"}},"fontSize":"medium","className":"is-style-outline"} -->
                <div class="wp-block-button has-custom-font-size is-style-outline has-medium-font-size">
                    <a class="wp-block-button__link has-white-color has-transparent-background-color has-text-color has-background has-border-color wp-element-button" href="/progetti" style="border-color:#ffffff;border-width:2px;border-radius:8px">Scopri i Progetti</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->',
    )
);

// Hero Progetti
register_block_pattern(
    'pronti-qua/hero-project',
    array(
        'title'         => __('Hero Progetti', 'pronti-qua'),
        'description'   => __('Hero section per pagine progetto', 'pronti-qua'),
        'categories'    => array('pronti-qua-hero'),
        'content'       => '
<!-- wp:cover {"dimRatio":20,"overlayColor":"verde-primario","minHeight":400,"contentPosition":"center left","isDark":false,"align":"full"} -->
<div class="wp-block-cover alignfull has-custom-content-position is-position-center-left is-light" style="min-height:400px">
    <span aria-hidden="true" class="wp-block-cover__background has-verde-primario-background-color has-background-dim-20 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
            <!-- wp:heading {"level":1,"fontSize":"xx-large","textColor":"white"} -->
            <h1 class="wp-block-heading has-white-color has-text-color has-xx-large-font-size">Nome Progetto</h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"fontSize":"large","textColor":"white","style":{"spacing":{"margin":{"top":"16px"}}}} -->
            <p class="has-white-color has-text-color has-large-font-size" style="margin-top:16px">Descrizione breve del progetto e del suo impatto sulla comunità.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->',
    )
);