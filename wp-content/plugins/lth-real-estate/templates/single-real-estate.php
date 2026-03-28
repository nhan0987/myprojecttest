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
    <div class="bds-gallery-grid grid-<?php echo $display_num; ?> mb-10 hidden lg:grid">
        <?php for ($i = 0; $i < $display_num; $i++) :
            $src = wp_get_attachment_image_url($gallery_ids[$i], "large"); 
        ?>
            <div class="bds-gallery-item img-<?php echo $i; ?>" onclick="openLb(<?php echo $i; ?>)">
                <img src="<?php echo esc_url($src); ?>" alt="BĐS Gallery">
                <?php if ($i === 4 && $total_images > 5) : ?>
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-3xl font-bold transition-all hover:bg-black/40">
                        +<?php echo ($total_images - 4); ?> ảnh
                    </div>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Mobile Responsive Gallery -->
    <div class="lg:hidden relative mb-8 rounded-2xl overflow-hidden shadow-xl aspect-video">
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
    <div id="lth-lightbox" class="fixed inset-0 z-[10001] bg-black/95 items-center justify-center hidden">
        <div class="absolute top-6 right-8 flex items-center gap-8 text-white z-20">
            <span id="lb-indicator" class="text-xl font-bold">1 / 1</span>
            <button onclick="closeLb()" class="hover:opacity-50 transition-opacity"><span class="material-symbols-outlined text-4xl">close</span></button>
        </div>
        <div class="w-full h-full flex items-center justify-between px-6 lg:px-20">
            <button onclick="changeLb(-1)" class="w-14 h-14 bg-white/10 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all"><span class="material-symbols-outlined text-5xl">chevron_left</span></button>
            <img id="lb-view" class="max-w-full max-h-[85vh] object-contain transition-all duration-300">
            <button onclick="changeLb(1)" class="w-14 h-14 bg-white/10 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all"><span class="material-symbols-outlined text-5xl">chevron_right</span></button>
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
    <div class="flex flex-col lg:flex-row gap-8 items-start mb-10">
        
        <!-- COLUMN 1: LEFT MAIN -->
        <div class="lg:basis-[70rem] flex-grow">
            
            <div class="flex flex-col lg:flex-row gap-4 items-start">
                
                <!-- SUB LEFT (Title + Content) -->
                <div class="flex-grow">
                    <!-- HEADER -->
                    <div class="border-b border-gray-100 pb-6 mb-8">
                        <div class="flex flex-wrap gap-x-4! gap-y-2 text-sm text-gray-400 mb-3 items-center">
                            <span class="flex items-center gap-1">Danh mục: <span class="text-black font-semibold"><?php echo esc_html($type_name); ?></span></span>
                            <span class="text-gray-300 text-3xl!">·</span>
                            <span class="flex items-center gap-1">Tình trạng: <span class="text-black font-semibold"><?php echo esc_html(isset($labels_map[$legal]) ? $labels_map[$legal] : ($legal ?: 'Đang cập nhật')); ?></span></span>
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
                                <span class="material-symbols-outlined text-2xl">rectangle</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="">Mặt tiền:</span>  <span class="text-black font-semibold"><?php echo esc_html($frontage ?: '---'); ?>m</span>
                                </div>
                            </div>
                            <!-- Diện tích -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-2xl">open_in_full</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="">Diện tích:</span> <span class="text-black font-semibold"><?php echo esc_html($area ?: '---'); ?>m²</span>
                                </div>
                            </div>
                            <!-- Số tầng -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-2xl">stairs</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="">Số tầng:</span>  <span class="text-black font-semibold"><?php echo esc_html($num_floors ?: '---'); ?> tầng</span>
                                </div>
                            </div>
                            <!-- Pháp lý -->
                            <div class="bg-[#F3F7F8] px-3! py-3!  rounded-xl flex items-center   gap-1! ">
                                <span class="material-symbols-outlined text-2xl">balance</span>
                                <div class="text-sm whitespace-nowrap">
                                    <span class="">Pháp lý:</span> <span class="text-black font-semibold"><?php echo esc_html(isset($labels_map[$legal]) ? $labels_map[$legal] : ($legal ?: '---')); ?></span>
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
                <div class="bds-price-sub-column hidden lg:block w-41 flex-shrink-0 sticky  top-20">
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
        <div class="w-full lg:basis-[18.5rem] flex-shrink-0 top-10">
            <div class="bds-agent-card">
                <div class="avatar">
                    <img src="/wp-content/uploads/2026/03/033b60afaa34c7b6114814ec022fe1438ea96af5.jpg" alt="Agent">
                </div>
                <h4 class="text-sm! font-bold! mb-1">Mr. Hoàng Văn Thái</h4>
                <p class="position italic text-gray-500 text-sm mb-1!">Chuyên viên tư vấn</p>
                
                <div class="text-[#D09130] font-semibold text-sm mb-8! flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size: 20px;">phone_enabled</span>
                    <span class="">0972 991 551</span>
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
<div class="bg-[#1a2533] lg:hidden fixed z-[9999] bottom-0 shadow-2xl  overflow-hidden  flex h-[72px] w-full" style="backdrop-filter: blur(10px);">
    <div class="flex-1 px-4 py-2 flex flex-col justify-center text-white leading-tight">
        <span class="text-base tracking-tighter">Giá bán:</span>
        <span class="text-2xl font-bold text-white" ><?php echo esc_html($price_label); ?></span>
    </div>
    <div class="bg-[#FEBD55] flex-1 px-3 py-2 flex items-center justify-center text-gray-900 font-semibold text-base text-center leading-tight rounded-bl-2xl">
        <?php echo esc_html($price_sqm); ?>
    </div>
    <div class="bg-white flex items-center gap-3 px-4">
        <a href="tel:0972991551" class="w-10 h-10 bg-[radial-gradient(59.94%_218.75%_at_50.15%_132.35%,#FFD45C_0%,#9E5625_100%)] rounded-full flex items-center justify-center text-white shadow-lg">
            <span class="material-symbols-outlined">call</span>
        </a>
        <a href="mailto:contact@stnd.vn" class="w-10 h-10 border border-gray-100 rounded-full flex items-center justify-center text-gray-400!">
            <span class="material-symbols-outlined">mail</span>
        </a>
    </div>
</div>

<div class="h-24"></div>

<?php 
endwhile;
get_footer(); 
?>


