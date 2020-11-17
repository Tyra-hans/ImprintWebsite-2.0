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
class Webify_Blog_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-blog-widget';
  }

  public function get_title() {
    return 'Blog';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('isotop');
  }

  public function get_style_depends() {
    return array('webify-post', 'isotop', 'webify-button');
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
      'blog_section',
      array(
        'label' => esc_html__('Blog' , 'webify-addons')
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
          'style5' => 'Style 5',
          'style6' => 'Style 6',
          'style7' => 'Style 7',
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
      'excerpt_length',
      array(
        'label'       => esc_html__('Excerpt Length', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 20,
        'condition'   => array('style' => array('style2', 'style3', 'style4')),
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



    $this->start_controls_section('section_category_style',
      array(
        'label' => esc_html__('Category Style', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );


    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'category_typography',
        'selector' => '{{WRAPPER}} .post-categories a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('category_style');

    $this->start_controls_tab(
      'category_color_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );


    $this->add_control('category_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .post-categories a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'category_color_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );


    $this->add_control('category_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .post-categories a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title Style', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_color_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('title_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-title a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
      'title_color_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );


    $this->add_control('title_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-title a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-post-title a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_date_style',
      array(
        'label' => esc_html__('Date Style', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );


    $this->add_control('date_normal_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-date' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'date_typography',
        'selector' => '{{WRAPPER}} .tb-post-date',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );


    $this->end_controls_section();


    $this->start_controls_section('section_author_style',
      array(
        'label' => esc_html__('Author Style', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );


    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'author_typography',
        'selector' => '{{WRAPPER}} .tb-post-author-name a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('author_style');

    $this->start_controls_tab(
      'author_color_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );


    $this->add_control('author_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-author-name a' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();


    $this->start_controls_tab(
      'author_color_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('author_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-author-name a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_read_more_style',
      array(
        'label'     => esc_html__('Read More Style', 'webify-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2'))
      )
    );

    $this->start_controls_tabs('read_more_style');

    $this->start_controls_tab(
      'read_more_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('read_more_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'read_more_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('read_more_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('read_more_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();



  }

  protected function render() { 

    $settings       = $this->get_settings();
    $style          = $settings['style'];
    $cats           = $settings['cats'];
    $limit          = $settings['limit'];
    $orderby        = $settings['orderby'];
    $excerpt_length = $settings['excerpt_length'];

    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }

    $args = array(
      'posts_per_page' => $limit,
      'orderby'        => $orderby,
      'paged'          => $paged,
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

    $max_num_pages = $the_query ->max_num_pages;

    switch ($style) {
      case 'style':
      default: ?>
        <div class="tb-blog-content">
          <div class="tb-isotop tb-port-col-2 tb-has-gutter">
            <div class="tb-grid-sizer"></div>

            <?php 
              $i = 0;
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                if($i == 0): 
            ?>
              <div <?php post_class('tb-isotop-item tb-w100'); ?>>
                <div class="tb-post tb-style5 tb-color1 tb-large-post">
                  <?php if(has_post_thumbnail()): ?>
                    <div class="tb-zoom">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1">
                        <?php the_post_thumbnail('webify-rectangle-large'); ?>
                      </a>
                    </div>
                  <?php endif; ?>
                  <div class="tb-post-info">
                    <div class="tb-post-meta">
                      <div class="tb-catagory tb-style1">
                        <?php echo get_the_category_list(); ?>
                      </div>
                    </div>
                    <div class="empty-space marg-lg-b5"></div>
                    <h2 class="tb-post-title tb-36-lg  tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                    <div class="tb-post-label tb-style1">
                      <span class="tb-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                      <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            <?php else: ?>

              <div <?php post_class('tb-isotop-item'); ?>>
                <div class="tb-post tb-style5 tb-color1 ">
                  <?php if(has_post_thumbnail()): ?>
                    <div class="tb-zoom">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1">
                        <?php the_post_thumbnail('webify-rectangle-medium-alt'); ?>
                      </a>
                    </div>
                  <?php endif; ?>
                  <div class="tb-post-info">
                    <div class="tb-catagory tb-style1">
                      <?php echo get_the_category_list(); ?>
                    </div>
                    <div class="empty-space marg-lg-b5"></div>
                    <h2 class="tb-post-title tb-f18-lg  tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                    <div class="tb-post-label tb-style1">
                      <span class="tb-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                      <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; $i++; endwhile; wp_reset_postdata(); ?>

          </div>
          <?php webify_paging_nav($max_num_pages); ?>
        </div>
        <?php
        # code...
        break;
      
      case 'style2': ?>
        <div class="tb-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('tb-post tb-style13'); ?>>
              <?php if(has_post_thumbnail()): ?>
                <div class="tb-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
              <?php endif; ?>
              <div class="tb-post-info">
                <div class="empty-space marg-lg-b20"></div>
                <div class="tb-post-label tb-style1">
                  <span class="tb-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"> <?php echo get_the_author(); ?></a></span> 
                  <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                </div>
                <div class="empty-space marg-lg-b5"></div>
                <h2 class="tb-post-title tb-f28-lg tb-m0 tb-mt-2 tb-mb-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                <div class="empty-space marg-lg-b10"></div>
                <div class="tb-f15-lg tb-line1-6"><?php echo webify_post_excerpt($excerpt_length); ?></div>
                <div class="empty-space marg-lg-b10"></div>
                <div class="tb-post-btn"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-btn tb-style1 tb-type1"><?php echo esc_html__('CONTINUE READING', 'webify-addons'); ?></a></div>
              </div>
              <?php echo (($the_query->current_post + 1) !== ( $the_query->post_count )) ? '<div class="empty-space marg-lg-b40"></div>':''; ?>
            </div><!-- .post -->
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        break;
      case 'style3': 

        $args = array(
          'nav'            => 'load-more',
          'isotope'        => 0,
          'posts_per_page' => $limit,
          'cats'           => $cats,
          'excerpt_length' => $excerpt_length
        );

      ?>
        <div class="row tb-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('col-lg-6'); ?>>
              <div class="tb-post tb-style13 tb-small-post">
                <div class="tb-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
                <div class="tb-post-info">
                  <div class="empty-space marg-lg-b15"></div>
                  <div class="tb-catagory tb-style1 tb-color1">
                    <?php echo get_the_category_list(); ?>
                  </div>
                  <div class="empty-space marg-lg-b10"></div>
                  <h2 class="tb-post-title tb-f18-lg tb-m0 tb-mt-2 tb-mb-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  <div class="empty-space marg-lg-b10"></div>
                  <div class="tb-f14-lg tb-line1-6"><?php echo webify_post_excerpt($excerpt_length); ?></div>
                  <div class="empty-space marg-lg-b5"></div>
                </div>
              </div>
            </div><!-- .col -->
          <?php endwhile; wp_reset_postdata(); ?>
          <div class="empty-space marg-lg-b20"></div>
          <?php webify_paging_nav($max_num_pages, $args); ?>
        </div><!-- .row -->

        <?php
        break;
      case 'style4': ?>
        <div class="tb-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('tb-post tb-style8 tb-small-post tb-type1'); ?>>
              <div class="tb-zoom">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
              </div>
              <div class="tb-post-info">
                <div class="tb-catagory tb-style1 tb-color1">
                  <?php echo get_the_category_list(); ?>
                </div>
                <div class="empty-space marg-lg-b10"></div>
                <h2 class="tb-post-title tb-f21-lg tb-m0 tb-mt-4 tb-mb-5"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                <div class="empty-space marg-lg-b15"></div>
                <div class="tb-f14-lg tb-line1-6">
                  <?php echo webify_post_excerpt($excerpt_length); ?>
                </div>
              </div>
            </div><!-- .post -->
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      <?php
      break;
      case 'style5': ?>
        <div class="row tb-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('col-lg-3 col-sm-6'); ?>>
              <div class="tb-post tb-style11">
                <div class="tb-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
                <div class="tb-post-info">
                  <div class="empty-space marg-lg-b15"></div>
                  <h2 class="tb-post-title tb-f16-lg tb-m0 tb-mt-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  <div class="tb-post-label tb-style1">
                    <span class="tb-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                    <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        break;
      case 'style6': ?>
        <div class="tb-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div class="tb-post tb-style3 tb-color3 tb-type1">
              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
              <div class="tb-post-info">
                <div class="tb-post-text">
                  <div class="empty-space marg-lg-b5"></div>
                  <h2 class="tb-post-title tb-f14-lg tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  <div class="empty-space marg-lg-b5"></div>
                  <div class="tb-post-label tb-style1">
                    <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                  </div>
                </div>
              </div>
            </div>
            <?php echo (($the_query->current_post + 1) !== ( $the_query->post_count )) ? '<div class="empty-space marg-lg-b20"></div>':''; ?>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        break;

      case 'style7': ?>
        <div class="tb-isotop tb-style1 tb-port-col-2 tb-has-gutter">
          <div class="tb-grid-sizer"></div>
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('tb-isotop-item'); ?>>
              <div class="tb-post tb-style12 <?php echo ($the_query->current_post == 0) ? 'tb-large-post':''; ?>">
                <div class="tb-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
                <div class="tb-post-info">
                  <div class="tb-catagory tb-style1">
                    <?php echo get_the_category_list(); ?>
                  </div>
                  <h2 class="tb-post-title tb-f24-lg tb-white-c tb-mb-6"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo wp_trim_words( get_the_title(), 6, '...'); ?></a></h2>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        # code...
        break;
    }
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Blog_Widget() );