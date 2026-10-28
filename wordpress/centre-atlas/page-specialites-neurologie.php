<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Neurologie</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>">Spécialités</a><span>›</span><span>Neurologie</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow">Neurologie</span><p class="text-size-medium text-style-muted" style="margin-top:.6rem">L'évaluation et le suivi des maladies du système nerveux, du cerveau aux nerfs périphériques.</p></div>
        <div class="fiche_block reveal"><h2>Quand consulter ?</h2><ul class="list-check"><li>Maux de tête fréquents ou inhabituels</li><li>Vertiges, troubles de l'équilibre</li><li>Fourmillements, faiblesse d'un membre</li><li>Troubles de la mémoire ou du sommeil</li></ul></div>
        <div class="fiche_block reveal"><h2>Motifs pris en charge</h2><ul class="list-check"><li>Céphalées et migraines</li><li>Vertiges</li><li>Douleurs neurologiques</li><li>Suivi de maladies neurologiques</li></ul></div>
        <div class="fiche_block reveal"><h2>Déroulement de la consultation</h2><ol class="fiche_steps"><li>Recueil détaillé de vos symptômes</li><li>Examen neurologique (réflexes, force, équilibre)</li><li>Examens complémentaires si utiles</li><li>Traitement et suivi expliqués clairement</li></ol></div>
        <div class="fiche_block reveal"><h2>Examens éventuellement associés</h2><ul class="list-check"><li>Imagerie cérébrale, selon disponibilité</li><li>Bilan biologique sur prescription</li><li>Avis complémentaire d'un autre spécialiste</li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Consulter en neurologie</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a><a href="tel:+221338678646" class="text-size-small" style="color:#fff">Ou appelez le 33 867 86 46</a></div>
        <div class="aside_links"><strong>Autres spécialités</strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>">Médecine générale</a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>">Cardiologie</a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>">Gynécologie</a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>">Gastro-entérologie</a><a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>" class="w--current">Neurologie</a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>">Rhumatologie</a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
