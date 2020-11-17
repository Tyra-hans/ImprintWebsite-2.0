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
class Webify_Google_Map_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-google-map-widget';
  }

  public function get_title() {
    return 'Google Map';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('gmapsensor', 'gmap');
  }

  public function get_style_depends() {
    return array('webify-map');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'google_map_section',
      array(
        'label' => esc_html__('Google Map' , 'webify-addons')
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
        )
      )
    );
    
    
    $this->add_control(
      'marker',
      array(
        'label'   => esc_html__('Marker', 'webify-addons'),
        'type'    => Controls_Manager::MEDIA,
      )
    );

    $this->add_control(
      'latitude',
      array(
        'label' => esc_html__('Latitude', 'webify-addons'),
        'type'  => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter latitude', 'webify-addons'),
        'default'     => '39.742043',
        'label_block' => true,
      )
    );

    $this->add_control(
      'longitude',
      array(
        'label' => esc_html__('Longitude', 'webify-addons'),
        'type'  => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter latitude', 'webify-addons'),
        'default'     => '-104.991531',
        'label_block' => true,
      )
    );

    $this->add_control(
      'zoom',
      array(
        'label'       => esc_html__('Zoom', 'webify-addons'),
        'type'        => Controls_Manager::SLIDER,
        'description' => esc_html__('Ajust map zoom', 'webify-addons'),
        'label_block' => true,
        'range' => array(
          'px' => array(
            'min'  => 1,
            'max'  => 20,
            'step' => 1,
          ),
        ),
        'default' => array(
          'size' => 12,
          'unit' => 'px',
        ),
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
            'min'  => 10,
            'max'  => 1000,
            'step' => 5,
          ),
        ),
        'default' => array(
          'unit' => 'px',
        ),
        'selectors' => array(
          '{{WRAPPER}} .tb-map-wrap.tb-style1 #map' => 'height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_map_style',
      array(
        'label' => esc_html__('Map', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Css_Filter::get_type(),
      array(
        'name'     => 'css_filters',
        'selector' => '{{WRAPPER}} .tb-map-wrap.tb-style1 #map',
      )
    );

    $this->end_controls_tab();

    $this->end_controls_section();


  }

  protected function render() { 

    $settings  = $this->get_settings();
    $latitude  = $settings['latitude'];
    $style     = $settings['style'];
    $marker    = $settings['marker'];
    $longitude = $settings['longitude'];
    $zoom      = $settings['zoom'];

    $options = array();

    $options[] = 'data-lat="'.esc_attr($latitude).'" ';
    $options[] = 'data-lng="'.esc_attr($longitude).'" ';
    $options[] = 'data-zoom="'.esc_attr($zoom['size']).'" ';
    $options[] = (is_array($marker) && !empty($marker['url'])) ? ' data-marker="'.esc_attr($marker['url']).'" ':'';

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-map-wrap tb-style1" <?php echo implode('', $options); ?>><div id="map"></div></div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="tb-map-wrap tb-style2 tb-border tb-radious-4 tb-white-bg" <?php echo implode('', $options); ?>><div id="map"></div></div>
        <?php
        break;
    }

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Google_Map_Widget() );