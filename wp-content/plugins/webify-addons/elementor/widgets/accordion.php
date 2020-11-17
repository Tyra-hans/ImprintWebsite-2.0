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
class Webify_Accordion_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-accordion-widget';
  }

  public function get_title() {
    return 'Accordion';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-accordian');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'accordion_section',
      array(
        'label' => esc_html__('Accordion' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'webify-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'accordion_title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Accordion Title', 'webify-addons')
      )
    );

    $repeater->add_control(
      'accordion_content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Accordion Content', 'webify-addons'),
        'type'        => Controls_Manager::WYSIWYG
      )
    );

    $this->add_control(
      'accordion_items',
      array(
        'label'   => esc_html__('Accordion Items', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'accordion_title'   => esc_html__('Accordion #1', 'webify-addons'),
            'accordion_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'webify-addons')
          ),
          array(
            'accordion_title'   => esc_html__('Accordion #2', 'webify-addons'),
            'accordion_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'webify-addons')
          ),
        ),
        'title_field' => '{{ accordion_title }}',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_accordion_style',
      array(
        'label' => esc_html__('Accordion', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-accordian-wrap .tb-accordian-toggle'                    => 'color: {{VALUE}};',
          '{{WRAPPER}} .tb-accordian-wrap, 
           {{WRAPPER}} .tb-accordian-wrap .tb-accordian,
           {{WRAPPER}} .tb-accordian-wrap.tb-style1.tb-type1 .tb-accordian.active' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_accordion_title_style',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-accordian-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-accordian-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_accordion_content_style',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-accordian-body' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-accordian-body',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings        = $this->get_settings_for_display();
    $style           = $settings['style'];
    $accordion_items = $settings['accordion_items'];
  
    switch ($style) {
      case 'style1': default: ?>
        <div class="tb-accordian-wrap tb-style1">
          <?php 
            foreach($accordion_items as $key => $item): 
              $active_nav = ( ( $key + 1 ) == 1 ) ? ' active ' : '';
              $title      = $item['accordion_title'];
              $content    = $item['accordion_content'];
          ?>
            <div class="tb-accordian<?php echo esc_attr($active_nav); ?>">
              <div class="tb-accordian-title tb-fw-regular tb-f18-lg tb-black111-c tb-font-name">
                <?php echo esc_html($title); ?> <span class="tb-accordian-toggle fa fa-angle-down"></span>
              </div>
              <div class="tb-accordian-body"><?php echo wp_kses_post($content); ?></div>
            </div><!-- .tb-accordian -->
          <?php endforeach; ?>

        </div><!-- .tb-accordian-wrap -->
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="tb-accordian-wrap tb-style1 tb-type1">
          <?php 
            foreach($accordion_items as $key => $item): 
              $active_nav = ( ( $key + 1 ) == 1 ) ? ' active ' : '';
              $title      = $item['accordion_title'];
              $content    = $item['accordion_content'];
          ?>
            <div class="tb-accordian<?php echo esc_attr($active_nav); ?>">
              <div class="tb-accordian-title tb-fw-regular tb-f16-lg">
                <?php echo esc_html($title); ?> <span class="tb-accordian-toggle fa fa-angle-down"></span>
              </div>
              <div class="tb-accordian-body"><?php echo wp_kses_post($content); ?></div>
            </div><!-- .tb-accordian -->
          <?php endforeach; ?>

        </div><!-- .tb-accordian-wrap -->
        <?php
        # code...
        break;
    }

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Accordion_Widget() );