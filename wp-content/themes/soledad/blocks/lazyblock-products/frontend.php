<?php

/**
 * @block-slug  :   lth-products
 * @block-output:   lth_products_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-products/frontend_callback', 'lth_products_output_fe', 10, 2);

if (!function_exists('lth_products_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_products_output_fe($output, $attributes) {
        ob_start();
?>
<article class="lth-products">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="module module_products">
                    <?php if ($attributes['title'] || $attributes['description']) : ?>
                        <div class="module_header title-box">
                            <?php if (isset($attributes['title'])) : ?>
                                <h3 class="title">
                                    <?php if ($attributes['url']) : ?> 
                                        <a href="<?php echo esc_url($attributes['url']); ?>" title="">
                                    <?php else : ?>
                                        <span>
                                    <?php endif; ?>
                                        <?php echo esc_html($attributes['title']); ?>
                                    <?php if ($attributes['url']) : ?> 
                                        </a>
                                    <?php else : ?>
                                        </span>
                                    <?php endif; ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($attributes['description']) : ?>
                                <div class="infor">
                                    <?php echo esc_html($attributes['description']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                        $i = 0;
                        foreach( $attributes['categories'] as $inner ) {
                            $i++;
                            if ($i == '1') {
                                $cat = $inner['category'];
                            }
                        }

                        if ($cat) {
                            $args = [
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'name',
                                        'terms'    => $cat,
                                    ),
                                ),
                                'posts_per_page' => $attributes['post_number'],
                                'orderby' => $attributes['orderby'],
                                'order' => $attributes['order'],
                            ];
                        } else {
                            $args = [
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => $attributes['post_number'],
                                'orderby' => $attributes['orderby'],
                                'order' => $attributes['order'],
                            ];
                        }
                        $wp_query = new WP_Query($args);
                        if ($wp_query->have_posts()) { ?>
                            <div class="slick-slider slick-products-2">
                                <?php while ($wp_query->have_posts()) {
                                    $wp_query-> the_post(); ?>                                
                                    <?php //load file tương ứng với post format
                                    get_template_part('woocommerce/product-box/product-box', ''); ?>
                                <?php } ?>
                            </div>
                        <?php } else {
                            get_template_part('template-parts/content', 'none');
                        }
                        // reset post data
                        wp_reset_postdata();
                    ?>

                    <?php if ($attributes['url_text']) : ?>
                        <div class="module_button">
                            <a href="<?php echo esc_url($attributes['url']); ?>">
                                <?php echo $attributes['url_text']; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
        return ob_get_clean();
    }
endif;
?>