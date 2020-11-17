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
class Webify_Round_Chart_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-round-chart-widget';
  }

  public function get_title() {
    return 'Round Chart';
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
      'round_chart_section',
      array(
        'label' => esc_html__('Round Chart' , 'webify-addons')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Bitcoin', 'webify-addons'),
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

    $repeater->add_control(
      'stroke_color',
      array(
        'label'       => esc_html__('Stroke Color', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('#4ed55f', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
      )
    );

    $this->add_control(
      'round_chart',
      array(
        'label'   => esc_html__('Round Chart', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'label'        => esc_html__('Bitcoin', 'webify-addons'),
            'value'        => esc_html__('90', 'webify-addons'),
            'stroke_color' => esc_html__('#4ed55f', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ label }} - {{ value }}</span>',
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings    = $this->get_settings_for_display();
    $round_chart = $settings['round_chart'];
  ?>

    <div class="tb-circle-chart tb-round-chart tb-style1 tb-box-shadow1" data-options="<?php echo esc_attr(json_encode($round_chart)); ?>">
      <div class="tb-circle-chart-in">
        <canvas id="tb-chart1" height="140" width="140"></canvas>
        <div class="tb-offer-percentage">
          <h4>30%</h4>
          <span>Webcoin</span>
        </div>
      </div>
      <?php if(!empty($round_chart) && is_array($round_chart)): ?>
        <ul class="tb-circle-stroke tb-mp0">
          <?php for($i = 0; $i < count($round_chart); $i++): ?>
            <li>
              <span class="tb-circle-color"></span>
              <span class="tb-circle-label"></span>
            </li>
          <?php endfor; ?>
        </ul>
      <?php endif; ?>
    </div>
    <?php
    
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Round_Chart_Widget() );