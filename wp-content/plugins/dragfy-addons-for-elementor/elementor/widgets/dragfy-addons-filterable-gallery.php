<?php

namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use DragfyAddons\Helpers\Helpers;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Filterable_Gallery extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-filterable-gallery';
  }

  public function get_title() {
    return 'Filterable Gallery';
  }

  public function get_icon() {
    return 'elem_icon filterable_gallery';
  }

  public function is_reload_preview_required() {
    return true;
  }

  public function get_script_depends() {
    return array('isotope', 'imagesloaded', 'light-gallery', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('isotope', 'image-box', 'light-gallery', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  public function filter_name($category_name) {
    if(empty($category_name)) { return; }
    $category_name = strtolower(str_replace(' ', '-', $category_name));
    return $category_name;
  }

  public function filter_class($category_name) {
    if(empty($category_name)) { return; }
    $category_name = strtolower(str_replace(',', ' ', $category_name));
    $category_name = str_replace(' ', '-', $category_name);
    return $category_name;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'filterable_gallery_general_settings',
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
          'style5' => esc_html__('Style 5', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->add_responsive_control(
      'gallery_height',
      array(
        'label'       => esc_html__('Height', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('You may need to click `Apply` button after settings this option', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'condition'   => array('style' => 'style1'),
        'range' => array(
          'px' => array(
            'max'  => 600,
            'step' => 10,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-image-box.df-style2.df-height2 .df-bg' => 'height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'filterable_gallery_filters_settings',
      array(
        'label' => esc_html__('Filters Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'all_label',
      array(
        'label'       => esc_html__('"All" Label', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('All', 'dragfy-addons-for-elementor')

      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'category_name',
      array(
        'label'       => esc_html__('Name', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,

      )
    );


    $this->add_control(
      'categories_items',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'category_name' => esc_html__('Category 1', 'dragfy-addons-for-elementor'),
          ),
          array(
            'category_name' => esc_html__('Category 2', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ category_name }}</span>',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section(
      'filterable_gallery_images_settings',
      array(
        'label' => esc_html__('Images Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $img_repeater = new Repeater();

    $img_repeater->add_control(
      'image',
      array(
        'label'       => esc_html__('Upload Image', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),

      )
    );

    $img_repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Image #1', 'dragfy-addons-for-elementor')

      )
    );

    $img_repeater->add_control(
      'assigned_category',
      array(
        'label'       => esc_html__('Category', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'description' => esc_html__('To assign for multiple categories, separate by a comma', 'dragfy-addons-for-elementor')

      )
    );

    $img_repeater->add_control(
      'link_to',
      array(
        'label'       => esc_html__('Link To', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'options'     => array(
          'lightbox' => esc_html__('Lightbox', 'dragfy-addons-for-elementor'),
          'external' => esc_html__('External Link', 'dragfy-addons-for-elementor'),
          'pages'    => esc_html__('Existing Page', 'dragfy-addons-for-elementor'),
        ),
        'default'   => 'lightbox'
      )
    );

    $img_repeater->add_control(
      'all_pages',
      array(
        'label'       => esc_html__('Select Page', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'condition'   => array('link_to' => 'pages'),
        'options'     => Helpers::get_all_pages(),
      )
    );

    $img_repeater->add_control(
      'external_url',
      array(
        'label'       => esc_html__('External URL', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'condition'   => array('link_to' => 'external'),
        'label_block' => true,
        'default'     => array('url' => '#')
      )
    );

    $this->add_control(
      'images_item',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $img_repeater->get_controls(),
        'default' => array(
          array(
            'title'             => esc_html__('Image #1', 'dragfy-addons-for-elementor'),
            'assigned_category' => esc_html__('Category 1', 'dragfy-addons-for-elementor'),
          ),
          array(
            'title'             => esc_html__('Image #2', 'dragfy-addons-for-elementor'),
            'assigned_category' => esc_html__('Category 2', 'dragfy-addons-for-elementor'),
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
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


    $this->start_controls_section('section_filterable_gallery_general',
      array(
        'label'     => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-image-box',
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'     => 'filterable_gallery_shadow',
        'label'    => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector' => '{{WRAPPER}} .df-image-box',
      )
    );

    $this->add_group_control(
      Group_Control_Css_Filter::get_type(),
      array(
        'name'     => 'filterable_gallery_css_filter',
        'selector' => '{{WRAPPER}} .df-image-box .df-bg',
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'filterable_gallery_border',
        'selector' => '{{WRAPPER}} .df-image-box .df-bg',
      )
    );

    $this->add_responsive_control(
      'filterable_gallery_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'filterable_gallery_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-image-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'filterable_gallery_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-image-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_filterable_gallery_overlay',
      array(
        'label'     => esc_html__('Overlay Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('overlay_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-image-box.df-style2 .df-image-link:before' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_filterable_gallery_title',
      array(
        'label'     => esc_html__('Title Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2'))
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_color_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Title Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-image-meta h3 a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'title_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('title_color_hover', 
      array(
        'label'       => esc_html__('Title Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-image-meta h3 a:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-image-meta h3',
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
          '{{WRAPPER}} .df-image-meta h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_filterable_gallery_category',
      array(
        'label'     => esc_html__('Category Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2'))
      )
    );

    $this->add_control('category_color', 
      array(
        'label'       => esc_html__('Category Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-image-meta span' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'category_typography',
        'selector' => '{{WRAPPER}} .df-image-meta span',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'category_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-image-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_filterable_gallery_filter',
      array(
        'label'     => esc_html__('Filter Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'filter_typography',
        'selector' => '{{WRAPPER}} .df-isotop-filter a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'filter_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'filter_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'filter_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->start_controls_tabs('filter_style');

    $this->start_controls_tab(
      'filter_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );


    $this->add_control('filter_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter a' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('filter_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'filter_border',
        'selector' => '{{WRAPPER}} .df-isotop-filter li a',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'filter_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('filter_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter a:hover' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('filter_color_hover', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter a:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'filter_border_hover',
        'selector' => '{{WRAPPER}} .df-isotop-filter li a:hover',
      )
    );


    $this->end_controls_tab();

    $this->start_controls_tab(
      'filter_active',
      array(
        'label' => esc_html__('Active', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('filter_bg_color_active', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter li.active a' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('filter_color_active', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-isotop-filter li.active a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'filter_border_active',
        'selector' => '{{WRAPPER}} .df-isotop-filter li.active a',
      )
    );

    $this->end_controls_tab();

    $this->end_controls_section();
  }

  protected function render() { 

    $settings         = $this->get_settings();
    $style            = $settings['style'];
    $all_label        = $settings['all_label'];
    $categories_items = $settings['categories_items'];
    $images_item      = $settings['images_item'];


    switch ($style) {
      case 'style1':
      default: ?>
        <?php if(!empty($images_item) && is_array($images_item)): ?>
          <div class="df-portfolio-wrapper">
            <div class="df-overflow-hidden">

              <?php if(count($categories_items) > 0 && is_array($categories_items)): ?>
                <div class="df-isotop-filter df-style1 text-center">
                  <ul class="df-mp0 df-flex df-f16-lg df-black111-c ">
                    <li class="active"><a href="#" data-filter="*"><?php echo esc_html($all_label); ?></a></li>
                    <?php foreach ($categories_items as $item): ?>
                      <li><a href="#" data-filter=".<?php echo $this->filter_name($item['category_name']); ?>"><?php echo esc_html($item['category_name']); ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
              <div class="df-isotop df-style1 df-port-col-3 df-has-gutter df-lightgallery">
                <div class="df-grid-sizer"></div>

                  <?php 
                    foreach($images_item as $item):
                      $lightbox_class = $url = ''; 
                      switch ($item['link_to']) {
                        case 'external':
                          $url    = (!empty($item['external_url']['url']) ) ? $item['external_url']['url'] : '#';
                          $target = ($item['external_url']['is_external'] == 'on') ? '_blank' : '_self';
                          break;
                        case 'pages':
                          $url    = get_the_permalink($item['all_pages']);
                          $target = '_blank';
                          break;
                        case 'lightbox':
                        default:
                          $url            = $item['image']['url'];
                          $lightbox_class = 'df-lightbox-item';
                          $target         = '_self';
                          # code...
                          break;
                      }
                  ?>
                    <div class="df-isotop-item <?php echo esc_attr($this->filter_class($item['assigned_category'])); ?>">
                      <div class="df-image-box df-style2 df-relative df-radious-4 df-border df-height2">
                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="df-image-link <?php echo esc_attr($lightbox_class); ?> df-zoom">
                          <div class="df-image df-relative">
                            <?php if($item['link_to'] == 'lightbox'): ?>
                              <img src="<?php echo esc_url($item['image']['url']); ?>" alt="thumb">
                            <?php endif; ?>
                            <div class="df-bg df-zoom-in1" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);"></div>
                          </div>
                        </a>
                        <div class="df-image-meta">
                          <h3 class="df-f16-lg df-font-name df-mb5 df-mt-3"><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($item['title']); ?></a></h3>
                          <div class="df-mb-6">
                            <span><?php echo esc_html($item['assigned_category']); ?></span>
                          </div>
                        </div>
                      </div>
                    </div><!-- .df-isotop-item -->
                  <?php endforeach; ?>

              </div><!-- .isotop -->
            </div>
          </div>
        <?php endif; ?>
        <?php
        # code...
        break;
      
      case 'style2': ?>
        <?php if(!empty($images_item) && is_array($images_item)): ?>
          <div class="df-portfolio-wrapper">
            <?php if(count($categories_items) > 0 && is_array($categories_items)): ?>
              <div class="df-isotop-filter df-style1 text-center">
                <ul class="df-mp0 df-flex df-f16-lg df-black111-c">
                  <li class="active"><a href="#" data-filter="*"><?php echo esc_html($all_label); ?></a></li>
                  <?php foreach ($categories_items as $item): ?>
                    <li><a href="#" data-filter=".<?php echo $this->filter_name($item['category_name']); ?>"><?php echo esc_html($item['category_name']); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <div class="df-isotop df-style1 df-port-col-4 df-has-gutter df-lightgallery">
              <div class="df-grid-sizer"></div>

              <?php 
                $class_array = array('df-w50|df-height1', 'df-w25|df-height2', 'df-w25|df-height2');
                $count = 0;

                foreach($images_item as $item):
                  switch ($item['link_to']) {
                    case 'external':
                      $url    = (!empty($item['external_url']['url']) ) ? $item['external_url']['url'] : '#';
                      $target = ($item['external_url']['is_external'] == 'on') ? '_blank' : '_self';
                      break;
                    case 'pages':
                      $url    = get_the_permalink($item['all_pages']);
                      $target = '_blank';
                      break;
                    case 'lightbox':
                    default:
                      $url            = $item['image']['url'];
                      $lightbox_class = 'df-lightbox-item';
                      $target         = '_self';
                      # code...
                      break;
                  }

                  $count      = ( $count < 3 ) ? $count:0;
                  $class_attr = explode('|', $class_array[$count]);

              ?>
                <div class="df-isotop-item <?php echo esc_attr($class_attr[0]); ?> <?php echo esc_attr($this->filter_class($item['assigned_category'])); ?>">
                  <div class="df-image-box df-style2 df-type1 df-relative df-radious-4 df-border <?php echo esc_attr($class_attr[1]); ?>">
                    <a href="<?php echo esc_url($url); ?>" class="df-image-link <?php echo esc_attr($lightbox_class); ?> df-zoom">
                      <div class="df-image df-relative">
                        <?php if($item['link_to'] == 'lightbox'): ?>
                          <img src="<?php echo esc_url($item['image']['url']); ?>" alt="thumb">
                        <?php endif; ?>
                        <div class="df-bg df-zoom-in1" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);"></div>
                      </div>
                    </a>
                    <div class="df-image-meta">
                      <h3 class="df-f16-lg df-font-name df-mb5 df-mt-3"><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($item['title']); ?></a></h3>
                      <div class="df-mb-6">
                        <span><?php echo esc_html($item['assigned_category']); ?></span>
                      </div>
                    </div>
                  </div>
                </div><!-- .df-isotop-item -->
              <?php $count++; endforeach; ?>

            </div><!-- .isotop -->

          </div>
        <?php endif; ?>
        
        <?php
        # code...
        break;

      case 'style3':?>
        <?php if(!empty($images_item) && is_array($images_item)): ?>
          <div class="df-portfolio-wrapper">

            <?php if(count($categories_items) > 0 && is_array($categories_items)): ?>
              <div class="df-isotop-filter df-style1 text-center">
                <ul class="df-mp0 df-flex df-f16-lg df-black111-c">
                  <li class="active"><a href="#" data-filter="*"><?php echo esc_html($all_label); ?></a></li>
                  <?php foreach ($categories_items as $item): ?>
                    <li><a href="#" data-filter=".<?php echo $this->filter_name($item['category_name']); ?>"><?php echo esc_html($item['category_name']); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <div class="df-isotop df-style1 df-port-col-3 df-has-gutter df-lightgallery">
              <div class="df-grid-sizer"></div>
              <?php 
                $class_array = array('df-height3', 'df-height4', 'df-height3', 'df-height4', 'df-height4', 'df-height3');
                $count = 0;
                foreach($images_item as $item):
                  switch ($item['link_to']) {
                    case 'external':
                      $url    = (!empty($item['external_url']['url']) ) ? $item['external_url']['url'] : '#';
                      $target = ($item['external_url']['is_external'] == 'on') ? '_blank' : '_self';
                      break;
                    case 'pages':
                      $url    = get_the_permalink($item['all_pages']);
                      $target = '_blank';
                      break;
                    case 'lightbox':
                    default:
                      $url            = $item['image']['url'];
                      $lightbox_class = 'df-lightbox-item';
                      $target         = '_self';
                      # code...
                      break;
                }
                
                $count = ($count < 6) ? $count:0;

              ?>
                <div class="df-isotop-item <?php echo esc_attr($this->filter_class($item['assigned_category'])); ?>">
                  <div class="df-image-box df-style2 df-relative df-radious-4 df-border <?php echo esc_attr($class_array[$count]); ?>">
                    <a href="<?php echo esc_url($url); ?>" class="df-image-link <?php echo esc_attr($lightbox_class); ?> df-zoom">
                      <div class="df-image df-relative">
                        <?php if($item['link_to'] == 'lightbox'): ?>
                          <img src="<?php echo esc_url($item['image']['url']); ?>" alt="thumb">
                        <?php endif; ?>
                        <div class="df-bg df-zoom-in1" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);"></div>
                      </div>
                    </a>
                  </div>
                </div><!-- .df-isotop-item -->

              <?php $count++; endforeach; ?>
          
            </div><!-- .isotop -->

          </div>
        <?php endif; ?>
        <?php
        # code...
        break;

      case 'style4': ?>
        <?php if(!empty($images_item) && is_array($images_item)): ?>
          <div class="df-portfolio-wrapper">
            <?php if(count($categories_items) > 0 && is_array($categories_items)): ?>
              <div class="df-isotop-filter df-style1 text-center">
                <ul class="df-mp0 df-flex df-f16-lg df-black111-c">
                  <li class="active"><a href="#" data-filter="*"><?php echo esc_html($all_label); ?></a></li>
                  <?php foreach ($categories_items as $item): ?>
                    <li><a href="#" data-filter=".<?php echo $this->filter_name($item['category_name']); ?>"><?php echo esc_html($item['category_name']); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            <div class="df-isotop df-style1 df-port-col-4 df-has-gutter df-lightgallery">
              <div class="df-grid-sizer"></div>

              <?php 
                $class_array = array('df-w50', 'df-w50', 'df-w25', 'df-w25');
                $count = 0;
                foreach($images_item as $item):
                  switch ($item['link_to']) {
                    case 'external':
                      $url    = (!empty($item['external_url']['url']) ) ? $item['external_url']['url'] : '#';
                      $target = ($item['external_url']['is_external'] == 'on') ? '_blank' : '_self';
                      break;
                    case 'pages':
                      $url    = get_the_permalink($item['all_pages']);
                      $target = '_blank';
                      break;
                    case 'lightbox':
                    default:
                      $url            = $item['image']['url'];
                      $lightbox_class = 'df-lightbox-item';
                      $target         = '_self';
                      # code...
                      break;
                }
                
                $count = ($count < 4) ? $count:0;

              ?>

              <div class="df-isotop-item <?php echo esc_attr($this->filter_class($item['assigned_category'])); ?> <?php echo esc_attr($class_array[$count]); ?>">
                <div class="df-image-box df-style2 df-relative df-radious-4 df-border <?php echo ($count == 0 || ($count / 4) == 0) ? 'df-height1':'df-height2'; ?>">
                  <a href="<?php echo esc_url($url); ?>" class="df-image-link <?php echo esc_attr($lightbox_class); ?> df-zoom">
                    <div class="df-image df-relative">
                      <?php if($item['link_to'] == 'lightbox'): ?>
                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="thumb">
                      <?php endif; ?>
                      <div class="df-bg df-zoom-in1" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);"></div>
                    </div>
                  </a>
                </div>
              </div><!-- .df-isotop-item -->
              <?php $count++; endforeach; ?>

              
            </div><!-- .isotop -->

          </div>
        <?php endif; ?>
        <?php
        # code...
        break;

      case 'style5': ?>
        <?php if(!empty($images_item) && is_array($images_item)): ?>
          <div class="df-portfolio-wrapper">
            <?php if(count($categories_items) > 0 && is_array($categories_items)): ?>
              <div class="df-isotop-filter df-style1 text-center">
                <ul class="df-mp0 df-flex df-f16-lg df-black111-c">
                  <li class="active"><a href="#" data-filter="*"><?php echo esc_html($all_label); ?></a></li>
                  <?php foreach ($categories_items as $item): ?>
                    <li><a href="#" data-filter=".<?php echo $this->filter_name($item['category_name']); ?>"><?php echo esc_html($item['category_name']); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            <div class="df-isotop df-style1 df-port-col-1 df-has-gutter df-lightgallery">
              <div class="df-grid-sizer"></div>

              <?php 
                foreach($images_item as $item):
                  switch ($item['link_to']) {
                    case 'external':
                      $url    = (!empty($item['external_url']['url']) ) ? $item['external_url']['url'] : '#';
                      $target = ($item['external_url']['is_external'] == 'on') ? '_blank' : '_self';
                      break;
                    case 'pages':
                      $url    = get_the_permalink($item['all_pages']);
                      $target = '_blank';
                      break;
                    case 'lightbox':
                    default:
                      $url            = $item['image']['url'];
                      $lightbox_class = 'df-lightbox-item';
                      $target         = '_self';
                      # code...
                      break;
                }
              ?>

                <div class="df-isotop-item <?php echo esc_attr($this->filter_class($item['assigned_category'])); ?> df-w100">
                  <div class="df-image-box df-style2 df-relative df-radious-4 df-border df-height2">
                    <a href="<?php echo esc_url($url); ?>" class="df-image-link <?php echo esc_attr($lightbox_class); ?> df-zoom">
                      <div class="df-image df-relative">
                        <?php if($item['link_to'] == 'lightbox'): ?>
                          <img src="<?php echo esc_url($item['image']['url']); ?>" alt="thumb">
                        <?php endif; ?>
                        <div class="df-bg df-zoom-in1" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);"></div>
                      </div>
                    </a>
                  </div>
                </div><!-- .df-isotop-item -->
              <?php endforeach; ?>
              
            </div><!-- .isotop -->

          </div>
        <?php endif; ?>
        <?php
        # code...
        break;
      
    }

  }
}
