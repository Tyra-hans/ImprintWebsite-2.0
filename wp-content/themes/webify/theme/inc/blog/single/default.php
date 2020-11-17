<?php
/**
 * Blog Default
 *
 * @package webify
 * @since 1.0
 */
global $post;
wp_enqueue_style('webify-button');
wp_enqueue_style('webify-newsletter'); ?>

<div class="tb-content">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="tb-blog-single-post-style1">

      <?php get_template_part('theme/inc/blog/single/parts/banner'); ?>


      <div class="container">
      <div class="empty-space marg-lg-b95 marg-sm-b60"></div>
      <?php get_template_part('theme/inc/global/page-before-content'); ?>
        
        <?php webify_social_share(); ?>

        <div class="tb-simple-text tb-f18-lg tb-line1-8">
          <?php the_content(); ?>
        </div>
        <div class="empty-space marg-lg-b50 marg-sm-b50"></div>

        <?php the_tags( '<div class="tb-tag-wrap"><span class="tb-tag-title  tb-black222-c">'.esc_html__('Tags:', 'webify').'</span><ul class="tb-tags tb-mp0"><li>', '</li><li>', '</li></ul></div><div class="empty-space marg-lg-b60 marg-sm-b60"></div>'); ?>
        
        <?php webify_post_up_down_vote($post->ID); ?>

        <?php webify_post_author_details(); ?>

        <?php webify_post_navigation(); ?>

        <?php if ( comments_open() || get_comments_number()): comments_template(); endif; ?>

        <?php get_template_part('theme/inc/global/page-after-content'); ?>
      <div class="empty-space marg-lg-b80 marg-sm-b60"></div>
      </div>
      <hr>
    </div>
  <?php endwhile; ?>
</div><!-- .tb-content -->

