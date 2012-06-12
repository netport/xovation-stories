<?php
/**
 * Register custom shortcodes
 * [shortcode post_id]
 */
function xovation_shortcodes( $atts ) {

  // get the post
  $p = get_post( $atts[0] );

  // format return content based on content type
  if ( get_post_type( $p ) == 'xovation_fragments' ) {
    $c = '<section class="fragment"><header class="fragment-header"><h1 class="fragment-title"><a class="fragment-anchor" href="'. get_permalink( $p->ID ) .'">'.$p->post_title.'</a></h1></header>'. wpautop($p->post_content) .'</section>';
  }
  else {
    $c = '<div class="fragment missing">'. __('Content is missing', 'xovation') .'</div>';
  }

  // return formatted content
  return $c;
}
add_shortcode( 'fragment', 'xovation_shortcodes' );
