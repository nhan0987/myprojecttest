<?php
/**
 * @block-slug  :   lth-slider
 * @block-output:   lth__slider_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-slider/editor_callback', 'lth__slider_output', 10, 2);

if (!function_exists('lth__slider_output')) :
    /**
     * Editor Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__slider_output($output, $attributes) {
        ob_start();
        $style = isset($attributes['display_style']) ? esc_html($attributes['display_style']) : 'style_01';
        $items_count = isset($attributes['items']) ? count($attributes['items']) : 0;
?>
    <div style="padding: 25px; border: 2px dashed #b5dbff; background: #f0f8ff; text-align: center; border-radius: 8px;">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:inline-block; margin-bottom: 10px;">
            <path d="M4 16L8.58579 11.4142C9.36684 10.6332 10.6332 10.6332 11.4142 11.4142L16 16M14 14L15.5858 12.4142C16.3668 11.6332 17.6332 11.6332 18.4142 12.4142L20 14M14 8H14.01M6 20H18C19.1046 20 20 19.1046 20 18V6C20 4.89543 19.1046 4 18 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20Z" stroke="#0071a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h3 style="margin: 0 0 10px 0; color: #0071a1; font-size: 18px; font-weight: bold;">[Block: SLIDER]</h3>
        <p style="margin: 0; color: #555;">Trình chiếu hình ảnh gồm <strong><?php echo $items_count; ?></strong> ảnh (Giao diện: <strong><?php echo $style; ?></strong>).</p>
        <p style="margin: 5px 0 0 0; font-size: 12px; font-style: italic; color: #888;">* Giao diện thật và chuyển động slide chỉ hiển thị ở ngoài trang chủ (Frontend).</p>
    </div>
<?php
        return ob_get_clean();
    }
endif;

?>