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
class Webify_Image_Gallery_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-gallery-slider-widget';
  }

  public function get_title() {
    return 'Image Gallery Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-shop-feature', 'webify-slider', 'webify-image-box');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'image_gallery_slider_section',
      array(
        'label' => esc_html__('Image Gallery Slider' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
          'style3' => 'Style 3',
        )
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__('Upload Images', 'webify-addons'),
        'type'        => Controls_Manager::GALLERY,
        'label_block' => true,
        'separator'   => 'after',
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

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $images   = $settings['images'];
    $style    = $settings['style'];
    $loop     = $settings['loop'];
    $speed    = $settings['speed'];
    $autoplay = $settings['autoplay'];
    $delay    = $settings['delay'];
    $loop     = ($loop == 'yes') ? 1:0;
    $autoplay = ($autoplay == 'yes') ? 1:0;

    if(is_array($images) && !empty($images)): 

      switch ($style) {
        case 'style1': ?>
          <div class="tb-half-slider tb-style1">
            <div class="tb-half-slider-in">
              <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style5 tb-type1">
                <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="3000" data-center="1" data-slides-per-view="3">
                  <div class="slick-wrapper">

                    <?php foreach($images as $image): ?>
                      <div class="slick-slide">
                        <div class="tb-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                      </div><!-- .slick-slide -->
                    <?php endforeach; ?>


                  </div>
                </div><!-- .slick-container -->
                <div class="pagination tb-style3"></div> <!-- If dont need Pagination then add class .hidden -->
                <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
                  <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                  <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
                </div>
              </div>
            </div>
          </div>

          <?php
          # code...
          break;

        case 'style2': ?>
          <div class="tb-gallery-slider tb-style2">
            <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
              <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="4000" data-center="0" data-slides-per-view="1">
                <div class="slick-wrapper">

                  <?php for($i = 0; $i < count($images) - 1; $i++): ?>
                    <div class="slick-slide">
                      <div class="tb-gallery-slider-in">
                        <?php for($j = $i; $j < $i + 1; $j++): ?>
                          <div class="tb-gallery-lg-img tb-bg" style="background-image: url(<?php echo esc_url($images[$j]['url']); ?>);"></div>
                          <div class="tb-gallery-sm-img tb-bg" style="background-image: url(<?php echo esc_url($images[$j+1]['url']); ?>);"></div>
                        <?php endfor; ?>
                      </div>
                    </div><!-- .slick-slide -->
                  <?php endfor; ?>

                </div>
              </div><!-- .slick-container -->
              <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
                <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
              </div>
            </div><!-- .tb-carousor -->
          </div>
          <?php
          # code...
          break;

        case 'style3': ?>
          <div class="tb-overflow-hidden">
            <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
              <div class="tb-slick-inner-pad-wrap">
                <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="3" data-add-slides="3">
                  <div class="slick-wrapper">

                    <?php foreach($images as $image): ?>
                      <div class="slick-slide">
                        <div class="tb-slick-inner-pad">
                          <div class="tb-image-box tb-style1">
                            <div class="tb-image">
                              <div class="tb-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                            </div>
                          </div>
                        </div>
                      </div><!-- .slick-slide -->
                    <?php endforeach; ?>

                  </div>
                </div><!-- .slick-container -->
              </div>
              <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow tb-style6"> <!-- If dont need navigation then add class .tb-hidden -->
                <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
              </div>
            </div><!-- .tb-carousor -->
          </div>
          <?php
          # code...
          break;
      }

    endif;
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Gallery_Slider_Widget() );