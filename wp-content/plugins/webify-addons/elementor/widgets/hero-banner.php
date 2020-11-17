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
class Webify_Hero_Banner_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-hero-banner-widget';
  }

  public function get_title() {
    return 'Hero Banner';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('web-animation', 'ball', 'text-slider', 'svg-wave');
  }

  public function get_style_depends() {
    return array('webify-button', 'webify-hero', 'webify-text-slider', 'webify-client');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  public function get_form_id() {
    global $wpdb;

    $db_cf7froms  = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
    $cf7_forms    = array();

    if ( $db_cf7froms ) {

      foreach ( $db_cf7froms as $cform ) {
        $cf7_forms[$cform->post_title] = $cform->ID;
      }

    } else {
      $cf7_forms['No contact forms found'] = 0;
    }

    return $cf7_forms;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'hero_banner_section',
      array(
        'label' => esc_html__('Hero Banner' , 'webify-addons')
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
          'style4' => 'Style 4',
          'style5' => 'Style 5',
          'style6' => 'Style 6',
          'style7' => 'Style 7',
          'style8' => 'Style 8',
          'style9' => 'Style 9',
        )
      )
    );

    $this->add_control(
      'bg_image',
      array(
        'label'       => esc_html__('Image', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
        'condition'   => array('style' => array('style2', 'style3', 'style4', 'style5', 'style7', 'style8', 'style9'))    
      )
    );

    $this->add_control(
      'overlay',
      array(
        'label'     => esc_html__('Overlay', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'separator' => 'after',
        'condition' => array('style' => array('style4', 'style9')),
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'default'     => 'Make it professional.<br>Make it beautiful.',
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'default'     => 'We design digital platforms that elevate the customer experience <br>for the world\'s most beloved brands.',
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA
      )
    );

    $this->add_control(
      'client_images',
      array(
        'label'       => esc_html__('Client Images', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::GALLERY,
        'condition'   => array('style' => array('style5'))    
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
        'condition'   => array('style' => array('style1', 'style2', 'style3', 'style5', 'style7', 'style8', 'style9')),
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'default'     => esc_html__('Button Text.', 'webify-addons'),
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3', 'style5', 'style7', 'style8', 'style9')),    
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'condition'   => array('style' => array('style1', 'style3', 'style5', 'style7', 'style8', 'style9')),  
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->add_control(
      'form',
      array(
        'label'       => esc_html__('Form', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::HEADING,
        'separator'   => 'before',
        'condition'   => array('style' => array('style3'))
      )
    );


    $this->add_control(
      'form_heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'default'     => esc_html__('Make an Appointment', 'webify-addons'),
        'separator'   => 'before',
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'form_sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'default'     => esc_html__('Fill-out the details for imformation', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style3'))
      )
    );

    $this->add_control(
      'form_id',
      array(
        'label'       => esc_html__('Contact Form', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'condition'   => array('style' => array('style3')),
        'description' => esc_html__('Choose previously created contact form from the drop down list.', 'webify-addons'),
        'options'     => array('' => 'Select Contact Form') + array_flip($this->get_form_id()),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_bg_style',
      array(
        'label' => esc_html__('Background', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'     => 'background',
        'label'    => esc_html__( 'Background', 'webify-addons'),
        'types'    => array('classic', 'gradient'),
        'selector' => '{{WRAPPER}} .tb-hero.tb-style11',
      )
    );

    $this->end_controls_section();


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
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-text-slider' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-text-slider',
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
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-subtitle' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-hero-subtitle',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_shape_style',
      array(
        'label' => esc_html__('Shape', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('shape_color_1', 
      array(
        'label'       => esc_html__('Color 1', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-shap-animation-wrap.tb-style1 .tb-shap-animation-in b,
           {{WRAPPER}} .tb-hero-img-box-circle, {{WRAPPER}} .tb-circle-shape1'  => 'background: {{VALUE}};',
          '{{WRAPPER}} .tb-shap-animation-wrap.tb-style1 .tb-shap-animation1 .tb-shap-animation-in span,
           {{WRAPPER}} .tb-shap-animation2 span' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('shape_color_2', 
      array(
        'label'       => esc_html__('Color 2', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-shap-animation-wrap.tb-style1 .tb-shap-animation2 span,
           {{WRAPPER}} .tb-shap-animation3' => 'border-color: {{VALUE}};',
           '{{WRAPPER}} .tb-circle-shape2'  => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('shape_color_3', 
      array(
        'label'       => esc_html__('Color 3', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-shap-animation-wrap.tb-style1 .tb-shap-animation3' => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .tb-circle-shape3'                                     => 'background: {{VALUE}};',
          '{{WRAPPER}} .tb-pattern2, {{WRAPPER}} .tb-pattern1'                => 'background-image: radial-gradient({{VALUE}} 15%,transparent 15%);',
        ),
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
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-btn .tb-btn,
           {{WRAPPER}} .tb-subscribe-btn' => 'background-color: {{VALUE}};',
          '{{WRAPPER}} .tb-subscribe-btn' => 'border-color: {{VALUE}};',

        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-btn .tb-btn,
           {{WRAPPER}} .tb-subscribe-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .tb-hero-btn .tb-btn, {{WRAPPER}} .tb-subscribe-btn',
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
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-btn .tb-btn:hover,
           {{WRAPPER}} .tb-subscribe-btn:hover' => 'background-color: {{VALUE}};',
          '{{WRAPPER}} .tb-subscribe-btn:hover' => 'border-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-hero-btn .tb-btn:hover,
           {{WRAPPER}} .tb-subscribe-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .tb-hero-btn .tb-btn:hover, {{WRAPPER}} .tb-subscribe-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();



    $this->start_controls_section('section_form_heading_style',
      array(
        'label' => esc_html__('Form Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('form_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-form-heading h2' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'form_heading_typography',
        'selector' => '{{WRAPPER}} .tb-form-heading h2',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_form_sub_heading_style',
      array(
        'label' => esc_html__('Form Sub Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('form_sub_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-form-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'form_sub_heading_typography',
        'selector' => '{{WRAPPER}} .tb-form-sub-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();




    $this->start_controls_section('section_form_button_style',
      array(
        'label' => esc_html__('Form Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('form_btn_style');

    $this->start_controls_tab(
      'form_btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('form_btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit' => 'background-color: {{VALUE}};',

        ),
      )
    );

    $this->add_control('form_btn_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'form_btn_typography',
        'selector' => '{{WRAPPER}} .wpcf7-submit',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'form_btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('form_btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('form_btn_text_color_hover', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .wpcf7-submit:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'form_btn_typography_hover',
        'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();


  }

  protected function render() { 
    $settings         = $this->get_settings_for_display();
    $style            = $settings['style'];
    $heading          = $settings['heading'];
    $description      = $settings['description'];
    $form_heading     = $settings['form_heading'];
    $form_sub_heading = $settings['form_sub_heading'];
    $form_id          = $settings['form_id'];
    $btn_text         = $settings['btn_text'];
    $btn_link         = $settings['btn_link'];
    $bg_image         = $settings['bg_image'];
    $overlay          = $settings['overlay'];
    $button_style     = $settings['button_style'];
    $client_images    = $settings['client_images'];
    $href             = (!empty($btn_link['url']) ) ? $btn_link['url'] : '#';
    $target           = ($btn_link['is_external'] == 'on') ? '_blank' : '_self';
    $overlay          = ($overlay == 'yes') ? 'has-overlay':'no-overlay';


    switch ($style) {
      case 'style1': default: ?>
        <div class="tb-hero tb-style5 tb-flex text-center">
          <div id="tb-ball-wrap"></div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <?php if(!empty($heading)): ?>
                  <h1 class="tb-text-slider tb-f60-lg tb-f40-sm tb-line1 tb-font-name tb-font-name tb-mt-6 tb-mb-9 tb-mt-5-sm tb-mb-3-sm"><?php echo wp_kses_post($heading); ?></h1>
                  <div class="empty-space marg-lg-b30"></div>
                <?php endif; ?>
                <?php if(!empty($description)): ?>
                  <div class="tb-hero-subtitle tb-f18-lg tb-line1-6 tb-mt-5 tb-mb-5"><?php echo wp_kses_post($description); ?></div>
                  <div class="empty-space marg-lg-b40"></div>
                <?php endif; ?>
                <?php if(!empty($btn_text)): ?>
                  <div class="tb-hero-btn">
                    <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style4'; ?> tb-color2"><?php echo esc_html($btn_text); ?></a>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php
       # code...
       break;


      case 'style2': 

      $heading = (strpos($heading, ',') !== false) ? explode(',', $heading):$heading;

      ?>
        <section class="tb-hero tb-style3 tb-bg tb-flex">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="tb-hero-text">
                  <div class="tb-section-heading tb-style2 text-center">
                    <h1 class="tb-text-slider slide tb-f48-lg tb-f36-sm tb-font-name tb-m0 tb-mt-9 tb-mt-5-sm">

                      <?php if(is_array($heading)): ?>

                        <span><?php echo wp_kses_post($heading[0]); ?></span>
                        <span class="tb-words-wrapper tb-waiting">
                          <b class="is-visible"><?php echo wp_kses_post($heading[1]); ?>.</b>
                          <?php 
                            $heading = array_slice($heading, 2);  
                            if(!empty($heading) && is_array($heading)):
                              foreach($heading as $words):
                          ?>  
                                <b><?php echo wp_kses_post($words); ?></b>
                          <?php 
                              endforeach; 
                            endif; 
                          ?>
                        </span>
                      <?php else: ?>
                        <span><?php echo wp_kses_post($heading); ?></span>
                      <?php endif; ?>

                    </h1>
                    <div class="empty-space marg-lg-b10"></div>
                  <?php if(!empty($description)): ?>
                    <div class="tb-hero-subtitle tb-f18-lg tb-f16-sm tb-line1-6 tb-mb-3"><?php echo wp_kses_post($description); ?></div>
                  <?php endif; ?>
                  </div>
                  <div class="empty-space marg-lg-b35"></div>

                  <?php if(class_exists('Newsletter')): ?>
                    <form action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="tb-hero-form tb-style1">
                      <input type="email" name="ne" required="" placeholder="<?php echo esc_html__('Enter Your Email Adress', 'webify-addons'); ?>">
                      <?php if(!empty($btn_text)): ?>
                        <button class="tb-btn tb-subscribe-btn newsletter-submit tb-style4 tb-color9"><?php echo esc_html($btn_text); ?></button>
                      <?php endif; ?>
                    </form>
                    <div class="empty-space marg-lg-b60 marg-sm-b40"></div>
                  <?php endif; ?>

                  <?php if(!empty($bg_image) && is_array($bg_image)): ?>
                    <div class="tb-hero-img text-center">
                      <img src="<?php echo esc_url($bg_image['url']); ?>" alt="image">
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Hero Section -->
        <?php
        # code...
        break;

      case 'style3': 

        $bg_style = (is_array($bg_image) && !empty($bg_image['url'])) ? ' style="background-image:url('.esc_url($bg_image['url']).');"':''; 

      ?>
        <div class="tb-hero tb-style7 tb-bg tb-flex"<?php echo wp_kses_post($bg_style); ?>>
          <div class="container">
            <div class="row">
              <div class="col-lg-7">
                <div class="tb-vertical-middle">
                  <div class="tb-hero-text">
                    <?php if(!empty($heading)): ?>
                      <h1 class="tb-hero-title tb-text-slider tb-f60-lg tb-f35-sm tb-m0 tb-font-name"><?php echo wp_kses_post($heading); ?></h1>
                      <div class="empty-space marg-lg-b10 marg-sm-b10"></div>
                    <?php endif; ?>
                    <?php if(!empty($description)): ?>
                      <div class="tb-hero-subtitle tb-f18-lg tb-line1-6"><?php echo wp_kses_post($description); ?></div>
                      <div class="empty-space marg-lg-b35 marg-sm-b35"></div>
                    <?php endif; ?>
                    <?php if(!empty($btn_text)): ?>
                      <div class="tb-hero-btn">
                        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style6'; ?> tb-color8"><span><?php echo esc_html($btn_text); ?></span></a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <?php if(!empty($form_id)): ?>
                <div class="col-lg-5">
                  <div class="tb-box-shadow2">
                    <div class="tb-hero-form tb-style2 tb-radious-4">
                      <div class="tb-form-heading tb-style1 text-center">
                        <h2 class="tb-f24-lg tb-mb4 tb-mt-6"><?php echo esc_html($form_heading); ?></h2>
                        <div class="tb-mb-6 tb-form-sub-heading"><?php echo esc_html($form_sub_heading); ?></div>
                      </div><!-- .tb-form-heading -->

                        <!-- form starts from here [contact form 7] -->
                        <div class="tb-appointment-form tb-form-body"><?php echo do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]'); ?></div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>


            </div>
          </div>
         </div>
         <?php
        # code...
        break;

      case 'style4': 
        $bg_style = (is_array($bg_image) && !empty($bg_image['url'])) ? ' style="background-image:url('.esc_url($bg_image['url']).');"':''; 
      ?>
        <div class="tb-hero tb-parallax <?php echo esc_attr($overlay); ?> tb-style9 tb-bg tb-flex text-center" data-speed="0.4" <?php echo wp_kses_post($bg_style); ?>>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="tb-hero-text">
                  <?php if(!empty($heading)): ?>
                    <h1 class="tb-hero-title tb-text-slider tb-white-c tb-f60-lg tb-f38-sm tb-font-name tb-m0"><?php echo wp_kses_post($heading); ?></h1>
                    <div class="empty-space marg-lg-b5"></div>
                  <?php endif; ?>
                  <?php if(!empty($description)): ?>
                    <div class="tb-hero-subtitle tb-white-c tb-f20-lg tb-line1-6"><?php echo wp_kses_post($description); ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style5': ?>
        <div class="tb-hero-banner">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
                <div class="tb-hero-text">
                  <?php if(!empty($heading)): ?>
                    <h1 class="tb-hero-title tb-text-slider tb-f60-lg tb-f38-sm tb-font-name tb-mp0"><?php echo wp_kses_post($heading); ?></h1>
                    <div class="empty-space marg-lg-b5"></div>
                  <?php endif; ?>
                  <?php if(!empty($description)): ?>
                    <div class="tb-hero-subtitle tb-f20-lg tb-line1-6 tb-mb2"><?php echo wp_kses_post($description); ?></div>
                    <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
                  <?php endif; ?>
                  <?php if(!empty($btn_text)): ?>
                    <div class="tb-hero-btn">
                      <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style6'; ?> tb-color4"><?php echo esc_html($btn_text); ?></a>
                    </div>
                    <div class="empty-space marg-lg-b60 marg-sm-b40"></div>
                  <?php endif; ?>
                  <?php if(is_array($client_images) & !empty($client_images)): ?>
                    <div class="tb-clients tb-style1">
                      <?php foreach($client_images as $image): if(!empty($image['url'])): ?>
                        <div class="tb-client tb-style4"><img src="<?php echo esc_url($image['url']); ?>" alt=""></div>
                      <?php endif; endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="empty-space marg-lg-b100 marg-sm-b0"></div>
              </div>

              <?php if(!empty($bg_image['url'])): ?>
                <div class="col-lg-6">
                  <div class="empty-space marg-lg-b100 marg-sm-b30"></div>
                  <div class="tb-hero-img text-center">
                    <img src="<?php echo esc_url($bg_image['url']); ?>" alt="hero-img">
                    <div class="tb-shap-animation-wrap">
                      <div class="tb-shap-animation tb-shap-animation2"><span></span></div>
                      <div class="tb-shap-animation tb-shap-animation3"></div>
                    </div>
                    <div class="tb-pattern-animation"><div class="tb-pattern2"></div></div>
                  </div>
                  <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style6': 
        $heading = (strpos($heading, ',') !== false) ? explode(',', $heading):$heading;
      ?>
        <div class="tb-hero tb-style10 tb-flex">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="empty-space marg-lg-b150 marg-sm-b100"></div>
                <div class="tb-section-heading tb-style2">
                  <div class="tb-f16-lg tb-hero-subtitle tb-mt-4"><?php echo wp_kses_post($description); ?></div>
                  <div class="empty-space marg-lg-b10"></div>
                  <h1 class="tb-text-slider slide tb-f48-lg tb-f36-sm tb-font-name tb-mb-3">

                    <?php if(is_array($heading)): ?>

                      <span><?php echo wp_kses_post($heading[0]); ?></span>
                      <span class="tb-words-wrapper tb-waiting">
                        <b class="is-visible"><?php echo wp_kses_post($heading[1]); ?>.</b>
                        <?php 
                          $heading = array_slice($heading, 2);  
                          if(!empty($heading) && is_array($heading)):
                            foreach($heading as $words):
                        ?>  
                              <b><?php echo wp_kses_post($words); ?></b>
                        <?php 
                            endforeach; 
                          endif; 
                        ?>
                      </span>
                    <?php else: ?>
                      <span><?php echo wp_kses_post($heading); ?></span>
                    <?php endif; ?>

                  </h1>
                </div>
                <div class="empty-space marg-lg-b135 marg-sm-b90"></div>
              </div>
            </div>
          </div>
          <div class="tb-shap-animation-wrap tb-style1">
            <div class="tb-shap-animation tb-shap-animation1">
              <div class="tb-shap-animation-in">
                <b></b>
                <span></span>
              </div>
            </div>
            <div class="tb-shap-animation tb-shap-animation2"><span></span></div>
            <div class="tb-shap-animation tb-shap-animation3"></div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style7': ?>
        <!-- Start Hero Section -->


        <div class="tb-hero tb-style5 tb-flex">
          <!-- <div id="tb-ball-wrap" class=" wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.1s"></div> -->
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="tb-vertical-middle">
                  <div class="tb-vertical-middle-in">
                    <?php if(!empty($heading)): ?>
                      <h1 class="tb-text-slider tb-f60-lg tb-f40-sm tb-line1 tb-m0 tb-font-name"><?php echo wp_kses_post($heading); ?></h1>
                      <div class="empty-space marg-lg-b15"></div>
                    <?php endif; ?>
                    <?php if(!empty($description)): ?>
                      <div class="tb-hero-subtitle tb-f18-lg tb-line1-6 tb-mb2"><?php echo wp_kses_post($description); ?></div>
                      <div class="empty-space marg-lg-b30"></div>
                    <?php endif; ?>
                    <div class="tb-hero-btn">
                      <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style4'; ?> tb-color19"><?php echo esc_html($btn_text); ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(!empty($bg_image['url'])): ?>
                <div class="col-lg-6">
                  <div class="tb-vertical-middle">
                    <div class="tb-vertical-middle-in">
                      <div class="tb-hero-img tb-style1" >
                        <div class="tb-hero-img-box tb-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
                        <div class="tb-hero-img-box-pattern"><div class="tb-pattern1"></div></div>
                        <div class="tb-hero-img-box-circle"></div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style8': ?>

        <div class="tb-hero tb-style11 tb-bg tb-flex">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="tb-hero-text text-center">
                  <h1 class="tb-hero-title tb-text-slider tb-white-c tb-f48-lg tb-f35-sm tb-font-name tb-m0"><?php echo wp_kses_post($heading); ?></h1>
                  <div class="empty-space marg-lg-b10"></div>
                  <div class="tb-hero-subtitle tb-white-c tb-f18-lg tb-line1-6 tb-mb2"><?php echo wp_kses_post($description); ?></div>
                  <div class="empty-space marg-lg-b30"></div>
                  <div class="tb-btn-group tb-hero-btn tb-style1">
                    <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style4'; ?> tb-color1"><?php echo esc_html($btn_text); ?></a>
                  </div>
                </div>
                <?php if(!empty($bg_image['url'])): ?>
                  <div class="empty-space marg-lg-b80 marg-sm-b40"></div>
                  <div class="tb-hero-img tb-style2">
                    <img src="<?php echo esc_url($bg_image['url']); ?>" alt="image">
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="tb-circle-shape-wrap">
            <div class="tb-circle-shape1"></div>
            <div class="tb-circle-shape2"></div>
            <div class="tb-circle-shape3"></div>
          </div>
          <svg id="tb-svg-wave"><path></path><path></path></svg> 
        </div>
        <?php
        # code...
        break;

      case 'style9': ?>
        <div class="tb-hero12-wrap">
          <div class="tb-hero <?php echo esc_attr($overlay); ?> tb-style12 tb-flex text-center">
            <div class="tb-hero-bg tb-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="tb-hero-text">
                    <h1 class="tb-hero-title tb-white-c tb-f72-lg tb-text-slider tb-f42-sm tb-m0 tb-mt-10"><?php echo wp_kses_post($heading); ?></h1>
                    <div class="empty-space marg-lg-b15"></div>
                    <div class="tb-hero-subtitle tb-white-c7 tb-f20-lg tb-f16-sm tb-line1-6 tb-mb2"><?php echo wp_kses_post($description); ?></div>
                    <div class="empty-space marg-lg-b40 marg-sm-b40"></div>
                    <div class="tb-hero-btn">
                      <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style6'; ?> tb-color20"><?php echo esc_html($btn_text); ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        break;
             
   } 

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Hero_Banner_Widget() );