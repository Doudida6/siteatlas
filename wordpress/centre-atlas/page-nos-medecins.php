<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('tbc8ce25b'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('tbc8ce25b'); ?></span></div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow"><?php atlas_t('t75ccefd9'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('tcba06b70'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('t8b78a532'); ?></p>
      </div>
      <div class="doc_grid">
<?php atlas_doc_cards(); ?>
</div>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
