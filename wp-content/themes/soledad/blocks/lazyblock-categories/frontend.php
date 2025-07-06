<?php

/**
 * @block-slug  :   lth-categories
 * @block-output:   lth_categories_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-categories/frontend_callback', 'lth_categories_output_fe', 10, 2);

if (!function_exists('lth_categories_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_categories_output_fe($output, $attributes) {
        ob_start();
?>
    <section class="lth-categories">
        <div class="module module_categories">
            <?php if ($attributes['title'] || $attributes['description'] || $attributes['categories']) : ?>
                <div class="module_header title-box">
                    <?php if (isset($attributes['title'])) : ?>
                        <h2 class="title">
                            <?php if ($attributes['url']) : ?> 
                                <a href="<?php echo esc_url($attributes['url']); ?>" title="">
                            <?php endif; ?>
                                <?php echo wpautop(esc_html($attributes['title'])); ?>
                            <?php if ($attributes['url']) : ?> 
                                </a>
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
                        <?php foreach( $attributes['items'] as $inner ) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="item">
                                    <div class="content">
                                        <div class="content-header">
                                            <div class="content-image">
                                                <a href="<?php echo get_category_link($inner['item']); ?>">
                                                    <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="<?php echo $inner['item_title']; ?>">
                                                </a>
                                            </div>
                                            <div class="content-box">
                                                <div class="content-excerpt">
                                                    <?php echo wpautop($inner['item_text']); ?>
                                                </div>
                                                <h3 class="content-name">
                                                    <a href="<?php echo get_category_link($inner['item']); ?>">
                                                        <?php echo wpautop($inner['item_title']); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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