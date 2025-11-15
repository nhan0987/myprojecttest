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
                                                <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Slide" width="1440" height="650">  
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
                            <div class="swiper-content absolute top-0 left-0 z-[2] translate-x-[24px] sm:translate-x-[24px] xl:translate-x-[241px]! translate-y-[191px]">
                                 <div class="flex flex-col gap-3">
                                    <div class="text-left"><span class="font-normal text-[20px] text-white">- Bất động sản Hà Nội</span></div>
                                    <div class="text-left"><span class="capitalize font-bold text-2xl xl:text-[40px] bg-[linear-gradient(86.24deg,_#FFD45C_1.16%,_#9E5625_128.11%)] bg-clip-text text-transparent leading-tight"><span class="text-transparent lg:text-white text-[20px] lgtext-[50px]">Siêu thị nhà đất</span> <br>Khác biệt tạo dấu ấn </span></div>
                                    <div class="text-left"><span class="font-medium text-xs xl:text-base text-white my-[10px]">Chuyên mua bán, ký gửi Bất động sản thổ cư <br> Hà Nội (Nhà mặt phố, Biệt thự, Văn phòng)</span></div>
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