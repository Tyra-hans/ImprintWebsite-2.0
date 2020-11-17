<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
  return;
}
$sidebar_position = webify_sidebar_position();
$col_class        = ($sidebar_position['layout'] == 'default' || empty($sidebar_position['layout'])) ? 'col-lg-3':'col-lg-6';
$label            = get_option('yith-wcqv-button-label');

?>
  
  <div class="<?php echo esc_attr($col_class); ?>">
    <div <?php wc_product_class( 'tb-shop-card tb-style2', $product ); ?>>
      <div class="tb-product-img-wrap">
        <?php 
          echo webify_woocommerce_get_product_thumbnail();
          woocommerce_show_product_loop_sale_flash();
        ?>
        <div class="tb-cart-btn">
          <?php
            /**
             * Hook: woocommerce_before_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_before_shop_loop_item' );
        
            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
          ?>
        </div>
        <?php if(webify_yith_quick_view_enabled()): ?>
          <a href="#" class="tb-quick-view-btn yith-wcqv-button tb-flex" data-product_id="<?php echo get_the_ID(); ?>"><?php echo esc_html($label); ?></a>
        <?php endif; ?> 
      </div>
      <div class="empty-space marg-lg-b15"></div>
      <div class="tb-card-text">
        <div class="tb-product-category">
          <?php echo wc_get_product_category_list($product->get_id()) ?>
        </div>
        <h2 class="tb-f16-lg tb-font-name tb-m0 tb-mt-2 tb-font-name"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
        <?php
          /**
           * Hook: woocommerce_after_shop_loop_item_title.
           *
           * @hooked woocommerce_template_loop_rating - 5
           * @hooked woocommerce_template_loop_price - 10
           */
          do_action( 'woocommerce_after_shop_loop_item_title');
        ?>
      </div>
      <div class="tb-overlay"></div>
    </div>
  </div>
