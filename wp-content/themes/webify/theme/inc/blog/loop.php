<?php
/**
 * Blog Loop
 *
 * @package webify
 * @since 1.0
 */
get_header(); 

wp_enqueue_script('isotop');
wp_enqueue_style('isotop');
wp_enqueue_style('webify-post');

?>

<div class="tb-content">
  <div class="empty-space marg-lg-b100 marg-sm-b50"></div>
  <div class="container">
    <?php get_template_part('theme/inc/global/page-before-content'); ?>

      <?php webify_post_author_details(); ?>

      <?php if(have_posts()): ?>
        <div class="tb-blog-content">
          <div class="tb-isotop tb-port-col-2 tb-has-gutter">
          <div class="tb-grid-sizer"></div>
            <?php
              $i = 0; 
              while (have_posts()) : the_post(); 
                if($i == 0):
                  get_template_part('theme/inc/blog/layout/full');
                else:
                  get_template_part('theme/inc/blog/layout/grid');
                endif;
                $i++;
              endwhile; 
            ?>
          </div>
          <?php webify_paging_nav(); ?>
        </div>
      <?php else: ?>
        <div class="tb-search-no-results">
          <div class="tb-s-search style1">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search">
              <input type="text" required="" id="s" name="s" placeholder="<?php echo esc_attr('Search articles', 'webify'); ?>">
              <div class="tb-s-search-submit">
                <input class="search-field" type="search" value="">
                <input type="submit" value="">
              </div>
              <div class="tb-s-popup-devider"></div>
            </form>
            <div class="tb-couldnot-found"><?php echo esc_html__('We couldn’t find anything. Please try a different search!', 'webify'); ?></div>
          </div>
        </div>
      <?php endif;?>

    <?php get_template_part('theme/inc/global/page-after-content'); ?>
  </div>
  <div class="empty-space marg-lg-b100 marg-sm-b50"></div>
</div>

<?php
get_footer();
