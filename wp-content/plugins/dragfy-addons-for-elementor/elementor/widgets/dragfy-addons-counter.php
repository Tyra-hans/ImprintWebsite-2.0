<?php
 
namespace DragfyAddons\Elementor\Widgets;
use DragfyAddons\Helpers\Helpers;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
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
class Dragfy_Addons_Counter extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-counter';
  }

  public function get_title() {
    return 'Counter';
  }

  public function get_icon() {
    return 'elem_icon counter';
  }

  public function get_script_depends() {
    return array('counter', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('text-box', 'counter', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'counter_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
          'style3' => 'Style 3',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'icon_settings',
      array(
        'label'     => esc_html__('Icon Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'selected_icon',
      array(
        'label'            => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'fa4compatibility' => 'icon',
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'count_settings',
      array(
        'label' => esc_html__('Count Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'count_no',
      array(
        'label'       => esc_html__('Count No', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'default'     => '1.2'
      )
    );

    $this->add_control(
      'suffix',
      array(
        'label'       => esc_html__('Suffix', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('k', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1', 'style2'))
      )
    );

    $this->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'dragfy-addons-for-elementor'),
        'default'     => esc_html__('Active Users', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
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
        'selector'  => '{{WRAPPER}} .df-counter',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-counter'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-counter',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_icon_color',
      array(
        'label' => esc_html__('Icon Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-icon-bg i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-icon-bg' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_count_no_color',
      array(
        'label' => esc_html__('Count Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('count_no_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-count-no' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'count_no_typography',
        'selector' => '{{WRAPPER}} .df-count-no',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'count_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-count-no' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_label_color',
      array(
        'label' => esc_html__('Label Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('label_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-label' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'label_typography',
        'selector' => '{{WRAPPER}} .df-label',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'label_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings      = $this->get_settings_for_display();
    $style         = $settings['style'];
    $selected_icon = $settings['selected_icon'];

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="df-text-box df-counter df-style3 text-center df-radious-4 df-flex">
          <?php if(!empty($settings['count_no'])): ?>
            <h3 class="df-f48-lg df-count-no df-488bf8-c df-mt-12 df-mb4"><span data-count-to="<?php echo esc_html($settings['count_no']); ?>" class="counter"></span><?php echo esc_html($settings['suffix']); ?></h3>
          <?php endif; ?> 
          <?php if(!empty($settings['label'])): ?>
            <div class="df-f14-lg df-label df-mb-5"><?php echo esc_html($settings['label']); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="df-funfact df-counter df-style1 text-center df-box-shadow1">
          <div class="empty-space marg-lg-b30"></div>
          <?php if(!empty($settings['count_no'])): ?>
            <h3 class="df-f48-lg df-count-no df-font-name df-mb4 df-mt-2"><span data-count-to="<?php echo esc_html($settings['count_no']); ?>" class="counter"></span><?php echo esc_html($settings['suffix']); ?></h3>
          <?php endif; ?>
          <?php if(!empty($settings['label'])): ?>
            <div class="df-label df-mb4"><?php echo esc_html($settings['label']); ?></div>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="df-counter df-style1 df-color1 df-radious-4 df-border">
          <div class="df-counter-icon df-f22-lg df-icon-bg df-radious-50 df-flex">
            <?php if(is_array($selected_icon) && $selected_icon['library'] == 'svg'): ?>
              <img src="<?php echo esc_url($selected_icon['value']['url']); ?>" alt="icon">
            <?php else: ?>
              <i class="<?php echo esc_attr($selected_icon['value']); ?>"></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b10"></div>
          <h3 class="df-counter-number df-count-no df-line1 df-f60-lg df-font-name df-m0"><span data-count-to="<?php echo esc_html($settings['count_no']); ?>" class="counter"></span></h3>
          <?php if(!empty($settings['label'])): ?>
            <div class="df-counter-title df-label df-f16-lg df-line1-3"><?php echo esc_html($settings['label']); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;
    }
  }
}
