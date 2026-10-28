<?php
/**
 * Complète (une seule fois) les articles d'exemple qui n'avaient qu'un texte provisoire.
 * Un article déjà modifié par la cliente n'est jamais écrasé.
 */
if (!defined('ABSPATH')) exit;

add_action('init', 'atlas_setup5', 50);
function atlas_setup5() {
    if (get_option('atlas_setup5_done')) return;
    foreach (atlas_fill_articles() as $title => $slug) {
        $post = get_page_by_title($title, OBJECT, 'post');
        if (!$post) continue;
        // texte provisoire d'origine : il contient cette phrase
        if (strpos((string) $post->post_content, 'contenu à rédiger avec les médecins du centre') === false) continue;
        $body = atlas_article_body($slug);
        if ($body !== '') wp_update_post(['ID' => $post->ID, 'post_content' => $body]);
    }
    update_option('atlas_setup5_done', 1);
}
