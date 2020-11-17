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
class Webify_Icon_Box_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-icon-box-slider-widget';
  }

  public function get_title() {
    return 'Icon Box Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('slick', 'webify-text-box', 'webify-slider', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'icon_box_slider_section',
      array(
        'label' => esc_html__('Icon Box Slider' , 'webify-addons')
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__('Style', 'webify-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'separator' => 'after',
        'options' => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
      )
    );

    $this->add_control(
      'bg_image',
      array(
        'label'     => esc_html__('Background Image', 'webify-addons'),
        'separator' => 'after',
        'type'      => Controls_Manager::MEDIA,
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
        'default'     => 600
      )
    );


    $repeater = new Repeater();

    $repeater->add_control(
      'count_text',
      array(
        'label'       => esc_html__('Count Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your count text here.', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('673', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'description' => esc_html__('This field is only for Style 1', 'webify-addons')
      )
    );

    $repeater->add_control(
      'icon',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => Controls_Manager::ICON,
        'options'     => webify_get_icons(),
        'label_block' => true,
        'default'     => 'fa fa-star',
        'description' => esc_html__('This field is only for Style 2', 'webify-addons')
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'placeholder' => esc_html__('Enter your title here.', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::TEXT
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'placeholder' => esc_html__('Enter your description here.', 'webify-addons'),
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
        'default'     => esc_html__('Learn More', 'webify-addons'),
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
      'items',
      array(
        'label'       => esc_html__('Items', 'webify-addons'),
        'type'        => Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'separator'   => 'before',
        'default' => array(
          array(
            'title'    => esc_html__('Projects Completed', 'webify-addons'),
            'content'  => esc_html__('Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation ensure proactive.', 'webify-addons', 'webify-addons'),
            'btn_text' => esc_html__('Learn More', 'webify-addons')
          ),
          array(
            'title'    => esc_html__('Projects Completed', 'webify-addons'),
            'content'  => esc_html__('Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation ensure proactive.', 'webify-addons', 'webify-addons'),
            'btn_text' => esc_html__('Learn More', 'webify-addons')
          ),
        ), 
        'title_field' => '<span>{{ title }}</span>',
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_icon_style',
      array(
        'label' => esc_html__('Icon', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-icon-box-slider i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_count_style',
      array(
        'label' => esc_html__('Count', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('count_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-text-box-slider .tb-text-box-slider-count-item' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'count_typography',
        'selector' => '{{WRAPPER}} .tb-text-box-slider .tb-text-box-slider-count-item',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
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
          '{{WRAPPER}} .tb-text-box-slider-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-text-box-slider-title',
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
          '{{WRAPPER}} .tb-text-box-slider-content' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-text-box-slider-content',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_bg_hover_style',
      array(
        'label' => esc_html__('Background on Hover', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors'   => array(
          '{{WRAPPER}} .tb-text-box.tb-style2.tb-type1:hover .tb-text-box-in' => 'background-color: {{VALUE}};',
        ),
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
          '{{WRAPPER}} .tb-text-box-in .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-text-box-in .tb-btn:before' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'link_style_hover',
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
          '{{WRAPPER}} tb-text-box-in .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-text-box-in .tb-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 
    $settings   = $this->get_settings_for_display();
    $bg_image   = $settings['bg_image'];
    $style      = $settings['style'];
    $items      = $settings['items'];
    $autoplay   = $settings['autoplay'];
    $loop       = $settings['loop'];
    $delay      = $settings['delay'];
    $speed      = $settings['speed'];
    $loop       = ($loop == 'yes') ? 1:0;
    $autoplay   = ($autoplay == 'yes') ? 1:0;
    $style_attr = (is_array($bg_image) && !empty($bg_image)) ? ' style="background-image:url('.$bg_image['url'].')"':''; 



    if(is_array($items) && !empty($items)):

      switch ($style) {
        default:
        case 'style1': ?>
          <div class="tb-overflow-hidden">
            <div class="tb-arrow-closest tb-poind-closest tb-slider tb-text-box-slider tb-style1 tb-bg"<?php echo wp_kses_post($style_attr); ?>>
              <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
                <div class="slick-wrapper">

                  <?php 
                    foreach($items as $item): 
                      $href   = (!empty($item['btn_link']['url']) ) ? $item['btn_link']['url'] : '#';
                      $target = ($item['btn_link']['is_external'] == 'on') ? '_blank' : '_self';

                  ?>
                    <div class="slick-slide">
                      <div class="tb-text-box tb-style2">
                        <div class="tb-text-box-in">
                          <h2 class="tb-special-text tb-text-box-slider-count-item tb-f48-lg tb-line0-9 tb-white-c  tb-m0 tb-mb-3"><?php echo esc_html($item['count_text']); ?></h2>
                          <div class="empty-space marg-lg-b20"></div>
                          <h3 class="tb-font-name tb-f18-lg tb-text-box-slider-title tb-white-c tb-font-name tb-m0 tb-mt-3 tb-mb-6"><?php echo esc_html($item['title']); ?></h3>
                          <div class="empty-space marg-lg-b20"></div>
                          <div class="tb-white-c7 tb-text-box-slider-content  tb-mb-6 tb-mt-6"><?php echo wp_kses_post($item['content']); ?></div>
                          <div class="tb-text-box-btn">
                            <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style1"><?php echo esc_html($item['btn_text']); ?></a>
                          </div>
                        </div>
                      </div>
                    </div><!-- .slick-slide -->
                  <?php endforeach; ?>

                </div>
              </div><!-- .slick-container -->
              <div class="pagination tb-style2 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
                <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
              </div>
            </div><!-- .tb-carousor -->
          </div>
        <?php
         # code...
        break;
       
        case 'style2': ?>
        <div class="tb-overflow-hidden">
          <div class="tb-arrow-closest tb-poind-closest tb-icon-box-slider tb-slider tb-style1 tb-type1 tb-bg" <?php echo wp_kses_post($style_attr); ?>>
            <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
              <div class="slick-wrapper">
                <?php 
                  foreach($items as $item): 
                    $href   = (!empty($item['btn_link']['url']) ) ? $item['btn_link']['url'] : '#';
                    $target = ($item['btn_link']['is_external'] == 'on') ? '_blank' : '_self';
                ?>
                  <div class="slick-slide">
                    <div class="tb-text-box tb-style2 tb-type1">
                      <div class="tb-text-box-in">
                        <h2 class="tb-special-text tb-f48-lg tb-line0-9 tb-white-c  tb-m0 tb-mb-3"><i class="<?php echo esc_attr($item['icon']); ?>"></i></h2>
                        <div class="empty-space marg-lg-b20"></div>
                        <h3 class="tb-font-name tb-f18-lg tb-text-box-slider-title tb-white-c tb-font-name tb-m0 tb-mt-3 tb-mb-6"><?php echo esc_html($item['title']); ?></h3>
                        <div class="empty-space marg-lg-b20"></div>
                        <div class="tb-white-c6  tb-line1-5 tb-text-box-slider-content tb-mb-6 tb-mt-6"><?php echo wp_kses_post($item['content']); ?></div>
                        <div class="tb-text-box-btn">
                          <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style1"><?php echo esc_html($item['btn_text']); ?></a>
                        </div>
                      </div>
                    </div>
                  </div><!-- .slick-slide -->
                <?php endforeach; ?>
              </div>
            </div><!-- .slick-container -->
            <div class="pagination tb-style1 tb-type1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
            <div class="swipe-arrow tb-style3"> <!-- If dont need navigation then add class .tb-hidden -->
              <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
              <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
            </div>
          </div><!-- .tb-carousor -->
        </div>
        <?php
        break;
      } 
    endif;
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Icon_Box_Slider_Widget() );