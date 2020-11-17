<?php
/**
 * Header Template file
 *
 * @package webify
 * @since 1.0
 */
?>
<header class="tb-site-header tb-style2 tb-type1 tb-sticky-header tb-solid-header tb-color1">
  <div class="tb-main-header">
    <div class="container">
      <div class="tb-main-header-in">
        <div class="tb-main-header-top">
          <div class="tb-site-branding">
            <?php webify_logo('header-logo', get_theme_file_uri('assets/img/logo-dark.png')); ?>
          </div>
        </div>

        <div class="tb-main-header-middle tb-menu-bg">
          <div class="tb-full-screen-nav-overlay"></div>
          <nav class="tb-main-nav tb-primary-nav">
            <?php webify_main_menu('tb-primary-nav-list'); ?>
          </nav>
          <?php webify_social_icons('header'); ?>
        </div>
        <div class="tb-main-header-bottom">
          <div class="tb-m-menu-btn tb-style2"><span></span></div>
        </div>
      </div>
    </div>
  </div>
</header>
