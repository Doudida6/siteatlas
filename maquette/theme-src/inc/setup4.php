<?php
/**
 * Mise à jour des coordonnées par défaut (une seule fois) : adresse « Liberté 6, Dakar » et horaires d'ouverture.
 * Ne touche que les valeurs qui n'ont jamais été modifiées par la cliente.
 */
if (!defined('ABSPATH')) exit;

add_action('init', 'atlas_setup4', 40);
function atlas_setup4() {
    if (get_option('atlas_setup4_done')) return;
    $c = get_option('atlas_contact');
    if (is_array($c)) {
        $old_addr = ['', 'Dakar, Sénégal', 'Dakar, Sénégal (adresse à compléter)'];
        if (!isset($c['adresse']) || in_array(trim((string) $c['adresse']), $old_addr, true)) {
            $c['adresse'] = atlas_contact_defaults()['adresse'];
        }
        $old_hours = "Médecine générale : lundi au vendredi, 9h - 18h ; samedi, 9h - 14h\nGynécologie : lundi, 15h - 18h\nCardiologie : mercredi, 15h - 18h\nDiabétologie : samedi, 9h - 14h";
        $h = isset($c['horaires']) ? str_replace("\r", '', trim((string) $c['horaires'])) : '';
        if ($h === '' || $h === 'À compléter' || $h === $old_hours) {
            $c['horaires'] = atlas_contact_defaults()['horaires'];
        }
        update_option('atlas_contact', $c);
    }
    update_option('atlas_setup4_done', 1);
}
