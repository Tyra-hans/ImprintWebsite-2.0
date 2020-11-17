<?php
/**
 * View Activate Theme
 *
 * @package webify
 * @since 1.0
 */
require_once 'header.php';
$theme_details = wp_get_theme();
$response      = ThemeBubble_API::get_instance()->registration(); ?>

<div class="tb-admin-wrapper tb-plugins-wrapper about-wrap">
  <div class="tb-wc-header">
    <h1>Activate <?php echo esc_html($theme_details->get('Name')); ?></h1>
    <div class="about-text">
      <p> Please activate <?php echo esc_html($theme_details->get('Name')); ?>. This activation enables all features of the theme (i.e. Demo import etc.). This step is taken for mass piracy of our theme, and to serve our paying customers better. </p>
    </div>
    
    <?php if(!empty($response['message'])): ?>
      <div class="msg-box">
        <?php echo esc_html($response['message']); ?>
      </div>
    <?php endif; ?>

    <?php if($response['success']): ?>
      <div class="msg-box success">
        <?php echo esc_html__('Congratulations! '.$theme_details->get('Name').' is Activated.'); ?>
      </div>
    <?php endif; ?>

    <form method="post" action="admin.php?page=webify_theme_activate">
      <div class="form-table tb-theme-activate">
        <div class="tb-form-title"><?php echo esc_html__('Your E-mail:', 'webify'); ?></div>
        <div class="tb-input-box">
          <input type="text" <?php echo ($response['success']) ? 'disabled':''; ?> placeholder="<?php echo esc_html__('johndoe@domain.com', 'webify'); ?>" name="tb_register_email" value="<?php echo esc_attr(ThemeBubble_API::get_instance()->get_email()); ?>">
        </div>
        <div class="tb-form-title"><?php echo esc_html__('Envato Purchase Code:', 'webify'); ?></div>
        <div class="tb-input-box">
          <input type="text" <?php echo ($response['success']) ? 'disabled':''; ?> placeholder="for e.g 4507f06b-ab21-4a97-8a1b-67w03d778345" name="tb_register_code" value="<?php echo esc_attr(ThemeBubble_API::get_instance()->get_purchase_code()); ?>">
          <?php if(!empty(ThemeBubble_API::get_instance()->get_purchase_code())): ?>
            <input type="hidden" name="tb_unregister" value="true">
          <?php endif; ?>
        </div>
        <?php wp_nonce_field('tb_register_nonce', 'tb_register_nonce'); ?>
        <p class="submit"><input type="submit" name="submit" id="submit" class="btn-style-1 btn-blue" value="<?php echo (empty(ThemeBubble_API::get_instance()->get_purchase_code()) ? 'Activate License': 'Deactivate License'); ?>"></p>
        <div class="tb-info"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php echo esc_html__('Where to find your purchase code ?', 'webify'); ?></a></div>
      </div>
    </form>

  </div>


</div>
