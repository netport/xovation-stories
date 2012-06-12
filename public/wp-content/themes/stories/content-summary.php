<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage stories
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stories' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
      </a>

    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it. ?>
    <figure class="entry-thumbnail">
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stories' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_post_thumbnail('medium'); ?>
      </a>
    </figure>
    <?php endif; // has_post_thumbnail()

    $excerpt = $post->post_excerpt;
    if ( $excerpt != '' ) {
      echo '<div class="entry-content"><p>'.$excerpt.'</p></div>';
    }
    ?>

  </article><!-- #post-<?php the_ID(); ?> -->