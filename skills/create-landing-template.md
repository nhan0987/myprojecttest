# Quy trình tạo Landing Page Template (Hinode Park Pattern)

Tài liệu này mô tả quy trình chuẩn để tạo một trang Landing Page chuyên biệt trong WordPress (dựa trên theme Soledad) mà không bị ảnh hưởng bởi CSS/JS mặc định của theme.

## 1. Tạo File Template PHP
Tạo file `template-[project-name].php` trong thư mục gốc của theme.

```php
<?php
/**
 * Template Name: [Project Name]
 * 
 * Mô tả: Landing page template cao cấp cho [Project Name].
 */

$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
    add_action('wp_enqueue_scripts', function() {
        // 1. Enqueue Google Fonts
        wp_enqueue_style('project-fonts', 'URL_GOOGLE_FONTS', array(), null);
        
        // 2. Enqueue Custom CSS & JS
        wp_enqueue_style('project-style', get_template_directory_uri() . '/css/[project-name].css', array(), '1.0.0');
        wp_enqueue_script('project-script', get_template_directory_uri() . '/js/[project-name].js', array('jquery'), '1.0.0', true);
    });
    wp_head(); 
    ?>
</head>
<body <?php body_class(); ?>>
    <!-- Nội dung HTML ở đây -->
    <?php wp_footer(); ?>
</body>
</html>
```

## 2. Quản lý CSS riêng biệt
- Tạo file `css/[project-name].css`.
- Sử dụng biến CSS (`:root`) để quản lý màu sắc thương hiệu.
- Đảm bảo tất cả các style là cô lập, tránh dùng các class quá chung chung có thể bị theme ghi đè.
- **Tách CSS nội tuyến**: Chuyển toàn bộ các khối `<style>...</style>` và các thuộc tính `style="..."` (inline CSS) ra file CSS độc lập bằng cách tạo class/thuộc tính data tương ứng để giữ HTML sạch sẽ.

## 2.5. Quản lý JS riêng biệt
- Tạo file `js/[project-name].js`.
- **Tách JS triệt để**: Chuyển toàn bộ mã JavaScript nội tuyến (`<script>...</script>`) từ file HTML gốc sang file JS riêng biệt.
- **Lưu ý ngoại lệ**: Các mã theo dõi (Tracking scripts) như Google Tag Manager (GTM) hoặc Facebook Pixel vẫn có thể giữ lại trong file HTML/PHP để đảm bảo tương thích và dễ quản lý việc cấu hình biến trực tiếp nếu cần.

## 3. Gỡ bỏ tài nguyên mặc định của Theme (Quan trọng)
Để Landing Page hoàn toàn sạch, cần dequeue các asset của theme trong `functions.php`.

```php
/**
 * Dequeue theme assets for specific landing page template
 */
add_action('wp_enqueue_scripts', 'dequeue_assets_for_landing_page', 9999);
function dequeue_assets_for_landing_page() {
    if (is_page_template('template-[project-name].php')) {
        // Danh sách các handle CSS/JS cần gỡ bỏ
        $handles = array(
            'penci-main-style',
            'penci_style',
            'bootstrap',
            // ... các handle khác
        );

        foreach ($handles as $handle) {
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
            wp_dequeue_script($handle);
            wp_deregister_script($handle);
        }
    }
}
```

## 4. Quản lý hình ảnh và Tài nguyên
- **Quy trình thu thập ảnh**:
    - Tải các hình ảnh từ link Figma hoặc file HTML nguồn về máy.
    - Chuyển đổi định dạng sang `.webp` và nén ảnh (TinyPNG hoặc tương đương) để tối ưu hiệu suất.
- **Tổ chức thư mục**:
    - Tạo thư mục con riêng biệt cho từng dự án bên trong thư mục `images` của theme để tránh nhầm lẫn tài nguyên.
    - Cấu trúc: `wp-content/themes/soledad/images/[project-name]/`.
    - Ví dụ: `/images/noble-palace/`, `/images/hinode-park/`.
- **Cách gọi ảnh trong Template**:
    - Luôn sử dụng đường dẫn động: `<?php echo get_template_directory_uri(); ?>/images/[project-name]/[file-name].webp`.
    - Tránh hardcode đường dẫn tuyệt đối hoặc sử dụng link trực tiếp từ Figma.

## 5. Các Section chuẩn của một Landing Bất động sản
- **Hero**: Banner chính, tiêu đề lớn, nút Call to Action (CTA).
- **Overview**: Thông tin tổng quan dự án.
- **Location**: Bản đồ và các điểm kết nối (Metro, trường học...).
- **Policy**: Chính sách bán hàng, chiết khấu.
- **Floorplan**: Mặt bằng căn hộ (thường có Tabs chuyển đổi).
- **Amenities**: Hệ thống tiện ích.
- **FAQ**: Giải đáp thắc mắc.
- **CTA Form**: Form đăng ký tư vấn.
