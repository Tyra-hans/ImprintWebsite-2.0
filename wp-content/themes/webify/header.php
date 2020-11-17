<?php
/**
 * Header Template
 *
 * @package webify
 * @since 1.0
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    
  <?php webify_loader('loader-logo', get_theme_file_uri('assets/img/logo-dark.png')); ?>
  <?php webify_header_style(webify_get_opt('header-style')); ?>
  <?php webify_page_header_style('default'); ?>


