<?php
/**
 * @block-slug  :   lth-features
 * @block-output:   lth__features_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-features/editor_callback', 'lth__features_output', 10, 2);

if (!function_exists('lth__features_output')) :
    /**
     * Editor Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__features_output($output, $attributes) {
        ob_start();
        $title = !empty($attributes['title']) ? esc_html($attributes['title']) : 'Features';
        $style = isset($attributes['features_style']) ? esc_html($attributes['features_style']) : 'style-01';
        $items_count = isset($attributes['items']) ? count($attributes['items']) : 0;
?>
    <div style="padding: 25px; border: 2px dashed #b5dbff; background: #f0f8ff; text-align: center; border-radius: 8px;">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:inline-block; margin-bottom: 10px;">
            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#0071a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h3 style="margin: 0 0 10px 0; color: #0071a1; font-size: 18px; font-weight: bold;">[Block: <?php echo $title; ?>]</h3>
        <p style="margin: 0; color: #555;">Hiển thị <strong><?php echo $items_count; ?></strong> đặc điểm/tính năng (Giao diện: <strong><?php echo $style; ?></strong>).</p>
        <p style="margin: 5px 0 0 0; font-size: 12px; font-style: italic; color: #888;">* Giao diện thật chỉ hiển thị ở ngoài trang chủ (Frontend).</p>
    </div>
<?php
        return ob_get_clean();
    }
endif;

?>