<?php
/**
 * @block-slug  :   lth-html-blocks
 * @block-output:   lth_html_blocks_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-html-blocks/frontend_callback', 'lth_html_blocks_output_fe', 10, 2);

if (!function_exists('lth_html_blocks_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_html_blocks_output_fe($output, $attributes) {
        ob_start();
?>
    <?php
        $fullsidebar = $attributes['url_html_blogs'];
        $explode_fullsidebar = explode('/', $fullsidebar);
        $last_sidebar = $explode_fullsidebar[count($explode_fullsidebar) - 2];
        $args = new WP_Query(array(
            'post_type'      => 'html-blocks',
            'posts_per_page' => 1,
            'name'  => $last_sidebar,
        ));
    ?>

    <?php while ($args->have_posts()) : $args->the_post();
        the_content();
    endwhile; wp_reset_query(); ?>
<?php
        return ob_get_clean();
    }
endif;
?>