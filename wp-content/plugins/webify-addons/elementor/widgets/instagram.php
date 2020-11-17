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
class Webify_Instagram_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-instagram-widget';
  }

  public function get_title() {
    return 'Instagram';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-instagram');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'instagram_section',
      array(
        'label' => esc_html__('Instagram' , 'webify-addons')
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
      'username',
      array(
        'label'       => esc_html__('@username or #tag', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 8
      )
    );

    $this->add_control(
      'cols',
      array(
        'label'       => esc_html__('Column', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 8
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 

    $settings = $this->get_settings();
    $style    = $settings['style'];
    $username = $settings['username'];
    $limit    = $settings['limit'];
    $cols     = $settings['cols'];


    if(!empty($username)):
      // check if username is hastag or with @
      $type           = (substr($username, 0, 1) == '@') ? 'user':'hashtag';
      $showheader     = ($style == 'style1') ? 'true':'false';
      $attribute_type = ($type == 'hashtag') ? 'hashtag="'.$username.'"':'user="'.str_replace('@', '', $username).'"';

      echo '<div class="tb-instagram '.$style.'">';
      echo do_shortcode('[instagram-feed showheader='.$showheader.' showfollow=false showbio=false showbutton=false showcaption=false showlikes=false imagepadding=0 num='.$limit.' cols='.$cols.' imageres="full" type="'.$type.'" '.$attribute_type.']');
      echo '</div>';
    endif;


  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Instagram_Widget() );