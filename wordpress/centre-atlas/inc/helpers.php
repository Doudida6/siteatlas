<?php
/**
 * Aides communes : coordonnées, photos et textes modifiables depuis l'administration.
 */
if (!defined('ABSPATH')) exit;

/** Registre généré par le script de build : pages, textes par défaut, emplacements photo. */
function atlas_registry() {
    static $r = null;
    if ($r === null) { $r = require get_theme_file_path('inc/registry.php'); }
    return $r;
}

/* ---------- Coordonnées du centre (Centre Atlas → Coordonnées) ---------- */
function atlas_contact_defaults() {
    return [
        'tel_fixe'   => '33 867 86 46',
        'tel_mobile' => '78 831 60 60',
        'email'      => 'centreatlasmedical@gmail.com',
        'rdv_email'  => 'centreatlasmedical@gmail.com',
        'adresse'    => 'Dakar, Sénégal (adresse à compléter)',
        'horaires'   => 'À compléter',
        'facebook'   => '',
        'instagram'  => '',
    ];
}
function atlas_opt($key) {
    static $o = null;
    if ($o === null) {
        $saved = get_option('atlas_contact', []);
        $o = array_merge(atlas_contact_defaults(), is_array($saved) ? $saved : []);
    }
    return isset($o[$key]) ? trim((string) $o[$key]) : '';
}
/** Numéro au format international pour les liens tel: (indicatif +221 ajouté si absent). */
function atlas_tel($key) {
    $raw = atlas_opt($key);
    $digits = preg_replace('/\D+/', '', $raw);
    if ($digits === '') return '';
    if (strpos($raw, '+') === 0) return '+' . $digits;
    if (strpos($digits, '221') === 0 && strlen($digits) > 9) return '+' . $digits;
    return '+221' . ltrim($digits, '0');
}
/** Numéro WhatsApp : chiffres seulement, avec l'indicatif du pays. */
function atlas_wa() { return ltrim(atlas_tel('tel_mobile'), '+'); }
function atlas_addr() { return atlas_opt('adresse'); }
/** Adresse utilisable pour Google Maps (sans la mention « à compléter »). */
function atlas_map_query() {
    $a = trim(preg_replace('/\s*\([^)]*compléter[^)]*\)/u', '', atlas_opt('adresse')));
    return $a !== '' ? $a : 'Dakar, Sénégal';
}
function atlas_hours() { return nl2br(esc_html(atlas_opt('horaires'))); }

/** Remplace les repères {tel_fixe}, {tel_mobile}, {email}, {adresse}, {horaires} par les coordonnées saisies. */
function atlas_expand($text) {
    if (strpos($text, '{') === false) return $text;
    return strtr($text, [
        '{tel_fixe}'   => atlas_opt('tel_fixe'),
        '{tel_mobile}' => atlas_opt('tel_mobile'),
        '{email}'      => atlas_opt('email'),
        '{adresse}'    => atlas_opt('adresse'),
        '{horaires}'   => atlas_opt('horaires'),
    ]);
}

/* ---------- Photos du site (Centre Atlas → Photos du site) ---------- */
function atlas_photo_id($key) {
    static $p = null;
    if ($p === null) { $p = get_option('atlas_photos', []); if (!is_array($p)) $p = []; }
    return isset($p[$key]) ? (int) $p[$key] : 0;
}
function atlas_photo_url($key, $size = 'large') {
    $id = atlas_photo_id($key);
    if (!$id) return '';
    $u = wp_get_attachment_image_url($id, $size);
    return $u ? (string) $u : '';
}
/** Classe ajoutée à l'emplacement quand une photo est choisie. */
function atlas_photo_class($key) { return atlas_photo_url($key) ? ' has-photo' : ''; }
/** Attributs (image de fond) ajoutés à l'emplacement quand une photo est choisie. */
function atlas_photo_attr($key, $label = '') {
    $u = atlas_photo_url($key);
    if (!$u) return '';
    return ' style="background-image:url(\'' . esc_url($u) . '\')" role="img" aria-label="' . esc_attr($label) . '"';
}
/** Texte indicatif de l'emplacement : n'apparaît que tant qu'aucune photo n'est choisie. */
function atlas_photo_label($key, $label) {
    if (!atlas_photo_url($key)) echo esc_html($label);
}

/* ---------- Textes du site (Centre Atlas → Textes du site) ---------- */
function atlas_text($key) {
    static $o = null;
    if ($o === null) { $o = get_option('atlas_texts', []); if (!is_array($o)) $o = []; }
    $reg = atlas_registry();
    $v = (isset($o[$key]) && $o[$key] !== '') ? $o[$key] : (isset($reg['texts'][$key]) ? $reg['texts'][$key][1] : '');
    return atlas_expand($v);
}
function atlas_t($key) { echo esc_html(atlas_text($key)); }
