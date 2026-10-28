<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('tc62a5df5'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><a href="<?php echo esc_url(home_url('/specialites/')); ?>"><?php atlas_t('t4b581032'); ?></a><span>›</span><span><?php atlas_t('tc62a5df5'); ?></span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par le médecin du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large fiche_grid">
      <div>
        <div class="fiche_block"><span class="text-style-eyebrow"><?php atlas_t('tc62a5df5'); ?></span><p class="text-size-medium text-style-muted" style="margin-top:.6rem"><?php atlas_t('t55fe3baa'); ?></p></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('tfa6579be'); ?></h2><ul class="list-check"><li><?php atlas_t('taa8a35b8'); ?></li><li><?php atlas_t('td5e76db3'); ?></li><li><?php atlas_t('t3caaeba7'); ?></li><li><?php atlas_t('t4efe30ee'); ?></li></ul></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('tf50194d5'); ?></h2><ul class="list-check"><li><?php atlas_t('t285a762d'); ?></li><li><?php atlas_t('te5a1dcdf'); ?></li><li><?php atlas_t('t1e38f925'); ?></li><li><?php atlas_t('ta0f8b7c5'); ?></li></ul></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('t6f01f37a'); ?></h2><ol class="fiche_steps"><li><?php atlas_t('t369d08c0'); ?></li><li><?php atlas_t('t458aa3ae'); ?></li><li><?php atlas_t('t77282b5d'); ?></li><li><?php atlas_t('ta17895b4'); ?></li></ol></div>
        <div class="fiche_block reveal"><h2><?php atlas_t('t6dc30dbd'); ?></h2><ul class="list-check"><li><?php atlas_t('tdd8cd5fd'); ?></li><li><?php atlas_t('t9c079165'); ?></li><li><?php atlas_t('t864c9aa9'); ?></li><li><?php atlas_t('t323d0282'); ?></li></ul></div>
      </div>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4"><?php atlas_t('ta3a437fa'); ?></h3><p class="text-size-small"><?php atlas_t('t72d60e5a'); ?></p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center"><?php atlas_t('tda31472f'); ?></a><a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>" class="text-size-small" style="color:#fff"><?php atlas_t('t709b971a'); ?></a></div>
        <div class="aside_links"><strong><?php atlas_t('t865b6b1a'); ?></strong><a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>"><?php atlas_t('t49b96814'); ?></a><a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>"><?php atlas_t('t0641fc0a'); ?></a><a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>"><?php atlas_t('tfa4c9926'); ?></a><a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>" class="w--current"><?php atlas_t('tc62a5df5'); ?></a><a href="<?php echo esc_url(home_url('/specialites-diabetologie/')); ?>"><?php atlas_t('t0311621e'); ?></a><a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>"><?php atlas_t('td6bc365e'); ?></a></div>
      </aside>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
