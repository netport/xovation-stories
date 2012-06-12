<?php
/**
 * The Main widget areas.
 *
 * @package WordPress
 * @subpackage stories
 */
?>

<div id="sidebar-main" class="sidebar" role="complementary">
  <div class="widget-area">
    <?php
    if ( is_singular() ):
      $images_field = get_post_custom_values('images');
      $images = explode(',', $images_field[0]);

      if (count($images) > 0):
    ?>
    <aside class="widget">
    <h2 class="widget-title"><?php _e( 'Download images', 'stories' ); ?></h2>
    <ul class="widget-content inline-list">
      <li>
      <?php
        foreach ($images as $key => $image):
          echo $image.' &middot; ';
          //echo '<li>'.$image.'</li>';
        endforeach;
      ?>
      </li>
    </ul>
    </aside>
    <?php endif; // count($images) > 0 ?>
    <aside class="widget">
      <h2 class="widget-title"><?php _e( 'Related products', 'stories' ); ?></h2>
      <ul class="taxonomy-list taxonomy-theme">
        <?php wp_list_categories(array('taxonomy'=>'product', 'title_li'=>'')); ?>
      </ul>
    </aside>
    <?php endif; // is_singular() ?>

    <aside class="widget" style="height:240px;background-color:#eee">
    </aside>

    <aside class="widget meta">
      <h2 class="widget-title"><?php _e( 'Meta', 'stories' ); ?></h2>
      <ul class="widget-content">
        <li><?php wp_loginout(); ?></li>
        <?php wp_meta(); ?>
      </ul>
    </aside>
  </div>
</div><!-- #sidebar-main -->