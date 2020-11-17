<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package webify
 */
$sidebar_details = webify_sidebar_position();
switch ($sidebar_details['layout']):
  case 'left_sidebar': ?>
    <!-- Sidebar -->
    <?php if (is_active_sidebar( webify_get_custom_sidebar('main') )): ?>
    <div class="col-lg-4">
      <div class="sidebar left-sidebar">
        <?php if (is_active_sidebar( webify_get_custom_sidebar('main') )): ?>
          <?php dynamic_sidebar( webify_get_custom_sidebar('main', $sidebar_details['sidebar-name'])); ?>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    <!-- End Sidebar -->
    <?php break;

  case 'right_sidebar': ?>
    <!-- Sidebar -->
    <?php if (is_active_sidebar( webify_get_custom_sidebar('main') )): ?>
    <div class="col-lg-4">
      <div class="sidebar right-sidebar">
          <?php dynamic_sidebar( webify_get_custom_sidebar('main', $sidebar_details['sidebar-name'])); ?>
      </div>
    </div>
    <?php endif; ?>
    <!-- End Sidebar -->
    <?php break;
endswitch;
?>
