<?php
/**
 * Pages créées par le gestionnaire à partir de 5 modèles de mise en page.
 * Contenu du site → « + Ajouter une page » : choix du modèle, puis textes / photos par section,
 * statut (publiée / brouillon) et affichage dans le menu principal.
 * Les contenus sont stockés dans la méta « _atlas_fields » de la page, le modèle dans « _atlas_model ».
 */
if (!defined('ABSPATH')) exit;

/* =========================================================================
 * 1. Définition des modèles
 * Champ : [type, libellé, valeur d'exemple]  — types : text, textarea, image, url, repeater
 * Répéteur : ['repeater', libellé, [lignes d'exemple], [sous-champs], max]
 * ========================================================================= */
function atlas_models() {
    $rdv = '/rendez-vous/';
    return [
        'presentation' => [
            'name' => 'Présentation',
            'desc' => 'Photo et texte côte à côte, puis des cartes « points forts ». Idéal pour présenter un service, un partenaire ou une activité.',
            'sections' => [
                'banner' => ['Bandeau du haut', [
                    'banner_img' => ['image', 'Photo de fond du bandeau (facultatif)', 0],
                ]],
                'intro' => ['Présentation', [
                    'image'    => ['image', 'Photo', 0],
                    'eyebrow'  => ['text', 'Sur-titre', 'Présentation'],
                    'title'    => ['text', 'Titre', 'Un accompagnement pensé pour vous'],
                    'text'     => ['textarea', 'Texte principal', 'Présentez ici ce que propose cette page : à qui elle s\'adresse, ce que le patient peut attendre et pourquoi venir au Centre Médical Atlas.'],
                    'text2'    => ['textarea', 'Texte complémentaire (facultatif)', ''],
                    'btn'      => ['text', 'Texte du bouton', 'Prendre rendez-vous'],
                    'btn_url'  => ['url', 'Lien du bouton', $rdv],
                ]],
                'cards' => ['Points forts', [
                    'cards_eyebrow' => ['text', 'Sur-titre', 'Nos engagements'],
                    'cards_title'   => ['text', 'Titre', 'Ce qui fait la différence'],
                    'items'   => ['repeater', 'Cartes', [
                        ['title' => 'Écoute', 'text' => 'Chaque patient est reçu avec attention.'],
                        ['title' => 'Expertise', 'text' => 'Une équipe médicale expérimentée.'],
                        ['title' => 'Proximité', 'text' => 'Un centre accessible au cœur de Dakar.'],
                    ], ['title' => ['text', 'Titre'], 'text' => ['textarea', 'Texte']], 6],
                ]],
            ],
        ],
        'service' => [
            'name' => 'Service / Examen',
            'desc' => 'Texte et encadré « points clés », déroulement en étapes avec photo, puis questions fréquentes. Idéal pour un nouvel examen ou une nouvelle consultation.',
            'sections' => [
                'banner' => ['Bandeau du haut', [
                    'banner_img' => ['image', 'Photo de fond du bandeau (facultatif)', 0],
                ]],
                'intro' => ['Introduction', [
                    'eyebrow'   => ['text', 'Sur-titre', 'L\'examen'],
                    'title'     => ['text', 'Titre', 'À quoi sert cet examen ?'],
                    'text'      => ['textarea', 'Texte', 'Expliquez simplement l\'examen ou le service : son objectif, pour qui il est indiqué et ce qu\'il permet de détecter ou de suivre.'],
                    'box_title' => ['text', 'Titre de l\'encadré', 'Points clés'],
                    'points'    => ['repeater', 'Points clés', [
                        ['text' => 'Examen rapide et sans douleur'], ['text' => 'Résultats expliqués par le médecin'], ['text' => 'Sur rendez-vous, du lundi au samedi'],
                    ], ['text' => ['text', 'Point']], 8],
                ]],
                'steps' => ['Déroulement', [
                    'steps_eyebrow' => ['text', 'Sur-titre', 'Comment ça se passe'],
                    'steps_title'   => ['text', 'Titre', 'Le déroulement, étape par étape'],
                    'steps_image'   => ['image', 'Photo', 0],
                    'items'   => ['repeater', 'Étapes', [
                        ['title' => 'Avant l\'examen', 'text' => 'Les consignes de préparation vous sont données à la prise de rendez-vous.'],
                        ['title' => 'Pendant l\'examen', 'text' => 'Le médecin vous explique chaque geste.'],
                        ['title' => 'Après l\'examen', 'text' => 'Vous repartez avec vos résultats ou un rendez-vous de suivi.'],
                    ], ['title' => ['text', 'Titre de l\'étape'], 'text' => ['textarea', 'Texte']], 6],
                ]],
                'faq' => ['Questions fréquentes (facultatif)', [
                    'faq_title' => ['text', 'Titre', 'Questions fréquentes'],
                    'faq_items' => ['repeater', 'Questions', [
                        ['q' => 'Faut-il être à jeun ?', 'a' => 'Cela dépend de l\'examen : la consigne vous est donnée au moment du rendez-vous.'],
                    ], ['q' => ['text', 'Question'], 'a' => ['textarea', 'Réponse']], 12],
                ]],
            ],
        ],
        'galerie' => [
            'name' => 'Galerie photos',
            'desc' => 'Une introduction puis une mosaïque de photos avec légendes. Idéal pour montrer les locaux, un nouvel équipement ou un événement passé.',
            'sections' => [
                'banner' => ['Bandeau du haut', [
                    'banner_img' => ['image', 'Photo de fond du bandeau (facultatif)', 0],
                ]],
                'intro' => ['Introduction', [
                    'eyebrow' => ['text', 'Sur-titre', 'Galerie'],
                    'title'   => ['text', 'Titre', 'Découvrez nos espaces'],
                    'text'    => ['textarea', 'Texte (facultatif)', 'Un cadre moderne et chaleureux, pensé pour le confort de chaque patient.'],
                ]],
                'photos' => ['Photos', [
                    'items' => ['repeater', 'Photos', [
                        ['img' => 0, 'caption' => 'Accueil'], ['img' => 0, 'caption' => 'Salle d\'attente'], ['img' => 0, 'caption' => 'Cabinet'],
                        ['img' => 0, 'caption' => 'Équipement'], ['img' => 0, 'caption' => ''],
                    ], ['img' => ['image', 'Photo'], 'caption' => ['text', 'Légende (facultatif)']], 16],
                ]],
            ],
        ],
        'evenement' => [
            'name' => 'Événement / Campagne',
            'desc' => 'Grand bandeau photo avec la date, cartes d\'infos pratiques, description et bouton. Idéal pour une journée de dépistage ou une campagne.',
            'sections' => [
                'banner' => ['Bandeau du haut', [
                    'banner_img' => ['image', 'Grande photo du bandeau', 0],
                    'date'       => ['text', 'Date affichée sous le titre', 'Samedi 14 mars, de 9h à 14h'],
                ]],
                'infos' => ['Infos pratiques', [
                    'items' => ['repeater', 'Cartes', [
                        ['title' => 'Quand ?', 'text' => 'Samedi 14 mars, de 9h à 14h'],
                        ['title' => 'Où ?', 'text' => 'Centre Médical Atlas, Liberté 6, Dakar'],
                        ['title' => 'Pour qui ?', 'text' => 'Ouvert à tous, sans rendez-vous'],
                    ], ['title' => ['text', 'Titre'], 'text' => ['textarea', 'Texte']], 4],
                ]],
                'details' => ['Description', [
                    'image'   => ['image', 'Photo', 0],
                    'eyebrow' => ['text', 'Sur-titre', 'L\'événement'],
                    'title'   => ['text', 'Titre', 'Une journée dédiée à votre santé'],
                    'text'    => ['textarea', 'Texte', 'Décrivez l\'événement : son objectif, ce qui sera proposé sur place et comment y participer.'],
                    'btn'     => ['text', 'Texte du bouton', 'Je m\'inscris'],
                    'btn_url' => ['url', 'Lien du bouton', $rdv],
                ]],
            ],
        ],
        'faq' => [
            'name' => 'Questions fréquentes',
            'desc' => 'Introduction, liste de questions dépliables et encadré de contact. Idéal pour « Préparer son examen », « Tarifs et assurances »…',
            'sections' => [
                'banner' => ['Bandeau du haut', [
                    'banner_img' => ['image', 'Photo de fond du bandeau (facultatif)', 0],
                ]],
                'intro' => ['Introduction', [
                    'title' => ['text', 'Titre', 'Vos questions, nos réponses'],
                    'text'  => ['textarea', 'Texte', 'Retrouvez ici les réponses aux questions les plus fréquentes de nos patients.'],
                ]],
                'questions' => ['Questions', [
                    'items' => ['repeater', 'Questions', [
                        ['q' => 'Comment prendre rendez-vous ?', 'a' => 'Par téléphone, par WhatsApp ou avec le formulaire en ligne. Notre équipe vous rappelle pour confirmer.'],
                        ['q' => 'Quels sont vos horaires ?', 'a' => 'Du lundi au vendredi de 9h à 18h, et le samedi de 9h à 14h.'],
                        ['q' => 'Que dois-je apporter ?', 'a' => 'Votre pièce d\'identité, vos anciens examens et votre ordonnance si vous en avez une.'],
                    ], ['q' => ['text', 'Question'], 'a' => ['textarea', 'Réponse']], 30],
                ]],
                'contact' => ['Encadré « Une autre question ? »', [
                    'contact_title' => ['text', 'Titre', 'Vous ne trouvez pas votre réponse ?'],
                    'contact_text'  => ['textarea', 'Texte', 'Notre secrétariat vous répond du lundi au samedi.'],
                    'btn'     => ['text', 'Texte du bouton', 'Nous contacter'],
                    'btn_url' => ['url', 'Lien du bouton', '/contact/'],
                ]],
            ],
        ],
    ];
}

/** Aperçu schématique (SVG) de chaque modèle, affiché dans le choix du modèle. */
function atlas_model_preview($model) {
    $c = '#00B0CC'; $d = '#2C333A'; $g = '#dfe7ea'; $l = '#eef3f5';
    $bar = function ($x, $y, $w, $h = 6, $col = '#c9d3d8') { return "<rect x='$x' y='$y' width='$w' height='$h' rx='3' fill='$col'/>"; };
    $s = "<rect width='240' height='26' fill='$d'/>" . $bar(80, 10, 80, 6, '#ffffff');
    switch ($model) {
        case 'presentation':
            $s .= "<rect x='14' y='38' width='92' height='70' rx='6' fill='$g'/>" . $bar(118, 44, 50, 5, $c) . $bar(118, 56, 100, 8, $d) . $bar(118, 72, 108) . $bar(118, 82, 96) . "<rect x='118' y='94' width='46' height='12' rx='6' fill='$c'/>";
            for ($i = 0; $i < 3; $i++) $s .= "<rect x='" . (14 + $i * 72) . "' y='120' width='66' height='34' rx='5' fill='$l'/>" . $bar(24 + $i * 72, 130, 30, 5, $d) . $bar(24 + $i * 72, 140, 46);
            break;
        case 'service':
            $s .= $bar(14, 40, 40, 5, $c) . $bar(14, 52, 110, 8, $d) . $bar(14, 68, 120) . $bar(14, 78, 100) . "<rect x='146' y='38' width='80' height='50' rx='5' fill='$d'/>" . $bar(156, 48, 40, 5, $c) . $bar(156, 60, 56, 4, '#ffffff') . $bar(156, 70, 50, 4, '#ffffff');
            for ($i = 0; $i < 3; $i++) $s .= "<circle cx='22' cy='" . (106 + $i * 18) . "' r='6' fill='$c'/>" . $bar(34, 103 + $i * 18, 80);
            $s .= "<rect x='146' y='98' width='80' height='56' rx='5' fill='$g'/>";
            break;
        case 'galerie':
            $s .= $bar(90, 38, 60, 8, $d) . $bar(70, 52, 100);
            $s .= "<rect x='14' y='66' width='104' height='88' rx='5' fill='$g'/><rect x='124' y='66' width='50' height='41' rx='5' fill='$g'/><rect x='180' y='66' width='46' height='41' rx='5' fill='$g'/><rect x='124' y='113' width='50' height='41' rx='5' fill='$g'/><rect x='180' y='113' width='46' height='41' rx='5' fill='$g'/>";
            break;
        case 'evenement':
            $s = "<rect width='240' height='60' fill='#6b8f97'/>" . $bar(70, 18, 100, 9, '#ffffff') . "<rect x='90' y='34' width='60' height='12' rx='6' fill='$c'/>";
            for ($i = 0; $i < 3; $i++) $s .= "<rect x='" . (14 + $i * 72) . "' y='70' width='66' height='30' rx='5' fill='#ffffff' stroke='$g'/><rect x='" . (14 + $i * 72) . "' y='70' width='66' height='4' fill='$c'/>" . $bar(22 + $i * 72, 84, 40, 5, $d);
            $s .= "<rect x='14' y='110' width='90' height='46' rx='5' fill='$g'/>" . $bar(116, 116, 90, 8, $d) . $bar(116, 130, 108) . "<rect x='116' y='142' width='46' height='12' rx='6' fill='$c'/>";
            break;
        case 'faq':
            $s .= $bar(80, 38, 80, 8, $d) . $bar(60, 52, 120);
            for ($i = 0; $i < 4; $i++) $s .= $bar(30, 70 + $i * 14, 150, 6, '#9aa7ad') . "<text x='206' y='" . (76 + $i * 14) . "' font-size='10' fill='$c'>+</text><rect x='30' y='" . (79 + $i * 14) . "' width='180' height='1' fill='$g'/>";
            $s .= "<rect x='40' y='130' width='160' height='26' rx='5' fill='$d'/><rect x='150' y='137' width='40' height='12' rx='6' fill='$c'/>";
            break;
    }
    return "<svg viewBox='0 0 240 160' xmlns='http://www.w3.org/2000/svg' style='display:block;width:100%;height:auto;background:#fff'>$s</svg>";
}

/* =========================================================================
 * 2. Données d'une page
 * ========================================================================= */
function atlas_model_of($post_id) {
    $m = get_post_meta($post_id, '_atlas_model', true);
    return ($m && isset(atlas_models()[$m])) ? $m : '';
}

/** Valeurs d'exemple d'un modèle (utilisées à la création). */
function atlas_model_defaults($model) {
    $out = [];
    foreach (atlas_models()[$model]['sections'] as $sec) {
        foreach ($sec[1] as $k => $f) $out[$k] = $f[2];
    }
    return $out;
}

function atlas_model_fields($post_id) {
    $f = get_post_meta($post_id, '_atlas_fields', true);
    return is_array($f) ? $f : [];
}

/** Nettoie les valeurs envoyées par le formulaire selon le type de chaque champ. */
function atlas_model_clean($model, $in) {
    $in = is_array($in) ? $in : [];
    $clean_one = function ($type, $v) {
        if (is_array($v)) return '';
        $v = (string) $v;
        switch ($type) {
            case 'textarea': return trim(sanitize_textarea_field($v));
            case 'image':    $id = (int) $v; return ($id > 0 && wp_attachment_is_image($id)) ? $id : 0;
            case 'url':      $v = trim($v); return ($v !== '' && $v[0] === '/') ? '/' . ltrim(sanitize_text_field($v), '/') : esc_url_raw($v);
            default:         return trim(sanitize_text_field($v));
        }
    };
    $out = [];
    foreach (atlas_models()[$model]['sections'] as $sec) {
        foreach ($sec[1] as $k => $f) {
            if ($f[0] === 'repeater') {
                $rows = [];
                foreach ((array) ($in[$k] ?? []) as $row) {
                    if (!is_array($row)) continue;
                    $r = []; $empty = true;
                    foreach ($f[3] as $sk => $sf) {
                        $r[$sk] = $clean_one($sf[0], $row[$sk] ?? '');
                        if ($r[$sk] !== '' && $r[$sk] !== 0) $empty = false;
                    }
                    if (!$empty) $rows[] = $r;
                    if (count($rows) >= (int) ($f[4] ?? 50)) break;
                }
                $out[$k] = $rows;
            } else {
                $out[$k] = $clean_one($f[0], $in[$k] ?? '');
            }
        }
    }
    return $out;
}

/* =========================================================================
 * 3. Affichage sur le site
 * ========================================================================= */
add_filter('template_include', function ($template) {
    if (is_page() && atlas_model_of(get_queried_object_id())) {
        $t = locate_template('modele.php');
        if ($t) return $t;
    }
    return $template;
}, 100000);

function atlas_mv($f, $k) { return isset($f[$k]) && !is_array($f[$k]) ? (string) $f[$k] : ''; }
function atlas_mimg($id, $size = 'large') { $id = (int) $id; return $id ? (string) wp_get_attachment_image_url($id, $size) : ''; }
function atlas_murl($u) { $u = (string) $u; return ($u !== '' && $u[0] === '/') ? home_url($u) : $u; }
function atlas_mtext($t) { return wpautop(esc_html($t)); }

/** Bloc photo (ou emplacement gris si aucune photo n'est choisie). */
function atlas_mphoto($id, $class, $label = 'Photo') {
    $u = atlas_mimg($id);
    if ($u) return '<div class="' . esc_attr($class) . ' photo-placeholder has-photo" style="background-image:url(\'' . esc_url($u) . '\')" role="img" aria-label="' . esc_attr($label) . '"></div>';
    return '<div class="' . esc_attr($class) . ' photo-placeholder">' . esc_html($label) . '</div>';
}

function atlas_render_model($post) {
    $model = atlas_model_of($post->ID);
    $f = atlas_model_fields($post->ID);
    $title = get_the_title($post);
    $bg = atlas_mimg($f['banner_img'] ?? 0, 'full');

    // Bandeau commun
    echo '<section class="banner_component' . ($bg ? ' mp_has-bg' : '') . ($model === 'evenement' ? ' mp_banner-event' : '') . '"' . ($bg ? ' style="background-image:url(\'' . esc_url($bg) . '\')"' : '') . '>';
    echo '<div class="padding-global"><div class="container-large banner_container">';
    echo '<h1 class="heading-style-h1" style="font-size:clamp(2.2rem,4vw,3.2rem)">' . esc_html($title) . '</h1>';
    if ($model === 'evenement' && atlas_mv($f, 'date') !== '') echo '<span class="mp_date">' . esc_html(atlas_mv($f, 'date')) . '</span>';
    echo '<div class="breadcrumb"><a href="' . esc_url(home_url('/')) . '">Accueil</a><span>›</span><span>' . esc_html($title) . '</span></div>';
    echo '</div></div></section>';

    $btn = function ($label, $url, $class = 'button is-primary') {
        if ($label === '') return '';
        return '<div><a href="' . esc_url(atlas_murl($url ?: '/rendez-vous/')) . '" class="' . esc_attr($class) . '">' . esc_html($label) . '</a></div>';
    };
    $head = function ($eyebrow, $title, $text = '', $center = true) {
        if ($eyebrow === '' && $title === '' && $text === '') return '';
        $o = '<div class="' . ($center ? 'text-align-center max-width-medium margin-auto ' : '') . 'margin-bottom-large">';
        if ($eyebrow !== '') $o .= '<span class="text-style-eyebrow">' . esc_html($eyebrow) . '</span>';
        if ($title !== '') $o .= '<h2 class="heading-style-h2">' . esc_html($title) . '</h2>';
        if ($text !== '') $o .= '<div class="text-style-muted text-size-medium">' . atlas_mtext($text) . '</div>';
        return $o . '</div>';
    };
    $open = function ($extra = '') { return '<section class="padding-section-large ' . $extra . '"><div class="padding-global"><div class="container-large">'; };
    $close = '</div></div></section>';

    switch ($model) {
        case 'presentation':
            echo '<section class="padding-section-large"><div class="padding-global"><div class="container-large about_grid">';
            echo '<div class="about_visual reveal">' . atlas_mphoto($f['image'] ?? 0, 'about_image-main', 'Photo') . '</div>';
            echo '<div class="about_content reveal">';
            if (atlas_mv($f, 'eyebrow') !== '') echo '<span class="text-style-eyebrow">' . esc_html(atlas_mv($f, 'eyebrow')) . '</span>';
            if (atlas_mv($f, 'title') !== '') echo '<h2 class="heading-style-h2">' . esc_html(atlas_mv($f, 'title')) . '</h2>';
            if (atlas_mv($f, 'text') !== '') echo '<div class="text-style-muted text-size-medium">' . atlas_mtext(atlas_mv($f, 'text')) . '</div>';
            if (atlas_mv($f, 'text2') !== '') echo '<div class="text-style-muted">' . atlas_mtext(atlas_mv($f, 'text2')) . '</div>';
            echo $btn(atlas_mv($f, 'btn'), atlas_mv($f, 'btn_url'));
            echo '</div></div></div></section>';
            if (!empty($f['items'])) {
                echo $open('background-color-light') . $head(atlas_mv($f, 'cards_eyebrow'), atlas_mv($f, 'cards_title'));
                echo '<div class="mp_cards">';
                $icons = ['i-chat', 'i-stetho', 'i-target', 'i-scan', 'i-calendar', 'i-check'];
                foreach ($f['items'] as $i => $it) {
                    echo '<div class="value_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#' . $icons[$i % 6] . '"/></svg></span>'
                        . '<h3 class="heading-style-h4">' . esc_html($it['title'] ?? '') . '</h3><p class="text-size-small text-style-muted">' . esc_html($it['text'] ?? '') . '</p></div>';
                }
                echo '</div>' . $close;
            }
            break;

        case 'service':
            echo '<section class="padding-section-large"><div class="padding-global"><div class="container-large split_grid">';
            echo '<div class="reveal">';
            if (atlas_mv($f, 'eyebrow') !== '') echo '<span class="text-style-eyebrow">' . esc_html(atlas_mv($f, 'eyebrow')) . '</span>';
            if (atlas_mv($f, 'title') !== '') echo '<h2 class="heading-style-h2 margin-bottom-medium">' . esc_html(atlas_mv($f, 'title')) . '</h2>';
            echo '<div class="text-style-muted text-size-medium">' . atlas_mtext(atlas_mv($f, 'text')) . '</div></div>';
            if (!empty($f['points'])) {
                echo '<div class="reveal background-color-dark" style="padding:2.5rem;border-radius:var(--radius)">';
                if (atlas_mv($f, 'box_title') !== '') echo '<span class="text-style-eyebrow">' . esc_html(atlas_mv($f, 'box_title')) . '</span>';
                echo '<ul class="list-check" style="margin-top:1rem">';
                foreach ($f['points'] as $p) echo '<li>' . esc_html($p['text'] ?? '') . '</li>';
                echo '</ul></div>';
            }
            echo '</div></div></section>';
            if (!empty($f['items'])) {
                echo '<section class="padding-section-large background-color-tint"><div class="padding-global"><div class="container-large about_grid">';
                echo '<div class="reveal">';
                if (atlas_mv($f, 'steps_eyebrow') !== '') echo '<span class="text-style-eyebrow">' . esc_html(atlas_mv($f, 'steps_eyebrow')) . '</span>';
                if (atlas_mv($f, 'steps_title') !== '') echo '<h2 class="heading-style-h2 margin-bottom-medium">' . esc_html(atlas_mv($f, 'steps_title')) . '</h2>';
                echo '<ol class="steps2">';
                $icons = ['i-calendar', 'i-stetho', 'i-check', 'i-phone', 'i-scan', 'i-chat'];
                foreach ($f['items'] as $i => $st) {
                    echo '<li><span class="step_icon"><svg><use href="#' . $icons[$i % 6] . '"/></svg></span><div><strong>' . esc_html($st['title'] ?? '') . '</strong><p class="text-size-small text-style-muted">' . esc_html($st['text'] ?? '') . '</p></div></li>';
                }
                echo '</ol></div><div class="about_visual reveal">' . atlas_mphoto($f['steps_image'] ?? 0, 'about_image-main', 'Photo') . '</div>';
                echo '</div></div></section>';
            }
            if (!empty($f['faq_items'])) {
                echo $open() . '<div class="max-width-medium margin-auto">' . $head('', atlas_mv($f, 'faq_title'), '') . '<div class="faq">';
                foreach ($f['faq_items'] as $q) echo '<details><summary>' . esc_html($q['q'] ?? '') . '</summary><p>' . esc_html($q['a'] ?? '') . '</p></details>';
                echo '</div></div>' . $close;
            }
            break;

        case 'galerie':
            echo $open() . $head(atlas_mv($f, 'eyebrow'), atlas_mv($f, 'title'), atlas_mv($f, 'text'));
            $items = $f['items'] ?? [];
            if ($items) {
                echo '<div class="gallery_grid mp_gallery">';
                foreach ($items as $i => $it) {
                    $cls = 'gallery_item reveal' . ($i === 0 ? ' is-wide is-tall' : '');
                    $u = atlas_mimg($it['img'] ?? 0);
                    $cap = (string) ($it['caption'] ?? '');
                    echo '<figure class="' . $cls . ' photo-placeholder' . ($u ? ' has-photo" style="background-image:url(\'' . esc_url($u) . '\')"' : '"') . '>'
                        . ($cap !== '' ? '<figcaption class="mp_caption">' . esc_html($cap) . '</figcaption>' : ($u ? '' : 'Photo')) . '</figure>';
                }
                echo '</div>';
            }
            echo $close;
            break;

        case 'evenement':
            if (!empty($f['items'])) {
                echo '<section class="mp_infos"><div class="padding-global"><div class="container-large"><div class="mp_cards">';
                foreach ($f['items'] as $it) echo '<div class="why_card reveal"><strong class="heading-style-h4">' . esc_html($it['title'] ?? '') . '</strong><p class="text-style-muted">' . esc_html($it['text'] ?? '') . '</p></div>';
                echo '</div></div></div></section>';
            }
            echo '<section class="padding-section-large"><div class="padding-global"><div class="container-large about_grid">';
            echo '<div class="about_visual reveal">' . atlas_mphoto($f['image'] ?? 0, 'about_image-main', 'Photo') . '</div><div class="about_content reveal">';
            if (atlas_mv($f, 'eyebrow') !== '') echo '<span class="text-style-eyebrow">' . esc_html(atlas_mv($f, 'eyebrow')) . '</span>';
            if (atlas_mv($f, 'title') !== '') echo '<h2 class="heading-style-h2">' . esc_html(atlas_mv($f, 'title')) . '</h2>';
            echo '<div class="text-style-muted text-size-medium">' . atlas_mtext(atlas_mv($f, 'text')) . '</div>';
            echo $btn(atlas_mv($f, 'btn'), atlas_mv($f, 'btn_url')) . '</div></div></div></section>';
            break;

        case 'faq':
            echo $open() . '<div class="max-width-medium margin-auto">' . $head('', atlas_mv($f, 'title'), atlas_mv($f, 'text'));
            if (!empty($f['items'])) {
                echo '<div class="faq">';
                foreach ($f['items'] as $q) echo '<details><summary>' . esc_html($q['q'] ?? '') . '</summary><p>' . esc_html($q['a'] ?? '') . '</p></details>';
                echo '</div>';
            }
            if (atlas_mv($f, 'contact_title') !== '' || atlas_mv($f, 'btn') !== '') {
                echo '<div class="mp_contact reveal"><div><h3 class="heading-style-h4">' . esc_html(atlas_mv($f, 'contact_title')) . '</h3><p>' . esc_html(atlas_mv($f, 'contact_text')) . '</p></div>'
                    . $btn(atlas_mv($f, 'btn'), atlas_mv($f, 'btn_url')) . '</div>';
            }
            echo '</div>' . $close;
            break;
    }
}

/* =========================================================================
 * 4. Menu principal
 * ========================================================================= */
function atlas_primary_menu_id() {
    $loc = get_nav_menu_locations();
    if (!empty($loc['primary'])) return (int) $loc['primary'];
    $m = wp_get_nav_menu_object('Menu principal');
    return $m ? (int) $m->term_id : 0;
}

/** Éléments de premier niveau du menu (pour « afficher sous … »). */
function atlas_menu_parents() {
    $id = atlas_primary_menu_id();
    if (!$id) return [];
    $out = [];
    foreach ((array) wp_get_nav_menu_items($id) as $it) {
        if ((int) $it->menu_item_parent === 0) $out[(int) $it->ID] = $it->title;
    }
    return $out;
}

/** Place (ou retire) la page dans le menu principal. $choice : '' (pas dans le menu), 'top', ou l'ID d'un élément parent. */
function atlas_sync_menu($post_id, $choice) {
    $menu = atlas_primary_menu_id();
    $item = (int) get_post_meta($post_id, '_atlas_menu_item', true);
    if ($item && !get_post($item)) $item = 0;
    $show = $menu && $choice !== '' && get_post_status($post_id) === 'publish';
    if (!$show) {
        if ($item) wp_delete_post($item, true);
        delete_post_meta($post_id, '_atlas_menu_item');
        return;
    }
    $parent = $choice === 'top' ? 0 : (int) $choice;
    if ($parent && !isset(atlas_menu_parents()[$parent])) $parent = 0;
    $args = [
        'menu-item-object-id' => $post_id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type',
        'menu-item-title' => get_the_title($post_id), 'menu-item-status' => 'publish', 'menu-item-parent-id' => $parent,
    ];
    if (!$item) {
        // nouvel élément : placé avant « Contact » s'il existe, sinon à la fin
        $items = (array) wp_get_nav_menu_items($menu);
        $pos = count($items) + 1;
        if (!$parent) foreach ($items as $it) { if ((int) $it->menu_item_parent === 0 && stripos($it->title, 'contact') !== false) { $pos = (int) $it->menu_order; break; } }
        $args['menu-item-position'] = $pos;
        if ($pos <= count($items)) foreach ($items as $it) { if ((int) $it->menu_order >= $pos) wp_update_post(['ID' => $it->ID, 'menu_order' => (int) $it->menu_order + 1]); }
    }
    $new = wp_update_nav_menu_item($menu, $item, $args);
    if (!is_wp_error($new)) update_post_meta($post_id, '_atlas_menu_item', (int) $new);
}

// Page supprimée : on retire aussi son lien du menu
add_action('wp_trash_post', function ($post_id) {
    $item = (int) get_post_meta($post_id, '_atlas_menu_item', true);
    if ($item) { wp_delete_post($item, true); delete_post_meta($post_id, '_atlas_menu_item'); }
});

/* =========================================================================
 * 5. SEO des pages créées
 * ========================================================================= */
function atlas_model_seo($post_id) {
    $f = atlas_model_fields($post_id);
    $desc = '';
    foreach (['text', 'contact_text'] as $k) { if (atlas_mv($f, $k) !== '') { $desc = atlas_mv($f, $k); break; } }
    $desc = wp_html_excerpt($desc, 155, '…');
    $img = 0;
    foreach (['banner_img', 'image', 'steps_image'] as $k) { if (!empty($f[$k])) { $img = (int) $f[$k]; break; } }
    if (!$img && !empty($f['items'][0]['img'])) $img = (int) $f['items'][0]['img'];
    return ['title' => get_the_title($post_id) . ' | Centre Médical Atlas', 'desc' => $desc, 'img' => $img];
}
