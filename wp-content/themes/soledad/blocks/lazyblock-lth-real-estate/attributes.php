<?php

/**
 * Create gutenberg attributes fields for LTH Real Estate
 */

if (function_exists('lazyblocks')) :

   global $wpdb;

   $location_choices = array(
       array( 'label' => '-- Tất cả --', 'value' => '' )
   );
   
   // Sử dụng Cache để tránh việc gọi thẳng DB nhiều lần
   $loc_terms = wp_cache_get('lth_loc_terms', 'lth_blocks');
   if ( false === $loc_terms ) {
       $loc_terms = $wpdb->get_results("SELECT t.term_id, t.name, tt.parent FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id WHERE tt.taxonomy = 'property-location'");
       wp_cache_set('lth_loc_terms', $loc_terms, 'lth_blocks', HOUR_IN_SECONDS);
   }

   if ( ! empty( $loc_terms ) ) {
       foreach ( $loc_terms as $t ) {
           if ( $t->parent != 0 ) {
               $location_choices[] = array( 'label' => $t->name, 'value' => $t->term_id );
           }
       }
   }

   $type_choices = array(
       array( 'label' => '-- Tất cả --', 'value' => '' )
   );
   
   $type_terms = wp_cache_get('lth_type_terms', 'lth_blocks');
   if ( false === $type_terms ) {
       $type_terms = $wpdb->get_results("SELECT t.term_id, t.name, tt.parent FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id WHERE tt.taxonomy = 'property-type'");
       wp_cache_set('lth_type_terms', $type_terms, 'lth_blocks', HOUR_IN_SECONDS);
   }

   if ( ! empty( $type_terms ) ) {
       foreach ( $type_terms as $t ) {
           $type_choices[] = array( 'label' => $t->name, 'value' => $t->term_id );
       }
   }

   lazyblocks()->add_block(array(
      'id' => 'lth_real_estate',
      'title' => 'LTH: Real Estate',
      'description'  => 'Block danh sách bất động sản tùy chỉnh.',
      'icon' => '<svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
      'slug' => 'lazyblock/lth-real-estate',
      'category' => 'common',
      'category_label' => 'common',
      'supports' => array(
         'customClassName' => true,
         'anchor' => false,
         'align' => array(
             0 => 'wide',
             1 => 'full',
         ),
         'html' => false,
         'multiple' => true,
         'inserter' => true,
      ),
      'ghostkit' => array(
         'supports' => array(
            'spacings' => false,
            'display' => false,
            'scrollReveal' => false,
            'frame' => false,
            'customCSS' => false,
         ),
      ),
      'controls' => array(
         'control_text_lth_title' => array(
           'type' => 'text',
           'name' => 'title',
           'default' => 'Bất Động Sản Nổi Bật',
           'label' => 'Title',
           'placement' => 'inspector',
           'width' => '100',
         ),
         'control_text_lth_subtitle' => array(
           'type' => 'text',
           'name' => 'subtitle',
           'default' => 'DANH MỤC BĐS',
           'label' => 'Subtitle',
           'placement' => 'inspector',
           'width' => '100',
         ),
         'control_text_lth_location_cats' => array(
            'type' => 'select',
            'name' => 'location_cats',
            'default' => '',
            'label' => 'Danh mục vị trí',
            'help' => 'Chọn vị trí cần hiển thị (để trống lấy tất cả).',
            'placement' => 'inspector',
            'width' => '100',
            'choices' => $location_choices,
         ),
         'control_text_lth_type_cats' => array(
            'type' => 'select',
            'name' => 'type_cats',
            'default' => '',
            'label' => 'Danh mục loại hình',
            'help' => 'Chọn loại hình cần hiển thị (để trống lấy tất cả).',
            'placement' => 'inspector',
            'width' => '100',
            'choices' => $type_choices,
         ),
         'control_number_lth_post_number' => array(
            'type' => 'number',
            'name' => 'post_number',
            'default' => '10',
            'label' => 'Number of Posts',
            'placement' => 'inspector',
            'width' => '100',
         ),
      ),
      'code' => array(
         'output_method' => 'php',
         'editor_html' => '',
         'editor_callback' => '',
         'editor_css' => '',
         'frontend_html' => '',
         'frontend_callback' => '',
         'frontend_css' => '',
         'show_preview' => 'always',
         'single_output' => false,
      ),
      'condition' => array(),
   ));
endif;
