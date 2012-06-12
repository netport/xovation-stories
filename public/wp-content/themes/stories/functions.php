<?php
/**
 * SYN-ACK functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage stories
 */

/*
 * Set up post meta boxes
 */
if( @file_exists( dirname( __FILE__ ) . '/inc/post_types.php' ) )
  include_once dirname( __FILE__ ) . '/inc/post_types.php';

/*
 * Set up taxonomies
 */
if( @file_exists( dirname( __FILE__ ) . '/inc/taxonomies.php' ) )
  include_once dirname( __FILE__ ) . '/inc/taxonomies.php';

/*
 * Set up custom shortcodes
 */
if( @file_exists( dirname( __FILE__ ) . '/inc/shortcodes.php' ) )
  include_once dirname( __FILE__ ) . '/inc/shortcodes.php';


/**
 * Tell WordPress to run stories_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'stories_setup' );


if ( ! function_exists( 'stories_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function stories_setup() {

  // Add translation support
  $locale = get_locale();
  if( !empty( $locale ) ) {
    $mofile = dirname(__FILE__) . "/lang/" .  $locale . ".mo";
    if(@file_exists($mofile) && is_readable($mofile))
      load_textdomain('stories', $mofile);
  }

  // Add default posts and comments RSS feed links to <head>.
  add_theme_support( 'automatic-feed-links' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Main Menu', 'stories' ) );

  // Add support for post thumbnails
  add_theme_support('post-thumbnails');
}
endif; // stories_setup


/**
 * Run function on theme init
 */
function stories_init() {

  // Add support for excerpt to pages
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'stories_init' );


/**
 * Redirect the Loop to show stories instead of posts
 */
function stories_pre_get_posts( $query ) {
  if ( ( is_home() && $query->is_main_query() ) || is_feed() )
    $query->set( 'post_type', array( 'xovation_stories' ) );
  return $query;
}
add_filter( 'pre_get_posts', 'stories_pre_get_posts' );


/**
 * Returns a "Continue Reading" link for excerpts
 */
function stories_continue_reading_link() {
  return ' <a class="meta-nav" href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading &rsaquo;', 'stories' ) . '</a>';
}


/**
 * Adds a pretty "Continue Reading" link to post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function stories_custom_excerpt_more( $output ) {
  if ( has_excerpt() && ! is_attachment() ) {
    $output .= stories_continue_reading_link();
  }
  return $output;
}
add_filter( 'get_the_excerpt', 'stories_custom_excerpt_more' );
add_filter( 'excerpt_more', 'stories_custom_excerpt_more' );


/**
 * Display navigation to next/previous pages when applicable
 */
function stories_content_nav( $nav_id ) {
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $nav_id; ?>">
      <h1 class="assistive-text"><?php _e( 'Post navigation', 'stories' ); ?></h1>
      <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'stories' ) ); ?></div>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'stories' ) ); ?></div>
    </nav><!-- #nav-above -->
  <?php endif;
}


if ( ! function_exists( 'stories_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own stories_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function stories_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'stories' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'stories' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>">
      <aside class="comment-meta">
        <div class="comment-author vcard">
          <?php
            $avatar_size = 68;
            if ( '0' != $comment->comment_parent )
              $avatar_size = 39;

            echo get_avatar( $comment, $avatar_size );

            printf( __( '%1$s on %2$s', 'stories' ),
              sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
              sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                sprintf( __( '%1$s at %2$s', 'stories' ), get_comment_date(), get_comment_time() )
              )
            );
          ?>
        </div><!-- .comment-author .vcard -->

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'stories' ); ?></em>
          <br />
        <?php endif; ?>

      </aside>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'stories' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        <?php edit_comment_link( __( 'Edit', 'stories' ), '<span class="edit-link">', '</span>' ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->

  <?php
      break;
  endswitch;
}
endif; // ends check for stories_comment()


if ( ! function_exists( 'stories_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own stories_posted_on to override in a child theme
 */
function stories_posted_on() {
  printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'stories' ),
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    sprintf( esc_attr__( 'View all posts by %s', 'stories' ), get_the_author() ),
    esc_html( get_the_author() )
  );
}
endif;


/**
 * Adds classes to the array of body classes.
 */
function stories_body_classes( $classes ) {

  if ( is_singular() && ! is_home() )
    $classes[] = 'singular';

  return $classes;
}
add_filter( 'body_class', 'stories_body_classes' );
