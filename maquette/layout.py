"""Assemble une page interne à partir de l'en-tête/pied de page de index.html."""
import re
_h = open('index.html').read()
_sprite = re.search(r"<!-- Sprite d'icônes -->.*?</svg>\n", _h, re.S).group(0)
_header = re.search(r'  <!-- ===== Header ===== -->.*?</header>\n', _h, re.S).group(0)
_footer = re.search(r'  <!-- ===== Footer ===== -->.*?</footer>\n', _h, re.S).group(0)
_mobile = re.search(r"<!-- Barre d'accès rapide mobile -->.*?</nav>\n", _h, re.S).group(0)
_head = _h.split('<body>')[0]

def _fix(block, current=None):
    block = re.sub(r'href="#(?!")([a-z-]+)"', r'href="index.html#\1"', block)
    block = block.replace('href="index.html#centre"', 'href="le-centre.html"')
    block = block.replace('href="index.html#specialites"', 'href="specialites.html"')
    block = block.replace('href="index.html#rendez-vous"', 'href="rendez-vous.html"')
    block = block.replace('href="index.html#medecins"', 'href="nos-medecins.html"')
    block = block.replace(' w--current', '')
    if current:
        block = block.replace(f'href="{current}" class="nav_link"', f'href="{current}" class="nav_link w--current"')
        block = block.replace(f'href="{current}" class="nav_sub-link"', f'href="{current}" class="nav_sub-link w--current"')
        if current in ('imagerie.html', 'endoscopie.html', 'biopsie.html'):
            block = block.replace('class="nav_link nav_dropdown-toggle"', 'class="nav_link nav_dropdown-toggle w--current"')
    return block

def page(title, desc, current, body):
    hd = re.sub(r'<title>.*?</title>', f'<title>{title}</title>', _head)
    hd = re.sub(r'<meta name="description" content=".*?">', f'<meta name="description" content="{desc}">', hd)
    return (hd + '<body>\n' + _sprite + '\n<div class="page-wrapper">\n\n' + _fix(_header, current) + '\n' + body + '\n'
            + _fix(_footer) + '</div>\n\n' + _fix(_mobile) + '\n<script src="js/main.js"></script>\n</body>\n</html>\n')

def banner(title, crumbs):
    trail = ''.join(f'<a href="{u}">{t}</a><span>›</span>' for t, u in crumbs)
    return f'''  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">{title}</h1>
      <div class="breadcrumb">{trail}<span>{title}</span></div>
    </div></div>
  </section>
'''

CTA = '''  <section class="padding-section-medium">
    <div class="padding-global"><div class="container-large">
      <div class="cta_component reveal">
        <h2 class="heading-style-h2">Besoin d'un rendez-vous ?</h2>
        <p class="text-size-medium">Consultation ou examen : notre équipe vous accompagne.</p>
        <div class="button-group" style="justify-content:center"><a href="rendez-vous.html" class="button is-primary">Prendre rendez-vous</a><a href="https://wa.me/221788316060" class="button is-secondary-light">Nous écrire sur WhatsApp</a></div>
      </div>
    </div></div>
  </section>
'''
