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
class Webify_Team_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-team-widget';
  }

  public function get_title() {
    return 'Team';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array('');
  }

  public function get_style_depends() {
    return array('webify-team');
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
      'team_section',
      array(
        'label' => esc_html__('Team' , 'webify-addons')
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
        'options'     => array_flip($this->get_custom_term_values('team-category')),
        'default'     => array(''),
      )
    );

    $this->add_control(
      'limit',
      array(
        'label'       => esc_html__('Limit', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 4,
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
    $limit   = $settings['limit'];
    $style   = $settings['style'];
    $orderby = $settings['orderby'];

    $args = array(
      'posts_per_page' => $limit,
      'orderby'        => $orderby,
      'order'          => 'ID',
      'post_type'      => 'team',
    );

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'team-category',
        'field'    => 'slug',
        'terms'    => $cats,
      ),
    );
    
    $the_query = new \WP_Query($args); 


    switch ($style) {
      case 'style1': ?>

        <div class="row">
          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $bg_image = $this->get_image_src(get_post_thumbnail_id(get_the_ID()));
              $position = webify_get_post_opt('team_position');
              $socials   = webify_get_post_opt('team_social');

              if(!empty($bg_image)):
          ?>
              <div class="col-lg-3 col-sm-6">
                <div class="tb-team-card tb-style1 tb-type1 tb-border tb-overflow-hidden text-center tb-relative">
                  <div class="tb-team-img tb-bg" style="background-image: url(<?php echo esc_url($bg_image); ?>);"></div>
                  <div class="tb-team-card-meta">
                    <div class="tb-team-text">
                      <h3 class="tb-f18-lg tb-font-name tb-font-name tb-white-c tb-m0"><?php the_title(); ?></h3>
                      <?php if(!empty($position)): ?>
                        <div class="tb-white-c7"><?php echo esc_html($position); ?></div>
                      <?php endif; ?>
                    </div>

                    <?php if(!empty($socials) && is_array($socials)): ?>
                      <hr>
                      <div class="tb-team-social">
                        <?php foreach($socials as $social): ?>
                          <a href="<?php echo esc_url($social['team_social_link']); ?>"><?php echo esc_html($social['team_social_name']); ?></a>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div><!-- .col -->
          <?php 
              endif; 
            endwhile; wp_reset_postdata(); 
          ?>
        </div>
        <?php
        # code...
        break;

      case 'style2': ?>

        <div class="row">
          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $bg_image = $this->get_image_src(get_post_thumbnail_id(get_the_ID()));
              $position = webify_get_post_opt('team_position');
              $socials   = webify_get_post_opt('team_social');

              if(!empty($bg_image)):
          ?>
          <div class="col-lg-3 col-sm-6">
            <div class="tb-team-card tb-style1 tb-box-shadow1 text-center">
              <div class="tb-team-img tb-bg" style="background-image: url(<?php echo esc_url($bg_image); ?>);"></div>
              <div class="tb-team-text">
                <h3 class="tb-f18-lg tb-font-name tb-m0"><?php the_title(); ?></h3>
                <?php if(!empty($position)): ?>
                  <div class="tb-team-position"><?php echo esc_html($position); ?></div>
                <?php endif; ?>
              </div>
              <?php if(!empty($socials) && is_array($socials)): ?>
                <hr>
                <div class="tb-team-social">
                  <?php foreach($socials as $social): ?>
                    <a href="<?php echo esc_url($social['team_social_link']); ?>"><?php echo esc_html($social['team_social_name']); ?></a>
                  <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </div><!-- .col -->
          <?php 
              endif; 
            endwhile; wp_reset_postdata(); 
          ?>
        </div>

        <?php
        # code...
        break;

      case 'style3': ?>
        <div class="row">

          <?php 
            while ($the_query -> have_posts()) : $the_query -> the_post(); 
              $bg_image = $this->get_image_src(get_post_thumbnail_id(get_the_ID()));
              $position = webify_get_post_opt('team_position');
              $socials  = webify_get_post_opt('team_social');

              if(!empty($bg_image)):
          ?>
            <div <?php post_class('col-lg-3 col-sm-6'); ?>>
              <div class="tb-team-card tb-style1 tb-border text-center">
                <div class="tb-team-img tb-bg" style="background-image: url(<?php echo esc_url($bg_image); ?>);"></div>
                <div class="tb-team-text">
                  <h3 class="tb-f18-lg tb-font-name tb-m0"><?php the_title(); ?></h3>
                  <?php if(!empty($position)): ?>
                    <div class="tb-team-position"><?php echo esc_html($position); ?></div>
                  <?php endif; ?>
                </div>
                <?php if(!empty($socials) && is_array($socials)): ?>
                  <hr>
                  <div class="tb-team-social">
                    <?php foreach($socials as $social): ?>
                      <a href="<?php echo esc_url($social['team_social_link']); ?>"><?php echo esc_html($social['team_social_name']); ?></a>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div><!-- .col -->
          <?php 
              endif; 
            endwhile; wp_reset_postdata(); 
          ?>

        </div>
        <?php
        # code...
        break;
      
      default:
        # code...
        break;
    }
  }
}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Team_Widget() );