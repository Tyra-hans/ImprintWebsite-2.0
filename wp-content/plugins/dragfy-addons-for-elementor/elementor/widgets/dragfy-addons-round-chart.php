<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
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
class Dragfy_Addons_Round_Chart extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-round-chart';
  }

  public function get_title() {
    return 'Round Chart';
  }

  public function get_icon() {
    return 'elem_icon round_chart';
  }

  public function get_script_depends() {
    return array('chart-min','dragfy-addons');
  }

  public function get_style_depends() {
   return array('chart','dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {

    $this->start_controls_section(
      'round_chart_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_responsive_control(
      'width',
      array(
        'label'       => esc_html__('Width', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 1000,
            'step' => 10,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'default' => array('unit' => 'px', 'size' => '300'),
        'selectors' => array(
          '{{WRAPPER}} .df-round-chart' => 'width: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'align',
      array(
        'label' => esc_html__( 'Alignment', 'dragfy-addons-for-elementor' ),
        'type' => Controls_Manager::CHOOSE,
        'options' => array(
          'none' => array(
            'title' => esc_html__( 'Left', 'dragfy-addons-for-elementor' ),
            'icon'  => 'fa fa-align-left',
          ),
          'auto' => array(
            'title' => esc_html__( 'Center', 'dragfy-addons-for-elementor' ),
            'icon'  => 'fa fa-align-center',
          ),
        ),
        'default'   => 'auto',
        'selectors' => array(
          '{{WRAPPER}} .df-round-chart' => 'margin-left: {{VALUE}}; margin-right:{{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'round_chart_chart_settings',
      array(
        'label' => esc_html__('Chart Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'value',
      array(
        'label'       => esc_html__('Value', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'stroke_color',
      array(
        'label'       => esc_html__('Stroke Color', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('#5752d0', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
      )
    );

    $this->add_control(
      'round_chart',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'label'        => esc_html__('Bitcoin', 'dragfy-addons-for-elementor'),
            'value'        => esc_html__('90', 'dragfy-addons-for-elementor'),
            'stroke_color' => esc_html__('#5752d0', 'dragfy-addons-for-elementor'),
          ),
          array(
            'label'        => esc_html__('Litecoin', 'dragfy-addons-for-elementor'),
            'value'        => esc_html__('40', 'dragfy-addons-for-elementor'),
            'stroke_color' => esc_html__('#7975d9', 'dragfy-addons-for-elementor'),
          ),
          array(
            'label'        => esc_html__('Webcoin', 'dragfy-addons-for-elementor'),
            'value'        => esc_html__('60', 'dragfy-addons-for-elementor'),
            'stroke_color' => esc_html__('#9a97e3', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ label }} - {{ value }}</span>',
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
        'selector'  => '{{WRAPPER}} .df-round-chart',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-round-chart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'description' => esc_html__('You may need to click `Apply` button after settings this option', 'dragfy-addons-for-elementor'),
        'selectors' => array(
          '{{WRAPPER}} .df-round-chart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-round-chart'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-round-chart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'     => 'box_shadow',
        'label'    => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector' => '{{WRAPPER}} .df-round-chart',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'round_chart_label_settings',
      array(
        'label' => esc_html__('Label Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control('label_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-circle-label' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'label_typography',
        'selector' => '{{WRAPPER}} .df-circle-label',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings    = $this->get_settings_for_display();
    $round_chart = $settings['round_chart'];
  ?>

    <div class="df-circle-chart df-round-chart df-style1" data-options="<?php echo esc_attr(json_encode($round_chart)); ?>">
      <div class="df-circle-chart-in">
        <canvas id="df-chart1" height="140" width="140"></canvas>
        <!-- <div class="df-offer-percentage">
          <h4>30%</h4>
          <span>Webcoin</span>
        </div> -->
      </div>
      <?php if(!empty($round_chart) && is_array($round_chart)): ?>
        <ul class="df-circle-stroke df-mp0">
          <?php for($i = 0; $i < count($round_chart); $i++): ?>
            <li>
              <span class="df-circle-color"></span>
              <span class="df-circle-label"></span>
            </li>
          <?php endfor; ?>
        </ul>
      <?php endif; ?>
    </div>
    <?php
    
  }

}
