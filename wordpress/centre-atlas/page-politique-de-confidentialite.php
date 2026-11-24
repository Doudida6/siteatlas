<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t357d75b4'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('t357d75b4'); ?></span></div>
    </div></div>
  </section>

  <!-- Texte juridique : à relire et faire valider par le centre (ou son conseil juridique) avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large" style="max-width:860px">
      <div class="article_body legal_body">
        <p class="text-style-muted"><?php atlas_t('t0f6b9e84'); ?></p>
        <p><?php atlas_t('tfa93fbb9'); ?></p>
        <h2><?php atlas_t('td30165fd'); ?></h2>
        <p>Le responsable du traitement est <?php echo esc_html(atlas_opt('raison_sociale')); ?>, <?php echo esc_html(atlas_opt('adresse')); ?>, Sénégal. Pour toute question : <?php echo esc_html(atlas_data_email()); ?>.</p>
        <h2><?php atlas_t('tad904e55'); ?></h2>
        <p><?php atlas_t('te7c26b61'); ?></p>
        <ul>
          <li><?php atlas_t('t2ba1fab3'); ?></li>
          <li><?php atlas_t('td4de44ff'); ?></li>
          <li><?php atlas_t('t0ca8bb6f'); ?></li>
        </ul>
        <div class="callout"><strong><?php atlas_t('tff96b4a1'); ?></strong> <?php atlas_t('tf4b3049b'); ?></div>
        <p><?php atlas_t('tcb9cb53b'); ?></p>
        <h2><?php atlas_t('tf310d6f0'); ?></h2>
        <ul>
          <li><?php atlas_t('t71c5e31c'); ?></li>
          <li><?php atlas_t('te93c590d'); ?></li>
          <li><?php atlas_t('t81acfd3d'); ?></li>
        </ul>
        <p><?php atlas_t('t2e8eceab'); ?></p>
        <h2><?php atlas_t('tb9305008'); ?></h2>
        <p><?php atlas_t('t78153f89'); ?></p>
        <h2><?php atlas_t('t4fc6fc15'); ?></h2>
        <p>Les demandes sont conservées pendant la durée nécessaire à leur traitement, puis supprimées automatiquement au bout de <?php echo esc_html(atlas_opt('retention_mois')); ?> mois au maximum.</p>
        <h2><?php atlas_t('t3fef8f39'); ?></h2>
        <p>Vous disposez d'un droit d'accès, de rectification, d'opposition et de suppression de vos données. Pour les exercer, écrivez-nous à <?php echo esc_html(atlas_data_email()); ?> en précisant votre demande ; nous pourrons vous demander de justifier de votre identité. Si vous estimez, après nous avoir contactés, que vos droits ne sont pas respectés, vous pouvez saisir la Commission de Protection des Données Personnelles (CDP) du Sénégal.</p>
        <h2><?php atlas_t('tdd8612b0'); ?></h2>
        <p><?php atlas_t('t017f3ef2'); ?></p>
        <p><?php atlas_t('t48f190df'); ?></p>
        <h2><?php atlas_t('tf02018cc'); ?></h2>
        <p><?php atlas_t('tcf4fa404'); ?></p>
        <h2><?php atlas_t('t46e3b20b'); ?></h2>
        <p><?php atlas_t('tba094478'); ?></p>
      </div>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
