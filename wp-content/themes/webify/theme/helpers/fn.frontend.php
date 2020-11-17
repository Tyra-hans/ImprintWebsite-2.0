<?php
/**
 * Frontend Functions
 *
 * @package webify
 * @since 1.0
*/

/*
 * Theme Loader
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
if(!function_exists('webify_loader')) {
  function webify_loader($loader_field = '', $default_url = '') {
    if(!webify_get_opt('preloader')) { return; } 
    $logo = webify_get_opt($loader_field);
    $logo_url = (is_array($logo) && !empty($logo['url'])) ? $logo['url']:$default_url;
  ?>
    <div class="tb-preloader">
      <div class="tb-preloader-in"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr('loader-logo'); ?>"></div>
    </div>
  <?php
  }
}

/**
 * Main Menu
 *
 * @since webify 1.0
*/
if(!function_exists('webify_main_menu')) {
  function webify_main_menu($class = '', $menu_id = 'nav', $nav_menu = 'primary-menu') {
    if ( function_exists('wp_nav_menu') && has_nav_menu( $nav_menu ) ) {
      wp_nav_menu(array(
        'theme_location' => $nav_menu,
        'container'      => false,
        'menu_id'        => $menu_id,
        'menu'           => 'primary-menu',
        'menu_class'     => $class,
        'walker'         => new Webify_Menu_Widget_Walker_Nav_Menu()
      ));
    }
  }
}

/**
 * Theme logo
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
*/
 if( !function_exists('webify_logo')) {
  function webify_logo($logo_id = '', $default_url = '', $class = '') {
    $logo = webify_get_opt($logo_id);

    if(is_array($logo) && !empty($logo['url'])) {
      $logo_url    = $logo['url'];
      $logo_height = $logo['height'];
    } else {
      $logo_url    = $default_url;
      $logo_height = '';
    }

    $style = (!empty($logo_height)) ? ' style="max-height:'.($logo_height / 2).'px;"':'';

    if(!empty($logo_url)):
      echo '<a href="'.esc_url(home_url('/')).'" class="tb-custom-logo-link '.$class.'"><img src="'.esc_url($logo_url).'" '.$style.' alt="'.esc_attr('logo', 'webify').'" class="tb-custom-logo"></a>';
    endif;
  }
}


/**
 *
 * Social Share
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('webify_social_share')) {
  function webify_social_share() {
    global $post;
    if(!webify_get_opt('blog-single-social-share')) { return; }
    $pinterest_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'webify-big-alt' );
  ?>

    <div class="tb-share tb-style1 text-center">
      <ul class="tb-share-list tb-white-c tb-mp0">
        <li><a class="tb-facebook tb-flex" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a class="tb-twitter tb-flex" href="https://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a class="tb-pinterest tb-flex" href="https://pinterest.com/pin/create/button/?url=&amp;media=<?php echo esc_url($pinterest_image[0]); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
        <li><a class="tb-google tb-flex" href="https://plus.google.com/share?url=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
        <li><a class="tb-reddit tb-flex" href="http://www.reddit.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;title="><i class="fa fa-reddit-alien" aria-hidden="true"></i></a></li>
        <li><a class="tb-mail tb-flex" href="http://digg.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;title="><i class="fa fa-digg" aria-hidden="true"></i></a></li>
      </ul>
    </div>
    <?php     
  }
}

/**
 *
 * Social Icons
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('webify_social_icons')) {
  function webify_social_icons($part, $class = '') {
    switch ($part) {
      case 'header':
      default: 
      $header_social_icon = webify_get_opt('header-social-icons');
      if(!empty($header_social_icon) && is_array($header_social_icon)):
    ?>
      <ul class="tb-header-social-btn <?php echo esc_attr($class); ?> tb-mp0 tb-flex">
        <?php foreach($header_social_icon as $icon): ?>
          <li><a href="<?php echo esc_url($icon['url']); ?>"><i class="<?php echo esc_attr($icon['icon']); ?>"></i></a></li>
        <?php endforeach; ?>
      </ul>
      <?php 
      endif;
        break;
      
      case 'footer':
      $footer_social_icon = webify_get_opt('footer-social-icons');
      if(!empty($footer_social_icon) && is_array($footer_social_icon)):
      ?>
        <div class="tb-footer-social-btn tb-style1 <?php echo esc_attr($class); ?> tb-flex-align-center">
          <?php foreach($footer_social_icon as $icon): ?>
            <a href="<?php echo esc_url($icon['url']); ?>"><i class="<?php echo esc_attr($icon['icon']); ?>"></i></a>
          <?php endforeach; ?>
        </div>
      <?php
      endif;
        # code...
        break;

      case 'profile': 
        $profile_social_icons = get_user_meta(get_current_user_id(), 'profile_social', true);
        if(!empty($profile_social_icons) && is_array($profile_social_icons)):
      ?>
        <ul class="tb-author-social <?php echo esc_attr($class); ?> tb-mp0 tb-mt-5 tb-f14-lg tb-grayb5b5b5-c">
          <?php foreach($profile_social_icons as $icon): ?>
            <li><a href="<?php echo esc_url($icon['url']); ?>"><i class="<?php echo esc_attr($icon['icon']); ?>"></i></a></li>
          <?php endforeach; ?>
        </ul>
        <?php
        endif;
        # code...
        break;

    }    
  }
}

/**
 *
 * Get the Page Title
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('webify_get_the_title')) {
  function webify_get_the_title() {

    $title = '';

    if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()):
      if (apply_filters( 'woocommerce_show_page_title', true )):
        $title = woocommerce_page_title(false);
      endif;
    elseif( is_home() && !is_singular('page') ) :
      $title = esc_html__('Blog','webify');

    elseif(is_singular('product')):
      $title = esc_html__('Shop', 'webify');
    
    elseif( is_singular() ) :
      $title = get_the_title();

    elseif( is_search() ) :
      global $wp_query;
      $total_results = $wp_query->found_posts;
      $prefix = '';

      if( $total_results == 1 ){
        $prefix = '1 '.esc_html__('Search result for', 'webify');
      }
      else if( $total_results > 1 ) {
        $prefix = $total_results . ' ' . esc_html__('Search result for', 'webify');
      }
      else {
        $prefix = esc_html__('Search result for', 'webify');
      }
      $title = $prefix . ': ' . get_search_query();

    elseif ( is_category() ) :
      $title = single_cat_title('', false);

    elseif ( is_tag() ) :
      $title = single_tag_title('', false);

    elseif ( is_author() ) :
      $title = wp_kses_post(sprintf( __( 'Author: %s', 'webify' ), '<span class="vcard">' . get_the_author() . '</span>' ));

    elseif ( is_day() ) :
      $title = wp_kses_post(sprintf( __( 'Day: %s', 'webify' ), '<span>' . get_the_date() . '</span>' ));

    elseif ( is_month() ) :
      $title = wp_kses_post(sprintf( __( 'Month: %s', 'webify' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'webify' ) ) . '</span>' ));

    elseif ( is_year() ) :
      $title = wp_kses_post(sprintf( __( 'Year: %s', 'webify' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'webify' ) ) . '</span>' ));

    elseif( is_tax() ) :
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      $title = $term->name;

    elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
      $title = esc_html__( 'Asides', 'webify' );

    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
      $title = esc_html__( 'Galleries', 'webify');

    elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
      $title = esc_html__( 'Images', 'webify');

    elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
      $title = esc_html__( 'Videos', 'webify' );

    elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
      $title = esc_html__( 'Quotes', 'webify' );

    elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
      $title = esc_html__( 'Links', 'webify' );

    elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
      $title = esc_html__( 'Statuses', 'webify' );

    elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
      $title = esc_html__( 'Audios', 'webify' );

    elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
      $title = esc_html__( 'Chats', 'webify' );

    elseif( is_404() ) :
      $title = esc_html__( '404', 'webify' );

    else :
      $title = esc_html__( 'Archives', 'webify' );
    endif;

    return $title;
  }
}

/**
 * Get Social Icons links
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('webify_post_author_details')) {
  function webify_post_author_details() {
    if(!is_single() || !is_author()) { return; }
    global $post;
    $curauth = get_userdata($post->post_author);
    if(!empty($curauth->description)): ?>

      <div class="tb-author tb-border tb-radious-4">
        <a class="tb-author-img tb-radious-50" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">
          <?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
        </a>
        <div class="tb-author-info">
          <a class="tb-author-title tb-f14-lg  tb-black111-c tb-fw-medium" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a>
          <div class="marg-lg-b5"></div>
          <div class="tb-f13-lg tb-line1-6">
            <p><?php echo get_the_author_meta('description'); ?></p>
          </div>
          <?php webify_social_icons('profile'); ?>

        </div>
      </div>
      <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
    <?php endif;
  }
}

/**
 *
 * Related Post
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('webify_related_post')) {
  function webify_related_post($style = 'style1') {
    wp_enqueue_style('webify-post');
    if(!webify_get_opt('blog-single-related-post')) { return; }
    global $post;
    $tags = wp_get_post_tags($post->ID);

    if(!empty($tags) && is_array($tags)):
      $simlar_tag = $tags[0]->term_id;
    ?>

    <?php
      $args = array(
        'tag__in'             => array($simlar_tag),
        'post__not_in'        => array($post->ID),
        'posts_per_page'      => 3,
        'meta_query'          => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS')),
        'ignore_sticky_posts' => 1,
      );
      $re_query = new WP_Query($args);
      if($re_query->have_posts()):
        switch ($style) {
          case 'style1':
          default: ?>
            <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
            <div class="tb-section-heading tb-style6 tb-overflow-hidden tb-mt-5">
              <h2 class="tb-f16-lg tb-m0">You Might also Like</h2>
              <div class="empty-space marg-lg-b25"></div>
            </div>
            <div class="row">

              <?php 
                while ($re_query->have_posts()) : $re_query->the_post(); 
                  $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
              ?>
                <div <?php post_class('col-lg-4'); ?>>
                  <div class="tb-post tb-style5 tb-small-post">
                    <div class="tb-zoom">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($img_src[0]); ?>);"></a>
                    </div>
                    <div class="tb-post-info">
                      <div class="tb-catagory tb-style1">
                        <?php echo get_the_category_list(); ?>
                      </div>
                      <div class="empty-space marg-lg-b5"></div>
                      <h2 class="tb-post-title tb-f16-lg  tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                    </div>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>

            </div>
            
            <?php
            break;
          
          case 'style2': ?>
            <div class="tb-shortcode-1">


              <div class="tb-title-block">
                <h3 class="tb-title-text"><?php echo esc_html__('Related Stories', 'webify'); ?></h3>
                <span class="tb-shortcode-1-close"></span>
              </div>

              <div class="container">
                <div class="row">

                <?php while ($re_query->have_posts()) : $re_query->the_post(); ?>
                  <div <?php post_class('col-md-3 col-sm-6'); ?>>


                    <div class="tb-post type-7 clearfix">
                      <?php the_post_thumbnail('webify-small-alt'); ?>
                      <div class="tb-post-info">
                        <a class="tb-post-title c-h6" href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?> </a>
                      </div>
                    </div> 


                  </div>
                <?php endwhile; wp_reset_postdata(); ?>


                </div>
              </div>  


            </div>
            <?php
            break;
        }
      endif;
    endif;
  }
}


/**
 * Post Navigation
 * @param type $type
 * @return array
 */
if(!function_exists('webify_post_navigation')) {
  function webify_post_navigation() { 

    $previous_post       = get_previous_post();
    $prev_thumbnail      = (is_object($previous_post) && !empty($previous_post)) ? get_the_post_thumbnail($previous_post->ID):'';
    $next_post           = get_next_post();
    $next_post_thumbnail = (is_object($next_post) && !empty($next_post)) ? get_the_post_thumbnail($next_post->ID):'';
    $col_class           = ($previous_post && $next_post) ? 'col-sm-6':'col-sm-12';
    if($previous_post || $next_post):
  ?>
    <!-- <div class="empty-space marg-lg-b30 marg-sm-b30"></div> -->
    <div class="row">

      <?php if ($previous_post): ?>
      <div class="<?php echo esc_attr($col_class); ?>">
        <div class="tb-blog-nav tb-left <?php echo (empty($prev_thumbnail)) ? 'no-thumb':''; ?>">
          <?php if(!empty($prev_thumbnail)): ?>
            <div class="tb-blog-nav-image tb-prev-post-img">
              <?php echo wp_kses_post($prev_thumbnail); ?>
            </div>
          <?php endif; ?>
          <div class="tb-blog-nav-in">
            <div class="tb-blog-nav-label text-uppercase tb-f12-lg tb-grayb5b5b5-c tb-line1-3 tb-mb8">Previous Article</div>
            <h3 class="tb-f16-lg tb-m0"><?php previous_post_link('%link', '%title'); ?></h3>
          </div>
        </div>
        <div class="empty-space marg-xs-b20"></div>
      </div>
      <?php endif; ?>
      <?php if ($next_post): ?>
      <div class="<?php echo esc_attr($col_class); ?>">
        <div class="tb-blog-nav tb-right <?php echo (empty($next_post_thumbnail)) ? 'no-thumb':''; ?>">
          <?php if(!empty($next_post_thumbnail)): ?>
            <div class="tb-blog-nav-image tb-next-post-img">
             <?php echo wp_kses_post($next_post_thumbnail); ?>
            </div>
          <?php endif; ?>
          <div class="tb-blog-nav-in">
            <div class="tb-blog-nav-label text-uppercase tb-f12-lg tb-grayb5b5b5-c tb-line1-3 tb-mb8">Next Article</div>
            <h3 class="tb-f16-lg tb-m0"><?php next_post_link('%link', '%title'); ?></h3>
          </div>
        </div>
      </div>
      <?php endif; ?>


    </div>
    

  <?php endif;
  }
}

/**
 * Get Social Icons links
 *
 * @param type $terms
 * @return boolean
*/
if(!function_exists('webify_accent_css')) {
  function webify_accent_css() {
    $output = '';
    $error_bg_image = webify_get_opt('error-page-bg');
    $error_bg_image = (isset($error_bg_image['url']) && !empty($error_bg_image['url'])) ? '':get_theme_file_uri('assets/img/error-bg.jpg');
    if(!empty($error_bg_image)):
      $output .= '.tb-error-page {';
      $output .= 'background-image:url('.$error_bg_image.');';
      $output .= '}';
    endif;
    $page_header_bg = webify_get_opt('page-header-bg');
    $page_header_bg = (isset($page_header_bg['url']) && !empty($page_header_bg['url'])) ? '':get_theme_file_uri('assets/img/page-header-bg.png');
    if(!empty($page_header_bg)):
      $output .= '.tb-page-header {';
      $output .= 'background-image:url('.$page_header_bg.');';
      $output .= '}';
    endif;
    return $output;
  }
}

/**
 * webify_top_margin
 *
 * @param type $terms
 * @return boolean
*/
if(!function_exists('webify_top_margin')) {
  function webify_top_margin($default) {
    $page_top_margin    = webify_get_opt('page-top-margin');
    if($page_top_margin == 'no-margin') { return; }
    $page_top_margin    = (empty($page_top_margin) || !class_exists('CSF')) ? $default:$page_top_margin;
    $output = '<div class="marg-lg-b'.$page_top_margin.' marg-md-b'.(int)($page_top_margin / 2).'"></div>';
    return $output;
  }
}

/**
 * webify_bottom_margin
 *
 * @param type $terms
 * @return boolean
*/
if(!function_exists('webify_bottom_margin')) {
  function webify_bottom_margin($default) {
    $page_bottom_margin    = webify_get_opt('page-bottom-margin');
    if($page_bottom_margin == 'no-margin') { return; }
    $page_bottom_margin    = (empty($page_bottom_margin) || !class_exists('CSF')) ? $default:$page_bottom_margin;
    $output = '<div class="marg-lg-b'.$page_bottom_margin.' marg-md-b'.(int)($page_bottom_margin / 2).'"></div>';
    return $output;
  }
}

/**
 * Footer Columns
 * @param type $type
 * @return array
*/
if(!function_exists('webify_footer_columns')) {
  function webify_footer_columns() { 
    $footer_columns = class_exists('CSF') ? webify_get_opt('footer-column'):4;
    switch ($footer_columns) {
      case '1':
        $col_class = 'col-md-12 col-sm-12';
        break;
      case '2':
        $col_class = 'col-md-6 col-sm-6';
        break;
      case '3':
        $col_class = 'col-md-4 col-sm-6';
        break;
      case '4':
      default:
        $col_class = 'col-md-3 col-sm-6';
        break;
    }
    for($i = 1; $i < $footer_columns + 1; $i++) { ?>
      <div class="<?php echo esc_attr($col_class); ?>">
        <?php if (is_active_sidebar( webify_get_custom_sidebar('footer-'.$i, 'footer-sidebar-'.$i) )): ?>
          <?php dynamic_sidebar( webify_get_custom_sidebar('footer-'.$i, 'footer-sidebar-'.$i) ); ?>
        <?php endif; ?>
      </div>
    <?php }
  }
}


if(!function_exists('webify_footer_cta')) {
  function webify_footer_cta($btn_class = 'tb-color1', $heading_class = 'tb-white-c6') {

    $enable_footer_cta = webify_get_opt('footer-enable-cta');
    if(!$enable_footer_cta) { return; }
    wp_enqueue_style('webify-cta');
    wp_enqueue_style('webify-button');
?>  
    <hr>
    <div class="empty-space marg-lg-b40 marg-sm-b40"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="tb-cta tb-style1">
            <div class="tb-cta-left">
              <h2 class="tb-f18-lg tb-font-name <?php echo esc_attr($heading_class); ?> tb-m0"><?php echo esc_html(webify_get_opt('footer-cta-heading')); ?></h2>
              <div class="empty-space marg-lg-b0 marg-sm-b30"></div>
            </div>
            <div class="tb-cta-right">
              <a href="<?php echo esc_url(webify_get_opt('footer-cta-btn-link')); ?>" class="tb-btn tb-style3 <?php echo esc_html(webify_get_opt('footer-cta-btn-style')); ?> tb-cta-btn <?php echo esc_attr($btn_class); ?>"><span><?php echo esc_html(webify_get_opt('footer-cta-btn-text')); ?></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="empty-space marg-lg-b40 marg-sm-b40"></div>
    <hr>
  <?php

  }
}


if(!function_exists('webify_post_up_down_vote')) {
  function webify_post_up_down_vote($post_id) { 
    $post_vote_enable = webify_get_opt('blog-single-post-vote');
    if(empty($post_id) || !$post_vote_enable) { return; }
    $vote_count = get_post_meta($post_id, '_vote_count', true);
    $vote_count = (!empty( $vote_count)) ? $vote_count : 0;
    $is_up      = (isset($_COOKIE['webify_vote_'.$post_id])) ? trim(str_replace($post_id, '', $_COOKIE['webify_vote_'.$post_id])):'';

  ?>
    <div class="tb-votes tb-style1" data-post-id="<?php echo esc_attr($post_id); ?>">
      <a href="#" class="tb-vote-btn tb-up-vote-btn <?php echo ($is_up == 'true') ? 'voted':''; ?> tb-border tb-radious-4 tb-black111-c tb-f2f2f2-bg tb-flex tb-f30-lg"><i class="fa fa-caret-up"></i></a>
      <div class="tb-count-vote tb-f21-lg  tb-black111-c tb-flex">
        <span class="tb-count-no"><?php echo esc_html($vote_count); ?></span>
        <span class="text-center tb-grayb5b5b5-c tb-fw-regular tb-f14-lg tb-mt4 tb-line1-1">Points</span>
      </div>
      <a href="#" class="tb-vote-btn tb-down-vote-btn <?php echo ($is_up == 'false') ? 'voted':''; ?> tb-border tb-radious-4 tb-black111-c tb-f2f2f2-bg tb-flex tb-f30-lg"><i class="fa fa-caret-down"></i></a>
    </div>
    <div class="empty-space marg-lg-b60 marg-sm-b60"></div>

    <hr>
    <div class="empty-space marg-lg-b60 marg-sm-b60"></div>

  <?php
    
  }
}

if(!function_exists('webify_post_newsletter')) {
  function webify_post_newsletter() { 
    $newsletter         = webify_get_opt('blog-single-newsletter');
    $newsletter_image   = webify_get_opt('blog-single-newsletter-image');
    $newsletter_heading = webify_get_opt('blog-single-newsletter-heading');
    $newsletter_content = webify_get_opt('blog-single-newsletter-content');
    if(!$newsletter && isset($newsletter)) { return; }
  ?>
    <div class="tb-banner tb-style1 tb-relative tb-radious-4 tb-ping-gray-bg">
      <?php if(is_array($newsletter_image) && !empty($newsletter_image['url'])): ?>
        <img class="tb-banner-img" src="<?php echo esc_url($newsletter_image['url']); ?>" alt="<?php echo esc_attr('img', 'webify'); ?>">
      <?php endif; ?>
      <div class="tb-banner-info">
        <h4 class="tb-banner-title tb-f20-lg tb-m0 tb-mt-4 tb-line1-1"><?php echo esc_html($newsletter_heading); ?></h4>
        <div class="tb-simple-text tb-f13-lg"><?php echo esc_html($newsletter_content); ?></div>
        <div class="empty-space marg-lg-b15"></div>
        <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="tb-newsletter tb-style5">
          <div class="tb-form-field">
            <input type="text" name="ne" required="" placeholder="<?php echo esc_attr('Email', 'webify'); ?>">
          </div>
          <div class="tb-btn tb-style3 tb-color2">
            <input type="submit" class="tb-newsletter-submit newsletter-submit" value="<?php echo esc_attr('Subscribe', 'webify'); ?>">
          </div>
        </form>
      </div>
    </div>
    <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
  <?php
  }
}

if(!function_exists('webify_video_popup')) {
  function webify_video_popup() { ?>
    <!-- Start Video Popup -->
    <div class="tb-video-popup">
      <div class="tb-video-popup-overlay"></div>
      <div class="tb-video-popup-content">
        <div class="tb-video-popup-layer"></div>
        <div class="tb-video-popup-container">
          <div class="tb-video-popup-align">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="about:blank"></iframe>
            </div>
          </div>
          <div class="tb-video-popup-close"></div>
        </div>
      </div>
    </div>
    <!-- End Video Popup -->
  <?php
  }
}

if(!function_exists('webify_product_search_form')) {
  function webify_product_search_form() { ?>
    <div class="tb-search-modal">
      <div class="tb-search-modal-in">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="tb-product-search-form">
          <span class="tb-search-modal-cross"></span>
          <div class="tb-product-search-title"><?php echo esc_html__('WHAT ARE YOU LOOKING FOR ?', 'webify'); ?></div>
          <input class="tb-product-search-input" name="s" type="text" placeholder="<?php echo esc_attr('Search Products...', 'webify'); ?>">
          <button type="submit" class="tb-product-searc-btn"><i class="fa fa-search"></i></button>
          <input type="hidden" name="post_type" value="product" />
        </form>
      </div>
      <div class="tb-search-modal-overlay"></div>
    </div>
  <?php
  }
}

if(!function_exists('webify_scroll_top')) {
  function webify_scroll_top() { 
    $footer_scroll_top = webify_get_opt('footer-scroll-top');
    if(!$footer_scroll_top) { return; }
  ?>
    <div id="tb-scrollup"><i class="fa fa-angle-up"></i></div>
  <?php
  }
}
