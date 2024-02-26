<?php
global $bodyClass;
$bodyClass = 'page-blog';
$tempPath = do_shortcode('[template]');
get_header();
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/magazine/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/magazine/pc/page-kv.jpg"><img src="<?php echo $tempPath; ?>/assets/img/magazine/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading">ブログ</span>
              <span class="text-sub" data-subpage-head-el="heading">BLOG</span>
            </h2>
            <div class="decoration-text">
              <span class="char char-1">B</span>
              <span class="char char-2">L</span>
              <span class="char char-3">O</span>
              <span class="char char-4">G</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>ブログ<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <div class="blog-new-list">
              <div class="slider">
                <div class="slider-contents" data-slider data-slider-id="magazine">
                  <ul class="slider-item-list slides" data-slides>
                    <?php
                    $query = new WP_Query(array(
                      'post_type' => 'magazine',
                      'post_status' => 'publish',
                      'posts_per_page' => -1,
                      'meta_query' => array(
                        'relation' => 'AND',
                        array(
                          'key' => 'slider',
                          'value' => true,
                          'compare' => '=',
                        ),
                      ),
                    ));
                    if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                      $thumb = imageSetUrl('thumb', 'full');
                      if (!$thumb) {
                        $thumb = get_the_post_thumbnail_url();
                      }
                      $terms = get_the_terms($post->ID, 'magazine_category');
                      $termName = $terms[0]->name;
                    ?>
                    <li class="slider-item slide">
                      <a href="<?php the_permalink(); ?>">
                        <div class="thumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                        <p class="category"><span><?php echo $termName; ?></span></p>
                        <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
                        <p class="title"><?php the_title(); ?></p>
                      </a>
                    </li>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                  </ul>
                  <div class="slider-scroll"><span class="slider-scroll-bar swiper-scrollbar-drag"></span></div>
                </div>
              </div>
            </div>
            <?php
            $categories = get_terms(array(
              'taxonomy' => 'magazine_category',
              'hide_empty' => false,
            ));
            ?>
            <div class="blog-contents-wrapper">
              <div class="blog-main-contents">
                <div class="blog-main">
                  <div class="category-list-select sp">
                    <select onchange="location.href = value;">
                      <option value="/magazine/" selected>すべて</option>
                      <?php
                      if (!empty($categories)) {
                        foreach ($categories as $term) {
                          $categoryLink = esc_url(get_term_link($term));
                          $categoryName = esc_html($term->name);
                          echo "<option value=\"$categoryLink\">$categoryName</option>";
                        }
                      }
                      ?>
                    </select>
                    <span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span>
                  </div>
                  <h3 class="blog-main-heading">すべて</h3>
                  <ul class="blog-list">
                    <?php
                    if (have_posts()) : 
                      while (have_posts()) : the_post();
                        $thumb = imageSetUrl('thumb', 'full');
                        if (!$thumb) {
                          $thumb = get_the_post_thumbnail_url();
                        }
                        $terms = get_the_terms($post->ID, 'magazine_category');
                        $termName = $terms[0]->name;
                    ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <div class="thumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                        <div class="text-container">
                          <div class="info">
                            <p class="category"><span><?php echo $termName; ?></span></p>
                            <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
                          </div>
                          <p class="title"><?php the_title(); ?><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></p>
                        </div>
                      </a>
                    </li>
                    <?php endwhile; endif; ?>
                  </ul>
                </div>
                <?php if (function_exists('pagination')) { pagination($wp_query->max_num_pages, get_query_var('paged')); } ?>
              </div>
              <div class="blog-side-contents">
                <div class="blog-category">
                  <ul class="category-list">
                    <li class="is-selected"><a href="/magazine/"><span class="btn-text">すべて</span><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></a></li>
                    <?php
                    if (!empty($categories)) {
                      foreach ($categories as $term) {
                        $categoryLink = esc_url(get_term_link($term));
                        $categoryName = esc_html($term->name);
                        echo "<li><a href='$categoryLink'><span class='btn-text'>$categoryName</span><span class='icon-arrow'><svg><use xlink:href='#icon-arrow'/></svg></span></a></li>";
                      }
                    }
                    ?>
                  </ul>
                </div>
                <div class="blog-tags">
                  <h3 class="blog-side-contents-heading">人気のタグ</h3>
                  <ul class="tag-list" data-tag="tag">
                    <?php
                    $tags = array();
                    $posts = get_posts(array(
                      'post_type' => 'magazine',
                      'post_status' => 'publish',
                      'meta_key' => 'views',
                      'posts_per_page' => -1
                    ));
                    foreach($posts as $post) {
                      $terms = get_the_terms( $post->ID, 'magazine_tag');
                      if ($terms){
                        foreach ( $terms as $tag ) {
                          $tag_name = $tag->name;
                          $view_count = (int) get_post_meta($post->ID, 'views', true);
                          if (array_key_exists($tag_name, $tags)) {
                            $tags[$tag_name] += $view_count;
                          } else {
                            $tags += array($tag_name => $view_count);
                          }
                        }
                      }
                    }
                    arsort($tags);
                    foreach ( $tags as $key => $value  ) :
                      $tag = get_term_by('name', $key, 'magazine_tag');
                      $tagURL = get_tag_link($tag->term_id);
                      $tagName = $tag->name;
                      echo "<li><a href='$tagURL'>#$tagName</a></li>";
                    endforeach;
                    ?>
                  </ul>
                  <div class="btn-viewalltags"><button data-tag="button"><span class="btn-text">View All Tags</span><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></button></div>
                </div>
                <?php
                $recommend = get_field('blog_recommend', 'option');
                if ($recommend) :
                ?>
                <div class="blog-recommended">
                  <h3 class="blog-side-contents-heading">おすすめの記事</h3>
                  <ul class="article-list">
                    <?php
                    foreach($recommend as $post):
                      setup_postdata($post);
                      $terms = get_the_terms($post->ID, 'magazine_category');
                      $termName = $terms[0]->name;
                      $title = get_the_title();
                      $permalink = get_the_permalink();
                      $thumb = imageSetUrl('thumb', 'full');
                      if (!$thumb) {
                        $thumb = get_the_post_thumbnail_url();
                      }
                      echo "
                      <li>
                        <a href=\"$permalink\">
                          <div class=\"thumb\"><img src=\"$thumb\"></div>
                          <div class=\"text-container\">
                            <p class=\"category\">$termName</p>
                            <p class=\"title\">$title</p>
                          </div>
                        </a>
                      </li>";
                    endforeach;
                    wp_reset_postdata();
                    ?>
                  </ul>
                </div>
                <?php endif; ?>
                <div class="blog-popular">
                  <h3 class="blog-side-contents-heading">人気の記事</h3>
                  <ul class="article-list">
                    <?php
                    $tags = array();
                    $favoritePosts = get_posts(array(
                      'post_type' => 'magazine',
                      'post_status' => 'publish',
                      'meta_key' => 'views',
                      'posts_per_page' => 5
                    ));
                    foreach($favoritePosts as $post):
                      setup_postdata($post);
                      $terms = get_the_terms($post->ID, 'magazine_category');
                      $termName = $terms[0]->name;
                      $title = get_the_title();
                      $permalink = get_the_permalink();
                      $thumb = imageSetUrl('thumb', 'full');
                      if (!$thumb) {
                        $thumb = get_the_post_thumbnail_url();
                      }
                      echo "
                      <li>
                        <a href=\"$permalink\">
                          <div class=\"thumb\"><img src=\"$thumb\"></div>
                          <div class=\"text-container\">
                            <p class=\"category\">$termName</p>
                            <p class=\"title\">$title</p>
                          </div>
                        </a>
                      </li>
                      ";
                    endforeach;
                    wp_reset_postdata();
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php get_footer(); ?>