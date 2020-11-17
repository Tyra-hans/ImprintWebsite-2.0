<?php 

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Logo_Carousel extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-logo-carousel';
  }

  public function get_title() {
    return 'Logo Carousel';
  }

  public function get_icon() {
    return 'elem_icon logo_carousel';
  }

  public function get_script_depends() {
    return array('slick', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('slider', 'slick', 'client', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'logo_carousel_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default'     => 'style1',
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'logo_carousel_slider_settings',
      array(
        'label' => esc_html__('Slider Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label'       => esc_html__('Autoplay', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SWITCHER,
        
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => esc_html__('Loop', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        
        'default'   => 'yes',
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => esc_html__('Speed', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 600
      )
    );

    $this->add_control(
      'navigational_arrows',
      array(
        'label'     => esc_html__('Navigational Arrows', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'image_settings',
      array(
        'label' => esc_html__('Image Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__('Upload Images', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::GALLERY,
        'label_block' => true,
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
      Group_Control_Border::get_type(),
      array(
        'name'     => 'logo_carousel_border',
        'selector' => '{{WRAPPER}} .df-client'
      )
    );

    $this->add_responsive_control(
      'logo_carousel_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-client' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'logo_carousel_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-client' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'logo_carousel_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-client' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_navigational_arrows',
      array(
        'label' => esc_html__('Navigational Arrows', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2')),
      )
    );

    $this->add_control('left_icon_arrow', 
      array(
        'label'     => esc_html__('Left Icon', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::CHOOSE,
        'options' => array(
          'left_arrow_bold' => array(
            'icon'  => 'fa fa-arrow-left',
          ),
          'left_arrow_long' => array(
            'icon'  => 'fa fa-long-arrow-left',
          ),
          'left_arrow_long_circle' => array(
            'icon'  => 'fa fa-arrow-circle-left',
          ),
          'left_arrow_angle' => array(
            'icon' => 'fa fa-angle-left',
          ),
          'left_arrow_chevron' => array(
            'icon' => 'fa fa-chevron-left',
          )
        ),
        'default'   => 'left_arrow_chevron',
      )
    );

    $this->add_control('right_icon_arrow', 
      array(
        'label'     => esc_html__('Right Icon', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::CHOOSE,
        'options' => array(
          'right_arrow_bold' => array(
            'icon'  => 'fa fa-arrow-right',
          ),
          'right_arrow_long' => array(
            'icon'  => 'fa fa-long-arrow-right',
          ),
          'right_arrow_long_circle' => array(
            'icon'  => 'fa fa-arrow-circle-right',
          ),
          'right_arrow_angle' => array(
            'icon' => 'fa fa-angle-right',
          ),
          'right_arrow_chevron' => array(
            'icon' => 'fa fa-chevron-right',
          )
        ),
        'default'   => 'right_arrow_chevron',
      )
    );

    $this->add_responsive_control(
      'size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust circle width & height', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 50,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow.df-style1 i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'icon_size',
      array(
        'label'       => esc_html__('Icon Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust arrow size', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 5,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow.df-style1 i' => 'font-size: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'position',
      array(
        'label'       => esc_html__('Position', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust arrow position', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => -50,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow.df-style1 i' => 'top: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_control('circle_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow.df-style1 i' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('circle_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow.df-style1 i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('circle_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow.df-style1 i' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings            = $this->get_settings(); 
    $style               = $settings['style'];
    $right_icon_arrow    = $settings['right_icon_arrow'];
    $left_icon_arrow     = $settings['left_icon_arrow'];
    $images              = $settings['images'];
    $autoplay            = $settings['autoplay'];
    $loop                = $settings['loop'];
    $speed               = $settings['speed'];
    $navigational_arrows = $settings['navigational_arrows'];
    $loop                = ($loop == 'yes') ? 1:0;
    $autoplay            = ($autoplay == 'yes') ? 1:0;

    switch ($right_icon_arrow) {
      case 'right_arrow_bold':
        $right_arrow_icon = 'fa fa-arrow-right';
        break;

      case 'right_arrow_long':
        $right_arrow_icon = 'fa fa-long-arrow-right';
        break;

      case 'right_arrow_long_circle':
        $right_arrow_icon = 'fa fa-arrow-circle-right';
        break;      

      case 'right_arrow_angle':
        $right_arrow_icon = 'fa fa-angle-right';
        break;

      case 'right_arrow_chevron':
      default:
        $right_arrow_icon = 'fa fa-chevron-right';
        break;
    }

    switch ($left_icon_arrow) {
      case 'left_arrow_bold':
        $left_arrow_icon = 'fa fa-arrow-left';
        break;

      case 'left_arrow_long':
        $left_arrow_icon = 'fa fa-long-arrow-left';
        break;

      case 'left_arrow_long_circle':
        $left_arrow_icon = 'fa fa-arrow-circle-left';
        break;      

      case 'left_arrow_angle':
        $left_arrow_icon = 'fa fa-angle-left';
        break;

      case 'left_arrow_chevron':
      default:
        $left_arrow_icon = 'fa fa-chevron-left';
        break;
    }


    switch ($style) {
      case 'style1': default:
        if(is_array($images) && !empty($images)): ?>
          <div class="df-client-wrapper">
            <div class="df-arrow-closest df-poind-closest df-slider df-style4">
              <div class="df-swiper-inner-pad-wrap">
                <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="5">
                  <div class="slick-wrapper">
                    <?php foreach($images as $image): ?>
                      <div class="slick-slide-in">
                        <div class="df-swiper-inner-pad">
                          <div class="df-client df-style1 df-flex">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                          </div>
                        </div>
                      </div><!-- .slick-slide-in -->
                    <?php endforeach; ?>
                  </div>
                </div><!-- .slick-container -->
              </div>
              <div class="pagination df-style3 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow df-style4 <?php echo ($navigational_arrows == 'yes') ? 'df-has-nav':'hidden'; ?>"> <!-- If dont need navigation then add class .df-hidden -->
                <div class="slick-arrow-left"></div>
                <div class="slick-arrow-right"></div>
              </div>
            </div><!-- .df-carousor -->
          </div>
        <?php endif;
        # code...
        break;

      case 'style2':
      if(is_array($images) && !empty($images)): ?>
        <div class="df-container">
          <div class="df-row">
            <div class="df-col-lg-12">
              <div class="df-arrow-closest df-poind-closest df-slider df-style1 df-logo-carouser-2">
                <div class="df-swiper-inner-pad-wrap">
                  <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="6">
                    <div class="slick-wrapper">

                      <?php foreach($images as $image): ?>
                        <div class="slick-slide-in">
                          <div class="df-swiper-inner-pad">
                            <div class="df-client df-style2" data-wow-duration="0.8s" data-wow-delay="0.75s">
                              <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                            </div>
                          </div>
                        </div><!-- .slick-slide-in -->
                      <?php endforeach; ?>
                    </div>
                  </div><!-- .slick-container -->
                </div>
                <div class="pagination df-style1 hidden df-mobile-hidden"></div> <!-- If dont need Pagination then add class .hidden -->
                <div class="swipe-arrow df-style1 <?php echo ($navigational_arrows == 'yes') ? 'df-has-nav':'hidden'; ?>"> <!-- If dont need navigation then add class .df-hidden -->
                  <div class="slick-arrow-left"><i class="<?php echo esc_attr($left_arrow_icon); ?>"></i></div>
                  <div class="slick-arrow-right"><i class="<?php echo esc_attr($right_arrow_icon); ?>"></i></div>
                </div>
              </div><!-- .df-carousor -->
            </div>
          </div>
        </div>
      <?php endif;
        # code...
        break;
      
    }
    

  }
}
