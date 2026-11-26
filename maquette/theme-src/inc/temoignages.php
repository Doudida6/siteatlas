<?php
/**
 * Témoignages : menu « Témoignages » dans l'administration (ajouter, modifier, supprimer).
 * Titre = nom du patient, contenu = témoignage, champ « Mention » = service concerné.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    register_post_type('atlas_temoignage', [
        'labels' => [
            'name' => 'Témoignages', 'singular_name' => 'Témoignage', 'menu_name' => 'Témoignages',
            'add_new' => 'Ajouter un témoignage', 'add_new_item' => 'Ajouter un témoignage', 'edit_item' => 'Modifier le témoignage',
            'all_items' => 'Tous les témoignages', 'not_found' => 'Aucun témoignage pour le moment', 'search_items' => 'Chercher un témoignage',
        ],
        'public' => false, 'show_ui' => true, 'show_in_menu' => true, 'show_in_rest' => false,
        'menu_icon' => 'dashicons-format-quote', 'menu_position' => 27,
        'supports' => ['title', 'editor', 'page-attributes'], 'has_archive' => false, 'rewrite' => false,
    ]);

    // Premiers témoignages créés une seule fois (modifiables ensuite dans l'administration)
    if (!get_option('atlas_temoignages_seeded')) {
        update_option('atlas_temoignages_seeded', 1);
        $items = [
            ['Aminata Ndiaye', 'Accueil et prise en charge', "J'ai particulièrement apprécié la qualité de l'accueil et l'attention accordée à chaque patient. L'équipe est disponible, professionnelle et prend le temps de bien vous orienter. Une expérience rassurante du début à la fin."],
            ['Mamadou Diop', 'Consultation médicale', "Un centre médical où l'on se sent véritablement écouté. Le médecin a pris le temps de m'expliquer ma situation et de répondre à toutes mes questions. J'ai beaucoup apprécié le professionnalisme et la qualité des échanges."],
            ['Marième Fall', 'Gynécologie', "Une équipe accueillante et rassurante. J'ai été reçue avec beaucoup de respect et de délicatesse. C'est important de pouvoir bénéficier d'un accompagnement médical dans un environnement où l'on se sent à l'aise et en confiance."],
            ['Ibrahima Sarr', 'Examens médicaux', "J'ai apprécié la simplicité du parcours et la disponibilité du personnel. Les explications avant les examens étaient claires, ce qui m'a permis de les aborder sereinement. Un cadre agréable et une équipe attentive."],
            ['Khady Ba', 'Expérience globale', "Ce qui m'a marquée au Centre Médical Atlas, c'est l'importance accordée au patient. De l'accueil à l'accompagnement médical, on ressent une réelle volonté de bien faire. Je recommande particulièrement pour la qualité de l'écoute et le professionnalisme de l'équipe."],
        ];
        foreach ($items as $i => $t) {
            $id = wp_insert_post(['post_type' => 'atlas_temoignage', 'post_status' => 'publish', 'post_title' => $t[0], 'post_content' => $t[2], 'menu_order' => $i + 1]);
            if ($id && !is_wp_error($id)) update_post_meta($id, '_atlas_mention', $t[1]);
        }
    }
}, 11);

// Texte simple (pas d'éditeur de mise en forme) : le témoignage s'affiche en texte brut
add_filter('user_can_richedit', function ($can) {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    return ($screen && $screen->post_type === 'atlas_temoignage') ? false : $can;
});

add_filter('enter_title_here', function ($title, $post) {
    return ($post && $post->post_type === 'atlas_temoignage') ? 'Nom du patient (ex. Aminata Ndiaye)' : $title;
}, 10, 2);

add_action('add_meta_boxes', function () {
    add_meta_box('atlas_temoignage_infos', 'Mention sous le nom', 'atlas_temoignage_box', 'atlas_temoignage', 'side', 'high');
});

function atlas_temoignage_box($post) {
    wp_nonce_field('atlas_temoignage', 'atlas_temoignage_nonce');
    echo '<p><input type="text" class="widefat" name="atlas_mention" value="' . esc_attr(get_post_meta($post->ID, '_atlas_mention', true)) . '" placeholder="ex. Gynécologie"></p>';
    echo '<p class="description">Le texte du témoignage se saisit dans le grand champ. L\'ordre d\'affichage se règle dans « Attributs » (1 = en premier). Publiez uniquement des témoignages réels, avec l\'accord du patient.</p>';
}

add_action('save_post_atlas_temoignage', function ($post_id) {
    if (!isset($_POST['atlas_temoignage_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['atlas_temoignage_nonce'])), 'atlas_temoignage')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    update_post_meta($post_id, '_atlas_mention', sanitize_text_field(wp_unslash($_POST['atlas_mention'] ?? '')));
});

// Colonnes de la liste
add_filter('manage_atlas_temoignage_posts_columns', function ($cols) {
    return ['cb' => $cols['cb'], 'title' => 'Patient', 'atlas_mention' => 'Mention', 'atlas_ordre' => 'Ordre', 'date' => $cols['date']];
});
add_action('manage_atlas_temoignage_posts_custom_column', function ($col, $post_id) {
    if ($col === 'atlas_mention') echo esc_html(get_post_meta($post_id, '_atlas_mention', true));
    if ($col === 'atlas_ordre') echo (int) get_post_field('menu_order', $post_id);
}, 10, 2);
add_action('pre_get_posts', function ($q) {
    if (is_admin() && $q->is_main_query() && $q->get('post_type') === 'atlas_temoignage' && !$q->get('orderby')) {
        $q->set('orderby', ['menu_order' => 'ASC', 'date' => 'DESC']);
    }
});

/** Témoignages publiés, dans l'ordre choisi. */
function atlas_get_testimonials() {
    return get_posts(['post_type' => 'atlas_temoignage', 'post_status' => 'publish', 'numberposts' => 12,
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC']]);
}

/** Cartes affichées sur l'accueil. */
function atlas_testimonials() {
    foreach (atlas_get_testimonials() as $t) {
        $name = get_the_title($t);
        $initial = function_exists('mb_substr') ? mb_substr(trim($name), 0, 1) : substr(trim($name), 0, 1);
        $text = trim(wp_strip_all_tags($t->post_content));
        $mention = get_post_meta($t->ID, '_atlas_mention', true);
        echo '<figure class="testi_card reveal"><svg class="testi_mark" fill="currentColor" stroke="none"><use href="#i-quote"/></svg>'
           . '<blockquote class="testi_text">« ' . esc_html($text) . ' »</blockquote>'
           . '<figcaption class="testi_author"><span class="testi_initials">' . esc_html($initial) . '</span><span><strong>' . esc_html($name) . '</strong>'
           . ($mention !== '' ? '<small>' . esc_html($mention) . '</small>' : '') . '</span></figcaption></figure>' . "\n";
    }
}
