<?php
/**
 * Admin Helpers Functions
 *
 * @package webify
 * @since 1.0
*/
/**
 * Get theme option value
 * @param string $option
 * @return mix|boolean
*/
if(!function_exists('webify_get_opt')) {
  function webify_get_opt($option = '', $default = null) {

    $theme_options = get_option('_tb_options');
    $local = false;

    if (is_singular()) {
      $value = webify_get_post_opt($option);
      $local = true;
    }

    if ($local === true) {
      $first_element = null;
      if (is_array($value)) {
        $first_element = reset($value);
      }
      if (is_string($value) && (strlen($value) > 0 || !empty($value)) || is_array($value) && !empty($first_element)) {
        return $value;
      }
    }

    $options_defaults = webify_options_default();
    $default          = (!isset($default) && isset( $options_defaults[$option])) ? $options_defaults[$option] : $default;
    $value            = (isset( $theme_options[$option])) ? $theme_options[$option] : $default;
    return $value;    

  }
}

  /**
   * Get single post option value
   * @param unknown $option
   * @param string $id
   * @return NULL|mixed
  */
if(!function_exists('webify_get_post_opt')) {
  function webify_get_post_opt($option, $id = '') {

    global $post;

    if (!empty($id)) {
      $local_id = $id;
    } else {
      if(!isset($post->ID)) {
        return null;
      }
      $local_id = get_the_ID();
    }
    
    $value = get_post_meta( $local_id, $option, true );


    if( isset( $value ) ) {
      return $value;
    } else {
      return null;
    }
  }
}

if(!function_exists('webify_options_default')) {
  function webify_options_default() {
    $default = array(
      'preloader'                   => 0,
      'page-layout'                 => 'default',
      'page-sidebar'                => 0,
      'header-sticky'               => 0,
      'header-full-width'           => 0,
      'header-style'                => 'header-style1',
      'header-height'               => '',
      'top-header-enable'           => 0,
      'top-header-msg'              => esc_html__('Add your custom welcome message here (product announcement, notice, etc.) or turn this off.', 'webify'),
      'top-header-height'           => '',
      'header-btn-style'            => '',
      'header-btn-text'             => esc_html__('Get Webify Today', 'webify'),
      'header-btn-link'             => esc_html__('#', 'webify'),
      'page-header-enable'          => 1,
      'page-header-bg-overlay'      => 1,
      'blog-single-layout'          => 'default',
      'blog-sidebar'                => '',
      'blog-single-social-share'    => 0,
      'blog-single-post-vote'       => 1,
      'archive-layout'              => 'right_sidebar',
      'archive-sidebar'             => '',
      'search-layout'               => 'right_sidebar',
      'search-sidebar'              => '',
      'author-layout'               => 'right_sidebar',
      'author-sidebar'              => '',
      'shop-layout'                 => 'default',
      'shop-sidebar'                => '',
      'shop-single-layout'          => 'default',
      'shop-single-sidebar'         => '',
      'shop-newsletter'             => 1,
      'shop-newsletter-heading'     => esc_html__('We send love letters!', 'webify'),
      'shop-newsletter-sub-heading' => esc_html__('Get the discount coupons in mail', 'webify'),
      'shop-newsletter-btn-style'   => '',
      'error-page-heading'          => esc_html__('Ooops... Page not found!', 'webify'),
      'error-page-content'          => esc_html__('We are sorry, but the page you are looking for does not exist.', 'webify'),
      'error-page-btn-text'         => esc_html__('Back to Home', 'webify'),
      'footer-enable-switch'        => 1,
      'footer-sticky'               => 1,
      'footer-scroll-top'           => 1,
      'footer-style'                => 'footer-style1',
      'footer-enable-cta'           => 1,
      'footer-cta-heading'          => esc_html__('Ready to revolutionize your website?', 'webify'),
      'footer-cta-btn-style'        => '',
      'footer-cta-btn-text'         => esc_html__('Learn More', 'webify'),
      'footer-cta-btn-link'         => esc_html__('#', 'webify'),
      'footer-column'               => '4',
      'footer-sidebar-1'            => '',
      'footer-sidebar-2'            => '',
      'footer-sidebar-3'            => '',
      'footer-sidebar-4'            => '',
      'footer-content'              => wp_kses_post('Make your beautiful blog or magazine website with this stunning WordPress theme. <br>Crafted with an eye for details and care by ThemeBubble.'),
      'footer-copyright-text'       => esc_html__('© Built with pride and caffeine. All rights reserved.', 'webify')
    );
    return $default;
  }
}

/**
 * Get custom sidebars list
 * @return array
*/
if(!function_exists('webify_get_custom_sidebars_list')) {
  function webify_get_custom_sidebars_list($add_default = true) {

    $sidebars = array();
    if ($add_default) {
      $sidebars['default'] = esc_html__('Default', 'webify');
    }

    $options = get_option('_tb_options');


    if (!isset($options['custom-sidebar']) || !is_array($options['custom-sidebar'])) {
      return $sidebars;
    }

    if (is_array($options['custom-sidebar'])) {
      foreach ($options['custom-sidebar'] as $sidebar) {
        $sidebars[sanitize_title ($sidebar['sidebar-name'] )] = $sidebar['sidebar-name'];
      }
    }

    return $sidebars;
  }
}

/**
 * Get custom sidebar, returns $default if custom sidebar is not defined
 * @param string $default
 * @param string $sidebar_option_field
 * @return string
*/
if(!function_exists('webify_get_custom_sidebar')) {
  function webify_get_custom_sidebar($default = '', $sidebar_option_field = 'page-sidebar') {

    $sidebar = webify_get_opt($sidebar_option_field);

    if ($sidebar != 'default' && !empty($sidebar)) {
      return $sidebar;
    }
    return $default;
  }
}

/**
 * Get space array
 * @param type $type
 * @return array
*/
if(!function_exists('webify_get_space_array')) {
  function webify_get_space_array() {
    $space_array = array('' => 'Select Margin', 'no-margin' => 'No Margin');
    for($i = 5; $i < 215;) {
      $space_array[$i] = $i;
      $i = $i + 5;
    }
    return $space_array;
  }
}
