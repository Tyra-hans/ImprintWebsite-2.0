<?php
/**
 * View Welcome
 *
 * @package webify
 * @since 1.0
 */
require_once 'header.php';
$theme_details = wp_get_theme();
?>

<div class="tb-admin-wrapper about-wrap">
  <div class="tb-wc-header">
      <h1>Welcome to <?php echo esc_html($theme_details->get('Name')); ?> <div class="tb-theme-version">V<?php echo esc_html($theme_details->get('Version')); ?></div></h1>
      <div class="about-text">
         Thanks for using webify. We've worked for more than 1.5 years to release a great product. Also, we'll continuously work on it to improve it even more by supporting this theme.
      </div>
  </div>

  <div class="feature-section two-column">
  
    <div class="half-width">
      <div class="tb-intro-image">
        <img src="<?php echo get_theme_file_uri('admin/assets/img/dashboard/icons/07.png'); ?>" alt="<?php echo esc_attr__('icon', 'webify'); ?>">
      </div>
    </div>

    <div class="half-width last-box">
      
      <div class="process-list">
        <h4>Now what ? Follow these steps:</h4>
        <ul>
          <li><span>Step 1:</span>Activate theme with envato purchase code.</li>
          <li><span>Step 2:</span>Activate all plugins.</a></li>
          <li><span>Step 3:</span>Go to <a href="<?php echo admin_url('site-health.php?tab=debug'); ?>">Site Health</a> tab and check if your web hosting settings is good to go.</a></li>
          <li><span>Step 4:</span>Import demos, by going to <a href="<?php echo admin_url('themes.php?page=pt-one-click-demo-import'); ?>">Theme Options > Demo Import.</a></li>
          <li><span>Step 5:</span>Start customizing — go to help center & watch video tutorials.</a></li>
        </ul>
      </div>

    </div>
  
  </div>


</div>
