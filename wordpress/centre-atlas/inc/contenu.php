<?php
/**
 * « Contenu du site » : une page d'administration par page du site,
 * avec ses textes et ses photos regroupés par section, dans l'ordre d'affichage.
 */
if (!defined('ABSPATH')) exit;

/** Pages affichées directement dans le menu de gauche (les autres sont accessibles depuis « Toutes les pages »). */
function atlas_contenu_main_pages() {
    return ['accueil', 'le-centre', 'specialites', 'imagerie', 'biologie', 'endoscopie', 'biopsie', 'nos-medecins', 'rendez-vous', 'contact', 'blog', 'commun'];
}

/** Groupes de la vue d'ensemble. */
function atlas_contenu_groups() {
    $reg = atlas_registry();
    $groups = [
        'Pages principales' => ['accueil', 'le-centre', 'specialites', 'nos-medecins', 'rendez-vous', 'contact', 'blog'],
        'Examens'           => ['imagerie', 'biologie', 'endoscopie', 'biopsie'],
        'Spécialités'       => [],
        'Éléments présents sur toutes les pages' => ['commun', 'cta'],
        'Pages légales'     => ['mentions-legales', 'politique-de-confidentialite'],
        'Autres'            => [],
    ];
    $placed = array_merge(...array_values($groups));
    foreach (array_keys($reg['layout'] ?? []) as $slug) {
        if (in_array($slug, $placed, true)) continue;
        if (strpos($slug, 'specialites-') === 0) $groups['Spécialités'][] = $slug; else $groups['Autres'][] = $slug;
    }
    foreach ($groups as $g => $list) {
        $groups[$g] = array_values(array_filter($list, function ($s) use ($reg) { return !empty($reg['layout'][$s]); }));
    }
    return array_filter($groups);
}

function atlas_contenu_title($slug) {
    $reg = atlas_registry();
    $names = ['commun' => 'En-tête et pied de page', 'cta' => 'Bandeau « Besoin d\'un rendez-vous ? »', 'blog' => 'Conseils santé (blog)'];
    if (isset($names[$slug])) return $names[$slug];
    return $reg['pages'][$slug] ?? $slug;
}

/** Adresse publique de la page (pour « Voir la page »). */
function atlas_contenu_url($slug) {
    if (in_array($slug, ['accueil', 'commun', 'cta'], true)) return home_url('/');
    if ($slug === 'blog') {
        $id = (int) get_option('page_for_posts');
        if ($id) return get_permalink($id);
        $p = get_page_by_path('conseils-sante');
        return $p ? get_permalink($p) : home_url('/');
    }
    $p = get_page_by_path($slug);
    return $p ? get_permalink($p) : '';
}

/** Valeur brute enregistrée (ou texte d'origine). */
function atlas_contenu_text_value($key) {
    return function_exists('atlas_text_raw') ? atlas_text_raw($key) : atlas_text($key);
}

/* ---------- Menu ---------- */
add_action('admin_menu', function () {
    $reg = atlas_registry();
    add_menu_page('Contenu du site', 'Contenu du site', 'manage_options', 'atlas-contenu', 'atlas_contenu_overview', 'dashicons-edit-page', 3);
    add_submenu_page('atlas-contenu', 'Toutes les pages', 'Toutes les pages', 'manage_options', 'atlas-contenu', 'atlas_contenu_overview');
    // pages principales dans l'ordre du site, puis les autres (masquées du menu, voir plus bas)
    $all = array_keys($reg['layout'] ?? []);
    $main = array_values(array_intersect(atlas_contenu_main_pages(), $all));
    foreach (array_merge($main, array_diff($all, $main)) as $slug) {
        add_submenu_page('atlas-contenu', atlas_contenu_title($slug), atlas_contenu_title($slug), 'manage_options',
            'atlas-p-' . $slug, function () use ($slug) { atlas_contenu_edit($slug); });
    }
});

// Seules les pages principales apparaissent dans le menu de gauche (les autres restent accessibles depuis « Toutes les pages »)
add_action('admin_head', function () {
    $reg = atlas_registry();
    $hide = array_diff(array_keys($reg['layout'] ?? []), atlas_contenu_main_pages());
    if (!$hide) return;
    $sel = [];
    foreach ($hide as $slug) $sel[] = '#toplevel_page_atlas-contenu .wp-submenu li:has(> a[href$="page=atlas-p-' . esc_attr($slug) . '"])';
    echo '<style>' . implode(',', $sel) . '{display:none}</style>';
});

add_filter('submenu_file', function ($sub) {
    $p = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
    if (strpos($p, 'atlas-p-') === 0 && !in_array(substr($p, 8), atlas_contenu_main_pages(), true)) return 'atlas-contenu';
    return $sub;
});

add_action('admin_enqueue_scripts', function () {
    $p = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
    if (strpos($p, 'atlas-p-') === 0) wp_enqueue_media();
});

function atlas_contenu_css() {
    echo '<style>
    .atlas-wrap{max-width:1100px}
    .atlas-head{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin:8px 0 6px}
    .atlas-head h1{margin:0 8px 0 0}
    .atlas-intro{color:#50575e;margin:6px 0 18px;max-width:780px}
    .atlas-group{margin:28px 0 10px;font-size:15px;text-transform:uppercase;letter-spacing:.04em;color:#50575e}
    .atlas-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:16px}
    .atlas-card{background:#fff;border:1px solid #dcdcde;border-radius:10px;overflow:hidden;display:flex;flex-direction:column;transition:box-shadow .15s,transform .15s}
    .atlas-card:hover{box-shadow:0 6px 18px rgba(0,0,0,.08);transform:translateY(-2px)}
    .atlas-card-img{height:120px;background:linear-gradient(135deg,#cfe9ee,#e9eef0) center/cover no-repeat;display:grid;place-items:center;color:#00B0CC}
    .atlas-card-img .dashicons{font-size:42px;width:42px;height:42px}
    .atlas-card-body{padding:14px 16px 16px;display:flex;flex-direction:column;gap:6px;flex:1}
    .atlas-card-body h3{margin:0;font-size:15px}
    .atlas-card-meta{color:#646970;font-size:12px}
    .atlas-card-actions{display:flex;gap:8px;margin-top:auto;padding-top:8px}
    .atlas-toc{display:flex;flex-wrap:wrap;gap:6px;margin:0 0 18px;position:sticky;top:32px;z-index:5;background:#f0f0f1;padding:8px 0}
    .atlas-toc a{background:#fff;border:1px solid #c3c4c7;border-radius:999px;padding:4px 12px;text-decoration:none;font-size:12px}
    .atlas-sec{background:#fff;border:1px solid #dcdcde;border-radius:10px;margin:0 0 18px;scroll-margin-top:90px}
    .atlas-sec>h2{margin:0;padding:14px 18px;border-bottom:1px solid #f0f0f1;font-size:15px;display:flex;justify-content:space-between;gap:10px}
    .atlas-sec>h2 small{font-weight:400;color:#646970}
    .atlas-fields{padding:6px 18px 16px}
    .atlas-field{padding:12px 0;border-bottom:1px dashed #eee}
    .atlas-field:last-child{border-bottom:0}
    .atlas-field label{display:block;font-weight:600;margin-bottom:6px}
    .atlas-field label em{font-weight:400;font-style:normal;color:#646970;font-size:12px;margin-left:6px}
    .atlas-field input[type=text],.atlas-field textarea{width:100%;max-width:100%}
    .atlas-field .atlas-reset{font-size:12px;margin-top:4px;display:inline-block}
    .atlas-img{display:flex;gap:14px;align-items:center;flex-wrap:wrap}
    .atlas-img-prev{width:180px;height:110px;border-radius:6px;background:#e9eef0 center/cover no-repeat;border:1px solid #dcdcde}
    .atlas-img-actions{display:flex;flex-direction:column;gap:6px;align-items:flex-start}
    .atlas-savebar{position:sticky;bottom:0;background:#fff;border-top:1px solid #dcdcde;padding:12px 18px;margin:0 -20px;display:flex;gap:12px;align-items:center;z-index:9;box-shadow:0 -4px 12px rgba(0,0,0,.04)}
    .atlas-savebar .atlas-dirty{color:#b26200;display:none}
    </style>';
}

/* ---------- Vue d'ensemble ---------- */
function atlas_contenu_overview() {
    $reg = atlas_registry();
    atlas_contenu_css();
    echo '<div class="wrap atlas-wrap"><div class="atlas-head"><h1>Contenu du site</h1></div>';
    echo '<p class="atlas-intro">Choisissez la page à modifier. Vous y trouverez ses textes et ses photos, regroupés par section dans l\'ordre où ils apparaissent sur le site. Astuce : sur le site, le bouton <strong>« ✎ Modifier cette page »</strong> de la barre noire permet aussi de modifier directement en cliquant sur un texte ou une photo.</p>';
    foreach (atlas_contenu_groups() as $group => $slugs) {
        echo '<h2 class="atlas-group">' . esc_html($group) . '</h2><div class="atlas-cards">';
        foreach ($slugs as $slug) {
            $nt = $np = 0; $thumb = '';
            foreach ($reg['layout'][$slug] as $sec) {
                foreach ($sec[1] as $f) {
                    if ($f[0] === 'p') { $np++; if (!$thumb) $thumb = atlas_photo_url($f[1], 'medium'); } else { $nt++; }
                }
            }
            $edit = admin_url('admin.php?page=atlas-p-' . $slug);
            $url = atlas_contenu_url($slug);
            echo '<div class="atlas-card"><a href="' . esc_url($edit) . '" class="atlas-card-img"' . ($thumb ? ' style="background-image:url(\'' . esc_url($thumb) . '\')"' : '') . '>'
               . ($thumb ? '' : '<span class="dashicons dashicons-media-document"></span>') . '</a>'
               . '<div class="atlas-card-body"><h3><a href="' . esc_url($edit) . '" style="text-decoration:none;color:inherit">' . esc_html(atlas_contenu_title($slug)) . '</a></h3>'
               . '<span class="atlas-card-meta">' . count($reg['layout'][$slug]) . ' sections · ' . $nt . ' textes · ' . $np . ' photos</span>'
               . '<div class="atlas-card-actions"><a class="button button-primary" href="' . esc_url($edit) . '">Modifier</a>'
               . ($url ? '<a class="button" href="' . esc_url($url) . '" target="_blank" rel="noopener">Voir ↗</a>' : '') . '</div></div></div>';
        }
        echo '</div>';
    }
    echo '<h2 class="atlas-group">Aussi</h2><p><a class="button" href="' . esc_url(admin_url('admin.php?page=centre-atlas')) . '">Coordonnées et horaires</a> <a class="button" href="' . esc_url(admin_url('edit.php?post_type=atlas_medecin')) . '">Médecins</a> <a class="button" href="' . esc_url(admin_url('edit.php?post_type=atlas_temoignage')) . '">Témoignages</a> <a class="button" href="' . esc_url(admin_url('edit.php')) . '">Articles (Conseils santé)</a></p>';
    echo '</div>';
}

/* ---------- Édition d'une page ---------- */
function atlas_contenu_edit($slug) {
    $reg = atlas_registry();
    if (empty($reg['layout'][$slug])) { echo '<div class="wrap"><p>Page introuvable.</p></div>'; return; }
    atlas_contenu_css();
    $url = atlas_contenu_url($slug);
    echo '<div class="wrap atlas-wrap"><div class="atlas-head"><h1>' . esc_html(atlas_contenu_title($slug)) . '</h1>';
    if ($url) {
        echo '<a class="button" href="' . esc_url($url) . '" target="_blank" rel="noopener">Voir la page ↗</a> ';
        echo '<a class="button" href="' . esc_url(add_query_arg('atlas_edit', '1', $url)) . '" target="_blank" rel="noopener">✎ Modifier directement sur le site</a>';
    }
    echo '<a class="button-link" style="margin-left:auto" href="' . esc_url(admin_url('admin.php?page=atlas-contenu')) . '">← Toutes les pages</a></div>';
    if (!empty($_GET['updated'])) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>Modifications enregistrées.</strong>' . ($url ? ' <a href="' . esc_url($url) . '" target="_blank" rel="noopener">Voir la page ↗</a>' : '') . '</p></div>';
    }
    if ($slug === 'commun') echo '<p class="atlas-intro">Ces textes apparaissent sur <strong>toutes les pages</strong>. Les numéros, l\'email et les horaires se modifient dans <a href="' . esc_url(admin_url('admin.php?page=centre-atlas')) . '">Coordonnées</a>.</p>';
    else echo '<p class="atlas-intro">Modifiez les textes et les photos puis cliquez sur « Enregistrer ». Un champ vidé reprend son texte d\'origine.</p>';

    // sommaire des sections
    echo '<nav class="atlas-toc">';
    foreach ($reg['layout'][$slug] as $i => $sec) echo '<a href="#atlas-sec-' . (int) $i . '">' . esc_html(wp_trim_words($sec[0], 6, '…')) . '</a>';
    echo '</nav>';

    echo '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '" id="atlas-contenu-form">';
    echo '<input type="hidden" name="action" value="atlas_save_contenu"><input type="hidden" name="atlas_page" value="' . esc_attr($slug) . '">';
    wp_nonce_field('atlas_save_contenu', 'atlas_contenu_nonce');

    $photos_saved = get_option('atlas_photos', []);
    $photos_saved = is_array($photos_saved) ? $photos_saved : [];
    foreach ($reg['layout'][$slug] as $i => $sec) {
        $nt = $np = 0;
        foreach ($sec[1] as $f) { if ($f[0] === 'p') $np++; else $nt++; }
        echo '<div class="atlas-sec" id="atlas-sec-' . (int) $i . '"><h2>' . esc_html($sec[0]) . '<small>' . $nt . ' textes' . ($np ? ' · ' . $np . ' photo' . ($np > 1 ? 's' : '') : '') . '</small></h2><div class="atlas-fields">';
        foreach ($sec[1] as $f) {
            list($type, $key, $label) = $f;
            $id = 'atlas-' . sanitize_html_class($key);
            if ($type === 'p') {
                $pid = isset($photos_saved[$key]) ? (int) $photos_saved[$key] : 0;
                $cur = atlas_photo_url($key, 'medium');
                $def = atlas_photo_default_url($key);
                $plabel = $reg['photos'][$key][1] ?? '';
                echo '<div class="atlas-field"><label>Image <em>' . esc_html(preg_replace('/^Photo\s*:\s*/u', '', $plabel)) . '</em></label><div class="atlas-img">'
                   . '<div class="atlas-img-prev"' . ($cur ? ' style="background-image:url(\'' . esc_url($cur) . '\')"' : '') . '></div>'
                   . '<div class="atlas-img-actions"><input type="hidden" class="atlas-img-id" name="photos[' . esc_attr($key) . ']" value="' . ($pid ?: '') . '" data-default="' . esc_attr($def) . '">'
                   . '<button type="button" class="button button-primary atlas-img-pick">Choisir une image</button>'
                   . '<button type="button" class="button-link atlas-img-reset">' . ($def ? 'Remettre l\'image d\'origine' : 'Retirer l\'image') . '</button></div></div></div>';
            } else {
                $default = $reg['texts'][$key][1] ?? '';
                $val = atlas_contenu_text_value($key);
                $long = mb_strlen($default) > 90 || mb_strlen($val) > 90;
                echo '<div class="atlas-field"><label for="' . esc_attr($id) . '">' . esc_html($label) . (strpos($default, '{') !== false ? ' <em>Les mots entre accolades, comme {tel_fixe}, sont remplacés par vos coordonnées.</em>' : '') . '</label>';
                if ($long) {
                    echo '<textarea id="' . esc_attr($id) . '" name="texts[' . esc_attr($key) . ']" rows="3" data-default="' . esc_attr($default) . '">' . esc_textarea($val) . '</textarea>';
                } else {
                    echo '<input type="text" id="' . esc_attr($id) . '" name="texts[' . esc_attr($key) . ']" value="' . esc_attr($val) . '" data-default="' . esc_attr($default) . '">';
                }
                if ($val !== $default) echo '<a href="#" class="atlas-reset">↺ Revenir au texte d\'origine</a>';
                echo '</div>';
            }
        }
        echo '</div></div>';
    }
    echo '<div class="atlas-savebar"><button type="submit" class="button button-primary button-large">Enregistrer</button><span class="atlas-dirty">Modifications non enregistrées</span></div>';
    echo '</form></div>';
    ?>
    <script>
    jQuery(function ($) {
        var dirty = false, form = $('#atlas-contenu-form');
        function setDirty() { dirty = true; $('.atlas-dirty').show(); }
        form.on('input change', 'input,textarea', setDirty);
        form.on('submit', function () { dirty = false; });
        window.addEventListener('beforeunload', function (e) { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
        form.on('click', '.atlas-reset', function (e) {
            e.preventDefault();
            var f = $(this).closest('.atlas-field').find('input[type=text],textarea');
            f.val(f.data('default')); setDirty(); $(this).remove();
        });
        form.on('click', '.atlas-img-pick', function (e) {
            e.preventDefault();
            var box = $(this).closest('.atlas-field');
            var frame = wp.media({ title: 'Choisir une image', button: { text: 'Utiliser cette image' }, multiple: false, library: { type: 'image' } });
            frame.on('select', function () {
                var a = frame.state().get('selection').first().toJSON();
                var url = (a.sizes && a.sizes.medium) ? a.sizes.medium.url : a.url;
                box.find('.atlas-img-id').val(a.id);
                box.find('.atlas-img-prev').css('background-image', 'url("' + url + '")');
                setDirty();
            });
            frame.open();
        });
        form.on('click', '.atlas-img-reset', function (e) {
            e.preventDefault();
            var box = $(this).closest('.atlas-field'), id = box.find('.atlas-img-id'), def = id.data('default');
            id.val('');
            box.find('.atlas-img-prev').css('background-image', def ? 'url("' + def + '")' : 'none');
            setDirty();
        });
    });
    </script>
    <?php
}

/* ---------- Enregistrement ---------- */
add_action('admin_post_atlas_save_contenu', function () {
    if (!current_user_can('manage_options')) wp_die('Accès refusé', 403);
    check_admin_referer('atlas_save_contenu', 'atlas_contenu_nonce');
    $slug = sanitize_key(wp_unslash($_POST['atlas_page'] ?? ''));
    $texts = isset($_POST['texts']) && is_array($_POST['texts']) ? wp_unslash($_POST['texts']) : [];
    $photos = isset($_POST['photos']) && is_array($_POST['photos']) ? wp_unslash($_POST['photos']) : [];
    if ($texts) atlas_store_option('atlas_texts', atlas_sanitize_texts($texts));
    if ($photos) atlas_store_option('atlas_photos', atlas_sanitize_photos($photos));
    wp_safe_redirect(add_query_arg(['page' => 'atlas-p-' . $slug, 'updated' => 1], admin_url('admin.php')));
    exit;
});
