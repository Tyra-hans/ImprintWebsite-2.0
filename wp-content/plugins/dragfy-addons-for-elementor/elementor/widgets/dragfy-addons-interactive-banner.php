<?php
 
namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
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
class Dragfy_Addons_Interactive_Banner extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-interactive-banner';
  }

  public function get_title() {
    return 'Interactive Banner';
  }

  public function get_icon() {
    return 'elem_icon interactive_banner';
  }

  public function get_script_depends() {
    return array('text-slider', 'svg-wave', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('button', 'hero', 'text-slider', 'client', 'form', 'dragfy-addons');
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
    $this->start_controls_section(
      'interactive_banner_general_settings',
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
          'style3' => 'Style 3',
          'style4' => 'Style 4',
          'style5' => 'Style 5',
          'style6' => 'Style 6',
          'style7' => 'Style 7',
          'style8' => 'Style 8',
          'style9' => 'Style 9',
        )
      )
    );

    $this->add_responsive_control(
      'interactive_banner_height',
      array(
        'label'       => esc_html__('Height', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 1000,
            'step' => 5,
          ),
        ),
        'condition'  => array('style' => array('style1', 'style2', 'style3', 'style4', 'style7', 'style8', 'style9')),    
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-hero' => 'height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'interactive_banner_image_settings',
      array(
        'label'     => esc_html__('Image Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style2', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9'))
      )
    );

    $this->add_control(
      'bg_image',
      array(
        'label'       => esc_html__('Image', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $this->add_control(
      'overlay',
      array(
        'label'       => esc_html__('Overlay', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SWITCHER,
        'default'     => 'yes',
        'description' => esc_html__('Works only for Style 3 & 4', 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'logo_images',
      array(
        'label'       => esc_html__('Logo Images', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::GALLERY,
        'description' => esc_html__('Works only for Style 5', 'dragfy-addons-for-elementor')
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'interactive_banner__content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
        'default'     => 'Make it professional.<br>Make it beautiful.',
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'default'     => 'We design digital platforms that elevate the customer experience <br>for the world\'s most beloved brands.',
        'label_block' => true,
        'type'        => Controls_Manager::WYSIWYG
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'interactive_banner_btn_settings',
      array(
        'label'     => esc_html__('Button Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style1', 'style2', 'style3', 'style5', 'style7', 'style8', 'style9')),
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Button Text.', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3', 'style5', 'style7', 'style8', 'style9')),    
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'condition'   => array('style' => array('style1', 'style5', 'style7', 'style8', 'style9')),  
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'interactive_banner_form_settings',
      array(
        'label'     => esc_html__('Form Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style3'))
      )
    );


    $this->add_control(
      'form_heading',
      array(
        'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Make an Appointment', 'dragfy-addons-for-elementor'),
        'separator'   => 'before',
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'form_sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Fill-out the details for imformation', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'form_id',
      array(
        'label'       => esc_html__('Contact Form', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'condition'   => array('style' => array('style3')),
        'description' => esc_html__('Choose previously created contact form from the drop down list.', 'dragfy-addons-for-elementor'),
        'options'     => array('' => 'Select Contact Form') + array_flip($this->get_form_id()),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_bg_style',
      array(
        'label'     => esc_html__('Background Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style3', 'style4', 'style8'))
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__( 'Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-hero.df-style11',
      )
    );

    $this->add_control('overlay_bg_color', 
      array(
        'label'     => esc_html__('Overlay Background Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .has-overlay:before' => 'background-color: {{VALUE}};',
        ),
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
          '{{WRAPPER}} .df-text-slider' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .df-text-slider',
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
          '{{WRAPPER}} .df-text-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_style',
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
          '{{WRAPPER}} .df-hero-subtitle' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .df-hero-subtitle',
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
          '{{WRAPPER}} .df-hero-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_shape_style',
      array(
        'label'     => esc_html__('Shape Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style8'))
      )
    );

    $this->add_control('shape_color_1', 
      array(
        'label'     => esc_html__('Color 1', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-shap-animation-wrap.df-style1 .df-shap-animation-in b,
           {{WRAPPER}} .df-hero-img-box-circle, {{WRAPPER}} .df-circle-shape1'  => 'background: {{VALUE}};',
          '{{WRAPPER}} .df-shap-animation-wrap.df-style1 .df-shap-animation1 .df-shap-animation-in span,
           {{WRAPPER}} .df-shap-animation2 span' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('shape_color_2', 
      array(
        'label'       => esc_html__('Color 2', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-shap-animation-wrap.df-style1 .df-shap-animation2 span,
           {{WRAPPER}} .df-shap-animation3' => 'border-color: {{VALUE}};',
           '{{WRAPPER}} .df-circle-shape2'  => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('shape_color_3', 
      array(
        'label'       => esc_html__('Color 3', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .df-shap-animation-wrap.df-style1 .df-shap-animation3' => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .df-circle-shape3'                                     => 'background: {{VALUE}};',
          '{{WRAPPER}} .df-pattern2, {{WRAPPER}} .df-pattern1'                => 'background-image: radial-gradient({{VALUE}} 15%,transparent 15%);',
        ),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_button_style',
      array(
        'label'     => esc_html__('Button Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2', 'style3', 'style5', 'style7', 'style8', 'style9')),
      )
    );

    $this->add_responsive_control(
      'btn_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-hero-btn .df-btn, {{WRAPPER}} .df-subscribe-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-hero-btn .df-btn, {{WRAPPER}} .df-subscribe-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-hero-btn .df-btn, {{WRAPPER}} .df-subscribe-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-hero-btn .df-btn,
           {{WRAPPER}} .df-subscribe-btn' => 'background-color: {{VALUE}};',
          '{{WRAPPER}} .df-subscribe-btn' => 'border-color: {{VALUE}};',

        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-hero-btn .df-btn,
           {{WRAPPER}} .df-subscribe-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .df-hero-btn .df-btn, {{WRAPPER}} .df-subscribe-btn',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn, {{WRAPPER}} .df-subscribe-btn',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-hero-btn .df-btn:hover,
           {{WRAPPER}} .df-subscribe-btn:hover' => 'background-color: {{VALUE}};',
          '{{WRAPPER}} .df-subscribe-btn:hover' => 'border-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-hero-btn .df-btn:hover,
           {{WRAPPER}} .df-subscribe-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .df-hero-btn .df-btn:hover, {{WRAPPER}} .df-subscribe-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_hover_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn:hover, {{WRAPPER}} .df-subscribe-btn:hover',
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

    $this->start_controls_section('section_form_style',
      array(
        'label'     => esc_html__('Form Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style3'))
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'form_border',
        'selector' => '{{WRAPPER}} .df-hero-form'
      )
    );

    $this->add_responsive_control(
      'form_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-hero-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'form_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-box-shadow2',
      )
    );

    $this->add_control('form_heading_color', 
      array(
        'label'       => esc_html__('Heading Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-form-heading h2' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'form_heading_typography',
        'selector' => '{{WRAPPER}} .df-form-heading h2',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_control('form_sub_heading_color', 
      array(
        'label'       => esc_html__('Sub Heading Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-form-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'form_sub_heading_typography',
        'selector' => '{{WRAPPER}} .df-form-sub-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings         = $this->get_settings_for_display();
    $style            = $settings['style'];
    $heading          = $settings['heading'];
    $description      = $settings['description'];
    $form_heading     = $settings['form_heading'];
    $form_sub_heading = $settings['form_sub_heading'];
    $form_id          = $settings['form_id'];
    $btn_text         = $settings['btn_text'];
    $btn_link         = $settings['btn_link'];
    $bg_image         = $settings['bg_image'];
    $overlay          = $settings['overlay'];
    $logo_images      = $settings['logo_images'];
    $href             = (!empty($btn_link['url']) ) ? $btn_link['url'] : '#';
    $target           = ($btn_link['is_external'] == 'on') ? '_blank' : '_self';
    $overlay          = ($overlay == 'yes') ? 'has-overlay':'no-overlay';


    switch ($style) {
      case 'style1': default: ?>
        <div class="df-hero df-style5 df-flex text-center">
          <div id="df-ball-wrap"></div>
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <?php if(!empty($heading)): ?>
                  <h1 class="df-text-slider df-f60-lg df-f40-sm df-line1 df-font-name df-font-name df-mt-6 df-mb-9 df-mt-5-sm df-mb-3-sm"><?php echo wp_kses_post($heading); ?></h1>
                  <div class="empty-space marg-lg-b30"></div>
                <?php endif; ?>
                <?php if(!empty($description)): ?>
                  <div class="df-hero-subtitle df-f18-lg df-line1-6 df-mt-5 df-mb-5"><?php echo wp_kses_post($description); ?></div>
                  <div class="empty-space marg-lg-b40"></div>
                <?php endif; ?>
                <?php if(!empty($btn_text)): ?>
                  <div class="df-hero-btn">
                    <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style4 df-color2"><?php echo esc_html($btn_text); ?></a>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php
       # code...
       break;


      case 'style2': 

      $heading = (strpos($heading, ',') !== false) ? explode(',', $heading):$heading;

      ?>
        <section class="df-hero df-style3 df-bg df-flex">
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <div class="df-hero-text">
                  <div class="df-section-heading df-style2 text-center">
                    <h1 class="df-text-slider slide df-f48-lg df-f36-sm df-font-name df-m0 df-mt-9 df-mt-5-sm">

                      <?php if(is_array($heading)): ?>

                        <span><?php echo wp_kses_post($heading[0]); ?></span>
                        <span class="df-words-wrapper df-waiting">
                          <b class="is-visible"><?php echo wp_kses_post($heading[1]); ?>.</b>
                          <?php 
                            $heading = array_slice($heading, 2);  
                            if(!empty($heading) && is_array($heading)):
                              foreach($heading as $words):
                          ?>  
                                <b><?php echo wp_kses_post($words); ?></b>
                          <?php 
                              endforeach; 
                            endif; 
                          ?>
                        </span>
                      <?php else: ?>
                        <span><?php echo wp_kses_post($heading); ?></span>
                      <?php endif; ?>

                    </h1>
                    <div class="empty-space marg-lg-b10"></div>
                  <?php if(!empty($description)): ?>
                    <div class="df-hero-subtitle df-f18-lg df-f16-sm df-line1-6 df-mb-3"><?php echo wp_kses_post($description); ?></div>
                  <?php endif; ?>
                  </div>
                  <div class="empty-space marg-lg-b35"></div>

                  <?php if(class_exists('Newsletter')): ?>
                    <form action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="df-hero-form df-style1">
                      <input type="email" name="ne" required="" placeholder="<?php echo esc_html__('Enter Your Email Adress', 'dragfy-addons-for-elementor'); ?>">
                      <?php if(!empty($btn_text)): ?>
                        <button class="df-btn df-subscribe-btn newsletter-submit df-style4 df-color9"><?php echo esc_html($btn_text); ?></button>
                      <?php endif; ?>
                    </form>
                    <div class="empty-space marg-lg-b60 marg-sm-b40"></div>
                  <?php endif; ?>

                  <?php if(!empty($bg_image) && is_array($bg_image)): ?>
                    <div class="df-hero-img text-center">
                      <img src="<?php echo esc_url($bg_image['url']); ?>" alt="image">
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Hero Section -->
        <?php
        # code...
        break;

      case 'style3': 

        $bg_style = (is_array($bg_image) && !empty($bg_image['url'])) ? ' style="background-image:url('.esc_url($bg_image['url']).');"':''; 

      ?>
        <div class="df-hero df-style7 <?php echo esc_attr($overlay); ?> df-bg df-flex"<?php echo wp_kses_post($bg_style); ?>>
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-7">
                <div class="df-vertical-middle">
                  <div class="df-hero-text">
                    <?php if(!empty($heading)): ?>
                      <h1 class="df-hero-title df-text-slider df-f60-lg df-f35-sm df-m0 df-font-name"><?php echo wp_kses_post($heading); ?></h1>
                      <div class="empty-space marg-lg-b10 marg-sm-b10"></div>
                    <?php endif; ?>
                    <?php if(!empty($description)): ?>
                      <div class="df-hero-subtitle df-f18-lg df-line1-6"><?php echo wp_kses_post($description); ?></div>
                      <div class="empty-space marg-lg-b35 marg-sm-b35"></div>
                    <?php endif; ?>
                    <?php if(!empty($btn_text)): ?>
                      <div class="df-hero-btn">
                        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style6 df-color8"><span><?php echo esc_html($btn_text); ?></span></a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

                <div class="df-col-lg-5">
                  <div class="df-box-shadow2">
                    <div class="df-hero-form df-style2 df-radious-4">
                        <div class="df-form-heading df-style1 text-center">
                          <?php if(class_exists('WPCF7') && !empty($form_id)): ?>
                            <h2 class="df-f24-lg df-mb4 df-mt-6"><?php echo esc_html($form_heading); ?></h2>
                            <div class="df-mb-6 df-form-sub-heading"><?php echo esc_html($form_sub_heading); ?></div>
                          <?php else: ?>
                            <span>Contact Form 7 Plugin Not Found !!</span>
                          <?php endif; ?>
                        </div><!-- .df-form-heading -->
                        <?php if(class_exists('WPCF7') && !empty($form_id)): ?>
                          <div class="df-appointment-form df-form-body"><?php echo do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]'); ?></div>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>


            </div>
          </div>
         </div>
         <?php
        # code...
        break;

      case 'style4': 
        $bg_style = (is_array($bg_image) && !empty($bg_image['url'])) ? ' style="background-image:url('.esc_url($bg_image['url']).');"':''; 
      ?>
        <div class="df-hero df-parallax <?php echo esc_attr($overlay); ?> df-style9 df-bg df-flex text-center" data-speed="0.4" <?php echo wp_kses_post($bg_style); ?>>
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <div class="df-hero-text">
                  <?php if(!empty($heading)): ?>
                    <h1 class="df-hero-title df-text-slider df-white-c df-f60-lg df-f38-sm df-font-name df-m0"><?php echo wp_kses_post($heading); ?></h1>
                    <div class="empty-space marg-lg-b5"></div>
                  <?php endif; ?>
                  <?php if(!empty($description)): ?>
                    <div class="df-hero-subtitle df-white-c df-f20-lg df-line1-6"><?php echo wp_kses_post($description); ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style5': ?>
        <div class="df-hero-banner">
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-6">
                <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
                <div class="df-hero-text">
                  <?php if(!empty($heading)): ?>
                    <h1 class="df-hero-title df-text-slider df-f60-lg df-f38-sm df-font-name df-mp0"><?php echo wp_kses_post($heading); ?></h1>
                    <div class="empty-space marg-lg-b5"></div>
                  <?php endif; ?>
                  <?php if(!empty($description)): ?>
                    <div class="df-hero-subtitle df-f20-lg df-line1-6 df-mb2"><?php echo wp_kses_post($description); ?></div>
                    <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
                  <?php endif; ?>
                  <?php if(!empty($btn_text)): ?>
                    <div class="df-hero-btn">
                      <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style6 df-color4"><?php echo esc_html($btn_text); ?></a>
                    </div>
                    <div class="empty-space marg-lg-b60 marg-sm-b40"></div>
                  <?php endif; ?>
                  <?php if(is_array($logo_images) & !empty($logo_images)): ?>
                    <div class="df-clients df-style1">
                      <?php foreach($logo_images as $image): if(!empty($image['url'])): ?>
                        <div class="df-client df-style4"><img src="<?php echo esc_url($image['url']); ?>" alt=""></div>
                      <?php endif; endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="empty-space marg-lg-b100 marg-sm-b0"></div>
              </div>

              <?php if(!empty($bg_image['url'])): ?>
                <div class="df-col-lg-6">
                  <div class="empty-space marg-lg-b100 marg-sm-b30"></div>
                  <div class="df-hero-img text-center">
                    <img src="<?php echo esc_url($bg_image['url']); ?>" alt="hero-img">
                    <div class="df-shap-animation-wrap">
                      <div class="df-shap-animation df-shap-animation2"><span></span></div>
                      <div class="df-shap-animation df-shap-animation3"></div>
                    </div>
                    <div class="df-pattern-animation"><div class="df-pattern2"></div></div>
                  </div>
                  <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style6': 
        $heading = (strpos($heading, ',') !== false) ? explode(',', $heading):$heading;
      ?>
        <div class="df-hero df-style10 df-flex">
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <div class="empty-space marg-lg-b150 marg-sm-b100"></div>
                <div class="df-section-heading df-style2">
                  <div class="df-f16-lg df-hero-subtitle df-mt-4"><?php echo wp_kses_post($description); ?></div>
                  <div class="empty-space marg-lg-b10"></div>
                  <h1 class="df-text-slider slide df-f48-lg df-f36-sm df-font-name df-mb-3">

                    <?php if(is_array($heading)): ?>

                      <span><?php echo wp_kses_post($heading[0]); ?></span>
                      <span class="df-words-wrapper df-waiting">
                        <b class="is-visible"><?php echo wp_kses_post($heading[1]); ?>.</b>
                        <?php 
                          $heading = array_slice($heading, 2);  
                          if(!empty($heading) && is_array($heading)):
                            foreach($heading as $words):
                        ?>  
                              <b><?php echo wp_kses_post($words); ?></b>
                        <?php 
                            endforeach; 
                          endif; 
                        ?>
                      </span>
                    <?php else: ?>
                      <span><?php echo wp_kses_post($heading); ?></span>
                    <?php endif; ?>

                  </h1>
                </div>
                <div class="empty-space marg-lg-b135 marg-sm-b90"></div>
              </div>
            </div>
          </div>
          <div class="df-shap-animation-wrap df-style1">
            <div class="df-shap-animation df-shap-animation1">
              <div class="df-shap-animation-in">
                <b></b>
                <span></span>
              </div>
            </div>
            <div class="df-shap-animation df-shap-animation2"><span></span></div>
            <div class="df-shap-animation df-shap-animation3"></div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style7': ?>
        <!-- Start Hero Section -->


        <div class="df-hero df-style5 df-flex">
          <!-- <div id="df-ball-wrap" class=" wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.1s"></div> -->
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-6">
                <div class="df-vertical-middle">
                  <div class="df-vertical-middle-in">
                    <?php if(!empty($heading)): ?>
                      <h1 class="df-text-slider df-f60-lg df-f40-sm df-line1 df-m0 df-font-name"><?php echo wp_kses_post($heading); ?></h1>
                      <div class="empty-space marg-lg-b15"></div>
                    <?php endif; ?>
                    <?php if(!empty($description)): ?>
                      <div class="df-hero-subtitle df-f18-lg df-line1-6 df-mb2"><?php echo wp_kses_post($description); ?></div>
                      <div class="empty-space marg-lg-b30"></div>
                    <?php endif; ?>
                    <div class="df-hero-btn">
                      <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style4 df-color19"><?php echo esc_html($btn_text); ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(!empty($bg_image['url'])): ?>
                <div class="df-col-lg-6">
                  <div class="df-vertical-middle">
                    <div class="df-vertical-middle-in">
                      <div class="df-hero-img df-style1" >
                        <div class="df-hero-img-box df-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
                        <div class="df-hero-img-box-pattern"><div class="df-pattern1"></div></div>
                        <div class="df-hero-img-box-circle"></div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style8': ?>

        <div class="df-hero df-style11 df-bg df-flex">
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-12">
                <div class="df-hero-text text-center">
                  <h1 class="df-hero-title df-text-slider df-white-c df-f48-lg df-f35-sm df-font-name df-m0"><?php echo wp_kses_post($heading); ?></h1>
                  <div class="empty-space marg-lg-b10"></div>
                  <div class="df-hero-subtitle df-white-c df-f18-lg df-line1-6 df-mb2"><?php echo wp_kses_post($description); ?></div>
                  <div class="empty-space marg-lg-b30"></div>
                  <div class="df-btn-group df-hero-btn df-style1">
                    <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style4 df-color1"><?php echo esc_html($btn_text); ?></a>
                  </div>
                </div>
                <?php if(!empty($bg_image['url'])): ?>
                  <div class="empty-space marg-lg-b80 marg-sm-b40"></div>
                  <div class="df-hero-img df-style2">
                    <img src="<?php echo esc_url($bg_image['url']); ?>" alt="image">
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="df-circle-shape-wrap">
            <div class="df-circle-shape1"></div>
            <div class="df-circle-shape2"></div>
            <div class="df-circle-shape3"></div>
          </div>
          <svg id="df-svg-wave"><path></path><path></path></svg> 
        </div>
        <?php
        # code...
        break;

      case 'style9': ?>
        <section class="df-hero df-style13 df-flex">
          <div class="df-container">
            <div class="df-row">
              <div class="df-col-lg-6">
                <div class="df-vertical-middle">
                  <div class="df-vertical-middle-in">
                    <div class="df-hero-text">
                      <h1 class="df-fw-medium df-text-slider df-hero-title df-051e31-c df-line1-2"><?php echo wp_kses_post($heading); ?></h1>
                      <div class="df-hero-subtitle df-051e31-c df-line1-6"><?php echo wp_kses_post($description); ?></div>
                      <div class="df-hero-btn">
                        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style4 df-color23"><?php echo esc_html($btn_text); ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- .col -->
              <?php if(!empty($bg_image['url'])): ?>
              <div class="df-col-lg-6">
                <div class="df-hero-img">
                  <img src="<?php echo esc_url($bg_image['url']); ?>" alt="image">
                </div>
              </div><!-- .col -->
              <?php endif; ?>
            </div>
          </div>
        </section>
        <?php
        # code...
        break;
             
   } 

  }
}
