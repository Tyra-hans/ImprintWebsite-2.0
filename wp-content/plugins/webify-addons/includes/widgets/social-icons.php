<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_social_icons_details', array(
  'title'       => esc_html__('- Webify Social Icons', 'webify-addons'),
  'classname'   => 'tb-widget-contact-details',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => 'Title',
    ),
    array(
      'id'     => 'social-icons',
      'type'   => 'repeater',
      'fields' => array(
        array(
          'id'    => 'icon',
          'type'  => 'icon',
          'title' => esc_html__('Choose Icon', 'webify-addons'),
        ),
        array(
          'id'    => 'url',
          'type'  => 'text',
          'title' => esc_html__('URL', 'webify-addons'),
        ),
      ),
    ),
  )
));


if(!function_exists( 'webify_social_icons_details' ) ) {
  function webify_social_icons_details( $args, $instance ) {

    echo $args['before_widget'];

    if (!empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
        
    $social_icons = isset($instance['social-icons']) ? $instance['social-icons']:'';

    if(!empty($social_icons) && is_array($social_icons)): ?>
      <div class="tb-footer-social-btn tb-style1 tb-flex-align-center tb-f16-lg tb-mt-3 tb-mb-3">
        <?php foreach($social_icons as $icons): ?>
          <a href="<?php echo esc_html($icons['url']); ?>"><i class="<?php echo esc_html($icons['icon']); ?>"></i></a>
        <?php endforeach; ?>
      </div>
    <?php endif;

    echo $args['after_widget'];

  }
}