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
class Webify_Pricing_Table_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-pricing-table-widget';
  }

  public function get_title() {
    return 'Pricing Table';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-pricing-table', 'webify-button');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'pricing_section',
      array(
        'label' => esc_html__('Pricing Table' , 'webify-addons')
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
        )
      )
    );

    $this->add_control(
      'is_featured',
      array(
        'label'       => esc_html__('Is this Featured ?', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'no',
        'label_block' => true,
        'condition'   => array('style' => array('style2')),
        'options' => array(
          'no'  => 'No',
          'yes' => 'Yes',
        )
      )
    );

    $this->add_control(
      'plan',
      array(
        'label'       => esc_html__('Plan', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Standard', 'webify-addons'),
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'currency',
      array(
        'label'       => esc_html__('Currency', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('$', 'webify-addons'),
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'price',
      array(
        'label'       => esc_html__('Price', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('499', 'webify-addons'),
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'duration',
      array(
        'label'       => esc_html__('Duration', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('month', 'webify-addons'),
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1'))
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'icon',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => \Elementor\Controls_Manager::ICON,
        'options'     => webify_get_icons(),
        'default'     => 'fa fa-check',
        'label_block' => true,
        'description' => esc_html__('This option is only for Style 1 & 3', 'webify-addons')
      )
    );

    $repeater->add_control(
      'feature',
      array(
        'label'       => esc_html__('Feature', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('5000 GB Bandwidth', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'features',
      array(
        'label'   => esc_html__('Features', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'icon'    => 'fa fa-check',
            'feature' => esc_html__('50 GB Bandwidth', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ feature }}</span>',
      )
    );

    $this->add_control(
      'button_style',
      array(
        'label'       => esc_html__('Button Style', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => '',
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'options'     => array(
          ''          => esc_html__('Choose Button Style', 'webify'),
          'tb-style3' => esc_html__('Style 1', 'webify'),
          'tb-style5' => esc_html__('Style 2', 'webify')
        ),
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'placeholder' => esc_html__('Enter your button text here.', 'webify-addons'),
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'default'     => esc_html__('Get Started', 'webify-addons'),
        'type'        => Controls_Manager::TEXT
      )
    );

    $this->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3')),
        'type'        => Controls_Manager::URL,
        'default'     => array('url' => '#'),
        'placeholder' => esc_html__('https://your-link.com', 'webify-addons'),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_plan_color',
      array(
        'label' => esc_html__('Plan', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('plan_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-pricing-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'plan_typography',
        'selector' => '{{WRAPPER}} .tb-pricing-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_price_color',
      array(
        'label' => esc_html__('Price', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('price_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-pricing-card.tb-style1.tb-mkt-green .tb-price,
           {{WRAPPER}} .tb-pricing-card.tb-style2 .tb-price span,
           {{WRAPPER}} .tb-pricing-card-col .tb-price span,
           {{WRAPPER}} .tb-pricing-card-col .tb-price i,
           {{WRAPPER}} .tb-pricing-card.tb-style2 .tb-price i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'price_typography',
        'selector' => '{{WRAPPER}} .tb-pricing-card.tb-style1.tb-mkt-green .tb-price',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_features_color',
      array(
        'label' => esc_html__('Features', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('features_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-pricing-feature' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_color', 
      array(
        'label'       => esc_html__('Icon Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-pricing-card.tb-style1.tb-mkt-green .tb-pricing-feature li i' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'features_typography',
        'selector' => '{{WRAPPER}} .tb-pricing-feature',
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

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
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
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover'  => 'background-color: {{VALUE}};',
        ),
      )
    );


    $this->add_control('btn_text_color_hover', 
      array(
        'label'       => esc_html__('Text Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover'  => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography_hover',
        'selector' => '{{WRAPPER}} .tb-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tabs();


    $this->end_controls_section();


  }

  protected function render() { 
    $settings     = $this->get_settings_for_display();
    $style        = $settings['style'];
    $features     = $settings['features'];
    $plan         = $settings['plan'];
    $currency     = $settings['currency'];
    $duration     = $settings['duration'];
    $is_featured  = $settings['is_featured'];
    $price        = $settings['price'];
    $button_style = $settings['button_style'];
    $btn_text     = $settings['btn_text'];
    $href         = (!empty($settings['btn_link']['url']) ) ? $settings['btn_link']['url'] : '#';
    $target       = ($settings['btn_link']['is_external'] == 'on') ? '_blank' : '_self';


    switch ($style) {
      case 'style1':
      default: ?>
        <div class="tb-pricing-card tb-style1 tb-pricing-table tb-mkt-green">
          <h3 class="tb-pricing-heading text-center tb-f16-lg tb-font-name tb-m0"><?php echo esc_html($plan); ?></h3>
          <hr>
          <div class="tb-price text-center">
            <i class="tb-price-currency tb-f30-lg"><?php echo esc_html($currency); ?></i>
            <span class="tb-f60-lg tb-pricing-price"><?php echo esc_html($price); ?></span>
            <i class="tb-price-cycle tb-grayb5b5b5-c">/<?php echo esc_html($duration); ?></i>
          </div>
          <hr>
          <?php if(!empty($features) && is_array($features)): ?>
            <ul class="tb-pricing-feature tb-mp0 tb-f14-lg">
              <?php foreach($features as $feature): ?>
                <li><i class="<?php echo esc_attr($feature['icon']); ?>"></i><?php echo esc_html($feature['feature']); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <div class="tb-pricing-btn">
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-btn-primary <?php echo (!empty($button_style)) ? $button_style: 'tb-style3'; ?> tb-color9 w-100"><span><?php echo esc_html($btn_text); ?></span></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>
        <div class="tb-radious-4 tb-border tb-pricing-card tb-style2 text-center<?php echo ($is_featured == 'yes') ? ' tb-active':''; ?>">
          <h3 class="tb-pricing-heading tb-666-c text-center tb-f16-lg tb-m0"><?php echo esc_html($plan); ?></h3>
          <hr>
          <div class="tb-price tb-fw-regular tb-font-name  tb-flex">
            <i class="tb-price-currency tb-f24-lg"><?php echo esc_html($currency); ?></i>
            <span class="tb-f48-lg tb-black111-c"><?php echo esc_html($price); ?></span>
          </div>
          <?php if(!empty($features) && is_array($features)): ?>
          <ul class="tb-pricing-feature tb-mp0 ">
            <?php foreach($features as $feature): ?>
              <li><?php echo esc_html($feature['feature']); ?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if(!empty($btn_text)): ?>
            <div class="tb-pricing-btn">
              <div class="empty-space marg-lg-b30"></div>
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style5'; ?> <?php echo ($is_featured == 'yes') ? ' tb-color16':'tb-color5'; ?>"><span><?php echo esc_html($btn_text); ?></span></a>
              <div class="empty-space marg-lg-b30"></div>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="tb-pricing-card-col tb-pricing-table-style3">
          <div class="tb-pricing-card-row tb-pricing-heading"><?php echo esc_html($plan); ?></div>
          <div class="tb-pricing-card-row">
            <h3 class="tb-price tb-flex tb-m0">
              <i class="tb-price-currency tb-f16-lg"><?php echo esc_html($currency); ?></i>
              <span class="tb-f48-lg tb-line1"><?php echo esc_html($price); ?></span>
            </h3>
            <?php if(!empty($btn_text)): ?>
              <div class="tb-pricing-card-btn">
                <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn <?php echo (!empty($button_style)) ? $button_style: 'tb-style3'; ?> tb-color17"><?php echo esc_html($btn_text); ?></a>
              </div>
            <?php endif; ?>
          </div>

          <?php if(!empty($features) && is_array($features)): ?>
          <ul class="tb-pricing-feature tb-mp0 ">
            <?php foreach($features as $feature): ?>
              <li>
                <?php 
                  if(!empty($feature['feature'])):
                    echo esc_html($feature['feature']);
                  else: 
                ?>
                  <i class="<?php echo esc_attr($feature['icon']); ?>"></i>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="tb-pricing-card-col tb-pricing-table-style4">
          <div class="tb-pricing-card-row tb-pricing-heading"></div>
          <div class="tb-pricing-card-row"></div>
          <?php if(!empty($features) && is_array($features)): ?>
          <ul class="tb-pricing-feature tb-mp0 ">
            <?php foreach($features as $feature): ?>
              <li><?php echo esc_html($feature['feature']); ?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;
    }
    
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Pricing_Table_Widget() );