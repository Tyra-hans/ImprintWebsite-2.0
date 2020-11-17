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
class Webify_Interactive_Card_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-interactive-card-widget';
  }

  public function get_title() {
    return 'Interactive Card';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-button', 'webify-image-box', 'webify-video-block');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'interactive_card_section',
      array(
        'label' => esc_html__('Text Block With Button' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'webify-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
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
      'youtube_url',
      array(
        'label'       => esc_html__('URL', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter your URL', 'webify-addons'),
        'default'     => 'https://www.youtube.com/embed/7KIEvEODCI4?autoplay=1',
        'label_block' => true,
        'condition'   => array('style' => array('style2'))
      )
    );


    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Enter your heading', 'webify-addons'),
        'default'     => esc_html__('Rewarding entertainment for you and your loved ones', 'webify-addons'),
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::WYSIWYG,
        'default'     => esc_html__('I also believe it\'s important for every member to be involved and invested in our company and this is one way to do so crank this out products need full resourcing and support from a cross-functional team.', 'webify-addons'),
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
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons'),
        'type'        => Controls_Manager::TEXT
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

    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'webify-addons'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .tb-image-box-text',
      )
    );

    
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'webify-addons'),
        'selector'  => '{{WRAPPER}} .tb-image-box',
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
          '{{WRAPPER}} .tb-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-heading',
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
          '{{WRAPPER}} .tb-description' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-description',
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
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .tb-btn',
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
          '{{WRAPPER}} .tb-btn:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .tb-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

  }

  protected function render() { 
    $settings             = $this->get_settings();
    $style                = $settings['style'];
    $image                = $settings['image'];
    $youtube_url          = $settings['youtube_url'];
    $heading              = $settings['heading'];
    $description          = $settings['description'];
    $btn_text             = $settings['btn_text'];
    $primary_button_style = $settings['button_style'];
    $href                 = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target               = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1': default: ?>
        <div class="tb-image-box tb-style7">
          <?php if(!empty($image['url'])): ?>
            <div class="tb-image-box-img"><img src="<?php echo esc_url($image['url']); ?>" alt="img"></div>
          <?php endif; ?>
          <div class="tb-image-box-text">
            <div class="tb-image-box-text-in">
              <h2 class="tb-image-box-title tb-heading"><?php echo wp_kses_post($heading); ?></h2>
              <div class="tb-image-box-subtitle tb-description"><?php echo wp_kses_post($description); ?></div>
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color2 tb-font-name"><?php echo esc_html($btn_text); ?></a>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;
      
      case 'style2': ?>
        <div class="tb-image-box tb-style8">
          <div class="tb-image-box-text">
            <div class="tb-image-box-text-in">
              <h2 class="tb-image-box-title tb-heading"><?php echo wp_kses_post($heading); ?></h2>
              <div class="tb-image-box-subtitle tb-description"><?php echo wp_kses_post($description); ?></div>
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color2 tb-font-name"><?php echo esc_html($btn_text); ?></a>
            </div>
          </div>
          <?php if(!empty($image['url'])): ?>
            <div class="tb-image-box-img">
              <img src="<?php echo esc_url($image['url']); ?>" alt="img">
              <a href="<?php echo esc_url($youtube_url); ?>" class="tb-play-btn tb-style1 tb-video-open"></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;
    }

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Interactive_Card_Widget() );