<?php 

namespace DragfyAddons\Helpers;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

class Helpers {

  public static $options = array();

  /**
   * [css_compress description]
   * @param  [type] $css [description]
   * @return [type]      [description]
   */
  public static function css_compress($css) {
    $css  = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
    $css  = str_replace(': ', ':', $css );
    $css  = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css);
    return $css;
  }



  /**
   * [add_inline_css description]
   * @param [type] $css [description]
   */
  public static function add_inline_css($css) {
    echo '<style type="text/css" scoped>'.self::css_compress($css).'</style>';
  }



  /**
   * [hex_to_rgba description]
   * @param  [type]  $hexcolor [description]
   * @param  integer $opacity  [description]
   * @return [type]            [description]
   */
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



  /**
   * [post_excerpt description]
   * @param  string $limit   [description]
   * @param  string $content [description]
   * @return [type]          [description]
   */
  public static function post_excerpt($limit = '', $content = '') {
    $limit   = ( empty($limit)) ? 20:$limit;
    $content = (empty($content)) ? get_the_excerpt():$content;
    $content = strip_shortcodes( $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    $content = strip_tags( $content );
    $words   = explode( ' ', $content, $limit + 1 );

    if( count( $words ) > $limit ) {

      array_pop( $words );
      $content  = implode( ' ', $words );
      $content .= ' ...';

    }

    return $content;

  }



  /**
   * [get_all_pages description]
   * @return [type] [description]
   */
  public static function get_all_pages() {

    $post_types        = get_post_types();
    $post_type_not__in = array('attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'elementor_library', 'post');

    foreach ($post_type_not__in as $post_type_not) {
      unset($post_types[$post_type_not]);
    }

    $post_type = array_values($post_types);  
    $all_pages = get_posts(array(
      'posts_per_page' => -1,
      'post_type'      => 'page',
    ));

    if(!empty($all_pages) && !is_wp_error($all_pages)) {
      foreach ($all_pages as $page) {
        self::$options[$page->ID] = strlen($page->post_title) > 20 ? substr($page->post_title, 0, 20).'...' : $page->post_title;
      }
    }
    return self::$options;
  }



  /**
   * [paging_nav description]
   * @param  boolean $max_num_pages [description]
   * @param  array   $args          [description]
   * @return [type]                 [description]
   */
  public static function paging_nav($max_num_pages = false, $args = array()) {

    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }

    if ($max_num_pages === false) {
      global $wp_query;
      $max_num_pages = $wp_query->max_num_pages;
    }

    $defaults = array(
      'nav'            => 'load',
      'posts_per_page' => get_option('posts_per_page'),
      'max_pages'      => $max_num_pages,
      'post_type'      => 'post',
    );

    $args = wp_parse_args( $args, $defaults );

    if ($max_num_pages < 2 ) { return; }

    if($args['nav'] == 'load-more') {

      $uniqid = uniqid();

      $output  = '<div class="df-ajax-pagination">';
      $output .= '<a href="#" class="df-btn df-ajax-load-more df-style12 df-color22 w-100 '.$args['nav'].'" data-token="'. $uniqid .'">'.esc_html__('LOAD MORE ARTICLES', 'webify').'</a>';
      $output .= '</div>';

      unset( $args['query'] );
      wp_localize_script('dragfy-addons', 'dragfy_addons_load_more_' . $uniqid, $args );

      echo wp_kses_post($output);

    } else {

      $big = 999999999; 

      $links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'total'     => $max_num_pages,
        'prev_next' => false,
        'end_size'  => 1,
        'mid_size'  => 2,
        'type'      => 'list',
      ) );

      if (!empty($links)): ?>
        <div class="df-col-lg-12">
          <div class="empty-space marg-lg-b30 marg-sm-b15"></div>
          <div class="text-center">
            <?php echo wp_kses_post($links); ?>
          </div>
        </div>
      <?php 
      endif;
    }

  }



  /**
   * [get_page_templates description]
   * @param  [type] $type [description]
   * @return [type]       [description]
   */
  public static function get_page_templates($type = null) {
    $args = array(
      'post_type'      => 'elementor_library',
      'posts_per_page' => -1,
    );

    if($type) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'elementor_library_type',
          'field' => 'slug',
          'terms' => $type,
        ),
      );
    }

    $page_templates = get_posts($args);
    $options = array();

    if(!empty($page_templates) && !is_wp_error($page_templates)) {
      foreach ($page_templates as $post) {
        $options[$post->ID] = $post->post_title;
      }
    }
    return $options;
  }



  /**
   * [select_ninja_form description]
   * @return [type] [description]
   */
  public static function select_ninja_form() {
    $options = array();
    if(class_exists('Ninja_Forms')) {
      $contact_forms = Ninja_Forms()->form()->get_forms();
      if (!empty($contact_forms) && !is_wp_error($contact_forms)) {
        $options[0] = esc_html__('Select Ninja Form', 'dragfy-addons-for-elementor');
        foreach ($contact_forms as $form) {
          $options[$form->get_id()] = $form->get_setting('title');
        }
      }
    } else {
      $options[0] = esc_html__('Create a Form First', 'dragfy-addons-for-elementor');
    }
    return $options;
  }



  /**
   * [select_wp_form description]
   * @return [type] [description]
   */
  public static function select_wp_form() {
    $options = array();
    if(class_exists('\WPForms\WPForms')) {
      $args = array(
        'post_type'      => 'wpforms',
        'posts_per_page' => -1,
      );

      $contact_forms = get_posts($args);
      if (!empty($contact_forms) && !is_wp_error($contact_forms)) {
        $options[0] = esc_html__('Select a WPForm', 'dragfy-addons-for-elementor');
        foreach ($contact_forms as $post) {
          $options[$post->ID] = $post->post_title;
        }
      }
    } else {
      $options[0] = esc_html__('Create a Form First', 'dragfy-addons-for-elementor');
    }
    return $options;
  }


} // end of class
