<?php
/**
 * Blog Parts
 *
 * @package webify
 * @since 1.0
 */
wp_enqueue_script('parallax');
$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
<div class="tb-blog-head tb-bg tb-flex tb-parallax" data-speed="0.4" style="background-image:url(<?php echo esc_url($img_src[0]); ?>);">
  <div class="tb-blog-head-inner">
    <div class="container">
      <div class="row">

        <div class="col-lg-10 offset-lg-1">
          <div class="tb-blog-category text-center text-uppercase tb-white-c  tb-f10-lg tb-line1-3">
            <?php 
              $category = get_the_category(); 
              if(is_array($category) && !empty($category)):
                foreach($category as $cat): ?>
                  <a class="tb-category-btn tb-style1 tb-radious-3" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
               <?php 
                endforeach;
              endif;
            ?>
          </div>
          <div class="empty-space marg-lg-b15"></div>
          <h1 class="tb-m0 tb-f48-lg tb-white-c  tb-font-name text-center"><?php the_title(); ?></h1>
          <div class="empty-space marg-lg-b5"></div>
          <!-- Tb-BLOG-USER -->
          <div class="tb-user tb-style1 text-center tb-flex">
            <a class="tb-user-img tb-radious-50" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">
              <?php echo get_avatar( get_the_author_meta('ID'), 40 ); ?>
            </a>
            <div class="tb-user-content tb-f14-lg tb-white-c">
              <span class="tb-post-author-single"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span>
              <span class="tb-post-date-single tb-white-c7"><?php echo get_the_date(get_option('date_format')); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
