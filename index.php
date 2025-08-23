<?php
/**
 * Fallback template
 * Questo file è richiesto per compatibilità ma non dovrebbe mai essere usato
 * in un tema FSE, dove i template HTML hanno la precedenza
 */

// Redirect to block template if available
if (function_exists('wp_is_block_theme') && wp_is_block_theme()) {
    return;
}

// Fallback per temi classici (non dovrebbe mai essere raggiunto)
get_header();

echo '<main>';
if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
}
echo '</main>';
get_footer();