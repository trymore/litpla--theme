<?php
global $bodyClass;
$bodyClass = 'page-space';
$tempPath = do_shortcode('[template]');
get_header();
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/space/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/space/pc/page-kv.jpg">
              <img src="<?php echo $tempPath; ?>/assets/img/space/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading">パーク検索</span>
              <span class="text-sub" data-subpage-head-el="heading">PARK LIST</span>
            </h2>
            <div class="decoration-text">
              <span class="char char-1">P</span>
              <span class="char char-2">A</span>
              <span class="char char-3">R</span>
              <span class="char char-4">K</span>
              <span class="char char-5 space">&nbsp;</span>
              <span class="char char-6">L</span>
              <span class="char char-7">I</span>
              <span class="char char-8">S</span>
              <span class="char char-9">T</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>パーク検索<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <section class="section-search">
              <h2 class="section-heading">エリアから探す</h2>
              <ul class="space-nav space-nav-area">
                <?php
                $cat = get_terms(array(
                  'taxonomy' => 'space_category',
                  'hide_empty' => true,
                  'parent' => 0,
                ));
                if (!empty($cat) && !is_wp_error($cat)) {
                  foreach ($cat as $term) {
                    $name = $term -> name;
                    $slug = $term -> slug;
                    echo "<li><a href='#$slug'><span class='btn-text'>$name</span><span class='icon-arrow-circle'><span class='icon-arrow'><svg><use xlink:href='#icon-arrow'/></svg></span></span></a></li>";
                  }
                }
                ?>
              </ul>
            </section>
            <?php
            $parentTerms = get_terms(array(
              'taxonomy' => 'space_category',
              'hide_empty' => true,
              'parent' => 0,
            ));
            if (!empty($parentTerms) && !is_wp_error($parentTerms)) {
              foreach ($parentTerms as $parentTerm) {
                $parentCatName = $parentTerm -> name;
                $parentCatSlug = $parentTerm -> slug;
                $childTerms = get_terms(array(
                  'taxonomy' => 'space_category',
                  'hide_empty' => true,
                  'parent' => $parentTerm->term_id,
                ));
                if (!empty($childTerms) && !is_wp_error($childTerms)) {
            ?>
            <section class="section-area" id="<?php echo $parentCatSlug; ?>">
              <h2 class="section-heading"><?php echo $parentCatName; ?></h2>
              <ul class="space-nav space-nav-place">
                <?php
                  foreach ($childTerms as $childTerm):
                    $catName = $childTerm -> name;
                    $catSlug = $childTerm -> slug;
                    echo "<li><a href='#$catSlug'><span class='btn-text'>$catName</span><span class='icon-arrow-circle'><span class='icon-arrow'><svg><use xlink:href='#icon-arrow'/></svg></span></span></a></li>";
                  endforeach;
                ?>
              </ul>
              <ul class="space-list">
                <?php foreach ($childTerms as $childTerm) : ?>
                <div id="<?php echo $childTerm -> slug; ?>">
                  <?php
                    // 関連する記事の取得
                    $args = array(
                      'post_type' => 'space',
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'space_category',
                          'field' => 'term_id',
                          'terms' => $childTerm->term_id,
                        ),
                      ),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                      while ($query->have_posts()) {
                        $query->the_post();
                        $permalink = get_permalink();
                        $title = get_the_title();
                        $thumb = imageSetUrl('thumb', 'full');
                        $status = get_field('status');
                        $statusValue = $status['value'];
                        $statusLabel = $status['label'];
                        $address = get_field('address');
                        $businessHours = get_field('business_hours');
                        echo "
                          <li>
                            <a href='$permalink'>
                              <div class='thumb'><img src='$thumb'></div>
                              <div class='text-container'>
                                <p class='status status-$statusValue'><span><span>$statusLabel</span></span></p>
                                <p class='place'>$title</p>
                                <dl class='info'>";
                        if ($address):
                        echo "
                                  <dt><span>住所</span></dt>
                                  <dd>$address</dd>";
                        endif;
                        if ($businessHours):
                        echo "
                                  <dt><span>営業時間</span></dt>
                                  <dd>$businessHours</dd>";
                        endif;
                        echo "
                                </dl>
                              </div>
                              <div class='btn-viewmore'><span><span class='btn-text'>View More</span><span class='btn-icon'><svg><use xlink:href='#icon-arrow'/></svg></span></span></div>
                            </a>
                          </li>";
                      }
                      wp_reset_postdata();
                    }
                  ?>
                </div>
                <?php endforeach; ?>
              </ul>
            </section>
            <?php
                }
              }
            }
            ?>
            <section class="section-area" id="end">
              <h2 class="section-heading">過去のパーク</h2>
              <ul class="space-list">
                <?php
                  // 関連する記事の取得
                  $args = array(
                    'post_type' => 'space',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'space_category',
                        'field' => 'slug',
                        'terms' => 'end',
                      ),
                    ),
                  );
                  $query = new WP_Query($args);
                  if ($query->have_posts()) {
                    while ($query->have_posts()) {
                      $query->the_post();
                      $permalink = get_permalink();
                      $title = get_the_title();
                      $thumb = imageSetUrl('thumb', 'full');
                      $status = get_field('status');
                      $statusValue = $status['value'];
                      $statusLabel = $status['label'];
                      $address = get_field('address');
                      $businessHours = get_field('business_hours');
                      echo "
                        <li>
                          <a href='$permalink'>
                            <div class='thumb'><img src='$thumb'></div>
                            <div class='text-container'>
                              <p class='status status-$statusValue'><span><span>$statusLabel</span></span></p>
                              <p class='place'>$title</p>
                              <dl class='info'>";
                      if ($address):
                      echo "
                                <dt><span>住所</span></dt>
                                <dd>$address</dd>";
                      endif;
                      if ($businessHours):
                      echo "
                                <dt><span>営業時間</span></dt>
                                <dd>$businessHours</dd>";
                      endif;
                      echo "
                              </dl>
                            </div>
                            <div class='btn-viewmore'><span><span class='btn-text'>View More</span><span class='btn-icon'><svg><use xlink:href='#icon-arrow'/></svg></span></span></div>
                          </a>
                        </li>";
                    }
                    wp_reset_postdata();
                  }
                ?>
              </ul>
            </section>
          </div>
        </div>
<?php get_footer(); ?>