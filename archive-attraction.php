<?php
global $bodyClass;
$bodyClass = 'page-attractions';
$tempPath = do_shortcode('[template]');
get_header();
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/attraction/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/attraction/pc/page-kv.jpg">
              <img src="<?php echo $tempPath; ?>/assets/img/attraction/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading">アトラクション</span>
              <span class="text-sub" data-subpage-head-el="heading">ATTRACTIONS</span>
            </h2>
            <div class="decoration-text">
              <span class="char char-1">A</span>
              <span class="char char-2">T</span>
              <span class="char char-3">T</span>
              <span class="char char-4">R</span>
              <span class="char char-5">A</span>
              <span class="char char-6">C</span>
              <span class="char char-7">T</span>
              <span class="char char-8">I</span>
              <span class="char char-9">O</span>
              <span class="char char-10">N</span>
              <span class="char char-11">S</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>アトラクション<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="bg-3"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="bg-4"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4"></div>
          <div class="bg-item-5"></div>
          <div class="bg-item-6"></div>
          <div class="page-contents-inner">
            <div class="attractions-list" data-expandable-list>
              <ul data-initial-display-count="14">
                <?php
                if (have_posts()) : 
                  while (have_posts()) : the_post();
                    if (!get_field('old_attraction')) :
                      $title = get_field('title');
                      $title = preg_replace('/\[(.*?)\]/', '<span>$1</span>', $title);
                      $attractionType = get_field('attraction_type');
                      $catchCopy = get_field('catch_copy');
                      $movie = get_field('movie');
                      $thumb = imageSetUrl('thumb', 'full');
                ?>
                <li data-expandable-item>
                  <a href="<?php the_permalink(); ?>" data-hover-video>
                    <?php if (get_field('new')) :?>
                    <div class="icon-new">
                      <svg class="icon-new-bg">
                        <use xlink:href="#icon-new-bg"/>
                      </svg><span class="icon-text">NEW</span>
                    </div>
                    <?php endif;?>
                    <div class="img-container">
                      <div class="diagonal-line-block">
                        <div class="diagonal-line-block-inner">
                          <?php if ($movie) : ?>
                          <div class="movie">
                            <video poster="<?php echo $thumb; ?>" loop muted data-hover-video-player>
                              <source src="<?php echo $movie; ?>" type="video/mp4">
                            </video>
                          </div>
                          <?php else: ?>
                          <div class="img"><img src="<?php echo $thumb; ?>"></div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-container">
                      <h3 class="heading"><span class="text-sub"><?php echo $attractionType; ?></span><span class="text-main"><?php echo $title; ?></span></h3>
                      <p class="text"><?php echo $catchCopy; ?><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></p>
                    </div>
                  </a>
                </li>
                <?php endif; endwhile; endif; ?>
              </ul>
              <div class="btn-more sp" data-show-more>
                <button><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></button>
              </div>
            </div>
            <section class="section-archive">
              <div class="section-inner">
                <h2 class="section-heading heading-bg-black">過去のアトラクション</h2>
                <div class="archive-list" data-expandable-list>
                  <ul data-initial-display-count="4">
                    <?php
                    if (have_posts()) :
                      $count = 0;
                      while (have_posts()) : the_post();
                        if (get_field('old_attraction')) :
                          $attractionType = get_field('attraction_type');
                          $catchCopy = get_field('catch_copy');
                          $thumb = imageSetUrl('thumb', 'full');
                          $count++;
                    ?>
                    <li class="item-<?php echo $count; ?>" data-expandable-item>
                      <a href="<?php the_permalink(); ?>">
                        <div class="img-container">
                          <div class="img"><img src="<?php echo $thumb; ?>"></div>
                        </div>
                        <div class="text-container">
                          <h3 class="heading"><span class="text-sub-wrap"><span class="text-sub"><?php echo $attractionType; ?></span></span><span class="text-main"><?php the_title(); ?></span></h3>
                          <p class="text"><?php echo $catchCopy; ?></p>
                        </div>
                      </a>
                    </li>
                    <?php endif; endwhile; endif; ?>
                  </ul>
                  <div class="btn-more sp" data-show-more>
                    <button><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></button>
                  </div>
                </div>
              </div>
            </section>
            <div class="btn-backtotop"><a href="/"><span class="btn-text">BACK TO TOP</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
        <section class="section-business">
          <a href="/business/" target="_blank">
            <div class="bg-img">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/business-bg-img.jpg" width="750" height="1000">
                <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/business-bg-img.jpg" width="1400" height="600"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/business-bg-img.jpg" alt="" loading="lazy" width="1400" height="600">
              </picture>
            </div>
            <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-white-1"></div>
            <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-white-2"></div>
            <div class="section-inner">
              <h2 class="section-heading">企業・団体・教育機関のお客さまへ</h2>
              <p class="copy">リトルプラネットの魔法を、<br class="sp">どこにでも。</p>
              <div class="text">
                <p>”遊びが学びに変わる” リトルプラネットのアトラクションを店舗や施設、<br class="pc">イベントにおける体験型コンテンツとしてご活用いただけます。<br>短期の催事導入から常設のキッズスペース作りまで、ファミリー集客の幅広いニーズにお応えします。</p>
              </div>
              <div class="btn-viewmore btn-viewmore-bg-white btn-viewmore-size-300 btn-viewmore-sp-size-420"><span><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
            </div>
          </a>
        </section>
<?php get_footer(); ?>