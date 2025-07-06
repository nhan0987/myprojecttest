<?php
/**
 * @block-slug  :   lth-features
 * @block-output:   lth_features_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-features/frontend_callback', 'lth_features_output_fe', 10, 2);

if (!function_exists('lth_features_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_features_output_fe($output, $attributes) {
        ob_start();
?>  
<section class="lth-features">            
    <div class="module module_features">
        <?php if ($attributes['title'] || $attributes['description'] || $attributes['categories']) : ?>
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
            <div class="row">
                <?php foreach( $attributes['items'] as $inner ): ?>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="item">
                            <div class="content">
                                <div class="content-image">
                                    <div class="image">
                                        <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="Icon" width="100" height="100">
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
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php
        return ob_get_clean();
    }
endif;
?>