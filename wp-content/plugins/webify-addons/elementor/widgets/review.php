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
class Webify_Review_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-review-widget';
  }

  public function get_title() {
    return 'Review';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array();
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'review_section',
      array(
        'label' => esc_html__('Review' , 'webify-addons')
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'webify-addons'),
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
        'label_block' => true,
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Excellent ICO', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'comment',
      array(
        'label'       => esc_html__('Comment', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Webify is an end-to-end solution for launching compliant security tokens.', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
      )
    );

    $this->add_control(
      'rating',
      array(
        'label'       => esc_html__('Rating Value', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('4.7', 'webify-addons'),
        'description' => esc_html__('Enter rating value in between 1 - 5', 'webify-addons')
      )
    );

    $this->add_control(
      'stretch_image',
      array(
        'label'     => esc_html__('Stretch Image', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'separator' => 'after',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_title',
      array(
        'label' => esc_html__('Title', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('title_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-review-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-review-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_comment',
      array(
        'label' => esc_html__('Comment', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('comment_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-comment' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'comment_typography',
        'selector' => '{{WRAPPER}} .tb-comment',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_icon',
      array(
        'label' => esc_html__('Icon', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tb-review-number span, {{WRAPPER}} .tb-review-wrap i, .tb-review-number' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings      = $this->get_settings(); 
    $image         = $settings['image'];
    $title         = $settings['title'];
    $comment       = $settings['comment'];
    $rating        = $settings['rating'];
    $stretch_image = $settings['stretch_image'];
    $style         = ($stretch_image) ? ' style="width:100%;"':'';
    if(empty($image['url'])) { return; }
  ?>

    <div class="tb-experts-review tb-box-shadow1">
      <div class="tb-experts-review-in">
        <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="image"<?php echo wp_kses_data($style); ?>>
        <?php endif; ?>
        <div class="tb-expert-comment">
          <?php if(!empty($title)): ?>
            <h3 class="tb-f14-lg tb-font-name tb-review-title tb-mb10"><?php echo esc_html($title); ?></h3>
          <?php endif; ?>
          <?php if(!empty($comment)): ?>
            <div class="tb-comment"><?php echo wp_kses_post($comment); ?></div>
          <?php endif; ?>
        </div>
      </div>
      <?php if(!empty($rating)): ?>
        <hr>
        <div class="tb-review-wrap">
          <div class="tb-review tb-style1">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <div class="tb-review-number"><span><?php echo esc_html($rating); ?>/</span>5</div>
        </div>
      <?php endif; ?>
    </div>

    <?php

  }
    
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Review_Widget() );