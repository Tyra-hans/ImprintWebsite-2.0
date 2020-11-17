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
class Webify_Hero_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-hero-slider-widget';
  }

  public function get_title() {
    return 'Hero Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-button', 'webify-hero', 'webify-slider');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'hero_slider_section',
      array(
        'label' => esc_html__('Hero Slider' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'     => esc_html__('Style', 'webify-addons'),
        'type'      => Controls_Manager::SELECT,
        'default'   => 'style1',
        'separator' => 'after',
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
          'style3' => 'Style 3',
          'style4' => 'Style 4',
          'style5' => 'Style 5',
        )
      )
    );

    $this->add_control(
      'overlay',
      array(
        'label'     => esc_html__('Overlay', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'separator' => 'after',
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
        'default'     => 600,
        'separator' => 'after',
      )
    );


    $repeater = new Repeater();

    $repeater->add_control(
      'bg_image',
      array(
        'label'       => esc_html__('Background Image', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $repeater->add_control(
      'sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'default'     => 'WELCOME TO ROYAL BONANZA',
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'description' => esc_html__('This is only for Style 5', 'webify-addons')
      )
    );

    $repeater->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'default'     => 'Make it professional.<br>Make it beautiful.',
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'default'     => 'We design digital platforms that elevate the customer experience <br>for the world\'s most beloved brands.',
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA
      )
    );

    $repeater->add_control(
      'primary_button_style',
      array(
        'label'       => esc_html__('Primary Button Style', 'webify-addons'),
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

    $repeater->add_control(
      'btn_text_primary',
      array(
        'label'       => esc_html__('Primary Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'btn_link_primary',
      array(
        'label'       => esc_html__('Primary Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $repeater->add_control(
      'secondary_button_style',
      array(
        'label'       => esc_html__('Secondary Button Style', 'webify-addons'),
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

    $repeater->add_control(
      'btn_text_secondary',
      array(
        'label'       => esc_html__('Secondary Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'default'     => esc_html__('Contact Us', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'btn_link_secondary',
      array(
        'label'       => esc_html__('Secondary Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->add_control(
      'hero_slides',
      array(
        'heading'     => esc_html__('Hero Slides', 'webify-addons'),
        'type'        => Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'separator' => 'after',
        'default'    => array(
          array(
            'heading'                => 'Make it professional.<br>Make it beautiful.',
            'description'            => 'We design digital platforms that elevate the customer experience <br>for the world\'s most beloved brands.',
            'primary_button_style'   => '',
            'btn_text_primary'       => 'Learn More',
            'secondary_button_style' => '',
            'btn_text_secondary'     => 'Contact Us',
            'btn_link_primary'       => array('url' => '#'),
            'btn_link_secondary'     => array('url' => '#'),
          ),
        ),
        'title_field' => '<span>{{ heading }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_sub_heading_style',
      array(
        'label' => esc_html__('Sub Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('sub_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-text .tb-hero-subheading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_heading_typography',
        'selector' => '{{WRAPPER}} .tb-hero-text .tb-hero-subheading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_heading_style',
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
          '{{WRAPPER}} .tb-hero-text .tb-hero-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-hero-text .tb-hero-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_style',
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
          '{{WRAPPER}} .tb-hero-text .tb-hero-subtitle, .tb-hero-subtitle .tb-white-c5, .tb-hero-subtitle .tb-white-c8' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-hero-text .tb-hero-subtitle, .tb-hero-subtitle .tb-white-c5, .tb-hero-subtitle .tb-white-c8',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_button_style_primary',
      array(
        'label' => esc_html__('Button Primary', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal_primary',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_primary', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_border_color_primary', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color_primary', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
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
        'name'     => 'btn_typography_primary',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-primary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover_primary',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_hover_primary', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_border_color_hover_primary', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary:hover' => 'border-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover_primary', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
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
        'name'     => 'btn_typography_hover_primary',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-primary:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();



    $this->end_controls_section();


    $this->start_controls_section('section_button_style_secondary',
      array(
        'label' => esc_html__('Button Secondary', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('btn_style_secondary');

    $this->start_controls_tab(
      'btn_style_normal_secondary',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_secondary', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_border_color_secondary', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-btn .tb-btn.tb-btn-secondary' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color_secondary', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_secondary',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-secondary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover_secondary',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_hover_secondary', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_bg_border_hover_secondary', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover' => 'border-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover_secondary', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover_secondary',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();


    $this->end_controls_section();


  }

  protected function render() { 
    $settings    = $this->get_settings_for_display(); 
    $hero_slides = $settings['hero_slides'];
    $style       = $settings['style'];
    $loop        = $settings['loop'];
    $speed       = $settings['speed'];
    $autoplay    = $settings['autoplay'];
    $overlay     = $settings['overlay'];
    $delay       = $settings['delay'];
    $loop        = ($loop == 'yes') ? 1:0;
    $autoplay    = ($autoplay == 'yes') ? 1:0;
    $overlay     = ($overlay == 'yes') ? 'has-overlay':'no-overlay';

    if(is_array($hero_slides) && !empty($hero_slides)):


      switch ($style) {

        case 'style1': ?>
          <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
            <div class="tb-overflow-hidden">
              <div class="tb-mb-6">
                <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0" data-slides-per-view="1">
                  <div class="slick-wrapper">

                    <?php 
                      foreach($hero_slides as $slide): 
                        $href_primary   = (!empty($slide['btn_link_primary']['url']) ) ? $slide['btn_link_primary']['url'] : '#';
                        $target_primary = ($slide['btn_link_primary']['is_external'] == 'on') ? '_blank' : '_self';
                    ?>
                      <div class="slick-slide">
                        <div class="tb-hero tb-style4 <?php echo esc_attr($overlay); ?> tb-flex">
                        <div class="tb-hero-bg tb-bg" style="background-image: url(<?php echo esc_url($slide['bg_image']['url']); ?>);"></div>
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="tb-hero-text">
                                  <h1 class="tb-hero-title tb-white-c tb-f60-lg tb-f38-sm tb-font-name tb-m0"><?php echo wp_kses_post($slide['heading']); ?></h1>
                                  <div class="empty-space marg-lg-b5"></div>
                                  <div class="tb-hero-subtitle tb-white-c tb-f18-lg tb-line1-6 tb-mb2"><?php echo wp_kses_post($slide['description']); ?></div>
                                  <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
                                  <?php if(!empty($slide['btn_text_primary'])):?>
                                    <div class="tb-hero-btn">
                                      <a href="<?php echo esc_url($href_primary); ?>" target="<?php echo esc_attr($target_primary); ?>" class="tb-btn-primary tb-btn <?php echo (!empty($slide['primary_button_style'])) ? $slide['primary_button_style']: 'tb-style4'; ?> tb-color1"><?php echo esc_html($slide['btn_text_primary']); ?></a>
                                    </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- .slick-slide -->
                    <?php endforeach; ?>


                  </div>
                </div><!-- .slick-container -->
              </div>
            </div>
            <div class="pagination tb-style2 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div>
          <?php
          break;

        case 'style2': ?>
          <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
            <div class="tb-overflow-hidden">
              <div class="tb-mb-6">
                <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="1000" data-center="0" data-slides-per-view="1">
                  <div class="slick-wrapper">

                    <?php 
                      foreach($hero_slides as $slide): 
                        $href_primary     = (!empty($slide['btn_link_primary']['url']) ) ? $slide['btn_link_primary']['url'] : '#';
                        $target_primary   = ($slide['btn_link_primary']['is_external'] == 'on') ? '_blank' : '_self';
                        $href_secondary   = (!empty($slide['btn_link_secondary']['url']) ) ? $slide['btn_link_secondary']['url'] : '#';
                        $target_secondary = ($slide['btn_link_secondary']['is_external'] == 'on') ? '_blank' : '_self'; 
                    ?>
                    <div class="slick-slide">
                      <div class="tb-hero <?php echo esc_attr($overlay); ?> tb-style8 tb-bg tb-flex" style="background-image: url(<?php echo esc_url($slide['bg_image']['url']); ?>);">
                        <div class="container">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="tb-hero-text">
                                <h1 class="tb-hero-title tb-white-c tb-f48-lg tb-f35-sm tb-font-name tb-font-name tb-mt-10 tb-mb-15  tb-mt-7-sm tb-mb-11-sm"><?php echo wp_kses_post($slide['heading']); ?></h1>
                                <div class="empty-space marg-lg-b30"></div>
                                <div class="tb-hero-subtitle tb-white-c tb-f18-lg  tb-line1-6 tb-mb-5 tb-mt-5"><?php echo wp_kses_post($slide['description']); ?></div>
                                <div class="empty-space marg-lg-b40"></div>
                                <div class="tb-btn-group tb-style1">
                                  <?php if(!empty($slide['btn_text_primary'])): ?>
                                    <a href="<?php echo esc_url($href_primary); ?>" target="<?php echo esc_attr($target_primary); ?>" class="tb-btn tb-btn-primary tb-color1 <?php echo (!empty($slide['primary_button_style'])) ? $slide['primary_button_style']: 'tb-style4'; ?>"><?php echo esc_html($slide['btn_text_primary']); ?></a>
                                  <?php endif; ?>
                                  <?php if(!empty($slide['btn_text_secondary'])): ?>
                                    <a href="<?php echo esc_url($href_secondary); ?>" target="<?php echo esc_attr($target_secondary); ?>" class="tb-btn tb-accent-color <?php echo (!empty($slide['secondary_button_style'])) ? $slide['secondary_button_style']: 'tb-style4'; ?> tb-color3 tb-btn-secondary"><?php echo esc_html($slide['btn_text_secondary']); ?></a>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- .slick-slide -->
                  <?php endforeach; ?>

                  </div>
                </div><!-- .slick-container -->
              </div>
            </div>
            <div class="pagination tb-style2 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div><!-- .tb-carousor -->
          <?php
          # code...
          break;

        case 'style3': ?>
          <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
            <div class="tb-overflow-hidden">
              <div class="tb-mb-6">
                <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="1000" data-center="0" data-slides-per-view="1">
                  <div class="slick-wrapper">

                    <?php 
                      foreach($hero_slides as $slide): 
                        $href_primary     = (!empty($slide['btn_link_primary']['url']) ) ? $slide['btn_link_primary']['url'] : '#';
                        $target_primary   = ($slide['btn_link_primary']['is_external'] == 'on') ? '_blank' : '_self';
                    ?>

                      <div class="slick-slide">
                        <div class="tb-hero tb-flex <?php echo esc_attr($overlay); ?> tb-style4">
                          <div class="tb-hero-bg tb-bg" style="background-image: url(<?php echo esc_url($slide['bg_image']['url']); ?>);"></div>
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="tb-hero-text">
                                  <h1 class="tb-hero-title tb-white-c tb-f60-lg tb-f38-sm  tb-font-name tb-mt-14 tb-mb-14 tb-mt-8-sm tb-mb-9-sm"><?php echo wp_kses_post($slide['heading']); ?></h1>
                                  <div class="empty-space marg-lg-b30"></div>
                                  <div class="tb-hero-subtitle tb-white-c tb-f18-lg tb-line1-5 tb-mb-7 tb-mt-7"><?php echo wp_kses_post($slide['description']); ?></div>
                                  <div class="empty-space marg-lg-b40"></div>
                                  <?php if(!empty($slide['btn_text_primary'])): ?>
                                    <div class="tb-hero-btn">
                                      <a href="<?php echo esc_url($href_primary); ?>" target="<?php echo esc_attr($target_primary); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($slide['primary_button_style'])) ? $slide['primary_button_style']: 'tb-style4'; ?> tb-color1"><?php echo esc_html($slide['btn_text_primary']); ?></a>
                                    </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- .slick-slide -->

                    <?php endforeach; ?>



                  </div>
                </div><!-- .slick-container -->
              </div>
            </div>
            <div class="pagination tb-style2 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div><!-- .tb-carousor -->
          <?php
          # code...
          break;

        case 'style4': ?>
          <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
            <div class="tb-overflow-hidden">
              <div class="tb-mb-6">
                <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="4000" data-center="0" data-slides-per-view="1">
                  <div class="slick-wrapper">

                    <?php 
                      foreach($hero_slides as $slide): 
                        $href_primary     = (!empty($slide['btn_link_primary']['url']) ) ? $slide['btn_link_primary']['url'] : '#';
                        $target_primary   = ($slide['btn_link_primary']['is_external'] == 'on') ? '_blank' : '_self';
                        $href_secondary   = (!empty($slide['btn_link_secondary']['url']) ) ? $slide['btn_link_secondary']['url'] : '#';
                        $target_secondary = ($slide['btn_link_secondary']['is_external'] == 'on') ? '_blank' : '_self';
                    ?>
                    <div class="slick-slide">
                     <div class="tb-hero <?php echo esc_attr($overlay); ?> tb-style2 tb-bg tb-flex" style="background-image: url(<?php echo esc_url($slide['bg_image']['url']); ?>);">
                        <div class="container">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="tb-hero-text">
                                <h1 class="tb-hero-title tb-font-name tb-white-c tb-f48-lg tb-f38-sm tb-mt-9 tb-mt-5-sm tb-m0 tb-mb-3-sm">
                                  <span class="tb-overflow-hidden">
                                    <?php echo wp_kses_post($slide['heading']); ?>
                                  </span>
                                </h1>
                                <div class="empty-space marg-lg-b10"></div>
                                <div class="tb-hero-subtitle  tb-white-c7 tb-f18-lg tb-line1-6 tb-mb2"><?php echo wp_kses_post($slide['description']); ?></div>
                                <div class="empty-space marg-lg-b30"></div>
                                <?php if(!empty($slide['btn_text_primary']) || !empty($slide['btn_text_secondary'])): ?>
                                  <div class="tb-btn-group tb-style1">
                                    <?php if(!empty($slide['btn_text_primary'])): ?>
                                      <a href="<?php echo esc_url($href_primary); ?>" target="<?php echo esc_attr($target_primary); ?>" class="tb-btn tb-color6 tb-btn-primary <?php echo (!empty($slide['primary_button_style'])) ? $slide['primary_button_style']: 'tb-style4'; ?>"><?php echo esc_html__($slide['btn_text_primary']); ?></a>
                                    <?php endif; ?>
                                    <?php if(!empty($slide['btn_text_secondary'])): ?>
                                      <a href="<?php echo esc_url($href_secondary); ?>" class="tb-btn tb-btn-secondary <?php echo (!empty($slide['secondary_button_style'])) ? $slide['secondary_button_style']: 'tb-style4'; ?> tb-color1 tb-video-open">
                                      <i class="fa fa-play-circle"></i><?php echo esc_html__($slide['btn_text_secondary']); ?>
                                    </a>
                                    <?php endif; ?>
                                  </div>
                                <?php endif; ?>
                              </div><!-- .tb-hero-text -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- .slick-slide -->

                  <?php endforeach; ?>




                  </div>
                </div><!-- .slick-container -->
              </div>
            </div>
            <div class="pagination tb-style2 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div><!-- .tb-carousor -->
          <?php
          # code...
          break;

        case 'style5': ?>
          <!-- Start Hero Section -->
          <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
            <div class="tb-overflow-hidden">

              <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="1000" data-center="0" data-slides-per-view="1">
                <div class="slick-wrapper">

                  <?php 
                    foreach($hero_slides as $slide): 
                      $href_primary     = (!empty($slide['btn_link_primary']['url']) ) ? $slide['btn_link_primary']['url'] : '#';
                  ?>
                    <div class="slick-slide">
                      <div class="tb-hero <?php echo esc_attr($overlay); ?> tb-style6 tb-flex tb-parallax" style="background-image: url(<?php echo esc_url($slide['bg_image']['url']); ?>);" data-speed="0.3">
                        <div class="container">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="tb-hero-text text-center tb-radious-4">
                                <div class="tb-spacing1 tb-hero-subheading tb-f14-lg tb-white-c5 tb-mt-4"><?php echo wp_kses_post($slide['sub_heading']); ?></div>
                                <div class="empty-space marg-lg-b15"></div>
                                <h1 class="tb-font-name tb-hero-title tb-f60-lg tb-f35-sm tb-white-c tb-font-name  tb-mp0"><?php echo wp_kses_post($slide['heading']); ?></h1>
                                <div class="empty-space marg-lg-b40 marg-sm-b40"></div>
                                <div class="tb-hero-subtitle">
                                  <?php echo wp_kses_post($slide['description']); ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- .slick-slide -->
                  <?php endforeach; ?>

                </div>
              </div><!-- .slick-container -->

            </div>
            <div class="pagination tb-style2 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div><!-- .tb-carousor -->
          <!-- End Hero Section -->
          <?php
          # code...
          break;
        
        default:
          # code...
          break;
      }
    endif;
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Hero_Slider_Widget() );