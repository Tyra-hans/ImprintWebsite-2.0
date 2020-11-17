<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.


if(!class_exists('Admin')) {

  class Admin {

    private static $instance = null;

    private static $api_url = 'https://wordpress-197386-1383774.cloudwaysapps.com/server/v1';

    public static $element_keys = array(
      'accordion',
      'business-hours',
      'call-to-action',
      'contact-form-7',
      'counter',
      'fancy-heading',
      'filterable-gallery',
      'flip-box',
      'heading',
      'icon-box',
      'image-scroll',
      'image-slider',
      'info-card',
      'interactive-banner',
      'logo-carousel',
      'newsletter',
      'ninja-forms',
      'post',
      'pricing-table',
      'progress-bar',
      'road-map',
      'round-chart',
      'table',
      'tabs',
      'testimonial',
      'timeline',
      'wp-forms',
    );

    public static $element_pro_keys = array(
      'content-toggle',
      'count-down',
      'filterable-video-gallery',
      'hotspot',
      'icon-box-slider',
      'image-box-slider',
      'image-box',
      'image-comparison',
      'image-gallery',
      'interactive-card',
      'interactive-slider',
      'line-chart',
      'post-slider',
      'parallax',
      'particles',
      'team-member',
      'team-member-slider',
      'testimonial-slider',
      'video-box',
      'youtube-video-playlist'
    );

    public static $modules_keys = array(
      'particles',
      'parallax'
    );


    public static $page_slug = 'dragfy-addons-for-elementor';

    public static $url = '//dragfy.com/elementor-addons/';

    private $default_settings;

    private $settings;

    public static $get_settings;

    function __construct() {
      self::$element_keys = (\Dragfy_Addons_Elementor::$premium) ? array_merge(self::$element_keys, self::$element_pro_keys):self::$element_keys;
      add_filter('plugin_action_links_' . \Dragfy_Addons_Elementor::$basename, array(&$this, 'insert_plugin_links'));
      add_action('admin_notices', array(&$this, 'is_elementor_loaded'));
      add_action('admin_notices', array(&$this, 'activate_dashboard'));
      add_action('admin_init', array(&$this, 'redirect_on_activation'));
      add_action('admin_init', array(&$this, 'register_email'));
      add_action('admin_menu', array(&$this, 'admin_menu'), 0);
      add_action('wp_ajax_save_admin_addons_settings', array(&$this, 'save_settings'));
      add_action('admin_enqueue_scripts', array(&$this, 'admin_page_scripts'));

    }



    /**
     * [is_elementor_loaded description]
     * @return boolean [description]
     */
    public function is_elementor_loaded() {

      $elementor = 'elementor/elementor.php';

      if(!defined('ELEMENTOR_VERSION')) {
        if(!$this->is_plugin_installed($elementor)) {
          if(current_user_can('install_plugins')) {
            $install_url = wp_nonce_url(self_admin_url(sprintf( 'update.php?action=install-plugin&plugin=%s', 'elementor')), 'install-plugin_elementor');
            $message = '<p>Please Install <strong>Elementor</strong> plugin to use <strong>Dragfy Addons for Elementor</strong> plugin.</p>';
            $message .= sprintf('<p><a href="%s" class="button-primary">%s</a></p>', $install_url, esc_html__('Install Now', 'dragfy-addons-for-elementor'));
          }
        } else {
          if(current_user_can('activate_plugin')) {
            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin='.$elementor.'&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_'. $elementor);
            $message = '<p>Please Activate <strong>Elementor</strong> plugin to use <strong>Dragfy Addons for Elementor</strong> plugin.</p>';
            $message .= '<p>'.sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Now', 'dragfy-addons-for-elementor')).'</p>';
          }
        }

        printf('<div class="error">%s</div>', $message);

      }

    }

        /**
     * [register_email description]
     * @return [type]        [description]
     */
    public static function register_email() {
      try {

          $is_processed = get_option('is_processed');

          if(isset($_GET['_wpnonce']) && !$is_processed) {

            $nonce = sanitize_text_field($_GET['_wpnonce']);

            if(!wp_verify_nonce($nonce, '_df_register_nonce')) {
              throw new Exception('Security check.');
            }

            if(isset($_GET['df_tracker_optin'])) {

              $email    = get_bloginfo('admin_email');

              $response = self::call('/register', array('email' => $email));

              if(!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {

                $body = json_decode(wp_remote_retrieve_body($response), true);

                if(!empty($body['success'])) {

                  $result = true;

                  update_option('is_processed', true);
                  if(isset($_GET['redirect'])) {
                    wp_redirect('admin.php?page=dragfy-addons-for-elementor');
                  }

                } else if(!empty($body['data']['message'])) {

                  throw new Exception($body['data']['message']);

                }

              }
            }


          }

      } catch (Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
      }

    }

    public static function call($suffix, $data = array()) {
      $data = wp_parse_args($data, array(
        'domain'  => wp_parse_url(site_url(), PHP_URL_HOST)
      ));
      $args = array(
        'sslverify'  => false,
        'timeout'    => 120,
        'body'       => $data,
        'user-agent' => 'WordPress/'. get_bloginfo('version') .'; '. network_site_url(),
      );

      return wp_remote_post(self::$api_url . $suffix, $args);

    }

    /**
     * [activate_dashboard description]
     * @return boolean [description]
     */
    public function activate_dashboard() {
      if(!get_option('is_processed')):
    ?>
      <div id="df-connect-message" class="updated df-banner-container">
        <div class="df-banner-container-top-text">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"></rect><g><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 15h-2v-2h2v2zm0-4h-2l-.5-6h3l-.5 6z"></path></g></svg>
          <span>You’re almost done. Activate Dragfy Addons for Elementor to enable powerful tools to help you build better sites faster in WordPress.</span>
        </div>
        <div class="df-banner-inner-container">
          <a href="<?php echo wp_nonce_url('/wp-admin/index.php?df_tracker_optin=true', '_df_register_nonce'); ?>" class="notice-dismiss df-connection-banner-dismiss df-connection-banner-action" title="Dismiss this notice">
          </a>
          <div class="df-banner-content-container">
            <div class="df-banner-slide df-banner-slide-one df-slide-is-active">
              <div class="df-banner-content-icon df-illo">
                <img src="<?php echo Dragfy_Addons_Elementor::include_plugin_url('admin/assets/img/01.png'); ?>" alt="banner-image">
              </div>

              <div class="df-banner-slide-text">
                <h2>Boost Any Site with All-in-One Elementor Addon.</h2>
                <p>A Library of unique Elementor Widgets to add more functionality and flexibility to your website. Dragfy Addons is made with care of each pixel. Making your website beautiful has never been easier.</p>
                <div class="df-banner-button-container">
                  <span class="df-banner-tos-blurb">By clicking the <strong>Activate</strong> button, you agree to our <a href="<?php echo esc_url(self::$url); ?>privacy-policy/" target="_blank">Terms of Service</a> and to <a href="<?php echo esc_url(self::$url); ?>privacy-policy/" target="_blank">Share Details</a> with Dragfy.com.</span>
                  <a href="<?php echo wp_nonce_url('/wp-admin/index.php?df_tracker_optin=true&redirect=true', '_df_register_nonce'); ?>" class="dops-button is-primary df-alt-connect-button df-connection-banner-action">
                    Activate Dragfy Addons for Elementor</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif;
    }


    /**
     * [is_plugin_installed description]
     * @param  [type]  $basename [description]
     * @return boolean           [description]
     */
    public function is_plugin_installed($basename) {
      if (!function_exists('get_plugins')) {
        include_once ABSPATH . '/wp-admin/includes/plugin.php';
      }
      $installed_plugins = get_plugins();
      return isset($installed_plugins[$basename]);
    }



    /**
     * [redirect_on_activation description]
     * @return [type] [description]
     */
    public function redirect_on_activation() {
      if(get_transient('do_activation_redirect')) {
        delete_transient('do_activation_redirect');
        if(!isset($_GET['activate-multi'])) {
          wp_redirect('admin.php?page=dragfy-addons-for-elementor');
        }
      }
    }



    /**
     * [admin_menu description]
     * @return [type] [description]
     */
    public function admin_menu() {
      add_menu_page('Dragfy Addons for Elementor', 'Dragfy Addons for Elementor', 'manage_options', self::$page_slug, array($this, 'admin_page'), \Dragfy_Addons_Elementor::include_plugin_url('admin/assets/img/dashicon.svg'));
    }



    /**
     * [insert_plugin_links description]
     * @param  [type] $links [description]
     * @return [type]        [description]
     */
    public function insert_plugin_links($links) {
      if(!is_admin()) { return; }
      $links[] = sprintf('<a href="admin.php?page=eael-settings">'.esc_html__('Settings', 'dragfy-addons-for-elementor').'</a>');
      if(!\Dragfy_Addons_Elementor::$premium) {
        $links[] = sprintf('<a href="//dragfy.com/elementor-addons" target="_blank" style="color: #39b54a; font-weight: bold;">'. esc_html__('Go Pro', 'dragfy-addons-for-elementor').'</a>');
      }

      return $links;
    }



    /**
     * [admin_page_scripts description]
     * @return [type] [description]
     */
    public function admin_page_scripts() {
      $current_screen = get_current_screen();

      if(strpos($current_screen->id, self::$page_slug) !== false) {
        wp_enqueue_script('core-js',          \Dragfy_Addons_Elementor::include_plugin_url('admin/assets/vendor/sweetalert2/core.js'), array('jquery'), \Dragfy_Addons_Elementor::$version, true);
        wp_enqueue_script('sweetalert-js',    \Dragfy_Addons_Elementor::include_plugin_url('admin/assets/vendor/sweetalert2/sweetalert2.min.js'), array('jquery'), \Dragfy_Addons_Elementor::$version, true);
        wp_enqueue_script('df-admin-js',      \Dragfy_Addons_Elementor::include_plugin_url('admin/assets/js/admin.js'), array('jquery'), \Dragfy_Addons_Elementor::$version, true);
        wp_enqueue_style('sweetalert-css',    \Dragfy_Addons_Elementor::include_plugin_url('admin/assets/vendor/sweetalert2/sweetalert2.min.css'));
      }
      wp_enqueue_style('df-admin-css',      \Dragfy_Addons_Elementor::include_plugin_url('admin/assets/css/admin.css'));
    }



    /**
     * [save_settings description]
     * @return [type] [description]
     */
    public function save_settings() {

      if(isset($_POST['fields'])) {
        parse_str($_POST['fields'], $settings);
      } else {
        return;
      }

      foreach(self::$element_keys as $key) {
        $this->settings[$key] = intval($settings[$key] ? 1 : 0);
      }

      update_option('save_settings', $this->settings);
      return true;
      die();
    }



    /**
     * [process_keys_to_name description]
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public static function process_keys_to_name($key) {
      $name = str_replace('-', ' ', $key);
      $name = ucwords($name);
      return $name;
    }



    /**
     * [get_default_keys description]
     * @return [type] [description]
     */
    public static function get_default_keys() {
      $default_keys = array_fill_keys(self::$element_keys, true);
      return $default_keys;
    }



    /**
     * [get_enabled_keys description]
     * @return [type] [description]
     */
    public static function get_enabled_keys() {
      $enabled_keys = get_option('save_settings', self::get_default_keys());
      return $enabled_keys;
    }



    /**
     * [admin_page description]
     * @return [type] [description]
     */
    public function admin_page() {
      $js_info = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
      );

      wp_localize_script('df-admin-js', 'settings', $js_info);

      $this->default_settings = $this->get_default_keys();
      self::$get_settings     = $this->get_enabled_keys();

      $new_settings = array_diff_key($this->default_settings, self::$get_settings);

      if(!empty($new_settings)) {
        $updated_settings = array_merge(self::$get_settings, $new_settings);
        update_option('save_settings', $updated_settings);
      }

      self::$get_settings = get_option('save_settings', $this->default_settings);

      $section = (!empty( $_GET['section'])) ? sanitize_text_field($_GET['section']) : '';
      \Dragfy_Addons_Elementor::include_plugin_file('admin/views/header.php');

      switch ($section) {
        case 'general':
        default:
          \Dragfy_Addons_Elementor::include_plugin_file('admin/views/general.php');
          break;

        case 'elements':
          \Dragfy_Addons_Elementor::include_plugin_file('admin/views/elements.php');
          # code...
          break;

        case 'go-premium':
          # code...
          break;

      }
    }



    /**
     * [instance description]
     * @return [type] [description]
     */
    public static function instance() {
      if(is_null( self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

  }

  Admin::instance();

}
