<?php
if (!defined('ABSPATH')) exit;

// Régénère une fois les permaliens et le fichier .htaccess (corrige les 404 sur les sous-pages)
add_action('admin_init', function () {
    if (get_option('atlas_setup7_done')) return;
    if (!current_user_can('edit_theme_options')) return;
    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules(true); // true = réécrit aussi le .htaccess
    update_option('atlas_setup7_done', 1);
});
