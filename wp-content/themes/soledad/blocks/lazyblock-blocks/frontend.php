<?php
/**
 * @block-slug  :   lth-blocks
 * @block-output:   lth_blocks_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-blocks/frontend_callback', 'lth_blocks_output_fe', 10, 2);

if (!function_exists('lth_blocks_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_blocks_output_fe($output, $attributes) {
        ob_start();
?>
    <!-- echo $attributes['control_name']; -->

    <?php echo $attributes['text']; ?>
    <br>
    <?php echo $attributes['text-area']; ?>
    <br>
    <?php echo $attributes['number']; ?>
    <br>
    <?php echo $attributes['range']; ?>
    <br>
    <?php echo esc_url( $attributes['url'] ); ?>
    <br>
    <?php echo $attributes['email']; ?>
    <br>
    <?php echo $attributes['password']; ?>
    <br>
    <?php echo esc_url( $attributes['image']['url'] ); ?>
    <br>
    <?php //foreach( $attributes['gallery'] as $image ) {
        // if ( isset( $image['id'] ) ) {
        //     echo esc_url( $image['url'] );
        // }
    //} ?>
    <br>
    <?php echo esc_url( $attributes['file']['url'] ); ?>
    <br>
    <?php echo $attributes['rich-text']; ?>
    <br>
    <?php echo $attributes['classic-editor']; ?>
    <br>
    <?php echo $attributes['code-editor']; ?>
    <br>
    <div class="inner-blocks">
        <?php echo $attributes['inner-blocks']; ?>
    </div>
    <br>
    <?php echo $attributes['select']; ?>
    <br>
    <?php echo $attributes['radio']; ?>
    <br>
    <?php if ( $attributes['checkbox'] ) : ?>
        <p>The value is True</p>
    <?php else: ?>
        <p>The value is False</p>
    <?php endif; ?>
    <br>
    <?php if ( $attributes['toggle'] ) : ?>
        <p>The value is True</p>
    <?php else: ?>
        <p>The value is False</p>
    <?php endif; ?>
    <br>
    <?php echo $attributes['color']; ?>
    <br>
    <?php echo date_i18n( 'F j, Y H:i', strtotime( $attributes['date-time'] ) ); ?>
    <br>
    <?php foreach( $attributes['repeater'] as $inner ): ?>
        <p><?php echo $inner['repeater-text']; ?></p>
    <?php endforeach; ?>

    <!-- ////////////////////////// -->

cat
    <?php echo $attributes['product_cat']; ?>
    <br>
    <?php echo $attributes['html_block']; ?>
<?php
        return ob_get_clean();
    }
endif;
?>