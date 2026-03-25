<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LTH_Real_Estate_Admin_UI {

    public function __construct() {
        // Customize real_estate columns
        add_filter( 'manage_real_estate_posts_columns', [ $this, 'set_real_estate_columns' ] );
        add_action( 'manage_real_estate_posts_custom_column', [ $this, 'fill_real_estate_columns' ], 10, 2 );
        add_action( 'restrict_manage_posts', [ $this, 'add_real_estate_filters' ] );
    }

    public function set_real_estate_columns( $columns ) {
        $new_columns = [];
        $new_columns['cb'] = $columns['cb'];
        $new_columns['thumbnail'] = 'Hình ảnh';
        $new_columns['title'] = 'Tiêu đề BĐS';
        $new_columns['lth_params'] = 'Thông số chính';
        $new_columns['lth_project'] = 'Thuộc Dự án';
        $new_columns['lth_tax'] = 'Phân loại';
        $new_columns['lth_status'] = 'Tình trạng';
        $new_columns['date'] = 'Thời gian';
        
        return $new_columns;
    }

    public function fill_real_estate_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'thumbnail':
                if ( has_post_thumbnail( $post_id ) ) {
                    echo get_the_post_thumbnail( $post_id, [60, 60], ['style' => 'border-radius:4px; border: 1px solid #ddd; display:block;'] );
                } else {
                    echo '<div style="width:60px; height:60px; background:#f0f0f1; border-radius:4px; border:1px dashed #dcdcde; display:flex; align-items:center; justify-content:center; color:#a7aaad;">No Img</div>';
                }
                break;
            case 'lth_params':
                $price = get_post_meta( $post_id, 'price', true );
                $currency = get_post_meta( $post_id, 'currency', true );
                $area = get_post_meta( $post_id, 'area', true );
                
                $price_text = $price ? "<strong style='color:#d63638; font-size:14px;'>" . esc_html($price) . " " . esc_html($currency) . "</strong>" : "<strong style='color:#d63638;'>Thỏa thuận</strong>";
                $area_text = $area ? esc_html($area) . "m²" : "—";
                echo "{$price_text} <br> / <span style='color:#50575e; font-weight:500;'>{$area_text}</span>";
                break;
            case 'lth_project':
                $projects = get_the_term_list( $post_id, 'project', '', ', ' );
                echo $projects ? "<strong style='color:#1d2327;'>" . $projects . "</strong>" : "<span style='color:#8c8f94;'>—</span>";
                break;
            case 'lth_tax':
                $types = get_the_term_list( $post_id, 'property-type', '', ', ' );
                $locations = get_the_term_list( $post_id, 'property-location', '', ' > ' );
                echo $types ? "<div style='margin-bottom:4px;'><strong style='color:#1d2327;'>Loại:</strong> {$types}</div>" : "";
                echo $locations ? "<div><strong style='color:#1d2327;'>Vị trí:</strong> <span style='font-size:12px; color:#50575e;'>" . $locations . "</span></div>" : "";
                break;
            case 'lth_status':
                $status = get_post_status( $post_id );
                $style = 'padding: 4px 10px; border-radius: 20px; font-weight: 600; color: #fff; display: inline-block; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;';
                if ( $status == 'publish' ) {
                    echo "<span style='{$style} background: #00a32a; box-shadow: 0 2px 4px rgba(0,163,42,0.2);'>Đang bán</span>";
                } elseif ( $status == 'draft' ) {
                    echo "<span style='{$style} background: #dba617;'>Nháp</span>";
                } else {
                    echo "<span style='{$style} background: #646970;'>{$status}</span>";
                }
                break;
        }
    }

    public function add_real_estate_filters() {
        global $typenow;
        if ( $typenow == 'real_estate' ) {
            $taxonomies = ['project', 'property-type', 'property-location'];
            foreach($taxonomies as $tax_slug){
                $tax_obj = get_taxonomy($tax_slug);
                $selected = isset($_GET[$tax_slug]) ? $_GET[$tax_slug] : '';
                wp_dropdown_categories([
                    'show_option_all' => '-- Tất cả ' . $tax_obj->labels->singular_name . ' --',
                    'taxonomy'        => $tax_slug,
                    'name'            => $tax_slug,
                    'orderby'         => 'name',
                    'selected'        => $selected,
                    'show_count'      => false,
                    'hide_empty'      => true,
                    'value_field'     => 'slug',
                ]);
            }
        }
    }
}
