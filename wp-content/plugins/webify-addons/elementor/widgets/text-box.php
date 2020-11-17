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
class Webify_Text_Box_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-text-box-widget';
  }

  public function get_title() {
    return 'Text Box';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-text-box');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'text_box_section',
      array(
        'label' => esc_html__('Text Box' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'webify-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'options' => array(
          'style1' => 'Style 1',
        )
      )
    );

    $this->add_control(
      'number',
      array(
        'label'       => esc_html__('Number', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('2.5', 'webify-addons'),
      )
    );

    $this->add_control(
      'suffix',
      array(
        'label'       => esc_html__('Suffix', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('%', 'webify-addons'),       
        'label_block' => true,
      )
    );

    $this->add_control(
      'title_text',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter your title', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('This is heading', 'webify-addons')       
      )
    );

    $this->add_control(
      'description_text',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'placeholder' => esc_html__('Enter your description', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('You can choose from 320+ icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'webify-addons')       
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_number_color',
      array(
        'label' => esc_html__('Number', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('number_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-text-box .tb-text-box-number' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'number_typography',
        'selector' => '{{WRAPPER}} .tb-text-box .tb-text-box-number',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_title_color',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-text-box-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-text-box .tb-text-box-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_color',
      array(
        'label' => esc_html__('Description', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-text-box .tb-text-box-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-text-box .tb-text-box-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings         = $this->get_settings();
    $style            = $settings['style'];
    $number           = $settings['number'];
    $suffix           = $settings['suffix'];
    $title_text       = $settings['title_text'];
    $description_text = $settings['description_text'];

  ?>

    <div class="tb-text-box tb-style1">
      <div class="tb-text-box-in">
        <h2 class="tb-special-text tb-f60-lg tb-f50-sm tb-line0-8 tb-font-name tb-m0"><?php echo esc_html($number); ?> <span class="tb-f24-lg"><?php echo esc_html($suffix); ?></span></h2>
        <div class="empty-space marg-lg-b10"></div>
        <h3 class="tb-font-name tb-f18-lg tb-mt1 tb-m0 tb-text-box-heading"><?php echo wp_kses_post($title_text); ?></h3>
        <div class="empty-space marg-lg-b10"></div>
        <div class="tb-mb-5 tb-text-box-text"><?php echo wp_kses_post($description_text); ?></div>
      </div>
    </div>

  <?php

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Text_Box_Widget() );