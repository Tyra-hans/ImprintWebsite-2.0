<?php
/**
 * Footer Template file
 *
 * @package webify
 * @since 1.0
 */
?>
<!-- Start Site Footer -->
<footer class="tb-site-footer tb-style1 tb-light-footer <?php echo (webify_get_opt('footer-sticky')) ? 'tb-sticky-footer':''; ?>">

  <?php webify_footer_cta('tb-color16', 'tb-cta-title'); ?>

  <?php if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')): ?> 
    <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
    <div class="container">
      <div class="row">
        <?php webify_footer_columns(); ?>
      </div>
    </div>
    <div class="empty-space marg-lg-b55 marg-sm-55"></div>
    <hr>
  <?php endif; ?>
  <div class="tb-copyright tb-style1 tb-f13-lg text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12"><?php echo wp_kses_post(webify_get_opt('footer-copyright-text')); ?></div>
      </div>
    </div>
  </div>
</footer>
<!-- End Site Footer -->
