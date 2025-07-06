<?php

/**
 * @block-slug  :   lth-shopcart
 * @block-output:   lth_shopcart_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-shopcart/frontend_callback', 'lth_shopcart_output_fe', 10, 2);

if (!function_exists('lth_shopcart_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_shopcart_output_fe($output, $attributes) {        
        ob_start();
?>
<?php if ( class_exists( 'WooCommerce' ) ) { ?>
    <div class="lth-shopcart">
        <div class="cart-header clearfix">
            <?php global $woocommerce; ?>
            <?php require_once(get_template_directory() . '/woocommerce/cart/header-cart-ajax.php'); ?>
        </div>
    </div>
<?php } ?>
<?php
        return ob_get_clean();
    }
endif;
?>