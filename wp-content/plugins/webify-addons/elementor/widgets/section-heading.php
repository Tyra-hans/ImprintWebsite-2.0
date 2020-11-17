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
class Webify_Section_Heading_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-section-heading-widget';
  }

  public function get_title() {
    return 'Section Heading';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array();
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'section_heading_section',
      array(
        'label' => esc_html__('Section Heading' , 'webify-addons')
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
          'style7' => 'Style 7',
          'style8' => 'Style 8',
        )
      )
    );

    $this->add_control(
      'small_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('This is sub heading', 'webify-addons'),
        'condition'   => array('style' => array('style2', 'style4', 'style3', 'style6')),       
      )
    );

    $this->add_control(
      'big_heading_tag',
      array(
        'label'   => esc_html__('Heading Tag', 'webify-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'h2',
        'label_block' => true,
        'options' => array(
          'h1' => 'H1',
          'h2' => 'H2',
          'h3' => 'H3',
          'h4' => 'H4',
          'h5' => 'H5',
          'h6' => 'H6',
        )
      )
    );

    $this->add_control(
      'big_heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('This is heading', 'webify-addons'),
        'dynamic' => array(
          'active' => true,
        ),       
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'placeholder' => esc_html__('Enter your heading description', 'webify-addons'),
        'default'     => esc_html__('Enter your heading description', 'webify-addons'),
        'condition'   => array('style' => array('style5')),       
        'dynamic' => array(
          'active' => true,
        ),       
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
        'condition'   => array('style' => array('style1', 'style2', 'style3', 'style4', 'style5', 'style6')),
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
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-section-heading .tb-small-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'      => 'small_heading_typography',
        'selector'  => '{{WRAPPER}} .tb-section-heading .tb-small-heading',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'sub_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-section-heading .tb-small-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        'separator' => 'before',
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
        'label'     => esc_html__('Color', 'webify-addons'),
        'type'      => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-section-heading .tb-big-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'big_heading_typography',
        'selector' => '{{WRAPPER}} .tb-section-heading .tb-big-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'big_heading_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-section-heading .tb-big-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        'separator' => 'before',
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

    $this->add_responsive_control(
      'description_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-section-heading .tb-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        'separator' => 'before',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_brder',
      array(
        'label' => esc_html__('Border', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('border_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-big-heading:before, {{WRAPPER}} .tb-big-heading:after' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings        = $this->get_settings();
    $small_heading   = $settings['small_heading'];
    $big_heading     = $settings['big_heading'];
    $big_heading_tag = $settings['big_heading_tag'];
    $description     = $settings['description'];
    $style           = $settings['style'];

    $this->add_inline_editing_attributes('big_heading');

    $this->add_render_attribute('small_heading', 'none');
    $this->add_inline_editing_attributes('small_heading');

    $this->add_render_attribute('description', 'none');
    $this->add_inline_editing_attributes('description');

    switch ($style) {
      case 'style1':
      default: 
        $this->add_render_attribute('big_heading', 'class', 'tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-5 tb-mb-8 tb-mb-6-sm');
      ?>
        <div class="tb-section-heading">
          <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-5 tb-mb-8 tb-mb-6-sm"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
        </div>
      
      <?php  
      break;

      case 'style2': 

        $this->add_render_attribute('big_heading',   'class', 'tb-f32-lg tb-f25-sm tb-big-heading tb-font-name tb-mb-6');
        $this->add_render_attribute('small_heading', 'class', 'tb-f16-lg tb-small-heading tb-mt-3');

      ?>
        <div class="tb-section-heading tb-style2">
          <?php if(!empty($small_heading)): ?>
            <div <?php echo $this->get_render_attribute_string('small_heading'); ?> class="tb-f16-lg tb-small-heading tb-mt-3"><?php echo wp_kses_post($small_heading); ?></div>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($big_heading)): ?>
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-f32-lg tb-f25-sm tb-big-heading tb-font-name tb-mb-6"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style3': 
        $this->add_render_attribute('small_heading', 'class', 'tb-f16-lg tb-small-heading tb-mt-4');
        $this->add_render_attribute('big_heading',   'class', 'tb-f32-lg tb-f25-sm tb-big-heading tb-font-name tb-m0');

      ?>

        <div class="tb-section-heading tb-style2"> 
          <?php if(!empty($small_heading)): ?>
            <div <?php echo $this->get_render_attribute_string('small_heading'); ?> class="tb-f16-lg tb-small-heading tb-mt-4"><?php echo wp_kses_post($small_heading); ?></div>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($big_heading)): ?>
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-f32-lg tb-f25-sm tb-big-heading tb-font-name tb-m0"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style4': 
        $this->add_render_attribute('big_heading',   'class', 'tb-f36-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-9 tb-mb-9 tb-mt-6-sm tb-mb-7-sm');
        $this->add_render_attribute('small_heading', 'class', 'tb-f18-lg tb-mt-5 tb-small-heading tb-mb-4');

      ?>

        <div class="tb-section-heading tb-style4">
          <?php if(!empty($big_heading)): ?>
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-f36-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-9 tb-mb-9 tb-mt-6-sm tb-mb-7-sm"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
          <?php if(!empty($small_heading)): ?>
            <div <?php echo $this->get_render_attribute_string('small_heading'); ?> class="tb-f18-lg tb-mt-5 tb-small-heading tb-mb-4"><?php echo wp_kses_post($small_heading); ?></div>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style5': 
        $this->add_render_attribute('big_heading',   'class', 'tb-f36-lg tb-f30-sm tb-font-name tb-big-heading tb-mt-5 tb-mt-3-sm tb-m0');
        $this->add_render_attribute('description',   'class', 'tb-f18-lg tb-f16-sm tb-line1-6 tb-description tb-mb-7');

      ?>

        <div class="tb-section-heading tb-style2">
          <?php if(!empty($big_heading)): ?>
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-f36-lg tb-f30-sm tb-font-name tb-big-heading tb-mt-5 tb-mt-3-sm tb-m0"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div <?php echo $this->get_render_attribute_string('description'); ?> class="tb-f18-lg tb-f16-sm tb-line1-6 tb-description tb-mb-7"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style6': 
        $this->add_render_attribute('big_heading',   'class', 'tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-6 tb-mb-9 tb-mt-4-sm tb-mb-7-sm');
        $this->add_render_attribute('small_heading',   'class', 'tb-f11-lg tb-mt-4 tb-small-heading tb-mb-5 tb-line1-6 tb-spacing2 tb-grayb5b5b5-c text-uppercase');
      ?>
        <div class="tb-section-heading tb-style2">
          <?php if(!empty($small_heading)): ?>
            <div <?php echo $this->get_render_attribute_string('small_heading'); ?> class="tb-f11-lg tb-mt-4 tb-small-heading tb-mb-5 tb-line1-6 tb-spacing2 tb-grayb5b5b5-c text-uppercase"><?php echo wp_kses_post($small_heading); ?></div>
            <div class="empty-space marg-lg-b20"></div>
          <?php endif; ?>
          <?php if(!empty($big_heading)): ?>
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-6 tb-mb-9 tb-mt-4-sm tb-mb-7-sm"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style7':
        $this->add_render_attribute('big_heading', 'class', 'tb-big-heading tb-f21-lg tb-m0');
      ?>
        <?php if(!empty($big_heading)): ?>
          <div class="tb-section-heading tb-style1 text-center">
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-big-heading tb-f21-lg tb-m0"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
          </div>
        <?php endif; ?>
        <?php
        # code...
        break;

      case 'style8':
        $this->add_render_attribute('big_heading', 'class', 'tb-big-heading tb-f18-lg tb-m0 tb-mb-2');
      ?>
        <?php if(!empty($big_heading)): ?>
          <div class="tb-section-heading tb-style6 tb-overflow-hidden tb-mt-3">
            <<?php echo esc_attr($big_heading_tag); ?> <?php echo $this->get_render_attribute_string('big_heading'); ?> class="tb-big-heading tb-f18-lg tb-m0 tb-mb-2"><?php echo wp_kses_post($big_heading); ?></<?php echo esc_attr($big_heading_tag); ?>>
          </div>
        <?php endif; ?>
        <?php
        # code...
        break;
    }
  }



  protected function _content_template() { ?>

    <#

      var bigHeading = settings.big_heading,
      smallHeading   = settings.small_heading,
      description    = settings.description,
      style          = settings.style;


      view.addInlineEditingAttributes('big_heading');
      view.addInlineEditingAttributes('small_heading', 'none');
      view.addInlineEditingAttributes('description', 'none');

      switch(style) {
        case 'style1':
          default: 
          view.addRenderAttribute( 'big_heading', 'class', 'tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-5 tb-mb-8 tb-mb-6-sm');
        #>
        <div class="tb-section-heading">
          <h2 {{{ view.getRenderAttributeString('big_heading') }}} >{{{bigHeading}}}</h2>
        </div>
        <#
        break;

        case 'style2': 

          view.addRenderAttribute( 'big_heading',   'class', 'tb-f32-lg tb-f25-sm tb-big-heading tb-font-name tb-mb-6');
          view.addRenderAttribute( 'small_heading', 'class', 'tb-f16-lg tb-small-heading tb-mt-3');

        #>
          <div class="tb-section-heading tb-style2">
          <# if(settings.small_heading != '') { #>
            <div {{{ view.getRenderAttributeString('small_heading') }}}>{{{smallHeading}}}</div>
            <div class="empty-space marg-lg-b10"></div>
          <# } #>
          <# if(settings.big_heading != '') { #>
            <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
          <# } #>
        </div>
        <#
        break;

      case 'style3': 

        view.addRenderAttribute( 'big_heading',   'class', 'tb-f32-lg tb-f25-sm tb-big-heading tb-font-name tb-m0');
        view.addRenderAttribute( 'small_heading', 'class', 'tb-f16-lg tb-small-heading tb-mt-4');

      #>
        <div class="tb-section-heading tb-style2"> 
          <# if(settings.small_heading != '') { #>
            <div {{{ view.getRenderAttributeString('small_heading') }}}>{{{smallHeading}}}</div>
            <div class="empty-space marg-lg-b10"></div>
          <# } #>
          <# if(settings.big_heading != '') { #>
            <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
          <# } #>
        </div>
        <#
        break;

      case 'style4': 
        view.addRenderAttribute( 'big_heading',   'class', 'tb-f36-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-9 tb-mb-9 tb-mt-6-sm tb-mb-7-sm');
        view.addRenderAttribute( 'small_heading', 'class', 'tb-f18-lg tb-mt-5 tb-small-heading tb-mb-4');

      #>
        <div class="tb-section-heading tb-style4">
          <# if(settings.big_heading != '') { #>
            <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
            <div class="empty-space marg-lg-b30"></div>
          <# } #>
          <# if(settings.small_heading != '') { #>
            <div {{{ view.getRenderAttributeString('small_heading') }}} >{{{smallHeading}}}</div>
          <# } #>
        </div>
        <#
        break;

      case 'style5':
        view.addRenderAttribute( 'big_heading',   'class', 'tb-f36-lg tb-f30-sm tb-font-name tb-big-heading tb-mt-5 tb-mt-3-sm tb-m0');
        view.addRenderAttribute( 'description', 'class', 'tb-f18-lg tb-f16-sm tb-line1-6 tb-description tb-mb-7');
      #>
        <div class="tb-section-heading tb-style2">
          <# if(settings.big_heading != '') { #>
            <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
            <div class="empty-space marg-lg-b10"></div>
          <# } #>
          <# if(settings.description != '') { #>
            <div {{{ view.getRenderAttributeString('description') }}}>{{{description}}}</div>
          <# } #>
        </div>
        <#
        break;

      case 'style6':
        view.addRenderAttribute( 'big_heading',   'class', 'tb-f32-lg tb-f28-sm tb-big-heading tb-font-name tb-mt-6 tb-mb-9 tb-mt-4-sm tb-mb-7-sm');
        view.addRenderAttribute( 'small_heading', 'class', 'tb-f11-lg tb-mt-4 tb-small-heading tb-mb-5 tb-line1-6 tb-spacing2 tb-grayb5b5b5-c text-uppercase');
      #>
      <div class="tb-section-heading tb-style2">
        <# if(settings.small_heading != '') { #>
          <div {{{ view.getRenderAttributeString('small_heading') }}}>{{{smallHeading}}}</div>
          <div class="empty-space marg-lg-b20"></div>
        <# } #>
        <# if(settings.big_heading != '') { #>
          <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
        <# } #>
      </div>
      <#
      break;

    case 'style7':
        view.addRenderAttribute( 'big_heading',   'class', 'tb-big-heading tb-f21-lg tb-m0');
      #>
      <div class="tb-section-heading tb-style1 text-center">
        <# if(settings.big_heading != '') { #>
          <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
        <# } #>
      </div>
      <#
      break;

    case 'style8':
        view.addRenderAttribute( 'big_heading',   'class', 'tb-big-heading tb-f18-lg tb-m0 tb-mb-2');
      #>
      <div class="tb-section-heading tb-style6 tb-overflow-hidden tb-mt-3">
        <# if(settings.big_heading != '') { #>
          <h2 {{{ view.getRenderAttributeString('big_heading') }}}>{{{bigHeading}}}</h2>
        <# } #>
      </div>
      <#
      break;
    }

    #>
    <?php 
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Section_Heading_Widget() );