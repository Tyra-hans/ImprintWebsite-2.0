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
class Webify_Feature_Lists_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-feature-lists-widget';
  }

  public function get_title() {
    return 'Feature Lists';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-funfact');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'feature_lists_section',
      array(
        'label' => esc_html__('Feature List' , 'webify-addons')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'image',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => Controls_Manager::MEDIA,
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'list',
      array(
        'label'       => esc_html__('List', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Secure like Forte', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'lists',
      array(
        'label'   => esc_html__('Lists', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'list'  => esc_html__('Secure like Forte', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ list }}</span>',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_style_lists',
      array(
        'label' => esc_html__('Lists', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('lists_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-feature-list' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'      => 'lists_typography',
        'selector'  => '{{WRAPPER}} .tb-feature-list',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'lists_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-feature-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        'separator' => 'before',
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $lists    = $settings['lists'];

    if(is_array($lists) && !empty($lists)):
  ?>

    <div class="tb-vertical-middle">
      <ul class="tb-feature-list tb-mp0 tb-f18-lg  tb-line1-5 tb-black111-c">
        <?php foreach($lists as $list): ?>
          <li>
            <?php if(!empty($list['image']['url'])): ?>
              <img src="<?php echo esc_url($list['image']['url']); ?>" alt="list-img">
            <?php endif; ?>
            <?php echo esc_html($list['list']); ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php
    endif;

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Feature_Lists_Widget() );