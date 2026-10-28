<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Gynécologie</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>">Spécialités</a><span>›</span><span>Gynécologie</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow">Gynécologie</span><p class="text-size-medium text-style-muted" style="margin-top:.6rem">Un suivi attentif et confidentiel de la santé des femmes, à chaque étape de la vie.</p></div>
        <div class="fiche_block reveal"><h2>Quand consulter ?</h2><ul class="list-check"><li>Suivi gynécologique régulier</li><li>Douleurs pelviennes ou troubles du cycle</li><li>Souhait de contraception ou de grossesse</li><li>Suivi de grossesse et échographies</li></ul></div>
        <div class="fiche_block reveal"><h2>Motifs pris en charge</h2><ul class="list-check"><li>Consultation de suivi et prévention</li><li>Troubles du cycle et douleurs</li><li>Contraception</li><li>Suivi de grossesse</li></ul></div>
        <div class="fiche_block reveal"><h2>Déroulement de la consultation</h2><ol class="fiche_steps"><li>Échange confidentiel sur le motif de consultation</li><li>Examen adapté, toujours expliqué au préalable</li><li>Échographie si nécessaire</li><li>Conseils, prescription et prochain rendez-vous</li></ol></div>
        <div class="fiche_block reveal"><h2>Examens éventuellement associés</h2><ul class="list-check"><li>Échographie pelvienne ou obstétricale</li><li>Bilan biologique sur prescription</li><li>Imagerie mammaire, selon l'offre du centre</li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Consulter en gynécologie</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a><a href="tel:+221338678646" class="text-size-small" style="color:#fff">Ou appelez le 33 867 86 46</a></div>
        <div class="aside_links"><strong>Autres spécialités</strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>">Médecine générale</a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>">Cardiologie</a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>" class="w--current">Gynécologie</a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>">Gastro-entérologie</a><a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>">Neurologie</a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>">Rhumatologie</a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
