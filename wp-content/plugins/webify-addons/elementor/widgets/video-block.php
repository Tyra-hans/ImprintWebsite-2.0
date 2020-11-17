<?php 
namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Video_Block_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-video-block-widget';
  }

  public function get_title() {
    return 'Video Block';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-video-block', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'video_block_section',
      array(
        'label' => esc_html__('Video' , 'webify-addons')
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
      'youtube_url',
      array(
        'label' => esc_html__('URL', 'webify-addons'),
        'type'  => Controls_Manager::TEXT,
        'dynamic' => array(
          'active' => true,
          'categories' => array(
            TagsModule::POST_META_CATEGORY,
            TagsModule::URL_CATEGORY,
          ),
        ),
        'placeholder' => esc_html__('Enter your URL', 'webify-addons'),
        'default'     => 'https://www.youtube.com/embed/7KIEvEODCI4?autoplay=1',
        'label_block' => true,
      )
    );

    $this->add_responsive_control(
      'height',
      array(
        'label'       => esc_html__('Height', 'webify-addons'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust block height (optional)', 'webify-addons'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 315,
            'max'  => 1000,
            'step' => 5,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .tb-video-block' => 'height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_control(
      'tilt_effect',
      array(
        'label'       => esc_html__('Tilt Effect', 'webify-addons'),
        'type'        => Controls_Manager::SWITCHER,
        'label_block' => true,
        'condition'   => array('style' => array('style1'))
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_icon_style',
      array(
        'label' => esc_html__('Icon', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-play-btn:before' => 'border-left-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-play-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-play-btn' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();

    $this->end_controls_section();

  }

  protected function render() { 

    $settings    = $this->get_settings();
    $bg_image    = $settings['bg_image'];
    $youtube_url = $settings['youtube_url'];
    $style       = $settings['style'];
    $tilt_effect = $settings['tilt_effect'];


    if(!empty($youtube_url) && is_array($bg_image)):

      switch ($style) {
        case 'style1':
        default: ?>
          <div class="tb-video-block-wrapper<?php echo ($tilt_effect == 'yes') ? ' tb-hover-layer':''; ?>">
            <div class="tb-video-block tb-style1 tb-bg tb-flex tb-radious-4" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);">
              <div class="tb-video-block-inner<?php echo ($tilt_effect == 'yes') ? ' tb-hover-layer1':''; ?>">
                <a href="<?php echo esc_url($youtube_url); ?>" class="tb-play-btn tb-style1 tb-video-open"></a>
              </div>
            </div>
          </div>
          <?php
          break;

        case 'style2': ?>
          <div class="tb-video-block tb-style3 tb-relative tb-radious-4">
            <div class="tb-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
            <a href="<?php echo esc_url($youtube_url); ?>" class="tb-play-btn tb-style2 tb-video-open tb-f64-lg tb-white-c"><i class="tbi-Play-Music"></i></a>
          </div>
          <?php
          # code...
          break;

        case 'style3': ?>
          <div class="tb-video-block tb-style3 tb-relative tb-type1 tb-flex">
            <div class="tb-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
            <a href="<?php echo esc_url($youtube_url); ?>" class="tb-play-btn tb-style1 tb-video-open"></a>
          </div>
          <?php
          break;

        case 'style4': ?>
          <div class="tb-video-block tb-style2 tb-type1 tb-flex">
            <div class="tb-box-shadow2"></div>
            <div class="tb-video-block-half-bg"></div>
            <div class="tb-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
            <a href="<?php echo esc_url($youtube_url); ?>" class="tb-play-btn tb-style1 tb-video-open"></a>
          </div>
          <?php
          # code...
          break;
      }
    endif;
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Video_Block_Widget() );