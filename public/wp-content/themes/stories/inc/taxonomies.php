<?php
/**
 * Register custom taxonomies
 */
function xovation_taxonomies() {
  // Activities
  $activities_labels = array(
    'name' => __( 'Activities', 'xovation' ),
    'singular_name' => __( 'Activity', 'xovation' ),
    'search_items' =>  __( 'Search Activities', 'xovation' ),
    'popular_items' => __( 'Popular Activities', 'xovation' ),
    'all_items' => __( 'All Activities', 'xovation' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Activity', 'xovation' ),
    'update_item' => __( 'Update Activity', 'xovation' ),
    'add_new_item' => __( 'Add New Activity', 'xovation' ),
    'new_item_name' => __( 'New Activity Name', 'xovation' ),
    'separate_items_with_commas' => __( 'Separate activities with commas', 'xovation' ),
    'add_or_remove_items' => __( 'Add or remove activities', 'xovation' ),
    'choose_from_most_used' => __( 'Choose from the most used activities', 'xovation' ),
    'menu_name' => __( 'Activities', 'xovation' )
  );
  register_taxonomy('xovation_activities','xovation_fragments',array(
    'hierarchical' => false,
    'labels' => $activities_labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'activities' )
  ));
  // Activities
  $fragment_tags_labels = array(
    'name' => __( 'Tags', 'xovation' ),
    'singular_name' => __( 'Tag', 'xovation' ),
    'search_items' =>  __( 'Search Tags', 'xovation' ),
    'popular_items' => __( 'Popular Tags', 'xovation' ),
    'all_items' => __( 'All Tags', 'xovation' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag', 'xovation' ),
    'update_item' => __( 'Update Tag', 'xovation' ),
    'add_new_item' => __( 'Add New Tag', 'xovation' ),
    'new_item_name' => __( 'New Tag Name', 'xovation' ),
    'separate_items_with_commas' => __( 'Separate tags with commas', 'xovation' ),
    'add_or_remove_items' => __( 'Add or remove tags', 'xovation' ),
    'choose_from_most_used' => __( 'Choose from the most used tags', 'xovation' ),
    'menu_name' => __( 'Tags', 'xovation' )
  );
  register_taxonomy('xovation_fragment_tags','xovation_fragments',array(
    'hierarchical' => false,
    'labels' => $fragment_tags_labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'fragment-tags' )
  ));
}
add_action( 'init', 'xovation_taxonomies' );
