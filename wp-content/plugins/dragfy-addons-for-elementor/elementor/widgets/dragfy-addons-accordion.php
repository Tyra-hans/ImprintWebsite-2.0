<?php 
namespace DragfyAddons\Elementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        Dragfy
 * @category      Classes
 * @author        Dragfy
 */
class Dragfy_Addons_Accordion extends Widget_Base {

  public function get_name() {
    return 'dragfy-addons-accordion';
  }

  public function get_title() {
    return 'Accordion';
  }

  public function get_icon() {
    return 'elem_icon accordion';
  }

  public function get_script_depends() {
    return array('dragfy-addons');
  }

  public function get_style_depends() {
    return array('accordian', 'dragfy-addons');
  }

  public function get_categories() {
    return array('dragfy-addons-for-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'accordion_general_settings',
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
        )
      )
    );

    $this->add_control(
      'active_item',
      array(
        'label'       => esc_html__('Active Item', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('1', 'dragfy-addons-for-elementor')
      )
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'accordion_content_settings',
      array(
        'label' => esc_html__('Content Settings' , 'dragfy-addons-for-elementor')
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
        'description' => esc_html__('This field is only for Style 3 & 4', 'dragfy-addons-for-elementor'),
      )
    );

    $repeater->add_control(
      'show_icon',
      array(
        'label'       => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::SWITCHER,
        'description' => esc_html__('This field is only for Style 2', 'dragfy-addons-for-elementor'),
        'default'     => 'no'
      )
    );

    $repeater->add_control(
      'selected_icon',
      array(
        'label'            => esc_html__('Icon', 'dragfy-addons-for-elementor'),
        'type'             => Controls_Manager::ICONS,
        'fa4compatibility' => 'icon',
        'condition'        => array('show_icon' => array('yes')),
        'default' => array(
          'value'   => 'fas fa-star',
          'library' => 'fa-solid',
        ),
      )
    );

    $repeater->add_control(
      'accordion_title',
      array(
        'label'       => esc_html__('Title', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Accordion Title', 'dragfy-addons-for-elementor')
      )
    );

    $repeater->add_control(
      'accordion_content',
      array(
        'label'       => esc_html__('Content', 'dragfy-addons-for-elementor'),
        'label_block' => true,
        'default'     => esc_html__('Accordion Content', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::WYSIWYG
      )
    );

    $this->add_control(
      'accordion_items',
      array(
        'label'   => esc_html__('Items', 'dragfy-addons-for-elementor'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'accordion_title'   => esc_html__('Accordion #1', 'dragfy-addons-for-elementor'),
            'accordion_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dragfy-addons-for-elementor')
          ),
          array(
            'accordion_title'   => esc_html__('Accordion #2', 'dragfy-addons-for-elementor'),
            'accordion_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dragfy-addons-for-elementor')
          ),
        ),
        'title_field' => '{{ accordion_title }}',
      )
    );

    $this->end_controls_section();

    

    $this->start_controls_section('section_accordion_style',
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
        'selector'  => '{{WRAPPER}} .df-accordian-wrap',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .df-accordian-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .df-accordian-wrap'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'dragfy-addons-for-elementor'),
        'selector'  => '{{WRAPPER}} .df-accordian-wrap',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_accordion_title_style',
      array(
        'label' => esc_html__('Title Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'title_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-accordian-title',
      )
    );

    $this->add_control('title_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-title, {{WRAPPER}} .df-accordian-toggle' => 'color: {{VALUE}};',
          '{{WRAPPER}} .df-accordian-btn:before, {{WRAPPER}} .df-accordian-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'title_border',
        'selector' => '{{WRAPPER}} .df-accordian-title'
      )
    );

    $this->add_responsive_control(
      'title_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .df-accordian-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'title_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_accordion_content_style',
      array(
        'label' => esc_html__('Content Style', 'dragfy-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'content_background',
        'label'     => esc_html__('Background', 'dragfy-addons-for-elementor'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .df-accordian-body',
      )
    );

    $this->add_control('content_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'dragfy-addons-for-elementor'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-body' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'content_border',
        'selector' => '{{WRAPPER}} .df-accordian-body'
      )
    );

    $this->add_responsive_control(
      'content_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .df-accordian-body',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'content_margin',
      array(
        'label'      => esc_html__('Margin', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'content_padding',
      array(
        'label'      => esc_html__('Padding', 'dragfy-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .df-accordian-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 
    $settings        = $this->get_settings_for_display();
    $style           = $settings['style'];
    $accordion_items = $settings['accordion_items'];
    $active_item     = $settings['active_item'];
  
    switch ($style) {
      case 'style1': default: ?>
        <div class="df-accordian-wrap df-style1">
          <?php 
            foreach($accordion_items as $key => $item): 
              $active_nav = ( ( $key + 1 ) == $active_item ) ? ' active ' : '';
              $title      = $item['accordion_title'];
              $content    = $item['accordion_content'];
          ?>
            <div class="df-accordian<?php echo esc_attr($active_nav); ?>">
              <div class="df-accordian-title df-fw-regular df-f18-lg df-black111-c df-font-name">
                <?php echo esc_html($title); ?> 
                <span class="df-accordian-toggle fa fa-angle-down"></span>
              </div>
              <div class="df-accordian-body"><?php echo wp_kses_post($content); ?></div>
            </div><!-- .df-accordian -->
          <?php endforeach; ?>

        </div><!-- .df-accordian-wrap -->
        <?php
        # code...
        break;

      case 'style2': ?>

        <div class="df-faq-wrap df-accordian-wrap df-style2">

          <?php 
            foreach($accordion_items as $key => $item):
              $active_nav    = ( ( $key + 1 ) == $active_item ) ? ' active ' : '';
              $title         = $item['accordion_title'];
              $show_icon     = $item['show_icon'];
              $selected_icon = $item['selected_icon'];
              $content       = $item['accordion_content'];
          ?>
            <div class="df-accordian <?php echo esc_attr($active_nav); ?> df-style2 df-051e31-c df-line1-6">
              <div class="df-accordian-title">
                <?php if($show_icon == 'yes'): ?>
                  <div class="df-accordian-icon">
                    <?php if(is_array($selected_icon) && $selected_icon['library'] == 'svg'): ?>
                      <img src="<?php echo esc_url($selected_icon['value']['url']); ?>" alt="icon">
                    <?php else: ?>
                      <i class="<?php echo esc_attr($selected_icon['value']); ?>"></i>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
                <?php echo esc_html($title); ?> <span class="df-accordian-btn"></span></div>
              <div class="df-accordian-body">
                <?php echo wp_kses_post($content); ?>
              </div>
            </div>
            <div class="empty-space marg-lg-b10 marg-sm-b10"></div>
          <?php endforeach; ?>

        </div>

        <?php
        # code...
        break;

    case 'style3': 
    case 'style4': ?>
      <div class="df-gallery-accordian df-accordian-wrap <?php echo ($style == 'style3') ? 'df-horizontal':'df-vertical'; ?>">

        <?php 
            foreach($accordion_items as $key => $item):
              $active_nav = ( ( $key + 1 ) == $active_item ) ? ' active ' : '';
              $title      = $item['accordion_title'];
              $image      = $item['image'];
              $show_icon  = $item['show_icon'];
              $content    = $item['accordion_content'];
        ?>

          <div class="df-gallery-accordian-in df-bg <?php echo esc_attr($active_nav); ?>">
            <div class="df-gallery-accordian-img df-bg" style="background-image: url(<?php echo esc_url($image['url']); ?>);">
              <div class="df-gallery-accordian-text">
                <h2 class="df-gallery-accordian-title df-accordian-title"><?php echo esc_html($title); ?></h2>
                <div class="df-gallery-accordian-subtitle df-accordian-body"> <?php echo wp_kses_post($content); ?></div>
              </div>
            </div>
          </div>

        <?php endforeach; ?>

      </div><!-- .df-gallery-accordian -->
      <?php
      # code...
      break;


    }

  }

}
