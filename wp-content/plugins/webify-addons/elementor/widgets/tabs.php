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
class Webify_Tabs_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-tabs-widget';
  }

  public function get_title() {
    return 'Tabs';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-tab');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'tabs_section',
      array(
        'label' => esc_html__('Tabs' , 'webify-addons')
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
        )
      )
    );

    $this->add_control(
      'active',
      array(
        'label'       => esc_html__('Active Tab', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('1', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('01 Myself', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'icon_set',
      array(
        'label'       => esc_html__('Icon Set', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'default',
        'label_block' => true,
        'options' => array(
          'default'  => 'Default',
          'material' => 'Material Icons',
        ),
      )
    );

    $repeater->add_control(
      'material_icon_type',
      array(
        'label'       => esc_html__('Icon Type', 'webify-addons'),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'material-icons',
        'label_block' => true,
        'options' => array(
          'material-icons'          => 'Filled',
          'material-icons-outlined' => 'Outlined',
        ),
        'condition'   => array('icon_set' => array('material'))       
      )
    );

    $repeater->add_control(
      'icon',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => \Elementor\Controls_Manager::ICON,
        'options'     => webify_get_icons(),
        'default'     => 'fa fa-star',
        'condition'   => array('icon_set' => array('default')),       
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'icon_material',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => \Elementor\Controls_Manager::SELECT2,
        'options'     => webify_get_icons('material'),
        'default'     => '3d_rotation',
        'description' => '<a href="https://material.io/tools/icons/" target="_blank">https://material.io/tools/icons/</a>',
        'label_block' => true,
        'condition'   => array('icon_set' => array('material'))       
      )
    );

    $repeater->add_control(
      'content_type',
      array(
        'label'       => esc_html__('Content Type', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::SELECT,
        'options'     => array(
          'content'  => esc_html__('Content', 'webify-addons'),
          'template' => esc_html__('Saved Templates', 'webify-addons'),
        ),
        'default'     => 'content'
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Energetic Adobe Certified Expert (ACE) web designer with 6+ years of experience. Seeking to enhance design excellence at Dujo International. Designed 5 responsive websites per month for Amphimia Global with 99% client satisfaction. Raised UX scores by 35% and customer retention by 18%. Received Awwards prize 2015.', 'webify-addons'),
        'condition'   => array('content_type' => array('content')),
        'type'        => Controls_Manager::WYSIWYG,
      )
    );

    $repeater->add_control(
      'templates',
      array(
        'label'       => esc_html__('Choose Template', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::SELECT,
        'options'     => webify_get_page_templates(),
        'condition'   => array('content_type' => array('template'))
      )
    );

    $this->add_control(
      'tabs',
      array(
        'label'     => esc_html__('Tabs', 'webify-addons'),
        'type'      => Controls_Manager::REPEATER,
        'fields'    => $repeater->get_controls(),
        'default'   => array(
          array(
            'title'              => esc_html__('01 Myself', 'webify-addons'),
            'icon_set'           => 'default',
            'material_icon_type' => 'material-icons',
            'icon'               => 'fa fa-star',
            'icon_material'      => '3d_rotation',
            'content'            => esc_html__('Energetic Adobe Certified Expert (ACE) web designer with 6+ years of experience. Seeking to enhance design excellence at Dujo International. Designed 5 responsive websites per month for Amphimia Global with 99% client satisfaction. Raised UX scores by 35% and customer retention by 18%. Received Awwards prize 2015.', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('active_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-tabs.tb-style6 .tb-tab-links a:before' => 'background: {{VALUE}};',
        ),
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
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-tab-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-tab-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_value_style',
      array(
        'label' => esc_html__('Content', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-tab-content' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tb-tab-content',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings = $this->get_settings_for_display();
    $tabs     = $settings['tabs'];
    $style    = $settings['style'];
    $active   = $settings['active'];

    if(is_array($tabs) && !empty($tabs)):

      switch ($style) {
        case 'style1': ?>
          <div class="tb-tabs tb-fade-tabs tb-style1">
            <ul class="tb-tab-links tb-mp0 tb-flex-start tb-f16-lg tb-line1-6 tb-font-name tb-grayb5b5b5-c">
              <?php 
                foreach($tabs as $key => $tab): 
                  $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
                  $anchor_id  = $key.strtolower(str_replace(' ', '-', $tab['title']));
              ?>
                <li class="tb-tab-title <?php echo esc_attr($active_nav); ?>"><h6 class="tb-grayb5b5b5-c tb-m0"><a href="#<?php echo esc_attr($anchor_id); ?>"><?php echo esc_html($tab['title']); ?></a></h6></li>
              <?php endforeach; ?>
            </ul>
            <div class="empty-space marg-lg-b20"></div>
            <div class="tab-content">

              <?php 
                foreach($tabs as $key => $tab): 
                  $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
                  $anchor_id  = $key.strtolower(str_replace(' ', '-', $tab['title']));
              ?>
                <div id="<?php echo esc_attr($anchor_id); ?>" class="tb-tab <?php echo esc_attr($active_nav); ?>">
                  <div class="tb-f16-lg tb-line1-6 tb-tab-content tb-about-text">
                    <?php 
                      if(($tab['content_type'] == 'template') && !empty($tab['templates'])):
                        $instance = new Frontend();
                        echo $instance->get_builder_content($tab['templates']);
                      else:
                        echo do_shortcode($tab['content']);
                      endif;
                    ?>
                  </div>
                </div>
              <?php endforeach; ?>

            </div>
          </div><!-- .tb-tabs -->
          <?php
          # code...
          break;
        
        case 'style2': ?>
          <div class="tb-tabs tb-fade-tabs tb-style6">
            <div class="tb-tab-links-wrap">
              <div class="container">
                <ul class="tb-mp0 tb-tab-links">
                  <?php 
                  foreach($tabs as $key => $tab): 
                    $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
                    $anchor_id  = $key.strtolower(str_replace(' ', '-', $tab['title']));
                  ?>
                    <li class="tb-tab-title <?php echo esc_attr($active_nav); ?>"><a class="tb-tab-title" href="#<?php echo esc_attr($anchor_id); ?>">
                      <?php if($tab['icon_set'] == 'default'): ?>
                        <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                      <?php else: ?>
                        <i class="<?php echo esc_attr($tab['material_icon_type']); ?>"><?php echo esc_attr($tab['icon_material']); ?></i>
                      <?php endif; ?>
                    <?php echo esc_html($tab['title']); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class="empty-space marg-lg-b80"></div>
            <div class="tb-tab-body tb-tab-content">
              <?php 
                foreach($tabs as $key => $tab): 
                  $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
                  $anchor_id  = $key.strtolower(str_replace(' ', '-', $tab['title']));
              ?>
                <div class="tb-tab <?php echo esc_attr($active_nav); ?>" id="<?php echo esc_attr($anchor_id); ?>">
                  <?php 
                    if(($tab['content_type'] == 'template') && !empty($tab['templates'])):
                      $instance = new Frontend();
                      echo $instance->get_builder_content($tab['templates']);
                    else:
                      echo do_shortcode($tab['content']);
                    endif;
                  ?>
                </div>
              <?php endforeach; ?>

            </div>
          </div>
          <?php
          # code...
          break;
      }  
    endif;
      
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Tabs_Widget() );