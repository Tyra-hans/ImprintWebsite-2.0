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
class Webify_Portfolio_Section_Scroll_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-portfolio-section-scroll-widget';
  }

  public function get_title() {
    return 'Portfolio Section Scroll';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('scrollify', 'anime');
  }

  public function get_style_depends() {
    return array('webify-scroll-section', 'webify-button');
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
      'portfolio_scroll_section',
      array(
        'label' => esc_html__('Portfolio Section Scroll' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
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

    $this->start_controls_section('section_style_shape_color',
      array(
        'label' => esc_html__('Shape', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('shape_fill_color', 
      array(
        'label'       => esc_html__('Background', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-svg-shape' => 'fill: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings();
    $cats    = $settings['cats'];
    $style   = $settings['style'];
    $limit   = $settings['limit'];
    $orderby = $settings['orderby'];

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
    
    $the_query = new \WP_Query($args); 

    if($the_query->have_posts()): ?>

      <div class="tb-svg-shape-wrap">
        <svg class="tb-svg-shape" width="1400" height="770" viewBox="0 0 1400 770">
          <path d="M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z"/>
        </svg>
      </div>

      <div class="tb-overflow-hidden">
        <div class="tb-scroll-section-navigation">
          <div class="tb-scroll-up-btn">Prev<i class="fa fa-angle-right"></i></div>
          <div class="tb-scroll-down-btn"><i class="fa fa-angle-left"></i>Next</div>
        </div>
        <div class="tb-scroll-section-box">
          <h5 class="tb-scroll-number-present">1</h5>
          <div class="tb-scroll-vertical-bar">
            <span class="tb-scroll-vertical-bar-in"></span>
          </div>
          <h5 class="tb-scroll-number-total"></h5>
        </div>

        <?php 
          while ($the_query -> have_posts()) : $the_query -> the_post(); 
            $link_to    = webify_get_post_opt('portfolio-link-to');
            $terms      = wp_get_post_terms(get_the_ID(), 'portfolio-category');
            $image_url  = $this->get_image_src(get_post_thumbnail_id());
            $url        = (!empty($link_to) && $link_to == 'lightbox') ? $image_url:get_the_permalink();
            $lightbox_class = (!empty($link_to) && $link_to == 'lightbox') ? 'tb-lightbox-item':'';
            $term_names = array();
            if (count($terms) > 0):
              foreach ($terms as $term):
                $term_names[] = $term->name;
              endforeach;
            endif; 
        ?>

          <div class="tb-scroll-section">
            <div class="tb-portfolio-off-grid-wrap">
              <div class="tb-portfolio-off-grid">
                <div class="tb-portfolio-off-grid-text">
                  <h1 class="tb-portfolio-off-grid-title tb-m0 tb-f72-lg tb-f40-sm"><?php the_title(); ?></h1>
                  <div class="empty-space marg-lg-b20"></div>
                  <div class="tb-portfolio-off-grid-btn">
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-btn tb-style11"><?php echo esc_html__('Discover Project', 'webify-addons'); ?></a>
                  </div>
                </div>
                <div class="tb-portfolio-off-grid-img tb-bg" style="background-image: url(<?php echo esc_url($image_url); ?>);"></div>
                <div class="tb-portfolio-off-grid-label"><?php echo implode(', ', $term_names); ?></div>
              </div>
              <div class="tb-mousey tb-scroll-down-btn">
                <div class="tb-scroller"></div>
              </div>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>


      </div>

    <?php endif;
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Portfolio_Section_Scroll_Widget() );