<?php

/**
 * @block-slug  :   lth-contact
 * @block-output:   lth_contact_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-contact/frontend_callback', 'lth_contact_output_fe', 10, 2);

if (!function_exists('lth_contact_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_contact_output_fe($output, $attributes) {
        ob_start();
?>
    <section class="content-contact__pages p-70s">
        <?php echo $attributes['map']; ?>
        <div class="container">
            <div class="intros-content__pages">
                <h2 class="titles-bold__alls fs-32s titles-bold__alls mb-10s">Liên hệ</h2>
                <p class="mb-10s"> <span class="titles-bold__alls"><?php echo __('Địa chỉ VP:'); ?></span> <?php echo $attributes['address']; ?></p>
                <ul class="details-intros__contacts mb-15s">
                    <li>
                        <img src="<?php echo ASSETS_URI; ?>/images/details-intros-icons-1.png" alt="">
                        <a href="#" title=""> <?php echo __('Hotline'); ?> : <?php echo $attributes['phone']; ?></a>
                    </li>
                    <li>
                        <img src="<?php echo ASSETS_URI; ?>/images/details-intros-icons-2.png" alt="">
                        <a href="#" title=""> <?php echo __('Email'); ?> : <?php echo $attributes['email']; ?></a>
                    </li>
                </ul>

                <div class="form-contacts__details">
                    <?php echo do_shortcode($attributes['form']); ?>
                </div>
            </div>
        </div>
    </section>

<?php
        return ob_get_clean();
    }
endif;
?>