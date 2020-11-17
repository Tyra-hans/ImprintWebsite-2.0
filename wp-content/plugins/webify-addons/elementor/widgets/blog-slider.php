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
class Webify_Blog_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-blog-slider-widget';
  }

  public function get_title() {
    return 'Blog Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-post', 'slick', 'webify-slider');
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
      'blog_slider_section',
      array(
        'label' => esc_html__('Blog Slider' , 'webify-addons')
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
        'options'     => array_flip($this->get_custom_term_values('category')),
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
        'separator' => 'after',
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => esc_html__('Loop', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'separator' => 'after',
      )
    );

    $this->add_control(
      'delay',
      array(
        'label'     => esc_html__('Delay', 'webify-addons'),
        'type'      => Controls_Manager::TEXT,
        'separator' => 'after',
        'default'   => 2000,
        'condition' => array('autoplay' => 'yes')
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => esc_html__('Speed', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => 600,
        'separator' => 'after',
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings();
    $style    = $settings['style'];
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
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); 

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style10">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="1"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="3" data-add-slides="3">
              <div class="slick-wrapper">
                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                  <div class="slick-slide">
                    <div class="tb-slick-inner-pad">
                      <div class="tb-post tb-style13 tb-large-post text-center">
                        <div class="tb-zoom">
                          <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo $this->get_image_src(get_post_thumbnail_id()); ?>);"></a>
                        </div>
                        <div class="tb-post-info">
                          <div class="empty-space marg-lg-b15"></div>
                          <div class="tb-catagory tb-style1 tb-flex tb-color1">
                            <?php echo get_the_category_list(); ?>
                          </div>
                          <h2 class="tb-post-title tb-f28-lg tb-m0 tb-mt5 tb-mb-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
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
      <?php
        break;

      case 'style2': ?>
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style9">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="3" data-add-slides="4">
              <div class="slick-wrapper">
                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                  <div class="slick-slide">
                    <div class="tb-slick-inner-pad">
                      <div class="tb-post tb-style9">
                        <div class="tb-post-info">
                          <div class="empty-space marg-lg-b15"></div>
                          <div class="tb-catagory tb-style1">
                            <?php echo get_the_category_list(); ?>
                          </div>
                          <h2 class="tb-post-title tb-f28-lg tb-mt-2 tb-mb-2"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...'); ?></a></h2>
                          <div class="empty-space marg-lg-b15"></div>
                        </div>
                        <div class="tb-zoom">
                          <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-bg tb-zoom-in1" style="background-image: url(<?php echo $this->get_image_src(get_post_thumbnail_id()); ?>);"></a>
                        </div>
                        <!-- <a href="#" class="tb-post-video-btn tb-style1 tb-video-open tb-flex"><i class="fa fa-caret-right"></i></a> -->
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
        <?php
        break;
    }

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Blog_Slider_Widget() );