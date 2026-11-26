<?php
/**
 * Administration des pages créées à partir d'un modèle :
 * Contenu du site → « + Ajouter une page » (choix du modèle) → formulaire par sections.
 */
if (!defined('ABSPATH')) exit;

/** Pages créées par le gestionnaire (tous statuts sauf corbeille). */
function atlas_model_pages() {
    return get_posts(['post_type' => 'page', 'post_status' => ['publish', 'draft', 'pending', 'private'], 'numberposts' => 100,
        'meta_key' => '_atlas_model', 'orderby' => 'date', 'order' => 'DESC']);
}

/* ---------- Menu ---------- */
add_action('admin_menu', function () {
    add_submenu_page('atlas-contenu', 'Ajouter une page', '+ Ajouter une page', 'edit_pages', 'atlas-nouvelle-page', 'atlas_admin_new_page', 1);
    add_submenu_page('atlas-contenu', 'Modifier la page', 'Modifier la page', 'edit_pages', 'atlas-modele', 'atlas_admin_model_edit');
}, 20);
add_action('admin_head', function () {
    echo '<style>#toplevel_page_atlas-contenu .wp-submenu li:has(> a[href$="page=atlas-modele"]){display:none}</style>';
});
add_filter('submenu_file', function ($sub) {
    return (isset($_GET['page']) && $_GET['page'] === 'atlas-modele') ? 'atlas-contenu' : $sub;
}, 20);
add_action('admin_enqueue_scripts', function () {
    if (isset($_GET['page']) && $_GET['page'] === 'atlas-modele') wp_enqueue_media();
});

/* ---------- Choix du modèle ---------- */
function atlas_admin_new_page() {
    if (function_exists('atlas_contenu_css')) atlas_contenu_css();
    echo '<div class="wrap atlas-wrap"><div class="atlas-head"><h1>Ajouter une page</h1><a class="button-link" style="margin-left:auto" href="' . esc_url(admin_url('admin.php?page=atlas-contenu')) . '">← Contenu du site</a></div><hr class="wp-header-end">';
    echo '<p class="atlas-intro">1. Donnez un nom à la page. 2. Choisissez une mise en page. La page est créée avec un contenu d\'exemple : vous remplacez ensuite les textes et les photos, puis vous la publiez.</p>';
    echo '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">';
    echo '<input type="hidden" name="action" value="atlas_create_page">';
    wp_nonce_field('atlas_create_page', 'atlas_nonce');
    echo '<p><label for="atlas-new-title" style="font-weight:600;display:block;margin-bottom:6px">Nom de la page</label><input type="text" id="atlas-new-title" name="title" required class="regular-text" style="font-size:16px;padding:6px 10px" placeholder="ex. Mammographie, Journée de dépistage, Tarifs…"></p>';
    echo '<style>.atlas-models{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:16px;margin:18px 0}.atlas-model{position:relative;background:#fff;border:2px solid #dcdcde;border-radius:10px;overflow:hidden;cursor:pointer;display:flex;flex-direction:column;transition:border-color .15s,box-shadow .15s}.atlas-model:hover{box-shadow:0 6px 18px rgba(0,0,0,.08)}.atlas-model input{position:absolute;opacity:0}.atlas-model:has(input:checked){border-color:#00B0CC;box-shadow:0 0 0 3px rgba(0,176,204,.2)}.atlas-model svg{border-bottom:1px solid #eee}.atlas-model-body{padding:12px 14px 14px}.atlas-model-body strong{font-size:15px;display:block;margin-bottom:4px}.atlas-model-body span{color:#646970;font-size:12px;line-height:1.45;display:block}</style>';
    echo '<div class="atlas-models">';
    $first = true;
    foreach (atlas_models() as $key => $m) {
        echo '<label class="atlas-model"><input type="radio" name="model" value="' . esc_attr($key) . '"' . ($first ? ' checked' : '') . '>' . atlas_model_preview($key)
            . '<span class="atlas-model-body"><strong>' . esc_html($m['name']) . '</strong><span>' . esc_html($m['desc']) . '</span></span></label>';
        $first = false;
    }
    echo '</div><p><button type="submit" class="button button-primary button-large">Créer la page</button></p></form></div>';
}

add_action('admin_post_atlas_create_page', function () {
    if (!current_user_can('edit_pages')) wp_die('Accès refusé', 403);
    check_admin_referer('atlas_create_page', 'atlas_nonce');
    $model = sanitize_key(wp_unslash($_POST['model'] ?? ''));
    if (!isset(atlas_models()[$model])) $model = 'presentation';
    $title = trim(sanitize_text_field(wp_unslash($_POST['title'] ?? '')));
    if ($title === '') $title = 'Nouvelle page';
    $id = wp_insert_post(['post_type' => 'page', 'post_status' => 'draft', 'post_title' => $title, 'post_content' => '']);
    if (is_wp_error($id) || !$id) wp_die('La page n\'a pas pu être créée.');
    update_post_meta($id, '_atlas_model', $model);
    update_post_meta($id, '_atlas_fields', atlas_model_defaults($model));
    wp_safe_redirect(admin_url('admin.php?page=atlas-modele&id=' . (int) $id . '&created=1'));
    exit;
});

/* ---------- Formulaire d'une page ---------- */
function atlas_model_field_html($name, $type, $label, $value, $id_attr = '') {
    $o = '<div class="atlas-field">';
    if ($type === 'image') {
        $u = $value ? (string) wp_get_attachment_image_url((int) $value, 'medium') : '';
        $o .= '<label>' . esc_html($label) . '</label><div class="atlas-img"><div class="atlas-img-prev"' . ($u ? ' style="background-image:url(\'' . esc_url($u) . '\')"' : '') . '></div>'
            . '<div class="atlas-img-actions"><input type="hidden" class="atlas-img-id" name="' . esc_attr($name) . '" value="' . ($value ? (int) $value : '') . '" data-default="">'
            . '<button type="button" class="button button-primary atlas-img-pick">Choisir une image</button><button type="button" class="button-link atlas-img-reset">Retirer l\'image</button></div></div>';
    } elseif ($type === 'textarea') {
        $o .= '<label>' . esc_html($label) . '</label><textarea name="' . esc_attr($name) . '" rows="4">' . esc_textarea((string) $value) . '</textarea>';
    } elseif ($type === 'url') {
        $o .= '<label>' . esc_html($label) . ' <em>ex. /rendez-vous/, /contact/ ou une adresse complète https://…</em></label><input type="text" name="' . esc_attr($name) . '" value="' . esc_attr((string) $value) . '">';
    } else {
        $o .= '<label>' . esc_html($label) . '</label><input type="text" name="' . esc_attr($name) . '" value="' . esc_attr((string) $value) . '">';
    }
    return $o . '</div>';
}

function atlas_model_row_html($key, $i, $subs, $row) {
    $o = '<div class="atlas-row"><div class="atlas-row-head"><span class="atlas-row-num"></span><span><button type="button" class="button-link atlas-row-up" title="Monter">↑</button> <button type="button" class="button-link atlas-row-down" title="Descendre">↓</button> <button type="button" class="button-link atlas-row-del" style="color:#b32d2e">Supprimer</button></span></div>';
    foreach ($subs as $sk => $sf) {
        $o .= atlas_model_field_html('fields[' . $key . '][' . $i . '][' . $sk . ']', $sf[0], $sf[1], $row[$sk] ?? '');
    }
    return $o . '</div>';
}

function atlas_admin_model_edit() {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $post = $id ? get_post($id) : null;
    $model = $post ? atlas_model_of($id) : '';
    if (!$post || !$model || !current_user_can('edit_page', $id)) { echo '<div class="wrap"><p>Page introuvable.</p></div>'; return; }
    $def = atlas_models()[$model];
    $f = array_merge(atlas_model_defaults($model), atlas_model_fields($id));
    if (function_exists('atlas_contenu_css')) atlas_contenu_css();
    $url = get_permalink($id);
    $preview = get_preview_post_link($id);
    $status = get_post_status($id);
    $choice = get_post_meta($id, '_atlas_menu_choice', true);

    echo '<div class="wrap atlas-wrap"><div class="atlas-head"><h1>' . esc_html(get_the_title($id)) . '</h1>';
    echo '<span class="atlas-badge ' . ($status === 'publish' ? 'is-on' : '') . '">' . ($status === 'publish' ? 'Publiée' : 'Brouillon') . '</span>';
    echo $status === 'publish' ? '<a class="button" href="' . esc_url($url) . '" target="_blank" rel="noopener">Voir la page ↗</a>' : '<a class="button" href="' . esc_url($preview) . '" target="_blank" rel="noopener">Prévisualiser ↗</a>';
    echo '<a class="button-link" style="margin-left:auto" href="' . esc_url(admin_url('admin.php?page=atlas-contenu')) . '">← Contenu du site</a></div><hr class="wp-header-end">';
    if (!empty($_GET['created'])) echo '<div class="notice notice-info"><p><strong>Page créée en brouillon</strong> avec un contenu d\'exemple (modèle « ' . esc_html($def['name']) . ' »). Remplacez les textes et les photos, puis cochez « Publier ».</p></div>';
    if (!empty($_GET['updated'])) echo '<div class="notice notice-success is-dismissible"><p><strong>Modifications enregistrées.</strong>' . ($status === 'publish' ? ' <a href="' . esc_url($url) . '" target="_blank" rel="noopener">Voir la page ↗</a>' : '') . '</p></div>';
    echo '<style>.atlas-badge{background:#f0f0f1;border-radius:999px;padding:3px 10px;font-size:12px;color:#50575e}.atlas-badge.is-on{background:#e6f7ee;color:#1a7f37}.atlas-row{border:1px solid #e2e4e7;border-radius:8px;padding:4px 14px 8px;margin:10px 0;background:#fbfbfc}.atlas-row-head{display:flex;justify-content:space-between;align-items:center;padding-top:8px;font-weight:600;color:#50575e}.atlas-settings{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px}.atlas-settings select,.atlas-settings input[type=text]{width:100%}</style>';

    echo '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '" id="atlas-contenu-form">';
    echo '<input type="hidden" name="action" value="atlas_save_model_page"><input type="hidden" name="id" value="' . (int) $id . '">';
    wp_nonce_field('atlas_save_model_page_' . $id, 'atlas_nonce');

    // Réglages de la page
    echo '<div class="atlas-sec"><h2>Réglages de la page<small>modèle : ' . esc_html($def['name']) . '</small></h2><div class="atlas-fields"><div class="atlas-settings">';
    echo '<div class="atlas-field"><label>Nom de la page (titre affiché)</label><input type="text" name="title" value="' . esc_attr(get_the_title($id)) . '" required></div>';
    echo '<div class="atlas-field"><label>Statut</label><label style="font-weight:400"><input type="checkbox" name="publish" value="1"' . checked($status, 'publish', false) . '> Publier la page (visible par tous)</label><p class="description">Décoché : la page reste en brouillon, visible seulement par vous.</p></div>';
    echo '<div class="atlas-field"><label>Afficher dans le menu principal</label><select name="menu_choice"><option value="">Non, pas dans le menu</option><option value="top"' . selected($choice, 'top', false) . '>Oui, dans le menu (premier niveau)</option>';
    foreach (atlas_menu_parents() as $pid => $ptitle) echo '<option value="' . (int) $pid . '"' . selected((string) $choice, (string) $pid, false) . '>Oui, sous « ' . esc_html($ptitle) . ' »</option>';
    echo '</select><p class="description">Le lien apparaît dans le menu une fois la page publiée.</p></div>';
    echo '<div class="atlas-field"><label>Adresse de la page</label><code style="display:block;padding:8px;word-break:break-all">' . esc_html($status === 'publish' ? $url : home_url('/' . ($post->post_name ?: sanitize_title(get_the_title($id))) . '/')) . '</code></div>';
    echo '</div></div></div>';

    // Sommaire + sections
    echo '<nav class="atlas-toc">';
    $i = 0; foreach ($def['sections'] as $sec) echo '<a href="#atlas-sec-' . ($i++) . '">' . esc_html($sec[0]) . '</a>';
    echo '</nav>';
    $i = 0;
    foreach ($def['sections'] as $sec) {
        echo '<div class="atlas-sec" id="atlas-sec-' . ($i++) . '"><h2>' . esc_html($sec[0]) . '</h2><div class="atlas-fields">';
        foreach ($sec[1] as $k => $fd) {
            if ($fd[0] === 'repeater') {
                $rows = is_array($f[$k] ?? null) ? $f[$k] : [];
                $max = (int) ($fd[4] ?? 50);
                echo '<div class="atlas-field atlas-repeater" data-key="' . esc_attr($k) . '" data-max="' . $max . '"><label>' . esc_html($fd[1]) . ' <em>' . $max . ' maximum</em></label><div class="atlas-rows">';
                foreach (array_values($rows) as $ri => $row) echo atlas_model_row_html($k, $ri, $fd[3], $row);
                echo '</div><template>' . atlas_model_row_html($k, '__i__', $fd[3], []) . '</template>';
                echo '<button type="button" class="button atlas-row-add">+ Ajouter</button></div>';
            } else {
                echo atlas_model_field_html('fields[' . $k . ']', $fd[0], $fd[1], $f[$k] ?? '');
            }
        }
        echo '</div></div>';
    }
    echo '<div class="atlas-savebar"><button type="submit" class="button button-primary button-large">Enregistrer</button><span class="atlas-dirty">Modifications non enregistrées</span>';
    echo '<a href="' . esc_url(wp_nonce_url(admin_url('admin-post.php?action=atlas_delete_model_page&id=' . (int) $id), 'atlas_delete_' . $id)) . '" class="atlas-del" style="margin-left:auto;color:#b32d2e" onclick="return confirm(\'Supprimer cette page ? Elle sera placée dans la corbeille.\')">Supprimer la page</a></div>';
    echo '</form></div>';
    ?>
    <script>
    jQuery(function ($) {
        var form = $('#atlas-contenu-form'), dirty = false;
        function setDirty() { dirty = true; $('.atlas-dirty').show(); }
        function renumber(rep) {
            rep.find('.atlas-rows > .atlas-row').each(function (n) {
                $(this).find('.atlas-row-num').text('N° ' + (n + 1));
                $(this).find('[name]').each(function () { this.name = this.name.replace(/\[(\d+|__i__)\](\[[a-z_]+\])$/, '[' + n + ']$2'); });
            });
            var max = parseInt(rep.data('max'), 10);
            rep.find('.atlas-row-add').prop('disabled', rep.find('.atlas-rows > .atlas-row').length >= max);
        }
        $('.atlas-repeater').each(function () { renumber($(this)); });
        form.on('input change', 'input,textarea,select', setDirty);
        form.on('submit', function () { dirty = false; });
        window.addEventListener('beforeunload', function (e) { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
        form.on('click', '.atlas-row-add', function () {
            var rep = $(this).closest('.atlas-repeater');
            rep.find('.atlas-rows').append($(rep.find('template').html()));
            renumber(rep); setDirty();
        });
        form.on('click', '.atlas-row-del', function () {
            var rep = $(this).closest('.atlas-repeater'); $(this).closest('.atlas-row').remove(); renumber(rep); setDirty();
        });
        form.on('click', '.atlas-row-up, .atlas-row-down', function () {
            var row = $(this).closest('.atlas-row'), rep = $(this).closest('.atlas-repeater');
            if ($(this).hasClass('atlas-row-up')) row.prev('.atlas-row').before(row); else row.next('.atlas-row').after(row);
            renumber(rep); setDirty();
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
            var box = $(this).closest('.atlas-field'); box.find('.atlas-img-id').val(''); box.find('.atlas-img-prev').css('background-image', 'none'); setDirty();
        });
    });
    </script>
    <?php
}

add_action('admin_post_atlas_save_model_page', function () {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id || !current_user_can('edit_page', $id)) wp_die('Accès refusé', 403);
    check_admin_referer('atlas_save_model_page_' . $id, 'atlas_nonce');
    $model = atlas_model_of($id);
    if (!$model) wp_die('Page introuvable.');
    $fields = atlas_model_clean($model, wp_unslash($_POST['fields'] ?? []));
    update_post_meta($id, '_atlas_fields', $fields);
    $title = trim(sanitize_text_field(wp_unslash($_POST['title'] ?? '')));
    $publish = !empty($_POST['publish']) && current_user_can('publish_pages');
    $upd = ['ID' => $id, 'post_status' => $publish ? 'publish' : 'draft'];
    if ($title !== '') $upd['post_title'] = $title;
    wp_update_post($upd);
    $choice = sanitize_text_field(wp_unslash($_POST['menu_choice'] ?? ''));
    if ($choice !== '' && $choice !== 'top') $choice = (string) (int) $choice;
    update_post_meta($id, '_atlas_menu_choice', $choice);
    atlas_sync_menu($id, $choice);
    wp_safe_redirect(admin_url('admin.php?page=atlas-modele&id=' . $id . '&updated=1'));
    exit;
});

add_action('admin_post_atlas_delete_model_page', function () {
    $id = (int) ($_GET['id'] ?? 0);
    if (!$id || !current_user_can('delete_page', $id)) wp_die('Accès refusé', 403);
    check_admin_referer('atlas_delete_' . $id);
    if (atlas_model_of($id)) wp_trash_post($id);
    wp_safe_redirect(admin_url('admin.php?page=atlas-contenu&deleted=1'));
    exit;
});

/** Bloc « Mes pages » affiché en haut de « Contenu du site ». */
function atlas_my_pages_block() {
    $pages = atlas_model_pages();
    echo '<h2 class="atlas-group">Mes pages</h2><div class="atlas-cards">';
    echo '<a class="atlas-card" href="' . esc_url(admin_url('admin.php?page=atlas-nouvelle-page')) . '" style="text-decoration:none;border:2px dashed #00B0CC;justify-content:center;align-items:center;min-height:230px;color:#00B0CC"><span class="dashicons dashicons-plus-alt2" style="font-size:40px;width:40px;height:40px"></span><strong style="font-size:15px;margin-top:10px">Ajouter une page</strong><span style="color:#646970;font-size:12px;margin-top:4px">5 mises en page au choix</span></a>';
    foreach ($pages as $p) {
        $seo = atlas_model_seo($p->ID);
        $thumb = $seo['img'] ? (string) wp_get_attachment_image_url($seo['img'], 'medium') : '';
        $edit = admin_url('admin.php?page=atlas-modele&id=' . $p->ID);
        $pub = $p->post_status === 'publish';
        $in_menu = (bool) get_post_meta($p->ID, '_atlas_menu_item', true);
        $mname = atlas_models()[atlas_model_of($p->ID)]['name'] ?? '';
        echo '<div class="atlas-card"><a href="' . esc_url($edit) . '" class="atlas-card-img"' . ($thumb ? ' style="background-image:url(\'' . esc_url($thumb) . '\')"' : '') . '>' . ($thumb ? '' : '<span class="dashicons dashicons-media-document"></span>') . '</a>'
            . '<div class="atlas-card-body"><h3><a href="' . esc_url($edit) . '" style="text-decoration:none;color:inherit">' . esc_html(get_the_title($p)) . '</a></h3>'
            . '<span class="atlas-card-meta">' . esc_html($mname) . ' · ' . ($pub ? '<span style="color:#1a7f37">Publiée</span>' : 'Brouillon') . ($in_menu ? ' · Dans le menu' : '') . '</span>'
            . '<div class="atlas-card-actions"><a class="button button-primary" href="' . esc_url($edit) . '">Modifier</a>'
            . ($pub ? '<a class="button" href="' . esc_url(get_permalink($p)) . '" target="_blank" rel="noopener">Voir ↗</a>' : '') . '</div></div></div>';
    }
    echo '</div>';
}
