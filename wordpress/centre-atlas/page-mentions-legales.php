<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t6ba68484'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('t6ba68484'); ?></span></div>
    </div></div>
  </section>

  <!-- Texte juridique : à relire et faire valider par le centre (ou son conseil juridique) avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large" style="max-width:860px">
      <div class="article_body legal_body">
        <p class="text-style-muted"><?php atlas_t('t0f6b9e84'); ?></p>
        <h2><?php atlas_t('tcb66a121'); ?></h2>
        <ul>
          <li>Raison sociale : <?php echo esc_html(atlas_opt('raison_sociale')); ?></li>
          <li>Forme juridique : <?php echo esc_html(atlas_opt('forme_juridique')); ?></li>
          <li>Siège : <?php echo esc_html(atlas_opt('adresse')); ?>, Sénégal</li>
          <li>NINEA : <?php echo esc_html(atlas_opt('ninea')); ?></li>
          <li>RCCM : <?php echo esc_html(atlas_opt('rccm')); ?></li>
          <li>Téléphone : <?php echo esc_html(atlas_opt('tel_mobile')); ?> / <?php echo esc_html(atlas_opt('tel_fixe')); ?></li>
          <li>Email : <?php echo esc_html(atlas_opt('email')); ?></li>
        </ul>
        <p>Directeur de la publication : <?php echo esc_html(atlas_opt('directeur')); ?>.</p>
        <h2><?php atlas_t('t665e1654'); ?></h2>
        <p>Le Centre Médical Atlas est un centre médical privé. Les informations relatives à son autorisation d'exercer et à l'inscription de ses médecins auprès de l'Ordre national des médecins du Sénégal : <?php echo esc_html(atlas_opt('autorisation')); ?>.</p>
        <h2><?php atlas_t('tefe15857'); ?></h2>
        <p><?php atlas_t('t764d8054'); ?></p>
        <h2><?php atlas_t('tf719d179'); ?></h2>
        <p><?php atlas_t('t68ac1fd4'); ?> <a href="https://digifab.agency/" target="_blank" rel="noopener"><?php atlas_t('ta7071cbc'); ?></a>.</p>
        <h2><?php atlas_t('tfd09f90a'); ?></h2>
        <p><?php atlas_t('tfd58eacc'); ?></p>
        <h2><?php atlas_t('tc44cb3cb'); ?></h2>
        <p><?php atlas_t('tb2c92b36'); ?></p>
        <div class="callout"><strong><?php atlas_t('ta62fee5c'); ?></strong> <?php atlas_t('ta7a2c31c'); ?></div>
        <h2><?php atlas_t('t49db0c4e'); ?></h2>
        <p><?php atlas_t('t3dced470'); ?></p>
        <h2><?php atlas_t('t3b205c88'); ?></h2>
        <p><?php atlas_t('tac22000e'); ?> <a href="<?php echo esc_url(home_url('/politique-de-confidentialite/')); ?>"><?php atlas_t('t434aea19'); ?></a>.</p>
        <h2><?php atlas_t('t2460a4ed'); ?></h2>
        <p><?php atlas_t('tdd3daf28'); ?></p>
      </div>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
