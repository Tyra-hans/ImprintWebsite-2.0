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
class Webify_Road_Map_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-road-map-widget';
  }

  public function get_title() {
    return 'Road Map';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-slider', 'webify-icon-box');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'road_map_section',
      array(
        'label' => esc_html__('Road Map' , 'webify-addons')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'icon',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'label_block' => true,
        'type'        => \Elementor\Controls_Manager::ICON,
        'options'     => webify_get_icons(),
        'default'     => 'fa fa-exchange'
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'default'     => esc_html__('Your Title', 'webify-addons'),
        'placeholder' => esc_html__('Enter your title here.', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'default'     => esc_html__('Coming up with the genius idea and forming up the business', 'webify-addons'),
        'placeholder' => esc_html__('Enter your content here.', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA
      )
    );

    $repeater->add_control(
      'date',
      array(
        'label'       => esc_html__('Date', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('December 2015', 'webify-addons'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'plans',
      array(
        'label'   => esc_html__('Plans', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'icon'    => 'fa fa-exchange',
            'title'   => esc_html__('Project Starts', 'webify-addons'),
            'content' => esc_html__('Coming up with the genius idea and forming up the business', 'webify-addons'),
            'date'    => esc_html__('December 2017', 'webify-addons')
          ),
          array(
            'icon'    => 'fa fa-exchange',
            'title'   => esc_html__('Token Sale', 'webify-addons'),
            'content' => esc_html__('Coming up with the genius idea and forming up the business', 'webify-addons'),
            'date'    => esc_html__('November 2018', 'webify-addons')
          ),
        ),
        'title_field' => '<i class="{{ icon }}"></i> <span>{{ title }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_road_map_style',
      array(
        'label' => esc_html__('Road Map', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('time_line_color', 
      array(
        'label'       => esc_html__('Timeline Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-roadmap.tb-color1 .tb-icon-box.tb-style2 .tb-box-time'        => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .tb-roadmap.tb-color1 .tb-icon-box.tb-style2 .tb-box-time:before' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_icon_style',
      array(
        'label' => esc_html__('Icon', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('icon_style');

    $this->start_controls_tab(
      'icon_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-roadmap.tb-color1 .tb-icon-box.tb-style2 .tb-icon' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'icon_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('icon_color_hover', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-roadmap.tb-color1 .tb-icon-box.tb-style2 .tb-icon:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();

    $this->start_controls_section('section_title_style',
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
          '{{WRAPPER}} .tb-roadmap-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-roadmap-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_content_style',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-roadmap-content' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-roadmap-content',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

        $this->start_controls_section('section_date_style',
      array(
        'label' => esc_html__('Date', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('date_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-box-time' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'date_typography',
        'selector' => '{{WRAPPER}} .tb-box-time',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings = $this->get_settings_for_display();
    $plans    = $settings['plans']; 

    if(is_array($plans) && !empty($plans)):

  ?>

    <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1 tb-roadmap tb-color1">
      <div class="tb-overflow-hidden">
        <div class="tb-slick-inner-pad-wrap">
          <div class="slick-container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
            <div class="slick-wrapper">

              <?php foreach($plans as $plan): ?>
                <div class="slick-slide">
                  <div class="tb-slick-inner-pad">
                    <div class="tb-icon-box tb-style2 text-center wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.65s">
                      <div class="tb-icon tb-f32-lg tb-mb10"><i class="<?php echo esc_attr($plan['icon']); ?>"></i></div>
                      <h3 class="tb-f18-lg tb-roadmap-title tb-font-name tb-mb8 tb-font-name"><?php echo esc_html($plan['title']); ?></h3>
                      <div class=" tb-roadmap-content tb-mb4"><?php echo wp_kses_post($plan['content']); ?></div>
                      <div class="empty-space marg-lg-b30"></div>
                      <div class="tb-box-time"><?php echo esc_html($plan['date']); ?></div>
                    </div>
                  </div>
                </div><!-- .slick-slide -->
              <?php endforeach; ?>

            </div>
          </div><!-- .slick-container -->
        </div>
      </div>
      <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
      <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
        <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
        <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
      </div>
    </div><!-- .tb-carousor -->

  <?php endif;
    
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Road_Map_Widget() );