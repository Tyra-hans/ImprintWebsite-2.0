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
class Webify_Text_Block_With_Image_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-text-block-with-image-widget';
  }

  public function get_title() {
    return 'Text Block With Image';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-video-block', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'text_block_section',
      array(
        'label' => esc_html__('Text Block With Image' , 'webify-addons')
      )
    );

    $this->add_control(
      'sub_heading',
      array(
        'label' => esc_html__('Sub Heading', 'webify-addons'),
        'type'  => Controls_Manager::TEXT,
        'default' => esc_html__('Our Philosophy', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('The projects undertaken by our firm are based on disciplinary knowledge base.', 'webify-addons' ),
        'label_block' => true,
      )
    );

    $this->add_control(
      'image',
      array(
        'label'   => esc_html__('Image', 'webify-addons'),
        'type'    => Controls_Manager::MEDIA,
        'default' => array('url' => \Elementor\Utils::get_placeholder_image_src()),       
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons')
      )
    );

    $this->add_control(
      'url',
      array(
        'label'       => esc_html__('URL', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'default'     => array('url' => '#'),
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings    = $this->get_settings();
    $image       = $settings['image'];
    $link_text   = $settings['link_text'];
    $url         = $settings['url'];
    $heading     = $settings['heading'];
    $sub_heading = $settings['sub_heading'];

  ?>

  <div class="row">
    <div class="col-lg-5">
      <div class="empty-space marg-lg-b60 marg-sm-b0"></div>
      <div class="tb-video-blog-text tb-style1 tb-radious-4 tb-border">
        <div class="tb-section-heading tb-style2">
          <?php if(!empty($sub_heading)): ?>
            <div class="tb-f16-lg"><?php echo esc_html($sub_heading); ?></div>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($heading)): ?>
            <h2 class="tb-f36-lg tb-f25-sm tb-font-name tb-m0"><?php echo wp_kses_post($heading); ?></h2>
            <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
          <?php endif; ?>
        </div>
        <?php if(!empty($link_text)): ?>
          <div class="tb-video-btn"><a href="<?php echo esc_url($url['url']); ?>" class="tb-btn tb-style1"><?php echo esc_html($link_text); ?></a></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="tb-video-block tb-style4 tb-radious-4 tb-relative">
        <div class="tb-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
      </div>
    </div>
  </div>

  <?php

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Text_Block_With_Image_Widget() );