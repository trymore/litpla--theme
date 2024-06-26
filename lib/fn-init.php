<?php

/* ショートコード
====================================================*/
// template directory path [template]
function shortcode_tp() {
  $url = get_template_directory_uri();
  return str_replace(site_url(), '', $url);
}
add_shortcode('template', 'shortcode_tp');


/* Archives title
====================================================*/
add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = '「' . single_cat_title('', false) . '」タグのついた記事一覧';
  }
  return $title;
});


/* 件数を指定する
====================================================*/
function change_posts_per_page($query) {
  if (is_admin() || ! $query->is_main_query()) return;

  if (is_post_type_archive('goods') || is_post_type_archive('attraction')) {
    $query->set('posts_per_page', -1);
  } else {
    $query->set('posts_per_page', '10');
  }
}
add_action('pre_get_posts', 'change_posts_per_page');

/* 全体共通設定
====================================================*/
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {
  // Check function exists.
  if( function_exists('acf_add_options_page') ) {
    // Register options page.
    $option_page = acf_add_options_page(array(
      'page_title' => 'オプション設定',
      'menu_title' => 'オプション設定',
      'menu_slug'  => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false
    ));
  }
}

/* 検索から固定ページを除外
====================================================*/
function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
  return $query;
}
add_filter('pre_get_posts', 'SearchFilter');

/* サムネイル
====================================================*/
add_theme_support('post-thumbnails');

/* 画像サイズ
====================================================*/
// add_image_size('workshopThumb', 380, 300, true);
// add_image_size('workshopThumbSP', 760, 600, true);
// add_image_size('workshopThumb2x', 760, 600, true);

//プラグインIDを指定し解除する
function dequeue_plugins_style() {
  wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'dequeue_plugins_style', 9999);

/* カスタムパーマリンクでクエリを動作させる
====================================================*/
add_filter('custom_permalinks_like_query', '__return_true');


/*【管理画面】投稿メニューを非表示 */
function remove_menus () {
  global $menu;
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
  $menu[19] = $menu[10];  //メディアの移動
  unset($menu[10]);
}
add_action('admin_menu', 'remove_menus');

/*【管理画面】メディアを追加で挿入されるimgタグから不要な属性を削除 */
add_filter('image_send_to_editor', 'remove_image_attribute', 10);
add_filter('post_thumbnail_html', 'remove_image_attribute', 10);
function remove_image_attribute($html){
  $html = preg_replace('/(width)="\d*"\s/', 'width="" ', $html);
  $html = preg_replace('/(height)="\d*"\s/', 'height="" ', $html);
  $html = preg_replace('/title=[\'"]([^\'"]+)[\'"]/i', '', $html);
  return $html;
}

// Pタグ自動挿入解除
// add_action('init', function() {
//   remove_filter('the_content', 'wpautop');
// });


/* カスタム分類アーカイブ用のリライトルールを追加
====================================================*/
add_filter('rewrite_rules_array', 'wp_insertMyRewriteRules');
add_filter('query_vars', 'wp_insertMyRewriteQueryVars');
add_filter('init', 'flushRules');

function wp_insertMyRewriteRules($rules) {
  $newrules = array();
  $newrules['news/page/([0-9]+)/?$'] = 'index.php?post_type=news&paged=$matches[1]';
  $newrules['news/([^/]+)/?$'] = 'index.php?news_category=$matches[1]';
  $newrules['news/([^/]+)/page/([0-9]+)/?$'] = 'index.php?news_category=$matches[1]&paged=$matches[2]';
  $newrules['news/space/([^/]+)/?$'] = 'index.php?news_place=$matches[1]';
  $newrules['news/space/([^/]+)/page/([0-9]+)/?$'] = 'index.php?news_place=$matches[1]&paged=$matches[2]';
  $newrules['news/space/([^/]+)/([^/]+)/?$'] = 'index.php?news_place=$matches[1]&news_category=$matches[2]';
  $newrules['news/space/([^/]+)/([^/]+)/page/([0-9]+)/?$'] = 'index.php?news_place=$matches[1]&news_category=$matches[2]&paged=$matches[3]';
  return $newrules + $rules;
}

function wp_insertMyRewriteQueryVars($vars) {
  array_push($vars, 'id');
  return $vars;
}

function flushRules() {
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}

function mappendUrls($urls) {
  $states = [
    'press',
    'publicity',
  ];

  foreach ($states as $slag) {
    $statesPosts = get_posts(array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'news_category',
          'field' => 'slug',
          'terms' => $slag,
        ),
      ),
    ));
    $urls[] = home_url("/news/{$slag}/");
    $statesMaxPages = ceil(count($statesPosts) / 10);
    for ($i = 1; $i <= $statesMaxPages; $i++) {
      $urls[] = home_url("/news/{$slag}/page/{$i}/");
    }
  }

  $spacePosts = get_posts(array(
    'post_type' => 'space',
    'posts_per_page' => -1, 
  ));

  foreach ($spacePosts as $post) {
    $importNews = get_field('import_news', $post);
    $spaceNewsPosts = get_posts(array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'news_place',
          'field' => 'term_taxonomy_id',
          'terms' => $importNews,
        ),
      ),
    ));
    $urls[] = home_url("/news/space/{$post->post_name}/");
    $spaceNewsMaxPages = ceil(count($spaceNewsPosts) / 10);
    for ($i = 1; $i <= $spaceNewsMaxPages; $i++) {
      $urls[] = home_url("/news/space/{$post->post_name}/page/{$i}/");
    }
    foreach ($states as $slag) {
      $count = 0;
      foreach ($spaceNewsPosts as $newsPost) {
        if (has_term($slag, 'news_category', $newsPost)) {
          $count++;
        }
      }
      $count = ceil($count / 10);
      $urls[] = home_url("/news/space/{$post->post_name}/{$slag}/");
      for ($i = 1; $i <= $count; $i++) {
        $urls[] = home_url("/news/space/{$post->post_name}/{$slag}/page/{$i}/");
      }
    }
  }
  return $urls;
}
add_action('init', function(){
  add_filter('ShifterURLS::AppendURLtoAll', 'mappendUrls');
});


/* スラッグを基本的にIDにする
====================================================*/
function slug_auto_setting( $slug, $post_ID, $post_status, $post_type ) {
  $post = get_post($post_ID);
  if ($post_type == 'news' && $post->post_date_gmt == '0000-00-00 00:00:00') {
    $slug = $post_ID;
    return $slug;
  }
  return $slug;
}
add_filter( 'wp_unique_post_slug', 'slug_auto_setting', 10, 4 );