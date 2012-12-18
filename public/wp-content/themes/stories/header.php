<!doctype html>
<!--[if IEMobile 7 ]><html <?php language_attributes(); ?> class="no-js iem7"> <![endif]-->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 8)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">
<meta name="application-name" content="<?php bloginfo('name'); ?>">

<title><?php
  // Print the <title> tag based on what is being viewed.
  global $page, $paged;
  $separator_char = '&lsaquo;';

  wp_title( $separator_char, true, 'right' );

  bloginfo( 'name' );

  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    echo " ".$separator_char." $site_description";

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' '.$separator_char.' '.sprintf( __( 'Page %s', 'stories' ), max( $paged, $page ) );

  ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
  // Modernizr enables HTML5 elements and detects features
  wp_enqueue_script( 'modernizr', get_bloginfo('template_directory').'/js/vendor/modernizr.js', false, '2.5.2', false );

  // Scripts are placed after the content to speed up page loading
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'isotope', get_bloginfo('template_directory').'/js/vendor/jquery.isotope.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'application', get_bloginfo('template_directory').'/js/application.js', array('modernizr','jquery'), false, true );

  /* Always have wp_head() just before the closing </head>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to add elements to <head> such
   * as styles, scripts, and meta tags.
   */
  wp_head();
?></head>

<body <?php body_class(); ?>>
<div id="container">

  <header id="header" role="banner">
    <h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <nav id="nav-primary" role="navigation">
      <h1 class="assistive-text"><?php _e( 'Main menu', 'stories' ); ?></h1>
      <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
      <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'stories' ); ?>"><?php _e( 'Skip to primary content', 'stories' ); ?></a></div>
      <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '1' ) ); ?>
    </nav><!-- #nav-primary -->
    <img src="http://www.x-ovation.se/wp-content/uploads/2012/03/EU_vanster_RGB.jpg" style="box-sizing:border-box;display:block;width:100%;max-width:240px;height:auto;margin-top:4em;border:1px solid #ddd;background:#fff;padding:.5em;">
  </header><!-- #header -->
