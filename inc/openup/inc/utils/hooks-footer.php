<?php

/**
 * Apply Global / Page Tracking Scripts to Footer
 */
add_action('wp_footer', function () {
  $global_tracking_footer = (class_exists('ACF'))  ? get_field('global_tracking_footer', 'options') : null;

  if ($global_tracking_footer) echo $global_tracking_footer;
  
});
