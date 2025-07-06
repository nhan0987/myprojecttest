<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
/* Check page header has enable or not */

if ( ! function_exists( 'penci_is_pageheader' ) ):
	function penci_is_pageheader(){
		if( ! is_page() ): return false; endif;
		
		static $show_page_title;
		$show_page_title = get_theme_mod( 'penci_pheader_show' );
		$penci_page_title = get_post_meta( get_the_ID(), 'penci_pmeta_page_title', true );

		$pheader_show = isset( $penci_page_title['pheader_show'] ) ? $penci_page_title['pheader_show'] : '';
		if(  'enable' == $pheader_show  ) {
			$show_page_title = true;
		}elseif(  'disable' == $pheader_show  ) {
			$show_page_title = false;
		}

		return $show_page_title;
	}
endif;
if ( ! function_exists( 'penci_soledad_get_header_layout' ) ):
	function penci_soledad_get_header_layout() {
		$header_layout = get_theme_mod( 'penci_header_layout' );
		if ( is_page() ) {
			$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
			if ( isset( $pmeta_page_header['header_style'] ) && $pmeta_page_header['header_style'] ) {
				$header_layout = $pmeta_page_header['header_style'];
			}
		}

		if ( empty( $header_layout ) ) {
			$header_layout = 'header-1';
		}

		return $header_layout;
	}
endif;

if ( ! function_exists( 'penci_soledad_get_header_width' ) ):
	function penci_soledad_get_header_width() {
		$header_width = get_theme_mod( 'penci_header_ctwidth' );
		if ( is_page() ) {
			$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
			if ( isset( $pmeta_page_header['penci_header_width'] ) && $pmeta_page_header['penci_header_width'] ) {
				$header_width = $pmeta_page_header['penci_header_width'];
			}
		}

		$output = 'container';
		if ( $header_width ) {
			$output .= ' container-' . $header_width;
		}

		echo $output;
	}
endif;

if ( ! function_exists( 'penci_soledad_get_header_container_width' ) ):
	function penci_soledad_get_header_container_width() {
		$header_width = get_theme_mod( 'penci_header_ctwidth' );
		if ( is_page() ) {
			$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
			if ( isset( $pmeta_page_header['penci_header_width'] ) && $pmeta_page_header['penci_header_width'] ) {
				$header_width = $pmeta_page_header['penci_header_width'];
			}
		}

		$output = '1170';
		if ( $header_width ) {
			$output = $header_width;
		}

		return $output;
	}
endif;

if ( ! function_exists( 'penci_soledad_wpheader_classes' ) ):
	function penci_soledad_wpheader_classes( $class = '' ) {
		$_featured_slider_all_page   = get_theme_mod( 'penci_featured_slider_all_page' );
		$_featured_slider            = get_theme_mod( 'penci_featured_slider' );
		$_vertical_nav_remove_header = get_theme_mod( 'penci_vertical_nav_remove_header' );
		$_vertical_nav_show          = get_theme_mod( 'penci_vertical_nav_show' );
		$header_layout               = penci_soledad_get_header_layout();

		$classes = 'header-' . $header_layout;
		if ( ( ( ! is_home() || ! is_front_page() ) && ! $_featured_slider_all_page ) || ( ( is_home() || is_front_page() ) && ! $_featured_slider ) ) {
			$classes .= ' has-bottom-line';
		}
		if ( $_vertical_nav_remove_header && $_vertical_nav_show ) {
			$classes .= ' penci-vernav-hide-innerhead';
		}

		if ( $class ) {
			$classes .= ' ' . $class;
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'penci_soledad_sitenavigation_classes' ) ):
	function penci_soledad_sitenavigation_classes( $class = '' ) {
		$menu_style    = get_theme_mod( 'penci_header_menu_style' );
		$header_layout = penci_soledad_get_header_layout();

		$classes = '';

		if ( in_array( $header_layout, array( 'header-1', 'header-4', 'header-7' ) ) ) {
			$classes .= 'header-layout-top';
		} else {
			$classes .= 'header-layout-bottom';
		}

		if ( $header_layout == 'header-9' ) {
			$classes .= ' header-6';
		}

		if ( $header_layout == 'header-10' || $header_layout == 'header-11' ) {
			$overflow_logo = get_theme_mod( 'penci_overflow_logo' );
			if ( $overflow_logo ) {
				$class .= ' penci-logo-overflow';
			}
		}

		$classes .= ' ' . $header_layout;
		$classes .= ' ' . ( $menu_style ? $menu_style : 'menu-style-1' );

		if ( get_theme_mod( 'penci_header_enable_padding' ) ) {
			$classes .= ' menu-item-padding';
		}
		if ( get_theme_mod( 'penci_disable_sticky_header' ) ) {
			$classes .= ' penci-disable-sticky-nav';
		}

		if ( $class ) {
			$classes .= ' ' . $class;
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'penci_soledad_body_classes' ) ):
	function penci_soledad_body_classes( $classes ) {

		$fontawesome_ver5 = get_theme_mod( 'penci_fontawesome_ver5' );
		if ( $fontawesome_ver5 ) {
			$classes[] = 'penci-fawesome-ver5';
		}

		if ( is_singular( 'portfolio' ) ) {

			if ( get_theme_mod( "penci_portfolio_single_enable_2sidebar" ) ) {
				$classes[] = 'penci-two-sidebar';
			}
		} elseif ( is_home() || is_front_page() ) {

			$show_on_front =  get_option( 'show_on_front' );
			if( 'page' == $show_on_front ) {

				$sidebar_layout   = get_theme_mod( 'penci_page_default_template_layout' );
				$sidebar_position = get_post_meta( get_the_ID(), 'penci_sidebar_page_pos', true );
				if ( $sidebar_position ) {
					$sidebar_layout = $sidebar_position;
				}

				if ( 'two-sidebar' == $sidebar_layout ) {
					$classes[] = 'penci-two-sidebar';
				}

				// Header transparent
				$header_trans = penci_is_header_transparent();
				if ( $header_trans ) {
					$classes[] = 'penci-header-trans';
				}

			}else{
				if ( get_theme_mod( "penci_two_sidebar_home" ) ) {
					$classes[] = 'penci-two-sidebar';
				}
			}

		} elseif ( is_archive() || is_search() ) {

			$is_two_sidebar_archive = get_theme_mod( 'penci_two_sidebar_archive' );

			if ( is_category() ) {
				$category_oj  = get_queried_object();
				$fea_cat_id   = $category_oj->term_id;
				$cat_meta     = get_option( "category_$fea_cat_id" );
				$sidebar_opts = isset( $cat_meta['cat_sidebar_display'] ) ? $cat_meta['cat_sidebar_display'] : '';
				if ( $sidebar_opts == 'two' ) {
					$is_two_sidebar_archive = true;
				}else{
					$is_two_sidebar_archive = false;
				}
			}

			if ( $is_two_sidebar_archive ) {
				$classes[] = 'penci-two-sidebar';
			}
		} elseif ( is_page() ) {
			$sidebar_layout   = get_theme_mod( 'penci_page_default_template_layout' );
			$sidebar_position = get_post_meta( get_the_ID(), 'penci_sidebar_page_pos', true );
			if ( $sidebar_position ) {
				$sidebar_layout = $sidebar_position;
			}

			if ( 'two-sidebar' == $sidebar_layout ) {
				$classes[] = 'penci-two-sidebar';
			}
			
			$show_page_title = penci_is_pageheader();
			if( $show_page_title ):
			$classes[] = 'penci-body-epageheader';
			endif;

			// Header transparent
			$header_trans = penci_is_header_transparent();
			if ( $header_trans ) {
				$classes[] = 'penci-header-trans';
			}
			
		} elseif ( is_single() ) {
			$sidebar_single_layout   = get_theme_mod( 'penci_single_layout' );
			$sidebar_single_position = get_post_meta( get_the_ID(), 'penci_post_sidebar_display', true );
			if ( $sidebar_single_position ) {
				$sidebar_single_layout = $sidebar_single_position;
			}

			if ( 'two' == $sidebar_single_layout ) {
				$classes[] = 'penci-two-sidebar';
			}
		}


		if ( is_singular( 'portfolio' ) || is_singular( 'product' ) ) {
			$classes[] = 'penci-port-product';
		}



		return $classes;
	}

	add_filter( 'body_class', 'penci_soledad_body_classes' );
endif;

/**
 * Get class sidebar position
 */
if ( ! function_exists( 'penci_is_header_transparent' ) ):
	function penci_is_header_transparent() {
		$header_trans = false;
		if( is_page() ){
			$header_trans = get_theme_mod( 'penci_header_enable_transparent' );
		}

		$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
		if ( isset( $pmeta_page_header['penci_edeader_trans'] ) ) {
			if ( 'yes' == $pmeta_page_header['penci_edeader_trans'] ) {
				$header_trans = true;
			} elseif ( 'no' == $pmeta_page_header['penci_edeader_trans'] ) {
				$header_trans = false;
			}
		}

		return $header_trans;
	}
endif;

/**
 * Get class sidebar position
 */
if ( ! function_exists( 'penci_get_sidebar_position_archive' ) ):
	function penci_get_sidebar_position_archive() {
		$sidebar_position = 'right-sidebar';
		if ( get_theme_mod( 'penci_two_sidebar_archive' ) ) {
			$sidebar_position = 'two-sidebar';
		} elseif ( get_theme_mod( "penci_left_sidebar_archive" ) ) {
			$sidebar_position = 'left-sidebar';
		}

		return $sidebar_position;
	}
endif;

if ( ! function_exists( 'get_list_custom_sidebar_option' ) ):
	function get_list_custom_sidebar_option() {
		$list_sidebar = array(
			'main-sidebar'      => 'Main Sidebar',
			'main-sidebar-left' => 'Main Sidebar Left',
			'custom-sidebar-1'  => 'Custom Sidebar 1',
			'custom-sidebar-2'  => 'Custom Sidebar 2',
			'custom-sidebar-3'  => 'Custom Sidebar 3',
			'custom-sidebar-4'  => 'Custom Sidebar 4',
			'custom-sidebar-5'  => 'Custom Sidebar 5',
			'custom-sidebar-6'  => 'Custom Sidebar 6',
			'custom-sidebar-7'  => 'Custom Sidebar 7',
			'custom-sidebar-8'  => 'Custom Sidebar 8',
			'custom-sidebar-9'  => 'Custom Sidebar 9',
			'custom-sidebar-10' => 'Custom Sidebar 10'
		);

		$custom_sidebars = get_option( 'soledad_custom_sidebars' );
		if ( empty( $custom_sidebars ) || ! is_array( $custom_sidebars ) ) {
			return $list_sidebar;
		}

		foreach ( $custom_sidebars as $sidebar_id => $custom_sidebar ) {

			if ( empty( $custom_sidebar['name'] ) ) {
				continue;
			}
			$list_sidebar[ $sidebar_id ] = $custom_sidebar['name'];
		}

		return $list_sidebar;
	}
endif;

if ( ! function_exists( 'penci_get_option_yesno' ) ) {
	function penci_get_option_yesno( $default = false ) {
		$output = array();

		if ( $default ) {
			$output[''] = esc_html__( 'Default( follow Customize )', 'soledad' );
		}

		$output['no']  = esc_html__( 'No', 'soledad' );
		$output['yes'] = esc_html__( 'Yes', 'soledad' );

		return $output;
	}
}

if ( ! function_exists( 'penci_get_option_menus' ) ) {
	function penci_get_option_menus( $hide_empty = false ) {
		$output = array( '' => esc_html__( '-- Default Select -- ', 'soledad' ) );

		$menus = get_terms( 'nav_menu', array( 'hide_empty' => $hide_empty ) );

		foreach ( $menus as $menu ) {
			$output[ $menu->term_id ] = $menu->name;
		}

		return $output;
	}
}

if ( ! function_exists( 'penci_get_data_slider' ) ):
	function penci_get_data_slider( $args ) {
		$items = $autoplay = $autotime = $speed = $loop = $showdots = $shownav = '';

		$args = wp_parse_args( $args, array(
			'items'    => '1',
			'autoplay' => '',
			'autotime' => '',
			'speed'    => '',
			'loop'     => '',
			'showdots' => '0',
			'shownav'  => '0',
		) );
		extract( $args );

		$data = ' data-items="' . $items . '"';
		$data .= ' data-auto="' . ( 'yes' == $autoplay ? 'true' : 'false' ) . '"';

		$data .= $autotime ? ' data-autotime="' . $autotime . '"' : '';
		$data .= $speed ? ' data-speed="' . $speed . '"' : '';
		$data .= ! $loop ? ' data-loop="false"' : '';
		$data .= $showdots ? ' data-dots="true"' : '';
		$data .= ! $shownav ? ' data-nav="true"' : '';

		return $data;
	}
endif;

if ( defined( 'ELEMENTOR_VERSION' ) || defined( 'WPB_VC_VERSION' ) ) {
	if ( ! function_exists( 'custom_css_title_block_pagebuilder' ) ) {
		add_action( 'soledad_theme/custom_css', 'custom_css_title_block_pagebuilder' );
		function custom_css_title_block_pagebuilder() {
			if ( get_theme_mod( 'penci_sidebar_heading_lowcase' ) ): ?>
				.penci-block-vc .penci-border-arrow .inner-arrow { text-transform: none; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_size' ) ): ?>
				.penci-block-vc .penci-border-arrow .inner-arrow { font-size: <?php echo get_theme_mod( 'penci_sidebar_heading_size' ); ?>px; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_image_8' ) ): ?>
				.penci-block-vc .style-8.penci-border-arrow .inner-arrow { background-image: url(<?php echo get_theme_mod( 'penci_sidebar_heading_image_8' ); ?>); }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading8_repeat' ) ): ?>
				.penci-block-vc .style-8.penci-border-arrow .inner-arrow { background-repeat: <?php echo get_theme_mod( 'penci_sidebar_heading8_repeat' ); ?>; background-size: auto; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_bg' ) ): ?>
				.penci-block-vc .penci-border-arrow .inner-arrow { background-color: <?php echo get_theme_mod( 'penci_sidebar_heading_bg' ); ?>; }
				.penci-block-vc .style-2.penci-border-arrow:after{ border-top-color: <?php echo get_theme_mod( 'penci_sidebar_heading_bg' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_outer_bg' ) ): ?>
				.penci-block-vc .penci-border-arrow:after { background-color: <?php echo get_theme_mod( 'penci_sidebar_heading_outer_bg' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_color' ) ): ?>
				.penci-block-vc .penci-border-arrow .inner-arrow, .penci-block-vc.style-4 .penci-border-arrow .inner-arrow:before, .penci-block-vc.style-4 .penci-border-arrow .inner-arrow:after, .penci-block-vc.style-5 .penci-border-arrow, .penci-block-vc.style-7
				.penci-border-arrow, .penci-block-vc.style-9 .penci-border-arrow { border-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color' ); ?>; }
				.penci-block-vc .penci-border-arrow:before { border-top-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_color5' ) ): ?>
				.penci-block-vc .style-5.penci-border-arrow { border-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color5' ); ?>; }
				.penci-block-vc .style-5.penci-border-arrow .inner-arrow{ border-bottom-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color5' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_color7' ) ): ?>
				.penci-block-vc .style-7.penci-border-arrow .inner-arrow:before, .penci-block-vc.style-9 .penci-border-arrow .inner-arrow:before { background-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color7' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_inner_color' ) ): ?>
				.penci-block-vc .penci-border-arrow:after { border-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_inner_color' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_color' ) ): ?>
				.penci-block-vc .penci-border-arrow .inner-arrow { color: <?php echo get_theme_mod( 'penci_sidebar_heading_color' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_remove_border_outer' ) ): ?>
				.penci-block-vc .penci-border-arrow:after { content: none; display: none; }
				.penci-block-vc .widget-title{ margin-left: 0; margin-right: 0; margin-top: 0; }
				.penci-block-vc .penci-border-arrow:before{ bottom: -6px; border-width: 6px; margin-left: -6px; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_remove_arrow_down' ) ): ?>
				.penci-block-vc .penci-border-arrow:before, .penci-block-vc .style-2.penci-border-arrow:after { content: none; display: none; }
			<?php endif;
		}
	}
}

/**
 * Get icon font awesome with each version
 *
 * Note important : if edit function , please edit same function on penci snorlax framework
 * @see penci_icon_by_ver()
 */
if ( ! function_exists( 'penci_icon_by_ver' ) ):
	function penci_icon_by_ver( $class, $style = '' ) {
		$fontawesome_ver5 = get_theme_mod( 'penci_fontawesome_ver5' );

		if ( ! $fontawesome_ver5 ) {
			$class = str_replace( array( 'fab ', 'fal ', 'far ', 'fas ' ), 'fa ', $class );

			if( 'fa fa-facebook-f' == $class ){
				$class = str_replace( 'facebook-f', 'facebook', $class );
			}elseif( 'fa fa-thumbtack' == $class ){
				$class = str_replace( 'thumbtack', 'thumb-tack', $class );
			}elseif( 'fa fa-linkedin-in' == $class ){
				$class = str_replace( 'linkedin-in', 'linkedin', $class );
			}elseif( 'fa fa-image' == $class ){
				$class = str_replace( 'fa-image', 'fa-picture-o', $class );
			}elseif( 'fa fa-clock' == $class ){
				$class = str_replace( 'fa-clock', 'fa-clock-o', $class );
			}elseif( 'fa fa-user-circle-o' == $class ){
				$class = str_replace( 'fa-user-circle-o', 'fa-user-circle', $class );
			}elseif( 'fa fa-sign-out-alt' == $class ){
				$class = str_replace( 'fa-sign-out-alt', 'fa-sign-out', $class );
			}elseif( 'fa fa-sync' == $class ){
				$class = str_replace( 'fa-sync', 'fa-refresh', $class );
			}elseif( 'fa fa-youtube' == $class ){
				$class = str_replace( 'fa-youtube', 'fa-youtube-play', $class );
			}elseif( 'fa fa-envelope-o' == $class ){
				$class = str_replace( 'fa-envelope-o', 'fa-envelope', $class );
			}elseif( 'fa fa-snapchat-ghost' == $class ){
				$class = str_replace( 'fa-snapchat-ghost', 'fa-snapchat', $class );
			}elseif( 'fa fa-vimeo-v' == $class ){
				$class = str_replace( 'fa-vimeo-v', 'fa-vimeo', $class );
			}elseif( 'fa fa-times' == $class ){
				$class = str_replace( 'fa-times', 'fa-close', $class );
			}elseif( 'fa fa-heart' == $class ){
				$class = str_replace( 'fa-heart', 'fa-heart-o', $class );
			}elseif( 'fa fa-comment' == $class ){
				$class = str_replace( 'fa-comment', 'fa-comment-o', $class );
			}
		}

		return '<i class="penci-faicon ' . esc_attr( $class ) . '" ' . ( $style ? ' ' . $style : '' ) . '></i>';
	}
endif;
/**
 * Show icon font awesome with each version
 *
 */
if ( ! function_exists( 'penci_fawesome_icon' ) ):
	function penci_fawesome_icon( $class, $style = '' ) {
		echo penci_icon_by_ver( $class, $style );
	}
endif;

/**
 * Trims post title.
 *
 * @param $id
 * @param int $length
 * @param null $more
 *
 * @return string
 */
if ( ! function_exists( 'penci_get_trim_post_title' ) ) {
	function penci_get_trim_post_title( $id = '', $length = 20, $more = '...' ) {
		if ( empty( $id ) ) {
			$id = get_the_ID();
		}

		if ( ! $length || ! is_numeric( $length ) ) {
			return get_the_title( $id );
		}

		return sanitize_text_field( wp_trim_words( wp_strip_all_tags( get_the_title( $id ) ), $length, $more ) );
	}
}
if ( ! function_exists( 'penci_trim_post_title' ) ) {
	function penci_trim_post_title( $id = '', $length = 20, $more = '...' ) {
		echo penci_get_trim_post_title( $id, $length, $more );
	}
}

if( !function_exists( 'penci_get_post_countview' ) ) {
	function penci_get_post_countview( $post_id = null ) {

		echo '<span>';
		penci_fawesome_icon('fas fa-eye');
		echo penci_get_post_views( $post_id );
		echo ' ' . penci_get_setting( 'penci_trans_countviews' );
		echo '</span>';
	}
}


/* Hook for Soledad Penci Page Speed */
/* Options from Soledad */
if( ! function_exists( 'penci_classes_slider_lazy' ) ) {
	function penci_classes_slider_lazy() {
		$class = 'owl-lazy';
		if( ! is_user_logged_in() && get_theme_mod( 'penci_enable_spoptimizer' ) ){
			$class = 'penci-lazy';
		}
		
		return $class;
	}
}

/*
add_action('hpp_print_initjs', function(){
	echo '_HWIO.data.gencss=1;';
});
*/

if( ! is_user_logged_in() && get_theme_mod( 'penci_enable_spoptimizer' ) && function_exists( 'hpp_shouldlazy' ) && hpp_shouldlazy() ){
	
add_filter('hpp_allow_generate_css', function($ok){
	return get_option( strrev( 'detavitca_si_dadelos_icnep' ) )? true: false;
});

add_filter('hpp_merge_file', function($code, $handle, $ext, $script_path){
	if($ext=='js' && strpos($script_path, '/contact-form-7/includes/js/scripts.js')!==false) {
		$code = str_replace('$( function() {', 'setTimeout( function() {', $code);
	}
	return $code;
}, 10, 4);

/*
add_filter('hpp_inline_script_part', function($js, $handle){
	if($handle=='contact-form-7') {
		//disable wp-json/contact-form-7/refill for boot speed
		$js = str_replace('"cached":"1"', '"cached":0', $js);
	}
	return $js;
}, 10, 2);
*/

/* CDN */
if( get_theme_mod( 'penci_speed_cdnbase' ) ){
	add_filter( 'hpp_cache_url', function(){
		$cdn_base = get_theme_mod( 'penci_speed_cdnbase' );

		return $cdn_base . '/wp-content/mmr';
	} );
}

add_filter('elementor/widget/render_content', 'hpp_defer_content');

add_filter('hpp_merge_file', function($js, $handle, $ext, $script_path){
	if($ext=='js' && strpos($script_path, '/elementor/assets/js/frontend.js')!==false) {
		$js = str_replace('function runElementsHandlers() {', 'function runElementsHandlers() {let t=this;_HWIO.readyjs(function(){t.elements.$elements.each(function (index, element) {return elementorFrontend.elementsHandler.runReadyTrigger(element)});})', $js);

		$js = str_replace('this.elements.$elements.each(function', 'if(0)this.elements.$elements.each(function', $js);
		$js = str_replace('return $element.elementorWaypoint(', 'if(!jQuery.fn.elementorWaypoint && typeof jQuery_elementorWaypoint!="undefined")jQuery.fn.elementorWaypoint = jQuery_elementorWaypoint;return $element.elementorWaypoint(', $js);
	}
	if($ext=='js' && strpos($script_path, '/elementor/assets/js/frontend.min.js')!==false) {
		if(strpos($js, '_HWIO.readyjs(function(){')===false) {
			$js = str_replace('function runElementsHandlers(){this.elements', 'function runElementsHandlers(){let t=this;_HWIO.readyjs(function(){t.elements', $js);
			if(strpos($js,'.runReadyTrigger(t)}))')!==false) {
				$js = str_replace('elementorFrontend.elementsHandler.runReadyTrigger(t)}))', 'elementorFrontend.elementsHandler.runReadyTrigger(t)}))})', $js);
			}
			else $js = str_replace('elementorFrontend.elementsHandler.runReadyTrigger(t)})}}', 'elementorFrontend.elementsHandler.runReadyTrigger(t)})})}}', $js);
			
			$js = str_replace('return e.elementorWaypoint(', 'if(!jQuery.fn.elementorWaypoint && typeof jQuery_elementorWaypoint!="undefined")jQuery.fn.elementorWaypoint = jQuery_elementorWaypoint;return e.elementorWaypoint(', $js);

		}
	}
	if($ext=='js' && strpos($script_path, '/elementor/assets/lib/waypoints/waypoints.js')!==false) {
		if(strpos($js, 'jQuery_elementorWaypoint')!==false) {
			$js = str_replace('window.jQuery.fn.elementorWaypoint =', 'window.jQuery_elementorWaypoint=window.jQuery.fn.elementorWaypoint =', $js);			
		}
	}
	if($ext=='js' && strpos($script_path, '/elementor/assets/lib/waypoints/waypoints.min.js')!==false) {
		if(strpos($js, 'jQuery_elementorWaypoint')!==false) {
			$js = str_replace('window.jQuery.fn.elementorWaypoint=', 'window.jQuery_elementorWaypoint=window.jQuery.fn.elementorWaypoint=', $js);
		}
	}
	return $js;
}, 10, 4);


add_filter('hpp_delay_asset_att', function($att, $tp) {
	if($tp == 'js' ) { //&& !hw_config('merge_js')
		if($att['id']=='wc-single-product') $att['deps'].=',photoswipe';
	}
	
	if($tp=='js' ) {
		if($att['id']=='main-script') $att['deps'].=',penci-libs-js';
	}
	
	return $att;
	
}, 10, 2);

add_filter('woocommerce_queued_js', function($js){
	if( function_exists( 'hpp_delay_it_script' ) ){
		$js = hpp_delay_it_script( $js);
	}
	
	return $js;
});

add_filter('hpp_critical_css', function($css, $file){
$css .= '#navigation ul.menu > li.menu-item-has-children > a:after, #navigation ul.menu > li.penci-mega-menu > a:after{width: 9xp;}.penci-post-gallery-container .caption { opacity:0; }.penci-owl-carousel:not(.owl-loaded){display:block}.penci-owl-carousel:not(.owl-loaded)>div,.penci-owl-carousel:not(.owl-loaded)>img,.penci-owl-carousel:not(.owl-loaded)>figure,.penci-owl-carousel:not(.owl-loaded) .penci-featured-content-right{display:none}.penci-owl-carousel:not(.owl-loaded)>div:first-child,.penci-owl-carousel:not(.owl-loaded)>figure:first-child,.penci-owl-carousel:not(.owl-loaded)>img:first-child{display:block}.featured-style-2 .penci-owl-carousel:not(.owl-loaded)>.item{width:900px;margin-left:auto;margin-right:auto}.featured-style-38 .penci-owl-carousel:not(.owl-loaded)>.item{width:450px;width:25vw;margin-left:auto;margin-right:auto;position:relative}@media only screen and (max-width:1200px){.featured-style-38 .penci-owl-carousel:not(.owl-loaded)>.item{width:400px}}@media only screen and (max-width:960px){.featured-style-2 .penci-owl-carousel:not(.owl-loaded)>.item{width:760px}}@media only screen and (max-width:767px){.featured-style-2 .penci-owl-carousel:not(.owl-loaded)>.item{width:480px}}@media only screen and (max-width:479px){.featured-style-2 .penci-owl-carousel:not(.owl-loaded)>.item,.featured-style-38 .penci-owl-carousel:not(.owl-loaded)>.item{width:360px}}.penci-owl-carousel:not(.owl-loaded) .penci-featured-content{display:none}.penci-owl-carousel:not(.owl-loaded):before,.penci-owl-carousel:not(.owl-loaded):after{content:"";clear:both;display:table}.penci-owl-carousel.penci-headline-posts:not(.owl-loaded):before,.penci-owl-carousel.penci-headline-posts:not(.owl-loaded):after{content:none;clear:none;display:none}@media only screen and (min-width:1170px){.penci-owl-carousel:not(.owl-loaded)[data-item="4"]>div{width:25%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-item="4"]>div:nth-child(2),.penci-owl-carousel:not(.owl-loaded)[data-item="4"]>div:nth-child(3),.penci-owl-carousel:not(.owl-loaded)[data-item="4"]>div:nth-child(4){display:block}.penci-owl-carousel:not(.owl-loaded)[data-item="3"]>div{width:33.3333%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-item="3"]>div:nth-child(2),.penci-owl-carousel:not(.owl-loaded)[data-item="3"]>div:nth-child(3){display:block}.penci-owl-carousel:not(.owl-loaded)[data-item="2"]>div{width:50%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-item="2"]>div:nth-child(2){display:block}}@media only screen and (max-width:1169px) and (min-width:769px){.penci-owl-carousel:not(.owl-loaded)[data-tablet="4"]>div{width:25%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-tablet="4"]>div:nth-child(2),.penci-owl-carousel:not(.owl-loaded)[data-tablet="4"]>div:nth-child(3),.penci-owl-carousel:not(.owl-loaded)[data-tablet="4"]>div:nth-child(4){display:block}.penci-owl-carousel:not(.owl-loaded)[data-tablet="3"]>div{width:33.3333%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-tablet="3"]>div:nth-child(2),.penci-owl-carousel:not(.owl-loaded)[data-tablet="3"]>div:nth-child(3){display:block}.penci-owl-carousel:not(.owl-loaded)[data-tablet="2"]>div{width:50%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-tablet="2"]>div:nth-child(2){display:block}}@media only screen and (max-width:768px) and (min-width:481px){.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="4"]>div{width:25%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="4"]>div:nth-child(2),.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="4"]>div:nth-child(3),.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="4"]>div:nth-child(4){display:block}.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="3"]>div{width:33.3333%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="3"]>div:nth-child(2),.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="3"]>div:nth-child(3){display:block}.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="2"]>div{width:50%;float:left}.penci-owl-carousel:not(.owl-loaded)[data-tabsmall="2"]>div:nth-child(2){display:block}}.penci-go-to-top-floating{transform:translate3d(0,60px,0);-webkit-transform:translate3d(0,60px,0)}.penci-rlt-popup{-webkit-transform:translate(0,100%);transform:translate(0,100%)}.pctopbar-login-btn{display:inline-block;vertical-align:top;}@media only screen and (min-width: 1170px){.penci-top-bar{height: 32px;}}';
	if( 'header-3' == get_theme_mod( 'penci_header_layout' ) ){
		$css .= '#header .inner-header{height: 155px;}@media only screen and (max-width: 479px){#header .inner-header { height: 207px; }}';
	}
	if( get_theme_mod( 'penci_speed_criticalcss' ) ){
		$add_criticalcss = get_theme_mod( 'penci_speed_criticalcss' );
		$minify_criticalcss = trim(preg_replace('/\s+/', ' ', $add_criticalcss));
		$css .= $minify_criticalcss;
	}
	
	return $css;
}, 10, 2);

add_action('hpp_print_initjs', function(){
?>
_HWIO.docReady(function(){
	document.querySelectorAll('.penci-lazy').forEach(function(e){e.classList.add('lazy');})
	document.addEventListener('lazybeforeunveil', function(e){
	    var bg = e.target.getAttribute('data-src');
	    if(bg && ['a','span','div', 'footer','figure'].indexOf(e.target.tagName.toLowerCase())!==-1){
	        e.target.style.backgroundImage = 'url(' + bg + ')';
			e.target.removeAttribute("data-src");
	    }
	});
});
<?php if( get_theme_mod( 'penci_speed_showbg' ) ): ?>
_HWIO.docReady(function(){
    document.querySelector('style[media="not all"]').removeAttribute('media');
});
<?php
endif; /* End check if showing BG on GG Page Speed Preview */
} );

/* Disalbe other speed optimizer if enable speed optimizer is checked */
/*
add_filter( 'theme_mod_penci_topbar_mega_disable_lazy', function(){ return true; } );
add_filter( 'theme_mod_penci_disable_lazyload_slider', function(){ return true; } );
add_filter( 'theme_mod_penci_disable_lazyload_layout', function(){ return true; } );
add_filter( 'theme_mod_penci_disable_lazyload_single', function(){ return true; } );
*/
add_filter( 'theme_mod_penci_spcss_render', function(){ return 'inline'; } );
add_filter( 'theme_mod_penci_preload_font_icons', function(){ return false; } );
add_filter( 'theme_mod_penci_preload_google_fonts', function(){ return false; } );
add_filter( 'theme_mod_penci_speed_move_icons', function(){ return false; } );
add_filter( 'theme_mod_penci_preload_all_stylesheets', function(){ return false; } );
add_filter( 'theme_mod_penci_preload_exclude_name', function(){ return ''; } );
add_filter( 'theme_mod_penci_preload_include_name', function(){ return ''; } );
add_filter( 'theme_mod_penci_speed_move_jquery_footer', function(){ return false; } );
add_filter( 'theme_mod_penci_speed_lazy_adsense', function(){ return false; } );
add_filter( 'theme_mod_penci_speed_add_defer', function(){ return false; } );
add_filter( 'theme_mod_penci_speed_add_more_defer', function(){ return ''; } );
add_filter( 'theme_mod_penci_speed_html_minify', function(){ return false; } );

if( get_theme_mod( 'penci_speed_disablelazyvideo' ) ){
	//turn off lazy for all video
	add_filter('hpp_allow_lazy_video', '__return_false');

	/**
	 *@param $ok - 0/false: disable lazy
	 *@param $str - embed code
	*/
	add_filter('hpp_allow_lazy_video', function($ok, $str){
		return $ok;
	}, 10,2);
}

add_filter('oembed_result', function($iframe_html, $video_url, $frame_attributes){
  //leave iframe tag but use lazyload feature
  return hpp_lazy_video($iframe_html, 2);
}, 20, 3);

/* Exclude CSS from lazyload images/iframe */
if( get_theme_mod( 'penci_speed_excludelazyload' ) ){
	add_filter('hpp_disallow_lazyload', function($ok, $tag){
		$exclude_lazy = get_theme_mod( 'penci_speed_excludelazyload' );
		$exclude_lazy_array = explode( ",", str_replace( ' ', '', $exclude_lazy ) );
		//class,src,srcset,.. ->attributes
		foreach( $exclude_lazy_array as $val1 ){
			if(strpos($tag, $val1 )!==false) return 1;
		}
		
		return $ok;
	},10,2);

	add_filter('hpp_disallow_lazyload_attr', function($ok, $tag){
		$exclude_lazy = get_theme_mod( 'penci_speed_excludelazyload' );
		$exclude_lazy_array = explode( ",", str_replace( ' ', '', $exclude_lazy ) );
		foreach( $exclude_lazy_array as $val2 ){
			if(strpos($tag['class'], $val2 )!==false) return 1;
		}
		
		return $ok;
	}, 10, 2);
}

} /* End check should lazy */