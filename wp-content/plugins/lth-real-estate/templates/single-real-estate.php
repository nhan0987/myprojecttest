<?php
/**
 * Custom Template for Single Real Estate Property
 * Thiết kế giao diện chi tiết BĐS hoàn toàn tách biệt khỏi Theme blog
 */
get_header(); // Vẫn load Header của theme Soledad để giữ nguyên Menu và Logo

while ( have_posts() ) : the_post();
    // Retrieve custom meta
    $post_id = get_the_ID();
    $price = get_post_meta( $post_id, 'price', true );
    $currency = get_post_meta( $post_id, 'currency', true );
    $area = get_post_meta( $post_id, 'area', true );
    $address_street = get_post_meta( $post_id, 'address_street', true );
    
    // Fallback labels
    $price_label = $price ? $price . ' ' . $currency : 'Liên hệ';
    $area_label = $area ? $area . ' m²' : '—';
?>

<div class="lth-property-container" style="max-width: 1100px; margin: 40px auto; padding: 0 15px; font-family: Arial, sans-serif; color: #333;">
    <!-- BREADCRUMB -->
    <div style="font-size: 13px; color: #777; margin-bottom: 25px;">
        <a href="<?php echo home_url(); ?>" style="color: #d63638; text-decoration: none;">Trang chủ</a> &raquo; Bất động sản &raquo; <?php the_title(); ?>
    </div>

    <!-- TÁCH GIAO DIỆN CHÍNH -->
    <div style="display: flex; flex-wrap: wrap; gap: 40px;">
        
        <!-- CỘT TRÁI (Ảnh & Nội dung chi tiết) -->
        <div style="flex: 1 1 65%; min-width: 0;">
            <!-- Tiêu đề & Địa chỉ -->
            <h1 style="font-size: 28px; line-height: 1.4; font-weight: bold; margin-bottom: 15px; color: #111;"><?php the_title(); ?></h1>
            <p style="color: #666; font-size: 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 5px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <?php echo $address_street ? esc_html( $address_street ) : 'Đang cập nhật địa chỉ'; ?>
            </p>

            <!-- Ảnh đại diện -->
            <div style="margin-bottom: 30px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
               <?php 
               if ( has_post_thumbnail() ) {
                   the_post_thumbnail( 'full', ['style' => 'width:100%; height:auto; display:block;'] );
               } else {
                   echo '<div style="width:100%; height:400px; background:#eee; display:flex; align-items:center; justify-content:center; color:#999;">Không có hình ảnh</div>';
               }
               ?>
            </div>
            
            <!-- Noi dung bài viết -->
            <h3 style="font-size: 22px; margin-bottom: 15px; border-bottom: 2px solid #eee; padding-bottom: 10px;">Thông tin chi tiết</h3>
            <div style="line-height: 1.7; font-size: 16px; color: #444;">
                <?php the_content(); ?>
            </div>
        </div>

        <!-- CỘT PHẢI (Thông số kỹ thuật Block) -->
        <div style="flex: 1 1 30%; min-width: 300px;">
            <div style="background: #fff; border: 1px solid #eaeaea; padding: 25px; border-radius: 8px; position: sticky; top: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                
                <div style="font-size: 14px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Mức giá</div>
                <div style="font-size: 28px; font-weight: bold; color: #d63638; margin-bottom: 25px;"><?php echo esc_html( $price_label ); ?></div>
                
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 15px;">
                    <li style="padding: 12px 0; border-top: 1px solid #eee; display: flex; justify-content: space-between;">
                        <span style="color: #666;">Diện tích</span>
                        <strong style="color: #111;"><?php echo esc_html( $area_label ); ?></strong>
                    </li>
                    <li style="padding: 12px 0; border-top: 1px solid #eee; display: flex; justify-content: space-between;">
                        <span style="color: #666;">Phòng ngủ</span>
                        <strong style="color: #111;"><?php echo esc_html( get_post_meta( $post_id, 'num_bedrooms', true ) ?: '-' ); ?></strong>
                    </li>
                    <li style="padding: 12px 0; border-top: 1px solid #eee; display: flex; justify-content: space-between;">
                        <span style="color: #666;">Phòng tắm</span>
                        <strong style="color: #111;"><?php echo esc_html( get_post_meta( $post_id, 'num_bathrooms', true ) ?: '-' ); ?></strong>
                    </li>
                    <li style="padding: 12px 0; border-top: 1px solid #eee; display: flex; justify-content: space-between;">
                        <span style="color: #666;">Tình trạng pháp lý</span>
                        <strong style="color: #111;"><?php echo esc_html( get_post_meta( $post_id, 'legal_paper_status', true ) ?: 'Đang chờ' ); ?></strong>
                    </li>
                </ul>

                <button style="width: 100%; background: #000; color: #fff; border: none; padding: 15px; font-size: 16px; font-weight: bold; border-radius: 6px; margin-top: 25px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#d63638'" onmouseout="this.style.background='#000'">
                    NHẬN TƯ VẤN NGAY
                </button>
            </div>
        </div>

    </div>
</div>

<?php 
endwhile;
get_footer(); // Vẫn load Footer chuẩn của Theme
?>
