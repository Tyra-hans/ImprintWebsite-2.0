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
class Webify_Progress_Bar_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-progress-bar-widget';
  }

  public function get_title() {
    return 'Progress Bar';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-progress-bar');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'progress_bar_section',
      array(
        'label' => esc_html__('Progress Bar' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Development', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('150M', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'value',
      array(
        'label'       => esc_html__('Value', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('90', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'progress_bars',
      array(
        'label'   => esc_html__('Progress Bar', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'title'   => esc_html__('Development', 'webify-addons'),
            'label'   => esc_html__('150M', 'webify-addons'),
            'value'   => esc_html__('90', 'webify-addons'),
          ),
          array(
            'title'   => esc_html__('Profit', 'webify-addons'),
            'label'   => esc_html__('20B', 'webify-addons'),
            'value'   => esc_html__('40', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ title }} - {{ value }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_progress_bar_style',
      array(
        'label' => esc_html__('Bar Background', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('bar_bg_color', 
      array(
        'label'       => esc_html__('Bar Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-progressbar.tb-style1 .tb-single-bar' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('progress_bg_color', 
      array(
        'label'       => esc_html__('Progress Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-progressbar.tb-style1 .tb-single-bar-in' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_label_style',
      array(
        'label' => esc_html__('Label', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('label_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-progressbar-label' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'label_typography',
        'selector' => '{{WRAPPER}} .tb-progressbar-label',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-progressbar-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-progressbar-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_value_style',
      array(
        'label' => esc_html__('Value', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('value_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-progressbar-value' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'value_typography',
        'selector' => '{{WRAPPER}} .tb-progressbar-value',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings      = $this->get_settings_for_display();
    $style         = $settings['style'];
    $progress_bars = $settings['progress_bars']; 

    if(is_array($progress_bars) && !empty($progress_bars)):


      switch ($style) {
        case 'style1':
        default: ?>
          <div class="tb-box-shadow1 tb-progressbar tb-style1">

            <?php foreach($progress_bars as $bar): ?>

              <div class="tb-single-progressbar">
                <div class="tb-single-bar-title">
                  <span class="tb-grayb5b5b5-c tb-progressbar-title"><?php echo esc_html($bar['title']); ?></span>
                  <span class="tb-progressbar-label"><?php echo esc_html($bar['label']); ?></span>
                </div>
                <div class="tb-single-bar" data-progress-percentage="<?php echo esc_attr($bar['value']); ?>">
                  <div class="tb-single-bar-in"></div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <?php
          # code...
          break;

        case 'style2': ?>
          <div class="tb-progressbar tb-style1 tb-type1 tb-color1 row">

            <?php foreach($progress_bars as $bar): ?>
              <div class="col-lg-6 tb-single-progressbar">
                <h3 class="tb-progressbar-number tb-progressbar-value tb-f36-lg tb-line1-2 tb-m0"><?php echo esc_attr($bar['value']); ?>%</h3>
                <div class="empty-space marg-lg-b10"></div>
                <div class="tb-single-bar" data-progress-percentage="<?php echo esc_attr($bar['value']); ?>">
                  <div class="tb-single-bar-in"></div>
                </div>
                <h2 class="tb-single-bar-title tb-progressbar-title tb-line1-6 tb-f14-lg"><?php echo esc_html($bar['title']); ?></h2>
              </div>
            <?php endforeach; ?>

          </div>
          <?php
          # code...
          break;
      
      }
    endif;
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Progress_Bar_Widget() );