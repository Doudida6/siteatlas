<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php the_title(); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><a href="<?php echo esc_url(home_url('/conseils-sante/')); ?>"><?php atlas_t('t59fcfbf5'); ?></a><span>›</span><span><?php the_title(); ?></span></div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large article_grid">
      <article>
        <div class="blog_meta" style="margin-bottom:1.25rem"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span><span><?php echo esc_html(atlas_read_time()); ?> min de lecture</span></div>
        <?php atlas_thumb('Photo de couverture', 'article_cover'); ?>
        <div class="article_body"><?php the_content(); ?></div>
      </article>
      <aside class="fiche_aside">
        <div class="aside_card"><h3 class="heading-style-h4"><?php atlas_t('t2c4ed984'); ?></h3><p class="text-size-small"><?php atlas_t('t72d60e5a'); ?></p><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center"><?php atlas_t('tda31472f'); ?></a></div>
<?php $related = get_posts(['numberposts' => 3, 'exclude' => [get_the_ID()]]); if ($related) : ?>
        <div class="aside_links"><strong><?php atlas_t('t862de52b'); ?></strong><?php foreach ($related as $r) : ?><a href="<?php echo esc_url(get_permalink($r)); ?>"><?php echo esc_html(get_the_title($r)); ?></a><?php endforeach; ?></div>
<?php endif; ?>
      </aside>
    </div></div>
  </section>
<?php endwhile; ?>
<?php get_template_part('parts/cta'); ?>
<?php get_footer(); ?>
