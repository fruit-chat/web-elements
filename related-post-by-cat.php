  <!-- Related Posts -->
        <div class="related-posts-widget">
            <h2 class="widget-title">مزید پڑھیں</h2>
            <ul class="related-posts">
                <?php
                // Fetch related posts based on categories
                $categories = wp_get_post_categories($post->ID);
                $related_args = array(
                    'category__in' => $categories,
                    'post__not_in' => array($post->ID),
                    'posts_per_page' => 5,
                );
                $related_posts = new WP_Query($related_args);
                
                if ($related_posts->have_posts()) {
                    while ($related_posts->have_posts()) {
                        $related_posts->the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                        <?php
                    }
                } else {
                    echo '<p>کوئی متعلقہ پوسٹ دستیاب نہیں۔.</p>';
                }
                wp_reset_postdata();
                ?>
            </ul>
        </div>
