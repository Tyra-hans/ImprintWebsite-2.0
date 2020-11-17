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
class Webify_Image_Gallery_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-image-gallery-widget';
  }

  public function get_title() {
    return 'Image Gallery';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('isotop', 'light-gallery');
  }

  public function get_style_depends() {
    return array('webify-image-box', 'isotop', 'light-gallery');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'image_gallery_section',
      array(
        'label' => esc_html__('Image Gallery' , 'webify-addons')
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
          'style7' => 'Style 7',
        )
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__('Upload Images', 'webify-addons'),
        'type'        => Controls_Manager::GALLERY,
        'label_block' => true,
      )
    );


    $this->add_group_control(
      Group_Control_Css_Filter::get_type(),
      array(
        'name'     => 'css_filter',
        'selector' => '{{WRAPPER}} .tb-image .tb-bg',
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings(); 
    $style    = $settings['style'];
    $images   = $settings['images'];

    if(is_array($images) && !empty($images)): 

      switch ($style) {
        case 'style1':
        default: ?>
          <div class="row">
            <div class="col-lg-12">
              <div class="tb-overflow-hidden">
                <div class="tb-isotop tb-style1 tb-port-col-4 tb-has-gutter tb-lightgallery">
                  <div class="tb-grid-sizer"></div>

                  <?php 
                    foreach($images as $key => $image): 
                      if(!empty($image['url'])):

                        $caption = wp_get_attachment_caption($image['id']);
                  ?>

                    <div class="tb-isotop-item<?php echo ($key == 0) ? ' tb-w50':''; ?>">
                      <div class="tb-image-box tb-style2 tb-relative <?php echo ($key == 0) ? 'tb-height1':'tb-height2'; ?> tb-radious-4">
                        <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>"  class="tb-lightbox-item tb-image-link tb-zoom">
                          <div class="tb-image tb-relative">
                            <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                            <?php if(!empty($caption)): ?>
                              <div class="caption">
                                <!-- <h4>Caption1</h4> -->
                                <p><?php echo esc_html($caption); ?></p>
                              </div>
                            <?php endif; ?>
                          </div>
                        </a>
                      </div>
                    </div><!-- .isotop-item -->

                  <?php endif; endforeach; ?>

                </div><!-- .isotop -->
              </div>
            </div>
          </div>
          <?php
          # code...
          break;


        case 'style2': 

          $class_array = array(
            'tb-height8', 
            'tb-height6', 
            'tb-height7', 
            'tb-height8', 
            'tb-height8', 
            'tb-height7', 
            'tb-height8', 
            'tb-height6', 
            'tb-height7', 
            'tb-height6',
            'tb-height7',
            'tb-height5',
            'tb-height6',
            'tb-height8',
            'tb-height7',
          );

        ?>
          <div class="tb-portfolio-wrapper">
            <div class="tb-isotop tb-style1 tb-port-col-3 tb-lightgallery">
              <div class="tb-grid-sizer"></div>
              <?php
                $count = 0; 
                foreach($images as $image): 
                  if(!empty($image['url'])):
                    $count   = ( $count < 15 ) ? $count:0;
                    $caption = wp_get_attachment_caption($image['id']);
              ?>
                <div class="tb-isotop-item">
                  <div class="tb-image-box tb-style2 tb-relative <?php echo esc_attr($class_array[$count]); ?>">
                    <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>" class="tb-image-link tb-lightbox-item tb-zoom">
                      <div class="tb-image tb-relative">
                        <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                        <?php if(!empty($caption)): ?>
                          <div class="caption">
                            <!-- <h4>Caption1</h4> -->
                            <p><?php echo esc_html($caption); ?></p>
                          </div>
                        <?php endif; ?>
                      </div>
                    </a>
                  </div>
                </div><!-- .tb-isotop-item -->
              <?php $count++; endif; endforeach; ?>

            </div><!-- .isotop -->
          </div>
          <?php
          # code...
          break;

        case 'style3': 

          $class_array = array(
            'tb-height5', 
            'tb-height8', 
            'tb-height8', 
            'tb-height5', 
            'tb-height5', 
            'tb-height5', 
          );

        ?>
        <div class="tb-portfolio-wrapper">
          <div class="tb-isotop tb-style1 tb-port-col-2 tb-has-gutter tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php
                $count = 0; 
                foreach($images as $image): 
                  if(!empty($image['url'])):
                    $count   = ( $count < 6 ) ? $count:0;
                    $caption = wp_get_attachment_caption($image['id']);
            ?>
              <div class="tb-isotop-item">
                <div class="tb-image-box tb-style2 tb-relative <?php echo esc_attr($class_array[$count]); ?>">
                  <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>" class="tb-image-link tb-lightbox-item tb-zoom">
                    <div class="tb-image tb-relative">
                      <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                      <?php if(!empty($caption)): ?>
                        <div class="caption">
                          <!-- <h4>Caption1</h4> -->
                          <p><?php echo esc_html($caption); ?></p>
                        </div>
                      <?php endif; ?>
                    </div>
                  </a>
                </div>
              </div><!-- .tb-isotop-item -->
            <?php $count++; endif; endforeach; ?>

          </div><!-- .isotop -->
        </div>

        <?php
        break;

      case 'style4':

        $class_array = array(
          'tb-height7', 
          'tb-height7', 
          'tb-height9', 
          'tb-height7', 
          'tb-height9', 
          'tb-height7', 
          'tb-height7', 
          'tb-height7', 
          'tb-height7', 
        );

      ?>

        <div class="tb-portfolio-wrapper">
          <div class="tb-isotop tb-style1 tb-port-col-3 tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php
                $count = 0; 
                foreach($images as $image): 
                  if(!empty($image['url'])):
                    $count = ( $count < 9 ) ? $count:0;
                    $caption = wp_get_attachment_caption($image['id']);
            ?>
              <div class="tb-isotop-item<?php echo ($count == 1) ? ' tb-w66':''; ?>">
                <div class="tb-image-box tb-style2 tb-relative <?php echo esc_attr($class_array[$count]); ?>">
                  <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>" class="tb-image-link tb-lightbox-item tb-zoom">
                    <div class="tb-image tb-relative">
                      <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                      <?php if(!empty($caption)): ?>
                        <div class="caption">
                          <!-- <h4>Caption1</h4> -->
                          <p><?php echo esc_html($caption); ?></p>
                        </div>
                      <?php endif; ?>
                    </div>
                  </a>
                </div>
              </div><!-- .tb-isotop-item -->
            <?php $count++; endif; endforeach; ?>

          </div><!-- .isotop -->
        </div>

        <?php
        break;

      case 'style5': ?>
        <div class="tb-portfolio-wrapper">
          <div class="tb-isotop tb-style1 tb-port-col-4 tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php
                $count = 1; 
                foreach($images as $image): 
                  if(!empty($image['url'])):
                    $caption = wp_get_attachment_caption($image['id']);
            ?>
              <div class="tb-isotop-item <?php echo ($count == 1 || $count % 8 == 0) ? 'tb-w50':''; ?>">
                <div class="tb-image-box tb-style2 tb-relative <?php echo ($count == 1 || $count % 9 == 0) ? 'tb-height9':'tb-height7'; ?>">
                  <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>" class="tb-image-link tb-lightbox-item tb-zoom">
                    <div class="tb-image tb-relative">
                      <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                      <?php if(!empty($caption)): ?>
                        <div class="caption">
                          <!-- <h4>Caption1</h4> -->
                          <p><?php echo esc_html($caption); ?></p>
                        </div>
                      <?php endif; ?>
                    </div>
                  </a>
                </div>
              </div><!-- .tb-isotop-item -->
            <?php $count++; endif; endforeach; ?>
            

          </div><!-- .isotop -->
        </div>
        <?php
        # code...
        break;

      case 'style6': ?>
        <div class="tb-portfolio-wrapper">
          <div class="tb-isotop tb-style1 tb-port-col-2 tb-has-gutter tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php
                foreach($images as $image): 
                  if(!empty($image['url'])):
                    $caption = wp_get_attachment_caption($image['id']);
            ?>
            <div class="tb-isotop-item">
              <div class="tb-image-box tb-style2 tb-relative tb-height8">
                <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>" class="tb-image-link tb-lightbox-item tb-zoom">
                  <div class="tb-image tb-relative">
                    <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                    <?php if(!empty($caption)): ?>
                      <div class="caption">
                        <!-- <h4>Caption1</h4> -->
                        <p><?php echo esc_html($caption); ?></p>
                      </div>
                    <?php endif; ?>
                  </div>
                </a>
              </div>
            </div><!-- .tb-isotop-item -->
            <?php endif; endforeach; ?>

          </div><!-- .isotop -->
        </div>
        <?php
        # code...
        break;

      case 'style7': ?>
        <div class="tb-portfolio-wrapper">
          <div class="tb-isotop tb-style1 tb-port-col-4 tb-has-gutter tb-lightgallery">
            <div class="tb-grid-sizer"></div>
            <?php
                foreach($images as $image): 
                  if(!empty($image['url'])):
                    $caption = wp_get_attachment_caption($image['id']);
            ?>
            <div class="tb-isotop-item">
              <div class="tb-image-box tb-style2 tb-relative tb-height5">
                <a data-sub-html=".caption" href="<?php echo esc_url($image['url']); ?>" class="tb-image-link tb-lightbox-item tb-zoom">
                  <div class="tb-image tb-relative">
                    <div class="tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="thumb">
                    <?php if(!empty($caption)): ?>
                      <div class="caption">
                        <!-- <h4>Caption1</h4> -->
                        <p><?php echo esc_html($caption); ?></p>
                      </div>
                    <?php endif; ?>
                  </div>
                </a>
              </div>
            </div><!-- .tb-isotop-item -->
            <?php endif; endforeach; ?>

          </div><!-- .isotop -->
        </div>
        <?php
        # code...
        break;

      }
    endif;
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Image_Gallery_Widget() );