<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * TB Custom Post Types Class.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
if(!class_exists('Webify_Food_Menu_CPT')) {
  class Webify_Food_Menu_CPT {

    /**
     * constructor
     */
    public function __construct() {
      add_filter('init', array($this, 'register_post_type'));
    }

    /**
     * register post types ( testimonial )
     * @return void
     */
    function register_post_type() {

      $labels = array(
        'name'               => esc_html__( 'Food Menu', 'webify-addons' ),
        'singular_name'      => esc_html__( 'Food Menu', 'webify-addons' ),
        'add_new'            => esc_html__( 'Add New', 'webify-addons' ),
        'add_new_item'       => esc_html__( 'Add New Item', 'webify-addons' ),
        'edit_item'          => esc_html__( 'Edit Item', 'webify-addons' ),
        'new_item'           => esc_html__( 'New Item', 'webify-addons' ),
        'all_items'          => esc_html__( 'All Item', 'webify-addons' ),
        'view_item'          => esc_html__( 'View Item', 'webify-addons' ),
        'search_items'       => esc_html__( 'Search Item', 'webify-addons' ),
        'not_found'          => esc_html__( 'No Item found', 'webify-addons' ),
        'not_found_in_trash' => esc_html__( 'No Item found in Trash', 'webify-addons' ),
        'parent_item_colon'  => '',
        'menu_name'          => esc_html__('Food Menu', 'webify-addons' )
      );

       $args = array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'menu_position' => 6,
        'supports'      => array( 'title', 'thumbnail', 'editor' ),
        'has_archive'   => false,
      );

      $args = apply_filters( 'webify_register_post_type_menu_arg', $args );
      register_post_type ('menu', $args);

    }

  }
  new Webify_Food_Menu_CPT();
}