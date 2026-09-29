"""Génère imagerie.html. Contenus indicatifs : à valider par les médecins du centre.
La mammographie n'est pas incluse : à ajouter uniquement si le centre la propose."""
from layout import page, banner, CTA

EXAMS = [
 dict(id='echographie', nom='Échographie', photo="Photo : salle d'échographie Atlas",
  intro="Un examen d'imagerie par ultrasons, sans rayons X, qui permet de visualiser de nombreux organes.",
  indications="Suivi de grossesse, douleurs abdominales ou pelviennes, exploration du foie, des reins, de la vésicule, de la thyroïde, des seins ou des parties molles.",
  preparation="Selon l'examen : parfois à jeun quelques heures, ou vessie pleine. Notre équipe vous précise la consigne au moment du rendez-vous. Apportez votre ordonnance et vos anciens examens.",
  deroulement="Vous êtes allongé(e) confortablement. Le médecin applique un gel tiède sur la peau et déplace une sonde. L'examen est indolore.",
  duree="15 à 30 minutes",
  resultats="Le médecin vous explique les premières constatations et un compte rendu vous est remis."),
 dict(id='doppler', nom='Doppler', photo="Photo : examen Doppler",
  intro="Une échographie spécialisée qui étudie la circulation du sang dans les artères et les veines.",
  indications="Jambes lourdes ou gonflées, suspicion de phlébite, contrôle des artères du cou ou des membres, exploration de certains vaisseaux abdominaux.",
  preparation="Généralement aucune préparation. Portez des vêtements amples, faciles à retirer au niveau de la zone examinée.",
  deroulement="Comme pour une échographie, une sonde et du gel sont utilisés. Le médecin observe et mesure le flux sanguin. L'examen est indolore.",
  duree="20 à 40 minutes",
  resultats="Le médecin commente l'examen et remet un compte rendu à l'issue de la séance."),
 dict(id='radiographie', nom='Radiographie numérique', photo="Photo : salle de radiographie Atlas",
  intro="Une image rapide des os, des articulations et du thorax, avec une dose de rayons X maîtrisée grâce au numérique.",
  indications="Traumatisme ou suspicion de fracture, douleurs osseuses ou articulaires, toux persistante, contrôle du thorax.",
  preparation="Aucune préparation particulière. Retirez bijoux et objets métalliques sur la zone examinée. Signalez toute possibilité de grossesse.",
  deroulement="Vous êtes positionné(e) devant l'appareil par le manipulateur. Chaque image ne dure que quelques secondes. L'examen est indolore.",
  duree="10 à 15 minutes",
  resultats="Les images sont disponibles rapidement et le compte rendu vous est remis selon les délais du centre."),
 dict(id='scanner', nom='Scanner', photo="Photo : salle de scanner (à venir)", soon=True,
  intro="Un examen d'imagerie détaillé, qui produit des coupes précises du corps. Il sera bientôt disponible au Centre Atlas.",
  indications="Les indications seront précisées à l'ouverture du service.",
  preparation="Les consignes de préparation seront communiquées à l'ouverture du service.",
  deroulement="Les modalités de l'examen seront détaillées à l'ouverture du service.",
  duree="À préciser",
  resultats="À préciser"),
]

def exam(e):
    badge = ' <span class="badge" style="margin-left:.6rem">Prochainement disponible</span>' if e.get('soon') else ''
    btn = '<div style="margin-top:1.5rem"><span class="button is-disabled" aria-disabled="true">Rendez-vous : bientôt disponible</span></div>' if e.get('soon') else '<div style="margin-top:1.5rem"><a href="index.html#rendez-vous" class="button is-primary">Prendre rendez-vous pour cet examen</a></div>'
    return f'''      <article id="{e['id']}" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">{e['photo']}</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">{e['nom']}{badge}</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">{e['intro']}</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>{e['duree']}</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">{e['indications']}</p></div>
          <div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">{e['preparation']}</p></div>
          <div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">{e['deroulement']}</p></div>
          <div class="exam_detail"><h3>Résultats</h3><p class="text-style-muted">{e['resultats']}</p></div>
          {btn}
        </div>
      </article>
'''

nav = ''.join(f'<a href="#{e["id"]}">{e["nom"]}</a>' for e in EXAMS)
body = banner('Imagerie médicale', [('Accueil', 'index.html')]) + f'''
  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Imagerie médicale</span>
        <h2 class="heading-style-h2">Des examens expliqués simplement</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Pour chaque examen, retrouvez pourquoi il est prescrit, comment vous y préparer et comment il se déroule.</p>
      </div>
      <div class="exam_nav">{nav}</div>
{''.join(exam(e) for e in EXAMS)}      <p class="note-info">Les informations présentées sont générales. Votre médecin ou notre équipe vous donnent les consignes adaptées à votre situation lors de la prise de rendez-vous.</p>
    </div></div>
  </section>
''' + CTA
open('imagerie.html', 'w').write(page('Imagerie médicale à Dakar : échographie, Doppler, radiographie | Centre Médical Atlas', 'Échographie, Doppler et radiographie numérique à Dakar. Scanner prochainement disponible. Prenez rendez-vous au Centre Médical Atlas.', 'imagerie.html', body))
print('ok')
