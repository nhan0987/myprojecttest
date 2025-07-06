<?php
/**
 * @block-slug  :   lth-gallery
 * @block-output:   lth_gallery_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-gallery/frontend_callback', 'lth_gallery_output_fe', 10, 2);

if (!function_exists('lth_gallery_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_gallery_output_fe($output, $attributes) {
        ob_start();
?>    
    <section class="lth-galleries">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="module module_galleries">
                        <ul class="list-galleries">
                            <?php $i = 0;
                            foreach( $attributes['gallery'] as $inner ): ?>
                                <li>
                                    <div class="items">
                                        <a href="<?php echo esc_url( $inner['image']['url'] ); ?>" title="">
                                            <img src="<?php echo esc_url( $inner['image']['url'] ); ?>" alt="Image" width="" height="">
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>        
    </section>
<?php
        return ob_get_clean();
    }
endif;
?>