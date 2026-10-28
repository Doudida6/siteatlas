<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?><div class="padding-global padding-section-large"><div class="container-large"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></div></div><?php endwhile; endif; ?>
<?php get_footer(); ?>
