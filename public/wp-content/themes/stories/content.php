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

      <?php if ( ! is_sticky() && ! is_singular() ) : // do not make the title and thumbnail a link if post is sticky or displayed singularly ?>
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stories' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
      <?php
        endif;

        the_title('<h1 class="entry-title">', '</h1>');

        $excerpt = $post->post_excerpt;
        if ( $excerpt != '' ) {
          echo '<h2 class="entry-excerpt">'.$excerpt.'</h2>';
        }


        if ( !is_sticky() || !is_singular() ) : // close title and thumbnail link ?>
      </a>
      <?php endif; ?>

    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it. ?>
    <figure class="entry-thumbnail">
      <?php
        the_post_thumbnail('large');

        // print thumbnail title and/or description, if available
        $thumbnail = get_post( get_post_thumbnail_id( $post->ID ) );
        if ( $thumbnail->post_excerpt || $thumbnail->post_content ) :
      ?>
      <figcaption class="post-thumbnail-caption">
      <?php
        if ( $thumbnail->post_excerpt )
          echo '<span class="post-thumbnail-title">'.$thumbnail->post_excerpt.'</span>';

        if ( $thumbnail->post_excerpt && $thumbnail->post_content )
          echo '<span class="sep">&rsaquo;</span>';

        if ( $thumbnail->post_content )
          echo '<span class="post-thumbnail-description">'.$thumbnail->post_content.'</span>';
      ?>
      </figcaption>
      <?php
      endif; // $thumbnail->post_excerpt || $thumbnail->post_content
      ?>
    </figure>
    <?php endif; // has_post_thumbnail() ?>

    <div class="entry-content">
      <?php
        the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'stories' ) );
      ?>
    </div><!-- .entry-content -->

    <?php if ( 'post' == get_post_type() && is_singular() ) : ?>
    <footer class="entry-footer">
      <?php
        $categories_list = get_the_category_list( '</li><li>' );
        if ( $categories_list ):
      ?>
      <ul class="inline-list cat-links">
        <h2 class="assistive-text"><?php _e('Categories', 'stories'); ?></h2>
        <li><?php echo $categories_list; ?></li>
      </ul>
      <?php endif; // End if categories ?>

      <?php
        $tags_list = get_the_tag_list( '', '</li><li>' );
        if ( $tags_list ):
      ?>
      <ul class="inline-list tag-links">
        <h2 class="assistive-text"><?php _e('Tags', 'stories'); ?></h2>
      <li><?php echo $tags_list; ?></li>
      </ul>
      <?php endif; // End if $tags_list ?>
    </footer><!-- #entry-footer -->
  <?php endif; // End if 'post' == get_post_type() && is_singular() ?>

  </article><!-- #post-<?php the_ID(); ?> -->
