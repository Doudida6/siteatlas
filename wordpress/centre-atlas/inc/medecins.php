<?php
/**
 * Médecins : menu « Médecins » dans l'administration (nom, photo, spécialité, formation, expertises, jours).
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    register_post_type('atlas_medecin', [
        'labels' => [
            'name' => 'Médecins', 'singular_name' => 'Médecin', 'menu_name' => 'Médecins',
            'add_new' => 'Ajouter un médecin', 'add_new_item' => 'Ajouter un médecin', 'edit_item' => 'Modifier le médecin',
            'all_items' => 'Tous les médecins', 'not_found' => 'Aucun médecin pour le moment', 'search_items' => 'Chercher un médecin',
            'featured_image' => 'Photo du médecin', 'set_featured_image' => 'Choisir la photo',
            'remove_featured_image' => 'Retirer la photo', 'use_featured_image' => 'Utiliser comme photo',
        ],
        'public' => false, 'show_ui' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-id', 'menu_position' => 26,
        'supports' => ['title', 'thumbnail', 'page-attributes'], 'has_archive' => false, 'rewrite' => false,
    ]);
});

add_filter('enter_title_here', function ($title, $post) {
    return ($post && $post->post_type === 'atlas_medecin') ? 'Nom du médecin (ex. Dr. Fatou Diop)' : $title;
}, 10, 2);

function atlas_medecin_fields() {
    return [
        'specialite' => ['Spécialité', 'ex. Cardiologie'],
        'formation'  => ['Formation / diplômes', 'ex. Doctorat en médecine, Université Cheikh Anta Diop'],
        'expertises' => ["Domaines d'expertise (séparés par des virgules)", 'ex. Hypertension, Échographie cardiaque'],
        'jours'      => ['Jours de consultation', 'ex. Lundi, mercredi, vendredi'],
    ];
}

add_action('add_meta_boxes', function () {
    add_meta_box('atlas_medecin_infos', 'Informations du médecin', 'atlas_medecin_box', 'atlas_medecin', 'normal', 'high');
});

function atlas_medecin_box($post) {
    wp_nonce_field('atlas_medecin', 'atlas_medecin_nonce');
    echo '<p>La <strong>photo</strong> se choisit dans le bloc « Photo du médecin » à droite. L\'<strong>ordre</strong> d\'affichage se règle dans « Attributs » (plus le chiffre est petit, plus le médecin apparaît en premier).</p>';
    echo '<table class="form-table"><tbody>';
    foreach (atlas_medecin_fields() as $k => $f) {
        $v = get_post_meta($post->ID, '_atlas_' . $k, true);
        echo '<tr><th><label for="atlas_' . esc_attr($k) . '">' . esc_html($f[0]) . '</label></th>';
        echo '<td><input type="text" class="large-text" id="atlas_' . esc_attr($k) . '" name="atlas_' . esc_attr($k) . '" value="' . esc_attr($v) . '" placeholder="' . esc_attr($f[1]) . '"></td></tr>';
    }
    echo '</tbody></table>';
}

add_action('save_post_atlas_medecin', function ($post_id) {
    if (!isset($_POST['atlas_medecin_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['atlas_medecin_nonce'])), 'atlas_medecin')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    foreach (array_keys(atlas_medecin_fields()) as $k) {
        $v = isset($_POST['atlas_' . $k]) ? sanitize_text_field(wp_unslash($_POST['atlas_' . $k])) : '';
        update_post_meta($post_id, '_atlas_' . $k, $v);
    }
});

function atlas_medecins($limit = -1) {
    return get_posts([
        'post_type' => 'atlas_medecin', 'post_status' => 'publish', 'numberposts' => $limit,
        'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'],
    ]);
}
function atlas_medecin_meta($id, $key) { return trim((string) get_post_meta($id, '_atlas_' . $key, true)); }

/** Cartes de l'accueil (trois premiers médecins). */
function atlas_team_cards($limit = 3) {
    $list = atlas_medecins($limit);
    if (!$list) { echo '<p class="text-style-muted">Les médecins seront bientôt présentés ici.</p>'; return; }
    $arrow = '<svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2"><use href="#i-arrow"/></svg>';
    foreach ($list as $p) {
        $u = get_the_post_thumbnail_url($p, 'large');
        $cls = $u ? ' has-photo' : '';
        $style = $u ? ' style="background-image:url(\'' . esc_url($u) . '\')"' : '';
        echo '<a href="' . esc_url(home_url('/nos-medecins/')) . '" class="team_card reveal">'
            . '<div class="team_photo photo-placeholder' . $cls . '"' . $style . '>' . ($u ? '' : 'Portrait du médecin') . '</div>'
            . '<div class="team_info"><div><small>' . esc_html(atlas_medecin_meta($p->ID, 'specialite')) . '</small>' . esc_html(get_the_title($p)) . '</div>'
            . '<span class="team_arrow">' . $arrow . '</span></div></a>';
    }
}

/** Fiches de la page « Nos médecins ». */
function atlas_doc_cards() {
    $list = atlas_medecins();
    if (!$list) { echo '<p class="text-style-muted">Les médecins seront bientôt présentés ici.</p>'; return; }
    foreach ($list as $p) {
        $u = get_the_post_thumbnail_url($p, 'large');
        $cls = $u ? ' has-photo' : '';
        $style = $u ? ' style="background-image:url(\'' . esc_url($u) . '\')"' : '';
        $formation = atlas_medecin_meta($p->ID, 'formation');
        $jours = atlas_medecin_meta($p->ID, 'jours');
        $chips = '';
        foreach (array_filter(array_map('trim', explode(',', atlas_medecin_meta($p->ID, 'expertises')))) as $e) {
            $chips .= '<span class="chip">' . esc_html($e) . '</span>';
        }
        echo '<article class="doc_card reveal"><div class="doc_photo photo-placeholder' . $cls . '"' . $style . '>' . ($u ? '' : 'Portrait professionnel') . '</div>'
            . '<div class="doc_body"><div><small>' . esc_html(atlas_medecin_meta($p->ID, 'specialite')) . '</small><h3 class="heading-style-h4">' . esc_html(get_the_title($p)) . '</h3></div>'
            . '<div class="doc_meta">'
            . ($formation !== '' ? '<span><strong>Formation :</strong> ' . esc_html($formation) . '</span>' : '')
            . ($jours !== '' ? '<span><strong>Jours de consultation :</strong> ' . esc_html($jours) . '</span>' : '')
            . '</div>'
            . ($chips !== '' ? '<div class="chips">' . $chips . '</div>' : '')
            . '<a href="' . esc_url(add_query_arg('medecin', $p->ID, home_url('/rendez-vous/'))) . '" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>'
            . '</div></article>';
    }
}

/** Liste des médecins dans le formulaire de rendez-vous. */
function atlas_medecin_options() {
    $sel = isset($_GET['medecin']) ? (int) $_GET['medecin'] : 0;
    echo '<option>Pas de préférence</option>';
    foreach (atlas_medecins() as $p) {
        $spec = atlas_medecin_meta($p->ID, 'specialite');
        $label = get_the_title($p) . ($spec !== '' ? ' (' . $spec . ')' : '');
        echo '<option' . ($sel === (int) $p->ID ? ' selected' : '') . '>' . esc_html($label) . '</option>';
    }
}
