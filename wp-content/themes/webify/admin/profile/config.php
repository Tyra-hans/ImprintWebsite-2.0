<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access pages directly.


$prefix_profile_opts = '_tb_profile_options';

CSF::createProfileOptions($prefix_profile_opts, array(
  'data_type'    => 'unserialize'
) );

CSF::createSection($prefix_profile_opts, array(
  'title'  => esc_html__('Social Options', 'webify'),
  'fields' => array(
    array(
      'id'     => 'profile_social',
      'type'   => 'repeater',
      'max'    => 3,
      'title'  => esc_html__('Social', 'webify'),
      'fields' => array(
        array(
          'id'    => 'icon',
          'type'  => 'icon',
          'title' => esc_html__('Icon', 'webify'),
        ),
        array(
          'id'    => 'url',
          'type'  => 'text',
          'title' => esc_html__('URL', 'webify'),
        ),

      ),
    ),
  )
  
));

