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
                                            <a href="<?php echo esc_url( $inner['button_url'] ); ?>">
                                                <img class="no-lazy" src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Slide" fetchpriority="high">  
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