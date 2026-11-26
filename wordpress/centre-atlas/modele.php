<?php
/**
 * Modèle d'affichage des pages créées dans « Contenu du site → Ajouter une page ».
 */
if (!defined('ABSPATH')) exit;
get_header();
while (have_posts()) { the_post(); atlas_render_model(get_post()); }
get_template_part('parts/cta');
get_footer();
