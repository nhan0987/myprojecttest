<?php
/**
 * @block-slug  :   lth-categories
 * @block-output:   lth__categories_output
 * @block-attributes: get from attributes.php
 */

// filter for Editor output.
add_filter('lazyblock/lth-categories/editor_callback', 'lth__categories_output', 10, 2);

if (!function_exists('lth__categories_output')) :
    /**
     * Editor Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth__categories_output($output, $attributes) {
        ob_start();
        $title = !empty($attributes['title']) ? esc_html($attributes['title']) : 'Categories';
        $style = isset($attributes['categories_style']) ? esc_html($attributes['categories_style']) : 'list-01';
        $items_count = isset($attributes['items']) ? count($attributes['items']) : 0;
?>
    <div style="padding: 25px; border: 2px dashed #b5dbff; background: #f0f8ff; text-align: center; border-radius: 8px;">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:inline-block; margin-bottom: 10px;">
             <path d="M3 7C3 5.89543 3.89543 5 5 5H9.58579C9.851 5 10.1054 5.10536 10.2929 5.29289L12.7071 7.70711C12.8946 7.89464 13.149 8 13.4142 8H19C20.1046 8 21 8.89543 21 10V17C21 18.1046 20.1046 19 19 19H5C3.89543 19 3 18.1046 3 17V7Z" stroke="#0071a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h3 style="margin: 0 0 10px 0; color: #0071a1; font-size: 18px; font-weight: bold;">[Block: <?php echo $title; ?>]</h3>
        <p style="margin: 0; color: #555;">Hiển thị danh sách <strong><?php echo $items_count; ?></strong> chuyên mục (Giao diện: <strong><?php echo $style; ?></strong>).</p>
        <p style="margin: 5px 0 0 0; font-size: 12px; font-style: italic; color: #888;">* Giao diện thật chỉ hoạt động khi xem ở trang ngoài (Frontend).</p>
    </div>
<?php
        return ob_get_clean();
    }
endif;

?>