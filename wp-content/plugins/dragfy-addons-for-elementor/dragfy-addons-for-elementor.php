<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Dragfy Addons for Elementor
 *
 * Plugin Name: Dragfy Addons for Elementor
 * Plugin URI: http://dragfy.com/elementor-addons
 * Author: Dragfy
 * Author URI: http://dragfy.com/
 * Version: 1.0.2
 * Description: A collection of premium quality addons or widgets for use in Elementor page builder. Elementor must be installed and activated.
 * Text Domain: dragfy-addons-for-elementor
 * License: GNU General Public License v3.0
 *
 */
if(!class_exists('Dragfy_Elementor_Addons')) {
  class Dragfy_Addons_Elementor {

    public static $premium    = false;
    public static $dir        = null;
    public static $url        = null;
    public static $version    = null;
    public static $basename   = null;
    public static $inline_css = array();

    public function __construct() {
      $this->paths();
      $this->includes();
      $this->init();
      $this->load_textdomain();
    }

    /**
     * [paths description]
     * @return [type] [description]
     */
    public function paths() {
      self::$dir     = trailingslashit( plugin_dir_path( __FILE__ ) );
      self::$url     = trailingslashit( plugin_dir_url( __FILE__ ) );
      self::$version = get_file_data( __FILE__, array( 'Version' => 'Version' ) );
    }



    /**
     * [include_plugin_file description]
     * @param  [type]  $file [description]
     * @param  boolean $load [description]
     * @return [type]        [description]
     */
    public static function include_plugin_file($file, $load = true) {

      $path = '';

      if( file_exists( self::$dir . $file ) ) {
        $path = self::$dir . $file;
      }

      if(!empty($path) && ! empty($file) && $load) {
        global $wp_query;
        if(is_object($wp_query) && function_exists('load_template')) {
          load_template($path, true);
        } else {
          require_once($path);
        }
      } else {
        return self::$dir . $file;
      }

    }


    /**
     * [include_plugin_url description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public static function include_plugin_url($file) {
      return self::$url . $file;
    }

    /**
     * [textdomain description]
     * @return [type] [description]
     */
    public function load_textdomain() {
      load_plugin_textdomain('dragfy-addons-for-elementor', false, self::$dir .'/languages' );
    }



    /**
     * [activate description]
     * @return [type] [description]
     */
    public static function activate() {
      flush_rewrite_rules();
      set_transient('do_activation_redirect', true, 60);

    }


    /**
     * [deactivate description]
     * @return [type] [description]
     */
    public static function deactivate() {
      flush_rewrite_rules();
    }



    /**
     * [includes description]
     * @return [type] [description]
     */
    public function includes() {
      self::include_plugin_file('admin/admin.class.php');
      self::include_plugin_file('includes/helpers/helpers.class.php');
    }

    /**
     * [init_elementor description]
     * @return [type] [description]
     */
    public function init() {
      add_action('elementor/init',                              array($this, 'init_elementor'));
      add_action('elementor/widgets/widgets_registered',        array($this, 'includes_elementor_widgets'));
      add_action('elementor/frontend/after_register_scripts',   array($this, 'register_frontend_scripts' ));
      add_action('elementor/frontend/after_register_styles',    array($this, 'register_frontend_styles' ));
      add_action('elementor/preview/enqueue_styles',            array($this, 'enqueue_elementor_preview_styles'));
      add_action('elementor/editor/before_enqueue_styles',      array($this, 'enqueue_editor_styles'));
      update_option('elementor_disable_typography_schemes',     'yes');
      update_option('elementor_disable_color_schemes',          'yes');
    }



    /**
     * [init_elementor description]
     * @return [type] [description]
     */
    public function init_elementor() {
      $this->register_elementor_title();
    }



    /**
     * [register_elementor_title description]
     * @return [type] [description]
     */
    public function register_elementor_title() {
      Elementor\Plugin::instance()->elements_manager->add_category(
        'dragfy-addons-for-elementor',
        array(
          'title' => esc_html__('Dragfy Addons Elementor', 'dragfy-addons-elementor')
        )
      );
    }



    /**
     * [register_frontend_scripts description]
     * @return [type] [description]
     */
    public function register_frontend_scripts() {
      $js_handlers = array(
        'dragfy-addons' => 'jquery.dragfy.addons',
        'isotope'       => 'jquery.isotope.pkg.min',
        'text-slider'   => 'jquery.text.slider.min',
        'svg-wave'      => 'jquery.svg.wave.min',
        'chart-min'     => 'jquery.chart.min',
        'light-gallery' => 'jquery.lightgallery.min',
        'before-after'  => 'jquery.beforeAfter',
        'ytv'           => 'jquery.ytv.min',
        'slick'         => 'jquery.slick.min',
        'counter'       => 'jquery.counter.min',
      );
      foreach($js_handlers as $handler => $file_name) {
        wp_register_script($handler, self::include_plugin_url('assets/frontend/js/'.$file_name.'.js'), array('jquery'), self::$version, true);
      }
    }



    /**
     * [register_frontend_styles description]
     * @return [type] [description]
     */
    public function register_frontend_styles() {
      foreach (glob(self::include_plugin_file('assets/frontend/css/*.css', false )) as $file) {
        $slug = basename($file, '.css');
        wp_register_style($slug, self::include_plugin_url('assets/frontend/css/'.$slug.'.css'), null, self::$version, false);
      }
      $modules = \Admin::$modules_keys;
      foreach($modules as $module) {
        wp_enqueue_style($module);
      }
    }



    /**
     * [enqueue_elementor_preview_styles description]
     * @return [type] [description]
     */
    public function enqueue_elementor_preview_styles() {

      foreach (glob(self::include_plugin_file('assets/frontend/css/*.css', false )) as $file) {
        $slug = basename($file, '.css');
        wp_enqueue_style($slug);
      }

    }



    /**
     * [includes_elementor_widgets description]
     * @return [type] [description]
     */
    public function includes_elementor_widgets() {

      $modules = Admin::get_enabled_keys();

      foreach (glob(self::include_plugin_file('elementor/widgets/'.'*.php')) as $file) {

        $key = str_replace('dragfy-addons-', '', basename($file, '.php'));

        if($modules[$key]) {
          $this->register_elementor_widgets($file);
        }
      }
    }



    /**
     * [register_elementor_widgets description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function register_elementor_widgets($file) {
      $widget_manager = \Elementor\Plugin::instance()->widgets_manager;

      $base  = basename(str_replace('.php', '', $file));
      $class = ucwords(str_replace('-', ' ', $base));
      $class = str_replace(' ', '_', $class);
      $class = sprintf('DragfyAddons\Elementor\Widgets\%s', $class);

      require $file;

      if(class_exists($class)) {
        $widget_manager->register_widget_type(new $class);
      }

    }



    /**
     * [enqueue_editor_styles description]
     * @return [type] [description]
     */
    public function enqueue_editor_styles() {
      wp_enqueue_style('dragfy-addons-icon',  self::include_plugin_url('assets/editor/css/style.css'),  null, self::$version);
    }


  }

  new Dragfy_Addons_Elementor();
  register_activation_hook(__FILE__,    array('Dragfy_Addons_Elementor', 'activate'));
  register_deactivation_hook(__FILE__,  array('Dragfy_Addons_Elementor', 'deactivate'));
}
