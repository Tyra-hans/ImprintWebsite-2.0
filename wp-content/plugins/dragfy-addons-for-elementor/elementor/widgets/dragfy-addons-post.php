<?php 

namespace DragfyAddons\Elementor\Widgets;
use DragfyAddons\Helpers\Helpers;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Post extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-post';
  }

  public function get_title() {
    return 'Post';
  }

  public function get_icon() {
    return 'elem_icon post';
  }

  public function get_script_depends() {
    return array('isotope', 'imagesloaded', 'dragfy-addons');
  }

  public function get_style_depends() {
    return array('post', 'isotope', 'button', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
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
      'post_general_settings',
      array(
        'label' => esc_html__('General Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__('Style', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'label_block' => true,
        'options' => array(
          'style1' => esc_html__('Style 1', 'dragfy-addons-for-elementor'),
          'style2' => esc_html__('Style 2', 'dragfy-addons-for-elementor'),
          'style3' => esc_html__('Style 3', 'dragfy-addons-for-elementor'),
          'style4' => esc_html__('Style 4', 'dragfy-addons-for-elementor'),
          'style5' => esc_html__('Style 5', 'dragfy-addons-for-elementor'),
          'style6' => esc_html__('Style 6', 'dragfy-addons-for-elementor'),
        )
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'post_query_settings',
      array(
        'label' => esc_html__('Query Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'cats',
      array(
        'label'       => esc_html__('Filter By Categories', 'dragfy-addons-for-elementor'),
        'description' => esc_html__('Specifies a category that you want to show posts from it.', 'dragfy-addons-for-elementor' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'label_block' => true,
        'options'     => array_flip($this->get_custom_term_values('category')),
        'default'     => array(''),
      )
    );

    $this->add_control(
      'tags',
      array(
        'label'       => esc_html__('Filter By Tags', 'dragfy-addons-for-elementor'),
        'description' => esc_html__('Specifies a tag that you want to show posts from it.', 'dragfy-addons-for-elementor' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'label_block' => true,
        'options'     => array_flip($this->get_custom_term_values('post_tag')),
        'default'     => array(''),
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 8,
      )
    );

    $this->add_control(
      'orderby',
      array(
        'label'       => esc_html__( 'Order By', 'dragfy-addons-for-elementor' ),
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
      'order',
      array(
        'label'       => esc_html__('Order', 'dragfy-addons-for-elementor' ),
        'type'        => Controls_Manager::SELECT,
        'options'     => array(
          'DESC' => esc_html__('Descending', 'dragfy-addons-for-elementor'),
          'ASC'  => esc_html__('Ascending', 'dragfy-addons-for-elementor'),
        ),
        'default' => 'DESC',
        'label_block' => true,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'post_meta_settings',
      array(
        'label' => esc_html__('Meta Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'category',
      array(
        'label'     => esc_html__('Category', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => array('style!' => array('style2', 'style5'))
      )
    );

    $this->add_control(
      'author',
      array(
        'label'     => esc_html__('Author', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => array('style' => array('style1', 'style2', 'style5'))
      )
    );

    $this->add_control(
      'date',
      array(
        'label'     => esc_html__('Date', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => array('style' => array('style1', 'style2', 'style5'))
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'post_advance_settings',
      array(
        'label' => esc_html__('Advance Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $this->add_control(
      'excerpt',
      array(
        'label'     => esc_html__('Excerpt', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => array('style' => array('style2', 'style3', 'style4'))
      )
    );

    $this->add_control(
      'excerpt_length',
      array(
        'label'     => esc_html__('Excerpt Length', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::TEXT,
        'default'   => 20,
        'condition' => array('style' => array('style2', 'style3', 'style4'))
      )
    );
    

    $this->add_control(
      'read_more',
      array(
        'label'     => esc_html__('Read More', 'dragfy-addons-for-elementor'),
        'type'      => Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => array('style' => array('style2'))
      )
    );

    $this->add_control(
      'pagination',
      array(
        'label'   => esc_html__('Pagination', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::SWITCHER,
        'default' => 'yes'
      )
    );

    $this->end_controls_section();






    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-post',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-post'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-post',
      )
    );

    $this->end_controls_section();





    $this->start_controls_section('section_category_style',
      array(
        'label' => esc_html__('Category Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'category_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .post-categories a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'category_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .post-categories a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
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
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('category_normal_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .post-categories a' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('category_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .post-categories a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'category_normal_border',
        'selector' => '{{WRAPPER}} .post-categories a'
      )
    );

    $this->add_responsive_control(
      'category_normal_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .post-categories a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'category_color_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('category_hover_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .post-categories a:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('category_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .post-categories a:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'category_hover_border',
        'selector' => '{{WRAPPER}} .post-categories a:hover'
      )
    );

    $this->add_responsive_control(
      'category_hover_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .post-categories a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-post-title a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_color_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('title_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-title a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
      'title_color_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );


    $this->add_control('title_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-title a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_author_style',
      array(
        'label' => esc_html__('Author Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'author_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'author_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'author_typography',
        'selector' => '{{WRAPPER}} .df-post-author-name a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('author_style');

    $this->start_controls_tab(
      'author_color_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('author_normal_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('author_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'author_normal_border',
        'selector' => '{{WRAPPER}} .df-post-author-name a'
      )
    );

    $this->add_responsive_control(
      'author_normal_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'author_color_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('author_hover_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('author_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'author_hover_border',
        'selector' => '{{WRAPPER}} .df-post-author-name a:hover'
      )
    );

    $this->add_responsive_control(
      'author_hover_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-author-name a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_date_style',
      array(
        'label' => esc_html__('Date Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'date_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'date_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'date_typography',
        'selector' => '{{WRAPPER}} .df-post-date',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );


    $this->add_control('date_normal_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-date' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('date_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-post-date' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'date_normal_border',
        'selector' => '{{WRAPPER}} .df-post-date'
      )
    );

    $this->add_responsive_control(
      'date_normal_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-post-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_pagination_style',
      array(
        'label' => esc_html__('Pagination Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'pagination_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'pagination_size',
      array(
        'label'       => esc_html__('Size', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SLIDER,
        'label_block' => true,
        'range' => array(
          'px' => array(
            'max'  => 150,
            'step' => 5,
          ),
        ),
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'pagination_typography',
        'selector' => '{{WRAPPER}} ul.page-numbers li, {{WRAPPER}} ul.page-numbers li',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('pagination_style');

    $this->start_controls_tab(
      'pagination_color_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('pagination_normal_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('pagination_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'pagination_normal_border',
        'selector' => '{{WRAPPER}} ul.page-numbers li'
      )
    );

    $this->add_responsive_control(
      'pagination_normal_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'pagination_color_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('pagination_hover_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li a:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('pagination_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li a:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'pagination_hover_border',
        'selector' => '{{WRAPPER}} ul.page-numbers li:hover'
      )
    );

    $this->add_responsive_control(
      'pagination_hover_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );


    $this->end_controls_tab();
    


    $this->start_controls_tab(
      'pagination_color_active',
      array(
        'label' => esc_html__('Active', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('pagination_active_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li .current' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('pagination_active_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li .current' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'pagination_active_border',
        'selector' => '{{WRAPPER}} ul.page-numbers li .current'
      )
    );

    $this->add_responsive_control(
      'pagination_active_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} ul.page-numbers li .current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    $this->start_controls_section('section_read_more_style',
      array(
        'label'     => esc_html__('Read More Style', 'dragfy-addons-for-elementor'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style2'))
      )
    );

    $this->add_responsive_control(
      'read_more_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->start_controls_tabs('read_more_style');

    $this->start_controls_tab(
      'read_more_style_normal',
      array(
        'label' => esc_html__('Normal', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('read_more_text_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'read_more_style_hover',
      array(
        'label' => esc_html__('Hover', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control('read_more_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('read_more_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        
        'selectors' => array(
          '{{WRAPPER}} .df-btn:after' => 'background: {{VALUE}};',
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
    $tags           = $settings['tags'];
    $limit          = $settings['limit'];
    $orderby        = $settings['orderby'];
    $order          = $settings['order'];
    $category       = $settings['category'];
    $author         = $settings['author'];
    $date           = $settings['date'];
    $excerpt_length = $settings['excerpt_length'];
    $pagination     = $settings['pagination'];

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
      'order'          => $order,
      'paged'          => $paged,
      'order'          => 'ID',
    );

    if(!empty($tags[0]) && is_array($tags)) {
      $args['tag_slug__in'] = $tags;
    }

    if(!empty($cats[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => $cats,
        ),
      );
    }
    
    $the_query = new \WP_Query($args); 

    $max_num_pages = $the_query->max_num_pages;

    switch ($style) {
      case 'style':
      default: ?>
        <div class="df-blog-content">
          <div class="df-isotop df-port-col-2 df-has-gutter">
            <div class="df-grid-sizer"></div>

            <?php 
              $i = 0;
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                if($i == 0): 
            ?>
              <div <?php post_class('df-isotop-item df-w100'); ?>>
                <div class="df-post df-style5 df-color1 df-large-post">
                  <?php if(has_post_thumbnail()): ?>
                    <div class="df-zoom">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                    </div>
                  <?php endif; ?>
                  <div class="df-post-info">
                    <div class="df-post-meta">
                      <?php if($category == 'yes'): ?>
                        <div class="df-catagory df-style1">
                          <?php echo get_the_category_list(); ?>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="empty-space marg-lg-b5"></div>
                    <h2 class="df-post-title df-36-lg df-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                    <?php if($author == 'yes' || $date == 'yes'): ?>
                      <div class="df-post-label df-style1">
                        <?php if($author == 'yes'): ?>
                          <span class="df-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                        <?php endif; ?>
                        <?php if($date == 'yes'): ?>
                          <span class="df-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php else: ?>

              <div <?php post_class('df-isotop-item'); ?>>
                <div class="df-post df-style5 df-color1 ">
                  <?php if(has_post_thumbnail()): ?>
                    <div class="df-zoom">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                    </div>
                  <?php endif; ?>
                  <div class="df-post-info">
                    <?php if($category == 'yes'): ?>
                      <div class="df-catagory df-style1">
                        <?php echo get_the_category_list(); ?>
                      </div>
                    <?php endif; ?>
                    <div class="empty-space marg-lg-b5"></div>
                    <h2 class="df-post-title df-f18-lg  df-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>

                    <?php if($author == 'yes' || $date == 'yes'): ?>
                      <div class="df-post-label df-style1">
                        <?php if($author == 'yes'): ?>
                          <span class="df-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                        <?php endif; ?>
                        <?php if($date == 'yes'): ?>
                          <span class="df-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
            <?php endif; $i++; endwhile; wp_reset_postdata(); ?>

          </div>
          <?php if($pagination == 'yes'): Helpers::paging_nav($max_num_pages); endif; ?>
        </div>
        <?php
        # code...
        break;
      
      case 'style2': ?>
        <div class="df-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('df-post df-style13'); ?>>
              <?php if(has_post_thumbnail()): ?>
                <div class="df-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
              <?php endif; ?>
              <div class="df-post-info">
                <div class="empty-space marg-lg-b20"></div>

                <?php if($author == 'yes' || $date == 'yes'): ?>
                  <div class="df-post-label df-style1">
                    <?php if($author == 'yes'): ?>
                      <span class="df-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                    <?php endif; ?>
                    <?php if($date == 'yes'): ?>
                      <span class="df-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>


                <div class="empty-space marg-lg-b5"></div>
                <h2 class="df-post-title df-f28-lg df-m0 df-mt-2 df-mb-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                <div class="empty-space marg-lg-b10"></div>
                <div class="df-f15-lg df-line1-6"><?php echo Helpers::post_excerpt($excerpt_length); ?></div>
                <div class="empty-space marg-lg-b10"></div>
                <div class="df-post-btn"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-btn df-style1 df-type1"><?php echo esc_html__('READ MORE', 'dragfy-addons-for-elementor'); ?></a></div>
              </div>
              <?php echo (($the_query->current_post + 1) !== ( $the_query->post_count )) ? '<div class="empty-space marg-lg-b40"></div>':''; ?>
            </div><!-- .post -->
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php if($pagination == 'yes'): Helpers::paging_nav($max_num_pages); endif; ?>
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
        <div class="df-row df-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('df-col-lg-6'); ?>>
              <div class="df-post df-style13 df-small-post">
                <div class="df-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
                <div class="df-post-info">
                  <div class="empty-space marg-lg-b15"></div>
                  <?php if($category == 'yes'): ?>
                    <div class="df-catagory df-style1 df-color1">
                      <?php echo get_the_category_list(); ?>
                    </div>
                  <?php endif; ?>
                  <div class="empty-space marg-lg-b10"></div>
                  <h2 class="df-post-title df-f18-lg df-m0 df-mt-2 df-mb-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  <div class="empty-space marg-lg-b10"></div>
                  <div class="df-f14-lg df-line1-6"><?php echo Helpers::post_excerpt($excerpt_length); ?></div>
                  <div class="empty-space marg-lg-b5"></div>
                </div>
              </div>
            </div><!-- .col -->
          <?php endwhile; wp_reset_postdata(); ?>
          <div class="empty-space marg-lg-b20"></div>
          <?php if($pagination == 'yes'): Helpers::paging_nav($max_num_pages); endif; ?>
        </div><!-- .row -->

        <?php
        break;
      case 'style4': ?>
        <div class="df-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('df-post df-style8 df-small-post df-type1'); ?>>
              <div class="df-zoom">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
              </div>
              <div class="df-post-info">
                <?php if($category == 'yes'): ?>
                  <div class="df-catagory df-style1 df-color1">
                    <?php echo get_the_category_list(); ?>
                  </div>
                <?php endif; ?>
                <div class="empty-space marg-lg-b10"></div>
                <h2 class="df-post-title df-f21-lg df-m0 df-mt-4 df-mb-5"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                <div class="empty-space marg-lg-b15"></div>
                <div class="df-f14-lg df-line1-6">
                 <?php echo Helpers::post_excerpt($excerpt_length); ?>
                </div>
              </div>
            </div><!-- .post -->
          <?php endwhile; wp_reset_postdata(); ?>
          <?php if($pagination == 'yes'): Helpers::paging_nav($max_num_pages); endif; ?>
        </div>
      <?php
      break;
      case 'style5': ?>
        <div class="df-row df-post-outerwrapper">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('df-col-lg-3 df-col-sm-6'); ?>>
              <div class="df-post df-style11">
                <div class="df-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
                <div class="df-post-info">
                  <div class="empty-space marg-lg-b15"></div>
                  <h2 class="df-post-title df-f16-lg df-m0 df-mt-3"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>

                  <?php if($author == 'yes' || $date == 'yes'): ?>
                    <div class="df-post-label df-style1">
                      <?php if($author == 'yes'): ?>
                        <span class="df-post-author-name vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                      <?php endif; ?>
                      <?php if($date == 'yes'): ?>
                        <span class="df-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
          <?php if($pagination == 'yes'): Helpers::paging_nav($max_num_pages); endif; ?>
        </div>
        <?php
        break;

      case 'style6': ?>
        <div class="df-isotop df-style1 df-port-col-2 df-has-gutter">
          <div class="df-grid-sizer"></div>
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div <?php post_class('df-isotop-item'); ?>>
              <div class="df-post df-style12 <?php echo ($the_query->current_post == 0) ? 'df-large-post':''; ?>">
                <div class="df-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="df-post-thumb df-zoom-in1 df-bg" style="background-image: url(<?php echo esc_url($this->get_image_src(get_post_thumbnail_id())); ?>);"></a>
                </div>
                <div class="df-post-info">
                  <?php if($category == 'yes'): ?>
                    <div class="df-catagory df-style1 df-color1">
                      <?php echo get_the_category_list(); ?>
                    </div>
                  <?php endif; ?>
                  <h2 class="df-post-title df-f24-lg df-white-c df-mb-6"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo wp_trim_words( get_the_title(), 6, '...'); ?></a></h2>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php if($pagination == 'yes'): Helpers::paging_nav($max_num_pages); endif; ?>
        <?php
        # code...
        break;
    }
  }
}
