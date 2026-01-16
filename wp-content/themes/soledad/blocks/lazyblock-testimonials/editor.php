<?php
/**
 * @block-slug  :   lth-testimonials
 * @block-output:   lth__testimonials_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-testimonials/editor_callback', 'lth__testimonials_output', 10, 2);

if (!function_exists('lth__testimonials_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__testimonials_output($output, $attributes) {
        ob_start();
?>
    <?php if (isset($attributes['title'])) : ?>
        <p style="font-size: 0.75rem; padding-top: 0.625rem; padding-left: 2.1875rem; margin: 0;"><strong><?php echo esc_html($attributes['title']); ?></strong></p>
    <?php endif; ?>
<?php
        return ob_get_clean();
    }
endif;

?>