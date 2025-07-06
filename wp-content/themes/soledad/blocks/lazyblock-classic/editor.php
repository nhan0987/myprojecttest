<?php
/**
 * @block-slug  :   lth-classic
 * @block-output:   lth__classic_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-classic/editor_callback', 'lth__classic_output', 10, 2);

if (!function_exists('lth__classic_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__classic_output($output, $attributes) {
        ob_start();
?>
    
<?php
        return ob_get_clean();
    }
endif;

?>