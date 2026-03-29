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
        add_filter( 'allowed_block_types_all', [ $this, 'restrict_real_estate_blocks' ], 10, 2 );
        add_action( 'admin_head', [ $this, 'hide_media_button_for_real_estate' ] );
        add_filter( 'mce_buttons', [ $this, 'remove_mce_media_buttons' ] );
        add_filter( 'mce_buttons_2', [ $this, 'remove_mce_media_buttons' ] );
        add_filter( 'tiny_mce_before_init', [ $this, 'customize_tinymce_for_real_estate' ] );
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
                
                $labels_map = [
                    'billion' => 'tỷ',
                    'million' => 'triệu',
                    'million_sqm' => 'triệu/m²',
                    'million_month' => 'triệu/tháng',
                    'million_year' => 'triệu/năm'
                ];
                $currency_label = isset($labels_map[$currency]) ? $labels_map[$currency] : $currency;

                $price_text = $price ? "<strong style='color:#d63638; font-size:14px;'>" . esc_html($price) . " " . esc_html($currency_label) . "</strong>" : "<strong style='color:#d63638;'>Thỏa thuận</strong>";
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

    public function restrict_real_estate_blocks( $allowed_blocks, $editor_context ) {
        if ( isset( $editor_context->post ) && $editor_context->post->post_type === 'real_estate' ) {
            return [ 'core/freeform' ]; // Return only the Classic Block
        }
        return $allowed_blocks;
    }

    public function hide_media_button_for_real_estate() {
        global $current_screen;
        if ( isset( $current_screen->post_type ) && $current_screen->post_type === 'real_estate' ) {
            // Hide the Add Media button above the editor (if any)
            remove_action( 'media_buttons', 'media_buttons' );
            
            // CSS fallback to hide any remaining media buttons in TinyMCE/Gutenberg blocks
            echo '<style>
                .wp-media-buttons, 
                .mce-i-image, 
                .mce-i-media, 
                .editor-post-featured-image { 
                    display: none !important; 
                }
                /* Hide the "Add Media" button and menu items in the Classic Block toolbar */
                div[aria-label^="Thêm Media"],
                div[aria-label^="Add Media"],
                button[aria-label^="Thêm Media"], 
                button[aria-label^="Add Media"],
                .mce-btn[aria-label^="Thêm Media"],
                .mce-btn[aria-label^="Add Media"],
                .mce-menu-item[aria-label^="Thêm Media"],
                .mce-menu-item[aria-label^="Add Media"],
                .mce-i-dashicon.dashicons-admin-media,
                .mce-i-wp-media-library,
                .mce-i-media,
                .mce-i-image {
                    display: none !important;
                }
                /* Hide the specific menu item from the "Insert" menu */
                .mce-menu-item .mce-text:contains("Thêm Media"),
                .mce-menu-item .mce-text:contains("Add Media"),
                .mce-menu-item-normal:has(.mce-i-wp-media-library) {
                    display: none !important;
                }
                /* Fallback for IDs seen in screenshot */
                [id^="mce_"][id$="-text"]:contains("Thêm Media"),
                [id^="mce_"][id$="-text"]:contains("Add Media") {
                    display: none !important;
                }
                /* Hide container if text matches */
                .mce-menu-item:has(span:contains("Media")) {
                   display: none !important;
                }
            </style>';
            
            // Add script to ensure menu items are removed even if CSS fails
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    const observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.addedNodes.length) {
                                mutation.addedNodes.forEach(function(node) {
                                    if (node.classList && (node.classList.contains("mce-menu") || node.classList.contains("mce-floatpanel"))) {
                                        const items = node.querySelectorAll(".mce-menu-item");
                                        items.forEach(function(item) {
                                            if (item.innerText.includes("Thêm Media") || item.innerText.includes("Add Media")) {
                                                item.style.display = "none";
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                    observer.observe(document.body, { childList: true, subtree: true });
                });
            </script>';
        }
    }

    public function remove_mce_media_buttons( $buttons ) {
        global $current_screen;
        if ( isset( $current_screen->post_type ) && $current_screen->post_type === 'real_estate' ) {
            $buttons_to_remove = [ 'image', 'wp_add_media', 'media' ]; 
            return array_diff( $buttons, $buttons_to_remove );
        }
        return $buttons;
    }

    public function customize_tinymce_for_real_estate( $init_array ) {
        global $current_screen;
        if ( isset( $current_screen->post_type ) && $current_screen->post_type === 'real_estate' ) {
            // Remove media related tools from toolbars
            $init_array['toolbar1'] = str_replace(['image,', ',image', 'image', 'wp_add_media,', 'wp_add_media'], '', $init_array['toolbar1']);
            $init_array['toolbar2'] = str_replace(['image,', ',image', 'image', 'wp_add_media,', 'wp_add_media'], '', $init_array['toolbar2']);
            
            // Explicitly remove menu items
            $init_array['removed_menuitems'] = 'wp_add_media,media,image';
            
            // Aggressive JS-based removal within TinyMCE
            $init_array['setup'] = 'function(ed) {
                ed.on("PreInit", function() {
                    if (ed.settings.menu && ed.settings.menu.insert) {
                        var items = ed.settings.menu.insert.items;
                        if (typeof items === "string") {
                            ed.settings.menu.insert.items = items.replace(/wp_add_media|media|image/g, "").replace(/\|\|/g, "|").replace(/^\||\|$/g, "");
                        }
                    }
                });
            }';
        }
        return $init_array;
    }
}
