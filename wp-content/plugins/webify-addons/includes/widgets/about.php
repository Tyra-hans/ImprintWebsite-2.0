<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_about', array(
  'title'       => esc_html__('- Webify About', 'webify-addons'),
  'classname'   => 'tb-about',
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
    array(
      'id'      => 'sig_image',
      'type'    => 'media',
      'title'   => esc_html__('Signature Image')
    ),
  )
));


if(!function_exists( 'webify_about' ) ) {
  function webify_about( $args, $instance ) {

    echo $args['before_widget'];

    if (!empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    $image     = (!empty($instance['image'])) ? $instance['image']:'';
    $sig_image = (!empty($instance['sig_image'])) ? $instance['sig_image']:'';
        
  ?>
    <div class="tb-about tb-style2">
      <div class="text-center">
        <?php if(is_array($image) && !empty($image['url'])): ?>
          <div class="tb-about-img tb-zoom"> 
            <a class="tb-about-img-hover tb-zoom-in1" href="#" style="background-image:url(<?php echo esc_url($image['url']); ?>);"> </a>
          </div>
          <div class="empty-space marg-lg-b15"></div>
        <?php endif; ?>
        <div class="tb-simple-text">
          <?php echo wp_kses_post($instance['content']); ?>
        </div>
        <div class="empty-space marg-lg-b15"></div>
        <?php if(!empty($sig_image) && !empty($sig_image['url'])): ?>
          <img src="<?php echo esc_url($sig_image['url']); ?>" alt="img">
        <?php endif; ?>
      </div>
    </div>
    <?php
    echo $args['after_widget'];

  }
}