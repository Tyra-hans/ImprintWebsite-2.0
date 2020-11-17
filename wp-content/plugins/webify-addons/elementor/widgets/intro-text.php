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
class Webify_Intro_Text_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-intro-text-widget';
  }

  public function get_title() {
    return 'Intro Text';
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


  protected function _register_controls() {
    $this->start_controls_section(
      'intro_section',
      array(
        'label' => esc_html__('Intro Text' , 'webify-addons')
      )
    );

    $this->add_control(
      'intro_content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'default'     => esc_html__('Cooperation is key to any project and our priority will always be towards clients that have a clear view of where they want to be.', 'webify-addons'),
        'label_block' => true        
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'webify-addons'),
        'default'     => esc_html('Learn More', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#')
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_style_content',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-intro-text .tb-sample-text p' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-intro-text .tb-sample-text p',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_link_style',
      array(
        'label' => esc_html__('Link', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('link_style');

    $this->start_controls_tab(
      'link_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('link_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:before' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'link_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('link_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 

    $settings  = $this->get_settings();
    $content   = $settings['intro_content'];
    $link_url  = $settings['link_url'];
    $link_text = $settings['link_text'];
    $href      = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $target    = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

  ?>

    <div class="tb-intro-text text-center">
      <?php if(!empty($content)): ?>
      <div class="tb-sample-text tb-f18-lg tb-line1-6 tb-mt-5">
        <p><?php echo wp_kses_post($content); ?></p>
      </div>
      <?php endif; ?>
      <div class="empty-space marg-lg-b15"></div>
      <?php if(!empty($link_text)): ?>
        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style1"><?php echo esc_html($link_text); ?></a>
      <?php endif; ?>
    </div>
  <?php

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Intro_Text_Widget() );