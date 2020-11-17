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
class Webify_Text_Block_With_Button_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-text-block-with-button-widget';
  }

  public function get_title() {
    return 'Text Block With Button';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'text_block_with_button_section',
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
          'style3' => 'Style 3',
          'style4' => 'Style 4',
          'style5' => 'Style 5',
          'style6' => 'Style 6',
        )
      )
    );

    $this->add_control(
      'small_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Enter your sub heading', 'webify-addons'),
        'default'     => esc_html__('Building A Better World', 'webify-addons'),
        'condition'   => array('style' => array('style1', 'style2')),
      )
    );

    $this->add_control(
      'big_heading',
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
        'label'       => esc_html__('Description - or- List', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'placeholder' => esc_html__('Enter your description', 'webify-addons'),
        'default'     => esc_html__('Deployment long tail monetization strategy equity basic of conversion. | Supply chain freemium investor long tail agile development prototype validation influencer.', 'webify-addons'),
        'description' => esc_html__('Adding | in between sentence makes lists (only for Style 3 & Style 5).'),
        'condition'   => array('style' => array('style2', 'style3', 'style4', 'style5', 'style6')),
        'label_block' => true,
      )
    );

    $this->add_control(
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

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Primary Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Primary Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'default'     => array('url' => '#'),
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->add_control(
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

    $this->add_control(
      'secondary_btn_text',
      array(
        'label'       => esc_html__('Secondary Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Contact Us', 'webify-addons'),
        'condition'   => array('style' => array('style5')),
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'secondary_btn_link',
      array(
        'label'       => esc_html__('Secondary Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'default'     => array('url' => '#'),
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
        'condition'   => array('style' => array('style5')),
      )
    );

    $this->add_responsive_control(
      'align',
      array(
        'label' => esc_html__( 'Alignment', 'webify-addons' ),
        'type' => Controls_Manager::CHOOSE,
        'options' => array(
          'left' => array(
            'title' => esc_html__( 'Left', 'webify-addons' ),
            'icon'  => 'fa fa-align-left',
          ),
          'center' => array(
            'title' => esc_html__( 'Center', 'webify-addons' ),
            'icon'  => 'fa fa-align-center',
          ),
          'right' => array(
            'title' => esc_html__( 'Right', 'webify-addons' ),
            'icon'  => 'fa fa-align-right',
          ),
          'justify' => array(
            'title' => esc_html__( 'Justified', 'webify-addons' ),
            'icon'  => 'fa fa-align-justify',
          ),
        ),
        'default' => '',
        'condition'   => array('style' => array('style1', 'style2', 'style4', 'style6')),
        'selectors' => array(
          '{{WRAPPER}} .tb-section-heading' => 'text-align: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_small_heading',
      array(
        'label' => esc_html__('Sub Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('small_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-small-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'small_heading_typography',
        'selector' => '{{WRAPPER}} .tb-small-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_big_heading',
      array(
        'label' => esc_html__('Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('big_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-big-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'big_heading_typography',
        'selector' => '{{WRAPPER}} .tb-big-heading',
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

    $this->add_control('description_tick_color', 
      array(
        'label'       => esc_html__('Check Icon Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-description i' => 'color: {{VALUE}};',
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
        'label' => esc_html__('Primary Button', 'webify-addons'),
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




    $this->start_controls_section('section_secondary_button_style',
      array(
        'label' => esc_html__('Secondary Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('secondary_btn_style');

    $this->start_controls_tab(
      'secondary_btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('secondary_btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('secondary_btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
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
        'name'     => 'secondary_btn_typography',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-secondary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'secondary_btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('secondary_btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn-secondary:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('secondary_btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn-secondary:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'secondary_btn_typography_hover',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();


    $this->end_controls_section();


  }

  protected function render() { 
    $settings               = $this->get_settings();
    $style                  = $settings['style'];
    $small_heading          = $settings['small_heading'];
    $big_heading            = $settings['big_heading'];
    $description            = $settings['description'];
    $btn_text               = $settings['btn_text'];
    $primary_button_style   = $settings['primary_button_style'];
    $secondary_button_style = $settings['secondary_button_style'];
    $secondary_btn_text     = $settings['secondary_btn_text'];
    $href                   = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target                 = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';
    $secondary_href         = (!empty($settings['secondary_btn_link']['url']) ) ? $settings['secondary_btn_link']['url'] : '#';
    $secondary_target       = ($settings['secondary_btn_link']['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1': default: ?>
        <div class="tb-section-heading tb-style2">
          <?php if(!empty($small_heading)): ?>
            <div class="tb-f11-lg tb-mt-5 tb-mb-5 tb-small-heading tb-line1-64 tb-spacing2 tb-grayb5b5b5-c  text-uppercase"><?php echo esc_html($small_heading); ?></div>
            <div class="empty-space marg-lg-b25"></div>
          <?php endif; ?>
          <?php if(!empty($big_heading)): ?>
            <h2 class="tb-f32-lg tb-f28-sm tb-font-name tb-big-heading tb-font-name tb-mt-7 tb-mb-10 tb-mt-5-sm tb-mb-9-sm"><?php echo wp_kses_post($big_heading); ?></h2>
            <div class="empty-space marg-lg-b50 marg-sm-b40"></div>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <div class="tb-text-box-btn">
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color2 tb-font-name"><?php echo esc_html($btn_text); ?></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style2': ?>

        <div class="tb-section-heading">
          <div class="tb-style2">
            <?php if(!empty($small_heading)): ?>
              <div class="tb-f16-lg tb-small-heading tb-mt-4"><?php echo esc_html($small_heading); ?></div>
              <div class="empty-space marg-lg-b10"></div>
            <?php endif; ?>
            <?php if(!empty($big_heading)): ?>
              <h2 class="tb-f32-lg tb-big-heading tb-f25-sm tb-font-name tb-m0"><?php echo wp_kses_post($big_heading); ?></h2>
              <div class="empty-space marg-lg-b25"></div>
            <?php endif; ?>
          </div>
          <?php if(!empty($description)): ?>
            <div class="tb-line1-6 tb-f16-lg tb-description"><?php echo wp_kses_post($description); ?></div>
            <div class="empty-space marg-lg-b35"></div>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color3"><?php echo esc_html($btn_text); ?></a>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style3': 

        $lists = array();
        if (strpos($description, '|') !== false) {
          $lists = explode('|', $description);
        }
      ?>
        <div class="tb-token-text-wrap tb-section-heading">
          <div class="tb-token-text">
            <?php if(!empty($big_heading)): ?>
              <h2 class="tb-f36-lg tb-f30-sm tb-font-name tb-mb3 tb-mt-9 tb-mt-7-sm tb-big-heading"><?php echo wp_kses_post($big_heading); ?></h2>
              <div class="empty-space marg-lg-b15"></div>
            <?php endif; ?>
            <?php if(!empty($lists) && is_array($lists)): ?>
              <ul class="tb-f18-lg tb-line1-67 tb-mp0 tb-mb-8 tb-description">
                <?php foreach($lists as $list): ?>
                  <li><i class="fa fa-check"></i><?php echo esc_html($list); ?></li>
                <?php endforeach; ?>
              </ul>
              <div class="empty-space marg-lg-b40"></div>
            <?php endif; ?>
            <?php if(!empty($btn_text)): ?>
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color6"><?php echo esc_html($btn_text); ?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php
        break;

      case 'style4': ?>
        <div class="tb-token-text-wrap tb-section-heading">
          <div class="tb-token-text">
            <?php if(!empty($big_heading)): ?>
              <h2 class="tb-f36-lg tb-f30-sm tb-font-name tb-big-heading tb-mb3 tb-mt-5"><?php echo wp_kses_post($big_heading); ?></h2>
              <div class="empty-space marg-lg-b15"></div>
            <?php endif; ?>
            <?php if(!empty($description)): ?>
              <div class="tb-f18-lg tb-line1-67 tb-mp0 tb-mb-8 tb-description"><?php echo wp_kses_post($description); ?></div>
              <div class="empty-space marg-lg-b40"></div>
            <?php endif; ?>
            <?php if(!empty($btn_text)): ?>
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color6"><?php echo esc_html($btn_text); ?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style5': 
        $lists = array();
        if (strpos($description, '|') !== false) {
          $lists = explode('|', $description);
        }
      ?>
        <?php if(!empty($big_heading)): ?>
          <h2 class="tb-f36-lg tb-f30-sm tb-font-name tb-mt-7 tb-big-heading tb-m0"><?php echo wp_kses_post($big_heading); ?></h2>
          <div class="empty-space marg-lg-b20"></div>
        <?php endif; ?>
        <?php if(!empty($lists) && is_array($lists)): ?>
          <ul class="tb-mkt-list tb-mkt-green tb-mp0 tb-f18-lg tb-f16-sm tb-description tb-line1-6">
            <?php foreach($lists as $list): ?>
              <li><i class="fa fa-check-circle"></i><?php echo esc_html($list); ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="empty-space marg-lg-b35"></div>
        <?php endif; ?>
        <div class="tb-btn-group tb-style1">
          <?php if(!empty($btn_text)): ?>
            <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color9"><span><?php echo esc_html($btn_text); ?></span></a>
          <?php endif; ?>
          <?php if(!empty($secondary_btn_text)): ?>
            <a href="<?php echo esc_url($secondary_href); ?>" target="<?php echo esc_attr($secondary_target); ?>" class="tb-btn tb-btn-secondary <?php echo (!empty($secondary_button_style)) ? $secondary_button_style: 'tb-style3'; ?> tb-color9"><span><?php echo esc_html($secondary_btn_text); ?></span></a>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style6': ?>
        <div class="tb-vertical-middle tb-section-heading">
          <div class="tb-sample-text">
            <?php if(!empty($big_heading)): ?>
              <h2 class="tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-m0"><?php echo wp_kses_post($big_heading); ?></h2>
              <div class="empty-space marg-lg-b15"></div>
            <?php endif; ?>
            <?php if(!empty($description)): ?>
              <div class="tb-f16-lg tb-description tb-line1-6"><?php echo wp_kses_post($description); ?></div>
              <div class="empty-space marg-lg-b25"></div>
            <?php endif; ?>
            <?php if(!empty($btn_text)): ?>
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style5'; ?> tb-color5"><span><?php echo esc_html($btn_text); ?></span></a>
            <?php endif; ?>
          </div>
        </div>
        <?php
        # code...
        break;
    }
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Text_Block_With_Button_Widget() );