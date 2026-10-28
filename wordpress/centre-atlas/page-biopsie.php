<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t127bf08d'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('t127bf08d'); ?></span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow"><?php atlas_t('t91ba9363'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('t6e603fc5'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('tc8042ca0'); ?></p>
      </div>
      <div class="exam_nav"><a href="#mammaire"><?php atlas_t('t24837cb1'); ?></a><a href="#hepatique"><?php atlas_t('t4f918d0e'); ?></a><a href="#superficielle"><?php atlas_t('tbfe00b9a'); ?></a><a href="#echoguidee"><?php atlas_t('t3846c266'); ?></a><a href="#scanoguidee"><?php atlas_t('tf3abc7c0'); ?></a></div>
      <div class="note-info" style="margin-bottom:1rem"><strong><?php atlas_t('t49be22ab'); ?></strong> <?php atlas_t('t18047a1b'); ?></div>
      <article id="mammaire" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biopsie-photo-espace-dedie-aux-biopsies'); ?>"<?php echo atlas_photo_attr('biopsie-photo-espace-dedie-aux-biopsies', 'Photo : espace dédié aux biopsies'); ?>><?php atlas_photo_label('biopsie-photo-espace-dedie-aux-biopsies', 'Photo : espace dédié aux biopsies'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t24837cb1'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('tee235ad6'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t6725a554'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tf009cf64'); ?></h3><p class="text-style-muted"><?php atlas_t('t18a92b60'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t101fe5e4'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('tdad17bd8'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t256c31f1'); ?></h3><p class="text-style-muted"><?php atlas_t('te2c8f4fa'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t5abb775e'); ?></h3><p class="text-style-muted"><?php atlas_t('ta64b2d22'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="hepatique" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biopsie-photo-espace-dedie-aux-biopsies-2'); ?>"<?php echo atlas_photo_attr('biopsie-photo-espace-dedie-aux-biopsies-2', 'Photo : espace dédié aux biopsies'); ?>><?php atlas_photo_label('biopsie-photo-espace-dedie-aux-biopsies-2', 'Photo : espace dédié aux biopsies'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t4f918d0e'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('taeb958e8'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('td6c4062e'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tf009cf64'); ?></h3><p class="text-style-muted"><?php atlas_t('t503e3850'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t7405343c'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('te64707b9'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t256c31f1'); ?></h3><p class="text-style-muted"><?php atlas_t('t6d3c2c79'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t5abb775e'); ?></h3><p class="text-style-muted"><?php atlas_t('t194ba582'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="superficielle" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biopsie-photo-espace-dedie-aux-biopsies-3'); ?>"<?php echo atlas_photo_attr('biopsie-photo-espace-dedie-aux-biopsies-3', 'Photo : espace dédié aux biopsies'); ?>><?php atlas_photo_label('biopsie-photo-espace-dedie-aux-biopsies-3', 'Photo : espace dédié aux biopsies'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('tbfe00b9a'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t672e4b96'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t17270bb6'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tf009cf64'); ?></h3><p class="text-style-muted"><?php atlas_t('tc46f670d'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t7991b499'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t7613a415'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t256c31f1'); ?></h3><p class="text-style-muted"><?php atlas_t('t70821988'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t5abb775e'); ?></h3><p class="text-style-muted"><?php atlas_t('tbd0cbe0a'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="echoguidee" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biopsie-photo-echographe-et-espace-de-biopsie'); ?>"<?php echo atlas_photo_attr('biopsie-photo-echographe-et-espace-de-biopsie', 'Photo : échographe et espace de biopsie'); ?>><?php atlas_photo_label('biopsie-photo-echographe-et-espace-de-biopsie', 'Photo : échographe et espace de biopsie'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t3846c266'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t05efb6c8'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('te0b982d0'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tf009cf64'); ?></h3><p class="text-style-muted"><?php atlas_t('tf967350c'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t0110006b'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t6626b080'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t256c31f1'); ?></h3><p class="text-style-muted"><?php atlas_t('t849ce90f'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t5abb775e'); ?></h3><p class="text-style-muted"><?php atlas_t('t3990ca95'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="scanoguidee" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biopsie-photo-salle-de-scanner-a-venir'); ?>"<?php echo atlas_photo_attr('biopsie-photo-salle-de-scanner-a-venir', 'Photo : salle de scanner (à venir)'); ?>><?php atlas_photo_label('biopsie-photo-salle-de-scanner-a-venir', 'Photo : salle de scanner (à venir)'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('tf3abc7c0'); ?> <span class="badge" style="margin-left:.6rem"><?php atlas_t('t63164a0b'); ?></span></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('tf4aeaa25'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('tafea7eb9'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tf009cf64'); ?></h3><p class="text-style-muted"><?php atlas_t('t09c1973a'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t09c1973a'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t09c1973a'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t256c31f1'); ?></h3><p class="text-style-muted"><?php atlas_t('t09c1973a'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t5abb775e'); ?></h3><p class="text-style-muted"><?php atlas_t('t09c1973a'); ?></p></div>
          <div style="margin-top:1.5rem"><span class="button is-disabled" aria-disabled="true"><?php atlas_t('tb23aeaa7'); ?></span></div>
        </div>
      </article>
      <p class="note-info"><?php atlas_t('td161e121'); ?></p>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
