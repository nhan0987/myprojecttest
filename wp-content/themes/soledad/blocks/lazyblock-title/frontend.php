<?php

/**
 * @block-slug  :   lth-title
 * @block-output:   lth_title_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-title/frontend_callback', 'lth_title_output_fe', 10, 2);

if (!function_exists('lth_title_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_title_output_fe($output, $attributes) {
        ob_start();

    $color_title = 'color: '.$attributes['color_title'];
    $color_description = 'color: '.$attributes['color_description'];
?>

    <?php if ($attributes['title'] || $attributes['description']) : ?>
        <div class="module_header title-box <?php echo $attributes['style']; ?>">
            <?php if (isset($attributes['title'])) : ?>
                <h2 class="title">
                    <?php if ($attributes['title_url']) : ?> 
                        <a href="<?php echo esc_url($attributes['title_url']); ?>" title="">
                    <?php endif; ?>
                        <?php echo wpautop(esc_html($attributes['title'])); ?>
                    <?php if ($attributes['title_url']) : ?> 
                        </a>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <?php if ($attributes['description']) : ?>
                <div class="infor">
                    <?php echo wpautop(esc_html($attributes['description'])); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php
        return ob_get_clean();
    }
endif;
?>