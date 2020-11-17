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
class Webify_Icon_Box_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-icon-box-widget';
  }

  public function get_title() {
    return 'Icon Box';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-icon-box', 'webify-button', 'webify-image-box');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'icon_box_section',
      array(
        'label' => esc_html__('Icon Box' , 'webify-addons')
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
          'style1'  => 'Style 1',
          'style2'  => 'Style 2',
          'style3'  => 'Style 3',
          'style4'  => 'Style 4',
          'style5'  => 'Style 5',
          'style6'  => 'Style 6',
          'style7'  => 'Style 7',
          'style8'  => 'Style 8',
          'style9'  => 'Style 9',
          'style10' => 'Style 10',
        )
      )
    );

    $this->add_control(
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
        'condition'   => array('style' => array('style1', 'style4', 'style5', 'style2', 'style8', 'style9', 'style10'))       
      )
    );

    $this->add_control(
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

    $this->add_control(
      'icon',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'type'        => \Elementor\Controls_Manager::ICON,
        'options'     => webify_get_icons(),
        'default'     => 'fa fa-star',
        'label_block' => true,
        'condition'   => array('icon_set' => array('default'), 'style' => array('style1', 'style4', 'style5', 'style2', 'style8', 'style9', 'style10'))       
      )
    );

    $this->add_control(
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

    $this->add_control(
      'image',
      array(
        'label'     => esc_html__('Icon Image', 'webify-addons'),
        'type'      => Controls_Manager::MEDIA,
        'condition' => array('style' => array('style3', 'style6', 'style7'))       
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter your title', 'webify-addons'),
        'default'     => esc_html__('Super Creative', 'webify-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'description',
      array(
        'label'       => esc_html__('Description', 'webify-addons'),
        'type'        => Controls_Manager::TEXTAREA,
        'placeholder' => esc_html__('Enter your description', 'webify-addons'),
        'default'     => esc_html__('You can choose from 320+ icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'webify-addons'),
        'condition'   => array('style' => array('style1', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9', 'style10')),
        'label_block' => true,
      )
    );

    $this->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Learn More', 'webify-addons'),
        'condition' => array('style' => array('style3', 'style4', 'style9'))
      )
    );

    $this->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#'),
        'condition' => array('style' => array('style3', 'style4', 'style9'))
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_icon_color',
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
          '{{WRAPPER}} .tb-icon-box .tb-icon' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('icon_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'description' => esc_html__('This field is only for Style 6,8,9 & 10', 'webify-addons'),
        'selectors' => array(
          '{{WRAPPER}} .tb-icon-box .tb-icon.tb-icon-bg' => 'background: {{VALUE}};',
        ),
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
          '{{WRAPPER}} .tb-icon-box .tb-iconbox-heading' => 'color: {{VALUE}};',
          '{{WRAPPER}} .tb-image-box.tb-style4 h3'       => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-icon-box .tb-iconbox-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_description_color',
      array(
        'label' => esc_html__('Description', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('description_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-description-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'description_typography',
        'selector' => '{{WRAPPER}} .tb-description-text',
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
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:before' => 'background: {{VALUE}};',
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
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('link_border_color_hover', 
      array(
        'label'       => esc_html__('Border Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tabs();

    $this->end_controls_section();

    $this->start_controls_section('section_icon_box_bg_color',
      array(
        'label' => esc_html__('Icon Box', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('icon_box_bg_color', 
      array(
        'label'     => esc_html__('Background Color', 'webify-addons'),
        'type'      => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-icon-box.tb-style6.tb-with-bg-color' => 'background: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_section();

  }

  protected function render() { 
    $settings           = $this->get_settings();
    $style              = $settings['style'];
    $title              = $settings['title'];
    $icon               = $settings['icon'];
    $icon_material      = $settings['icon_material'];
    $icon_set           = $settings['icon_set'];
    $material_icon_type = $settings['material_icon_type'];
    $image              = $settings['image'];
    $description        = $settings['description'];
    $link_url           = $settings['link_url'];
    $link_text          = $settings['link_text'];
    $href               = (!empty($link_url['url']) ) ? $link_url['url'] : '#';
    $target             = ($link_url['is_external'] == 'on') ? '_blank' : '_self';

    switch ($style) {
      case 'style1': default: ?>
      <div class="tb-icon-box tb-style3 tb-mkt-green">
        <div class="tb-icon tb-icon-bg">
          <?php if($icon_set == 'default'): ?>
            <i class="<?php echo esc_attr($icon); ?>"></i>
          <?php else: ?>
            <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
          <?php endif; ?>
        </div>
        <?php if(!empty($title)): ?>
          <h3 class="tb-iconbox-heading tb-f18-lg tb-font-name tb-mt-4 tb-mb5"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        <?php if(!empty($description)): ?>
          <div class="tb-iconbox-text tb-description-text  tb-mb-6"><?php echo wp_kses_post($description); ?></div>
        <?php endif; ?>
      </div>
      
      <?php  
      break;

      case 'style2': ?>

        <div class="tb-icon-box tb-style2 text-center tb-box-shadow1">
          <div class="empty-space marg-lg-b35"></div>
          <div class="tb-icon tb-f48-lg tb-line1">
            <?php if($icon_set == 'default'): ?>
              <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php else: ?>
              <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b15"></div>
          <?php if(!empty($title)): ?>
            <div class="tb-line1-43 tb-iconbox-heading"><?php echo esc_html($title); ?></div>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
        </div>
        
        <?php
        break;

      case 'style3': ?>

        <div class="tb-icon-box tb-style3 tb-type1">
          <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
            <div class="tb-icon"><img src="<?php echo esc_url($image['url']); ?>" alt="img-icon"></div>
          <?php endif; ?>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-f18-lg tb-font-name tb-font-name tb-mt-3 tb-mb3"><?php echo esc_html($title); ?></h3>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-description-text  tb-line1-6 tb-mb8"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
          <?php if(!empty($link_text)): ?>
            <div class="tb-icon-box-btn tb-mb-6">
              <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style2 tb-color7"><?php echo esc_html($link_text); ?><i class="fa fa-angle-right"></i></a>
            </div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style4': ?>
        <div class="tb-icon-box tb-style4 tb-border text-center">
          <div class="tb-icon tb-f48-lg">
            <?php if($icon_set == 'default'): ?>
              <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php else: ?>
              <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b20"></div>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-font-name tb-f18-lg  tb-m0"><?php echo esc_html($title); ?></h3>
          <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-description-text tb-mb3"><?php echo wp_kses_post($description); ?></div>
            <div class="empty-space marg-lg-b20 marg-sm-b20"></div>
          <?php endif; ?>
          <?php if(!empty($link_text)): ?>
            <a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style1"><?php echo esc_html($link_text); ?></a>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style5': ?>
        <div class="tb-icon-box tb-style5">
          <div class="tb-icon tb-f48-lg">
            <?php if($icon_set == 'default'): ?>
              <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php else: ?>
              <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b15"></div>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-f18-lg tb-font-name  tb-m0 tb-mt-3"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-description-text tb-mb-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style6': ?>
        <div class="tb-icon-box tb-style7">
          <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
            <div class="tb-icon"><img src="<?php echo esc_url($image['url']); ?>" alt="icon"></div>
          <?php endif; ?>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-font-name tb-f18-lg  tb-m0 tb-mb-5"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b20"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-iconbox-text tb-description-text  tb-mt-6 tb-mb-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style7': ?>
        <div class="tb-icon-box tb-style6 tb-with-bg-color text-center tb-radious-5 tb-font-lato ">
          <?php if(!empty($image) && is_array($image) && !empty($image['url'])): ?>
            <div class="tb-icon"><img src="<?php echo esc_url($image['url']); ?>" alt="icon"></div>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-f18-lg  tb-white-c9 tb-mt-4 tb-mb-4 tb-font-libre-baskerville"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b30"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-iconbox-text tb-f16-lg tb-description-text tb-line1-5  tb-white-c7 tb-mt-7 tb-mb-6"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        break;

      case 'style8': ?>
        <div class="tb-icon-box tb-style8">
          <div class="tb-icon tb-f28-lg tb-icon-bg tb-flex tb-radious-50">
            <?php if($icon_set == 'default'): ?>
              <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php else: ?>
              <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b20"></div>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-font-open-sanse tb-f18-lg tb-mt-4 tb-mb-4"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b15"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-iconbox-text tb-line1-6 tb-description-text tb-mt-6 tb-mb-6"><?php echo wp_kses_post($description); ?></div>
            <div class="empty-space marg-lg-b10"></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

      case 'style9': 

        $icon_color   = $settings['icon_color'];
        $output_css   = '';
        $uniqid_class = '';   
        $unique_id    = uniqid();

        if(!empty($icon_color)):
          $output_css .= '.custom-color-properties-'.$unique_id.'.tb-icon-box.tb-style9.tb-color1:hover {';
          $output_css .=  'background-image: linear-gradient(120deg, '.\Webify_Addons::hex_to_rgba($icon_color, 0.6).' 0%, '.$icon_color.');';
          $output_css .=  'box-shadow: 0px 10px 19px 1px '.\Webify_Addons::hex_to_rgba($icon_color, 0.2).';';
          $output_css .= '}';

          $output_css .= '.custom-color-properties-'.$unique_id.'.tb-icon-box.tb-style9.tb-color1 .tb-icon {';
          $output_css .= 'background-color:'.\Webify_Addons::hex_to_rgba($icon_color, 0.2).';';
          $output_css .= '}';

          \Webify_Addons::add_inline_css($output_css);
          $uniqid_class = ' custom-color-properties-'.$unique_id;
        endif;
        


      ?>
        <div class="tb-hover-layer">
          <div class="hover-container tb-style3">
            <div class="tb-icon-box tb-style9 <?php echo esc_attr($uniqid_class); ?> tb-color1 tb-radious-5">
              <div class="tb-icon tb-f22-lg tb-radious-50 tb-icon-bg tb-flex">
                <?php if($icon_set == 'default'): ?>
                  <i class="<?php echo esc_attr($icon); ?>"></i>
                <?php else: ?>
                  <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
                <?php endif; ?>
              </div>
              <div class="empty-space marg-lg-b15"></div>
              <?php if(!empty($title)): ?>
                <h3 class="tb-iconbox-heading tb-f18-lg tb-font-name tb-m0 tb-mt2"><?php echo esc_html($title); ?></h3>
                <div class="empty-space marg-lg-b5"></div>
              <?php endif; ?>
              <?php if(!empty($description)): ?>
                <div class="tb-iconbox-text">
                  <div class="tb-iconbox-text-in tb-description-text"><?php echo wp_kses_post($description); ?></div>
                </div>
              <?php endif; ?>
              <?php if(!empty($link_text)): ?>
                <div class="tb-icon-box-btn"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style1"><?php echo esc_html($link_text); ?></a></div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
        # code...
        break;

      case 'style10': ?>
        <div class="tb-icon-box tb-style10 tb-color1">
          <div class="tb-icon tb-color1 tb-f22-lg tb-radious-50 tb-icon-bg tb-flex">
            <?php if($icon_set == 'default'): ?>
              <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php else: ?>
              <i class="<?php echo esc_attr($material_icon_type); ?>"><?php echo esc_attr($icon_material); ?></i>
            <?php endif; ?>
          </div>
          <div class="empty-space marg-lg-b10"></div>
          <?php if(!empty($title)): ?>
            <h3 class="tb-iconbox-heading tb-f18-lg tb-font-name tb-m0 tb-mt2"><?php echo esc_html($title); ?></h3>
            <div class="empty-space marg-lg-b5"></div>
          <?php endif; ?>
          <?php if(!empty($description)): ?>
            <div class="tb-iconbox-text tb-description-text"><?php echo wp_kses_post($description); ?></div>
          <?php endif; ?>
        </div>
        <?php
        # code...
        break;

    }
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Icon_Box_Widget() );