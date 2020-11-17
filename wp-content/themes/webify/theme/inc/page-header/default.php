<?php
/**
 * Title Wrapper
 *
 * @package webify
 * @since 1.0
 */
if(is_singular('post') || is_singular('portfolio') || is_404()) { return; }
?>

<div class="tb-page-heading-wrap <?php echo (webify_get_opt('page-header-bg-overlay') || !class_exists('CSF')) ? 'has-overlay':'no-overlay'; ?> tb-page-header tb-parallax" data-speed="0.4">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="tb-page-heading">
          <h1 class="tb-heading-title tb-font-name"><?php echo webify_get_the_title(); ?></h1>
          <?php if(function_exists('bcn_display_list')): ?>
            <ul class="tb-breadcamp">
              <?php bcn_display_list($return = false, $linked = true, $reverse = false, $force = false); ?>
            </ul>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>
