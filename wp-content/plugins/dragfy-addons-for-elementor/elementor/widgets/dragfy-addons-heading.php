<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
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
class Dragfy_Addons_Heading extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-heading';
  }

  public function get_title() {
    return 'Heading';
  }

  public function get_icon() {
    return 'elem_icon heading';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('dragfy-addons', 'heading');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'heading_general_settings',
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
          'style1' => 'Style 1',
          'style2' => 'Style 2',
          'style3' => 'Style 3',
          'style4' => 'Style 4',
          'style5' => 'Style 5',
          'style6' => 'Style 6',
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'heading_icon_settings',
      array(
        'label'     => esc_html__('Icon Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style4')),
      )
    );

    $this->add_control(
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

    $this->end_controls_section();

    $this->start_controls_section(
      'section_heading_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'small_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => esc_html__('Modular System', 'dragfy-addons-for-elementor'),
        'condition'   => array('style' => array('style2')),       
      )
    );

    $this->add_control(
      'big_heading',
      array(
        'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => esc_html__('Level up your site with great-looking widgets.', 'dragfy-addons-for-elementor'),
        'dynamic' => array(
          'active' => true,
        ),       
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::WYSIWYG,
        'label_block' => true,
        'default'     => esc_html__('Everyone wants a visually appealing site. Dragfy addon for Elementor does extactly that. All widgets are extremely customizable and created to perfection.', 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style3', 'style4')),       
        'dynamic' => array(
          'active' => true,
        ),       
      )
    );

    $this->add_responsive_control(
      'align',
      array(
        'label' => esc_html__( 'Alignment', 'dragfy-addons-for-elementor' ),
        'type' => Controls_Manager::CHOOSE,
        'condition' => array('style!' => array('style4', 'style5', 'style6')),
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
        'default'   => 'center',
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading' => 'text-align: {{VALUE}};',
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

    $this->start_controls_section('section_style_small_heading',
      array(
        'label'     => esc_html__('Sub Heading Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2')),
      )
    );

    $this->add_control('small_heading_backgound_style', 
      array(
        'label'       => esc_html__('Background Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'options'     => array(
          'color'   => esc_html__('Normal Background'),
          'clipped' => esc_html__('Clipped Background'),
        ),
        'default' => 'color'
      )
    );

    $this->add_control('small_heading_color', 
      array(
        'label'     => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('small_heading_backgound_style' => 'color'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('small_heading_stroke', 
      array(
        'label'     => esc_html__('Stroke', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'condition' => array('small_heading_backgound_style' => 'clipped'),
      )
    );

    $this->add_control('small_heading_stroke_text_color', 
      array(
        'label'     => esc_html__('Stroke Text Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('small_heading_backgound_style' => 'clipped', 'small_heading_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading.df-clip.df-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('small_heading_stroke_fill_color', 
      array(
        'label'     => esc_html__('Stroke Fill Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('small_heading_backgound_style' => 'clipped', 'small_heading_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading.df-stroke' => '-webkit-text-fill-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('small_heading_stroke_fill_width', 
      array(
        'label'     => esc_html__('Stroke Fill Width', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SLIDER,
        'condition' => array('small_heading_backgound_style' => 'clipped', 'small_heading_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading.df-stroke' => '-webkit-text-stroke-width: {{SIZE}}px;',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'small_heading_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-section-heading .df-small-heading',
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'      => 'small_heading_typography',
        'selector'  => '{{WRAPPER}} .df-section-heading .df-small-heading',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'small_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'small_heading_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'small_heading_border',
        'selector' => '{{WRAPPER}} .df-section-heading .df-small-heading'
      )
    );

    $this->add_responsive_control(
      'small_heading_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-small-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_big_heading',
      array(
        'label' => esc_html__('Heading Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('big_heading_backgound_style', 
      array(
        'label'       => esc_html__('Background Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'options'     => array(
          'color'   => esc_html__('Normal Background'),
          'clipped' => esc_html__('Clipped Background'),
        ),
        'default' => 'color'
      )
    );

    $this->add_control('big_heading_color', 
      array(
        'label'     => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('big_heading_backgound_style' => 'color'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('big_heading_stroke', 
      array(
        'label'     => esc_html__('Stroke', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'condition' => array('big_heading_backgound_style' => 'clipped'),
      )
    );

    $this->add_control('big_heading_stroke_text_color', 
      array(
        'label'     => esc_html__('Stroke Text Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('big_heading_backgound_style' => 'clipped', 'big_heading_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading.df-clip.df-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('big_heading_stroke_fill_color', 
      array(
        'label'     => esc_html__('Stroke Fill Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('big_heading_backgound_style' => 'clipped', 'big_heading_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading.df-stroke' => '-webkit-text-fill-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('big_heading_stroke_fill_width', 
      array(
        'label'     => esc_html__('Stroke Fill Width', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SLIDER,
        'condition' => array('big_heading_backgound_style' => 'clipped', 'big_heading_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading.df-stroke' => '-webkit-text-stroke-width: {{SIZE}}px;',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'big_heading_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-section-heading .df-big-heading',
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'      => 'big_heading_typography',
        'selector'  => '{{WRAPPER}} .df-section-heading .df-big-heading',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'big_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'big_heading_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'big_heading_border',
        'condition' => array('style!' => array('style4', 'style5', 'style6')),
        'selector' => '{{WRAPPER}} .df-section-heading .df-big-heading'
      )
    );

    $this->add_responsive_control(
      'big_heading_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'condition' => array('style!' => array('style4', 'style5', 'style6')),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading .df-big-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_control('big_heading_primary_border_color', 
      array(
        'label'     => esc_html__('Primary Border Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('style' => array('style4', 'style5', 'style6')),
        'selectors' => array(
          '{{WRAPPER}} .df-section-divider .df-left, {{WRAPPER}} .df-section-divider .df-right, {{WRAPPER}} .df-heading-double-border:before, {{WRAPPER}} .df-heading-double-border:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('big_heading_secondary_border_color', 
      array(
        'label'     => esc_html__('Secondary Border Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('style' => array('style5', 'style6')),
        'selectors' => array(
          '{{WRAPPER}} .df-section-heading.df-style5 .df-section-heading-title span:before' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('big_heading_bottom_icon_color', 
      array(
        'label'     => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('style' => array('style4')),
        'selectors' => array(
          '{{WRAPPER}} .df-section-divider-icon' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_description',
      array(
        'label'     => esc_html__('Description Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style3', 'style4')),
      )
    );

    $this->add_control('description_backgound_style', 
      array(
        'label'       => esc_html__('Background Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'options'     => array(
          'color'   => esc_html__('Normal Background'),
          'clipped' => esc_html__('Clipped Background'),
        ),
        'default' => 'color'
      )
    );

    $this->add_control('description_color', 
      array(
        'label'     => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('description_backgound_style' => 'color'),
        'selectors' => array(
          '{{WRAPPER}} .df-description' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('description_stroke', 
      array(
        'label'     => esc_html__('Stroke', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'condition' => array('description_backgound_style' => 'clipped'),
      )
    );

    $this->add_control('description_stroke_text_color', 
      array(
        'label'     => esc_html__('Stroke Text Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('description_backgound_style' => 'clipped', 'description_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-description.df-clip.df-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('description_stroke_fill_color', 
      array(
        'label'     => esc_html__('Stroke Fill Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('description_backgound_style' => 'clipped', 'description_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-description.df-stroke' => '-webkit-text-fill-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('description_stroke_fill_width', 
      array(
        'label'     => esc_html__('Stroke Fill Width', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SLIDER,
        'condition' => array('description_backgound_style' => 'clipped', 'description_stroke' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} .df-description.df-stroke' => '-webkit-text-stroke-width: {{SIZE}}px;',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'description_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-description',
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'      => 'description_typography',
        'selector'  => '{{WRAPPER}} .df-description',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'description_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'description_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'description_border',
        'selector' => '{{WRAPPER}} .df-description'
      )
    );

    $this->add_responsive_control(
      'description_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings                      = $this->get_settings();
    $style                         = $settings['style'];
    $selected_icon                 = $settings['selected_icon'];
    $small_heading                 = $settings['small_heading'];
    $big_heading                   = $settings['big_heading'];
    $description                   = $settings['description'];
    $small_heading_backgound_style = $settings['small_heading_backgound_style'];
    $small_heading_stroke          = $settings['small_heading_stroke'];
    $big_heading_backgound_style   = $settings['big_heading_backgound_style'];
    $big_heading_stroke            = $settings['big_heading_stroke'];
    $description_backgound_style   = $settings['description_backgound_style'];
    $description_stroke            = $settings['description_stroke'];

    $small_heading_stroke     = ($small_heading_stroke == 'yes') ? ' df-stroke':'';
    $small_heading_background = ($small_heading_backgound_style == 'clipped') ? ' df-clip':'';
    $big_heading_stroke       = ($big_heading_stroke == 'yes') ? ' df-stroke':'';
    $big_heading_background   = ($big_heading_backgound_style == 'clipped') ? ' df-clip':'';
    $description_stroke       = ($description_stroke == 'yes') ? ' df-stroke':'';
    $description_background   = ($description_backgound_style == 'clipped') ? ' df-clip':'';

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="df-section-heading">
          <h2 class="df-f32-lg df-f28-sm df-big-heading df-font-name df-mt-5 df-mb-8 df-mb-6-sm<?php echo esc_attr($big_heading_stroke); ?><?php echo esc_attr($big_heading_background); ?>"><?php echo wp_kses_post($big_heading); ?></h2>
        </div>
      
      <?php  
      break;

      case 'style2': ?>

        <div class="df-section-heading df-style2"> 
          <?php if(!empty($small_heading)): ?>
            <div class="df-f16-lg df-ilb df-small-heading df-mt-4<?php echo esc_attr($small_heading_stroke); ?><?php echo esc_attr($small_heading_background); ?>"><?php echo wp_kses_post($small_heading); ?></div>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($big_heading)): ?>
            <h2 class="df-f32-lg df-f25-sm df-big-heading df-font-name df-m0<?php echo esc_attr($big_heading_stroke); ?><?php echo esc_attr($big_heading_background); ?>"><?php echo wp_kses_post($big_heading); ?></h2>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style3': ?>

        <div class="df-section-heading df-style2">
          <?php if(!empty($big_heading)): ?>
            <h2 class="df-fw-medium df-big-heading df-ilb df-f36-lg df-f30-sm df-mt-5 df-mt-3-sm df-m0 df-line1-2<?php echo esc_attr($big_heading_stroke); ?><?php echo esc_attr($big_heading_background); ?>"><?php echo wp_kses_post($big_heading); ?></h2>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-f16-lg df-f14-sm df-line1-6 df-mb-7 df-line1-6 <?php echo esc_attr($description_stroke); ?><?php echo esc_attr($description_background); ?> df-description df-mb-7"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="df-section-heading df-style4">
          <?php if(!empty($big_heading)): ?>
          <h2 class="df-section-heading-title df-ilb df-big-heading df-f32-lg df-f25-sm df-m0<?php echo esc_attr($big_heading_stroke); ?><?php echo esc_attr($big_heading_background); ?>"><?php echo wp_kses_post($big_heading); ?></h2>
            <div class="df-section-divider">
              <div class="df-left"></div>
              <div class="df-section-divider-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
              <div class="df-right"></div>
            </div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-section-heading-subtitle <?php echo esc_attr($description_stroke); ?><?php echo esc_attr($description_background); ?> df-description df-f16-lg df-f14-sm df-line1-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style5': ?>
        <div class="df-section-heading df-style5">
          <h2 class="df-section-heading-title df-heading-double-border df-big-heading df-f32-lg df-f25-sm df-m0<?php echo esc_attr($big_heading_stroke); ?><?php echo esc_attr($big_heading_background); ?>"><span><?php echo wp_kses_post($big_heading); ?></span></h2>
        </div>
        <?php
        # code...
        break;

      case 'style6': ?>
        <div class="df-section-heading df-style5 df-type1">
          <h2 class="df-section-heading-title df-heading-double-border df-big-heading df-f32-lg df-f25-sm df-m0<?php echo esc_attr($big_heading_stroke); ?><?php echo esc_attr($big_heading_background); ?>"><span><?php echo wp_kses_post($big_heading); ?></span></h2>
        </div>
        <?php
        # code...
        break;
    }
  }


}
