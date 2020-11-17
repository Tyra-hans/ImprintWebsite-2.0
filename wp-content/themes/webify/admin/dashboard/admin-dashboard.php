<?php
/**
* Admin Dashboard
*/
if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('Webify_Admin_Dashboard')) {
  class Webify_Admin_Dashboard {
    public $is_activated;
    function __construct() {
      $this->webify_init();
    }

    public function webify_init() {
      $this->is_activated = ThemeBubble_API::get_instance()->is_registered();
      add_action('admin_menu', array($this, 'webify_register_theme_panel'));
      add_action('admin_init', array($this, 'webify_theme_redirect'));
      add_action('admin_notices', array($this, 'webify_theme_activate_notice'));
    }

    public function webify_register_theme_panel() {
      call_user_func('add_'. 'menu' .'_page', esc_html__('Theme Panel', 'webify'), esc_html__('Webify', 'webify'), 'edit_posts', 'webify_theme_welcome', array($this, 'webify_view_welcome'), null, 2);
      if(!defined('ENVATO_HOSTED_SITE')):
        call_user_func( 'add_'. 'submenu' .'_page', 'webify_theme_welcome', esc_html__('Activate Theme', 'webify'), esc_html__('Activate Theme', 'webify'), 'edit_posts', 'webify_theme_activate', array($this, 'webify_theme_activate'));
      endif;
      call_user_func( 'add_'. 'submenu' .'_page', 'webify_theme_welcome', esc_html__('Help Center', 'webify'), esc_html__('Help Center', 'webify'), 'edit_posts', 'webify_theme_help_center', array($this, 'webify_theme_help_center'));
      global $submenu;
      $submenu['webify_theme_welcome'][0][0] = esc_html__('Welcome', 'webify');
    }

    public function webify_view_welcome() {
      require_once 'welcome.php';
    }
    
    public function webify_theme_help_center() {
      require_once 'help-center.php';
    }

    public function webify_theme_activate() {
      require_once 'activate.php';
    }

    public function webify_theme_activate_notice() {
      if($this->is_activated || defined('ENVATO_HOSTED_SITE')) { return; }
    ?>
      <div class="notice notice-error is-dismissible"> 
        <p></p>
        <p><strong> Please activate <em>Webify.</em> This activation enables all features of the theme (i.e. Demo import etc.). This step is taken for mass piracy of our theme, and to serve our paying customers better. </strong></p>
        <p><strong><a href="<?php echo admin_url('admin.php?page=webify_theme_activate'); ?>">Enter purchase code</a></strong></p>
        <p></p>
        <button type="button" class="notice-dismiss">
          <span class="screen-reader-text">Dismiss this notice.</span>
        </button>
      </div>
    <?php
    }

    public function webify_theme_redirect() {
      global $pagenow;
      if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
        wp_redirect(admin_url('admin.php?page=webify_theme_welcome')); 
      }
    }
  }
  new Webify_Admin_Dashboard();
}
