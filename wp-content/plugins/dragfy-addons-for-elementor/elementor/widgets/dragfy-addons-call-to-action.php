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
class Dragfy_Addons_Call_To_Action extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-cta';
  }

  public function get_title() {
    return 'Call to Action';
  }

  public function get_icon() {
    return 'elem_icon cta';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('cta', 'button', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'cta_general_settings',
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
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'cta_image_settings',
      array(
        'label'     => esc_html__('Image Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style2', 'style3')),
      )
    );

    $this->add_control(
      'obj_image',
      array(
        'label'     => esc_html__('Object Image', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::MEDIA,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'cta_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'condition'   => array('style' => array('style3')),
        'default'     => esc_html__('NEW', 'dragfy-addons-for-elementor'),
        'dynamic' => array(
          'active' => true,
        ),       
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => esc_html__('Power up your workflow with Dragfy.', 'dragfy-addons-for-elementor'),
        'dynamic' => array(
          'active' => true,
        ),       
      )
    );

    $this->add_control(
      'sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => esc_html__('30 days trial - Power up your workflow with dragfy toolkit', 'dragfy-addons-for-elementor'),
        'condition'   => array('style' => array('style1', 'style3')),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'cta_link_settings',
      array(
        'label'     => esc_html__('Link Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'dragfy-addons-for-elementor'),
        'default'     => esc_html('View Product', 'dragfy-addons-for-elementor'),
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

    $this->start_controls_section(
      'cta_btn_settings',
      array(
        'label' => esc_html__('Button Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style1', 'style2'))
      )
    );

    $this->add_control(
      'primary_btn_text',
      array(
        'label'       => esc_html__('Primary Button Text', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Primary Button Text', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'primary_btn_link',
      array(
        'label'       => esc_html__('Primary Button Link', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'secondary_btn_text',
      array(
        'label'       => esc_html__('Secondary Button Text', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Secondary Button Text', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'secondary_btn_link',
      array(
        'label'       => esc_html__('Secondary Button Link', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
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
        'selector'  => '{{WRAPPER}} .df-cta-wrap',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-cta-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-cta-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-cta-wrap'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-cta-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-cta-wrap',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_label',
      array(
        'label' => esc_html__('Label Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style3'))
      )
    );

    $this->add_control('label_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-cta-label' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('label_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-cta-label' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'label_typography',
        'selector' => '{{WRAPPER}} .df-cta-label',
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
          '{{WRAPPER}} .df-cta-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_style_heading',
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
          '{{WRAPPER}} .df-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .df-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'heading_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_sub_heading',
      array(
        'label'     => esc_html__('Sub Heading Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2', 'style3'))
      )
    );

    $this->add_control('sub_heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_heading_typography',
        'selector' => '{{WRAPPER}} .df-sub-heading',
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
          '{{WRAPPER}} .df-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_link_style',
      array(
        'label'     => esc_html__('Link Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style3'))
      )
    );

    $this->add_responsive_control(
      'link_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-cta-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

    $this->add_control('link_text_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-cta-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'link_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('link_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-cta-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_primary_button_style',
      array(
        'label' => esc_html__('Primary Button Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2'))
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'primary_btn_border',
        'selector' => '{{WRAPPER}} .df-btn.df-btn-primary'
      )
    );

    $this->add_responsive_control(
      'primary_btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'primary_btn_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'primary_btn_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'primary_btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn.df-btn-primary',
      )
    );


    $this->start_controls_tabs('primary_btn_style');

    $this->start_controls_tab(
      'primary_btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('primary_btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('primary_btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'primary_btn_typography',
        'selector' => '{{WRAPPER}} .df-btn.df-btn-primary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'primary_btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('primary_btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('primary_btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-primary:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'primary_btn_typography_hover',
        'selector' => '{{WRAPPER}} .df-btn.df-btn-primary:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();


    $this->end_controls_section();



    $this->start_controls_section('section_secondary_button_style',
      array(
        'label' => esc_html__('Secondary Button Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1'))
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'secondary_btn_border',
        'selector' => '{{WRAPPER}} .df-btn.df-btn-secondary'
      )
    );

    $this->add_responsive_control(
      'secondary_btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'secondary_btn_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'secondary_btn_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'secondary_btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn.df-btn-secondary',
      )
    );


    $this->start_controls_tabs('secondary_btn_style');

    $this->start_controls_tab(
      'secondary_btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('secondary_btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('secondary_btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'secondary_btn_typography',
        'selector' => '{{WRAPPER}} .df-btn.df-btn-secondary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'secondary_btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('secondary_btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('secondary_btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn.df-btn-secondary:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'secondary_btn_typography_hover',
        'selector' => '{{WRAPPER}} .df-btn.df-btn-secondary:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 
    $settings           = $this->get_settings();
    $style              = $settings['style'];
    $obj_image          = $settings['obj_image'];
    $label              = $settings['label'];
    $sub_heading        = $settings['sub_heading'];
    $heading            = $settings['heading'];
    $primary_btn_text   = $settings['primary_btn_text'];
    $link_url           = $settings['link_url'];
    $link_text          = $settings['link_text'];
    $primary_href       = (!empty($settings['primary_btn_link']['url']) ) ? $settings['primary_btn_link']['url'] : '#';
    $primary_target     = ($settings['primary_btn_link']['is_external'] == 'on') ? '_blank' : '_self';
    $secondary_btn_text = $settings['secondary_btn_text'];
    $secondary_href     = (!empty($settings['secondary_btn_link']['url']) ) ? $settings['secondary_btn_link']['url'] : '#';
    $secondary_target   = ($settings['secondary_btn_link']['is_external'] == 'on') ? '_blank' : '_self';
    $link_href          = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $link_target        = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="df-bg df-cta-bg df-cta-wrap">
          <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <div class="df-cta df-style1">
                  <div class="df-cta-left">
                    <?php if(!empty($heading)): ?>
                      <h2 class="df-f30-lg df-font-name df-heading df-line1-2 df-white-c df-mt-6 df-m0"><?php echo esc_html($heading); ?></h2>
                      <div class="empty-space marg-lg-b10"></div>
                    <?php endif; ?>
                    <?php if(!empty($sub_heading)): ?>
                      <div class="df-f16-lg df-line1-6 df-sub-heading df-white-c6 df-mb-5"><?php echo esc_html($sub_heading); ?></div>
                      <div class="empty-space marg-lg-b0 marg-sm-b20"></div>
                    <?php endif; ?>
                  </div>
                  <?php if(!empty($primary_btn_text) || !empty($secondary_btn_text)): ?>
                    <div class="df-cta-right">
                      <div class="df-btn-group df-style1">
                        <?php if(!empty($primary_btn_text)): ?>
                          <a href="<?php echo esc_attr($primary_href); ?>" target="<?php echo esc_attr($primary_target); ?>" class="df-btn df-btn-primary df-style3 df-color6 df-mt10"><?php echo esc_html($primary_btn_text); ?></a>
                        <?php endif; ?>
                        <?php if(!empty($secondary_btn_text)): ?>
                          <a href="<?php echo esc_attr($secondary_href); ?>" target="<?php echo esc_attr($secondary_target); ?>" class="df-btn df-btn-secondary df-style3 df-color1 df-mt10"><?php echo esc_html($secondary_btn_text); ?></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
        </div>
        <?php
        break;

      case 'style2': ?>
        <div class="df-bg df-cta-wrap df-cta-bg">
          <div class="empty-space marg-lg-b70 marg-sm-b60"></div>
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <div class="df-cta df-style1">
                  <div class="df-cta-left">
                    <?php if(!empty($heading)): ?>
                      <h2 class="df-f24-lg df-heading df-font-name df-line1-2 df-white-c df-m0 df-mt-4"><?php echo wp_kses_post($heading); ?></h2>
                      <div class="empty-space marg-lg-b25"></div>
                      <?php endif; ?>
                    <?php if(!empty($primary_btn_text)): ?>
                      <a href="<?php echo esc_attr($primary_href); ?>" target="<?php echo esc_attr($primary_target); ?>" class="df-btn df-btn-primary df-style3 df-color6"><?php echo esc_html($primary_btn_text); ?></a>
                    <?php endif; ?>
                  </div>
                  <?php if(!empty($obj_image['url']) && is_array($obj_image)): ?>
                    <div class="df-cta-img">
                      <img src="<?php echo esc_url($obj_image['url']); ?>" alt="mobile">
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="empty-space marg-lg-b70 marg-sm-b60"></div>
        </div>
        <?php
        break;

      case 'style3': ?>
        <div class="df-cta df-cta-wrap df-style4">
          <div class="df-cta-in df-bg">
            <?php if(!empty($obj_image['url']) && is_array($obj_image)): ?>
              <div class="df-cta-left"><img src="<?php echo esc_url($obj_image['url']); ?>" alt="image" class="df-cta-img"></div>
            <?php endif; ?>
            <div class="df-cta-right">
              <div class="df-cta-top">
                <span class="df-cta-label df-style1"><?php echo esc_html($label); ?></span>
                <div class="empty-space marg-lg-b10 marg-sm-b10"></div>
                <h2 class="df-cta-title df-heading"><?php echo wp_kses_post($heading); ?></h2>
                <div class="df-cta-subtitle df-sub-heading"><?php echo esc_html($sub_heading); ?></div>
              </div>
              <div class="df-cta-bottom">
                <a href="<?php echo esc_url($link_href); ?>" target="<?php echo esc_attr($link_target); ?>" class="df-link-text df-cta-btn"><?php echo esc_html($link_text); ?> </a>
              </div>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

    }
  }
}
