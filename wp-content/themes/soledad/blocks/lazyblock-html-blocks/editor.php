<?php
/**
 * @block-slug  :   lth-html-blocks
 * @block-output:   lth_html_blocks_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-html-blocks/editor_callback', 'lth_html_blocks_output', 10, 2);

if (!function_exists('lth_html_blocks_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_html_blocks_output($output, $attributes) {
        ob_start();
?>
    <?php
    if ($attributes['url_html_blogs']) {
            $fullsidebar = $attributes['url_html_blogs'];
            $explode_fullsidebar = explode('/', $fullsidebar);
            $last_sidebar = $explode_fullsidebar[count($explode_fullsidebar) - 2];
            $args = new WP_Query(array(
                'post_type'      => 'html-blocks',
                'posts_per_page' => 1,
                'name'  => $last_sidebar,
            ));
        ?>

        <?php while ($args->have_posts()) : $args->the_post(); ?>            
            <p style="font-size: 12px; padding-top: 10px; padding-left: 35px; margin: 0;"><strong><?php the_title(); ?></strong></p>
        <?php endwhile; wp_reset_query();
    } ?>
<?php
        return ob_get_clean();
    }
endif;

?>