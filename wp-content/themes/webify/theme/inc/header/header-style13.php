<?php
/**
 * Header Template file
 *
 * @package webify
 * @since 1.0
 */
wp_enqueue_style('webify-button'); ?>
<header class="tb-site-header tb-sticky-logo tb-header-style tb-header-style13 <?php echo (webify_get_opt('header-full-width')) ? 'tb-full-width':'tb-default-width'; ?> tb-style1 <?php echo (webify_get_opt('header-sticky')) ? 'tb-sticky-header':'tb-sticky-disabled'; ?>  tb-transparent-header tb-color1">
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
            <!-- For Image Logo -->
            <?php webify_logo('header-logo', get_theme_file_uri('assets/img/logo-dark.png'), 'tb-logo'); ?>
            <?php webify_logo('header-logo-sticky', get_theme_file_uri('assets/img/logo-white.png'), 'tb-logo-sticky'); ?>
          </div>
        </div>

        <div class="tb-main-header-right">
          <nav class="tb-main-nav tb-primary-nav">
            <?php webify_main_menu('tb-primary-nav-list'); ?>
          </nav>
          <?php if(!empty(webify_get_opt('header-btn-text'))): ?>
            <div class="tb-header-btn"><a href="<?php echo esc_url(webify_get_opt('header-btn-link')); ?>" class="tb-btn <?php echo webify_get_opt('header-btn-style'); ?> tb-style10"><?php echo esc_html(webify_get_opt('header-btn-text')); ?></a></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- End Site Header -->
