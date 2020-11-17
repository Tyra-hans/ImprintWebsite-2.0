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
class Webify_Text_Block_With_Gallery_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-text-block-with-gallery-widget';
  }

  public function get_title() {
    return 'Text Block With Gallery';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-button', 'webify-shop-feature', 'slick', 'webify-slider');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'text_block_gallery_section',
      array(
        'label' => esc_html__('Text Block With Gallery' , 'webify-addons')
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Summer #lookbook', 'webify-addons' ),
        'label_block' => true,
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'placeholder' => esc_html__('Enter your description', 'webify-addons'),
        'default'     => esc_html__('Sharing ten outfit ideas in this summer lookbook including casual, everyday and date night looks. Turn up the heat with colour-infused prints on breezy, skin-bearing silhouettes. Summerly Escape Lookbook will revive your wardrobe for every destination!', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'button_style',
      array(
        'label'       => esc_html__('Button Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'options'     => array(
          ''          => 'Choose Button Style',
          'tb-style3' => 'Style 1',
          'tb-style5' => 'Style 2',
        ),
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons')
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'default'     => array('url' => '#'),
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__('Upload Images', 'webify-addons'),
        'type'        => Controls_Manager::GALLERY,
        'label_block' => true,
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

    $this->end_controls_section();

    $this->start_controls_section('section_style_heading',
      array(
        'label' => esc_html__('Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-shop-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-shop-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_description',
      array(
        'label' => esc_html__('Description', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-shop-description' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-shop-description',
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

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-primary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-primary:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();


    $this->end_controls_section();

  }

  protected function render() { 

    $settings     = $this->get_settings();
    $images       = $settings['images'];
    $button_style = $settings['button_style'];
    $btn_text     = $settings['btn_text'];
    $btn_link     = $settings['btn_link'];
    $href         = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target       = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';
    $heading      = $settings['heading'];
    $description  = $settings['description'];
    $loop         = $settings['loop'];
    $speed        = $settings['speed'];
    $autoplay     = $settings['autoplay'];
    $loop         = ($loop == 'yes') ? 1:0;
    $autoplay     = ($autoplay == 'yes') ? 1:0;

  ?>

  <div class="tb-shop-feature tb-style1">
    <div class="empty-space marg-lg-b145 marg-sm-b80"></div>

    <div class="tb-shop-feature-text">
      <h2 class="tb-f48-lg tb-f35-sm tb-font-name tb-mt-5 tb-shop-heading tb-mb2 tb-mt-3-sm tb-mb4-sm tb-line1"><?php echo wp_kses_post($heading); ?></h2>
      <div class="empty-space marg-lg-b15"></div>
      <div class="tb-f16-lg tb-shop-description tb-mb3"><?php echo wp_kses_post($description); ?></div>
      <div class="empty-space marg-lg-b30 marg-sm-b20"></div>
      <div class="tb-shop-feature-btn">
        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($button_style)) ? $button_style: 'tb-style3'; ?> tb-color2"><?php echo esc_html($btn_text); ?></a>
      </div>
    </div>

    <?php if(is_array($images) && !empty($images)): ?>
      <div class="tb-gallery-slider tb-style1">
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
          <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="4000" data-center="0" data-slides-per-view="1">
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
    <?php endif; ?>

    <div class="empty-space marg-lg-b145 marg-sm-b80"></div>
  </div>

  <?php

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Text_Block_With_Gallery_Widget() );