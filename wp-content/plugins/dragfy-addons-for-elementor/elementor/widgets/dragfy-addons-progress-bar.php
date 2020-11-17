<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
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
class Dragfy_Addons_Progress_Bar extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-progress-bar';
  }

  public function get_title() {
    return 'Progress Bar';
  }

  public function get_icon() {
    return 'elem_icon progress_bar';
  }

  public function get_script_depends() {
    return array('dragfy-addons');
  }

  public function get_style_depends() {
    return array('progressbar', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'progress_bar_genreal_settings',
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
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
      )
    );

    $this->add_responsive_control(
      'max_width',
      array(
        'label'       => esc_html__('Max Width', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 1200,
            'step' => 5,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar' => 'max-width: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'progress_bar_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('Development', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('150M', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'value',
      array(
        'label'       => esc_html__('Value', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('90', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'progress_bars',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'title'   => esc_html__('Development', 'dragfy-addons-for-elementor'),
            'label'   => esc_html__('150M', 'dragfy-addons-for-elementor'),
            'value'   => esc_html__('90', 'dragfy-addons-for-elementor'),
          ),
          array(
            'title'   => esc_html__('Profit', 'dragfy-addons-for-elementor'),
            'label'   => esc_html__('20B', 'dragfy-addons-for-elementor'),
            'value'   => esc_html__('40', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ title }} - {{ value }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_progress_bar_general_style',
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
        'selector'  => '{{WRAPPER}} .df-progressbar',
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-progressbar'
      )
    );

    $this->add_responsive_control(
      'progress_bar_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'progress_bar_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-progressbar',
      )
    );

    $this->add_responsive_control(
      'progress_bar_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_progress_bar_background_style',
      array(
        'label' => esc_html__('Background Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'progress_bar_bg',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-progressbar.df-style1 .df-single-bar',
      )
    );

    $this->add_responsive_control(
      'progress_bar_bg_height',
      array(
        'label'       => esc_html__('Height', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar.df-style1 .df-single-bar' => 'height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'progress_bar_bg_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar.df-style1 .df-single-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_progress_fill_style',
      array(
        'label' => esc_html__('Fill Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'progress_bar_fill',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-progressbar.df-style1 .df-single-bar-in',
      )
    );

    $this->add_responsive_control(
      'progress_bar_fill_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar.df-style1 .df-single-bar-in' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_label_style',
      array(
        'label'     => esc_html__('Label Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1'))
      )
    );

    $this->add_control('label_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar-label' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'label_typography',
        'selector' => '{{WRAPPER}} .df-progressbar-label',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'label_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-progressbar-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-progressbar-title',
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
          '{{WRAPPER}} .df-progressbar-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_value_style',
      array(
        'label'     => esc_html__('Value Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2'))
      )
    );

    $this->add_control('value_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar-value' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'value_typography',
        'selector' => '{{WRAPPER}} .df-progressbar-value',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'value_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-progressbar-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings      = $this->get_settings_for_display();
    $style         = $settings['style'];
    $progress_bars = $settings['progress_bars']; 

    if(is_array($progress_bars) && !empty($progress_bars)):


      switch ($style) {
        case 'style1':
        default: ?>
          <div class="df-box-shadow1 df-progressbar df-style1">

            <?php foreach($progress_bars as $bar): ?>

              <div class="df-single-progressbar">
                <div class="df-single-bar-title">
                  <span class="df-grayb5b5b5-c df-progressbar-title"><?php echo esc_html($bar['title']); ?></span>
                  <span class="df-progressbar-label"><?php echo esc_html($bar['label']); ?></span>
                </div>
                <div class="df-single-bar" data-progress-percentage="<?php echo esc_attr($bar['value']); ?>">
                  <div class="df-single-bar-in"></div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <?php
          # code...
          break;

        case 'style2': ?>
          <div class="df-progressbar df-style1 df-type1 df-color1 row">

            <?php foreach($progress_bars as $bar): ?>
              <div class="col-lg-6 df-single-progressbar">
                <h3 class="df-progressbar-number df-progressbar-value df-f36-lg df-line1-2 df-m0"><?php echo esc_attr($bar['value']); ?>%</h3>
                <div class="empty-space marg-lg-b10"></div>
                <div class="df-single-bar" data-progress-percentage="<?php echo esc_attr($bar['value']); ?>">
                  <div class="df-single-bar-in"></div>
                </div>
                <h2 class="df-single-bar-title df-progressbar-title df-line1-6 df-f14-lg"><?php echo esc_html($bar['title']); ?></h2>
              </div>
            <?php endforeach; ?>

          </div>
          <?php
          # code...
          break;
      
      }
    endif;
  }

}
