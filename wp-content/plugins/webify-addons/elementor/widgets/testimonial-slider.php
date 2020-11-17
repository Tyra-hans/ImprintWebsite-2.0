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
class Webify_Testimonial_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-testimonial-slider-widget';
  }

  public function get_title() {
    return 'Testimonial Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-testimonial', 'slick', 'webify-slider');
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
      'testimonial_section',
      array(
        'label' => esc_html__('Testimonial Slider' , 'webify-addons')
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
          'style3' => 'Style 3',
        )
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'webify-addons'),
        'type'        => Controls_Manager::MEDIA,
        'label_block' => true,
        'condition'   => array('style' => array('style1'))
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
        'options'     => array_flip($this->get_custom_term_values('testimonial-category')),
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


    $this->start_controls_section('section_icon_color',
      array(
        'label' => esc_html__('Icon', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial.tb-style1 .tb-testimonial-icon' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial.tb-style1 .tb-testimonial-icon i' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_content_color',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-testimonial-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_name_color',
      array(
        'label' => esc_html__('Name', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('name_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-name' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'name_typography',
        'selector' => '{{WRAPPER}} .tb-testimonial-name',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_position_color',
      array(
        'label' => esc_html__('Position', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('position_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-position' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'position_typography',
        'selector' => '{{WRAPPER}} .tb-testimonial-position',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();



  }

  protected function render() { 

    $settings = $this->get_settings();
    $cats     = $settings['cats'];
    $limit    = $settings['limit'];
    $style    = $settings['style'];
    $orderby  = $settings['orderby'];
    $autoplay = $settings['autoplay'];
    $loop     = $settings['loop'];
    $speed    = $settings['speed'];
    $delay    = $settings['delay'];
    $image    = $settings['image'];
    $loop     = ($loop == 'yes') ? 1:0;
    $autoplay = ($autoplay == 'yes') ? 1:0;

    $args = array(
      'posts_per_page' => $limit,
      'orderby'        => $orderby,
      'order'          => 'ID',
      'post_type'      => 'testimonial',
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'testimonial-category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); 

    switch ($style) {
      case 'style1':
      default: ?>
        <div class="row">
          <div class="col-lg-5">
            <div class="empty-space marg-lg-b60 marg-sm-b0"></div>
            <div class="tb-testimonial-wrap">
              <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
                <div class="tb-overflow-hidden">
                  <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="1" data-md-slides="1" data-lg-slides="1" data-add-slides="1">
                    <div class="slick-wrapper">

                      <?php 
                        while ($the_query -> have_posts()) : $the_query -> the_post(); 
                          $position = webify_get_post_opt('testimonial_position');
                      ?>
                        <div class="slick-slide">
                          <div class="tb-testimonial tb-style1">
                            <span class="tb-testimonial-icon tb-font-name"><i class="material-icons">format_quote</i></span>
                            <div class="tb-testimonial-text tb-f18-lg tb-f16-sm tb-line1-6"><?php the_content(); ?></div>
                            <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
                            <div class="tb-testimonial-meta">
                              <?php the_post_thumbnail('webify-square-thumb', array('class' => 'tb-radious-50')); ?>
                              <h3 class="tb-f18-lg tb-font-name tb-m0 tb-testimonial-name"><?php the_title(); ?></h3>
                              <?php if(!empty($position)): ?>
                                <div class="tb-testimonial-position"><?php echo wp_kses_post($position); ?></div>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div><!-- .slick-slide -->
                      <?php endwhile; wp_reset_postdata(); ?>

                    </div>
                  </div><!-- .slick-container -->
                </div>
                <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
                <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
                  <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                  <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
                </div>
              </div><!-- .tb-carousor -->
            </div><!-- .tb-testimonial-wrap -->
            <div class="empty-space marg-lg-b60 marg-sm-b0"></div>
          </div><!-- .col -->
          <?php if(is_array($image) && !empty($image['url'])): ?>
            <div class="col-lg-7">
              <div class="tb-testimonial-img tb-style1 tb-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
            </div><!-- .col -->
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
          <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-autoplay-timeout="1000" data-loop="1" data-center="0" data-slides-per-view="1">
            <div class="slick-wrapper">

              <?php 
                while ($the_query -> have_posts()) : $the_query -> the_post(); 
                  $position  = webify_get_post_opt('testimonial_position');
                  $logo      = webify_get_post_opt('testimonial_logo');
                  $signature = webify_get_post_opt('testimonial_signature');
                  $image_url = $this->get_image_src(get_post_thumbnail_id());
              ?>
                <div class="slick-slide">
                  <div class="tb-testimonial tb-style6 tb-border tb-radious-5">
                    <div class="tb-testimonial-left">
                      <?php if(is_array($logo) & !empty($logo['url'])): ?>
                        <div class="tb-testimonial-logo"><img src="<?php echo esc_url($logo['url']); ?>" alt="logo"></div>
                      <?php endif; ?>
                      <div class="tb-testimonial-text tb-f18-lg tb-line1-6"><?php the_content(); ?></div>
                      <div class="tb-testimonial-meta">
                        <?php if(is_array($signature) & !empty($signature['url'])): ?>
                          <div class="tb-testimonial-signature"><img src="<?php echo esc_url($signature['url']); ?>" alt="signature"></div>
                        <?php endif; ?>
                        <h3 class="tb-f16-lg tb-font-name tb-testimonial-name tb-m0"><?php the_title(); ?></h3>
                        <?php if(!empty($position)): ?>
                          <div class=" tb-mb-6 tb-testimonial-position tb-f13-lg"><?php echo wp_kses_post($position); ?></div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <?php if(!empty($image_url)): ?>
                      <div class="tb-testimonial-right">
                        <div class="tb-bg tb-testimonial-img" style="background-image: url(<?php echo esc_url($image_url); ?>);"></div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div><!-- .slick-slide -->
              <?php endwhile; wp_reset_postdata(); ?>





            </div>
          </div><!-- .slick-container -->
          <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
          <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
            <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
          </div>
        </div><!-- .tb-carousor -->
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="tb-overflow-hidden">
          <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style6">
            <div class="tb-slick-inner-pad-wrap">
              <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="1" data-md-slides="1" data-lg-slides="3" data-add-slides="3">
                <div class="slick-wrapper">
                  <?php 
                    while ($the_query -> have_posts()) : $the_query -> the_post(); 
                      $position  = webify_get_post_opt('testimonial_position');
                      $logo      = webify_get_post_opt('testimonial_logo');
                      $signature = webify_get_post_opt('testimonial_signature');
                      $image_url = $this->get_image_src(get_post_thumbnail_id());
                  ?>
                    <div class="slick-slide">
                      <div class="tb-slick-inner-pad">
                        <div class="tb-testimonial tb-style1">
                          <span class="tb-testimonial-icon "><i class="material-icons">format_quote</i></span>
                          <div class="tb-testimonial-text tb-f16-lg tb-line1-6"><?php the_content(); ?>
                          </div>
                          <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
                          <div class="tb-testimonial-meta">
                            <?php the_post_thumbnail('webify-square-thumb', array('class' => 'tb-radious-50')); ?>
                            <h3 class="tb-f18-lg  tb-m0 tb-testimonial-name"><?php the_title(); ?></h3>
                            <div class="tb-testimonial-position"><?php echo wp_kses_post($position); ?></div>
                          </div>
                        </div>
                      </div>
                    </div><!-- .slick-slide -->
                  <?php endwhile; wp_reset_postdata(); ?>

                </div>
              </div><!-- .slick-container -->
            </div>
            <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style6"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div><!-- .tb-carousor -->
        </div>
        <?php
        break;
      
    }

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Testimonial_Slider_Widget() );