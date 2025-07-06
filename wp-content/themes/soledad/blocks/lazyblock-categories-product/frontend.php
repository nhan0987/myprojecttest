<?php

/**
 * @block-slug  :   lth-categories-product
 * @block-output:   lth_categories_product_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-categories-product/frontend_callback', 'lth_categories_product_output_fe', 10, 2);

if (!function_exists('lth_categories_product_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_categories_product_output_fe($output, $attributes) {
        ob_start();
?>
    <section class="lth-categories">
        <div class="container">
            <div class="module module_categories_product">
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
                            <?php foreach( $attributes['items'] as $inner ) {
                                $cat_url = $inner['item_url'];
                                $cat_url_2 = explode('/', $cat_url);
                                $cat_slug = $cat_url_2[count($cat_url_2) - 2];
                                $cat = get_term_by( 'slug', $cat_slug, 'category'); ?>

                                <div class="item">
                                    <div class="border-dot">
                                        <div class="content category">
                                            <div class="content-header">
                                                <div class="content-image">
                                                    <a href="<?php echo $cat_url; ?>">
                                                        <img src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="<?php echo $inner['item_title']; ?>">
                                                    </a>
                                                </div>
                                                <div class="content-box">
                                                    <h3 class="content-name">
                                                        <a href="<?php echo $cat_url; ?>">
                                                            <?php echo wpautop($inner['item_title']); ?>
                                                        </a>
                                                    </h3>
                                                    <div class="content-excerpt">
                                                        <?php echo wpautop($inner['item_description']); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="content-footer">
                                                <a href="<?php echo $cat_url; ?>" title="" class="btn"><?php echo __('Xem thêm'); ?></a>
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