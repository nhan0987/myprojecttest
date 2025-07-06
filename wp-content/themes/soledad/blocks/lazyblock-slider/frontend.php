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