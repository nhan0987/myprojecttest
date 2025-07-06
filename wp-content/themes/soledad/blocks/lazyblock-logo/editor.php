<?php
/**
 * @block-slug  :   lth-logo
 * @block-output:   lth__logo_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-logo/editor_callback', 'lth__logo_output', 10, 2);

if (!function_exists('lth__logo_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__logo_output($output, $attributes) {
        ob_start();
?>
    
    

<?php
        return ob_get_clean();
    }
endif;

?>