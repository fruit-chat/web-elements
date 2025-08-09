
    <!-- Sidebar Section with Related Posts Widget -->
    <div class="custom-sidebar">
        <?php if (is_active_sidebar('custom-sidebar')) : ?>
            <?php dynamic_sidebar('custom-sidebar'); ?>
        <?php endif; ?>
        
      <div class="related-posts-widget">
    <h2 class="widget-title">Related Posts</h2>
    <ul class="related-posts">
        <?php
        $related_args = array(
            'category__in' => wp_get_post_categories($post->ID),
            'post__not_in' => array($post->ID),
            'posts_per_page' => 5,
        );
        $related_posts = new WP_Query($related_args);
        
        if ($related_posts->have_posts()) {
            while ($related_posts->have_posts()) {
                $related_posts->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail', ['class' => 'related-post-thumbnail']);
                        } ?>
                        <?php the_title(); ?>
                    </a>
                </li>
                <?php
            }
        } else {
            echo '<p>No related posts found.</p>';
        }
        wp_reset_postdata();
        ?>
    </ul>
</div>
