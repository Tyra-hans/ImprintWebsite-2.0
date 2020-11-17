<?php

$sidebar_details = webify_sidebar_position();

if(is_singular('post')) {
  $col_class = 'col-lg-8 offset-lg-2';
} else {
  $col_class = 'col-md-12';
}

if ((is_active_sidebar(webify_get_custom_sidebar('main')) && $sidebar_details['layout'] == 'left_sidebar')): ?>
  <div class="row">
    <?php get_sidebar(); ?>
    <div class="col-lg-8">
<?php elseif ((is_active_sidebar(webify_get_custom_sidebar('main')) && $sidebar_details['layout'] == 'right_sidebar')): ?>
  <div class="row">
    <div class="col-lg-8">
<?php else: ?>
  <div class="row">
    <div class="<?php echo esc_attr($col_class); ?>">
<?php endif; ?>
