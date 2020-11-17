<?php
/**
 * 404
 *
 * @package webify
 * @since 1.0
 */

get_header(); 

wp_enqueue_style('webify-button');

?>

<div class="tb-error-page tb-flex tb-bg text-center">
  <div class="tb-error-section">
    <h2 class="tb-f32-lg tb-mb7"><?php echo esc_html(webify_get_opt('error-page-heading')); ?></h2>
    <div class="tb-f16-lg"><?php echo wp_kses_post(webify_get_opt('error-page-content')); ?></div>
    <div class="empty-space  marg-lg-b25"></div>
    <a class="tb-btn tb-style3 tb-color18" target="_self" title="button" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(webify_get_opt('error-page-btn-text')); ?></a>
  </div>
</div>

<?php
get_footer();
