<?php
// /* エディタのビジュアルモードを無効にする
// ====================================================*/
// function disable_visual_editor($wp_rich_edit) {
//   $posttype = get_post_type();
//   if ($posttype === 'page') {
//     return false;
//   } else {
//     return $wp_rich_edit;
//   }
// }
// add_filter('user_can_richedit', 'disable_visual_editor');

// function disable_visual_editor_in_page() {
// 	global $typenow;
// 	if($typenow == "page"){  //条件にしたい投稿タイプ名 post/page/カスタム投稿名
// 		add_filter("user_can_richedit", "disable_visual_editor_filter");
// 	}
// }

// function disable_visual_editor_filter(){
// 	return false;
// }

// add_action("load-post.php", "disable_visual_editor_in_page");   //編集画面で無効に
// add_action("load-post-new.php", "disable_visual_editor_in_page"); //新規投稿画面で無効に


// function my_acf_render_field( $field ) {
//   // remove_filter("user_can_richedit", "disable_visual_editor_filter");
//   echo '<p>Some extra HTML.</p>';
// }
// add_action('acf/render_field/type=wysiwyg', 'my_acf_render_field');

/* 投稿一覧にスラッグ追加 */
function add_posts_columns_slug($columns) { 
  $columns['slug'] = 'スラッグ'; 
  return $columns; 
} 
function add_posts_columns_slug_row($column_name, $post_id) { 
  if( $column_name == 'slug' ) { 
    $slug = get_post($post_id) -> post_name; 
    echo esc_attr($slug); 
  } 
} 
add_filter('manage_posts_columns', 'add_posts_columns_slug'); 
add_action('manage_posts_custom_column', 'add_posts_columns_slug_row', 10, 2);
