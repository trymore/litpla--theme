<?php get_header(); ?>
<?php
while (have_posts()) : the_post();
  // $thumb = get_the_post_thumbnail_url($post->ID, 'NewsThumLarge');
?>
  <a href="<?php the_permalink(); ?>">
    <img src="" alt="<?php the_title(); ?>">
    <?php echo get_the_date('Y.n.j'); ?>
    <?php the_title(); ?>
  </a>
<?php
endwhile;
?>
<?php pagination(); ?>
<?php get_footer(); ?>