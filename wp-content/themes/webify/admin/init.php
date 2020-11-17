<?php
/**
 * Init File
 *
 * @package webify
 * @since 1.0
*/
require get_theme_file_path('admin/helpers/class.themebubble.api.php');
if(is_admin() && current_user_can('switch_themes')): 
  require get_theme_file_path('admin/dashboard/admin-dashboard.php');
endif;
require get_theme_file_path('admin/hooks/fn.action.config.php');
require get_theme_file_path('admin/hooks/fn.filter.config.php');
require get_theme_file_path('admin/helpers/class-tgm-plugin-activation.php');
require get_theme_file_path('admin/helpers/fn.helpers.php');
if(class_exists('CSF')):
  require get_theme_file_path('admin/metaboxes/config.php');
  require get_theme_file_path('admin/options/config.php');
  require get_theme_file_path('admin/profile/config.php');
  require get_theme_file_path('admin/taxonomy/config.php');
endif;


