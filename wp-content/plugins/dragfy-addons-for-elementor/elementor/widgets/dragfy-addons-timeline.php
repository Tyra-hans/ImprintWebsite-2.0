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
class Dragfy_Addons_Timeline extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-timeline';
  }

  public function get_title() {
    return 'Timeline';
  }

  public function get_icon() {
    return 'elem_icon timeline';
  }

  public function get_script_depends() {
    return array('dragfy-addons');
  }

  public function get_style_depends() {
    return array('timeline', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'timeline_general_settings',
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
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'timeline_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'date',
      array(
        'label'       => esc_html__('Date', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('December 2015', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Your Heading', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::WYSIWYG
      )
    );

    $repeater->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#')
      )
    );


    $this->add_control(
      'items',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'date'    => esc_html__('December 2017', 'dragfy-addons-for-elementor'),
            'heading' => esc_html__('Your Heading', 'dragfy-addons-for-elementor'),
            'content' => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
          ),
          array(
            'date'    => esc_html__('December 2017', 'dragfy-addons-for-elementor'),
            'heading' => esc_html__('Your Heading', 'dragfy-addons-for-elementor'),
            'content' => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
          ),
          array(
            'date'    => esc_html__('December 2017', 'dragfy-addons-for-elementor'),
            'heading' => esc_html__('Your Heading', 'dragfy-addons-for-elementor'),
            'content' => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
          ),
          array(
            'date'    => esc_html__('December 2017', 'dragfy-addons-for-elementor'),
            'heading' => esc_html__('Your Heading', 'dragfy-addons-for-elementor'),
            'content' => esc_html__('Coming up with the genius idea and forming up the business', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ heading }}</span>',
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
        'selector'  => '{{WRAPPER}} .df-timeline-post, {{WRAPPER}} .df-timeline-post.df-style1:before',
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_control('border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-post, {{WRAPPER}} .df-timeline-post.df-style1:before' => 'border-color: {{VALUE}};',
        ),
      )
    );


    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-timeline-post',
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
          '{{WRAPPER}} .df-timeline-post-date' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'date_typography',
        'selector' => '{{WRAPPER}} .df-timeline-post-date',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_heading_style',
      array(
        'label' => esc_html__('Heading Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-post-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .df-timeline-post-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_content_style',
      array(
        'label' => esc_html__('Content Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-post-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .df-timeline-post-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_connector_style',
      array(
        'label' => esc_html__('Connector Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control(
      'connector_selected_icon',
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

    $this->add_control('connector_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-icon i'   => 'color: {{VALUE}};',
          '{{WRAPPER}} .df-timeline-icon svg' => 'fill: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'icon_size',
      array(
        'label'       => esc_html__('Icon Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 60,
            'step' => 1,
          ),
        ),
        'default' => array('unit' => 'px', 'size' => 18),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-icon' => 'font-size: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .df-timeline-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_control('connector_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-icon' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->start_controls_tabs('connector_line_style');

    $this->start_controls_tab(
      'connector_line_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('connector_line_color', 
      array(
        'label'       => esc_html__('Line Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-bar' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'connector_line_style_focused',
      array(
        'label' => esc_html__('Focused', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('connector_line_color_focused', 
      array(
        'label'       => esc_html__('Line Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-timeline-bar-in' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();
    
  }

  protected function render() { 
    $settings                = $this->get_settings_for_display();
    $style                   = $settings['style'];
    $connector_selected_icon = $settings['connector_selected_icon'];
    $items                   = $settings['items'];

    if(is_array($items) && !empty($items)):
      switch ($style) {
        case 'style1': 
        default: ?>
          <div class="df-timeline-wrap df-style1">

            <?php foreach($items as $item): ?>
              <div class="df-timeline-post df-style1">
                <div class="df-timeline-icon"><?php Icons_Manager::render_icon($connector_selected_icon, ['aria-hidden' => 'true']); ?></div>
                <div class="df-timeline-post-date"><?php echo esc_html($item['date']); ?></div>
                <h2 class="df-timeline-post-title"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>"><?php echo esc_html($item['heading']); ?></a></h2>
                <div class="df-timeline-post-text"><?php echo wp_kses_post($item['content']); ?></div>
              </div><!-- .df-timeline-post -->
            <?php endforeach; ?>
            <div class="df-timeline-bar df-horizontal-parallax"><div class="df-timeline-bar-in"></div></div>
          <?php
          # code...
          break;

        case 'style2': ?>
          <div class="df-timeline-wrap df-style2">

            <?php 
              foreach($items as $item): 
                $href   = (!empty($item['link_url']['url']) ) ? $item['link_url']['url'] : '#';
                $target = ($item['link_url']['is_external'] == 'on') ? '_blank' : '_self';
              ?>
              <div class="df-timeline-post df-style1">
                <div class="df-timeline-icon"><?php Icons_Manager::render_icon($connector_selected_icon, ['aria-hidden' => 'true']); ?></div>
                <div class="df-timeline-post-date"><?php echo esc_html($item['date']); ?></div>
                <h2 class="df-timeline-post-title"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>"><?php echo esc_html($item['heading']); ?></a></h2>
                <div class="df-timeline-post-text"><?php echo wp_kses_post($item['content']); ?></div>
              </div><!-- .df-timeline-post -->
            <?php endforeach; ?>
            <div class="df-timeline-bar df-horizontal-parallax"><div class="df-timeline-bar-in"></div></div>
          <?php
          break;

        case 'style3': ?>
          <div class="df-timeline-wrap df-style3">

            <?php foreach($items as $item): ?>
              <div class="df-timeline-post df-style1">
                <div class="df-timeline-icon"><?php Icons_Manager::render_icon($connector_selected_icon, ['aria-hidden' => 'true']); ?></div>
                <div class="df-timeline-post-date"><?php echo esc_html($item['date']); ?></div>
                <h2 class="df-timeline-post-title"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>"><?php echo esc_html($item['heading']); ?></a></h2>
                <div class="df-timeline-post-text"><?php echo wp_kses_post($item['content']); ?></div>
              </div><!-- .df-timeline-post -->
            <?php endforeach; ?>
            <div class="df-timeline-bar df-horizontal-parallax"><div class="df-timeline-bar-in"></div></div>
          <?php
          break;
        
      }

    endif;

    
  }

}
