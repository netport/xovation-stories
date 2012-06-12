<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage stories
 */

the_post();

get_header(); ?>

    <div id="main" role="main">

        <?php
        /* Run the loop to output the page.
         * If you want to overload this in a child theme then include files
         * called loop-home.php and and loop-page.php and they will be used instead.
         */
        if ( is_front_page() ) {
          get_template_part( 'loop', 'home' );
        }
        else {
          get_template_part( 'loop', 'page' );

          comments_template( '', true );
        }
        ?>

    </div><!-- #main -->

<?php get_footer(); ?>