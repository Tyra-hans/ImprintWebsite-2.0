<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Webify Addons
 *
 * Plugin Name: Webify Addons
 * Plugin URI: http://themebubble.com/
 * Author: themebubble
 * Author URI: http://themebubble.com/
 * Version: 4.3
 * Description: Includes Custom Post Types, Shortcodes for Webify
 * Text Domain: webify-addons
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Copyright 2019 Satish Pokhrel <relstudiosnx@gmail.com>
 * 
 * ------------------------------------------------------------------------------------------------
 *
 */
defined('WEBIFY_PLUGIN_DIR') or define('WEBIFY_PLUGIN_DIR',  plugin_dir_path(__FILE__));

if(!class_exists('Webify_Addons')) {
  class Webify_Addons {

    public static $inline_css = array();

    public function __construct() {
      if ($this->get_installed_theme() !== 'published') {
        add_action('admin_notices', array($this,'theme_notices'));
      } else { 
        $this->contstants();
        $this->includes();
        $this->init_elementor();
        $this->init_importer();
        $this->textdomain();
      }
    }

    public function contstants() {
      define('WEBIFY_ADDONS_VER', '1.0.0');
      if(!defined('ALLOW_UNFILTERED_UPLOADS')) {
        define('ALLOW_UNFILTERED_UPLOADS', true);
      }
      $this->assets_css = plugins_url('/assets/css', __FILE__);
      $this->demos_img  = plugins_url('/includes/demos', __FILE__);
    }

    public static function activate() {
      flush_rewrite_rules();
    }

    public function get_installed_theme() {
      $theme = wp_get_theme();
      if( $theme->parent() ) {
        $theme_status = $theme->parent()->get('Status');
      } else {
        $theme_status = $theme->get('Status');
      }
      $theme_status = sanitize_key( $theme_status );
      return $theme_status;
    }

    public static function deactivate() {
      flush_rewrite_rules();
    }

    public function init_elementor() {
      add_action('elementor/init',                              array($this, 'init_elementor_widgets_title'));
      add_action('elementor/widgets/widgets_registered',        array($this, 'includes_elementor_widgets'));
      add_action('elementor/preview/enqueue_styles',            array($this, 'enqueue_elementor_preview_styles'));
      add_action('elementor/editor/after_enqueue_styles',       array($this, 'enqueue_editor_styles'));
      add_action('wp_enqueue_scripts',                          array($this, 'enqueue_custom_font_css'));
      add_action('admin_enqueue_scripts',                       array($this, 'enqueue_custom_font_css'));
      add_filter('csf_field_typography_customwebfonts',         array($this, 'append_custom_fonts'));
      add_filter('mc4wp_form_css_classes',                      array($this, 'mc4wp_add_css_class_to_form'));
      update_option('elementor_disable_typography_schemes',     'yes');
      update_option('elementor_disable_color_schemes',          'yes');
    }

    public function init_elementor_widgets_title() {
      $this->register_elementor_title();
    }

    public function register_elementor_title() {
      Elementor\Plugin::instance()->elements_manager->add_category(
        'webify-elementor',
        array(
          'title' => esc_html__('Webify Addons', 'webify-addons')
        ),
      1);
    }

    public function includes_elementor_widgets() {
      $this->locate_template('elementor/widgets/intro-text.php');
      $this->locate_template('elementor/widgets/video-block.php');
      $this->locate_template('elementor/widgets/section-heading.php');
      $this->locate_template('elementor/widgets/icon-box.php');
      $this->locate_template('elementor/widgets/text-box.php');
      $this->locate_template('elementor/widgets/portfolio.php');
      $this->locate_template('elementor/widgets/client.php');
      $this->locate_template('elementor/widgets/hero-slider.php');
      $this->locate_template('elementor/widgets/hero-banner.php');
      $this->locate_template('elementor/widgets/accordion.php');
      $this->locate_template('elementor/widgets/road-map.php');
      $this->locate_template('elementor/widgets/icon-box-slider.php');
      $this->locate_template('elementor/widgets/portfolio-slider.php');
      $this->locate_template('elementor/widgets/recent-news.php');
      $this->locate_template('elementor/widgets/testimonial.php');
      $this->locate_template('elementor/widgets/image-box.php');
      $this->locate_template('elementor/widgets/text-block-with-button.php');
      $this->locate_template('elementor/widgets/counter.php');
      $this->locate_template('elementor/widgets/team.php');
      $this->locate_template('elementor/widgets/countdown.php');
      $this->locate_template('elementor/widgets/line-chart.php');
      $this->locate_template('elementor/widgets/cta.php');
      $this->locate_template('elementor/widgets/progress-bar.php');
      $this->locate_template('elementor/widgets/round-chart.php');
      $this->locate_template('elementor/widgets/review.php');
      $this->locate_template('elementor/widgets/pricing-table.php');
      $this->locate_template('elementor/widgets/testimonial-slider.php');
      $this->locate_template('elementor/widgets/newsletter.php');
      $this->locate_template('elementor/widgets/team-slider.php');
      $this->locate_template('elementor/widgets/image-box-slider.php');
      $this->locate_template('elementor/widgets/contact-details.php');
      $this->locate_template('elementor/widgets/feature-lists.php');
      $this->locate_template('elementor/widgets/responsive-table.php');
      $this->locate_template('elementor/widgets/google-map.php');
      $this->locate_template('elementor/widgets/text-block-with-image.php');
      $this->locate_template('elementor/widgets/text-block-with-gallery.php');
      $this->locate_template('elementor/widgets/text-block-with-signature.php');
      $this->locate_template('elementor/widgets/contact-form-7.php');
      $this->locate_template('elementor/widgets/image-gallery.php');
      $this->locate_template('elementor/widgets/info-card.php');
      $this->locate_template('elementor/widgets/image-gallery-slider.php');
      $this->locate_template('elementor/widgets/blockquote.php');
      $this->locate_template('elementor/widgets/award.php');
      $this->locate_template('elementor/widgets/about-us.php');
      $this->locate_template('elementor/widgets/instagram.php');
      $this->locate_template('elementor/widgets/menu.php');
      $this->locate_template('elementor/widgets/image-horizontal-scroll.php');
      $this->locate_template('elementor/widgets/tabs.php');
      $this->locate_template('elementor/widgets/image-slide.php');
      $this->locate_template('elementor/widgets/blog.php');
      $this->locate_template('elementor/widgets/portfolio-section-scroll.php');
      $this->locate_template('elementor/widgets/shop-card.php');
      $this->locate_template('elementor/widgets/blog-slider.php');
      $this->locate_template('elementor/widgets/category-block.php');
      $this->locate_template('elementor/widgets/youtube-video-playlist.php');
      $this->locate_template('elementor/widgets/fancy-box.php');
      $this->locate_template('elementor/widgets/fancy-box-slider.php');
      $this->locate_template('elementor/widgets/image-box-lists.php');
      $this->locate_template('elementor/widgets/interactive-card.php');
      if(is_woocommerce_activated()):
        $this->locate_template('elementor/widgets/product-slider.php');
      endif;
    }

    public function enqueue_elementor_preview_styles() {
      wp_enqueue_style('webify-button');
      wp_enqueue_style('webify-fancy-box');
      wp_enqueue_style('webify-video-block');
      wp_enqueue_style('webify-icon-box');
      wp_enqueue_style('isotop');
      wp_enqueue_style('webify-image-box');
      wp_enqueue_style('webify-slider');
      wp_enqueue_style('slick');
      wp_enqueue_style('webify-client');
      wp_enqueue_style('webify-hero');
      wp_enqueue_style('webify-accordian');
      wp_enqueue_style('webify-text-box');
      wp_enqueue_style('webify-text-slider');
      wp_enqueue_style('webify-testimonial');
      wp_enqueue_style('webify-post');
      wp_enqueue_style('webify-team');
      wp_enqueue_style('webify-token-sale');
      wp_enqueue_style('webify-chart');
      wp_enqueue_style('webify-cta');
      wp_enqueue_style('webify-pricing-table');
      wp_enqueue_style('webify-newsletter');
      wp_enqueue_style('webify-funfact');
      wp_enqueue_style('webify-progress-bar');
      wp_enqueue_style('webify-table');
      wp_enqueue_style('webify-map');
      wp_enqueue_style('webify-shop-feature');
      wp_enqueue_style('webify-shop-card');
      wp_enqueue_style('webify-award');
      wp_enqueue_style('light-gallery');
      wp_enqueue_style('webify-instagram');
      wp_enqueue_style('webify-food-menu');
      wp_enqueue_style('horizontal-scroll');
      wp_enqueue_style('webify-tab');
      wp_enqueue_style('webify-counter');
      wp_enqueue_style('webify-image-slide');
      wp_enqueue_style('webify-scroll-section');
      wp_enqueue_style('ytv');
    }

    public function enqueue_editor_styles() {
      wp_enqueue_style('icons-mind',      $this->assets_css.'/iconsmind.css',  null, '1.0.0');
    } 

    private function includes() {
      $this->locate_template('includes/helpers/helpers.php');
      $this->locate_template('includes/cpt/class-portfolio-cpt.php');
      $this->locate_template('includes/cpt/class-portfolio-taxonomy.php');
      $this->locate_template('includes/cpt/class-testimonial-cpt.php');
      $this->locate_template('includes/cpt/class-testimonial-taxonomy.php');
      $this->locate_template('includes/cpt/class-team-cpt.php');
      $this->locate_template('includes/cpt/class-team-taxonomy.php');
      $this->locate_template('includes/cpt/class-food-menu-cpt.php');
      $this->locate_template('includes/cpt/class-food-menu-taxonomy.php');

      if(class_exists('CSF')) {
        $this->locate_template('includes/widgets/contact-details.php');
        $this->locate_template('includes/widgets/about.php');
        $this->locate_template('includes/widgets/category-block.php');
        $this->locate_template('includes/widgets/social-icons.php');
        $this->locate_template('includes/widgets/popular-posts.php');
        $this->locate_template('includes/widgets/recent-posts.php');
        $this->locate_template('includes/widgets/newsletter.php');
        $this->locate_template('includes/widgets/text-block-with-image.php');
      }

    }

    public function theme_notices() { ?>
      <div class="notice notice-error">
        <p><strong><?php esc_html_e('Please Activate Webify Theme to use Webify Addons plugin.', 'webify-addons'); ?></strong></p>
        <?php
        $screen = get_current_screen();
        if ($screen->base != 'themes'): ?>
          <p><a href="<?php echo esc_url(admin_url('themes.php')); ?>"><?php esc_html_e('Activate Theme', 'webify-addons'); ?></a></p>
        <?php endif; ?>
      </div>
      <?php
    }

    public static function css_compress($css) {
      $css  = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
      $css  = str_replace(': ', ':', $css );
      $css  = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css);
      return $css;
    }

    public static function add_inline_css($css) {
      echo '<style type="text/css" scoped>'.self::css_compress($css).'</style>';
    }

    public static function hex_to_rgba($hexcolor, $opacity = 1) {
      $hex = str_replace('#', '', $hexcolor);
      if( strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
      } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
      }

      return (isset($opacity) && $opacity != 1) ? 'rgba('. $r .', '. $g .', '. $b .', '. $opacity .')' : ' ' . $hexcolor;
    }

    public function append_custom_fonts($fonts) {
      $custom_fonts = webify_get_opt('custom_fonts');
      if(is_array($custom_fonts) && !empty($custom_fonts)) {
        foreach ($custom_fonts as $key => $font) {
          $font_weight = (!empty($font['font-weight'])) ? array($font['font-weight']):array('300', '400', '500', '600', '700', '800');
          $fonts[$font['name']] = $font_weight;
        }
      }
      return $fonts;
    }

    public function enqueue_custom_font_css() {
      $custom_font_style = webify_custom_font();
      wp_enqueue_style('custom-font',  $this->assets_css.'/custom-font.css',  null, '1.0.0');
    }

    public function locate_template($template_path) {
      $located = WEBIFY_PLUGIN_DIR . $template_path;
      if(file_exists($located)) {
        require_once($located);
      }
    }

    public function textdomain() {
      load_plugin_textdomain('webify-addons', false, wp_normalize_path(trailingslashit(plugin_dir_path( __FILE__ ))) .'/languages');
    }

    public function init_importer() {
      $is_valid = get_option('tb_registered');
      if($is_valid) {
        add_filter('pt-ocdi/import_files', array($this, 'import_files'));
        add_filter('pt-ocdi/enable_grid_layout_import_popup_confirmation', '__return_false');
        add_action('pt-ocdi/after_import', array($this, 'after_import_setup'));
        add_filter('pt-ocdi/disable_pt_branding', '__return_true' );
      }
    }

    public function import_files() {
      $demos_list = array(
        'creative'             => esc_html__('Creative', 'webify-addons'),
        'portfolio-section'    => esc_html__('Portfolio Section', 'webify-addons'),
        'crypto'               => esc_html__('Crypto', 'webify-addons'),
        'architect'            => esc_html__('Architect', 'webify-addons'),
        'consult'              => esc_html__('Consult', 'webify-addons'),
        'agency'               => esc_html__('Agency', 'webify-addons'),
        'restaurent'           => esc_html__('Restaurent', 'webify-addons'),
        'photography'          => esc_html__('Photography', 'webify-addons'),
        'app-landing'          => esc_html__('App Landing', 'webify-addons'),
        'resume'               => esc_html__('Resume', 'webify-addons'),
        'medical'              => esc_html__('Medical', 'webify-addons'),
        'yoga'                 => esc_html__('Yoga', 'webify-addons'),
        'portfolio-masonry'    => esc_html__('Portfolio Masonry', 'webify-addons'),
        'marketing'            => esc_html__('Marketing', 'webify-addons'),
        'blog-personal'        => esc_html__('Blog Personal', 'webify-addons'),
        'magazine'             => esc_html__('Magazine', 'webify-addons'),
        'construction'         => esc_html__('Construction', 'webify-addons'),
        'shop'                 => esc_html__('Shop', 'webify-addons'),
        'podcast'              => esc_html__('Podcast', 'webify-addons'),
        'onepage'              => esc_html__('One Page', 'webify-addons'),
        'law'                  => esc_html__('Law', 'webify-addons'),
        'gardener'             => esc_html__('Gardener', 'webify-addons'),
        'wedding'              => esc_html__('Wedding', 'webify-addons'),
        'organic'              => esc_html__('Organic', 'webify-addons'),
        'event'                => esc_html__('Event', 'webify-addons'),
        'startup'              => esc_html__('Startup', 'webify-addons'),
        'dark-portfolio'       => esc_html__('Dark Portfolio', 'webify-addons'),
        'video-agency'         => esc_html__('Video Agency', 'webify-addons'),
        'minimalist'           => esc_html__('Minimalist', 'webify-addons'),
        'portfolio-minimal'    => esc_html__('Portfolio Minimal', 'webify-addons'),
        'photographer'         => esc_html__('Photographer', 'webify-addons'),
        'musician'             => esc_html__('Musician', 'webify-addons'),
        'minimal-magazine'     => esc_html__('Minimal Magazine', 'webify-addons'),
        'fitness'              => esc_html__('Fitness', 'webify-addons'),
        'cleaning'             => esc_html__('Cleaning', 'webify-addons'),
        'fashion'              => esc_html__('Fashion', 'webify-addons'),
        'product-landing'      => esc_html__('Product Landing', 'webify-addons'),
        'motivational-speaker' => esc_html__('Motivational Speaker', 'webify-addons'),
        'designer'             => esc_html__('Designer', 'webify-addons'),
        'charity'              => esc_html__('Charity', 'webify-addons'),
        'fashion-store'        => esc_html__('Fashion Store', 'webify-addons'),
        'big-masonry'          => esc_html__('Big Masonry', 'webify-addons'),
        'grid-gallery'         => esc_html__('Grid Gallery', 'webify-addons'),
        'gallery-thumbnail'    => esc_html__('Gallery Thumbnail', 'webify-addons'),
        'furniture-shop'       => esc_html__('Furniture Shop', 'webify-addons'),
        'interior-design'      => esc_html__('Interior Design', 'webify-addons'),
        'real-estate'          => esc_html__('Real Estate', 'webify-addons'),
        'hair-salon'           => esc_html__('Hair Salon', 'webify-addons'),
        'insurance'            => esc_html__('Insurance', 'webify-addons'),
      );

      $demos = array();
      if(!empty($demos_list) && is_array($demos_list)) {
        foreach($demos_list as $key => $demo) {
          $demos[$key] = array(
            'import_file_name'         => $demo,
            'local_import_file'        => WEBIFY_PLUGIN_DIR .'/includes/demos/'.$key.'/demo-content.xml',
            'local_import_widget_file' => WEBIFY_PLUGIN_DIR .'/includes/demos/'.$key.'/widgets.json',
            'local_import_json'        => array(
              array(
                'file_path'   => WEBIFY_PLUGIN_DIR .'/includes/demos/'.$key.'/theme-options.json',
                'option_name' => '_tb_options',
              ),
            ),
            'import_preview_image_url' => $this->demos_img .'/'.$key.'/screenshot.jpg',
          );
        }
      }

      return $demos;

    }

    public function after_import_setup( $imported_file ) {
      
      $downloader = new OCDI\Downloader();
 
      if(!empty($imported_file['import_json'])) {
        foreach($imported_file['import_json'] as $index => $import) {
          $file_path = $downloader->download_file( $import['file_url'], 'demo-import-file-'. $index .'-'. date( 'Y-m-d__H-i-s' ) .'.json');
          $file_raw  = OCDI\Helpers::data_from_file( $file_path );
          update_option( $import['option_name'], json_decode( $file_raw, true ));
        }
      } else if(!empty($imported_file['local_import_json'])) {
        foreach($imported_file['local_import_json'] as $index => $import) {
          $file_path = $import['file_path'];
          $file_raw  = OCDI\Helpers::data_from_file($file_path);
          update_option($import['option_name'], json_decode( $file_raw, true));
        }
      }

      $header_menu = get_term_by('name', 'Header Menu', 'nav_menu');
      $left_menu   = get_term_by('name', 'Left Menu', 'nav_menu');
      $right_menu  = get_term_by('name', 'Right Menu', 'nav_menu');
      set_theme_mod('nav_menu_locations', array(
          'primary-menu' => $header_menu->term_id,
          'left-menu'    => $left_menu->term_id,
          'right-menu'   => $right_menu->term_id,
        )
      );

      $front_page_id = get_page_by_title('Home');
      update_option('show_on_front', 'page');
      update_option('page_on_front', $front_page_id->ID);
    }

    public function mc4wp_add_css_class_to_form($classes) {
      $classes[] = 'tb-mc4wp-form';
      return $classes;
    }


  }

  new Webify_Addons();
}
