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
class Webify_Award_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-award-widget';
  }

  public function get_title() {
    return 'Award';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-slider', 'webify-award');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'award_section',
      array(
        'label' => esc_html__('Award' , 'webify-addons')
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label'     => esc_html__('Autoplay', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'separator' => 'after',
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => esc_html__('Loop', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'separator' => 'after',
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => esc_html__('Speed', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => 600
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'webify-addons'),
        'type'        => Controls_Manager::MEDIA,
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('The European Business Award', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Winner 2016', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
      )
    );

    $this->add_control(
      'awards',
      array(
        'label'   => esc_html__('Awards', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'title'   => esc_html__('The European Business Award', 'webify-addons'),
            'content' => esc_html__('Winner 2016', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_title',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-award-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-award-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
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
        'selectors' => array(
          '{{WRAPPER}} .tb-award-year' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-award-year',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_bg_hover',
      array(
        'label' => esc_html__('Background on Hover', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('bg_hover_color', 
      array(
        'label'       => esc_html__('Background', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-award-text' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $awards   = $settings['awards'];
  ?>

    <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
      <div class="tb-slick-inner-pad-wrap">
        <div class="slick-container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"  data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="6">
          <div class="slick-wrapper">

            <?php foreach($awards as $award): if(!empty($award['image']['url'])): ?>
              <div class="slick-slide">
                <div class="tb-slick-inner-pad">
                  <div class="tb-award-box tb-style1 tb-border tb-radious-4 tb-relative tb-flex">
                    <div class="tb-award-img">
                      <img src="<?php echo esc_url($award['image']['url']); ?>" alt="award">
                    </div>
                    <div class="tb-award-text">
                      <h3 class="tb-award-title tb-white-c tb-m0 tb-f18-lg"><?php echo esc_html($award['title']); ?></h3>
                      <div class="tb-award-year tb-white-c"><?php echo esc_html($award['content']); ?></div>
                    </div>
                  </div>
                </div>
              </div><!-- .slick-slide -->
            <?php endif; endforeach; ?>

          </div>
        </div><!-- .slick-container -->
      </div>
      <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
      <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
        <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
        <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
      </div>
    </div><!-- .tb-carousor -->

    <?php

  }
    
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Award_Widget() );