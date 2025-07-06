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
    function lth_blogs_output_fe($output, $attributes) {
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
                    foreach( $attributes['items'] as $inner ) {
                        $i++;
                        if ($i == '1') {
                            $cat = $inner['item'];
                        }
                    }

                    $args = [
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'cat' => $cat,
                        'posts_per_page' => $attributes['post_number'],
                        'orderby' => $attributes['orderby'],
                        'order' => $attributes['order'],
                    ];
                    $wp_query = new WP_Query($args);
                    if ($wp_query->have_posts()) { ?>

                        <div class="row">                        
                            <?php if ($attributes['post_style'] == 'list') { ?>
                                <?php if ($attributes['post_style_2'] == 'style_02') { ?>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 active">
                                        <?php $j; while ($wp_query->have_posts()) {
                                            $wp_query-> the_post(); $j++; ?>
                                            <?php if ($j == 1) { ?>
                                                <?php //load file tương ứng với post format
                                                    get_template_part('temps/post/content', '');
                                                ?>
                                            <?php } ?>
                                        <?php } wp_reset_postdata(); ?>   
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <?php $k; while ($wp_query->have_posts()) {
                                            $wp_query-> the_post(); $k++; ?>
                                            <?php if ($k > 1) { ?>
                                                <div class="item">
                                                    <div class="content">
                                                        <div class="content-header">
                                                            <?php if (has_post_thumbnail()) { ?>
                                                                <div class="content-image">
                                                                    <a href="<?php the_permalink(); ?>" title="" class="image">
                                                                        <img src="<?php echo lth_custom_img('full', 227, 146);?>" width="227" height="146" alt="<?php the_title(); ?>">
                                                                    </a>
                                                                </div>
                                                            <?php } ?>

                                                            <div class="content-box">
                                                                <h3 class="content-name">
                                                                    <a href="<?php the_permalink(); ?>" title="" class="name-news__mains titles-bold__alls fs-17s mb-10s">
                                                                        <?php the_title(); ?>
                                                                    </a> 
                                                                </h3>

                                                                <p class="content-days">
                                                                    <?php the_time('d '); ?><?php echo __('Tháng '); ?><?php the_time('m, Y'); ?>
                                                                </p>

                                                                <div class="content-excerpt">
                                                                    <?php wpautop(the_excerpt()); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } wp_reset_postdata(); ?> 
                                    </div>
                                <?php } else { ?>
                                    <?php while ($wp_query->have_posts()) {
                                        $wp_query-> the_post(); ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <?php //load file tương ứng với post format
                                                get_template_part('temps/post/content', '2');
                                            ?>
                                        </div>
                                    <?php }
                                        // reset post data
                                        wp_reset_postdata();
                                    ?>   
                                <?php } ?>
                            <?php } elseif ($attributes['post_style'] == 'grid') { ?>
                                <?php if ($attributes['post_style_2'] == 'style_02') { ?>
                                    <?php while ($wp_query->have_posts()) {
                                        $wp_query-> the_post(); ?>
                                        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12"> -->
                                            <?php //load file tương ứng với post format
                                                get_template_part('temps/post/content', '');
                                            ?>
                                        <!-- </div> -->
                                    <?php }
                                        // reset post data
                                        wp_reset_postdata();
                                    ?>
                                <?php } else { ?>
                                    <?php while ($wp_query->have_posts()) {
                                        $wp_query-> the_post(); ?>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                            <?php //load file tương ứng với post format
                                                get_template_part('temps/post/content', '');
                                            ?>
                                        </div>
                                    <?php }
                                        // reset post data
                                        wp_reset_postdata();
                                    ?>
                                <?php } ?>
                            <?php } ?>
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