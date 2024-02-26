<?php
global $bodyClass;
$bodyClass = 'page-news-top';
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
  <?php echo get_the_date('Y.n.j'); ?>
  <?php the_permalink(); ?>
<?php endwhile; ?>
<?php get_footer(); ?>