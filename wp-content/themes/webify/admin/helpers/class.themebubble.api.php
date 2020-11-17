<?php if(!defined('ABSPATH')) { die; } // Cannot access directly.
/**
 *
 * ThemeBubble API BETA
 *
 */
if(!class_exists('ThemeBubble_API')) {
  class ThemeBubble_API {

    // API Server URL
    public $api_url = 'https://wordpress-197386-1380309.cloudwaysapps.com/server/v1';

    // API transient keys
    public $api_status_key = 'tb_api_status';

    // API option keys
    public $registered_key    = 'tb_registered';
    public $purchase_code_key = 'tb_purchase_code';
    public $email_key         = 'tb_email';

    // Instance of class.
    public static $instance;

    /**
     * Returns the singleton instance of the class.
     */
    public static function get_instance() {
      if(!isset(self::$instance) && ! (self::$instance instanceof self)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * construct.
     */
    public function __construct() {

      $this->refresh();

      add_action('switch_theme', array(&$this, 'flush'));

    }

    public function is_online() {

      $this->status = get_transient($this->api_status_key);

      if(!$this->status) {

        $this->status = 'offline';

        $response = $this->call('/status');

        if(!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {

          $body = json_decode(wp_remote_retrieve_body($response), true);

          if(!empty($body['success'])) {

            $this->status = 'online';

          }

        }

        set_transient($this->api_status_key, $this->status, 60*60*24);

      }

      return ($this->status === 'online') ? true : false;

    }

    public function get_error_notice() {

      echo '<p class="ut-admin-alertbox ut-admin-alertbox-error">';
      echo '<i class="fas fa-circle"></i>';
      echo esc_html__('Unable to connect to ThemeBubble API Server. Please try again later.', 'webify');
      echo '</p>';

      return false;

    }

    public function registration() {

      try {

        $result = get_option($this->registered_key);

        if(isset($_POST['tb_register_nonce'])) {

          $nonce = sanitize_text_field($_POST['tb_register_nonce']);

          if(!wp_verify_nonce($nonce, 'tb_register_nonce')) {
            throw new Exception('Security check.');
          }

          if(isset($_POST['tb_register_code']) && isset($_POST['tb_register_email'])) {

            $code  = sanitize_text_field($_POST['tb_register_code']);
            $email = sanitize_text_field($_POST['tb_register_email']);
            
            if(empty($code)) {
              throw new Exception('Please enter a valid purchase code.');
            }

            if(empty($email)) {
              throw new Exception('E-mail must not be empty.');
            }

            $response = $this->call('/register', array('code' => $code, 'email' => $email));

            if(!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {

              $body = json_decode(wp_remote_retrieve_body($response), true);

              if(!empty($body['success'])) {

                $result = true;

                update_option($this->purchase_code_key, $code);

                update_option($this->registered_key, $result);

                update_option($this->email_key, $email);

              } else if(!empty($body['data']['message'])) {

                throw new Exception($body['data']['message']);

              }

            }

          }

          if(isset($_POST['tb_unregister'])) {

            $this->call('/unregister');

            $result = false;

            delete_option($this->purchase_code_key);

            delete_option($this->registered_key);

            delete_option($this->email_key);

          }

        }

        return array('success' => $result);

      } catch (Exception $e) {

        return array('success' => false, 'message' => $e->getMessage());

      }

    }

    public function is_registered() {

      $registered = get_option($this->registered_key);

      return ($registered) ? true : false;

    }

    public function get_purchase_code() {

      $code = get_option($this->purchase_code_key);

      return ($code) ? $code : '';

    }

    public function get_domain() {
      return wp_parse_url(site_url(), PHP_URL_HOST);
    }

    public function get_email() {
      $email = get_option($this->email_key);
      return ($email) ? $email : '';
    }

    /**
     * API Call function this is a wrapper wp_remote_get
     */
    public function call($suffix, $data = array()) {
      $data = wp_parse_args($data, array(
        'code'   => $this->get_purchase_code(),
        'domain' => $this->get_domain(),
        'email'  => $this->get_email()
     ));

      $args = apply_filters('tb_api_call_args', array(
        'sslverify'  => false,
        'timeout'    => 120,
        'body'       => $data,
        'user-agent' => 'WordPress/'. get_bloginfo('version') .'; '. network_site_url(),
     ));

      return wp_remote_post($this->api_url . $suffix, $args);

    }

    /**
     * Refresh API button
     */
    public function refresh() {

      if(!empty($_GET['tb-api'])) {
        $this->flush();
        wp_redirect(wp_get_referer());
        exit;
      }

    }

    /**
     * Flush API transients
     */
    public function flush() {
      delete_transient($this->api_status_key);
      wp_clean_update_cache();

    }

  }
}
