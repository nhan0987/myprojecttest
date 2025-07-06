<?php

/**
 * @block-slug  :   lth-toggle
 * @block-output:   lth_toggle_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-toggle/frontend_callback', 'lth_toggle_output_fe', 10, 2);

if (!function_exists('lth_toggle_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_toggle_output_fe($output, $attributes) {
        ob_start();
?>

<article class="lth-toggle">
    <div class="module module_toggle">
        <?php $i; foreach( $attributes['items'] as $inner ): $i++; ?>
            <div class="module_toggle_content <?php //if ($i == 1) {echo 'active';} ?>">
                <?php if ($inner['item_title'] || $inner['description']) : ?>
                    <div class="module_header title-box <?php echo $inner['item_title_style']; ?>">
                        <?php if (isset($inner['item_title'])) : ?>
                            <h2 class="title">
                                <?php if ($inner['url']) : ?> 
                                    <a href="<?php echo esc_url($inner['url']); ?>" title="">
                                <?php endif; ?>
                                    <?php echo wpautop(esc_html($inner['item_title'])); ?>
                                <?php if ($inner['url']) : ?> 
                                    </a>
                                <?php endif; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if ($inner['description']) : ?>
                            <div class="infor">
                                <?php echo wpautop(esc_html($inner['description'])); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="module_content">
                    <?php echo $inner['item_content']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</article>

<?php
        return ob_get_clean();
    }
endif;
?>