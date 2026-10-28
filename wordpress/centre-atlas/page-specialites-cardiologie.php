<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t0641fc0a'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>"><?php atlas_t('t4b581032'); ?></a><span>›</span><span><?php atlas_t('t0641fc0a'); ?></span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow"><?php atlas_t('t0641fc0a'); ?></span><p class="text-size-medium text-style-muted" style="margin-top:.6rem"><?php atlas_t('t07666467'); ?></p></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('tfa6579be'); ?></h2><ul class="list-check"><li><?php atlas_t('t7ab33c91'); ?></li><li><?php atlas_t('tcb38213c'); ?></li><li><?php atlas_t('tb4343c63'); ?></li><li><?php atlas_t('te405b9c7'); ?></li></ul></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('tf50194d5'); ?></h2><ul class="list-check"><li><?php atlas_t('t22484b56'); ?></li><li><?php atlas_t('tf187432b'); ?></li><li><?php atlas_t('t4deac9d2'); ?></li><li><?php atlas_t('t697846eb'); ?></li></ul></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('t6f01f37a'); ?></h2><ol class="fiche_steps"><li><?php atlas_t('ta18d55ca'); ?></li><li><?php atlas_t('t40e19765'); ?></li><li><?php atlas_t('t3b2481d6'); ?></li><li><?php atlas_t('t9332fdf5'); ?></li></ol></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('t6dc30dbd'); ?></h2><ul class="list-check"><li><?php atlas_t('t660fad32'); ?></li><li><?php atlas_t('td5bcac3d'); ?></li><li><?php atlas_t('t61a472cc'); ?></li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4"><?php atlas_t('tbf780552'); ?></h3><p class="text-size-small"><?php atlas_t('t72d60e5a'); ?></p><p class="text-size-small"><strong><?php atlas_t('tb7d49e88'); ?></strong><br><?php atlas_t('t47360aa2'); ?></p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center"><?php atlas_t('tda31472f'); ?></a><a href="tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>" class="text-size-small" style="color:#fff"><?php atlas_t('t8508db82'); ?></a></div>
        <div class="aside_links"><strong><?php atlas_t('t865b6b1a'); ?></strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>"><?php atlas_t('t49b96814'); ?></a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>" class="w--current"><?php atlas_t('t0641fc0a'); ?></a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>"><?php atlas_t('tfa4c9926'); ?></a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>"><?php atlas_t('tc62a5df5'); ?></a><a href="<?php echo esc_url(home_url('/specialites-diabetologie/')); ?>"><?php atlas_t('t0311621e'); ?></a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>"><?php atlas_t('td6bc365e'); ?></a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
