<?php
/**
 * @block-slug  :   lth-search
 * @block-output:   lth__search_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-search/editor_callback', 'lth__search_output', 10, 2);

if (!function_exists('lth__search_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__search_output($output, $attributes) {
        ob_start();
?>
    
    

<?php
        return ob_get_clean();
    }
endif;

?>