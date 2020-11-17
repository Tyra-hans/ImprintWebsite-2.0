<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_contact_details', array(
  'title'       => esc_html__('- Webify Contact Details', 'webify-addons'),
  'classname'   => 'tb-footer-address-widget',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => 'Title',
    ),
    array(
      'id'     => 'contact-details',
      'type'   => 'repeater',
      'fields' => array(
        array(
          'id'    => 'icon',
          'type'  => 'icon',
        ),
        array(
          'id'    => 'detail',
          'type'  => 'text',
        ),
      ),
      'default' => array(
        array(
          'icon'  => 'fa fa-map-marker',
          'detail' => esc_html__('221B Baker Street', 'webify-addons'),
        ),
        array(
          'icon'  => 'fa fa-phone',
          'detail' => esc_html__('(372) 587-2335', 'webify-addons'),
        ),
        array(
          'icon'  => 'fa fa-clock-o',
          'detail' => esc_html__('11 a.m - 12 p.m', 'webify-addons'),
        ),
      ),
    ),
  )
));


if(!function_exists( 'webify_contact_details' ) ) {
  function webify_contact_details( $args, $instance ) {

    echo $args['before_widget'];

    if (!empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
        
    $contact_details = $instance['contact-details'];

    if(!empty($contact_details) && is_array($contact_details)): ?>
      <ul class="tb-mp0">
        <?php foreach($contact_details as $detail): ?>
          <li><i class="<?php echo esc_attr($detail['icon']); ?>"></i><?php echo esc_html($detail['detail']); ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif;

    echo $args['after_widget'];

  }
}