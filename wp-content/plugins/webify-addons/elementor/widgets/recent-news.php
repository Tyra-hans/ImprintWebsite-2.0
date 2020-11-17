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
class Webify_Recent_News_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-recent-news-widget';
  }

  public function get_title() {
    return 'Recent News';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-post');
  }

  public function get_categories() {
    return array('webify-elementor');
  }

  public function get_custom_term_values($type) {
    $items = array();
    $terms = get_terms($type, array('orderby' => 'name'));
    if (is_array($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        $items[$term ->name] = $term->slug;
      }
    }
    return $items;
  }

  public function get_image_src($id) {
    if(empty($id)) { return ; }
    $image_src = (is_numeric($id)) ? wp_get_attachment_url($id):$id;
    return $image_src;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'recent_news_section',
      array(
        'label' => esc_html__('Recent News' , 'webify-addons')
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
        )
      )
    );

    $this->add_control(
      'cats',
      array(
        'label'       => esc_html__('Categories', 'webify-addons'),
        'description' => esc_html__('Specifies a category that you want to show posts from it.', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'label_block' => true,
        'options'     => array_flip($this->get_custom_term_values('category')),
        'default'     => array(''),
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 8,
      )
    );

    $this->add_control(
      'orderby',
      array(
        'label'       => esc_html__( 'Order By', 'webify-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'ID',
        'options'     => array_flip(array(
          'ID'            => 'ID',
          'Author'        => 'author',
          'Post Title'    => 'title',
          'Date'          => 'date',
          'Last Modified' => 'modified',
          'Random Order'  => 'rand',
          'Comment Count' => 'comment_count',
          'Menu Order'    => 'menu_order',
        )),
        'label_block' => true,
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings = $this->get_settings();
    $cats    = $settings['cats'];
    $style   = $settings['style'];
    $limit   = $settings['limit'];
    $orderby = $settings['orderby'];

    $args = array(
      'posts_per_page' => $limit,
      'orderby'        => $orderby,
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); 


    switch ($style) {
      case 'style1': default: ?>
        <div class="row tb-recent-news-wrapper-style1">

          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $image_url = $this->get_image_src(get_post_thumbnail_id());
          ?>

          <div <?php post_class('col-lg-4'); ?>>

            <div class="tb-post tb-style4 tb-radious-4 tb-zoom">
              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url); ?>);"></a>
              <div class="tb-post-info">
                <h2 class="tb-post-title tb-f18-lg tb-font-name tb-white-c tb-mb-6"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                
                <div class="empty-space marg-lg-b25"></div>
                <hr>
                <div class="tb-post-meta">
                  <div class="tb-post-label tb-style1 tb-color1"> 
                    <span class="tb-post-author-name vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span>
                    <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile; wp_reset_postdata(); ?>

        </div>

        <?php
        # code...
        break;



      case 'style2': ?>
        <div class="row tb-recent-news-wrapper-style2">

        
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); $image_url = $this->get_image_src(get_post_thumbnail_id()); ?>
            <div <?php post_class('col-lg-4'); ?>>

              <div class="tb-post tb-style2 tb-color1 tb-box-shadow1 tb-zoom">
                <?php if(has_post_thumbnail()): ?>
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-bg tb-zoom-in1" style="background-image: url(<?php echo esc_url($image_url); ?>);"></a>
                <?php endif; ?>
                <div class="tb-post-info">
                  <div class="tb-post-info-in">
                    <h2 class="tb-post-title tb-f18-lg"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  </div>
                  <div class="tb-post-meta">
                    <div class="tb-post-label tb-style1">
                      <span class="tb-post-author-name vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                      <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- .col -->
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        # code...
        break;

        case 'style3': ?>
          <div class="row tb-recent-news-wrapper-style3">

          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $image_url = $this->get_image_src(get_post_thumbnail_id());
          ?>
            <div <?php post_class('col-lg-4 col-md-6'); ?>>
              <div class="tb-post tb-style3 tb-color2">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-bg" style="background-image: url(<?php echo esc_url($image_url); ?>);"></a>
                <div class="tb-post-info">
                  <div class="tb-post-text">
                    <div class="tb-catagory tb-style1 tb-mb3 tb-f11-lg tb-grayb5b5b5-c text-uppercase">
                      <?php echo get_the_category_list(); ?>
                    </div>
                    <h2 class="tb-post-title tb-f16-lg tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>

          </div>
          <?php
          # code...
          break;
        case 'style4': ?>

          <div class="row tb-recent-news-wrapper-style4">
            <?php
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                $image_url = $this->get_image_src(get_post_thumbnail_id());
            ?>
            <div <?php post_class('col-md-6'); ?>>
              <div class="tb-post tb-style3 tb-color1">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-bg" style="background-image: url(<?php echo esc_url($image_url); ?>);"></a>
                <div class="tb-post-info">
                  <div class="tb-post-text">
                    <div class="tb-catagory tb-style1">
                      <?php echo get_the_category_list(); ?>
                    </div>
                    <h2 class="tb-post-title tb-f16-lg tb-line1-2 tb-font-name tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
          <?php
          # code...
          break;

        case 'style5': ?>
          <div class="row tb-recent-news-wrapper-style5">
            <?php
              while ($the_query -> have_posts()) : $the_query -> the_post(); 
                $image_url = $this->get_image_src(get_post_thumbnail_id());
            ?>
            <div <?php post_class('col-lg-4'); ?>>
              <div class="tb-post tb-style5 tb-color1">
                <div class="tb-zoom">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tb-post-thumb tb-zoom-in1">
                    <?php the_post_thumbnail('webify-rectangle-medium-alt'); ?>
                  </a>
                </div>
                <div class="tb-post-info">
                  <div class="tb-catagory tb-style1">
                    <?php echo get_the_category_list(); ?>
                  </div>
                  <div class="empty-space marg-lg-b5"></div>
                  <h2 class="tb-post-title tb-f18-lg  tb-m0"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                  <div class="tb-post-label tb-style1">
                    <span class="tb-post-author-name vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span> 
                    <span class="tb-post-date"><?php echo get_the_date(get_option('date_format')); ?></span>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
          </div>
          <?php
          # code...
          break;
    }
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Recent_News_Widget() );