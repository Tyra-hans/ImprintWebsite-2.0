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
class Webify_Contact_Details_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-contact-details-widget';
  }

  public function get_title() {
    return 'Contact Details';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array();
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'contact_details_section',
      array(
        'label' => esc_html__('Contact Details' , 'webify-addons')
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
        'condition'   => array('icon_set' => array('default'))       
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
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Event Location', 'webify-addons')       
      )
    );

    $this->add_control(
      'details',
      array(
        'label'       => esc_html__('Details', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => '445 Mount Eden Road,arters Beach<br>Westport. Mount Eden, Auckland.'      
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
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-contact-info i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_title_color',
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
          '{{WRAPPER}} .tb-contact-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-contact-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_details_color',
      array(
        'label' => esc_html__('Details', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('details_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-contact-details' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'details_typography',
        'selector' => '{{WRAPPER}} .tb-contact-details',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings = $this->get_settings();
    $title              = $settings['title'];
    $icon               = $settings['icon'];
    $icon_material      = $settings['icon_material'];
    $icon_set           = $settings['icon_set'];
    $material_icon_type = $settings['material_icon_type'];
    $details            = $settings['details'];

  ?>
    <div class="tb-contact-info tb-style1 tb-border tb-radious-4 tb-white-bg tb-posi tb-relative">
      <div class="tb-location-icon tb-f16-lg">
        <?php if($icon_set == 'default'): ?>
          <i class="<?php echo esc_attr($icon); ?>"></i>
        <?php else: ?>
          <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
        <?php endif; ?>
      </div>
      <h3 class="tb-f18-lg tb-font-name tb-contact-title tb-mt-3 tb-mb5"><?php echo esc_html($title); ?></h3>
      <div class="tb-mb-6 tb-contact-details"><?php echo wp_kses_post($details); ?></div>
    </div>
   <?php
    
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Contact_Details_Widget() );