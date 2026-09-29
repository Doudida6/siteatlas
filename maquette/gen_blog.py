"""Génère blog.html et un exemple d'article. Contenus d'exemple : à remplacer/valider par le centre."""
from layout import page, banner, CTA

ARTS = [
 dict(t="Échographie abdominale : comment s'y préparer ?", cat='Imagerie', d='12 octobre 2026', lect='4 min', ex="Jeûne, vessie pleine, ordonnance : les réponses aux questions les plus fréquentes avant votre examen."),
 dict(t="Brûlures d'estomac : quand faut-il consulter ?", cat='Gastro-entérologie', d='5 octobre 2026', lect='3 min', ex="Reconnaître les signes qui justifient un avis médical et ce qu'on peut vous proposer."),
 dict(t="Tension artérielle : les bons réflexes", cat='Cardiologie', d='28 septembre 2026', lect='4 min', ex="Pourquoi la surveiller, comment la mesurer correctement et quand en parler à votre médecin."),
 dict(t="Douleurs du dos : quand s'en préoccuper ?", cat='Rhumatologie', d='20 septembre 2026', lect='3 min', ex="Les situations où une consultation est utile, et les gestes simples du quotidien."),
 dict(t="Comprendre la coloscopie", cat='Endoscopie', d='12 septembre 2026', lect='5 min', ex="À quoi sert cet examen, comment se préparer et ce qui se passe le jour J."),
 dict(t="Le suivi gynécologique : pourquoi consulter régulièrement ?", cat='Gynécologie', d='3 septembre 2026', lect='3 min', ex="Un rendez-vous de prévention pour être accompagnée à chaque étape de la vie."),
]
cats = ['Imagerie', 'Endoscopie', 'Cardiologie', 'Gastro-entérologie', 'Gynécologie', 'Rhumatologie']
filters = '<button class="blog_filter is-active" data-filter="all">Tous</button>' + ''.join(f'<button class="blog_filter" data-filter="{c}">{c}</button>' for c in cats)
feat = ARTS[0]
def card(a):
    return f'''        <a href="article-exemple.html" class="blog_card reveal" data-cat="{a['cat']}"><div class="photo-placeholder">Photo de l'article</div><div class="blog_card-body"><div class="blog_meta"><span class="chip">{a['cat']}</span><span>{a['d']}</span></div><h3 class="heading-style-h4">{a['t']}</h3><p class="text-size-small text-style-muted">{a['ex']}</p><span class="quick_link text-color-accent">Lire l'article <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
'''
body = banner('Conseils santé', [('Accueil', 'index.html')]) + f'''
  <!-- Articles d'exemple : à remplacer et à faire valider par les médecins du centre -->
  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Actualités &amp; conseils</span>
        <h2 class="heading-style-h2">Comprendre pour mieux se soigner</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Des articles simples, rédigés avec nos médecins, pour vous aider à comprendre vos examens et votre santé.</p>
      </div>
      <div class="blog_filters">{filters}</div>
      <a href="article-exemple.html" class="blog_featured reveal" data-cat="{feat['cat']}">
        <div class="photo-placeholder">Photo de l'article à la une</div>
        <div class="blog_featured-body"><div class="blog_meta"><span class="chip">{feat['cat']}</span><span>{feat['d']}</span><span>{feat['lect']} de lecture</span></div><h2 class="heading-style-h2" style="font-size:1.9rem">{feat['t']}</h2><p class="text-style-muted">{feat['ex']}</p><span class="button is-primary" style="justify-self:start">Lire l'article</span></div>
      </a>
      <div class="blog_grid">
{''.join(card(a) for a in ARTS[1:])}      </div>
    </div></div>
  </section>
''' + CTA
open('blog.html', 'w').write(page('Conseils santé et actualités | Centre Médical Atlas, Dakar', "Conseils santé, explications d'examens et actualités du Centre Médical Atlas à Dakar.", 'blog.html', body))

# --- Article d'exemple ---
rel = ''.join(f'<a href="article-exemple.html">{a["t"]}</a>' for a in ARTS[1:4])
body = banner('Échographie abdominale : comment s\'y préparer ?', [('Accueil', 'index.html'), ('Conseils santé', 'blog.html')]) + f'''
  <!-- Article d'exemple : contenu à remplacer et à valider par les médecins du centre -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large article_grid">
      <article>
        <div class="blog_meta" style="margin-bottom:1.25rem"><span class="chip">Imagerie</span><span>12 octobre 2026</span><span>4 min de lecture</span><span>Rédigé avec l'équipe médicale du Centre Atlas</span></div>
        <div class="article_cover photo-placeholder">Photo de couverture de l'article</div>
        <div class="article_body">
          <p><strong>L'échographie abdominale est un examen simple et indolore. Bien s'y préparer permet d'obtenir des images de qualité et un résultat fiable.</strong></p>
          <h2>À quoi sert cet examen ?</h2>
          <p>L'échographie utilise des ultrasons, sans rayons X, pour observer plusieurs organes du ventre. Votre médecin peut la prescrire, par exemple, en cas de douleurs abdominales ou pour explorer le foie, la vésicule biliaire ou les reins.</p>
          <h2>Comment se préparer ?</h2>
          <p>La préparation dépend de l'organe examiné. Elle vous est précisée au moment de la prise de rendez-vous. En règle générale :</p>
          <ul>
            <li>Il peut vous être demandé d'être à jeun quelques heures avant l'examen.</li>
            <li>Dans certains cas, il faut avoir la vessie pleine : vous en serez informé(e) à l'avance.</li>
            <li>Apportez votre ordonnance et vos anciens examens d'imagerie.</li>
          </ul>
          <div class="callout"><strong>Bon à savoir :</strong> en cas de doute sur la préparation, appelez notre équipe. Il vaut mieux poser la question que reporter l'examen.</div>
          <h2>Comment se déroule l'examen ?</h2>
          <p>Vous êtes allongé(e) confortablement. Le médecin applique un gel tiède sur la peau et déplace doucement une sonde. L'examen dure en général entre 15 et 30 minutes et ne provoque pas de douleur.</p>
          <h2>Et après ?</h2>
          <p>Le médecin vous explique ses premières constatations, puis un compte rendu vous est remis. Vous pouvez reprendre vos activités immédiatement.</p>
          <p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
        </div>
      </article>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Une échographie à prévoir ?</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="rendez-vous.html" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a></div>
        <div class="aside_links"><strong>À lire aussi</strong>{rel}</div>
      </aside>
    </div></div>
  </section>
''' + CTA
open('article-exemple.html', 'w').write(page("Échographie abdominale : comment s'y préparer ? | Centre Médical Atlas", "Jeûne, vessie pleine, ordonnance : tout savoir pour bien préparer votre échographie abdominale à Dakar.", 'blog.html', body))
print('ok')
