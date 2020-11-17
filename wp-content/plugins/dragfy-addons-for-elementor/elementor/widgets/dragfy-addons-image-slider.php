<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;


if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Image_Slider extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-image-slider';
  }

  public function get_title() {
    return 'Image Slider';
  }

  public function get_icon() {
    return 'elem_icon image_slider';
  }

  public function get_script_depends() {
    return array('slick', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('slick', 'shop-feature', 'slider', 'image-box', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'image_slider_general_section',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
          'style2' => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
          'style3' => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
          
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'image_slider_image_section',
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
        'separator'   => 'after',
      )
    );


    $this->end_controls_section();

    $this->start_controls_section(
      'image_slider_slider_settings',
      array(
        'label' => esc_html__('Slider Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label' => esc_html__('Autoplay', 'dragfy-addons-for-elementor'),
        'type'  => Controls_Manager::SWITCHER,
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'   => esc_html__('Loop', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SWITCHER,
        'default' => 'yes',
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'   => esc_html__('Speed', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::TEXT,
        'default' => 600,
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label'     => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'height',
      array(
        'label'       => esc_html__('Height', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust height.', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 300,
            'max'  => 1000,
            'step' => 10,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .slick-slide-in' => 'height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .style1 .slick-slide-in.slick-slide-in-active .df-bg, {{WRAPPER}} .style1 .slick-slide-in, {{WRAPPER}} .style2 .df-gallery-slider-in .df-bg, {{WRAPPER}} .style3 .slick-slide-in .df-bg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Css_Filter::get_type(),
      array(
        'name'     => 'css_filter',
        'selector' => '{{WRAPPER}} .slick-slide-in .df-bg',
      )
    );


    $this->end_controls_section();





    $this->start_controls_section('section_style_navigational_arrows',
      array(
        'label' => esc_html__('Navigational Arrows', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
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
        'default'   => 'left_arrow_angle',
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
        'default'   => 'right_arrow_angle',
      )
    );

    $this->add_responsive_control(
      'size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust circle width & height.', 'dragfy-addons-for-elementor'),
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
          '{{WRAPPER}} .swipe-arrow i' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'circle_icon_size',
      array(
        'label'       => esc_html__('Icon Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust icon size.', 'dragfy-addons-for-elementor'),
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
          '{{WRAPPER}} .swipe-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'circle_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->start_controls_tabs('circle_style');

    $this->start_controls_tab(
      'circle_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('circle_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('circle_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'circle_border',
        'selector' => '{{WRAPPER}} .swipe-arrow i'
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'circle_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('circle_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i:hover' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('circle_icon_hover_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .swipe-arrow i:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'circle_hover_border',
        'selector' => '{{WRAPPER}} .swipe-arrow i:hover'
      )
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

  }

  protected function render() { 

    $settings         = $this->get_settings(); 
    $images           = $settings['images'];
    $style            = $settings['style'];
    $loop             = $settings['loop'];
    $speed            = $settings['speed'];
    $right_icon_arrow = $settings['right_icon_arrow'];
    $left_icon_arrow  = $settings['left_icon_arrow'];
    $autoplay         = $settings['autoplay'];
    $loop             = ($loop == 'yes') ? 1:0;
    $autoplay         = ($autoplay == 'yes') ? 1:0;

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

      case 'right_arrow_chevron':
        $right_arrow_icon = 'fa fa-chevron-right';
        break;

      case 'right_arrow_angle':
      default:
        $right_arrow_icon = 'fa fa-angle-right';
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

      case 'left_arrow_chevron':
        $left_arrow_icon = 'fa fa-chevron-left';
        break;

      case 'left_arrow_angle':
      default:
        $left_arrow_icon = 'fa fa-angle-left';
        break;

    }

    if(is_array($images) && !empty($images)): 

      switch ($style) {
        case 'style1': ?>
          <div class="df-half-slider style1 df-style1">
            <div class="df-half-slider-in">
              <div class="df-arrow-closest df-poind-closest df-slider df-style5 df-type1">
                <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="3000" data-center="1" data-slides-per-view="3">
                  <div class="slick-wrapper">

                    <?php foreach($images as $image): ?>
                      <div class="slick-slide-in">
                        <div class="df-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                      </div><!-- .slick-slide-in -->
                    <?php endforeach; ?>


                  </div>
                </div><!-- .slick-container -->
                <div class="pagination df-style3"></div> <!-- If dont need Pagination then add class .hidden -->
                <div class="swipe-arrow df-style3"> <!-- If dont need navigation then add class .df-hidden -->
                  <div class="slick-arrow-left"><i class="<?php echo esc_attr($left_arrow_icon); ?>"></i></div>
                  <div class="slick-arrow-right"><i class="<?php echo esc_attr($right_arrow_icon); ?>"></i></div>
                </div>
              </div>
            </div>
          </div>

          <?php
          # code...
          break;

        case 'style2': ?>
          <div class="df-gallery-slider style2 df-style2">
            <div class="df-arrow-closest df-poind-closest df-slider df-style1">
              <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="4000" data-center="0" data-slides-per-view="1">
                <div class="slick-wrapper">

                  <?php for($i = 0; $i < count($images) - 1; $i++): ?>
                    <div class="slick-slide-in">
                      <div class="df-gallery-slider-in">
                        <?php for($j = $i; $j < $i + 1; $j++): ?>
                          <div class="df-gallery-lg-img df-bg" style="background-image: url(<?php echo esc_url($images[$j]['url']); ?>);"></div>
                          <div class="df-gallery-sm-img df-bg" style="background-image: url(<?php echo esc_url($images[$j+1]['url']); ?>);"></div>
                        <?php endfor; ?>
                      </div>
                    </div><!-- .slick-slide-in -->
                  <?php endfor; ?>

                </div>
              </div><!-- .slick-container -->
              <div class="pagination df-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow df-style1"> <!-- If dont need navigation then add class .df-hidden -->
                <div class="slick-arrow-left"><i class="<?php echo esc_attr($left_arrow_icon); ?>"></i></div>
                <div class="slick-arrow-right"><i class="<?php echo esc_attr($right_arrow_icon); ?>"></i></div>
              </div>
            </div><!-- .df-carousor -->
          </div>
          <?php
          # code...
          break;

        case 'style3': ?>
          <div class="df-overflow-hidden style3 df-style3">
            <div class="df-arrow-closest df-poind-closest df-slider df-style1">
              <div class="df-swiper-inner-pad-wrap">
                <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="3" data-add-slides="3">
                  <div class="slick-wrapper">

                    <?php foreach($images as $image): ?>
                      <div class="slick-slide-in">
                        <div class="df-swiper-inner-pad">
                          <div class="df-image-box df-style1">
                            <div class="df-image">
                              <div class="df-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                            </div>
                          </div>
                        </div>
                      </div><!-- .slick-slide-in -->
                    <?php endforeach; ?>

                  </div>
                </div><!-- .slick-container -->
              </div>
              <div class="pagination df-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow df-style6"> <!-- If dont need navigation then add class .df-hidden -->
                <div class="slick-arrow-left"><i class="<?php echo esc_attr($left_arrow_icon); ?>"></i></div>
                <div class="slick-arrow-right"><i class="<?php echo esc_attr($right_arrow_icon); ?>"></i></div>
              </div>
            </div><!-- .df-carousor -->
          </div>
          <?php
          # code...
          break;
      }

    endif;
  }
}
