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
class Dragfy_Addons_Newsletter extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-newsletter';
  }

  public function get_title() {
    return 'Newsletter';
  }

  public function get_icon() {
    return 'elem_icon newsletter';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('newsletter', 'button', 'dragfy-addons', 'form');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {

    if(!class_exists('Newsletter')) {
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
          'raw'             => __('<strong>Newsletter</strong> is not installed/activated on your site. Please install and activate <strong>Newsletter</strong>.', 'dragfy-addons-for-elementor'),
          'content_classes' => 'warning',
        )
      );

      $this->end_controls_section();

    } else {

      $this->start_controls_section(
        'newsletter_genreal_settings',
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
          ),
        )
      );

      $this->end_controls_section();

      $this->start_controls_section(
        'newsletter_image_settings',
        array(
          'label'     => esc_html__('Image Settings' , 'dragfy-addons-for-elementor'),
          'condition' => array('style' => array('style2'))
        )
      );

      $this->add_control(
        'image',
        array(
          'label'       => esc_html__('Image', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'type'        => Controls_Manager::MEDIA,
        )
      );

      $this->end_controls_section();

      $this->start_controls_section(
        'newsletter_content_settings',
        array(
          'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
        )
      );

      $this->add_control(
        'heading',
        array(
          'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'default'     => esc_html__('Subscribe Newsletter', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::TEXT,
        )
      );

      $this->add_control(
        'sub_heading',
        array(
          'label'       => esc_html__('Sub Heading', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'default'     => esc_html__('Fill-out the form for informations', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::TEXT,
        )
      );

      $this->add_control(
        'name_placeholder',
        array(
          'label'       => esc_html__('Name Placeholder', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'default'     => esc_html__('Name', 'dragfy-addons-for-elementor'),
          'condition'   => array('style' => array('style1')),
          'type'        => Controls_Manager::TEXT,
        )
      );

      $this->add_control(
        'email_placeholder',
        array(
          'label'       => esc_html__('Email Placeholder', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'default'     => esc_html__('Email Address', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::TEXT,
        )
      );
      $this->end_controls_section();

      $this->start_controls_section(
        'newsletter_btn_settings',
        array(
          'label' => esc_html__('Button Settings' , 'dragfy-addons-for-elementor')
        )
      );

      $this->add_control(
        'btn_text',
        array(
          'label'       => esc_html__('Button Text', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'default'     => esc_html__('Subscribe Newsletter', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::TEXT,
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
          'selector'  => '{{WRAPPER}} .df-newsletter-wrap',
        )
      );

      $this->add_responsive_control(
        'margin',
        array(
          'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} .df-newsletter-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-newsletter-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'border',
          'selector' => '{{WRAPPER}} .df-newsletter-wrap'
        )
      );

      $this->add_responsive_control(
        'border_radius',
        array(
          'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} .df-newsletter-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
          
        )
      );

      $this->add_control('horizonal_line_color', 
        array(
          'label'     => esc_html__('Horizontal Line Color', 'dragfy-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} .df-newsletter-wrap hr' => 'border-color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        array(
          'name'      => 'box_shadow',
          'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
          'selector'  => '{{WRAPPER}} .df-newsletter-wrap',
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
          'label' => esc_html__('Sub Heading Style', 'dragfy-addons-for-elementor'),
          'tab'   => Controls_Manager::TAB_STYLE,
        )
      );

      $this->add_control('sub_heading_color', 
        array(
          'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} .df-subscribe-sub-heading' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
          'name'     => 'sub_heading_typography',
          'selector' => '{{WRAPPER}} .df-subscribe-sub-heading',
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
            '{{WRAPPER}} .df-subscribe-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
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
            '{{WRAPPER}} input[type="text"]' => 'background: {{VALUE}};',
          ),
        )
      );

      $this->add_control('form_text_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="text"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'form_border',
          'selector' => '{{WRAPPER}} input[type="text"]'
        )
      );

      $this->add_responsive_control(
        'form_border_radius',
        array(
          'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} input[type="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit' => 'background-color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'btn_border',
          'selector' => '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit'
        )
      );

      $this->add_control('btn_text_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
          'name'     => 'btn_typography',
          'selector' => '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit',
          'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        )
      );

      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        array(
          'name'      => 'btn_box_shadow',
          'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
          'selector'  => '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-newsletter-submit',
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
            '{{WRAPPER}} .df-btn:hover, {{WRAPPER}} .df-newsletter-submit:hover' => 'background-color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'btn_hover_border',
          'selector' => '{{WRAPPER}} .df-btn:hover, {{WRAPPER}} .df-newsletter-submit:hover'
        )
      );

      $this->add_control('btn_text_hover_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} .df-btn:hover, {{WRAPPER}} .df-newsletter-submit:hover' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
          'name'     => 'btn_hover_typography',
          'selector' => '{{WRAPPER}} .df-btn:hover, {{WRAPPER}} .df-newsletter-submit:hover',
          'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        )
      );

      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        array(
          'name'      => 'btn_hover_box_shadow',
          'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
          'selector'  => '{{WRAPPER}} .df-btn:hover, {{WRAPPER}} .df-newsletter-submit:hover',
        )
      );

      $this->end_controls_tabs();
      $this->end_controls_section();


    }


  }

  protected function render() { 
    if(!class_exists('Newsletter')) { return; }
    $settings          = $this->get_settings_for_display();
    $style             = $settings['style'];
    $heading           = $settings['heading'];
    $sub_heading       = $settings['sub_heading'];
    $name_placeholder  = $settings['name_placeholder'];
    $email_placeholder = $settings['email_placeholder'];
    $image             = $settings['image'];
    $btn_text          = $settings['btn_text'];

    switch ($style) {
      case 'style1': default: ?>
        <div class="df-border df-newsletter-wrap">
          <div class="df-subscribe-heading text-center">
            <div class="empty-space marg-lg-b25"></div>
            <h3 class="df-f18-lg df-line23-lg df-heading df-font-name df-m0"><?php echo esc_html($heading); ?></h3>
            <p class="df-m0 df-subscribe-sub-heading"><?php echo esc_html($sub_heading); ?></p>
            <div class="empty-space marg-lg-b25"></div>
          </div>
          <hr>
          <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="df-newsletter df-style4">
            <input type="text" name="nn" required="" placeholder="<?php echo esc_html($name_placeholder); ?>">
            <input type="text" name="ne" required="" placeholder="<?php echo esc_html($email_placeholder); ?>">
            <div class="empty-space marg-lg-b5"></div>
            <button class="df-btn df-style3 df-color9 newsletter-submit w-100"><span><?php echo esc_html($btn_text); ?></span></button>
          </form>
        </div>
        <?php
        # code...
        break;
      case 'style2': ?>
        <div class="df-7a77d0-bg df-newsletter-wrap">
          <div class="df-container">
            <div class="df-row">
              <?php if(is_array($image) && !empty($image['url'])): ?>
                <div class="df-col-lg-6">
                  <div class="empty-space marg-lg-b0 marg-sm-b60"></div>
                  <div class="df-vertical-middle text-center">
                    <div class="df-vertical-middle-in">
                      <img src="<?php echo esc_url($image['url']); ?>" alt="image">
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <div class="df-col-lg-6">
                <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
                <div class="df-section-heading df-style2">
                  <h2 class="df-f40-lg df-f25-sm df-heading df-font-name df-mt-7 df-mb-2 df-white-c"><?php echo wp_kses_post($heading); ?></h2>
                  <div class="empty-space marg-lg-b5 marg-sm-b5"></div>
                  <div class="df-f16-lg df-line1-6 df-subscribe-sub-heading df-white-c7"><?php echo wp_kses_post($sub_heading); ?></div>
                  <div class="empty-space marg-lg-b25 marg-sm-b25"></div>
                  <form action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" method="post" class="df-newsletter df-style7">
                    <div class="df-form-field">
                      <input type="text" name="ne" required="" placeholder="<?php echo esc_html($email_placeholder); ?>">
                    </div>
                    <input type="submit" class="df-newsletter-submit newsletter-submit" value="<?php echo esc_attr($btn_text); ?>">
                  </form>
                </div>
                <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
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
