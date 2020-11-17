<?php
/**
 * Header Template file
 *
 * @package webify
 * @since 1.0
 */
?>
<!-- Start Site Header -->
<header class="tb-site-header tb-sideheader <?php echo (webify_get_opt('header-full-width')) ? 'tb-full-width':'tb-default-width'; ?> tb-style2 <?php echo (webify_get_opt('header-sticky')) ? 'tb-sticky-header':'tb-sticky-disabled'; ?> tb-solid-header tb-color1">

  <div class="tb-main-header">
    <div class="container">
      <div class="tb-main-header-in">
        <div class="tb-main-header-top">
          <div class="tb-site-branding">
            <?php webify_logo('header-logo', get_theme_file_uri('assets/img/logo-dark.png')); ?>
          </div>
        </div>


        <div class="tb-main-header-middle">
          <nav class="tb-main-nav tb-primary-nav">
            <?php webify_main_menu('tb-primary-nav-list'); ?>
          </nav>

          <?php if(!empty(webify_get_opt('header-btn-text'))): ?>
            <div class="tb-header-btn"><a href="<?php echo esc_url(webify_get_opt('header-btn-link')); ?>" class="tb-btn <?php echo webify_get_opt('header-btn-style'); ?> tb-style9"><?php echo esc_html(webify_get_opt('header-btn-text')); ?></a></div>
          <?php endif; ?>
        </div>

        <div class="tb-main-header-bottom">
          <?php webify_social_icons('header'); ?>
        </div>

      </div>
    </div>
  </div>
</header>
<!-- End Site Header -->
