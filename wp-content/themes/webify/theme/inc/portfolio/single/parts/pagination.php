<?php
/**
 * Portfolio Single Parts
 *
 * @package webify
 * @since 1.0
 *
 */

  $previous_post       = get_previous_post();
  $prev_thumbnail      = (is_object($previous_post) && !empty($previous_post)) ? get_the_post_thumbnail($previous_post->ID):'';
  $next_post           = get_next_post();
  $next_post_thumbnail = (is_object($next_post) && !empty($next_post)) ? get_the_post_thumbnail($next_post->ID):'';
  $col_class           = ($previous_post && $next_post) ? 'col-xs-6':'col-xs-12';
?>
<hr>
<div class="empty-space marg-lg-b20"></div>
<div class="tb-blog-nav-wrap tb-style2">

  <?php if($previous_post): ?>
    <div class="tb-blog-nav tb-left">
      <div class="tb-blog-nav-image tb-prev-post-img">
        <a href="<?php echo get_the_permalink($previous_post->ID); ?>"><?php echo wp_kses_post($prev_thumbnail); ?></a>
      </div>
      <div class="tb-blog-nav-in">
        <div class="tb-blog-nav-label text-uppercase tb-f12-lg  tb-grayb5b5b5-c tb-line1-3"><?php echo esc_html__('Previous', 'webify'); ?></div>
        <h3 class="tb-f16-lg tb-m0"><?php previous_post_link('%link', '%title'); ?></h3>
      </div>
    </div>
  <?php endif; ?> 

  <div class="tb-blog-nav tb-center text-center">
    <div class="tb-blog-share-label text-uppercase tb-f12-lg  tb-grayb5b5b5-c tb-line1-3"><?php echo esc_html__('Share On', 'webify'); ?></div>
    <div class="tb-footer-social-btn tb-style1 tb-flex-align-center tb-f14-lg">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-facebook-f"></i></a>
      <a href="https://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-twitter"></i></a>
    </div>
  </div>

  <?php if($next_post): ?>
    <div class="tb-blog-nav tb-right">
      <div class="tb-blog-nav-image tb-next-post-img">
        <a href="<?php echo get_the_permalink($next_post->ID); ?>"><?php echo wp_kses_post($next_post_thumbnail); ?></a>
      </div>
      <div class="tb-blog-nav-in">
        <div class="tb-blog-nav-label text-uppercase tb-f12-lg tb-grayb5b5b5-c tb-line1-3"><?php echo esc_html__('Next', 'webify'); ?></div>
        <h3 class="tb-f16-lg tb-m0"><?php next_post_link('%link', '%title'); ?></h3>
      </div>
    </div>
  <?php endif; ?>
</div>
