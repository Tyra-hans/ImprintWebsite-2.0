<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access pages directly.


$prefix_taxonomy_opts = '_tb_taxonomy_options';

CSF::createTaxonomyOptions($prefix_taxonomy_opts, array(
  'taxonomy'  => 'category',
  'data_type' => 'unserialize'
) );

CSF::createSection($prefix_taxonomy_opts, array(
  'fields' => array(
    array(
      'id'     => 'category_image',
      'type'   => 'media',
      'title'  => esc_html__('Category Image', 'webify'),
    ),
  )
  
));

