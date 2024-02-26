<?php

/* 無効化
====================================================*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

function wpautop_filter($content) {
  global $post;
  $remove_filter = false;
  $arr_types = array('page'); //自動整形を無効にする投稿タイプを記述
  $post_type = get_post_type($post->ID);
  if (in_array($post_type, $arr_types)) $remove_filter = true;
  if ($remove_filter) {
    remove_filter('the_content', 'wpautop');
    remove_filter('the_excerpt', 'wpautop');
  }
  return $content;
}
add_filter('the_content', 'wpautop_filter', 9);

/* 謎のインラインスタイルを除去
====================================================*/
function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');
?>
