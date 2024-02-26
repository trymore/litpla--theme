<?php
global $bodyClass;
$bodyClass = 'page-news';
$tempPath = do_shortcode('[template]');
$termObj = get_queried_object();
$termSlug = $termObj->slug;
$parameter = "?news_place=$termSlug";

get_header();
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/news/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/news/pc/page-kv.jpg">
              <img src="<?php echo $tempPath; ?>/assets/img/news/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading">ニュース</span>
              <span class="text-sub" data-subpage-head-el="heading">NEWS</span>
            </h2>
            <div class="decoration-text">
              <span class="char char-1">N</span>
              <span class="char char-2">E</span>
              <span class="char char-3">W</span>
              <span class="char char-4">S</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>ニュース<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <ul class="category-list">
              <li><span>すべて</a></li>
              <?php
              echo "<li><a href=\"/news/press/$parameter\">ニュース&トピックス</a></li>";
              echo "<li><a href=\"/news/publicity/$parameter\">パークからのお知らせ</a></li>";
              ?>
            </ul>
            <h2 class="news-heading"><?php single_term_title(); ?></h2>
            <div class="news-list">
              <ul>
                <?php
                if (have_posts()) : 
                  while (have_posts()) : the_post();
                    $thumb = imageSetUrl('thumb', 'newsThumb');
                    if (!$thumb) {
                      $thumb = get_the_post_thumbnail_url();
                    }
                    $terms = get_the_terms($post->ID, 'news_category');
                    $termName = $terms[0]->name;
                ?>
                <li>
                  <a href="<?php the_permalink(); ?>">
                    <div class="thumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                    <div class="text-container">
                      <p class="category"><span><?php echo $termName; ?></span></p>
                      <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
                      <p class="title"><?php the_title(); ?><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></p>
                    </div>
                  </a>
                </li>
                <?php endwhile; endif; ?>
              </ul>
            </div>
            <?php if (function_exists('pagination')) { pagination($wp_query->max_num_pages, get_query_var('paged')); } ?>
            <!-- <div class="pagination">
              <div class="btn-prev"><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span><span class="btn-text">Prev</span></div>
              <div class="num-list"><span>1</span><span class="dot"></span><span>5</span><span>6</span><span class="is-selected">7</span><span>8</span><span>9</span><span class="dot"></span><span>28</span></div>
              <div class="btn-next"><span class="btn-text">Next</span><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
            </div> -->
            <div class="btn-backtotop"><a href="/"><span class="btn-text">BACK TO TOP</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
<?php get_footer(); ?>