<?php get_header(); ?>
  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php the_title(); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php the_title(); ?></span></div>
    </div></div>
  </section>

  <section class="padding-section-large"><div class="padding-global"><div class="container-large" style="max-width:820px">
<?php while (have_posts()) : the_post(); ?><div class="entry-content article_body"><?php the_content(); ?></div><?php endwhile; ?>
  </div></div></section>
<?php get_footer(); ?>
