<?php 
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Product_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-product-slider-widget';
  }

  public function get_title() {
    return 'Product Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-shop-card', 'webify-slider');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  public function get_image_src($id) {
    if(empty($id)) { return ; }
    $image_src = (is_numeric($id)) ? wp_get_attachment_url($id):$id;
    return $image_src;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'product_slider_section',
      array(
        'label' => esc_html__('Product Slider' , 'webify-addons')
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 6,
      )
    );

    $this->add_control(
      'orderby',
      array(
        'label'       => esc_html__( 'Order By', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'title',
        'options'     => array_flip(array(
          'Random'     => 'rand',
          'Post Title' => 'title',
          'Date'       => 'date',
          'Rating'     => 'rating',
          'Price'      => 'price',
          'Popularity' => 'popularity',
        )),
        'label_block' => true,
      )
    );

    $this->add_control(
      'order',
      array(
        'label'       => esc_html__('Order', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'ASC',
        'options'     => array_flip(array(
          'ASC'  => 'ASC',
          'DESC' => 'DESC',
        )),
        'label_block' => true,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    global $wpdb, $product;

    $settings = $this->get_settings();
    $limit    = $settings['limit'];
    $orderby  = $settings['orderby'];
    $order    = $settings['order'];
    $label    = get_option('yith-wcqv-button-label');

    $args = array(
      'posts_per_page' => intval($limit) ? intval($limit) : 6,
      'offset'         => 0,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'meta_key'       => '',
      'meta_value'     => '',
      'post_type'      => 'product',
      'post_mime_type' => '',
      'post_parent'    => '',
      'paged'          => 1,
      'post_status'    => 'publish',
    );

    $args['meta_query']   = array();
    $args['meta_query'][] = WC()->query->stock_status_meta_query();
    $args['meta_query']   = array_filter($args['meta_query']);

    switch ($orderby) {
      case 'rand' :
        $args['orderby']  = 'rand';
      break;
      case 'date' :
        $args['orderby']  = 'date';
        $args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
      break;
      case 'price' :
        $args['orderby']  = 'meta_value_num {$wpdb->posts}.ID';
        $args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
        $args['meta_key'] = '_price';
      break;
      case 'popularity' :
        $args['meta_key'] = 'total_sales';

        add_filter( 'posts_clauses', 'webify_woocommerce_order_by_popularity_post_clauses'  );
      break;
      case 'rating' :
        add_filter( 'posts_clauses', 'webify_woocommerce_order_by_rating_post_clauses'  );
      break;
      case 'title' :
        $args['orderby']  = 'title';
        $args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
      break;
    }
    
    $shop = new \WP_Query($args); 

    if($shop->have_posts()):
  ?>

    <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
      <div class="tb-overflow-hidden">
        <div class="tb-slick-inner-pad-wrap">
          <div class="slick-container" data-delay="5000" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
            <div class="slick-wrapper">
              <?php while ($shop -> have_posts()) :  $shop -> the_post(); ?>
                <div <?php post_class('slick-slide'); ?>>
                  <div class="tb-slick-inner-pad">
                    <div class="tb-shop-card tb-style2">
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
                          <?php echo wc_get_product_category_list(get_the_ID()) ?>
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
                </div><!-- .slick-slide -->
              <?php endwhile; wp_reset_postdata(); ?>
            </div>
          </div><!-- .slick-container -->
        </div>
      </div>
      <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
      <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
        <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
        <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
      </div>
    </div><!-- .tb-carousor -->
  <?php endif;
    remove_filter('posts_clauses', 'webify_woocommerce_order_by_popularity_post_clauses');
    remove_filter('posts_clauses', 'webify_woocommerce_order_by_rating_post_clauses');
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Product_Slider_Widget() );