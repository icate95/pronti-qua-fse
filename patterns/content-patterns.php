<?php
/**
 * Content Section Patterns
 */

// Impact Numbers
register_block_pattern(
    'pronti-qua/impact-numbers',
    array(
        'title'         => __('Numeri del nostro impatto', 'pronti-qua'),
        'description'   => __('Sezione con statistiche e numeri', 'pronti-qua'),
        'categories'    => array('pronti-qua-content'),
        'content'       => '
<!-- wp:group {"backgroundColor":"light","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-light-background-color has-background" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:heading {"textAlign":"center","fontSize":"xx-large","textColor":"verde-primario","style":{"spacing":{"margin":{"bottom":"48px"}}}} -->
    <h2 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-xx-large-font-size" style="margin-bottom:48px">Il Nostro Impatto</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}}}} -->
        <div class="wp-block-column" style="padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
            <!-- wp:heading {"textAlign":"center","fontSize":"xxx-large","textColor":"rosa-accento"} -->
            <h3 class="wp-block-heading has-text-align-center has-rosa-accento-color has-text-color has-xxx-large-font-size">500+</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","fontSize":"medium","style":{"spacing":{"margin":{"top":"8px"}}}} -->
            <p class="has-text-align-center has-medium-font-size" style="margin-top:8px">Famiglie supportate</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}}}} -->
        <div class="wp-block-column" style="padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
            <!-- wp:heading {"textAlign":"center","fontSize":"xxx-large","textColor":"azzurro-secondario"} -->
            <h3 class="wp-block-heading has-text-align-center has-azzurro-secondario-color has-text-color has-xxx-large-font-size">15</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","fontSize":"medium","style":{"spacing":{"margin":{"top":"8px"}}}} -->
            <p class="has-text-align-center has-medium-font-size" style="margin-top:8px">Progetti attivi</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}}}} -->
        <div class="wp-block-column" style="padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
            <!-- wp:heading {"textAlign":"center","fontSize":"xxx-large","textColor":"giallo-highlight"} -->
            <h3 class="wp-block-heading has-text-align-center has-giallo-highlight-color has-text-color has-xxx-large-font-size">€120K</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","fontSize":"medium","style":{"spacing":{"margin":{"top":"8px"}}}} -->
            <p class="has-text-align-center has-medium-font-size" style="margin-top:8px">Fondi raccolti nel 2024</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}}}} -->
        <div class="wp-block-column" style="padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
            <!-- wp:heading {"textAlign":"center","fontSize":"xxx-large","textColor":"verde-primario"} -->
            <h3 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-xxx-large-font-size">50+</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center","fontSize":"medium","style":{"spacing":{"margin":{"top":"8px"}}}} -->
            <p class="has-text-align-center has-medium-font-size" style="margin-top:8px">Volontari attivi</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
    )
);

// Come possiamo aiutarti
register_block_pattern(
    'pronti-qua/how-we-help',
    array(
        'title'         => __('Come possiamo aiutarti', 'pronti-qua'),
        'description'   => __('Sezione servizi di supporto', 'pronti-qua'),
        'categories'    => array('pronti-qua-content'),
        'content'       => '
<!-- wp:group {"style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:heading {"textAlign":"center","fontSize":"xx-large","textColor":"azzurro-secondario","style":{"spacing":{"margin":{"bottom":"48px"}}}} -->
    <h2 class="wp-block-heading has-text-align-center has-azzurro-secondario-color has-text-color has-xx-large-font-size" style="margin-bottom:48px">Come Possiamo Aiutarti</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"32px"}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"32px","right":"32px"}},"border":{"radius":"12px","width":"1px","color":"#e5e7eb"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e5e7eb;border-width:1px;border-radius:12px;padding-top:40px;padding-right:32px;padding-bottom:40px;padding-left:32px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xxx-large"} -->
                <h3 class="wp-block-heading has-text-align-center has-xxx-large-font-size">🤝</h3>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large","textColor":"verde-primario","style":{"spacing":{"margin":{"top":"16px","bottom":"16px"}}}} -->
                <h4 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-large-font-size" style="margin-top:16px;margin-bottom:16px">Supporto per Pazienti</h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","fontSize":"normal"} -->
                <p class="has-text-align-center has-normal-font-size">Accompagniamo i pazienti nel percorso di cura con supporto psicologico, informazioni e orientamento.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"24px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:24px">
                    <!-- wp:button {"backgroundColor":"azzurro-secondario","textColor":"white","style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                    <div class="wp-block-button has-custom-font-size has-small-font-size">
                        <a class="wp-block-button__link has-white-color has-azzurro-secondario-background-color has-text-color has-background wp-element-button" href="/aiuto/pazienti" style="border-radius:6px">Richiedi Aiuto</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"32px","right":"32px"}},"border":{"radius":"12px","width":"1px","color":"#e5e7eb"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e5e7eb;border-width:1px;border-radius:12px;padding-top:40px;padding-right:32px;padding-bottom:40px;padding-left:32px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xxx-large"} -->
                <h3 class="wp-block-heading has-text-align-center has-xxx-large-font-size">👨‍👩‍👧‍👦</h3>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large","textColor":"verde-primario","style":{"spacing":{"margin":{"top":"16px","bottom":"16px"}}}} -->
                <h4 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-large-font-size" style="margin-top:16px;margin-bottom:16px">Supporto per Familiari</h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","fontSize":"normal"} -->
                <p class="has-text-align-center has-normal-font-size">Aiutiamo le famiglie ad affrontare le difficoltà con consulenze, gruppi di sostegno e supporto pratico.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"24px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:24px">
                    <!-- wp:button {"backgroundColor":"azzurro-secondario","textColor":"white","style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                    <div class="wp-block-button has-custom-font-size has-small-font-size">
                        <a class="wp-block-button__link has-white-color has-azzurro-secondario-background-color has-text-color has-background wp-element-button" href="/aiuto/familiari" style="border-radius:6px">Contattaci</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"32px","right":"32px"}},"border":{"radius":"12px","width":"1px","color":"#e5e7eb"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e5e7eb;border-width:1px;border-radius:12px;padding-top:40px;padding-right:32px;padding-bottom:40px;padding-left:32px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xxx-large"} -->
                <h3 class="wp-block-heading has-text-align-center has-xxx-large-font-size">📋</h3>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large","textColor":"verde-primario","style":{"spacing":{"margin":{"top":"16px","bottom":"16px"}}}} -->
                <h4 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-large-font-size" style="margin-top:16px;margin-bottom:16px">Risorse Utili</h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","fontSize":"normal"} -->
                <p class="has-text-align-center has-normal-font-size">Guide, documenti e informazioni pratiche per orientarsi nel percorso di cura.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"24px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:24px">
                    <!-- wp:button {"backgroundColor":"azzurro-secondario","textColor":"white","style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                    <div class="wp-block-button has-custom-font-size has-small-font-size">
                        <a class="wp-block-button__link has-white-color has-azzurro-secondario-background-color has-text-color has-background wp-element-button" href="/aiuto/risorse" style="border-radius:6px">Esplora Risorse</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
    )
);

// Come puoi aiutarci
register_block_pattern(
'pronti-qua/how-you-help',
array(
'title'         => __('Come puoi aiutarci', 'pronti-qua'),
'description'   => __('Sezione modalità di supporto', 'pronti-qua'),
'categories'    => array('pronti-qua-content'),
'content'       => '
<!-- wp:group {"backgroundColor":"light","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-light-background-color has-background" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:heading {"textAlign":"center","fontSize":"xx-large","textColor":"rosa-accento","style":{"spacing":{"margin":{"bottom":"48px"}}}} -->
    <h2 class="wp-block-heading has-text-align-center has-rosa-accento-color has-text-color has-xx-large-font-size" style="margin-bottom:48px">Come Puoi Aiutarci</h2>
    <!-- /wp:heading -->
    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"24px"}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xx-large","style":{"color":{"text":"#ff6b6b"}}} -->
                <h3 class="wp-block-heading has-text-align-center has-text-color has-xx-large-font-size" style="color:#ff6b6b">💝</h3>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large","textColor":"rosa-accento"} -->
                <h4 class="wp-block-heading has-text-align-center has-rosa-accento-color has-text-color has-large-font-size">Dona</h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Il tuo contributo ci permette di finanziare progetti concreti e offrire supporto gratuito.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"16px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:16px">
                    <!-- wp:button {"backgroundColor":"rosa-accento","style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                    <div class="wp-block-button has-custom-font-size has-small-font-size">
                        <a class="wp-block-button__link has-rosa-accento-background-color has-background wp-element-button" href="/dona" style="border-radius:6px">Dona Ora</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xx-large"} -->
                <h3 class="wp-block-heading has-text-align-center has-xx-large-font-size">🤲</h3>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large","textColor":"verde-primario"} -->
                <h4 class="wp-block-heading has-text-align-center has-verde-primario-color has-text-color has-large-font-size">Volontariato</h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Dedica il tuo tempo e le tue competenze per fare la differenza nella vita di chi ha bisogno.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"16px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:16px">
                    <!-- wp:button {"backgroundColor":"verde-primario","style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                    <div class="wp-block-button has-custom-font-size has-small-font-size">
                        <a class="wp-block-button__link has-verde-primario-background-color has-background wp-element-button" href="/volontario" style="border-radius:6px">Diventa Volontario</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:32px;padding-right:24px;padding-bottom:32px;padding-left:24px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xx-large"} -->
                <h3 class="wp-block-heading has-text-align-center has-xx-large-font-size">📄</h3>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large","textColor":"giallo-highlight"} -->
                <h4 class="wp-block-heading has-text-align-center has-giallo-highlight-color has-text-color has-large-font-size">5x1000</h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Destina il tuo 5x1000 a Pronti Qua: non costa nulla ma vale moltissimo per noi.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"16px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:16px">
                    <!-- wp:button {"backgroundColor":"giallo-highlight","textColor":"dark","style":{"border":{"radius":"6px"}},"fontSize":"small"} -->
                    <div class="wp-block-button has-custom-font-size has-small-font-size">
                        <a class="wp-block-button__link has-dark-color has-giallo-highlight-background-color has-text-color has-background wp-element-button" href="/5x1000" style="border-radius:6px">Scopri Come</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->',
        )
    );


// Pattern con Progress Bar
register_block_pattern(
    'pronti-qua/project-with-progress',
    array(
        'title'         => __('Progetto con Progress Bar', 'pronti-qua'),
        'description'   => __('Layout progetto con barra di progresso', 'pronti-qua'),
        'categories'    => array('pronti-qua-projects'),
        'content'       => '
<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"48px"}}} -->
<div class="wp-block-columns alignwide">
    <!-- wp:column {"width":"60%"} -->
    <div class="wp-block-column" style="flex-basis:60%">
        <!-- wp:heading {"fontSize":"x-large","textColor":"verde-primario"} -->
        <h2 class="wp-block-heading has-verde-primario-color has-text-color has-x-large-font-size">Onde di Speranza</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"fontSize":"medium"} -->
        <p class="has-medium-font-size">Il progetto Onde di Speranza mira a raccogliere fondi per l\'acquisto di strumentazione medica all\'avanguardia per il reparto oncologico dell\'ospedale Santa Chiara di Trento.</p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph -->
        <p>Grazie al vostro supporto, potremo garantire cure sempre migliori e più precise per tutti i pazienti che affrontano il loro percorso di guarigione.</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"24px"}}}} -->
        <div class="wp-block-buttons" style="margin-top:24px">
            <!-- wp:button {"backgroundColor":"rosa-accento","style":{"border":{"radius":"8px"}},"fontSize":"medium"} -->
            <div class="wp-block-button has-custom-font-size has-medium-font-size">
                <a class="wp-block-button__link has-rosa-accento-background-color has-background wp-element-button" href="/dona" style="border-radius:8px">Dona Ora</a>
            </div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"40%"} -->
    <div class="wp-block-column" style="flex-basis:40%">
        <!-- wp:pronti-qua/project-progress {"projectTitle":"Onde di Speranza","currentAmount":85000,"targetAmount":120000} /-->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->',
    )
);

// Pattern con Impact Counters
register_block_pattern(
    'pronti-qua/impact-counters-row',
    array(
        'title'         => __('Riga Contatori Impatto', 'pronti-qua'),
        'description'   => __('4 contatori di impatto in riga', 'pronti-qua'),
        'categories'    => array('pronti-qua-content'),
        'content'       => '
<!-- wp:group {"backgroundColor":"light","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-light-background-color has-background" style="padding-top:60px;padding-bottom:60px">
    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:pronti-qua/impact-counter {"number":500,"label":"Famiglie supportate","textColor":"#e66395"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:pronti-qua/impact-counter {"number":15,"label":"Progetti attivi","textColor":"#379db2"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:pronti-qua/impact-counter {"number":120,"label":"Fondi raccolti","suffix":"K€","textColor":"#ded771"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:pronti-qua/impact-counter {"number":50,"label":"Volontari attivi","textColor":"#6f8a2b"} /-->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
    )
);