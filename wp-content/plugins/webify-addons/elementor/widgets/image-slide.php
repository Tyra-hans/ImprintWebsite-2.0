<?php 
namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Image_Slide_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-slide-widget';
  }

  public function get_title() {
    return 'Image Slide';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-image-slide');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'image_slide_section',
      array(
        'label' => esc_html__('Image Slide' , 'webify-addons')
      )
    );

    $this->add_control(
      'first_image',
      array(
        'label'   => esc_html__('First Image', 'webify-addons'),
        'type'    => Controls_Manager::MEDIA,
        'default' => array('url' => \Elementor\Utils::get_placeholder_image_src()),       
      )
    );

    $this->add_control(
      'second_image',
      array(
        'label'   => esc_html__('Second Image', 'webify-addons'),
        'type'    => Controls_Manager::MEDIA,
        'default' => array('url' => \Elementor\Utils::get_placeholder_image_src()),       
      )
    );


    $this->end_controls_section();


  }

  protected function render() { 

    $settings     = $this->get_settings();
    $first_image  = $settings['first_image'];
    $second_image = $settings['second_image'];

    if(empty($first_image['url']) || empty($second_image['url'])) {return;}

  ?>
    <div class="tb-before-after">
      <?php if(is_array($first_image) && !empty($first_image['url'])): ?>
        <div class="tb-after tb-single-slide" style="background-image: url(<?php echo esc_url($first_image['url']); ?>"></div>
      <?php endif; ?>
      <?php if(is_array($second_image) && !empty($second_image['url'])): ?>
        <div class="tb-before tb-single-slide" style="background-image: url(<?php echo esc_url($second_image['url']); ?>)"></div>
      <?php endif; ?>
      <div class="tb-handle-before-after"><span></span></div>
    </div>
    <?php
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Slide_Widget() );