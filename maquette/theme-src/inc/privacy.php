<?php
/**
 * Protection des données : suppression automatique des demandes de rendez-vous anciennes.
 * La durée (en mois) se règle dans Centre Atlas > Coordonnées ; 0 désactive la suppression.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    if (!wp_next_scheduled('atlas_purge_demandes')) {
        wp_schedule_event(time() + HOUR_IN_SECONDS, 'daily', 'atlas_purge_demandes');
    }
});

add_action('atlas_purge_demandes', 'atlas_purge_demandes');
function atlas_purge_demandes() {
    $months = (int) atlas_opt('retention_mois');
    if ($months <= 0) return 0;
    $old = get_posts([
        'post_type' => 'atlas_demande', 'post_status' => 'any', 'numberposts' => 200, 'fields' => 'ids',
        'date_query' => [['before' => $months . ' months ago']],
    ]);
    foreach ($old as $id) { wp_delete_post($id, true); }
    return count($old);
}

add_action('switch_theme', function () { wp_clear_scheduled_hook('atlas_purge_demandes'); });
