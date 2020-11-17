<?php
/**
 * Action Hooks.
 *
 * @package webify
 * @since 1.0
*/
if( !function_exists('webify_after_setup')) {

  function webify_after_setup() {

    add_image_size('webify-square-thumb',           50,   50, true);
    add_image_size('webify-square-thumb-big',       100,  100, true);
    add_image_size('webify-rectangle-small',        370,  160, true);
    add_image_size('webify-rectangle-medium',       248,  230, true);
    add_image_size('webify-rectangle-medium-alt',   570,  392, true);
    add_image_size('webify-rectangle-large',        728,  485, true);

    define('WEBIFY_THEME_ACTIVATED', true);

    add_theme_support('post-thumbnails');
    add_theme_support('custom-background');
    add_theme_support('automatic-feed-links' );
    add_theme_support('title-tag');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    load_theme_textdomain('webify', get_template_directory() . '/languages');

    register_nav_menus (array(
      'primary-menu' => esc_html__('Main Menu', 'webify'),
      'left-menu'    => esc_html__('Left Menu Before Logo', 'webify'),
      'right-menu'   => esc_html__('Right Menu After Logo', 'webify'),
    ) );
  }
  add_action( 'after_setup_theme', 'webify_after_setup' );
}



/**
 *
 * Post Vote AJAX
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('webify_post_vote')) {
  function webify_post_vote() {
    if(isset($_POST['id']) && wp_verify_nonce($_POST['vote_nonce'], 'webify-nonce')) {
      $post_id    = $_POST['id'];
      $is_up      = $_POST['is_up'];
      $vote_count = get_post_meta($post_id, '_vote_count', true);

      if($is_up == 'true') {
        $vote_count = ++$vote_count;
      } elseif($is_up == 'false') {
        $vote_count = --$vote_count;
      } else {
        $vote_count = 1;
      }

      update_post_meta($post_id, '_vote_count', $vote_count);
      setcookie('webify_vote_'. $post_id, $post_id.' '.$is_up, time() + ( 86400 * 7 ), '/');
      echo 'voted';
    } else {
      echo 'error';
    }
    die();
  }
  add_action('wp_ajax_nopriv_post-vote', 'webify_post_vote');
  add_action('wp_ajax_post-vote', 'webify_post_vote');
}

/**
* @return null
* @param none
* editor style
**/
if(!function_exists('webify_theme_editor_style')) {
  function webify_theme_editor_style() {
    add_editor_style( 'custom-editor-style.css' );
  }
  add_action( 'admin_init', 'webify_theme_editor_style' );
}

if(!function_exists('webify_enqueue_scripts')) {
  function webify_enqueue_scripts() {
    if(( is_admin())) { return; }

    if (is_singular()) { wp_enqueue_script( 'comment-reply' ); }

    wp_enqueue_script('parallax',                     get_theme_file_uri('assets/js/parallax.min.js'),   array('jquery'), '1.0.0', true);
    wp_enqueue_script('form-stone',                   get_theme_file_uri('assets/js/jquery.formstone.min.js'),   array('jquery'), '1.0.0', true);
    wp_enqueue_script('webify-main',                  get_theme_file_uri('assets/js/main.js'),                   array('jquery'), '1.0.0', true);
    wp_enqueue_script('imagesloaded');

    wp_register_script('isotop',                      get_theme_file_uri('assets/js/isotope.pkg.min.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('slick',                       get_theme_file_uri('assets/js/slick.min.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('web-animation',               get_theme_file_uri('assets/js/jquery.web.animation.min.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('ball',                        get_theme_file_uri('assets/js/ball.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('text-slider',                 get_theme_file_uri('assets/js/textSlider.min.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('svg-wave',                    get_theme_file_uri('assets/js/svg-wave.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('chart-min',                   get_theme_file_uri('assets/js/Chart.min.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('anime',                       get_theme_file_uri('assets/js/anime.min.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('ytv',                         get_theme_file_uri('assets/js/ytv.js'),   array('jquery'), '1.0.0', true);
    wp_register_script('scrollify',                   get_theme_file_uri('assets/js/jquery.scrollify.js'),   array('jquery'), '1.0.0', true);

    $google_map_api = webify_get_opt('google-map-api');
    if(!empty($google_map_api)) {
      wp_register_script('gmapsensor',                  '//maps.google.com/maps/api/js?key='.$google_map_api.'', array('jquery'), '1.0.0', true);
      wp_register_script('gmap',                        get_theme_file_uri('assets/js/gmap3.min.js'),   array('gmapsensor'), '1.0.0', true);
    }
    wp_register_script('light-gallery',               get_theme_file_uri('assets/js/lightgallery.min.js'),   array('jquery'), '1.0.0', true);
    
    wp_localize_script('webify-main', 'get',
      array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'siteurl' => get_template_directory_uri(),
        'nonce'   => wp_create_nonce('webify-nonce')
      )
    );

    wp_enqueue_style('webify-fonts',                 webify_fonts_url(), null, '1.0.0');
    wp_enqueue_style('bootstrap',                    get_theme_file_uri('assets/css/bootstrap.min.css'),    null, '1.0.0');
    wp_enqueue_style('icons-mind',                   get_theme_file_uri('assets/css/iconsmind.css'),        null, '1.0.0');
    wp_enqueue_style('webify-font-awesome',          '//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all.min.css',        null, '1.0.0');
    wp_enqueue_style('webify-font-awesome-v4',       '//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/v4-shims.min.css',        null, '1.0.0');
    wp_enqueue_style('webify-unit-testing',          get_theme_file_uri('assets/css/unit-testing.css'),        null, '1.0.0');
    wp_enqueue_style('webify-woocommerce',           get_theme_file_uri('assets/css/woocommerce.css'),        null, '1.0.0');
    wp_enqueue_style('header',                       get_theme_file_uri('assets/css/header.css'),        null, '1.0.0');
    wp_enqueue_style('ytv',                          get_theme_file_uri('assets/css/ytv.css'),        null, '1.0.0');
    wp_enqueue_style('material-icon',                webify_material_font_icon(), null, '1.0.0' );
    wp_enqueue_style('webify-style',                 get_theme_file_uri('assets/css/style.css'),      null, '1.0.0');

    if(is_rtl()) {
      wp_enqueue_style('webify-rtl',                 get_theme_file_uri('assets/css/rtl.css'),      null, '1.0.0');
    }

    wp_register_style('webify-button',               get_theme_file_uri('assets/css/shortcodes/button.css'),   null, '1.0.0');
    wp_register_style('webify-fancy-box',            get_theme_file_uri('assets/css/shortcodes/fancybox.css'),   null, '1.0.0');
    wp_register_style('webify-newsletter',           get_theme_file_uri('assets/css/shortcodes/newsletter.css'),   null, '1.0.0');
    wp_register_style('webify-slider',               get_theme_file_uri('assets/css/shortcodes/slider.css'),   null, '1.0.0');
    wp_register_style('isotop',                      get_theme_file_uri('assets/css/shortcodes/isotop.css'),   null, '1.0.0');
    //wp_register_style('swiper',                      get_theme_file_uri('assets/css/swiper.min.css'),   null, '1.0.0');
    wp_register_style('slick',                       get_theme_file_uri('assets/css/slick.css'),   null, '1.0.0');
    wp_register_style('webify-client',               get_theme_file_uri('assets/css/shortcodes/client.css'),   null, '1.0.0');
    wp_register_style('webify-text-box',             get_theme_file_uri('assets/css/shortcodes/text-box.css'),   null, '1.0.0');
    wp_register_style('webify-text-slider',          get_theme_file_uri('assets/css/shortcodes/text-slider.css'),   null, '1.0.0');
    wp_register_style('webify-accordian',            get_theme_file_uri('assets/css/shortcodes/accordian.css'),   null, '1.0.0');
    wp_register_style('webify-testimonial',          get_theme_file_uri('assets/css/shortcodes/testimonial.css'),   null, '1.0.0');
    wp_register_style('webify-shop-feature',         get_theme_file_uri('assets/css/shortcodes/shop-feature.css'),   null, '1.0.0');
    wp_register_style('webify-table',                get_theme_file_uri('assets/css/shortcodes/table.css'),   null, '1.0.0');
    wp_register_style('webify-hero',                 get_theme_file_uri('assets/css/shortcodes/hero.css'),   null, '1.0.0');
    wp_register_style('webify-team',                 get_theme_file_uri('assets/css/shortcodes/team.css'),   null, '1.0.0');
    wp_register_style('webify-image-box',            get_theme_file_uri('assets/css/shortcodes/image-box.css'),   null, '1.0.0');
    wp_register_style('webify-icon-box',             get_theme_file_uri('assets/css/shortcodes/icon-box.css'),   null, '1.0.0');
    wp_register_style('webify-award',                get_theme_file_uri('assets/css/shortcodes/award.css'),   null, '1.0.0');
    wp_register_style('webify-image-slide',          get_theme_file_uri('assets/css/shortcodes/image-slide.css'),   null, '1.0.0');
    wp_register_style('webify-chart',                get_theme_file_uri('assets/css/shortcodes/chart.css'),   null, '1.0.0');
    wp_register_style('webify-tab',                  get_theme_file_uri('assets/css/shortcodes/tab.css'),   null, '1.0.0');
    wp_register_style('webify-funfact',              get_theme_file_uri('assets/css/shortcodes/funfact.css'),   null, '1.0.0');
    wp_register_style('webify-counter',              get_theme_file_uri('assets/css/shortcodes/counter.css'),   null, '1.0.0');
    wp_register_style('webify-pricing-table',        get_theme_file_uri('assets/css/shortcodes/pricing-table.css'),   null, '1.0.0');
    wp_register_style('webify-scroll-section',       get_theme_file_uri('assets/css/shortcodes/scroll-section.css'),   null, '1.0.0');
    wp_register_style('webify-progress-bar',         get_theme_file_uri('assets/css/shortcodes/progressbar.css'),   null, '1.0.0');
    wp_register_style('webify-post',                 get_theme_file_uri('assets/css/shortcodes/post.css'),   null, '1.0.0');
    wp_register_style('webify-food-menu',            get_theme_file_uri('assets/css/shortcodes/food-menu.css'),   null, '1.0.0');
    wp_register_style('webify-instagram',            get_theme_file_uri('assets/css/shortcodes/instagram.css'),   null, '1.0.0');
    wp_register_style('light-gallery',               get_theme_file_uri('assets/css/lightgallery.min.css'),   null, '1.0.0');
    wp_register_style('horizontal-scroll',           get_theme_file_uri('assets/css/shortcodes/horizontal-scroll.css'),   null, '1.0.0');
    wp_register_style('webify-cta',                  get_theme_file_uri('assets/css/shortcodes/cta.css'),   null, '1.0.0');
    wp_register_style('webify-map',                  get_theme_file_uri('assets/css/shortcodes/map.css'),   null, '1.0.0');
    wp_register_style('webify-token-sale',           get_theme_file_uri('assets/css/shortcodes/token-sale.css'),   null, '1.0.0');
    wp_register_style('webify-newsletter',           get_theme_file_uri('assets/css/shortcodes/newsletter.css'),   null, '1.0.0');
    wp_register_style('webify-video-block',          get_theme_file_uri('assets/css/shortcodes/video-block.css'),   null, '1.0.0');
    wp_register_style('flaticon',                    get_theme_file_uri('assets/css/flaticon.css'),        null, '1.0.0');
    wp_register_style('webify-shop-card',            get_theme_file_uri('assets/css/shortcodes/shop-card.css'),   null, '1.0.0');

    $accent_code = webify_accent_css();
    $style = '';
    $style .= (!empty($accent_code)) ? $accent_code:'';

    wp_add_inline_style('webify-style', $style);

  }
  add_action('wp_enqueue_scripts', 'webify_enqueue_scripts');
}


if( !function_exists('webify_register_sidebar') ) {
  /**
  * @return null
  * @param none
  * register widgets
  **/
  function webify_register_sidebar() {
    register_sidebar(array(
      'id'            => 'main',
      'name'          => 'Main Sidebar',
      'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="tb-sidebar-widget-title widget-title"><span>',
      'after_title'   => '</span></h4>',
      'description'   => 'Drag the widgets for main sidebars.'
    ));

    for($i = 1; $i < 5; $i++) {
      register_sidebar(array(
        'id'            => 'footer-'.$i,
        'name'          => esc_html__('Footer Sidebar '.$i, 'webify'),
        'before_widget' => '<div id="%1$s" class="widget tb-footer-item tb-footer_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="tb-footer-widget-title tb-font-name"><span>',
        'after_title'   => '</span></h2>',
        'description'   => 'Drag the widgets for sidebars.'
      ));
    }

    $custom_sidebars = webify_get_opt('custom-sidebar');
    if (is_array($custom_sidebars)) {
      foreach ($custom_sidebars as $sidebar) {

        if (empty($sidebar['sidebar-name'])) {
          continue;
        }

        register_sidebar ( array (
          'name'          => $sidebar['sidebar-name'],
          'id'            => sanitize_title ($sidebar['sidebar-name']),
          'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="tb-custom-widget-title tb-font-name widget-title"><span>',
          'after_title'   => '</span></h4>',
          'description'   => 'Drag the widgets for custom sidebars.'
        ) );
      }
    }
  }
  add_action( 'widgets_init', 'webify_register_sidebar' );
}


if(! function_exists('webify_include_required_plugins')) {
  /**
  * @return null
  * @param none
  * tgm_include
  **/
  function webify_include_required_plugins() {

    $plugins = array(

      array(
        'name'               => esc_html__('Contact Form 7', 'webify'), // The plugin name
        'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
        'required'           => false, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),
      array(
        'name'               => esc_html__('Elementor', 'webify'), // The plugin name
        'slug'               => 'elementor', // The plugin slug (typically the folder name)
        'required'           => true, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),
      array(
        'name'               => esc_html__('Webify Addons', 'webify'), // The plugin name
        'slug'               => 'webify-addons', // The plugin slug (typically the folder name)
        'source'             => get_template_directory_uri().'/plugins/webify-addons.zip', // The plugin source
        'required'           => true, // If false, the plugin is only 'recommended' instead of required
        'version'            => '4.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),
      array(
        'name'               => esc_html__('Codestar Framework', 'webify'), // The plugin name
        'slug'               => 'codestar-framework', // The plugin slug (typically the folder name)
        'source'             => get_template_directory_uri().'/plugins/codestar-framework.zip', // The plugin source
        'required'           => true, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),
      array(
        'name'               => esc_html__('Envato Market', 'webify'), // The plugin name
        'slug'               => 'envato-market', // The plugin slug (typically the folder name)
        'source'             => get_template_directory_uri().'/plugins/envato-market.zip', // The plugin source
        'required'           => false, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),
      array(
        'name'               => esc_html__('Smash Balloon Social Photo Feed', 'webify'),
        'slug'               => 'instagram-feed',
        'required'           => false,
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => '',
      ),
      array(
        'name'               => esc_html__('Newsletter', 'webify'),
        'slug'               => 'newsletter',
        'required'           => false,
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => '',
      ),
      array(
        'name'               => esc_html__('Mailchimp for WordPress', 'webify'),
        'slug'               => 'mailchimp-for-wp',
        'required'           => false,
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => '',
      ),
      array(
        'name'               => esc_html__('Breadcrumb NavXT', 'webify'),
        'slug'               => 'breadcrumb-navxt',
        'required'           => false,
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => '',
      ),
      array(
        'name'               => esc_html__('Dragfy Addons for Elementor', 'webify'),
        'slug'               => 'dragfy-addons-for-elementor',
        'required'           => false,
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => '',
      ),
      array(
        'name'               => esc_html__('One Click Demo Import', 'webify'),
        'slug'               => 'one-click-demo-import',
        'required'           => false,
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => '',
      ),
      array(
        'name'               => esc_html__('Woocommerce', 'webify'), 
        'slug'               => 'woocommerce', 
        'required'           => false, 
        'version'            => '', 
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
    );

    $config = array(
      'id'           => 'webify',                   // Unique ID for hashing notices for multiple instances of TGMPA.
      'default_path' => '',                      // Default absolute path to bundled plugins.
      'menu'         => 'tgmpa-install-plugins', // Menu slug.
      'parent_slug'  => 'themes.php',            // Parent menu slug.
      'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
      'has_notices'  => true,                    // Show admin notices or not.
      'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
      'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
      'is_automatic' => false,                   // Automatically activate plugins after installation or not.
      'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

  }
  add_action( 'tgmpa_register', 'webify_include_required_plugins' );
}

/**
 *
 * Ajax Pagination
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if(!function_exists('webify_ajax_pagination' ) ) {
  function webify_ajax_pagination() {
    global $post;
    
    $categories     = (!empty($_POST['cats'])) ? $_POST['cats']:'';
    $excerpt_length = (!empty($_POST['excerpt_length'])) ? $_POST['excerpt_length']:35;

    $query_args = array(
      'paged'          => $_POST['paged'],
      'posts_per_page' => $_POST['posts_per_page'],
      'post_type'      => 'post',
      'isotope'        => 0,
      'post_status'    => 'publish',
    );

    query_posts($query_args);

    if(!empty($categories)) {
      $query_args['tax_query'] = array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => $categories,
        ),
      );
    }

    while( have_posts() ) : the_post(); ?>

      <div <?php post_class('col-lg-6'); ?>>
        <div class="tb-post tb-style13 tb-small-post">
          <div class="tb-zoom">
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url(webify_get_image_src(get_post_thumbnail_id())); ?>);"></a>
          </div>
          <div class="tb-post-info">
            <div class="empty-space marg-lg-b15"></div>
            <div class="tb-catagory tb-style1 tb-color1">
              <?php echo get_the_category_list(); ?>
            </div>
            <div class="empty-space marg-lg-b10"></div>
            <h2 class="tb-post-title tb-f18-lg tb-m0 tb-mt-2 tb-mb-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
            <div class="empty-space marg-lg-b10"></div>
            <div class="tb-f14-lg tb-line1-6"><?php echo webify_post_excerpt($excerpt_length); ?></div>
            <div class="empty-space marg-lg-b5"></div>
          </div>
        </div>
      </div><!-- .col -->

    <?php
    endwhile;
    wp_reset_query();


    die();
  }
  add_action('wp_ajax_ajax-pagination', 'webify_ajax_pagination');
  add_action('wp_ajax_nopriv_ajax-pagination', 'webify_ajax_pagination');
}

