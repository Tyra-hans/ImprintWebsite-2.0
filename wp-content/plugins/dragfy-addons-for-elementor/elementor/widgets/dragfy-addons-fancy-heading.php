<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Fancy_Heading extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-fancy-heading';
  }

  public function get_title() {
    return 'Fancy Heading';
  }

  public function is_reload_preview_required() {
    return true;
  }

  public function get_icon() {
    return 'elem_icon fancy_heading';
  }

  public function get_script_depends() {
    return array('text-slider', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('dragfy-addons', 'text-slider');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'fancy_heading_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'slide',
        'label_block' => true,
        'options' => array(
          'slide'              => 'Style 1',
          'rotate-1'           => 'Style 2',
          'letters type'       => 'Style 3',
          'letters rotate-2'   => 'Style 4',
          'clip is-full-width' => 'Style 5',
          'zoom'               => 'Style 6',
          'letters rotate-3'   => 'Style 7',
          'letters scale'      => 'Style 8',
          'push'               => 'Style 9',
          'loading-bar'        => 'Style 10',
        )
      )
    );

    $this->end_controls_section();
    $this->start_controls_section(
      'fancy_heading_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('We design digital platforms.', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'before_text',
      array(
        'label'       => esc_html__('Before Text', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Build your', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'fancy_text',
      array(
        'label'       => esc_html__('Fancy Text', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => "Creative\nAmazing\nPassionate"
      )
    );

    $this->add_responsive_control(
      'align',
      array(
        'label' => esc_html__('Alignment', 'dragfy-addons-for-elementor' ),
        'type' => Controls_Manager::CHOOSE,
        'options' => array(
          'left' => array(
            'title' => esc_html__( 'Left', 'dragfy-addons-for-elementor' ),
            'icon'  => 'fa fa-align-left',
          ),
          'center' => array(
            'title' => esc_html__( 'Center', 'dragfy-addons-for-elementor' ),
            'icon'  => 'fa fa-align-center',
          ),
          'right' => array(
            'title' => esc_html__( 'Right', 'dragfy-addons-for-elementor' ),
            'icon'  => 'fa fa-align-right',
          ),
          'justify' => array(
            'title' => esc_html__( 'Justified', 'dragfy-addons-for-elementor' ),
            'icon'  => 'fa fa-align-justify',
          ),
        ),
        'default'   => 'left',
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading' => 'text-align: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_sub_heading_style',
      array(
        'label' => esc_html__('Sub Heading Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('sub_heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-hero-subtitle' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_heading_typography',
        'selector' => '{{WRAPPER}} .df-hero-subtitle',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'sub_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-hero-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'pro_section',
        array(
          'label' => esc_html__('Go Premium for More Features', 'dragfy-addons-for-elementor')
        )
    );

    $this->add_control(
      'get_pro',
      array(
        'label' => esc_html__('Unlock more possibilities', 'dragfy-addons-for-elementor' ),
        'type'  => Controls_Manager::CHOOSE,
        'options' => array(
          '1' => array(
            'title' => esc_html__('', 'dragfy-addons-for-elementor'),
            'icon'  => 'fa fa-unlock-alt',
          ),
        ),
        'default'     => '1',
        'description' => '<span class="pro-feature"> Get the  <a href="https://dragfy.com/elementor-addons/" target="_blank">Pro version</a> for more stunning elements and customization options.</span>'
      )
    );
            
    $this->end_controls_section();


    $this->start_controls_section('section_before_text_style',
      array(
        'label' => esc_html__('Before Text Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('before_text_heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-before-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'before_text_heading_typography',
        'selector' => '{{WRAPPER}} .df-before-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'before_text_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-before-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_fancy_style',
      array(
        'label' => esc_html__('Fancy Text Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('fancy_heading_cursor_color', 
      array(
        'label'       => esc_html__('Cursor Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-text-slider.type .df-words-wrapper::after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('fancy_heading_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition'   => array('style' => array('letters type')),
        'selectors' => array(
          '{{WRAPPER}} .df-text-slider.type .df-words-wrapper.selected' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('fancy_loading_bar_color', 
      array(
        'label'       => esc_html__('Loading Bar Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition'   => array('style' => array('loading-bar')),
        'selectors' => array(
          '{{WRAPPER}} .df-text-slider.loading-bar .df-words-wrapper::after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('fancy_heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-words-wrapper' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'fancy_text_heading_typography',
        'selector' => '{{WRAPPER}} .df-words-wrapper',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'fancy_text_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-words-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings    = $this->get_settings(); 
    $style       = $settings['style'];
    $sub_heading = $settings['sub_heading'];
    $before_text = $settings['before_text'];
    $fancy_text  = $settings['fancy_text'];
    $order       = array("\r\n", "\n", "\r", '<br/>', '<br>');
    $str         = str_replace( $order, '|', trim($fancy_text));
    $lines       = explode('|', $str);

  ?>
    <div class="df-section-heading df-style2">
      <?php if(!empty($sub_heading)): ?>
        <div class="df-f16-lg df-hero-subtitle"><?php echo esc_html($sub_heading); ?></div>
        <div class="empty-space marg-lg-b10"></div>
      <?php endif; ?>
      <h1 class="df-text-slider <?php echo esc_attr($style); ?> df-f48-lg df-f36-sm df-mb-3">
        <span class="df-before-text"><?php echo wp_kses_post($before_text); ?></span>
        <?php if(!empty($lines) && is_array($lines)): ?>
          <span class="df-words-wrapper">
            <?php foreach($lines as $key => $line): $class = ($key === 0) ? ' class="is-visible"':''; ?>
              <b<?php echo wp_kses_post($class); ?>> <?php echo esc_html($lines[$key]); ?></b>
            <?php endforeach; ?>
          </span>
        <?php endif; ?>
      </h1>
    </div>
    <?php
    
  }

}
