<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LTH_Real_Estate_Post_Types {

    public function __construct() {
        add_action( 'init', [ $this, 'register_post_types' ] );
        add_action( 'init', [ $this, 'register_taxonomies' ] );
        add_action( 'admin_menu', [ $this, 'customize_admin_menu' ] );
    }

    public function register_post_types() {
        // CPT: Bất động sản
        $labels_re = [
            'name'                  => 'Tất cả Bất động sản',
            'singular_name'         => 'Bất động sản',
            'menu_name'             => 'LTH Real Estate',
            'add_new'               => 'Thêm Bất động sản',
            'add_new_item'          => 'Thêm Mới Bất động sản',
            'edit_item'             => 'Sửa Bất động sản',
            'all_items'             => 'Tất cả Bất động sản',
        ];
        $args_re = [
            'labels'             => $labels_re,
            'public'             => true,
            'has_archive'        => true,
            'rewrite'            => [ 'slug' => 'real-estate' ],
            'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author' ], 
            'template'           => [
                [ 'core/freeform', [] ]
            ],
            'template_lock'      => 'all', // Prevent adding/moving/deleting blocks
            'menu_icon'          => 'dashicons-building',
            'menu_position'      => 30,
            'show_in_rest'       => true, // Enable Gutenberg Block Editor
        ];
        register_post_type( 'real_estate', $args_re );
    }

    public function register_taxonomies() {
        // Taxonomy: Dự án
        register_taxonomy( 'project', 'real_estate', [
            'labels' => [
                'name'              => 'Danh mục Dự án',
                'singular_name'     => 'Dự án',
                'menu_name'         => 'Danh mục Dự án',
                'all_items'         => 'Tất cả Dự án',
            ],
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'project' ],
        ]);

        // Taxonomy: Loại hình
        register_taxonomy( 'property-type', 'real_estate', [
            'labels' => [
                'name'              => 'Danh mục Loại hình',
                'singular_name'     => 'Loại hình',
                'menu_name'         => 'Danh mục Loại hình',
                'all_items'         => 'Tất cả Loại hình',
            ],
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => false, // Disables the sidebar box in Gutenberg
            'rewrite'           => [ 'slug' => 'property-type' ],
        ]);

        // Taxonomy: Vị trí
        register_taxonomy( 'property-location', 'real_estate', [
            'labels' => [
                'name'              => 'Danh mục Vị trí',
                'singular_name'     => 'Vị trí',
                'menu_name'         => 'Danh mục Vị trí',
                'all_items'         => 'Tất cả Vị trí',
            ],
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'property-location' ],
        ]);
    }

    public function customize_admin_menu() {
        // Rename the main menu item globally to 'LTH Real Estate Manager'
        global $menu, $submenu;
        if ( isset( $menu ) ) {
            foreach ( $menu as $key => $item ) {
                if ( $item[2] === 'edit.php?post_type=real_estate' ) {
                    $menu[$key][0] = 'LTH Real Estate Manager';
                    break;
                }
            }
        }
    }
}
