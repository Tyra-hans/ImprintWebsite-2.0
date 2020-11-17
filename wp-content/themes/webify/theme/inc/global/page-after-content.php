<?php
$sidebar_details = webify_sidebar_position();
if ((is_active_sidebar(webify_get_custom_sidebar('main')) && $sidebar_details['layout'] == 'left_sidebar')): ?>
    </div>
  </div><!-- .row -->
<?php elseif ((is_active_sidebar(webify_get_custom_sidebar('main')) && $sidebar_details['layout'] == 'right_sidebar')): ?>
    </div>
    <?php get_sidebar(); ?>
  </div><!-- .row -->
<?php else: ?>
  </div>
</div>
<?php endif; ?>
