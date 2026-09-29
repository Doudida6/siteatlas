"""Génère specialites.html + une fiche par spécialité.
Contenus indicatifs : à faire valider par les médecins du centre avant publication."""
from layout import page, banner, CTA

SPECS = [
 dict(slug='medecine-generale', nom='Médecine générale', icon='i-stetho',
  intro="Votre premier interlocuteur pour tout problème de santé, pour le suivi au long cours et l'orientation vers le bon spécialiste.",
  quand=["Fièvre, fatigue, toux, douleurs ou tout symptôme qui vous inquiète","Suivi d'une maladie chronique (tension, diabète…)","Bilan de santé, vaccination, certificat médical","Besoin d'un avis avant de consulter un spécialiste"],
  motifs=["Maladies courantes de l'adulte et de l'enfant","Suivi des maladies chroniques","Prévention et dépistage","Renouvellement et adaptation des traitements"],
  deroulement=["Échange sur vos symptômes et vos antécédents","Examen clinique complet","Explications, conseils et prescription si nécessaire","Orientation vers un spécialiste ou un examen si besoin"],
  examens=["Bilan biologique (sur prescription)","Échographie ou radiographie selon la situation","Avis spécialisé au sein du centre"]),
 dict(slug='cardiologie', nom='Cardiologie', icon='i-stetho',
  intro="Le dépistage, le suivi et la prise en charge des maladies du cœur et des vaisseaux.",
  quand=["Essoufflement, douleur thoracique ou palpitations","Hypertension artérielle ou antécédents familiaux","Bilan avant la reprise du sport","Suivi d'une maladie cardiaque connue"],
  motifs=["Hypertension artérielle","Troubles du rythme","Douleurs thoraciques et essoufflement","Suivi cardiovasculaire et prévention"],
  deroulement=["Recueil de vos symptômes et de vos antécédents","Mesure de la tension et examen clinique","Examens complémentaires si nécessaires","Explication des résultats et du plan de suivi"],
  examens=["Électrocardiogramme","Échographie cardiaque et Doppler, selon disponibilité","Bilan biologique sur prescription"]),
 dict(slug='gynecologie', nom='Gynécologie', icon='i-calendar',
  intro="Un suivi attentif et confidentiel de la santé des femmes, à chaque étape de la vie.",
  quand=["Suivi gynécologique régulier","Douleurs pelviennes ou troubles du cycle","Souhait de contraception ou de grossesse","Suivi de grossesse et échographies"],
  motifs=["Consultation de suivi et prévention","Troubles du cycle et douleurs","Contraception","Suivi de grossesse"],
  deroulement=["Échange confidentiel sur le motif de consultation","Examen adapté, toujours expliqué au préalable","Échographie si nécessaire","Conseils, prescription et prochain rendez-vous"],
  examens=["Échographie pelvienne ou obstétricale","Bilan biologique sur prescription","Imagerie mammaire, selon l'offre du centre"]),
 dict(slug='gastro-enterologie', nom='Gastro-entérologie', icon='i-tube',
  intro="La prise en charge des maladies de l'estomac, de l'intestin et du foie, avec accès aux explorations digestives sur place.",
  quand=["Brûlures d'estomac, douleurs abdominales, ballonnements","Troubles du transit persistants","Amaigrissement ou saignement digestif","Suivi d'une maladie digestive ou hépatique"],
  motifs=["Reflux et maux d'estomac","Troubles du transit","Maladies du foie","Dépistage et surveillance digestive"],
  deroulement=["Consultation pour comprendre vos symptômes","Examen clinique de l'abdomen","Décision d'examen éventuel (échographie, endoscopie)","Explication des résultats et du traitement"],
  examens=["Fibroscopie digestive","Coloscopie","Échographie abdominale","Biopsies si nécessaire"]),
 dict(slug='neurologie', nom='Neurologie', icon='i-target',
  intro="L'évaluation et le suivi des maladies du système nerveux, du cerveau aux nerfs périphériques.",
  quand=["Maux de tête fréquents ou inhabituels","Vertiges, troubles de l'équilibre","Fourmillements, faiblesse d'un membre","Troubles de la mémoire ou du sommeil"],
  motifs=["Céphalées et migraines","Vertiges","Douleurs neurologiques","Suivi de maladies neurologiques"],
  deroulement=["Recueil détaillé de vos symptômes","Examen neurologique (réflexes, force, équilibre)","Examens complémentaires si utiles","Traitement et suivi expliqués clairement"],
  examens=["Imagerie cérébrale, selon disponibilité","Bilan biologique sur prescription","Avis complémentaire d'un autre spécialiste"]),
 dict(slug='rhumatologie', nom='Rhumatologie', icon='i-scan',
  intro="La prise en charge des douleurs et maladies des articulations, du dos, des os et des muscles.",
  quand=["Douleurs articulaires ou du dos persistantes","Raideur matinale, gonflement d'une articulation","Douleurs après un effort ou un traumatisme","Suivi d'arthrose ou d'ostéoporose"],
  motifs=["Arthrose et douleurs articulaires","Lombalgies et douleurs du dos","Rhumatismes inflammatoires","Ostéoporose"],
  deroulement=["Échange sur la localisation et l'histoire de la douleur","Examen des articulations et de la mobilité","Examens complémentaires si nécessaires","Plan de traitement et conseils au quotidien"],
  examens=["Radiographie numérique","Échographie articulaire","Bilan biologique sur prescription"]),
]

def li(items): return ''.join(f'<li>{i}</li>' for i in items)

# --- Page générale ---
cards = ''.join(f'''        <a href="specialites-{s['slug']}.html" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#{s['icon']}"/></svg></span><h3 class="heading-style-h4">{s['nom']}</h3><p class="text-size-small text-style-muted">{s['intro']}</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>\n''' for s in SPECS)
body = banner('Spécialités', [('Accueil', 'index.html')]) + f'''
  <section class="padding-section-large background-color-tint">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Nos expertises médicales</span>
        <h2 class="heading-style-h2">Des spécialistes à votre écoute</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Chaque spécialité est présentée simplement : quand consulter, comment se déroule la consultation et quels examens peuvent être associés.</p>
      </div>
      <div class="spec_grid">
{cards}      </div>
    </div></div>
  </section>
''' + CTA
open('specialites.html', 'w').write(page('Spécialités médicales à Dakar | Centre Médical Atlas', 'Médecine générale, cardiologie, gynécologie, gastro-entérologie, neurologie et rhumatologie au Centre Médical Atlas, Dakar.', 'specialites.html', body))

# --- Fiches ---
for s in SPECS:
    def lien(o):
        cur = ' class="w--current"' if o is s else ''
        return f'<a href="specialites-{o["slug"]}.html"{cur}>{o["nom"]}</a>'
    nav = ''.join(lien(o) for o in SPECS)
    body = banner(s['nom'], [('Accueil', 'index.html'), ('Spécialités', 'specialites.html')]) + f'''
  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow">{s['nom']}</span><p class="text-size-medium text-style-muted" style="margin-top:.6rem">{s['intro']}</p></div>
        <div class="fiche_block reveal"><h2>Quand consulter ?</h2><ul class="list-check">{li(s['quand'])}</ul></div>
        <div class="fiche_block reveal"><h2>Motifs pris en charge</h2><ul class="list-check">{li(s['motifs'])}</ul></div>
        <div class="fiche_block reveal"><h2>Déroulement de la consultation</h2><ol class="fiche_steps">{li(s['deroulement'])}</ol></div>
        <div class="fiche_block reveal"><h2>Examens éventuellement associés</h2><ul class="list-check">{li(s['examens'])}</ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Consulter en {s['nom'].lower()}</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="rendez-vous.html" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a><a href="tel:+221338678646" class="text-size-small" style="color:#fff">Ou appelez le 33 867 86 46</a></div>
        <div class="aside_links"><strong>Autres spécialités</strong>{nav}</div>
      </aside>
    </div></div>
  </section>
''' + CTA
    open(f'specialites-{s["slug"]}.html', 'w').write(page(f'{s["nom"]} à Dakar | Centre Médical Atlas', s['intro'], 'specialites.html', body))
print('ok')
