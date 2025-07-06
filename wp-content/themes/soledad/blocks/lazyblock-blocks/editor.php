<?php
/**
 * @block-slug  :   lth-blocks
 * @block-output:   lth__blocks_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-blocks/editor_callback', 'lth__blocks_output', 10, 2);

if (!function_exists('lth__blocks_output')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__blocks_output($output, $attributes) {
        ob_start();
?>
<div class="d-none">
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
    <?php foreach( $attributes['gallery'] as $image ) {
        if ( isset( $image['id'] ) ) {
            echo esc_url( $image['url'] );
        }
    } ?>
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
</div>
<?php
        return ob_get_clean();
    }
endif;

?>