<?php
/**
 * Register custom post types
 */
function xovation_post_types() {

  // Fragments
  $fragments_labels = array(
    'name' => __('Fragments', 'xovation'),
    'singular_name' => __('Fragment', 'xovation'),
    'add_new' => __('Add', 'xovation'),
    'add_new_item' => __('Add fragment', 'xovation'),
    'edit_item' => __('Edit fragment', 'xovation'),
    'new_item' => __('New fragment', 'xovation'),
    'all_items' => __('All fragments', 'xovation'),
    'view_item' => __('View fragment', 'xovation'),
    'search_items' => __('Search fragments', 'xovation'),
    'not_found' =>  __('No fragments found', 'xovation'),
    'not_found_in_trash' => __('No fragments found in Trash', 'xovation'),
    'parent_item_colon' => '',
    'menu_name' => __('Fragments', 'xovation'),
  );
  $fragments_args = array(
    'label' => __('Fragments', 'xovation'),
    'labels' => $fragments_labels,
    'description' => __('Content fragments are a building block of stories', 'xovation'),
    'public' => true,
    'menu_position' => 25,
    'menu_icon' => null,
    'hierarchical' => false,
    'supports' => array('title', 'editor', 'author', 'comments', 'revisions', 'tags'),
    'register_meta_box_cb' => 'xovation_fragments_meta',
    'has_archive' => true,
    'rewrite' => array('slug' => 'fragments'),
    'query_var' => true,
    'can_export' => true,
    'show_in_nav_menus' => false
  );
  register_post_type('xovation_fragments', $fragments_args);

  // Stories
  $stories_labels = array(
    'name' => __('Stories', 'xovation'),
    'singular_name' => __('Story', 'xovation'),
    'add_new' => __('Write', 'xovation'),
    'add_new_item' => __('Write story', 'xovation'),
    'edit_item' => __('Edit story', 'xovation'),
    'new_item' => __('New story', 'xovation'),
    'all_items' => __('All stories', 'xovation'),
    'view_item' => __('View stories', 'xovation'),
    'search_items' => __('Search stories', 'xovation'),
    'not_found' =>  __('No stories found', 'xovation'),
    'not_found_in_trash' => __('No stories found in Trash', 'xovation'),
    'parent_item_colon' => '',
    'menu_name' => __('Stories', 'xovation'),
  );
  $stories_args = array(
    'label' => __('Stories', 'xovation'),
    'labels' => $stories_labels,
    'description' => __('Stories are made from fragments of content', 'xovation'),
    'public' => true,
    'menu_position' => 25,
    'menu_icon' => null,
    'hierarchical' => false,
    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
    'register_meta_box_cb' => 'xovation_stories_meta',
    'has_archive' => true,
    'rewrite' => array('slug' => 'stories'),
    'query_var' => true,
    'can_export' => true,
    'show_in_nav_menus' => false
  );
  register_post_type('xovation_stories', $stories_args);
}
add_action('init', 'xovation_post_types');

/**
 * Add meta boxes to fragments
 */
function xovation_fragments_meta() {
  add_meta_box('fragment_meta', __('Properties', 'xovation'), 'xovation_fragments_meta_callback', 'xovation_fragments', 'side', 'default');
}
function xovation_fragments_meta_callback($post) {
  // Use nonce for verification
  wp_nonce_field('fragment_nonce', 'fragment_nonce');

  // The actual fields for data entry
  echo '<fieldset class="text">';
  echo '<label for="fragment_quote_source">'. _e("Quote source", 'xovation' ) .'</label> ';
  echo '<input class="widefat" type="text" id="fragment_quote_source" name="fragment_quote_source" placeholder="'. __('Firstname Lastname', 'xovation') .'">';
  echo '</fieldset>';
}
function xovation_fragments_meta_save_postdata( $post_id ) {
  // verify if this is an auto save routine.
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return;

  // verify nonce
  if (!wp_verify_nonce($_POST['fragment_nonce'], 'fragment_nonce'))
    return;

  // Check permissions
  if ('xovation_fragments'==$_POST['post_type'] && !current_user_can('edit_post', $post_id))
    return;

  // Save data
  $fragment_quote_source = $_POST['fragment_quote_source'];
}
add_action('save_post', 'xovation_fragments_meta_save_postdata');

/**
 * Add meta boxes to stories
 */
function xovation_stories_meta() {
//  add_meta_box('story_meta', __('Story properties', 'xovation'), 'xovation_stories_meta_callback', 'xovation_stories', 'side', 'default');
}
function xovation_stories_meta_callback($post) {
  // TODO
}

/**
 * Handle messages for custom post types
 */
function xovation_meta_messages( $messages ) {
  // Stories
  $messages['xovation_fragments'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Fragment updated. <a href="%s">View fragment</a>', 'xovation'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'xovation'),
    3 => __('Custom field deleted.', 'xovation'),
    4 => __('Fragment updated.', 'xovation'),
    // translators: %s: date and time of the revision
    5 => isset($_GET['revision']) ? sprintf( __('Fragment restored to revision from %s', 'xovation'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Fragment published. <a href="%s">View fragment</a>', 'xovation'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Fragment saved.', 'xovation'),
    8 => sprintf( __('Fragment submitted. <a target="_blank" href="%s">Preview fragment</a>', 'xovation'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Fragment scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview story</a>', 'xovation'),
    // translators: Publish box date format, see http://php.net/date
    date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Fragment draft updated. <a target="_blank" href="%s">Preview fragment</a>', 'xovation'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  // Stories
  $messages['xovation_stories'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Story updated. <a href="%s">View story</a>', 'xovation'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'xovation'),
    3 => __('Custom field deleted.', 'xovation'),
    4 => __('Story updated.', 'xovation'),
    // translators: %s: date and time of the revision
    5 => isset($_GET['revision']) ? sprintf( __('Story restored to revision from %s', 'xovation'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Story published. <a href="%s">View story</a>', 'xovation'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Story saved.', 'xovation'),
    8 => sprintf( __('Story submitted. <a target="_blank" href="%s">Preview story</a>', 'xovation'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Story scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview story</a>', 'xovation'),
    // translators: Publish box date format, see http://php.net/date
    date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Story draft updated. <a target="_blank" href="%s">Preview story</a>', 'xovation'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter('post_updated_messages', 'xovation_meta_messages');
