"""Génère nos-medecins.html. Fiches à compléter avec les vrais médecins du centre."""
from layout import page, banner, CTA
DOCS = [("Cardiologie",), ("Gastro-entérologie",), ("Médecine générale",), ("Gynécologie",), ("Neurologie",), ("Rhumatologie",)]
def card(spec):
    return f'''        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>{spec}</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="rendez-vous.html" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
'''
body = banner('Nos médecins', [('Accueil', 'index.html')]) + f'''
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Équipe médicale</span>
        <h2 class="heading-style-h2">Une équipe à votre écoute</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Des médecins de plusieurs spécialités, réunis pour vous accompagner à chaque étape de votre parcours.</p>
      </div>
      <div class="doc_grid">
{''.join(card(d[0]) for d in DOCS)}      </div>
    </div></div>
  </section>
''' + CTA
open('nos-medecins.html', 'w').write(page('Nos médecins à Dakar | Centre Médical Atlas', "Découvrez les médecins du Centre Médical Atlas à Dakar : spécialités, expertises et jours de consultation.", 'nos-medecins.html', body))
print('ok')
