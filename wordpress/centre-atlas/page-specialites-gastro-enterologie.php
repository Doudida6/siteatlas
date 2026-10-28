<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Gastro-entérologie</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>">Spécialités</a><span>›</span><span>Gastro-entérologie</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow">Gastro-entérologie</span><p class="text-size-medium text-style-muted" style="margin-top:.6rem">La prise en charge des maladies de l'estomac, de l'intestin et du foie, avec accès aux explorations digestives sur place.</p></div>
        <div class="fiche_block reveal"><h2>Quand consulter ?</h2><ul class="list-check"><li>Brûlures d'estomac, douleurs abdominales, ballonnements</li><li>Troubles du transit persistants</li><li>Amaigrissement ou saignement digestif</li><li>Suivi d'une maladie digestive ou hépatique</li></ul></div>
        <div class="fiche_block reveal"><h2>Motifs pris en charge</h2><ul class="list-check"><li>Reflux et maux d'estomac</li><li>Troubles du transit</li><li>Maladies du foie</li><li>Dépistage et surveillance digestive</li></ul></div>
        <div class="fiche_block reveal"><h2>Déroulement de la consultation</h2><ol class="fiche_steps"><li>Consultation pour comprendre vos symptômes</li><li>Examen clinique de l'abdomen</li><li>Décision d'examen éventuel (échographie, endoscopie)</li><li>Explication des résultats et du traitement</li></ol></div>
        <div class="fiche_block reveal"><h2>Examens éventuellement associés</h2><ul class="list-check"><li>Fibroscopie digestive</li><li>Coloscopie</li><li>Échographie abdominale</li><li>Biopsies si nécessaire</li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Consulter en gastro-entérologie</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a><a href="tel:+221338678646" class="text-size-small" style="color:#fff">Ou appelez le 33 867 86 46</a></div>
        <div class="aside_links"><strong>Autres spécialités</strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>">Médecine générale</a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>">Cardiologie</a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>">Gynécologie</a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>" class="w--current">Gastro-entérologie</a><a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>">Neurologie</a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>">Rhumatologie</a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
