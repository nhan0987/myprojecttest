<?php
/**
 * @block-slug  :   lth-blogs
 * @block-output:   lth__blogs_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-blogs/editor_callback', 'lth__blogs_output', 10, 2);

if (!function_exists('lth__blogs_output')) :
    /**
     * Editor Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__blogs_output($output, $attributes) {
        ob_start();
        $title = !empty($attributes['title']) ? esc_html($attributes['title']) : 'Blogs';
        $post_number = isset($attributes['post_number']) ? intval($attributes['post_number']) : 5;
        $post_style = isset($attributes['post_style']) ? esc_html($attributes['post_style']) : 'list';
?>
    <div style="padding: 25px; border: 2px dashed #b5dbff; background: #f0f8ff; text-align: center; border-radius: 8px;">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:inline-block; margin-bottom: 10px;">
            <rect opacity="0.25" width="15" height="15" rx="4" transform="matrix(-1 0 0 1 22 7)" fill="#0071a1" />
            <rect width="15" height="15" rx="4" transform="matrix(-1 0 0 1 17 2)" fill="#0071a1" />
        </svg>
        <h3 style="margin: 0 0 10px 0; color: #0071a1; font-size: 18px; font-weight: bold;">[Block: <?php echo $title; ?>]</h3>
        <p style="margin: 0; color: #555;">Hiển thị danh sách tối đa <strong><?php echo $post_number; ?></strong> bài viết mới nhất (Giao diện: <strong><?php echo $post_style; ?></strong>).</p>
        <p style="margin: 5px 0 0 0; font-size: 12px; font-style: italic; color: #888;">* Giao diện thật chỉ hoạt động khi xem ở trang ngoài (Frontend).</p>
    </div>
<?php
        return ob_get_clean();
    }
endif;

?>