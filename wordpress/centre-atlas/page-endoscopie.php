<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Endoscopie</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Endoscopie</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Endoscopie digestive</span>
        <h2 class="heading-style-h2">Des explorations digestives, expliquées pas à pas</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Ces examens sont réalisés dans un environnement adapté, avec une équipe qui prend le temps de vous expliquer chaque étape.</p>
      </div>
      <div class="exam_nav"><a href="#fibroscopie">Fibroscopie digestive</a><a href="#coloscopie">Coloscopie</a></div>
      <article id="fibroscopie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">Photo : salle d'endoscopie Atlas</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">Fibroscopie digestive</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">Un examen qui permet de regarder l'œsophage, l'estomac et le début de l'intestin grâce à un fin tuyau souple muni d'une caméra.</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>10 à 20 minutes (hors surveillance)</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">Brûlures d'estomac persistantes, douleurs au niveau de l'estomac, difficultés à avaler, vomissements, anémie inexpliquée ou suivi d'une maladie digestive.</p></div><div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">Être à jeun plusieurs heures avant l'examen. Signalez vos traitements (notamment anticoagulants), vos allergies et vos antécédents. Les consignes précises vous sont données lors du rendez-vous.</p></div><div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">Vous êtes allongé(e) sur le côté. Le médecin introduit doucement l'endoscope par la bouche et observe la muqueuse. Il peut réaliser de petits prélèvements (biopsies) si nécessaire.</p></div><div class="exam_detail"><h3>Sédation / anesthésie</h3><p class="text-style-muted">Réalisée selon le protocole du centre et l'avis du médecin : anesthésie de la gorge et/ou sédation. Ce point vous est expliqué avant l'examen.</p></div><div class="exam_detail"><h3>Après l'examen</h3><p class="text-style-muted">Une période de surveillance est prévue. Vous devez être accompagné(e) si une sédation a été réalisée. Le médecin vous donne les premières conclusions et vous explique les suites.</p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous pour une endoscopie</a></div>
        </div>
      </article>
      <article id="coloscopie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">Photo : matériel d'endoscopie</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">Coloscopie</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">Un examen qui permet d'observer l'intérieur du côlon avec un endoscope souple, pour rechercher ou surveiller certaines anomalies.</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>20 à 45 minutes (hors surveillance)</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">Troubles du transit persistants, présence de sang dans les selles, douleurs abdominales, dépistage ou surveillance selon l'âge et les antécédents.</p></div><div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">Une préparation intestinale est indispensable pour que l'examen soit fiable (régime adapté et solution à boire, selon les consignes du médecin). Elle vous est expliquée en détail lors du rendez-vous.</p></div><div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">Le médecin introduit doucement l'endoscope par l'anus et observe la muqueuse du côlon. Il peut retirer de petites lésions ou réaliser des prélèvements si nécessaire.</p></div><div class="exam_detail"><h3>Sédation / anesthésie</h3><p class="text-style-muted">Réalisée selon le protocole du centre et l'avis du médecin. Ce point vous est expliqué avant l'examen.</p></div><div class="exam_detail"><h3>Après l'examen</h3><p class="text-style-muted">Une surveillance est prévue après l'examen. Quelques ballonnements peuvent persister un moment. Vous devez être accompagné(e) si une sédation a été réalisée. Le médecin vous explique les résultats et les suites.</p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous pour une endoscopie</a></div>
        </div>
      </article>
      <p class="note-info">Les informations présentées sont générales. Le médecin adapte la préparation et le déroulement à votre situation lors de la consultation.</p>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
