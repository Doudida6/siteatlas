<?php
/**
 * Centre Médical Atlas — fonctions du thème.
 * Fichier généré par maquette/build_theme.py : modifier la maquette puis relancer le script.
 */
if (!defined('ABSPATH')) exit;

define('ATLAS_VERSION', '1.0.0');
define('ATLAS_SECRETARIAT_EMAIL', 'centreatlasmedical@gmail.com');

foreach (['helpers', 'medecins', 'menu', 'admin', 'setup2'] as $atlas_inc) {
    require_once get_theme_file_path('inc/' . $atlas_inc . '.php');
}

/* ---------- Réglages de base ---------- */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_image_size('atlas-card', 800, 500, true);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('atlas-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('atlas-style', get_stylesheet_uri(), ['atlas-fonts'], ATLAS_VERSION);
    wp_enqueue_script('atlas-main', get_theme_file_uri('assets/main.js'), [], ATLAS_VERSION, true);
});

add_action('wp_head', function () {
    echo '<link rel="icon" href="' . esc_url(get_theme_file_uri('assets/logo-icon.svg')) . '" type="image/svg+xml">' . "\n";
});

/* ---------- Aides pour les modèles ---------- */
function atlas_current($slug) {
    if ($slug === 'specialites') {
        $on = is_page('specialites') || (is_page() && strpos((string) get_post_field('post_name', get_queried_object_id()), 'specialites-') === 0);
    } elseif ($slug === 'conseils-sante') {
        $on = is_home() || is_single();
    } else {
        $on = is_page($slug);
    }
    return $on ? ' w--current' : '';
}
function atlas_current_group($slugs) {
    foreach ($slugs as $s) { if (is_page($s)) return ' w--current'; }
    return '';
}
function atlas_sent()        { return isset($_GET['atlas_sent']); }
function atlas_sent_class()  { return atlas_sent() ? ' is-visible' : ''; }
function atlas_sent_hidden() { return atlas_sent() ? ' hidden' : ''; }

function atlas_cat_name($post_id = null) {
    $cats = get_the_category($post_id ?: get_the_ID());
    return $cats ? $cats[0]->name : 'Conseils';
}
function atlas_read_time($post_id = null) {
    $words = str_word_count(wp_strip_all_tags(get_post_field('post_content', $post_id ?: get_the_ID())));
    return max(1, (int) ceil($words / 200));
}
/** Affiche l'image mise en avant, ou un emplacement gris si l'article n'en a pas. */
function atlas_thumb($label = "Photo de l'article", $extra_class = '') {
    $cls = trim('photo-placeholder ' . $extra_class);
    if (has_post_thumbnail()) {
        echo '<div class="' . esc_attr($cls) . ' has-img">' . get_the_post_thumbnail(null, 'atlas-card') . '</div>';
    } else {
        echo '<div class="' . esc_attr($cls) . '">' . esc_html($label) . '</div>';
    }
}

/* ---------- Priorité du thème sur les modèles imposés par Elementor ----------
 * Si une page est réglée sur « Elementor Canvas » (modèle vide), WordPress n'affiche pas nos modèles.
 * On force ici front-page.php et page-{slug}.php quand ils existent. */
add_filter('template_include', function ($template) {
    if (!is_front_page() && !is_page()) return $template;
    $candidates = [];
    if (is_front_page()) $candidates[] = 'front-page.php';
    $slug = get_post_field('post_name', get_queried_object_id());
    if ($slug) $candidates[] = 'page-' . $slug . '.php';
    $found = locate_template($candidates);
    return $found ? $found : $template;
}, 99999);

/* ---------- Demandes de rendez-vous (visibles dans l'admin) ---------- */
add_action('init', function () {
    register_post_type('atlas_demande', [
        'labels' => ['name' => 'Demandes', 'singular_name' => 'Demande', 'menu_name' => 'Demandes RDV', 'all_items' => 'Toutes les demandes', 'edit_item' => 'Voir la demande'],
        'public' => false, 'show_ui' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-calendar-alt', 'menu_position' => 25,
        'supports' => ['title', 'editor'],
        'capability_type' => 'post', 'capabilities' => ['create_posts' => 'do_not_allow'], 'map_meta_cap' => true,
    ]);
});

add_action('admin_post_nopriv_atlas_form', 'atlas_handle_form');
add_action('admin_post_atlas_form', 'atlas_handle_form');
function atlas_handle_form() {
    $back = remove_query_arg('atlas_sent', wp_get_referer() ?: home_url('/'));

    if (!isset($_POST['atlas_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['atlas_nonce'])), 'atlas_form')) {
        wp_die('Votre session a expiré. Merci de recharger la page et de réessayer.', 'Erreur', ['response' => 403, 'back_link' => true]);
    }
    // Piège anti-spam : champ caché rempli = robot. On fait comme si tout allait bien.
    if (!empty($_POST['website'])) {
        wp_safe_redirect(add_query_arg('atlas_sent', '1', $back));
        exit;
    }
    // Limite : 5 envois par heure et par adresse IP.
    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'x';
    $key = 'atlas_form_' . md5($ip);
    $count = (int) get_transient($key);
    if ($count >= 5) {
        wp_die('Trop de demandes envoyées. Merci de nous appeler au 33 867 86 46.', 'Erreur', ['response' => 429, 'back_link' => true]);
    }
    set_transient($key, $count + 1, HOUR_IN_SECONDS);

    $type = sanitize_text_field(wp_unslash($_POST['form_type'] ?? 'Demande'));
    $labels = ['nom' => 'Nom et prénom', 'tel' => 'Téléphone', 'email' => 'Email', 'type' => 'Type de rendez-vous',
               'medecin' => 'Médecin souhaité', 'date' => 'Date souhaitée', 'message' => 'Message', 'msg' => 'Message'];
    $skip = ['action', 'atlas_nonce', '_wp_http_referer', 'form_type', 'website'];
    $lines = []; $name = ''; $reply = '';
    foreach ($_POST as $field => $value) {
        if (in_array($field, $skip, true) || is_array($value)) continue;
        $value = trim(sanitize_textarea_field(wp_unslash($value)));
        if ($value === '') continue;
        $short = preg_replace('/^.*-/', '', $field);
        if ($short === 'nom') $name = $value;
        if ($short === 'email' && is_email($value)) $reply = $value;
        $lines[] = ($labels[$short] ?? $field) . ' : ' . $value;
    }
    if ($name === '' || !$lines) {
        wp_die('Merci de renseigner au moins votre nom.', 'Erreur', ['response' => 400, 'back_link' => true]);
    }
    $body = implode("\n", $lines);

    wp_insert_post(['post_type' => 'atlas_demande', 'post_status' => 'private', 'post_title' => $type . ' — ' . $name, 'post_content' => $body]);

    $to = atlas_opt('rdv_email');
    if (!is_email($to)) $to = get_option('atlas_secretariat_email', ATLAS_SECRETARIAT_EMAIL);
    $headers = $reply ? ['Reply-To: ' . $reply] : [];
    wp_mail($to, '[Centre Atlas] ' . $type . ' : ' . $name, $type . "\n\n" . $body, $headers);

    wp_safe_redirect(add_query_arg('atlas_sent', '1', $back));
    exit;
}

/* ---------- Installation à l'activation du thème ---------- */
add_action('after_switch_theme', 'atlas_setup');
function atlas_setup() {
    if (get_option('atlas_setup_done')) return;

    $pages = [
        PAGES_PHP
    ];
    $ids = [];
    foreach ($pages as $slug => $title) {
        $existing = get_page_by_path($slug);
        $ids[$slug] = $existing ? $existing->ID : wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'post_content' => '']);
    }

    update_option('blogname', 'Centre Médical Atlas');
    update_option('blogdescription', 'Médecine, imagerie et endoscopie à Dakar');
    update_option('show_on_front', 'page');
    update_option('page_on_front', $ids['accueil']);
    update_option('page_for_posts', $ids['conseils-sante']);
    update_option('permalink_structure', '/%postname%/');

    // Articles d'exemple (à remplacer par les vrais articles du centre)
    $samples = [
        POSTS_PHP
    ];
    $first_body = <<<'HTML'
ARTICLE_HTML
HTML;
    foreach ($samples as $i => $s) {
        $cat = term_exists($s['cat'], 'category');
        $cat_id = $cat ? (int) (is_array($cat) ? $cat['term_id'] : $cat) : (int) wp_insert_term($s['cat'], 'category')['term_id'];
        $when = gmdate('Y-m-d H:i:s', time() - $s['days'] * DAY_IN_SECONDS);
        wp_insert_post([
            'post_type' => 'post', 'post_status' => 'publish', 'post_title' => $s['title'], 'post_excerpt' => $s['excerpt'],
            'post_content' => $i === 0 ? $first_body : '<p>' . esc_html($s['excerpt']) . '</p><p>Article d\'exemple : contenu à rédiger avec les médecins du centre.</p>',
            'post_category' => [$cat_id], 'post_date_gmt' => $when, 'post_date' => get_date_from_gmt($when),
        ]);
    }
    // Retire l'article et la page créés par défaut par WordPress (mis à la corbeille, récupérables)
    foreach (['hello-world' => 'post', 'sample-page' => 'page'] as $slug => $type) {
        $p = get_page_by_path($slug, OBJECT, $type);
        if ($p) wp_trash_post($p->ID);
    }

    update_option('atlas_setup_done', 1);
    flush_rewrite_rules();
}
