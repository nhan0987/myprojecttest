<?php
/**
 * @block-slug  :   lth-custom-block
 * @block-output:   lth__custom_block_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-custom-block/editor_callback', 'lth__custom_block_output', 10, 2);

if (!function_exists('lth__custom_block_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__custom_block_output($output, $attributes) {
        ob_start();
?>
    <div style="font-size: 12px; padding-top: 10px; padding-left: 35px; margin: 0;">
        <strong>Custom Block</strong>
        <?php
        $page_id = isset($attributes['Page']) ? $attributes['Page'] : '';
        if ($page_id) {
            $page = get_post($page_id);
            if ($page) {
                echo '<p>Page: ' . esc_html($page->post_title) . '</p>';
            }
        } else {
            echo '<p>Please select a page.</p>';
        }
        ?>
    </div>
<?php
        return ob_get_clean();
    }
endif;

?>