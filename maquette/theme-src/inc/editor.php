<?php
/**
 * Édition directe sur le site : un administrateur connecté clique sur « Modifier cette page »
 * dans la barre noire, puis clique sur un texte pour le changer ou sur une photo pour la remplacer.
 * Les modifications sont enregistrées dans les mêmes réglages que Centre Atlas → Textes / Photos.
 */
if (!defined('ABSPATH')) exit;

/** Vrai quand la page est affichée en mode édition. */
function atlas_edit_mode() {
    static $on = null;
    if ($on === null) {
        $on = !is_admin() && isset($_GET['atlas_edit']) && is_user_logged_in() && current_user_can('manage_options');
    }
    return $on;
}

/** Valeur brute (avant remplacement de {tel_fixe}…) d'un texte. */
function atlas_text_raw($key) {
    $o = get_option('atlas_texts', []);
    $reg = atlas_registry();
    if (is_array($o) && isset($o[$key]) && $o[$key] !== '') return (string) $o[$key];
    return isset($reg['texts'][$key]) ? (string) $reg['texts'][$key][1] : '';
}

/* Bouton dans la barre d'administration (en haut du site) */
add_action('admin_bar_menu', function ($bar) {
    if (is_admin() || !current_user_can('manage_options')) return;
    if (atlas_edit_mode()) {
        $bar->add_node(['id' => 'atlas-edit', 'title' => '✕ Quitter la modification', 'href' => remove_query_arg('atlas_edit')]);
    } else {
        $bar->add_node(['id' => 'atlas-edit', 'title' => '✎ Modifier cette page', 'href' => add_query_arg('atlas_edit', '1')]);
    }
}, 80);

/* Scripts du mode édition */
add_action('wp_enqueue_scripts', function () {
    if (!atlas_edit_mode()) return;
    nocache_headers();
    wp_enqueue_media();
    $dir = get_theme_file_path('assets/editor/');
    wp_enqueue_style('atlas-editor', get_theme_file_uri('assets/editor/editor.css'), [], (string) @filemtime($dir . 'editor.css'));
    wp_enqueue_script('atlas-editor', get_theme_file_uri('assets/editor/editor.js'), ['jquery'], (string) @filemtime($dir . 'editor.js'), true);
    wp_localize_script('atlas-editor', 'atlasEditor', [
        'ajax'  => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('atlas_inline_save'),
        'exit'  => remove_query_arg('atlas_edit'),
    ]);
}, 20);

add_action('send_headers', function () {
    if (atlas_edit_mode()) nocache_headers();
});

/* Enregistrement */
add_action('wp_ajax_atlas_inline_save', function () {
    check_ajax_referer('atlas_inline_save', 'nonce');
    if (!current_user_can('manage_options')) wp_send_json_error('Accès refusé', 403);

    $texts  = json_decode(wp_unslash($_POST['texts'] ?? '{}'), true);
    $photos = json_decode(wp_unslash($_POST['photos'] ?? '{}'), true);
    $texts  = is_array($texts) ? $texts : [];
    $photos = is_array($photos) ? $photos : [];

    // Les fonctions de nettoyage repartent des valeurs enregistrées et n'appliquent que les champs envoyés
    if ($texts)  atlas_store_option('atlas_texts', atlas_sanitize_texts($texts));
    if ($photos) atlas_store_option('atlas_photos', atlas_sanitize_photos($photos));

    $out = [];
    foreach (array_keys($texts) as $k) {
        $k = (string) $k;
        $out[$k] = ['raw' => atlas_text_raw($k), 'shown' => atlas_expand(atlas_text_raw($k))];
    }
    wp_send_json_success(['texts' => $out, 'photos' => count($photos)]);
});
