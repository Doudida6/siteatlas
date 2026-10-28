<?php get_header(); ?>
  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('t59fcfbf5'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('t59fcfbf5'); ?></span></div>
    </div></div>
  </section>

  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="eyebrow2"><?php atlas_t('t1f691f71'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('t4220cafe'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('t090b0557'); ?></p>
      </div>
<?php $cats = get_categories(['hide_empty' => true]); if ($cats) : ?>
      <div class="blog_filters"><button class="blog_filter is-active" data-filter="all"><?php atlas_t('t3dd16e13'); ?></button><?php foreach ($cats as $c) : ?><button class="blog_filter" data-filter="<?php echo esc_attr($c->name); ?>"><?php echo esc_html($c->name); ?></button><?php endforeach; ?></div>
<?php endif; ?>
<?php
global $wp_query;
$items = $wp_query->posts;
$featured = (!is_paged() && $items) ? array_shift($items) : null;
if ($featured) : $GLOBALS['post'] = $featured; setup_postdata($featured); ?>
      <a href="<?php the_permalink(); ?>" class="blog_featured reveal" data-cat="<?php echo esc_attr(atlas_cat_name()); ?>">
        <?php atlas_thumb("Photo de l'article à la une"); ?>
        <div class="blog_featured-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span><span><?php echo esc_html(atlas_read_time()); ?> min de lecture</span></div><h2 class="heading-style-h2" style="font-size:1.9rem"><?php the_title(); ?></h2><p class="text-style-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28)); ?></p><span class="button is-primary" style="justify-self:start"><?php atlas_t('t42ada6a3'); ?></span></div>
      </a>
<?php wp_reset_postdata(); endif; ?>
      <div class="blog_grid">
<?php foreach ($items as $p) : $GLOBALS['post'] = $p; setup_postdata($p); ?>
        <a href="<?php the_permalink(); ?>" class="blog_card reveal" data-cat="<?php echo esc_attr(atlas_cat_name()); ?>"><?php atlas_thumb(); ?><div class="blog_card-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span></div><h3 class="heading-style-h4"><?php the_title(); ?></h3><p class="text-size-small text-style-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p><span class="quick_link text-color-accent"><?php atlas_t('t42ada6a3'); ?> <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
<?php endforeach; wp_reset_postdata(); ?>
      </div>
      <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '‹', 'next_text' => '›']); ?>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>
<?php get_footer(); ?>
