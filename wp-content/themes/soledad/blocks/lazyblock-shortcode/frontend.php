<?php

/**
 * @block-slug  :   lth-shortcode
 * @block-output:   lth_shortcode_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-shortcode/frontend_callback', 'lth_shortcode_output_fe', 10, 2);

if (!function_exists('lth_shortcode_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_shortcode_output_fe($output, $attributes) {
        ob_start();
?>

    <div class="entry-content lth-shortcode">
        <?php echo do_shortcode($attributes['shortcode']); ?>
    </div>

<?php
        return ob_get_clean();
    }
endif;
?>