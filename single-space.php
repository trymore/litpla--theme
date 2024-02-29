<?php
global $bodyClass;
$bodyClass = 'page-space-detail';
$tempPath = do_shortcode('[template]');
$sub_title = get_field('sub_title');
$URL = get_the_permalink();
$articleTitle = get_the_title();
$kv = get_field('kv');
$kvPc = imageIdUrl($kv['pc_img'], 'full');
$kvSp = imageIdUrl($kv['sp_img'], 'full');
$parkID  = get_field('park_id');
$status = get_field('status');
$congestion = get_field('congestion');
$parkTitle = get_field('park_title');
$parkText = get_field('park_text');
$importNews = get_field('import_news');
$relatedPosts = get_field('workshop');
$service = get_field('service');
$importFaq = get_field('import_faq');

// 本日の営業時間設定
$now = new DateTime();
$today = get_field('today');
$IF_SPECIAL = false;
$start;
$close;

// FAQ
$faqArray = array();
$faqTerms = get_terms('faq_cat');
if (!empty($faqTerms) && !is_wp_error($faqTerms)) {
  foreach ($faqTerms as $term) {
    $termName = $term->name;
    $faqArray += array($termName => 
      array(
        'count' => 0,
        'slug' => $term->slug,
        'articles' => array(),
        )
    );
  }
}
$faqPosts = get_posts(array(
  'post_type' => 'faq',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'orderby' => 'post__in',
  'tax_query' => array(
    array(
      'taxonomy' => 'faq_park',
      'field'    => 'term_taxonomy_id',
      'terms'    => $importFaq,
    ),
  ),
));
foreach($faqPosts as $faqPost) {
  $postFaqTerms = get_the_terms($faqPost->ID, 'faq_cat');
  if ($postFaqTerms){
    foreach ($postFaqTerms as $term) {
      $termName = $term->name;
      $faqArray[$termName]['count'] += 1;
      array_push($faqArray[$termName]['articles'], $faqPost);
    }
  }
}
// echo "<!--";
// print_r($faqArray);
// echo "-->";
get_header();
?>

        <script>window.business_hours = <?php echo json_encode($today)?> </script>
        <div class="page-nav">
          <p class="space-name"><?php echo $articleTitle; ?></p>
          <div class="page-nav-list <?php if (!$relatedPosts || !$faqPosts) { echo "is-no-slider"; } ?>" data-mobile-slider data-slider-id="mobile-space">
            <ul class="mobile-slides" data-local-nav>
              <li class="item-price mobile-slide is-located" data-local-nav-el="item"><a href="#price"><span class="icon-price">
                    <svg>
                      <use xlink:href="#icon-price"/>
                    </svg></span><span class="btn-text">料金表</span></a></li>
              <li class="item-info mobile-slide" data-local-nav-el="item"><a href="#info"><span class="icon-info">
                    <svg>
                      <use xlink:href="#icon-info"/>
                    </svg></span><span class="btn-text">営業案内</span></a></li>
              <li class="item-park mobile-slide" data-local-nav-el="item"><a href="#park"><span class="icon-park">
                    <svg>
                      <use xlink:href="#icon-park"/>
                    </svg></span><span class="btn-text">パーク紹介</span></a></li>
              <li class="item-attractions mobile-slide" data-local-nav-el="item"><a href="#attractions"><span class="icon-attractions">
                    <svg>
                      <use xlink:href="#icon-attractions"/>
                    </svg></span><span class="btn-text"><span class="pc">遊べる</span>アトラクション</span></a></li>
              <?php if ($relatedPosts) : ?>
              <li class="item-workshop mobile-slide" data-local-nav-el="item"><a href="#workshop"><span class="icon-workshop">
                    <svg>
                      <use xlink:href="#icon-workshop"/>
                    </svg></span><span class="btn-text">ワークショップ</span></a></li>
              <?php endif; ?>
              
              <?php if ($faqPosts) : ?>
              <li class="item-faq mobile-slide" data-local-nav-el="item"><a href="#faq"><span class="icon-faq">
                    <svg>
                      <use xlink:href="#icon-faq"/>
                    </svg></span><span class="btn-text">FAQ</span></a></li>
              <?php endif; ?>
            </ul>
            <button class="btn-nav-more mobile-slider-btn-prev"><span class="icon-arrow-circle"><span class="icon-arrow">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span></span>
            </button>
            <button class="btn-nav-more mobile-slider-btn-next"><span class="icon-arrow-circle"><span class="icon-arrow">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span></span>
            </button>
          </div>
        </div>
        <div class="page-kv-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $kvSp; ?>">
              <source media="(min-width: 768px)" srcset="<?php echo $kvPc; ?>">
              <img src="<?php echo $kvPc; ?>" alt="">
            </picture>
          </div>
          <div class="page-kv-inner">
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span>
              </li>
              <li><a href="/space/">PARK検索</a><span class="icon-arrow">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span>
              </li>
              <li><?php echo $articleTitle; ?><span class="icon-arrow">
                  <svg>
                    <use xlink:href="#icon-arrow"/>
                  </svg></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <?php if(have_rows('news')): ?>
          <div class="news-important">
            <div class="news-important-inner">
              <ul>
                <?php
                while(have_rows('news')):
                  the_row();
                  $date = get_sub_field('date');
                  $text = get_sub_field('text');
                  $url = get_sub_field('url');
                  echo "<li><span class=\"date\">$date</span><a href=\"$url\"><span>$text</span></a></li>";
                endwhile;
                ?>
              </ul>
            </div>
          </div>
          <?php endif; ?>
          <?php if (strstr($status['value'], 'open')) : ?>
          <div class="todays-info" data-park-id="<?php echo $parkID; ?>">
            <div class="character">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/space/detail/todays-info-character.png" width="111" height="160">
                <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/space/detail/pc/todays-info-character.png, <?php echo $tempPath; ?>/assets/img/space/detail/pc/todays-info-character@2x.png 2x" width="65" height="93">
                <img src="<?php echo $tempPath; ?>/assets/img/space/detail/pc/todays-info-character.png" alt="" loading="lazy" width="65" height="93">
              </picture>
            </div>
            <dl>
              <dt>本日の営業時間</dt>
              <dd class="hour" data-business="time"></dd>
              <dt>只今の混雑状況</dt>
              <dd class="status" data-business="status">
                <?php if($congestion == 1): ?>
                <div class="status-1"><span class="status-icon"><svg class="pc"><use xlink:href="#icon-double-circle"/></svg><svg class="sp"><use xlink:href="#icon-double-circle-sp"/></svg></span><span class="status-text">快適に遊べます</span></div>
                <?php elseif($congestion == 2): ?>
                <div class="status-2"><span class="status-icon"><svg class="pc"><use xlink:href="#icon-circle"/></svg><svg class="sp"><use xlink:href="#icon-circle-sp"/></svg></span><span class="status-text">やや混雑しています</span></div>
                <?php elseif($congestion == 3): ?>
                <div class="status-3"><span class="status-icon"><svg class="pc"><use xlink:href="#icon-triangle"/></svg><svg class="sp"><use xlink:href="#icon-triangle-sp"/></svg></span><span class="status-text">混雑しています</span></div>
                <?php elseif($congestion == 4): ?>
                <div class="status-4"><span class="status-icon"><svg class="pc"><use xlink:href="#icon-limited"/></svg><svg class="sp"><use xlink:href="#icon-limited-sp"/></svg></span><span class="status-text">入場制限中<span class="text-small">一時的にフリーパスの販売を<br class="pc">休止<br class="sp">しています</span></span></div>
                <?php elseif($congestion == 5): ?>
                <div class="status-5"><span class="status-icon"><svg class="pc"><use xlink:href="#icon-closed"/></svg><svg class="sp"><use xlink:href="#icon-closed-sp"/></svg></span><span class="status-text">営業時間外です</span></div>
                <?php endif; ?>
              </dd>
            </dl>
          </div>
          <?php endif; ?>
          <?php
          $pressPosts = get_posts(array(
            'post_type' => 'news',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'tax_query' => array(
              array(
                'taxonomy' => 'news_place',
                'field' => 'term_taxonomy_id',
                'terms' => $importNews,
              ),
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
          $publicityPosts = get_posts(array(
            'post_type' => 'news',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'tax_query' => array(
              'relation' => 'AND',
              array(
                'taxonomy' => 'news_place',
                'field' => 'term_taxonomy_id',
                'terms' => $importNews,
              ),
              array(
                'taxonomy' => 'news_category',
                'field' => 'slug',
                'terms' => 'publicity',
              ),
            ),
          ));
          if ($pressPosts || $publicityPosts) :
          ?>
          <section class="section-news">
            <div class="bg-item-1"></div>
            <div class="bg-item-2"></div>
            <div class="section-inner">
              <h2 class="section-heading"><span class="text-main">NEWS</span><span class="text-sub">パークの最新情報</span></h2>
              <div class="section-contents">
                <?php if ($pressPosts) : ?>
                <div class="latest-news">
                  <?php 
                  $term = get_term_by('id', $importNews, 'news_place');
                  if ($term) {
                    $slug = $term->slug;
                    echo "<div class=\"btn-viewmore btn-viewmore-bg-none\"><a href=\"/news-space/$slug/\"><span class=\"btn-text\">View More</span><span class=\"btn-icon\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></a></div>";
                  }
                  ?>
                  <div class="latest-news-list">
                    <div class="slider">
                      <div class="slider-contents" data-slider data-slider-id="space-news">
                        <ul class="slider-item-list slides" data-slides>
                          <?php
                          foreach ($pressPosts as $post):
                            setup_postdata($post);
                            $thumb = imageSetUrl('thumb', 'full');
                            $title = get_the_title();
                            $permalink = get_the_permalink();
                            $date = get_the_date('Y.m.d');
                            if (!$thumb) {
                              $thumb = get_the_post_thumbnail_url();
                            }

                            echo "
                            <li class=\"slider-item slide\">
                              <a href=\"$permalink\">
                                <div class=\"thumb\"><img src=\"$thumb\"></div>
                                <p class=\"date\">$date</p>
                                <p class=\"title\">$title</p>
                              </a>
                            </li>";
                          endforeach;
                          wp_reset_postdata();
                          ?>
                        </ul>
                        <div class="slider-scroll"><span class="slider-scroll-bar swiper-scrollbar-drag"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                endif;
                if ($publicityPosts) :
                ?>
                <div class="park-info">
                  <h3 class="sub-heading">パークからのお知らせ</h3>
                  <?php 
                  $term = get_term_by('id', $importNews, 'news_place');
                  if ($term) {
                    $slug = $term->slug;
                    echo "<div class=\"btn-viewmore btn-viewmore-bg-none\"><a href=\"/news/publicity/?news_place=$slug\"><span class=\"btn-text\">View More</span><span class=\"btn-icon\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></a></div>";
                  }
                  ?>
                  <div class="park-info-list">
                    <ul>
                      <?php
                      foreach ($publicityPosts as $post):
                        setup_postdata($post);
                        $title = get_the_title();
                        $permalink = get_the_permalink();
                        $date = get_the_date('Y.m.d');
                        echo "
                        <li>
                          <a href=\"$permalink\">
                            <p class=\"date\">$date</p>
                            <p class=\"title\">$title</p><span class=\"icon-arrow-circle\"><span class=\"icon-arrow\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></span>
                          </a>
                        </li>";
                      endforeach;
                      wp_reset_postdata();
                      ?>
                    </ul>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </section>
          <?php endif; ?>
          <section class="section-tickets" id="price" data-observer>
            <div class="section-container">
              <div class="bg-item-1" data-animate="bg" data-animate-id="bg-19"></div>
              <div class="bg-item-2" data-animate="bg" data-animate-id="bg-20"></div>
              <div class="bg-item-3"></div>
              <div class="section-inner">
                <h2 class="section-heading"><span class="text-main">TICKET</span><span class="text-sub">チケット料金</span></h2>
                <div class="section-contents">
                  <?php
                  if(have_rows('ticket')):
                    while (have_rows('ticket')):
                      the_row();
                      $table = get_sub_field('table');
                      echo "
                      <div class=\"table-block\">
                        <div data-scrollable>
                          $table
                        </div>
                      </div>
                      ";
                    endwhile;
                  endif;
                  ?>
                  <?php
                  if(have_rows('ticket_table')):
                    while (have_rows('ticket_table')):
                      the_row();
                      echo '<div class="table-block"><div data-scrollable>';
                      $tableName = get_row_layout();
                      $table = get_sub_field('table');
                      if (!empty($table)):
                        echo "<table class='table-$tableName'>";
                        if (!empty($table['header'])):
                          echo '<tr>';
                          $count = 0;
                          foreach($table['header'] as $th) {
                            $count++;
                            if ($count === 1) {
                              echo '<th class="table-heading">';
                            } else {
                              echo '<th class="table-heading-sub">';
                            }
                            echo $th['c'];
                            echo '</th>';
                          }
                          echo '</tr>';
                        endif;
                        foreach($table['body'] as $tr):
                          $count = 0;
                          echo '<tr>';
                          foreach($tr as $td):
                            $count++;
                            if ($count === 1) {
                              echo '<th class="item-heading">';
                            } else {
                              echo '<td>';
                            }
                            echo $td['c'];
                            echo '</td>';
                          endforeach;
                          echo '</tr>';
                        endforeach;
                        echo '</table></div></div>';
                      endif;
                    endwhile;
                  endif;
                  ?>
                  <div class="notes">
                    <?php
                    the_field('tickets_notes_editor');
                    if(have_rows('tickets_notes')):
                    ?>
                    <ul>
                      <?php
                      while(have_rows('tickets_notes')):
                        the_row();
                        $text = get_sub_field('text');
                        echo "<li>$text</li>";
                      endwhile;
                      ?>
                    </ul>
                    <?php endif; ?>
                  </div>
                  <?php
                  if(have_rows('park_banner','option')):
                    while (have_rows('park_banner','option')) :
                      the_row();
                      $image = imageSubSetUrl('pc_image', 'full');
                      $imageSp = imageSubSetUrl('sp_image', 'full');
                      $park = get_sub_field('park_setting');
                      $link = get_sub_field('link');
                      foreach ($park as &$value) :
                        if ($importNews === $value->term_taxonomy_id) :
                          echo "
                          <div class=\"banner\">
                            <a href=\"$link\" target=\"_blank\">
                              <picture>
                                <source media=\"(max-width: 767px)\" srcset=\"$imageSp\">
                                <source media=\"(min-width: 768px)\" srcset=\"$image\">
                                <img src=\"$image\">
                              </picture>
                            </a>
                          </div>";
                        endif;
                      endforeach;
                    endwhile;
                  endif;
                  ?>
                </div>
              </div>
            </div>
          </section>
          <div class="info-container">
            <div class="info-inner">
              <section class="info-section section-guide" id="info" data-observer>
                <div class="section-container">
                  <div class="section-inner">
                    <h2 class="section-heading heading-bg-blue">営業案内</h2>
                    <div class="section-contents">
                      <dl>
                        <?php
                        if(have_rows('info')):
                          while (have_rows('info')):
                            the_row();
                            if(get_row_layout() == 'business_hours'):
                              $text = get_sub_field('text');
                              $notes = get_sub_field('notes');
                              echo "<dt>営業時間</dt><dd>$text";
                              if ($notes) {
                                echo "<p class='notes'>$notes</p>";
                              }
                              echo "</dd>";
                            elseif(get_row_layout() == 'holiday'):
                              $text = get_sub_field('text');
                              $notes = get_sub_field('notes');
                              echo "<dt>定休日</dt><dd>$text";
                              if ($notes) {
                                echo "<p class='notes'>$notes</p>";
                              }
                              echo "</dd>";
                            elseif(get_row_layout() == 'tel'):
                              $text = get_sub_field('text');
                              $notes = get_sub_field('notes');
                              echo "<dt>TEL</dt><dd>$text";
                              if ($notes) {
                                echo "<p class='notes'>$notes</p>";
                              }
                              echo "</dd>";
                            elseif(get_row_layout() == 'period'):
                              $text = get_sub_field('text');
                              $notes = get_sub_field('notes');
                              echo "<dt>期間</dt><dd>$text";
                              if ($notes) {
                                echo "<p class='notes'>$notes</p>";
                              }
                              echo "</dd>";
                            elseif(get_row_layout() == 'organizer'):
                              $text = get_sub_field('text');
                              $notes = get_sub_field('notes');
                              echo "<dt>主催</dt><dd>$text";
                              if ($notes) {
                                echo "<p class='notes'>$notes</p>";
                              }
                              echo "</dd>";
                            elseif(get_row_layout() == 'access'):
                              $link = get_sub_field('link');
                              $linkText = get_sub_field('link_text');
                              $text = get_sub_field('text');
                              $map = get_sub_field('map');
                              echo "<dt>アクセス</dt><dd>
                              ";
                              if ($link) {
                                echo "<a href='$link' target='_blank'>$linkText</a><br>";
                              }
                              if ($text) {
                                echo $text;
                              }
                              if ($map) {
                                echo "<div class='map'><iframe src='$map' width='670' height='360' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe></div>";
                              }
                              echo "</dd>";
                            endif;
                          endwhile;
                        endif;
                        ?>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
              </section>
              <section class="info-section section-park" id="park" data-observer>
                <div class="section-container">
                  <div class="bg-item-1" data-animate="bg" data-animate-id="bg-18"></div>
                  <div class="bg-item-2" data-animate="bg" data-animate-id="bg-15"></div>
                  <div class="section-inner">
                    <h2 class="section-heading heading-bg-blue">パーク紹介</h2>
                    <div class="section-contents">
                      <div class="text">
                        <p class="text-large"><?php echo $parkTitle; ?></p>
                        <p><?php echo $parkText; ?></p>
                      </div>
                    </div>
                  </div>
                  <?php if(have_rows('slider')): ?>
                  <div class="slider" data-slider data-slider-id="park" data-slider-loop="true" data-slider-centered="true">
                    <ul class="slider-item-list slides" data-slides>
                      <?php
                      while (have_rows('slider')):
                        the_row();
                        if(get_row_layout() == 'images'):
                          $image = imageSubSetUrl('image', 'full');
                          $border = get_sub_field('border') ? '': 'slider-item-border';
                          echo "<li class=\"slider-item slider-item-border slide $border\"><img src=\"$image\" alt=\"\"></li>";
                        elseif(get_row_layout() == 'movie'):
                          $youtube = get_sub_field('youtube_id');
                          $image = imageSubSetUrl('image', 'full');
                          echo "
                          <li class=\"slider-item slider-item-movie slide\">
                            <div class=\"movie-block\" data-youtube>
                              <div class=\"movie\" data-youtube-el=\"player\" data-youtube-id=\"$youtube\"></div>
                              <div class=\"thumb\" data-youtube-el=\"thumb\"><img src=\"$image\" alt=\"\"><span class=\"icon-play\"></span>
                              </div>
                            </div>
                          </li>";
                        endif;
                      endwhile;
                      ?>
                    </ul>
                    <div class="slider-nav">
                      <span class="icon-arrow-circle slider-btn-prev"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                      <div class="slider-dot-list slider-paginations"></div>
                      <span class="icon-arrow-circle slider-btn-next"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </section>
              <section class="info-section section-attractions" id="attractions" data-observer>
                <div class="section-container">
                  <div class="bg-item-1"></div>
                  <div class="bg-item-2"></div>
                  <div class="bg-item-3"></div>
                  <div class="section-inner">
                    <h2 class="section-heading heading-bg-blue">アトラクション紹介</h2>
                    <div class="section-contents">
                      <div class="attractions-list" data-expandable-list>
                        <ul data-initial-display-count="5">
                          <?php
                          $attractions = get_field('attractions');
                          if ($attractions):
                            $count = 0;
                            foreach ($attractions as $post):
                              setup_postdata($post);
                              $title = get_the_title();
                              $permalink = get_the_permalink();
                              $date = get_the_date('Y.m.d');
                              $new = get_field('new');
                              $attractionType = get_field('attraction_type');
                              $catchCopy = get_field('catch_copy');
                              $thumb = imageSetUrl('thumb', 'full');
                              $count++;
                              $index = ($count % 3 === 0) ? 3 : $count % 3;
                              echo "
                              <li class=\"item-$index\" data-expandable-item>
                                <a href=\"$permalink\">
                                  <div class=\"img-container\">
                                    <div class=\"img\"><img src=\"$thumb\"></div>";
                              if ($new) {
                                echo "<div class=\"icon-new\"><svg><use xlink:href=\"#icon-new-bg\"/></svg><span class=\"icon-text\">NEW</span></div>";
                              }
                              echo "
                                  </div>
                                  <div class=\"text-container\">
                                    <h3 class=\"heading\"><span class=\"text-sub-wrap\" data-adjust-height=\"target\"><span class=\"text-sub\" data-adjust-height=\"source\">$attractionType</span></span><span class=\"text-main\">$title</span></h3>
                                    <p class=\"text\">$catchCopy</p>
                                  </div>
                                </a>
                              </li>
                              ";
                            endforeach;
                            wp_reset_postdata();
                          endif;
                          ?>
                        </ul>
                        <div class="btn-more sp" data-show-more>
                          <button><span class="btn-text">View More</span><span class="btn-icon">
                              <svg>
                                <use xlink:href="#icon-arrow"/>
                              </svg></span></button>
                        </div>
                      </div>
                      <?php if(have_rows('attractions_calendar')): ?>
                      <div class="schedule">
                        <p class="title">隔週アトラクションの運営予定</p>
                        <div class="contents">
                          <?php
                          while(have_rows('attractions_calendar')): the_row();
                            $image = imageSubSetUrl('image', 'full');
                            echo "<div class=\"calendar\"><img src=\"$image\"></div>";
                          endwhile;
                          ?>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </section>
              <?php if ($relatedPosts) : ?>
              <section class="info-section section-workshop" id="workshop" data-observer>
                <div class="section-container">
                  <div class="bg-item-1"></div>
                  <div class="section-inner">
                    <h2 class="section-heading heading-bg-blue">ワークショップ</h2>
                    <div class="section-contents">
                      <ul class="workshop-list">
                        <?php
                        foreach ($relatedPosts as $post):
                          setup_postdata($post);
                          $summary = get_field('summary');
                          $thumb = imageSetUrl('pc_thumb', 'full');
                         ?>
                        <li>
                          <a href="<?php the_permalink(); ?>">
                            <div class="thumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                            <div class="text-container">
                              <p class="title"><?php the_title(); ?></p>
                              <p class="text"><?php echo $summary; ?></p>
                            </div>
                            <div class="btn-viewmore"><span><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
                          </a>
                        </li>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
              <?php endif; ?>
              <?php if ($service) : ?>
              <section class="info-section section-service" id="service" data-observer>
                <div class="section-container">
                  <div class="section-inner">
                    <h2 class="section-heading heading-bg-blue">提供サービス</h2>
                    <div class="section-contents">
                      <ul class="service-list">
                        <?php
                        foreach ($service as $val) {
                          $label = $val['label'];
                          if ($label === '多目的ルーム') {
                            $label .= '<span>（団体のみ）</span>';
                          }
                          $value = $val['value'];
                          echo "<li><p class=\"text\">$label</p><span class=\"icon icon-$value\"><svg><use xlink:href=\"#icon-$value\"/></svg></span></li>";
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
              <?php endif; ?>
              <?php if ($faqPosts) : ?>
              <section class="info-section section-faq" id="faq" data-observer>
                <div class="section-container">
                  <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
                  <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
                  <div class="section-inner">
                    <h2 class="section-heading heading-bg-blue">FAQ</h2>
                    <div class="section-contents">
                      <ul class="faq-nav">
                        <?php
                        foreach($faqArray as $key => $data) : if ($data['count']) :
                          echo "<li><a href=\"#$data[slug]\"><span class=\"btn-text\">$key</span><span class=\"icon-arrow-circle\"><span class=\"icon-arrow\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></span></a></li>";
                        endif; endforeach;
                        ?>
                      </ul>
                      <?php foreach($faqArray as $key => $data) : if ($data['count']) : ?>
                      <section class="section-sub" id="<?php echo $data['slug']; ?>">
                        <h3 class="section-sub-heading heading-blue-line"><?php echo $key; ?></h3>
                        <div class="section-sub-contents">
                          <?php
                          foreach($data['articles'] as $post) : setup_postdata($post); ?>
                          <div class="accordion" data-accordion>
                            <div class="accordion-btn" data-accordion-el="trigger"><span class="icon-q">Q.</span>
                              <div class="text-q"><?php the_field('question'); ?></div><span class="accordion-btn-icon"></span>
                            </div>
                            <div data-accordion-el="content">
                              <div class="accordion-contents"><span class="icon-a">A</span>
                                <div class="text-a"><?php the_field('anser'); ?></div>
                              </div>
                            </div>
                          </div>
                          <?php endforeach; wp_reset_postdata();?>
                        </div>
                      </section>
                      <?php endif; endforeach;  ?>
                    </div>
                  </div>
                </div>
              </section>
              <?php endif; ?>
            </div>
          </div>
        </div>
<?php get_footer(); ?>