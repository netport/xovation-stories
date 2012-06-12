<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage stories
 */

have_posts(); // empty call to have_posts required to make it return true in the next call (bug?)

if ( have_posts() ) :

  /* Start the Loop */
  while ( have_posts() ) : the_post();

    if ( is_home() ) :
      get_template_part( 'content', 'summary' );
    else :
      get_template_part( 'content', get_post_format() );
    endif;

  endwhile;

else : ?>

    <article id="post-0" class="post no-results not-found">
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Uh oh!', 'stories' ); ?></h1>
      </header><!-- .entry-header -->

      <div class="entry-content">
        <p><?php _e( 'We could not find what you were looking for. Try performing a search.', 'stories' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    </article><!-- #post-0 -->

<?php endif;