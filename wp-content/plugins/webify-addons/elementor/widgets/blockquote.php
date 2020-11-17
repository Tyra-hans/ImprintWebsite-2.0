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
class Webify_Blockquote_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-block-quote-widget';
  }

  public function get_title() {
    return 'Blockquote';
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
      'blockquote_section',
      array(
        'label' => esc_html__('Blockquote' , 'webify-addons')
      )
    );

    $this->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => '“It\'s difficult to deliver a boutique fashion ecommerce site that showcases a compelling brand experience but also converts. Webify delivered just that.”'
      )
    );

    $this->add_control(
      'cite',
      array(
        'label'       => esc_html__('Cite', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Guthrie Ferguson, Brand Director', 'webify-addons')
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_content',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-blockquote' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-blockquote',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_cite',
      array(
        'label' => esc_html__('Cite', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('cite_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-blockquote-cite' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'cite_typography',
        'selector' => '{{WRAPPER}} .tb-blockquote-cite',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $content  = $settings['content'];
    $cite     = $settings['cite'];
    if(!empty($content)):
  ?>
    <blockquote class="tb-font-name tb-blockquote"><?php echo wp_kses_post($content); ?>
      <?php if(!empty($cite)): ?>
        <small class="tb-blockquote-cite"><?php echo esc_html($cite); ?></small>
      <?php endif; ?>
    </blockquote>
  <?php endif;
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Blockquote_Widget() );