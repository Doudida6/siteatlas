<?php
/**
 * SEO local : titres et descriptions par page, balises de partage (Open Graph) et données structurées Google.
 * Si un plugin SEO (Yoast, Rank Math, All in One SEO, SEOPress) est actif, le thème s'efface pour éviter les doublons.
 */
if (!defined('ABSPATH')) exit;

function atlas_seo_plugin_active() {
    return defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_VERSION') || defined('SEOPRESS_VERSION');
}

/** Identifiant de la page courante dans le registre SEO (« accueil », « contact », etc.). */
function atlas_seo_slug() {
    if (is_front_page()) return 'accueil';
    if (is_home()) return 'conseils-sante';
    if (is_page()) return (string) get_post_field('post_name', get_queried_object_id());
    return '';
}

/** Titre et description : valeur saisie dans l'administration, sinon valeur proposée. */
function atlas_seo_get($slug) {
    $reg = atlas_registry();
    if (!isset($reg['seo'][$slug])) return null;
    $saved = get_option('atlas_seo', []);
    $saved = is_array($saved) && isset($saved[$slug]) && is_array($saved[$slug]) ? $saved[$slug] : [];
    return [
        'title' => !empty($saved['title']) ? $saved['title'] : $reg['seo'][$slug][1],
        'desc'  => !empty($saved['desc']) ? $saved['desc'] : $reg['seo'][$slug][2],
    ];
}

function atlas_seo_current() {
    if (is_singular('post')) {
        $post = get_queried_object();
        $desc = has_excerpt($post) ? get_the_excerpt($post) : wp_trim_words(wp_strip_all_tags($post->post_content), 28, '…');
        return ['title' => get_the_title($post) . ' | Centre Médical Atlas', 'desc' => trim(wp_strip_all_tags($desc))];
    }
    $slug = atlas_seo_slug();
    return $slug !== '' ? atlas_seo_get($slug) : null;
}

add_filter('pre_get_document_title', function ($title) {
    if (atlas_seo_plugin_active()) return $title;
    $s = atlas_seo_current();
    return ($s && $s['title'] !== '') ? $s['title'] : $title;
}, 20);

/** Image de partage : photo mise en avant de l'article, sinon photo principale de l'accueil si elle est choisie. */
function atlas_og_image() {
    if (is_singular('post') && has_post_thumbnail()) return (string) get_the_post_thumbnail_url(null, 'large');
    $reg = atlas_registry();
    foreach (array_keys($reg['photos']) as $key) {
        if (strpos($key, 'accueil-photo-accueil') === 0) { $u = atlas_photo_url($key); if ($u) return $u; }
    }
    return '';
}

/** Adresse découpée pour les données structurées : « Liberté 6, Dakar » -> rue « Liberté 6 », ville « Dakar ». */
function atlas_address_parts() {
    $a = trim(preg_replace('/,?\s*S[ée]n[ée]gal\s*$/iu', '', atlas_map_query()));
    $parts = array_values(array_filter(array_map('trim', explode(',', $a))));
    if (count($parts) < 2) return ['street' => $a, 'city' => 'Dakar'];
    $city = array_pop($parts);
    return ['street' => implode(', ', $parts), 'city' => $city];
}

function atlas_schema_clinic() {
    $addr = atlas_address_parts();
    $data = [
        '@context' => 'https://schema.org', '@type' => 'MedicalClinic', '@id' => home_url('/#clinic'),
        'name' => 'Centre Médical Atlas', 'alternateName' => 'Cabinet Médical Atlas', 'url' => home_url('/'),
        'description' => 'Centre médical à Dakar : consultations pluridisciplinaires, imagerie médicale, endoscopie digestive, biopsies et analyses.',
        'telephone' => atlas_tel('tel_mobile'), 'email' => atlas_opt('email'),
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => $addr['street'], 'addressLocality' => $addr['city'], 'addressCountry' => 'SN'],
        'areaServed' => ['@type' => 'City', 'name' => 'Dakar'],
        'medicalSpecialty' => ['Cardiovascular', 'Gynecologic', 'Gastroenterologic', 'Endocrine', 'Rheumatologic'],
        'hasMap' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode(atlas_map_query()),
    ];
    $contact = [];
    foreach (['tel_mobile', 'tel_fixe'] as $k) {
        if (atlas_tel($k) !== '') $contact[] = ['@type' => 'ContactPoint', 'telephone' => atlas_tel($k), 'contactType' => 'customer service', 'availableLanguage' => 'fr'];
    }
    if ($contact) $data['contactPoint'] = $contact;
    $lat = atlas_opt('lat'); $lng = atlas_opt('lng');
    if ($lat !== '' && $lng !== '') $data['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float) $lat, 'longitude' => (float) $lng];
    $hours = [];
    foreach ([['ouv_semaine', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']], ['ouv_samedi', ['Saturday']]] as $h) {
        if (preg_match('/^(\d{2}:\d{2})-(\d{2}:\d{2})$/', atlas_opt($h[0]), $m)) {
            $hours[] = ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => count($h[1]) === 1 ? $h[1][0] : $h[1], 'opens' => $m[1], 'closes' => $m[2]];
        }
    }
    if ($hours) $data['openingHoursSpecification'] = $hours;
    $same = array_values(array_filter([atlas_opt('facebook'), atlas_opt('instagram'), atlas_opt('google')]));
    if ($same) $data['sameAs'] = $same;
    $img = atlas_og_image();
    if ($img) $data['image'] = $img;
    return $data;
}

function atlas_schema_article($post) {
    $data = [
        '@context' => 'https://schema.org', '@type' => 'BlogPosting', 'headline' => get_the_title($post),
        'datePublished' => get_the_date('c', $post), 'dateModified' => get_the_modified_date('c', $post),
        'mainEntityOfPage' => get_permalink($post),
        'author' => ['@type' => 'Organization', 'name' => 'Centre Médical Atlas'],
        'publisher' => ['@type' => 'Organization', 'name' => 'Centre Médical Atlas', 'url' => home_url('/')],
        'inLanguage' => 'fr-FR',
    ];
    $img = atlas_og_image();
    if ($img) $data['image'] = $img;
    return $data;
}

function atlas_print_schema($data) {
    echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) . "</script>\n";
}

add_action('wp_head', function () {
    // Avec un plugin SEO actif : on laisse celui-ci gérer description et partage, on garde seulement la fiche locale (clinique, horaires).
    $s = atlas_seo_plugin_active() ? null : atlas_seo_current();
    if ($s) {
        $title = $s['title']; $desc = $s['desc'];
        if ($desc !== '') echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:locale" content="fr_FR">' . "\n";
        echo '<meta property="og:type" content="' . (is_singular('post') ? 'article' : 'website') . '">' . "\n";
        echo '<meta property="og:site_name" content="Centre Médical Atlas">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        if ($desc !== '') echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
        $url = is_singular() ? get_permalink() : (is_front_page() ? home_url('/') : '');
        if ($url) echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        $img = atlas_og_image();
        if ($img) echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
        echo '<meta name="twitter:card" content="' . ($img ? 'summary_large_image' : 'summary') . '">' . "\n";
    }
    echo '<meta name="geo.region" content="SN-DK">' . "\n" . '<meta name="geo.placename" content="Dakar">' . "\n";
    if (is_front_page() || is_page('contact')) atlas_print_schema(atlas_schema_clinic());
    if (is_singular('post')) atlas_print_schema(atlas_schema_article(get_queried_object()));
}, 5);

/* ---------- Performances : retire ce dont le site n'a pas besoin ---------- */
add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
});
