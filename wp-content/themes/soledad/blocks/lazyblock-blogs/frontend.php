<?php

/**
 * @block-slug  :   lth-blogs
 * @block-output:   lth_blogs_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-blogs/frontend_callback', 'lth_blogs_output_fe', 10, 2);

if (!function_exists('lth_blogs_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_blogs_output_fe($output, $attributes)
    {
        ob_start();
?>
        <section class="lth-blogs" style="background-color: #fff; padding: 0;">
            <!-- <div class="container">         -->
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

                <div class="module_content content_<?php echo $attributes['post_style']; ?> <?php echo $attributes['post_style_2']; ?>">
                    <?php
                    $i = 0;
                    foreach ($attributes['items'] as $inner) {
                        $i++;
                        if ($i == '1') {
                            $cat = $inner['item'];
                        }
                    }
                    $args = [
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'category__in' => $cat,
                        'posts_per_page' => $attributes['post_number'],
                        'orderby' => $attributes['orderby'],
                        'order' => $attributes['order'],
                    ];
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) { ?>

                        <div class="grid grid-cols-1 gap-4">
                            
                                <?php 
                                if ($attributes['post_style'] == 'list') { 
                                    ?>
                                    <?php if ($attributes['post_style_2'] == 'style_01') { ?>
                                        
                                            <?php while ($wp_query->have_posts()) {
                                                $wp_query->the_post();
                                                $j++; 
                                            ?>
                                            <div class="item">
                                                <?php  get_template_part('template-parts/post/content', '');?>
                                            </div>  
                                            <?php }
                                            wp_reset_postdata(); ?>
  
                                    <?php } else { ?>
                                            <?php while ($wp_query->have_posts()) {
                                                $wp_query->the_post();
                                                $j++; 
                                            ?>
                                                <div class="item">
                                                    <?php  get_template_part('template-parts/post/content', '2');?>
                                                </div>
                                                
                                            <?php }
                                            wp_reset_postdata(); ?>
                                    <?php } ?>
                                <?php }  ?>
                            
                        </div>

                        <?php if ($attributes['button_text']) : ?>
                            <div class="module_button">
                                <a href="<?php echo esc_url($attributes['button_url']); ?>" class="btn">
                                    <?php echo esc_html($attributes['button_text']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
            <!-- </div> -->
        </section>
<?php
        return ob_get_clean();
    }
endif;
?>