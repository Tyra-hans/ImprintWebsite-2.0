<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_newsletter', array(
  'title'       => esc_html__('- Webify Newsletter', 'webify-addons'),
  'classname'   => 'tb-widget-newsletter',
  'fields'      => array(
    array(
      'id'      => 'type',
      'type'    => 'select',
      'title'   => esc_html__('Type', 'webify-addons'),
      'options' => array(
        'newsletter' => esc_html__('Newsletter', 'webify-addons'),
        'mailchimp'  => esc_html__('Mailchimp', 'webify-addons')
      ),
      'default' => 'newsletter'
    ),
    array(
      'id'      => 'style',
      'type'    => 'select',
      'title'   => esc_html__('Style', 'webify-addons'),
      'options' => array(
        'style1' => esc_html__('Style 1', 'webify-addons'),
        'style2' => esc_html__('Style 2', 'webify-addons')
      ),
      'default' => 'style1'
    ),
    array(
      'id'      => 'title',
      'type'    => 'text',
      'default' => esc_html__('Sign up for Newsletter', 'webify-addons'),
      'title'   => esc_html__('Title', 'webify-addons'),
    ),
    array(
      'id'         => 'sub_title',
      'type'       => 'text',
      'default'    => esc_html__('Hottest articles on your inbox!', 'webify-addons'),
      'title'      => esc_html__('Sub Title', 'webify-addons'),
      'dependency' => array('style', '==', 'style1'),
    ),
    array(
      'id'         => 'image',
      'type'       => 'media',
      'title'      => esc_html__('Image', 'webify-addons'),
      'dependency' => array('style', '==', 'style1'),
    ),
    array(
      'id'         => 'name_placeholder',
      'type'       => 'text',
      'default'    => esc_html__('First Name', 'webify-addons'),
      'title'      => esc_html__('Name Placeholder', 'webify-addons'),
      'dependency' => array('style|type', '==', 'style1|newsletter'),
    ),
    array(
      'id'      => 'email_placeholder',
      'type'    => 'text',
      'default' => esc_html__('Enter Email Address', 'webify-addons'),
      'title'   => esc_html__('Email Placeholder', 'webify-addons'),
      'dependency' => array('type', '==', 'newsletter'),
    ),
    array(
      'id'         => 'btn_text',
      'type'       => 'text',
      'default'    => esc_html__('Subscribe Now', 'webify-addons'),
      'title'      => esc_html__('Button Text', 'webify-addons'),
      'dependency' => array('style|type', '==', 'style1|newsletter'),
    ),
    array(
      'id'         => 'mc4wp_form_id',
      'type'       => 'select',
      'title'      => esc_html__('Form', 'webify-addons'),
      'options'    => array('' => 'Select Mailchimp Form') + array_flip(webify_get_form_id()),
      'dependency' => array('type', '==', 'mailchimp'),
      'default'    => '',
    ),
  )
));


if(!function_exists( 'webify_newsletter' ) ) {
  function webify_newsletter( $args, $instance ) {

    echo $args['before_widget'];

    wp_enqueue_style('webify-button');
    wp_enqueue_style('webify-newsletter');

    $image         = $instance['image'];
    $style         = $instance['style'];
    $type          = !empty($instance['type']) ? $instance['type']:'newsletter';
    $mc4wp_form_id = !empty($instance['mc4wp_form_id']) ? $instance['mc4wp_form_id']:'';

    switch ($style) {
      case 'style1': default: ?>
        <div class="tb-border tb-radious-4 tb-newsletter-widget <?php echo esc_attr($style); ?>">
          <div class="tb-newsletter tb-style6 text-center">
            <h4 class="tb-newsletter-title tb-f20-lg tb-mt-4 tb-mb2"><?php echo esc_html($instance['title']); ?></h4>
            <div class="tb-newsletter-subtitle"><?php echo esc_html($instance['sub_title']); ?></div>
            <div class="empty-space marg-lg-b15"></div>
            <?php if(is_array($image) && !empty($image['url'])): ?>
              <a class="tb-newsletter-img" href="#">
                <img src="<?php echo esc_url($image['url']); ?>" height="149" width="105" alt="img">
              </a>
              <div class="empty-space marg-lg-b30"></div>
            <?php endif; ?>
            <?php if($type == 'mailchimp' && !empty($mc4wp_form_id)): ?>
              <?php echo do_shortcode('[mc4wp_form id="'.$mc4wp_form_id.'"]'); ?>
            <?php else: ?> 
              <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)">
                <div class="tb-form-field">
                  <input class="c-input" type="text" name="nn" required="" placeholder="<?php echo esc_attr($instance['name_placeholder']); ?>">
                </div>
                <div class="empty-space marg-lg-b10"></div>
                <div class="tb-form-field">
                  <input class="c-input" type="email" name="ne" required="" placeholder="<?php echo esc_attr($instance['email_placeholder']); ?>">
                </div>
                <div class="empty-space marg-lg-b10"></div>
                <div class="tb-btn tb-style3 w-100 tb-color2">
                  <input type="submit" class="tb-newsletter-submit" value="<?php echo esc_attr($instance['btn_text']); ?>">
                </div>
              </form>
            <?php endif; ?>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style2': 
        if (!empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
      ?>
      <?php if($type == 'mailchimp' && !empty($mc4wp_form_id)): ?>
        <div class="tb-newsletter-widget <?php echo esc_attr($style); ?>">
          <?php echo do_shortcode('[mc4wp_form id="'.$mc4wp_form_id.'"]'); ?>
        </div>
      <?php else: ?> 
        <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="tb-newsletter tb-style8">
          <input type="email" name="ne" required="" placeholder="<?php echo esc_attr($instance['email_placeholder']); ?>">
          <button type="submit" class="tb-newsletter-submit"><i class="fa fa-paper-plane"></i></button>
        </form>
      <?php endif; ?>
      <?php
        break;
    }
  ?>

    <?php 
    echo $args['after_widget'];

  }
}