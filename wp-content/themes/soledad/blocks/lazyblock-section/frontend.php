<?php

/**
 * @block-slug  :   lth-section
 * @block-output:   lth_section_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-section/frontend_callback', 'lth_section_output_fe', 10, 2);

if (!function_exists('lth_section_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_section_output_fe($output, $attributes) {
        ob_start();

    if ($attributes['background_image']) {
        $background = 'background: url('.$attributes['background_image']['url'].') no-repeat center; background-size: 100% 100%;';
    } elseif ($attributes['background_color']) {
        $background = 'background-color: '.$attributes['background_color'].';';
    }
    if ($attributes['margin_top']) {
        $margin_top = 'margin-top: '.$attributes['margin_top'].'px;';
    } else {
        $margin_top = 'margin-top: 0 !important;';
    }
    if ($attributes['margin_bottom']) {
        $margin_bottom = 'margin-bottom: '.$attributes['margin_bottom'].'px;';
    } else {
        $margin_bottom = 'margin-bottom: 0 !important;';
    }
    if ($attributes['padding_top']) {
        $padding_top = 'padding-top: '.$attributes['padding_top'].'px;';
    } else {
        $padding_top = 'padding-top: 0 !important;';
    }
    if ($attributes['padding_bottom']) {
        $padding_bottom = 'padding-bottom: '.$attributes['padding_bottom'].'px;';
    } else {
        $padding_bottom = 'padding-bottom: 0 !important;';
    }
    if ($attributes['text_color']) {
        $text = 'color: '.$attributes['text_color'].';';
    }
?>

    <section class="lth-section <?php echo $attributes['class']; ?>" style="<?php echo $margin_top; ?> <?php echo $margin_bottom; ?> <?php echo $padding_top; ?> <?php echo $padding_bottom; ?> <?php echo $background; ?> <?php echo $text; ?>">
        <?php if ( $attributes['full_width'] ) : ?>
            <div class="container-fluid">
        <?php else: ?>
            <div class="container">
        <?php endif; ?>
            <?php echo $attributes['section']; ?>
        </div>
    </section>

<?php
        return ob_get_clean();
    }
endif;
?>