<?php
/**
 * @block-slug  :   lth-testimonials
 * @block-output:   lth_testimonials_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-testimonials/frontend_callback', 'lth_testimonials_output_fe', 10, 2);

if (!function_exists('lth_testimonials_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_testimonials_output_fe($output, $attributes) {
        ob_start();
?>   
<section class="lth-testimonials">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="module module_testimonials">
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
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="module module_testimonials">
                    <div class="module_content">
                        <div class="swiper-testimonials swiper">
                            <div class="swiper-wrapper">
                                <?php foreach( $attributes['items'] as $inner ): ?>
                                    <div class="swiper-slide item">
                                        <div class="content">
                                            <div class="content-image">
                                                <div class="image">
                                                    <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Icon" width="169" height="268">
                                                </div>
                                            </div>

                                            <div class="content-box">
                                                <div class="content-excerpt">
                                                    <?php echo wpautop($inner['item_description']); ?>
                                                </div>

                                                <div class="content-gallery">
                                                    <ul>
                                                        <?php foreach( $inner['item_gallery'] as $image ) {
                                                            if ( isset( $image['id'] ) ) { ?> 
                                                                <li>
                                                                    <a href="<?php echo esc_url( $image['url'] ); ?>" data-fancybox>
                                                                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="Image" width="200" height="149">
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } ?>                                                        
                                                    </ul>
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
    </div>
</section>
<?php
        return ob_get_clean();
    }
endif;
?>