<?php
global $bodyClass;
$bodyClass = 'page-workshop';
$tempPath = do_shortcode('[template]');
get_header();
?>
        <div class="page-heading-container" data-subpage-head>
          <div class="kv">
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/workshop/page-kv.jpg">
              <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/workshop/pc/page-kv.jpg">
              <img src="<?php echo $tempPath; ?>/assets/img/workshop/pc/page-kv.jpg" alt="">
            </picture>
          </div>
          <div class="page-heading-inner">
            <h2 class="page-heading">
              <span class="text-main" data-subpage-head-el="heading">ワークショップ</span>
              <span class="text-sub" data-subpage-head-el="heading">WORKSHOP</span>
            </h2>
            <div class="decoration-text">
              <span class="char char-1">W</span>
              <span class="char char-2">O</span>
              <span class="char char-3">R</span>
              <span class="char char-4">K</span>
              <span class="char char-5">S</span>
              <span class="char char-6">H</span>
              <span class="char char-7">O</span>
              <span class="char char-8">P</span>
            </div>
            <ul class="breadcrumb" data-subpage-head-el="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li>ワークショップ<span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
          </div>
        </div>
        <div class="page-contents">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="bg-item-3" data-animate="bg" data-animate-id="footer-bg-black-1"></div>
          <div class="bg-item-4" data-animate="bg" data-animate-id="footer-bg-black-2"></div>
          <div class="page-contents-inner">
            <ul class="workshop-list">
              <?php
              if (have_posts()) : 
                while (have_posts()) : the_post();
                  $summary = get_field('summary');
                  $time = get_field('time');
                  $rec_age = get_field('rec_age');
                  $price = get_field('price');
                  $venue = get_field('venue');
                  $period = get_field('period');
                  $thumb = imageSetUrl('pc_thumb', 'full');
                  $thumbSP = imageSetUrl('sp_thumb', 'full');
                  $thumb2x = imageSetUrl('retina_thumb', 'full');
                  $border = get_field('border') ? 'border': '';
              ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <div class="thumb <?php echo $border; ?>">
                    <picture>
                      <source media="(max-width: 767px)" srcset="<?php echo $thumbSP; ?>" width="560" height="315">
                      <source media="(min-width: 768px)" srcset="<?php echo $thumb; ?>, <?php echo $thumb2x; ?> 2x" width="380" height="300">
                      <img src="<?php echo $thumb; ?>" alt="" loading="lazy" width="380" height="300">
                    </picture>
                    <?php if (get_field('new')) :?>
                    <div class="icon-new"><svg><use xlink:href="#icon-new-bg"/></svg><span class="icon-text">NEW</span></div>
                    <?php endif;?>
                  </div>
                  <div class="text-container">
                    <p class="title"><?php the_title(); ?></p>
                    <p class="text"><?php echo $summary; ?></p>
                    <dl>
                      <?php if($time) { ?>
                      <dt>時  間</dt>
                      <dd><?php echo $time; ?></dd>
                      <?php } ?>
                      <?php if($rec_age) { ?>
                      <dt>推奨年齢</dt>
                      <dd><?php echo $rec_age; ?></dd>
                      <?php } ?>
                      <?php if($price) { ?>
                      <dt>料  金</dt>
                      <dd><?php echo $price; ?></dd>
                      <?php } ?>
                      <?php if($venue) { ?>
                      <dt>開催場所</dt>
                      <dd><?php echo $venue; ?></dd>
                      <?php } ?>
                      <?php if($venue) { ?>
                      <dt>開催期間</dt>
                      <dd><?php echo $period; ?></dd>
                      <?php } ?>
                    </dl>
                  </div>
                  <div class="btn-viewmore btn-viewmore-bg-none"><span><span class="btn-text">View More</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></span></div>
                </a>
              </li>
              <?php endwhile; endif; ?>
            </ul>
            <div class="btn-backtotop"><a href="/"><span class="btn-text">BACK TO TOP</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
<?php get_footer(); ?>