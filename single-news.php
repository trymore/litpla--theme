<?php
global $bodyClass;
$bodyClass = 'page-article page-news-article';
$tempPath = do_shortcode('[template]');

$title = get_the_title();
$titleEncode = urlencode($title);
$URL = get_the_permalink();
get_header();

$terms = get_the_terms($post->ID, 'news_category');
$termName = $terms[0]->name;
?>
        <div data-subpage-head></div>
        <div class="page-contents">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4"></div>
          <div class="page-contents-inner">
            <div class="article-info">
              <p class="category"><span><?php echo $termName; ?></span></p>
              <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
            </div>
            <h2 class="article-title"><?php echo $title; ?></h2>
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><a href="/news/">ニュース</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php echo $title; ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
            <div class="article-contents">
              <?php
              $kv = get_the_post_thumbnail_url();
              if ($kv) {
                echo "<img class=\"img-large mb-40\" src=\"$kv\">";
              }
              the_content();
              ?>
              <?php
              if(have_rows('layout')):
                while (have_rows('layout')) :
                  the_row();
                  if(get_row_layout() == 'image'):
                    $image = imageSubSetUrl('img', 'full');
                    $size = get_sub_field('size');
                    $caption = get_sub_field('caption');
                    $mb = get_sub_field('mb');
                    if ($caption):
                      echo "<img class=\"$size\" src=\"$image\">";
                      echo "<p class=\"caption $mb\">$caption</p>";
                    else:
                      echo "<img class=\"$size $mb\" src=\"$image\">";
                    endif;
                  elseif(get_row_layout() == 'h3_layout'):
                    $text  = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "<h3 class=\"$mb\">$text</h3>";
                  elseif(get_row_layout() == 'h4_layout'):
                    $text  = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "<h4 class=\"$mb\">$text</h4>";
                  elseif(get_row_layout() == 'editor_layout'):
                    $editor = get_sub_field('editor');
                    $mb = get_sub_field('mb');
                    echo "<div class=\"$mb\">$editor</div>";
                  endif;
                endwhile;
              endif;
              ?>
            </div>
            <div class="btn-backtoindex"><a href="/news/"><span class="btn-text">BACK TO INDEX</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
<?php get_footer(); ?>