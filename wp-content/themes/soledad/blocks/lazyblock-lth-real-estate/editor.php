<?php
/**
 * @block-slug  :   lth-real-estate
 * @block-output:   lth__real_estate_editor_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-real-estate/editor_callback', 'lth__real_estate_editor_output', 10, 2);

if (!function_exists('lth__real_estate_editor_output')) :
    /**
     * Editor Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__real_estate_editor_output($output, $attributes) {
        ob_start();
        $title = isset($attributes['title']) ? esc_html($attributes['title']) : 'Bất Động Sản';
        $post_number = isset($attributes['post_number']) ? intval($attributes['post_number']) : 10;
?>
    <div style="padding: 25px; border: 2px dashed #b5dbff; background: #f0f8ff; text-align: center; border-radius: 8px;">
        <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#0071a1" style="display:inline-block; margin-bottom: 10px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <h3 style="margin: 0 0 10px 0; color: #0071a1; font-size: 18px; font-weight: bold;">[Block: <?php echo $title; ?>]</h3>
        <p style="margin: 0; color: #555;">Hiển thị khung danh sách tối đa <strong><?php echo $post_number; ?></strong> Bất động sản mới nhất.</p>
        <p style="margin: 5px 0 0 0; font-size: 12px; font-style: italic; color: #888;">* Giao diện thật và chức năng lọc tab chỉ hoạt động khi bạn xuất bản bài viết và xem ở trang ngoài (Frontend).</p>
    </div>
<?php
        return ob_get_clean();
    }
endif;
?>
