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
class Webify_Image_Box_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-box-widget';
  }

  public function get_title() {
    return 'Image Box';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-image-box', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'image_box_section',
      array(
        'label' => esc_html__('Image Box' , 'webify-addons')
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Super Creative', 'webify-addons')       
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => esc_html__('You can choose from 320+ icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'webify-addons')       
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons')
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

    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('title_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box .tb-image-box-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-image-box .tb-image-box-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'title_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('title_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box:hover .tb-image-box-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

    $this->start_controls_section('section_description_color',
      array(
        'label' => esc_html__('Description', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );



    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box .tb-image-box-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-image-box .tb-image-box-text',
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
          '{{WRAPPER}} .tb-image-box .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box .tb-btn:before' => 'background: {{VALUE}};',
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
          '{{WRAPPER}} .tb-image-box .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box .tb-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 
    $settings    = $this->get_settings();
    $title       = $settings['title'];
    $image       = $settings['image'];
    $description = $settings['description'];
    $link_url    = $settings['link_url'];
    $link_text   = $settings['link_text'];
    $href        = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $target      = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

  ?>

    <div class="tb-image-box tb-style4 tb-zoom tb-radious-4 tb-relative tb-border text-center">
      <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
        <div class="tb-image tb-overflow-hidden">
          <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
        </div>
      <?php endif; ?>
      <?php if(!empty($title) || !empty($description)): ?>
        <div class="empty-space marg-lg-b30"></div>
        <div class="tb-image-meta">
          <h3 class="tb-f18-lg tb-font-name tb-font-name tb-image-box-heading tb-mt-3 tb-mb-6"><?php echo esc_html($title); ?></h3>
          <div class="empty-space marg-lg-b20"></div>
          <div class=" tb-mt-5 tb-mb-6 tb-image-box-text tb-description-text"><?php echo wp_kses_post($description); ?></div>
        </div>
        <div class="empty-space marg-lg-b30"></div>
      <?php endif; ?>
      <?php if(!empty($link_text)): ?>
        <div class="tb-image-box-btn tb-mt-7">
          <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style1"><?php echo esc_html($link_text); ?></a>
        </div>
        <div class="empty-space marg-lg-b30"></div>
      <?php endif; ?>
    </div>


   <?php
    
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Box_Widget() );