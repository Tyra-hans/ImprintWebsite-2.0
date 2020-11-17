<?php
 
namespace DragfyAddons\Elementor\Widgets;
use DragfyAddons\Helpers\Helpers;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Image_Scroll extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-image-scroll';
  }

  public function get_title() {
    return 'Image Scroll';
  }

  public function get_icon() {
    return 'elem_icon image_scroll';
  }

  public function get_script_depends() {
    return array('light-gallery', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('horizontal-scroll', 'light-gallery', 'scroll-section', 'button', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }

  protected function _register_controls() {

    $this->start_controls_section(
      'image_scroll_general_settings',
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
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'image_scroll_image_settings',
      array(
        'label'     => esc_html__('Image Settings' , 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__('Upload Images', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::GALLERY,
        'label_block' => true,
      )
    );

    $this->add_control(
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

    $this->add_control(
      'all_pages',
      array(
        'label'       => esc_html__('Select Page', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'condition'   => array('link_to' => 'pages'),
        'options'     => Helpers::get_all_pages(),
      )
    );

    $this->add_control(
      'external_url',
      array(
        'label'       => esc_html__('External URL', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'condition'   => array('link_to' => 'external'),
        'label_block' => true,
        'default'     => array('url' => '#')
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'gutter_space',
      array(
        'label'       => esc_html__('Gutter Space (px)', 'dragfy-addons-for-elementor'),
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
          '{{WRAPPER}} .df-horizontal-scroll-bar .df-horizontal-scroll-item:not(:nth-last-child(2)), {{WRAPPER}} .df-horizontal-scroll-bar .df-horizontal-scroll-item:not(:nth-last-child(2))' => 'margin-right: {{SIZE}}px;',
        ),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_image_scroll_image_style',
      array(
        'label'     => esc_html__('Image Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('overlay_bg_color', 
      array( 
        'label'       => esc_html__('Overlay Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-horizontal-scroll-item .df-bg:before' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Css_Filter::get_type(),
      array(
        'name'     => 'image_scroll_css_filter',
        'selector' => '{{WRAPPER}} .df-horizontal-scroll-item a',
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'image_scroll_border',
        'selector' => '{{WRAPPER}} .df-horizontal-scroll-item a',
      )
    );

    $this->add_responsive_control(
      'image_scroll_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-horizontal-scroll-item a, {{WRAPPER}} .df-horizontal-scroll-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings     = $this->get_settings(); 
    $images       = $settings['images'];
    $link_to      = $settings['link_to'];
    $external_url = $settings['external_url'];
    $all_pages    = $settings['all_pages'];
    $style        = $settings['style'];

    if(!empty($images) && is_array($images)): ?>

      <div class="df-horizontal-scroll-wrap">
        <div class="df-horizontal-scroll">
          <div class="df-horizontal-scroll-in">
            <div class="df-horizontal-scroll-bar df-<?php echo esc_attr($style); ?> df-lightgallery">

              <?php 
                foreach($images as $image): 
                  $lightbox_class = $url = ''; 
                  switch ($link_to) {
                    case 'external':
                      $url    = (!empty($external_url['url']) ) ? $external_url['url'] : '#';
                      $target = ($external_url['is_external'] == 'on') ? '_blank' : '_self';
                      break;
                    case 'pages':
                      $url    = get_the_permalink($all_pages);
                      $target = '_blank';
                      break;
                    case 'lightbox':
                    default:
                      $url            = $image['url'];
                      $lightbox_class = 'df-lightbox-item';
                      $target         = '_self';
                      # code...
                      break;
                  }
              ?>
                <div class="df-horizontal-scroll-item df-zoom">
                  <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="df-bg df-zoom-in1 <?php echo esc_attr($lightbox_class); ?>" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                    <?php if($link_to == 'lightbox'): ?>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                    <?php endif; ?>
                  </a>
                </div>
              <?php endforeach; ?>
              <div class="df-horizontal-scroll-right-padd"></div>
            </div>
          </div>
        </div>
      </div>
    <?php endif;

  }
}
