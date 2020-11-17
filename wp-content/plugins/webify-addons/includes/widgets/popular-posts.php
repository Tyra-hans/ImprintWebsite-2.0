<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_popular_posts', array(
  'title'       => esc_html__('- Webify Popular Posts', 'webify-addons'),
  'classname'   => 'tb-widget-popular-posts',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => 'Title',
    ),
    array(
      'id'      => 'post_count',
      'type'    => 'text',
      'default' => 6,
      'title'   => esc_html__('Number of Posts', 'webify-addons')
    ),
  )
));


if(!function_exists( 'webify_popular_posts' ) ) {
  function webify_popular_posts( $args, $instance ) {

    echo $args['before_widget'];

    $query_args = array(
      'orderby'             => 'comment_count', 
      'order'               => 'DESC', 
      'posts_per_page'      => $instance['post_count'], 
      'no_found_rows'       => true, 
      'post_status'         => 'publish', 
      'ignore_sticky_posts' => true
    );

    $query = new WP_Query($query_args);

    if($query->have_posts()):

      wp_enqueue_style('webify-section-heading');
      wp_enqueue_style('webify-post');

      $post_count = 1;
    ?>

      <div class="tb-border tb-radious tb-sidebar-padd">
        <div class="empty-space marg-lg-b30"></div>
        <?php if(!empty($instance['title'])): ?>
          <div class="tb-section-heading tb-style6 tb-overflow-hidden tb-mt-3">
            <h2 class="tb-f16-lg tb-m0"><?php echo esc_html($instance['title']); ?></h2>
          </div>
          <div class="empty-space marg-lg-b15"></div>
        <?php endif; ?>

        <?php for($i = 0; $i < $post_count; $i++): $query->the_post();  $img_src = webify_get_image_src(get_post_thumbnail_id()); ?>
          <div <?php post_class('tb-post tb-style1'); ?>>
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom tb-radious-4 tb-relative">
              <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($img_src); ?>);"></div>
            </a>
            <div class="tb-post-info">
              <div class="empty-space marg-lg-b15"></div>
              <h3 class="tb-post-title tb-f14-lg  tb-mt-3 tb-mb5 tb-line1-2"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
              <div class="tb-post-label"></div>
              <div class="tb-post-label tb-style1"> 
                <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
              </div>
            </div>
          </div>
          <div class="empty-space marg-lg-b25"></div>
          <hr>
          <div class="empty-space marg-lg-b15"></div>

          <?php 
            if (!$query -> have_posts()) :
              break;
          endif; ?>
        <?php endfor; ?>

        <?php

          $small_preview_count = $query->post_count - 1;

          if($query->have_posts() && $small_preview_count > 0):
            $post_per_col = $instance['post_count'] - 1;

        ?>
          <ul class="tb-post-list tb-style1 tb-mp0">
            <?php 
            for ($i = 0; $i < $post_per_col; $i++): 
              if (!$query->have_posts()) :
                  break;
                endif;
              $query -> the_post();
              $img_src = webify_get_image_src(get_post_thumbnail_id());
            ?>
              <li>
                <div class="tb-post tb-style3 tb-size1">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom">
                    <span class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($img_src); ?>);"></span>
                    <span class="tb-btn tb-style26 tb-size1"><i class="fas fa-caret-right"></i></span>
                  </a>
                  <div class="tb-post-info">
                    <div class="tb-post-text">
                      <h2 class="tb-post-title tb-f14-lg tb-line1-2 tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                      <div class="tb-post-label tb-style1">
                        <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            <?php endfor; ?>
          </ul>
        <?php endif; ?>

        <div class="empty-space marg-lg-b30"></div>
      </div>
    <?php wp_reset_postdata(); endif;
    echo $args['after_widget'];

  }
}