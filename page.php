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
while (have_posts()):
  the_post();
  $title = get_the_title();
  $html = get_field('html');
  if ($html):
    echo $html;
  else:
    $subTitle = get_field('sub_title');
    $enTitle = get_field('en_title');
    $kv = get_field('keyvisual');
    $Kvflag = $kv['pc_img'] && $kv['sp_img'];
    $kvPc = imageIdUrl($kv['pc_img'], 'full');
    $kvSp = imageIdUrl($kv['sp_img'], 'full');
?>
        <div class="<?php echo ($Kvflag) ? 'page-heading-container': 'page-heading-container no-kv';  ?>" data-subpage-head>
          <?php if ($Kvflag) : ?>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $kvSp; ?>">
              <source media="(min-width: 768px)" srcset="<?php echo $kvPc; ?>">
              <img src="<?php echo $kvPc; ?>" alt="">
            </picture>
          </div>
          <?php else: ?>
          <div class="bg-item-1"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="bg-11"></div>
          <?php endif; ?>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading"><?php echo $title; ?></span>
              <span class="text-sub" data-subpage-head-el="heading"><?php echo $subTitle; ?></span>
              <span class="text-en" data-subpage-head-el="heading"><?php echo $enTitle; ?></span>
            </h2>
            <div class="decoration-text"><?php echo $enTitle; ?></div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php echo $title; ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-2" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <div class="page-base-contents">
              <?php
              if(have_rows('content')):
                while (have_rows('content')) :
                  the_row(); 
                  if(get_row_layout() == 'h1'):
                    $text = get_sub_field('text');
                    echo "<div class=\"main-text mb-35 pt-145\">$text</div>";
                  elseif(get_row_layout() == 'h2'):
                    $text = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "<h2 class=\"heading-bg-blue $mb\">$text</h2>";
                  elseif(get_row_layout() == 'h3'):
                    $text = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "<h3 class=\"heading-blue-line $mb\">$text</h3>";
                  elseif(get_row_layout() == 'p'):
                    $text = get_sub_field('text');
                    $horizontal = get_sub_field('horizontal');
                    $mb = get_sub_field('mb');
                    echo "<p class=\"$mb $horizontal\">$text</p>";
                  elseif(get_row_layout() == 'visual_editor'):
                    $editor = get_sub_field('editor');
                    echo $editor;
                  elseif(get_row_layout() == 'movie'):
                    $youtubeID = get_sub_field('youtube_id');
                    $img = imageSubSetUrl('thumb', 'full');
                    $mb = get_sub_field('mb');
                    echo "
                    <div class=\"movie-block $mb\" data-youtube>
                      <div class=\"movie\" data-youtube-el=\"player\" data-youtube-id=\"$youtubeID\"></div>";
                    if ($img) {
                      echo "<div class=\"thumb\" data-youtube-el=\"thumb\"><img src=\"$img\"><span class=\"icon-play\"></span></div>";
                    }
                    echo "</div>";
                 elseif(get_row_layout() == 'layout_1'):
                    $img = imageSubSetUrl('image', 'full');
                    $caption = get_sub_field('caption');
                    $mb = get_sub_field('mb');
                    echo "
                    <div class=\"img $mb\">
                      <img class=\"mb-20\" src=\"$img\">
                      <p>$caption</p>
                    </div>";
                  elseif(get_row_layout() == 'layout_2'):
                    $img = imageSubSetUrl('image', 'full');
                    $text = get_sub_field('text');
                    $mb = get_sub_field('mb');
                    echo "
                    <div class=\"block-side $mb\">
                      <div class=\"block-img\"><img src=\"$img\"></div>
                      <div class=\"block-text\">
                        <p>$text</p>
                      </div>
                    </div>";
                  elseif(get_row_layout() == 'arrow_link'):
                    $text = get_sub_field('text');
                    $link = get_sub_field('link');
                    $mb = get_sub_field('mb');
                    echo "<div class=\"btn-arrow $mb\"><a href=\"$link\">$text<svg><use xlink:href=\"#icon-arrow\"/></svg></a></div>";
                  elseif(get_row_layout() == 'btn_black'):
                    $text = get_sub_field('text');
                    $link = get_sub_field('link');
                    $mb = get_sub_field('mb');
                    echo "<div class=\"btn-black $mb\"><a href=\"$link\">$text<svg><use xlink:href=\"#icon-arrow\"/></svg></a></div>";
                  endif;
                endwhile;
              endif;
              ?>
            </div>
          </div>
        </div>
<?php
  endif;
endwhile;
get_footer();
?>
