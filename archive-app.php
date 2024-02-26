<?php
global $bodyClass;
$bodyClass = 'page-app';
$tempPath = do_shortcode('[template]');
get_header();
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/pc/page-kv.jpg">
              <img src="<?php echo $tempPath; ?>/assets/img/app/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading"><span class="text-main" data-subpage-head-el="heading">アプリ</span><span class="text-sub" data-subpage-head-el="heading">APP</span></h2>
            <div class="decoration-text">
              <span class="char char-1">A</span>
              <span class="char char-2">P</span>
              <span class="char char-3">P</span>
              <span class="char char-4">L</span>
              <span class="char char-5">I</span>
              <span class="char char-6">C</span>
              <span class="char char-7">A</span>
              <span class="char char-8">T</span>
              <span class="char char-9">I</span>
              <span class="char char-10">O</span>
              <span class="char char-11">N</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>アプリ<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="bg-13"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="bg-12"></div>
          <div class="bg-item-3" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-4" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <div class="app-list">
              <ul>
                <?php
                if (have_posts()) :
                  while (have_posts()) :
                    the_post();
                    $sub_title = get_field('sub_title');
                    $thumb = imageSetUrl('thumb', 'full');
                ?>
                <li class="item-1">
                  <a href="<?php the_permalink(); ?>">
                    <div class="img-container">
                      <div class="diagonal-line-block">
                        <div class="img"><img src="<?php echo $thumb; ?>" alt=""></div>
                      </div>
                    </div>
                    <div class="text-container">
                      <p class="text"><?php echo $sub_title; ?></p>
                      <h3 class="heading"><?php the_title(); ?><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></h3>
                    </div>
                  </a>
                </li>
                <?php endwhile; endif; ?>
              </ul>
            </div>
            <div class="btn-backtotop"><a href="/"><span class="btn-text">BACK TO TOP</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
<?php get_footer(); ?>