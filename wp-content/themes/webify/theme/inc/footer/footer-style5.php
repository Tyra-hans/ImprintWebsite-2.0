<?php
/**
 * Footer Template file
 *
 * @package webify
 * @since 1.0
 */
?>
<!-- Start Site Footer -->
<footer class="tb-site-footer tb-style2 tb-light-footer tb-footer-style5 <?php echo (webify_get_opt('footer-sticky')) ? 'tb-sticky-footer':''; ?>">
  <div class="tb-site-footer-in tb-flex-between">
    <div class="tb-copyright tb-style1 tb-f13-lg">
      <?php echo wp_kses_post(webify_get_opt('footer-copyright-text')); ?>
    </div>
    <?php webify_social_icons('footer', 'tb-color1'); ?>
  </div>
</footer>
<!-- End Site Footer -->
