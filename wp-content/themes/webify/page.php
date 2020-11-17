<?php
/**
 * Page Template
 *
 * @package webify
 * @since 1.0
 */
get_header(); ?>

<div class="tb-content <?php echo (in_array('elementor-page elementor-page-'.get_the_ID(), get_body_class())) ? 'elementor-page':'default-page'; ?>">
  <?php echo webify_top_margin(100); ?>
  <div class="container">
    <?php
      get_template_part('theme/inc/global/page-before-content');
      while ( have_posts() ) : the_post();
        the_content();
        wp_link_pages( array(
          'before' => '<div class="page-links"><div class="page-link-title">' . esc_html__( 'Pages:', 'webify' ).'</div>',
          'after'  => '</div>',
        ));
        if ((comments_open() || get_comments_number()) ) :
          comments_template();
        endif;
      endwhile;
      get_template_part('theme/inc/global/page-after-content');
    ?>
  </div>
  <?php echo webify_bottom_margin(100); ?>
</div>

<?php get_footer(); ?>
