<?php
/**
 * Helper Functions
 *
 * @package webify
 * @since 1.0
*/

/**
 *
 * Blog Excerpt Read More
 * @since 1.7.0
 * @version 1.0.0
 *
 */
if (!function_exists( 'webify_post_excerpt' ) ) {
  function webify_post_excerpt( $limit = '', $content = '' ) {
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
}

/**
 *
 * Pagination
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'webify_paging_nav' ) ) {
  function webify_paging_nav( $max_num_pages = false, $args = array()) {

    $pagination = webify_get_opt('blog-post-pagination');

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

      $output  = '<div class="tb-ajax-pagination">';
      $output .= '<a href="#" class="tb-btn tb-ajax-load-more tb-style12 tb-color22 w-100 '.$args['nav'].'" data-token="'. $uniqid .'">'.esc_html__('LOAD MORE ARTICLES', 'webify').'</a>';
      $output .= '</div>';

      unset( $args['query'] );
      wp_localize_script('webify-main', 'webify_load_more_' . $uniqid, $args );

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
        <div class="col-lg-12">
          <div class="empty-space marg-lg-b30 marg-sm-b15"></div>
          <div class="text-center">
            <?php echo wp_kses_post($links); ?>
          </div>
        </div>
      <?php 
      endif;
    }

  }
}

/**
 * webify Header Style
 * @since webify 1.0
*/
if(!function_exists('webify_header_style')) {
  function webify_header_style($layout) {
    switch ($layout) {
      case 'header-style16':
        get_template_part('theme/inc/header/header-style16');
        break;
      case 'header-style15':
        get_template_part('theme/inc/header/header-style15');
        break;
      case 'header-style14':
        get_template_part('theme/inc/header/header-style14');
        break;
      case 'header-style13':
        get_template_part('theme/inc/header/header-style13');
        break;
      case 'header-style12':
        get_template_part('theme/inc/header/header-style12');
        break;
      case 'header-style11':
        get_template_part('theme/inc/header/header-style11');
        break;
      case 'header-style10':
        get_template_part('theme/inc/header/header-style10');
        break;
      case 'header-style9':
        get_template_part('theme/inc/header/header-style9');
        break;
      case 'header-style8':
        get_template_part('theme/inc/header/header-style8');
        break;
      case 'header-style7':
        get_template_part('theme/inc/header/header-style7');
        break;
      case 'header-style6':
        get_template_part('theme/inc/header/header-style6');
        break;
      case 'header-style5':
        get_template_part('theme/inc/header/header-style5');
        break;
      case 'header-style4':
        get_template_part('theme/inc/header/header-style4');
        break;
      case 'header-style3':
        get_template_part('theme/inc/header/header-style3');
        break;
      case 'header-style2':
        get_template_part('theme/inc/header/header-style2');
        break;
      case 'header-style1':
      default:
        get_template_part('theme/inc/header/header-style1');
        break;
    }
  }
}

/**
 * webify_footer_style
 * @since webify 1.0
*/
if(!function_exists('webify_footer_style')) {
  function webify_footer_style($layout) {
    if(!webify_get_opt('footer-enable-switch')) { return; }
    switch ($layout) {
      case 'footer-style1':
      default:
        get_template_part('theme/inc/footer/footer-style1');
        break;
      case 'footer-style2':
        get_template_part('theme/inc/footer/footer-style2');
        break;
      case 'footer-style3':
        get_template_part('theme/inc/footer/footer-style3');
        break;
      case 'footer-style4':
        get_template_part('theme/inc/footer/footer-style4');
        break;
      case 'footer-style5':
        get_template_part('theme/inc/footer/footer-style5');
        break;
    }
  }
}

/**
 * webify Title Wrapper Style
 * @since webify 1.0
*/
if(!function_exists('webify_page_header_style')) {
  function webify_page_header_style($layout) {
    $page_header_enable = webify_get_opt('page-header-enable');
    if(!$page_header_enable && class_exists('CSF')) { return; }
    switch ($layout) {
      case 'default':
      default:
        get_template_part('theme/inc/page-header/default');
        break;
    }
  }
}

/**
 * webify Blog Single Style
 * @since webify 1.0
*/
if(!function_exists('webify_blog_single_style')) {
  function webify_blog_single_style($layout) {
    switch ($layout) {
      case 'default':
      default:
        get_template_part('theme/inc/blog/single/default');
        break;
    }
  }
}


/**
 * Return page layout
 * @param type $type
 * @return array
 */
if(!function_exists('webify_sidebar_position')) {
  function webify_sidebar_position() {
    $sidebar_details = array();
    if(is_singular('post')) {
      $sidebar_details['layout']       = webify_get_opt('blog-single-layout');
      $sidebar_details['sidebar-name'] = 'blog-sidebar';
    } elseif(class_exists('WooCommerce') && is_shop()) {
      $sidebar_details['layout']       =  webify_get_opt('shop-layout');
      $sidebar_details['sidebar-name'] = 'shop-sidebar';
    } elseif(class_exists('WooCommerce') && is_product()) {
      $sidebar_details['layout']       =  webify_get_opt('shop-single-layout');
      $sidebar_details['sidebar-name'] = 'shop-single-sidebar';
    } elseif(is_search()) {
      $sidebar_details['layout']       = webify_get_opt('search-layout');
      $sidebar_details['sidebar-name'] = 'search-sidebar';
    } elseif(is_author()) {
      $sidebar_details['layout']       = webify_get_opt('author-layout');
      $sidebar_details['sidebar-name'] = 'author-sidebar';
    } elseif(is_archive()) {
      $sidebar_details['layout']       = webify_get_opt('archive-layout');
      $sidebar_details['sidebar-name'] = 'archive-sidebar';
    } elseif(is_home()) {
      $sidebar_details['layout']       = 'right_sidebar';
      $sidebar_details['sidebar-name'] = 'page-sidebar';
    } else {
      $sidebar_details['layout']       =  webify_get_opt('page-layout');
      $sidebar_details['sidebar-name'] = 'page-sidebar';
    }
    return $sidebar_details;
  }
}

/**
 *
 * Comment Form
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!function_exists('webify_comment_form')) {
  function webify_comment_form() {
    ob_start();
    comment_form();
    $comment_form = ob_get_clean();
    $comment_form = str_replace( array( 'id="submit"', 'class="comment-form"' ), array( 'id="submit" class="tb-btn tb-style3 tb-color18"', 'class="comment-form tb-comment-form"' ), $comment_form);
    return $comment_form;
  }
}

/**
 * Load Material Icon
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('webify_material_font_icon')) {
  function webify_material_font_icon() {
    $fonts_url = '';

    $material_icons = _x( 'on', 'Material Icons: on or off', 'webify' );

    if ( 'off' !== $material_icons ) {
      $font_families = array();

      if ( 'off' !== $material_icons ) {
        $font_families[] = 'Material Icons|Material Icons Outlined';
      }
      $query_args = array('family' => urlencode( implode( '|', $font_families ) ));
      $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/icon' );
    }

    return esc_url_raw( $fonts_url );
  }
}

/**
 * Load Google Font
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('webify_fonts_url')) {
  function webify_fonts_url() {
    $fonts_url = '';

    $roboto = _x('on', 'Roboto font: on or off', 'webify');

    if ('off' !== $roboto) {
      $font_families = array();

      if ('off' !== $roboto) {
        $font_families[] = 'Roboto:300,400,500,700';
      }

      $query_args = array('family' => urlencode(implode( '|', $font_families )), 'subset' => urlencode('latin,latin-ext'));
      $fonts_url  = add_query_arg( $query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw( $fonts_url );
  }
}

/**
 * Get Image URL
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('webify_get_image_src')) {
  function webify_get_image_src($id) {
    if(empty($id)) { return ; }
    $image_src = (is_numeric($id)) ? wp_get_attachment_url($id):$id;
    return $image_src;
  }
}

/**
 * Is WOO Activated
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('is_woocommerce_activated')) {
  function is_woocommerce_activated() {
    if (class_exists('woocommerce')) { return true; } else { return false; }
  }
}
