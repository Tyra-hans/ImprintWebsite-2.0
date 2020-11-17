<?php

/**
* WP Core doens't let us change the sort direction for invidual orderby params - http://core.trac.wordpress.org/ticket/17065
*
* This lets us sort by meta value desc, and have a second orderby param.
*
* @param array $args
* @return array
*/

if(!function_exists('webify_yith_quick_view_enabled')) {
  function webify_yith_quick_view_enabled() {
    return defined('YITH_WCQV');
  }
}

if(!function_exists('webify_woocommerce_order_by_popularity_post_clauses')) {
  function webify_woocommerce_order_by_popularity_post_clauses($args) {
    global $wpdb;
    $args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";
    return $args;
  }
}

/**
* order_by_rating_post_clauses function.
*
* @param array $args
* @return array
*/
if(!function_exists('webify_woocommerce_order_by_rating_post_clauses')) {
  function webify_woocommerce_order_by_rating_post_clauses($args) {
    global $wpdb;

    $args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";
    $args['where']  .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";
    $args['join']   .= "
      LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
      LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
    ";
    $args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";
    $args['groupby'] = "$wpdb->posts.ID";

    return $args;
  }
}

if (!function_exists('webify_woocommerce_top_bar_ajax')) {
  function webify_woocommerce_top_bar_ajax($fragments) {
    global $woocommerce;

    $fragments['.tb-card-number'] = '<span class="tb-card-number">'. $woocommerce->cart->cart_contents_count .'</span>';

    return $fragments;
  }
  add_filter('woocommerce_add_to_cart_fragments', 'webify_woocommerce_top_bar_ajax');
}

if (!function_exists( 'webify_woocommerce_get_product_thumbnail')) {
  function webify_woocommerce_get_product_thumbnail($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0) {

    wp_enqueue_style('webify-shop-card');
    global $post, $product, $woocommerce;
    $image_ids = $product->get_gallery_image_ids();

    $output = '';

    if (has_post_thumbnail()) {

      $image_url = webify_get_image_src(get_post_thumbnail_id($post->ID));


      $output .= '<div class="tb-product-img">';

      $output .= '<div class="tb-before-hover tb-bg" style="background-image: url('.esc_url($image_url).');"></div>';

      if(!empty($image_ids)) {
        $secondary_image_id = $image_ids['0'];
        $secondary_image_url = webify_get_image_src($secondary_image_id);
        $output .= '<div class="tb-after-hover tb-bg" style="background-image: url('.esc_url($secondary_image_url).');"></div>';
      }
      
      $output .= (!$product->is_in_stock() ) ? '<span class="out-of-stock">'. esc_html__('Out of stock', 'webify') .'</span>' : '';


      $output .= '</div>';

    } elseif (wc_placeholder_img_src()) {

      $output .= '<div class="tb-product-img">';
      $output .= wc_placeholder_img($size);
      $output .= '</div>';

    }

    return $output;

  }
}

if(!function_exists('webify_wc_newsletter')) {
  function webify_wc_newsletter() { 
    $shop_newsletter       = webify_get_opt('shop-newsletter');
    if(!$shop_newsletter) { return; }
    $shop_newsletter_image = webify_get_opt('shop-newsletter-image');
    wp_enqueue_style('webify-newsletter');
    wp_enqueue_style('webify-button');
  ?>
    <div class="tb-ping-gray-bg">
      <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
              <?php if(is_array($shop_newsletter_image) && !empty($shop_newsletter_image)): ?>
                <img src="<?php echo esc_url($shop_newsletter_image['url']); ?>" alt="<?php echo esc_attr('newsletter-image', 'webify'); ?>">
              <?php endif; ?>
              <div class="empty-space marg-lg-b20"></div>
              <h2 class="tb-f32-lg tb-f25-sm  tb-mt-6 tb-mt-4-sm tb-mb2 tb-font-name"><?php echo esc_html(webify_get_opt('shop-newsletter-heading')); ?></h2>
              <div class="tb-f16-lg tb-mb-6"><?php echo esc_html(webify_get_opt('shop-newsletter-sub-heading')); ?></div>
              <div class="empty-space marg-lg-b25"></div>
            </div>
            <form method="post" action="<?php echo esc_url(home_url('/')); ?>?na=s" onsubmit="return newsletter_check(this)" class="tb-newsletter tb-style3">
              <div class="tb-form-field tb-f16-lg">
                <input type="email" type="email" name="ne" required="" placeholder="<?php echo esc_attr('Your Email', 'webify'); ?>">
              </div>
              <div class="empty-space marg-lg-b15"></div>
              <div class="tb-btn tb-style3 <?php echo esc_html(webify_get_opt('shop-newsletter-btn-style')); ?> tb-color2 w-100">
                <input type="submit" class="newsletter-submit" value="<?php echo esc_attr('Subscribe Today', 'webify'); ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="empty-space marg-lg-b60 marg-sm-b60"></div>
    </div>
  <?php
  }
  add_action('woocommerce_single_newsletter', 'webify_wc_newsletter');
}

if(!function_exists('webify_remove_yith_quick_button')) {
  function webify_remove_yith_quick_button() {
    return false;
  }
  add_filter('yith_wcqv_show_quick_view_button', 'webify_remove_yith_quick_button');
}

add_filter('woocommerce_enqueue_styles',                '__return_false' );
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_after_shop_loop_item_title',    'woocommerce_template_loop_price', 11);
add_action('woocommerce_after_shop_loop_item_title',    'woocommerce_template_loop_rating', 12);
