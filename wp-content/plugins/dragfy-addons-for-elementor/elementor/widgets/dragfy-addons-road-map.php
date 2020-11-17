<?php

namespace DragfyAddons\Elementor\Widgets;
use DragfyAddons\Helpers\Helpers;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Road_Map extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-road-map';
  }

  public function get_title() {
    return 'Road Map';
  }

  public function get_icon() {
    return 'elem_icon road_map';
  }

  public function get_script_depends() {
    return array('slick', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('slick', 'slider', 'icon-box', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'road_map_slider_settings',
      array(
        'label' => esc_html__('Slider Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label' => esc_html__('Autoplay', 'dragfy-addons-for-elementor'),
        'type'  => Controls_Manager::SWITCHER,
        
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'   => esc_html__('Loop', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SWITCHER,
        'default' => 'yes',
      )
    );

    $this->add_control(
      'arrows',
      array(
        'label'   => esc_html__('Arrows', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SWITCHER,
        'default' => 'yes',
      )
    );

    $this->add_control(
      'drag_effect',
      array(
        'label'   => esc_html__('Draggable Effect', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SWITCHER,
        'default' => 'yes',
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => esc_html__('Speed', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'default'     => 600
      )
    );

    $this->add_control(
      'lg_slide',
      array(
        'label'   => esc_html__('Desktop Slide', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::NUMBER,
        'default' => 4
      )
    );

    $this->add_control(
      'md_slide',
      array(
        'label'   => esc_html__('Table Slide', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::NUMBER,
        'default' => 3
      )
    );

    $this->add_control(
      'xs_slide',
      array(
        'label'   => esc_html__('Mobile Slide', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::NUMBER,
        'default' => 1
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'road_map_plan_settings',
      array(
        'label' => esc_html__('Plan Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'selected_icon',
      array(
        'label'            => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'fa4compatibility' => 'icon',
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Your Title', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA
      )
    );

    $repeater->add_control(
      'date',
      array(
        'label'       => esc_html__('Date', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('December 2015', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'plans',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'title'       => esc_html__('Project Starts', 'dragfy-addons-for-elementor'),
            'description' => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
            'date'        => esc_html__('December 2017', 'dragfy-addons-for-elementor')
          ),
          array(
            'title'       => esc_html__('Token Sale', 'dragfy-addons-for-elementor'),
            'description' => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
            'date'        => esc_html__('November 2018', 'dragfy-addons-for-elementor')
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
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
        'selector'  => '{{WRAPPER}} .df-roadmap',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-roadmap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-roadmap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-roadmap'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-roadmap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-roadmap',
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_icon_style',
      array(
        'label' => esc_html__('Icon Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'icon_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-icon-box .df-icon',
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'     => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'icon_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'icon_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'icon_border',
        'selector' => '{{WRAPPER}} .df-icon-box .df-icon'
      )
    );

    $this->add_responsive_control(
      'icon_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'icon_size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 60,
            'step' => 1,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'font-size: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-roadmap-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-roadmap-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-roadmap-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_style',
      array(
        'label' => esc_html__('Description Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-description-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .df-description-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'description_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-description-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_timeline_style',
      array(
        'label' => esc_html__('Timeline Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('horizontal_line_color', 
      array(
        'label'       => esc_html__('Horizontal Line Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-box-time' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('timeline_circle_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-box-time:before' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'timeline_circle_border',
        'selector' => '{{WRAPPER}} .df-box-time:before'
      )
    );

    $this->add_responsive_control(
      'timeline_circle_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-box-time:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_date_style',
      array(
        'label' => esc_html__('Date Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('date_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-box-time' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'date_typography',
        'selector' => '{{WRAPPER}} .df-box-time',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'date_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-box-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_navigational_arrows',
      array(
        'label' => esc_html__('Navigational Arrows', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('left_icon_arrow', 
      array(
        'label'     => esc_html__('Left Icon', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::CHOOSE,
        'options' => array(
          'left_arrow_bold' => array(
            'icon'  => 'fa fa-arrow-left',
          ),
          'left_arrow_long' => array(
            'icon'  => 'fa fa-long-arrow-left',
          ),
          'left_arrow_long_circle' => array(
            'icon'  => 'fa fa-arrow-circle-left',
          ),
          'left_arrow_angle' => array(
            'icon' => 'fa fa-angle-left',
          ),
          'left_arrow_chevron' => array(
            'icon' => 'fa fa-chevron-left',
          )
        ),
        'default'   => 'left_arrow_angle',
      )
    );

    $this->add_control('right_icon_arrow', 
      array(
        'label'     => esc_html__('Right Icon', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::CHOOSE,
        'options' => array(
          'right_arrow_bold' => array(
            'icon'  => 'fa fa-arrow-right',
          ),
          'right_arrow_long' => array(
            'icon'  => 'fa fa-long-arrow-right',
          ),
          'right_arrow_long_circle' => array(
            'icon'  => 'fa fa-arrow-circle-right',
          ),
          'right_arrow_angle' => array(
            'icon' => 'fa fa-angle-right',
          ),
          'right_arrow_chevron' => array(
            'icon' => 'fa fa-chevron-right',
          )
        ),
        'default'   => 'right_arrow_angle',
      )
    );

    $this->add_responsive_control(
      'size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust circle width & height.', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 5,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'circle_icon_size',
      array(
        'label'       => esc_html__('Icon Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust icon size.', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 5,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'circle_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->start_controls_tabs('circle_style');

    $this->start_controls_tab(
      'circle_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('circle_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('circle_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'circle_border',
        'selector' => '{{WRAPPER}} .swipe-arrow i'
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'circle_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('circle_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i:hover' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('circle_icon_hover_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'circle_hover_border',
        'selector' => '{{WRAPPER}} .swipe-arrow i:hover'
      )
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();


  }

  protected function render() { 
    $settings = $this->get_settings_for_display();
    $plans            = $settings['plans'];
    $autoplay         = $settings['autoplay'];
    $loop             = $settings['loop'];
    $speed            = $settings['speed'];
    $right_icon_arrow = $settings['right_icon_arrow'];
    $left_icon_arrow  = $settings['left_icon_arrow'];
    $arrows           = $settings['arrows'];
    $lg_slide         = $settings['lg_slide'];
    $md_slide         = $settings['md_slide'];
    $xs_slide         = $settings['xs_slide'];
    $loop             = ($loop == 'yes') ? 1:0;
    $autoplay         = ($autoplay == 'yes') ? 1:0;

    switch ($right_icon_arrow) {
      case 'right_arrow_bold':
        $right_arrow_icon = 'fa fa-arrow-right';
        break;

      case 'right_arrow_long':
        $right_arrow_icon = 'fa fa-long-arrow-right';
        break;

      case 'right_arrow_long_circle':
        $right_arrow_icon = 'fa fa-arrow-circle-right';
        break;      

      case 'right_arrow_chevron':
        $right_arrow_icon = 'fa fa-chevron-right';
        break;

      case 'right_arrow_angle':
      default:
        $right_arrow_icon = 'fa fa-angle-right';
        break;
    }

    switch ($left_icon_arrow) {
      case 'left_arrow_bold':
        $left_arrow_icon = 'fa fa-arrow-left';
        break;

      case 'left_arrow_long':
        $left_arrow_icon = 'fa fa-long-arrow-left';
        break;

      case 'left_arrow_long_circle':
        $left_arrow_icon = 'fa fa-arrow-circle-left';
        break;      

      case 'left_arrow_chevron':
        $left_arrow_icon = 'fa fa-chevron-left';
        break;

      case 'left_arrow_angle':
      default:
        $left_arrow_icon = 'fa fa-angle-left';
        break;

    } 

    if(is_array($plans) && !empty($plans)):

  ?>

    <div class="df-arrow-closest df-poind-closest df-slider df-style1 df-roadmap df-color1">
      <div class="df-overflow-hidden">
        <div class="df-swiper-inner-pad-wrap">
          <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="<?php echo esc_attr($xs_slide); ?>" data-sm-slides="2" data-md-slides="<?php echo esc_attr($md_slide); ?>" data-lg-slides="<?php echo esc_attr($lg_slide); ?>" data-add-slides="<?php echo esc_attr($lg_slide); ?>">
            <div class="slick-wrapper">

              <?php foreach($plans as $plan): ?>
                <div class="slick-slide-in">
                  <div class="df-swiper-inner-pad">
                    <div class="df-icon-box df-style2 text-center">
                      <div class="df-icon df-ilb df-f32-lg df-mb10"><?php Icons_Manager::render_icon($plan['selected_icon'], ['aria-hidden' => 'true']); ?></div>
                      <h3 class="df-f18-lg df-roadmap-title df-font-name df-mb8 df-font-name"><?php echo esc_html($plan['title']); ?></h3>
                      <div class="df-roadmap-content df-description-text df-mb4"><?php echo wp_kses_post($plan['description']); ?></div>
                      <div class="empty-space marg-lg-b30"></div>
                      <div class="df-box-time"><?php echo esc_html($plan['date']); ?></div>
                    </div>
                  </div>
                </div><!-- .slick-slide-in -->
              <?php endforeach; ?>

            </div>
          </div><!-- .slick-container -->
        </div>
      </div>
      <div class="pagination df-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
      <div class="swipe-arrow df-style1 <?php echo ($arrows == 'yes') ? 'df-has-arrow':'hidden'; ?>"> <!-- If dont need navigation then add class .df-hidden -->
        <div class="slick-arrow-left"><i class="<?php echo esc_attr($left_arrow_icon); ?>"></i></div>
        <div class="slick-arrow-right"><i class="<?php echo esc_attr($right_arrow_icon); ?>"></i></div>
      </div>
    </div><!-- .df-carousor -->

  <?php endif;
    
  }

}
