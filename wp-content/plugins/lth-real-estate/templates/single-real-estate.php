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
    
    // New fields for property types
    $house_condition = get_post_meta( $post_id, 'house_condition', true );
    $design = get_post_meta( $post_id, 'design', true );
    $occupancy_rate = get_post_meta( $post_id, 'occupancy_rate', true );
    $unit_type = get_post_meta( $post_id, 'unit_type', true );
    $floor_range = get_post_meta( $post_id, 'floor_range', true );
    $entrance_width = get_post_meta( $post_id, 'entrance_width_m', true );
    
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
    
    // Calculate price/m2
    $price_sqm = '';
    if ( ! empty($price) && ! empty($area) && intval($area) > 0 ) {
        $price_float = floatval($price);
        $total_millions = 0;
        if ( stripos($currency, 'billion') !== false ) {
            $total_millions = $price_float * 1000;
        } elseif ( stripos($currency, 'million') !== false ) {
            $total_millions = $price_float;
        }
        
        if ($total_millions > 0) {
            $calc = $total_millions / floatval($area);
            $price_sqm = round($calc, 1) . ' triệu/m²';
        }
    }

    $currency_label = isset($labels_map[$currency]) ? $labels_map[$currency] : $currency;
    $price_label = $price ? $price . ' ' . $currency_label : 'Liên hệ';
    
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




<div class="single-bds-container xl:max-w-7xl! max-w-[23.4375rem] mx-auto px-3! 2xl:px-0! mt-6">
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
    <?php 
    $total_images = count($gallery_ids);
    $display_num = min($total_images, 5);
    ?>
    <!-- Desktop Dynamic Grid -->
    <div class="bds-gallery-grid grid-<?php echo $display_num; ?> mb-10 hidden xl:grid">
        <?php for ($i = 0; $i < $display_num; $i++) :
            $src = wp_get_attachment_image_url($gallery_ids[$i], "large"); 
        ?>
            <div class="bds-gallery-item img-<?php echo $i; ?>" onclick="openLb(<?php echo $i; ?>)">
                <img src="<?php echo esc_url($src); ?>" alt="BĐS Gallery">
                <?php if ($i === 4 && $total_images > 5) : ?>
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-3xl font-bold transition-all hover:bg-black/40">
                        +<?php echo ($total_images - 5); ?> ảnh
                    </div>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Mobile Responsive Gallery -->
    <div class="xl:hidden relative mb-8 rounded-2xl overflow-hidden shadow-xl aspect-video mb-8!">
        <div id="mob-scroll" class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide h-full">
            <?php foreach ($gallery_ids as $idx => $id) : 
                $src = wp_get_attachment_image_url($id, "large");
            ?>
                <div class="snap-start shrink-0 w-full h-full relative" onclick="openLb(<?php echo $idx; ?>)">
                    <img src="<?php echo esc_url($src); ?>" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 right-4 bg-black/70 text-white px-3 py-1 rounded-full text-xs font-bold"><?php echo ($idx+1)."/".$total_images; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- LIGHTBOX OVERLAY -->
    <div id="lth-lightbox" class="fixed inset-0 z-[10001] bg-black/95 flex flex-col items-center justify-center hidden">
        <!-- Header: Counter & Close -->
        <div class="absolute top-4 right-4 left-4 flex items-center justify-between text-white z-20">
            <span id="lb-indicator" class="text-base font-bold bg-black/50 px-3 py-1 rounded-full">1 / 1</span>
            <button onclick="closeLb()" class="hover:opacity-50 transition-opacity p-2">
                <i class="bi bi-x-lg text-3xl"></i>
            </button>
        </div>

        <!-- Main View Area -->
        <div class="w-full h-full flex items-center justify-center px-2 relative">
            <!-- Nút Trái -->
            <button onclick="changeLb(-1)" class="absolute left-2 z-10 w-12 h-12 bg-black/20 hover:bg-black/50 rounded-full flex items-center justify-center text-white transition-all">
                <i class="bi bi-chevron-left text-4xl"></i>
            </button>
            
            <!-- Ảnh chính -->
            <img id="lb-view" class="max-w-full max-h-[80vh] object-contain transition-all duration-300">
            
            <!-- Nút Phải -->
            <button onclick="changeLb(1)" class="absolute right-2 z-10 w-12 h-12 bg-black/20 hover:bg-black/50 rounded-full flex items-center justify-center text-white transition-all">
                <i class="bi bi-chevron-right text-4xl"></i>
            </button>
        </div>
    </div>


    <script>
    const galData = <?php echo json_encode(array_map(function($id) { return wp_get_attachment_image_url($id, "full"); }, $gallery_ids)); ?>;
    let lbCurrent = 0;
    function openLb(i) {
        lbCurrent = i; refreshLb();
        document.getElementById("lth-lightbox").classList.add("active");
        document.body.style.overflow = "hidden";
    }
    function refreshLb() {
        document.getElementById("lb-view").src = galData[lbCurrent];
        document.getElementById("lb-indicator").innerText = (lbCurrent + 1) + " / " + galData.length;
    }
    function changeLb(d) {
        lbCurrent = (lbCurrent + d + galData.length) % galData.length; refreshLb();
    }
    function closeLb() {
        document.getElementById("lth-lightbox").classList.remove("active");
        document.body.style.overflow = "";
    }
    window.onkeydown = e => {
        if(e.key === "Escape") closeLb();
        if(e.key === "ArrowLeft") changeLb(-1);
        if(e.key === "ArrowRight") changeLb(1);
    };
    </script>


    <!-- MAIN FLEX LAYOUT -->
    <div class="flex flex-col xl:flex-row gap-8 items-start mb-10">
        
        <!-- COLUMN 1: LEFT MAIN -->
        <div class="xl:basis-[70rem] flex-grow">
            
            <div class="flex flex-col xl:flex-row gap-4 items-start">
                
                <!-- SUB LEFT (Title + Content) -->
                <div class="flex-grow">
                    <!-- HEADER -->
                    <div class="border-b border-gray-100 pb-6 mb-8">
                        <div class="flex items-center justify-between xl:justify-start gap-3! xl:gap-x-10 text-sm mb-2! border-b border-gray-100 pb-6">
                            <div class="flex flex-col xl:flex-row xl:items-center gap-0 xl:gap-1!">
                                <span class="text-xs xl:text-sm text-gray-400 normal-case font-medium xl:font-normal">Danh mục:</span>
                                <span class="text-sm xl:text-sm text-black font-semibold"><?php echo esc_html($type_name); ?></span>
                            </div>
                            <span class="text-gray-200 text-3xl! -mt-1">·</span>
                            <div class="flex flex-col xl:flex-row xl:items-center gap-0 xl:gap-1!">
                                <span class="text-xs xl:text-sm text-gray-400 normal-case font-medium xl:font-normal">Tình trạng:</span>
                                <span class="text-sm xl:text-sm text-black font-semibold"><?php echo esc_html(isset($labels_map[$legal]) ? $labels_map[$legal] : ($legal ?: 'Đang cập nhật')); ?></span>
                            </div>
                            <span class="text-gray-200 text-3xl! -mt-1">·</span>
                            <div class="flex flex-col xl:flex-row xl:items-center gap-0 xl:gap-1!">
                                <span class="text-xs xl:text-sm text-gray-400 normal-case font-medium xl:font-normal">Năm xây:</span>
                                <span class="text-sm xl:text-sm text-black font-semibold">2022</span>
                            </div>
                        </div>

                        <h1 class="text-2xl! font-bold text-gray-900 leading-snug mb-2"><?php the_title(); ?></h1>
                        
                        <div class="flex items-center gap-1 text-gray-500 text-sm mb-2">
                            <i class="bi bi-geo-alt text-lg"></i>
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
                        <div class="flex items-center gap-1 text-gray-400 text-sm mb-6 -mt-3">
                            <i class="bi bi-clock text-sm"></i>
                            <?php echo get_the_date('d/m/Y H:i'); ?>
                        </div>

                        <!-- Top Info Boxes -->
                        <div class="grid grid-cols-2 xl:grid-cols-4 gap-2 mb-5! mt-5!">
                            <div class="bg-[#F3F7F8] px-3 py-3 rounded-xl flex items-center gap-2 border border-gray-100 hover:border-gray-200 transition-all whitespace-nowrap overflow-hidden">
                               
                                <i class="stnd-normal-icons icons-house-facade text-gray-400 text-sm w-[20px]! h-[20px]!"></i>
                                <div class="flex items-center gap-1 text-[13px]">
                                    <span class="text-gray-500">Mặt tiền:</span>
                                    <span class="font-bold text-gray-900"><?php echo $frontage ? $frontage . 'm' : '---'; ?></span>
                                </div>
                            </div>
                            <div class="bg-[#F3F7F8] px-3 py-3 rounded-xl flex items-center gap-2 border border-gray-100 hover:border-gray-200 transition-all whitespace-nowrap overflow-hidden">
                                <i class="stnd-normal-icons icons-area text-gray-400 text-sm w-[20px]! h-[20px]!"></i>
                                <div class="flex items-center gap-1 text-[13px]">
                                    <span class="text-gray-500">Diện tích:</span>
                                    <span class="font-bold text-gray-900"><?php echo $area ? $area . 'm²' : '---'; ?></span>
                                </div>
                            </div>
                            <div class="bg-[#F3F7F8] px-3 py-3 rounded-xl flex items-center gap-2 border border-gray-100 hover:border-gray-200 transition-all whitespace-nowrap overflow-hidden">
                                <i class="stnd-normal-icons icons-floor text-gray-400 text-sm w-[20px]! h-[20px]!"></i>
                                <div class="flex items-center gap-1 text-[13px]">
                                    <span class="text-gray-500">Số tầng:</span>
                                    <span class="font-bold text-gray-900"><?php echo $num_floors ? $num_floors . ' tầng' : '---'; ?></span>
                                </div>
                            </div>
                            <div class="bg-[#F3F7F8] px-3 py-3 rounded-xl flex items-center gap-2 border border-gray-100 hover:border-gray-200 transition-all whitespace-nowrap overflow-hidden">
                                <i class="stnd-normal-icons icons-balance  text-gray-400 text-sm w-[20px]! h-[20px]!"></i>
                                <div class="flex items-center gap-1 text-[13px] truncate">
                                    <span class="text-gray-500">Pháp lý:</span>
                                    <span class="font-bold text-gray-900 truncate" title="<?php echo esc_attr($legal); ?>"><?php echo isset($labels_map[$legal]) ? $labels_map[$legal] : ($legal ?: '---'); ?></span>
                                </div>
                            </div>
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

                        <div class="dash-07 mb-6!">
                            <div class="title-box">
                                <h2 class="title text-[20px]! capitalize!">Chi tiết</h2>
                                <div class="infor"><p class="text-base! normal-case!">Bất động sản</p></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mb-12!">
                            <?php
                            $details = [];
                            $type_text = mb_strtolower($type_name);

                            if ( mb_stripos($type_text, 'biệt thự') !== false ) {
                                $details = [
                                    ['icon' => 'bi-fullscreen', 'label' => 'Quy mô', 'value' => $area ? $area . 'm²' : '---'],
                                    ['icon' => 'bi-house', 'label' => 'Mặt tiền', 'value' => $frontage ? $frontage . 'm' : '---'],
                                    ['icon' => 'bi-signpost-2', 'label' => 'Đường trước nhà', 'value' => $entrance_width ? $entrance_width . 'm' : '---'],
                                    ['icon' => 'bi-compass', 'label' => 'Hướng', 'value' => isset($labels_map[$house_direction]) ? $labels_map[$house_direction] : '---'],
                                    ['icon' => 'bi-door-closed', 'label' => 'Phòng ngủ', 'value' => $num_bedrooms ?: '---'],
                                    ['icon' => 'bi-house-check', 'label' => 'Hiện trạng nhà', 'value' => $house_condition ?: '---'],
                                ];
                            } elseif ( mb_stripos($type_text, 'văn phòng') !== false ) {
                                $details = [
                                    ['icon' => 'bi-fullscreen', 'label' => 'Quy mô', 'value' => $area ? $area . 'm²' : '---'],
                                    ['icon' => 'bi-house', 'label' => 'Mặt tiền', 'value' => $frontage ? $frontage . 'm' : '---'],
                                    ['icon' => 'bi-compass', 'label' => 'Hướng', 'value' => isset($labels_map[$house_direction]) ? $labels_map[$house_direction] : '---'],
                                    ['icon' => 'bi-signpost-2', 'label' => 'Đường trước nhà', 'value' => $entrance_width ? $entrance_width . 'm' : '---'],
                                    ['icon' => 'bi-house-check', 'label' => 'Hiện trạng nhà', 'value' => $house_condition ?: '---'],
                                    ['icon' => 'bi-brush', 'label' => 'Thiết kế', 'value' => $design ?: '---'],
                                ];
                            } elseif ( mb_stripos($type_text, 'khách sạn') !== false || mb_stripos($type_text, 'ccmn') !== false || mb_stripos($type_text, 'mini') !== false ) {
                                $details = [
                                    ['icon' => 'bi-fullscreen', 'label' => 'Quy mô', 'value' => $area ? $area . 'm²' : '---'],
                                    ['icon' => 'bi-house', 'label' => 'Mặt tiền', 'value' => $frontage ? $frontage . 'm' : '---'],
                                    ['icon' => 'bi-door-closed', 'label' => 'Phòng ngủ', 'value' => $num_bedrooms ?: '---'],
                                    ['icon' => 'bi-compass', 'label' => 'Hướng', 'value' => isset($labels_map[$house_direction]) ? $labels_map[$house_direction] : '---'],
                                    ['icon' => 'bi-graph-up-arrow', 'label' => 'Tỷ lệ lấp đầy', 'value' => $occupancy_rate ?: '---'],
                                    ['icon' => 'bi-house-check', 'label' => 'Hiện trạng nhà', 'value' => $house_condition ?: '---'],
                                ];
                            } elseif ( mb_stripos($type_text, 'mặt phố') !== false ) {
                                $details = [
                                    ['icon' => 'bi-fullscreen', 'label' => 'Quy mô', 'value' => $area ? $area . 'm²' : '---'],
                                    ['icon' => 'bi-house', 'label' => 'Mặt tiền', 'value' => $frontage ? $frontage . 'm' : '---'],
                                    ['icon' => 'bi-compass', 'label' => 'Hướng', 'value' => isset($labels_map[$house_direction]) ? $labels_map[$house_direction] : '---'],
                                    ['icon' => 'bi-house-check', 'label' => 'Hiện trạng nhà', 'value' => $house_condition ?: '---'],
                                ];
                            } elseif ( mb_stripos($type_text, 'chung cư') !== false ) {
                                $details = [
                                    ['icon' => 'bi-building', 'label' => 'Loại căn', 'value' => $unit_type ?: '---'],
                                    ['icon' => 'bi-layers', 'label' => 'Khoảng tầng', 'value' => $floor_range ?: '---'],
                                    ['icon' => 'bi-compass', 'label' => 'Hướng', 'value' => isset($labels_map[$house_direction]) ? $labels_map[$house_direction] : '---'],
                                    ['icon' => 'bi-lamp', 'label' => 'Nội thất', 'value' => isset($labels_map[$furniture]) ? $labels_map[$furniture] : '---'],
                                ];
                            } else {
                                // Default fallback
                                $details = [
                                    ['icon' => 'bi-fullscreen', 'label' => 'Quy mô', 'value' => $area ? $area . 'm²' : '---'],
                                    ['icon' => 'bi-house', 'label' => 'Mặt tiền', 'value' => $frontage ? $frontage . 'm' : '---'],
                                    ['icon' => 'bi-compass', 'label' => 'Hướng', 'value' => isset($labels_map[$house_direction]) ? $labels_map[$house_direction] : '---'],
                                    ['icon' => 'bi-shield-check', 'label' => 'Pháp lý', 'value' => isset($labels_map[$legal]) ? $labels_map[$legal] : '---'],
                                ];
                            }

                            foreach ($details as $item) :
                            ?>
                                <div class="flex items-center justify-between group">
                                    <div class="flex items-center gap-3">
                                        <i class="bi <?php echo esc_attr($item['icon']); ?> text-[20px]! text-gray-400 group-hover:text-black transition-colors"></i>
                                        <span class="text-[15px] font-medium text-gray-700"><?php echo esc_html($item['label']); ?></span>
                                    </div>
                                    <div class="bg-[#F3F7F8] px-4 py-1.5 rounded-full min-w-[60px] text-center">
                                        <span class="text-[15px] font-bold text-gray-900"><?php echo esc_html($item['value']); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!--
                        <div class="dash-07">
                            <div class="title-box ">
                                <h2 class="title text-[20px]! capitalize!">Tiện ích </h2>
                                <div class="infor"><p class="text-base! normal-case!">Bất động sản</p></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-y-5 gap-x-8 border-t border-gray-50 mb-10!">
                            
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">directions_car</span> Gara ô tô trong nhà</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">cooking</span> Bếp full tủ + thiết bị</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">ac_unit</span> Điều hòa các phòng</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">balcony</span> Ban công trước - sau</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">fire_extinguisher</span> Hệ thống PCCC cơ bản</div>
                            <div class="flex items-center gap-3 text-sm text-gray-600"><span class="material-symbols-outlined text-gray-400">layers</span> Dịch vụ tiện ích</div>
                        </div>
                            -->
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
                <div class="bds-price-sub-column hidden xl:block w-41 flex-shrink-0 sticky top-20">
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
                            <a href="tel:<?php echo esc_attr(lth_cfg('phone_link')); ?>" class="btn-call">
                                <i class="bi bi-telephone-fill"></i>
                                <span class="text-sm! font-semibold"><?php echo esc_html(lth_cfg('phone_number')); ?></span>
                            </a>
                            <a href="#" class="btn-contact">
                                <i class="bi bi-envelope"></i>
                                Liên hệ ngay
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- COLUMN 2: AGENT CARD (Basis 18.5rem) -->
        <div class="w-full xl:basis-[18.5rem] flex-shrink-0 top-10">
            <div class="bds-agent-card">
                <div class="avatar">
                    <img src="/wp-content/uploads/2026/03/033b60afaa34c7b6114814ec022fe1438ea96af5.jpg" alt="Agent">
                </div>
                <h4 class="text-sm! font-bold! mb-1">Mr. Hoàng Văn Thái</h4>
                <p class="position italic text-gray-500 text-sm mb-1!">Chuyên viên tư vấn</p>
                
                <div class="text-[#D09130] font-semibold text-sm mb-8! flex items-center justify-center gap-2">
                    <i class="bi bi-telephone-fill" style="font-size: 20px;"></i>
                    <span class=""><?php echo esc_html(lth_cfg('phone_number')); ?></span>
                </div>

                <div class="border-t border-gray-100 ">
                    
                    <div class="flex justify-center gap-2 items-center">
                        <span class="text-sm text-gray-400 tracking-widest">Liên hệ khác:</span>
                        <i class="stnd-images-icons facebook-icons w-[32px]! h-[32px]!">&nbsp;</i>
                        <i class="stnd-images-icons messenger-icons w-[32px]! h-[32px]!">&nbsp;</i>
                        <i class="stnd-images-icons zalo-icons w-[32px]! h-[32px]!">&nbsp;</i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FIXED MOBILE BAR -->
<div class="bg-[#1a2533] xl:hidden fixed z-[9999] bottom-0 shadow-2xl overflow-hidden flex h-[72px] w-full" style="backdrop-filter: blur(10px);">
    <div class="flex-1 px-4 py-2 flex flex-col justify-center text-white leading-tight">
        <span class="text-base tracking-tighter">Giá bán:</span>
        <span class="text-2xl font-bold text-white" ><?php echo esc_html($price_label); ?></span>
    </div>
    <div class="bg-[#FEBD55] flex-1 px-3 py-2 flex items-center justify-center text-gray-900 font-semibold text-base text-center leading-tight rounded-bl-2xl">
        <?php echo esc_html($price_sqm); ?>
    </div>
    <div class="bg-white flex items-center gap-3 px-2">
        <a href="tel:<?php echo esc_attr(lth_cfg('phone_link')); ?>" class="w-10 h-10 bg-[radial-gradient(59.94%_218.75%_at_50.15%_132.35%,#FFD45C_0%,#9E5625_100%)] rounded-full flex items-center justify-center text-white shadow-lg">
            <i class="bi bi-telephone-fill"></i>
        </a>
        <a href="mailto:<?php echo esc_attr(lth_cfg('email')); ?>" class="w-10 h-10 border border-gray-100 rounded-full flex items-center justify-center text-gray-400!">
            <i class="bi bi-envelope-fill"></i>
        </a>
    </div>
</div>

    <!-- RELATED REAL ESTATE SECTION -->
    <div class="related-bds-section mt-20 mb-20 xl:max-w-7xl! max-w-[23.4375rem] mx-auto px-3! 2xl:px-0!">
        <div class="flex items-center justify-between my-4!">
            
            <div class="dash-07">
                <div class="title-box ">
                    <h2 class="title">Bất động sản </h2>
                    <div class="infor"><p class=" uppercase!">Liên quan</p></div>
                </div>
            </div>
            <a href="<?php echo esc_url( $type_link ); ?>" class="flex items-center gap-1 px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600! hover:bg-gray-50 transition-colors">
                Xem thêm <i class="bi bi-chevron-right text-sm"></i>
            </a>
        </div>

        <?php
        $related_args = array(
            'post_type'      => 'real_estate',
            'posts_per_page' => 4,
            'post__not_in'   => array($post_id),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        if ($type_obj) {
            $related_args['tax_query'] = array(
                array(
                    'taxonomy' => (isset($type_obj->taxonomy)) ? $type_obj->taxonomy : 'category',
                    'field'    => 'term_id',
                    'terms'    => $type_obj->term_id,
                ),
            );
        }

        $related_query = new WP_Query($related_args);

        if ($related_query->have_posts()) :
        ?>
            <div class="flex flex-wrap xl:grid xl:grid-cols-4 gap-10 xl:gap-6">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                    $rel_id = get_the_ID();
                    $rel_price = get_post_meta($rel_id, 'price', true);
                    $rel_currency = get_post_meta($rel_id, 'currency', true);
                    $rel_area = get_post_meta($rel_id, 'area', true);
                    $rel_frontage = get_post_meta($rel_id, 'frontage_width_m', true);
                    $rel_floors = get_post_meta($rel_id, 'num_floors', true);
                    
                    $rel_locations = get_the_terms($rel_id, 'property-location');
                    $rel_loc_text = 'Đang cập nhật';
                    if ($rel_locations && !is_wp_error($rel_locations)) {
                        $rel_loc_text = $rel_locations[0]->name;
                    }

                    $rel_currency_label = isset($labels_map[$rel_currency]) ? $labels_map[$rel_currency] : $rel_currency;
                    $rel_price_display = $rel_price ? $rel_price . ' ' . $rel_currency_label : 'Liên hệ';

                    // Tag Logic: Mới nhất (<6h) vs Đang bán (>6h)
                    $rel_post_timestamp = get_post_time( 'U', true, $rel_id );
                    $current_timestamp = current_time( 'timestamp', 1 ); 
                    
                    if ( ( $current_timestamp - $rel_post_timestamp ) <= 6 * HOUR_IN_SECONDS ) {
                        $tag_class = 'pennant-tag-green';
                        $tag_text = 'Mới nhất';
                    } else {
                        $tag_class = 'pennant-tag-yellow';
                        $tag_text = 'Đang bán';
                    }
                ?>
                    <div class="bds-related-card bg-white border border-gray-100 rounded-2xl relative shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group px-4! gap-4! ">
                        <!-- Image Container with Specific Structure -->
                        
                            <!-- Conditional Pennant Tag -->
                            <div class="<?php echo esc_attr($tag_class); ?> text-sm font-medium"><?php echo esc_html($tag_text); ?></div>
                            
                            <div class="w-full h-[13.75rem] xl:w-[16.875rem] xl:h-[11.875rem] cut-the-bottom-right-corner-27-container">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', ['class' => 'zoom-image w-full h-full object-cover']); ?>
                                    <?php else : ?>
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                            <i class="bi bi-image text-gray-300 text-5xl"></i>
                                        </div>
                                    <?php endif; ?>
                                </a>

                                <!-- View More Overlay -->
                                <div class="job-overlay bg-view-more">
                                    <a class="btn-view-more" href="<?php the_permalink(); ?>">
                                        <span class="text-view-more">Xem chi tiết</span>
                                        <i class="arrow-right-icons"></i>
                                    </a>
                                </div>
                            </div>
                        

                        <!-- Info Content -->
                        <div class="flex-grow flex flex-col">
                            <h4 class=" font-bold line-clamp-2 mb-4! leading-snug group-hover:text-[#D09130] transition-colors" title="<?php the_title_attribute(); ?>">
                                <a class="text-base! text-black!" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>

                            <div class="flex items-center gap-1 text-gray-400 text-xs mb-2!">
                                <i class="bi bi-geo-alt text-sm"></i>
                                <span class="truncate"><?php echo esc_html($rel_loc_text); ?></span>
                            </div>

                            <div class="flex items-center gap-1 text-gray-400 text-xs mb-2!">
                                <i class="bi bi-clock text-sm"></i>
                                <span><?php echo get_the_date('d/m/Y H:i'); ?></span>
                            </div>

                            <!-- Parameters with Separators -->
                            <div class="flex items-center gap-x-2 border-t border-gray-50 py-1 xl:py-3 my-2!">
                                <div class="flex items-center gap-1 text-gray-600 pr-4! border-r! border-gray-200! last:border-0">
                                    <i class="bi bi-house text-[14px] text-gray-400"></i>
                                    <span class="text-sm font-bold"><?php echo $rel_frontage ?: '---'; ?>m</span>
                                </div>
                                <div class="flex items-center gap-1 text-gray-600 pr-4! border-r! border-gray-200! last:border-0">
                                    <i class="bi bi-aspect-ratio text-[14px] text-gray-400"></i>
                                    <span class="text-sm font-bold"><?php echo $rel_area ?: '---'; ?>m²</span>
                                </div>
                                <div class="flex items-center gap-1 text-gray-600 last:border-0">
                                    <i class="bi bi-layers text-[14px] text-gray-400"></i>
                                    <span class="text-sm font-bold"><?php echo $rel_floors ?: '---'; ?> tầng</span>
                                </div>
                                
                            </div>

                            <!-- Footer: Price + Call -->
                            <div class="flex items-center justify-between border-t border-gray-50 py-2!">
                                <div class="flex flex-row gap-2 items-center">
                                    <span class="text-sm text-gray-400">Giá:</span>
                                    <span class="text-base font-bold text-[#d63638]"><?php echo esc_html($rel_price_display); ?></span>
                                </div>
      
                                
                                <a href="tel:<?php echo esc_attr(lth_cfg('phone_link')); ?>">
                                    <div class="col-span-3 flex items-center gap-2! border border-[#FFD45C]! rounded-full py-1! pl-1! pr-3!">
                                        <i class="bi bi-telephone-fill gold-call-buton flex items-center justify-center"></i> 
                                        <span class="text_call_now">Gọi ngay</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            
        <?php endif; ?>
    </div>



<div class="h-24 xl:h-24"></div>

<?php 
endwhile;
get_footer(); 
?>


