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
class Webify_Image_Box_Slider_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-box-slider-widget';
  }

  public function get_title() {
    return 'Image Box Slider';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-image-box', 'webify-button', 'webify-slider', 'slick');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'image_box_slider_section',
      array(
        'label' => esc_html__('Image Box Slider' , 'webify-addons')
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
      'image',
      array(
        'label'       => esc_html__(' Image', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
        'default'     => array('url' => \Elementor\Utils::get_placeholder_image_src()),
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Super Creative', 'webify-addons')       
      )
    );

    $repeater->add_control(
      'lists',
      array(
        'label'       => esc_html__('List(s)', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'default'     => esc_html__('Wollo Token Sale Starts 5th September at Midday|Educating children about the future of money', 'webify-addons'),
        'description' => esc_html__('Adding | in between sentence makes lists.'),
        'label_block' => true,
      )
    );

    

    $repeater->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons')
      )
    );

    $repeater->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#')
      )
    );


    $this->add_control(
      'image_boxes',
      array(
        'label'   => esc_html__('Image Boxes', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'image'       => array('url' => \Elementor\Utils::get_placeholder_image_src()),
            'title'       => esc_html__('Super Creative', 'webify-addons'),
            'description' => esc_html__('You can choose from 320+ icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'webify-addons'),
            'link_text'   => esc_html__('Learn More', 'webify-addons'),
            'link_url'    => array('url' => '#')
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_title_color',
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
          '{{WRAPPER}} .tb-image-box .tb-image-box-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-image-box .tb-image-box-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_lists_color',
      array(
        'label' => esc_html__('Lists', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('lists_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box .tb-image-box-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('lists_tick_color', 
      array(
        'label'       => esc_html__('Icon Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box-text i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'lists_typography',
        'selector' => '{{WRAPPER}} .tb-image-box .tb-image-box-text',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

        $this->start_controls_section('section_link_style',
      array(
        'label' => esc_html__('Link', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('link_style');

    $this->start_controls_tab(
      'link_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('link_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box .tb-btn' => 'color: {{VALUE}};',
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

    $this->add_control('link_text_color_hover', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-image-box.tb-style3:hover a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

  }

  protected function render() { 
    $settings    = $this->get_settings();
    $image_boxes = $settings['image_boxes'];
    $loop        = $settings['loop'];
    $speed       = $settings['speed'];
    $autoplay    = $settings['autoplay'];
    $delay       = $settings['delay'];
    $loop        = ($loop == 'yes') ? 1:0;
    $autoplay    = ($autoplay == 'yes') ? 1:0;

  ?>


  <?php if(is_array($image_boxes) && !empty($image_boxes)): ?>
    <div class="tb-full-widh-slider-padding">
      <div class="tb-mobile-padd15">
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-delay="<?php echo esc_attr($delay); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="6">
              <div class="slick-wrapper">

                <?php 
                  foreach($image_boxes as $box): 

                    $lists     = array();
                    if (strpos($box['lists'], '|') !== false) {
                      $lists = explode('|', $box['lists']);
                    }

                    $link_url = $box['link_url'];
                    $href     = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
                    $target   = ($link_url['is_external'] == 'on') ? '_blank' : '_self';
                ?>
                <div class="slick-slide">
                  <div class="tb-slick-inner-pad">
                    <div class="tb-image-box tb-style3 tb-zoom tb-radious-4 tb-relative tb-border">
                      <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-link-wrap"></a>
                        <div class="tb-image tb-overflow-hidden tb-radious-4">
                          <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($box['image']['url']); ?>);"></div>
                        </div>
                      <div class="tb-image-meta">
                        <h3 class="tb-f18-lg tb-font-name tb-mt-3 tb-mb-4"><?php echo esc_html($box['title']); ?></h3>
                        <div class="empty-space marg-lg-b30"></div>
                        <?php if(is_array($lists) && !empty($lists)): ?>
                          <ul class="tb-mp0 tb-list tb-image-box-text tb-mb-6 tb-mt-6">
                            <?php foreach($lists as $list): ?>
                              <li><i class="fa fa-check"></i><?php echo esc_html($list); ?></li>
                            <?php endforeach; ?>
                          </ul>
                      <?php endif; ?>
                      </div>
                      <div class="tb-image-box-btn">
                        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style2"><?php echo esc_html($box['link_text']); ?> <i class="fa fa-angle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div><!-- .slick-slide -->
              <?php endforeach; ?>

              </div>
            </div><!-- .slick-container -->
          </div>
          <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
          <div class="swipe-arrow tb-style1"> <!-- If dont need navigation then add class .tb-hidden -->
            <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
          </div>
        </div><!-- .tb-carousor -->
      </div>
    </div>
   <?php endif;
    
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Box_Slider_Widget() );