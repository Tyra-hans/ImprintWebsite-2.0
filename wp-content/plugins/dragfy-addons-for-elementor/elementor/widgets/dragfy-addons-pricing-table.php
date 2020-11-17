<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Repeater;
use DragfyAddons\Helpers\Helpers;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Pricing_Table extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-pricing-table';
  }

  public function get_title() {
    return 'Pricing Table';
  }

  public function get_icon() {
    return 'elem_icon pricing_table';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('pricing-table', 'button', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'pricing_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
          'style2' => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
          'style3' => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
          'style4' => esc_html__('Style 4', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->add_control(
      'is_featured',
      array(
        'label'     => esc_html__('Is Featured ?', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'no',
        'condition' => array('style' => array('style4')),
      )
    );

    $this->add_control(
      'featured_heading',
      array(
        'label'       => esc_html__('Featured Heading', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'condition'   => array('is_featured' => array('yes')),
        'default'     => esc_html__('Most Popular', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'pricing_price_settings',
      array(
        'label' => esc_html__('Price Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'plan',
      array(
        'label'       => esc_html__('Plan', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('Standard', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'plan_icon_type',
      array(
        'label'       => esc_html__('Icon Type', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'icon',
        'condition'   => array('style' => array('style4')),
        'label_block' => true,
        'options' => array(
          'icon'  => esc_html__('Icon', 'dragfy-addons-for-elementor'),
          'image' => esc_html__('Image', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->add_control(
      'plan_icon',
      array(
        'label'            => esc_html__('Font Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'condition'        => array('plan_icon_type' => array('icon')),
        'fa4compatibility' => 'icon',
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $this->add_control(
      'plan_icon_image',
        array(
          'label'       => esc_html__('Image Icon', 'dragfy-addons-for-elementor'),
          'condition'   => array('plan_icon_type' => array('image')),
          'label_block' => true,
          'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
          'type'        => Controls_Manager::MEDIA,
        )
      );

    $this->add_control(
      'currency',
      array(
        'label'       => esc_html__('Currency', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('$', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'price',
      array(
        'label'       => esc_html__('Price', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('499', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'seperator',
      array(
        'label'       => esc_html__('Seperator', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('/', 'dragfy-addons-for-elementor'),
        'condition'   => array('style' => array('style1')),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'duration',
      array(
        'label'       => esc_html__('Duration', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('month', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1'))
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'pricing_feature_settings',
      array(
        'label' => esc_html__('Feature Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'selected_icon',
      array(
        'label'            => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'fa4compatibility' => 'icon',
        'description'      => esc_html__('This option is only for Style 1, 3 & 4', 'dragfy-addons-for-elementor'),
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $repeater->add_control('feature_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'description' => esc_html__('This option is only for Style 1, 3 & 4', 'dragfy-addons-for-elementor'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-feature {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control(
      'feature',
      array(
        'label'       => esc_html__('Feature', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('5000 GB Bandwidth', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'features',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'icon'    => 'fa fa-check',
            'feature' => esc_html__('50 GB Bandwidth', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ feature }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'pricing_btn_settings',
      array(
        'label' => esc_html__('Button Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('Button Text', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'default'     => array('url' => '#'),
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'btn_data_attr',
      array(
        'label'       => esc_html__('Button Attributes', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );


    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-pricing-card',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-pricing-card'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-pricing-card',
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_featured_heading_style',
      array(
        'label'     => esc_html__('Featured Heading Style', 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style4')),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );


    $this->add_control('featured_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-featured-heading' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'featured_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-featured-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'featured_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-featured-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'featured_border',
        'selector' => '{{WRAPPER}} .df-featured-heading'
      )
    );

    $this->add_responsive_control(
      'featured_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-featured-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_control('featured_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-featured-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'featured_typography',
        'selector' => '{{WRAPPER}} .df-featured-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_plan_style',
      array(
        'label' => esc_html__('Plan Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );


    $this->add_control('plan_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'plan_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'plan_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'plan_border',
        'selector' => '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head'
      )
    );

    $this->add_responsive_control(
      'plan_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_control('plan_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('plan_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition'   => array('style' => array('style4')),
        'selectors' => array(
          '{{WRAPPER}} .df-plan-icon i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('plan_horizonal_line_color', 
      array(
        'label'     => esc_html__('Horizontal Line Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-card hr.plan-line' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'plan_typography',
        'selector' => '{{WRAPPER}} .df-pricing-heading, {{WRAPPER}} .df-pricing-head',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_price_style',
      array(
        'label' => esc_html__('Price Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('price_currency_heading', 
      array(
        'label' => esc_html__('Currency', 'dragfy-addons-for-elementor'),
        'type'  => Controls_Manager::HEADING,
      )
    );

    $this->add_control('currency_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-price-currency' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'currency_typography',
        'selector' => '{{WRAPPER}} .df-price-currency',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'currency_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'separator'  => 'after',
        'selectors' => array(
          '{{WRAPPER}} .df-price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );
    
    $this->add_control('price_price_heading', 
      array(
        'label'     => esc_html__('Price', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );


    $this->add_control('price_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-price' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'price_typography',
        'selector' => '{{WRAPPER}} .df-pricing-price',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'price_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'separator'  => 'after',
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );


    $this->add_control('price_seperator_heading', 
      array(
        'label'     => esc_html__('Seperator', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );


    $this->add_control('seperator_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-seperator' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'seperator_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'separator'  => 'after',
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-seperator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );



    $this->add_control('price_duratrion_heading', 
      array(
        'label'     => esc_html__('Duration', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );


    $this->add_control('duration_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-price-cycle' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'duration_typography',
        'selector' => '{{WRAPPER}} .df-price-cycle',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'duration_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'separator'  => 'after',
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-price-cycle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_control('price_extra_heading', 
      array(
        'label'     => esc_html__('Extra', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );

    $this->add_control('price_horizonal_line_color', 
      array(
        'label'     => esc_html__('Horizontal Line Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} hr.feature-line' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_features_style',
      array(
        'label' => esc_html__('Feature Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('feature_text_heading', 
      array(
        'label'     => esc_html__('Text', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );

    $this->add_control('feature_text_color', 
      array(
        'label'     => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-feature' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'      => 'feature_text_typography',
        'selector'  => '{{WRAPPER}} .df-pricing-feature',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'feature_text_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-feature li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );


    $this->add_control('feature_icon_heading', 
      array(
        'separator' => 'before',
        'label'     => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );

    $this->add_responsive_control(
      'feature_icon_size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust icon size.', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .df-pricing-feature i' => 'font-size: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_control('feature_odd_heading', 
      array(
        'separator' => 'before',
        'condition' => array('style' => array('style2')),
        'label'     => esc_html__('Odd item', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::HEADING,
      )
    );

    $this->add_control('feature_odd_bg_color', 
      array(
        'label'     => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-style2 .df-pricing-feature li:nth-child(odd)' => 'background: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_section();


    $this->start_controls_section('section_button_style',
      array(
        'label' => esc_html__('Button Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'btn_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'btn_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_border',
        'selector' => '{{WRAPPER}} .df-btn'
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .df-btn',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('btn_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_hover_border',
        'selector' => '{{WRAPPER}} .df-btn:hover'
      )
    );

    $this->add_control('btn_text_hover_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_hover_typography',
        'selector' => '{{WRAPPER}} .df-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_hover_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn:hover',
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();



  }

  protected function render() { 
    $settings         = $this->get_settings_for_display();
    $style            = $settings['style'];
    $plan_icon_type   = $settings['plan_icon_type'];
    $plan_icon        = $settings['plan_icon'];
    $plan_icon_image  = $settings['plan_icon_image'];
    $is_featured      = $settings['is_featured'];
    $featured_heading = $settings['featured_heading'];
    $features         = $settings['features'];
    $plan             = $settings['plan'];
    $currency         = $settings['currency'];
    $seperator        = $settings['seperator'];
    $duration         = $settings['duration'];
    $price            = $settings['price'];
    $btn_text         = $settings['btn_text'];
    $btn_data_attr    = $settings['btn_data_attr'];
    $href             = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target           = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';


    switch ($style) {
      case 'style1':
      default: ?>
        <div class="df-pricing-card df-style1 df-pricing-table df-mkt-green">
          <h3 class="df-pricing-heading text-center df-f16-lg df-font-name df-m0"><?php echo esc_html($plan); ?></h3>
          <hr class="plan-line">
          <div class="df-price text-center">
            <i class="df-price-currency df-f30-lg"><?php echo esc_html($currency); ?></i>
            <span class="df-f60-lg df-pricing-price"><?php echo esc_html($price); ?></span>
            <i class="df-price-cycle df-grayb5b5b5-c"><span class="df-seperator"><?php echo esc_html($seperator); ?></span><?php echo esc_html($duration); ?></i>
          </div>
          <hr class="feature-line">
          <?php if(!empty($features) && is_array($features)): ?>
            <ul class="df-pricing-feature df-mp0 df-f14-lg">
              <?php foreach($features as $feature): ?>
                <li class="elementor-repeater-item-<?php echo $feature['_id']; ?>"><?php Icons_Manager::render_icon($feature['selected_icon'], ['aria-hidden' => 'true']); ?><?php echo esc_html($feature['feature']); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <div class="df-pricing-btn">
              <a href="<?php echo esc_url($href); ?>" <?php echo wp_kses_post($btn_data_attr); ?> target="<?php echo esc_attr($target); ?>" class="df-btn df-btn-primary df-style3 df-color9 w-100"><span><?php echo esc_html($btn_text); ?></span></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="df-radious-4 df-border df-pricing-card df-style2 text-center">
          <h3 class="df-pricing-heading df-666-c text-center df-f16-lg df-m0"><?php echo esc_html($plan); ?></h3>
          <hr class="plan-line">
          <div class="df-price df-fw-regular df-font-name  df-flex">
            <i class="df-price-currency df-f24-lg"><?php echo esc_html($currency); ?></i>
            <span class="df-f48-lg df-pricing-price df-black111-c"><?php echo esc_html($price); ?></span>
          </div>
          <?php if(!empty($features) && is_array($features)): ?>
          <ul class="df-pricing-feature df-mp0">
            <?php foreach($features as $feature): ?>
              <li class="elementor-repeater-item-<?php echo $feature['_id']; ?>"><?php echo esc_html($feature['feature']); ?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <div class="df-pricing-btn">
              <div class="empty-space marg-lg-b30"></div>
              <a href="<?php echo esc_url($href); ?>" <?php echo wp_kses_post($btn_data_attr); ?> target="<?php echo esc_attr($target); ?>" class="df-btn df-style5 df-color5 ?>"><span><?php echo esc_html($btn_text); ?></span></a>
              <div class="empty-space marg-lg-b30"></div>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="df-pricing-card-col df-pricing-card df-pricing-table-style3">
          <div class="df-pricing-card-row df-pricing-heading"><?php echo esc_html($plan); ?></div>
          <div class="df-pricing-card-row">
            <h3 class="df-price df-flex df-m0">
              <i class="df-price-currency df-f16-lg"><?php echo esc_html($currency); ?></i>
              <span class="df-f48-lg df-pricing-price df-line1"><?php echo esc_html($price); ?></span>
            </h3>
            <?php if(!empty($btn_text)): ?>
              <div class="df-pricing-card-btn">
                <a href="<?php echo esc_url($href); ?>" <?php echo wp_kses_post($btn_data_attr); ?> target="<?php echo esc_attr($target); ?>" class="df-btn df-style3 df-color17"><?php echo esc_html($btn_text); ?></a>
              </div>
            <?php endif; ?>
          </div>

          <?php if(!empty($features) && is_array($features)): ?>
          <ul class="df-pricing-feature df-mp0 ">
            <?php foreach($features as $feature): ?>
              <li class="elementor-repeater-item-<?php echo $feature['_id']; ?>">
                <?php Icons_Manager::render_icon($feature['selected_icon'], ['aria-hidden' => 'true']); ?>
                <?php echo esc_html($feature['feature']); ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="df-pricing-card df-style6 df-pricing-table">
          <?php if($is_featured == 'yes'): ?>
            <div class="df-popular-bar df-featured-heading"><?php echo esc_html($featured_heading); ?></div>
          <?php endif; ?>
          <div class="df-pricing-head">
            <div class="df-pricing-icon df-plan-icon">
              <?php if($plan_icon_type == 'image' && is_array($plan_icon_image) && !empty($plan_icon_image['url'])): ?>
                <img src="<?php echo esc_url($plan_icon_image['url']); ?>" alt="icon">
              <?php else: ?>
                <?php Icons_Manager::render_icon($plan_icon, ['aria-hidden' => 'true']); ?>
              <?php endif; ?>
            </div>
            <h3 class="df-pricing-heading text-center df-f16-lg df-font-name df-m0"><?php echo esc_html($plan); ?></h3>
          </div>
          <hr class="plan-line">
          <div class="df-price text-center">
            <i class="df-price-currency df-f20-lg"><?php echo esc_html($currency); ?></i>
            <span class="df-f48-lg df-pricing-price"><?php echo esc_html($price); ?></span>
          </div>
          <?php if(!empty($features) && is_array($features)): ?>
          <ul class="df-pricing-feature df-mp0 df-f16-lg">
            <?php foreach($features as $feature): ?>
              <li class="elementor-repeater-item-<?php echo $feature['_id']; ?>">
                <?php Icons_Manager::render_icon($feature['selected_icon'], ['aria-hidden' => 'true']); ?>
                <?php echo esc_html($feature['feature']); ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <div class="df-pricing-btn">
              <a href="<?php echo esc_url($href); ?>" <?php echo wp_kses_post($btn_data_attr); ?> target="<?php echo esc_attr($target); ?>" class="df-btn df-btn-primary df-style3 df-color9 w-100"><span><?php echo esc_html($btn_text); ?></span></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

    }
    
  }

}
