<?php
/**
 * Call-to-Action Patterns
 */

// CTA Newsletter
register_block_pattern(
    'pronti-qua/newsletter-signup',
    array(
        'title'         => __('Newsletter Signup', 'pronti-qua'),
        'description'   => __('Sezione iscrizione newsletter', 'pronti-qua'),
        'categories'    => array('pronti-qua-cta'),
        'content'       => '
<!-- wp:cover {"overlayColor":"azzurro-secondario","minHeight":300,"contentPosition":"center center","isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}}} -->
<div class="wp-block-cover alignfull is-light" style="padding-top:60px;padding-bottom:60px;min-height:300px">
    <span aria-hidden="true" class="wp-block-cover__background has-azzurro-secondario-background-color has-background-dim-100 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"}} -->
        <div class="wp-block-group">
            <!-- wp:heading {"textAlign":"center","fontSize":"x-large","textColor":"white"} -->
            <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color has-x-large-font-size">Resta Aggiornato</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","fontSize":"medium","textColor":"white","style":{"spacing":{"margin":{"top":"16px","bottom":"32px"}}}} -->
            <p class="has-text-align-center has-white-color has-text-color has-medium-font-size" style="margin-top:16px;margin-bottom:32px">Ricevi aggiornamenti sui nostri progetti e storie di speranza direttamente nella tua casella email.</p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
            <div class="wp-block-group">

                <!-- wp:html -->
                <form class="newsletter-form" style="display: flex; gap: 12px; width: 100%; max-width: 400px;">
                    <input type="email" placeholder="La tua email" style="flex: 1; padding: 12px 16px; border: none; border-radius: 6px; font-size: 16px;" required>
                    <button type="submit" style="background: var(--wp--preset--color--rosa-accento); color: white; border: none; padding: 12px 24px; border-radius: 6px; font-weight: 600; cursor: pointer;">Iscriviti</button>
                </form>
                <!-- /wp:html -->
            </div>
            <!-- /wp:group -->

            <!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"white","style":{"spacing":{"margin":{"top":"16px"}},"elements":{"link":{"color":{"text":"var:preset|color|giallo-highlight"}}}}} -->
            <a href="/privacy">Privacy Policy</a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->',
    )
);

// CTA 5x1000
register_block_pattern(
    'pronti-qua/cta-5x1000',
    array(
        'title'         => __('CTA 5x1000', 'pronti-qua'),
        'description'   => __('Call to action per 5x1000', 'pronti-qua'),
        'categories'    => array('pronti-qua-cta'),
        'content'       => '
<!-- wp:group {"backgroundColor":"giallo-highlight","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-giallo-highlight-background-color has-background" style="padding-top:60px;padding-bottom:60px">
    <!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":"48px"}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        <!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
            <!-- wp:heading {"fontSize":"x-large","textColor":"dark"} -->
            <h2 class="wp-block-heading has-dark-color has-text-color has-x-large-font-size">Il tuo 5x1000 non costa nulla ma vale moltissimo</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"fontSize":"medium","textColor":"dark","style":{"spacing":{"margin":{"top":"16px","bottom":"24px"}}}} -->
            <p class="has-dark-color has-text-color has-medium-font-size" style="margin-top:16px;margin-bottom:24px">Scegli Pronti Qua ODV per destinare il tuo 5x1000 e contribuire ai nostri progetti di supporto oncologico.</p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"16px","margin":{"bottom":"24px"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
            <div class="wp-block-group" style="margin-bottom:24px">
                <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"}},"border":{"radius":"20px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:20px;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px">
                    <!-- wp:paragraph {"fontSize":"small","textColor":"dark","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
                    <p class="has-dark-color has-text-color has-small-font-size" style="margin-top:0px;margin-bottom:0px">✓ Non costa nulla</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"}},"border":{"radius":"20px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:20px;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px">
                    <!-- wp:paragraph {"fontSize":"small","textColor":"dark","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
                    <p class="has-dark-color has-text-color has-small-font-size" style="margin-top:0px;margin-bottom:0px">✓ 100% trasparente</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"}},"border":{"radius":"20px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:20px;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px">
                    <!-- wp:paragraph {"fontSize":"small","textColor":"dark","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
                    <p class="has-dark-color has-text-color has-small-font-size" style="margin-top:0px;margin-bottom:0px">✓ Impatto reale</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"dark","textColor":"white","style":{"border":{"radius":"8px"}},"fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size has-medium-font-size">
                    <a class="wp-block-button__link has-white-color has-dark-background-color has-text-color has-background wp-element-button" href="/5x1000" style="border-radius:8px">Scopri Come Fare</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
            <!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}},"border":{"radius":"12px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-white-background-color has-background" style="border-radius:12px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px">
                <!-- wp:heading {"textAlign":"center","level":3,"fontSize":"large","textColor":"dark"} -->
                <h3 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-large-font-size">Codice Fiscale</h3>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","fontSize":"x-large","textColor":"verde-primario","style":{"spacing":{"margin":{"top":"8px","bottom":"16px"}},"typography":{"fontWeight":"700","letterSpacing":"2px"}}} -->
                <p class="has-text-align-center has-verde-primario-color has-text-color has-x-large-font-size" style="margin-top:8px;margin-bottom:16px;font-weight:700;letter-spacing:2px">96123456789</p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"dark"} -->
                <p class="has-text-align-center has-dark-color has-text-color has-small-font-size">Inserisci questo codice nel riquadro<br>"Sostegno del volontariato" della tua dichiarazione dei redditi</p>
                <!-- /wp:paragraph -->
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

// Storia Roberto
register_block_pattern(
    'pronti-qua/roberto-story',
    array(
        'title'         => __('Storia Roberto', 'pronti-qua'),
        'description'   => __('Sezione con la storia del fondatore', 'pronti-qua'),
        'categories'    => array('pronti-qua-content'),
        'content'       => '
<!-- wp:group {"style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":"48px"}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        <!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
            <!-- wp:image {"aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"12px"}}} -->
            <figure class="wp-block-image"><img alt="Roberto, fondatore di Pronti Qua ODV" style="border-radius:12px;aspect-ratio:4/3;object-fit:cover"/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
            <!-- wp:heading {"fontSize":"x-large","textColor":"verde-primario","style":{"spacing":{"margin":{"bottom":"24px"}}}} -->
            <h2 class="wp-block-heading has-verde-primario-color has-text-color has-x-large-font-size" style="margin-bottom:24px">La Storia di Roberto</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"fontSize":"medium","style":{"spacing":{"margin":{"bottom":"16px"}}}} -->
            <p class="has-medium-font-size" style="margin-bottom:16px">Nel 2018, Roberto riceve una diagnosi che cambierà per sempre la sua vita. Durante il lungo percorso di cura, si rende conto di quanto sia importante avere qualcuno accanto nei momenti più difficili.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"fontSize":"medium","style":{"spacing":{"margin":{"bottom":"16px"}}}} -->
            <p class="has-medium-font-size" style="margin-bottom:16px">Nasce così l\'idea di <strong>Pronti Qua ODV</strong>: un\'associazione che non si limita a raccogliere fondi, ma che offre vicinanza umana, supporto concreto e soprattutto speranza.</p>
            <!-- /wp:paragraph -->

            <!-- wp:quote {"className":"is-style-large"} -->
            <blockquote class="wp-block-quote is-style-large">
                <!-- wp:paragraph {"fontSize":"medium","style":{"color":{"text":"var:preset|color|azzurro-secondario"},"typography":{"fontStyle":"italic"}}} -->
                <p class="has-text-color has-medium-font-size" style="color:var(--wp--preset--color--azzurro-secondario);font-style:italic">"Nessuno dovrebbe affrontare da solo la malattia. Vogliamo essere la mano tesa che ognuno di noi vorrebbe trovare."</p>
                <!-- /wp:paragraph -->
                <cite></cite>
            </blockquote>
            <!-- /wp:quote -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"24px"}}}} -->
            <div class="wp-block-buttons" style="margin-top:24px">
                <!-- wp:button {"backgroundColor":"transparent","textColor":"verde-primario","style":{"border":{"radius":"6px","color":"var:preset|color|verde-primario","width":"2px"}},"fontSize":"normal","className":"is-style-outline"} -->
                <div class="wp-block-button has-custom-font-size is-style-outline has-normal-font-size">
                    <a class="wp-block-button__link has-verde-primario-color has-transparent-background-color has-text-color has-background has-border-color wp-element-button" href="/la-nostra-storia" style="border-radius:6px">Leggi la Storia Completa</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
    )
);