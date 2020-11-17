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
class Webify_Client_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-client-widget';
  }

  public function get_title() {
    return 'Client';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('slick');
  }

  public function get_style_depends() {
    return array('webify-slider', 'slick', 'webify-client');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'client_section',
      array(
        'label' => esc_html__('Client' , 'webify-addons')
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
          'style5' => 'Style 5',
          'style6' => 'Style 6',
        )
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'image',
      array(
        'label'       => esc_html__('Upload Image', 'webify-addons'),
        'type'        => Controls_Manager::MEDIA,
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Visit Website', 'webify-addons'),
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'btn_link',
      array(
        'label'       => esc_html__('Button Link', 'webify-addons'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'default'     => array('url' => '#'),
      )
    );

    $this->add_control(
      'clients',
      array(
        'label'   => esc_html__('Clients', 'webify-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'btn_text' => esc_html__('Visit Website', 'webify-addons'),
            'btn_url'  => array('url' => '#')
          ),
        ),
        'title_field' => '<span>{{ btn_text }}</span>',
        'condition'   => array('style' => array('style6')),
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__('Upload Images', 'webify-addons'),
        'type'        => Controls_Manager::GALLERY,
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2', 'style3', 'style4', 'style5')),
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label'       => esc_html__('Autoplay', 'webify-addons'),
        'type'        => Controls_Manager::SWITCHER,
        'separator'   => 'before',
        'condition'   => array('style' => array('style1', 'style3', 'style4', 'style5')),
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => esc_html__('Loop', 'webify-addons'),
        'type'      => Controls_Manager::SWITCHER,
        'separator' => 'before',
        'default'   => 'yes',
        'condition'   => array('style' => array('style1', 'style3', 'style4', 'style5')),
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => esc_html__('Speed', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'separator'   => 'before',
        'condition'   => array('style' => array('style1', 'style3', 'style4', 'style5')),
        'default'     => 600
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_button_style',
      array(
        'label' => esc_html__('Button', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->start_controls_tabs('button_style');

    $this->start_controls_tab(
      'button_style_normal',
      array(
        'label' => esc_html__('Normal', 'webify-addons'),
      )
    );

    $this->add_control('button_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('button_text_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'button_style_hover',
      array(
        'label' => esc_html__('Hover', 'webify-addons'),
      )
    );

    $this->add_control('button_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('button_text_hover_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator' => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $style    = $settings['style'];
    $clients  = $settings['clients'];
    $images   = $settings['images'];
    $autoplay = $settings['autoplay'];
    $loop     = $settings['loop'];
    $speed    = $settings['speed'];
    $loop     = ($loop == 'yes') ? 1:0;
    $autoplay = ($autoplay == 'yes') ? 1:0;


    switch ($style) {
      case 'style1': default:
        if(is_array($images) && !empty($images)): ?>
          <div class="tb-client-wrapper">
            <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style4">
              <div class="tb-slick-inner-pad-wrap">
                <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="5">
                  <div class="slick-wrapper">
                    <?php foreach($images as $image): ?>
                      <div class="slick-slide">
                        <div class="tb-slick-inner-pad">
                          <div class="tb-client tb-style1 tb-flex">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                          </div>
                        </div>
                      </div><!-- .slick-slide -->
                    <?php endforeach; ?>
                  </div>
                </div><!-- .slick-container -->
              </div>
              <div class="pagination tb-style3 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
              <div class="swipe-arrow tb-style4"> <!-- If dont need navigation then add class .tb-hidden -->
                <div class="slick-arrow-left"></div>
                <div class="slick-arrow-right"></div>
              </div>
            </div><!-- .tb-carousor -->
          </div>
        <?php endif;
        # code...
        break;

      case 'style2':
        if(is_array($images) && !empty($images)): ?>
          <div class="tb-vertical-middle">
            <div class="row">
              <?php foreach($images as $image): ?>
              <div class="col-sm-4 col-6">
                <div class="tb-client tb-style3 tb-flex">
                  <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                </div>
              </div>  
            <?php endforeach; ?>
            </div><!-- .row -->
          </div>
        <?php endif;
        # code...
        break;

      case 'style3': 
      if(is_array($images) && !empty($images)): ?>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
                <div class="tb-slick-inner-pad-wrap">
                  <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="6">
                    <div class="slick-wrapper">

                      <?php foreach($images as $image): ?>
                        <div class="slick-slide">
                          <div class="tb-slick-inner-pad">
                            <div class="tb-client tb-style2 tb-flex wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.75s">
                              <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                            </div>
                          </div>
                        </div><!-- .slick-slide -->
                      <?php endforeach; ?>
                    </div>
                  </div><!-- .slick-container -->
                </div>
                <div class="pagination tb-style1 hidden tb-mobile-hidden"></div> <!-- If dont need Pagination then add class .hidden -->
                <div class="swipe-arrow tb-style1 tb-hidden"> <!-- If dont need navigation then add class .tb-hidden -->
                  <div class="slick-arrow-left"><i class="fas fa-chevron-left"></i></div>
                  <div class="slick-arrow-right"><i class="fas fa-chevron-right"></i></div>
                </div>
              </div><!-- .tb-carousor -->
            </div>
          </div>
        </div>
      <?php endif;
        # code...
        break;

      case 'style4': 
      if(is_array($images) && !empty($images)): ?>
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="6">
              <div class="slick-wrapper">

                <?php foreach($images as $image): ?>
                  <div class="slick-slide">
                    <div class="tb-slick-inner-pad">
                      <div class="tb-client tb-style2 tb-flex">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                      </div>
                    </div>
                  </div><!-- .slick-slide -->
                <?php endforeach; ?>

              </div>
            </div><!-- .slick-container -->
          </div>
          <div class="pagination tb-style1 hidden tb-mobile-hidden"></div> <!-- If dont need Pagination then add class .hidden -->
          <div class="swipe-arrow tb-style1 tb-hidden"> <!-- If dont need navigation then add class .tb-hidden -->
            <div class="slick-arrow-left"><i class="fas fa-chevron-left"></i></div>
            <div class="slick-arrow-right"><i class="fas fa-chevron-right"></i></div>
          </div>
        </div><!-- .tb-carousor -->
        <?php endif;
        break;

      case 'style5':
      if(is_array($images) && !empty($images)): ?>
        <div class="tb-arrow-closest tb-poind-closest tb-slider tb-style1">
          <div class="tb-slick-inner-pad-wrap">
            <div class="slick-container" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"  data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="6">
              <div class="slick-wrapper">
                <?php foreach($images as $image): ?>
                <div class="slick-slide">
                  <div class="tb-slick-inner-pad">
                    <div class="tb-client tb-style1 tb-flex">
                      <img src="<?php echo esc_url($image['url']); ?>" alt="client-image">
                    </div>
                  </div>
                </div><!-- .slick-slide -->
                <?php endforeach; ?>
              </div>
            </div><!-- .slick-container -->
          </div>
          <div class="pagination tb-style1 hidden"></div> <!-- If dont need Pagination then add class .hidden -->
          <div class="swipe-arrow tb-style1 tb-hidden"> <!-- If dont need navigation then add class .tb-hidden -->
            <div class="slick-arrow-left"><i class="fas fa-chevron-left"></i></div>
            <div class="slick-arrow-right"><i class="fas fa-chevron-right"></i></div>
          </div>
        </div><!-- .tb-carousor -->
        <?php endif;
        break;

      case 'style6': 

      if(is_array($clients) && !empty($clients)):

      ?>
        <div class="tb-client5-wrap">
          <div class="tb-client5-wrap-in">
            <?php 
              foreach($clients as $client): 
                $btn_link = $client['btn_link'];
                $href     = (!empty($btn_link['url']) ) ? $btn_link['url'] : '#';
                $target   = ($btn_link['is_external'] == 'on') ? '_blank' : '_self';
                if(!empty($client['image']['url'])):
            ?>
              <div class="tb-client tb-style5">
                <img src="<?php echo esc_url($client['image']['url']); ?>" alt="client">
                <div class="tb-client-btn"><a href="<?php echo esc_url($href); ?>" target="<?php echo esc_attr($target); ?>" class="tb-btn tb-style3 tb-color20 w-100"><?php echo esc_html($client['btn_text']); ?></a></div>
              </div>
            <?php endif; endforeach; ?>
            

          </div>
        </div>
        <?php endif;
        # code...
        break;
      
    }
    

  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Client_Widget() );