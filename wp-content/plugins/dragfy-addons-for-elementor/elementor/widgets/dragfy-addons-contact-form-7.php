<?php 

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
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
class Dragfy_Addons_Contact_Form_7 extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-contact-form-7';
  }

  public function get_title() {
    return 'Contact Form 7';
  }

  public function get_icon() {
    return 'elem_icon contact_form';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('dragfy-addons', 'form', 'button');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  public function get_form_id() {
    global $wpdb;

    $db_cf7froms  = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
    $cf7_forms    = array();

    if ( $db_cf7froms ) {

      foreach ( $db_cf7froms as $cform ) {
        $cf7_forms[$cform->post_title] = $cform->ID;
      }

    } else {
      $cf7_forms['No contact forms found'] = 0;
    }

    return $cf7_forms;
  }

  protected function _register_controls() {

    if(!class_exists('WPCF7')) {
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
          'raw'             => __('<strong>Contact Form 7</strong> is not installed/activated on your site. Please install and activate <strong>Contact Form 7</strong>.', 'dragfy-addons-for-elementor'),
          'content_classes' => 'warning',
        )
      );

      $this->end_controls_section();

    } else {

      $this->start_controls_section(
        'contact_form_7_settings',
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
            'style1'  => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
            'style2'  => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
            'style3'  => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
            'style4'  => esc_html__('Style 4', 'dragfy-addons-for-elementor'),
          )
        )
      );

      $this->add_control(
        'form_id',
        array(
          'label'       => esc_html__('Contact Form', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::SELECT,
          'default'     => '',
          'label_block' => true,
          'description' => esc_html__('Choose previously created contact form from the drop down list.', 'dragfy-addons-for-elementor'),
          'options'     => array('' => 'Select Contact Form') + array_flip($this->get_form_id()),
        )
      );

      $this->end_controls_section();

      $this->start_controls_section(
        'contact_form_7_image_settings',
        array(
          'label'     => esc_html__('Image Settings' , 'dragfy-addons-for-elementor'),
          'condition' => array('style' => array('style3')), 
        )
      );

      $this->add_control(
        'image',
        array(
          'label'       => esc_html__('Image', 'dragfy-addons-for-elementor'),
          'label_block' => true,
          'type'        => Controls_Manager::MEDIA,
          'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
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

      $this->add_control('form_label_color', 
        array(
          'label'       => esc_html__('Label Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} label' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_control('form_text_color', 
        array(
          'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
          'type'        => Controls_Manager::COLOR,
          'selectors' => array(
            '{{WRAPPER}} input[type="text"]::-webkit-input-placeholder, {{WRAPPER}} input[type="email"]::-webkit-input-placeholder, {{WRAPPER}} .df-contact-form-wrapper label textarea::-webkit-input-placeholder, {{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper label textarea' => 'color: {{VALUE}};',
          ),
        )
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        array(
          'name'     => 'form_border',
          'condition' => array('style' => array('style1', 'style2')),
          'selector' => '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper label textarea'
        )
      );

      $this->add_responsive_control(
        'form_border_radius',
        array(
          'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'condition' => array('style' => array('style1', 'style2')),
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper label textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
          
        )
      );

      $this->add_responsive_control(
        'form_padding',
        array(
          'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'condition' => array('style' => array('style1', 'style2')),
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper label textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ),
        )
      );

      $this->add_responsive_control(
        'form_margin',
        array(
          'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
          'type'       => Controls_Manager::DIMENSIONS,
          'condition' => array('style' => array('style1', 'style2')),
          'size_units' => array('px', 'em', '%'),
          'selectors' => array(
            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"], {{WRAPPER}} .df-contact-form-wrapper label textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
  }

  protected function render() { 
    if(!class_exists('WPCF7')) { return; }
    $settings = $this->get_settings();
    $form_id  = $settings['form_id'];
    $style    = $settings['style'];
    $image    = $settings['image'];

    if(empty($form_id)) { return; }
    
  ?>

    <div class="df-contact-form-wrapper df-<?php echo esc_attr($style); ?>">
      <?php if(!empty($image) && is_array($image) && !empty($image['url']) && $style == 'style3'): ?>
        <div class="df-form-img" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
      <?php endif; ?>
    <?php 

      ob_start();
        echo do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]');
      $cf7 = ob_get_clean();

      $cf7 = str_replace('wpcf7-submit', 'wpcf7-submit df-btn df-color4 df-style3', $cf7);

      echo $cf7;
    ?>
    </div>
      
  <?php

  }
}
