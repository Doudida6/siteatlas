"""Génère endoscopie.html et biopsie.html. Contenus indicatifs : à valider par les médecins du centre."""
from layout import page, banner, CTA

def render(exams, fields):
    out = ''
    for e in exams:
        badge = ' <span class="badge" style="margin-left:.6rem">Prochainement disponible</span>' if e.get('soon') else ''
        if e.get('soon'):
            btn = '<div style="margin-top:1.5rem"><span class="button is-disabled" aria-disabled="true">Rendez-vous : bientôt disponible</span></div>'
        else:
            btn = f'<div style="margin-top:1.5rem"><a href="rendez-vous.html" class="button is-primary">{e.get("cta", "Prendre rendez-vous pour cet examen")}</a></div>'
        details = ''.join(f'<div class="exam_detail"><h3>{lab}</h3><p class="text-style-muted">{e[k]}</p></div>' for lab, k in fields)
        out += f'''      <article id="{e['id']}" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">{e['photo']}</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">{e['nom']}{badge}</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">{e['intro']}</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>{e['duree']}</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          {details}
          {btn}
        </div>
      </article>
'''
    return out

def build(fname, title, desc, h1, eyebrow, h2, lead, exams, fields, note, extra=''):
    nav = ''.join(f'<a href="#{e["id"]}">{e["nom"]}</a>' for e in exams)
    body = banner(h1, [('Accueil', 'index.html')]) + f'''
  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">{eyebrow}</span>
        <h2 class="heading-style-h2">{h2}</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">{lead}</p>
      </div>
      <div class="exam_nav">{nav}</div>
{extra}{render(exams, fields)}      <p class="note-info">{note}</p>
    </div></div>
  </section>
''' + CTA
    open(fname, 'w').write(page(title, desc, fname, body))

# --- Endoscopie ---
F_ENDO = [("Indications", 'indications'), ("Préparation", 'preparation'), ("Déroulement", 'deroulement'),
          ("Sédation / anesthésie", 'sedation'), ("Après l'examen", 'apres')]
ENDO = [
 dict(id='fibroscopie', nom='Fibroscopie digestive', photo="Photo : salle d'endoscopie Atlas",
  intro="Un examen qui permet de regarder l'œsophage, l'estomac et le début de l'intestin grâce à un fin tuyau souple muni d'une caméra.",
  indications="Brûlures d'estomac persistantes, douleurs au niveau de l'estomac, difficultés à avaler, vomissements, anémie inexpliquée ou suivi d'une maladie digestive.",
  preparation="Être à jeun plusieurs heures avant l'examen. Signalez vos traitements (notamment anticoagulants), vos allergies et vos antécédents. Les consignes précises vous sont données lors du rendez-vous.",
  deroulement="Vous êtes allongé(e) sur le côté. Le médecin introduit doucement l'endoscope par la bouche et observe la muqueuse. Il peut réaliser de petits prélèvements (biopsies) si nécessaire.",
  sedation="Réalisée selon le protocole du centre et l'avis du médecin : anesthésie de la gorge et/ou sédation. Ce point vous est expliqué avant l'examen.",
  apres="Une période de surveillance est prévue. Vous devez être accompagné(e) si une sédation a été réalisée. Le médecin vous donne les premières conclusions et vous explique les suites.",
  duree="10 à 20 minutes (hors surveillance)", cta="Prendre rendez-vous pour une endoscopie"),
 dict(id='coloscopie', nom='Coloscopie', photo="Photo : matériel d'endoscopie",
  intro="Un examen qui permet d'observer l'intérieur du côlon avec un endoscope souple, pour rechercher ou surveiller certaines anomalies.",
  indications="Troubles du transit persistants, présence de sang dans les selles, douleurs abdominales, dépistage ou surveillance selon l'âge et les antécédents.",
  preparation="Une préparation intestinale est indispensable pour que l'examen soit fiable (régime adapté et solution à boire, selon les consignes du médecin). Elle vous est expliquée en détail lors du rendez-vous.",
  deroulement="Le médecin introduit doucement l'endoscope par l'anus et observe la muqueuse du côlon. Il peut retirer de petites lésions ou réaliser des prélèvements si nécessaire.",
  sedation="Réalisée selon le protocole du centre et l'avis du médecin. Ce point vous est expliqué avant l'examen.",
  apres="Une surveillance est prévue après l'examen. Quelques ballonnements peuvent persister un moment. Vous devez être accompagné(e) si une sédation a été réalisée. Le médecin vous explique les résultats et les suites.",
  duree="20 à 45 minutes (hors surveillance)", cta="Prendre rendez-vous pour une endoscopie"),
]
build('endoscopie.html', 'Endoscopie digestive à Dakar : fibroscopie, coloscopie | Centre Médical Atlas',
  'Fibroscopie et coloscopie à Dakar : indications, préparation, déroulement et suites. Prenez rendez-vous au Centre Médical Atlas.',
  'Endoscopie', 'Endoscopie digestive', 'Des explorations digestives, expliquées pas à pas',
  "Ces examens sont réalisés dans un environnement adapté, avec une équipe qui prend le temps de vous expliquer chaque étape.",
  ENDO, F_ENDO, "Les informations présentées sont générales. Le médecin adapte la préparation et le déroulement à votre situation lors de la consultation.")

# --- Biopsie ---
F_BIO = [("Pourquoi cet examen ?", 'pourquoi'), ("Préparation", 'preparation'), ("Déroulement", 'deroulement'),
         ("Anesthésie éventuelle", 'anesthesie'), ("Suites et précautions", 'suites')]
BIO = [
 dict(id='mammaire', nom='Biopsie mammaire', photo="Photo : espace dédié aux biopsies",
  intro="Un petit prélèvement effectué dans le sein pour analyser précisément une anomalie repérée à l'imagerie.",
  pourquoi="Une anomalie a été vue à l'échographie ou lors d'un autre examen. La biopsie permet de savoir de quoi il s'agit. Dans beaucoup de cas, il s'agit d'une lésion bénigne.",
  preparation="Selon les consignes du médecin : informer de vos traitements (anticoagulants) et de vos allergies, apporter vos examens d'imagerie.",
  deroulement="Guidée par l'imagerie, une fine aiguille prélève de petits fragments. Les prélèvements sont envoyés au laboratoire pour analyse.",
  anesthesie="Une anesthésie locale est en général réalisée, selon le protocole du centre.",
  suites="Quelques ecchymoses ou une sensibilité sont possibles. Les consignes de surveillance vous sont remises. Les résultats sont expliqués par le médecin.",
  duree="30 minutes environ"),
 dict(id='hepatique', nom='Biopsie hépatique', photo="Photo : espace dédié aux biopsies",
  intro="Un prélèvement d'un très petit fragment de foie pour mieux comprendre une anomalie ou évaluer une maladie du foie.",
  pourquoi="Le médecin a besoin de précisions que les analyses et l'imagerie ne suffisent pas à donner.",
  preparation="Bilan sanguin préalable, éventuel arrêt de certains traitements sur avis médical, et consignes de jeûne précisées lors du rendez-vous.",
  deroulement="Sous guidage d'imagerie, le médecin prélève un fragment de foie à l'aide d'une fine aiguille.",
  anesthesie="Une anesthésie locale est réalisée, selon le protocole du centre.",
  suites="Une période de repos et de surveillance est prévue après l'examen. Des consignes précises vous sont remises pour les heures suivantes.",
  duree="30 à 60 minutes, surveillance comprise à préciser"),
 dict(id='superficielle', nom='Biopsies de lésions superficielles', photo="Photo : espace dédié aux biopsies",
  intro="Un prélèvement d'une lésion située sous la peau ou près de la surface du corps, pour en connaître la nature.",
  pourquoi="Pour identifier une boule, un ganglion ou une lésion cutanée et orienter le traitement.",
  preparation="Peu de préparation en général. Signalez vos traitements et vos allergies.",
  deroulement="Après repérage à l'échographie si besoin, le médecin prélève un fragment de la lésion.",
  anesthesie="Anesthésie locale, selon le protocole du centre.",
  suites="Un petit pansement est posé. Les consignes de soins vous sont expliquées.",
  duree="15 à 30 minutes"),
 dict(id='echoguidee', nom='Biopsie échoguidée', photo="Photo : échographe et espace de biopsie",
  intro="Une biopsie réalisée sous contrôle de l'échographie, qui permet de viser la zone avec précision et en toute sécurité.",
  pourquoi="L'échographie permet de suivre l'aiguille en direct et de prélever exactement la zone concernée.",
  preparation="Selon l'organe concerné. Les consignes vous sont données au moment du rendez-vous.",
  deroulement="Le médecin repère la zone à l'échographie, puis réalise le prélèvement avec une fine aiguille.",
  anesthesie="Anesthésie locale le plus souvent, selon le protocole du centre.",
  suites="Surveillance courte, puis consignes remises avant le retour à domicile.",
  duree="20 à 40 minutes"),
 dict(id='scanoguidee', nom='Biopsie scanoguidée', photo="Photo : salle de scanner (à venir)", soon=True,
  intro="Une biopsie réalisée sous contrôle du scanner. Elle sera proposée dès l'ouverture du scanner au Centre Atlas.",
  pourquoi="À préciser à l'ouverture du service.", preparation="À préciser à l'ouverture du service.",
  deroulement="À préciser à l'ouverture du service.", anesthesie="À préciser à l'ouverture du service.",
  suites="À préciser à l'ouverture du service.", duree="À préciser"),
]
reassure = '''      <div class="note-info" style="margin-bottom:1rem"><strong>Une biopsie, c'est un petit prélèvement.</strong> Elle permet d'obtenir un diagnostic précis pour proposer le meilleur traitement. Notre équipe vous explique chaque étape et répond à toutes vos questions avant l'acte.</div>
'''
build('biopsie.html', 'Biopsie à Dakar : mammaire, hépatique, échoguidée | Centre Médical Atlas',
  'Biopsies guidées par l\'imagerie à Dakar : pourquoi, préparation, déroulement et suites. Une information claire et rassurante au Centre Médical Atlas.',
  'Biopsie', 'Biopsies guidées par l\'imagerie', 'Comprendre votre examen, sereinement',
  "Nous détaillons ici chaque type de biopsie : pourquoi elle est proposée, comment elle se déroule et ce qui se passe ensuite.",
  BIO, F_BIO, "Les informations présentées sont générales et ne remplacent pas l'avis de votre médecin. Les actes proposés dépendent de l'offre effective du centre.", extra=reassure)
print('ok')
