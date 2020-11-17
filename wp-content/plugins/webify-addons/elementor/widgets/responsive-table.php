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
class Webify_Responsive_Table_Widget extends Widget_Base {

  public function get_name() {
    return 'webify-responsive-table-widget';
  }

  public function get_title() {
    return 'Responsive Table';
  }

  public function get_icon() {
    return 'pa-grid';
  }

  public function get_script_depends() {
    return array();
  }

  public function get_style_depends() {
    return array('webify-table');
  }

  public function get_categories() {
    return array('webify-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'responsive_table_section',
      array(
        'label' => esc_html__('Responsive Table' , 'webify-addons')
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
      'title_one',
      array(
        'label'       => esc_html__('Title One', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Class', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1')) 
      )
    );

    $this->add_control(
      'title_two',
      array(
        'label'       => esc_html__('Title Two', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Day', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1')) 
      )
    );

    $this->add_control(
      'title_three',
      array(
        'label'       => esc_html__('Title Three', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Time', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
        'condition'   => array('style' => array('style1'))
      )
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'title_one_value',
      array(
        'label'       => esc_html__('Title One Value', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Yin Yoga for Begginers (Woman Only)', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'title_two_value',
      array(
        'label'       => esc_html__('Title Two Value', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Monday-Tuesday', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater->add_control(
      'title_three_value',
      array(
        'label'       => esc_html__('Title Three Value', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('10 AM', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'rows',
      array(
        'label'     => esc_html__('Rows', 'webify-addons'),
        'type'      => Controls_Manager::REPEATER,
        'fields'    => $repeater->get_controls(),
        'condition' => array('style' => array('style1')),
        'default'   => array(
          array(
            'title_one_value'   => esc_html__('Yin Yoga for Begginers (Woman Only)', 'webify-addons'),
            'title_two_value'   => esc_html__('Monday-Tuesday', 'webify-addons'),
            'title_three_value' => esc_html__('10 AM', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ title_one_value }}</span>',
      )
    );


    $repeater_two = new Repeater();

    $repeater_two->add_control(
      'icon_style2',
      array(
        'label'       => esc_html__('Icon', 'webify-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::MEDIA,
      )
    );

    $repeater_two->add_control(
      'title_style2',
      array(
        'label'       => esc_html__('Title', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Jan til Today', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $repeater_two->add_control(
      'value_style2',
      array(
        'label'       => esc_html__('Value', 'webify-addons'),
        'label_block' => true,
        'default'     => esc_html__('Freelance Designer at Webbox.com', 'webify-addons'),
        'type'        => Controls_Manager::TEXT,
      )
    );

    $this->add_control(
      'rows_style2',
      array(
        'label'     => esc_html__('Rows', 'webify-addons'),
        'type'      => Controls_Manager::REPEATER,
        'condition' => array('style' => array('style2')),
        'fields'    => $repeater_two->get_controls(),
        'default'   => array(
          array(
            'icon_style2'    => '',        
            'title_style2'   => esc_html__('Jan til Today', 'webify-addons'),
            'value_style2'   => esc_html__('Freelance Designer at Webbox.com', 'webify-addons'),
          ),
        ),
        'title_field' => '<span>{{ title_style2 }}</span>',
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
          '{{WRAPPER}} .tb-table-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tb-table-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_value_style',
      array(
        'label' => esc_html__('Value', 'webify-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('value_color', 
      array(
        'label'       => esc_html__('Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-table-value' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('value_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'webify-addons'),
        'type'        => Controls_Manager::COLOR,
        'separator'   => 'after',
        'selectors' => array(
          '{{WRAPPER}} .tb-table.tb-style1 .tb-table-row:nth-child(odd), .tb-table.tb-style2 .tb-table-row:hover' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'value_typography',
        'selector' => '{{WRAPPER}} .tb-table-value',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->end_controls_section();


  }

  protected function render() { 
    $settings    = $this->get_settings_for_display();
    $rows        = $settings['rows']; 
    $rows_style2 = $settings['rows_style2']; 
    $style       = $settings['style']; 



    switch ($style) {
      case 'style1':
      default: ?>
        <?php if(is_array($rows) && !empty($rows)): ?>
        <div class="table-responsive">
          <div class="tb-table tb-style1 tb-border tb-radious-4">
            <div class="tb-table-row tb-table-heading">
              <div class="tb-table-col tb-table-title"><?php echo esc_html($settings['title_one']); ?></div>
              <div class="tb-table-col tb-table-title"><?php echo esc_html($settings['title_two']); ?></div>
              <div class="tb-table-col tb-table-title"><?php echo esc_html($settings['title_three']); ?></div>
            </div>
            <?php foreach($rows as $row): ?>
              <div class="tb-table-row">
                <div class="tb-table-col tb-table-value"><?php echo esc_html($row['title_one_value']); ?></div>
                <div class="tb-table-col tb-table-value"><?php echo esc_html($row['title_two_value']); ?></div>
                <div class="tb-table-col tb-table-value"><?php echo esc_html($row['title_three_value']); ?></div>
              </div>
            <?php endforeach; ?>
          </div><!-- .tb-table -->
        </div>
        <?php endif;
        # code...
        break;

      case 'style2': 
        if(is_array($rows_style2) && !empty($rows_style2)): ?>
          <div class="table-responsive">
            <div class="tb-table tb-style2">
              <?php foreach($rows_style2 as $row): ?>
                <div class="tb-table-row">
                  <div class="tb-table-col tb-table-title"><?php echo esc_html($row['title_style2']); ?></div>
                  <div class="tb-table-col tb-table-value">
                    <?php if(!empty($row['icon_style2']['url'])): ?>
                      <div class="tb-expericnce-img"><img src="<?php echo esc_url($row['icon_style2']['url']); ?>" alt="icon"></div> 
                    <?php endif; ?>
                  <?php echo esc_html($row['value_style2']); ?></div>
                </div>
              <?php endforeach; ?>
            </div><!-- .tb-table -->
          </div>
        <?php endif;
        # code...
        break;
      
    }
  }

}
Plugin::instance()->widgets_manager->register_widget_type( new Webify_Responsive_Table_Widget() );