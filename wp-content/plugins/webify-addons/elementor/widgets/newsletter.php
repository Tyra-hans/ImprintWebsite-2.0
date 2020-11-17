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
class Webify_Newsletter_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-newsletter-widget';
  }

  public function get_title() {
    return 'Newsletter';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-newsletter', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'newsletter_section',
      array(
        'label' => esc_html__('Newsletter' , 'webify-addons')
      )
    );

    $this->add_control(
      'newsletter_type',
      array(
        'label'       => esc_html__('Type', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'newsletter',
        'label_block' => true,
        'options' => array(
          'newsletter' => 'Newsletter',
          'mailchimp'  => 'Mailchimp',
        ),
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
        ),
      )
    );

    $this->add_control(
      'mc4wp_form_id',
      array(
        'label'       => esc_html__('Form', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'description' => esc_html__('Choose previously created form from the drop down list.', 'webify-addons'),
        'options'     => array('' => 'Select Mailchimp Form') + array_flip(webify_get_form_id()),
        'condition'   => array('newsletter_type' => array('mailchimp'))
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'condition'   => array('style' => array('style2'))
      )
    );


    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Subscribe Newsletter', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Fill-out the form for informations', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'name_placeholder',
      array(
        'label'       => esc_html__('Name Placeholder', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Name', 'webify-addons'),
        'condition'   => array('style' => array('style1')),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('newsletter_type' => array('newsletter'))
      )
    );

    $this->add_control(
      'email_placeholder',
      array(
        'label'       => esc_html__('Email Placeholder', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Email Address', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('newsletter_type' => array('newsletter'))
      )
    );

    $this->add_control(
      'button_style',
      array(
        'label'       => esc_html__('Button Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'condition'   => array('newsletter_type' => array('newsletter')),
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
        'label_block' => true,
        'default'     => esc_html__('Subscribe Newsletter', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('newsletter_type' => array('newsletter'))
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_bg_color',
      array(
        'label' => esc_html__('Background', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'     => 'newsletter_bg',
        'label'    => esc_html__('Background Color', 'webify-addons'),
        'types'    => array('gradient', 'classic'),
        'selector' => '{{WRAPPER}} .tb-7a77d0-bg',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_heading_color',
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
          '{{WRAPPER}} .tb-subscribe-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-subscribe-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_sub_heading_color',
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
          '{{WRAPPER}} .tb-subscribe-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_heading_typography',
        'selector' => '{{WRAPPER}} .tb-subscribe-sub-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_btn_style',
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
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn, {{WRAPPER}} .tb-newsletter-submit, {{WRAPPER}} .tb-mc4wp-form input[type="submit"]' => 'background-color: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn, {{WRAPPER}} .tb-newsletter-submit, {{WRAPPER}} .tb-mc4wp-form input[type="submit"]' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .tb-btn, {{WRAPPER}} .tb-newsletter-submit, {{WRAPPER}} .tb-mc4wp-form input[type="submit"]',
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
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover, {{WRAPPER}} .tb-newsletter-submit:hover, {{WRAPPER}} .tb-mc4wp-form input[type="submit"]:hover'  => 'background-color: {{VALUE}};border-color:{{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover, {{WRAPPER}} .tb-newsletter-submit:hover, {{WRAPPER}} .tb-mc4wp-form input[type="submit"]:hover'  => 'color: {{VALUE}};',
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

    $this->end_controls_tabs();


    $this->end_controls_section();


  }

  protected function render() { 
    $settings          = $this->get_settings_for_display();
    $newsletter_type   = $settings['newsletter_type'];
    $mc4wp_form_id     = $settings['mc4wp_form_id'];
    $style             = $settings['style'];
    $heading           = $settings['heading'];
    $sub_heading       = $settings['sub_heading'];
    $name_placeholder  = $settings['name_placeholder'];
    $email_placeholder = $settings['email_placeholder'];
    $image             = $settings['image'];
    $btn_text          = $settings['btn_text'];
    $button_style      = $settings['button_style'];

    switch ($style) {
      case 'style1': default: ?>
        <div class="tb-border <?php echo esc_attr($style); ?>">
          <div class="tb-subscribe-heading text-center">
            <div class="empty-space marg-lg-b25"></div>
            <h3 class="tb-f18-lg tb-line23-lg  tb-font-name tb-m0"><?php echo esc_html($heading); ?></h3>
            <p class="tb-m0 "><?php echo esc_html($sub_heading); ?></p>
            <div class="empty-space marg-lg-b25"></div>
          </div>
          <hr>
          <?php if($newsletter_type == 'mailchimp' && !empty($mc4wp_form_id)): ?>
            <?php echo do_shortcode('[mc4wp_form id="'.$mc4wp_form_id.'"]'); ?>
          <?php else: ?>
            <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="tb-newsletter tb-style4">
              <input type="text" name="nn" required="" placeholder="<?php echo esc_html($name_placeholder); ?>">
              <input type="text" name="ne" required="" placeholder="<?php echo esc_html($email_placeholder); ?>">
              <div class="empty-space marg-lg-b5"></div>
              <button class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style3'; ?> tb-color9 newsletter-submit w-100"><span><?php echo esc_html($btn_text); ?></span></button>
            </form>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;
      case 'style2': ?>
        <div class="tb-7a77d0-bg <?php echo esc_attr($style); ?>">
          <div class="container">
            <div class="row">
              <?php if(is_array($image) && !empty($image['url'])): ?>
                <div class="col-lg-6">
                  <div class="empty-space marg-lg-b0 marg-sm-b60"></div>
                  <div class="tb-vertical-middle text-center">
                    <div class="tb-vertical-middle-in">
                      <img src="<?php echo esc_url($image['url']); ?>" alt="image">
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <div class="col-lg-6">
                <div class="empty-space marg-lg-b100 marg-sm-b30"></div>
                <div class="tb-section-heading tb-style2">
                  <h2 class="tb-f40-lg tb-f25-sm tb-subscribe-heading tb-font-name tb-mt-7 tb-mb-2 tb-white-c"><?php echo wp_kses_post($heading); ?></h2>
                  <div class="empty-space marg-lg-b5 marg-sm-b5"></div>
                  <div class="tb-f16-lg tb-line1-6 tb-subscribe-sub-heading tb-white-c7"><?php echo wp_kses_post($sub_heading); ?></div>
                  <div class="empty-space marg-lg-b25 marg-sm-b25"></div>
                  <?php if($newsletter_type == 'mailchimp' && !empty($mc4wp_form_id)): ?>
                    <?php echo do_shortcode('[mc4wp_form id="'.$mc4wp_form_id.'"]'); ?>
                  <?php else: ?>
                    <form action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" method="post" class="tb-newsletter tb-style7">
                      <div class="tb-form-field">
                        <input type="text" name="ne" required="" placeholder="<?php echo esc_html($email_placeholder); ?>">
                      </div>
                      <input type="submit" class="tb-newsletter-submit newsletter-submit" value="<?php echo esc_attr($btn_text); ?>">
                    </form>
                  <?php endif; ?>
                </div>
                <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
              </div>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;
    }
    
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Newsletter_Widget() );