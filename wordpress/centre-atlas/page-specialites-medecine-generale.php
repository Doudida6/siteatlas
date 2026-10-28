<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Médecine générale</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>">Spécialités</a><span>›</span><span>Médecine générale</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow">Médecine générale</span><p class="text-size-medium text-style-muted" style="margin-top:.6rem">Votre premier interlocuteur pour tout problème de santé, pour le suivi au long cours et l'orientation vers le bon spécialiste.</p></div>
        <div class="fiche_block reveal"><h2>Quand consulter ?</h2><ul class="list-check"><li>Fièvre, fatigue, toux, douleurs ou tout symptôme qui vous inquiète</li><li>Suivi d'une maladie chronique (tension, diabète…)</li><li>Bilan de santé, vaccination, certificat médical</li><li>Besoin d'un avis avant de consulter un spécialiste</li></ul></div>
        <div class="fiche_block reveal"><h2>Motifs pris en charge</h2><ul class="list-check"><li>Maladies courantes de l'adulte et de l'enfant</li><li>Suivi des maladies chroniques</li><li>Prévention et dépistage</li><li>Renouvellement et adaptation des traitements</li></ul></div>
        <div class="fiche_block reveal"><h2>Déroulement de la consultation</h2><ol class="fiche_steps"><li>Échange sur vos symptômes et vos antécédents</li><li>Examen clinique complet</li><li>Explications, conseils et prescription si nécessaire</li><li>Orientation vers un spécialiste ou un examen si besoin</li></ol></div>
        <div class="fiche_block reveal"><h2>Examens éventuellement associés</h2><ul class="list-check"><li>Bilan biologique (sur prescription)</li><li>Échographie ou radiographie selon la situation</li><li>Avis spécialisé au sein du centre</li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4">Consulter en médecine générale</h3><p class="text-size-small">Faites votre demande, notre équipe vous rappelle pour confirmer un créneau.</p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a><a href="tel:+221338678646" class="text-size-small" style="color:#fff">Ou appelez le 33 867 86 46</a></div>
        <div class="aside_links"><strong>Autres spécialités</strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>" class="w--current">Médecine générale</a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>">Cardiologie</a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>">Gynécologie</a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>">Gastro-entérologie</a><a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>">Neurologie</a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>">Rhumatologie</a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
