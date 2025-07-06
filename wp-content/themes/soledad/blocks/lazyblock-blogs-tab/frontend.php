<?php

/**
 * @block-slug  :   lth-blogs-tab
 * @block-output:   lth_blogs_tab_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-blogs-tab/frontend_callback', 'lth_blogs_tab_output_fe', 10, 2);

if (!function_exists('lth_blogs_tab_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_blogs_tab_output_fe($output, $attributes) {
        ob_start();
?>
<section class="lth-blogs">
    <div class="container">        
        <div class="module module_blogs">
            <?php if ($attributes['title'] || $attributes['description']) : ?>
                <div class="module_header title-box">
                    <?php if (isset($attributes['title'])) : ?>
                        <h2 class="title">
                            <?php if ($attributes['url']) : ?> 
                                <a href="<?php echo esc_url($attributes['url']); ?>" title="">
                            <?php else : ?>
                                <span>
                            <?php endif; ?>
                                <?php echo wpautop(esc_html($attributes['title'])); ?>
                            <?php if ($attributes['url']) : ?> 
                                </a>
                            <?php else : ?>
                                </span>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($attributes['description']) : ?>
                        <div class="infor">
                            <?php echo wpautop(esc_html($attributes['description'])); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="title-tab">
                <ul>
                    <?php $i; foreach( $attributes['items'] as $inner ): $i++; ?>
                        <li>
                            <div>
                                <a href="#" data_tab="tab-<?php echo $i; ?>" class="title <?php if ($i == 1) { ?>active<?php } ?>">
                                    <?php if ($inner['item_image']) { ?>
                                        <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Icon">
                                    <?php } ?>
                                    <?php echo $inner['item']; ?>
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?> 
                </ul>
            </div>

            <div class="module_content">
                <div class="tab-content">
                    <?php $j; foreach( $attributes['items'] as $inner ): $j++; ?>
                        <div class="tab-panel tab-<?php echo $j; ?> <?php if ($j == 1) { ?>active<?php } ?>">
                            <?php
                                $args = [
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'category_name' => $inner['item'],
                                    'posts_per_page' => $attributes['post_number'],
                                    'orderby' => $attributes['orderby'],
                                    'order' => $attributes['order'],
                                ];
                                $wp_query = new WP_Query($args);
                                if ($wp_query->have_posts()) { ?>

                                    <div class="row">
                                        <?php while ($wp_query->have_posts()) {
                                            $wp_query-> the_post(); ?>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                <?php //load file tương ứng với post format
                                                    get_template_part('template-parts/post/content', '');
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } else {
                                    get_template_part('template-parts/content', 'none');
                                }
                                // reset post data
                                wp_reset_postdata();
                            ?>     
                        </div>
                    <?php endforeach; ?> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        return ob_get_clean();
    }
endif;
?>