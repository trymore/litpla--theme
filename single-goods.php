<?php
global $bodyClass;
$bodyClass = 'page-article page-goods-article';
$tempPath = do_shortcode('[template]');

$subTitle = get_field('sub_title');
$title = get_the_title();
$titleEncode = urlencode($title);
$URL = get_the_permalink();
get_header();
?>
        <div data-subpage-head></div>
        <div class="page-contents">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="bg-item-3" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-4" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <h2 class="article-title"><?php the_title(); ?></h2>
            <p class="article-title-sub"><?php echo $subTitle; ?></p>
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><a href="/goods/">グッズ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php the_title(); ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
            <div class="article-contents">
              <?php
              if(have_rows('content')):
                while (have_rows('content')) :
                  the_row(); 
                  if(get_row_layout() == 'white_bg_image'):
                    $image = imageSubSetUrl('image', 'full');
                    echo "<div class=\"img-bg-white mb-70\"><img src=\"$image\"></div>";
                  elseif(get_row_layout() == 'h3'):
                    $text = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "<h3 class=\"$mb\">$text</h3>";
                  elseif(get_row_layout() == 'p'):
                    $text = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "<p class=\"$mb\">$text</p>";
                  elseif(get_row_layout() == 'visual_editor'):
                    $editor = get_sub_field('editor');
                    echo $editor;
                  elseif(get_row_layout() == 'normal_image'):
                    $img = imageSubSetUrl('image', 'full');
                    $mb = get_sub_field('mb');
                    echo "<img class=\"img-small $mb\" src=\"$img\">";
                  elseif(get_row_layout() == 'bg_glay_editor'):
                    $editor = get_sub_field('editor');
                    echo "<div class=\"block-bg-gray mb-60\">$editor</div>";
                  endif;
                endwhile;
              endif;
              ?>
              <!-- common button -->
              <?php if(get_field('online')): ?>
              <div class="btn-block-online-store">
                <a href="https://litpla.base.shop/" target="_blank">
                  <div class="img">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/goods/detail/online-store-img.jpg" width="210" height="210">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/goods/detail/pc/online-store-img.jpg" width="330" height="200">
                      <img src="<?php echo $tempPath; ?>/assets/img/goods/detail/pc/online-store-img.jpg" alt="" loading="lazy" width="330" height="200">
                    </picture>
                  </div>
                  <div class="text-container">
                    <p class="text">リトプラグッズは<br>オンラインショップでも<br class="sp">販売中！</p>
                  </div>
                  <div class="btn"><span class="btn-text">Little Planet Online Store</span><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
                </a>
              </div>
              <?php endif; ?>

              <div class="btn-block-contact">
                <a href="../../contact/">
                  <div class="bg-img">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/goods/detail/contact-bg-img.jpg" width="670" height="300">
                      <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/goods/detail/pc/contact-bg-img.jpg" width="800" height="281">
                      <img src="<?php echo $tempPath; ?>/assets/img/goods/detail/pc/contact-bg-img.jpg" alt="" loading="lazy" width="800" height="281">
                    </picture>
                  </div>
                  <div class="text-container">
                    <p class="text">お問い合わせ</p>
                    <p class="text-sub">ご質問・導入のご相談などお気軽にお問い合わせください。</p>
                  </div>
                  <div class="btn"><span class="btn-text">CONTACT</span><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
                </a>
              </div>
            </div>
            <div class="btn-backtoindex"><a href="/workshop/"><span class="btn-text">BACK TO INDEX</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
<?php get_footer(); ?>