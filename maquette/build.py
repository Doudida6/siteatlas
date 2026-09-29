"""Génère dist/ : chaque page en fichier autonome (CSS, JS et logo intégrés)."""
import base64, glob, os, re
css = open('css/style.css').read()
js = open('js/main.js').read()
logo = 'data:image/svg+xml;base64,' + base64.b64encode(open('assets/logo-icon.svg', 'rb').read()).decode()
os.makedirs('dist', exist_ok=True)
for f in glob.glob('*.html'):
    h = open(f).read()
    h = h.replace('<link rel="stylesheet" href="css/style.css">', f'<style>\n{css}\n</style>')
    h = h.replace('<script src="js/main.js"></script>', f'<script>\n{js}\n</script>')
    h = h.replace('assets/logo-icon.svg', logo)
    open(f'dist/{f}', 'w').write(h)
    print('dist/' + f)
