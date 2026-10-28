<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t70e91475'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('t70e91475'); ?></span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow"><?php atlas_t('t70e91475'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('t7dd9b179'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('t6f19b8a0'); ?></p>
      </div>
      <div class="exam_nav"><a href="#echographie"><?php atlas_t('ta1f6683d'); ?></a><a href="#doppler"><?php atlas_t('t7caa8bb2'); ?></a><a href="#radiographie"><?php atlas_t('td45c5a60'); ?></a><a href="#scanner"><?php atlas_t('t948505fb'); ?></a></div>
      <article id="echographie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('imagerie-photo-salle-d-echographie-atlas'); ?>"<?php echo atlas_photo_attr('imagerie-photo-salle-d-echographie-atlas', 'Photo : salle d\'échographie Atlas'); ?>><?php atlas_photo_label('imagerie-photo-salle-d-echographie-atlas', 'Photo : salle d\'échographie Atlas'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('ta1f6683d'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('te2851548'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t17270bb6'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('ta1e1ea7b'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t8c85c8f7'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t56510cf4'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('t11484e44'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="doppler" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('imagerie-photo-examen-doppler'); ?>"<?php echo atlas_photo_attr('imagerie-photo-examen-doppler', 'Photo : examen Doppler'); ?>><?php atlas_photo_label('imagerie-photo-examen-doppler', 'Photo : examen Doppler'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t7caa8bb2'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t0cccf2ab'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('te0b982d0'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('tb80f503e'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('t5e8d08ea'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t60b11f3c'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('t93d5a68c'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="radiographie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('imagerie-photo-salle-de-radiographie-atlas'); ?>"<?php echo atlas_photo_attr('imagerie-photo-salle-de-radiographie-atlas', 'Photo : salle de radiographie Atlas'); ?>><?php atlas_photo_label('imagerie-photo-salle-de-radiographie-atlas', 'Photo : salle de radiographie Atlas'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('td45c5a60'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('te61abbc4'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t4f0cddeb'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('t46238797'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('tf82955da'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t806693e0'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('ta6b6828e'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('te79a3c8f'); ?></a></div>
        </div>
      </article>
      <article id="scanner" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('imagerie-photo-salle-de-scanner-a-venir'); ?>"<?php echo atlas_photo_attr('imagerie-photo-salle-de-scanner-a-venir', 'Photo : salle de scanner (à venir)'); ?>><?php atlas_photo_label('imagerie-photo-salle-de-scanner-a-venir', 'Photo : salle de scanner (à venir)'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t948505fb'); ?> <span class="badge" style="margin-left:.6rem"><?php atlas_t('t63164a0b'); ?></span></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t49f55361'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('tafea7eb9'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('t6c448251'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('td90f2f07'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t5295a017'); ?></p></div>
          <div class="exam_detail"><h3><?php atlas_t('tf21a7fd5'); ?></h3><p class="text-style-muted"><?php atlas_t('tafea7eb9'); ?></p></div>
          <div style="margin-top:1.5rem"><span class="button is-disabled" aria-disabled="true"><?php atlas_t('tb23aeaa7'); ?></span></div>
        </div>
      </article>
      <p class="note-info"><?php atlas_t('t4660bf5e'); ?></p>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
