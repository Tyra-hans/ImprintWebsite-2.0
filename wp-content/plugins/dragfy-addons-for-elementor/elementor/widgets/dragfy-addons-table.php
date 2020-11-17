<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Table extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-table';
  }

  public function get_title() {
    return 'Table';
  }

  public function get_icon() {
    return 'elem_icon table';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('table', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {

    $this->start_controls_section(
      'table_heading_settings',
      array(
        'label' => esc_html__('Heading Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'heading_one',
      array(
        'label'       => esc_html__('Heading One', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Features', 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'heading_two',
      array(
        'label'       => esc_html__('Heading Two', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Free', 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'heading_three',
      array(
        'label'       => esc_html__('Heading Three', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Pro', 'dragfy-addons-for-elementor')
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'content_settings',
      array(
        'label'     => esc_html__('Content Settings' , 'dragfy-addons-for-elementor'),
      )
    );


    $repeater = new Repeater();

    $repeater->add_control(
      'heading_one_value',
      array(
        'label'       => esc_html__('Heading One Value', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('30 Basic Widgets', 'dragfy-addons-for-elementor')
      )
    );

    $repeater->add_control(
      'heading_two_value', 
      array(
        'label'       => esc_html__('Heading Two Value', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::CHOOSE,
        'label_block' => true,
        'options' => array(
          'icon_check' => array(
            'icon'  => 'fas fa-check',
          ),
          'icon_cross' => array(
            'icon'  => 'fas fa-times',
          ),
        ),
        'default'   => 'icon_check',
      )
    );

    $repeater->add_control(
      'heading_three_value', 
      array(
        'label'       => esc_html__('Heading Three Value', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::CHOOSE,
        'label_block' => true,
        'options' => array(
          'icon_check' => array(
            'icon'  => 'fas fa-check',
          ),
          'icon_cross' => array(
            'icon'  => 'fas fa-times',
          ),
        ),
        'default'   => 'icon_check',
      )
    );

    $repeater->add_control('content_styling_heading', 
      array(
        'label' => esc_html__('Styling', 'dragfy-addons-for-elementor'),
        'type'  => Controls_Manager::HEADING,
      )
    );

    $repeater->add_control('heading_one_value_color', 
      array(
        'label'     => esc_html__('Heading One Value Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} .df-table-value' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control('heading_two_value_color', 
      array(
        'label'     => esc_html__('Heading Two Value Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} .df-table-value-two i' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control('heading_three_value_color', 
      array(
        'label'     => esc_html__('Heading Three Value Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} .df-table-value-three i' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control('bg_color', 
      array(
        'label'     => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} .df-table-value' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control(
      'items',
      array(
        'label'     => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::REPEATER,
        'fields'    => $repeater->get_controls(),
        'default' => array(
          array(
            'heading_one_value'   => esc_html__('30 Basic Widgets', 'dragfy-addons-for-elementor'),
            'heading_two_value'   => 'icon_check',
            'heading_three_value' => 'icon_cross'
          ),
        ),
        'title_field' => '<span>{{ heading_one_value }}</span>',
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
        'selector'  => '{{WRAPPER}} .df-table-wrap',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-table-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-table-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-table-wrap'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-table-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-table-wrap',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_heading_style',
      array(
        'label' => esc_html__('Heading Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('heading_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-table-heading' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-table-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'heading_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-table-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .df-table-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_content_style',
      array(
        'label' => esc_html__('Content Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'content_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-table-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .df-table-value',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 

    $settings      = $this->get_settings();
    $heading_one   = $settings['heading_one'];
    $heading_two   = $settings['heading_two'];
    $heading_three = $settings['heading_three'];
    $items         = $settings['items'];

    if(!empty($items) && is_array($items)):

  ?>

      <div class="df-table df-table-wrap df-style1 df-type1 df-border df-radious-4">

                                            
        <div class="df-table-row df-table-heading">
          <div class="df-table-col df-table-title"><?php echo esc_html($heading_one); ?></div>
          <div class="df-table-col df-table-title"><?php echo esc_html($heading_two); ?></div>
          <div class="df-table-col df-table-title"><?php echo esc_html($heading_three); ?></div>
        </div>

        <?php foreach($items as $item): ?>
          <div class="df-table-row elementor-repeater-item-<?php echo $item['_id']; ?>">
            <div class="df-table-col df-table-value">
              <?php echo esc_html($item['heading_one_value']); ?>
            </div>
            <div class="df-table-col df-table-value df-table-value-two">
              <div class="df-table-icon"><i aria-hidden="true" class="<?php echo ($item['heading_two_value'] == 'icon_check') ? 'fa fa-check':'fa fa-times'; ?>"></i></div>
            </div>
            <div class="df-table-col df-table-value df-table-value-three">
              <div class="df-table-icon"><i aria-hidden="true" class="<?php echo ($item['heading_three_value'] == 'icon_check') ? 'fa fa-check':'fa fa-times'; ?>"></i></div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    <?php
    endif;
    
  }
}
