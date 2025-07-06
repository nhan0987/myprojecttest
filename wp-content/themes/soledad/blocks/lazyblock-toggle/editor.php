<?php
/**
 * @block-slug  :   lth-toggle
 * @block-output:   lth__toggle_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-toggle/editor_callback', 'lth__toggle_output', 10, 2);

if (!function_exists('lth__toggle_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__toggle_output($output, $attributes) {
        ob_start();
?>
    
    <?php foreach( $attributes['toggle'] as $inner ): ?>
        <?php if (isset($inner['title'])) : ?>
            <p style="font-size: 12px; padding-top: 10px; padding-left: 35px; margin: 0;"><strong><?php echo esc_html($inner['item_title']); ?></strong></p>
        <?php endif; ?>
    <?php endforeach; ?>

<?php
        return ob_get_clean();
    }
endif;

?>