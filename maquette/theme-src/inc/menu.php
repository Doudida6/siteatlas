<?php
/**
 * Menu principal : se gère dans Apparence → Menus (emplacement « Menu principal »).
 * Un élément avec des sous-éléments devient un sous-menu déroulant (ex. « Examens »).
 */
if (!defined('ABSPATH')) exit;

add_action('after_setup_theme', function () {
    register_nav_menus(['primary' => 'Menu principal']);
});

function atlas_chevron() {
    return '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 4l4 4 4-4"/></svg>';
}

class Atlas_Walker extends Walker_Nav_Menu {
    private $has_children_at = [];

    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $args = (object) $args;
        $has_children = !empty($args->has_children);
        $this->has_children_at[$depth] = $has_children;
        $classes = is_array($item->classes) ? $item->classes : [];
        $current = in_array('current-menu-item', $classes, true) || in_array('current-menu-ancestor', $classes, true) || in_array('current-menu-parent', $classes, true);
        $on = $current ? ' w--current' : '';
        $title = esc_html($item->title);
        $url = esc_url($item->url);
        if ($depth === 0 && $has_children) {
            $output .= '<div class="nav_dropdown"><button type="button" class="nav_link nav_dropdown-toggle' . $on . '" aria-expanded="false" data-dropdown-toggle>'
                . $title . ' ' . atlas_chevron() . '</button><div class="nav_dropdown-list">';
        } elseif ($depth === 0) {
            $output .= '<a href="' . $url . '" class="nav_link' . $on . '">' . $title . '</a>';
        } else {
            $output .= '<a href="' . $url . '" class="nav_sub-link' . $on . '">' . $title . '</a>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth === 0 && !empty($this->has_children_at[0])) {
            $output .= '</div></div>';
        }
        unset($this->has_children_at[$depth]);
    }
}

function atlas_menu() {
    wp_nav_menu([
        'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'depth' => 2,
        'walker' => new Atlas_Walker(), 'fallback_cb' => 'atlas_default_menu',
    ]);
}

/** Menu de secours si aucun menu n'est assigné à l'emplacement « Menu principal ». */
function atlas_default_menu($args = []) {
    $u = function ($slug) { return esc_url(home_url('/' . $slug . '/')); };
    echo '<a href="' . $u('le-centre') . '" class="nav_link">Le Centre</a>'
        . '<a href="' . $u('specialites') . '" class="nav_link">Spécialités</a>'
        . '<div class="nav_dropdown"><button type="button" class="nav_link nav_dropdown-toggle" aria-expanded="false" data-dropdown-toggle>Examens ' . atlas_chevron() . '</button><div class="nav_dropdown-list">'
        . '<a href="' . $u('imagerie') . '" class="nav_sub-link">Imagerie</a>'
        . '<a href="' . $u('endoscopie') . '" class="nav_sub-link">Endoscopie</a>'
        . '<a href="' . $u('biopsie') . '" class="nav_sub-link">Biopsie</a></div></div>'
        . '<a href="' . $u('nos-medecins') . '" class="nav_link">Nos médecins</a>'
        . '<a href="' . $u('conseils-sante') . '" class="nav_link">Conseils santé</a>'
        . '<a href="' . $u('contact') . '" class="nav_link">Contact</a>';
}
