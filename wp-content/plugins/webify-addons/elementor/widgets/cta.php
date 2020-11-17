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
class Webify_Call_To_Action_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-cta-widget';
  }

  public function get_title() {
    return 'Call to Action';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-cta', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'cta_section',
      array(
        'label' => esc_html__('Call to Action' , 'webify-addons')
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
      'bg_image',
      array(
        'label'   => esc_html__('Background Image', 'webify-addons'),
        'type'    => Controls_Manager::MEDIA,
        'default' => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $this->add_control(
      'obj_image',
      array(
        'label'     => esc_html__('Object Image', 'webify-addons'),
        'type'      => Controls_Manager::MEDIA,
        'default'   => array('url' => \Elementor\Utils::get_placeholder_image_src()),
        'condition' => array('style' => array('style2')),
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Enter your heading', 'webify-addons'),
        'dynamic' => array(
          'active' => true,
        ),       
      )
    );

    $this->add_control(
      'sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Enter your sub heading', 'webify-addons'),
        'condition'   => array('style' => array('style1')),
        
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
      'primary_btn_text',
      array(
        'label'       => esc_html__('Primary Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your primary button text here.', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'primary_btn_link',
      array(
        'label'       => esc_html__('Primary Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
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
        'placeholder' => esc_html__('Enter your secondary button text here.', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1')),
      )
    );

    $this->add_control(
      'secondary_btn_link',
      array(
        'label'       => esc_html__('Secondary Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
        'condition'   => array('style' => array('style1')),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_sub_heading',
      array(
        'label' => esc_html__('Sub Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('sub_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_heading_typography',
        'selector' => '{{WRAPPER}} .tb-sub-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
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
        'label_block' => true,
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


    $this->start_controls_section('section_primary_button_style',
      array(
        'label' => esc_html__('Primary Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('primary_btn_style');

    $this->start_controls_tab(
      'primary_btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('primary_btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('primary_btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'primary_btn_typography',
        'selector' => '{{WRAPPER}} .tb-btn.tb-btn-primary',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'primary_btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('primary_btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('primary_btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-primary:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'primary_btn_typography_hover',
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

    $this->add_control('secondary_btn_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary' => 'border-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('secondary_btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-secondary' => 'color: {{VALUE}};',
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
          '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('secondary_btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn.tb-btn-secondary:hover' => 'color: {{VALUE}};',
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
    $bg_image               = $settings['bg_image'];
    $obj_image              = $settings['obj_image'];
    $sub_heading            = $settings['sub_heading'];
    $heading                = $settings['heading'];
    $primary_button_style   = $settings['primary_button_style'];
    $secondary_button_style = $settings['secondary_button_style'];
    $primary_btn_text       = $settings['primary_btn_text'];
    $primary_href           = (!empty($settings['primary_btn_link']['url']) ) ? $settings['primary_btn_link']['url'] : '#';
    $primary_target         = ($settings['primary_btn_link']['is_external'] == 'on') ? '_blank' : '_self';
    $secondary_btn_text     = $settings['secondary_btn_text'];
    $secondary_href         = (!empty($settings['secondary_btn_link']['url']) ) ? $settings['secondary_btn_link']['url'] : '#';
    $secondary_target       = ($settings['secondary_btn_link']['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-bg tb-cta-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);">
          <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="tb-cta tb-style1">
                  <div class="tb-cta-left">
                    <?php if(!empty($heading)): ?>
                      <h2 class="tb-f30-lg tb-font-name tb-heading tb-line1-2 tb-white-c tb-mt-6 tb-m0"><?php echo esc_html($heading); ?></h2>
                      <div class="empty-space marg-lg-b10"></div>
                    <?php endif; ?>
                    <?php if(!empty($sub_heading)): ?>
                      <div class="tb-f16-lg tb-line1-6 tb-sub-heading tb-white-c6 tb-mb-5"><?php echo esc_html($sub_heading); ?></div>
                      <div class="empty-space marg-lg-b0 marg-sm-b20"></div>
                    <?php endif; ?>
                  </div>
                  <?php if(!empty($primary_btn_text) || !empty($secondary_btn_text)): ?>
                    <div class="tb-cta-right">
                      <div class="tb-btn-group tb-style1">
                        <?php if(!empty($primary_btn_text)): ?>
                          <a href="<?php echo esc_attr($primary_href); ?>" target="<?php echo esc_attr($primary_target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color6 tb-mt10"><?php echo esc_html($primary_btn_text); ?></a>
                        <?php endif; ?>
                        <?php if(!empty($secondary_btn_text)): ?>
                          <a href="<?php echo esc_attr($secondary_href); ?>" target="<?php echo esc_attr($secondary_target); ?>" class="tb-btn tb-btn-secondary <?php echo (!empty($secondary_button_style)) ? $secondary_button_style: 'tb-style3'; ?> tb-color1 tb-mt10"><?php echo esc_html($secondary_btn_text); ?></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
        </div>
        <?php
        break;

      case 'style2': ?>
        <div class="tb-bg tb-cta-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);">
          <div class="empty-space marg-lg-b70 marg-sm-b60"></div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="tb-cta tb-style1">
                  <div class="tb-cta-left">
                    <?php if(!empty($heading)): ?>
                      <h2 class="tb-f24-lg tb-font-name tb-line1-2 tb-white-c tb-m0 tb-mt-4"><?php echo wp_kses_post($heading); ?></h2>
                      <div class="empty-space marg-lg-b25"></div>
                      <?php endif; ?>
                    <?php if(!empty($primary_btn_text)): ?>
                      <a href="<?php echo esc_attr($primary_href); ?>" target="<?php echo esc_attr($primary_target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($primary_button_style)) ? $primary_button_style: 'tb-style3'; ?> tb-color6"><?php echo esc_html($primary_btn_text); ?></a>
                    <?php endif; ?>
                  </div>
                  <?php if(!empty($obj_image['url']) && is_array($obj_image)): ?>
                    <div class="tb-cta-img">
                      <img src="<?php echo esc_url($obj_image['url']); ?>" alt="mobile">
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="empty-space marg-lg-b70 marg-sm-b60"></div>
        </div>
        <?php
        break;

    }
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Call_To_Action_Widget() );