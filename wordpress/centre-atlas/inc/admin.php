<?php
/**
 * Administration « Centre Atlas » : Coordonnées, Photos du site, Textes du site.
 */
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_menu_page('Centre Atlas', 'Centre Atlas', 'manage_options', 'centre-atlas', 'atlas_admin_contact', 'dashicons-heart', 24);
    add_submenu_page('centre-atlas', 'Coordonnées', 'Coordonnées', 'manage_options', 'centre-atlas', 'atlas_admin_contact');
    // Anciennes pages (remplacées par « Contenu du site ») : accessibles par lien direct seulement
    add_submenu_page('', 'Photos du site', 'Photos du site', 'manage_options', 'centre-atlas-photos', 'atlas_admin_photos');
    add_submenu_page('', 'Textes du site', 'Textes du site', 'manage_options', 'centre-atlas-textes', 'atlas_admin_textes');
    // SEO : menu à part (voir plus bas)
});

add_action('admin_menu', function () {
    add_menu_page('SEO et partage', 'SEO et partage', 'manage_options', 'centre-atlas-seo', 'atlas_admin_seo', 'dashicons-search', 4);
});

add_action('admin_enqueue_scripts', function ($hook) {
    if (strpos((string) $hook, 'centre-atlas-photos') !== false || strpos((string) $hook, 'centre-atlas-seo') !== false) wp_enqueue_media();
});

add_action('admin_init', function () {
    register_setting('atlas_contact_group', 'atlas_contact', ['sanitize_callback' => 'atlas_sanitize_contact']);
    register_setting('atlas_photos_group', 'atlas_photos', ['sanitize_callback' => 'atlas_sanitize_photos']);
    register_setting('atlas_texts_group', 'atlas_texts', ['sanitize_callback' => 'atlas_sanitize_texts']);
    register_setting('atlas_seo_group', 'atlas_seo', ['sanitize_callback' => 'atlas_sanitize_seo']);
});

/* ---------- Nettoyage des valeurs enregistrées ---------- */
/** Enregistre une valeur déjà nettoyée (sans repasser par le filtre, qui annulerait les retours au texte d'origine). */
function atlas_store_option($name, $value) {
    $filters = $GLOBALS['wp_filter']['sanitize_option_' . $name] ?? null;
    remove_all_filters('sanitize_option_' . $name);
    update_option($name, $value);
    if ($filters) $GLOBALS['wp_filter']['sanitize_option_' . $name] = $filters;
}

function atlas_sanitize_contact($in) {
    $in = is_array($in) ? $in : [];
    $out = [];
    foreach (atlas_contact_defaults() as $k => $def) {
        $v = isset($in[$k]) ? (string) $in[$k] : '';
        if ($k === 'email' || $k === 'rdv_email') $out[$k] = sanitize_email($v);
        elseif (in_array($k, ['facebook', 'instagram', 'tiktok', 'linkedin', 'google'], true)) $out[$k] = esc_url_raw($v);
        elseif ($k === 'lat' || $k === 'lng') $out[$k] = preg_match('/^-?\d{1,3}(\.\d+)?$/', trim($v)) ? trim($v) : '';
        elseif ($k === 'retention_mois') $out[$k] = (string) max(0, min(60, (int) $v));
        elseif ($k === 'ouv_semaine' || $k === 'ouv_samedi') $out[$k] = preg_match('/^\d{2}:\d{2}-\d{2}:\d{2}$/', trim($v)) ? trim($v) : '';
        elseif ($k === 'horaires') $out[$k] = sanitize_textarea_field($v);
        else $out[$k] = sanitize_text_field($v);
    }
    return $out;
}
function atlas_sanitize_photos($in) {
    $old = get_option('atlas_photos', []);
    $out = is_array($old) ? $old : [];
    $reg = atlas_registry();
    foreach ((array) $in as $k => $v) {
        if (!isset($reg['photos'][$k])) continue;
        $id = (int) $v;
        if ($id > 0 && wp_attachment_is_image($id)) $out[$k] = $id; else unset($out[$k]);
    }
    return $out;
}
function atlas_sanitize_texts($in) {
    $old = get_option('atlas_texts', []);
    $out = is_array($old) ? $old : [];
    $reg = atlas_registry();
    foreach ((array) $in as $k => $v) {
        if (!isset($reg['texts'][$k])) continue;
        $v = trim(sanitize_text_field((string) $v));
        if ($v === '' || $v === $reg['texts'][$k][1]) unset($out[$k]); else $out[$k] = $v;
    }
    return $out;
}

/* ---------- Page « Coordonnées » ---------- */
function atlas_admin_contact() {
    $v = array_merge(atlas_contact_defaults(), (array) get_option('atlas_contact', []));
    $fields = [
        'tel_fixe'   => ['Téléphone fixe', 'text', 'ex. 33 867 86 46'],
        'tel_mobile' => ['Mobile / WhatsApp', 'text', 'ex. 78 831 60 60 (sert au bouton WhatsApp)'],
        'email'      => ['Email affiché sur le site', 'email', 'ex. contact@centreatlas.sn'],
        'rdv_email'  => ['Email qui reçoit les demandes de rendez-vous', 'email', 'Les formulaires du site arrivent à cette adresse'],
        'adresse'    => ['Adresse complète', 'text', 'ex. Rue 10, Fann Résidence, Dakar'],
        'horaires'   => ['Horaires', 'textarea', "ex. Lundi au vendredi : 8h - 18h\nSamedi : 8h - 13h"],
        'facebook'   => ['Page Facebook (lien)', 'url', 'Laissez vide pour masquer l\'icône'],
        'instagram'  => ['Compte Instagram (lien)', 'url', 'Laissez vide pour masquer l\'icône'],
        'tiktok'     => ['Compte TikTok (lien)', 'url', 'Laissez vide pour masquer l\'icône'],
        'linkedin'   => ['Page LinkedIn (lien)', 'url', 'Laissez vide pour masquer l\'icône'],
        'google'     => ['Fiche Google (lien)', 'url', 'Lien de votre fiche Google Business Profile : un bouton « Notre fiche Google » apparaît sur la page Contact'],
        'ouv_semaine' => ['Ouverture lundi-vendredi (pour Google)', 'text', 'Format 09:00-18:00'],
        'ouv_samedi' => ['Ouverture samedi (pour Google)', 'text', 'Format 09:00-14:00 (laissez vide si fermé)'],
        'lat'        => ['Latitude (facultatif)', 'text', 'ex. 14.7167 : améliore l\'affichage sur Google Maps'],
        'lng'        => ['Longitude (facultatif)', 'text', 'ex. -17.4677'],
        'raison_sociale' => ['Raison sociale', 'text', 'Mentions légales : nom officiel de la société'],
        'forme_juridique' => ['Forme juridique', 'text', 'ex. SARL'],
        'ninea'      => ['NINEA', 'text', 'Mentions légales'],
        'rccm'       => ['RCCM', 'text', 'Mentions légales'],
        'directeur'  => ['Directeur de la publication', 'text', 'Mentions légales : nom et prénom'],
        'autorisation' => ['Autorisation d\'exercer / Ordre des médecins', 'text', 'Mentions légales : référence de l\'autorisation du centre'],
        'email_donnees' => ['Email pour les demandes sur les données personnelles', 'email', 'Politique de confidentialité. Laissez vide pour utiliser l\'email du site'],
        'retention_mois' => ['Suppression automatique des demandes de rendez-vous (en mois)', 'number', '12 par défaut ; 0 = ne jamais supprimer automatiquement'],
    ];
    echo '<div class="wrap"><h1>Coordonnées du centre</h1>';
    echo '<p>Ces informations s\'affichent automatiquement partout sur le site : en-tête, pied de page, page Contact, boutons Appeler, WhatsApp et Itinéraire.</p>';
    echo '<form method="post" action="options.php">';
    settings_fields('atlas_contact_group');
    echo '<table class="form-table"><tbody>';
    foreach ($fields as $k => $f) {
        echo '<tr><th><label for="atlas_c_' . esc_attr($k) . '">' . esc_html($f[0]) . '</label></th><td>';
        if ($f[1] === 'textarea') {
            echo '<textarea id="atlas_c_' . esc_attr($k) . '" name="atlas_contact[' . esc_attr($k) . ']" class="large-text" rows="3" placeholder="' . esc_attr($f[2]) . '">' . esc_textarea($v[$k]) . '</textarea>';
        } else {
            echo '<input id="atlas_c_' . esc_attr($k) . '" type="' . esc_attr($f[1]) . '" name="atlas_contact[' . esc_attr($k) . ']" class="regular-text" value="' . esc_attr($v[$k]) . '" placeholder="' . esc_attr($f[2]) . '">';
        }
        echo '</td></tr>';
    }
    echo '</tbody></table>';
    submit_button('Enregistrer');
    echo '</form></div>';
}

/* ---------- Page « Photos du site » ---------- */
function atlas_admin_photos() {
    $reg = atlas_registry();
    $saved = (array) get_option('atlas_photos', []);
    $groups = [];
    foreach ($reg['photos'] as $key => $info) { $groups[$info[0]][$key] = $info[1]; }

    echo '<div class="wrap"><h1>Photos du site</h1>';
    echo '<p>Chaque emplacement gris du site peut recevoir une vraie photo du centre. Cliquez sur « Choisir une photo », puis sur « Enregistrer ». Tant qu\'aucune photo n\'est choisie, l\'emplacement reste gris. Format conseillé : horizontal, au moins 1600 px de large.</p>';
    echo '<style>.atlas-ph-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;margin:12px 0 28px}.atlas-photo{background:#fff;border:1px solid #dcdcde;border-radius:6px;padding:12px}.atlas-photo-preview{height:130px;border-radius:4px;background:#e9eef0 center/cover no-repeat;margin-bottom:10px}.atlas-photo strong{display:block;margin-bottom:8px}</style>';
    echo '<form method="post" action="options.php">';
    settings_fields('atlas_photos_group');
    foreach ($reg['pages'] as $slug => $title) {
        if (empty($groups[$slug])) continue;
        echo '<h2>' . esc_html($title) . '</h2><div class="atlas-ph-grid">';
        foreach ($groups[$slug] as $key => $label) {
            $id = isset($saved[$key]) ? (int) $saved[$key] : 0;
            $thumb = $id ? wp_get_attachment_image_url($id, 'medium') : '';
            $is_default = false;
            if (!$thumb) { $thumb = atlas_photo_default_url($key); $is_default = $thumb !== ''; }
            echo '<div class="atlas-photo"><div class="atlas-photo-preview"' . ($thumb ? ' style="background-image:url(\'' . esc_url($thumb) . '\')"' : '') . '></div>';
            echo '<strong>' . esc_html($label !== '' ? $label : $key) . '</strong>';
            if ($is_default) echo '<p class="description" style="margin:0 0 8px">Photo du centre fournie avec le thème. Choisissez-en une autre pour la remplacer.</p>';
            echo '<input type="hidden" class="atlas-photo-id" name="atlas_photos[' . esc_attr($key) . ']" value="' . esc_attr($id) . '">';
            echo '<button type="button" class="button atlas-photo-pick">Choisir une photo</button> ';
            echo '<button type="button" class="button-link atlas-photo-remove">Retirer</button></div>';
        }
        echo '</div>';
    }
    submit_button('Enregistrer les photos');
    echo '</form></div>';
    ?>
    <script>
    jQuery(function ($) {
        $('.atlas-photo-pick').on('click', function (e) {
            e.preventDefault();
            var box = $(this).closest('.atlas-photo');
            var frame = wp.media({ title: 'Choisir une photo', button: { text: 'Utiliser cette photo' }, multiple: false, library: { type: 'image' } });
            frame.on('select', function () {
                var a = frame.state().get('selection').first().toJSON();
                var url = (a.sizes && a.sizes.medium) ? a.sizes.medium.url : a.url;
                box.find('.atlas-photo-id').val(a.id);
                box.find('.atlas-photo-preview').css('background-image', 'url(' + url + ')');
            });
            frame.open();
        });
        $('.atlas-photo-remove').on('click', function (e) {
            e.preventDefault();
            var box = $(this).closest('.atlas-photo');
            box.find('.atlas-photo-id').val('');
            box.find('.atlas-photo-preview').css('background-image', 'none');
        });
    });
    </script>
    <?php
}

/* ---------- Page « Textes du site » ---------- */
function atlas_admin_textes() {
    $reg = atlas_registry();
    $saved = (array) get_option('atlas_texts', []);
    $groups = [];
    foreach ($reg['texts'] as $key => $info) { $groups[$info[0]][$key] = $info[1]; }
    $current = isset($_GET['groupe']) ? sanitize_key(wp_unslash($_GET['groupe'])) : '';
    if (!isset($groups[$current])) { $current = isset($groups['accueil']) ? 'accueil' : (string) key($groups); }
    $base = admin_url('admin.php?page=centre-atlas-textes');

    echo '<div class="wrap"><h1>Textes du site</h1>';
    echo '<p>Choisissez une page ci-dessous, modifiez les textes puis cliquez sur « Enregistrer ». Pour revenir au texte d\'origine, videz le champ. Les repères entre accolades, comme <code>{tel_fixe}</code>, sont remplacés automatiquement par vos coordonnées : ne les supprimez pas.</p>';
    echo '<style>.atlas-tabs a{display:inline-block;margin:0 6px 6px 0;padding:5px 12px;border:1px solid #c3c4c7;border-radius:14px;background:#fff;text-decoration:none}.atlas-tabs a.on{background:#2271b1;color:#fff;border-color:#2271b1}.atlas-trow{display:grid;grid-template-columns:1fr;gap:4px;margin:0 0 14px}.atlas-trow textarea,.atlas-trow input{width:100%}</style>';
    echo '<div class="atlas-tabs">';
    foreach ($reg['pages'] as $slug => $title) {
        if (empty($groups[$slug])) continue;
        echo '<a class="' . ($slug === $current ? 'on' : '') . '" href="' . esc_url(add_query_arg('groupe', $slug, $base)) . '">' . esc_html($title) . ' (' . count($groups[$slug]) . ')</a>';
    }
    echo '</div>';
    echo '<p><input type="search" id="atlas-tsearch" class="regular-text" placeholder="Rechercher un texte dans cette page…"></p>';
    echo '<form method="post" action="options.php">';
    settings_fields('atlas_texts_group');
    foreach ($groups[$current] as $key => $default) {
        $val = (isset($saved[$key]) && $saved[$key] !== '') ? $saved[$key] : $default;
        $long = strlen($val) > 90 || strlen($default) > 90;
        echo '<div class="atlas-trow" data-search="' . esc_attr(function_exists('mb_strtolower') ? mb_strtolower($default . ' ' . $val) : strtolower($default . ' ' . $val)) . '">';
        if ($long) {
            echo '<textarea rows="3" name="atlas_texts[' . esc_attr($key) . ']">' . esc_textarea($val) . '</textarea>';
        } else {
            echo '<input type="text" name="atlas_texts[' . esc_attr($key) . ']" value="' . esc_attr($val) . '">';
        }
        echo '</div>';
    }
    submit_button('Enregistrer');
    echo '</form></div>';
    ?>
    <script>
    document.getElementById('atlas-tsearch').addEventListener('input', function () {
        var q = this.value.toLowerCase();
        document.querySelectorAll('.atlas-trow').forEach(function (r) {
            r.style.display = (!q || r.getAttribute('data-search').indexOf(q) !== -1) ? '' : 'none';
        });
    });
    </script>
    <?php
}

/* ---------- Page « SEO (Google) » ---------- */
function atlas_sanitize_seo($in) {
    $reg = atlas_registry();
    $out = [];
    $img = function ($v) { $id = (int) $v; return ($id > 0 && wp_attachment_is_image($id)) ? $id : 0; };
    foreach ((array) $in as $slug => $f) {
        if (!is_array($f)) continue;
        if ($slug === '_default') {
            $i = $img($f['img'] ?? 0);
            if ($i) $out['_default'] = ['img' => $i];
            continue;
        }
        if (!isset($reg['seo'][$slug])) continue;
        $t = trim(sanitize_text_field(isset($f['title']) ? $f['title'] : ''));
        $d = trim(sanitize_text_field(isset($f['desc']) ? $f['desc'] : ''));
        if ($t === $reg['seo'][$slug][1]) $t = '';
        if ($d === $reg['seo'][$slug][2]) $d = '';
        $i = $img($f['img'] ?? 0);
        if ($t !== '' || $d !== '' || $i) $out[$slug] = ['title' => $t, 'desc' => $d, 'img' => $i];
    }
    return $out;
}

function atlas_admin_seo() {
    $reg = atlas_registry();
    $saved = (array) get_option('atlas_seo', []);
    $logo = get_theme_file_uri('assets/og-image.jpg');
    $def_id = (int) ($saved['_default']['img'] ?? 0);
    $def_url = $def_id ? (string) wp_get_attachment_image_url($def_id, 'medium_large') : $logo;
    $host = wp_parse_url(home_url('/'), PHP_URL_HOST);
    echo '<div class="wrap atlas-seo"><h1>SEO et partage</h1>';
    if (atlas_seo_plugin_active()) {
        echo '<div class="notice notice-warning"><p>Un plugin SEO est actif : il gère les titres, descriptions et images de partage. Les réglages ci-dessous sont ignorés tant qu\'il reste activé.</p></div>';
    }
    if (!empty($_GET['settings-updated'])) echo '<div class="notice notice-success is-dismissible"><p><strong>Enregistré.</strong> Pensez à rafraîchir l\'aperçu sur Facebook / LinkedIn (voir en bas).</p></div>';
    echo '<p class="atlas-intro">Pour chaque page : le <strong>titre</strong> et la <strong>description</strong> affichés par Google, puis l\'<strong>image</strong> affichée quand on partage le lien (WhatsApp, Facebook, LinkedIn…). Videz un champ pour revenir à la valeur proposée. Conseils : titre ≤ 60 caractères, description ≤ 155, image horizontale (idéalement 1200 × 630).</p>';
    echo '<style>
    .atlas-seo{max-width:1100px}.atlas-intro{color:#50575e;max-width:820px}
    .atlas-seo-toc{display:flex;flex-wrap:wrap;gap:6px;margin:14px 0;position:sticky;top:32px;z-index:5;background:#f0f0f1;padding:8px 0}
    .atlas-seo-toc a{background:#fff;border:1px solid #c3c4c7;border-radius:999px;padding:4px 12px;text-decoration:none;font-size:12px}
    .atlas-seo-row{background:#fff;border:1px solid #dcdcde;border-radius:10px;padding:16px 18px;margin:0 0 16px;display:grid;grid-template-columns:minmax(0,1fr) 300px;gap:22px;scroll-margin-top:90px}
    .atlas-seo-row h2{margin:0 0 10px;font-size:16px;grid-column:1/-1;display:flex;justify-content:space-between;gap:10px}
    .atlas-seo-row h2 a{font-size:12px;font-weight:400}
    .atlas-seo-row label{display:block;font-weight:600;margin:10px 0 4px}
    .atlas-seo-row input[type=text],.atlas-seo-row textarea{width:100%}
    .atlas-count{font-size:12px;color:#646970}.atlas-count.over{color:#b32d2e;font-weight:600}
    .atlas-g{border:1px solid #eee;border-radius:8px;padding:10px 12px;margin-top:12px;font-family:arial,sans-serif;background:#fcfcfc}
    .atlas-g small{color:#4d5156;font-size:12px}.atlas-g b{display:block;color:#1a0dab;font-size:17px;font-weight:400;margin:2px 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.atlas-g p{margin:0;color:#4d5156;font-size:13px;line-height:1.4}
    .atlas-share{border:1px solid #dcdcde;border-radius:8px;overflow:hidden;background:#f0f2f5}
    .atlas-share-img{aspect-ratio:1200/630;background:#fff center/cover no-repeat}
    .atlas-share-txt{padding:8px 10px;font-size:12px;color:#606770}.atlas-share-txt b{display:block;color:#1d2129;font-size:13px;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .atlas-share-actions{display:flex;gap:10px;align-items:center;margin-top:8px;flex-wrap:wrap}
    .atlas-savebar{position:sticky;bottom:0;background:#fff;border-top:1px solid #dcdcde;padding:12px 18px;margin:0 -20px;z-index:9}
    @media (max-width:900px){.atlas-seo-row{grid-template-columns:1fr}}
    </style>';
    echo '<form method="post" action="options.php">';
    settings_fields('atlas_seo_group');

    // Image par défaut
    echo '<div class="atlas-seo-row" id="seo-default"><h2>Image de partage par défaut <span class="atlas-count">utilisée pour toutes les pages sans image propre</span></h2>';
    echo '<div><p>Par défaut, le logo du Centre Médical Atlas s\'affiche. Vous pouvez le remplacer par une autre image (par exemple une photo de la façade avec le logo).</p></div>';
    echo atlas_seo_image_field('_default', $def_id, $def_url, $logo, 'Centre Médical Atlas', $host, 'Remettre le logo');
    echo '</div>';

    echo '<nav class="atlas-seo-toc">';
    foreach ($reg['seo'] as $slug => $info) echo '<a href="#seo-' . esc_attr($slug) . '">' . esc_html($info[0]) . '</a>';
    echo '</nav>';

    foreach ($reg['seo'] as $slug => $info) {
        $t = !empty($saved[$slug]['title']) ? $saved[$slug]['title'] : $info[1];
        $d = !empty($saved[$slug]['desc']) ? $saved[$slug]['desc'] : $info[2];
        $iid = (int) ($saved[$slug]['img'] ?? 0);
        $iurl = $iid ? (string) wp_get_attachment_image_url($iid, 'medium_large') : $def_url;
        $url = function_exists('atlas_contenu_url') ? atlas_contenu_url($slug) : '';
        if ($slug === 'blog' || $slug === 'accueil') $url = $url ?: home_url('/');
        echo '<div class="atlas-seo-row" id="seo-' . esc_attr($slug) . '"><h2>' . esc_html($info[0]) . ($url ? '<a href="' . esc_url($url) . '" target="_blank" rel="noopener">Voir la page ↗</a>' : '') . '</h2><div>';
        echo '<label>Titre sur Google</label><input type="text" class="atlas-seo-t" name="atlas_seo[' . esc_attr($slug) . '][title]" value="' . esc_attr($t) . '"><span class="atlas-count" data-max="60"></span>';
        echo '<label>Description sur Google</label><textarea rows="3" class="atlas-seo-d" name="atlas_seo[' . esc_attr($slug) . '][desc]">' . esc_textarea($d) . '</textarea><span class="atlas-count" data-max="155"></span>';
        echo '<div class="atlas-g"><small>' . esc_html($host . ($url ? wp_parse_url($url, PHP_URL_PATH) : '')) . '</small><b class="g-t">' . esc_html($t) . '</b><p class="g-d">' . esc_html($d) . '</p></div>';
        echo '</div>';
        echo atlas_seo_image_field($slug, $iid, $iurl, $def_url, $t, $host, 'Utiliser l\'image par défaut');
        echo '</div>';
    }
    echo '<div class="atlas-savebar">'; submit_button('Enregistrer', 'primary large', 'submit', false); echo '</div>';
    echo '<h2 style="margin-top:28px">Après un changement d\'image</h2><p>Les réseaux gardent l\'ancien aperçu en mémoire. Pour le rafraîchir : <a href="https://developers.facebook.com/tools/debug/" target="_blank" rel="noopener">Facebook / WhatsApp</a> (« Scrape Again ») et <a href="https://www.linkedin.com/post-inspector/" target="_blank" rel="noopener">LinkedIn</a>.</p>';
    echo '</form></div>';
    ?>
    <script>
    jQuery(function ($) {
        $('.atlas-seo-row').each(function () {
            var row = $(this);
            row.find('input[type=text],textarea').each(function () {
                var el = this, out = $(el).next('.atlas-count'), max = parseInt(out.data('max'), 10);
                function upd() {
                    var n = el.value.length; out.text(n + ' / ' + max + ' caractères').toggleClass('over', n > max);
                    if ($(el).hasClass('atlas-seo-t')) { row.find('.g-t').text(el.value); row.find('.atlas-share-txt b').text(el.value); }
                    if ($(el).hasClass('atlas-seo-d')) row.find('.g-d').text(el.value);
                }
                $(el).on('input', upd); upd();
            });
        });
        $('.atlas-seo').on('click', '.atlas-share-pick', function (e) {
            e.preventDefault();
            var box = $(this).closest('.atlas-share-col');
            var frame = wp.media({ title: 'Image de partage', button: { text: 'Utiliser cette image' }, multiple: false, library: { type: 'image' } });
            frame.on('select', function () {
                var a = frame.state().get('selection').first().toJSON();
                var url = (a.sizes && a.sizes.medium_large) ? a.sizes.medium_large.url : a.url;
                box.find('.atlas-share-id').val(a.id);
                box.find('.atlas-share-img').css('background-image', 'url("' + url + '")');
            });
            frame.open();
        });
        $('.atlas-seo').on('click', '.atlas-share-reset', function (e) {
            e.preventDefault();
            var box = $(this).closest('.atlas-share-col');
            box.find('.atlas-share-id').val('');
            box.find('.atlas-share-img').css('background-image', 'url("' + box.data('fallback') + '")');
        });
    });
    </script>
    <?php
}

/** Colonne « image de partage » : aperçu façon WhatsApp/Facebook + boutons. */
function atlas_seo_image_field($slug, $id, $url, $fallback, $title, $host, $reset_label) {
    return '<div class="atlas-share-col" data-fallback="' . esc_url($fallback) . '"><label style="margin-top:0">Image au partage du lien</label>'
        . '<div class="atlas-share"><div class="atlas-share-img" style="background-image:url(\'' . esc_url($url) . '\')"></div>'
        . '<div class="atlas-share-txt">' . esc_html(strtoupper((string) $host)) . '<b>' . esc_html($title) . '</b></div></div>'
        . '<input type="hidden" class="atlas-share-id" name="atlas_seo[' . esc_attr($slug) . '][img]" value="' . ($id ?: '') . '">'
        . '<div class="atlas-share-actions"><button type="button" class="button atlas-share-pick">Choisir une image</button>'
        . '<a href="#" class="atlas-share-reset">' . esc_html($reset_label) . '</a></div></div>';
}
