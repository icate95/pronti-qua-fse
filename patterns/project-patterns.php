<?php
/**
 * Project Section Patterns
 */

// Progetti in evidenza
register_block_pattern(
    'pronti-qua/projects-featured',
    array(
        'title'         => __('Progetti in evidenza', 'pronti-qua'),
        'description'   => __('Griglia progetti principali', 'pronti-qua'),
        'categories'    => array('pronti-qua-projects'),
        'content'       => '
<!-- wp:group {"style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:heading {"textAlign":"center","fontSize":"xx-large","textColor":"verde-primario","style":{"spacing":{"margin":{"bottom":"16px"}}}} -->
    <h2 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-xx-large-font-size" style="margin-bottom:16px">I Nostri Progetti</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","fontSize":"large","style":{"spacing":{"margin":{"bottom":"48px"}}}} -->
    <p class="has-text-align-center has-large-font-size" style="margin-bottom:48px">Ogni progetto nasce da un bisogno reale e mira a creare un impatto concreto e duraturo.</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"32px"}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"0px","bottom":"32px","left":"0px","right":"0px"}},"border":{"radius":"12px","width":"1px","color":"#e5e7eb"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e5e7eb;border-width:1px;border-radius:12px;padding-top:0px;padding-right:0px;padding-bottom:32px;padding-left:0px">
                <!-- wp:image {"aspectRatio":"16/9","scale":"cover","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
                <figure class="wp-block-image"><img alt="" style="border-top-left-radius:12px;border-top-right-radius:12px;aspect-ratio:16/9;object-fit:cover"/></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"0px","left":"24px","right":"24px"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:24px;padding-right:24px;padding-bottom:0px;padding-left:24px">
                    <!-- wp:heading {"level":3,"fontSize":"large","textColor":"azzurro-secondario"} -->
                    <h3 class="wp-block-heading has-azzurro-secondario-color has-text-color has-large-font-size">Onde di Speranza</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"normal","style":{"spacing":{"margin":{"top":"8px","bottom":"16px"}}}} -->
                    <p class="has-normal-font-size" style="margin-top:8px;margin-bottom:16px">Raccolta fondi per l\'acquisto di strumentazione medica all\'avanguardia per il reparto oncologico.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"8px","margin":{"bottom":"16px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                    <div class="wp-block-group" style="margin-bottom:16px">
                        <!-- wp:paragraph {"fontSize":"small","style":{"color":{"text":"#6b7280"}}} -->
                        <p class="has-text-color has-small-font-size" style="color:#6b7280">Raccolti: €85.000</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"fontSize":"small","style":{"color":{"text":"#6b7280"}}} -->
                        <p class="has-text-color has-small-font-size" style="color:#6b7280">Obiettivo: €120.000</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"backgroundColor":"light","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-light-background-color has-background" style="border-radius:8px;padding-top:4px;padding-right:0px;padding-bottom:4px;padding-left:0px">
                        <!-- wp:group {"backgroundColor":"azzurro-secondario","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"0px","right":"0px"}},"layout":{"width":"70%"}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group has-azzurro-secondario-background-color has-background" style="border-radius:8px;padding-top:8px;padding-right:0px;padding-bottom:8px;padding-left:0px"></div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"24px"}}}} -->
                    <div class="wp-block-buttons" style="margin-top:24px">
                        <!-- wp:button {"backgroundColor":"azzurro-secondario","width":100,"style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                        <div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size has-small-font-size">
                            <a class="wp-block-button__link has-azzurro-secondario-background-color has-background wp-element-button" href="/progetti/onde-di-speranza" style="border-radius:6px">Scopri il Progetto</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"0px","bottom":"32px","left":"0px","right":"0px"}},"border":{"radius":"12px","width":"1px","color":"#e5e7eb"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e5e7eb;border-width:1px;border-radius:12px;padding-top:0px;padding-right:0px;padding-bottom:32px;padding-left:0px">
                <!-- wp:image {"aspectRatio":"16/9","scale":"cover","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
                <figure class="wp-block-image"><img alt="" style="border-top-left-radius:12px;border-top-right-radius:12px;aspect-ratio:16/9;object-fit:cover"/></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"0px","left":"24px","right":"24px"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:24px;padding-right:24px;padding-bottom:0px;padding-left:24px">
                    <!-- wp:heading {"level":3,"fontSize":"large","textColor":"verde-primario"} -->
                    <h3 class="wp-block-heading has-verde-primario-color has-text-color has-large-font-size">Non Più Soli</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"normal","style":{"spacing":{"margin":{"top":"8px","bottom":"16px"}}}} -->
                    <p class="has-normal-font-size" style="margin-top:8px;margin-bottom:16px">Supporto psicologico gratuito per pazienti e famiglie durante il percorso oncologico.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"8px","margin":{"bottom":"16px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                    <div class="wp-block-group" style="margin-bottom:16px">
                        <!-- wp:paragraph {"fontSize":"small","style":{"color":{"text":"#059669"}}} -->
                        <p class="has-text-color has-small-font-size" style="color:#059669">✓ Progetto Attivo</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"fontSize":"small","style":{"color":{"text":"#6b7280"}}} -->
                        <p class="has-text-color has-small-font-size" style="color:#6b7280">150+ famiglie</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"24px"}}}} -->
                    <div class="wp-block-buttons" style="margin-top:24px">
                        <!-- wp:button {"backgroundColor":"verde-primario","width":100,"style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                        <div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size has-small-font-size">
                            <a class="wp-block-button__link has-verde-primario-background-color has-background wp-element-button" href="/progetti/non-piu-soli" style="border-radius:6px">Scopri il Progetto</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"48px"}}}} -->
    <div class="wp-block-buttons" style="margin-top:48px">
        <!-- wp:button {"backgroundColor":"transparent","textColor":"verde-primario","style":{"border":{"radius":"8px","color":"var:preset|color|verde-primario","width":"2px"}},"fontSize":"medium","className":"is-style-outline"} -->
        <div class="wp-block-button has-custom-font-size is-style-outline has-medium-font-size">
            <a class="wp-block-button__link has-verde-primario-color has-transparent-background-color has-text-color has-background has-border-color wp-element-button" href="/progetti" style="border-radius:8px">Tutti i Progetti</a>
        </div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
    )
);