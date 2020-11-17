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
class Webify_Menu_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-menu-widget';
  }

  public function get_title() {
    return 'Menu';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('isotop');
  }

  public function get_style_depends() {
    return array('isotop', 'webify-food-menu');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  public function get_image_src($id) {
    if(empty($id)) { return ; }
    $image_src = (is_numeric($id)) ? wp_get_attachment_url($id):$id;
    return $image_src;
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
      'menu_section',
      array(
        'label' => esc_html__('Menu' , 'webify-addons')
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
        'options'     => array_flip($this->get_custom_term_values('menu-category')),
        'default'     => array(''),
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

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings();
    $cats    = $settings['cats'];
    $limit   = $settings['limit'];
    $orderby = $settings['orderby'];

    $args = array(
      'posts_per_page' => $limit,
      'meta_query'     => array(array('key' => '_thumbnail_id')),
      'orderby'        => $orderby,
      'order'          => 'ID',
      'post_type'      => 'menu',
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'menu-category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); ?>

    <div class="tb-food-menu-wrap">
      <?php 
        $terms = get_terms('menu-category', array('orderby' => 'name', 'slug' => $cats));
        if(count($terms) > 0): ?>
      <div class="tb-isotop-filter">
        <ul class="tb-mp0 tb-flex  tb-f13-lg text-center tb-food-menu">
          <?php $i = 0; foreach ($terms as $term): ?>
            <li class="<?php echo ($i == 0) ? 'active':'not-active'; ?>"><a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
          <?php $i++; endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
      <div class="tb-isotop tb-food-list tb-style1 tb-border tb-radious-5">
        <div class="tb-grid-sizer"></div>
        <?php 
          while ($the_query -> have_posts()) : $the_query -> the_post(); 
            $food_status = webify_get_post_opt('food-status');
            $food_price  = webify_get_post_opt('food-price');
            $terms       = wp_get_post_terms(get_the_ID(), 'menu-category');
            $term_slugs  = array();
            if (count($terms) > 0):
              foreach ($terms as $term):
                $term_slugs[] = $term->slug;
              endforeach;
            endif; 
        ?>
          <div class="tb-isotop-item <?php echo implode(' ', $term_slugs); ?>">
            <div class="tb-food-list-in">
              <div class="tb-food-desc">
                <?php the_post_thumbnail('webify-square-thumb-big', array('class' => 'tb-radious-50')); ?>
                <div class="empty-space marg-lg-b10"></div>
                <h3 class=" tb-f18-lg tb-mb-2 tb-mt2">
                  <?php the_title(); ?>
                  <?php if(!empty($food_status)): ?>
                    <span class="tb-food-status tb-white-c tb-f10-lg"><?php echo esc_html($food_status); ?></span></h3>
                  <?php endif; ?>
                </h3>
                <div class="empty-space marg-lg-b10"></div>
                <div class="tb-f16-lg tb-line1-6"><?php the_content(); ?></div>
              </div>
              <?php if(!empty($food_price)): ?>
                <h3 class="tb-food-price  tb-f18-lg tb-font-name tb-mt14-lg"><?php echo esc_html($food_price); ?></h3>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>

      </div>
    </div><!-- .tb-tabs -->

    <?php
    
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Menu_Widget() );