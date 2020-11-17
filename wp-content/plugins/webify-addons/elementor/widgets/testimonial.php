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
class Webify_Testimonial_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-testimonial-widget';
  }

  public function get_title() {
    return 'Testimonial';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('');
  }

  public function get_style_depends() {
    return array('webify-testimonial');
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
      'testimonial_section',
      array(
        'label' => esc_html__('Testimonial' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'webify-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
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

    $this->end_controls_section();





    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General Style', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'webify-addons'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .tb-testimonial',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'style3_border_color_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
        'condition' => array('style' => array('style3')),
      )
    );

    $this->add_control('style3_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial.tb-style5' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'style3_border_color_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
        'condition' => array('style' => array('style3')),
      )
    );

    $this->add_control('style3_border_color_hv', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial.tb-style5:hover' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();



    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'condition' => array('style' => array('style1', 'style2', 'style4')),
        'selector' => '{{WRAPPER}} .tb-testimonial'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'webify-addons'),
        'condition' => array('style' => array('style1', 'style2', 'style4')),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_control('horizonal_line_color', 
      array(
        'label'     => esc_html__('Horizontal Line Color', 'webify-addons'),
        'condition' => array('style' => array('style1', 'style2')),
        'type'      => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial hr' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'webify-addons'),
        'selector'  => '{{WRAPPER}} .tb-testimonial',
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_name_style',
      array(
        'label'     => esc_html__('Name Style', 'webify-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('name_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
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

    $this->add_responsive_control(
      'name_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_position_style',
      array(
        'label'     => esc_html__('Position Style', 'webify-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('position_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        
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

    $this->add_responsive_control(
      'position_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_description_style',
      array(
        'label'     => esc_html__('Description Style', 'webify-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-testimonial-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'description_margin',
      array(
        'label'      => esc_html__('Margin', 'webify-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tb-testimonial-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
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
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); $position = webify_get_post_opt('testimonial_position'); ?>
          <div class="col-lg-4">
            <div class="tb-testimonial tb-style2 tb-border tb-radious-4">
              <div class="tb-testimonial-text tb-f16-lg tb-line1-69 "><?php the_content(); ?></div>
              <hr>
              <div class="tb-testimonial-meta text-center">
                <?php the_post_thumbnail('webify-square-thumb', array('class' => 'tb-radious-50')); ?>
                <div class="empty-space marg-lg-b15"></div>
                <h3 class="tb-f16-lg tb-testimonial-name tb-font-name tb-m0 tb-mt-2"><?php the_title(); ?></h3>
                <?php if(!empty($position)): ?>
                  <div class="tb-mb-6 tb-testimonial-position"><?php echo esc_html($position); ?></div>
                <?php endif; ?>
                <div class="empty-space marg-lg-b30"></div>
              </div>
            </div>
          </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="row">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); $position = webify_get_post_opt('testimonial_position'); ?>
            <div class="col-lg-4">
              <div class="tb-testimonial tb-style3 tb-border tb-radious-4">
                <div class="tb-testimonial-text tb-f16-lg tb-line1-69 "><?php the_content(); ?></div>
                <hr>
                <div class="tb-testimonial-meta">
                  <?php the_post_thumbnail('webify-square-thumb', array('class' => 'tb-radious-50')); ?>
                  <h3 class="tb-f18-lg tb-testimonial-name tb-font-name tb-font-name tb-m0 tb-mt-3 tb-mb-2"><?php the_title(); ?></h3>
                  <?php if(!empty($position)): ?>
                    <div class="tb-mb-6 tb-testimonial-position"><?php echo esc_html($position); ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="row">
          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $position = webify_get_post_opt('testimonial_position');
          ?>
            <div class="col-lg-4">
              <div class="tb-testimonial tb-style5">
                <div class="tb-testimonial-text tb-f16-lg tb-line1-6  tb-mb-7"><?php the_content(); ?></div>
                <div class="empty-space marg-lg-b30"></div>
                <div class="tb-testimonial-meta">
                  <?php the_post_thumbnail('webify-square-thumb', array('class' => 'tb-radious-50')); ?>
                  <h3 class="tb-f16-lg tb-testimonial-name tb-m0 tb-mt-3"><?php the_title(); ?></h3>
                  <?php if(!empty($position)): ?>
                    <div class="tb-mb-6 tb-testimonial-position"><?php echo esc_html($position); ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="row">
          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $position = webify_get_post_opt('testimonial_position');
          ?>
            <div class="col-lg-4">
              <div class="tb-testimonial tb-style4 tb-border text-center">
                <?php the_post_thumbnail('webify-square-thumb-big', array('class' => 'tb-radious-50')); ?>
                <div class="empty-space marg-lg-b20"></div>
                <div class="tb-testimonial-text tb-f16-lg tb-line1-75 tb-mb2"><?php the_content(); ?></div>
                <div class="tb-testimonial-meta text-center">
                  <div class="empty-space marg-lg-b20"></div>
                  <h3 class="tb-f16-lg tb-testimonial-name tb-font-name tb-m0 tb-mt-3"><?php the_title(); ?></h3>
                  <div class="tb-mb-6 tb-testimonial-position tb-f14-lg"><?php echo esc_html($position); ?></div>
                  <div class="empty-space marg-lg-b40"></div>
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
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Testimonial_Widget() );