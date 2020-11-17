<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.


CSF::createWidget('webify_category_block', array(
  'title'       => esc_html__('- Webify Category Block', 'webify-addons'),
  'classname'   => 'tb-category-block',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => esc_html__('Title')
    ),
    array(
      'id'          => 'cats',
      'type'        => 'select',
      'title'       => esc_html__('Category'),
      'multiple'    => true,
      'chosen'      => true,
      'options'     => 'categories',
      'placeholder' => esc_html__('Select Categories', 'webify-addons')
    ),
  )
));


if(!function_exists( 'webify_category_block' ) ) {
  function webify_category_block( $args, $instance ) {

    echo $args['before_widget'];

    if (!empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    $cats = (!empty($instance['cats'])) ? $instance['cats']:'';

    $cat_args = array(
      'orderby' => 'name',
      'order'   => 'ASC',
      'include' => implode(',', $cats)
    );

    $fcategories = get_categories($cat_args); 

    if(!is_wp_error($fcategories)): ?>
      <ul class="tb-categorie-list">
        <?php foreach($fcategories as $key => $term):  
          $thumbnail = get_term_meta($term->term_id, 'category_image'); 
          if(is_array($thumbnail) && !empty($thumbnail[0]['url'])):
        ?>
          <li class="tb-zoom">
            <a href="<?php echo get_category_link($term->term_id); ?>" class="tb-single-categorie tb-zoom tb-radious-4">
              <div class="tb-categorie-img tb-zoom-in1" style="background-image: url(<?php echo esc_url($thumbnail[0]['url']); ?>);"></div>
              <span class="tb-categorie-text"><?php echo esc_html($term->name); ?></span>
            </a>
          </li>
        <?php endif; endforeach; ?>
      </ul>
    <?php endif; 
        
    echo $args['after_widget'];

  }
}