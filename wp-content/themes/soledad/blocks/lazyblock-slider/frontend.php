<?php
/**
 * @block-slug  :   lth-slider
 * @block-output:   lth_slider_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-slider/frontend_callback', 'lth_slider_output_fe', 10, 2);

if (!function_exists('lth_slider_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_slider_output_fe($output, $attributes) {
        ob_start();
?>    
    <section class="lth-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="module module_slider">
                        <div class="swiper-slidershow swiper">
                            <div class="swiper-wrapper">
                                <?php foreach( $attributes['items'] as $inner ): ?>
                                    <div class="swiper-slide item">
                                        <div class="module_image"> 

                                            <?php 
                                                $original_url = esc_url( $inner['item_image']['url'] );
                                                $attachment_id = attachment_url_to_postid($original_url);

                                                if ($attachment_id) {
                                                    // 3. Lấy link ảnh size trung bình (thường là 48rem hoặc 64rem tùy settings)
                                                    // Các size mặc định: 'thumbnail', 'medium', 'medium_large', 'large', 'full'
                                                    $image_mobile_data = wp_get_attachment_image_src($attachment_id, '351x360');
                                                    $image_mobile_url = $image_mobile_data[0];
                                                } else {
                                                    // Nếu không tìm thấy ID, mình dùng chính link gốc làm fallback
                                                    $image_mobile_url = $original_url;
                                                }
                                            ?>
                                            <a href="<?php echo esc_url($inner['button_url'] ); ?>">
                                                
                                                <picture>
                                                    <source media="(max-width: 768px)" srcset="<?php echo $image_mobile_url; ?>">
                                                    <img class="no-lazy" src="<?php echo $original_url; ?>" alt="Slide" fetchpriority="high">
                                                </picture>
                                            </a>                                  
                                        </div>
                                        <div class="module_content">
                                            <div class="container">
                                                <div class="group-box">
                                                    <div class="text-top">
                                                        <?php echo wpautop(esc_html($inner['text_top'])); ?>
                                                    </div>
                                                    <div class="text-title">
                                                        <?php echo wpautop(esc_html($inner['text_title'])); ?>
                                                    </div>
                                                    <div class="text-bottom">
                                                        <?php echo wpautop(esc_html($inner['text_bottom'])); ?>
                                                    </div>
                                                    <a href="<?php echo esc_url( $inner['button_url'] ); ?>" title="">
                                                        <?php echo esc_html($inner['button_text']); ?>
                                                    </a>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="swiper-button-next swiper-arrow swiper-next"></div>
                            <div class="swiper-button-prev swiper-arrow swiper-prev"></div>

                            <div class="swiper-pagination"></div>
                            
                            <?php  
                            // echo "<pre>"; 
                            // print_r($attributes['display_style']);
                            // echo "</pre>";

                            ?>

                            <?php if ($attributes['display_style'] == 'style_01') { ?>
                                <div class="swiper-content absolute top-0 left-0 z-[2] translate-x-[1.5rem] sm:translate-x-[1.5rem] xl:translate-x-[15.0625rem]! translate-y-[1.375rem] xl:translate-y-[11.9375rem]">
                                    <div class="flex flex-col gap-3">
                                        <!-- <div class="text-left"><span class="font-normal text-base lg:text-[1.25rem] text-white">- Bất động sản Hà Nội</span></div> -->
                                        <div class="text-left">
                                            <span class="uppercase text-white text-[1rem] font-bold xl:text-[2rem]">Siêu thị nhà đất </span>
                                        </div>
                                        <div class="text-left">
                                            <span class="vip-gradient-text">Khác biệt tạo dấu ấn </span>
                                        </div>
                                        <div class="text-left"><span class="font-medium text-xs xl:text-base text-white my-[0.625rem]">Chuyên mua bán, ký gửi Bất động sản thổ cư <br> Hà Nội (Nhà mặt phố, Biệt thự, Văn phòng)</span></div>
                                        <div class="btn-gold "><a href="#danh-muc-bds"><span class="text-white">Khám phá ngay</span></a></div>
                                    
                                    </div>
                                </div>
                            <?php } elseif($attributes['display_style'] == 'style_02'){ ?>
                                <div class="swiper-content absolute z-[2] inset-[0] w-full h-full flex justify-center items-start xl:items-center">
                                    <div class="flex flex-col justify-center items-center text-center gap-2 xl:gap-6! pt-4! xl:pt-0! px-6! xl:px-0">
                                        
                                        
                                        <span class="xl:uppercase text-white text-xs xl:text-2xl font-medium">Giám đốc sàn giao dịch bất động sản thực chiến</span>
                                        <span class="xl:uppercase text-gold font-bold! text-[1.25rem]! xl:text-5xl!">Lần đầu tiên tại Việt Nam</span>
                                        <span class="text-white font-bold! text-[1.25rem]! xl:text-5xl!">STND Academy</span>
                                        <span class="text-white text-xs! xl:text-lg!">Chương trình ngắn hạn, thực hành 70% với dữ liệu thị trường, template & checklist triển khai ngay tại sàn.</span>
                                       
                                    
                                        <div class="btn-gold p-x-[2rem]! p-y-[0.75rem]! rounded-xl! "><a href="#"><span class="text-white">Đăng ký ngay</span></a></div>
                                        <div class="hidden xl:grid grid-cols-2 xl:grid-cols-4 w-full rounded-xl! py-3 xl:py-4 border border-white/50 bg-white xl:bg-white/15! xl:backdrop-blur-md shadow-lg transform translate-y-10 xl:translate-y-0">
                                            <div class="flex flex-col items-center justify-center text-center gap-2">
                                                <span class="font-bold text-base! xl:text-[2rem]! xl:text-white">560+</span>
                                                <span class="font-normal text-base xl:text-white">Học viên</span>
                                            </div>
                                            <div class="item flex flex-col items-center justify-center text-center gap-2">
                                                <span class="font-bold text-base! xl:text-[2rem]! xl:text-white">43</span>
                                                <span class="font-normal text-base xl:text-white">Khóa học</span>
                                            </div>
                                            <div class="flex flex-col items-center justify-center text-center gap-2">
                                                <span class="font-bold text-base! xl:text-[2rem]! xl:text-white">26</span>
                                                <span class="font-normal text-base xl:text-white">Giảng viên</span>
                                            </div>
                                            <div class="flex flex-col items-center justify-center text-center gap-2">
                                                <span class="font-bold text-base! xl:text-[2rem]! xl:text-white">5</span>
                                                <span class="font-normal text-base xl:text-white">Giải thưởng</span>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
        return ob_get_clean();
    }
endif;
?>