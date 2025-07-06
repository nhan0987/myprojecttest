<?php

/**
 * @block-slug  :   lth-logo
 * @block-output:   lth_logo_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-logo/frontend_callback', 'lth_logo_output_fe', 10, 2);

if (!function_exists('lth_logo_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_logo_output_fe($output, $attributes) {
        ob_start();

    $logo = get_field('logo', 'option');
    $w = get_field('width_logo', 'option');
    $h = get_field('height_logo', 'option');
?>
<div class="lth-logo">
    <?php if ($logo) { ?>
        <a href="<?php echo get_home_url( $lang ); ?>" title="">
            <img src="<?php echo lth_custom_logo('full', $w, $h); ?>" alt="<?php bloginfo('title'); ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>">
        </a>
    <?php } else { ?>
        <h2>
            <a href="<?php echo get_home_url( $lang ); ?>" title="" class="title"><?php bloginfo('title'); ?></a>
            <p><?php bloginfo('description'); ?></p>
        </h2>
    <?php } ?>
</div>
<?php
        return ob_get_clean();
    }
endif;
?>