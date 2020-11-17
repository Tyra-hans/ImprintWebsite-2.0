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
class Webify_Count_Down_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-count-down-widget';
  }

  public function get_title() {
    return 'Count Down';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-token-sale');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'count_down_section',
      array(
        'label' => esc_html__('Count Down' , 'webify-addons')
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
        ),
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__('Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'condition'   => array('style' => array('style1'))        
      )
    );

    $this->add_control(
      'sub_heading',
      array(
        'label'       => esc_html__('Sub Heading', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'condition'   => array('style' => array('style1'))
      )
    );

    $this->add_control(
      'year',
      array(
        'label'       => esc_html__('Year', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => '2019',
        'label_block' => true,
      )
    );

    $this->add_control(
      'month',
      array(
        'label'       => esc_html__('Month', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => '12',
        'label_block' => true,
      )
    );


    $this->add_control(
      'day',
      array(
        'label'       => esc_html__('Day', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => '02',
        'label_block' => true,
      )
    );

    $this->add_control(
      'hour',
      array(
        'label'       => esc_html__('Hour', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => '03',
        'label_block' => true,
      )
    );

    $this->add_control(
      'minute',
      array(
        'label'       => esc_html__('Minute', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => '45',
        'label_block' => true,
      )
    );

    $this->add_control(
      'second',
      array(
        'label'       => esc_html__('Second', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => '26',
        'label_block' => true,
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'condition'   => array('style' => array('style1'))
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
        'condition'   => array('style' => array('style1'))
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_style_heading',
      array(
        'label' => esc_html__('Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tb-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_sub_heading',
      array(
        'label' => esc_html__('Sub Heading', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('sub_heading_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'sub_heading_typography',
        'selector' => '{{WRAPPER}} .tb-sub-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_count_number',
      array(
        'label' => esc_html__('Count Number', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('count_number_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-count-no' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'count_number_typography',
        'selector' => '{{WRAPPER}} .tb-count-no',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_button_style',
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

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .tb-btn',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('btn_bg_color_hover', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'border-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .tb-text-box-btn .tb-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();

  }

  protected function render() { 
    $settings    = $this->get_settings();
    $style       = $settings['style'];
    $heading     = $settings['heading'];
    $sub_heading = $settings['sub_heading'];
    $year        = $settings['year'];
    $month       = $settings['month'];
    $day         = $settings['day'];
    $hour        = $settings['hour'];
    $minute      = $settings['minute'];
    $second      = $settings['second'];
    $btn_text    = $settings['btn_text'];
    $href        = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target      = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';

    $data_count_date = '';

    if($year && $month && $day && $hour && $minute && $second) {
      $data_count_date = ' data-countdate="'.esc_attr($year).'-'.esc_attr($month).'-'.esc_attr($day).'T'.esc_attr($hour).':'.esc_attr($minute).':'.esc_attr($second).'"';
    }


    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-countdown-wrap text-center tb-box-shadow1">
          <div class="tb-countdown-heading">
            <?php if(!empty($heading)): ?>
              <h3 class="tb-f24-lg tb-mb4 tb-heading"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>
            <?php if(!empty($sub_heading)): ?>
              <div class="tb-sub-heading"><?php echo esc_html($sub_heading); ?></div>
            <?php endif; ?>
          </div>
          <hr>
          <div id="tb-if-expired" class="tb-countdown tb-if-expired"<?php echo wp_kses_post($data_count_date); ?>>
            
            <div class="tb-countdown-element">
              <h3 id="tb-count-days" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
              <div class="empty-space marg-lg-b5"></div>
              <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_html__('Days', 'webify-addons'); ?></div>
            </div>

            <div class="tb-countdown-element">
              <h3 id="tb-count-hours" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
              <div class="empty-space marg-lg-b5"></div>
              <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_html__('Hours', 'webify-addons'); ?></div>
            </div>
            <div class="tb-countdown-element">
              <h3 id="tb-count-minutes" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
              <div class="empty-space marg-lg-b5"></div>
              <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_html__('Minutes', 'webify-addons'); ?></div>
            </div>
            <div class="tb-countdown-element">
              <h3 id="tb-count-seconds" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
              <div class="empty-space marg-lg-b5"></div>
              <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_html__('Seconds', 'webify-addons'); ?></div>
            </div>
          </div><!-- .tb-countdown -->
          <?php if(!empty($btn_text)): ?>
            <div class="tb-countdown-btn">
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style3 tb-color6 w-100"><?php echo esc_html($btn_text); ?></a>
            </div>
          <?php endif; ?>
          <div class="empty-space marg-lg-b30"></div>
        </div><!-- .tb-countdown-wrap -->
        <?php
        # code...
        break;
      
      case 'style2': ?>
        <div id="tb-if-expired" class="tb-countdown tb-if-expired tb-style2"<?php echo wp_kses_post($data_count_date); ?>>
          <div class="tb-countdown-element">
            <h3 id="tb-count-days" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
            <div class="empty-space marg-lg-b5"></div>
            <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_attr('Days', 'webify-addons'); ?></div>
          </div>
          <div class="tb-countdown-element">
            <h3 id="tb-count-hours" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
            <div class="empty-space marg-lg-b5"></div>
            <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_attr('Hours', 'webify-addons'); ?></div>
          </div>
          <div class="tb-countdown-element">
            <h3 id="tb-count-minutes" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
            <div class="empty-space marg-lg-b5"></div>
            <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_attr('Minutes', 'webify-addons'); ?></div>
          </div>
          <div class="tb-countdown-element">
            <h3 id="tb-count-seconds" class="tb-count-no tb-f60-lg tb-f38-sm tb-line1 tb-m0"></h3>
            <div class="empty-space marg-lg-b5"></div>
            <div class="tb-f12-lg tb-line1-6 text-uppercase tb-grayb5b5b5-c tb-fw-light"><?php echo esc_attr('Seconds', 'webify-addons'); ?></div>
          </div>
        </div><!-- .tb-countdown -->
        <?php
        # code...
        break;
    }

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Count_Down_Widget() );