<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<div class="wrap">
  <div class="response-wrap"></div>
  <form action="" method="POST" id="df-settings" name="df-settings">
    <?php 
      Admin::$element_keys = (\Dragfy_Addons_Elementor::$premium) ? array_diff(Admin::$element_keys, Admin::$element_pro_keys):Admin::$element_keys; 
      if(!empty(Admin::$element_keys) && is_array(Admin::$element_keys)): 
    ?>
      <div class="df-elements-settings">
        <div id="df-modules" class="df-elements">

          <?php foreach(Admin::$element_keys as $key): ?>
            <div class="df-element">
              <span><?php echo esc_attr(Admin::process_keys_to_name($key)); ?></span>
              <div class="df-element-info">
                <a href="<?php echo Admin::$url.$key; ?>" target="_blank">
                  <i class="df-element-info-icon"></i>
                  <div class="df-element-info-text"><?php echo esc_html__('LIVE PREVIEW', 'dragfy-addons-for-elementor'); ?></div>
                </a>
              </div>
              <label class="switch">
                <input type="checkbox" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" <?php checked(1, Admin::$get_settings[$key], true); ?>>
                <span class="slider round"></span>
              </label>
            </div>
          <?php endforeach; ?>

          <div class="df-element-title"><?php echo esc_html__('Pro Elements', 'dragfy-addons-for-elementor'); ?></div>
          <?php foreach(Admin::$element_pro_keys as $key): ?>
            <div class="df-element">
              <span><?php echo esc_attr(Admin::process_keys_to_name($key)); ?></span>
              <div class="df-element-info upgrade-pro">
                <a href="<?php echo Admin::$url.$key; ?>" target="_blank">
                  <i class="df-element-info-icon"></i>
                  <div class="df-element-info-text"><?php echo esc_html__('LIVE PREVIEW', 'dragfy-addons-for-elementor'); ?></div>
                </a>
              </div>
              <span class="df-label"><?php echo esc_html__('Pro', 'dragfy-addons-for-elementor'); ?></span>
              <label class="switch">
                <input type="checkbox" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" <?php checked(1, true, true); ?>>
                <span class="slider upgrade-pro round"></span>
              </label>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    <input type="submit" value="<?php echo esc_html__('Save Settings', 'dragfy-addons-for-elementor'); ?>" class="button btn-primary df-btn df-save-button">
</form>
