<?php
/**
 * Init File
 *
 * @package webify
 * @since 1.0
*/
require get_theme_file_path('theme/hooks/fn.action.config.php');
require get_theme_file_path('theme/hooks/fn.filter.config.php');
require get_theme_file_path('theme/helpers/class.menu.walker.php');
require get_theme_file_path('theme/helpers/fn.frontend.php');
require get_theme_file_path('theme/helpers/fn.helpers.php');
if(class_exists('WooCommerce')):
  require get_theme_file_path('theme/helpers/fn.woocommerce.php');
endif;
