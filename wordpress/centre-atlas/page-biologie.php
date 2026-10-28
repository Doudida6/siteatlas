<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t2785781c'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('t2785781c'); ?></span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow"><?php atlas_t('tc2fd52b0'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('t05c44bda'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('tee9ba357'); ?></p>
      </div>
      <div class="exam_nav"><a href="#prise-de-sang"><?php atlas_t('tc66c7e4a'); ?></a><a href="#glycemie"><?php atlas_t('t0fbf71c2'); ?></a><a href="#bilan-lipidique"><?php atlas_t('t0eaa256d'); ?></a></div>
      <article id="prise-de-sang" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biologie-photo-espace-de-prelevement-atlas'); ?>"<?php echo atlas_photo_attr('biologie-photo-espace-de-prelevement-atlas', 'Photo : espace de prélèvement Atlas'); ?>><?php atlas_photo_label('biologie-photo-espace-de-prelevement-atlas', 'Photo : espace de prélèvement Atlas'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('tc66c7e4a'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('td42a3acd'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t061b5067'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('ta023cefe'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('te86ef201'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('tdb882187'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('t16d442ee'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('t7baef421'); ?></a></div>
        </div>
      </article>
      <article id="glycemie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biologie-photo-analyses-de-laboratoire'); ?>"<?php echo atlas_photo_attr('biologie-photo-analyses-de-laboratoire', 'Photo : analyses de laboratoire'); ?>><?php atlas_photo_label('biologie-photo-analyses-de-laboratoire', 'Photo : analyses de laboratoire'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t0fbf71c2'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t9f300a67'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t061b5067'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('t8e11ae73'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t49581646'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t6115db6e'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('t381b12d6'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('t7baef421'); ?></a></div>
        </div>
      </article>
      <article id="bilan-lipidique" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('biologie-photo-analyses-de-laboratoire-2'); ?>"<?php echo atlas_photo_attr('biologie-photo-analyses-de-laboratoire-2', 'Photo : analyses de laboratoire'); ?>><?php atlas_photo_label('biologie-photo-analyses-de-laboratoire-2', 'Photo : analyses de laboratoire'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t0eaa256d'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t61a49584'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t061b5067'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('tabbd189d'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t001e6ef0'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t9579ce62'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('tddbba684'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('t7baef421'); ?></a></div>
        </div>
      </article>
      <p class="note-info"><?php atlas_t('t447119ef'); ?></p>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
