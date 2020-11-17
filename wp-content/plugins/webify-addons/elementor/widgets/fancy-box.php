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
class Webify_Fancy_Box_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-fancy-box-widget';
  }

  public function get_title() {
    return 'Fancy Box';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-fancy-box', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'fancy_box_section',
      array(
        'label' => esc_html__('Fancy Box' , 'webify-addons')
      )
    );

    $this->add_control(
      'bg_image',
      array(
        'label'     => esc_html__('Background Image', 'webify-addons'),
        'type'      => Controls_Manager::MEDIA,
      )
    );

    $this->add_control(
      'sub_title',
      array(
        'label'       => esc_html__('Sub Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Episode 1020', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Take control of your commute with Google Maps', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Listen on iTunes', 'webify-addons'),
      )
    );

    $this->add_control(
      'btn_url',
      array(
        'label'       => esc_html__('Button URL', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#'),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_sub_title_color',
      array(
        'label' => esc_html__('Sub Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('sub_title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-fancybox-subtitle' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_title_typography',
        'selector' => '{{WRAPPER}} .tb-fancybox-subtitle',
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
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-fancybox-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-fancybox-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_button_style',
      array(
        'label' => esc_html__('Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('button_style');

    $this->start_controls_tab(
      'button_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('button_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('button_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'button_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('button_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-fancybox.tb-style4:hover .tb-btn.tb-style3' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('button_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 
    $settings  = $this->get_settings();
    $bg_image  = $settings['bg_image'];
    $title     = $settings['title'];
    $sub_title = $settings['sub_title'];
    $btn_url   = $settings['btn_url'];
    $btn_text  = $settings['btn_text'];
    $href      = (!empty($btn_url['url']) ) ? $btn_url['url'] : '#';
    $target    = ($btn_url['is_external'] == 'on') ? '_blank' : '_self';

  ?>

    <div class="tb-fancybox tb-style4 tb-zoom">
      <div class="tb-fancybox-bg tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
      <div class="tb-fancybox-info">
        <div class="tb-fancybox-text">
          <div class="tb-fancybox-subtitle tb-white-c tb-mt-5 tb-f12-lg text-uppercase"><?php echo esc_html($sub_title); ?></div>
          <h2 class="tb-fancybox-title tb-white-c tb-f21-lg tb-m0"><?php echo esc_html($title); ?></h2>
        </div>
        <div class="tb-fancybox-btn"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style3"><?php echo esc_html($btn_text); ?></a></div>
      </div>
    </div>
  <?php

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Fancy_Box_Widget() );