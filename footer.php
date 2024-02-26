<?php
$tempPath = do_shortcode('[template]');
?>
        <div class="fixed-btn-container">
          <div class="btn-tickets sp">
            <a href="https://reserve.litpla.com/purchase/ticket" target="_blank">
              <span class="btn-bg"></span>
              <div class="btn-contents">
                <span class="btn-text-main"><svg><title>TICKET</title><use xlink:href="#text-ticket"/></svg></span>
                <span class="btn-text-sub">チケット購入<span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></span>
                <span class="character"><img src="<?php echo $tempPath; ?>/assets/img/top/hero-tickets-character.png" alt=""><span class="icon-balloon"><svg><use xlink:href="#icon-balloon"/></svg><span class="icon-search"><svg><use xlink:href="#icon-search"/></svg></span></span></span>
              </div>
            </a>
          </div>
          <div class="btn-search" data-park-list-btn>
            <a href="/space/">
              <span class="btn-bg"></span>
              <div class="btn-contents">
                <span class="btn-text-main"><svg><title>PARK LIST</title><use xlink:href="#text-parklist"/></svg></span>
                <span class="btn-text-sub">パークを探す<span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></span>
                <span class="character">
                  <picture>
                    <source media="(max-width: 767px)" srcset="<?php echo $tempPath; ?>/assets/img/top/hero-search-character.png" width="97" height="132">
                    <source media="(min-width: 768px)" srcset="<?php echo $tempPath; ?>/assets/img/top/pc/hero-search-character.png, <?php echo $tempPath; ?>/assets/img/top/pc/hero-search-character@2x.png 2x" width="108" height="147">
                    <img src="<?php echo $tempPath; ?>/assets/img/top/pc/hero-search-character.png" alt="" loading="lazy" width="108" height="147">
                  </picture>
                  <span class="icon-balloon"><svg><use xlink:href="#icon-balloon"/></svg><span class="icon-search"><svg><use xlink:href="#icon-search"/></svg></span></span>
                </span>
              </div>
            </a>
          </div>
        </div>
      </main>
      <footer class="footer">
      <div class="bg" data-animate="bg" data-animate-id="footer-bg-blue-1"></div>
        <div class="footer-inner">
          <div>
            <div class="logo">
              <a href="/">
                <svg>
                  <title>Little Planet</title>
                  <use xlink:href="#logo"/>
                </svg>
              </a>
            </div>
            <div class="followus footer-followus">
              <p class="btn-text">FOLLOW US</p>
              <ul>
                <li class="btn-instagram"><a href="https://www.instagram.com/litpla/ " target="_blank"><span class="btn-icon"><svg><use xlink:href="#icon-instagram"/></svg></span></a></li>
                <li class="btn-twitter"><a href="https://twitter.com/litpla_info " target="_blank"><span class="btn-icon"><svg><use xlink:href="#icon-twitter"/></svg></span></a></li>
              </ul>
            </div>
            <div class="btn-contact"><a href="/contact/">お問い合わせ</a></div>
            <div class="links">
              <ul>
                <li class="sp"><a href="/park-guide-en/">ENGLISH</a></li>
                <li><a href="/law/">特定商取引法に基づく表記</a></li>
                <li><a href="/terms/">アプリ利用規約</a></li>
                <li><a href="/cancelpolicy/">キャンセルポリシー</a></li>
                <li><a href="https://corp.litpla.com/" target="_blank">運営会社</a></li>
              </ul>
            </div>
            <div class="link-recruit sp"><a href="/career/">採用情報</a></div>
            <div class="copyright">&copy; Litpla Inc.</div>
          </div>
          <div class="nav">
            <ul>
              <li><a href="/about/">リトルプラネットとは</a></li>
              <li><span>ご来場ガイド</span>
                <ul>
                  <li><a href="/guide_first/">はじめての方へ</a></li>
                  <li><a href="/sharing/">魔法のリストバンド</a></li>
                  <li><a href="/workshop/">ワークショップ</a></li>
                  <li><a href="/halfyear/">半年バリューパス</a></li>
                  <li class="link-multiple"><a href="/app/">アプリ</a><span class="slash">/ </span><a href="/goods/">グッズ</a></li>
                </ul>
              </li>
              <li><a href="/attraction/">アトラクション</a></li>
              <li><span>ニュース / ブログ</span>
                <ul>
                  <li><a href="/news/">ニュース</a></li>
                  <li><a href="/magazine/">ブログ</a></li>
                </ul>
              </li>
              <li><a href="/space/">パーク検索</a></li>
              <li><a href="/career/">採用情報</a></li>
            </ul>
          </div>
          <div class="pagetop"><a href="#"><span class="pagetop-text">PAGE TOP</span><span class="icon-arrow-circle"><span class="icon-arrow"><svg><use xlink:href="#icon-arrow"/></svg></span></span></a></div>
        </div>
      </footer>
    </div>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108453924-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-108453924-1');
    </script>
    <!-- /Global site tag (gtag.js) - Google Analytics -->
    <?php wp_footer(); ?>
  </body>
</html>