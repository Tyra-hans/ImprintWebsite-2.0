<?php
/**
 * Footer Template file
 *
 * @package webify
 * @since 1.0
 */
?>
<footer class="tb-site-footer tb-style1 tb-light-footer <?php echo (webify_get_opt('footer-sticky')) ? 'tb-sticky-footer':''; ?>">
  <hr>
  <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="tb-footer-widget tb-footer-text-widget text-center">
          <?php webify_logo('footer-logo', get_theme_file_uri('assets/img/logo-dark.png'), 'footer-logo'); ?>
          <div class="tb-footer-text-widget-text"><?php echo wp_kses_post(webify_get_opt('footer-content')); ?></div>
          <div class="empty-space marg-lg-b15 marg-sm-b15"></div>
          <?php webify_social_icons('footer', 'tb-color1 tb-flex'); ?>
          <?php if(class_exists('newsletter')): wp_enqueue_style('webify-newsletter'); ?>
            <div class="empty-space marg-lg-b20 marg-sm-b20"></div>
            <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="tb-newsletter tb-style8 tb-type1">
              <input type="email" name="ne" required="" placeholder="<?php echo esc_attr('Enter your email', 'webify'); ?>">
              <button type="submit" class="tb-newsletter-submit"><i class="fa fa-paper-plane"></i></button>
            </form>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
  <div class="empty-space marg-lg-b60 marg-sm-60"></div>
  <hr>
  <div class="tb-copyright tb-style1 tb-f13-lg text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12"><?php echo wp_kses_post(webify_get_opt('footer-copyright-text')); ?></div>
      </div>
    </div>
  </div>
</footer>

