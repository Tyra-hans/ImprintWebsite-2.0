<?php 
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Contact_Form_7_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-contact-form-7-widget';
  }

  public function get_title() {
    return 'Contact Form 7';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
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
    $this->start_controls_section(
      'contact_form_7_section',
      array(
        'label' => esc_html__('Contact Form 7' , 'webify-addons')
      )
    );

    $this->add_control(
      'form_id',
      array(
        'label'       => esc_html__('Contact Form', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'description' => esc_html__('Choose previously created contact form from the drop down list.', 'webify-addons'),
        'options'     => array('' => 'Select Contact Form') + array_flip($this->get_form_id()),
      )
    );

    $this->add_control(
      'button_style',
      array(
        'label'       => esc_html__('Button Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'tb-style3',
        'label_block' => true,
        'options'     => array(
          'tb-style3' => 'Style 1',
          'tb-style5' => 'Style 2',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_button_style',
      array(
        'label' => esc_html__('Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .wpcf7-submit',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
           '{{WRAPPER}} .wpcf7-submit:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .wpcf7-submit',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();
  }

  protected function render() { 
    $settings     = $this->get_settings();
    $form_id      = $settings['form_id'];
    $button_style = $settings['button_style'];

    if(empty($form_id)) { return; }
    
  ?>

    <div class="tb-contact-form-wrapper">

    <?php 

      ob_start();
        echo do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]');
      $cf7 = ob_get_clean();

      $cf7 = str_replace('wpcf7-submit', 'wpcf7-submit tb-btn tb-color4 '.$button_style, $cf7);

      echo $cf7;
    ?>
      
    </div>
      
  <?php

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Contact_Form_7_Widget() );