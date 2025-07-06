<?php

/**
 * @block-slug  :   lth-button
 * @block-output:   lth_button_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-button/frontend_callback', 'lth_button_output_fe', 10, 2);

if (!function_exists('lth_button_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_button_output_fe($output, $attributes) {
        ob_start();
?>

    
    <div class="module_footer module_button <?php echo $attributes['style']; ?>">
        <ul>
            <?php foreach( $attributes['items'] as $inner ): ?>
                <li>
                    <a href="<?php echo esc_url($inner['button_url']); ?>" title="" class="btn">
                        <?php echo wpautop(esc_html($inner['button_text'])); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    

<?php
        return ob_get_clean();
    }
endif;
?>