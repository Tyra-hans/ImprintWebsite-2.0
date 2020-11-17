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
class Webify_Portfolio_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-portfolio-slider-widget';
  }

  public function get_title() {
    return 'Portfolio Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-slider', 'webify-image-box');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  public function get_custom_term_values($type) {
    $items = array();
    $terms = get_terms($type, array('orderby' => 'name'));
    if (is_array($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        $items[$term ->name] = $term->slug;
      }
    }
    return $items;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'portfolio_slider_section',
      array(
        'label' => esc_html__('Portfolio Slider' , 'webify-addons')
      )
    );

    $this->add_control(
      'cats',
      array(
        'label'       => esc_html__('Categories', 'webify-addons'),
        'description' => esc_html__('Specifies a category that you want to show posts from it.', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'label_block' => true,
        'options'     => array_flip($this->get_custom_term_values('portfolio-category')),
        'default'     => array(''),
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 8,
      )
    );

    $this->add_control(
      'orderby',
      array(
        'label'       => esc_html__( 'Order By', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'ID',
        'options'     => array_flip(array(
          'ID'            => 'ID',
          'Author'        => 'author',
          'Post Title'    => 'title',
          'Date'          => 'date',
          'Last Modified' => 'modified',
          'Random Order'  => 'rand',
          'Comment Count' => 'comment_count',
          'Menu Order'    => 'menu_order',
        )),
        'label_block' => true,
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label'     => esc_html__('Autoplay', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'separator' => 'before'
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => esc_html__('Loop', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'separator' => 'before',
        'default'   => 'yes'
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'     => esc_html__('Speed', 'webify-addons'),
        'type'      => Controls_Manager::TEXT,
        'separator' => 'before',
        'default'   => 600
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings = $this->get_settings_for_display();
    $cats     = $settings['cats'];
    $limit    = $settings['limit'];
    $orderby  = $settings['orderby'];
    $autoplay = $settings['autoplay'];
    $loop     = $settings['loop'];
    $speed    = $settings['speed'];
    $loop     = ($loop == 'yes') ? 1:0;
    $autoplay = ($autoplay == 'yes') ? 1:0;

    $args = array(
      'posts_per_page' => $limit,
      'meta_query'     => array(array('key' => '_thumbnail_id')),
      'orderby'        => $orderby,
      'order'          => 'ID',
      'post_type'      => 'portfolio',
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'portfolio-category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); ?>

    <div class="tb-full-widh-slider-padding">
      <div class="tb-overflow-hidden">
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
              <div class="slick-wrapper">

                <?php 
                  while ($the_query -> have_posts()) : $the_query -> the_post(); 
                  $terms = wp_get_post_terms(get_the_ID(), 'portfolio-category');
                  $term_names = array();
                  if (count($terms) > 0):
                    foreach ($terms as $term):
                      $term_names[] = $term->name;
                    endforeach;
                  endif;                

                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');

                ?>
                  <div class="slick-slide">
                    <div class="tb-slick-inner-pad">
                      <div class="tb-image-box tb-style1 tb-zoom tb-radious-4 tb-relative wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.65s">
                        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-link-wrap"></a>
                        <div class="tb-image tb-overflow-hidden tb-radious-4">
                          <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></div>
                        </div>
                        <div class="tb-image-meta text-center">
                          <div class="empty-space marg-lg-b20"></div>
                          <h3 class="tb-f18-lg tb-font-name tb-font-name tb-mt-3 tb-m0"><?php the_title(); ?></h3>
                          <div class="tb-mb-3 tb-mt-2"><?php echo implode(' ', $term_names); ?></div>
                        </div>
                      </div>
                    </div>
                  </div><!-- .slick-slide -->
                <?php endwhile; wp_reset_postdata(); ?>
                
              </div>
            </div><!-- .slick-container -->
          </div>
          <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
          <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
            <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
          </div>
        </div><!-- .tb-carousor -->
      </div>
    </div>

  <?php

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Portfolio_Slider_Widget() );