<?php
global $bodyClass;
$bodyClass = 'page-article page-workshop-article';
$tempPath = do_shortcode('[template]');
$sub_title = get_field('sub_title');
$URL = get_the_permalink();
get_header();
?>
        <div data-subpage-head></div>
        <div class="page-contents">
          <div class="bg-item-1"></div>
          <div class="bg-item-2"></div>
          <div class="bg-item-3"></div>
          <div class="bg-item-4"></div>
          <div class="page-contents-inner">
            <div class="article-info">
              <p class="category"><span>ワークショップ</span></p>
            </div>
            <h2 class="article-title"><?php the_title(); ?></h2>
            <p class="article-title-sub"><?php echo $sub_title; ?></p>
            <ul class="breadcrumb">
              <li><a href="/">TOPページ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><a href="/workshop/">ワークショップ</a><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
              <li><?php the_title(); ?><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></li>
            </ul>
            <div class="article-contents">
              <?php
              if(have_rows('content')):
                while (have_rows('content')) : the_row(); 
                  if(get_row_layout() == 'white_bg_image'):
                    $image = imageSubSetUrl('img', 'full');
                    $mb = get_sub_field('mb');
                    echo "<div class=\"img-bg-white $mb\"><img src=\"$image\"></div>";
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
                    $mb = get_sub_field('mb');
                    echo "<div class=\"$mb\">$editor</div>";
                  elseif(get_row_layout() == 'normal_image'):
                    $img = imageSubSetUrl('img', 'full');
                    $mb = get_sub_field('mb');
                    echo "<img class=\"$mb\" src=\"$img\">";
                  elseif(get_row_layout() == 'table_layout'):
                    $table = get_sub_field('table');
                    $mb = get_sub_field('mb');
                    if (!empty($table)):
                      echo "<table class=\"$mb\">";
                      foreach($table['body'] as $tr):
                        $count = 0;
                        echo '<tr>';
                        foreach($tr as $td):
                          $count++;
                          if ($count === 1) {
                            echo '<th style="width:5em;">';
                          } else {
                            echo '<td>';
                          }
                          echo $td['c'];
                          echo '</td>';
                        endforeach;
                        echo '</tr>';
                      endforeach;
                      echo '</table>';
                    endif;
                  endif;
                endwhile;
              endif;
              ?>
            </div>
            <div class="btn-backtoindex"><a href="/workshop/"><span class="btn-text">BACK TO INDEX</span><span class="btn-icon"><svg><use xlink:href="#icon-arrow"/></svg></span></a></div>
          </div>
        </div>
<?php get_footer(); ?>