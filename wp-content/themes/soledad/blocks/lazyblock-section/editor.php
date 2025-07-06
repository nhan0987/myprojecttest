<?php
/**
 * @block-slug  :   lth-section
 * @block-output:   lth__section_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-section/editor_callback', 'lth__section_output', 10, 2);

if (!function_exists('lth__section_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__section_output($output, $attributes) {
        ob_start();
?>
    <p></p>
<?php
        return ob_get_clean();
    }
endif;

?>