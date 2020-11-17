<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access pages directly.

$option_name = '_tb_options';
CSF::createOptions( $option_name, array(
  'framework_title' => esc_html__('Webify', 'webify'),
  'menu_title'         => 'Theme Options',
  'menu_slug'          => 'tb-theme-options',
  'menu_type'          => 'submenu',
  'show_in_customizer' => true,
  'menu_parent'        => 'webify_theme_welcome',
  'ajax_save'          => false,
  'defaults'           => webify_options_default()
) );

CSF::createSection( $option_name, array(
  'title'  => esc_html('General', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'id'         => 'preloader',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Preloader', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'    => 'loader-logo',
      'type'  => 'media',
      'title' => esc_html__('Preloader Logo', 'webify'),
      'desc'  => esc_html__('Upload @2x sized image for retina display compatibility.', 'webify'),
    ),
    array(
      'id'     => 'custom-sidebar',
      'type'   => 'repeater',
      'title'  => esc_html('Custom Sidebars', 'webify'),
      'fields' => array(
        array(
          'id'    => 'sidebar-name',
          'type'  => 'text',
          'title' => esc_html('Sidebar Name', 'webify'),
        ),
      ),
      'subtitle' => esc_html('Custom sidebars can be assigned to any page or post.', 'webify'),
    ),
    array(
      'id'          => 'page-layout',
      'type'        => 'select',
      'title'       => esc_html('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'page-sidebar',
      'type'        => 'select',
      'title'       => esc_html('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('page-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),
    array(
      'id'    => 'google-map-api',
      'type'  => 'text',
      'title' => esc_html('Google Map API Key', 'webify'),
    ),
  )
));


CSF::createSection( $option_name, array(
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


CSF::createSection( $option_name, array(
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
    ),
    array(
      'id'     => 'page-header-bg',
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
    ),
  )
));


CSF::createSection( $option_name, array(
  'title'  => esc_html__('Blog Single Post', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'blog-single-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'blog-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('blog-single-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),
    array(
      'id'         => 'blog-single-social-share',
      'type'       => 'switcher',
      'title'      => esc_html__('Social Share', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'         => 'blog-single-post-vote',
      'type'       => 'switcher',
      'title'      => esc_html__('Post Vote', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
  )
));

CSF::createSection( $option_name, array(
  'id'    => 'typography',
  'title' => esc_html__('Typography', 'webify'),
  'icon'  => 'fa fa-gear',
) );

CSF::createSection( $option_name, array(
  'parent' => 'typography',
  'title'  => esc_html__('Heading', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'                 => 'heading',
      'type'               => 'typography',
      'output'             => '.tb-font-name',
      'title'              => 'Heading',
      'preview'            => 'always',
      'font_family'        => true,
      'font_weight'        => true,
      'font_style'         => true,
      'font_size'          => true,
      'line_height'        => true,
      'letter_spacing'     => true,
      'text_align'         => false,
      'text-transform'     => true,
      'color'              => true,
      'subset'             => true,
      'backup_font_family' => true,
      'font_variant'       => true,
      'word_spacing'       => true,
      'text_decoration'    => true,
    ),

  )
));

CSF::createSection( $option_name, array(
  'parent' => 'typography',
  'title'  => esc_html__('Body', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'                 => 'body',
      'type'               => 'typography',
      'output'             => 'body',
      'title'              => 'Body',
      'preview'            => 'always',
      'font_family'        => true,
      'font_weight'        => true,
      'font_style'         => true,
      'font_size'          => true,
      'line_height'        => true,
      'letter_spacing'     => true,
      'text_align'         => false,
      'text-transform'     => true,
      'color'              => true,
      'subset'             => true,
      'backup_font_family' => true,
      'font_variant'       => true,
      'word_spacing'       => true,
      'text_decoration'    => true,
    ),

  )
));

CSF::createSection( $option_name, array(
  'parent' => 'typography',
  'title'  => esc_html__('Custom Font', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'     => 'custom_fonts',
      'type'   => 'repeater',
      'title'  => esc_html__('Upload Custom Fonts', 'webify'),
      'fields' => array(
        array(
          'id'          => 'name',
          'type'        => 'text',
          'title'       => esc_html__('Font Family', 'webify'),
          'placeholder' => 'Arial',
        ),
        array(
          'id'    => 'ttf',
          'type'  => 'media',
          'title' => esc_html__('Upload .ttf (Optional)', 'webify'),
        ),
        array(
          'id'    => 'eot',
          'type'  => 'media',
          'title' => esc_html__('Upload .eot (Optional)', 'webify'),
        ),
        array(
          'id'    => 'svg',
          'type'  => 'media',
          'title' => esc_html__('Upload .svg (Optional)', 'webify'),
        ),
        array(
          'id'    => 'woff',
          'type'  => 'media',
          'title' => esc_html__('Upload .woff (Optional)', 'webify'),
        ),
        array(
          'id'    => 'woff2',
          'type'  => 'media',
          'title' => esc_html__('Upload .woff2 (Optional)', 'webify'),
        ),
        array(
          'id'          => 'font-weight',
          'type'        => 'text',
          'title'       => esc_html__('Font Weight', 'webify'),
          'placeholder' => '400',
        ),
      ),
    ),

  )
));

CSF::createSection($option_name, array(
  'id'    => 'styling',
  'title' => esc_html__('Styling', 'webify'),
  'icon'  => 'fa fa-gear',
) );

CSF::createSection($option_name, array(
  'parent' => 'styling',
  'title'  => esc_html__('Global', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'id'               => 'accent-color',
      'type'             => 'color',
      'title'            => esc_html__('Accent Color','webify'),
      'output'           => array(
        'color' => '.tb-post.tb-color1 .tb-catagory.tb-style1 .post-categories a, 
        .sidebar-item.widget ul li a:hover, 
        .tb-simple-text a, .tb-tags a:hover, 
        .comment-list .reply a:hover, .comment-list .fn a:hover,
        .woocommerce-MyAccount-content a,
        .woocommerce .lost_password a:hover',

        'background' => '.page-numbers li .page-numbers.current, 
        .page-numbers li a:hover, .page-links .current, 
        .checkout-button,
        .tb-error-section .tb-btn.tb-color18',
      ),
      'output_important' => true,
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Heading', 'webify'),
    ),
    array(
      'id'     => 'heading-h1-color',
      'type'   => 'link_color',
      'title'  => esc_html__('H1', 'webify'),
      'output' => array('color' => 'h1,h1 a'),
    ), 
    array(
      'id'     => 'heading-h2-color',
      'type'   => 'link_color',
      'title'  => esc_html__('H2', 'webify'),
      'output' => array('color' => 'h2,h2 a'),
    ),
    array(
      'id'     => 'heading-h3-color',
      'type'   => 'link_color',
      'title'  => esc_html__('H3', 'webify'),
      'output' => array('color' => 'h3,h3 a'),
    ),  
    array(
      'id'     => 'heading-h4-color',
      'type'   => 'link_color',
      'title'  => esc_html__('H4', 'webify'),
      'output' => array('color' => 'h4,h4 a'),
    ),
    array(
      'id'     => 'heading-h5-color',
      'type'   => 'link_color',
      'title'  => esc_html__('H5', 'webify'),
      'output' => array('color' => 'h5,h5 a'),
    ),
    array(
      'id'     => 'heading-h6-color',
      'type'   => 'link_color',
      'title'  => esc_html__('H6', 'webify'),
      'output' => array('color' => 'h6,h6 a'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Body / Content', 'webify'),
    ),
    array(
      'id'     => 'content-color',
      'type'   => 'color',
      'title'  => esc_html__('Color', 'webify'),
      'output' => array('color' => 'body'),
    ),          
  )
));

CSF::createSection($option_name, array(
  'parent' => 'styling',
  'title'  => esc_html__('Header', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Normal', 'webify'),
    ),
    array(
      'id'                    => 'header-bg',
      'type'                  => 'background',
      'title'                 => esc_html__('Background', 'webify'),
      'background_color'      => true,
      'background_image'      => true,
      'background-position'   => true,
      'background_repeat'     => true,
      'background_attachment' => true,
      'background_size'       => true,
      'background_origin'     => true,
      'background_clip'       => true,
      'background_blend_mode' => true,
      'background_gradient'   => true,
      'output'                => '.tb-site-header, .tb-main-header-bottom',
      'output_important'      => true
    ),
    array(
      'id'               => 'header-border-color',
      'type'             => 'color',
      'title'            => esc_html__('Border Color', 'webify'),
      'output'           => array('border-color' => '.tb-header-border1'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Sticky', 'webify'),
    ),
    array(
      'id'                    => 'header-bg-sticky',
      'type'                  => 'background',
      'title'                 => esc_html__('Background', 'webify'),
      'background_color'      => true,
      'background_image'      => true,
      'background-position'   => true,
      'background_repeat'     => true,
      'background_attachment' => true,
      'background_size'       => true,
      'background_origin'     => true,
      'background_clip'       => true,
      'background_blend_mode' => true,
      'background_gradient'   => true,
      'output'                => '.tb-site-header.small-height',
      'output_important'      => true
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Menu Settings', 'webify'),
    ),
    array(
      'id'               => 'menu-link-color',
      'type'             => 'link_color',
      'title'            => esc_html__('Link Color','webify'),
      'output'           => '.tb-site-header .tb-primary-nav-list > .menu-item > a',
      'output_important' => true
    ),


    array(
      'type'    => 'notice',
      'content' => esc_html__('Hamburger Menu', 'webify'),
      'style'   => 'info'
    ),
    array(
      'id'                    => 'hamburger-menu-bg',
      'type'                  => 'background',
      'title'                 => esc_html__('Background', 'webify'),
      'background_color'      => false,
      'background_image'      => true,
      'background-position'   => true,
      'background_repeat'     => true,
      'background_attachment' => true,
      'background_size'       => true,
      'background_origin'     => true,
      'background_clip'       => true,
      'background_blend_mode' => false,
      'background_gradient'   => false,
      'output'                => '.tb-full-screen-nav, .tb-menu-bg',
    ),
    array(
      'id'     => 'hamburger-menu-overlay-bg-color',
      'type'   => 'color',
      'title'  => esc_html__('Overlay Background Color', 'webify'),
      'output' => array('background' => '.tb-full-screen-nav-overlay'),
    ),
    array(
      'id'     => 'hamburger-menu-bar-color',
      'type'   => 'color',
      'title'  => esc_html__('Bar Color', 'webify'),
      'output' => array('background' => '.tb-m-menu-btn span, .tb-m-menu-btn span:before, .tb-m-menu-btn span:after'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Sub Menu Settings', 'webify'),
    ),
    array(
      'id'                    => 'sub-menu-bg',
      'type'                  => 'background',
      'title'                 => esc_html__('Background', 'webify'),
      'background_color'      => true,
      'background_image'      => true,
      'background-position'   => true,
      'background_repeat'     => true,
      'background_attachment' => true,
      'background_size'       => true,
      'background_origin'     => true,
      'background_clip'       => true,
      'background_blend_mode' => true,
      'background_gradient'   => true,
      'output'                => '.tb-site-header .tb-primary-nav-list ul:not(.tb-mega-menu-list)',
      'output_important'      => true
    ),
    array(
      'id'               => 'sub-menu-border-color',
      'type'             => 'color',
      'title'            => esc_html__('Border Color', 'webify'),
      'output'           => array('border-color' => '.tb-primary-nav .menu-item-has-children>ul, .tb-primary-nav .tb-mega-menu .tb-mega-wrapper>li'),
    ),
    array(
      'id'               => 'sub-menu-link-color',
      'type'             => 'link_color',
      'title'            => esc_html__('Link Color','webify'),
      'output'           => '.tb-site-header .tb-primary-nav-list ul li a',
      'output_important' => true
    ),
    array(
      'id'               => 'sub-menu-item-bg',
      'type'             => 'color',
      'title'            => esc_html__('Item Background Color on Hover', 'webify'),
      'output'           => array('background' => '.tb-primary-nav .tb-mega-wrapper ul li a:hover, .tb-site-header .tb-primary-nav ul li ul li:hover>a'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Button Settings', 'webify'),
    ),
    array(
      'id'               => 'header-btn-bg-color',
      'type'             => 'color',
      'title'            => esc_html__('Background Color','webify'),
      'output'           => array('background' => '.tb-site-header .tb-btn'),
      'output_important' => true
    ),
    array(
      'id'               => 'header-btn-bg-color-hover',
      'type'             => 'color',
      'title'            => esc_html__('Background Color on Hover','webify'),
      'output'           => array('background' => '.tb-site-header .tb-btn:hover'),
      'output_important' => true
    ),
    array(
      'id'               => 'header-btn-border-color',
      'type'             => 'color',
      'title'            => esc_html__('Border Color','webify'),
      'output'           => array('border-color' => '.tb-site-header .tb-btn'),
      'output_important' => true
    ),
    array(
      'id'               => 'header-btn-border-color-hover',
      'type'             => 'color',
      'title'            => esc_html__('Border Color on Hover','webify'),
      'output'           => array('border-color' => '.tb-site-header .tb-btn:hover'),
      'output_important' => true
    ),
    array(
      'id'               => 'header-btn-text-color',
      'type'             => 'link_color',
      'title'            => esc_html__('Text Color','webify'),
      'output'           => array('color' => '.tb-site-header .tb-btn'),
      'output_important' => true
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Social Settings', 'webify'),
    ),
    array(
      'id'               => 'header-social-color',
      'type'             => 'link_color',
      'title'            => esc_html__('Color','webify'),
      'output'           => array('color' => '.tb-header-social-btn a'),
      'output_important' => true
    ),
  )
));

CSF::createSection( $option_name, array(
  'parent' => 'styling',
  'title'  => esc_html__('Footer', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'                    => 'footer-bg',
      'type'                  => 'background',
      'title'                 => esc_html__('Background', 'webify'),
      'background_color'      => true,
      'background_image'      => true,
      'background-position'   => true,
      'background_repeat'     => true,
      'background_attachment' => true,
      'background_size'       => true,
      'background_origin'     => true,
      'background_clip'       => true,
      'background_blend_mode' => true,
      'background_gradient'   => true,
      'output'                => '.tb-site-footer, .tb-site-footer.tb-style2'
    ),
    array(
      'id'     => 'footer-border-color',
      'type'   => 'color',
      'title'  => esc_html__('Border Color','webify'),
      'output' => array('border-color' => '.tb-site-footer hr')
    ),
    array(
      'id'               => 'footer-heading-color',
      'type'             => 'color',
      'title'            => esc_html__('Heading Color', 'webify'),
      'output'           => '.tb-footer-widget-title',
      'output_important' => true,
    ),
    array(
      'id'     => 'footer-text-color',
      'type'   => 'color',
      'title'  => esc_html__('Text Color','webify'),
      'output' => '.tb-site-footer, .tb-copyright.tb-style1'
    ),
    array(
      'id'    => 'footer-link-color',
      'type'  => 'link_color',
      'title' => esc_html__('Link Color','webify'),
      'output' => '.tb-site-footer a, .tb-footer-social-btn.tb-style1.tb-color1 a'
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Call to Action Settings', 'webify'),
    ),
    array(
      'id'     => 'footer-cta-heading-color',
      'type'   => 'color',
      'title'  => esc_html__('Heading Color', 'webify'),
      'output' => '.tb-cta-left .tb-font-name'
    ),
    array(
      'id'     => 'footer-cta-btn-bg-color',
      'type'   => 'color',
      'title'  => esc_html__('Button Background Color', 'webify'),
      'output' => array('background-color' => '.tb-cta-right .tb-btn.tb-cta-btn')
    ),
    array(
      'id'     => 'footer-cta-btn-bg-hover-color',
      'type'   => 'color',
      'title'  => esc_html__('Button Background Color on Hover', 'webify'),
      'output' => array('background-color' => '.tb-cta-right .tb-btn.tb-cta-btn:hover')
    ),
    array(
      'id'     => 'footer-cta-btn-text-color',
      'type'   => 'color',
      'title'  => esc_html__('Button Text Color', 'webify'),
      'output' => array('color' => '.tb-cta-right .tb-btn.tb-cta-btn')
    ),
    array(
      'id'     => 'footer-cta-btn-text-color-hover',
      'type'   => 'color',
      'title'  => esc_html__('Button Text Color on Hover', 'webify'),
      'output' => array('color' => '.tb-cta-right .tb-btn.tb-cta-btn:hover')
    ),

    array(
      'type'    => 'subheading',
      'content' => esc_html__('Newsletter Settings', 'webify'),
    ),

    array(
      'id'     => 'footer-newsletter-btn-bg-color',
      'type'   => 'color',
      'title'  => esc_html__('Button Background Color', 'webify'),
      'output' => array('background-color' => '.tb-site-footer .tb-newsletter.tb-style8 button')
    ),
    array(
      'id'     => 'footer-newsletter-btn-bg-hover-color',
      'type'   => 'color',
      'title'  => esc_html__('Button Background Color on Hover', 'webify'),
      'output' => array('background-color' => '.tb-site-footer .tb-newsletter.tb-style8 button:hover')
    ),
    array(
      'id'     => 'footer-newsletter-btn-icon-color',
      'type'   => 'color',
      'title'  => esc_html__('Icon Color', 'webify'),
      'output' => array('color' => '.tb-site-footer .tb-newsletter.tb-style8 button i')
    ),

    array(
      'type'    => 'subheading',
      'content' => esc_html__('Social Settings', 'webify'),
    ),
    array(
      'id'               => 'footer-social-color',
      'type'             => 'link_color',
      'title'            => esc_html__('Color','webify'),
      'output'           => array('color' => '.tb-footer-social-btn a'),
      'output_important' => true
    ),
  )
));

CSF::createSection( $option_name, array(
  'title'  => esc_html__('Archive Page', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'archive-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'archive-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('archive-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),

  )
));

CSF::createSection( $option_name, array(
  'title'  => esc_html__('Search Page', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'search-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'search-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('search-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),

  )
));


CSF::createSection( $option_name, array(
  'title'  => esc_html__('Author Page', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'author-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'author-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('author-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),

  )
));

CSF::createSection( $option_name, array(
  'title'  => esc_html__('Shop Page', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'shop-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'shop-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('shop-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),

  )
));

CSF::createSection($option_name, array(
  'title'  => esc_html__('Shop Single', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'          => 'shop-single-layout',
      'type'        => 'select',
      'title'       => esc_html__('Layout', 'webify'),
      'options'     => array(
        'default'       => esc_html__('1 Column', 'webify'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'webify'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'webify'),
      ),
    ),
    array(
      'id'          => 'shop-single-sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Sidebar', 'webify'),
      'options'     => webify_get_custom_sidebars_list(),
      'dependency'  => array('shop-single-layout', 'any', 'left_sidebar,right_sidebar' ),
    ),
    array(
      'type'       => 'subheading',
      'content'    => esc_html__('Newsletter Settings', 'webify'),
    ),
    array(
      'id'         => 'shop-newsletter',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Newsletter', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'     => 'shop-newsletter-image',
      'type'   => 'media',
      'title'  => esc_html__('Image', 'webify'),
    ),
    array(
      'id'     => 'shop-newsletter-heading',
      'type'   => 'text',
      'title'  => esc_html__('Heading', 'webify'),
    ),
    array(
      'id'     => 'shop-newsletter-sub-heading',
      'type'   => 'text',
      'title'  => esc_html__('Sub Heading', 'webify'),
    ),
    array(
      'id'         => 'shop-newsletter-btn-style',
      'type'       => 'select',
      'title'      => esc_html__('Button Style', 'webify'),
      'options'   => array(
        ''                         => esc_html__('Choose Button Style', 'webify'),
        'tb-btn-style tb-btn-br4'  => esc_html__('Style 1', 'webify'),
        'tb-btn-style tb-btn-br50' => esc_html__('Style 2', 'webify'),
      ),
    ),
  )
));

CSF::createSection( $option_name, array(
  'title'  => esc_html__('404 Page', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(

    array(
      'id'               => 'error-page-bg',
      'type'             => 'background',
      'background_color' => false,
      'title'            => esc_html__('Background', 'webify'),
      'output'           => '.tb-error-page'
    ),

    array(
      'id'      => 'error-page-heading',
      'type'    => 'text',
      'title'   => esc_html__('Heading', 'webify'),
    ),

    array(
      'id'      => 'error-page-content',
      'type'    => 'textarea',
      'title'   => esc_html__('Content', 'webify'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Button Settings', 'webify'),
    ),
    array(
      'id'      => 'error-page-btn-text',
      'type'    => 'text',
      'title'   => esc_html__('Button Text', 'webify'),
    ),
  )
));

CSF::createSection( $option_name, array(
  'title'  => esc_html__('Footer', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'id'         => 'footer-enable-switch',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Footer', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'         => 'footer-sticky',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Sticky', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'         => 'footer-scroll-top',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Scroll Top', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
    ),
    array(
      'id'         => 'footer-style',
      'type'       => 'select',
      'title'      => esc_html__('Style', 'webify'),
      'options'    => array(
        'footer-style1' => esc_html__('Footer Style 1', 'webify'),
        'footer-style2' => esc_html__('Footer Style 2', 'webify'),
        'footer-style3' => esc_html__('Footer Style 3', 'webify'),
        'footer-style4' => esc_html__('Footer Style 4', 'webify'),
        'footer-style5' => esc_html__('Footer Style 5', 'webify'),
        
      ),
    ),

    array(
      'type'       => 'subheading',
      'content'    => esc_html__('Call to Action Settings', 'webify'),
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-enable-cta',
      'type'       => 'switcher',
      'title'      => esc_html__('Enable Call to Action', 'webify'),
      'text_on'    => 'Enabled',
      'text_off'   => 'Disabled',
      'text_width' => '100',
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-cta-heading',
      'type'       => 'text',
      'title'      => esc_html__('Heading', 'webify'),
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-cta-btn-style',
      'type'       => 'select',
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
      'title'      => esc_html__('Button Style', 'webify'),
      'options'   => array(
        ''                         => esc_html__('Choose Button Style', 'webify'),
        'tb-btn-style tb-btn-br4'  => esc_html__('Style 1', 'webify'),
        'tb-btn-style tb-btn-br50' => esc_html__('Style 2', 'webify'),
      ),
    ),
    array(
      'id'         => 'footer-cta-btn-text',
      'type'       => 'text',
      'title'      => esc_html__('Button Text', 'webify'),
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-cta-btn-link',
      'type'       => 'text',
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
      'title'      => esc_html__('Button Link', 'webify'),
    ),
    array(
      'type'       => 'subheading',
      'content'    => esc_html__('Footer Column Settings', 'webify'),
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-column',
      'type'       => 'select',
      'title'      => esc_html__('Footer Columns', 'webify'),
      'dependency' => array('footer-style', 'any', 'footer-style1,footer-style2'),
      'options'    => array(
        '4' => esc_html__('Column 4', 'webify'),
        '3' => esc_html__('Column 3', 'webify'),
        '2' => esc_html__('Column 2', 'webify'),
        '1' => esc_html__('Column 1', 'webify'),
      ),
    ),
    array(
      'id'         => 'footer-sidebar-1',
      'type'       => 'select',
      'title'      => esc_html__('Footer Sidebar 1', 'webify'),
      'subtitle'   => esc_html__('Select custom sidebar', 'webify'),
      'options'    => webify_get_custom_sidebars_list(),
      'dependency' => array('footer-column|footer-style', 'any|any', '4,3,2,1|footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-sidebar-2',
      'type'       => 'select',
      'title'      => esc_html__('Footer Sidebar 2', 'webify'),
      'subtitle'   => esc_html__('Select custom sidebar', 'webify'),
      'options'    => webify_get_custom_sidebars_list(),
      'dependency' => array('footer-column|footer-style', 'any|any', '4,3,2|footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-sidebar-3',
      'type'       => 'select',
      'title'      => esc_html__('Footer Sidebar 3', 'webify'),
      'subtitle'   => esc_html__('Select custom sidebar', 'webify'),
      'options'    => webify_get_custom_sidebars_list(),
      'dependency' => array('footer-column|footer-style', 'any|any', '4,3|footer-style1,footer-style2'),
    ),
    array(
      'id'         => 'footer-sidebar-4',
      'type'       => 'select',
      'title'      => esc_html__('Footer Sidebar 4', 'webify'),
      'subtitle'   => esc_html__('Select custom sidebar', 'webify'),
      'options'    => webify_get_custom_sidebars_list(),
      'dependency' => array('footer-column|footer-style', 'any|any', '4|footer-style1,footer-style2'),
    ),

    array(
      'id'         => 'footer-logo',
      'type'       => 'media',
      'title'      => esc_html__('Logo', 'webify'),
      'dependency' => array('footer-style', '==', 'footer-style3'),
    ),

    array(
      'id'         => 'footer-content',
      'type'       => 'textarea',
      'title'      => esc_html__('Content', 'webify'),
      'dependency' => array('footer-style', '==', 'footer-style3'),
    ),

    array(
      'type'       => 'subheading',
      'content'    => esc_html__('Social Settings', 'webify'),
      'dependency' => array('footer-style', 'any', 'footer-style3,footer-style4,footer-style5'),
    ),
    array(
      'id'         => 'footer-social-icons',
      'type'       => 'repeater',
      'dependency' => array('footer-style', 'any', 'footer-style3,footer-style4,footer-style5'),
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
      'type'    => 'subheading',
      'content' => esc_html__('Copyright Settings', 'webify'),
    ),
    array(
      'id'    => 'footer-copyright-text',
      'type'  => 'textarea',
      'title' => esc_html__('Copyright Text', 'webify'),
    ),
  )
));

CSF::createSection($option_name, array(
  'title'  => esc_html__('Backup', 'webify'),
  'icon'   => 'fa fa-gear',
  'fields' => array(
    array(
      'type' => 'backup',
    ),
  )
));
