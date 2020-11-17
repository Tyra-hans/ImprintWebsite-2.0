<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
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
class Dragfy_Addons_Info_Card extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-info-card';
  }

  public function get_title() {
    return 'Info Card';
  }

  public function get_icon() {
    return 'elem_icon info_card';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('info-card', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {

    $this->start_controls_section(
      'info_card_general_settings',
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
      'info_card_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'condition'   => array('style' => array('style2')),
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Join the Community', 'dragfy-addons-for-elementor')       
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::WYSIWYG,
        'label_block' => true,
        'default'     => esc_html__('Bring to the table win-win survival way to ensure proactive domination.', 'dragfy-addons-for-elementor'),      
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'info_card_link_settings',
      array(
        'label' => esc_html__('Link Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'dragfy-addons-for-elementor'),
        'default'     => esc_html('Learn More', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#')
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
        'selector'  => '{{WRAPPER}} .df-contact-card',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-contact-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-contact-card'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-contact-card',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_title_color',
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
          '{{WRAPPER}} .df-info-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-info-title',
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
          '{{WRAPPER}} .df-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_description_color',
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
          '{{WRAPPER}} .df-info-content' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .df-info-content',
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
          '{{WRAPPER}} .df-info-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_link_style',
      array(
        'label' => esc_html__('Link Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'link_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'condition'   => array('style' => array('style1')),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'link_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'link_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'condition'   => array('style' => array('style1')),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->start_controls_tabs('link_style');

    $this->start_controls_tab(
      'link_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('link_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition'   => array('style' => array('style1')),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer' => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .df-link-text:before'    => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer, {{WRAPPER}} .df-link-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'link_typography',
        'selector' => '{{WRAPPER}} .df-contact-card-footer, {{WRAPPER}} .df-link-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'link_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style1')),
        'selector'  => '{{WRAPPER}} .df-contact-card-footer',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'link_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('link_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition'   => array('style' => array('style1')),
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_hover_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer:hover' => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .df-link-text:after'    => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_text_hover_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-contact-card-footer:hover, {{WRAPPER}} .df-link-text:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'link_hover_typography',
        'selector' => '{{WRAPPER}} .df-contact-card-footer:hover, {{WRAPPER}} .df-link-text:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'link_hover_box_shadow',
        'condition' => array('style' => array('style1')),
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-contact-card-footer:hover',
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();




  }

  protected function render() { 
    $settings  = $this->get_settings();
    $style     = $settings['style'];
    $link_url  = $settings['link_url'];
    $link_text = $settings['link_text'];
    $image     = $settings['image'];
    $href      = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $target    = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1': default: ?>
        <div class="df-contact-card df-style1 df-border df-radious-4 text-center">
          <div class="df-contact-card-body">
            <h2 class="df-contact-card-title df-info-title df-f18-lg"><?php echo esc_html($settings['title']); ?></h2>
            <div class="df-info-content"><?php echo wp_kses_post($settings['description']); ?> </div>
          </div>
          <?php if(!empty($link_text)): ?>
            <div class="df-contact-card-footer df-flex">
              <a href="<?php echo esc_url($href); ?>" class="df-info-link" target="<?php echo esc_attr($target); ?>"><?php echo esc_html($link_text); ?></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

    case 'style2': ?>
      <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
        <div class="df-contact-card df-style2" style="background-image: url(<?php echo esc_url($image['url']); ?>);">
          <div class="df-contact-card-body">
            <h2 class="df-contact-card-title df-info-title df-f18-lg"><?php echo esc_html($settings['title']); ?></h2>
            <div class="df-info-content">
              <p><?php echo wp_kses_post($settings['description']); ?> </p>
            </div>
          </div>
          <?php if(!empty($link_text)): ?>
            <div class="df-contact-card-footer">
              <a href="<?php echo esc_url($href); ?>" class="df-info-link df-link-text" target="<?php echo esc_attr($target); ?>"><?php echo esc_html($link_text); ?></a>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php
      # code...
      break;

    case 'style3': ?>
      <div class="df-contact-card df-style3 df-border">
        <div class="df-contact-card-body">
          <h2 class="df-contact-card-title df-info-title df-f18-lg"><?php echo esc_html($settings['title']); ?></h2>
          <div class="df-info-content">
            <p><?php echo wp_kses_post($settings['description']); ?></p>
          </div>
        </div>
        <div class="df-contact-card-footer">
          <a href="<?php echo esc_url($href); ?>" class="df-info-link df-link-text" target="<?php echo esc_attr($target); ?>"><?php echo esc_html($link_text); ?></a>
        </div>
      </div>
      <?php
      break;

    }
    
  }
}
