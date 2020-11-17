<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Tabs extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-tabs';
  }

  public function get_title() {
    return 'Tabs';
  }

  public function get_icon() {
    return 'elem_icon tabs';
  }

  public function get_script_depends() {
    return array('dragfy-addons');
  }

  public function get_style_depends() {
    return array('tab', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'tabs_general_settings',
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
          'style4' => esc_html__('Style 4', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->add_control(
      'active',
      array(
        'label'       => esc_html__('Active Tab', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('1', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'tabs_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'show_icon',
      array(
        'label'   => esc_html__('Show Icon', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SWITCHER,
        'default' => 'yes',
      )
    );

    $repeater->add_control(
      'selected_icon',
      array(
        'label'            => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'fa4compatibility' => 'icon',
        'condition' => array('show_icon' => 'yes'),
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $repeater->add_control('tab_icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'condition' => array('show_icon' => 'yes'),
        'selectors' => array(
          '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
        ),
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::WYSIWYG,
      )
    );

    $this->add_control(
      'tabs',
      array(
        'label'     => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::REPEATER,
        'fields'    => $repeater->get_controls(),
        'default'   => array(
          array(
            'title'   => esc_html__('01 Myself', 'dragfy-addons-for-elementor'),
            'content' => esc_html__('Energetic Adobe Certified Expert (ACE) web designer with 6+ years of experience. Seeking to enhance design excellence at Dujo International. Designed 5 responsive websites per month for Amphimia Global with 99% client satisfaction. Raised UX scores by 35% and customer retention by 18%. Received Awwards prize 2015.', 'dragfy-addons-for-elementor'),
          ),
          array(
            'title'   => esc_html__('02 Myself', 'dragfy-addons-for-elementor'),
            'content' => esc_html__('Energetic Adobe Certified Expert (ACE) web designer with 6+ years of experience. Seeking to enhance design excellence at Dujo International. Designed 5 responsive websites per month for Amphimia Global with 99% client satisfaction. Raised UX scores by 35% and customer retention by 18%. Received Awwards prize 2015.', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'condition'  => array('style' => array('style1')),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-tab-title h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );
    
    $this->add_control('title_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tabs .df-tab-links, {{WRAPPER}} .df-tabs .df-tab-links li' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-tab-title, {{WRAPPER}} .df-tab-title a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_color_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('title_normal_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tab-title a, {{WRAPPER}} .df-tabs .df-tab-links li a:before' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('title_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tab-title a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'title_color_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('title_hover_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tab-title a:hover, {{WRAPPER}} .df-tabs .df-tab-links li.active a:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('title_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tab-title:hover a' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();


    $this->start_controls_tab(
      'title_color_active',
      array(
        'label' => esc_html__('Active', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('title_active_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tabs .df-tab-links li.active a' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('title_active_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-tab-title.active a' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();



    $this->start_controls_section('section_value_style',
      array(
        'label' => esc_html__('Content Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tab-content' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('content_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tab-content' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('content_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tab-content' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .df-tab-content',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings = $this->get_settings_for_display();
    $style    = $settings['style'];
    $tabs     = $settings['tabs'];
    $active   = $settings['active'];

    if(is_array($tabs) && !empty($tabs)):


    switch ($style) {
      case 'style1': default: ?>
        <div class="df-tabs df-fade-tabs df-style1">
          <ul class="df-tab-links df-mp0 df-flex-start df-f16-lg df-line1-6 df-font-name df-grayb5b5b5-c">
            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (( $key + 1) == $active ) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <li class="df-tab-title <?php echo esc_attr($active_nav); ?>"><h6 class="df-grayb5b5b5-c df-m0"><a class="elementor-repeater-item-<?php echo $tab['_id']; ?>" href="#<?php echo esc_attr($anchor_id); ?>">
                <?php if($tab['show_icon'] == 'yes'): ?>
                  <?php Icons_Manager::render_icon($tab['selected_icon'], ['aria-hidden' => 'true']); ?>
                <?php endif; ?>
                <?php echo esc_html($tab['title']); ?></a></h6></li>
            <?php endforeach; ?>
          </ul>
          <div class="empty-space marg-lg-b20"></div>
          <div class="tab-content">

            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (($key + 1) == $active) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <div id="<?php echo esc_attr($anchor_id); ?>" class="df-tab <?php echo esc_attr($active_nav); ?>">
                <div class="df-f16-lg df-line1-6 df-tab-content df-about-text">
                  <?php echo do_shortcode($tab['content']); ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div><!-- .df-tabs -->
        <?php
        # code...
        break;
      
      case 'style2': ?>
        <div class="df-tabs df-fade-tabs df-style5">
          <ul class="df-tab-links df-mp0 df-flex-start df-f16-lg df-line1-6 df-font-name df-grayb5b5b5-c">
            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (( $key + 1) == $active ) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <li class="df-tab-title <?php echo esc_attr($active_nav); ?>"><a class="elementor-repeater-item-<?php echo $tab['_id']; ?>" href="#<?php echo esc_attr($anchor_id); ?>">
                <?php if($tab['show_icon'] == 'yes'): ?>
                  <?php Icons_Manager::render_icon($tab['selected_icon'], ['aria-hidden' => 'true']); ?>
                <?php endif; ?>
                <?php echo esc_html($tab['title']); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="tab-content">

            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (($key + 1) == $active) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <div id="<?php echo esc_attr($anchor_id); ?>" class="df-tab <?php echo esc_attr($active_nav); ?>">
                <div class="df-f16-lg df-line1-6 df-tab-content df-about-text">
                  <?php echo do_shortcode($tab['content']); ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div><!-- .df-tabs -->
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="df-tabs df-fade-tabs df-style5 df-type1">
          <ul class="df-tab-links df-mp0 df-flex-start df-f16-lg df-line1-6 df-font-name df-grayb5b5b5-c">
            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (( $key + 1) == $active ) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <li class="df-tab-title <?php echo esc_attr($active_nav); ?>"><a class="elementor-repeater-item-<?php echo $tab['_id']; ?>" href="#<?php echo esc_attr($anchor_id); ?>">
                <?php if($tab['show_icon'] == 'yes'): ?>
                  <?php Icons_Manager::render_icon($tab['selected_icon'], ['aria-hidden' => 'true']); ?>
                <?php endif; ?>
                <?php echo esc_html($tab['title']); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="tab-content">

            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (($key + 1) == $active) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <div id="<?php echo esc_attr($anchor_id); ?>" class="df-tab <?php echo esc_attr($active_nav); ?>">
                <div class="df-f16-lg df-line1-6 df-tab-content df-about-text">
                  <?php echo do_shortcode($tab['content']); ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div><!-- .df-tabs -->
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="df-tabs df-fade-tabs df-style6">
          <ul class="df-tab-links df-mp0 df-flex-start df-line1-6">
            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (( $key + 1) == $active ) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <li class="df-tab-title <?php echo esc_attr($active_nav); ?>"><a class="elementor-repeater-item-<?php echo $tab['_id']; ?>" href="#<?php echo esc_attr($anchor_id); ?>">
                <?php if($tab['show_icon'] == 'yes'): ?>
                  <?php Icons_Manager::render_icon($tab['selected_icon'], ['aria-hidden' => 'true']); ?>
                <?php endif; ?>
                <?php echo esc_html($tab['title']); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="tab-content">

            <?php 
              foreach($tabs as $key => $tab): 
                $active_nav = (($key + 1) == $active) ? ' active ' : '';
                $anchor_id  = $style.'-'.$key.strtolower(str_replace(' ', '-', $tab['title']));
            ?>
              <div id="<?php echo esc_attr($anchor_id); ?>" class="df-tab <?php echo esc_attr($active_nav); ?>">
                <div class="df-f16-lg df-line1-6 df-tab-content df-about-text">
                  <?php echo do_shortcode($tab['content']); ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div><!-- .df-tabs -->
        <?php
        # code...
        break;
    }  
   endif;    
  }

}



