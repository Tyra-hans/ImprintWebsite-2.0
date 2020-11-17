<?php
/**
 * Portfolio Single Parts
 *
 * @package webify
 * @since 1.0
 *
 */
global $post;
$terms   = wp_get_post_terms($post->ID, 'portfolio-category'); 
$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

if(!empty($img_src) && is_array($img_src)): ?>
  <div class="tb-post <?php echo webify_get_opt('project-single-style'); ?> tb-style6">
    <div href="#" class="tb-post-thumb tb-bg" style="background-image: url(<?php echo esc_url($img_src[0]); ?>);"></div>
    <div class="tb-post-info">
      <div class="container">
        <h2 class="tb-post-title tb-f48-lg tb-m0"><?php the_title(); ?></h2>
        <div class="tb-catagory tb-style1">
          <?php if(!empty($terms) && is_array($terms)): ?>
            <ul class="post-categories">
              <?php foreach($terms as $term): ?>
                <li><?php echo esc_html($term->name); ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
