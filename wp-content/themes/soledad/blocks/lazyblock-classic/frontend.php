<?php

/**
 * @block-slug  :   lth-classic
 * @block-output:   lth_classic_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-classic/frontend_callback', 'lth_classic_output_fe', 10, 2);

if (!function_exists('lth_classic_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_classic_output_fe($output, $attributes) {
        ob_start();
?>

    <div class="entry-content lth-classic">
        <?php echo $attributes['classic']; ?>
    </div>

<?php
        return ob_get_clean();
    }
endif;
?>