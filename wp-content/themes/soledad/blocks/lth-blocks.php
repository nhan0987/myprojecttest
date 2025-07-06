<?php
/*
    Plugin Name: LTH Blocks
    Plugin URI: https://themeforest.net/
    Description: LTH Widgets for Autumn Theme
    Version: 1.0.0
    Author: LTH Design Team
    Author URI: https://wordpress.com/wordpress-plugins/
    Text Domain: lth-theme
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;

foreach(glob(BLOCKS_DIR . '/lazyblock-*/*.php') as $file) {
    require_once($file);
}

function lth_allowed_block_types( $allowed_blocks ) {     
    return array(
        'core/columns',
        'core/freeform', // Classic
        'lazyblock/lth-section',
        // 'lazyblock/lth-shortcode',
        // 'lazyblock/lth-blocks',
        // 'lazyblock/lth-banner',
        'lazyblock/lth-blogs',
        // 'lazyblock/lth-blogs-tab',
        'lazyblock/lth-brand',
        // 'lazyblock/lth-shopcart',
        'lazyblock/lth-categories',
        // 'lazyblock/lth-categories-product',
        'lazyblock/lth-classic',
        // 'lazyblock/lth-contact',
        // 'lazyblock/lth-faq',
        'lazyblock/lth-features',
        // 'lazyblock/lth-gallery',
        // 'lazyblock/lth-html-blocks',
        // 'lazyblock/lth-list',
        // 'lazyblock/lth-logo',
        // 'lazyblock/lth-menu',
        // 'lazyblock/lth-products',
        // 'lazyblock/lth-search',
        'lazyblock/lth-slider',
        // 'lazyblock/lth-tab',
        // 'lazyblock/lth-team',
        // 'lazyblock/lth-testimonials',
        'lazyblock/lth-title',
        'lazyblock/lth-button',
        'lazyblock/lth-toggle',
        'lazyblock/lth-video',

        ////////////////////////////////////

        

    );  
} add_action('allowed_block_types', 'lth_allowed_block_types', 11);