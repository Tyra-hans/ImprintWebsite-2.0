<?php 

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use DragfyAddons\Helpers\Helpers;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
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
class Dragfy_Addons_Ninja_Forms extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-ninja-forms';
  }

  public function get_title() {
    return 'Ninja Forms';
  }

  public function get_icon() {
    return 'elem_icon contact_form';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {

    if(!class_exists('Ninja_Forms')) {
      $this->start_controls_section(
        'warning_notice',
        array(
          'label' => esc_html__('Warning' , 'dragfy-addons-for-elementor')
        )
      );
      $this->add_control(
        'warning_text',
        array(
          'type'            => Controls_Manager::RAW_HTML,
          'raw'             => __('<strong>Ninja Forms</strong> is not installed/activated on your site. Please install and activate <strong>Ninja Forms</strong>.', 'dragfy-addons-for-elementor'),
          'content_classes' => 'warning',
        )
      );

      $this->end_controls_section();

    } else {

      $this->start_controls_section(
        'ninja_forms_settings',
        array(
          'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
        )
      );

      $this->add_control(
        'form_id',
        array(
          'label'       => esc_html__('Select Form', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::SELECT,
          'default'     => '0',
          'label_block' => true,
          'description' => esc_html__('Choose previously created contact form from the drop down list.', 'dragfy-addons-for-elementor'),
          'options'     => Helpers::select_ninja_form(),
        )
      );

      $this->end_controls_section();


      $this->start_controls_section('ninja_forms_error_settings',
        array(
          'label' => esc_html__('Error Settings', 'dragfy-addons-for-elementor'),
          'tab'   => Controls_Manager::TAB_STYLE,
        )
      );

      $this->add_control(
        'error_message',
        array(
          'label'       => esc_html__('Error Message', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::SELECT,
          'default'     => 'show',
          'label_block' => true,
          'options' => array(
            'show'  => esc_html__('Show', 'dragfy-addons-for-elementor'),
            'hide'  => esc_html__('Hide', 'dragfy-addons-for-elementor'),
          ),
          'selectors_dictionary' => array(
            'show' => 'block',
            'hide' => 'none'
          ), 
          'selectors' => array(
            '{{WRAPPER}} .df-ninja-forms .nf-error-wrap .nf-error-required-error' => 'display: {{VALUE}} !important;',
          ), 
        )
      );

      $this->add_control(
        'validation_errors',
        array(
          'label'       => esc_html__('Validation Message', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::SELECT,
          'default'     => 'show',
          'label_block' => true,
          'options' => array(
            'show'  => esc_html__('Show', 'dragfy-addons-for-elementor'),
            'hide'  => esc_html__('Hide', 'dragfy-addons-for-elementor'),
          ),
          'selectors_dictionary' => array(
            'show' => 'block',
            'hide' => 'none'
          ), 
          'selectors' => array(
            '{{WRAPPER}} .df-ninja-forms .nf-form-errors .nf-error-field-errors' => 'display: {{VALUE}} !important;',
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



      $this->start_controls_section('section_form_label_style',
        array(
          'label' => esc_html__('Label Style', 'dragfy-addons-for-elementor'),
          'tab'   => Controls_Manager::TAB_STYLE,
        )
      );

      $this->add_control('form_label_color', 
        array(
          'label'       => esc_html__('Label Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} label' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
          'name'     => 'label_typography',
          'selector' => '{{WRAPPER}} .df-ninja-forms label',
          'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        )
      );

      $this->end_controls_section();

      $this->start_controls_section('section_form_style',
        array(
          'label' => esc_html__('Form Style', 'dragfy-addons-for-elementor'),
          'tab'   => Controls_Manager::TAB_STYLE,
        )
      );

      $this->add_control('form_bg_color', 
        array(
          'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper textarea' => 'background: {{VALUE}};',
          ),
        )
      );

      $this->add_control('form_text_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} input[type="text"]::-webkit-input-placeholder, {{WRAPPER}} input[type="email"]::-webkit-input-placeholder, {{WRAPPER}} .df-contact-form-wrapper textarea::-webkit-input-placeholder, {{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper textarea' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'form_border',
          'selector' => '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper textarea'
        )
      );

      $this->add_responsive_control(
        'form_border_radius',
        array(
          'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
          
        )
      );

      $this->add_responsive_control(
        'form_padding',
        array(
          'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
        )
      );

      $this->add_responsive_control(
        'form_margin',
        array(
          'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-ninja-forms input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-ninja-forms input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-ninja-forms input[type="button"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-ninja-forms input[type="button"]' => 'background-color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'btn_border',
          'selector' => '{{WRAPPER}} .df-ninja-forms input[type="button"]'
        )
      );

      $this->add_control('btn_text_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} .df-ninja-forms input[type="button"]' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
          'name'     => 'btn_typography',
          'selector' => '{{WRAPPER}} .df-ninja-forms input[type="button"]',
          'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        )
      );

      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        array(
          'name'      => 'btn_box_shadow',
          'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
          'selector'  => '{{WRAPPER}} .df-ninja-forms input[type="button"]',
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
            '{{WRAPPER}} .df-ninja-forms input[type="button"]:hover' => 'background-color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'btn_hover_border',
          'selector' => '{{WRAPPER}} .df-ninja-forms input[type="button"]:hover'
        )
      );

      $this->add_control('btn_text_hover_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} .df-ninja-forms input[type="button"]:hover' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
          'name'     => 'btn_hover_typography',
          'selector' => '{{WRAPPER}} .df-ninja-forms input[type="button"]:hover',
          'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        )
      );

      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        array(
          'name'      => 'btn_hover_box_shadow',
          'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
          'selector'  => '{{WRAPPER}} .df-ninja-forms input[type="button"]:hover',
        )
      );

      $this->end_controls_tabs();
      $this->end_controls_section();



    }
  }

  protected function render() { 
    if(!class_exists('Ninja_Forms')) { return; }
    $settings = $this->get_settings();
    $form_id  = $settings['form_id'];
    if(empty($form_id)) { return; }
  ?>
    <div class="df-contact-form-wrapper df-ninja-forms">
      <?php echo do_shortcode('[ninja_form id="'.esc_attr($form_id).'"]'); ?>
    </div>
      
  <?php

  }
}
