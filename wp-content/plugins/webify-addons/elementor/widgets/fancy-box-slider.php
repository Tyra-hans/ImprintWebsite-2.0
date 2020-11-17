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
class Webify_Fancy_Box_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-fancy-box-slider-widget';
  }

  public function get_title() {
    return 'Fancy Box Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-fancy-box', 'webify-button', 'webify-slider', 'slick');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'fancy_box_slider_section',
      array(
        'label' => esc_html__('Fancy Box Slider' , 'webify-addons')
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
      'delay',
      array(
        'label'     => esc_html__('Delay', 'webify-addons'),
        'type'      => Controls_Manager::TEXT,
        'separator' => 'after',
        'default'   => 2000,
        'condition' => array('autoplay' => 'yes')
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
      'bg_image',
      array(
        'label'     => esc_html__('Background Image', 'webify-addons'),
        'type'      => Controls_Manager::MEDIA,
      )
    );

    $repeater->add_control(
      'sub_title',
      array(
        'label'       => esc_html__('Sub Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Episode 1020', 'webify-addons'),
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Take control of your commute with Google Maps', 'webify-addons'),
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Listen on iTunes', 'webify-addons'),
      )
    );

    $repeater->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#'),
      )
    );

    $this->add_control(
      'fancy_boxes',
      array(
        'label'   => esc_html__('Fancy Boxes', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'bg_image' => array('url' => \Elementor\Utils::get_placeholder_image_src()),
            'subtitle' => esc_html__('Episode 1020', 'webify-addons'),
            'title'    => esc_html__('Take control of your commute with Google Maps', 'webify-addons'),
            'btn_text' => esc_html__('Listen on iTunes', 'webify-addons'),
            'btn_url'  => array('url' => '#')
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_sub_title_color',
      array(
        'label' => esc_html__('Sub Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('sub_title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-fancybox-subtitle' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_title_typography',
        'selector' => '{{WRAPPER}} .tb-fancybox-subtitle',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
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
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-fancybox-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-fancybox-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_button_style',
      array(
        'label' => esc_html__('Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('button_style');

    $this->start_controls_tab(
      'button_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('button_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('button_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'button_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('button_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-fancybox.tb-style4:hover .tb-btn.tb-style3' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('button_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 
    $settings    = $this->get_settings();
    $fancy_boxes = $settings['fancy_boxes'];
    $loop        = $settings['loop'];
    $speed       = $settings['speed'];
    $autoplay    = $settings['autoplay'];
    $delay       = $settings['delay'];
    $loop        = ($loop == 'yes') ? 1:0;
    $autoplay    = ($autoplay == 'yes') ? 1:0;

    if(!empty($fancy_boxes) && is_array($fancy_boxes)):
  ?>

    <div class="tb-hero-carousel">
      <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style7">
        <div class="tb-slick-inner-pad-wrap">
          <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="3" data-add-slides="4">
            <div class="slick-wrapper">
              <?php 
                foreach($fancy_boxes as $box): 
                  $btn_link = $box['btn_link'];
                  $href    = (!empty($btn_link['url']) ) ? $btn_link['url'] : '#';
                  $target  = ($btn_link['is_external'] == 'on') ? '_blank' : '_self';
              ?>
                <div class="slick-slide">
                  <div class="tb-slick-inner-pad">
                    <div class="tb-fancybox tb-style4 tb-zoom">
                      <div class="tb-fancybox-bg tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($box['bg_image']['url']); ?>);"></div>
                      <div class="tb-fancybox-info">
                        <div class="tb-fancybox-text">
                          <div class="tb-fancybox-subtitle tb-white-c tb-mt-5 tb-f12-lg text-uppercase"><?php echo esc_html($box['sub_title']); ?></div>
                          <h2 class="tb-fancybox-title tb-white-c tb-f21-lg tb-m0"><?php echo esc_html($box['title']); ?></h2>
                        </div>
                        <div class="tb-fancybox-btn"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style3"><?php echo esc_html($box['btn_text']); ?></a></div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

            </div>
          </div>
        </div>
        <div class="pagination tb-style1 hidden"></div>
        <div class="swipe-arrow tb-style3">
          <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
          <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
        </div>
      </div>
    </div>
  <?php endif;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Fancy_Box_Slider_Widget() );