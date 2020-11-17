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
class Webify_Category_Block_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-category-block-widget';
  }

  public function get_title() {
    return 'Category Block';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-post');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  public function get_custom_term_values($type) {
    $items = array();
    $terms = get_terms($type, array('orderby' => 'name'));
    if (is_array($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        $items[$term->name] = $term->slug;
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
      'category_block_section',
      array(
        'label' => esc_html__('Category Block' , 'webify-addons')
      )
    );

    $this->add_control(
      'cats',
      array(
        'label'       => esc_html__('Categories', 'webify-addons'),
        'description' => esc_html__('Specifies a category that you want to show category from it.', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'label_block' => true,
        'options'     => array_flip($this->get_custom_term_values('category')),
        'default'     => array(''),
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


        $this->start_controls_section('section_meta_style',
      array(
        'label' => esc_html__('Meta Style', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('meta_style');

    $this->start_controls_tab(
      'meta_color_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('meta_normal_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-label a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
      'meta_color_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );


    $this->add_control('meta_hover_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-post-label a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'meta_typography',
        'selector' => '{{WRAPPER}} .tb-post-label a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings();
    $cats     = $settings['cats'];
    $orderby  = $settings['orderby'];
    
    $args = array(
      'orderby' => $orderby,
      'slug'    => $cats
    );

    $categories = get_categories($args);
    if(!is_wp_error($categories)):
  ?>
    <ul class="tb-post-style10-list row">
      <?php foreach($categories as $term):
        $thumbnail = get_term_meta($term->term_id, 'category_image');
        if(is_array($thumbnail) && !empty($thumbnail[0]['url'])):
      ?>
        <li>
          <div class="tb-post tb-style10">
            <div class="tb-zoom">
              <a href="<?php echo get_category_link($term->term_id); ?>" class="tb-post-thumb tb-zoom-in1 tb-bg" style="background-image: url(<?php echo esc_url($thumbnail[0]['url']); ?>);"></a>
            </div>
            <div class="tb-post-info">
              <div class="empty-space marg-lg-b15"></div>
              <h2 class="tb-post-title tb-f18-lg tb-m0 tb-mt-3"><a href="<?php echo get_category_link($term->term_id); ?>"><?php echo esc_html($term->name); ?></a></h2>
              <div class="tb-post-label tb-style1">
                <span class="tb-post-number"><a href="<?php echo get_category_link($term->term_id); ?>"><?php echo esc_html($term->count); ?> <?php echo esc_html__('articles', 'webify-addons'); ?></a></span>
              </div>
            </div>
          </div>
        </li>
      <?php endif; endforeach; ?>
    </ul>
  <?php endif;

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Category_Block_Widget() );