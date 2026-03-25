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

        ?>
        <style>
            .lth-meta-row { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px; }
            .lth-meta-field { flex: 1 1 200px; display: flex; flex-direction: column; }
            .lth-meta-field label { font-weight: bold; margin-bottom: 5px; color: #1d2327; }
            .lth-meta-field input, .lth-meta-field select { width: 100%; padding: 5px 8px; }
            .lth-gallery-container { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px; min-height: 80px; border: 2px dashed #ccc; padding: 10px; background: #fafafa;}
            .lth-gallery-item { position: relative; width: 80px; height: 80px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; }
            .lth-gallery-item img { width: 100%; height: 100%; object-fit: cover; }
            .lth-gallery-item .remove-img { position: absolute; top: 0; right: 0; background: red; color: white; cursor: pointer; padding: 0 4px; line-height: 1.2; font-size: 14px; font-weight: bold; }
        </style>

        <div class="lth-meta-box-wrapper" style="padding: 10px;">
            <p><i>Điền đầy đủ các thông số thực tế của Bất động sản mảng dưới đây. Nếu không có giá trị, có thể để trống.</i></p>
            <hr>
            <h3>I. Giao dịch & Vị trí</h3>
            <div class="lth-meta-row">
                <div class="lth-meta-field" style="flex:0.5;">
                    <label>Hình thức</label>
                    <select name="listing_type" id="lth_listing_type">
                        <option value="sale" <?php selected( $listing_type, 'sale' ); ?>>Bán</option>
                        <option value="rent" <?php selected( $listing_type, 'rent' ); ?>>Cho thuê</option>
                    </select>
                </div>
                <div class="lth-meta-field" style="flex:1;">
                    <label id="lth_price_label">Giá bán</label>
                    <input type="number" step="0.1" name="price" value="<?php echo esc_attr( $price ); ?>" />
                </div>
                <div class="lth-meta-field" style="flex:0.8;">
                    <label>Đơn vị</label>
                    <select name="currency" id="lth_currency_select">
                        <option value="Tỷ" <?php selected( $currency, 'Tỷ' ); ?>>Tỷ</option>
                        <option value="Triệu" <?php selected( $currency, 'Triệu' ); ?>>Triệu</option>
                        <option value="Triệu/m2" <?php selected( $currency, 'Triệu/m2' ); ?>>Triệu/m²</option>
                        <option value="Triệu/tháng" <?php selected( $currency, 'Triệu/tháng' ); ?>>Triệu/tháng</option>
                        <option value="Triệu/năm" <?php selected( $currency, 'Triệu/năm' ); ?>>Triệu/năm</option>
                    </select>
                </div>
                <div class="lth-meta-field" style="flex:1;">
                    <label>Diện tích (m2)</label>
                    <input type="number" step="0.1" name="area" value="<?php echo esc_attr( $area ); ?>" />
                </div>
            </div>
            
            <div class="lth-meta-row">
                <div class="lth-meta-field" style="flex:1;">
                    <label>Địa chỉ trên sổ (Số nhà/Đường/Ngõ)</label>
                    <input type="text" name="address_street" value="<?php echo esc_attr( $address_street ); ?>" placeholder="VD: 121B/4 Nguyễn Đình Chiểu" />
                </div>
            </div>

            <hr>
            <h3>II. Cấu trúc Nhà & Kích thước</h3>
            <div class="lth-meta-row">
                <div class="lth-meta-field">
                    <label>Số phòng ngủ</label>
                    <input type="number" name="num_bedrooms" value="<?php echo esc_attr( $num_bedrooms ); ?>" placeholder="0" />
                </div>
                <div class="lth-meta-field">
                    <label>Số phòng tắm/WC</label>
                    <input type="number" name="num_bathrooms" value="<?php echo esc_attr( $num_bathrooms ); ?>" placeholder="0" />
                </div>
                <div class="lth-meta-field">
                    <label>Số tầng cao</label>
                    <input type="number" name="num_floors" value="<?php echo esc_attr( $num_floors ); ?>" placeholder="0" />
                </div>
            </div>

            <div class="lth-meta-row">
                <div class="lth-meta-field">
                    <label>Kích thước Mặt tiền (m)</label>
                    <input type="number" step="0.1" name="frontage_width_m" value="<?php echo esc_attr( $frontage_width_m ); ?>" placeholder="Độ rộng mặt vuông góc đường" />
                </div>
                <div class="lth-meta-field">
                    <label>Độ rộng đường vào (m)</label>
                    <input type="number" step="0.1" name="entrance_width_m" value="<?php echo esc_attr( $entrance_width_m ); ?>" placeholder="Đường trước mặt (ô tô lọt?)" />
                </div>
                <div class="lth-meta-field">
                    <label>Hướng nhà</label>
                    <select name="house_direction">
                        <option value="">-- Trống --</option>
                        <?php 
                        $dirs = ['Đông','Tây','Nam','Bắc','Đông Nam','Đông Bắc','Tây Nam','Tây Bắc'];
                        foreach($dirs as $d) echo '<option value="'.$d.'" '.selected($house_direction, $d, false).'>'.$d.'</option>'; 
                        ?>
                    </select>
                </div>
            </div>

            <hr>
            <h3>III. Pháp lý hiện trạng</h3>
            <div class="lth-meta-row">
                <div class="lth-meta-field">
                    <label>Tình trạng Giấy tờ</label>
                    <select name="legal_paper_status">
                        <option value="">-- Bỏ qua --</option>
                        <option value="Sổ đỏ" <?php selected( $legal_paper_status, 'Sổ đỏ' ); ?>>Đã có Sổ đỏ</option>
                        <option value="Giấy phép xây dựng" <?php selected( $legal_paper_status, 'Giấy phép xây dựng' ); ?>>Giấy phép xây dựng</option>
                        <option value="Hợp đồng mua bán" <?php selected( $legal_paper_status, 'Hợp đồng mua bán' ); ?>>Hợp đồng mua bán (Dự án)</option>
                        <option value="Đang chờ sổ" <?php selected( $legal_paper_status, 'Đang chờ sổ' ); ?>>Đang chờ sổ</option>
                    </select>
                </div>
                <div class="lth-meta-field">
                    <label>Nội thất bàn giao</label>
                    <select name="furniture_status">
                        <option value="">-- Rỗng --</option>
                        <option value="Cơ bản" <?php selected( $furniture_status, 'Cơ bản' ); ?>>Nội thất Cơ bản (Bếp, Vệ sinh)</option>
                        <option value="Đầy đủ" <?php selected( $furniture_status, 'Đầy đủ' ); ?>>Đầy đủ (Dọn vào ở ngay)</option>
                        <option value="Cao cấp" <?php selected( $furniture_status, 'Cao cấp' ); ?>>Setup chuẩn Cao cấp</option>
                    </select>
                </div>
                <div class="lth-meta-field">
                    <label>Tin có hạn (Ngày gỡ ban)</label>
                    <input type="date" name="expires_at" value="<?php echo esc_attr( $expires_at ); ?>" />
                </div>
            </div>
            
            <div class="lth-meta-row">
                <div class="lth-meta-field" style="flex:1;">
                    <label>Video Clip thực tế (URL Youtube)</label>
                    <input type="url" name="video_url" value="<?php echo esc_attr( $video_url ); ?>" placeholder="Dán link HTTPS video Youtube hoặc Tiktok..." />
                </div>
                <div class="lth-meta-field" style="flex:1;">
                    <label>Google Maps Embed (URL hoặc Mã Iframe)</label>
                    <input type="text" name="google_maps_url" value="<?php echo esc_attr( $google_maps_url ); ?>" placeholder="Dán mã nhúng hoặc link Google Maps..." />
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

            <script>
            jQuery(document).ready(function($){
                var frame;
                $('#lth_add_gallery_btn').on('click', function(e) {
                    e.preventDefault();

                    if (frame) {
                        frame.open();
                        return;
                    }

                    frame = wp.media({
                        title: 'Chọn kho ảnh cho Bất Động Sản',
                        button: { text: 'Chèn toàn bộ vào Gallery' },
                        multiple: true // Bật tính năng chọn nhiều file
                    });

                    frame.on('select', function() {
                        var selection = frame.state().get('selection');
                        var ids = [];
                        $('#property_gallery_container').html(''); // Clear the ui

                        selection.map(function(attachment) {
                            attachment = attachment.toJSON();
                            ids.push(attachment.id);
                            
                            var url = attachment.url; // Use original as fallback
                            if(attachment.sizes && attachment.sizes.thumbnail) {
                                url = attachment.sizes.thumbnail.url;
                            }
                            
                            $('#property_gallery_container').append('<div class="lth-gallery-item" data-id="'+attachment.id+'"><img src="'+url+'" /><span class="remove-img" title="Xóa">&times;</span></div>');
                        });

                        $('#property_gallery_input').val(ids.join(','));
                    });

                    frame.open();
                });

                // Remove individual image
                $('#property_gallery_container').on('click', '.remove-img', function(){
                    $(this).parent('.lth-gallery-item').remove();
                    
                    var new_ids = [];
                    $('#property_gallery_container .lth-gallery-item').each(function(){
                        new_ids.push( $(this).data('id') );
                    });
                    $('#property_gallery_input').val(new_ids.join(','));
                });

                // Conditional Price/Currency fields
                function updateListingFields() {
                    var type = $('#lth_listing_type').val();
                    var $priceLabel = $('#lth_price_label');
                    var $currencySelect = $('#lth_currency_select');
                    
                    if (type === 'sale') {
                        $priceLabel.text('Giá bán');
                        $currencySelect.find('option').each(function(){
                            var val = $(this).val();
                            if (val === 'Tỷ' || val === 'Triệu' || val === 'Triệu/m2') {
                                $(this).show().prop('disabled', false);
                            } else {
                                $(this).hide().prop('disabled', true);
                            }
                        });
                    } else if (type === 'rent') {
                        $priceLabel.text('Giá thuê');
                        $currencySelect.find('option').each(function(){
                            var val = $(this).val();
                            if (val === 'Triệu/tháng' || val === 'Triệu/năm') {
                                $(this).show().prop('disabled', false);
                            } else {
                                $(this).hide().prop('disabled', true);
                            }
                        });
                    }
                }

                $('#lth_listing_type').on('change', updateListingFields);
                updateListingFields(); // Init on load
            });
            </script>
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
            'property_gallery', 'google_maps_url', 'listing_type'
        ];

        foreach ( $fields as $field ) {
            if ( isset( $_POST[$field] ) ) {
                $value = $_POST[$field];
                if ( $field === 'google_maps_url' ) {
                    // Cho phép dán mã iframe nên không dùng sanitize_text_field cho mục này
                    update_post_meta( $post_id, $field, wp_unslash( $value ) );
                } else {
                    update_post_meta( $post_id, $field, sanitize_text_field( $value ) );
                }
            }
        }
    }
}
