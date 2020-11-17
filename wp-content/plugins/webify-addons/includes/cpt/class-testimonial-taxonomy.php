<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Taxonomy class.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
if(!class_exists('Webify_Testimonial_Taxonomy')) {
  class Webify_Testimonial_Taxonomy {

    protected $post_type = 'testimonial';

    /**
     * constructor
     */
    
    public function __construct() {
      add_action('init', array($this,'register_taxonomy'), 10);
    }

    /**
     * register taxonomy ( property )
     * @return void
     */
    public function register_taxonomy() {
      $this->add_taxonomy('Categories','testimonial-category',$this->post_type);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @param string
     */
    public function add_taxonomy($label, $taxonomy_name, $post_type) { 
      $labels = array(
        'name'                       => esc_html($label),
        'singular_name'              => esc_html($label),
        'search_items'               => sprintf('Search %s', $label),
        'popular_items'              => sprintf('Popular %s', $label),
        'all_items'                  => sprintf('All %s', $label),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => sprintf('Edit %s', $label),
        'update_item'                => sprintf('Update %s', $label),
        'add_new_item'               => sprintf('Add New %s', $label),
        'new_item_name'              => sprintf('New %s Name', $label),
        'add_or_remove_items'        => sprintf('Add or Remove %s', $label),
        'choose_from_most_used'      => sprintf('Choose from the most used %s', $label),
      );

      register_taxonomy($taxonomy_name, $post_type, array(
        'hierarchical' => true,
        'labels'       => $labels,
      ));
    }
  }
  new Webify_Testimonial_Taxonomy();
}