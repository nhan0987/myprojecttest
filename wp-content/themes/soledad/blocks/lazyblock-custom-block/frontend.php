<?php

/**
 * @block-slug  :   lth-custom-block
 * @block-output:   lth_custom_block_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-custom-block/frontend_callback', 'lth_custom_block_output_fe', 10, 2);

if (!function_exists('lth_custom_block_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_custom_block_output_fe($output, $attributes) {
        ob_start();
?>
    <section class="lth-custom-block <?php echo $attributes['class']; ?>">
        <div class="module module_custom-block">
            <div class="module_content">
                <div class="content">
                    <?php
                    $page_id = isset($attributes['Page']) ? $attributes['Page'] : '';
                    if ($page_id) {
                        $page = get_post($page_id);
                        if ($page) {
                            echo '<h2>' . esc_html($page->post_title) . '</h2>';
                            echo '<div>' . apply_filters('the_content', $page->post_content) . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
        return ob_get_clean();
    }
endif;
?>