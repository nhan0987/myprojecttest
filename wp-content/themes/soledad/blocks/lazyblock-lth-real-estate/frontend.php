<?php

/**
 * @block-slug  :   lth-real-estate
 * @block-output:   lth_real_estate_output
 * @block-attributes: get from attributes.php
 */

add_filter('lazyblock/lth-real-estate/frontend_callback', 'lth_real_estate_output_fe', 10, 2);

if (!function_exists('lth_real_estate_output_fe')) :
    /**
     * Render Callback cho Soledad Blocks
     */
    function lth_real_estate_output_fe($output, $attributes) {
        ob_start();
        
        $subtitle = isset( $attributes['subtitle'] ) ? $attributes['subtitle'] : 'DANH MỤC BĐS';
        $title = isset( $attributes['title'] ) ? $attributes['title'] : 'Bất Động Sản Nổi Bật';
        $location_cats = isset( $attributes['location_cats'] ) ? $attributes['location_cats'] : '';
        $tab_locations = isset( $attributes['tab_locations'] ) ? $attributes['tab_locations'] : '';
        $type_cats = isset( $attributes['type_cats'] ) ? $attributes['type_cats'] : '';
        $listing_type_filter = isset( $attributes['listing_type_filter'] ) ? $attributes['listing_type_filter'] : '';
        $post_number = isset( $attributes['post_number'] ) ? intval( $attributes['post_number'] ) : 10;
        
        $loc_ids = [];
        if ( ! empty( $location_cats ) ) {
            $loc_ids = is_array( $location_cats ) ? array_map('intval', $location_cats) : array_map('intval', explode(',', $location_cats));
            $loc_ids = array_filter( $loc_ids );
        }

        $tab_loc_ids = [];
        if ( ! empty( $tab_locations ) ) {
            $tab_loc_ids = is_array( $tab_locations ) ? array_map('intval', $tab_locations) : array_map('intval', explode(',', $tab_locations));
            $tab_loc_ids = array_filter( $tab_loc_ids );
        }
        
        $type_ids = [];
        if ( ! empty( $type_cats ) ) {
            $type_ids = is_array( $type_cats ) ? array_map('intval', $type_cats) : array_map('intval', explode(',', $type_cats));
            $type_ids = array_filter( $type_ids );
        }

        // Lọc các Taxonomy để hiển thị trên TABS
        $active_location_terms = [];
        $fetched_terms = [];
        if ( ! empty( $tab_loc_ids ) ) {
            $fetched_terms = get_terms( [
                'taxonomy' => 'property-location',
                'include'  => $tab_loc_ids,
                'hide_empty' => false,
            ] );
        } else {
            $fetched_terms = get_terms( [
                'taxonomy' => 'property-location',
                'hide_empty' => false,
            ] );
        }

        if ( ! is_wp_error( $fetched_terms ) && ! empty( $fetched_terms ) ) {
            foreach ( $fetched_terms as $t ) {
                if ( $t->parent != 0 ) {
                    // Nếu đang dùng tab ngẫu nhiên nhưng Main query có lọc location_cats, thì ta chỉ nên show ngẫu nhiên các tab nằm trong loc_ids đang lọc!
                    if ( empty( $tab_loc_ids ) && ! empty( $loc_ids ) && ! in_array( $t->term_id, $loc_ids ) ) {
                        continue; 
                    }
                    $active_location_terms[] = $t;
                    if ( empty( $tab_loc_ids ) && count( $active_location_terms ) >= 4 ) {
                        break;
                    }
                }
            }
        }

        // Truy vấn WP_Query lấy sản phẩm
        $args = [
            'post_type'      => 'real_estate',
            'posts_per_page' => $post_number,
            'post_status'    => 'publish',
        ];

        $tax_query = ['relation' => 'AND'];
        
        if ( ! empty( $loc_ids ) ) {
            $tax_query[] = [
                'taxonomy' => 'property-location',
                'field'    => 'term_id',
                'terms'    => $loc_ids,
            ];
        }
        
        if ( ! empty( $type_ids ) ) {
            $tax_query[] = [
                'taxonomy' => 'property-type',
                'field'    => 'term_id',
                'terms'    => $type_ids,
            ];
        }

        if ( ! empty( $listing_type_filter ) ) {
            $args['meta_query'] = [
                [
                    'key'     => 'listing_type',
                    'value'   => $listing_type_filter,
                    'compare' => '=',
                ],
            ];
        }
        
        if ( count( $tax_query ) > 1 ) {
            $args['tax_query'] = $tax_query;
        }

        $paged = get_query_var('lth_p') ? intval(get_query_var('lth_p')) : 1;
        $args['paged'] = $paged;

        $query = new WP_Query( $args );
        $total_posts = $query->found_posts;

        $pagination_type = isset($attributes['pagination_type']) ? $attributes['pagination_type'] : 'none';
        $wrapper_id = 'lth-re-' . substr(md5(serialize($attributes)), 0, 8);
?>

<!-- Khung Bọc của Block danh sách -->
<div id="<?php echo $wrapper_id; ?>" class="module module_real_estate dash-01 section-reveal">
    <div class="module_header title-box">
        <h2 class="title"><?php echo esc_html( $title ); ?></h2>
        <div class="infor">
            <p><?php echo esc_html( $subtitle ); ?></p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 tabs-location">
        <button class="btn btn-dark rounded-xl! font-medium! text-sm! py-[1rem] px-[0.5rem] lth-tab-btn active" type="button" data-term="all">Tất cả</button>
        <?php 
        if ( ! is_wp_error( $active_location_terms ) && ! empty($active_location_terms) ) {
            foreach ( $active_location_terms as $term ) : 
        ?>
            <button class="btn btn-outline-secondary rounded-xl! font-medium! text-sm! py-[1rem] px-[0.5rem] lth-tab-btn" type="button" data-term="loc-<?php echo esc_attr( $term->term_id ); ?>">
                <?php echo esc_html( $term->name ); ?>
            </button>
        <?php 
            endforeach; 
        }
        ?>
    </div>

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between py-3">
        <div class="flex w-full items-center justify-between">
            <div class="text-base text-gray-700">Có <strong class="font-bold text-black lth-count"><?php echo esc_html( $total_posts ); ?></strong> bất động sản</div>
            <div class="flex items-center gap-2">
                <div class="rounded-lg bg-gray-800 p-2 text-white text-sm cursor-pointer"><i class="self-icons list-menu-icons w-[24px]! h-[20px]!"> </i></div>
                <div class="rounded-lg border bg-white p-2 text-gray-700 shadow-sm text-sm cursor-pointer"><i class="self-icons grid-menu-icons w-[24px]! h-[20px]!"> </i></div>
            </div>
        </div>
        <div class="w-full lg:w-auto">
            <select class="w-full rounded-lg border bg-white p-2 text-sm text-gray-700 shadow-sm lth-sort">
                <option value="moi-nhat">Sắp xếp: Mới nhất</option>
                <option value="cu-nhat">Sắp xếp: Cũ nhất</option>
                <option value="gia-thap">Giá thấp đến cao</option>
                <option value="gia-cao">Giá cao đến thấp</option>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap gap-5 lth-listings-container">
        <?php if ( $query->have_posts() ) : ?>
            <?php 
            while ( $query->have_posts() ) : $query->the_post(); 
                $post_id = get_the_ID();
                
                // Lấy Cấu hình Metas
                $price = get_post_meta( $post_id, 'price', true );
                $currency = get_post_meta( $post_id, 'currency', true );
                $area = get_post_meta( $post_id, 'area', true );
                $address_street = get_post_meta( $post_id, 'address_street', true );
                $frontage = get_post_meta( $post_id, 'frontage_width_m', true );
                $floors = get_post_meta( $post_id, 'num_floors', true );
                $legal = get_post_meta( $post_id, 'legal_paper_status', true );
                
                // Labels mapping for display
                $labels_map = [
                    'billion' => 'Tỷ',
                    'million' => 'Triệu',
                    'million_sqm' => 'Triệu/m²',
                    'million_month' => 'Triệu/tháng',
                    'million_year' => 'Triệu/năm',
                    'land_ownership_certificate' => 'Sổ đỏ',
                    'building_permit' => 'Giấy phép xây dựng',
                    'sales_contract' => 'Hợp đồng mua bán',
                    'pending_certificate' => 'Đang chờ sổ',
                    'basic_furniture' => 'Cơ bản',
                    'full_furniture' => 'Đầy đủ',
                    'premium_furniture' => 'Cao cấp',
                    'east' => 'Đông',
                    'west' => 'Tây',
                    'south' => 'Nam',
                    'north' => 'Bắc',
                    'south_east' => 'Đông Nam',
                    'north_east' => 'Đông Bắc',
                    'south_west' => 'Tây Nam',
                    'north_west' => 'Tây Bắc'
                ];
                
                $currency_label = isset($labels_map[$currency]) ? $labels_map[$currency] : $currency;
                $price_label = $price ? $price . ' ' . $currency_label : 'Liên hệ';
                
                // Trích xuất Taxonomy Type & Location
                $types = get_the_terms( $post_id, 'property-type' );
                $type_name = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : 'Bất động sản';

                $locations = get_the_terms( $post_id, 'property-location' );
                $location_name = '';
                if ( $locations && ! is_wp_error( $locations ) ) {
                    $child_term = null;
                    foreach ( $locations as $loc ) {
                        if ( $loc->parent != 0 ) {
                            $child_term = $loc;
                            break;
                        }
                    }
                    if ( ! $child_term ) {
                        $child_term = $locations[0]; // fallback
                    }
                    
                    if ( $child_term->parent != 0 ) {
                        $parent_term = get_term( $child_term->parent, 'property-location' );
                        if ( $parent_term && ! is_wp_error( $parent_term ) ) {
                            $location_name = $child_term->name . ', ' . $parent_term->name;
                        } else {
                            $location_name = $child_term->name;
                        }
                    } else {
                        $location_name = $child_term->name;
                    }
                }

                // Kết hợp Vị trí chi tiết
                if ( ! empty($address_street) && ! empty($location_name) ) {
                    $location_name = $address_street . ', ' . $location_name;
                } elseif ( empty($location_name) ) {
                    $location_name = $address_street;
                }
                
                // Phân tích class tab lọc
                $term_classes = [];
                if ( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
                    foreach ( $locations as $loc ) {
                        $term_classes[] = 'loc-' . $loc->term_id;
                    }
                }
                $term_class_string = implode( ' ', $term_classes );

                $thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url( $post_id, 'large' ) : '';
                
                // Tính toán để hiển thị tag (dưới 6 giờ là Mới nhất, trên 6 giờ là Đang bán)
                $post_timestamp = get_post_time( 'U', true, $post_id );
                $current_timestamp = current_time( 'timestamp', 1 ); // GMT time tương đương
                
                if ( ( $current_timestamp - $post_timestamp ) <= 6 * HOUR_IN_SECONDS ) {
                    $tag_class = 'pennant-tag-green';
                    $tag_text = 'Mới nhất';
                } else {
                    $tag_class = 'pennant-tag-yellow';
                    $tag_text = 'Đang bán';
                }

                // Tính toán giá để sort
                $price_val = floatval( str_replace(',', '.', $price) );
                $true_price = 0;
                if ( stripos($currency, 'billion') !== false ) {
                    $true_price = $price_val * 1000000000;
                } elseif ( stripos($currency, 'million') !== false ) {
                    $true_price = $price_val * 1000000;
                } else {
                    $true_price = $price_val;
                }
            ?>
            <div class="flex flex-col gap-4! lg:flex-row bds-content grow relative px-4! lth-list-item <?php echo esc_attr( $term_class_string ); ?>" data-price="<?php echo esc_attr($true_price); ?>" data-time="<?php echo esc_attr($post_timestamp); ?>">
                <div class="<?php echo esc_attr($tag_class); ?> text-sm font-medium"><?php echo esc_html($tag_text); ?></div>
                <div class="w-full h-[13.75rem] xl:w-[16.875rem] xl:h-[11.875rem] cut-the-bottom-right-corner-27-container">
                    
                    <a href="<?php the_permalink(); ?>"> <img decoding="async" class="zoom-image" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>"> </a>
                    <div class="job-overlay bg-view-more">
                        <a class="btn-view-more" href="<?php the_permalink(); ?>"> <span class="text-view-more">Xem chi tiết</span> <i class="arrow-right-icons"></i> </a>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-3! grow py-4!">
                    <div class="col-span-4 ">
                        <span class="category"><?php echo esc_html( $type_name ); ?></span>
                    </div>
                    <div class="col-span-4 bds-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></div>
                    <div class="col-span-4 flex gap-4! text-gray-500">
                        <?php if ( $location_name ) : ?>
                            <div class="flex items-center gap-1!">
                                <span class="material-symbols-outlined">location_on</span><span><?php echo esc_html( $location_name ); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="flex items-center gap-1!">
                            <span class="material-symbols-outlined">calendar_today</span><span><?php echo get_the_date('d/m/Y'); ?></span>
                        </div>
                    </div>
                
                        <div class="col-span-4 flex flex-wrap xl:flex-nowrap items-center gap-x-2 xl:gap-x-6 border-t border-gray-100 pt-4!">
                            <div class="flex items-center gap-1 text-gray-700  xl:pr-6! pr-2! border-r! border-gray-200! last:border-0">
                                <span class="material-symbols-outlined text-gray-400">home</span>
                                <span class="text-sm font-bold"><?php echo esc_html( $frontage ?: '-' ); ?>m</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-700  xl:pr-6! pr-2! border-r! border-gray-200! last:border-0">
                                <span class="material-symbols-outlined text-gray-400">aspect_ratio</span>
                                <span class="text-sm font-bold"><?php echo esc_html( $area ?: '-' ); ?>m2</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-700 xl:pr-6! pr-2! border-r! border-gray-200! last:border-0">
                                <span class="material-symbols-outlined text-gray-400 group-hover:text-black">stairs</span>
                                <span class="text-sm font-bold"><?php echo esc_html( $floors ?: '-' ); ?> tầng</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-700 last:border-0">
                                <span class="material-symbols-outlined text-gray-400">balance</span>
                                <span class="text-sm font-bold"><?php echo esc_html( isset($labels_map[$legal]) ? $labels_map[$legal] : ($legal ?: 'Chờ sổ') ); ?></span>
                            </div>
                        </div>
                        <div class="col-span-4 flex flex-row justify-between">
                            <div class="col-span-3 flex items-center gap-1!"><span class="text-sm">Giá :</span> <span class="text-red-500 font-bold text-base"><?php echo esc_html( $price_label ); ?></span></div>
                            <a href="tel:<?php echo esc_attr(lth_cfg('phone_link')); ?>">
                                <div class="col-span-3 flex items-center gap-2! border border-[#FFD45C]! rounded-full py-1! pl-1! pr-3!">
                                    <span class="material-symbols-outlined gold-call-buton p-2!">phone_enabled</span> 
                                    <span class="text_call_now">Gọi ngay</span>
                                </div>
                            </a>
                        </div>
                    
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="p-10 border border-gray-200 text-center text-gray-500 rounded-xl w-full">Chưa có dữ liệu bất động sản phù hợp.</div>
        <?php endif; ?>
    </div>

    <?php if ( $pagination_type == 'numeric' && $query->max_num_pages > 1 ) : ?>
        <div class="lth-numeric-pagination -pagination">
            <?php
            $base_url = preg_replace( '#realestatepage/[0-9]+/?#', '', get_pagenum_link( 1 ) );
            echo paginate_links( array(
                'base'         => user_trailingslashit( trailingslashit( $base_url ) . 'realestatepage/%#%' ),
                'total'        => $query->max_num_pages,
                'current'      => $paged,
                'format'       => '',
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
    <?php elseif ( $pagination_type == 'load_more' && $query->max_num_pages > 1 ) : ?>
        <div class="lth-load-more-wrapper">
            <button class="lth-load-more-btn btn" 
                    data-block-id="<?php echo $wrapper_id; ?>" 
                    data-paged="1" 
                    data-max="<?php echo $query->max_num_pages; ?>" 
                    data-attrs='<?php echo json_encode($attributes); ?>'>
                Xem thêm
                <i class="arrow-right-icons rotate-0 inline-block"></i>
            </button>
        </div>
        
        <script>
        if (typeof lthRELoadMoreInit === 'undefined') {
            var lthRELoadMoreInit = true;
            document.addEventListener('click', function(e) {
                if (e.target && (e.target.classList.contains('lth-load-more-btn') || e.target.closest('.lth-load-more-btn'))) {
                    const btn = e.target.classList.contains('lth-load-more-btn') ? e.target : e.target.closest('.lth-load-more-btn');
                    const blockId = btn.getAttribute('data-block-id');
                    if (!blockId.startsWith('lth-re-')) return;

                    const container = document.getElementById(blockId);
                    const listContainer = container.querySelector('.lth-listings-container');
                    let paged = parseInt(btn.getAttribute('data-paged'));
                    const maxPages = parseInt(btn.getAttribute('data-max'));
                    const attributes = JSON.parse(btn.getAttribute('data-attrs'));
                    
                    if (paged >= maxPages) return;
                    
                    paged++;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = 'Đang tải...';
                    btn.disabled = true;
                    
                    const params = new URLSearchParams();
                    params.append('action', 'lth_real_estate_load_more');
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
                            listContainer.insertAdjacentHTML('beforeend', html);
                            btn.innerHTML = originalText;
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
</div>

<!-- LOGIC JAVASCRIPT CHO TAB FILTER VÀ SẮP XẾP -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.lth-tab-btn');
    const items = document.querySelectorAll('.lth-list-item');
    const countDisplay = document.querySelector('.lth-count');
    const sortSelect = document.querySelector('.lth-sort');
    const container = document.querySelector('.lth-listings-container');
    
    const applyFilterAndSort = function() {
        // Tìm tab đang active
        const activeTab = document.querySelector('.lth-tab-btn.btn-dark');
        const term = activeTab ? activeTab.getAttribute('data-term') : 'all';
        const sortVal = sortSelect ? sortSelect.value : 'moi-nhat';
        
        let visibleItems = [];
        let count = 0;
        
        // 1. Lọc mục
        items.forEach(item => {
            if(term === 'all' || item.classList.contains(term)) {
                item.style.setProperty('display', 'flex', 'important');
                visibleItems.push(item);
                count++;
            } else {
                item.style.setProperty('display', 'none', 'important');
            }
        });
        
        if(countDisplay) { countDisplay.textContent = count; }
        
        // 2. Sắp xếp mục hiển thị
        if (sortVal && container) {
            visibleItems.sort((a, b) => {
                let priceA = parseFloat(a.getAttribute('data-price')) || 0;
                let priceB = parseFloat(b.getAttribute('data-price')) || 0;
                let timeA = parseInt(a.getAttribute('data-time')) || 0;
                let timeB = parseInt(b.getAttribute('data-time')) || 0;
                
                if (sortVal === 'moi-nhat') {
                    return timeB - timeA;
                } else if (sortVal === 'cu-nhat') {
                    return timeA - timeB;
                } else if (sortVal === 'gia-thap') {
                    return priceA - priceB;
                } else if (sortVal === 'gia-cao') {
                    return priceB - priceA;
                }
                return 0;
            });
            
            // Re-append elements in sorted order
            visibleItems.forEach(item => {
                container.appendChild(item);
            });
        }
    };

    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Đổi UI Tab
                tabs.forEach(t => {
                    t.classList.remove('btn-dark');
                    t.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-dark');
                
                applyFilterAndSort();
            });
        });
    }

    if (sortSelect) {
        sortSelect.addEventListener('change', applyFilterAndSort);
        applyFilterAndSort();
    }
});
</script>
<?php
        return ob_get_clean();
    }
endif;
?>
