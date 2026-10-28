<?php
/**
 * Mise à jour du contenu (une seule fois) pour les sites déjà installés :
 * pages Biologie et Diabétologie, retrait de Neurologie, menu Examens, médecins d'exemple, nouveaux articles, horaires.
 */
if (!defined('ABSPATH')) exit;

/** Ajoute les articles d'exemple manquants (fibroscopie, examens d'imagerie, scanner). */
function atlas_add_new_articles() {
    foreach (atlas_new_articles() as $a) {
        if (get_page_by_title($a['title'], OBJECT, 'post')) continue;
        $term = term_exists($a['cat'], 'category');
        $cat_id = $term ? (int) (is_array($term) ? $term['term_id'] : $term) : (int) wp_insert_term($a['cat'], 'category')['term_id'];
        $when = gmdate('Y-m-d H:i:s', time() - $a['days'] * DAY_IN_SECONDS);
        wp_insert_post([
            'post_type' => 'post', 'post_status' => 'publish', 'post_title' => $a['title'], 'post_excerpt' => $a['excerpt'],
            'post_content' => atlas_article_body($a['slug']), 'post_category' => [$cat_id],
            'post_date_gmt' => $when, 'post_date' => get_date_from_gmt($when),
        ]);
    }
}

add_action('init', 'atlas_setup3', 30);
function atlas_setup3() {
    if (get_option('atlas_setup3_done')) return;
    if (!post_type_exists('atlas_medecin')) return;
    if (!get_page_by_path('le-centre')) return; // installation neuve : les pages ne sont pas encore créées

    // 1. Nouvelles pages
    foreach (['biologie' => 'Biologie', 'specialites-diabetologie' => 'Diabétologie'] as $slug => $title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'post_content' => '']);
        }
    }
    // 2. Neurologie retirée (page mise à la corbeille, récupérable)
    $neuro = get_page_by_path('specialites-neurologie');
    if ($neuro) wp_trash_post($neuro->ID);
    // 3. « Imagerie » devient « Imagerie médicale »
    $img = get_page_by_path('imagerie');
    if ($img && $img->post_title === 'Imagerie') wp_update_post(['ID' => $img->ID, 'post_title' => 'Imagerie médicale']);

    // 4. Menu : Biologie dans Examens, libellé « Imagerie médicale »
    $menu = wp_get_nav_menu_object('Menu principal');
    if ($menu) {
        $items = wp_get_nav_menu_items($menu->term_id);
        $items = is_array($items) ? $items : [];
        $examens = null; $has_biologie = false;
        foreach ($items as $it) {
            if ($it->title === 'Examens') $examens = $it;
            if ((int) $it->object_id === (int) (get_page_by_path('biologie')->ID ?? 0) && $it->object === 'page') $has_biologie = true;
        }
        foreach ($items as $it) {
            if ($it->title === 'Imagerie' && $it->object === 'page') {
                wp_update_nav_menu_item($menu->term_id, $it->ID, [
                    'menu-item-title' => 'Imagerie médicale', 'menu-item-object' => $it->object, 'menu-item-object-id' => $it->object_id,
                    'menu-item-type' => $it->type, 'menu-item-status' => 'publish', 'menu-item-parent-id' => $it->menu_item_parent,
                    'menu-item-position' => $it->menu_order, 'menu-item-url' => $it->url,
                ]);
            }
        }
        $bio = get_page_by_path('biologie');
        if ($examens && $bio && !$has_biologie) {
            wp_update_nav_menu_item($menu->term_id, 0, [
                'menu-item-title' => 'Biologie', 'menu-item-object' => 'page', 'menu-item-object-id' => $bio->ID,
                'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', 'menu-item-parent-id' => $examens->ID,
            ]);
        }
    }

    // 5. Médecins d'exemple non modifiés : Neurologie -> Diabétologie, jours de consultation
    $jours = [
        'Médecine générale' => 'Lundi au vendredi, 9h - 18h ; samedi, 9h - 14h', 'Gynécologie' => 'Lundi, 15h - 18h',
        'Cardiologie' => 'Mercredi, 15h - 18h', 'Diabétologie' => 'Samedi, 9h - 14h',
    ];
    foreach (get_posts(['post_type' => 'atlas_medecin', 'post_status' => 'any', 'numberposts' => -1]) as $d) {
        if ($d->post_title !== 'Dr. Prénom Nom') continue;
        $spec = atlas_medecin_meta($d->ID, 'specialite');
        if ($spec === 'Neurologie') { $spec = 'Diabétologie'; update_post_meta($d->ID, '_atlas_specialite', $spec); }
        if (isset($jours[$spec]) && in_array(atlas_medecin_meta($d->ID, 'jours'), ['', 'À compléter'], true)) {
            update_post_meta($d->ID, '_atlas_jours', $jours[$spec]);
        }
    }

    // 6. Nouveaux articles
    atlas_add_new_articles();

    // 7. Horaires (uniquement si les coordonnées n'ont pas encore été renseignées)
    $c = get_option('atlas_contact');
    if (is_array($c) && (!isset($c['horaires']) || in_array(trim((string) $c['horaires']), ['', 'À compléter'], true))) {
        $c['horaires'] = atlas_contact_defaults()['horaires'];
        update_option('atlas_contact', $c);
    }

    update_option('atlas_setup3_done', 1);
}
