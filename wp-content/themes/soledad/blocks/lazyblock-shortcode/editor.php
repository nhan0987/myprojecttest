<?php
/**
 * @block-slug  :   lth-shortcode
 * @block-output:   lth__shortcode_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-shortcode/editor_callback', 'lth__shortcode_output', 10, 2);

if (!function_exists('lth__shortcode_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__shortcode_output($output, $attributes) {
        ob_start();
?>
    
<?php
        return ob_get_clean();
    }
endif;

?>