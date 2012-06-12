<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage stories
 */
?>
  <form method="get" id="searchform" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s"><?php _e( 'Search the site', 'stories' ); ?></label>
    <input type="search" class="field search" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter a search term', 'stories' ); ?>">
    <input type="submit" class="submit search" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'stories' ); ?>">
  </form>
