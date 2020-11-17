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
class Webify_Image_Horizontal_Scroll_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-horizontal-scroll-widget';
  }

  public function get_title() {
    return 'Image Horizontal Scroll';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('light-gallery');
  }

  public function get_style_depends() {
    return array('horizontal-scroll', 'light-gallery');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'image_horizontal_scroll_section',
      array(
        'label' => esc_html__('Image Horizontal Scroll' , 'webify-addons')
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

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $images   = $settings['images'];

    if(is_array($images) && !empty($images)): ?>

    <div class="tb-horizontal-scroll-wrap">
      <div class="tb-horizontal-scroll">
        <div class="tb-horizontal-scroll-in">
          <div class="tb-horizontal-scroll-bar tb-lightgallery">

            <?php foreach($images as $image): ?>
              <div class="tb-horizontal-scroll-item tb-zoom">
                
                <a href="<?php echo esc_url($image['url']); ?>" class="tb-bg tb-zoom-in1 tb-lightbox-item" style="background-image: url(<?php echo esc_url($image['url']); ?>)"><img src="<?php echo esc_url($image['url']); ?>" alt="thumb"></a>
              </div>
            <?php endforeach; ?>
            <div class="tb-horizontal-scroll-right-padd"></div>
          </div>
        </div>
      </div>
    </div>

    <?php
    endif;
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Horizontal_Scroll_Widget() );