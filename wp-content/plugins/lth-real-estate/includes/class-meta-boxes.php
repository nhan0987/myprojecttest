<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LTH_Real_Estate_Meta_Boxes {

    public function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'add_real_estate_meta_boxes' ] );
        add_action( 'save_post_real_estate', [ $this, 'save_real_estate_meta_boxes' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
    }

    public function add_real_estate_meta_boxes() {
        add_meta_box(
            'lth_real_estate_details',
            'Thông số Bất động sản',
            [ $this, 'render_meta_box_html' ],
            'real_estate',
            'normal', // Hiển thị phía dưới nội dung chuẩn
            'high'
        );
    }

    public function enqueue_admin_scripts( $hook ) {
        global $post;
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            if ( isset( $post ) && 'real_estate' === $post->post_type ) {
                wp_enqueue_media(); // Require script cho Gallery Loader
                
                // Enqueue custom CSS
                wp_enqueue_style( 
                    'lth-real-estate-admin-meta', 
                    LTH_REAL_ESTATE_URL . 'assets/css/admin-meta-boxes.css', 
                    [], 
                    LTH_REAL_ESTATE_VERSION 
                );

                // Enqueue custom JS
                wp_enqueue_script( 
                    'lth-real-estate-admin-meta', 
                    LTH_REAL_ESTATE_URL . 'assets/js/admin-meta-boxes.js', 
                    [ 'jquery' ], 
                    LTH_REAL_ESTATE_VERSION, 
                    true 
                );
            }
        }
    }

    public function render_meta_box_html( $post ) {
        wp_nonce_field( 'lth_real_estate_save_data', 'lth_real_estate_meta_nonce' );

        // Get saved data
        $price = get_post_meta( $post->ID, 'price', true );
        $currency = get_post_meta( $post->ID, 'currency', true );
        $area = get_post_meta( $post->ID, 'area', true );
        $address_street = get_post_meta( $post->ID, 'address_street', true );

        $num_bedrooms = get_post_meta( $post->ID, 'num_bedrooms', true );
        $num_bathrooms = get_post_meta( $post->ID, 'num_bathrooms', true );
        $num_floors = get_post_meta( $post->ID, 'num_floors', true );
        
        $house_direction = get_post_meta( $post->ID, 'house_direction', true );
        $balcony_direction = get_post_meta( $post->ID, 'balcony_direction', true );
        $entrance_width_m = get_post_meta( $post->ID, 'entrance_width_m', true );
        $frontage_width_m = get_post_meta( $post->ID, 'frontage_width_m', true );

        $legal_paper_status = get_post_meta( $post->ID, 'legal_paper_status', true );
        $furniture_status = get_post_meta( $post->ID, 'furniture_status', true );
        $video_url = get_post_meta( $post->ID, 'video_url', true );
        $expires_at = get_post_meta( $post->ID, 'expires_at', true );
        $google_maps_url = get_post_meta( $post->ID, 'google_maps_url', true );
        $listing_type = get_post_meta( $post->ID, 'listing_type', true );

        $property_gallery = get_post_meta( $post->ID, 'property_gallery', true );

        // New fields
        $house_condition = get_post_meta( $post->ID, 'house_condition', true );
        $design = get_post_meta( $post->ID, 'design', true );
        $occupancy_rate = get_post_meta( $post->ID, 'occupancy_rate', true );
        $unit_type = get_post_meta( $post->ID, 'unit_type', true );
        $floor_range = get_post_meta( $post->ID, 'floor_range', true );

        // Get current property type term
        $terms = wp_get_post_terms( $post->ID, 'property-type' );
        $current_type_id = ! empty( $terms ) && ! is_wp_error( $terms ) ? $terms[0]->term_id : '';
        $all_types = get_terms( [ 'taxonomy' => 'property-type', 'hide_empty' => false ] );
        ?>
        <div class="lth-meta-box-wrapper" style="padding: 10px;">
            <p><i>Điền đầy đủ các thông số thực tế của Bất động sản mảng dưới đây. Nếu không có giá trị, có thể để trống.</i></p>
            <hr>
            <h3>I. Giao dịch & Vị trí</h3>
            <div class="lth-meta-row">
                <div class="lth-meta-field">
                    <label>Hình thức</label>
                    <select name="listing_type" id="lth_listing_type">
                        <option value="sale" <?php selected( $listing_type, 'sale' ); ?>>Bán</option>
                        <option value="rent" <?php selected( $listing_type, 'rent' ); ?>>Cho thuê</option>
                    </select>
                </div>
                <div class="lth-meta-field">
                    <label id="lth_price_label">Giá bán</label>
                    <input type="number" step="0.1" name="price" value="<?php echo esc_attr( $price ); ?>" />
                </div>
                <div class="lth-meta-field">
                    <label>Tiền tệ / Đơn vị</label>
                    <select name="currency" id="lth_currency_select">
                        <option value="billion" <?php selected( $currency, 'billion' ); ?>>Tỷ VNĐ</option>
                        <option value="million" <?php selected( $currency, 'million' ); ?>>Triệu VNĐ</option>
                        <option value="million_sqm" <?php selected( $currency, 'million_sqm' ); ?>>Triệu / m²</option>
                        <option value="million_month" <?php selected( $currency, 'million_month' ); ?>>Triệu / Tháng</option>
                        <option value="million_year" <?php selected( $currency, 'million_year' ); ?>>Triệu / Năm</option>
                    </select>
                </div>
                <div class="lth-meta-field">
                    <label>Địa chỉ trên sổ (Số nhà/Đường/Ngõ)</label>
                    <input type="text" name="address_street" value="<?php echo esc_attr( $address_street ); ?>" placeholder="VD: 121B/4 Nguyễn Đình Chiểu" />
                </div>
            </div>

            <hr>
            <h3>II. Loại hình & Cấu trúc</h3>
            <div class="lth-meta-row">
                <div class="lth-meta-field" style="flex: 1 1 100%;">
                    <label>Loại hình Bất động sản</label>
                    <select name="property_type_sync" id="lth_property_type_sync">
                        <option value="">-- Chọn loại hình --</option>
                        <?php 
                        foreach ( $all_types as $type ) {
                            echo '<option value="' . esc_attr( $type->term_id ) . '" data-slug="' . esc_attr( $type->slug ) . '" ' . selected( $current_type_id, $type->term_id, false ) . '>' . esc_html( $type->name ) . '</option>';
                        }
                        ?>
                    </select>
                    <p class="description">Lựa chọn này sẽ đồng bộ với Danh mục bên cột phải và thay đổi các ô nhập liệu bên dưới.</p>
                </div>
            </div>

            <div id="lth_dynamic_fields" class="lth-meta-row">
                <!-- Quy mô (Dùng chung cho nhiều loại) -->
                <div class="lth-meta-field field-quy-mo">
                    <label>Quy mô / Diện tích</label>
                    <input type="text" name="area_display" value="<?php echo esc_attr( $area ); ?>" placeholder="VD: 1500m2" />
                </div>
                
                <!-- Mặt tiền -->
                <div class="lth-meta-field field-mat-tien">
                    <label>Mặt tiền (m)</label>
                    <input type="text" name="frontage_display" value="<?php echo esc_attr( $frontage_width_m ); ?>" placeholder="VD: 7m" />
                </div>

                <!-- Đường trước nhà -->
                <div class="lth-meta-field field-duong-truoc-nha">
                    <label>Đường trước nhà (m)</label>
                    <input type="text" name="entrance_display" value="<?php echo esc_attr( $entrance_width_m ); ?>" placeholder="VD: 6m" />
                </div>

                <!-- Hướng -->
                <div class="lth-meta-field field-huong">
                    <label>Hướng</label>
                    <select name="house_direction">
                        <option value="">-- Trống --</option>
                        <?php 
                        $dirs = [
                            'east' => 'Đông',
                            'west' => 'Tây',
                            'south' => 'Nam',
                            'north' => 'Bắc',
                            'south_east' => 'Đông Nam',
                            'north_east' => 'Đông Bắc',
                            'south_west' => 'Tây Nam',
                            'north_west' => 'Tây Bắc'
                        ];
                        foreach($dirs as $val => $label) echo '<option value="'.$val.'" '.selected($house_direction, $val, false).'>'.$label.'</option>'; 
                        ?>
                    </select>
                </div>

                <!-- Phòng ngủ -->
                <div class="lth-meta-field field-phong-ngu">
                    <label>Số phòng ngủ</label>
                    <input type="number" name="num_bedrooms" value="<?php echo esc_attr( $num_bedrooms ); ?>" placeholder="0" />
                </div>

                <!-- Hiện trạng nhà -->
                <div class="lth-meta-field field-hien-trang">
                    <label>Hiện trạng nhà</label>
                    <input type="text" name="house_condition" value="<?php echo esc_attr( $house_condition ); ?>" placeholder="VD: Mới, Cũ, Đang xây..." />
                </div>

                <!-- Thiết kế (Văn phòng) -->
                <div class="lth-meta-field field-thiet-ke">
                    <label>Thiết kế</label>
                    <input type="text" name="design" value="<?php echo esc_attr( $design ); ?>" placeholder="VD: Hiện đại, Thông sàn..." />
                </div>

                <!-- Tỷ lệ lấp đầy (Khách sạn) -->
                <div class="lth-meta-field field-lap-day">
                    <label>Tỷ lệ lấp đầy (%)</label>
                    <input type="text" name="occupancy_rate" value="<?php echo esc_attr( $occupancy_rate ); ?>" placeholder="VD: 90%" />
                </div>

                <!-- Loại căn (Chung cư) -->
                <div class="lth-meta-field field-loai-can">
                    <label>Loại căn</label>
                    <input type="text" name="unit_type" value="<?php echo esc_attr( $unit_type ); ?>" placeholder="VD: 2PN, Studio..." />
                </div>

                <!-- Khoảng tầng (Chung cư) -->
                <div class="lth-meta-field field-khoang-tang">
                    <label>Khoảng tầng</label>
                    <input type="text" name="floor_range" value="<?php echo esc_attr( $floor_range ); ?>" placeholder="VD: Tầng trung, Tầng cao..." />
                </div>
                
                <!-- Số tầng (Văn phòng, Biệt thự, Nhà mặt phố) -->
                <div class="lth-meta-field field-so-tang">
                    <label>Số tầng cao</label>
                    <input type="number" name="num_floors" value="<?php echo esc_attr( $num_floors ); ?>" placeholder="0" />
                </div>

                <!-- Số phòng tắm (Dùng chung nhiều loại) -->
                <div class="lth-meta-field field-phong-tam">
                    <label>Số phòng tắm/WC</label>
                    <input type="number" name="num_bathrooms" value="<?php echo esc_attr( $num_bathrooms ); ?>" placeholder="0" />
                </div>

                <div class="lth-meta-field field-noi-that">
                    <label>Nội thất</label>
                    <select name="furniture_status">
                        <option value="">-- Rỗng --</option>
                        <option value="basic_furniture" <?php selected( $furniture_status, 'basic_furniture' ); ?>>Nội thất Cơ bản (Bếp, Vệ sinh)</option>
                        <option value="full_furniture" <?php selected( $furniture_status, 'full_furniture' ); ?>>Đầy đủ (Dọn vào ở ngay)</option>
                        <option value="premium_furniture" <?php selected( $furniture_status, 'premium_furniture' ); ?>>Setup chuẩn Cao cấp</option>
                    </select>
                </div>
            </div>

            <hr>
            <h3>III. Pháp lý & Khác</h3>
            <div class="lth-meta-row">
                <div class="lth-meta-field">
                    <label>Tình trạng Giấy tờ</label>
                    <select name="legal_paper_status">
                        <option value="">-- Bỏ qua --</option>
                        <option value="land_ownership_certificate" <?php selected( $legal_paper_status, 'land_ownership_certificate' ); ?>>Đã có Sổ đỏ</option>
                        <option value="building_permit" <?php selected( $legal_paper_status, 'building_permit' ); ?>>Giấy phép xây dựng</option>
                        <option value="sales_contract" <?php selected( $legal_paper_status, 'sales_contract' ); ?>>Hợp đồng mua bán (Dự án)</option>
                        <option value="pending_certificate" <?php selected( $legal_paper_status, 'pending_certificate' ); ?>>Đang chờ sổ</option>
                    </select>
                </div>
                <div class="lth-meta-field">
                    <label>Tin có hạn (Ngày gỡ ban)</label>
                    <input type="date" name="expires_at" value="<?php echo esc_attr( $expires_at ); ?>" />
                </div>
                <div class="lth-meta-field">
                    <label>Video Clip thực tế (URL Youtube)</label>
                    <input type="url" name="video_url" value="<?php echo esc_attr( $video_url ); ?>" placeholder="Dán link HTTPS Youtube/Tiktok..." />
                </div>
                <div class="lth-meta-field">
                    <label>Google Maps Embed (Link/Iframe)</label>
                    <input type="text" name="google_maps_url" value="<?php echo esc_attr( $google_maps_url ); ?>" placeholder="Dán mã nhúng Google Maps..." />
                </div>
            </div>

            <hr>
            <h3>IV. Thư viện Ảnh (Gallery View)</h3>
            <p><i>Gallery này sẽ hiển thị dạng Slide cho khách xem các ngóc ngách không gian (Ảnh đại diện cài đặt ở Cột Phải). Nhấn nút dưới đây để khởi chạy WP Media Uploader.</i></p>
            <div class="lth-gallery-wrapper">
                <input type="hidden" name="property_gallery" id="property_gallery_input" value="<?php echo esc_attr( $property_gallery ); ?>" />
                <div id="property_gallery_container" class="lth-gallery-container">
                    <?php 
                    if ( ! empty( $property_gallery ) ) {
                        $image_ids = explode( ',', $property_gallery );
                        foreach ( $image_ids as $id ) {
                            if ( empty($id) ) continue;
                            $img_url = wp_get_attachment_image_url( $id, 'thumbnail' );
                            if ( $img_url ) {
                                echo '<div class="lth-gallery-item" data-id="'.esc_attr($id).'"><img src="'.esc_url($img_url).'" /><span class="remove-img" title="Remove">&times;</span></div>';
                            }
                        }
                    }
                    ?>
                </div>
                <button type="button" class="button button-primary button-large" id="lth_add_gallery_btn">Mở tệp đa phương tiện & Thêm ảnh</button>
            </div>

        </div>
        <?php
    }

    public function save_real_estate_meta_boxes( $post_id ) {
        if ( ! isset( $_POST['lth_real_estate_meta_nonce'] ) || ! wp_verify_nonce( $_POST['lth_real_estate_meta_nonce'], 'lth_real_estate_save_data' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $fields = [
            'price', 'currency', 'area', 'address_street',
            'num_bedrooms', 'num_bathrooms', 'num_floors',
            'house_direction', 'balcony_direction', 'entrance_width_m', 'frontage_width_m',
            'legal_paper_status', 'furniture_status', 'video_url', 'expires_at',
            'property_gallery', 'google_maps_url', 'listing_type',
            'house_condition', 'design', 'occupancy_rate', 'unit_type', 'floor_range'
        ];

        foreach ( $fields as $field ) {
            // Handle area, frontage, entrance update from display fields if provided
            $val_to_save = isset( $_POST[$field] ) ? $_POST[$field] : '';
            
            if ($field === 'area' && isset($_POST['area_display'])) $val_to_save = $_POST['area_display'];
            if ($field === 'frontage_width_m' && isset($_POST['frontage_display'])) $val_to_save = $_POST['frontage_display'];
            if ($field === 'entrance_width_m' && isset($_POST['entrance_display'])) $val_to_save = $_POST['entrance_display'];

            if ( $field === 'google_maps_url' ) {
                update_post_meta( $post_id, $field, wp_unslash( $val_to_save ) );
            } else {
                update_post_meta( $post_id, $field, sanitize_text_field( $val_to_save ) );
            }
        }

        // Sync taxonomy back
        if ( isset( $_POST['property_type_sync'] ) && ! empty( $_POST['property_type_sync'] ) ) {
            wp_set_post_terms( $post_id, [ (int)$_POST['property_type_sync'] ], 'property-type' );
        }
    }
}
