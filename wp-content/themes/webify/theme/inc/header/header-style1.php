<?php
/**
 * Header Template file
 *
 * @package webify
 * @since 1.0
 */
wp_enqueue_style('flaticon'); ?>
<!-- Start Site Header -->
<header class="tb-site-header <?php echo (webify_get_opt('header-full-width')) ? 'tb-full-width':'tb-default-width'; ?> tb-style1 <?php echo (webify_get_opt('header-sticky')) ? 'tb-sticky-header':'tb-sticky-disabled'; ?> tb-solid-header tb-color1 tb-header-border1">
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
          <nav class="tb-main-nav tb-primary-nav">
            <?php webify_main_menu('tb-primary-nav-list'); ?>
          </nav>
          <?php if(is_woocommerce_activated()): ?>
            <div class="tb-user-btn">

              <a href="<?php echo esc_url(get_the_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><img src="<?php echo get_theme_file_uri('assets/img/user.svg'); ?>" alt="user"></a>
              <span class="tb-search-modal-btn"><img src="<?php echo get_theme_file_uri('assets/img/search.svg'); ?>" alt=""></span>
              <a href="<?php echo esc_url(wc_get_cart_url()); ?>"><img src="<?php echo get_theme_file_uri('assets/img/shopping-bag.svg'); ?>" alt=""> <span class="tb-card-number">(<?php echo esc_html(WC()->cart->cart_contents_count); ?>)</span></a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- End Site Header -->
<?php webify_product_search_form(); ?>

