<?php
/**
 * Pages légales (une seule fois) : Mentions légales et Politique de confidentialité.
 */
if (!defined('ABSPATH')) exit;

add_action('init', 'atlas_setup6', 60);
function atlas_setup6() {
    if (get_option('atlas_setup6_done')) return;
    if (!get_page_by_path('le-centre')) return; // installation neuve : pages pas encore créées

    $ids = [];
    foreach (['mentions-legales' => 'Mentions légales', 'politique-de-confidentialite' => 'Politique de confidentialité'] as $slug => $title) {
        $page = get_page_by_path($slug);
        $ids[$slug] = $page ? (int) $page->ID : (int) wp_insert_post([
            'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'post_content' => '',
        ]);
    }
    // Page « politique de confidentialité » reconnue par WordPress (Réglages > Confidentialité)
    if (!get_option('wp_page_for_privacy_policy') && !empty($ids['politique-de-confidentialite'])) {
        update_option('wp_page_for_privacy_policy', $ids['politique-de-confidentialite']);
    }
    update_option('atlas_setup6_done', 1);
}
