<?php

function manage_pages_columns($columns) {
  $columns['permalink'] = "パーマリンク";
  return $columns;
}
function add_pages_column($column_name, $post_id) {
  if ('permalink' == $column_name) {
    // $plink = get_permalink($post_id);
    $plink = str_replace(home_url(), "", get_permalink($post_id));
  }
  if (isset($plink) && $plink) {
    echo $plink;
  } else {
    echo __('None');
  }
}
add_filter('manage_pages_columns', 'manage_pages_columns');
add_action('manage_pages_custom_column', 'add_pages_column', 10, 2);

/* 記事のナンバリング
====================================================*/
function get_post_number($post_type = 'post', $op = '<=') {
  global $wpdb, $post;
  $post_type = is_array($post_type) ? implode("','", $post_type) : $post_type;
  $number = $wpdb->get_var("
    SELECT COUNT( * )
    FROM $wpdb->posts
    WHERE post_date {$op} '{$post->post_date}'
    AND post_status = 'publish'
    AND post_type = ('{$post_type}')
  ");
  return $number;
}

function get_post_cat_number($cat_slug, $post_type = 'post') {
  global $wpdb, $post;
  $number = $wpdb->get_var("
    SELECT COUNT(posts.ID)
    FROM $wpdb->posts posts
    INNER JOIN $wpdb->term_relationships rels ON posts.ID = rels.object_id
    INNER JOIN $wpdb->term_taxonomy tax ON rels.term_taxonomy_id = tax.term_taxonomy_id
    INNER JOIN $wpdb->terms terms ON tax.term_id = terms.term_ID
    WHERE terms.slug = '{$cat_slug}'
    AND posts.post_date <= '{$post->post_date}'
    AND posts.post_status = 'publish'
    AND posts.post_type = '{$post_type}'
  ;");
  return sprintf('%02d', $number);
}

/* カスタムフィールド画像パス出力
====================================================*/
function imageSetUrl($field, $size, $post = null) {
  $img = ($post) ? get_field($field, $post) : get_field($field);
  if(!$img) {
    return '';
  }
  $url = wp_get_attachment_image_src($img, $size);
  return $url[0];
}

function imageSubSetUrl($field, $size, $post = null) {
  $img = ($post) ? get_sub_field($field, $post) : get_sub_field($field);
  $url = wp_get_attachment_image_src($img, $size);
  return $url[0];
}

function imageIdUrl($img, $size) {
  $url = wp_get_attachment_image_src($img, $size);
  return $url[0];
}

function the_thumbnail($size, $post_id = null, $class = '', $field_name = '') {
  $image = get_thumbnail_obj($post_id, $size, $field_name);
  $url = $image[0];
  $width = $image[1];
  $height = $image[2];
  echo "<img class='$class' src='$url' width='$width' height='$height' />";
}

/* エディタのスタイル定義
====================================================*/
function my_mce_formats($initArray) {  
	// スタイル設定の定義
	$style_formats = array(
		array(  
			'title' => '太字',
			'inline' => 'span',  
			'classes' => 'bold',
			
		),  
		// array(  
		// 	'title' => 'アンダーマーカー',
		// 	'inline' => 'span',  
		// 	'classes' => '_my_under_marker',
		// ),
	);  
	$initArray['style_formats'] = json_encode($style_formats);  
	return $initArray;  
} 

add_filter('tiny_mce_before_init', 'my_mce_formats', 10000);