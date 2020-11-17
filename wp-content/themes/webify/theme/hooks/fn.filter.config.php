<?php
/**
 * Filter Hooks
 *
 * @package webify
 * @since 1.0
 */

if (! function_exists('webify_wp_title') ) {
  /**
   * Title Filter
   *
   * @package webify
   * @since 1.0
   */
  function webify_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
      return $title;
    } 

    $title .= get_bloginfo( 'name' );

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
      $title = "$title $sep $site_description";
    } 
    
    if ( $paged >= 2 || $page >= 2 ) {
      $title = sprintf( __( 'Page %s', 'webify' ), max( $paged, $page ) ) . " $sep $title";
    } 

    return $title;

  } 
  add_filter( 'wp_title', 'webify_wp_title', 10, 2 );
}

/**
 * Change comment form textarea to use placeholder
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
if(!function_exists('webify_comment_form_defaults')) {
  function webify_comment_form_defaults($args) {
    $post_id       = get_the_ID();
    $user          = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args['comment_field'] = str_replace('textarea', 'textarea placeholder = "'.esc_attr('Comment', 'webify').'"', $args['comment_field']);
    $args['logged_in_as']  = '<p class="logged-in-as">'.sprintf(__('<a href="%1$s" aria-label="%2$s">Logged in as <span>%3$s</span></a>. <a href="%4$s">Log out?</a>', 'webify'),get_edit_user_link(), esc_attr(sprintf(__( 'Logged in as %s. Edit your profile.', 'webify'), $user_identity)), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
    ).'</p>';
    return $args;
  }
  add_filter('comment_form_defaults', 'webify_comment_form_defaults');
}

if(!function_exists('webify_comment_form_fields')) {
  function webify_comment_form_fields($fields) {
    foreach($fields as &$field) {
      $field = str_replace('id="author"', 'id="author"  placeholder="'.esc_attr('Name', 'webify').'"', $field);
      $field = str_replace('id="email"',  'id="email"   placeholder="'.esc_attr('Email', 'webify').'"',  $field);
      $field = str_replace('id="url"',    'id="url"     placeholder="'.esc_attr('Website', 'webify').'"',    $field);
    }
    return $fields;
  }
  add_filter('comment_form_default_fields', 'webify_comment_form_fields');
}

if(!function_exists('webify_change_breadcrumb_title')) {
  function webify_change_breadcrumb_title($title, $type, $id) {
    return (in_array('home', $type)) ? esc_html__('Home', 'webify'):$title;
  }
  add_filter('bcn_breadcrumb_title', 'webify_change_breadcrumb_title', 3, 10);
}
