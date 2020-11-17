<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
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
class Dragfy_Addons_Testimonial extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-testimonial';
  }

  public function get_title() {
    return 'Testimonial';
  }

  public function get_icon() {
    return 'elem_icon testimonial';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('dragfy-addons', 'testimonial');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'testimonial_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
          'style2' => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
          'style3' => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
          'style4' => esc_html__('Style 4', 'dragfy-addons-for-elementor'),
          'style5' => esc_html__('Style 5', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_avatar_settings',
      array(
        'label' => esc_html__('Avatar Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'avatar',
      array(
        'label'       => esc_html__('Avatar', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'name',
      array(
        'label'       => esc_html__('Name', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('John Doe', 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'position',
      array(
        'label'       => esc_html__('Position', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Themeforest Author', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::WYSIWYG,
        'default'     => esc_html__('Add testimonial description here. Edit and place your own text.', 'dragfy-addons-for-elementor'),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label'     => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-testimonial',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-testimonial'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_control('horizonal_line_color', 
      array(
        'label'     => esc_html__('Horizontal Line Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('style' => array('style1', 'style2')),
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial hr' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-testimonial',
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_avatar_style',
      array(
        'label'     => esc_html__('Avatar Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'avatar_size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default'    => array('unit' => 'px', 'size' => 50),
        'selectors' => array(
          '{{WRAPPER}} .df-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'avatar_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'avatar_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'avatar_border',
        'selector' => '{{WRAPPER}} .df-avatar'
      )
    );

    $this->add_responsive_control(
      'avatar_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_name_style',
      array(
        'label'     => esc_html__('Name Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('name_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial-name' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'name_typography',
        'selector' => '{{WRAPPER}} .df-testimonial-name',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'name_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_position_style',
      array(
        'label'     => esc_html__('Position Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('position_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial-position' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'position_typography',
        'selector' => '{{WRAPPER}} .df-testimonial-position',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'position_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_description_style',
      array(
        'label'     => esc_html__('Description Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-testimonial-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .df-testimonial-text',
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
          '{{WRAPPER}} .df-testimonial-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_section();


  }

  protected function render() { 

    $settings    = $this->get_settings();
    $style       = $settings['style'];
    $avatar      = $settings['avatar'];
    $name        = $settings['name'];
    $description = $settings['description'];
    $position    = $settings['position'];


    switch ($style) {
      case 'style1':
      default: ?>
        <div class="df-testimonial df-testimonial-bg df-style2 df-border df-radious-4">
          <div class="df-testimonial-text df-f16-lg df-line1-69 "><?php echo wp_kses_post($description); ?></div>
          <hr>
          <div class="df-testimonial-meta text-center">
            <?php if(!empty($avatar) && is_array($avatar) && !empty($avatar['url'])): ?>
              <img class="df-radious-50 df-avatar" src="<?php echo esc_url($avatar['url']); ?>" alt="avatar">
            <?php endif; ?>
            <div class="empty-space marg-lg-b15"></div>
            <h3 class="df-f16-lg df-testimonial-name df-font-name df-m0 df-mt-2"><?php echo esc_html($name); ?></h3>
            <div class="df-mb-6 df-testimonial-position"><?php echo esc_html($position); ?></div>
            <div class="empty-space marg-lg-b30"></div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="df-testimonial df-testimonial-bg df-style3 df-border df-radious-4">
          <div class="df-testimonial-text df-f16-lg df-line1-69 "><?php echo wp_kses_post($description); ?></div>
          <hr>
          <div class="df-testimonial-meta">
            <?php if(!empty($avatar) && is_array($avatar) && !empty($avatar['url'])): ?>
              <img class="df-radious-50 df-avatar" src="<?php echo esc_url($avatar['url']); ?>" alt="avatar">
            <?php endif; ?>
            <h3 class="df-f18-lg df-testimonial-name df-font-name df-font-name df-m0 df-mt-3 df-mb-2"><?php echo esc_html($name); ?></h3>
            <div class="df-mb-6 df-testimonial-position"><?php echo esc_html($position); ?></div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="df-testimonial df-testimonial-bg df-style5">
          <div class="df-testimonial-text df-f16-lg df-line1-6  df-mb-7"><?php echo wp_kses_post($description); ?></div>
          <div class="empty-space marg-lg-b30"></div>
          <div class="df-testimonial-meta">
            <?php if(!empty($avatar) && is_array($avatar) && !empty($avatar['url'])): ?>
              <img class="df-radious-50 df-avatar" src="<?php echo esc_url($avatar['url']); ?>" alt="avatar">
            <?php endif; ?>
            <h3 class="df-f16-lg df-testimonial-name df-m0 df-mt-3"><?php echo esc_html($name); ?></h3>
            <?php if(!empty($position)): ?>
              <div class="df-mb-6 df-testimonial-position"><?php echo esc_html($position); ?></div>
            <?php endif; ?>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="df-testimonial df-testimonial-bg df-style4 df-border text-center">
          <?php if(!empty($avatar) && is_array($avatar) && !empty($avatar['url'])): ?>
            <img class="df-radious-50 df-avatar" src="<?php echo esc_url($avatar['url']); ?>" alt="avatar">
          <?php endif; ?>
          <div class="empty-space marg-lg-b20"></div>
          <div class="df-testimonial-text df-f16-lg df-line1-75  df-mb2"><?php echo wp_kses_post($description); ?></div>
          <div class="df-testimonial-meta text-center">
            <div class="empty-space marg-lg-b20"></div>
            <h3 class="df-f16-lg df-testimonial-name df-font-name df-m0 df-mt-3"><?php echo esc_html($name); ?></h3>
            <div class="df-mb-6 df-f14-lg df-testimonial-position"><?php echo esc_html($position); ?></div>
            <div class="empty-space marg-lg-b40"></div>
          </div>
        </div>
        <?php
        # code...
        break;
      case 'style5': ?>
        <div class="df-testimonial df-style7">
          <div class="df-testimonial-text df-testimonial-bg df-051e31-c df-line1-6"><?php echo wp_kses_post($description); ?></div>
          <div class="df-testimonial-info">
            <?php if(!empty($avatar) && is_array($avatar) && !empty($avatar['url'])): ?>
              <div class="df-avatar-img"><img class="df-avatar" src="<?php echo esc_url($avatar['url']); ?>" alt="avatar"></div>
            <?php endif; ?>
            <div class="df-testimonial-meta">
              <h3 class="df-fw-medium df-avator-name df-testimonial-name df-051e31-c df-line1-2"><?php echo esc_html($name); ?></h3>
              <div class="df-avatar-designation df-testimonial-position df-051e31-c df-line1-6"><?php echo esc_html($position); ?></div>
            </div>
          </div>
        </div>
        <?php
        break;
      
    }
  }
}
