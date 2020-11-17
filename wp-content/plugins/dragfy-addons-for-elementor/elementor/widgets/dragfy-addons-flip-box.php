<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Flip_Box extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-flip-box';
  }

  public function get_title() {
    return 'Flip Box';
  }

  public function get_icon() {
    return 'elem_icon flip_box';
  }

  public function get_script_depends() {
    return array('dragfy-addons');
  }

  public function get_style_depends() {
    return array('flipbox', 'button', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'flip_box_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
          'style2' => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
          'style3' => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->add_control(
      'flip_animation_style',
      array(
        'label'       => esc_html__('Animation Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'df-type1',
        'label_block' => true,
        'options' => array(
          'df-type1' => esc_html__('Horizontal', 'dragfy-addons-for-elementor'),
          'df-type2' => esc_html__('Vertical', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->end_controls_section();




    $this->start_controls_section(
      'flip_settings',
      array(
        'label' => esc_html__('Flip Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'flip_style_border',
        'selector' => '{{WRAPPER}} .df-flipbox-in'
      )
    );

    $this->add_responsive_control(
      'flip_style_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-flipbox-in' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->start_controls_tabs('flip_setting');

    $this->start_controls_tab(
      'flip_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Background Image', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'condition'   => array('style' => array('style2', 'style1')),
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $this->add_control('flip_normal_bg', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition'   => array('style' => 'style3'),
        'selectors' => array(
          '{{WRAPPER}} .df-before-flick' => 'background: {{VALUE}};',
        ),
      )
    );
    

    $this->end_controls_tab();


    $this->start_controls_tab(
      'flip_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('flip_hover_bg', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-after-flick' => 'background: {{VALUE}};',
        ),
      )
    );



    $this->end_controls_tabs();
    $this->end_controls_section();



    $this->start_controls_section(
      'flip_box_icon_settings',
      array(
        'label'     => esc_html__('Icon Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style2', 'style3')),
      )
    );

    $this->add_control(
      'selected_icon',
      array(
        'label'            => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'fa4compatibility' => 'icon',
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'flip_box_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Super Creative', 'dragfy-addons-for-elementor')       
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::WYSIWYG,
        'label_block' => true,
        'default'     => esc_html__('You can choose from 320+ icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style1', 'style2'))       
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'flip_box_btn_settings',
      array(
        'label'     => esc_html__('Button Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style2', 'style3'))
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'btn_url',
      array(
        'label'       => esc_html__('Button URL', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#'),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'pro_section',
        array(
          'label' => esc_html__('Go Premium for More Features', 'dragfy-addons-for-elementor')
        )
    );

    $this->add_control(
      'get_pro',
      array(
        'label' => esc_html__('Unlock more possibilities', 'dragfy-addons-for-elementor' ),
        'type'  => Controls_Manager::CHOOSE,
        'options' => array(
          '1' => array(
            'title' => esc_html__('', 'dragfy-addons-for-elementor'),
            'icon'  => 'fa fa-unlock-alt',
          ),
        ),
        'default'     => '1',
        'description' => '<span class="pro-feature"> Get the  <a href="https://dragfy.com/elementor-addons/" target="_blank">Pro version</a> for more stunning elements and customization options.</span>'
      )
    );
            
    $this->end_controls_section();


    $this->start_controls_section('section_general_style',
      array(
        'label'     => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'flip_box_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-flip-box-wrap',
      )
    );


    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'flip_box_border',
        'selector' => '{{WRAPPER}} .df-flip-box-wrap'
      )
    );

    $this->add_responsive_control(
      'flip_box_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-flip-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'flip_box_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-flip-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'flip_box_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-flip-box-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'flip_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-flip-box-wrap',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_icon_color',
      array(
        'label' => esc_html__('Icon Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2', 'style3'))
      )
    );


    $this->add_control('icon_color', 
      array(
        'label'     => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-icon' => 'color: {{VALUE}};',
        ),
      )
    );
    
    $this->add_responsive_control(
      'icon_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );


    $this->add_responsive_control(
      'icon_size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 60,
            'step' => 1,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon' => 'font-size: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_title_color',
      array(
        'label' => esc_html__('Title Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-flip-box-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-flip-box-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-flip-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_color',
      array(
        'label'     => esc_html__('Description Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style!' => array('style3'))
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-description-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .df-description-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'description_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-description-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    
    $this->start_controls_section('section_button_style',
      array(
        'label'     => esc_html__('Button Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2', 'style3'))
      )
    );

    $this->add_responsive_control(
      'btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'btn_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'btn_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_border',
        'selector' => '{{WRAPPER}} .df-btn'
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .df-btn',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('btn_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_hover_border',
        'selector' => '{{WRAPPER}} .df-btn:hover'
      )
    );

    $this->add_control('btn_text_hover_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_hover_typography',
        'selector' => '{{WRAPPER}} .df-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_hover_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-btn:hover',
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();


  }

  protected function render() { 
    $settings             = $this->get_settings();
    $style                = $settings['style'];
    $title                = $settings['title'];
    $image                = $settings['image'];
    $description          = $settings['description'];
    $selected_icon        = $settings['selected_icon'];
    $flip_animation_style = $settings['flip_animation_style'];
    $btn_url              = $settings['btn_url'];
    $btn_text             = $settings['btn_text'];
    $btn_href             = (!empty($btn_url['url']) ) ? $btn_url['url'] : '#';
    $btn_target           = ($btn_url['is_external'] == 'on') ? '_blank' : '_self';


    switch ($style) {
      case 'style1':
      default: ?>
        <div class="df-hover-layer df-flip-box-wrap">
          <div class="hover-container">
            <div class="df-flipbox df-style1 <?php echo esc_attr($flip_animation_style); ?>">
              <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
                <div class="df-flipbox-in df-before-flick">
                  <div class="df-card-img df-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                </div>
              <?php endif; ?>
              <div class="df-flipbox-in df-after-flick">
                <div class="df-card-text">
                  <h2 class="df-card-title df-flip-box-title"><?php echo esc_html($title); ?></h2>
                  <div class="df-card-subtitle df-description-text"><?php echo wp_kses_post($description); ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="df-hover-layer df-flip-box-wrap">
          <div class="hover-container">
            <div class="df-flipbox df-style1 <?php echo esc_attr($flip_animation_style); ?>">
              <div class="df-flipbox-in df-before-flick">
                <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
                  <div class="df-card-img df-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                <?php endif; ?>
                <div class="df-flipbox-iconbox">
                  <div class="df-flipbox-icon df-icon">
                    <?php if(is_array($selected_icon) && $selected_icon['library'] == 'svg'): ?>
                      <img src="<?php echo esc_url($selected_icon['value']['url']); ?>" alt="icon">
                    <?php else: ?>
                      <i class="<?php echo esc_attr($selected_icon['value']); ?>"></i>
                    <?php endif; ?>
                  </div>
                  <h2 class="df-flipbox-iconbox-title df-flip-box-title"><?php echo esc_html($title); ?></h2>
                  <div class="df-flipbox-iconbox-subtitle df-description-text"><?php echo wp_kses_post($description); ?></div>
                </div>
              </div>
              <div class="df-flipbox-in df-after-flick">
                <div class="df-card-text">
                  <a href="<?php echo esc_url($btn_href); ?>" target="<?php echo esc_attr($btn_target); ?>" class="df-btn df-style4 df-color1"><?php echo esc_html($btn_text); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="df-hover-layer df-flip-box-wrap">
          <div class="hover-container">
            <a href="<?php echo esc_url($btn_href); ?>" target="<?php echo esc_attr($btn_target); ?>" class="df-flipbox df-style2 <?php echo esc_attr($flip_animation_style); ?>">
              <div class="df-flipbox-in df-before-flick">
                <div class="df-flipbox-iconbox">
                  <div class="df-flipbox-icon">
                    <?php if(is_array($selected_icon) && $selected_icon['library'] == 'svg'): ?>
                      <img src="<?php echo esc_url($selected_icon['value']['url']); ?>" alt="icon">
                    <?php else: ?>
                      <i class="<?php echo esc_attr($selected_icon['value']); ?>"></i>
                    <?php endif; ?>
                  </div>
                  <h2 class="df-flipbox-iconbox-title df-flip-box-title"><?php echo esc_html($title); ?></h2>
                </div>
              </div>
              <div class="df-flipbox-in df-after-flick">
                <div class="df-card-text"><span class="df-btn df-style3 df-color2"><?php echo esc_html($btn_text); ?></span></div>
              </div>
            </a>
          </div>
        </div>
        <?php
        # code...
        break;
    }
    
  }
}
