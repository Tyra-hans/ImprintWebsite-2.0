<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access pages directly.


$prefix_page_opts = '_tb_page_options';

CSF::createMetabox($prefix_page_opts, array(
  'title'        => esc_html__('Page Options', 'webify'),
  'post_type'    => array('page'),
  'show_restore' => true,
  'ajax_save'    => true,
  'data_type'    => 'unserialize'
) );

CSF::createSection( $prefix_page_opts, array(
  'title'  => esc_html__('Header', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'id'         => 'header-sticky',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Sticky', 'webify'),
      'text_on'    => 'Enabled',
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style15,header-style16'),
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'         => 'header-full-width',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Full Width', 'webify'),
      'text_on'    => 'Enabled',
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style15,header-style16'),
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'      => 'header-style',
      'type'    => 'select',
      'title'   => esc_html__('Style', 'webify'),
      'options' => array(
        'header-style1'  => esc_html__('Header Style 1', 'webify'),
        'header-style2'  => esc_html__('Header Style 2', 'webify'),
        'header-style3'  => esc_html__('Header Style 3', 'webify'),
        'header-style4'  => esc_html__('Header Style 4', 'webify'),
        'header-style5'  => esc_html__('Header Style 5', 'webify'),
        'header-style6'  => esc_html__('Header Style 6', 'webify'),
        'header-style7'  => esc_html__('Header Style 7', 'webify'),
        'header-style8'  => esc_html__('Header Style 8', 'webify'),
        'header-style9'  => esc_html__('Header Style 9', 'webify'),
        'header-style10' => esc_html__('Header Style 10', 'webify'),
        'header-style11' => esc_html__('Header Style 11', 'webify'),
        'header-style12' => esc_html__('Header Style 12', 'webify'),
        'header-style13' => esc_html__('Header Style 13', 'webify'),
        'header-style14' => esc_html__('Header Style 14', 'webify'),
        'header-style15' => esc_html__('Header Style 15', 'webify'),
        'header-style16' => esc_html__('Header Style 16', 'webify'),
      ),
    ),
    array(
      'id'         => 'header-height',
      'type'       => 'dimensions',
      'title'      => esc_html__('Height', 'webify'),
      'width'      => false,
      'height'     => true,
      'units'      => array('px'),
      'output'     => array('height' => '.tb-site-header.tb-style1 .tb-main-header, .tb-site-header.tb-style3 .tb-main-header'),
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style16'),
    ),
    array(
      'type'       => 'subheading',
      'content'    => esc_html__('Top Header Settings', 'webify'),
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style16'),
    ),
    array(
      'id'         => 'top-header-enable',
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style16'),
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Top Header', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'         => 'top-header-msg',
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style16'),
      'type'       => 'textarea',
      'title'      => esc_html__('Notice Message', 'webify'),
    ),
    array(
      'id'         => 'top-header-height',
      'type'       => 'dimensions',
      'title'      => esc_html__('Height', 'webify'),
      'width'      => false,
      'height'     => true,
      'units'      => array('px'),
      'output'     => array('height' => '.tb-promotion-bar.tb-style1'),
      'dependency' => array('header-style', 'not-any', 'header-style14,header-style16'),
    ),
    array(
      'type'       => 'subheading',
      'content'    => 'Logo Settings',
    ),
    array(
      'id'    => 'header-logo',
      'type'  => 'media',
      'title' => esc_html__('Logo', 'webify'),
      'desc'  => esc_html__('Upload @2x sized image for retina display compatibility.', 'webify'),
    ),
    array(
      'id'    => 'header-logo-sticky',
      'type'  => 'media',
      'dependency' => array('header-style', 'any', 'header-style11,header-style12,header-style13'),
      'title' => esc_html__('Sticky Header Logo', 'webify'),
      'desc'  => esc_html__('Upload @2x sized image for retina display compatibility.', 'webify'),
    ),
    array(
      'type'       => 'subheading',
      'content'    => 'Social Settings',
      'dependency' => array('header-style', 'any', 'header-style10,header-style12,header-style7,header-style9,header-style14,header-style15,header-style16'),
    ),
    array(
      'id'         => 'header-social-icons',
      'type'       => 'repeater',
      'dependency' => array('header-style', 'any', 'header-style10,header-style12,header-style7,header-style9,header-style14,header-style15,header-style16'),
      'title'      => esc_html__('Social Icons', 'webify'),
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

    array(
      'type'       => 'subheading',
      'content'    => esc_html__('Button Settings', 'webify'),
      'dependency' => array('header-style', 'not-any', 'header-style15,header-style16'),
    ),
    array(
      'id'         => 'header-btn-style',
      'type'       => 'select',
      'title'      => esc_html__('Button Style', 'webify'),
      'dependency' => array('header-style', 'not-any', 'header-style15,header-style16'),
      'options'   => array(
        ''                         => esc_html__('Choose Button Style', 'webify'),
        'tb-btn-style tb-btn-br4'  => esc_html__('Style 1', 'webify'),
        'tb-btn-style tb-btn-br50' => esc_html__('Style 2', 'webify'),
      ),
    ),
    array(
      'id'         => 'header-btn-text',
      'type'       => 'text',
      'dependency' => array('header-style', 'not-any', 'header-style15,header-style16'),
      'title'      => esc_html__('Button Text', 'webify'),
    ),
    array(
      'id'         => 'header-btn-link',
      'type'       => 'text',
      'dependency' => array('header-style', 'not-any', 'header-style15,header-style16'),
      'title'      => esc_html__('Button Link', 'webify'),
    ),
  )
));

CSF::createSection($prefix_page_opts, array(
  'title'  => esc_html__('Page Header', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'id'         => 'page-header-enable',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Page Header', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
      'default'    => 1,
    ),
    array(
      'id'     => 'title-wrapper-bg',
      'type'   => 'background',
      'title'  => esc_html__('Background', 'webify'),
      'output' => '.tb-page-header'
    ),
    array(
      'id'         => 'page-header-bg-overlay',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Background Overlay', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
      'default'    => 1,
    ),
  )
));

CSF::createSection($prefix_page_opts, array(
  'title'  => esc_html__('Content', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'             => 'page-top-margin',
      'type'           => 'select',
      'default_option' => 'Select Margin',
      'title'          => esc_html__('Margin Top', 'webify'),
      'desc'           => esc_html__('Select desired margin for the content', 'webify'),
      'options'        => webify_get_space_array(),
    ),

    array(
      'id'             => 'page-bottom-margin',
      'type'           => 'select',
      'default_option' => esc_html__('Select Margin', 'webify'),
      'title'          => esc_html__('Margin Bottom', 'webify'),
      'desc'           => esc_html__('Select desired margin for the content', 'webify'),
      'options'        => webify_get_space_array(),
    ),

  )
) );

CSF::createSection($prefix_page_opts, array(
  'title'  => esc_html__('Layout', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'page-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
      'default'     => 'default'
    ),

    array(
      'id'          => 'page-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('page-layout', 'any', 'left_sidebar,right_sidebar' ),
      'default'     => '',
    ),
  )
) );

$prefix_portfolio_opts = '_tb_portfolio_options'; 
CSF::createMetabox( $prefix_portfolio_opts, array(
  'title'        => esc_html__('Portfolio Options', 'webify'),
  'post_type'    => 'portfolio',
  'ajax_save'    => true,
  'show_restore' => true,
  'data_type'    => 'unserialize'
) );



CSF::createSection($prefix_portfolio_opts, array(
  'title' => esc_html__('General', 'webify'),
  'icon'  => 'fa fa-gear',
  'fields' => array(
    array(
      'id'      => 'project-single-style',
      'type'    => 'select',
      'title'   => esc_html__('Style', 'webify'),
      'options' => array(
        'tb-type'  => esc_html__('Style 1', 'webify'),
        'tb-type1' => esc_html__('Style 2', 'webify'),
      ),
    ),

  )
) );

CSF::createSection($prefix_portfolio_opts, array(
  'title' => esc_html__('Portfolio Details', 'webify'),
  'icon'  => 'fa fa-gear',
  'fields' => array(
    array(
      'id'     => 'project-logo',
      'type'   => 'media',
      'title'  => esc_html__('Logo', 'webify'),
    ),
    array(
      'id'     => 'project-details',
      'title' => esc_html__('Details', 'webify'),
      'type'   => 'repeater',
      'fields' => array(
        array(
          'id'    => 'label',
          'type'  => 'text',
          'title' => esc_html__('Label', 'webify'),
        ),
        array(
          'id'    => 'value',
          'type'  => 'text',
          'title' => esc_html__('Value', 'webify'),
        ),
      ),
      'default' => array(
        array(
          'label' => esc_html__('Client', 'webify'),
          'value' => esc_html__('Nickelodeon', 'webify'),
        ),
        array(
          'label' => esc_html__('Role', 'webify'),
          'value' => esc_html__('Branding, Motion', 'webify'),
        ),
        array(
          'label' => esc_html__('Year', 'webify'),
          'value' => esc_html__('2019-2020', 'webify'),
        ),
        array(
          'label' => esc_html__('Platforms', 'webify'),
          'value' => esc_html__('Web & Mobile', 'webify'),
        ),
        array(
          'label' => esc_html__('Project URL', 'webify'),
          'value' => esc_html__('http://themebubble.com', 'webify'),
        ),
      ),
    ),

  )
) );

CSF::createSection($prefix_portfolio_opts, array(
  'title'  => esc_html__('Portfolio Link', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'id'     => 'portfolio-link-to',
      'type'   => 'select',
      'title'  => esc_html__('Link To', 'webify'),
      'options' => array(
        'single-page' => esc_html__('Single Page', 'webify'),
        'lightbox'    => esc_html__('Lightbox', 'webify'),
      ),
      'default' => 'single-page'
    ),

  )
) );



$prefix_testimonial_opts = '_tb_testimonial_options'; // this ID is not important. but it is required for create metabox. ok.
CSF::createMetabox( $prefix_testimonial_opts, array(
  'title'        => esc_html__('Options', 'webify'),
  'post_type'    => 'testimonial',
  'show_restore' => true,
  'data_type'    => 'unserialize' // if USED unserialize. because.
) );


CSF::createSection( $prefix_testimonial_opts, array(
  'fields' => array(

    array(
      'id'    => 'testimonial_logo',
      'type'  => 'media',
      'title' => esc_html__('Logo', 'webify')
    ),

    array(
      'id'    => 'testimonial_position',
      'type'  => 'text',
      'title' => esc_html__('Position', 'webify')
    ),

    array(
      'id'    => 'testimonial_signature',
      'type'  => 'media',
      'title' => esc_html__('Signature', 'webify')
    ),

  )
) );


$prefix_team_opts = '_tb_team_options'; // this ID is not important. but it is required for create metabox. ok.
CSF::createMetabox( $prefix_team_opts, array(
  'title'        => esc_html__('Options', 'webify'),
  'post_type'    => 'team',
  'show_restore' => true,
  'data_type'    => 'unserialize' // if USED unserialize. because.
) );


CSF::createSection( $prefix_team_opts, array(
  'fields' => array(

    array(
      'id'    => 'team_position',
      'type'  => 'text',
      'title' => esc_html__('Position', 'webify'),
    ),

    array(
      'id'     => 'team_social',
      'type'   => 'repeater',
      'max'    => 3,
      'title'  => esc_html__('Social', 'webify'),
      'fields' => array(

        array(
          'id'    => 'team_social_name',
          'type'  => 'text',
          'title' => esc_html__('Name', 'webify'),
        ),

        array(
          'id'    => 'team_social_link',
          'type'  => 'text',
          'title' => esc_html__('Link', 'webify'),
        ),

      ),
    ),

  )
) );

$prefix_menu_opts = '_tb_menu_options'; // this ID is not important. but it is required for create metabox. ok.
CSF::createMetabox( $prefix_menu_opts, array(
  'title'        => esc_html__('Menu Options', 'webify'),
  'post_type'    => 'menu',
  'ajax_save'    => true,
  'show_restore' => true,
  'data_type'    => 'unserialize' // if USED unserialize. because.
) );

CSF::createSection($prefix_menu_opts, array(
  'fields' => array(
    array(
      'id'    => 'food-status',
      'type'  => 'text',
      'title' => esc_html__('Status', 'webify'),
      'desc'  => esc_html__('Enter food status e.g Best Seller', 'webify')
    ),
    array(
      'id'    => 'food-price',
      'type'  => 'text',
      'title' => esc_html__('Price', 'webify'),
      'desc'  => esc_html__('Enter food price e.g $14', 'webify')
    ),

  )
));
