<?php
/**
 * Portfolio Single Parts
 *
 * @package webify
 * @since 1.0
 *
 */
$project_details = webify_get_post_opt('project-details');
$project_logo    = webify_get_post_opt('project-logo');
if(!empty($project_details) && is_array($project_details)): ?>
<div class="tt-sticky-content">
  <div class="tt-sticky-content-middle">
    <div class="tt-sticky-content-in">
      <div class="tb-study-info-wrap tb-style1 tb-border tb-radious-4">
        <?php if(is_array($project_logo) && !empty($project_logo['url'])): ?>
          <img class="tb-case-user-logo" src="<?php echo esc_url($project_logo['url']); ?>" alt="<?php echo esc_attr('logo', 'webify'); ?>">
        <?php endif; ?>
        <ul class="tb-study-info-list tb-mp0">
          <?php foreach($project_details as $detail): ?>
            <li>
              <h4 class="tb-study-info-title"><?php echo esc_html($detail['label']); ?></h4>
              <div class="tb-study-info"><?php echo esc_html($detail['value']); ?></div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
