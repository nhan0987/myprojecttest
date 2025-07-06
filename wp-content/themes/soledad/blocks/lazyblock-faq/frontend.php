<?php

/**
 * @block-slug  :   lth-faq
 * @block-output:   lth_faq_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-faq/frontend_callback', 'lth_faq_output_fe', 10, 2);

if (!function_exists('lth_faq_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_faq_output_fe($output, $attributes) {
        ob_start();
?>

<article class="lth-faqs">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="module module_faqs">
                    <?php if ($attributes['title'] || $attributes['description'] || $attributes['categories']) : ?>
                        <div class="module_header title-box">
                            <?php if (isset($attributes['title'])) : ?>
                                <h2 class="title">
                                    <?php if ($attributes['url']) : ?> 
                                        <a href="<?php echo esc_url($attributes['url']); ?>" title="">
                                    <?php else : ?>
                                        <span>
                                    <?php endif; ?>
                                        <?php echo wpautop(esc_html($attributes['title'])); ?>
                                    <?php if ($attributes['url']) : ?> 
                                        </a>
                                    <?php else : ?>
                                        </span>
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

                    <div class="list-faqs">
                        <?php foreach( $attributes['faq'] as $inner ): ?>
                            <?php if ($inner['faq_title']) { ?>
                                <div class="items">
                                    <h3 class="title">- <?php echo $inner['faq_title']; ?></h3>
                                    <div class="content">
                                        <?php echo wpautop($inner['faq_content']); ?>
                                        <?php if ($inner['faq_url_text']) { ?>
                                            <a href="<?php echo esc_url($attributes['faq_url']); ?>" class="btn"><?php echo $inner['faq_url_text']; ?> -></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<?php
        return ob_get_clean();
    }
endif;
?>