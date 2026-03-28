<?php
/**
 * Custom Template for Single Real Estate Property
 * Redesign matching the premium layout
 */
get_header(); 

while ( have_posts() ) : the_post();
    $post_id = get_the_ID();
    
    // Meta data
    $price = get_post_meta( $post_id, 'price', true );
    $currency = get_post_meta( $post_id, 'currency', true );
    $area = get_post_meta( $post_id, 'area', true );
    $address_street = get_post_meta( $post_id, 'address_street', true );
    $num_bedrooms = get_post_meta( $post_id, 'num_bedrooms', true );
    $num_bathrooms = get_post_meta( $post_id, 'num_bathrooms', true );
    $num_floors = get_post_meta( $post_id, 'num_floors', true );
    $frontage = get_post_meta( $post_id, 'frontage_width_m', true );
    $legal = get_post_meta( $post_id, 'legal_paper_status', true );
    $gallery = get_post_meta( $post_id, 'property_gallery', true );
    $furniture = get_post_meta( $post_id, 'furniture_status', true );
    
    // Calculate price/m2
    $price_sqm = '';
    if ( ! empty($price) && ! empty($area) && intval($area) > 0 ) {
        $price_float = floatval($price);
        $total_millions = 0;
        if ( stripos($currency, 'Tỷ') !== false ) {
            $total_millions = $price_float * 1000;
        } elseif ( stripos($currency, 'Triệu') !== false ) {
            $total_millions = $price_float;
        }
        
        if ($total_millions > 0) {
            $calc = $total_millions / floatval($area);
            $price_sqm = round($calc, 1) . ' triệu/m²';
        }
    }

    $price_label = $price ? $price . ' ' . $currency : 'Liên hệ';
    
    // Locations
    $locations = get_the_terms( $post_id, 'property-location' );
    $loc_full = '';
    if ( $locations && ! is_wp_error( $locations ) ) {
        $child = null;
        foreach($locations as $l) { if($l->parent != 0) { $child = $l; break; } }
        if(!$child) $child = $locations[0];
        
        if($child->parent != 0) {
            $parent = get_term($child->parent, 'property-location');
            $loc_full = $child->name . ', ' . $parent->name;
        } else {
            $loc_full = $child->name;
        }
    }

    // GALLERY IMAGES
    $gallery_ids = ! empty( $gallery ) ? explode( ',', $gallery ) : [];
    // Prepend featured image if any
    $featured_id = get_post_thumbnail_id();
    if ( $featured_id ) {
        array_unshift( $gallery_ids, $featured_id );
    }
    $gallery_ids = array_unique( array_filter( $gallery_ids ) );
    
    // Taxonomy (Prioritize Category as requested)
    $categories = get_the_category( $post_id );
    $type_obj = ( $categories && ! is_wp_error( $categories ) ) ? $categories[0] : null;
    
    // If no category found, fall back to property-type taxonomy
    if ( ! $type_obj ) {
        $property_types = get_the_terms( $post_id, 'property-type' );
        $type_obj = ( $property_types && ! is_wp_error( $property_types ) ) ? $property_types[0] : null;
    }

    $type_name = $type_obj ? $type_obj->name : 'Bất động sản';
    $type_link = $type_obj ? get_term_link( $type_obj ) : '#';
    
    if ( ! is_wp_error( $type_link ) && $type_link !== '#' ) {
        // Force the link to use 'category' instead of 'property-type' path as requested
        $type_link = str_replace( '/property-type/', '/category/', $type_link );
    } else {
        $type_link = '#';
    }
?>




<div class="single-bds-container mx-auto px-4 max-w-[1200px] mt-6">
    <div class="bds-breadcrumb text-sm text-gray-400 mb-10!">
        <a href="<?php echo home_url(); ?>">Trang chủ</a> &nbsp;/&nbsp; 
        <?php if ( $type_link !== '#' ) : ?>
            <a href="<?php echo esc_url( $type_link ); ?>"><?php echo esc_html( $type_name ); ?></a>
        <?php else : ?>
            <span><?php echo esc_html( $type_name ); ?></span>
        <?php endif; ?>
        &nbsp;/&nbsp; 
        <span><?php the_title(); ?></span>
    </div>

    <!-- GALLERY SECTION -->
    <div class="bds-gallery-grid mb-10">
        <?php 
        for ($i = 0; $i < 5; $i++) {
            $current_id = isset($gallery_ids[$i]) ? $gallery_ids[$i] : null;
            $class = ($i == 0) ? 'bds-gallery-main' : 'bds-gallery-item';
            if ($current_id) {
                $url = wp_get_attachment_image_url($current_id, 'large');
                echo '<div class="'.esc_attr($class).'"><img src="'.esc_url($url).'" alt="Gallery Image"></div>';
            } else {
                $placeholder = 'https://picsum.photos/seed/'.($i + $post_id).'/800/600';
                echo '<div class="'.esc_attr($class).'"><img src="'.esc_url($placeholder).'" alt="Placeholder"></div>';
            }
        }
        ?>
    </div>

    <!-- MAIN FLEX LAYOUT -->
    <div class="flex flex-col lg:flex-row gap-8 items-start mb-10">
        
        <!-- COLUMN 1: LEFT MAIN -->
        <div class="lg:basis-[70rem] flex-grow">
            
            <div class="flex flex-col lg:flex-row gap-1 items-start">
                
                <!-- SUB LEFT (Title + Content) -->
                <div class="flex-grow">
                    <!-- HEADER -->
                    <div class="border-b border-gray-100 pb-6 mb-8">
                        <div class="flex flex-wrap gap-x-4! gap-y-2 text-sm text-gray-400 mb-3 items-center">
                            <span class="flex items-center gap-1">Danh mục: <span class="text-black font-semibold"><?php echo esc_html($type_name); ?></span></span>
                            <span class="text-gray-300 text-3xl!">·</span>
                            <span class="flex items-center gap-1">Tình trạng: <span class="text-black font-semibold"><?php echo esc_html($legal ?: 'Đang cập nhật'); ?></span></span>
                            <span class="text-gray-300 text-3xl!">·</span>
                            <span class="flex items-center gap-1">Năm xây: <span class="text-black font-semibold">2022</span></span>
                        </div>

                        <h1 class="text-2xl! font-bold text-gray-900 leading-snug mb-2"><?php the_title(); ?></h1>
                        
                        <div class="flex items-center gap-1 text-gray-500 text-sm mb-2">
                            <span class="material-symbols-outlined text-lg">location_on</span>
                            <?php 
                            $final_loc = $address_street;
                            if ( ! empty( $final_loc ) && ! empty( $loc_full ) ) {
                                $final_loc .= ', ' . $loc_full;
                            } elseif ( empty( $final_loc ) ) {
                                $final_loc = $loc_full;
                            }
                            echo esc_html( $final_loc ?: 'Đang cập nhật địa chỉ' ); 
                            ?>
                        </div>

                        <!-- Post Date -->
                        <div class="flex items-center gap-1 text-gray-400 text-sm mb-6 -mt-3 mb-2">
                            <span class="material-symbols-outlined text-base">schedule</span>
                            <?php echo get_the_date('d/m/Y H:i'); ?>
                        </div>

                        
                    </div>

                    <!-- BODY CONTENT -->
                    <div class="bds-body-content">
                        <div class="dash-07">
                            <div class="title-box ">
                                <h2 class="title text-[20px]! capitalize!">Tổng quan </h2>
                                <div class="infor"><p class="text-base! normal-case!">Bất động sản</p></div>
                            </div>
                        </div>
                        <div class="prose max-w-none text-gray-600 leading-relaxed mb-10!">
                            <?php the_content(); ?>
                        </div>

                        <div class="dash-07">
                                <div class="title-box ">
                                    <h2 class="title text-[20px]! capitalize!">Chi tiết </h2>
                                    <div class="infor"><p class="text-base! normal-case!">Bất động sản</p></div>
                                </div>
                            </div>

                        <div class="grid grid-cols-2 md:grid-cols-2 gap-3 mb-10!">

                            <!-- Basic Information Block -->
                            
                            <!-- Mặt tiền -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-gray-400 text-2xl">rectangle</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="text-gray-500">Mặt tiền:</span>  <span class="text-black font-semibold"><?php echo esc_html($frontage ?: '---'); ?>m</span>
                                </div>
                            </div>
                            <!-- Diện tích -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-gray-400 text-2xl">open_in_full</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="text-gray-500">Diện tích:</span> <span class="text-black font-semibold"><?php echo esc_html($area ?: '---'); ?>m²</span>
                                </div>
                            </div>
                            <!-- Số tầng -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-gray-400 text-2xl">stairs</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="text-gray-500">Số tầng:</span>  <span class="text-black font-semibold"><?php echo esc_html($num_floors ?: '---'); ?> tầng</span>
                                </div>
                            </div>
                            <!-- Pháp lý -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-gray-400 text-2xl">balance</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="text-gray-500">Pháp lý:</span> <span class="text-black font-semibold"><?php echo esc_html($legal ?: '---'); ?></span>
                                </div>
                            </div>
                        </div>

                        
                        <div class="dash-07">
                            <div class="title-box ">
                                <h2 class="title text-[20px]! capitalize!">Tiện ích </h2>
                                <div class="infor"><p class="text-base! normal-case!">Bất động sản</p></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-8 border-t border-gray-50 mb-10!">
                            
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">directions_car</span> Gara ô tô trong nhà</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">cooking</span> Bếp full tủ + thiết bị</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">ac_unit</span> Điều hòa các phòng</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">balcony</span> Ban công trước - sau</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">fire_extinguisher</span> Hệ thống PCCC cơ bản</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">layers</span> Dịch vụ tiện ích</div>
                        </div>

                        <!-- MAP SECTION -->
                        <?php 
                        $map_source = get_post_meta( $post_id, 'google_maps_url', true );
                        if ( ! empty( $map_source ) ) :
                            if ( preg_match( '/src="([^"]+)"/', $map_source, $match ) ) {
                                $map_url = $match[1];
                            } else {
                                $map_url = $map_source;
                            }
                        ?>
                            <div class="mt-12">
                                <div class="dash-07">
                                    <div class="title-box ">
                                        <h2 class="title text-[20px]! capitalize!">Vị trí </h2>
                                        <div class="infor"><p class="text-base! normal-case!">Bất động sản</p></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-400 mb-4"><?php echo esc_html($final_loc); ?></p>
                                <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-inner h-[400px]">
                                    <iframe src="<?php echo esc_url($map_url); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- SUB RIGHT (Price Card - Sticky) -->
                <div class="bds-price-sub-column hidden lg:block w-41 flex-shrink-0  top-10">
                    <div class="bds-price-card">
                        <div class="price-header-section">
                            <span class="label">Giá bán</span>
                            <div class="price-val"><?php echo esc_html($price_label); ?></div>
                        </div>
                        <?php if ($price_sqm) : ?>
                            <div class="price-sqm-section">
                                ~ <?php echo esc_html($price_sqm); ?>
                            </div>
                        <?php endif; ?>
                        <div class="price-contact-section">
                            <a href="tel:0972991551" class="btn-call">
                                <span class="material-symbols-outlined">call</span>
                                0972 991 551
                            </a>
                            <a href="#" class="btn-contact">
                                <span class="material-symbols-outlined">mail</span>
                                Liên hệ ngay
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- COLUMN 2: AGENT CARD (Basis 18.5rem) -->
        <div class="lg:basis-[18.5rem] flex-shrink-0 sticky top-10">
            <div class="bds-agent-card">
                <div class="avatar shadow-xl border-4 border-white mb-6">
                    <img src="https://i.pravatar.cc/150?u=thai" alt="Agent">
                </div>
                <h4 class="text-xl font-bold mb-1">Mr. Hoàng Văn Thái</h4>
                <p class="position italic text-gray-500 text-sm mb-6">Chuyên viên tư vấn</p>
                
                <div class="text-orange-400 font-bold text-lg mb-8 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size: 20px;">phone_enabled</span>
                    0972 991 551
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-4">Kết nối qua:</p>
                    <div class="flex justify-center gap-4 text-orange-400">
                        <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition">forum</span>
                        <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition">chat</span>
                        <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition">call</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FIXED MOBILE BAR -->
<div class="lg:hidden fixed bottom-1 left-4 right-4 z-[9999] shadow-2xl rounded-2xl overflow-hidden border border-white/20 flex h-[72px]" style="backdrop-filter: blur(10px);">
    <div class="bg-[#1a2533] flex-1 px-4 py-2 flex flex-col justify-center text-white leading-tight">
        <span class="text-[10px] opacity-70 uppercase tracking-tighter">Giá bán:</span>
        <span class="text-xl font-bold font-['Outfit']" style="color: #fff;"><?php echo esc_html($price_label); ?></span>
    </div>
    <div class="bg-[#ffbe42] flex-1 px-3 py-2 flex items-center justify-center text-gray-900 font-bold text-xs text-center leading-tight">
        <?php echo esc_html($price_sqm); ?>
    </div>
    <div class="bg-white flex items-center gap-3 px-4">
        <a href="tel:0972991551" class="w-10 h-10 bg-[#ffbe42] rounded-full flex items-center justify-center text-white shadow-lg">
            <span class="material-symbols-outlined">call</span>
        </a>
        <a href="mailto:contact@stnd.vn" class="w-10 h-10 border border-gray-100 rounded-full flex items-center justify-center text-gray-400">
            <span class="material-symbols-outlined">mail</span>
        </a>
    </div>
</div>

<div class="h-24"></div>

<?php 
endwhile;
get_footer(); 
?>


