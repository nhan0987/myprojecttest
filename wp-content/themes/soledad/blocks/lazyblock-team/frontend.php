<?php
/**
 * @block-slug  :   lth-team
 * @block-output:   lth_team_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-team/frontend_callback', 'lth_team_output_fe', 10, 2);

if (!function_exists('lth_team_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_team_output_fe($output, $attributes) {
        ob_start();
?>  
<section class="lth-team">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="module module_team">
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
                        <div>
                            <div class="row">
                                <?php foreach( $attributes['items'] as $inner ): ?>
                                    <div class="item">
                                        <div class="content">
                                            <div class="content-image">
                                                <div class="image">
                                                    <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Icon" width="357" height="377">
                                                </div>
                                            </div>

                                            <div class="content-box">
                                                <h3 class="content-name">
                                                    <?php echo wpautop($inner['item_title']); ?>
                                                </h3>
                                                <div class="content-excerpt">
                                                    <?php echo wpautop($inner['item_text']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="title-2">
                        <?php echo wpautop($attributes['title_2']); ?>
                    </div>

                    <div class="swiper-team swiper">
                        <div class="swiper-wrapper">
                            <?php foreach( $attributes['items_2'] as $inner ): ?>
                                <div class="swiper-slide item">
                                    <div class="content" style="background-color: <?php echo $inner['item_background']; ?>;">
                                        <div class="content-image">
                                            <div class="image">
                                                <img src="<?php echo esc_url( $inner['item_image_2']['url'] ); ?>" alt="Icon" width="169" height="268">
                                            </div>
                                        </div>

                                        <div class="content-box">
                                            <h3 class="content-name">
                                                <?php echo wpautop($inner['item_title_2']); ?>
                                            </h3>
                                            <div class="content-excerpt">
                                                <?php echo wpautop($inner['item_text_2']); ?>
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