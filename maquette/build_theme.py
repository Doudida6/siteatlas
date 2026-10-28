"""Génère le thème WordPress « centre-atlas » à partir des pages de la maquette.
Usage : python3 build_theme.py   ->  ../wordpress/centre-atlas/
La maquette (HTML) reste la source : relancer ce script après chaque modification."""
import glob, os, re, runpy, shutil

OUT = '../wordpress/centre-atlas'
SLUG = {'blog': 'conseils-sante', 'article-exemple': 'conseils-sante'}
ARROW = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg>'

# ---------- Utilitaires ----------
def url(h):
    if h.startswith(('#', 'mailto:', 'tel:', 'http', '<?php')):
        return h
    m = re.match(r'^([a-z0-9-]+)\.html(#.*)?$', h)
    if not m:
        return h
    slug, frag = m.group(1), m.group(2) or ''
    if slug == 'index':
        return "<?php echo esc_url(home_url('/')); ?>" + frag
    slug = SLUG.get(slug, slug)
    return f"<?php echo esc_url(home_url('/{slug}/')); ?>" + frag

def conv(html):
    html = re.sub(r'href="([^"]*)"', lambda m: 'href="' + url(m.group(1)) + '"', html)
    html = html.replace('src="assets/logo-icon.svg"', "src=\"<?php echo esc_url(get_theme_file_uri('assets/logo-icon.svg')); ?>\"")
    # page courante dans le menu
    for slug in ['le-centre', 'specialites', 'nos-medecins', 'conseils-sante', 'contact', 'imagerie', 'endoscopie', 'biopsie']:
        a = f"href=\"<?php echo esc_url(home_url('/{slug}/')); ?>\""
        for cls in ('nav_link', 'nav_sub-link'):
            html = html.replace(f'{a} class="{cls}"', f"{a} class=\"{cls}<?php echo atlas_current('{slug}'); ?>\"")
    html = html.replace('class="nav_link nav_dropdown-toggle"',
                        "class=\"nav_link nav_dropdown-toggle<?php echo atlas_current_group(['imagerie','endoscopie','biopsie']); ?>\"")
    return html

def block(html, start):
    """Renvoie le bloc <div> qui commence à `start`, jusqu'à sa balise fermante."""
    i = html.index(start)
    depth = 0
    for m in re.finditer(r'<div\b|</div>', html[i:]):
        depth += 1 if m.group(0).startswith('<div') else -1
        if depth == 0:
            return html[i:i + m.end()]
    raise ValueError(start)

def forms(html, ftype):
    """Formulaires : envoi réel vers admin-post.php (anti-spam + nonce)."""
    def add_name(m):
        tag = m.group(0)
        if ' name=' in tag:
            return tag
        return re.sub(r' id="([^"]+)"', r' id="\1" name="\1"', tag, count=1)
    html = re.sub(r'<(?:input|select|textarea)\b[^>]*>', add_name, html)
    opening = ('<form method="post" action="<?php echo esc_url(admin_url(\'admin-post.php\')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>>'
               '<input type="hidden" name="action" value="atlas_form">'
               f'<input type="hidden" name="form_type" value="{ftype}">'
               "<?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?>"
               '<input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">')
    html = html.replace('<form data-form class="form_grid">', opening)
    html = html.replace('<div class="form_success" role="status">', '<div class="form_success<?php echo atlas_sent_class(); ?>" role="status">')
    return html

def php_str(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "\\'") + "'"

# ---------- Lecture de la maquette ----------
idx = open('index.html', encoding='utf-8').read()
sprite = re.search(r"<!-- Sprite d'icônes -->.*?</svg>\n", idx, re.S).group(0)
header = re.search(r'  <!-- ===== Header ===== -->.*?</header>\n', idx, re.S).group(0)
footer = re.search(r'  <!-- ===== Footer ===== -->.*?</footer>\n', idx, re.S).group(0)
mobile = re.search(r"<!-- Barre d'accès rapide mobile -->.*?</nav>\n", idx, re.S).group(0)
CTA_RE = re.compile(r'  <section class="call2">.*?</section>\n', re.S)
cta = CTA_RE.search(idx).group(0)

def middle(html):
    a = html.index('</header>\n') + len('</header>\n')
    b = html.index('  <!-- ===== Footer ===== -->')
    return html[a:b]

if os.path.exists(OUT):
    shutil.rmtree(OUT)
for d in ('', 'assets', 'parts'):
    os.makedirs(os.path.join(OUT, d), exist_ok=True)
w = lambda p, s: open(os.path.join(OUT, p), 'w', encoding='utf-8').write(s)

# ---------- Assets ----------
shutil.copy('assets/logo-icon.svg', f'{OUT}/assets/logo-icon.svg')
shutil.copy('js/main.js', f'{OUT}/assets/main.js')
shutil.copy('assets/screenshot.png', f'{OUT}/screenshot.png')

PRE_CSS = '\n/* ===== Protection contre les styles globaux de WordPress et des plugins ===== */\n.page-wrapper :is(h1, h2, h3, h4, h5, h6) { color: inherit; font-family: inherit; text-transform: none; letter-spacing: inherit; }\n.page-wrapper :is(p, ul, ol, li) { font-family: inherit; }\n.page-wrapper button { font-family: inherit; }\n'
THEME_CSS = '''
/* Boutons : états survol/focus protégés (les plugins stylent souvent button:hover) */
.nav_component .nav_dropdown-toggle, .nav_component .nav_dropdown-toggle:hover, .nav_component .nav_dropdown-toggle:focus, .nav_component .nav_dropdown-toggle:active {
  background: none !important; border: 0 !important; box-shadow: none !important; border-radius: 0 !important;
  padding: .3rem 0 !important; font-size: .8rem !important; font-weight: 600 !important; text-transform: uppercase !important;
  letter-spacing: .06em !important; line-height: 1.6 !important; transform: none !important; height: auto !important; min-height: 0 !important;
}
.nav_component .nav_dropdown-toggle:not(.w--current) { color: inherit !important; }
.nav_component .nav_dropdown-toggle.w--current { color: var(--color-accent) !important; }
@media (max-width: 991px) { .nav_component .nav_dropdown-toggle { font-size: .95rem !important; text-transform: none !important; letter-spacing: 0 !important; } }
.nav_toggle, .nav_toggle:hover, .nav_toggle:focus, .nav_toggle:active { background: #fff !important; color: var(--color-dark) !important; border: 1.5px solid var(--color-dark) !important; box-shadow: none !important; border-radius: 999px !important; height: 44px; padding: 0 1.1rem !important; font-size: 1rem !important; text-transform: none !important; letter-spacing: 0 !important; }
.blog_filter, .blog_filter:focus { background: #fff; color: var(--color-dark); border: 1.5px solid #dfe4e7; box-shadow: none; text-transform: none; letter-spacing: 0; }
.blog_filter:hover { background: #fff; color: var(--color-dark); border-color: var(--color-accent); }
.blog_filter.is-active, .blog_filter.is-active:hover, .blog_filter.is-active:focus { background: var(--color-accent); border-color: var(--color-accent); color: #fff; }
button.button { text-transform: none; letter-spacing: 0; box-shadow: none; }
button.button.is-primary, button.button.is-primary:focus { background: var(--color-accent); color: #fff; border-color: transparent; }
button.button.is-primary:hover { background: var(--color-accent-dark); color: #fff; }

/* ===== Ajouts propres à WordPress ===== */
.hp { position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden; }
.photo-placeholder.has-img { padding: 0; background: none; }
.photo-placeholder.has-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.admin-bar .nav_component { top: -52px; }
@media (max-width: 991px) { .admin-bar .nav_component { top: 46px; } }
@media (max-width: 600px) { .admin-bar .nav_component { top: 0; } }
.entry-content > * + * { margin-top: 1.1rem; }
.screen-reader-text { position: absolute; left: -9999px; }
.pagination, .nav-links { display: flex; gap: .5rem; justify-content: center; margin-top: 2.5rem; }
.page-numbers { padding: .5rem 1rem; border-radius: 999px; background: #fff; box-shadow: var(--shadow); font-weight: 600; }
.page-numbers.current { background: var(--color-accent); color: #fff; }
'''
w('style.css', '''/*
Theme Name: Centre Médical Atlas
Theme URI: https://centremedicalatlas.sn
Author: Centre Médical Atlas
Description: Thème sur mesure du Centre Médical Atlas (Dakar) : consultations, imagerie, endoscopie, biopsie. Direction artistique contemporaine, premium et chaleureuse.
Version: 1.0.0
Requires at least: 6.0
Requires PHP: 7.4
License: Propriétaire
Text Domain: centre-atlas
*/

''' + PRE_CSS + open('css/style.css', encoding='utf-8').read() + THEME_CSS)

# ---------- header / footer ----------
w('header.php', '''<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
''' + sprite + '<div class="page-wrapper">\n\n' + conv(header))
w('footer.php', conv(footer) + '</div>\n\n' + conv(mobile) + '\n<?php wp_footer(); ?>\n</body>\n</html>\n')
w('parts/cta.php', '<?php if (!defined(\'ABSPATH\')) exit; ?>\n' + conv(cta))

# ---------- Pages générées ----------
TITLES = {'accueil': 'Accueil', 'le-centre': 'Le Centre', 'specialites': 'Spécialités', 'imagerie': 'Imagerie',
          'endoscopie': 'Endoscopie', 'biopsie': 'Biopsie', 'nos-medecins': 'Nos médecins',
          'conseils-sante': 'Conseils santé', 'rendez-vous': 'Prendre rendez-vous', 'contact': 'Contact'}
specs = runpy.run_path('gen_specialites.py')['SPECS']
for s in specs:
    TITLES['specialites-' + s['slug']] = s['nom']
ARTS = runpy.run_path('gen_blog.py')['ARTS']

def page_tpl(body):
    return '<?php get_header(); ?>\n' + body + '<?php get_footer(); ?>\n'

FORM_TYPES = {'rendez-vous': 'Demande de rendez-vous', 'contact': 'Message de contact'}
for f in sorted(glob.glob('*.html')):
    slug = f[:-5]
    if slug in ('index', 'blog', 'article-exemple'):
        continue
    body = middle(open(f, encoding='utf-8').read())
    body = CTA_RE.sub("<?php get_template_part('parts/cta'); ?>\n", body)
    body = conv(body)
    if slug in FORM_TYPES:
        body = forms(body, FORM_TYPES[slug])
    w(f'page-{slug}.php', page_tpl(body))

# ---------- Accueil ----------
home = middle(idx)
home = CTA_RE.sub("<?php get_template_part('parts/cta'); ?>\n", home)
grid = block(home, '<div class="blog_grid">')
loop = ('''<div class="blog_grid">
<?php $q = new WP_Query(['posts_per_page' => 3, 'ignore_sticky_posts' => true]); while ($q->have_posts()) : $q->the_post(); ?>
<a href="<?php the_permalink(); ?>" class="blog_card reveal"><?php atlas_thumb(); ?><div class="blog_card-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span></div><h3 class="heading-style-h4"><?php the_title(); ?></h3><span class="quick_link text-color-accent">Lire l'article ''' + ARROW + '''</span></div></a>
<?php endwhile; wp_reset_postdata(); ?>
</div>''')
home = home.replace(grid, loop)
home = forms(conv(home), 'Demande de rendez-vous (accueil)')
w('front-page.php', page_tpl(home))

# ---------- Blog : liste (home.php), article (single.php) ----------
def banner(title_php, crumbs_html):
    return f'''  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">{title_php}</h1>
      <div class="breadcrumb">{crumbs_html}</div>
    </div></div>
  </section>
'''
blog_list = banner('Conseils santé', '<a href="index.html">Accueil</a><span>›</span><span>Conseils santé</span>') + '''
  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="eyebrow2">Actualités &amp; conseils</span>
        <h2 class="heading-style-h2">Comprendre pour mieux se soigner</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Des articles simples, rédigés avec nos médecins, pour vous aider à comprendre vos examens et votre santé.</p>
      </div>
<?php $cats = get_categories(['hide_empty' => true]); if ($cats) : ?>
      <div class="blog_filters"><button class="blog_filter is-active" data-filter="all">Tous</button><?php foreach ($cats as $c) : ?><button class="blog_filter" data-filter="<?php echo esc_attr($c->name); ?>"><?php echo esc_html($c->name); ?></button><?php endforeach; ?></div>
<?php endif; ?>
<?php
global $wp_query;
$items = $wp_query->posts;
$featured = (!is_paged() && $items) ? array_shift($items) : null;
if ($featured) : $GLOBALS['post'] = $featured; setup_postdata($featured); ?>
      <a href="<?php the_permalink(); ?>" class="blog_featured reveal" data-cat="<?php echo esc_attr(atlas_cat_name()); ?>">
        <?php atlas_thumb("Photo de l'article à la une"); ?>
        <div class="blog_featured-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span><span><?php echo esc_html(atlas_read_time()); ?> min de lecture</span></div><h2 class="heading-style-h2" style="font-size:1.9rem"><?php the_title(); ?></h2><p class="text-style-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28)); ?></p><span class="button is-primary" style="justify-self:start">Lire l'article</span></div>
      </a>
<?php wp_reset_postdata(); endif; ?>
      <div class="blog_grid">
<?php foreach ($items as $p) : $GLOBALS['post'] = $p; setup_postdata($p); ?>
        <a href="<?php the_permalink(); ?>" class="blog_card reveal" data-cat="<?php echo esc_attr(atlas_cat_name()); ?>"><?php atlas_thumb(); ?><div class="blog_card-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span></div><h3 class="heading-style-h4"><?php the_title(); ?></h3><p class="text-size-small text-style-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p><span class="quick_link text-color-accent">Lire l'article ''' + ARROW + '''</span></div></a>
<?php endforeach; wp_reset_postdata(); ?>
      </div>
      <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '‹', 'next_text' => '›']); ?>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>
'''
w('home.php', page_tpl(conv(blog_list)))

single = '''<?php while (have_posts()) : the_post(); ?>
''' + banner('<?php the_title(); ?>', '<a href="index.html">Accueil</a><span>›</span><a href="blog.html">Conseils santé</a><span>›</span><span><?php the_title(); ?></span>') + '''
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large article_grid">
      <article>
        <div class="blog_meta" style="margin-bottom:1.25rem"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span><span><?php echo esc_html(atlas_read_time()); ?> min de lecture</span></div>
        <?php atlas_thumb('Photo de couverture', 'article_cover'); ?>
        <div class="article_body"><?php the_content(); ?></div>
      </article>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Une question, un examen à prévoir ?</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="rendez-vous.html" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a></div>
<?php $related = get_posts(['numberposts' => 3, 'exclude' => [get_the_ID()]]); if ($related) : ?>
        <div class="aside_links"><strong>À lire aussi</strong><?php foreach ($related as $r) : ?><a href="<?php echo esc_url(get_permalink($r)); ?>"><?php echo esc_html(get_the_title($r)); ?></a><?php endforeach; ?></div>
<?php endif; ?>
      </aside>
    </div></div>
  </section>
<?php endwhile; ?>
<?php get_template_part('parts/cta'); ?>
'''
w('single.php', page_tpl(conv(single)))

# ---------- Modèles de secours ----------
w('page.php', page_tpl(conv(banner('<?php the_title(); ?>', '<a href="index.html">Accueil</a><span>›</span><span><?php the_title(); ?></span>') + '''
  <section class="padding-section-large"><div class="padding-global"><div class="container-large" style="max-width:820px">
<?php while (have_posts()) : the_post(); ?><div class="entry-content article_body"><?php the_content(); ?></div><?php endwhile; ?>
  </div></div></section>
''')))
w('index.php', page_tpl('<?php if (have_posts()) : while (have_posts()) : the_post(); ?><div class="padding-global padding-section-large"><div class="container-large"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></div></div><?php endwhile; endif; ?>\n'))
w('404.php', page_tpl(conv(banner('Page introuvable', '<a href="index.html">Accueil</a><span>›</span><span>404</span>') + '''
  <section class="padding-section-large"><div class="padding-global"><div class="container-large text-align-center"><p class="text-size-medium text-style-muted margin-bottom-medium">Cette page n'existe pas ou a été déplacée.</p><a href="index.html" class="button is-primary">Retour à l'accueil</a></div></div></section>
''')))

# ---------- functions.php ----------
pages_php = ',\n        '.join(f"{php_str(k)} => {php_str(v)}" for k, v in TITLES.items())
posts_php = ',\n        '.join(
    "[" + ", ".join([f"'title' => {php_str(a['t'])}", f"'cat' => {php_str(a['cat'])}", f"'excerpt' => {php_str(a['ex'])}", f"'days' => {i * 9 + 3}"]) + "]"
    for i, a in enumerate(ARTS))
article_html = middle(open('article-exemple.html', encoding='utf-8').read())
art_body = block(article_html, '<div class="article_body">')
art_body = art_body[len('<div class="article_body">'):-len('</div>')].strip()

FUNCTIONS = r'''<?php
/**
 * Centre Médical Atlas — fonctions du thème.
 * Fichier généré par maquette/build_theme.py : modifier la maquette puis relancer le script.
 */
if (!defined('ABSPATH')) exit;

define('ATLAS_VERSION', '1.0.0');
define('ATLAS_SECRETARIAT_EMAIL', 'centreatlasmedical@gmail.com');

/* ---------- Réglages de base ---------- */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_image_size('atlas-card', 800, 500, true);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('atlas-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('atlas-style', get_stylesheet_uri(), ['atlas-fonts'], ATLAS_VERSION);
    wp_enqueue_script('atlas-main', get_theme_file_uri('assets/main.js'), [], ATLAS_VERSION, true);
});

add_action('wp_head', function () {
    echo '<link rel="icon" href="' . esc_url(get_theme_file_uri('assets/logo-icon.svg')) . '" type="image/svg+xml">' . "\n";
});

/* ---------- Aides pour les modèles ---------- */
function atlas_current($slug) {
    if ($slug === 'specialites') {
        $on = is_page('specialites') || (is_page() && strpos((string) get_post_field('post_name', get_queried_object_id()), 'specialites-') === 0);
    } elseif ($slug === 'conseils-sante') {
        $on = is_home() || is_single();
    } else {
        $on = is_page($slug);
    }
    return $on ? ' w--current' : '';
}
function atlas_current_group($slugs) {
    foreach ($slugs as $s) { if (is_page($s)) return ' w--current'; }
    return '';
}
function atlas_sent()        { return isset($_GET['atlas_sent']); }
function atlas_sent_class()  { return atlas_sent() ? ' is-visible' : ''; }
function atlas_sent_hidden() { return atlas_sent() ? ' hidden' : ''; }

function atlas_cat_name($post_id = null) {
    $cats = get_the_category($post_id ?: get_the_ID());
    return $cats ? $cats[0]->name : 'Conseils';
}
function atlas_read_time($post_id = null) {
    $words = str_word_count(wp_strip_all_tags(get_post_field('post_content', $post_id ?: get_the_ID())));
    return max(1, (int) ceil($words / 200));
}
/** Affiche l'image mise en avant, ou un emplacement gris si l'article n'en a pas. */
function atlas_thumb($label = "Photo de l'article", $extra_class = '') {
    $cls = trim('photo-placeholder ' . $extra_class);
    if (has_post_thumbnail()) {
        echo '<div class="' . esc_attr($cls) . ' has-img">' . get_the_post_thumbnail(null, 'atlas-card') . '</div>';
    } else {
        echo '<div class="' . esc_attr($cls) . '">' . esc_html($label) . '</div>';
    }
}

/* ---------- Demandes de rendez-vous (visibles dans l'admin) ---------- */
add_action('init', function () {
    register_post_type('atlas_demande', [
        'labels' => ['name' => 'Demandes', 'singular_name' => 'Demande', 'menu_name' => 'Demandes RDV', 'all_items' => 'Toutes les demandes', 'edit_item' => 'Voir la demande'],
        'public' => false, 'show_ui' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-calendar-alt', 'menu_position' => 25,
        'supports' => ['title', 'editor'],
        'capability_type' => 'post', 'capabilities' => ['create_posts' => 'do_not_allow'], 'map_meta_cap' => true,
    ]);
});

add_action('admin_post_nopriv_atlas_form', 'atlas_handle_form');
add_action('admin_post_atlas_form', 'atlas_handle_form');
function atlas_handle_form() {
    $back = remove_query_arg('atlas_sent', wp_get_referer() ?: home_url('/'));

    if (!isset($_POST['atlas_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['atlas_nonce'])), 'atlas_form')) {
        wp_die('Votre session a expiré. Merci de recharger la page et de réessayer.', 'Erreur', ['response' => 403, 'back_link' => true]);
    }
    // Piège anti-spam : champ caché rempli = robot. On fait comme si tout allait bien.
    if (!empty($_POST['website'])) {
        wp_safe_redirect(add_query_arg('atlas_sent', '1', $back));
        exit;
    }
    // Limite : 5 envois par heure et par adresse IP.
    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'x';
    $key = 'atlas_form_' . md5($ip);
    $count = (int) get_transient($key);
    if ($count >= 5) {
        wp_die('Trop de demandes envoyées. Merci de nous appeler au 33 867 86 46.', 'Erreur', ['response' => 429, 'back_link' => true]);
    }
    set_transient($key, $count + 1, HOUR_IN_SECONDS);

    $type = sanitize_text_field(wp_unslash($_POST['form_type'] ?? 'Demande'));
    $labels = ['nom' => 'Nom et prénom', 'tel' => 'Téléphone', 'email' => 'Email', 'type' => 'Type de rendez-vous',
               'medecin' => 'Médecin souhaité', 'date' => 'Date souhaitée', 'message' => 'Message', 'msg' => 'Message'];
    $skip = ['action', 'atlas_nonce', '_wp_http_referer', 'form_type', 'website'];
    $lines = []; $name = ''; $reply = '';
    foreach ($_POST as $field => $value) {
        if (in_array($field, $skip, true) || is_array($value)) continue;
        $value = trim(sanitize_textarea_field(wp_unslash($value)));
        if ($value === '') continue;
        $short = preg_replace('/^.*-/', '', $field);
        if ($short === 'nom') $name = $value;
        if ($short === 'email' && is_email($value)) $reply = $value;
        $lines[] = ($labels[$short] ?? $field) . ' : ' . $value;
    }
    if ($name === '' || !$lines) {
        wp_die('Merci de renseigner au moins votre nom.', 'Erreur', ['response' => 400, 'back_link' => true]);
    }
    $body = implode("\n", $lines);

    wp_insert_post(['post_type' => 'atlas_demande', 'post_status' => 'private', 'post_title' => $type . ' — ' . $name, 'post_content' => $body]);

    $to = get_option('atlas_secretariat_email', ATLAS_SECRETARIAT_EMAIL);
    $headers = $reply ? ['Reply-To: ' . $reply] : [];
    wp_mail($to, '[Centre Atlas] ' . $type . ' : ' . $name, $type . "\n\n" . $body, $headers);

    wp_safe_redirect(add_query_arg('atlas_sent', '1', $back));
    exit;
}

/* ---------- Réglage : adresse email du secrétariat ---------- */
add_action('admin_menu', function () {
    add_options_page('Centre Atlas', 'Centre Atlas', 'manage_options', 'centre-atlas', function () {
        if (isset($_POST['atlas_secretariat_email']) && check_admin_referer('atlas_settings')) {
            update_option('atlas_secretariat_email', sanitize_email(wp_unslash($_POST['atlas_secretariat_email'])));
            echo '<div class="updated"><p>Enregistré.</p></div>';
        }
        $v = get_option('atlas_secretariat_email', ATLAS_SECRETARIAT_EMAIL);
        echo '<div class="wrap"><h1>Centre Atlas</h1><form method="post">';
        wp_nonce_field('atlas_settings');
        echo '<table class="form-table"><tr><th><label for="e">Email qui reçoit les demandes de rendez-vous</label></th><td><input id="e" type="email" name="atlas_secretariat_email" class="regular-text" value="' . esc_attr($v) . '"></td></tr></table>';
        submit_button();
        echo '</form></div>';
    });
});

/* ---------- Installation à l'activation du thème ---------- */
add_action('after_switch_theme', 'atlas_setup');
function atlas_setup() {
    if (get_option('atlas_setup_done')) return;

    $pages = [
        PAGES_PHP
    ];
    $ids = [];
    foreach ($pages as $slug => $title) {
        $existing = get_page_by_path($slug);
        $ids[$slug] = $existing ? $existing->ID : wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'post_content' => '']);
    }

    update_option('blogname', 'Centre Médical Atlas');
    update_option('blogdescription', 'Médecine, imagerie et endoscopie à Dakar');
    update_option('show_on_front', 'page');
    update_option('page_on_front', $ids['accueil']);
    update_option('page_for_posts', $ids['conseils-sante']);
    update_option('permalink_structure', '/%postname%/');

    // Articles d'exemple (à remplacer par les vrais articles du centre)
    $samples = [
        POSTS_PHP
    ];
    $first_body = <<<'HTML'
ARTICLE_HTML
HTML;
    foreach ($samples as $i => $s) {
        $cat = term_exists($s['cat'], 'category');
        $cat_id = $cat ? (int) (is_array($cat) ? $cat['term_id'] : $cat) : (int) wp_insert_term($s['cat'], 'category')['term_id'];
        $when = gmdate('Y-m-d H:i:s', time() - $s['days'] * DAY_IN_SECONDS);
        wp_insert_post([
            'post_type' => 'post', 'post_status' => 'publish', 'post_title' => $s['title'], 'post_excerpt' => $s['excerpt'],
            'post_content' => $i === 0 ? $first_body : '<p>' . esc_html($s['excerpt']) . '</p><p>Article d\'exemple : contenu à rédiger avec les médecins du centre.</p>',
            'post_category' => [$cat_id], 'post_date_gmt' => $when, 'post_date' => get_date_from_gmt($when),
        ]);
    }
    // Retire l'article et la page créés par défaut par WordPress (mis à la corbeille, récupérables)
    foreach (['hello-world' => 'post', 'sample-page' => 'page'] as $slug => $type) {
        $p = get_page_by_path($slug, OBJECT, $type);
        if ($p) wp_trash_post($p->ID);
    }

    update_option('atlas_setup_done', 1);
    flush_rewrite_rules();
}
'''
FUNCTIONS = FUNCTIONS.replace('PAGES_PHP', pages_php).replace('POSTS_PHP', posts_php).replace('ARTICLE_HTML', art_body)
w('functions.php', FUNCTIONS)
print('Thème généré :', OUT, '-', len(os.listdir(OUT)), 'éléments')
