<?php
global $bodyClass;
$class = get_field('body_class');
if ($class):
  $bodyClass = $class;
else:
  $bodyClass = 'page-base';
endif;

$tempPath = do_shortcode('[template]');

get_header();
while (have_posts()) :
  the_post();
  $html = get_field('html');
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/group/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/group/pc/page-kv.jpg">
              <img src="<?php echo $tempPath; ?>/assets/img/group/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading">団体予約</span>
              <span class="text-sub" data-subpage-head-el="heading">GROUP RESERVATIONS</span>
            </h2>
            <div class="decoration-text">
              <span class="char char-1">G</span>
              <span class="char char-2">R</span>
              <span class="char char-3">O</span>
              <span class="char char-4">U</span>
              <span class="char char-5">P</span>
              <span class="char char-6 space">&nbsp;</span>
              <span class="char char-7">R</span>
              <span class="char char-8">E</span>
              <span class="char char-9">S</span>
              <span class="char char-10">E</span>
              <span class="char char-11">R</span>
              <span class="char char-12">V</span>
              <span class="char char-13">A</span>
              <span class="char char-14">T</span>
              <span class="char char-15">I</span>
              <span class="char char-16">O</span>
              <span class="char char-17">N</span>
              <span class="char char-18">S</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>団体予約<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="bg-13"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="bg-12"></div>
          <div class="bg-item-3" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-4" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <?php echo $html; ?>
          <section class="section-faq" id="faq">
            <div class="section-inner">
              <h2 class="section-heading heading-bg-blue">FAQ</h2>
              <div class="section-contents">
                <?php
                $array = array();
                $terms = get_terms('faq_cat');
                if (!empty($terms) && !is_wp_error($terms)) {
                  foreach ($terms as $term) {
                    $termName = $term->name;
                    $array += array($termName => 
                      array(
                        'count' => 0,
                        'slug' => $term->slug,
                        'articles' => array(),
                        )
                    );
                  }
                }
                $posts = get_posts(array(
                  'post_type' => 'faq',
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'orderby' => 'post__in',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'faq_park',
                      'field'    => 'slug',
                      'terms'    => '団体予約',
                    ),
                  ),
                ));
                foreach($posts as $post) {
                  $terms = get_the_terms($post->ID, 'faq_cat');
                  if ($terms){
                    foreach ($terms as $term) {
                      $termName = $term->name;
                      $array[$termName]['count'] += 1;
                      array_push($array[$termName]['articles'], $post);
                    }
                  }
                }
                ?>
                <ul class="faq-nav">
                  <?php
                  foreach($array as $key => $data) : if ($data['count']) :
                    echo "<li><a href=\"#$data[slug]\"><span class=\"btn-text\">$key</span><span class=\"icon-arrow-circle\"><span class=\"icon-arrow\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></span></a></li>";
                  endif; endforeach;
                  ?>
                </ul>
                <?php foreach($array as $key => $data) : if ($data['count']) : ?>
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
          </section>
          <div class="btn-backtotop"><a href="/"><span class="btn-text">BACK TO TOP</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
        </div>
<?php
endwhile;
get_footer();
?>
