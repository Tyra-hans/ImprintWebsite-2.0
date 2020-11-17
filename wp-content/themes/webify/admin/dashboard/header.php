<?php
/**
 * View Header
 *
 * @package webify
 * @since 1.0
 */
global $submenu;

if (isset($submenu['webify_theme_welcome'])):
  $welcome_menu_items = $submenu['webify_theme_welcome'];
endif;

if (!empty($welcome_menu_items) && is_array($welcome_menu_items)) : ?>
  <div class="wrap about-wrap tb-wp-admin-header ">
    <h2 class="nav-tab-wrapper">
      <?php foreach ($welcome_menu_items as $welcome_menu_item): ?>
        <a href="admin.php?page=<?php echo esc_attr($welcome_menu_item[2]);?>" class="nav-tab <?php if(isset($_GET['page']) and $_GET['page'] == $welcome_menu_item[2]) { echo 'nav-tab-active'; }?> "><?php echo esc_html($welcome_menu_item[0]); ?></a>
      <?php endforeach; ?>
    </h2>
  </div>
<?php endif; ?>


