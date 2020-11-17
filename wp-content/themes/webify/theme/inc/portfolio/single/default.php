<?php
/**
 * Portfolio Single Default
 *
 * @package webify
 * @since 1.0
 *
 */
wp_enqueue_style('webify-post'); ?>
<div class="tb-content">
  <?php if(webify_get_opt('header-style') == 'header-style13'): ?>
    <div class="empty-space marg-lg-b70"></div>
  <?php endif; ?>
  <?php get_template_part('theme/inc/portfolio/single/parts/banner'); ?>
  <div class="empty-space marg-lg-b70 marg-sm-b60"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <?php get_template_part('theme/inc/portfolio/single/parts/details'); ?>
      </div>
      <div class="col-lg-9">
        <div class="tt-sticky-content">
          <div class="tt-sticky-content-middle">
            <div class="tt-sticky-content-in">
              <div class="tb-left-padd-20">
                <div class="tb-study-body">
                  <?php 
                    while ( have_posts() ) : the_post();
                      the_content();
                    endwhile;
                  ?>
                </div>
                <div class="empty-space marg-lg-b75 marg-sm-b35"></div>
                <?php get_template_part('theme/inc/portfolio/single/parts/pagination'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="empty-space marg-lg-b100 marg-sm-b60"></div>
  <!-- End Hero Section -->
</div><!-- .tb-content -->
