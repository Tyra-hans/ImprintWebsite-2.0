<?php
/**
 * Header Template file
 *
 * @package webify
 * @since 1.0
 */
?>
<header class="tb-site-header tb-full-width tb-style3 tb-sticky-header tb-solid-header tb-color1 tb-header-border1">
  <?php if(webify_get_opt('top-header-enable')): ?>
  <div class="tb-promotion-bar tb-style1 tb-flex tb-ping-gray-bg">
    <div class="container">
      <div class="text-center tb-f13-lg tb-line1-3"><?php echo wp_kses_post(webify_get_opt('top-header-msg')); ?></div>
      <i class="tb-promotion-cross fa fa-times"></i>
    </div>
  </div>
  <?php endif; ?>
  <div class="tb-main-header">
    <div class="container">
      <div class="tb-main-header-in">
        <div class="tb-main-header-left">
          <div class="tb-site-branding">
            <?php webify_logo('header-logo', get_theme_file_uri('assets/img/logo-dark.png')); ?>
          </div>
        </div>
        <div class="tb-main-header-right">
          <div class="tb-m-menu-btn tb-style1"><span></span></div>
          <div class="tb-full-screen-nav">
            <div class="tb-full-screen-nav-in">
              <div class="tb-full-screen-nav-overlay"></div>
                <nav class="tb-main-nav tb-primary-nav">
                  <?php webify_main_menu('tb-primary-nav-list'); ?>
                </nav>
                <?php webify_social_icons('header'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
