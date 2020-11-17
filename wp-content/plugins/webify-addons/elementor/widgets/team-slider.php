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
class Webify_Team_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-team-slider-widget';
  }

  public function get_title() {
    return 'Team Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-image-box', 'slick', 'webify-slider');
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

  public function get_image_src($id) {
    if(empty($id)) { return ; }
    $image_src = (is_numeric($id)) ? wp_get_attachment_url($id):$id;
    return $image_src;
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'team_slider_section',
      array(
        'label' => esc_html__('Team Slider' , 'webify-addons')
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
        'options'     => array_flip($this->get_custom_term_values('team-category')),
        'default'     => array(''),
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 4,
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
        'label'       => esc_html__('Autoplay', 'webify-addons'),
        'type'        => Controls_Manager::SWITCHER,
        'label_block' => true,
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'       => esc_html__('Loop', 'webify-addons'),
        'type'        => Controls_Manager::SWITCHER,
        'label_block' => true,
      )
    );

    $this->add_control(
      'delay',
      array(
        'label'     => esc_html__('Delay', 'webify-addons'),
        'type'      => Controls_Manager::TEXT,
        'default'   => 2000,
        'condition' => array('autoplay' => 'yes')
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => esc_html__('Speed', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 600
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings();
    $cats     = $settings['cats'];
    $limit    = $settings['limit'];
    $orderby  = $settings['orderby'];
    $loop     = $settings['loop'];
    $speed    = $settings['speed'];
    $autoplay = $settings['autoplay'];
    $delay    = $settings['delay'];
    $loop     = ($loop == 'yes') ? 1:0;
    $autoplay = ($autoplay == 'yes') ? 1:0;

    $args = array(
      'posts_per_page' => $limit,
      'orderby'        => $orderby,
      'order'          => 'ID',
      'post_type'      => 'team',
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'team-category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); ?>


    <div class="tb-full-widh-slider-padding">
      <div class="tb-mobile-padd15">
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1 tb-color1">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="6">
              <div class="slick-wrapper">
                <?php 
                  while ($the_query -> have_posts()) : $the_query -> the_post(); 
                    $bg_image = $this->get_image_src(get_post_thumbnail_id(get_the_ID()));
                    $position = webify_get_post_opt('team_position');

                    if(!empty($bg_image)):
                ?>

                  <div class="slick-slide">
                    <div class="tb-slick-inner-pad">
                      <div class="tb-image-box tb-style1 tb-zoom tb-radious-4 tb-relative">
                        <a href="#" class="tb-link-wrap"></a>
                        <div class="tb-image tb-overflow-hidden">
                          <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($bg_image); ?>);"></div>
                        </div>
                        <div class="tb-image-meta text-center">
                          <div class="empty-space marg-lg-b20"></div>
                          <h3 class="tb-f18-lg tb-font-proxima-nova  tb-mt-3 tb-m0"><?php the_title(); ?></h3>
                          <?php if(!empty($position)): ?>
                            <div class="tb-mt-2"><?php echo esc_html($position); ?></div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div><!-- .slick-slide -->

                <?php 
                  endif; 
                  endwhile; wp_reset_postdata(); 
                ?>

              </div>
            </div><!-- .slick-container -->
          </div>
          <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
          <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
            <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
          </div>
        </div><!-- .tb-carousor -->
      </div>
    </div>

  <?php
    
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Team_Slider_Widget() );