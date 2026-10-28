<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('tdaba6bd5'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('tdaba6bd5'); ?></span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow"><?php atlas_t('te8e111ee'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('tc5ed0a53'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('t531c2820'); ?></p>
      </div>
      <div class="exam_nav"><a href="#fibroscopie"><?php atlas_t('tdd8cd5fd'); ?></a><a href="#coloscopie"><?php atlas_t('t9c079165'); ?></a></div>
      <article id="fibroscopie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('endoscopie-photo-salle-d-endoscopie-atlas'); ?>"<?php echo atlas_photo_attr('endoscopie-photo-salle-d-endoscopie-atlas', 'Photo : salle d\'endoscopie Atlas'); ?>><?php atlas_photo_label('endoscopie-photo-salle-d-endoscopie-atlas', 'Photo : salle d\'endoscopie Atlas'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('tdd8cd5fd'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t6e3d538a'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('tb450c7ac'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('ta432cf83'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('tcd02028e'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('t0131e51a'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tfbf1c652'); ?></h3><p class="text-style-muted"><?php atlas_t('tc59bc018'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tbb936348'); ?></h3><p class="text-style-muted"><?php atlas_t('teb6ab6e9'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('tb998dc87'); ?></a></div>
        </div>
      </article>
      <article id="coloscopie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder<?php echo atlas_photo_class('endoscopie-photo-materiel-d-endoscopie'); ?>"<?php echo atlas_photo_attr('endoscopie-photo-materiel-d-endoscopie', 'Photo : matériel d\'endoscopie'); ?>><?php atlas_photo_label('endoscopie-photo-materiel-d-endoscopie', 'Photo : matériel d\'endoscopie'); ?></div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem"><?php atlas_t('t9c079165'); ?></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem"><?php atlas_t('t0b95a819'); ?></p>
          <div class="exam_facts"><div class="exam_fact"><small><?php atlas_t('tfbafe486'); ?></small><?php atlas_t('t3d64996b'); ?></div><div class="exam_fact"><small><?php atlas_t('ta6be3418'); ?></small><?php atlas_t('t90f232e9'); ?></div></div>
          <div class="exam_detail"><h3><?php atlas_t('tb670b820'); ?></h3><p class="text-style-muted"><?php atlas_t('t096d13c8'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t2dae5ec7'); ?></h3><p class="text-style-muted"><?php atlas_t('tfe7c8c40'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('t47f58b9a'); ?></h3><p class="text-style-muted"><?php atlas_t('tc10a0b99'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tfbf1c652'); ?></h3><p class="text-style-muted"><?php atlas_t('te5ebd2f8'); ?></p></div><div class="exam_detail"><h3><?php atlas_t('tbb936348'); ?></h3><p class="text-style-muted"><?php atlas_t('tc69646cf'); ?></p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('tb998dc87'); ?></a></div>
        </div>
      </article>
      <p class="note-info"><?php atlas_t('tce79ccca'); ?></p>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
