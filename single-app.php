<?php
global $bodyClass;
$bodyClass = 'page-app-detail';
$tempPath = do_shortcode('[template]');

$keyVisual = get_field('key_visual');
$subTitle = get_field('sub_title');
$appStore = get_field('app_store');
$googlePlay = get_field('google_play');
$about = get_field('about');

$title = get_the_title();
$titleEncode = urlencode($title);
$URL = get_the_permalink();
get_header();
?>
        <div class="page-app-detail-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo imageIdUrl($keyVisual['sp_bg_img'],'full'); ?>">
              <source media="(min-width: 768px)" srcset="<?php echo imageIdUrl($keyVisual['pc_bg_img'],'full'); ?>">
              <img src="<?php echo imageIdUrl($keyVisual['pc_bg_img'],'full'); ?>" alt="">
            </picture>
          </div>
          <div class="heading-inner">
            <div class="heading-text-container">
              <p class="heading-text"><?php echo $subTitle; ?></p>
              <h2 class="heading"><?php the_title(); ?></h2>
              <div class="description">
                <p><?php echo $keyVisual['text']; ?></p>
              </div>
              <div class="app-btn-container">
                <?php if($appStore): ?>
                <div class="btn">
                  <a href="<?php echo $appStore; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/app-btn-appstore.png" width="315" height="94">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore.png, <?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore@2x.png 2x" width="218" height="65">
                      <img src="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore.png" alt="" loading="lazy" width="218" height="65">
                    </picture>
                  </a>
                </div>
                <?php endif; ?>
                <?php if($googlePlay): ?>
                <div class="btn">
                  <a href="<?php echo $googlePlay; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/app-btn-googleplay.png" width="315" height="94">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay.png, <?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay@2x.png 2x" width="218" height="65">
                      <img src="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay.png" alt="" loading="lazy" width="218" height="65">
                    </picture>
                  </a>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <?php
            $prop = wp_get_attachment_image_src($keyVisual['image'],'full');
            $type = ($prop[1]/$prop[2] > 2) ? 'img-1' : 'img-2';
            echo "<div class=\"$type\"><img src=\"$prop[0]\"></div>";
            ?>
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><a href="/app/">アプリ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php the_title(); ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <section class="section-service">
            <div class="bg-item-1" data-animate="bg" data-animate-id="bg-13"></div>
            <div class="bg-item-2" data-animate="bg" data-animate-id="bg-12"></div>
            <div class="bg-item-3"></div>
            <div class="section-inner">
              <h2 class="section-heading">サービス紹介</h2>
              <div class="service-list">
                <ul>
                  <?php
                  if(have_rows('service')):
                    while (have_rows('service')) :
                      the_row();
                      $image = imageSubSetUrl('image', 'full');
                      $title = get_sub_field('title');
                      $text = get_sub_field('text');
                      $icon = imageSubSetUrl('icon', 'full');
                      $layout = get_sub_field('layout');
                      echo "
                      <li class=\"service-$layout\">
                        <div class=\"img-container\">";
                      if ($icon) {
                        echo "
                            <div class=\"icon\"><img src=\"$icon\" alt=\"\"></div>";
                      }
                      echo "
                          <div class=\"img\"><img src=\"$image\" data-parallax=\"scale\"></div>
                        </div>
                        <div class=\"text-container\">
                          <p class=\"heading\">$title</p>
                          <div class=\"text\">
                            <p>$text</p>
                          </div>
                        </div>
                      </li>
                      ";
                    endwhile;
                  endif;
                  ?>
                </ul>
              </div>
            </div>
          </section>
          <div class="app-download app-download-top">
            <div class="bg">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo imageIdUrl($keyVisual['sp_bg_img'],'full'); ?>" width="750" height="1009">
                <source media="(min-width: 768px)" srcset="<?php echo imageIdUrl($keyVisual['pc_bg_img'],'full'); ?>" width="1400" height="490">
                <img src="<?php echo imageIdUrl($keyVisual['pc_bg_img'],'full'); ?>" alt="" loading="lazy" width="1400" height="490">
              </picture>
            </div>
            <div class="contents">
              <div class="icon"><img src="<?php echo imageSetUrl('app_icon', 'full'); ?>" alt=""></div>
              <p class="text"><?php the_title(); ?> を<br class="sp">今すぐダウンロード！</p>
              <div class="app-btn-container">
                <?php if($appStore): ?>
                <div class="btn">
                  <a href="<?php echo $appStore; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/app-btn-appstore.png" width="315" height="94">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore.png, <?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore@2x.png 2x" width="218" height="65">
                      <img src="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore.png" alt="" loading="lazy" width="218" height="65">
                    </picture>
                  </a>
                </div>
                <?php endif; ?>
                <?php if($googlePlay): ?>
                <div class="btn">
                  <a href="<?php echo $googlePlay; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/app-btn-googleplay.png" width="315" height="94">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay.png, <?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay@2x.png 2x" width="218" height="65">
                      <img src="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay.png" alt="" loading="lazy" width="218" height="65">
                    </picture>
                  </a>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <section class="section-movie">
            <div class="bg-item-1"></div>
            <div class="bg-item-2"></div>
            <div class="bg-item-3"></div>
            <div class="bg-item-4"></div>
            <div class="decoration-text">
              <div class="decoration-text-inner"></div>
            </div>
            <div class="section-inner">
              <h2 class="section-heading">紹介ムービー</h2>
              <div class="diagonal-line-block">
                <div class="movie-block" data-youtube>
                  <div class="movie" data-youtube-el="player" data-youtube-id="<?php echo get_field('movie'); ?>"></div>
                  <div class="thumb" data-youtube-el="thumb" data-parallax="scale"><img src="<?php echo imageSetUrl('movie_image', 'full'); ?>" alt=""><span class="icon-play"></span>
                  </div>
                </div>
              </div>
              <?php if(have_rows('function')): ?>
              <section class="section-function">
                <h2 class="section-heading">おもな機能</h2>
                <div class="function-list">
                  <div class="slider">
                    <div class="slider-contents">
                      <ul class="slider-item-list">
                        <?php while (have_rows('function')) : the_row();
                        $image = imageSubSetUrl('image', 'appFunction');
                        $text = get_sub_field('text');
                        ?>
                        <li class="slider-item">
                          <div class="img"><img src="<?php echo $image; ?>"></div>
                          <p class="text"><?php echo $text; ?></p>
                        </li>
                        <?php endwhile; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
              <?php endif; ?>
            </div>
          </section>
          <section class="section-faq">
            <div class="section-inner">
              <?php
              $faq = get_field('faq');
              if ($faq) :
              ?>
              <h2 class="section-heading heading-bg-blue">FAQ</h2>
              <div class="section-contents">
                <section class="section-sub">
                  <h3 class="section-sub-heading heading-blue-line">ご利用について</h3>
                  <div class="section-sub-contents">
                    <?php
                    foreach( $faq as $post ):
                      setup_postdata($post);
                    ?>
                    <div class="accordion" data-accordion>
                      <div class="accordion-btn" data-accordion-el="trigger"><span class="icon-q">Q.</span>
                        <div class="text-q"><?php echo get_field('question'); ?></div><span class="accordion-btn-icon"></span>
                      </div>
                      <div data-accordion-el="content">
                        <div class="accordion-contents"><span class="icon-a">A</span>
                          <div class="text-a"><p><?php echo get_field('anser'); ?></p></div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                  </div>
                </section>
              </div>
              <?php endif; ?>
            </div>
          </section>
          <div class="app-download app-download-bottom">
            <div class="bg">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo imageIdUrl($keyVisual['sp_bg_img'],'full'); ?>" width="750" height="1009">
                <source media="(min-width: 768px)" srcset="<?php echo imageIdUrl($keyVisual['pc_bg_img'],'full'); ?>" width="1400" height="490">
                <img src="<?php echo imageIdUrl($keyVisual['pc_bg_img'],'full'); ?>" alt="" loading="lazy" width="1400" height="490">
              </picture>
            </div>
            <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-white-1"></div>
            <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-white-2"></div>
            <div class="contents">
              <div class="icon"><img src="<?php echo imageSetUrl('app_icon', 'full'); ?>" alt=""></div>
              <p class="text"><?php the_title(); ?> を<br class="sp">今すぐダウンロード！</p>
              <div class="app-btn-container">
                <?php if($appStore): ?>
                <div class="btn">
                  <a href="<?php echo $appStore; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/app-btn-appstore.png" width="315" height="94">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore.png, <?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore@2x.png 2x" width="218" height="65">
                      <img src="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-appstore.png" alt="" loading="lazy" width="218" height="65">
                    </picture>
                  </a>
                </div>
                <?php endif; ?>
                <?php if($googlePlay): ?>
                <div class="btn">
                  <a href="<?php echo $googlePlay; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/app-btn-googleplay.png" width="315" height="94">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay.png, <?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay@2x.png 2x" width="218" height="65">
                      <img src="<?php echo $tempPath; ?>/assets/img/app/detail/pc/app-btn-googleplay.png" alt="" loading="lazy" width="218" height="65">
                    </picture>
                  </a>
                </div>
                <?php endif; ?>
              </div>
              <div class="about">
                <?php
                if ($about) :
                  echo "<p class=\"text-large\">【アプリ推奨環境について】</p>";
                  echo $about;
                endif;
                ?>
              </div>
            </div>
          </div>
        </div>
<?php get_footer(); ?>