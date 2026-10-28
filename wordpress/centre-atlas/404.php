<?php get_header(); ?>
  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Page introuvable</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>404</span></div>
    </div></div>
  </section>

  <section class="padding-section-large"><div class="padding-global"><div class="container-large text-align-center"><p class="text-size-medium text-style-muted margin-bottom-medium">Cette page n'existe pas ou a été déplacée.</p><a href="<?php echo esc_url(home_url('/')); ?>" class="button is-primary">Retour à l'accueil</a></div></div></section>
<?php get_footer(); ?>
