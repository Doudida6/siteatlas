<?php
/**
 * Installation de la version 2 (une seule fois) : médecins d'exemple et menu principal.
 */
if (!defined('ABSPATH')) exit;

add_action('init', 'atlas_setup2', 20);
function atlas_setup2() {
    if (get_option('atlas_setup2_done')) return;
    if (!post_type_exists('atlas_medecin')) return;
    if (!get_page_by_path('le-centre')) return; // pages pas encore créées (installation neuve) : on réessaie à la requête suivante

    // Médecins d'exemple (à remplacer par les vrais médecins du centre)
    if (!get_posts(['post_type' => 'atlas_medecin', 'post_status' => 'any', 'numberposts' => 1])) {
        $specs = [
            'Cardiologie' => 'Mercredi, 15h - 18h', 'Gastro-entérologie' => 'À compléter', 'Médecine générale' => 'Lundi au vendredi, 9h - 18h ; samedi, 9h - 14h',
            'Gynécologie' => 'Lundi, 15h - 18h', 'Diabétologie' => 'Samedi, 9h - 14h', 'Rhumatologie' => 'À compléter',
        ];
        $i = 0;
        foreach ($specs as $spec => $jours) {
            wp_insert_post([
                'post_type' => 'atlas_medecin', 'post_status' => 'publish', 'post_title' => 'Dr. Prénom Nom', 'menu_order' => $i++,
                'meta_input' => [
                    '_atlas_specialite' => $spec, '_atlas_formation' => 'Diplômes à compléter',
                    '_atlas_expertises' => "Domaine d'expertise, Domaine d'expertise", '_atlas_jours' => $jours,
                ],
            ]);
        }
    }

    // Menu principal
    $name = 'Menu principal';
    $menu = wp_get_nav_menu_object($name);
    $menu_id = $menu ? (int) $menu->term_id : wp_create_nav_menu($name);
    if (!is_wp_error($menu_id) && !wp_get_nav_menu_items($menu_id)) {
        $page_item = function ($title, $slug, $parent = 0) use ($menu_id) {
            $page = get_page_by_path($slug);
            if (!$page) return 0;
            return (int) wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title' => $title, 'menu-item-object' => 'page', 'menu-item-object-id' => $page->ID,
                'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', 'menu-item-parent-id' => $parent,
            ]);
        };
        $page_item('Le Centre', 'le-centre');
        $page_item('Spécialités', 'specialites');
        $exams = (int) wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title' => 'Examens', 'menu-item-url' => '#', 'menu-item-type' => 'custom', 'menu-item-status' => 'publish',
        ]);
        $page_item('Imagerie médicale', 'imagerie', $exams);
        $page_item('Endoscopie', 'endoscopie', $exams);
        $page_item('Biopsie', 'biopsie', $exams);
        $page_item('Biologie', 'biologie', $exams);
        $page_item('Nos médecins', 'nos-medecins');
        $page_item('Conseils santé', 'conseils-sante');
        $page_item('Contact', 'contact');
    }
    if (!is_wp_error($menu_id)) {
        $locations = get_theme_mod('nav_menu_locations', []);
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    update_option('atlas_setup2_done', 1);
}
