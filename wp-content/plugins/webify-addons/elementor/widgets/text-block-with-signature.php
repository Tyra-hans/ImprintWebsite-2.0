<?php 
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Text_Block_With_Signature_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-text-block-with-signature-widget';
  }

  public function get_title() {
    return 'Text Block With Signature';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array();
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'text_block_with_signature_section',
      array(
        'label' => esc_html__('Text Block With Signature' , 'webify-addons')
      )
    );


    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Enter your heading', 'webify-addons'),
        'default'     => esc_html__('Rewarding entertainment for you and your loved ones', 'webify-addons'),
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'placeholder' => esc_html__('Enter your description', 'webify-addons'),
        'default'     => esc_html__('Deployment long tail monetization strategy equity basic of conversion. Supply chain freemium investor long tail agile development prototype validation influencer.', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'signature_image',
      array(
        'label'       => esc_html__('Signature', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_heading',
      array(
        'label' => esc_html__('Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

        $this->start_controls_section('section_style_description',
      array(
        'label' => esc_html__('Description', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-description' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('description_tick_color', 
      array(
        'label'       => esc_html__('Check Icon Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-description i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-description',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();



  }

  protected function render() { 
    $settings        = $this->get_settings();
    $heading         = $settings['heading'];
    $description     = $settings['description'];
    $signature_image = $settings['signature_image'];
  ?>

    <div class="tb-vertical-middle">
      <div class="tb-text-box tb-style1">
        <?php if(!empty($heading)): ?>
          <h2 class="tb-f32-lg tb-heading tb-f28-sm tb-font-name tb-mt-5 tb-mp0"><?php echo wp_kses_post($heading); ?></h2>
          <div class="empty-space marg-lg-b15"></div>
        <?php endif; ?>
        <?php if(!empty($description)): ?>
          <div class="tb-f16-lg tb-description tb-line1-6"><?php echo wp_kses_post($description); ?></div>
          <div class="empty-space marg-lg-b25"></div>
        <?php endif; ?>
        <?php if(is_array($signature_image) && !empty($signature_image['url'])): ?>
          <img src="<?php echo esc_url($signature_image['url']); ?>" alt="img">
        <?php endif; ?>
      </div>
    </div>
  <?php

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Text_Block_With_Signature_Widget() );