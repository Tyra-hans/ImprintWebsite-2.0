<?php 
namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Line_Chart_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-line-chart-widget';
  }

  public function get_title() {
    return 'Line Chart';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('chart-min');
  }

  public function get_style_depends() {
    return array('webify-chart');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'line_chart_section',
      array(
        'label' => esc_html__('Line Chart' , 'webify-addons')
      )
    );

    $this->add_control(
      'chart_title',
      array(
        'label'       => esc_html__('Chart Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Price History', 'webify-addons'),
      )
    );

    $this->add_control(
      'x_axis_value',
      array(
        'label'       => esc_html__('X-axis Values', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'description' => esc_html__('Enter values for axis (Note: separate values with ",").', 'webify-addons'),
        'default'     => esc_html__('100, 200, 300, 400, 500', 'webify-addons'),
      )
    );

    $this->add_control(
      'y_axis_label',
      array(
        'label'       => esc_html__('Y-axis Label', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Price', 'webify-addons'),
      )
    );

    $this->add_control(
      'y_axis_value',
      array(
        'label'       => esc_html__('Y-axis Values', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'description' => esc_html__('Enter values for axis (Note: separate values with ",").', 'webify-addons'),
        'default'     => esc_html__('100, 50, 150, 100, 30', 'webify-addons'),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_chart_bg_color_style',
      array(
        'label' => esc_html__('Background Color', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('chart_bg_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_chart_border_color_style',
      array(
        'label' => esc_html__('Border Color', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('chart_border_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings           = $this->get_settings();
    $x_axis_value       = $settings['x_axis_value'];
    $y_axis_value       = $settings['y_axis_value'];
    $y_axis_label       = $settings['y_axis_label'];
    $chart_bg_color     = $settings['chart_bg_color'];
    $chart_border_color = $settings['chart_border_color'];

    $values = json_encode(array(
      'view_labels'  => '['.$x_axis_value.']',
      'view_data'    => '['.$y_axis_value.']',
    ));

    $data_bg_color     = (!empty($chart_bg_color)) ? ' data-bg-color="'.esc_attr($chart_bg_color).'"':'data-bg-color="rgba(87, 82, 208, 0.04)"';
    $data_border_color = (!empty($chart_border_color)) ? ' data-border-color="'.esc_attr($chart_border_color).'"':'data-border-color="#5752d0"';
    $data_attr         = (!empty($data_bg_color) || !empty($data_border_color)) ? $data_bg_color.' '.$data_border_color:'';

  ?>

    <div class="tb-graph-chart tb-style1 tb-line-chart tb-box-shadow1" <?php echo wp_kses_post($data_attr); ?> data-y-label="<?php echo esc_attr($y_axis_label); ?>" data-values='<?php echo wp_kses_post($values); ?>'>
      <canvas id="tb-chart2" height="220"></canvas>
      <div class="tb-graph-title"><?php echo esc_html($settings['chart_title']); ?></div>
    </div>
  <?php

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Line_Chart_Widget() );