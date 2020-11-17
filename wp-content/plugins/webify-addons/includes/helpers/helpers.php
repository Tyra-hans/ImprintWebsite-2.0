<?php
if(!function_exists('webify_get_icons')) {
  function webify_get_icons($icon_type = 'default') {
    $icons_keys = array();
    switch ($icon_type) {
      case 'default':
      default:
        $icons = file_get_contents(WEBIFY_PLUGIN_DIR .'/assets/fonts/iconsmind.json');
        # code...
        break;
      
      case 'material':
        $icons = file_get_contents(WEBIFY_PLUGIN_DIR .'/assets/fonts/material-icons.json');
        # code...
        break;
    }
    $icons = json_decode($icons, true);
    return $icons;
  }
}

if(!function_exists('webify_custom_font')) {
  function webify_custom_font() {
    $custom_fonts = webify_get_opt('custom_fonts');
    $output = '';

    if(!empty($custom_fonts) && is_array($custom_fonts)) {
      foreach($custom_fonts as $key => $font) {
        if(!empty($font['name']) && !empty($font['ttf']['url']) || !empty($font['eot']['url']) || !empty($font['woff']['url']) || !empty($font['woff2']['url']) || !empty($font['woff2']['url'])) {

          $firstfile = true;
          $output .= '@font-face {';
          $output .= 'font-family:';
          if ( false !== strpos( $font['name'], ' ')) {
            $font_face .= '"'.$font['name'].'";';
          } else {
            $output .= $font['name'].';';
          }
          $output .= 'src:';
          if (isset($font['eot']) && $font['eot']['url']) {
            $output .= 'url("'.str_replace( array('http://', 'https://'), '//', $font['eot']['url']).'?#iefix") format("embedded-opentype")';
            $firstfile = false;
          }
          if (isset($font['woff']) && $font['woff']['url']) {
            $output .= ($firstfile) ? '' : ',';
            $output .= 'url("'.str_replace( array('http://', 'https://'), '//', $font['woff']['url']).'") format("woff")';
            $firstfile = false;
          }
          if (isset($font['woff2']) && $font['woff2']['url']) {
            $output .= ($firstfile) ? '' : ',';
            $output .= 'url("'.str_replace( array('http://', 'https://'), '//', $font['woff2']['url']).'") format("woff2")';
            $firstfile = false;
          }
          if (isset($font['ttf']) && $font['ttf']['url']) {
            $output .= ($firstfile) ? '' : ',';
            $output .= 'url("'.str_replace( array('http://', 'https://'), '//', $font['ttf']['url']).'") format("truetype")';
            $firstfile = false;
          }
          if (isset($font['svg']) && $font['svg']['url']) {
            $output .= ($firstfile) ? '' : ',';
            $output .= 'url("'.str_replace( array('http://', 'https://'), '//', $font['svg']['url']).'") format("svg")';
            $firstfile = false;
          }
          $output .= ';';
          $output .= (!empty($font['font-weight'])) ? 'font-weight:'.$font['font-weight'].';':'font-weight:normal;';
          $output .= 'font-style: normal;';
          $output .= '}';

        }
      }   
    }

    return $output;
  }
}

if(!function_exists('webify_get_page_templates')) {
  function webify_get_page_templates($type = null) {
    $args = array(
      'post_type'      => 'elementor_library',
      'posts_per_page' => -1,
    );

    if($type) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'elementor_library_type',
          'field' => 'slug',
          'terms' => $type,
        ),
      );
    }

    $page_templates = get_posts($args);
    $options = array();

    if(!empty($page_templates) && !is_wp_error($page_templates)) {
      foreach ($page_templates as $post) {
        $options[$post->ID] = $post->post_title;
      }
    }
    return $options;
  }
}

if(!function_exists('webify_get_form_id')) {
  function webify_get_form_id() {
    global $wpdb;

    $db_mc4wpfroms = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'mc4wp-form'");
    $mc4wp_forms   = array();

    if ($db_mc4wpfroms) {

      foreach ($db_mc4wpfroms as $mc4wpform) {
        $mc4wp_forms[$mc4wpform->post_title] = $mc4wpform->ID;
      }

    } else {
      $mc4wp_forms['No forms found'] = 0;
    }

    return $mc4wp_forms;
  }
}