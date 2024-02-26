<?php
global $bodyClass;
$bodyClass = 'page-top';
$tempPath = do_shortcode('[template]');
$aboutMovie = get_field('top_about_movie','option');
get_header();
?>
        <section class="section-hero" data-hero>
          <div class="kv-slider">
            <div class="kv-slider-contents" data-hero-el="slider">
              <ul class="kv-slider-item-list">
                <?php
                if(have_rows('top_keyvisual','option')):
                  while (have_rows('top_keyvisual','option')) :
                    the_row();
                    $image = imageSubSetUrl('pc_img', 'full');
                    $imageSp = imageSubSetUrl('sp_img', 'full');
                    $imageX2 = imageSubSetUrl('retina_img', 'full');
                    echo "
                    <li class=\"kv-slider-item\">
                      <picture>
                        <source media=\"(max-width: 767px)\" srcset=\"$imageSp\">
                        <source media=\"(min-width: 768px)\" srcset=\"$image, $imageX2 2x\">
                        <img src=\"$image\">
                      </picture>
                    </li>";
                  endwhile;
                endif;
                ?>
              </ul>
            </div>
            <div class="kv-slider-nav">
              <div class="kv-slider-dot-list" data-hero-el="slider-pagination"></div>
            </div>
          </div>
          <div class="copy">
            <div class="copy-group" data-hero-el="copy-group1"><span class="text-p">
                <svg>
                  <title>P</title>
                  <use xlink:href="#kv-copy-p"/>
                </svg></span><span class="text-l text-l-1">
                <svg>
                  <title>L</title>
                  <use xlink:href="#kv-copy-l"/>
                </svg></span><span class="text-a text-a-1">
                <svg>
                  <title>A</title>
                  <use xlink:href="#kv-copy-a"/>
                </svg></span><span class="text-y">
                <svg>
                  <title>Y</title>
                  <use xlink:href="#kv-copy-y"/>
                </svg></span><span class="text-comma text-comma-1">
                <svg>
                  <title>,</title>
                  <use xlink:href="#kv-copy-comma"/>
                </svg></span><span class="text-l text-l-2">
                <svg>
                  <title>L</title>
                  <use xlink:href="#kv-copy-l"/>
                </svg></span><span class="text-e text-e-1">
                <svg>
                  <title>E</title>
                  <use xlink:href="#kv-copy-e"/>
                </svg></span><span class="text-a text-a-2">
                <svg>
                  <title>A</title>
                  <use xlink:href="#kv-copy-a"/>
                </svg></span><span class="text-r text-r-1">
                <svg>
                  <title>R</title>
                  <use xlink:href="#kv-copy-r"/>
                </svg></span><span class="text-n">
                <svg>
                  <title>N</title>
                  <use xlink:href="#kv-copy-n"/>
                </svg></span><span class="text-comma text-comma-2">
                <svg>
                  <title>,</title>
                  <use xlink:href="#kv-copy-comma"/>
                </svg></span></div>
            <div class="copy-group" data-hero-el="copy-group2"><span class="text-c">
                <svg>
                  <title>C</title>
                  <use xlink:href="#kv-copy-c"/>
                </svg></span><span class="text-r text-r-2">
                <svg>
                  <title>R</title>
                  <use xlink:href="#kv-copy-r"/>
                </svg></span><span class="text-e text-e-2">
                <svg>
                  <title>E</title>
                  <use xlink:href="#kv-copy-e"/>
                </svg></span><span class="text-a text-a-3">
                <svg>
                  <title>A</title>
                  <use xlink:href="#kv-copy-a"/>
                </svg></span><span class="text-t">
                <svg>
                  <title>T</title>
                  <use xlink:href="#kv-copy-t"/>
                </svg></span><span class="text-e text-e-3">
                <svg>
                  <title>E</title>
                  <use xlink:href="#kv-copy-e"/>
                </svg></span><span class="text-exclamation">
                <svg>
                  <title>!</title>
                  <use xlink:href="#kv-copy-exclamation"/>
                </svg></span></div>
          </div>
          <div class="copy-sub" data-hero-el="sub-copy"><svg><title>ONE DAY, ONE NEW STEP</title><use xlink:href="#kv-copy-sub"/></svg></div>
        </section>
        <section class="section-news">
          <div class="bg-item-1 sp" data-animate="bg" data-animate-id="home-news-bg-sp"></div>
          <div class="bg-item-1 pc" data-animate="bg" data-animate-id="home-news-bg-pc"></div>
          <div class="section-inner">
            <h2 class="section-heading" data-animate="heading"><span data-hidden><span class="text-main" data-heading-el="lg">NEWS</span></span><span class="text-sub" data-heading-el="sm">ニュース</span></h2>
            <div class="section-contents">
              <div class="latest-news">
                <h3 class="sub-heading">最新ニュース</h3>
                <div class="btn-viewmore btn-viewmore-bg-none"><a href="/news/press/"><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
                <div class="latest-news-list">
                  <div class="slider">
                    <div class="slider-contents" data-slider data-slider-id="news" data-animate="slide-in" data-x="50">
                      <ul class="slider-item-list slides" data-slides>
                        <?php
                        $query = new WP_Query(array(
                          'post_type' => 'news',
                          'post_status' => 'publish',
                          'posts_per_page' => 6,
                          'tax_query' => array(
                            // array(
                            //   'taxonomy' => 'news_place',
                            //   'field' => 'term_taxonomy_id',
                            //   'terms' => 76,
                            // ),
                            array(
                              'taxonomy' => 'news_category',
                              'field' => 'slug',
                              'terms' => 'press',
                            ),
                          ),
                          // 'meta_query' => array(
                          //   'relation' => 'AND',
                          //   array(
                          //     'key' => 'slider',
                          //     'value' => true,
                          //     'compare' => '=',
                          //   ),
                          // ),
                        ));
                        if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                          $thumb = imageSetUrl('thumb', 'full');
                          if (!$thumb) {
                            $thumb = get_the_post_thumbnail_url();
                          }
                          $terms = get_the_terms($post->ID, 'news_category');
                          $termName = $terms[0]->name;
                        ?>
                        <li class="slider-item slide">
                          <a href="<?php the_permalink(); ?>">
                            <div class="thumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                            <p class="category"><span><?php echo $termName; ?></span></p>
                            <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
                            <p class="title"><span><?php the_title(); ?></span></p>
                          </a>
                        </li>
                        <?php endwhile; endif; wp_reset_postdata(); ?>
                      </ul>
                      <div class="slider-scroll"><span class="slider-scroll-bar swiper-scrollbar-drag"></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="park-info">
                <h3 class="sub-heading">パークからのお知らせ</h3>
                <div class="btn-viewmore btn-viewmore-bg-none"><a href="/news/publicity/"><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
                <div class="park-info-list">
                  <ul>
                    <?php
                    $query = new WP_Query(array(
                      'post_type' => 'news',
                      'post_status' => 'publish',
                      'posts_per_page' => 3,
                      'tax_query' => array(
                        'relation' => 'AND',
                        // array(
                        //   'taxonomy' => 'news_place',
                        //   'field' => 'term_taxonomy_id',
                        //   'terms' => 76,
                        // ),
                        array(
                          'taxonomy' => 'news_category',
                          'field' => 'slug',
                          'terms' => 'publicity',
                        ),
                      ),
                    ));
                    if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                      $thumb = imageSetUrl('thumb', 'full');
                      $terms = get_the_terms($post->ID, 'news_category');
                      $termName = $terms[0]->name;
                    ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <p class="category"><span><?php echo $termName; ?></span></p>
                        <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
                        <p class="title"><?php the_title(); ?></p><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                      </a>
                    </li>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="btn-viewmore btn-viewmore-bg-black btn-viewmore-size-180 btn-viewmore-sp-size-420"><a href="/news/"><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </section>
        <section class="section-about">
          <div class="bg-item-1 sp" data-animate="bg" data-animate-id="bg-1-sp"></div>
          <div class="bg-item-1 pc" data-animate="bg" data-animate-id="bg-1-pc"></div>
          <div class="bg-item-2 pc" data-animate="bg" data-animate-id="bg-2"></div>
          <div class="bg-item-3"></div>
          <div class="decoration-text">
            <div class="decoration-text-inner" data-animate="bg-text"></div>
          </div>
          <div class="section-inner">
          <h2 class="section-heading" data-animate="heading"><span data-hidden><span class="text-main" data-heading-el="lg">ABOUT</span></span><span class="text-sub" data-heading-el="sm">リトルプラネットについて</span></h2>
            <div class="img img-1" data-parallax="y" data-parallax-start-y="5" data-parallax-end-y="-5">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-1.jpg">
                <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-1.jpg, <?php echo $tempPath; ?>/assets/img/top/about-img-1@2x.jpg 2x"><img src="<?php echo $tempPath; ?>/assets/img/top/about-img-1.jpg" alt="">
              </picture>
            </div>
            <div class="img img-2" data-parallax="y">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-2.jpg">
                <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-2.jpg, <?php echo $tempPath; ?>/assets/img/top/about-img-2@2x.jpg 2x"><img src="<?php echo $tempPath; ?>/assets/img/top/about-img-2.jpg" alt="">
              </picture>
            </div>
            <div class="img img-3" data-parallax="y">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-3.jpg">
                <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-3.jpg, <?php echo $tempPath; ?>/assets/img/top/about-img-3@2x.jpg 2x"><img src="<?php echo $tempPath; ?>/assets/img/top/about-img-3.jpg" alt="">
              </picture>
            </div>
            <div class="img img-4" data-parallax="y" data-parallax-start-y="5" data-parallax-end-y="-5">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-4.jpg">
                <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/about-img-4.jpg, <?php echo $tempPath; ?>/assets/img/top/about-img-4@2x.jpg 2x"><img src="<?php echo $tempPath; ?>/assets/img/top/about-img-4.jpg" alt="">
              </picture>
            </div>
            <p class="copy"><span class="text-blue"><span>ア</span><span>ソ</span><span>ビ</span></span>が<span class="text-blue"><span>マ</span><span>ナ</span><span>ビ</span></span>に変わる<br>次世代型テーマパーク</p>
            <div class="movie-block" data-youtube>
              <div class="movie" data-youtube-el="player" data-youtube-id="<?php echo $aboutMovie['movie_id']; ?>"></div>
              <div class="thumb" data-youtube-el="thumb" data-parallax="scale">
                <picture>
                  <source media="(max-width: 767px)" srcset="<?php echo $aboutMovie['sp_image']; ?>">
                  <source media="(min-width: 768px)" srcset="<?php echo $aboutMovie['pc_image']; ?>">
                  <img src="<?php echo $aboutMovie['pc_image']; ?>" alt="">
                </picture><span class="icon-play"></span>
              </div>
            </div>
            <div class="text">
              <p>スマホやゲームとも違う、未来に触れる感覚。<br>大自然との触れ合いとも違う、未知との出会い。<br>私たちはデジタル技術を駆使して、<br>子どもたちの探究心や創造力を刺激する未知<br class="sp">の体験を届けたい。<br>みんなが集まり、夢中になって一緒に遊ぶ。<br>その経験は、いつの間にか学びに変わっていく<br class="sp">はずだから。</p>
            </div>
            <div class="btn-viewmore btn-viewmore-bg-black btn-viewmore-size-300 btn-viewmore-sp-size-420"><a href="/about/"><span class="btn-text">View More</span><span class="btn-icon">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span></a>
            </div>
          </div>
        </section>
        <section class="section-attractions" data-attractions>
          <div class="bg-item-1 pc" data-animate="bg" data-animate-id="bg-3"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="bg-4"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4 pc" data-animate="bg" data-animate-id="bg-5"></div>
          <div class="bg-item-5"></div>
          <div class="bg-item-6"></div>
          <div class="bg-item-7 pc" data-animate="bg" data-animate-id="bg-6"></div>
          <div class="bg-item-8"></div>
          <div class="section-inner">
          <h2 class="section-heading" data-animate="heading"><span data-hidden> <span class="text-main" data-heading-el="lg">ATTRACTIONS</span></span><span data-hidden> <span class="text-sub" data-heading-el="sm">リトルプラネットのアトラクション</span></span></h2>
            <div class="attractions-list">
              <ul>
                <?php
                $query = new WP_Query(array(
                  'posts_per_page' => 5,
                  'post_type' => array('attraction'),
                ));
                $attractionCount = 0;
                if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                  $title = get_field('title');
                  $title = preg_replace('/\[(.*?)\]/', '<span>$1</span>', $title);
                  $attractionType = get_field('attraction_type');
                  $catchCopy = get_field('catch_copy');
                  $movie = get_field('movie');
                  $thumb = imageSetUrl('thumb', 'full');
                  $attractionCount++;
                ?>
                <li class="item-<?php echo $attractionCount; ?>">
                  <a href="<?php the_permalink(); ?>" data-hover-video>
                    <div class="img-container">
                      <div class="diagonal-line-block">
                        <div class="diagonal-line-block-inner">
                          <?php if ($movie) : ?>
                          <div class="movie">
                            <video poster="<?php echo $thumb; ?>" loop muted data-hover-video-player data-parallax="scale">
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
                      <div>
                        <h3 class="heading"><span class="text-sub"><?php echo $attractionType; ?></span><span class="text-main"><?php echo $title; ?></span></h3>
                        <p class="text"><?php echo $catchCopy; ?><span class="icon-arrow-circle sp"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></p>
                        <div class="btn-viewmore btn-viewmore-bg-black btn-viewmore-size-220 pc"><span><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
                      </div>
                    </div>
                  </a>
                </li>
                <?php endwhile; endif; wp_reset_postdata(); ?>
              </ul>
            </div>
            <div class="btn-viewall" data-attractions-el="view-all">
              <a href="/attraction/">
                <span class="character" data-attractions-el="character">
                  <picture>
                    <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/btn-viewall-character.png" width="138" height="147">
                    <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/btn-viewall-character.png, <?php echo $tempPath; ?>/assets/img/top/pc/btn-viewall-character@2x.png 2x" width="99" height="106">
                    <img src="<?php echo $tempPath; ?>/assets/img/top/pc/btn-viewall-character.png" alt="" loading="lazy" width="99" height="106">
                  </picture>
                </span>
                <span class="character-text" data-attractions-el="text">
                  <picture>
                    <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/btn-viewall-character-text.png" width="169" height="63">
                    <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/btn-viewall-character-text.png, <?php echo $tempPath; ?>/assets/img/top/pc/btn-viewall-character-text@2x.png 2x" width="129" height="42">
                    <img src="<?php echo $tempPath; ?>/assets/img/top/pc/btn-viewall-character-text.png" alt="" loading="lazy" width="129" height="42">
                  </picture>
                </span>
                <span class="btn-text">View All</span>
                <span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span>
              </a>
            </div>
          </div>
        </section>
        <section class="section-guide">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="section-inner">
            <div class="decoration-text" data-parallax="text">LET’S PLAY</div>
            <div class="bg"></div>
            <div class="section-contents">
              <div class="img">
                <div class="img-inner">
                  <picture>
                    <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/guide-img.png" width="633" height="435">
                    <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/guide-img.png, <?php echo $tempPath; ?>/assets/img/top/pc/guide-img@2x.png 2x" width="742" height="435"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/guide-img.png" alt="" loading="lazy" width="742" height="435">
                  </picture>
                  <div class="guide-character"></div>
                </div>
              </div>
              <h2 class="section-heading" data-animate="heading"><span data-hidden> <span class="text-main" data-heading-el="lg">PARK GUIDE</span></span><span data-hidden> <span class="text-sub" data-heading-el="sm">ご来場ガイド</span></span></h2>
              <p class="text">チケットはどこで買えるの？何歳から楽しめる？<br>はじめて行くときに準備することは？<br>そんな疑問をまとめました。<br>みなさまの旅が楽しく充実したものになりますように。</p>
              <div class="btn-viewmore btn-viewmore-bg-black btn-viewmore-size-220 btn-viewmore-sp-size-420"><a href="/guide_first/"><span class="btn-text">View More</span><span class="btn-icon">
                    <svg>
                      <use xlink:href="#icon-arrow"/>
                    </svg></span></a>
              </div>
            </div>
          </div>
        </section>
        <div class="park-img">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/park-img.jpg" width="750" height="650">
            <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/park-img.jpg, <?php echo $tempPath; ?>/assets/img/top/pc/park-img@2x.jpg 2x" width="1399" height="600"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/park-img.jpg" alt="" loading="lazy" width="1400" height="744" data-parallax="y" data-parallax-start-y="0" data-parallax-end-y="-10">
          </picture>
        </div>
        <section class="section-tickets">
          <div class="bg-item-1" data-animate="bg" data-animate-id="bg-7"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="bg-8"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4"></div>
          <div class="section-inner">
          <h2 class="section-heading" data-animate="heading"><span data-hidden> <span class="text-main" data-heading-el="lg">TICKETS</span></span><span data-hidden> <span class="text-sub" data-heading-el="sm">チケット</span></span></h2>
            <div class="section-contents">
              <div class="block block-1"><a href="https://reserve.litpla.com/purchase/ticket" target="_blank">
                  <div class="character">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/tickets-character-1.png" width="132" height="190">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/tickets-character-1.png, <?php echo $tempPath; ?>/assets/img/top/pc/tickets-character-1@2x.png 2x" width="97" height="140"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/tickets-character-1.png" alt="" loading="lazy" width="97" height="140">
                    </picture>
                  </div>
                  <p class="heading">チケット購入</p>
                  <p class="text">個人のお客さまはこちら</p>
                  <div class="btn-viewmore btn-viewmore-bg-white btn-viewmore-size-220 btn-viewmore-sp-size-420"><span><span class="btn-text">View More</span><span class="btn-icon">
                        <svg>
                          <use xlink:href="#icon-arrow"/>
                        </svg></span></span>
                  </div></a></div>
              <div class="block block-2">
                <a href="/group/">
                  <div class="character">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/tickets-character-2.png" width="116" height="158">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/tickets-character-2.png, <?php echo $tempPath; ?>/assets/img/top/pc/tickets-character-2@2x.png 2x" width="85" height="116"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/tickets-character-2.png" alt="" loading="lazy" width="85" height="116">
                    </picture>
                  </div>
                  <p class="heading">団体予約</p>
                  <p class="text">団体のお客さまはこちら</p>
                  <div class="btn-viewmore btn-viewmore-bg-white btn-viewmore-size-220 btn-viewmore-sp-size-420"><span><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
                </a>
              </div>
            </div>
          </div>
        </section>
        <section class="section-app">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4"></div>
          <div class="section-inner">
            <h2 class="section-heading" data-animate="heading"><span data-hidden> <span class="text-main" data-heading-el="lg">OFFICIAL APP</span></span><span data-hidden> <span class="text-sub" data-heading-el="sm">公式アプリ「PLANET PORTAL（プラポ）」</span></span></h2>
            <div class="section-contents">
              <div class="block-img">
                <div class="img">
                  <picture>
                    <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/app-img-1.png" width="240" height="490">
                    <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/app-img-1.png, <?php echo $tempPath; ?>/assets/img/top/pc/app-img-1@2x.png 2x" width="240" height="490"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/app-img-1.png" alt="" loading="lazy" width="240" height="490">
                  </picture>
                </div>
                <div class="img">
                  <picture>
                    <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/app-img-2.png" width="240" height="490">
                    <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/app-img-2.png, <?php echo $tempPath; ?>/assets/img/top/pc/app-img-2@2x.png 2x" width="240" height="490"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/app-img-2.png" alt="" loading="lazy" width="240" height="490">
                  </picture>
                </div>
              </div>
              <div class="block-text">
                <ul>
                  <li><span class="icon-check">
                      <svg>
                        <use xlink:href="#icon-check"/>
                      </svg></span>アプリ限定のお得なクーポン</li>
                  <li><span class="icon-check">
                      <svg>
                        <use xlink:href="#icon-check"/>
                      </svg></span>ミッションクリアで<br class="pc">プレゼント獲得</li>
                  <li><span class="icon-check">
                      <svg>
                        <use xlink:href="#icon-check"/>
                      </svg></span>無料で遊べるミニゲーム</li>
                </ul>
              </div>
              <div class="block-install">
                <div class="heading">
                  <div class="app-icon">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/app-icon.png" width="110" height="110">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/app-icon.png, <?php echo $tempPath; ?>/assets/img/top/pc/app-icon@2x.png 2x" width="80" height="80"><img src="<?php echo $tempPath; ?>/assets/img/top/pc/app-icon.png" alt="" loading="lazy" width="80" height="80">
                    </picture>
                  </div>
                  <p class="heading-text"><span>インストール</span>で<span>おとな半額！</span></p>
                </div>
                <div class="links"><a class="link-appstore" href="https://apps.apple.com/app/apple-store/id6463190812?pt=119103788&amp;ct=officialsite&amp;mt=8" target="_blank">
                    <svg>
                      <use xlink:href="#app-badge-appstore"/>
                    </svg></a><a class="link-googleplay" href="https://play.google.com/store/apps/details?id=com.litpla.litplax&amp;referrer=utm_source%3Dofficialsite" target="_blank"><img src="<?php echo $tempPath; ?>/assets/img/top/app-badge-googleplay.png" alt="GET IT ON Google Play"></a></div>
              </div>
            </div>
            <div class="btn-viewmore btn-viewmore-bg-black btn-viewmore-size-300 btn-viewmore-sp-size-420"><a href="https://litpla.com/app/plapo/"><span class="btn-text">View More</span><span class="btn-icon">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span></a>
            </div>
          </div>
        </section>
        <section class="section-business">
          <a href="https://corp.litpla.com/business/litpla" target="_blank">
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