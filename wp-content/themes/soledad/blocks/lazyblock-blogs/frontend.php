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
                    $cat = [];
                    if (!empty($attributes['items'])) {
                        foreach ($attributes['items'] as $inner) {
                            $cat[] = $inner['item'];
                        }
                    }

                    $args = [
                        'post_type'      => 'post',
                        'post_status'    => 'publish',
                        'category__in'   => $cat,
                        'posts_per_page' => $attributes['post_number'],
                        'orderby'        => $attributes['orderby'],
                        'order'          => $attributes['order'],
                    ];
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) {
                        if ($attributes['post_style'] == 'list') { ?>
                            <div class="grid grid-cols-1 gap-4">
                                <?php if ($attributes['post_style_2'] == 'style_01') {
                                    while ($wp_query->have_posts()) {
                                        $wp_query->the_post();
                                ?>
                                        <div class="item">
                                            <?php get_template_part('template-parts/post/content', ''); ?>
                                        </div>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                } else {
                                    while ($wp_query->have_posts()) {
                                        $wp_query->the_post();
                                    ?>
                                        <div class="item">
                                            <?php get_template_part('template-parts/post/content', '2'); ?>
                                        </div>
                                <?php
                                    }
                                    wp_reset_postdata();
                                } ?>
                            </div>
                        <?php } elseif ($attributes['post_style'] == 'mixed') { 
                            
                        ?>
                            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

                            <?php
                            $k = 0;
                            // Bắt đầu vòng lặp để tìm và hiển thị Bài Lớn (Post 1) và Sidebar (Post 2, 3)
                            if ($wp_query->have_posts()) {

                                // --- PHẦN 1: Xử lý Bài viết Lớn (k=1) ---
                                $wp_query->the_post(); // Lấy bài viết đầu tiên (Post 1)
                                $k++;
                            ?>
                                <div class="col-span-3 lg:col-span-2">
                                    <div class="">
                                        <div class="relative pt-[60%] lg:pt-[50%]"> 
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>" class="rounded-2xl w-full! h-full!">
                                            <span class="text-sm medium text-gray-500">
                                                <?php the_time('d/m/Y'); ?>
                                            </span>
                                        </div>
                                        <div class="">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <h2 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight">
                                                    <?php the_title(); ?>
                                                </h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-span-1 lg:col-span-1 grid grid-cols-2 lg:flex lg:flex-col gap-3">
                                    <?php
                                    // Tiếp tục vòng lặp để hiển thị các bài viết còn lại
                                    while ($wp_query->have_posts() && $k < 3) { // Chỉ lặp tối đa đến k=3 (Bài 3)
                                        $wp_query->the_post();
                                        $k++;
                                        // Không cần if ($k <= 3) nữa vì điều kiện đã ở trong while
                                    ?>
                                        <div class="col-span-1">
                                            <div class="flex flex-wrap gap-2"> <div class="">
                                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" 
                                                        class="rounded-2xl">
                                                    <span class="text-xs font-medium text-gray-500">
                                                        <?php the_time('d/m/Y'); ?>
                                                    </span>
                                                </div>
                                                
                                                <div class="">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                        <p class="text-sm font-bold text-gray-700">
                                                            <?php the_title(); ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } // Kết thúc while cho các bài phụ (k=2 và k=3)
                                    ?>
                                </div>
                                <div class="col-span-3 grid grid-cols-1 gap-4">
                                    <?php
                                    // Tiếp tục vòng lặp để hiển thị các bài viết còn lại
                                    while ($wp_query->have_posts()) { // Chỉ lặp tối đa đến k=3 (Bài 3)
                                        $wp_query->the_post();
                                        $k++;
                                        // Không cần if ($k <= 3) nữa vì điều kiện đã ở trong while
                                    ?>

                                        <div class="item">
                                            <?php get_template_part('template-parts/post/content', ''); ?>
                                        </div>

                                        <?php
                                    } // Kết thúc while cho các bài phụ (k=2 và k=3)
                                    ?>
                                </div>

                                <?php
                            } // Kết thúc if ($wp_query->have_posts())

                            wp_reset_postdata();
                            ?>

                        </div>
                        <?php } ?>

                        <?php if ($attributes['button_text']) : ?>
                            <div class="module_button">
                                <a href="<?php echo esc_url($attributes['button_url']); ?>" class="btn">
                                    <?php echo esc_html($attributes['button_text']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
<?php
        return ob_get_clean();
    }
endif;
?>