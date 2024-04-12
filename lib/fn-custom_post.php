<?php
/* カスタム投稿タイプ
====================================================*/
function create_post_type() {

  // workshop
  register_post_type(
    'workshop',
    array(
      'labels' => array(
        'name' => 'ワークショップ',
        'singular_name' => 'ワークショップ',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => true,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => false,
      'menu_position' => 4,
      'supports' => array(
        'title',
        'revisions',
        'page-attributes',
        'thumbnail'
      ),
    )
  );

  // app
  register_post_type(
    'app',
    array(
      'labels' => array(
        'name' => 'アプリ',
        'singular_name' => 'アプリ',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => true,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => true,
      'menu_position' => 4,
      'supports' => array(
        'title',
        // 'editor',
        'revisions',
        'page-attributes',
        'thumbnail'
      ),
    )
  );

  // faq
  register_post_type(
    'faq',
    array(
      'labels' => array(
        'name' => 'FAQ',
        'singular_name' => 'FAQ',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => true,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => true,
      'menu_position' => 4,
      'supports' => array(
        'title',
        'revisions',
        'page-attributes',
        'thumbnail'
      ),
    )
  );

  register_taxonomy(
    'faq_cat',
    'faq',
    array(
      'hierarchical' => true,
      'label' => 'カテゴリー',
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'faq'),
      'singular_label' => 'カテゴリー'
    )
  );

  register_taxonomy(
    'faq_park',
    'faq',
    array(
      'hierarchical' => true,
      'label' => 'パーク',
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'faq'),
      'singular_label' => 'パーク'
    )
  );

  // goods
  register_post_type(
    'goods',
    array(
      'labels' => array(
        'name' => 'グッズ',
        'singular_name' => 'グッズ',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => true,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => true,
      'menu_position' => 4,
      'supports' => array(
        'title',
        // 'editor',
        'revisions',
        'page-attributes',
        'thumbnail'
      ),
    )
  );
  
  // attraction
  register_post_type(
    'attraction',
    array(
      'labels' => array(
        'name' => 'アトラクション',
        'singular_name' => 'アトラクション',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => true,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => true,
      'menu_position' => 4,
      'supports' => array(
        'title',
        // 'editor',
        // 'revisions',
        'page-attributes',
        'thumbnail'
      ),
    )
  );

  // news
  register_post_type(
    'news',
    array(
      'labels' => array(
        'name' => 'ニュース',
        'singular_name' => 'ニュース',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'rewrite' => array(
        'with_front' => false,
      ),
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => false,
      'menu_position' => 4,
      'supports' => array(
      	'title',
      	'editor',
      	'revisions',
      	'page-attributes',
        'thumbnail'
      ),
      'taxonomies' => array('news_category', 'news_place')
    )
  );

  register_taxonomy(
    'news_category',
    'news',
    array(
      'hierarchical' => true,
      'label' => 'カテゴリー',
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array(
        'with_front' => false,
      ),
      'singular_label' => 'カテゴリー'
    )
  );

  register_taxonomy(
    'news_place',
    'news',
    array(
      'hierarchical' => true,
      'labels' => array(
        'name' => '表示設定',
        'singular_name' => '表示設定',
        'menu_name' => '表示設定',
        'add_new' => '新規追加',
        'add_new_item' => '表示設定の新規追加',
        'edit' => '編集',
        'edit_item' => '表示設定の編集',
        'new_item' => '新しい表示設定',
        'view' => '表示',
      ),
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array(
        'with_front' => false,
      ),
      'singular_label' => '表示設定'
    )
  );

  // blog
  register_post_type(
    'magazine',
    array(
      'labels' => array(
        'name' => 'ブログ',
        'singular_name' => 'ブログ',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => false,
      'menu_position' => 4,
      'supports' => array('title', 'editor', 'author', 'revisions', 'page-attributes', 'thumbnail'),
      // 'taxonomies' => array('magazine_category', 'magazine_tag'),
      'show_in_rest' => true,
    )
  );

  register_taxonomy(
    'magazine_category',
    'magazine',
    array(
      'hierarchical' => true,
      'label' => 'カテゴリー',
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'magazine'),
      'singular_label' => 'カテゴリー'
    )
  );

  register_taxonomy(
    'magazine_tag',
    'magazine',
    array(
      'hierarchical' => false,
      'label' => 'タグ',
      'rewrite' => array('slug' => 'magazine-tag'),
      'singular_label' => 'タグ',
      'public' => true,
      'show_ui' => true,
    )
  );

  // パーク検索
  register_post_type(
    'space',
    array(
      'labels' => array(
        'name' => 'パーク',
        'singular_name' => 'パーク',
        'all_items' => '記事の一覧'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'query_var' => false,
      'has_archive' => true,
      'exclude_from_search' => false,
      'menu_position' => 4,
      'supports' => array('title','author','page-attributes',),
      'taxonomies' => array('space_category'),
      'show_in_rest' => true,
    )
  );

  register_taxonomy(
    'space_category',
    'space',
    array(
      'hierarchical' => true,
      'label' => 'カテゴリー',
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'space'),
      'singular_label' => 'カテゴリー',
      'public' => true,
    )
  );

  register_taxonomy(
    'space_tag',
    'space',
    array(
      'hierarchical' => false,
      'label' => 'タグ',
      'singular_label' => 'タグ',
      'public' => true,
      'show_ui' => true,
    )
  );
  
}

add_action('init', 'create_post_type');
