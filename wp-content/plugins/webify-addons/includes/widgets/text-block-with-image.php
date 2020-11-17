<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_text_block_with_image', array(
  'title'       => esc_html__('- Webify Text Block With Image', 'webify-addons'),
  'classname'   => 'tb-text-block-with-image',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => esc_html__('Title')
    ),
    array(
      'id'      => 'image',
      'type'    => 'media',
      'title'   => esc_html__('Image')
    ),
    array(
      'id'      => 'content',
      'type'    => 'wp_editor',
    ),
  )
));


if(!function_exists( 'webify_text_block_with_image' ) ) {
  function webify_text_block_with_image( $args, $instance ) {

    echo $args['before_widget'];

    if (!empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    $image = (!empty($instance['image'])) ? $instance['image']:'';
        
  ?>

    <div class="tb-footer-widget tb-footer-text-widget">
      <?php 
      if(is_array($image) && !empty($image)): 
        $image_height = $image['height'];
        $style = (!empty($image_height)) ? ' style="max-height:'.($image_height / 2).'px;"':''; 
      ?>
          <img src="<?php echo esc_url($image['url']); ?>" class="tb-custom-logo" <?php echo wp_kses_post($style); ?> alt="image">
      <?php 
        endif; 
      ?>
      <div class="tb-footer-text-widget-text"><?php echo wp_kses_post($instance['content']); ?></div>
    </div>

    <?php
    echo $args['after_widget'];

  }
}