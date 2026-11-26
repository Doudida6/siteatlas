"""Passe finale du thème WordPress : rend tout modifiable depuis l'administration.
 - menu principal  -> wp_nav_menu (Apparence > Menus)
 - coordonnées     -> réglages « Centre Atlas > Coordonnées »
 - médecins        -> menu « Médecins »
 - photos          -> emplacements gris choisis dans « Photos du site »
 - textes          -> chaque texte visible devient modifiable dans « Textes du site »
Écrit aussi inc/registry.php (liste des textes par défaut et des emplacements photo)."""
import hashlib, html, os, re, shutil, unicodedata

FONT_CSS = '''/* Police Outfit hébergée dans le thème (licence SIL OFL 1.1, voir assets/fonts/OFL.txt) : aucune requête vers Google */
@font-face { font-family: 'Outfit'; font-style: normal; font-weight: 100 900; font-display: swap;
  src: url('assets/fonts/outfit-latin-ext.woff2') format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C4, U+2113, U+2C60-2C7F, U+A720-A7FF; }
@font-face { font-family: 'Outfit'; font-style: normal; font-weight: 100 900; font-display: swap;
  src: url('assets/fonts/outfit-latin.woff2') format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD; }
'''
# Photos du centre fournies avec le thème : emplacement -> fichier (dossier theme-src/photos)
DEFAULT_PHOTOS = {
    'accueil-photo-accueil-espace-architectural-du-ce': 'facade-horizontal.jpg',   # photo principale de l'accueil
    'cta-photo-accueil-du-centre-atlas': 'facade-carre.jpg',                        # bandeau « Besoin d'un rendez-vous ? »
    'accueil-photo-reception-salle-d-attente-atlas': 'reception-attente.jpg',
    'accueil-photo-cabinet-de-consultation': 'cabinet-consultation.jpg',
    'accueil-photo-echographie': 'echographe-detail.jpg',
    'le-centre-photo-facade-et-entree-du-centre-atlas': 'facade-carre.jpg',
    'le-centre-photo-facade': 'facade-horizontal.jpg',
    'le-centre-photo-reception': 'reception-logo.jpg',
    'le-centre-photo-salle-d-attente': 'salle-attente.jpg',
    'le-centre-photo-cabinet-de-consultation': 'cabinet-bureau.jpg',
    'le-centre-photo-echographie': 'echographe-portable.jpg',
    'specialites-photo-accueil': 'reception-detail.jpg',
    'imagerie-photo-salle-d-echographie-atlas': 'salle-echographie.jpg',
    'imagerie-photo-examen-doppler': 'echographe-detail.jpg',
    'endoscopie-photo-salle-d-endoscopie-atlas': 'salle-soins.jpg',
    'biopsie-photo-espace-dedie-aux-biopsies': 'cabinet-echo.jpg',
    'biopsie-photo-echographe-et-espace-de-biopsie': 'salle-echographie.jpg',
    'biologie-photo-espace-de-prelevement-atlas': 'biologie-prelevement.jpg',
    'biologie-photo-analyses-de-laboratoire': 'biologie-analyses.jpg',
    'endoscopie-photo-materiel-d-endoscopie': 'endoscopie-materiel.jpg',
    'imagerie-photo-salle-de-radiographie-atlas': 'radiographie.jpg',
    'le-centre-photo-details-architecturaux': 'details-bureau.jpg',
}
GUARD = "<?php if (!defined('ABSPATH')) exit; ?>\n"
PHP_RE = re.compile(r'<\?php.*?\?>', re.S)
SKIP_TAGS = ('script', 'style', 'svg', 'title', 'textarea', 'option', 'symbol')
LITERALS = [('33 867 86 46', '{tel_fixe}'), ('78 831 60 60', '{tel_mobile}'), ('centreatlasmedical@gmail.com', '{email}')]


def php_str(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "\\'") + "'"


FRIENDLY = {'quote2_avatar': 'Photo du patient (témoignage)', 'apt_side': 'Fond du bloc « Prenez rendez-vous »',
            'hero2_photo': 'Photo principale (en haut de page)', 'call2_photo': 'Photo du bandeau « Besoin d\'un rendez-vous ? »'}


def slugify(s):
    s = unicodedata.normalize('NFKD', s).encode('ascii', 'ignore').decode()
    s = re.sub(r'[^a-zA-Z0-9]+', '-', s).strip('-').lower()
    return s[:40] or 'photo'


def block(html_, start):
    i = html_.index(start)
    depth = 0
    for m in re.finditer(r'<div\b|</div>', html_[i:]):
        depth += 1 if m.group(0).startswith('<div') else -1
        if depth == 0:
            return html_[i:i + m.end()]
    raise ValueError(start)


# ---------- 1. Coordonnées, menu, médecins ----------
def contact_vars(s):
    s = s.replace('tel:+221338678646', "tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>")
    s = s.replace('tel:+221788316060', "tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>")
    s = s.replace('https://wa.me/221788316060', "https://wa.me/<?php echo esc_attr(atlas_wa()); ?>")
    s = s.replace('mailto:centreatlasmedical@gmail.com', "mailto:<?php echo esc_attr(atlas_opt('email')); ?>")
    s = re.sub(r'<span class="addr">.*?</span>', '<span class="addr"><?php echo esc_html(atlas_addr()); ?></span>', s, flags=re.S)
    s = s.replace('>Itinéraire</a>', ">Itinéraire</a><?php if (atlas_opt('google')) : ?> <a href=\"<?php echo esc_url(atlas_opt('google')); ?>\" class=\"button is-secondary\" target=\"_blank\" rel=\"noopener\">Notre fiche Google</a><?php endif; ?>")
    # valeurs des pages légales : <span class="lv" data-v="clé"> -> réglage correspondant
    s = re.sub(r'<span class="lv" data-v="([a-z_]+)">.*?</span>',
               lambda m: '<?php echo esc_html(' + ('atlas_data_email()' if m.group(1) == 'email_donnees' else f"atlas_opt('{m.group(1)}')") + '); ?>', s, flags=re.S)
    s = re.sub(r'<span class="hours">.*?</span>', '<span class="hours"><?php echo atlas_hours(); ?></span>', s, flags=re.S)
    s = re.sub(r'<span class="footer_credit">.*?</a></span>', '<?php atlas_credit(); ?>', s, flags=re.S)
    s = s.replace('src="https://www.google.com/maps?q=Libert%C3%A9+6,+Dakar,+Senegal&output=embed"',
                  "src=\"<?php echo esc_url('https://www.google.com/maps?q=' . rawurlencode(atlas_map_query()) . '&output=embed'); ?>\"")
    s = s.replace('href="https://www.google.com/maps/dir/?api=1&destination=Libert%C3%A9+6,+Dakar,+Senegal"',
                  "href=\"<?php echo esc_url('https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode(atlas_map_query())); ?>\"")
    for name, icon in (('facebook', 'i-fb'), ('instagram', 'i-ig'), ('tiktok', 'i-tt'), ('linkedin', 'i-li')):
        label = {'tiktok': 'TikTok', 'linkedin': 'LinkedIn'}.get(name, name.capitalize())
        lab_src = name.capitalize()
        old = f'<a href="#" aria-label="{lab_src}"><svg><use href="#{icon}"/></svg></a>'
        new = (f"<?php if (atlas_opt('{name}')) : ?><a href=\"<?php echo esc_url(atlas_opt('{name}')); ?>\" aria-label=\"{label}\" target=\"_blank\" rel=\"noopener\">"
               f'<svg><use href="#{icon}"/></svg></a><?php endif; ?>')
        s = s.replace(old, new)
    return s


def header_menu(s):
    m = re.search(r'<nav class="nav_menu" data-nav-menu>(.*?)</nav>', s, re.S)
    if not m:
        return s
    # le bouton « Prendre rendez-vous » est conservé (son href contient du PHP, donc on découpe sur </a>)
    btn = ''
    for seg in m.group(1).split('</a>'):
        if 'class="button is-primary"' in seg:
            btn = seg[seg.rindex('<a '):] + '</a>'
    new = '<nav class="nav_menu" data-nav-menu>\n          <?php atlas_menu(); ?>\n          ' + btn + '\n        </nav>'
    return s.replace(m.group(0), new, 1)


def dynamic_blocks(name, s):
    if name == 'front-page.php' and '<div class="team_grid">' in s:
        s = s.replace(block(s, '<div class="team_grid">'), '<div class="team_grid">\n<?php atlas_team_cards(3); ?>\n</div>')
    if name == 'front-page.php' and '<div class="testi_grid">' in s:
        s = s.replace(block(s, '<div class="testi_grid">'), '<div class="testi_grid">\n<?php atlas_testimonials(); ?>\n</div>')
        # section masquée s'il n'y a aucun témoignage publié
        i = s.index('<section class="quote2">'); j = s.index('</section>', i) + len('</section>')
        s = s[:i] + '<?php if (atlas_get_testimonials()) : ?>\n' + s[i:j] + '\n<?php endif; ?>' + s[j:]
    if name == 'page-nos-medecins.php' and '<div class="doc_grid">' in s:
        s = s.replace(block(s, '<div class="doc_grid">'), '<div class="doc_grid">\n<?php atlas_doc_cards(); ?>\n</div>')
    if name == 'page-rendez-vous.php':
        s = re.sub(r'(<select [^>]*id="medecin"[^>]*>).*?(</select>)', r'\1<?php atlas_medecin_options(); ?>\2', s, flags=re.S)
    return s


# ---------- 2. Photos ----------
def photos(s, page, reg_photos):
    store = []

    def protect(m):
        store.append(m.group(0))
        return '\x00%d\x00' % (len(store) - 1)
    s = PHP_RE.sub(protect, s)

    used = {}

    def key_for(label, classes):
        base = page + '-' + slugify(label or classes.split()[0])
        n = used.get(base, 0) + 1
        used[base] = n
        return base if n == 1 else f'{base}-{n}'

    def repl(m):
        tag, attrs_before, classes, attrs_after = m.group(1), m.group(2), m.group(3), m.group(4)
        inner, close = m.group(5), m.group(6)
        label = html.unescape(inner.strip()) if inner is not None and '<' not in inner else ''
        key = key_for(label, classes)
        reg_photos[key] = (page, label or 'Photo (' + classes.split()[0] + ')')
        opening = (f'<{tag}{attrs_before}class="{classes}<?php echo atlas_photo_class({php_str(key)}); ?>"{attrs_after}'
                   f'<?php echo atlas_photo_attr({php_str(key)}, {php_str(label)}); ?>>')
        if inner is not None and '<' not in inner:
            return opening + (f'<?php atlas_photo_label({php_str(key)}, {php_str(label)}); ?>' if label else '') + close
        return opening + (inner or '') + (close or '')

    # emplacements texte seul : <div class="… photo-placeholder …">Libellé</div>
    pat_text = re.compile(r'<(div|span)\b([^>]*?)class="([^"]*\bphoto-placeholder\b[^"]*)"([^>]*)>()([^<]*)(</\1>)')
    s = pat_text.sub(lambda m: repl_text(m, key_for, reg_photos, page), s)
    # emplacements complexes (contiennent d'autres balises) : on ne transforme que l'ouverture
    pat_open = re.compile(r'<(div|span)\b([^>]*?)class="([^"]*\bphoto-placeholder\b(?![^"]*has-photo)[^"]*)"([^>]*)>')

    def repl_open(m):
        if 'atlas_photo_class' in m.group(0):
            return m.group(0)
        tag, before, classes, after = m.groups()
        key = key_for('', classes.replace('photo-placeholder', '').strip() or 'bloc')
        reg_photos[key] = (page, FRIENDLY.get(classes.split()[0], 'Photo de fond (' + classes.split()[0] + ')'))
        return (f'<{tag}{before}class="{classes}<?php echo atlas_photo_class({php_str(key)}); ?>"{after}'
                f'<?php echo atlas_photo_attr({php_str(key)}, ""); ?>>')
    s = pat_open.sub(repl_open, s)
    return re.sub(r'\x00(\d+)\x00', lambda m: store[int(m.group(1))], s)


def repl_text(m, key_for, reg_photos, page):
    tag, before, classes, after = m.group(1), m.group(2), m.group(3), m.group(4)
    label = html.unescape(m.group(6).strip())
    key = key_for(label, classes)
    reg_photos[key] = (page, label or FRIENDLY.get(classes.split()[0], 'Photo (' + classes.split()[0] + ')'))
    opening = (f'<{tag}{before}class="{classes}<?php echo atlas_photo_class({php_str(key)}); ?>"{after}'
               f'<?php echo atlas_photo_attr({php_str(key)}, {php_str(label)}); ?>>')
    inner = f'<?php atlas_photo_label({php_str(key)}, {php_str(label)}); ?>' if label else ''
    return opening + inner + m.group(7)


# ---------- 3. Textes ----------
def texts(s, page, reg_texts):
    store = []

    def protect(m):
        store.append(m.group(0))
        return '\x00%d\x00' % (len(store) - 1)
    s = PHP_RE.sub(protect, s)
    parts = re.split(r'(<!--.*?-->|<[^>]+>)', s, flags=re.S)
    out, skip, prev_tag = [], 0, ''
    for i, part in enumerate(parts):
        if i % 2 == 1:                                   # balise ou commentaire
            out.append(part)
            if part.startswith('<!--'):
                continue
            m = re.match(r'<(/?)([a-zA-Z0-9]+)', part)
            if m:
                name = m.group(2).lower()
                if name in SKIP_TAGS and not part.rstrip().endswith('/>'):
                    skip += -1 if m.group(1) else 1
                    skip = max(skip, 0)
            prev_tag = part
            continue
        # texte
        has_literal = any(lit in part for lit, _ in LITERALS)
        if skip or '\x00' in part or not (re.search(r'[A-Za-zÀ-ÿ]', part) or has_literal) or 'data-nav-label' in prev_tag:
            out.append(part)
            continue
        lead = part[:len(part) - len(part.lstrip())]
        trail = part[len(part.rstrip()):]
        core = ' '.join(html.unescape(part).split())
        for lit, tok in LITERALS:
            core = core.replace(lit, tok)
        key = 't' + hashlib.md5(core.encode('utf-8')).hexdigest()[:8]
        reg_texts.setdefault(key, (page, core))
        out.append(f"{lead}<?php atlas_t({php_str(key)}); ?>{trail}")
    s = ''.join(out)
    return re.sub(r'\x00(\d+)\x00', lambda m: store[int(m.group(1))], s)


# ---------- Orchestration ----------
def run(OUT, TITLES):
    order = ['header.php', 'footer.php', 'parts/cta.php', 'front-page.php', 'home.php', 'single.php']
    pages_files = sorted(f for f in os.listdir(OUT) if f.startswith('page-') and f not in ('page.php',))
    # même ordre que le menu pour les pages
    pref = ['le-centre', 'specialites', 'imagerie', 'biologie', 'endoscopie', 'biopsie', 'nos-medecins', 'rendez-vous', 'contact']
    pages_files.sort(key=lambda f: (pref.index(f[5:-4]) if f[5:-4] in pref else 50, f))
    files = order + pages_files + ['page.php', '404.php']

    def page_of(f):
        if f in ('header.php', 'footer.php'):
            return 'commun'
        if f == 'parts/cta.php':
            return 'cta'
        if f == 'front-page.php':
            return 'accueil'
        if f in ('home.php', 'single.php'):
            return 'blog'
        if f.startswith('page-'):
            return f[5:-4]
        return 'autres'

    reg_texts, reg_photos = {}, {}
    for f in files:
        path = os.path.join(OUT, f)
        if not os.path.exists(path):
            continue
        s = open(path, encoding='utf-8').read()
        page = page_of(f)
        s = contact_vars(s)
        if f == 'header.php':
            s = header_menu(s)
        s = dynamic_blocks(f, s)
        s = photos(s, page, reg_photos)
        s = texts(s, page, reg_texts)
        if 'ABSPATH' not in s[:200]:
            s = GUARD + s
        open(path, 'w', encoding='utf-8').write(s)

    from seo_data import SEO
    labels = {'commun': 'Menu et pied de page', 'cta': 'Bandeau « Besoin d\'un rendez-vous ? »', 'accueil': 'Accueil',
              'blog': 'Conseils santé (blog)', 'autres': 'Autres pages'}
    pages = {}
    for k in ['commun', 'cta', 'accueil']:
        pages[k] = labels[k]
    for f in files:
        k = page_of(f)
        if k not in pages:
            pages[k] = labels.get(k) or TITLES.get(k, k)
    lines = ['<?php', "if (!defined('ABSPATH')) exit;", '// Fichier généré par maquette/theme_post.py : ne pas modifier à la main.', 'return [', "    'pages' => ["]
    lines += [f"        {php_str(k)} => {php_str(v)}," for k, v in pages.items()]
    lines += ['    ],', "    'texts' => ["]
    lines += [f"        {php_str(k)} => [{php_str(p)}, {php_str(t)}]," for k, (p, t) in reg_texts.items()]
    lines += ['    ],', "    'photos' => [", ]
    lines += [f"        {php_str(k)} => [{php_str(p)}, {php_str(l)}]," for k, (p, l) in reg_photos.items()]
    lines += ['    ],', "    'defaults' => ["]
    for k, fname in DEFAULT_PHOTOS.items():
        assert k in reg_photos, 'emplacement photo introuvable : ' + k
        assert os.path.exists(os.path.join('theme-src', 'photos', fname)), fname
        lines.append(f"        {php_str(k)} => {php_str(fname)},")
    lines += ['    ],', "    'seo' => ["]
    lines += [f"        {php_str(k)} => [{php_str(pages.get(k) or TITLES.get(k, k))}, {php_str(v[0])}, {php_str(v[1])}]," for k, v in SEO.items()]
    lines += ['    ],', '];', '']
    open(os.path.join(OUT, 'inc', 'registry.php'), 'w', encoding='utf-8').write('\n'.join(lines))

    # index.php (modèle de secours) : même garde
    ip = os.path.join(OUT, 'index.php')
    if os.path.exists(ip):
        c = open(ip, encoding='utf-8').read()
        if 'ABSPATH' not in c[:200]:
            open(ip, 'w', encoding='utf-8').write(GUARD + c)
    # polices
    os.makedirs(os.path.join(OUT, 'assets', 'fonts'), exist_ok=True)
    for f in os.listdir('theme-src/fonts'):
        shutil.copy(os.path.join('theme-src/fonts', f), os.path.join(OUT, 'assets', 'fonts', f))
    os.makedirs(os.path.join(OUT, 'assets', 'photos'), exist_ok=True)
    for f in sorted(set(DEFAULT_PHOTOS.values())):
        shutil.copy(os.path.join('theme-src', 'photos', f), os.path.join(OUT, 'assets', 'photos', f))
    # fichiers « silence » : empêchent l'affichage de la liste des fichiers d'un dossier
    for d in ('assets', 'inc', 'parts'):
        open(os.path.join(OUT, d, 'index.php'), 'w', encoding='utf-8').write('<?php\n// Silence is golden.\n')

    # CSS : emplacement photo rempli
    css_path = os.path.join(OUT, 'style.css')
    css = open(css_path, encoding='utf-8').read()
    i = css.index('*/') + 2  # l'en-tête du thème (Theme Name…) reste en tout début de fichier
    css = css[:i] + '\n\n' + FONT_CSS + css[i:]
    css += '\n/* Emplacements photo remplis depuis l\'administration */\n.photo-placeholder.has-photo { background-size: cover; background-position: center; background-repeat: no-repeat; }\n'
    open(css_path, 'w', encoding='utf-8').write(css)
    print(f'Textes modifiables : {len(reg_texts)} | emplacements photo : {len(reg_photos)}')
