<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage stories
 */

get_header(); ?>

    <div id="main" role="main">

      <?php
      /* Run the loop to output the posts.
       */
      if ( is_home() ) :
        get_template_part( 'loop', 'home' );
      else :
        get_template_part( 'loop', 'index' );
      endif;
      ?>

    </div><!-- #main -->

<?php get_footer(); ?>