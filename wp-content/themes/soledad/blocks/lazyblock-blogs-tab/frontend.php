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

            
                <ul class="nav nav-pills title-tab" id="myTab" role="tablist">
                    <?php $i; foreach( $attributes['items'] as $inner ): $i++; ?>
                    <?php
                    
                        // var_dump($inner);
                        // var_dump($inner['item']);
                        // var_dump($attributes['post_number']);

                        $category_id = $inner['item'];
                        $term_object = get_term( $category_id, 'category' );
                        $category_name = $term_object->name;

                    ?>
                        <li class="nav-item" role="presentation">
                             <button class="nav-link <?php if ($i == 1) { ?>active<?php } ?>" id="home-tab" data-bs-toggle="pill" data-bs-target="#tab-<?php echo $i; ?>" type="button" role="tab" aria-controls="tab-<?php echo $i; ?>" aria-selected="<?php if ($i == 1) { ?>true<?php } else {?>false<?php }?>"><?php echo $category_name ?></button>
                        </li>
                    <?php endforeach; ?> 
                </ul>
            

            
                <div class="tab-content">
                    <?php $j; foreach( $attributes['items'] as $inner ): $j++; ?>
                        <div class="tab-pane fade  <?php if ($j == 1) { ?>active show<?php } ?>" role="tabpanel" id="tab-<?php echo $j; ?>" >
                            <?php
                                $args = [
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'category__in' => $inner['item'],
                                    'posts_per_page' => $attributes['post_number'],
                                    'orderby' => $attributes['orderby'],
                                    'order' => $attributes['order'],
                                ];
                                
                                $wp_query = new WP_Query($args);
                                if ($wp_query->have_posts()) { ?>

                                    <div class="flex flex-wrap">
                                        <?php while ($wp_query->have_posts()) {
                                            $wp_query-> the_post(); ?>
                                            <div class="basis-full lg:flex-1">
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
</section>
<?php
        return ob_get_clean();
    }
endif;
?>