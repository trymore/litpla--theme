<?php
global $bodyClass;
$bodyClass = 'page-attractions-detail';
$tempPath = do_shortcode('[template]');

$title = get_the_title();
$logo = imageSetUrl('logo', 'full');
$aboutMovie = get_field('about_movie');
$aboutMoviePoster = imageSetUrl('about_movie_poster', 'full');
$aboutMovieCaption = get_field('about_movie_caption');
$catchCopy = get_field('catch_copy');
$aboutText = get_field('about_text');

$titleEncode = urlencode($title);
$URL = get_the_permalink();
get_header();
?>
        <div class="page-kv-container" data-subpage-head>
          <div class="kv">
            <video poster="<?php echo imageSetUrl('keyvisual_movie_poster', 'full'); ?>" playsinline webkit-playsinline loop muted autoplay>
              <source src="<?php echo get_field('keyvisual_movie'); ?>" type="video/mp4">
            </video>
          </div>
          <div class="page-kv-inner">
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><a href="/attraction/">アトラクション</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php echo $title; ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <section class="section-about">
            <div class="bg-item-1" data-animate="bg" data-animate-id="bg-14"></div>
            <div class="bg-item-2" data-animate="bg" data-animate-id="bg-15"></div>
            <div class="section-inner">
              <?php if ($logo) : ?>
              <div class="logo"><img src="<?php echo $logo; ?>"></div>
              <?php endif; ?>
              <h2 class="section-heading"><span class="text-main"><?php echo $title; ?></span><span class="text-sub"><?php echo get_field('attraction_type'); ?></span></h2>
              <?php
              if($aboutMovie):
                echo "
                <div class=\"movie-block\" data-youtube>
                  <div class=\"movie\" data-youtube-el=\"player\" data-youtube-id=\"$aboutMovie\"></div>
                  <div class=\"thumb\" data-youtube-el=\"thumb\"><img src=\"$aboutMoviePoster\" alt=\"\"><span class=\"icon-play\"></span>
                  </div>
                </div>
                ";
                if($aboutMovie):
                  echo "<p class=\"movie-caption\">$aboutMovieCaption</p>";
                endif;
              endif;

              if ($catchCopy) :
                echo "<p class=\"copy\">$catchCopy</p>";
              endif;

              if ($aboutText) :
                echo "<div class=\"text\"><p>$aboutText</p></div>";
              endif;
              ?>
            </div>
            <?php if(have_rows('about_slider')): ?>
            <div class="slider">
              <div class="slider-contents" data-slider data-slider-id="about" data-slider-loop="true" data-slider-centered="true">
                <ul class="slider-item-list slides" data-slides>
                  <?php
                  while (have_rows('about_slider')) :
                    the_row();
                    $image = imageSubSetUrl('image', 'full');
                    if ($image) {
                      echo "<li class=\"slider-item slide\"><img src=\"$image\"></li>\n";
                    }
                  endwhile;
                  ?>
                </ul>
                <div class="slider-nav">
                  <span class="icon-arrow-circle slider-btn-prev"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                  <div class="slider-dot-list slider-paginations"></div>
                  <span class="icon-arrow-circle slider-btn-next"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </section>
          <?php
          $storyText = get_field('story_text');
          $storyImg = get_field('story_img');
          $storyImgPc = imageIdUrl($storyImg['pc_img'], 'full');
          $storyImgSp = imageIdUrl($storyImg['sp_img'], 'full');
          if (!$storyImgPc) {
            $storyImgPc = "$tempPath/assets/img/attraction/zaboom_journey/pc/story-bg-img.jpg";
          }
          if (!$storyImgSp) {
            $storyImgSp = "$tempPath/assets/img/attraction/zaboom_journey/story-bg-img.jpg";
          }
          if ($storyText) {
          ?>
          <section class="section-story">
            <div class="bg-img">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $storyImgSp; ?>">
                <source media="(min-width: 768px)" srcset="<?php echo $storyImgPc; ?>">
                <img src="<?php echo $storyImgPc; ?>" alt="">
              </picture>
            </div>
            <div class="section-inner">
              <h2 class="section-heading"><span class="text-main">STORY</span><span class="text-sub">ストーリー</span></h2>
              <div class="text">
                <p><?php echo $storyText; ?></p>
              </div>
            </div>
          </section>
          <?php } ?>
          <section class="section-howtoplay">
            <div class="bg-item-1"></div>
            <div class="bg-item-2"></div>
            <div class="bg-item-3"></div>
            <div class="bg-item-4"></div>
            <?php
            if(have_rows('how_to_play')):
              $howToPlayCount = 0;
            ?>
            <div class="section-inner">
              <h2 class="section-heading"><span class="text-main">HOW TO PLAY</span><span class="text-sub">アトラクションの遊び方</span></h2>
              <div class="step-list">
                <ol>
                  <?php while (have_rows('how_to_play')) : the_row();
                  $howToPlayCount++;
                  $title = get_sub_field('title');
                  $text = get_sub_field('text');
                  $image = imageSubSetUrl('image', 'full');
                  $imageSp = imageSubSetUrl('sp_image', 'full');
                  ?>
                  <li>
                    <div class="num-block"><span class="num-text">STEP</span><span class="num"><?php echo sprintf("%02d", $howToPlayCount); ?></span></div>
                    <div class="text-container">
                      <p class="title"><?php echo $title; ?></p>
                      <div class="text"><p><?php echo $text; ?></p></div>
                    </div>
                    <div class="img-container">
                      <div class="diagonal-line-block">
                        <div class="img">
                          <picture>
                            <source media="(max-width: 767px)" srcset="<?php echo $imageSp; ?>" width="590" height="370">
                            <source media="(min-width: 768px)" srcset="<?php echo $image; ?>" width="396" height="256">
                            <img src="<?php echo $image; ?>" alt="" loading="lazy" width="396" height="256">
                          </picture>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php endwhile; ?>
                </ol>
              </div>
            </div>
            <?php endif; ?>
          </section>
          <section class="section-info">
            <div class="section-inner">
              <h2 class="section-heading heading-bg-blue">アトラクション情報</h2>
              <dl>
                <?php
                if(have_rows('attraction_info')):
                  while (have_rows('attraction_info')) :
                    the_row();
                    $title = get_sub_field('title');
                    $text = get_sub_field('text');
                    $notes = get_sub_field('notes');
                    echo "
                      <dt><span>$title</span></dt>
                      <dd>$text";
                    if ($notes) {
                      echo "<p class=\"notes\">$notes</p>";
                    }
                    echo "</dd>";
                  endwhile;
                endif;
                $infoEx = get_field('attraction_info_ex');
                if($infoEx):
                ?>
                <dt><span>エクスペリエンス</span></dt>
                <dd class="item-experience">
                  <ul class="icon-list">
                    <?php
                    foreach($infoEx as $obj):
                    ?>
                    <li class="item-<?php echo $obj['value']; ?>">
                      <span class="icon-<?php echo $obj['value']; ?>"><svg><use xlink:href="#icon-<?php echo $obj['value']; ?>"/></svg></span>
                      <p class="text"><?php echo $obj['label']; ?></p>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                </dd>
                <?php endif; ?>
              </dl>
            </div>
          </section>
          <div class="block-bottom">
            <div class="bg-item-1" data-animate="bg" data-animate-id="bg-16"></div>
            <div class="bg-item-2" data-animate="bg" data-animate-id="bg-17"></div>
            <section class="section-collaboration">
              <?php if(have_rows('collaboration')): ?>
              <div class="section-inner">
                <h2 class="section-heading"><span class="text-main">COLLABORATION</span><span class="text-sub">コラボレーション</span></h2>
                <div class="section-contents">
                  <div class="img-container">
                    <?php
                    if (count(get_field('collaboration')) === 1) :
                      while (have_rows('collaboration')) :
                        the_row();
                        $image = imageSubSetUrl('img', 'full');
                        $caption = get_sub_field('caption');
                        echo "
                        <div class=\"img\"><img src=\"$image\">
                          <p class=\"caption\">$caption</p>
                        </div>";
                      endwhile;
                    else :
                    ?>
                    <div class="slider">
                      <div class="slider-contents" data-slider data-slider-id="collaboration">
                        <ul class="slider-item-list slides" data-slides>
                          <?php
                          while (have_rows('collaboration')) :
                            the_row();
                            $image = imageSubSetUrl('img', 'full');
                            $caption = get_sub_field('caption');
                            echo "
                            <li class=\"slider-item slide\">
                              <img src=\"$image\">
                              <p class=\"caption\">$caption</p>
                            </li>";
                          endwhile;
                          ?>
                        </ul>
                        <div class="slider-nav">
                          <div class="slider-dot-list slider-paginations"></div>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>
            </section>
            <section class="section-other">
              <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
              <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
              <div class="section-inner">
                <h2 class="section-heading"><span class="text-main">OTHER ATTRACTIONS</span><span class="text-sub">その他のアトラクション</span></h2>
                <div class="slider">
                  <div class="slider-contents" data-slider data-slider-id="other" data-slider-loop="true" data-slider-centered="true">
                    <ul class="slider-item-list slides" data-slides>
                      <?php
                      $attraction = new WP_Query(array(
                        'post_type' => 'attraction',
                        'posts_per_page' => -1,
                        'orderby' => 'post__in',
                        'post__not_in' => array($post->ID),
                      ));
                      if($attraction -> have_posts()): while($attraction -> have_posts()): $attraction->the_post();
                        $title = get_field('title');
                        $title = preg_replace('/\[(.*?)\]/', '<span>$1</span>', $title);
                        $attractionType = get_field('attraction_type');
                        $catchCopy = get_field('catch_copy');
                        $thumb = imageSetUrl('thumb', 'full');
                      ?>
                      <li class="slider-item slide">
                        <a href="<?php the_permalink(); ?>">
                          <div class="img"><img src="<?php echo $thumb; ?>"></div>
                          <h3 class="heading"><span class="text-sub-wrap"><span class="text-sub"><?php echo $attractionType; ?></span></span><span class="text-main"><?php the_title(); ?></span></h3>
                          <p class="text"><?php echo $catchCopy; ?></p>
                        </a>
                      </li>
                      <?php endwhile; endif; wp_reset_postdata(); ?>
                    </ul>
                    <div class="slider-nav">
                      <span class="icon-arrow-circle slider-btn-prev"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                      <span class="icon-arrow-circle slider-btn-next"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                    </div>
                  </div>
                </div>
                <div class="btn-backtotop"><a href="/"><span class="btn-text">BACK TO TOP</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
              </div>
            </section>
          </div>
        </div>
<?php get_footer(); ?>