<?php
/**
 * Administration « Centre Atlas » : Coordonnées, Photos du site, Textes du site.
 */
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_menu_page('Centre Atlas', 'Centre Atlas', 'manage_options', 'centre-atlas', 'atlas_admin_contact', 'dashicons-heart', 24);
    add_submenu_page('centre-atlas', 'Coordonnées', 'Coordonnées', 'manage_options', 'centre-atlas', 'atlas_admin_contact');
    add_submenu_page('centre-atlas', 'Photos du site', 'Photos du site', 'manage_options', 'centre-atlas-photos', 'atlas_admin_photos');
    add_submenu_page('centre-atlas', 'Textes du site', 'Textes du site', 'manage_options', 'centre-atlas-textes', 'atlas_admin_textes');
    add_submenu_page('centre-atlas', 'SEO (Google)', 'SEO (Google)', 'manage_options', 'centre-atlas-seo', 'atlas_admin_seo');
});

add_action('admin_enqueue_scripts', function ($hook) {
    if (strpos((string) $hook, 'centre-atlas-photos') !== false) wp_enqueue_media();
});

add_action('admin_init', function () {
    register_setting('atlas_contact_group', 'atlas_contact', ['sanitize_callback' => 'atlas_sanitize_contact']);
    register_setting('atlas_photos_group', 'atlas_photos', ['sanitize_callback' => 'atlas_sanitize_photos']);
    register_setting('atlas_texts_group', 'atlas_texts', ['sanitize_callback' => 'atlas_sanitize_texts']);
    register_setting('atlas_seo_group', 'atlas_seo', ['sanitize_callback' => 'atlas_sanitize_seo']);
});

/* ---------- Nettoyage des valeurs enregistrées ---------- */
function atlas_sanitize_contact($in) {
    $in = is_array($in) ? $in : [];
    $out = [];
    foreach (atlas_contact_defaults() as $k => $def) {
        $v = isset($in[$k]) ? (string) $in[$k] : '';
        if ($k === 'email' || $k === 'rdv_email') $out[$k] = sanitize_email($v);
        elseif ($k === 'facebook' || $k === 'instagram' || $k === 'google') $out[$k] = esc_url_raw($v);
        elseif ($k === 'lat' || $k === 'lng') $out[$k] = preg_match('/^-?\d{1,3}(\.\d+)?$/', trim($v)) ? trim($v) : '';
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
        'google'     => ['Fiche Google (lien)', 'url', 'Lien de votre fiche Google Business Profile : un bouton « Notre fiche Google » apparaît sur la page Contact'],
        'ouv_semaine' => ['Ouverture lundi-vendredi (pour Google)', 'text', 'Format 09:00-18:00'],
        'ouv_samedi' => ['Ouverture samedi (pour Google)', 'text', 'Format 09:00-14:00 (laissez vide si fermé)'],
        'lat'        => ['Latitude (facultatif)', 'text', 'ex. 14.7167 : améliore l\'affichage sur Google Maps'],
        'lng'        => ['Longitude (facultatif)', 'text', 'ex. -17.4677'],
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
            echo '<div class="atlas-photo"><div class="atlas-photo-preview"' . ($thumb ? ' style="background-image:url(\'' . esc_url($thumb) . '\')"' : '') . '></div>';
            echo '<strong>' . esc_html($label !== '' ? $label : $key) . '</strong>';
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
    foreach ((array) $in as $slug => $f) {
        if (!isset($reg['seo'][$slug]) || !is_array($f)) continue;
        $t = trim(sanitize_text_field(isset($f['title']) ? $f['title'] : ''));
        $d = trim(sanitize_text_field(isset($f['desc']) ? $f['desc'] : ''));
        if ($t === $reg['seo'][$slug][1]) $t = '';
        if ($d === $reg['seo'][$slug][2]) $d = '';
        if ($t !== '' || $d !== '') $out[$slug] = ['title' => $t, 'desc' => $d];
    }
    return $out;
}

function atlas_admin_seo() {
    $reg = atlas_registry();
    echo '<div class="wrap"><h1>SEO : apparaître sur Google à Dakar</h1>';
    if (atlas_seo_plugin_active()) {
        echo '<div class="notice notice-warning"><p>Un plugin SEO est actif : il gère les titres et descriptions. Les réglages ci-dessous sont ignorés tant qu\'il reste activé.</p></div>';
    }
    echo '<p>Pour chaque page, voici le <strong>titre</strong> et la <strong>description</strong> proposés à Google. Ils contiennent déjà les mots que vos patients recherchent (« à Dakar », « échographie », « endoscopie »…). Modifiez-les si besoin ; videz un champ pour revenir à la valeur proposée.</p>';
    echo '<p>Conseil : titre de 60 caractères maximum, description de 155 caractères maximum. Les articles utilisent leur titre et leur « extrait ».</p>';
    echo '<style>.atlas-seo-row{background:#fff;border:1px solid #dcdcde;border-radius:6px;padding:12px 16px;margin:0 0 12px}.atlas-seo-row h3{margin:0 0 8px}.atlas-seo-row input,.atlas-seo-row textarea{width:100%}.atlas-count{font-size:12px;color:#646970}.atlas-count.over{color:#b32d2e;font-weight:600}</style>';
    echo '<form method="post" action="options.php">';
    settings_fields('atlas_seo_group');
    $saved = (array) get_option('atlas_seo', []);
    foreach ($reg['seo'] as $slug => $info) {
        $t = !empty($saved[$slug]['title']) ? $saved[$slug]['title'] : $info[1];
        $d = !empty($saved[$slug]['desc']) ? $saved[$slug]['desc'] : $info[2];
        echo '<div class="atlas-seo-row"><h3>' . esc_html($info[0]) . '</h3>';
        echo '<p><input type="text" class="atlas-seo-t" name="atlas_seo[' . esc_attr($slug) . '][title]" value="' . esc_attr($t) . '"><span class="atlas-count" data-max="60"></span></p>';
        echo '<p><textarea rows="2" class="atlas-seo-d" name="atlas_seo[' . esc_attr($slug) . '][desc]">' . esc_textarea($d) . '</textarea><span class="atlas-count" data-max="155"></span></p></div>';
    }
    submit_button('Enregistrer');
    echo '</form></div>';
    ?>
    <script>
    document.querySelectorAll('.atlas-seo-row').forEach(function (row) {
        row.querySelectorAll('input,textarea').forEach(function (el) {
            var out = el.parentNode.querySelector('.atlas-count');
            var max = parseInt(out.getAttribute('data-max'), 10);
            function upd() { var n = el.value.length; out.textContent = n + ' / ' + max + ' caractères'; out.className = 'atlas-count' + (n > max ? ' over' : ''); }
            el.addEventListener('input', upd); upd();
        });
    });
    </script>
    <?php
}
