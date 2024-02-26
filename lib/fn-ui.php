<?php

/* ページネーション
* $paged : 現在のページ
* $pages : 全ページ数
* $range : 左右に何ページ表示するか
====================================================*/
function pagination($pages, $paged, $range = 2) {
  $pages = (int) $pages;
  $paged = $paged ?: 1;
  if ($pages === 1) return;

  if (1 !== $pages) {
    echo "<div class=\"pagination\">";
    if ($paged > 1) {
      $prev = get_pagenum_link($paged - 1);
      echo "<div class=\"btn-prev\"><a href=\"$prev\"><span class=\"icon-arrow-circle\"><span class=\"icon-arrow\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></span><span class=\"btn-text\">Prev</span></a></div>";
    }

    echo "<div class=\"num-list pc\">";

    if ($paged > ($range + 1)) {
      $link = get_pagenum_link(1);
      echo "<a href=\"$link\">1</a><span class=\"dot\"></span>";
    } else {
      echo "<span class=\"is-none\"></span><span class=\"is-none\"></span>";
    }
    for ($i = 1; $i <= $pages; $i++) {
      if ($i <= $paged + $range && $i >= $paged - $range) {
        if ($paged === $i) {
          echo "<span class=\"is-selected\">$i</span>";
        } else {
          $link = get_pagenum_link($i);
          echo "<a href=\"$link\">$i</a>";
        }
      }
    }
    if ($paged < $pages - $range) {
      $link = get_pagenum_link($pages);
      echo "<span class=\"dot\"></span><a href=\"$link\">$pages</a>";
    } else {
      echo "<span class=\"is-none\"></span><span class=\"is-none\"></span>";
    }
    echo "</div>";
    echo "<div class=\"num-list sp\">$paged / $pages</div>";

    if ($paged < $pages) {
      $next = get_pagenum_link($paged + 1);
      echo "<div class=\"btn-next\"><a href=\"$next\"><span class=\"btn-text\">Next</span><span class=\"icon-arrow-circle\"><span class=\"icon-arrow\"><svg><use xlink:href=\"#icon-arrow\"/></svg></span></span></a></div>";

    }
    echo "</div>";
  }
}

function mod_get_adjacent_post($direction = 'prev', $post_types = 'post') {
  global $post, $wpdb;
  if(empty($post)) return NULL;
  if(!$post_types) return NULL;
  if(is_array($post_types)){
    $txt = '';
    for($i = 0; $i <= count($post_types) - 1; $i++){
      $txt .= "'".$post_types[$i]."'";
      if($i != count($post_types) - 1) $txt .= ', ';
    }
    $post_types = $txt;
  }
  $current_post_date = $post->post_date;
  $join = '';
  $in_same_cat = FALSE;
  $excluded_categories = '';
  $adjacent = $direction == 'prev' ? 'previous' : 'next';
  $op = $direction == 'prev' ? '<' : '>';
  $order = $direction == 'prev' ? 'DESC' : 'ASC';
  $join  = apply_filters("get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories);
  $where = apply_filters("get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type IN({$post_types}) AND p.post_status = 'publish'", $current_post_date), $in_same_cat, $excluded_categories);
  $sort  = apply_filters("get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1");
  $query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
  $query_key = 'adjacent_post_' . md5($query);
  $result = wp_cache_get($query_key, 'counts');
  if (false !== $result)
    return $result;
  $result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
  if (null === $result)
    $result = '';
  wp_cache_set($query_key, $result, 'counts');
  return $result;
}

?>
