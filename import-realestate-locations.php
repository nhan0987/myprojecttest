<?php
// Script nạp tự động nhanh danh mục Vị trí Bất động sản
// Load nhân WordPress Core
require_once dirname(__FILE__) . '/wp-load.php';

$taxonomy = 'property-location'; // Taxonomy chứa vị trí của bạn

// Dữ liệu mẫu phân cấp chuẩn (Cấp 1 là Thành phố, Cấp 2 là các Quận/Huyện trực thuộc)
$locations_data = [
    'Hà Nội' => [
        'Quận Đống Đa', 'Quận Long Biên', 'Quận Hoàn Kiếm', 'Quận Nam Từ Liêm', 'Quận Bắc Từ Liêm', 
        'Quận Hoàng Mai', 'Quận Hai Bà Trưng', 'Quận Thanh Xuân', 'Quận Ba Đình', 'Quận Tây Hồ', 
        'Quận Cầu Giấy', 'Quận Hà Đông', 'Huyện Thanh Trì', 'Huyện Gia Lâm', 'Huyện Đông Anh', 'Huyện Sóc Sơn', 'Huyện Hoài Đức'
    ],
    'Hồ Chí Minh' => [
        'Quận 1', 'Quận 3', 'Quận 4', 'Quận 5', 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 10', 'Quận 11', 'Quận 12',
        'Quận Tân Bình', 'Quận Bình Tân', 'Quận Bình Thạnh', 'Quận Tân Phú', 'Quận Gò Vấp', 'Quận Phú Nhuận', 
        'Thành phố Thủ Đức', 'Huyện Bình Chánh', 'Huyện Hóc Môn', 'Huyện Củ Chi', 'Huyện Nhà Bè'
    ]
];

$added_cities = 0;
$added_districts = 0;

foreach ($locations_data as $city => $districts) {
    // 1. Kiểm tra và thêm Thành phố (Parent = 0)
    $city_term = term_exists($city, $taxonomy);
    if ( ! $city_term ) {
        $city_term = wp_insert_term($city, $taxonomy);
        if ( ! is_wp_error($city_term) ) {
            $added_cities++;
        }
    }
    
    // Nếu có hoặc vừa tạo Thành phố thành công
    if ( ! is_wp_error($city_term) && isset($city_term['term_id']) ) {
        $parent_id = $city_term['term_id'];
        
        // 2. Chạy lặp kiểm tra và thêm các Quận/Huyện (Set Parent = ID Thành phố)
        foreach ($districts as $district) {
            $district_term = term_exists($district, $taxonomy);
            if ( ! $district_term ) {
                $inserted = wp_insert_term($district, $taxonomy, ['parent' => $parent_id]);
                if ( ! is_wp_error($inserted) ) {
                    $added_districts++;
                }
            }
        }
    }
}

echo "\nThanh cong! Da tiep nhan them:\n + $added_cities Tinh/Thanh pho\n + $added_districts Quan/Huyen\n\nXIN VUI LONG XOA SCRIPT NAY NGAY SAU KHI CHAY XONG DE DAM BAO BAO MAT!";
