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
class Webify_Portfolio_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-portfolio-widget';
  }

  public function get_title() {
    return 'Portfolio';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('isotop', 'light-gallery');
  }

  public function get_style_depends() {
    return array('isotop', 'webify-image-box', 'light-gallery');
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
      'portfolio_section',
      array(
        'label' => esc_html__('Portfolio' , 'webify-addons')
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
          'style4' => 'Style 4',
        )
      )
    );

    $this->add_control(
      'filter_position',
      array(
        'label'       => esc_html__('Filter Position', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'tb-flex',
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'options' => array(
          'tb-flex-start' => 'Left',
          'tb-flex'       => 'Center',
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

    $this->start_controls_section('section_portfolio_general',
      array(
        'label'     => esc_html__('General', 'webify-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2', 'style3')),
      )
    );

    $this->add_control('bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_color_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Title Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-meta h3 a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'title_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('title_color_hover', 
      array(
        'label'       => esc_html__('Title Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-meta h3 a:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->add_control('category_color', 
      array(
        'label'       => esc_html__('Category Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-meta span' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_portfolio_filter',
      array(
        'label'     => esc_html__('Filter', 'webify-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2', 'style3')),
      )
    );

    $this->add_control('filter_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-isotop-filter a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('filter_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-isotop-filter li.active a' => 'border-color: {{VALUE}};',
        ),
      )
    );

  }

  protected function render() { 

    $settings        = $this->get_settings();
    $cats            = $settings['cats'];
    $style           = $settings['style'];
    $limit           = $settings['limit'];
    $orderby         = $settings['orderby'];
    $filter_position = $settings['filter_position'];

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



    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-portfolio-wrapper">
          <div class="tb-overflow-hidden">

            <?php 
              $terms = get_terms('portfolio-category', array('orderby' => 'name', 'slug' => $cats));
              if(count($terms) > 0): ?>
                <div class="tb-isotop-filter tb-style1 text-center">
                  <ul class="tb-mp0 <?php echo esc_attr($filter_position); ?> tb-f16-lg tb-black111-c ">
                    <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All', 'webify-addons'); ?></a></li>
                    <?php foreach ($terms as $term): ?>
                      <li><a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
            <div class="tb-isotop tb-style1 tb-port-col-3 tb-has-gutter tb-lightgallery">
              <div class="tb-grid-sizer"></div>

              <?php 
                while ($the_query -> have_posts()) : $the_query -> the_post(); 
                  $link_to    = webify_get_post_opt('portfolio-link-to');
                  $terms      = wp_get_post_terms(get_the_ID(), 'portfolio-category');
                  $image_url  = $this->get_image_src(get_post_thumbnail_id());
                  $url        = (!empty($link_to) && $link_to == 'lightbox') ? $image_url:get_the_permalink();
                  $lightbox_class = (!empty($link_to) && $link_to == 'lightbox') ? 'tb-lightbox-item':'';
                  $term_slugs = array();
                  $term_names = array();
                  if (count($terms) > 0):
                    foreach ($terms as $term):
                      $term_slugs[] = $term->slug;
                      $term_names[] = $term->name;
                    endforeach;
                  endif; 
              ?>

                <div class="tb-isotop-item <?php echo implode(' ', $term_slugs); ?>">
                  <div class="tb-image-box tb-style2 tb-relative tb-radious-4 tb-border tb-height2">
                    <a href="<?php echo esc_url($url); ?>" class="tb-image-link <?php echo esc_attr($lightbox_class); ?> tb-zoom">
                      <div class="tb-image tb-relative">
                        <?php if($link_to == 'lightbox'): ?>
                          <img src="<?php echo esc_url($image_url); ?>" alt="thumb">
                        <?php endif; ?>
                        <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url); ?>);"></div>
                      </div>
                    </a>
                    <div class="tb-image-meta">
                      <h3 class="tb-f16-lg tb-font-name tb-mb5 tb-mt-3"><a href="<?php echo esc_url($url); ?>"><?php the_title(); ?></a></h3>
                      <div class="tb-mb-6">
                        <span><?php echo implode(', ', $term_names); ?></span>
                      </div>
                    </div>
                  </div>
                </div><!-- .tb-isotop-item -->
              <?php endwhile; wp_reset_postdata(); ?>



            </div><!-- .isotop -->
          </div>
        </div>
        <?php
        # code...
        break;
      
      case 'style2': ?>

        <div class="tb-portfolio-wrapper">
        <?php 
          $terms = get_terms('portfolio-category', array('orderby' => 'name', 'slug' => $cats));
          if(count($terms) > 0): ?>
            <div class="tb-isotop-filter tb-style1 text-center">
              <ul class="tb-mp0 <?php echo esc_attr($filter_position); ?> tb-f16-lg tb-black111-c">
                <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All', 'webify-addons'); ?></a></li>
                <?php foreach ($terms as $term): ?>
                  <li><a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <div class="tb-isotop tb-style1 tb-port-col-4 tb-has-gutter tb-lightgallery">
            <div class="tb-grid-sizer"></div>

            <?php 
              $class_array = array('tb-w50|tb-height1', 'tb-w25|tb-height2', 'tb-w25|tb-height2');
              $count = 0;
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                $link_to    = webify_get_post_opt('portfolio-link-to');
                $terms      = wp_get_post_terms(get_the_ID(), 'portfolio-category');
                $image_url  = $this->get_image_src(get_post_thumbnail_id());
                $url        = (!empty($link_to) && $link_to == 'lightbox') ? $image_url:get_the_permalink();
                $lightbox_class = (!empty($link_to) && $link_to == 'lightbox') ? 'tb-lightbox-item':'';
                $term_slugs = array();
                $term_names = array();
                if (count($terms) > 0):
                  foreach ($terms as $term):
                    $term_slugs[] = $term->slug;
                    $term_names[] = $term->name;
                  endforeach;
                endif;
                $count      = ( $count < 3 ) ? $count:0;
                $class_attr = explode('|', $class_array[$count]);

            ?>
              <div class="tb-isotop-item <?php echo esc_attr($class_attr[0]); ?> <?php echo implode(' ', $term_slugs); ?>">
                <div class="tb-image-box tb-style2 tb-type1 tb-relative tb-radious-4 tb-border <?php echo esc_attr($class_attr[1]); ?>">
                  <a href="<?php echo esc_url($url); ?>" class="tb-image-link <?php echo esc_attr($lightbox_class); ?> tb-zoom">
                    <div class="tb-image tb-relative">
                      <?php if($link_to == 'lightbox'): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="thumb">
                      <?php endif; ?>
                      <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url); ?>);"></div>
                    </div>
                  </a>
                  <div class="tb-image-meta">
                    <h3 class="tb-f16-lg tb-font-name tb-mb5 tb-mt-3"><a href="<?php echo esc_url($url); ?>"><?php the_title(); ?></a></h3>
                    <div class="tb-mb-6">
                      <span><?php echo implode(', ', $term_names); ?></span>
                    </div>
                  </div>
                </div>
              </div><!-- .tb-isotop-item -->
            <?php $count++; endwhile; wp_reset_postdata(); ?>



          </div><!-- .isotop -->


        </div>
        
        <?php
        # code...
        break;

      case 'style3':?>
        <div class="tb-portfolio-wrapper">

          <?php 
            $terms = get_terms('portfolio-category', array('orderby' => 'name', 'slug' => $cats));
            if(count($terms) > 0): ?>
              <div class="tb-isotop-filter tb-style1 text-center">
                <ul class="tb-mp0 <?php echo esc_attr($filter_position); ?> tb-f16-lg tb-black111-c ">
                  <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All', 'webify-addons'); ?></a></li>
                  <?php foreach ($terms as $term): ?>
                    <li><a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
          <?php endif; ?>

          <div class="tb-isotop tb-style1 tb-port-col-3 tb-has-gutter tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php 
              $class_array = array('tb-height3', 'tb-height4', 'tb-height3', 'tb-height4', 'tb-height4', 'tb-height3');
              $count = 0;
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                $link_to    = webify_get_post_opt('portfolio-link-to');
                $terms      = wp_get_post_terms(get_the_ID(), 'portfolio-category');
                $image_url  = $this->get_image_src(get_post_thumbnail_id());
                $url        = (!empty($link_to) && $link_to == 'lightbox') ? $image_url:get_the_permalink();
                $term_slugs = array();
                if (count($terms) > 0):
                  foreach ($terms as $term):
                    $term_slugs[] = $term->slug;
                  endforeach;
                endif;
                $count = ( $count < 6 ) ? $count:0;

            ?>
              <div class="tb-isotop-item <?php echo implode(' ', $term_slugs); ?>">
                <div class="tb-image-box tb-style2 tb-relative tb-radious-4 tb-border <?php echo esc_attr($class_array[$count]); ?>">
                  <a href="<?php echo esc_url($url); ?>" class="tb-image-link <?php echo ($link_to == 'lightbox') ? 'tb-lightbox-item':''; ?> tb-zoom">
                    <div class="tb-image tb-relative">
                      <?php if($link_to == 'lightbox'): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="thumb">
                      <?php endif; ?>
                      <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url); ?>);"></div>
                    </div>
                  </a>
                </div>
              </div><!-- .tb-isotop-item -->

            <?php $count++; endwhile; wp_reset_postdata(); ?>
            

          </div><!-- .isotop -->



        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="tb-portfolio-wrapper">
          <div class="tb-isotop tb-style1 tb-port-col-4 tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php 
              $class_array = array('tb-height8', 'tb-height6', 'tb-height7', 'tb-height5', 'tb-height6', 'tb-height8', 'tb-height7', 'tb-height5');
              $count = 0;
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                $link_to    = webify_get_post_opt('portfolio-link-to');
                $terms      = wp_get_post_terms(get_the_ID(), 'portfolio-category');
                $image_url  = $this->get_image_src(get_post_thumbnail_id());
                $url        = (!empty($link_to) && $link_to == 'lightbox') ? $image_url:get_the_permalink();
                $count = ( $count < 8 ) ? $count:0;
            ?>
              <div class="tb-isotop-item">
                <div class="tb-image-box tb-style2 tb-relative <?php echo esc_attr($class_array[$count]); ?>">
                  <a href="<?php echo esc_url($url); ?>" class="tb-image-link <?php echo ($link_to == 'lightbox') ? 'tb-lightbox-item':''; ?> tb-zoom">
                    <div class="tb-image tb-relative">
                      <?php if($link_to == 'lightbox'): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="thumb">
                      <?php endif; ?>
                      <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url); ?>);"></div>
                    </div>
                  </a>
                </div>
              </div><!-- .tb-isotop-item -->
            <?php $count++; endwhile; wp_reset_postdata(); ?>

          </div><!-- .isotop -->
        </div>
        <?php
        # code...
        break;
      
    }

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Portfolio_Widget() );