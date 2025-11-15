<?php
/**
 * @block-slug  :   lth-brand
 * @block-output:   lth_brand_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-brand/frontend_callback', 'lth_brand_output_fe', 10, 2);

if (!function_exists('lth_brand_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_brand_output_fe($output, $attributes) {
        ob_start();
?>  
<section class="lth-brands">
    <!-- <div class="container">         -->
        <div class="module module_brands">
            <?php if ($attributes['title'] || $attributes['description']) : ?>
                <div class="module_header title-box">
                    <?php if (isset($attributes['title'])) : ?>
                        <h2 class="title">
                            <?php if ($attributes['url']) : ?> 
                                <a href="<?php echo esc_url($attributes['url']); ?>" title="">
                            <?php else : ?>
                                <span>
                            <?php endif; ?>
                                <?php echo wpautop(esc_html($attributes['title'])); ?>
                            <?php if ($attributes['url']) : ?> 
                                </a>
                            <?php else : ?>
                                </span>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($attributes['description']) : ?>
                        <div class="infor">
                            <?php echo wpautop(esc_html($attributes['description'])); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="module_content">
                <div class="swiper-brands swiper">
                    <div class="swiper-wrapper">
                        <?php foreach( $attributes['brand'] as $inner ): ?>
                            <div class="swiper-slide item">
                                <div class="content">
                                    <div class="content-image">
                                        <a href="<?php echo esc_url( $inner['url'] ); ?>" title="" class="image">
                                            <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Icon" width="191" height="88">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- <div class="swiper-button-next swiper-arrow swiper-next"></div>
                    <div class="swiper-button-prev swiper-arrow swiper-prev"></div> -->

                    <div class="swiper-pagination"></div>
                </div> 
            </div>
        </div>
    <!-- </div> -->
</section>
<?php
        return ob_get_clean();
    }
endif;
?>