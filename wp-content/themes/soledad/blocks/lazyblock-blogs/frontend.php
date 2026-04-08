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
                        <?php if (!empty($attributes['title'])) : ?>
                            <h2 class="title">
                                <?php if (!empty($attributes['title_url'])) : ?>
                                    <a href="<?php echo esc_url($attributes['title_url']); ?>" title="">
                                <?php endif; ?>
                                <?php echo wpautop(esc_html($attributes['title'])); ?>
                                <?php if (!empty($attributes['title_url'])) : ?>
                                    </a>
                                <?php endif; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($attributes['description'])) : ?>
                            <div class="infor">
                                <?php echo wpautop(esc_html($attributes['description'])); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php
                $pagination_type = isset($attributes['pagination_type']) ? $attributes['pagination_type'] : 'none';
                $wrapper_id = 'lth-blogs-' . substr(md5(serialize($attributes)), 0, 8);
                ?>
                <div id="<?php echo $wrapper_id; ?>" class="module_content content_<?php echo $attributes['post_style']; ?> <?php echo $attributes['post_style_2']; ?>">
                    <?php
                    $cat = [];
                    if (!empty($attributes['items'])) {
                        foreach ($attributes['items'] as $inner) {
                            $cat[] = $inner['item'];
                        }
                    }

                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    if ( is_front_page() ) {
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                    }

                    $args = [
                        'post_type'      => 'post',
                        'post_status'    => 'publish',
                        'category__in'   => $cat,
                        'posts_per_page' => $attributes['post_number'],
                        'orderby'        => isset($attributes['post_orderby']) ? $attributes['post_orderby'] : 'date',
                        'order'          => isset($attributes['post_order']) ? $attributes['post_order'] : 'DESC',
                        'paged'          => $paged,
                    ];
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) {
                        if ($attributes['post_style'] == 'list') { ?>
                            <div class="">
                                <?php if ($attributes['post_style_2'] == 'style_01') {
                                ?>
                                <div class="flex flex-wrap xl:gap-10!">
                                <?php 
                                    while ($wp_query->have_posts()) {
                                        $wp_query->the_post();
                                ?>
                                        <div class="item">
                                            <?php get_template_part('template-parts/post/content', ''); ?>
                                        </div>
                                    <?php
                                    }
                                ?>
                                </div>
                                <?php
                                    wp_reset_postdata();
                                } else {

                                ?>
                                    <div class="flex flex-wrap gap-4!">
                                    <?php
                                    while ($wp_query->have_posts()) {
                                        $wp_query->the_post();
                                    ?>
                                        <div class="item">
                                            <?php get_template_part('template-parts/post/content', '2'); ?>
                                        </div>
                                <?php
                                    }
                                ?>
                                    </div>
                                <?php
                                    wp_reset_postdata();
                                } ?>
                            </div>
                        <?php } elseif ($attributes['post_style'] == 'mixed') { 
                            
                        ?>
                            <div class="grid grid-cols-1 xl:grid-cols-3 gap-y-5 xl:gap-y-30! gap-x-18!">

                            <?php
                            $k = 0;
                            // Bắt đầu vòng lặp để tìm và hiển thị Bài Lớn (Post 1) và Sidebar (Post 2, 3)
                            if ($wp_query->have_posts()) {

                                // --- PHẦN 1: Xử lý Bài viết Lớn (k=1) ---
                                $wp_query->the_post(); // Lấy bài viết đầu tiên (Post 1)
                                $k++;
                            ?>
                                <div class="col-span-1 xl:col-span-2! relative">
                                    
                                    <div class="cut-the-top-left-corner-25-container"> 
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>" class="zoom-image object-cover w-full! h-full!">
                                        </a>
                                        <span class="text-[0.8125rem] font-medium text-gray-500 absolute right-0 bottom-[0px] xl:bottom-[0px] w-[4.625rem] xl:w-[4.5625rem] h-[1.75rem] xl:h-[1.8125rem] leading-[1.6875rem] bg-white">
                                            <?php the_time('d/m/Y'); ?>
                                        </span>
                                        
                                    </div>
                                    <div class="pt-2! line-clamp-2">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <h2 class="text-base! xl:text-xl! font-bold text-gray-900 leading-tight lowercase first-letter:uppercase">
                                                <?php the_title(); ?>
                                            </h2>
                                        </a>
                                    </div>
                                    
                                    
                                </div>
                                
                                <div class="col-span-1 xl:col-span-1 grid grid-cols-2 xl:flex xl:flex-col gap-3">
                                    <?php
                                    // Tiếp tục vòng lặp để hiển thị các bài viết còn lại
                                    while ($wp_query->have_posts() && $k < 3) { // Chỉ lặp tối đa đến k=3 (Bài 3)
                                        $wp_query->the_post();
                                        $k++;
                                        // Không cần if ($k <= 3) nữa vì điều kiện đã ở trong while
                                    ?>
                                        
                                            <div class="flex flex-wrap justify-end gap-y-2"> 
                                                <div class="cut-the-top-left-corner-26-container">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" 
                                                            class="zoom-image object-cover w-full! h-full!">
                                                    </a>
                                                    <span class="text-xs font-medium text-gray-500 absolute left-0 bottom-[0px] w-[4.125rem] xl:w-[4.5rem] h-[1.25rem] xl:h-[1.6875rem] bg-white">
                                                        <?php the_time('d/m/Y'); ?>
                                                    </span>
                                                </div>
                                                
                                                <div class="">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                        <p class="text-sm font-bold text-gray-700 lowercase first-letter:uppercase">
                                                            <?php the_title(); ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                    <?php
                                    } // Kết thúc while cho các bài phụ (k=2 và k=3)
                                    ?>
                                </div>
                                <div class="col-span-1 xl:col-span-3 grid grid-cols-1 xl:gap-10!">
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

                        <?php if ( $pagination_type == 'numeric' && $wp_query->max_num_pages > 1 ) : ?>
                            <div class="lth-numeric-pagination <?php echo $attributes['post_style']; ?>-pagination">
                                <?php
                                echo paginate_links( array(
                                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                    'total'        => $wp_query->max_num_pages,
                                    'current'      => $paged,
                                    'format'       => '?paged=%#%',
                                    'show_all'     => false,
                                    'type'         => 'plain',
                                    'end_size'     => 1,
                                    'mid_size'     => 1,
                                    'prev_next'    => true,
                                    'prev_text'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:block;"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                                    'next_text'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:block;"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                                ) );
                                ?>
                            </div>
                        <?php elseif ( $pagination_type == 'load_more' && $wp_query->max_num_pages > 1 ) : ?>
                            <div class="lth-load-more-wrapper">
                                <button class="lth-load-more-btn btn" 
                                        data-block-id="<?php echo $wrapper_id; ?>" 
                                        data-paged="1" 
                                        data-max="<?php echo $wp_query->max_num_pages; ?>" 
                                        data-attrs='<?php echo json_encode($attributes); ?>'>
                                    Xem thêm
                                    <i class="arrow-right-icons rotate-0 inline-block"></i>
                                </button>
                            </div>
                            
                            <script>
                            if (typeof lthLoadMoreInit === 'undefined') {
                                var lthLoadMoreInit = true;
                                document.addEventListener('click', function(e) {
                                    if (e.target && e.target.classList.contains('lth-load-more-btn')) {
                                        const btn = e.target;
                                        const blockId = btn.getAttribute('data-block-id');
                                        const container = document.getElementById(blockId);
                                        let paged = parseInt(btn.getAttribute('data-paged'));
                                        const maxPages = parseInt(btn.getAttribute('data-max'));
                                        const attributes = JSON.parse(btn.getAttribute('data-attrs'));
                                        
                                        if (paged >= maxPages) return;
                                        
                                        paged++;
                                        btn.innerHTML = 'Đang tải...';
                                        btn.disabled = true;
                                        
                                        const formData = new FormData();
                                        formData.append('action', 'lth_blogs_load_more');
                                        formData.append('paged', paged);
                                        formData.append('attributes', JSON.stringify(attributes)); 
                                        // Gửi attributes dạng JSON string vì WP AJAX xử lý array trong POST đôi khi khó
                                        
                                        // Re-build formData with individual properties to match PHP expects
                                        const params = new URLSearchParams();
                                        params.append('action', 'lth_blogs_load_more');
                                        params.append('paged', paged);
                                        params.append('attributes', btn.getAttribute('data-attrs'));

                                        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                                            method: 'POST',
                                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                            body: params.toString()
                                        })
                                        .then(res => res.text())
                                        .then(html => {
                                            if (html) {
                                                // Tìm đúng container để append
                                                let target = container.querySelector('.xl\\:gap-10\\!'); 
                                                if (!target) target = container.querySelector('.gap-4\\!');
                                                if (!target) target = container.querySelector('.col-span-1.xl\\:col-span-3'); // mixed
                                                
                                                if (target) {
                                                    target.insertAdjacentHTML('beforeend', html);
                                                } else {
                                                    // fallback
                                                    btn.parentElement.insertAdjacentHTML('beforebegin', html);
                                                }
                                                
                                                btn.innerHTML = 'Xem thêm bài viết';
                                                btn.disabled = false;
                                                btn.setAttribute('data-paged', paged);
                                                
                                                if (paged >= maxPages) {
                                                    btn.parentElement.style.display = 'none';
                                                }
                                            } else {
                                                btn.parentElement.style.display = 'none';
                                            }
                                        })
                                        .catch(err => {
                                            console.error(err);
                                            btn.innerHTML = 'Lỗi, thử lại';
                                            btn.disabled = false;
                                        });
                                    }
                                });
                            }
                            </script>
                        <?php endif; ?>

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