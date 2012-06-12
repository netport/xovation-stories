<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to stories_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage stories
 */
?>

<?php
  // If comments and pings are closed, then let's bail early.
  if ( ! comments_open() && ! pings_open() )
    return;
?>

  <div id="comments">

  <?php // Is the post password protected? ?>
  <?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'stories' ); ?></p>
  </div><!-- #comments -->
  <?php
      /* Stop the rest of comments.php from being processed,
       * but don't kill the script entirely -- we still have
       * to fully load the template.
       */
      return;
    endif;
  ?>

  <?php // Do we have comments? ?>
  <?php if ( have_comments() ) : ?>

    <?php // Check for comment navigation ?>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="comment-nav comment-nav-above">
      <h1 class="assistive-text"><?php _e( 'Browse comments', 'stories' ); ?></h1>
      <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'stories' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'stories' ) ); ?></div>
    </nav>
    <?php endif; ?>

    <h3 class="comments-title"><?php _e( 'Reactions', 'stories' ); ?></h3>

    <ol class="commentlist">
      <?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use stories_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define stories_comment() and that will be used instead.
         * See stories_comment() in functions.php for more.
         */
        wp_list_comments( array( 'callback' => 'stories_comment' ) );
      ?>
    </ol>

    <?php // Check for comment navigation ?>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="comment-nav comment-nav-below">
      <h1 class="assistive-text"><?php _e( 'Browse comments', 'stories' ); ?></h1>
      <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'stories' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'stories' ) ); ?></div>
    </nav>
    <?php endif; ?>

  <?php endif; // end if ( have_comments() ) ?>

  <?php comment_form(); ?>

</div><!-- #comments -->
