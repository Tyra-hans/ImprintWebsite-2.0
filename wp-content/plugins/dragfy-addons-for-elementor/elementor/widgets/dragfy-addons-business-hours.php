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
class Dragfy_Addons_Business_Hours extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-business-hours';
  }

  public function get_title() {
    return 'Business Hours';
  }

  public function get_icon() {
    return 'elem_icon business_hours';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('business-hour', 'button', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {

    $this->start_controls_section(
      'business_hours_heading_settings',
      array(
        'label' => esc_html__('Heading Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Office Opening Hours', 'dragfy-addons-for-elementor')
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
      'day',
      array(
        'label'       => esc_html__('Day', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Sunday', 'dragfy-addons-for-elementor')
      )
    );

    $repeater->add_control(
      'time',
      array(
        'label'       => esc_html__('Time', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Sunday', 'dragfy-addons-for-elementor')
      )
    );

    $repeater->add_control('content_styling_heading', 
      array(
        'label' => esc_html__('Styling', 'dragfy-addons-for-elementor'),
        'type'  => Controls_Manager::HEADING,
      )
    );

    $repeater->add_control('day_color', 
      array(
        'label'     => esc_html__('Day Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} .df-day' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control('time_color', 
      array(
        'label'     => esc_html__('Time Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} .df-time' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control('bg_color', 
      array(
        'label'     => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control('border_color', 
      array(
        'label'     => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
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
            'day'  => esc_html__('Sunday', 'dragfy-addons-for-elementor'),
            'time' => esc_html__('8:00 AM - 5:00 PM', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ day }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'business_hours_button_settings',
      array(
        'label'     => esc_html__('Button Settings' , 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Button Text', 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
      )
    );


    $this->end_controls_section();

    $this->start_controls_section(
      'business_hours_contact_number_settings',
      array(
        'label'     => esc_html__('Contact Number Settings' , 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'contact_number',
      array(
        'label'       => esc_html__('Phone Number', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('+40 050 123044', 'dragfy-addons-for-elementor')
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'pro_section',
        array(
          'label' => esc_html__('Go Premium for More Features', 'dragfy-addons-for-elementor')
        )
    );

    $this->add_control(
      'get_pro',
      array(
        'label' => esc_html__('Unlock more possibilities', 'dragfy-addons-for-elementor' ),
        'type'  => Controls_Manager::CHOOSE,
        'options' => array(
          '1' => array(
            'title' => esc_html__('', 'dragfy-addons-for-elementor'),
            'icon'  => 'fa fa-unlock-alt',
          ),
        ),
        'default'     => '1',
        'description' => '<span class="pro-feature"> Get the  <a href="https://dragfy.com/elementor-addons/" target="_blank">Pro version</a> for more stunning elements and customization options.</span>'
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
        'selector'  => '{{WRAPPER}} .df-business-hour-wrap',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-business-hour-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-business-hour-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-business-hour-wrap'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-business-hour-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-business-hour-wrap',
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
          '{{WRAPPER}} .df-business-hour-heading' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('heading_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-business-hours' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-business-hour-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .df-business-hour-heading',
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
          '{{WRAPPER}} .df-business-hours li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .df-business-hours li',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_button_style',
      array(
        'label'     => esc_html__('Button Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'btn_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_border',
        'selector' => '{{WRAPPER}} .df-btn'
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .df-btn',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('btn_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_hover_border',
        'selector' => '{{WRAPPER}} .df-btn:hover'
      )
    );

    $this->add_control('btn_text_hover_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_hover_typography',
        'selector' => '{{WRAPPER}} .df-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_hover_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn:hover',
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_contact_number_style',
      array(
        'label' => esc_html__('Contact Number Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('contact_number_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-business-number' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'contact_number_typography',
        'selector' => '{{WRAPPER}} .df-business-number',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings       = $this->get_settings();
    $items          = $settings['items'];
    $heading        = $settings['heading'];
    $contact_number = $settings['contact_number'];
    $btn_text       = $settings['btn_text'];
    $href           = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target         = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';

    if(!empty($items) && is_array($items)): ?>
      <div class="df-business-hour-wrap">
        <h2 class="df-business-hour-heading"><?php echo esc_html($heading); ?></h2>
        <ul class="df-business-hours">
          <?php foreach($items as $item): ?>
            <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
              <div class="df-business-hour-title df-day"><?php echo esc_html($item['day']); ?></div>
              <div class="df-business-hour-time df-time"><?php echo esc_html($item['time']); ?></div>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="df-business-hour-meta">
          <div class="df-business-number"><?php echo esc_html($contact_number); ?></div>
          <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style3 df-color23"><?php echo esc_html($btn_text); ?></a>
        </div>
      </div>
      <?php
    endif;
  }
}
