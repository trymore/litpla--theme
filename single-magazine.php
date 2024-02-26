<?php
global $bodyClass;
$bodyClass = 'page-article page-blog-article';
$tempPath = do_shortcode('[template]');

$title = get_the_title();
$titleEncode = urlencode($title);
$URL = get_the_permalink();
get_header();
$relatedPosts = get_field('relation');
?>
        <div data-subpage-head></div>
        <div class="page-contents">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4"></div>
          <div class="page-contents-inner">
            <div class="article-info">
              <p class="category"><span>アトラクション</span></p>
              <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
            </div>
            <h2 class="article-title"><?php echo $title; ?></h2>
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><a href="/magazine/">ブログ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php echo $title; ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
            <div class="blog-contents-wrapper">
              <div class="blog-main-contents">
                <div class="article-contents">
                  <?php the_content(); ?>
                </div>
                <?php
                $post_id = get_the_ID();
                $terms = get_the_terms($post_id, 'magazine_tag');
                if ($terms && !is_wp_error($terms)) :
                ?>
                <div class="article-tags">
                  <ul>
                    <?php
                    foreach ($terms as $term) :
                      echo '<li><a href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a></li>';
                    endforeach;
                    ?>
                  </ul>
                </div>
                <?php endif; ?>
                <div class="share-links">
                  <p class="share-links-heading">SHARE<span>:</span></p>
                  <ul>
                    <li class="btn-tw"><a href="https://twitter.com/intent/tweet?text=<?php echo $URL; ?>" target="_blank"><span class="icon-twitter"><svg><use xlink:href="#icon-twitter"/></svg></span></a></li>
                    <li class="btn-facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $URL; ?>" target="_blank"><span class="icon-facebook"><svg><use xlink:href="#icon-facebook"/></svg></span></a></li>
                    <li class="btn-copy"><button data-url-copy><span class="icon-copy"><svg><use xlink:href="#icon-copy"/></svg></span><span class="btn-text">URLをコピー</span></button></li>
                  </ul>
                </div>
                <?php if ($relatedPosts) : ?>
                <div class="blog-related">
                  <h3 class="blog-related-heading">関連記事</h3>
                  <ul class="blog-list">
                    <?php
                    foreach ($relatedPosts as $post):
                      setup_postdata($post);
                      $thumb = imageSetUrl('thumb', 'full');
                      if (!$thumb) {
                        $thumb = get_the_post_thumbnail_url();
                      }
                      $relatedTerms = get_the_terms($post->ID, 'magazine_category');
                      $relatedTermName = $relatedTerms[0]->name;
                    ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <div class="thumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                        <div class="text-container">
                          <div class="info">
                            <p class="category"><span><?php echo $relatedTermName; ?></span></p>
                            <p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
                          </div>
                          <p class="title"><?php the_title(); ?><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></p>
                        </div>
                      </a>
                    </li>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
                  </ul>
                </div>
                <?php endif; ?>
              </div>
              <div class="blog-side-contents">
                <div class="blog-category">
                  <ul class="category-list">
                    <li><a href="/magazine/"><span class="btn-text">すべて</span><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></a></li>
                    <?php
                    $terms = get_terms(array(
                      'taxonomy' => 'magazine_category',
                      'hide_empty' => false,
                    ));
                    if (!empty($terms)) {
                      foreach ($terms as $term) {
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
                          if ( $tags["$tag_name"] ) {
                            $tags["$tag_name"] += $view_count ; 
                          } else {
                            $tags += array( $tag_name => $view_count);
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
            <div class="btn-backtoindex"><a href="/magazine/"><span class="btn-text">BACK TO INDEX</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>

<?php get_footer(); ?>