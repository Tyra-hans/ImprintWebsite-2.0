<?php 
namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Intro Text Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class Webify_Shop_Card_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-shop-card-widget';
  }

  public function get_title() {
    return 'Shop Card';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-shop-card');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'shop_card_section',
      array(
        'label' => esc_html__('Shop Card' , 'webify-addons')
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
      'bg_image',
      array(
        'label'   => esc_html__('Background Image', 'webify-addons'),
        'type'    => Controls_Manager::MEDIA,
        'default' => array('url' => \Elementor\Utils::get_placeholder_image_src()),       
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'default'     => esc_html('Grab your Coat', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'webify-addons'),
        'default'     => esc_html('Shop Now', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#')
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
        'label_block' => true,
        'selectors' => array(
          '{{WRAPPER}} .tb-shop-card-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-shop-card-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_tab();

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
          '{{WRAPPER}} .tb-card-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-card-btn:before' => 'background: {{VALUE}};',
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

    $this->add_control('link_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-card-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-card-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 

    $settings  = $this->get_settings();
    $bg_image  = $settings['bg_image'];
    $link_text = $settings['link_text'];
    $link_url  = $settings['link_url'];
    $title     = $settings['title'];
    $href      = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $target    = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

    if(!empty($bg_image['url']) && is_array($bg_image)):
  ?>

    <div class="tb-shop-card tb-style1 tb-zoom-effect tb-font-name">
      <div class="tb-zoom-effect-in">
        <div class="tb-shop-card-img tb-bg" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
      </div>
      <div class="tb-card-text">
        <h2 class="tb-f21-lg tb-white-c tb-shop-card-title tb-mb1"><?php echo esc_html($title); ?></h2>
        <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-card-btn tb-line1-14 tb-f10-lg tb-white-c text-uppercase"><?php echo esc_html($link_text); ?></a>
      </div>
      <div class="tb-overlay"></div>
    </div>
  <?php endif;


  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Shop_Card_Widget() );