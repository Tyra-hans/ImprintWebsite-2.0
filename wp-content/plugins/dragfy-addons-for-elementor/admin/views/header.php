<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

  $section = (!empty( $_GET['section'])) ? $_GET['section'] : 'general';
  $links   = array(
    'general'    => 'General',
    'elements'   => 'Elements',
  );

?>
<div class="df-general df-admin-wrap df-general-wrap">

  <div class="df-dragfy-header">
    <div class="df-dragfy-logo"><img src="<?php echo Dragfy_Addons_Elementor::include_plugin_url('admin/assets/img/logo.svg'); ?>" alt="logo"></div>
    <h1><?php echo esc_html__('Dragfy Addons for Elementor', 'dragfy-addons-for-elementor'); ?></h1>
    <a href="<?php echo Admin::$url; ?>" class="df-heading-btn"><?php echo esc_html__('Upgrade to Pro', 'dragfy-addons-for-elementor'); ?></a>
  </div>

  <h2 class="nav-tab-wrapper wp-clearfix">
    <?php
      foreach($links as $key => $link) {
        $activate = ($section === $key) ? ' nav-tab-active' : '';
        echo '<a href="'. add_query_arg( array('page' => Admin::$page_slug, 'section' => $key), admin_url('admin.php')) .'" class="nav-tab'. $activate .'">'. $link .'</a>';
      }
      echo '<a href="'.Admin::$url.'" target="_blank" class="nav-tab">'.esc_html__('Go Premium', 'dragfy-addons-for-elementor').'</a>';
    ?>
  </h2>
