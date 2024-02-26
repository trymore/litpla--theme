<?php
global $bodyClass;
$bodyClass = 'page-news-detail';
$terms = get_the_terms($post->ID, 'news_category');
get_header();
$title = urlencode(get_the_title());
$URL = get_the_permalink();
?>
<div class="main-contents">
  <article class="news-article">
    <div class="news-article-head">
      <div class="container">
        <div class="news-article-date-group">
          <time class="news-article-date"><?php the_date(); ?></time><span class="news-article-category"><?php echo $terms[0]->name; ?></span>
        </div>
        <h1 class="news-article-heading-lv1"><?php the_title(); ?></h1>
        <p class="news-article-head-name"><?php the_field('会社名'); ?></p>
      </div>
    </div>
    <div class="news-article-body">
      <div class="news-article-box">
        <div class="news-article-box-inner">
          <div class="news-article-box-body">
            <div class="section-lv2">
              <?php the_content(); ?>
            </div>
            <div class="news-article-share">
              <p class="news-article-share-text">SHARE</p>
              <ul class="social-list-primary social-row-cols-4">
                <li class="social-item"><a class="social-btn-facebook btn-outline-primary btn" href="http://www.facebook.com/sharer.php?u=<?php echo $URL; ?>" target="_blank">
                    <svg class="social-btn-facebook-icon social-btn-icon facebook-icon svg-item">
                      <title>Facebook</title>
                      <use xlink:href="#facebook-icon"></use>
                    </svg><span class="social-btn-label">facebook</span></a>
                </li>
                <li class="social-item"><a class="social-btn-twitter btn-outline-primary btn" href="http://twitter.com/share?url=<?php echo $URL; ?>&text=<?php echo $title; ?>" target="_blank">
                    <svg class="social-btn-twitter-icon social-btn-icon twitter-icon svg-item">
                      <title>Twitter</title>
                      <use xlink:href="#twitter-icon"></use>
                    </svg><span class="social-btn-label">Twitter</span></a>
                </li>
                <li class="social-item"><a class="social-btn-line btn-outline-primary btn pc" href="https://social-plugins.line.me/lineit/share?text=<?php echo $title; ?>%0A<?php echo urlencode($URL); ?>" target="_blank">
                    <svg class="social-btn-line-icon social-btn-icon line-icon svg-item">
                      <title>LINE</title>
                      <use xlink:href="#line-icon"></use>
                    </svg><span class="social-btn-label">LINE</span></a><a class="social-btn-line btn-outline-primary btn sp" href="https://timeline.line.me/social-plugin/share?url=<?php echo $title; ?>%0A<?php echo urlencode($URL); ?>" target="_blank">
                    <svg class="social-btn-line-icon social-btn-icon line-icon svg-item">
                      <title>LINE</title>
                      <use xlink:href="#line-icon"></use>
                    </svg><span class="social-btn-label">LINE</span></a>
                </li>
                <li class="social-item"><a class="social-btn-hatena btn-outline-primary btn" href="https://b.hatena.ne.jp/entry/<?php echo $URL; ?>" target="_blank">
                    <svg class="social-btn-hatena-icon social-btn-icon hatena-icon svg-item">
                      <title>hatena</title>
                      <use xlink:href="#hatena-icon"></use>
                    </svg><span class="social-btn-label">hatena</span></a>
                </li>
              </ul>
            </div>
            <div class="news-article-foot"><a class="btn-outline-primary btn" href="../"><span class="btn-outline-primary-label"><?php echo $terms[0]->name; ?>一覧へ</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</div>
<div class="breadcrumb">
  <ul class="breadcrumb-list">
    <li class="breadcrumb-item"><a href="/"><span class="breadcrumb-item-label">トップ</span>
        <svg class="breadcrumb-item-icon arrow-01-icon svg-item">
          <use xlink:href="#arrow-01-icon"></use>
        </svg></a></li>
    <li class="breadcrumb-item"><a href="/news/"><span class="breadcrumb-item-label">ニュース</span>
        <svg class="breadcrumb-item-icon arrow-01-icon svg-item">
          <use xlink:href="#arrow-01-icon"></use>
        </svg></a></li>
    <li class="breadcrumb-item"><span class="breadcrumb-item-label"><?php the_title(); ?></span></li>
  </ul>
</div>
<?php get_footer(); ?>