<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Rhumatologie</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>">Spécialités</a><span>›</span><span>Rhumatologie</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow">Rhumatologie</span><p class="text-size-medium text-style-muted" style="margin-top:.6rem">La prise en charge des douleurs et maladies des articulations, du dos, des os et des muscles.</p></div>
        <div class="fiche_block reveal"><h2>Quand consulter ?</h2><ul class="list-check"><li>Douleurs articulaires ou du dos persistantes</li><li>Raideur matinale, gonflement d'une articulation</li><li>Douleurs après un effort ou un traumatisme</li><li>Suivi d'arthrose ou d'ostéoporose</li></ul></div>
        <div class="fiche_block reveal"><h2>Motifs pris en charge</h2><ul class="list-check"><li>Arthrose et douleurs articulaires</li><li>Lombalgies et douleurs du dos</li><li>Rhumatismes inflammatoires</li><li>Ostéoporose</li></ul></div>
        <div class="fiche_block reveal"><h2>Déroulement de la consultation</h2><ol class="fiche_steps"><li>Échange sur la localisation et l'histoire de la douleur</li><li>Examen des articulations et de la mobilité</li><li>Examens complémentaires si nécessaires</li><li>Plan de traitement et conseils au quotidien</li></ol></div>
        <div class="fiche_block reveal"><h2>Examens éventuellement associés</h2><ul class="list-check"><li>Radiographie numérique</li><li>Échographie articulaire</li><li>Bilan biologique sur prescription</li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Consulter en rhumatologie</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a><a href="tel:+221338678646" class="text-size-small" style="color:#fff">Ou appelez le 33 867 86 46</a></div>
        <div class="aside_links"><strong>Autres spécialités</strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>">Médecine générale</a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>">Cardiologie</a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>">Gynécologie</a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>">Gastro-entérologie</a><a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>">Neurologie</a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>" class="w--current">Rhumatologie</a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
