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
        $locations_str = isset( $attributes['locations'] ) ? $attributes['locations'] : '';
        $post_number = isset( $attributes['post_number'] ) ? intval( $attributes['post_number'] ) : 10;

        // Lọc các Taxonomy được select
        $active_location_terms = [];
        if ( ! empty( $locations_str ) ) {
            $loc_ids = array_map('intval', explode(',', $locations_str));
            $active_location_terms = get_terms( [
                'taxonomy' => 'property-location',
                'include'  => $loc_ids,
                'hide_empty' => false,
            ] );
        } else {
            // Nếu chưa chọn tĩnh, lấy một vài cái mặc định
            $active_location_terms = get_terms( [
                'taxonomy' => 'property-location',
                'hide_empty' => false,
                'number' => 4,
            ] );
        }

        // Truy vấn WP_Query lấy sản phẩm
        $args = [
            'post_type'      => 'real_estate',
            'posts_per_page' => $post_number,
            'post_status'    => 'publish',
        ];
        $query = new WP_Query( $args );
        $total_posts = $query->found_posts;
?>

<!-- Khung Bọc của Block danh sách -->
<section class="property-block py-10 w-full" style="font-family: inherit;">
    
    <!-- 1. HEADER (Title & Tabs) -->
    <div class="mb-5">
        <p class="text-yellow-500 text-xs font-semibold uppercase mb-1 flex items-center gap-2 lth-subtitle">
            <span class="w-6 h-[1px] bg-yellow-500 inline-block"></span> 
            <?php echo esc_html( $subtitle ); ?>
        </p>
        <h2 class="text-3xl font-extrabold text-gray-800 mb-4 lth-title">
            <?php echo esc_html( $title ); ?>
        </h2>
        
        <div class="flex flex-wrap gap-2 tabs-location">
            <button class="bg-gray-800 text-white rounded-[20px] px-5 py-1.5 text-sm font-medium lth-tab-btn active cursor-pointer" data-term="all">Tất cả</button>
            <?php 
            if ( ! is_wp_error( $active_location_terms ) && ! empty($active_location_terms) ) {
                foreach ( $active_location_terms as $term ) : 
            ?>
                <button class="border border-gray-300 text-gray-600 rounded-[20px] px-5 py-1.5 text-sm font-medium hover:bg-gray-50 lth-tab-btn transition-colors cursor-pointer" data-term="loc-<?php echo esc_attr( $term->term_id ); ?>">
                    <?php echo esc_html( $term->name ); ?>
                </button>
            <?php 
                endforeach; 
            }
            ?>
        </div>
    </div>
    
    <!-- 2. TOOLBAR (Đếm số, Filter lưới) -->
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600 text-sm">Có <span class="font-bold text-gray-900 lth-count"><?php echo esc_html( $total_posts ); ?></span> bất động sản</p>
        <div class="flex gap-3 items-center">
            <div class="view-switch flex gap-1.5">
                <!-- Icon giả lập List/Grid -->
                <button class="w-8 h-8 rounded bg-gray-800 text-white flex items-center justify-center cursor-pointer">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <button class="w-8 h-8 rounded border border-gray-200 text-gray-500 hover:bg-gray-50 flex items-center justify-center cursor-pointer">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </button>
            </div>
            <select class="border border-gray-200 text-sm py-1.5 px-3 rounded-md outline-none text-gray-600 lth-sort">
                <option value="newest">Sắp xếp: Mới nhất</option>
                <option value="price_asc">Giá: Thấp đến cao</option>
                <option value="price_desc">Giá: Cao đến thấp</option>
            </select>
        </div>
    </div>

    <!-- 3. VÒNG LẶP SẢN PHẨM (WP_Query Loop) -->
    <div class="flex flex-col gap-5 lth-listings-container">

        <?php if ( $query->have_posts() ) : ?>
            <?php 
            while ( $query->have_posts() ) : $query->the_post(); 
                $post_id = get_the_ID();
                
                // Lấy Cấu hình Metas
                $price = get_post_meta( $post_id, 'price', true );
                $currency = get_post_meta( $post_id, 'currency', true );
                $area = get_post_meta( $post_id, 'area', true );
                $frontage = get_post_meta( $post_id, 'frontage_width_m', true );
                $floors = get_post_meta( $post_id, 'num_floors', true );
                $legal = get_post_meta( $post_id, 'legal_paper_status', true );
                
                $price_label = $price ? $price . ' ' . $currency : 'Liên hệ';
                
                // Trích xuất Taxonomy Type & Location
                $types = get_the_terms( $post_id, 'property-type' );
                $type_name = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : 'Bất động sản';

                $locations = get_the_terms( $post_id, 'property-location' );
                $location_name = ( $locations && ! is_wp_error( $locations ) ) ? $locations[0]->name : '';
                
                // Phân tích class tab lọc
                $term_classes = [];
                if ( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
                    foreach ( $locations as $loc ) {
                        $term_classes[] = 'loc-' . $loc->term_id;
                    }
                }
                $term_class_string = implode( ' ', $term_classes );
            ?>
            <!-- Bắt đầu Thẻ BĐS (Card List Layout) -->
            <div class="property-card lth-list-item flex flex-col md:flex-row border border-gray-200 rounded-[20px] p-4 gap-6 bg-white shadow-sm hover:shadow-md transition <?php echo esc_attr( $term_class_string ); ?>">
                
                <!-- Cột trái: Thumbnail Lớn -->
                <div class="relative w-full md:w-[35%] h-[220px]">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'medium_large' ); ?>" class="w-full h-full object-cover rounded-xl" alt="<?php the_title_attribute(); ?>">
                    <?php else : ?>
                        <div class="w-full h-full bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">Không có ảnh</div>
                    <?php endif; ?>
                    <span class="absolute top-0 left-0 bg-green-500 text-white px-3 py-1 text-xs font-bold rounded-tl-xl rounded-br-xl">Mới nhất</span>
                    <a href="<?php the_permalink(); ?>" class="absolute bottom-3 right-3 bg-black text-white px-5 py-2 text-xs font-semibold rounded-lg hover:bg-gray-800 transition">Xem chi tiết &gt;</a>
                </div>

                <!-- Cột phải: Content Form -->
                <div class="w-full md:w-[65%] flex flex-col justify-between py-1">
                    <div>
                        <!-- Category Tag -->
                        <span class="inline-block border border-gray-200 text-gray-500 px-4 py-1 rounded-full text-xs mb-3 font-semibold"><?php echo esc_html( $type_name ); ?></span>
                        
                        <!-- Tiêu đề chính -->
                        <h3 class="font-extrabold text-xl mb-3 text-gray-900 line-clamp-2 leading-snug"><a href="<?php the_permalink(); ?>" class="hover:text-yellow-600 transition"><?php the_title(); ?></a></h3>
                        
                        <!-- Location & Dát -->
                        <div class="text-sm text-gray-500 flex items-center gap-5 mb-4 font-medium">
                            <?php if ( $location_name ) : ?>
                                <span class="flex items-center gap-1.5">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <?php echo esc_html( $location_name ); ?>
                                </span>
                            <?php endif; ?>
                            <span class="flex items-center gap-1.5">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <?php echo get_the_date('d/m/Y'); ?>
                            </span>
                        </div>

                        <!-- Icons Kỹ thuật -->
                        <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm font-semibold border-b border-gray-100 pb-4 text-gray-700">
                            <span class="flex items-center gap-2" title="Mặt tiền"><span class="text-gray-400">⏹</span> <?php echo esc_html( $frontage ?: '-' ); ?>m</span>
                            <span class="flex items-center gap-2" title="Diện tích"><span class="text-gray-400">📐</span> <?php echo esc_html( $area ?: '-' ); ?>m2</span>
                            <span class="flex items-center gap-2" title="Số tầng"><span class="text-gray-400">🏢</span> <?php echo esc_html( $floors ?: '-' ); ?> tầng</span>
                            <span class="flex items-center gap-2" title="Pháp lý"><span class="text-gray-400">⚖️</span> <?php echo esc_html( $legal ?: 'Chờ sổ' ); ?></span>
                        </div>
                    </div>
                    
                    <!-- Footer: Giá & Buttons -->
                    <div class="flex justify-between items-center pt-3">
                        <p class="text-gray-500 text-sm font-semibold">Giá: <span class="text-red-600 font-extrabold text-xl ml-1"><?php echo esc_html( $price_label ); ?></span></p>
                        <a href="<?php the_permalink(); ?>" class="flex items-center gap-2 bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 text-yellow-700 px-6 py-2 rounded-full font-bold transition">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                            Gọi ngay
                        </a>
                    </div>
                </div>

            </div>
            <!-- Kết thúc Thẻ -->
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="p-10 border border-gray-200 text-center text-gray-500 rounded-xl">Chưa có dữ liệu bất động sản phù hợp.</div>
        <?php endif; ?>

    </div>
</section>

<!-- 4. LOGIC JAVASCRIPT CHO TAB FILTER -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.lth-tab-btn');
    const items = document.querySelectorAll('.lth-list-item');
    const countDisplay = document.querySelector('.lth-count');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Update UI Button
            tabs.forEach(t => {
                t.classList.remove('bg-gray-800', 'text-white');
                t.classList.add('border', 'border-gray-300', 'text-gray-600');
            });
            this.classList.remove('border', 'border-gray-300', 'text-gray-600');
            this.classList.add('bg-gray-800', 'text-white');
            
            // Logic Filter
            const term = this.getAttribute('data-term');
            let count = 0;
            
            items.forEach(item => {
                if(term === 'all' || item.classList.contains(term)) {
                    item.style.display = 'flex';
                    count++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            if(countDisplay) { countDisplay.textContent = count; }
        });
    });
});
</script>
<?php
        return ob_get_clean();
    }
endif;
?>
