<?php
/**
 * Durcissement : en-têtes de sécurité, noms d'utilisateurs non exposés, pas d'édition de code depuis l'administration.
 */
if (!defined('ABSPATH')) exit;

/** En-têtes envoyés sur les pages publiques. */
function atlas_security_headers() {
    return [
        'X-Content-Type-Options' => 'nosniff',
        'Referrer-Policy'        => 'strict-origin-when-cross-origin',
        'X-Frame-Options'        => 'SAMEORIGIN',
        'Permissions-Policy'     => 'camera=(), microphone=(), geolocation=(), payment=()',
    ];
}
add_action('send_headers', function () {
    if (is_admin() || headers_sent()) return;
    foreach (atlas_security_headers() as $name => $value) { header($name . ': ' . $value); }
});

/** L'API REST ne liste plus les comptes (noms d'utilisateurs) aux visiteurs non connectés. */
function atlas_rest_hide_users($endpoints) {
    if (!is_user_logged_in()) {
        unset($endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
}
add_filter('rest_endpoints', 'atlas_rest_hide_users');

/** Les adresses ?author=1 (qui révèlent un nom d'utilisateur) renvoient à l'accueil. */
add_action('template_redirect', function () {
    if (!is_admin() && (is_author() || isset($_GET['author']))) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
});

/** Pas d'éditeur de code dans l'administration (limite les dégâts si un compte est piraté). */
if (!defined('DISALLOW_FILE_EDIT')) define('DISALLOW_FILE_EDIT', true);

/** Le plan de site XML ne liste pas les comptes (il exposerait les identifiants de connexion). */
add_filter('wp_sitemaps_add_provider', function ($provider, $name) {
    return $name === 'users' ? false : $provider;
}, 10, 2);
