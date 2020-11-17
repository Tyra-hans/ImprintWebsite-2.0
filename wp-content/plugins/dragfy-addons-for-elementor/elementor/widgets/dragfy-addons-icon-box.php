<?php 

namespace DragfyAddons\Elementor\Widgets;
use DragfyAddons\Helpers\Helpers;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Icon_Box extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-icon-box';
  }

  public function get_title() {
    return 'Icon Box';
  }

  public function get_icon() {
    return 'elem_icon icon_box';
  }

  public function get_script_depends() {
    return array('dragfy-addons');
  }

  public function get_style_depends() {
    return array('icon-box', 'button', 'image-box', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'icon_box_general_settings',
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
          'style1'  => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
          'style2'  => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
          'style3'  => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
          'style4'  => esc_html__('Style 4', 'dragfy-addons-for-elementor'),
          'style5'  => esc_html__('Style 5', 'dragfy-addons-for-elementor'),
          'style6'  => esc_html__('Style 6', 'dragfy-addons-for-elementor'),
          'style7'  => esc_html__('Style 7', 'dragfy-addons-for-elementor'),
          'style8'  => esc_html__('Style 8', 'dragfy-addons-for-elementor'),
          'style9'  => esc_html__('Style 9', 'dragfy-addons-for-elementor'),
          'style10' => esc_html__('Style 10', 'dragfy-addons-for-elementor'),
          'style11' => esc_html__('Style 11', 'dragfy-addons-for-elementor'),
          'style12' => esc_html__('Style 12', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->add_responsive_control(
      'horizontal_position_left',
      array(
        'label'       => esc_html__('Horizontal Position - Left (px)', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box.df-style14' => 'left: {{SIZE}}px;',
        ),
        'condition'   => array('style' => array('style12')),
      )
    );

    $this->add_responsive_control(
      'horizontal_position_right',
      array(
        'label'       => esc_html__('Horizontal Position - Right (px)', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'condition'   => array('style' => array('style12')),
        'range' => array(
          'px' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 1,
          ),
        ),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box.df-style14' => 'right: {{SIZE}}px;',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'icon_box_icon_settings',
      array(
        'label' => esc_html__('Icon Settings' , 'dragfy-addons-for-elementor')
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
      'icon_box_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Super Creative', 'dragfy-addons-for-elementor'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::WYSIWYG,
        'default'     => esc_html__('You can choose from 320+ icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'dragfy-addons-for-elementor'),
        'condition'   => array('style' => array('style1', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9', 'style10', 'style11')),
        'label_block' => true,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'icon_box_link_settings',
      array(
        'label'     => esc_html__('Link Settings' , 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style2', 'style3', 'style4', 'style9'))
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style3', 'style4', 'style9'))
      )
    );

    $this->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#'),
        'condition'   => array('style' => array('style2', 'style3', 'style4', 'style9'))
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
        'name'      => 'icon_box_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'condition' => array('style' => array('style2', 'style3', 'style4', 'style7', 'style11', 'style12')),
        'selector'  => '{{WRAPPER}} .df-icon-box',
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'icon_box_border',
        'selector' => '{{WRAPPER}} .df-icon-box'
      )
    );

    $this->add_responsive_control(
      'icon_box_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'condition' => array('style' => array('style2', 'style3', 'style4', 'style7', 'style9', 'style11')),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box, {{WRAPPER}} .df-icon-box.df-style9:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'icon_box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'condition' => array('style' => array('style2', 'style3', 'style4', 'style7', 'style9', 'style11')),
        'selector'  => '{{WRAPPER}} .df-icon-box',
      )
    );


    $this->add_responsive_control(
      'icon_box_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'icon_box_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_icon_color',
      array(
        'label' => esc_html__('Icon Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_bg_color', 
      array(
        'label'     => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'condition' => array('style' => array('style1', 'style3', 'style8', 'style9', 'style10', 'style11')),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'     => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon'     => 'color: {{VALUE}};',
          '{{WRAPPER}} .df-icon-box .df-icon svg' => 'fill: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'      => 'icon_border',
        'condition' => array('style' => array('style1', 'style3', 'style8', 'style9', 'style10', 'style11')),
        'selector'  => '{{WRAPPER}} .df-icon-box .df-icon'
      )
    );

    $this->add_responsive_control(
      'icon_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'condition' => array('style' => array('style1', 'style3', 'style8', 'style9', 'style10', 'style11')),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-icon-box .df-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'icon_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        'default' => array('unit' => 'px', 'size' => 34),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-icon-box .df-icon' => 'font-size: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .df-icon-box .df-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
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
          '{{WRAPPER}} .df-icon-box .df-iconbox-heading' => 'color: {{VALUE}};',
          '{{WRAPPER}} .df-image-box.df-style4 h3'       => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-icon-box .df-iconbox-heading',
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
          '{{WRAPPER}} .df-icon-box .df-iconbox-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_color',
      array(
        'label'     => esc_html__('Description Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9', 'style10', 'style11')),
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

    $this->start_controls_section('section_link_style',
      array(
        'label'     => esc_html__('Link Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style3', 'style4', 'style9'))
      )
    );

    $this->add_responsive_control(
      'link_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->start_controls_tabs('link_style');

    $this->start_controls_tab(
      'link_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('link_text_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-btn:before' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'link_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('link_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();


  }

  protected function render() { 
    $settings      = $this->get_settings();
    $style         = $settings['style'];
    $selected_icon = $settings['selected_icon'];
    $title         = $settings['title'];
    $description   = $settings['description'];
    $link_url      = $settings['link_url'];
    $link_text     = $settings['link_text'];
    $href          = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $target        = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1': default: ?>
      <div class="df-icon-box df-style3 df-mkt-green">
        <div class="df-icon df-icon-bg">
          <?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?>
        </div>
        <?php if(!empty($title)): ?>
          <h3 class="df-iconbox-heading df-f18-lg df-font-name df-mt-4 df-mb5"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        <?php if(!empty($description)): ?>
          <div class="df-iconbox-text df-description-text  df-mb-6"><?php echo wp_kses_post($description); ?></div>
        <?php endif; ?>
      </div>
      
      <?php  
      break;

      case 'style2': ?>

        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-iconbox df-with-bg-color df-icon-box df-style13 text-center">
          <div class="df-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
          <div class="empty-space marg-lg-b20 marg-sm-b20"></div>
          <h3 class="df-fw-medium df-iconbox-title df-iconbox-heading df-051e31-c df-line1-2"><?php echo esc_html($title); ?></h3>
        </a>
        
        <?php
        break;

      case 'style3': ?>

        <div class="df-icon-box df-style3 df-type1">
          <div class="df-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-f18-lg df-font-name df-font-name df-mt-3 df-mb3"><?php echo esc_html($title); ?></h3>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-description-text  df-line1-6 df-mb8"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
          <?php if(!empty($link_text)): ?>
            <div class="df-icon-box-btn df-mb-6">
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style2 df-color7"><?php echo esc_html($link_text); ?><i class="fa fa-angle-right"></i></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="df-icon-box df-style4 df-border df-with-bg-color text-center">
          <div class="df-icon df-f48-lg">
            <?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?>
          </div>
          <div class="empty-space marg-lg-b20"></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-font-name df-f18-lg  df-m0"><?php echo esc_html($title); ?></h3>
          <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-description-text df-mb3"><?php echo wp_kses_post($description); ?></div>
            <div class="empty-space marg-lg-b20 marg-sm-b20"></div>
          <?php endif; ?>
          <?php if(!empty($link_text)): ?>
            <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style1"><?php echo esc_html($link_text); ?></a>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style5': ?>
        <div class="df-icon-box df-style5">
          <div class="df-icon df-f48-lg">
            <?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?>
          </div>
          <div class="empty-space marg-lg-b15"></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-f18-lg df-font-name  df-m0 df-mt-3"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-description-text df-mb-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style6': ?>
        <div class="df-icon-box df-style7">
          <div class="df-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-font-name df-f18-lg  df-m0 df-mb-5"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b20"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-iconbox-text df-description-text  df-mt-6 df-mb-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style7': ?>
        <div class="df-icon-box df-style6 df-with-bg-color text-center df-radious-5 df-font-lato ">
          <div class="df-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
          <div class="empty-space marg-lg-b30"></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-f18-lg  df-white-c9 df-mt-4 df-mb-4 df-font-libre-baskerville"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-iconbox-text df-f16-lg df-description-text df-line1-5  df-white-c7 df-mt-7 df-mb-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style8': ?>
        <div class="df-icon-box df-style8">
          <div class="df-icon df-f28-lg df-icon-bg df-flex df-radious-50">
            <?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?>
          </div>
          <div class="empty-space marg-lg-b20"></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-font-open-sanse df-f18-lg df-mt-4 df-mb-4"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b15"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-iconbox-text df-line1-6 df-description-text df-mt-6 df-mb-6"><?php echo wp_kses_post($description); ?></div>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style9': 

        $icon_color   = $settings['icon_color'];
        $output_css   = '';
        $uniqid_class = '';   
        $unique_id    = uniqid();

        if(!empty($icon_color)):
          $output_css .= '.custom-color-properties-'.$unique_id.'.df-icon-box.df-style9.df-color1:hover {';
          $output_css .=  'background-image: linear-gradient(120deg, '.Helpers::hex_to_rgba($icon_color, 0.6).' 0%, '.$icon_color.');';
          $output_css .=  'box-shadow: 0px 10px 19px 1px '.Helpers::hex_to_rgba($icon_color, 0.2).';';
          $output_css .= '}';

          $output_css .= '.custom-color-properties-'.$unique_id.'.df-icon-box.df-style9.df-color1 .df-icon {';
          $output_css .= 'background-color:'.Helpers::hex_to_rgba($icon_color, 0.2).';';
          $output_css .= '}';

          Helpers::add_inline_css($output_css);
          $uniqid_class = ' custom-color-properties-'.$unique_id;
        endif;
        


      ?>
        <div class="df-hover-layer">
          <div class="hover-container df-style3">
            <div class="df-icon-box df-style9 <?php echo esc_attr($uniqid_class); ?> df-color1 df-radious-5">
              <div class="df-icon df-f22-lg df-radious-50 df-icon-bg df-flex">
                <?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?>
              </div>
              <div class="empty-space marg-lg-b15"></div>
              <?php if(!empty($title)): ?>
                <h3 class="df-iconbox-heading df-f18-lg df-font-name df-m0 df-mt2"><?php echo esc_html($title); ?></h3>
                <div class="empty-space marg-lg-b5"></div>
              <?php endif; ?>
              <?php if(!empty($description)): ?>
                <div class="df-iconbox-text">
                  <div class="df-iconbox-text-in df-description-text"><?php echo wp_kses_post($description); ?></div>
                </div>
              <?php endif; ?>
              <?php if(!empty($link_text)): ?>
                <div class="df-icon-box-btn"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="df-btn df-style1"><?php echo esc_html($link_text); ?></a></div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style10': ?>
        <div class="df-icon-box df-style10 df-color1">
          <div class="df-icon df-color1 df-f22-lg df-radious-50 df-icon-bg df-flex">
            <?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?>
          </div>
          <div class="empty-space marg-lg-b10"></div>
          <?php if(!empty($title)): ?>
            <h3 class="df-iconbox-heading df-f18-lg df-font-name df-m0 df-mt2"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b5"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="df-iconbox-text df-description-text"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;
      case 'style11': ?>
        <div class="df-iconbox df-icon-box df-style12">
          <div class="df-iconbox-icon df-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
          <h3 class="df-fw-medium df-iconbox-heading df-iconbox-title df-051e31-c df-line1-2"><?php echo esc_html($title); ?></h3>
          <div class="df-iconbox-text df-description-text df-051e31-c df-line1-6"><?php echo wp_kses_post($description); ?></div>
        </div>
        <?php
        # code...
        break;

      case 'style12': ?>
        <div class="df-iconbox df-icon-box df-style14">
          <div class="df-iconbox-shadow"></div>
          <div class="df-iconbox-in">
            <div class="df-iconbox-icon df-icon"><?php Icons_Manager::render_icon($selected_icon, ['aria-hidden' => 'true']); ?></div>
            <h3 class="df-fw-regular df-iconbox-heading df-iconbox-title df-line1-2"><?php echo esc_html($title); ?></h3>
          </div>
        </div>
        <?php
        # code...
        break;

    }
  }
}
