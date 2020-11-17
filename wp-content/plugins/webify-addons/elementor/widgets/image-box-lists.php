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
class Webify_Image_Box_Lists_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-box-lists-widget';
  }

  public function get_title() {
    return 'Image Box Lists';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-button', 'webify-image-box');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'image_box_lists_section',
      array(
        'label' => esc_html__('Image Box Lists' , 'webify-addons')
      )
    );


    $repeater = new Repeater();

    $repeater->add_control(
      'thumbnail',
      array(
        'label'       => esc_html__('Thumbnail', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'placeholder' => esc_html__('Episode 221: Take control of your commute with Google Maps', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'placeholder' => esc_html__('Enthusiastic web designer with 6 years of experience. Responsible for all web design duties at Amphimia Global, Inc. including...', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXTAREA
      )
    );

    $repeater->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Play Now', 'webify-addons'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->add_control(
      'image_box_lists',
      array(
        'label'       => esc_html__('Image Box Lists', 'webify-addons'),
        'type'        => Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'separator'   => 'before',
        'default' => array(
          array(
            'thumbnail' => array('url' => \Elementor\Utils::get_placeholder_image_src()),
            'title'     => esc_html__('Episode 221: Take control of your commute with Google Maps', 'webify-addons'),
            'content'   => esc_html__('Enthusiastic web designer with 6 years of experience. Responsible for all web design duties at Amphimia Global, Inc. including...', 'webify-addons'),
            'btn_text'  => esc_html__('Play Now', 'webify-addons')
          ), 
        ), 
        'title_field' => '<span>{{ title }}</span>',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-image-box-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_content_style',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box-content' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-image-box-content',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_btn_style',
      array(
        'label' => esc_html__('Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('btn_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box.tb-style6:hover .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box.tb-style6:hover .tb-btn' => 'background: {{VALUE}}; border-color:{{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 
    $settings        = $this->get_settings_for_display();
    $image_box_lists = $settings['image_box_lists'];
    if(!empty($image_box_lists) && is_array($image_box_lists)):
  ?>

    <div class="tb-image-box6-wrap">
      <?php 
        foreach($image_box_lists as $list): 
          $href   = (!empty($list['btn_link']['url']) ) ? $list['btn_link']['url'] : '#';
          $target = ($list['btn_link']['is_external'] == 'on') ? '_blank' : '_self';
      ?>
        <div class="tb-image-box tb-style6 tb-zoom">
          <div class="tb-image">
            <div class="tb-image-in tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($list['thumbnail']['url']); ?>);"></div>
          </div>
          <div class="tb-image-box-meta">
            <div class="tb-image-box-info">
              <h3 class="tb-image-box-title tb-f16-lg tb-mt-2 tb-m0"><?php echo esc_html($list['title']); ?></h3>
              <div class="empty-space marg-lg-b10 marg-sm-b10"></div>
              <div class="tb-image-box-subtitle tb-image-box-content tb-mb-6"><?php echo esc_html($list['content']); ?></div>
            </div>
            <div class="tb-image-box-btn"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style9"><?php echo esc_html($list['btn_text']); ?></a></div>
          </div>
        </div><!-- .tb-image-box -->
      <?php endforeach; ?>  
    </div>
  <?php endif;

  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Box_Lists_Widget() );