<?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'webify-rectangle-medium-alt'); ?>
<div <?php post_class('tb-isotop-item'); ?>>
  <div class="tb-post tb-style5 tb-color1 ">
    <?php if(!empty($img_src) && is_array($img_src)): ?>
      <div class="tb-zoom">
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1">
          <img src="<?php echo esc_url($img_src[0]); ?>" alt="<?php echo esc_attr('blog-image', 'webify'); ?>">
        </a>
      </div>
    <?php endif; ?>
    <div class="tb-post-info">
      <div class="tb-catagory tb-style1">
        <?php echo get_the_category_list(); ?>
      </div>
      <div class="empty-space marg-lg-b5"></div>
      <h2 class="tb-post-title tb-f18-lg  tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
      <div class="tb-post-label tb-style1">
        <span class="tb-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
        <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
      </div>
    </div>
  </div>
</div>
