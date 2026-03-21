<?php
/**
 * Plugin Name: LTH Real Estate Manager
 * Description: Quản lý danh mục Bất động sản, Dự án và Tùy chỉnh Admin UI.
 * Version: 1.0.0
 * Author: LTH
 * Text Domain: lth-real-estate
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define Plugin Constants
define( 'LTH_REAL_ESTATE_VERSION', '1.0.0' );
define( 'LTH_REAL_ESTATE_DIR', plugin_dir_path( __FILE__ ) );
define( 'LTH_REAL_ESTATE_URL', plugin_dir_url( __FILE__ ) );

// Include Core Files
require_once LTH_REAL_ESTATE_DIR . 'includes/class-post-types.php';
require_once LTH_REAL_ESTATE_DIR . 'includes/class-meta-boxes.php';
require_once LTH_REAL_ESTATE_DIR . 'includes/class-admin-ui.php';
require_once LTH_REAL_ESTATE_DIR . 'includes/class-taxonomy-meta.php';

// Initialize the plugin
function lth_real_estate_init() {
    new LTH_Real_Estate_Post_Types();
    new LTH_Real_Estate_Meta_Boxes();
    new LTH_Real_Estate_Admin_UI();
    new LTH_Real_Estate_Taxonomy_Meta();
}
add_action( 'plugins_loaded', 'lth_real_estate_init' );

// Tự động Flush Rewrite Rules khi kích hoạt plugin để tránh lỗi 404
register_activation_hook( __FILE__, function() {
    lth_real_estate_init();
    flush_rewrite_rules();
} );

// Tách biệt hoàn toàn giao diện Frontend (Single Post) khỏi Theme
function lth_real_estate_single_template( $template ) {
    global $post;
    if ( 'real_estate' === $post->post_type && is_single() ) {
        $plugin_template = LTH_REAL_ESTATE_DIR . 'templates/single-real-estate.php';
        if ( file_exists( $plugin_template ) ) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter( 'single_template', 'lth_real_estate_single_template' );

