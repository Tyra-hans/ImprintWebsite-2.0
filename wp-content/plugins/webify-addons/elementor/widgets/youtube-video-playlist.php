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
class Webify_Youtube_Video_Playlist_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-youtube-video-playlist-widget';
  }

  public function get_title() {
    return 'Youtube Video Playlist';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('ytv');
  }

  public function get_style_depends() {
    return array('ytv');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'youtube_video_playlist_section',
      array(
        'label' => esc_html__('Youtube Video Playlist' , 'webify-addons')
      )
    );

    $this->add_control(
      'channel_id',
      array(
        'label'       => esc_html__('Channel ID', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 'UCJFp8uSYCjXOMnkUyb3CQ3Q',       
      )
    );


    $this->end_controls_section();

  }

  protected function render() { 

    $settings   = $this->get_settings();
    $channel_id = $settings['channel_id'];

    if(!empty($channel_id)): ?>
      <div id="frame" class="yt-playlist" data-channel-id="<?php echo esc_attr($channel_id); ?>"></div>
    <?php endif;
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Youtube_Video_Playlist_Widget() );