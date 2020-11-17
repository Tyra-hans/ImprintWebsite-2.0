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
class Webify_Counter_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-counter-widget';
  }

  public function get_title() {
    return 'Counter';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-text-box', 'webify-counter');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'counter_section',
      array(
        'label' => esc_html__('Counter' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'webify-addons'),
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

    $this->add_control(
      'icon_set',
      array(
        'label'       => esc_html__('Icon Set', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'default',
        'label_block' => true,
        'options' => array(
          'default'  => 'Default',
          'material' => 'Material Icons',
        ),
        'condition'   => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'material_icon_type',
      array(
        'label'       => esc_html__('Icon Type', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'material-icons',
        'label_block' => true,
        'options' => array(
          'material-icons'          => 'Filled',
          'material-icons-outlined' => 'Outlined',
        ),
        'condition'   => array('icon_set' => array('material'))       
      )
    );

    $this->add_control(
      'icon',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => \Elementor\Controls_Manager::ICON,
        'options'     => webify_get_icons(),
        'default'     => 'tbi-Location-2',
        'label_block' => true,
        'condition'   => array('icon_set' => array('default'), 'style' => array('style3'))       
      )
    );

    $this->add_control(
      'icon_material',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => \Elementor\Controls_Manager::SELECT2,
        'options'     => webify_get_icons('material'),
        'default'     => '3d_rotation',
        'description' => '<a href="https://material.io/tools/icons/" target="_blank">https://material.io/tools/icons/</a>',
        'label_block' => true,
        'condition'   => array('icon_set' => array('material'))       
      )
    );

    $this->add_control(
      'count_no',
      array(
        'label'       => esc_html__('Count No', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'default'     => '1.2'
      )
    );

    $this->add_control(
      'suffix',
      array(
        'label'       => esc_html__('Suffix', 'webify-addons'),
        'default'     => esc_html__('k', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1', 'style2'))
      )
    );

    $this->add_control(
      'label',
      array(
        'label'       => esc_html__('Label', 'webify-addons'),
        'default'     => esc_html__('Active Users', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_icon_color',
      array(
        'label' => esc_html__('Icon', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-icon-bg i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-icon-bg' => 'background: {{VALUE}} !important;',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_count_no_color',
      array(
        'label' => esc_html__('Count', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('count_no_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-count-no' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'count_no_typography',
        'selector' => '{{WRAPPER}} .tb-count-no',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_label_color',
      array(
        'label' => esc_html__('Label', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('label_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-label' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'label_typography',
        'selector' => '{{WRAPPER}} .tb-label',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings      = $this->get_settings_for_display();
    $style              = $settings['style'];
    $icon               = $settings['icon'];
    $icon_material      = $settings['icon_material'];
    $icon_set           = $settings['icon_set']; 
    $material_icon_type = $settings['material_icon_type'];

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-text-box tb-style3 text-center tb-radious-4 tb-flex">
          <?php if(!empty($settings['count_no'])): ?>
            <h3 class="tb-f48-lg tb-count-no tb-488bf8-c tb-mt-12 tb-mb4"><?php echo esc_html($settings['count_no']); ?><?php echo esc_html($settings['suffix']); ?></h3>
          <?php endif; ?> 
          <?php if(!empty($settings['label'])): ?>
            <div class="tb-f14-lg tb-label tb-mb-5"><?php echo esc_html($settings['label']); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="tb-funfact tb-style1 text-center tb-box-shadow1">
          <div class="empty-space marg-lg-b30"></div>
          <?php if(!empty($settings['count_no'])): ?>
            <h3 class="tb-f48-lg tb-count-no tb-font-name tb-mb4 tb-mt-2"><?php echo esc_html($settings['count_no']); ?><?php echo esc_html($settings['suffix']); ?></h3>
          <?php endif; ?>
          <?php if(!empty($settings['label'])): ?>
            <div class="tb-label tb-mb4"><?php echo esc_html($settings['label']); ?></div>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="tb-counter tb-style1 tb-color1 tb-radious-4 tb-border">
          <div class="tb-counter-icon tb-f22-lg tb-icon-bg tb-radious-50 tb-flex">
            <?php if($icon_set == 'default'): ?>
              <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php else: ?>
              <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b10"></div>
          <h3 class="tb-counter-number tb-count-no tb-line1 tb-f60-lg tb-font-name tb-m0"><?php echo esc_html($settings['count_no']); ?></h3>
          <?php if(!empty($settings['label'])): ?>
            <div class="tb-counter-title tb-label tb-f16-lg tb-line1-3"><?php echo esc_html($settings['label']); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;
    }
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Counter_Widget() );