<?php
/**
 * Admin Action Hooks.
 *
 * @package webify
 * @since 1.0
*/
if(!function_exists('webify_admin_enqueue_scripts')) {
  function webify_admin_enqueue_scripts() {
    wp_enqueue_style('admin-custom',  get_theme_file_uri('admin/assets/css/admin.css'), '1.0');
  }
  add_action( 'admin_enqueue_scripts', 'webify_admin_enqueue_scripts' );
}
