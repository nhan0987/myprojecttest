<?php
@ini_set('display_errors', '0');
error_reporting(0);

define('PENCI_SOLEDAD_VERSION', '7.9.2');
/**
 * Global content width
 *
 * @param $content_width
 *
 * @since 1.0
 * @return void
 */
if (! isset($content_width)) {
	$content_width = 1170;
}

/**
 * Theme setup
 * Hook to action after_setup_theme
 *
 * @since 1.0
 * @return void
 */
add_action('after_setup_theme', 'penci_soledad_theme_setup');
if (! function_exists('penci_soledad_theme_setup')) {
	function penci_soledad_theme_setup()
	{

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		$fontawesome_ver5 = get_theme_mod('penci_fontawesome_ver5');
		if ($fontawesome_ver5) {
			add_editor_style(array(get_template_directory_uri() . '/css/font-awesome.5.11.2.min.css'));
		}

		// Register navigation menu
		register_nav_menus(array(
			'main-menu'   => 'Primary Menu',
			'topbar-menu' => 'Topbar Menu',
			'footer-menu' => 'Footer Menu'
		));

		// Localization support
		load_theme_textdomain('soledad', get_template_directory() . '/languages');

		// Feed Links
		add_theme_support('automatic-feed-links');

		// Title tag
		add_theme_support('title-tag');

		// Post formats - we support 4 post format: standard, gallery, video and audio
		add_theme_support('post-formats', array('standard', 'gallery', 'video', 'audio', 'link', 'quote'));

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __('Small', 'soledad'),
					'shortName' => __('S', 'soledad'),
					'size'      => 12,
					'slug'      => 'small',
				),
				array(
					'name'      => __('Normal', 'soledad'),
					'shortName' => __('N', 'soledad'),
					'size'      => 14,
					'slug'      => 'normal',
				),
				array(
					'name'      => __('Medium', 'soledad'),
					'shortName' => __('M', 'soledad'),
					'size'      => 20,
					'slug'      => 'medium',
				),
				array(
					'name'      => __('Large', 'soledad'),
					'shortName' => __('L', 'soledad'),
					'size'      => 32,
					'slug'      => 'large',
				),
				array(
					'name'      => __('Huge', 'soledad'),
					'shortName' => __('XL', 'soledad'),
					'size'      => 42,
					'slug'      => 'huge',
				),
			)
		);

		// Post thumbnails
		add_theme_support('post-thumbnails');
		if (! get_theme_mod('penci_dthumb_1920_auto')): add_image_size('penci-single-full', 1920, 0, false);
		endif;
		if (! get_theme_mod('penci_dthumb_1920_800')): add_image_size('penci-slider-full-thumb', 1920, 800, true);
		endif;
		if (! get_theme_mod('penci_dthumb_1170_auto')): add_image_size('penci-full-thumb', 1170, 99999, false);
		endif;
		if (! get_theme_mod('penci_dthumb_1170_663')): add_image_size('penci-slider-thumb', 1170, 663, true);
		endif;
		if (! get_theme_mod('penci_dthumb_780_516')): add_image_size('penci-magazine-slider', 780, 516, true);
		endif;
		if (! get_theme_mod('penci_dthumb_585_390')): add_image_size('penci-thumb', 585, 390, true);
		endif;
		if (! get_theme_mod('penci_dthumb_585_auto')): add_image_size('penci-masonry-thumb', 585, 99999, false);
		endif;
		if (! get_theme_mod('penci_dthumb_585_585')): add_image_size('penci-thumb-square', 585, 585, true);
		endif;
		if (! get_theme_mod('penci_dthumb_480_650')): add_image_size('penci-thumb-vertical', 480, 650, true);
		endif;
		if (! get_theme_mod('penci_dthumb_263_175')): add_image_size('penci-thumb-small', 263, 175, true);
		endif;
	}
}

/**
 * Register Fonts
 *
 * @since 4.0
 */
if (! function_exists('penci_fonts_url')) {
	function penci_fonts_url($data = 'normal')
	{
		$font_url = '';

		$array_fonts = array('Raleway', 'PT Serif', 'Playfair Display SC', 'Montserrat');
		$array_get = array();
		$array_options = array();
		$array_earlyaccess = array();

		if (get_theme_mod('penci_font_for_title') && '"Raleway", "100:200:300:regular:500:600:700:800:900", sans-serif' != get_theme_mod('penci_font_for_title') && get_theme_mod('penci_font_for_menu') && '"Raleway", "100:200:300:regular:500:600:700:800:900", sans-serif' != get_theme_mod('penci_font_for_menu')) {
			$array_fonts = array_diff($array_fonts, array('Raleway'));
		}
		if (get_theme_mod('penci_font_for_body') && '"PT Serif", "regular:italic:700:700italic", serif' != get_theme_mod('penci_font_for_body') && get_theme_mod('penci_font_for_slogan') && '"PT Serif", "regular:italic:700:700italic", serif' != get_theme_mod('penci_font_for_slogan')) {
			$array_fonts = array_diff($array_fonts, array('PT Serif'));
		}

		if (get_theme_mod('penci_font_for_title')) {
			$array_options[] = get_theme_mod('penci_font_for_title');
		}
		if (get_theme_mod('penci_font_for_body')) {
			$array_options[] = get_theme_mod('penci_font_for_body');
		}
		if (get_theme_mod('penci_font_for_slogan')) {
			$array_options[] = get_theme_mod('penci_font_for_slogan');
		}
		if (get_theme_mod('penci_font_for_menu')) {
			$array_options[] = get_theme_mod('penci_font_for_menu');
		}

		if (! empty($array_options)) {
			$font_earlyaccess_keys = array_keys(penci_font_google_earlyaccess());

			foreach ($array_options as $font) {
				if (! in_array($font, $font_earlyaccess_keys)) {
					$font_family  = str_replace('"', '', $font);
					$font_family_explo   = explode(", ", $font_family);
					$array_get[]         = isset($font_family_explo[0]) ? $font_family_explo[0] : '';
				} else {
					$font_family  = str_replace('"', '', $font);
					$font_family_explo   = explode(", ", $font_family);
					if (isset($font_family_explo[0])) {
						$font_earlyaccess_name = strtolower(str_replace(' ', '', $font_family_explo[0]));
						$array_earlyaccess[] = $font_earlyaccess_name;
					}
				}
			}
		}
		$array_end = array_unique(array_merge($array_fonts, $array_get), SORT_REGULAR);

		$string_end = implode(':300,300italic,400,400italic,500,500italic,700,700italic,800,800italic|', $array_end);

		/*
	    Translators: If there are characters in your language that are not supported
	    by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
		if ('off' !== _x('on', 'Google font: on or off', 'soledad')) {
			$font_url = add_query_arg(
				array(
					'family' => urlencode($string_end . ':300,300italic,400,400italic,500,500italic,700,700italic,800,800italic&subset=latin,cyrillic,cyrillic-ext,greek,greek-ext,latin-ext'),
					'display' => 'swap',
				),
				"//fonts.googleapis.com/css"
			);
		}

		if ($data == 'earlyaccess') {
			return $array_earlyaccess;
		} else {
			return $font_url;
		}
	}
}

/**
 * Enqueue styles/scripts
 * Hook to action wp_enqueue_scripts
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_load_scripts')) {
	add_action('wp_enqueue_scripts', 'penci_load_scripts');
	function penci_load_scripts()
	{

		$localize_script = array(
			'url'     => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('ajax-nonce'),
			'errorPass'       => '<p class="message message-error">' . penci_get_setting('penci_plogin_mess_error_email_pass') . '</p>',
			'login'           => penci_get_setting('penci_plogin_email_place'),
			'password'        => penci_get_setting('penci_trans_pass_text'),
		);

		// Enqueue style
		if (! get_theme_mod('penci_disable_default_fonts')) {
			wp_enqueue_style('penci-fonts', penci_fonts_url(), array(), '1.0');
			$data_fonts = penci_fonts_url('earlyaccess');
			if (is_array($data_fonts) && ! empty($data_fonts)) {
				foreach ($data_fonts as $fontname) {
					wp_enqueue_style('penci-font-' . $fontname, '//fonts.googleapis.com/earlyaccess/' . esc_attr($fontname) . '.css', array(), '1.0');
				}
			}
		}

		if (! get_theme_mod('penci_speed_css_minify')) {
			wp_enqueue_style('penci-main-style', get_template_directory_uri() . '/main.css', array(), PENCI_SOLEDAD_VERSION);
		} else {
			wp_enqueue_style('penci-main-style', get_template_directory_uri() . '/main.min.css', array(), PENCI_SOLEDAD_VERSION);
		}

		if (class_exists('bbPress') || class_exists('BuddyPress')) {
			wp_enqueue_style('penci-buddypress-bbpress', get_template_directory_uri() . '/css/buddypress-bbpress.min.css', array(), PENCI_SOLEDAD_VERSION);
		}

		if (! get_theme_mod('penci_speed_move_icons') || get_theme_mod('penci_preload_font_icons')) {
			wp_enqueue_style('penci-font-awesomeold', get_template_directory_uri() . '/css/font-awesome.4.7.0.swap.min.css', array(), '4.7.0');
			if (! get_theme_mod('penci_speed_rweather_icons')) {
				wp_enqueue_style('penci-font-iweather', get_template_directory_uri() . '/css/weather-icon.swap.css', array(), '2.0');
			}

			$fontawesome_ver5 = penci_get_setting('penci_fontawesome_ver5');
			if ($fontawesome_ver5) {
				wp_enqueue_style('penci-font-awesome', get_template_directory_uri() . '/css/font-awesome.5.11.2.swap.min.css', array(), '5.11.2');
			}
		}

		wp_register_style('penci_icon', get_template_directory_uri() . '/css/penci-icon.css', array(), PENCI_SOLEDAD_VERSION);
		wp_enqueue_style('penci_style', get_stylesheet_directory_uri() . '/style.css', array(), PENCI_SOLEDAD_VERSION);

		// Enqueue script
		if (get_theme_mod('penci_speed_move_jquery_footer')) {
			wp_scripts()->add_data('jquery', 'group', 1);
			wp_scripts()->add_data('jquery-core', 'group', 1);
			wp_scripts()->add_data('jquery-migrate', 'group', 1);
		}

		if (get_theme_mod('penci_enable_featured_video_bg') || is_page()) {
			if (is_page()) {
				$metavideo = get_post_meta(get_the_ID(), 'penci_page_slider', true);
			}
			if (get_theme_mod('penci_enable_featured_video_bg') || (is_page() && 'video' == $metavideo)) {
				wp_enqueue_script('penci-video-background', get_template_directory_uri() . '/js/video-background.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);
			}
		}
		wp_enqueue_script('penci-libs-js', get_template_directory_uri() . '/js/libs-script.min.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);
		$check_mac   = strpos(getenv("HTTP_USER_AGENT"), 'Mac');
		if (get_theme_mod('penci_enable_smooth_scroll') && $check_mac == false) {
			wp_enqueue_script('penci-smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);
		}
		$minify_js = get_theme_mod('penci_speed_js_minify');
		$sub_fix_min = $minify_js ? '.min' : '';

		wp_enqueue_script('main-scripts', get_template_directory_uri() . '/js/main' . $sub_fix_min . '.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);

		if (defined('ELEMENTOR_VERSION')) {
			if (\Elementor\Plugin::$instance->preview->is_preview_mode()) {
				wp_enqueue_script('penci-elementor', get_template_directory_uri() . '/js/elementor.js', array('main-scripts'), PENCI_SOLEDAD_VERSION, true);
				wp_localize_script('penci-elementor', 'ajax_var_more', $localize_script);
			}
		}

		wp_localize_script('main-scripts', 'ajax_var_more', $localize_script);

		wp_enqueue_script('penci_ajax_like_post', get_template_directory_uri() . '/js/post-like' . $sub_fix_min . '.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);
		wp_localize_script('penci_ajax_like_post', 'ajax_var', $localize_script);
		wp_register_script('penci_ajax_more_posts', get_template_directory_uri() . '/js/more-post' . $sub_fix_min . '.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);
		wp_register_script('penci_ajax_more_scroll', get_template_directory_uri() . '/js/more-post-scroll' . $sub_fix_min . '.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);
		wp_register_script('penci_ajax_archive_more_scroll', get_template_directory_uri() . '/js/archive-more-post' . $sub_fix_min . '.js', array('jquery'), PENCI_SOLEDAD_VERSION, true);

		if (get_theme_mod('penci_page_navigation_ajax') && ! get_theme_mod('penci_page_navigation_scroll')) {
			wp_enqueue_script('penci_ajax_more_posts');
			wp_localize_script('penci_ajax_more_posts', 'ajax_var_more', $localize_script);
		}

		if (get_theme_mod('penci_page_navigation_scroll')) {
			wp_enqueue_script('penci_ajax_more_scroll');
			wp_localize_script('penci_ajax_more_scroll', 'ajax_var_more', $localize_script);
		}

		if (get_theme_mod('penci_archive_nav_ajax') || get_theme_mod('penci_archive_nav_scroll')) {
			wp_enqueue_script('penci_ajax_archive_more_scroll');
			wp_localize_script('penci_ajax_archive_more_scroll', 'SOLEDADLOCALIZE', $localize_script);
		}

		// js for comments
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}

/**
 * Enqueue styles/scripts
 * Hook to action wp_enqueue_scripts
 *
 * @since 2.0
 * @return void
 */
if (! function_exists('penci_load_admin_scripts')) {
	add_action('admin_enqueue_scripts', 'penci_load_admin_scripts');
	function penci_load_admin_scripts($hook)
	{

		wp_enqueue_style('admin-css', get_template_directory_uri() . '/css/admin.css');
		wp_enqueue_script('opts-field-upload-js', get_template_directory_uri() . '/js/field_upload.js', array('jquery'), '1.0', true);
		wp_enqueue_media();
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('penci-opts-color-js', get_template_directory_uri() . '/js/field_color.js', array('jquery', 'wp-color-picker'), '1.0', true);
		wp_enqueue_script('jquery-ui-sortable', array('jquery'));
		wp_enqueue_script('reorder-slides', get_template_directory_uri() . '/js/reorder.js', array('jquery'), false, '1.0');

		if ($hook == 'widgets.php' || 'nav-menus.php' == $hook) {
			wp_enqueue_script('penci-admin-widget', get_template_directory_uri() . '/js/admin-widget.js', array('jquery'), '1.0', true);

			wp_localize_script('penci-admin-widget', 'Penci', array(
				'ajaxUrl'            => admin_url('admin-ajax.php'),
				'nonce'              => wp_create_nonce('ajax-nonce'),
				'sidebarAddFails'    => esc_html__('Adding custom sidebar fails.', 'soledad'),
				'sidebarRemoveFails' => esc_html__('Removing custom sidebar fails.', 'soledad'),
				'cfRemovesidebar'    => esc_html__('Are you sure you want to remove this custom sidebar?', 'soledad'),
			));
		}
	}
}

/**
 * Functions callback when more posts clicked for archive pages
 *
 * @since 6.0
 */
if (! function_exists('penci_archive_more_post_ajax_func')):

	add_action('wp_ajax_nopriv_penci_archive_more_post_ajax', 'penci_archive_more_post_ajax_func');
	add_action('wp_ajax_penci_archive_more_post_ajax', 'penci_archive_more_post_ajax_func');

	function penci_archive_more_post_ajax_func()
	{
		if (is_user_logged_in()) {
			$nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';
			if (! wp_verify_nonce($nonce, 'ajax-nonce')) {
				die('Nope!');
			}
		}

		$ppp          = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;
		$offset       = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
		$layout       = (isset($_POST['layout'])) ? $_POST['layout'] : 'grid';
		$archivetype  = isset($_POST['archivetype']) ? $_POST['archivetype'] : '';
		$archivevalue = isset($_POST['archivevalue']) ? $_POST['archivevalue'] : '';
		$from         = (isset($_POST['from'])) ? $_POST['from'] : 'customize';
		$template     = (isset($_POST['template'])) ? $_POST['template'] : 'sidebar';

		$orderby = get_theme_mod('penci_general_post_orderby');

		if (!$orderby): $orderby = 'date';
		endif;

		$order = get_theme_mod('penci_general_post_order');
		if (! $order) : $order = 'DESC';
		endif;

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $ppp,
			'post_status'    => 'publish',
			'offset'         => $offset,
			'orderby'        => $orderby,
			'order'          => $order
		);

		if ('cat' == $archivetype) {
			$args['cat'] = $archivevalue;
		} elseif ('tag' == $archivetype) {
			$args['tag_id'] = $archivevalue;
		} elseif ('day' == $archivetype) {
			$date_arr = explode('|', $archivevalue);
			$args['date_query'] = array(
				array(
					'year'  => isset($date_arr[2]) ? $date_arr[2] : '',
					'month' => isset($date_arr[0]) ? $date_arr[0] : '',
					'day'   => isset($date_arr[1]) ? $date_arr[1] : ''
				)
			);
		} elseif ('month' == $archivetype) {
			$date_arr = explode('|', $archivevalue);
			$args['date_query'] = array(
				array(
					'year'  => isset($date_arr[2]) ? $date_arr[2] : '',
					'month' => isset($date_arr[0]) ? $date_arr[0] : '',
				)
			);
		} elseif ('year' == $archivetype) {
			$date_arr = explode('|', $archivevalue);
			$args['date_query'] = array(
				array(
					'year'  => isset($date_arr[2]) ? $date_arr[2] : ''
				)
			);
		} elseif ('search' == $archivetype) {
			$args['s'] = $archivevalue;

			if (! get_theme_mod('penci_include_search_page')) {
				$post_types = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'names');
				$array_include = array();
				foreach ($post_types as $key => $val) {
					if ('page' != $key) {
						$array_include[] = $key;
					}
				}
				$args['post_type'] = $array_include;
			} else {
				if (isset($args['post_type'])) {
					unset($args['post_type']);
				}
			}
		} elseif ('author' == $archivetype) {
			$args['author'] = $archivevalue;

			if (isset($args['post_type'])) {
				unset($args['post_type']);
			}
		} elseif ($archivetype && $archivevalue) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $archivetype,
					'field'    => 'term_id',
					'terms'    => array($archivevalue),
				)
			);
		}

		$loop = new WP_Query($args);

		if ($loop->have_posts()) :
			$infeed_ads = get_theme_mod('penci_infeedads_archi_code') ? get_theme_mod('penci_infeedads_archi_code') : '';
			$infeed_num = get_theme_mod('penci_infeedads_archi_num') ? get_theme_mod('penci_infeedads_archi_num') : 3;
			$infeed_full = get_theme_mod('penci_infeedads_archi_layout') ? get_theme_mod('penci_infeedads_archi_layout') : '';
			while ($loop->have_posts()) : $loop->the_post();
				include(locate_template('content-' . $layout . '.php'));
			endwhile;
		endif;

		wp_reset_postdata();

		exit;
	}
endif;
/**
 * Functions callback when more posts clicked for homepage
 *
 * @since 2.5
 */
if (! function_exists('penci_more_post_ajax_func')) {
	add_action('wp_ajax_nopriv_penci_more_post_ajax', 'penci_more_post_ajax_func');
	add_action('wp_ajax_penci_more_post_ajax', 'penci_more_post_ajax_func');
	function penci_more_post_ajax_func()
	{
		if (is_user_logged_in()) {
			$nonce = $_POST['nonce'];
			if (! wp_verify_nonce($nonce, 'ajax-nonce')) {
				die('Nope!');
			}
		}

		$ppp    = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;
		$offset   = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
		$layout = (isset($_POST['layout'])) ? $_POST['layout'] : 'grid';
		$exclude = (isset($_POST['exclude'])) ? $_POST['exclude'] : '';
		$from = (isset($_POST['from'])) ? $_POST['from'] : 'customize';
		$come_from = (isset($_POST['comefrom'])) ? $_POST['comefrom'] : '';
		$template = (isset($_POST['template'])) ? $_POST['template'] : 'sidebar';
		$penci_mixed_style = (isset($_POST['mixed'])) ? $_POST['mixed'] : 'mixed';
		$penci_vc_query = (isset($_POST['query'])) ? $_POST['query'] : 'query';
		$penci_infeedads = (isset($_POST['infeedads'])) ? $_POST['infeedads'] : array();
		$penci_vc_number = (isset($_POST['number'])) ? $_POST['number'] : '10';
		$atts          = isset($_POST['datafilter']) ? $_POST['datafilter'] : array();


		// Add more option enable or hide
		$standard_title_length = $grid_title_length = 10;

		if ($atts && is_array($atts)) {
			extract($atts);
		}

		$standard_title_length = $standard_title_length ? $standard_title_length : 10;
		$grid_title_length     = $grid_title_length ? $grid_title_length : 10;

		//header( "Content-Type: text/html" );

		$orderby = get_theme_mod('penci_general_post_orderby');
		if (!$orderby): $orderby = 'date';
		endif;
		$order = get_theme_mod('penci_general_post_order');
		if (!$order): $order = 'DESC';
		endif;

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $ppp,
			'post_status'    => 'publish',
			'offset'         => $offset,
			'orderby'        => $orderby,
			'order'          => $order
		);

		$exclude_cats = '';
		if ($from == 'vc' && $exclude) {
			$exclude_cats = $exclude;
		} else if ($from == 'customize' && (get_theme_mod('penci_exclude_featured_cat') || get_theme_mod('penci_home_exclude_cat'))) {
			$feat_query = penci_global_query_featured_slider();


			if ($feat_query) {

				$list_post_ids = array();
				if ($feat_query->have_posts()) {
					while ($feat_query->have_posts()) : $feat_query->the_post();
						$list_post_ids[] = get_the_ID();
					endwhile;
					wp_reset_postdata();
				}

				$args['post__not_in'] =  $list_post_ids;
			}

			if (get_theme_mod('penci_home_exclude_cat')) {
				$exclude_cats       = get_theme_mod('penci_home_exclude_cat');
			}
		}

		if ($exclude_cats) {
			$exclude_cats  = str_replace(' ', '', $exclude_cats);
			$exclude_array = explode(',', $exclude_cats);

			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $exclude_array,
					'operator' => 'NOT IN'
				)
			);
		}
		if ($from == 'vc' && $penci_vc_query) {
			$args = $penci_vc_query;

			$new_offset = (isset($args['offset']) && $args['offset']) ? intval($args['offset']) : 0;
			$args['offset'] =   $new_offset + $offset;
			$args['posts_per_page'] =   $penci_vc_number;
		}

		$args['post_status'] = 'publish';

		$loop = new WP_Query($args);

		if ($loop->have_posts()) :
			/* In-feed ads data */
			$infeed_ads = $infeed_num = $infeed_full = '';
			if ('vc-elementor' == $come_from) {
				$data_infeeds = $penci_infeedads;
				if (! empty($data_infeeds)) {
					$infeed_ads = (isset($data_infeeds['ads_code']) && $data_infeeds['ads_code']) ? rawurldecode(base64_decode($data_infeeds['ads_code'])) : '';
					$infeed_num = (isset($data_infeeds['ads_num']) && $data_infeeds['ads_num']) ? $data_infeeds['ads_num'] : 3;
					$infeed_full = (isset($data_infeeds['ads_full']) && $data_infeeds['ads_full']) ? $data_infeeds['ads_full'] : '';
				}
			} else {
				$infeed_ads = get_theme_mod('penci_infeedads_home_code') ? get_theme_mod('penci_infeedads_home_code') : '';
				$infeed_num = get_theme_mod('penci_infeedads_home_num') ? get_theme_mod('penci_infeedads_home_num') : 3;
				$infeed_full = get_theme_mod('penci_infeedads_home_layout') ? get_theme_mod('penci_infeedads_home_layout') : '';
			}

			while ($loop->have_posts()) : $loop->the_post();
				if ('vc-elementor' == $come_from) {
					include(locate_template('template-parts/latest-posts-sc/content-' . $layout . '.php'));
				} else {
					include(locate_template('content-' . $layout . '.php'));
				}

			endwhile;
		endif;

		wp_reset_postdata();

		exit;
	}
}

/**
 * Fallback when menu location is not checked
 * Callback function in wp_nav_menu() on header.php
 *
 * @since 1.0
 */
if (! function_exists('penci_menu_fallback')) {
	function penci_menu_fallback()
	{
		if (! current_user_can('manage_options')) {
			echo '<ul class="menu penci-topbar-menu"><li class="menu-item-first"><a href="' . esc_url(home_url('/')) . '">Home</a></li></ul>';
		} else {
			echo '<ul class="menu penci-topbar-menu"><li class="menu-item-first"><a href="' . esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations">Create or select a menu</a></li></ul>';
		}
	}
}

/**
 * Add more penci-body-boxed to body_class() function
 * This class will add more when body boxed is enable
 *
 * @package Wordpress
 * @since 1.0
 */

if (! function_exists('penci_add_more_body_boxed_class')) {
	add_filter('body_class', 'penci_add_more_body_boxed_class');
	function penci_add_more_body_boxed_class($classes)
	{
		if (get_theme_mod('penci_body_boxed_layout') && ! get_theme_mod('penci_vertical_nav_show')) {
			// add 'penci-body-boxed' to the $classes array
			$classes[] = 'penci-body-boxed';
		}

		if (defined('PENCI_SOLEDAD_VERSION')) {
			$version = PENCI_SOLEDAD_VERSION;
			$version_render = 'soledad-ver-' . str_replace('.', '-', $version);
			$classes[] = $version_render;
		}

		if (get_theme_mod('penci_vertical_nav_show')) {
			$classes[] = 'penci-vernav-enable';
			$class_post = 'penci-vernav-poleft';
			if (get_theme_mod('penci_menu_hbg_pos') == 'right') {
				$class_post = 'penci-vernav-poright';
			}
			$classes[] = $class_post;
		}

		if (get_theme_mod('penci_vernav_click_parent')) {
			$classes[] = 'penci-vernav-cparent';
		}

		if (get_theme_mod('penci_menu_hbg_click_parent')) {
			$classes[] = 'penci-hbg-cparent';
		}

		if (is_singular() && ! is_page()) {
			$single_style = penci_get_single_style();

			if (in_array($single_style, array('style-1', 'style-2'))) {
				return $classes;
			}

			$classes[] = 'penci-body-single-' . $single_style;

			if (get_theme_mod('penci_move_title_bellow')) {
				$classes[] = 'penci-body-title-bellow';
			}

			$post_format = get_post_format();
			if (! has_post_thumbnail() || (get_theme_mod('penci_post_thumb') && ! in_array($post_format, array('link', 'quote', 'gallery', 'video', 'audio')))) {
				$classes[] = 'penci-hide-pthumb';
			} else {
				$classes[] = 'penci-show-pthumb';
			}
		}

		return $classes;
	}
}

/**
 * Define class for call in javascript when enable lightbox videos for video posts format
 *
 * @since 4.0.3
 */
if (! function_exists('penci_class_lightbox_enable')) {
	function penci_class_lightbox_enable()
	{
		$return = '';
		$post_id = get_the_ID();

		if (has_post_format('video', $post_id) && get_theme_mod('penci_grid_lightbox_video')) {
			$penci_video_data = get_post_meta($post_id, '_format_video_embed', true);
			if ($penci_video_data) {
				$return = ' penci-other-layouts-lighbox';
			}
		}

		return $return;
	}
}

/**
 * Define permalink for enable lightbox videos for video posts format
 *
 * @since 4.0.3
 */
if (! function_exists('penci_permalink_fix')) {
	function penci_permalink_fix()
	{
		$return = get_the_permalink();
		$post_id = get_the_ID();


		if (has_post_format('video', $post_id) && get_theme_mod('penci_grid_lightbox_video')) {
			$penci_video_data = get_post_meta($post_id, '_format_video_embed', true);
			if ($penci_video_data) {
				if (wp_oembed_get($penci_video_data)) {
					$return = $penci_video_data;
				} else {
					if (strpos($penci_video_data, 'youtube.com') > 0) {
						preg_match('/embed\/([\w+\-+]+)[\"\?]/', $penci_video_data, $matches);
						if ($matches[1]) {
							$return = 'https://www.youtube.com/watch?v=' . $matches[1];
						}
					} elseif (strpos($penci_video_data, 'vimeo.com') > 0) {
						preg_match('/player\.vimeo\.com\/video\/([0-9]*)/', $penci_video_data, $matches);
						if ($matches[1]) {
							$return = 'https://vimeo.com/' . $matches[1];
						}
					}
				}
			}
		}

		echo $return;
	}
}

/**
 * Penci Allow HTML use in data validation wp_kses()
 *
 * @since 1.0
 * @return array HTML allow
 */
if (! function_exists('penci_allow_html')) {
	function penci_allow_html()
	{
		$return = array(
			'a'      => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
				'title'  => array()
			),
			'div'    => array(
				'class' => array(),
				'id'    => array(),
			),
			'ul'     => array(
				'class' => array(),
				'id'    => array()
			),
			'ol'     => array(
				'class' => array(),
				'id'    => array()
			),
			'li'     => array(
				'class' => array(),
				'id'    => array()
			),
			'br'     => array(),
			'h1'     => array(
				'class' => array(),
				'id'    => array()
			),
			'h2'     => array(
				'class' => array(),
				'id'    => array()
			),
			'h3'     => array(
				'class' => array(),
				'id'    => array()
			),
			'h4'     => array(
				'class' => array(),
				'id'    => array()
			),
			'h5'     => array(
				'class' => array(),
				'id'    => array()
			),
			'h6'     => array(
				'class' => array(),
				'id'    => array()
			),
			'img'    => array(
				'alt'   => array(),
				'src'   => array(),
				'title' => array()
			),
			'em'     => array(),
			'b'      => array(),
			'i'      => array(
				'class' => array(),
				'id'    => array()
			),
			'strong' => array(
				'class' => array(),
				'id'    => array()
			),
			'span'   => array(
				'class' => array(),
				'id'    => array()
			),
		);

		return $return;
	}
}

/**
 * Get categories array
 *
 * @since 1.0
 * @return array $categories
 */
if (! function_exists('penci_list_categories')) {
	function penci_list_categories()
	{
		$categories = get_categories(array(
			'hide_empty' => 0
		));

		$return = array();
		foreach ($categories as $cat) {
			$return[$cat->cat_name] = $cat->term_id;
		}

		return $return;
	}
}


/**
 * Modify more tag
 *
 * @since 1.0
 * @return new markup more tags
 */
if (! function_exists('penci_modify_more_tags')) {
	/**
	 * @param $link
	 *
	 * @return string
	 */
	function penci_modify_more_tags($link)
	{

		$class = 'penci-more-link';
		if (get_theme_mod('penci_standard_continue_reading_button')):
			$class = 'penci-more-link penci-more-link-button';
		endif;

		return '<div class="' . $class . '">' . $link . '</div>';
	}

	add_filter('the_content_more_link', 'penci_modify_more_tags');
}

/**
 * Include Files
 *
 * @since 1.0
 * @return void
 */

// Customizer
include(trailingslashit(get_template_directory()) . 'inc/customizer/default.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/controller.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/sanitizing.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/customizer.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/generate-css-file.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/style.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/style-page-header-title.php');
include(trailingslashit(get_template_directory()) . 'inc/customizer/style-page-header-transparent.php');
include(trailingslashit(get_template_directory()) . 'inc/fonts/fonts.php');

// Modules
include(trailingslashit(get_template_directory()) . 'inc/theme-updates.php');
include(trailingslashit(get_template_directory()) . 'inc/modules/penci-render.php');
include(trailingslashit(get_template_directory()) . 'inc/modules/penci-walker.php');
include(trailingslashit(get_template_directory()) . 'inc/modules/svg-social.php');
include(trailingslashit(get_template_directory()) . 'inc/template-function.php');
include(trailingslashit(get_template_directory()) . 'inc/videos-playlist.php');
include(trailingslashit(get_template_directory()) . 'inc/weather.php');
include(trailingslashit(get_template_directory()) . 'inc/login-popup.php');
include(trailingslashit(get_template_directory()) . 'inc/social-counter/social-counter.php');
include(trailingslashit(get_template_directory()) . 'inc/detect_mobile.php');

// Widgets
if (! function_exists('penci_use_widget_title_html')) {
	add_action('init', 'penci_use_widget_title_html', 999);
	function penci_use_widget_title_html()
	{
		remove_filter('widget_title', 'esc_html');
	}
}
include(trailingslashit(get_template_directory()) . 'inc/widgets/about_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/facebook_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/lastest_post_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/related_post_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/posts_slider_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/popular_post_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/social_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/quote_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/pinterest_widget.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/list_banner.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/login_register_widgets.php');
include(trailingslashit(get_template_directory()) . 'inc/widgets/video_playlist.php');

if (function_exists('getTweets')) {
	include(trailingslashit(get_template_directory()) . 'inc/widgets/latest_tweets.php');
}

// Like post
include(trailingslashit(get_template_directory()) . 'inc/like_post/post-like.php');

// Meta box
include(trailingslashit(get_template_directory()) . 'inc/meta-box/meta-box.php');
include(trailingslashit(get_template_directory()) . 'inc/meta-box/categories-meta-box.php');
include(trailingslashit(get_template_directory()) . 'inc/custom-sidebar.php');

/**
 * Register main sidebar and sidebars in footer
 *
 * @since 1.0
 * @return void
 */
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => esc_html__('Main Sidebar', 'soledad'),
		'id'            => 'main-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title penci-border-arrow"><span class="inner-arrow">',
		'after_title'   => '</span></h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Main Sidebar Left', 'soledad'),
		'id'            => 'main-sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title penci-border-arrow"><span class="inner-arrow">',
		'after_title'   => '</span></h3>',
	));

	for ($i = 1; $i <= 4; $i++) {
		register_sidebar(array(
			'name'          => sprintf(esc_html__('Footer Column #%s', 'soledad'), $i),
			'id'            => 'footer-' . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
			'after_title'   => '</span></h4>',
		));
	}

	register_sidebar(array(
		'name'          => esc_html__('Header Signup Form', 'soledad'),
		'id'            => 'header-signup-form',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="header-signup-form">',
		'after_title'   => '</h4>',
		'description'   => 'Only use for MailChimp Sign-Up Form widget. Display your Sign-Up Form widget below the header. Please use markup we provide here: https://soledad.pencidesign.net/soledad-document/#widgets to display exact',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Signup Form', 'soledad'),
		'id'            => 'footer-signup-form',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="footer-subscribe-title">',
		'after_title'   => '</h4>',
		'description'   => 'Only use for MailChimp Sign-Up Form widget. Display your Sign-Up Form widget below on the footer. Please use markup we provide here: https://soledad.pencidesign.net/soledad-document/#widgets to display exact',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Instagram', 'soledad'),
		'id'            => 'footer-instagram',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="footer-instagram-title"><span><span class="title">',
		'after_title'   => '</span></span></h4>',
		'description'   => esc_html__('Only use for Instagram Slider widget. Display instagram images on your website footer', 'soledad'),
	));

	register_sidebar(array(
		'name'          => esc_html__('Top Instagram', 'soledad'),
		'id'            => 'top-instagram',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="footer-instagram-title top-instagram-title"><span><span class="title">',
		'after_title'   => '</span></span></h4>',
		'description'   => esc_html__('Only use for Instagram Slider widget. Display instagram images on the top of your website', 'soledad'),
	));

	register_sidebar(array(
		'name'          => esc_html__('Sidebar Hamburger Widgets Above Menu', 'soledad'),
		'id'            => 'menu_hamburger_1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
		'after_title'   => '</span></h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Sidebar Hamburger Widgets Below Menu', 'soledad'),
		'id'            => 'menu_hamburger_2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
		'after_title'   => '</span></h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Sidebar For Shop Page & Shop Archive', 'soledad'),
		'id'            => 'penci-shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
		'after_title'   => '</span></h4>',
		'description'   => 'This sidebar for Shop Page & Shop Archive, if this sidebar is empty, will display Main Sidebar',
	));

	register_sidebar(array(
		'name'          => esc_html__('Sidebar For Single Product', 'soledad'),
		'id'            => 'penci-shop-single',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
		'after_title'   => '</span></h4>',
		'description'   => 'This sidebar for Single Product, if this sidebar is empty, will display Main Sidebar',
	));

	if (class_exists('bbPress')) {
		register_sidebar(array(
			'name'          => esc_html__('Sidebar For BbPress', 'soledad'),
			'id'            => 'penci-bbpress',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
			'after_title'   => '</span></h4>',
			'description'   => 'This sidebar for Single Product, if this sidebar is empty, will display Main Sidebar',
		));
	}

	if (class_exists('BuddyPress')) {
		register_sidebar(array(
			'name'          => esc_html__('Sidebar For BuddyPress', 'soledad'),
			'id'            => 'penci-buddypress',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
			'after_title'   => '</span></h4>',
			'description'   => 'This sidebar for Single Product, if this sidebar is empty, will display Main Sidebar',
		));
	}

	for ($i = 1; $i <= 10; $i++) {
		register_sidebar(array(
			'name'          => sprintf(esc_html__('Custom Sidebar %s', 'soledad'), $i),
			'id'            => 'custom-sidebar-' . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title penci-border-arrow"><span class="inner-arrow">',
			'after_title'   => '</span></h4>',
		));
	}
}

/**
 * Include default fonts support by browser
 *
 * @since 2.0
 * @return array list $penci_font_browser_arr
 */
if (! function_exists('penci_font_browser')) {
	function penci_font_browser()
	{
		$penci_font_browser_arr = array('-apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"' => 'System Font');
		$penci_font_browser     = array(
			'Arial, Helvetica, sans-serif',
			'Helvetica, sans-serif',
			'"Arial Black", Gadget, sans-serif',
			'"Comic Sans MS", cursive, sans-serif',
			'Impact, Charcoal, sans-serif',
			'"Lucida Sans Unicode", "Lucida Grande", sans-serif',
			'Tahoma, Geneva, sans-serif',
			'"Trebuchet MS", Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
			'Georgia, serif',
			'"Palatino Linotype", "Book Antiqua", Palatino, serif',
			'"Times New Roman", Times, serif',
			'"Courier New", Courier, monospace',
			'"Lucida Console", Monaco, monospace',
		);
		foreach ($penci_font_browser as $font) {
			$penci_font_browser_arr[$font] = $font;
		}

		return $penci_font_browser_arr;
	}
}

/**
 * Merge 2 array fonts to one array
 *
 * @since 1.0
 * @return array fonts $penci_font_browser_arr
 */
if (! function_exists('penci_all_fonts')) {
	function penci_all_fonts()
	{
		return array_merge(
			penci_get_custom_fonts(),
			penci_font_browser(),
			penci_list_google_fonts_array()
		);
	}
}

if (! function_exists('penci_get_custom_fonts')) {
	function penci_get_custom_fonts()
	{
		$fontfamily1 = penci_get_option('soledad_custom_fontfamily1');
		$fontfamily2 = penci_get_option('soledad_custom_fontfamily2');
		$fontfamily3 = penci_get_option('soledad_custom_fontfamily3');
		$fontfamily4 = penci_get_option('soledad_custom_fontfamily4');
		$fontfamily5 = penci_get_option('soledad_custom_fontfamily5');
		$fontfamily6 = penci_get_option('soledad_custom_fontfamily6');
		$fontfamily7 = penci_get_option('soledad_custom_fontfamily7');
		$fontfamily8 = penci_get_option('soledad_custom_fontfamily8');
		$fontfamily9 = penci_get_option('soledad_custom_fontfamily9');
		$fontfamily10 = penci_get_option('soledad_custom_fontfamily10');


		$list_fonts = array();

		if ($fontfamily1) {
			$list_fonts[$fontfamily1] = $fontfamily1;
		}
		if ($fontfamily2) {
			$list_fonts[$fontfamily2] = $fontfamily2;
		}

		if ($fontfamily3) {
			$list_fonts[$fontfamily3] = $fontfamily3;
		}

		if ($fontfamily4) {
			$list_fonts[$fontfamily4] = $fontfamily4;
		}

		if ($fontfamily5) {
			$list_fonts[$fontfamily5] = $fontfamily5;
		}

		if ($fontfamily6) {
			$list_fonts[$fontfamily6] = $fontfamily6;
		}

		if ($fontfamily7) {
			$list_fonts[$fontfamily7] = $fontfamily7;
		}

		if ($fontfamily8) {
			$list_fonts[$fontfamily8] = $fontfamily8;
		}

		if ($fontfamily9) {
			$list_fonts[$fontfamily9] = $fontfamily9;
		}

		if ($fontfamily10) {
			$list_fonts[$fontfamily10] = $fontfamily10;
		}

		return $list_fonts;
	}
}

/**
 * Modify category widget defaults
 * Hook to wp_list_categories
 *
 * @since 1.0
 */
if (! function_exists('penci_add_more_span_cat_count')) {
	add_filter('wp_list_categories', 'penci_add_more_span_cat_count');
	function penci_add_more_span_cat_count($links)
	{

		$links = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="category-item-count">(\\1)</span></a>', $links);

		return $links;
	}
}

/**
 * Custom number posts per page on homepage
 *
 * @since 1.0
 * @return void
 */
if (get_theme_mod('penci_home_lastest_posts_numbers')) {
	if (! function_exists('penci_custom_posts_per_page_for_home')) {
		function penci_custom_posts_per_page_for_home($query)
		{
			$blog_posts = get_option('posts_per_page ');
			$posts_page = get_theme_mod('penci_home_lastest_posts_numbers');
			if (is_numeric($posts_page) && $posts_page > 0 && $posts_page != $blog_posts) {
				if ($query->is_home() && $query->is_main_query()) {
					$query->set('posts_per_page', $posts_page);
				}
			}
		}

		add_action('pre_get_posts', 'penci_custom_posts_per_page_for_home');
	}
}

/**
 * Custom number posts per page on portfolio
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_portfolio_posts_numbers')) {
	function penci_portfolio_posts_numbers($query)
	{
		$blog_posts = get_option('posts_per_page ');
		if ($query->is_tax('portfolio-category') && $query->is_main_query()) {
			$query->set('posts_per_page', $blog_posts);
		}
	}

	add_action('pre_get_posts', 'penci_portfolio_posts_numbers');
}

/**
 * Custom orderby & order post
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_custom_posts_oderby')) {
	function penci_custom_posts_oderby($query)
	{
		if (($query->is_home() && $query->is_main_query()) || ($query->is_archive() && $query->is_main_query())) {
			$orderby = get_theme_mod('penci_general_post_orderby');
			if (!$orderby): $orderby = 'date';
			endif;
			$order = get_theme_mod('penci_general_post_order');
			if (!$order): $order = 'DESC';
			endif;

			if (! function_exists('is_woocommerce') || (function_exists('is_woocommerce') && ! is_woocommerce())) {
				$query->set('orderby', $orderby);
				$query->set('order', $order);
			}
		}
	}

	add_action('pre_get_posts', 'penci_custom_posts_oderby');
}

/**
 * Add lightbox for single post by filter
 * Hook to the_content() function
 *
 * @since 1.0
 */
if (! function_exists('penci_filter_image_attr')) {
	if (! get_theme_mod('penci_disable_lightbox_single')) {
		add_filter('the_content', 'penci_filter_image_attr');
		function penci_filter_image_attr($content)
		{
			global $post;

			if (!is_home() && !is_archive()):
				$pattern     = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)><img/i";
				$replacement = '<a$1href=$2$3.$4$5 data-rel="penci-gallery-image-content" $6><img';
				$content     = preg_replace($pattern, $replacement, $content);
			endif;

			return $content;
		}
	}
}

/**
 * Pagination next post and previous post
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_soledad_archive_pag_style')):
	function penci_soledad_archive_pag_style($layout_this)
	{

		if (get_theme_mod('penci_archive_nav_ajax') || get_theme_mod('penci_archive_nav_scroll')) {

			$button_class = 'penci-ajax-more penci-ajax-arch';
			if (get_theme_mod('penci_archive_nav_scroll')) {
				$button_class .= ' penci-infinite-scroll';
			}

			$data_layout = $layout_this;
			if (in_array($layout_this, array('standard-grid', 'classic-grid', 'overlay-grid'))) {
				$data_layout = 'grid';
			} elseif (in_array($layout_this, array('standard-grid-2', 'classic-grid-2'))) {
				$data_layout = 'grid-2';
			} elseif (in_array($layout_this, array('standard-list', 'classic-list', 'overlay-list'))) {
				$data_layout = 'list';
			} elseif (in_array($layout_this, array('standard-boxed-1', 'classic-boxed-1'))) {
				$data_layout = 'boxed-1';
			}

			$data_template = 'sidebar';
			if (! penci_get_setting('penci_sidebar_archive')):
				$data_template = 'no-sidebar';
			endif;

			$offset_number = get_option('posts_per_page');

			$num_load = 6;
			if (get_theme_mod('penci_arc_number_load_more') && 0 != get_theme_mod('penci_arc_number_load_more')):
				$num_load = get_theme_mod('penci_arc_number_load_more');
			endif;
?>
			<?php

			$data_archive_type = '';
			$data_archive_value = '';
			if (is_category()) :
				$category = get_category(get_query_var('cat'));
				$cat_id = isset($category->cat_ID) ? $category->cat_ID : '';
				$data_archive_type = 'cat';
				$data_archive_value = $cat_id;
				$opt_cat = 'category_' . $cat_id;
				$cat_meta     = get_option($opt_cat);
				$sidebar_opts = isset($cat_meta['cat_sidebar_display']) ? $cat_meta['cat_sidebar_display'] : '';
				if ($sidebar_opts == 'no'):
					$data_template = 'no-sidebar';
				elseif ($sidebar_opts == 'left' || $sidebar_opts == 'right'):
					$data_template = 'sidebar';
				endif;

			elseif (is_tag()) :
				$tag = get_queried_object();
				$tag_id = isset($tag->term_id) ? $tag->term_id : '';
				$data_archive_type = 'tag';
				$data_archive_value = $tag_id;
			elseif (is_day()) :
				$data_archive_type = 'day';
				$data_archive_value = get_the_date('m|d|Y');
			elseif (is_month()) :
				$data_archive_type = 'month';
				$data_archive_value = get_the_date('m|d|Y');
			elseif (is_year()) :
				$data_archive_type = 'year';
				$data_archive_value = get_the_date('m|d|Y');
			elseif (is_search()) :
				$data_archive_type = 'search';
				$data_archive_value = get_search_query();
			elseif (is_author()) :

				global $authordata;
				$user_id = isset($authordata->ID) ? $authordata->ID : 0;

				$data_archive_type = 'author';
				$data_archive_value = $user_id;
			elseif (is_archive()) :
				$queried_object = get_queried_object();
				$term_id = isset($queried_object->term_id) ? $queried_object->term_id : '';
				$tax = get_taxonomy(get_queried_object()->taxonomy);
				$tax_name = isset($tax->name) ? $tax->name : '';

				if ($term_id && $tax_name) {
					$data_archive_type = $tax_name;
					$data_archive_value = $term_id;
				}
			endif;

			$button_data = 'data-mes="' . penci_get_setting('penci_trans_no_more_posts') . '"';
			$button_data .= ' data-layout="' . esc_attr($data_layout) . '"';
			$button_data .= ' data-number="' . absint($num_load) . '"';
			$button_data .= ' data-offset="' . absint($offset_number) . '"';
			$button_data .= ' data-from="customize"';
			$button_data .= ' data-template="' . $data_template . '"';
			$button_data .= ' data-archivetype="' . $data_archive_type . '"';
			$button_data .= ' data-archivevalue="' . $data_archive_value . '"';
			?>
			<div class="penci-pagination <?php echo $button_class; ?>">
				<a href="#" class="penci-ajax-more-button" <?php echo $button_data; ?>>
					<span class="ajax-more-text"><?php echo penci_get_setting('penci_trans_load_more_posts'); ?></span>
					<span class="ajaxdot"></span><?php penci_fawesome_icon('fas fa-sync'); ?>
				</a>
			</div>
			<?php
		} else {
			penci_soledad_pagination();
		}
	}
endif;

if (! function_exists('penci_soledad_pagination')) {
	function penci_soledad_pagination()
	{

		if (get_theme_mod('penci_page_navigation_numbers')) {
			echo penci_pagination_numbers();
		} else {
			global $wp_query;
			if ($wp_query->max_num_pages > 1) :
			?>
				<div class="penci-pagination">
					<div class="newer">
						<?php if (get_previous_posts_link()) { ?>
							<?php previous_posts_link('<span>' . penci_icon_by_ver('fas fa-angle-left') . penci_get_setting('penci_trans_newer_posts') . '</span>'); ?>
						<?php } else { ?>
							<?php echo '<div class="disable-url"><span>' . penci_icon_by_ver('fas fa-angle-left') . penci_get_setting('penci_trans_newer_posts') . '</span></div>'; ?>
						<?php } ?>
					</div>
					<div class="older">
						<?php if (get_next_posts_link()) { ?>
							<?php next_posts_link('<span>' . penci_get_setting('penci_trans_older_posts') . ' ' .  penci_icon_by_ver('fas fa-angle-right') . '</span>'); ?>
						<?php } else { ?>
							<?php echo '<div class="disable-url"><span>' . penci_get_setting('penci_trans_older_posts') . ' ' .  penci_icon_by_ver('fas fa-angle-right') . '</span></div>'; ?>
						<?php } ?>
					</div>
				</div>
		<?php
			endif;
		}
	}
}

/**
 * Pagination numbers
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_pagination_numbers')) {
	function penci_pagination_numbers($custom_query = false)
	{
		global $wp_query;
		if (!$custom_query) {
			$custom_query = $wp_query;
		}

		$paged_get = 'paged';
		if (is_front_page() && ! is_home()):
			$paged_get = 'page';
		endif;

		$big = 999999999; // need an unlikely integer
		$pagination = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var($paged_get)),
			'total' => $custom_query->max_num_pages,
			'type'   => 'list',
			'prev_text'    => penci_icon_by_ver('fas fa-angle-left'),
			'next_text'    => penci_icon_by_ver('fas fa-angle-right'),
		));

		$pagenavi_align = get_theme_mod('penci_page_navigation_align');
		if (! $pagenavi_align): $pagenavi_align = 'align-left';
		endif;

		if ($pagination) {
			return '<div class="penci-pagination ' . esc_attr($pagenavi_align) . '">' . $pagination . '</div>';
		}
	}
}

/**
 * Comments template
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_comments_template')) {
	function penci_comments_template($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;


		$attr_date = 'datetime="' . get_comment_time('Y-m-d\TH:i:sP') . '"';
		$attr_date .= 'title="' . get_comment_time('l, F j, Y, g:i a') . '"';
		$attr_date .= 'itemprop="commentTime"';

		?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>" itemprop="" itemscope="itemscope" itemtype="https://schema.org/UserComments">
			<meta itemprop="discusses" content="<?php echo esc_attr(get_the_title()); ?>" />
			<link itemprop="url" href="#comment-<?php comment_ID() ?>">
			<div class="thecomment">
				<div class="author-img">
					<?php echo get_avatar($comment, $args['avatar_size']); ?>
				</div>
				<div class="comment-text">
					<span class="author" itemprop="creator" itemtype="https://schema.org/Person"><span itemprop="name"><?php echo get_comment_author_link(); ?></span></span>
					<span class="date" <?php echo $attr_date; ?>><?php penci_fawesome_icon('far fa-clock'); ?><?php printf(esc_html__('%1$s - %2$s', 'soledad'), get_comment_date(), get_comment_time()) ?></span>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><i class="icon-info-sign"></i> <?php echo penci_get_setting('penci_trans_wait_approval_comment'); ?></em>
					<?php endif; ?>
					<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>
					<span class="reply">
						<?php comment_reply_link(array_merge($args, array(
							'reply_text' => penci_get_setting('penci_trans_reply_comment'),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						)), $comment->comment_ID); ?>
						<?php edit_comment_link(penci_get_setting('penci_trans_edit_comment')); ?>
					</span>
				</div>
			</div>
		<?php
	}
}

/**
 * Author socials url
 *
 * @since 1.0
 *
 * @param array $contactmethods
 *
 * @return new array $contactmethods
 */
if (! function_exists('penci_author_social')) {
	function penci_author_social($contactmethods)
	{
		unset($contactmethods['googleplus']);
		$contactmethods['twitter']   = 'Twitter Username';
		$contactmethods['facebook']  = 'Facebook Username';
		$contactmethods['google']    = 'Google Plus Username';
		$contactmethods['tumblr']    = 'Tumblr Username';
		$contactmethods['instagram'] = 'Instagram Username';
		$contactmethods['linkedin'] = 'LinkedIn Profile URL';
		$contactmethods['pinterest'] = 'Pinterest Username';
		$contactmethods['soundcloud'] = 'Soundcloud Profile URL';
		$contactmethods['youtube'] = 'Youtube Profile URL';

		return $contactmethods;
	}
	add_filter('user_contactmethods', 'penci_author_social', 10, 1);
}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package       TGM-Plugin-Activation
 * @subpackage    Example
 * @version       2.5.0-alpha
 * @author        Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author        Gary Jones <gamajo@gamajo.com>
 * @copyright     Copyright (c) 2012, Thomas Griffin
 * @license       http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link          https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once trailingslashit(get_template_directory()) . 'class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'penci_register_required_plugins');
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if (! function_exists('penci_register_required_plugins')) {
	function penci_register_required_plugins()
	{
		$link_server = 'https://s3.amazonaws.com/soledad-plugins/';

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'               => 'Penci Shortcodes & Performance', // The plugin name
				'slug'               => 'penci-shortcodes', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-shortcodes.zip', // The plugin source
				'required'           => true, // If false, the plugin is only 'recommended' instead of required
				'version'            => '3.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Penci Speed Optimizer', // The plugin name
				'slug'               => 'wp2speed', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'wp2speed.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '2.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Vafpress Post Formats UI', // The plugin name
				'slug'               => 'vafpress-post-formats-ui-develop', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'vafpress-post-formats-ui-develop.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '1.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Elementor Page Builder', // The plugin name
				'slug'               => 'elementor', // The plugin slug (typically the folder name)
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Penci Slider', // The plugin name
				'slug'               => 'penci-soledad-slider', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-soledad-slider.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Penci Portfolio', // The plugin name
				'slug'               => 'penci-portfolio', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-portfolio.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '2.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Penci Recipe', // The plugin name
				'slug'               => 'penci-recipe', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-recipe.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '3.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Penci Review', // The plugin name
				'slug'               => 'penci-review', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-review.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Penci Soledad Demo Importer', // The plugin name
				'slug'               => 'penci-soledad-demo-importer', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-soledad-demo-importer.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '3.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'oAuth Twitter Feed', // The plugin name
				'slug'               => 'oauth-twitter-feed-for-developers', // The plugin slug (typically the folder name)
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Contact Form 7', // The plugin name
				'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'MailChimp for WordPress', // The plugin name
				'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'WPForms', // The plugin name
				'slug'               => 'wpforms-lite', // The plugin slug (typically the folder name)
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			)
		);

		if (function_exists('penci_amp_init')) {
			$plugins[] = array(
				'name'               => 'PenCi Soledad AMP', // The plugin name
				'slug'               => 'penci-soledad-amp', // The plugin slug (typically the folder name)
				'source'             => $link_server . 'penci-soledad-amp.zip', // The plugin source
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
				'version'            => '4.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			);
		}

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 *
		 * Some of the strings are wrapped in a sprintf(), so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'id'           => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '', // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php', // Parent menu slug.
			'capability'   => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true, // Show admin notices or not.
			'dismissable'  => true, // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false, // Automatically activate plugins after installation or not.
			'message'      => '', // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => esc_html__('Install Required Plugins', 'soledad'),
				'menu_title'                      => esc_html__('Install Plugins', 'soledad'),
				'installing'                      => esc_html__('Installing Plugin: %s', 'soledad'),
				// %s = plugin name.
				'oops'                            => esc_html__('Something went wrong with the plugin API.', 'soledad'),
				'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_ask_to_update_maybe'      => _n_noop('There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'soledad'),
				// %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'soledad'),
				// %1$s = plugin name(s).
				'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'soledad'),
				'update_link'                     => _n_noop('Begin updating plugin', 'Begin updating plugins', 'soledad'),
				'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins', 'soledad'),
				'return'                          => esc_html__('Return to Required Plugins Installer', 'soledad'),
				'plugin_activated'                => esc_html__('Plugin activated successfully.', 'soledad'),
				'activated_successfully'          => esc_html__('The following plugin was activated successfully:', 'soledad'),
				'plugin_already_active'           => esc_html__('No action taken. Plugin %1$s was already active.', 'soledad'),
				// %1$s = plugin name(s).
				'plugin_needs_higher_version'     => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'soledad'),
				// %1$s = plugin name(s).
				'complete'                        => esc_html__('All plugins installed and activated successfully. %1$s', 'soledad'),
				// %s = dashboard link.
				'contact_admin'                   => esc_html__('Please contact the administrator of this site for help.', 'soledad'),
				'nag_type'                        => 'updated',
				// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa($plugins, $config);
	}
}


/**
 * Featured category to display in top slider
 *
 * @since 1.0
 *
 * @param string $separator
 *
 * @return void
 */
if (! function_exists('penci_category')) {
	function penci_category($separator)
	{

		$show_pricat_only  = get_theme_mod('penci_show_pricat_yoast_only');
		$show_pricat_first = get_theme_mod('penci_show_pricat_first_yoast');

		$the_category = get_the_category();
		$loop_cats    = $the_category;

		$primary_cat = '';
		$primary_catid = penci_get_primary_cat_id();
		if (($show_pricat_only || $show_pricat_first) && $primary_catid) {
			$term               = get_term($primary_catid);
			if (! is_wp_error($term)) {
				$primary_cat = $term;

				if ($show_pricat_only) {
					$loop_cats = array($term);
				} else {
					$loop_cats = array_merge(array($term), $the_category);
				}
			}
		}

		if (get_theme_mod('penci_featured_cat_hide') == true) {

			$excluded_cat = get_theme_mod('penci_featured_cat');
			$first_time = 1;

			$count_the_category = count((array)$the_category);

			if ($show_pricat_only & isset($primary_cat->term_taxonomy_id) && $primary_cat->term_taxonomy_id == $excluded_cat && $count_the_category > 1) {
				$loop_cats = array();
				foreach ($the_category as $cat) {
					if ($loop_cats) {
						continue;
					}

					if (isset($cat->cat_ID) && $cat->cat_ID == $excluded_cat) {
						continue;
					}

					$loop_cats = array($cat);
				}
			}

			$cat_show_arr = array();
			foreach ((array)$loop_cats as $category) {

				$cat_ID = '';
				if (isset($category->cat_ID) && $category->cat_ID) {
					$cat_ID = $category->cat_ID;
				} elseif (isset($category->term_taxonomy_id) && $category->term_taxonomy_id) {
					$cat_ID = $category->term_taxonomy_id;
				}

				if ($cat_ID == $excluded_cat) {
					continue;
				}

				if ($show_pricat_first) {
					if (in_array($category->term_id, $cat_show_arr)) {
						continue;
					}

					$cat_show_arr[] = $category->term_id;
				}


				if ($first_time == 1) {
					echo '<a class="penci-cat-name penci-cat-' . $category->term_id . '" href="' . get_category_link($category->term_id) . '"  rel="category tag">' . $category->name . '</a>';
					$first_time = 0;
				} else {
					echo wp_kses($separator, penci_allow_html()) . '<a class="penci-cat-name penci-cat-' . $category->term_id . '" href="' . get_category_link($category->term_id) . '"  rel="category tag">' . $category->name . '</a>';
				}
			}
		} else {
			$cat_show_arr = array();
			$first_time = 1;
			foreach ((array)$loop_cats as $category) {
				if ($show_pricat_first) {
					if (in_array($category->term_id, $cat_show_arr)) {
						continue;
					}

					$cat_show_arr[] = $category->term_id;
				}

				if ($first_time == 1) {
					echo '<a class="penci-cat-name penci-cat-' . $category->term_id . '" href="' . get_category_link($category->term_id) . '"  rel="category tag">' . $category->name . '</a>';
					$first_time = 0;
				} else {
					echo wp_kses($separator, penci_allow_html()) . '<a class="penci-cat-name penci-cat-' . $category->term_id . '" href="' . get_category_link($category->term_id) . '"  rel="category tag">' . $category->name . '</a>';
				}
			}
		}

		unset($primary_cat, $the_category, $cat_show_arr);
	}
}

/**
 * List all social media data
 *
 */
function penci_social_media_array()
{
	$array = array(
		'facebook' => array(penci_get_setting('penci_facebook'), 'fab fa-facebook-f'),
		'twitter' => array(penci_get_setting('penci_twitter'), 'fab fa-twitter'),
		'instagram' => array(get_theme_mod('penci_instagram'), 'fab fa-instagram'),
		'pinterest' => array(get_theme_mod('penci_pinterest'), 'fab fa-pinterest'),
		'linkedin' => array(get_theme_mod('penci_linkedin'), 'fab fa-linkedin-in'),
		'flickr' => array(get_theme_mod('penci_flickr'), 'fab fa-flickr'),
		'behance' => array(get_theme_mod('penci_behance'), 'fab fa-behance'),
		'tumblr' => array(get_theme_mod('penci_tumblr'), 'fab fa-tumblr'),
		'youtube' => array(get_theme_mod('penci_youtube'), 'fab fa-youtube'),
		'email' => array(get_theme_mod('penci_email_me'), 'fas fa-envelope'),
		'vk' => array(get_theme_mod('penci_vk'), 'fab fa-vk'),
		'bloglovin' => array(get_theme_mod('penci_bloglovin'), 'far fa-heart'),
		'vine' => array(get_theme_mod('penci_vine'), 'fab fa-vine'),
		'soundcloud' => array(get_theme_mod('penci_soundcloud'), 'fab fa-soundcloud'),
		'snapchat' => array(get_theme_mod('penci_snapchat'), 'fab fa-snapchat'),
		'spotify' => array(get_theme_mod('penci_spotify'), 'fab fa-spotify'),
		'github' => array(get_theme_mod('penci_github'), 'fab fa-github'),
		'stack-overflow' => array(get_theme_mod('penci_stack'), 'fab fa-stack-overflow'),
		'twitch' => array(get_theme_mod('penci_twitch'), 'fab fa-twitch'),
		'vimeo' => array(get_theme_mod('penci_vimeo'), 'fab fa-vimeo-v'),
		'steam' => array(get_theme_mod('penci_steam'), 'fab fa-steam'),
		'xing' => array(get_theme_mod('penci_xing'), 'fab fa-xing'),
		'whatsapp' => array(get_theme_mod('penci_whatsapp'), 'fab fa-whatsapp'),
		'telegram' => array(get_theme_mod('penci_telegram'), 'fab fa-telegram'),
		'reddit' => array(get_theme_mod('penci_reddit'), 'fab fa-reddit-alien'),
		'ok' => array(get_theme_mod('penci_ok'), 'fab fa-odnoklassniki'),
		'500px' => array(get_theme_mod('penci_500px'), 'fab fa-500px'),
		'stumbleupon' => array(get_theme_mod('penci_stumbleupon'), 'fab fa-stumbleupon'),
		'wechat' => array(get_theme_mod('penci_wechat'), 'fab fa-weixin'),
		'weibo' => array(get_theme_mod('penci_weibo'), 'fab fa-weibo'),
		'line' => array(get_theme_mod('penci_line'), 'line'),
		'viber' => array(get_theme_mod('penci_viber'), 'viber'),
		'discord' => array(get_theme_mod('penci_discord'), 'discord'),
		'rss' => array(get_theme_mod('penci_rss'), 'fas fa-rss'),
		'slack' => array(get_theme_mod('penci_slack'), 'fab fa-slack'),
		'mixcloud' => array(get_theme_mod('penci_mixcloud'), 'fab fa-mixcloud'),
		'goodreads' => array(get_theme_mod('penci_goodreads'), 'goodreads'),
		'tripadvisor' => array(get_theme_mod('penci_tripadvisor'), 'fab fa-tripadvisor'),
		'tiktok' => array(get_theme_mod('penci_tiktok'), 'tiktok'),
		'douban' => array(get_theme_mod('penci_douban'), 'douban'),
		'qq' => array(get_theme_mod('penci_qq'), 'qq'),
	);

	return $array;
}

function penci_social_penci_icons_array()
{
	return array('line', 'viber', 'discord', 'goodreads', 'tiktok', 'douban', 'qq');
}

/**
 * Custom the_excerpt() length function
 *
 * @since 1.0
 *
 * @param number $length of the_excerpt
 *
 * @return new number excerpt length
 */
if (! function_exists('penci_custom_excerpt_length')) {
	function penci_custom_excerpt_length($length)
	{
		$number_excerpt_length = get_theme_mod('penci_post_excerpt_length') ? get_theme_mod('penci_post_excerpt_length') : 30;
		return $number_excerpt_length;
	}

	add_filter('excerpt_length', 'penci_custom_excerpt_length', 999);
}

/**
 * Custom the_excerpt() more string
 *
 * @since 1.0
 *
 * @param string $more
 *
 * @return new more string of the_excerpt() function
 */
if (! function_exists('penci_new_excerpt_more')) {
	function penci_new_excerpt_more($more)
	{
		return '&hellip;';
	}

	add_filter('excerpt_more', 'penci_new_excerpt_more');
}

/**
 * Exclude pages form search results page
 * Hook to init action
 *
 * @since 1.0
 * @return void
 */
if (! function_exists('penci_remove_pages_from_search')) {
	add_action('pre_get_posts', 'penci_remove_pages_from_search');
	function penci_remove_pages_from_search($query)
	{
		if (! get_theme_mod('penci_include_search_page') && ! is_admin() && $query->is_main_query() && $query->is_search) {
			$post_types = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'names');
			$array_include = array();
			foreach ($post_types as $key => $val) {
				if ('page' != $key) {
					$array_include[] = $key;
				}
			}

			$query->set('post_type', $array_include);
		}
	}
}

/**
 * Get the featured image size url from post
 *
 * @since 3.1
 * @developed PenciDesign
 */
if (! function_exists('penci_get_featured_image_size')) {
	function penci_get_featured_image_size($id, $size = 'full')
	{
		if (! has_post_thumbnail($id)) {
			$image_holder = get_template_directory_uri() . '/images/no-image.jpg';
			return $image_holder;
		} else {
			$image_html = get_the_post_thumbnail($id, $size);
			preg_match('@src="([^"]+)"@', $image_html, $match);
			// Speed Optimizer
			if (empty($match) || strpos($match[count($match) - 1], ';base64,') !== false || strpos($match[count($match) - 1], apply_filters('hpp_defer_src_holder', ';base64,')) !== false) {
				preg_match('#(data-src|' . md5('hw-attr-data-src') . ')="(.*?)"#', $image_html, $match);
			}
			$src = array_pop($match);
			$src_check = substr($src, -4);

			if ($src_check == '.gif') {
				$image_full = get_the_post_thumbnail($id, 'full');
				preg_match('@src="([^"]+)"@', $image_full, $match_full);
				// Speed Optimizer
				if (empty($match_full) || strpos($match_full[count($match_full) - 1], ';base64,') !== false || strpos($match_full[count($match_full) - 1], apply_filters('hpp_defer_src_holder', ';base64,')) !== false) {
					preg_match('#(data-src|' . md5('hw-attr-data-src') . ')="(.*?)"#', $image_full, $match_full);
				}
				$src = array_pop($match_full);
			}

			return esc_url($src);
		}
	}
}

if (! function_exists('penci_get_featured_single_image_size')) {
	function penci_get_featured_single_image_size($id, $size = 'full', $enable_jarallax = false, $thumb_alt = '')
	{
		$ratio = '67';
		$src = get_template_directory_uri() . '/images/no-image.jpg';

		if (has_post_thumbnail($id)) {
			$image_html = get_the_post_thumbnail($id, $size);
			preg_match('@src="([^"]+)"@', $image_html, $match);
			// Speed Optimizer
			if (empty($match) || strpos($match[count($match) - 1], ';base64,') !== false || strpos($match[count($match) - 1], apply_filters('hpp_defer_src_holder', ';base64,')) !== false) {
				preg_match('#(data-src|' . md5('hw-attr-data-src') . ')="(.*?)"#', $image_html, $match);
			}
			$src = array_pop($match);
			$src_check = substr($src, -4);

			if ($src_check == '.gif') {
				$image_full = get_the_post_thumbnail($id, 'full');
				$image_html = get_the_post_thumbnail($id, 'full');
				preg_match('@src="([^"]+)"@', $image_full, $match_full);
				// Speed Optimizer
				if (empty($match_full) || strpos($match_full[count($match_full) - 1], ';base64,') !== false || strpos($match_full[count($match_full) - 1], apply_filters('hpp_defer_src_holder', ';base64,')) !== false) {
					preg_match('#(data-src|' . md5('hw-attr-data-src') . ')="(.*?)"#', $image_full, $match_full);
				}
				$src = array_pop($match_full);
			}

			if (preg_match_all('#(width|height)=(\'|")?(?<dimensions>[0-9]+)(\'|")?#i', $image_html, $image_dis) && 2 == count((array)$image_dis['dimensions'])) {
				$width  =  isset($image_dis['dimensions'][0]) ? $image_dis['dimensions'][0] : 0;
				$height =  isset($image_dis['dimensions'][1]) ? $image_dis['dimensions'][1] : 0;

				if ($width && $height) {
					$ratio = number_format($height / $width * 100, 4);
				}
			}
		}


		$class = 'attachment-penci-full-thumb size-penci-full-thumb penci-single-featured-img wp-post-image';
		$style_ratio = 'padding-top: ' . $ratio . '%;';

		if ($enable_jarallax) {
			$image_html = '<img class="jarallax-img" src="' . $src . '" alt="' . $thumb_alt . '">';
		} elseif (get_theme_mod('penci_disable_lazyload_single')) {
			$image_html = '<span class="' . $class . ' penci-disable-lazy" style="background-image: url(' . $src . ');' . $style_ratio . '"></span>';
		} else {
			$image_html = '<span class="' . $class . ' penci-lazy" data-src="' . $src . '" style="' . $style_ratio . '"></span>';
		}

		return $image_html;
	}
}

/*
 * Get featured image ratio based on the post ID & thumbnail size.
 */

if (! function_exists('penci_get_featured_image_padding_markup')) {
	function penci_get_featured_image_padding_markup($postid, $image_thumb = 'full')
	{
		$ratio = '66.6666667';

		if (has_post_thumbnail($postid)) {
			$image = get_the_post_thumbnail($postid, $image_thumb);
		} else {
			$image = '<img src="' . get_template_directory_uri() . '/images/no-image.jpg" alt="' . __("No Thumbnail", "pencidesign") . '" />';
		}

		if (preg_match_all('#(width|height)=(\'|")?(?<dimensions>[0-9]+)(\'|")?#i', $image, $image_dis) && 2 == count((array)$image_dis['dimensions'])) {
			$ratio = number_format(($image_dis['dimensions'][1] / $image_dis['dimensions'][0]) * 100, 8);
		}

		$output = '<span class="penci-isotope-padding" style="padding-bottom:' . $ratio . '%;"></span>';

		return $output;
	}
}

/* Get ratio markup for post format gallery */
if (! function_exists('penci_get_ratio_img_format_gallery')) {
	function penci_get_ratio_img_format_gallery($image)
	{
		$ratio = '66.6666667';
		/* $image = wp_get_attachment_image_src( $image_id, $thumbnail_size ); */

		if (! empty($image)) {
			$img_width = isset($image[1]) ? $image[1] : '';
			$img_height = isset($image[2]) ? $image[2] : '';
			if ($img_width && $img_height) {
				$ratio = number_format(($img_height / $img_width) * 100, 8);
			}
		}

		$output = '<span class="penci-isotope-padding" style="padding-bottom:' . $ratio . '%;"></span>';

		return $output;
	}
}

/**
 * Get image ratio based on image size
 *
 * @since 6.3
 * @developed PenciDesign
 */
if (! function_exists('penci_get_featured_image_ratio')) {
	function penci_get_featured_image_ratio($id, $size = 'full')
	{
		$ratio = '66.6667';

		if (has_post_thumbnail($id)) {
			$image_html = get_the_post_thumbnail($id, $size);
			preg_match('@src="([^"]+)"@', $image_html, $match);
			// Speed Optimizer
			if (empty($match) || strpos($match[count($match) - 1], ';base64,') !== false || strpos($match[count($match) - 1], apply_filters('hpp_defer_src_holder', ';base64,')) !== false) {
				preg_match('#(data-src|' . md5('hw-attr-data-src') . ')="(.*?)"#', $image_html, $match);
			}
			$src = array_pop($match);
			$src_check = substr($src, -4);

			if ($src_check == '.gif') {
				$image_html = get_the_post_thumbnail($id, 'full');
			}

			if (preg_match_all('#(width|height)=(\'|")?(?<dimensions>[0-9]+)(\'|")?#i', $image_html, $image_dis) && 2 == count((array)$image_dis['dimensions'])) {
				$width  =  isset($image_dis['dimensions'][0]) ? $image_dis['dimensions'][0] : 0;
				$height =  isset($image_dis['dimensions'][1]) ? $image_dis['dimensions'][1] : 0;

				if ($width && $height) {
					$ratio = number_format($height / $width * 100, 4);
				}
			}
		}

		return $ratio;
	}
}

/**
 * Get the featured image size url based on featured image full url
 *
 * @since 3.1
 * @developed PenciDesign
 */
if (! function_exists('penci_get_image_size_url')) {
	function penci_get_image_size_url($image_url, $size = 'full')
	{
		$image_thumb_html = $image_url;
		if (function_exists('attachment_url_to_postid')) {
			$image_id = attachment_url_to_postid($image_url);
			if ($image_id && (0 != $image_id)) {
				$image_thumb = wp_get_attachment_image_src($image_id, $size);
				if (isset($image_thumb[0]) && $image_thumb[0]) {
					$image_thumb_html = $image_thumb[0];
				}
			}
		}

		return $image_thumb_html;
	}
}

/**
 * Get the image width/height based on the image URL
 *
 * @since 3.1
 * @developed PenciDesign
 */
if (! function_exists('penci_get_image_data_basedurl')) {
	function penci_get_image_data_basedurl($image_url, $data = 'w')
	{
		$return = '';
		if (function_exists('attachment_url_to_postid')) {
			$image_id = attachment_url_to_postid($image_url);
			if ($image_id && (0 != $image_id)) {
				$image_data = wp_get_attachment_image_src($image_id, 'full');
				if (isset($image_data[1]) && $image_data[1] && $data == 'w') {
					$return = $image_data[1];
				} else if (isset($image_data[2]) && $image_data[2] && $data == 'h') {
					$return = $image_data[2];
				} else if (isset($image_data[0]) && $image_data[0] && $data == 'url') {
					$return = $image_data[0];
				}
			} else {
				if ($data == 'url') {
					$return = $image_url;
				}
			}
		}

		return $return;
	}
}

/**
 * Get the featured image type display on the layouts
 *
 * @since 5.3
 * @developed PenciDesign
 */
if (! function_exists('penci_featured_images_size')) {
	function penci_featured_images_size($size = 'normal')
	{

		$return_size = 'penci-thumb';
		if ('small' == $size) {
			$return_size = 'penci-thumb-small';
		} elseif ('large' == $size) {
			$return_size = 'penci-magazine-slider';
		}

		$customize_data = get_theme_mod('penci_featured_image_size');
		if ('square' == $customize_data) {
			$return_size = 'penci-thumb-square';
			if ('large' == $size) {
				$return_size = 'penci-full-thumb';
			}
		} elseif ('vertical' == $customize_data) {
			$return_size = 'penci-thumb-vertical';
			if ('large' == $size) {
				$return_size = 'penci-full-thumb';
			}
		}

		return $return_size;
	}
}

/**
 * Get the featured image type display on the layouts
 *
 * @since 5.3
 * @developed PenciDesign
 */
if (! function_exists('penci_featured_images_size_vcel')) {
	function penci_featured_images_size_vcel($size = 'normal', $image_size = '', $custom_size = null)
	{

		$return_size = 'penci-thumb';
		if ('small' == $size) {
			$return_size = 'penci-thumb-small';
		} elseif ('large' == $size) {
			$return_size = 'penci-magazine-slider';
		}

		$customize_data = get_theme_mod('penci_featured_image_size');
		if ($image_size) {
			$customize_data = $image_size;
		}

		if ('horizontal' == $customize_data) {
			$return_size = 'penci-thumb';
			if ('small' == $size) {
				$return_size = 'penci-thumb-small';
			} elseif ('large' == $size) {
				$return_size = 'penci-magazine-slider';
			}
		} elseif ('square' == $customize_data) {
			$return_size = 'penci-thumb-square';
			if ('large' == $size) {
				$return_size = 'penci-full-thumb';
			}
		} elseif ('vertical' == $customize_data) {
			$return_size = 'penci-thumb-vertical';
			if ('large' == $size) {
				$return_size = 'penci-full-thumb';
			}
		} elseif ('custom' == $customize_data) {
			if ($custom_size) {
				$return_size = $custom_size;
			}
		}

		return $return_size;
	}
}

/**
 * Get the author posts link
 *
 * @since 8.0
 * @developed PenciDesign
 */
if (! function_exists('penci_get_the_author_posts_link')) {
	function penci_get_the_author_posts_link($author_id = null)
	{

		global $authordata;
		if (! is_object($authordata)) {
			return '';
		}
		$authorID = $authordata->ID;
		$authorNicename = $authordata->user_nicename;
		$authorDisplay = get_the_author();
		if ($author_id) {
			$authorID = $author_id;
			$authorNicename = get_the_author_meta('user_nicename', $authorID);
			$authorDisplay = get_the_author_meta('display_name', $authorID);
		}

		$link = sprintf(
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url(get_author_posts_url($authorID, $authorNicename)),
			/* translators: %s: Author's display name. */
			esc_attr(penci_get_setting('penci_trans_author') . ' ' . $authorDisplay),
			$authorDisplay
		);

		return apply_filters('the_author_posts_link', $link);
	}
}

/**
 * Get the featured image type display on category mega menu items
 *
 * @since 5.3
 * @developed PenciDesign
 */
if (! function_exists('penci_megamenu_featured_images_size')) {
	function penci_megamenu_featured_images_size()
	{

		$return_size = 'penci-thumb';

		$customize_data = get_theme_mod('penci_mega_featured_image_size');
		if ('square' == $customize_data) {
			$return_size = 'penci-thumb-square';
		} elseif ('vertical' == $customize_data) {
			$return_size = 'penci-thumb-vertical';
		}

		return $return_size;
	}
}

/**
 * Setup functions to count viewed posts to create popular posts
 *
 * @param string $postID - post ID of this post
 *
 * @return numbers viewed posts
 * @since 1.0
 */
if (! function_exists('penci_get_postviews_key')) {
	function penci_get_postviews_key()
	{
		$count_key = 'penci_post_views_count';
		if (('custom' == get_theme_mod('penci_general_views_meta')) && get_theme_mod('penci_general_views_key')) {
			$count_key = get_theme_mod('penci_general_views_key');
		}

		return $count_key;
	}
}

/**
 * Setup functions to count viewed posts to create popular posts
 *
 * @param string $postID - post ID of this post
 *
 * @return numbers viewed posts
 * @since 1.0
 */
if (! function_exists('penci_get_post_views')) {
	function penci_get_post_views($postID)
	{
		$count_key = penci_get_postviews_key();
		$count     = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');

			return "0";
		}

		return $count;
	}
}

if (! function_exists('penci_set_post_views')) {
	function penci_set_post_views($postID)
	{
		if (get_theme_mod('penci_enable_ajax_view')) {
			add_action('wp_footer', 'penci_cview_ajax_footer_script', 999);
			return;
		}

		$count_key = penci_get_postviews_key();
		$count_wkey = 'penci_post_week_views_count';
		$count_mkey = 'penci_post_month_views_count';
		$count     = get_post_meta($postID, $count_key, true);
		$count_w     = get_post_meta($postID, $count_wkey, true);
		$count_m     = get_post_meta($postID, $count_mkey, true);

		/* Update views count all time */
		if ($count == '') {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, $count);
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}

		/* Update views count week */
		if ($count_w == '') {
			$count_w = 0;
			delete_post_meta($postID, $count_wkey);
			add_post_meta($postID, $count_wkey, $count_w);
		} else {
			$count_w++;
			update_post_meta($postID, $count_wkey, $count_w);
		}

		/* Update views count month */
		if ($count_m == '') {
			$count_m = 0;
			delete_post_meta($postID, $count_mkey);
			add_post_meta($postID, $count_mkey, $count_m);
		} else {
			$count_m++;
			update_post_meta($postID, $count_mkey, $count_m);
		}
	}
}

if (! function_exists('penci_cview_ajax_footer_script')):
	function penci_cview_ajax_footer_script()
	{
		?>
			<script type="text/javascript">
				function PenciSimplePopularPosts_AddCount(id, endpoint) {
					var xmlhttp;
					var params = "/?penci_spp_count=1&penci_spp_post_id=" + id + "&cachebuster=" + Math.floor((Math.random() * 100000));
					// code for IE7+, Firefox, Chrome, Opera, Safari

					if (window.XMLHttpRequest) {
						xmlhttp = new XMLHttpRequest();
					} else {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}

					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							var data = JSON.parse(xmlhttp.responseText);
							document.getElementsByClassName("penci-post-countview-number")[0].innerHTML = data.visits;
						}
					}

					xmlhttp.open("GET", endpoint + params, true);
					xmlhttp.send();
				}
				PenciSimplePopularPosts_AddCount(<?php echo get_the_ID(); ?>, '<?php echo get_site_url(); ?>');
			</script>
		<?php
	}
endif;
if (! function_exists('penci_cview_ajax_query_vars')):
	function penci_cview_ajax_query_vars($query_vars)
	{
		if (get_theme_mod('penci_enable_ajax_view')) {
			$query_vars[] = 'penci_spp_count';
			$query_vars[] = 'penci_spp_post_id';
		}

		return $query_vars;
	}
	add_filter('query_vars', 'penci_cview_ajax_query_vars');
endif;

if (! function_exists('penci_cview_ajax_count')):
	function penci_cview_ajax_count()
	{
		/**
		 * Endpoint for counting visits
		 */
		if (intval(get_query_var('penci_spp_count')) === 1 && intval(get_query_var('penci_spp_post_id')) !== 0) {
			//JSON response
			header('Content-Type: application/json');
			$postID = intval(get_query_var('penci_spp_post_id'));
			$count_key = penci_get_postviews_key();
			$count_wkey = 'penci_post_week_views_count';
			$count_mkey = 'penci_post_month_views_count';
			$count     = get_post_meta($postID, $count_key, true);
			$count_w     = get_post_meta($postID, $count_wkey, true);
			$count_m     = get_post_meta($postID, $count_mkey, true);
			$current_count = 0;

			/* Update views count all time */
			if ($count == '') {
				$count = 0;

				$current_count = $count;
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, $count);
			} else {
				$count++;

				$current_count = $count;
				update_post_meta($postID, $count_key, $count);
			}

			/* Update views count week */
			if ($count_w == '') {
				$count_w = 0;
				delete_post_meta($postID, $count_wkey);
				add_post_meta($postID, $count_wkey, $count_w);
			} else {
				$count_w++;
				update_post_meta($postID, $count_wkey, $count_w);
			}

			/* Update views count month */
			if ($count_m == '') {
				$count_m = 0;
				delete_post_meta($postID, $count_mkey);
				add_post_meta($postID, $count_mkey, $count_m);
			} else {
				$count_m++;
				update_post_meta($postID, $count_mkey, $count_m);
			}

			echo json_encode(array('status' => 'OK', 'visits' => intval($current_count)));
			die();
		}
	}
	add_action('wp', 'penci_cview_ajax_count');
endif;

/**
 * Add schedules intervals
 *
 * @since  2.5.1
 *
 * @param  array $schedules
 *
 * @return array
 */
add_filter('cron_schedules', 'penci_add_schedules_intervals');
if (! function_exists('penci_add_schedules_intervals')) {
	function penci_add_schedules_intervals($schedules)
	{
		$schedules['weekly'] = array(
			'interval' => 604800,
			'display'  => __('Weekly', 'soledad')
		);

		$schedules['monthly'] = array(
			'interval' => 2635200,
			'display'  => __('Monthly', 'soledad')
		);

		return $schedules;
	}
}

/**
 * Add scheduled event during theme activation
 *
 * @since  2.5.1
 * @return void
 */
add_action('after_switch_theme', 'penci_add_schedule_events');
if (! function_exists('penci_add_schedule_events')) {
	function penci_add_schedule_events()
	{
		if (! wp_next_scheduled('penci_reset_track_data_weekly')) {
			wp_schedule_event(time(), 'weekly', 'penci_reset_track_data_weekly');
		}

		if (! wp_next_scheduled('penci_reset_track_data_monthly')) {
			wp_schedule_event(time(), 'monthly', 'penci_reset_track_data_monthly');
		}
	}
}

/**
 * Remove scheduled events when theme deactived
 *
 * @since  2.5.1
 * @return void
 */
add_action('switch_theme', 'penci_remove_schedule_events');
if (! function_exists('penci_remove_schedule_events')) {
	function penci_remove_schedule_events()
	{
		wp_clear_scheduled_hook('penci_reset_track_data_weekly');
		wp_clear_scheduled_hook('penci_reset_track_data_monthly');
	}
}


/**
 * Reset view counter of week
 *
 * @since  2.5.1
 * @return void
 */
add_action('penci_reset_track_data_weekly', 'penci_reset_week_view');
if (! function_exists('penci_reset_week_view')) {
	function penci_reset_week_view()
	{
		global $wpdb;

		$meta_key = 'penci_post_week_views_count';
		$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value = '0' WHERE meta_key = %s", $meta_key));
	}
}

/**
 * Reset view counter of month
 *
 * @since  2.5.1
 * @return void
 */
add_action('penci_reset_track_data_monthly', 'penci_reset_month_view');
if (! function_exists('penci_reset_month_view')) {
	function penci_reset_month_view()
	{
		global $wpdb;

		$meta_key = 'penci_post_month_views_count';
		$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value = '0' WHERE meta_key = %s", $meta_key));
	}
}

/**
 * Get custom excerpt length from the_content() function
 * Will use this function and call it in penci_add_fb_open_graph_tags() function
 *
 * @since 1.1
 * @return excerpt content from the_content
 */

if (! function_exists('penci_trim_excerpt_from_content')) {
	function penci_trim_excerpt_from_content($text, $excerpt)
	{

		if ($excerpt) {
			return $excerpt;
		}

		$text = strip_shortcodes($text);

		$text           = apply_filters('the_content', $text);
		$text           = str_replace(']]>', ']]&gt;', $text);
		$text           = strip_tags($text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more   = apply_filters('excerpt_more', ' ' . '...');
		$words          = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}

		return apply_filters('wp_trim_excerpt', $text, $excerpt);
	}
}

/**
 * Get categories parent list
 *
 * @since 3.2
 */
if (! function_exists('penci_get_category_parents')) {
	function penci_get_category_parents($id)
	{
		$chain  = '';
		$parent = get_term($id, 'category');

		if (is_wp_error($parent)) {
			return '';
		}

		$name = $parent->name;

		if ($parent->parent && ($parent->parent != $parent->term_id)) {
			$chain .= penci_get_category_parents($parent->parent);
		}

		$chain .= '<span><a class="crumb" href="' . esc_url(get_category_link($parent->term_id)) . '">' . $name . '</a></span>' . penci_icon_by_ver('fas fa-angle-right') . '</i>';

		return $chain;
	}
}

/**
 * Get category parent of a category
 *
 * @since 3.2
 */
if (! function_exists('penci_get_category_parent_id')) {
	function penci_get_category_parent_id($id)
	{
		$return  = '';
		$parent = get_term($id, 'category');

		if (is_wp_error($parent)) {
			return '';
		}

		if ($parent->parent && $parent->parent != $parent->term_id) {
			$return = $parent->parent;
		}

		return $return;
	}
}

/**
 * Return google adsense markup
 *
 * @since 3.2
 */
if (! function_exists('penci_render_google_adsense')) {
	function penci_render_google_adsense($option)
	{
		if (! get_theme_mod($option)) {
			return '';
		}

		return '<div class="penci-google-adsense ' . $option . '">' . do_shortcode(get_theme_mod($option)) . '</div>';
	}
}

/**
 * Add Next Page/Page Break Button to WordPress Visual Editor
 *
 * @since 4.0.3
 */
if (! function_exists('penci_add_next_page_button_to_editor')) {
	add_filter('mce_buttons', 'penci_add_next_page_button_to_editor', 1, 2);
	function penci_add_next_page_button_to_editor($buttons, $id)
	{

		/* only add this for content editor */
		if ('content' != $id) {
			return $buttons;
		}

		/* add next page after more tag button */
		array_splice($buttons, 13, 0, 'wp_page');

		return $buttons;
	}
}

/**
 * Exclude specific categories from latest posts on Homepage
 *
 * @since 2.4
 */
if (! function_exists('penci_exclude_specific_categories_display_on_home')) {
	function penci_exclude_specific_categories_display_on_home($query)
	{
		if (get_theme_mod('penci_home_exclude_cat')) {

			$exclude_cat = get_theme_mod('penci_home_exclude_cat');
			$exclude_cats       = str_replace(' ', '', $exclude_cat);
			$exclude_array = explode(',', $exclude_cats);

			if ($query->is_home() && $query->is_main_query()) {
				$query->set('tax_query', array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $exclude_array,
						'operator' => 'NOT IN'
					),
				));
			}
		}
	}

	add_action('pre_get_posts', 'penci_exclude_specific_categories_display_on_home');
}


/**
 * Anbles shortcodes in wordpress widget text
 *
 * @since 1.2.3
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Get image alt by image ID
 * If the alt is null - return posts ID
 *
 * @since 5.2
 */
if (! function_exists('penci_get_image_alt')) {
	function penci_get_image_alt($thumb_id, $postID = null)
	{
		$thumb_alt = '';
		$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

		if ($thumb_alt) {
			$thumb_alt = $thumb_alt;
		}

		return esc_attr($thumb_alt);
	}
}

/**
 * Check if post format + data of post format is available
 *
 * @return boolean or data of post format
 */
if (! function_exists('penci_get_post_format')) {
	function penci_get_post_format($format, $getdata = null)
	{
		$return = false;
		$post_id = get_the_ID();
		$data = '';
		if (has_post_format('link') && ($format == 'link')) {
			$data = get_post_meta($post_id, '_format_link_url', true);
		} else if (has_post_format('quote') && ($format == 'quote')) {
			$data = get_post_meta($post_id, '_format_quote_source_name', true);
		} else if (has_post_format('gallery') && ($format == 'gallery')) {
			$data = get_post_meta($post_id, '_format_gallery_images', true);
		} else if (has_post_format('video') && ($format == 'video')) {
			$data = get_post_meta($post_id, '_format_video_embed', true);
		} else if (has_post_format('audio') && ($format == 'audio')) {
			$data = get_post_meta($post_id, '_format_audio_embed', true);
		}

		if ($data) {
			$return = true;
		}

		if ('data' == $getdata && $data) {
			return $data;
		}

		return $return;
	}
}

/**
 * Get image title by image ID
 *
 * @since 5.2
 */
if (! function_exists('penci_get_image_title')) {
	function penci_get_image_title($thumb_id)
	{
		if (get_theme_mod('penci_disable_image_titles_galleries')) {
			return '';
		}

		$thumb_title = $thumb_title_html = '';
		$thumb_title = get_the_title($thumb_id);

		if ($thumb_title) {
			$thumb_title_html = ' title="' . esc_attr($thumb_title) . '"';
		}

		return $thumb_title_html;
	}
}

if (! function_exists('penci_insert_post_content_ads') && get_theme_mod('penci_ads_inside_content_html')) {
	require 'inc/modules/insert_ads.php';

	add_filter('the_content', 'penci_insert_post_content_ads');
	function penci_insert_post_content_ads($content)
	{
		// Check if the plugin WP Insert Content is activated.
		if (! function_exists('PenciDesign\Insert_Content\insert_content')) {
			return $content;
		}

		// Check if we're inside the main loop in a single post page.
		if (!(! is_admin() && is_single() && in_the_loop() && is_main_query())) {
			// Nope.
			return $content;
		}

		$ad_code = '<div class="penci-custom-html-inside-content">' . get_theme_mod('penci_ads_inside_content_html') . '</div>';
		$numpara = get_theme_mod('penci_ads_inside_content_num') ? get_theme_mod('penci_ads_inside_content_num') : 4;

		$args = array(
			'parent_element_id' => '',
			'insert_element'   => 'div',
			'insert_after_p'   => '',
			'insert_every_p'   => $numpara,
			'insert_if_no_p'   => false,
			'top_level_p_only' => true,
		);

		if (get_theme_mod('penci_ads_inside_content_style') == 'style-2') {
			$args['insert_after_p'] = $numpara;
			$args['insert_every_p'] = '';
		}

		$content = PenciDesign\Insert_Content\insert_content($content, $ad_code, $args);

		return $content;
	}
}


/**
 * Get image title by image ID
 *
 * @since 5.2
 */
if (! function_exists('penci_add_meta_description_home')) {
	function penci_add_meta_description_home()
	{
		if (is_home() && get_theme_mod('penci_home_metadesc')) {
			$meta_description = esc_attr(get_theme_mod('penci_home_metadesc'));
			echo '<meta name="description" content="' . $meta_description . '"/>';
		}
	}
	add_action('wp_head', 'penci_add_meta_description_home', 1);
}

/**
 * Hook to change gallery
 *
 * @since 2.4.2
 */
if (! get_theme_mod('penci_post_disable_gallery')):
	include(trailingslashit(get_template_directory()) . 'inc/modules/gallery.php');
endif;

if (! function_exists('penci_get_ratio_img_basedid')) {
	function penci_get_ratio_img_basedid($id, $thumb = 'full')
	{
		$ratio = '66.6666667';
		$image = wp_get_attachment_image_src($id, $thumb);

		if (! empty($image)) {
			$img_width = isset($image[1]) ? $image[1] : '';
			$img_height = isset($image[2]) ? $image[2] : '';
			if ($img_width && $img_height) {
				$ratio = number_format(($img_height / $img_width) * 100, 8);
			}
		}

		$output = '<span class="penci-isotope-padding" style="padding-bottom:' . $ratio . '%;"></span>';

		return $output;
	}
}

/**
 * Hook to change markup for gallery
 *
 * @since 2.3
 */
if (! function_exists('penci_custom_markup_for_gallery') && ! get_theme_mod('penci_post_disable_gallery')) {
	add_filter('post_gallery', 'penci_custom_markup_for_gallery', 10, 3);
	function penci_custom_markup_for_gallery($string, $attr)
	{

		/* Support Enhanced Media Library plugin */
		if (function_exists('wpuxss_eml_shortcode_atts')) {
			$attr = shortcode_atts(
				// defaults values
				array(
					'order'      => '',
					'orderby'    => '',
					'id'         => '',
					'ids'         => '',
					'type'         => 'justified',
					'columns'    => '',
					'include'    => '',
				),
				$attr,
				'gallery'
			);
		}

		$data_height = '150';
		if (is_numeric(get_theme_mod('penci_image_height_gallery')) && (60 < get_theme_mod('penci_image_height_gallery'))) {
			$data_height = get_theme_mod('penci_image_height_gallery');
		}

		$id = '';
		$type = 'justified';
		$columns = '3';

		if (get_theme_mod('penci_gallery_dstyle')) {
			$type = get_theme_mod('penci_gallery_dstyle');
		}

		if (isset($attr['ids'])) {
			$id = $attr['ids'];
		}
		if (isset($attr['type'])) {
			$type_name = $attr['type'];
			if (in_array($type_name, array('justified', 'masonry', 'grid', 'single-slider', 'none'))) {
				$type = $attr['type'];
			}
		}
		if ($type == 'grid'):
			$type = 'masonry grid';
		endif;

		if (isset($attr['columns']) && in_array($attr['columns'], array('2', '3', '4'))) {
			$columns = $attr['columns'];
		}

		if ($type == 'none') {
			return;
		}

		$block_id = 'penci-post-gallery__' . rand(1000, 100000);

		$output = '<div id="' . $block_id . '" class="penci-post-gallery-container ' . $type . ' column-' . $columns . '" data-height="' . $data_height . '" data-margin="3">';

		if ($type == 'masonry' || $type == 'masonry grid'):
			$output .= '<div class="inner-gallery-masonry-container">';
		endif;

		if ($type == 'single-slider'):
			$autoplay = ! get_theme_mod('penci_disable_autoplay_single_slider') ? 'true' : 'false';
			$output .= '<div class="penci-owl-carousel penci-owl-carousel-slider penci-nav-visible" data-auto="' . $autoplay . '" data-lazy="true">';
		endif;

		$order = isset($attr['order']) ?  $attr['order'] : '';
		$orderby = isset($attr['orderby']) ?  $attr['orderby'] : '';

		$posts  = get_posts(array('include' => $id, 'post_type' => 'attachment', 'order' => $order, 'orderby' => $orderby));

		if ($posts) {
			foreach ($posts as $imagePost) {
				$caption = '';
				$gallery_title = '';
				if ($imagePost->post_excerpt):
					$caption = $imagePost->post_excerpt;
				endif;
				if ($caption) {
					$gallery_title = ' data-cap="' . esc_attr($caption) . '"';
				}

				$get_full = wp_get_attachment_image_src($imagePost->ID, 'full');
				$get_masonry = wp_get_attachment_image_src($imagePost->ID, 'penci-masonry-thumb');
				$thumbsize = 'penci-masonry-thumb';

				$image_alt = penci_get_image_alt($imagePost->ID, get_the_ID());
				$image_title_html = penci_get_image_title($imagePost->ID);

				$class_a_item = '';
				if (! ($type == 'masonry' || $type == 'masonry grid')) {
					$class_a_item = 'item-gallery-' . $type;
				}

				if ($type == 'masonry' || $type == 'masonry grid' || $type == 'single-slider') {
					$class_a_item .= ' item-link-relative';
				}

				if ($type == 'single-slider'):
					$output .= '<figure>';
					$get_masonry = wp_get_attachment_image_src($imagePost->ID, 'penci-full-thumb');
					$thumbsize = 'penci-full-thumb';
				endif;

				if ($type == 'masonry grid'):
					$get_masonry = wp_get_attachment_image_src($imagePost->ID, 'penci-thumb');
					$thumbsize = 'penci-thumb';
				endif;

				if ($type == 'masonry' || $type == 'masonry grid') {
					$output .= '<div class="item-gallery-' . $type . '">';
				}

				$output .= '<a class="' . $class_a_item . '" href="' . $get_full[0] . '"' . $gallery_title . '>';

				if ($type == 'masonry' || $type == 'masonry grid'):
					$output .= '<div class="inner-item-masonry-gallery">';
				endif;

				if ($type == 'masonry' || $type == 'masonry grid' || $type == 'single-slider') {
					$output .= penci_get_ratio_img_basedid($imagePost->ID, $thumbsize);
				}

				$output .= '<img src="' . $get_masonry[0] . '" alt="' . $image_alt . '"' . $image_title_html . '>';

				if ($type == 'justified' && $caption) {
					$output .= '<div class="caption">' . wp_kses($caption, array('em' => array(), 'strong' => array(), 'b' => array(), 'i' => array())) . '</div>';
				}

				if ($type == 'masonry' || $type == 'masonry grid'):
					$output .= '</div>';
				endif;

				$output .= '</a>';

				// Close item-gallery-' . $style_gallery . '-wrap
				if ($type == 'masonry' || $type == 'masonry grid') {
					$output .= '</div>';
				}

				if ($type == 'single-slider'):
					if ($caption):
						$output .= '<p class="penci-single-gallery-captions">' . $caption . '</p>';
					endif;
					$output .= '</figure>';
				endif;
			}
		}

		if ($type == 'masonry' || $type == 'single-slider' || $type == 'masonry grid'):
			$output .= '</div>';
		endif;

		$output .= '</div>';

		return $output;
	}
}

/*
 * Create filter to hide header & footer
 */
if (! function_exists('penci_is_hide_header')) {
	function penci_is_hide_header()
	{
		$return = false;

		return apply_filters('penci_filter_hide_header', $return);
	}
}

if (! function_exists('penci_is_hide_footer')) {
	function penci_is_hide_footer()
	{
		$return = false;

		return apply_filters('penci_filter_hide_footer', $return);
	}
}

/**
 * Get next/prev posts data for current posts
 *
 */
if (! function_exists('penci_get_next_prev_posts')) {
	function penci_get_next_prev_posts()
	{

		$type = get_theme_mod('penci_loadnp_type') ? get_theme_mod('penci_loadnp_type') : 'prev';
		$exclude = get_theme_mod('penci_loadnp_exclude') ? get_theme_mod('penci_loadnp_exclude') : '';
		$return = get_previous_post(false, $exclude);

		if ($type == 'next') {
			$return = get_next_post(false, $exclude);
		} else if ($type == 'prev_cat') {
			$return = get_previous_post(true, $exclude, 'category');
		} else if ($type == 'next_cat') {
			$return = get_next_post(true, $exclude, 'category');
		} else if ($type == 'prev_tag') {
			$return = get_previous_post(true, $exclude, 'post_tag');
		} else if ($type == 'next_tag') {
			$return = get_next_post(true, $exclude, 'post_tag');
		}

		return $return;
	}
}

/**
 * Declare WooCommerce support
 *
 * @since 2.2
 */
if (! function_exists('penci_declare_woocommerce_support')) {
	add_action('after_setup_theme', 'penci_declare_woocommerce_support');
	function penci_declare_woocommerce_support()
	{
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-lightbox');
		if (! get_theme_mod('penci_woo_disable_zoom')):
			add_theme_support('wc-product-gallery-zoom');
		endif;
		add_theme_support('wc-product-gallery-slider');
	}
}

/**
 * Update cart total when products are added to the cart
 *
 * @since 2.2.4
 */
if (! function_exists('penci_woocommerce_header_add_to_cart_fragment')) {
	add_filter('woocommerce_add_to_cart_fragments', 'penci_woocommerce_header_add_to_cart_fragment');
	function penci_woocommerce_header_add_to_cart_fragment($fragments)
	{
		ob_start();
		?>
			<a class="cart-contents" href="<?php $cart_link = function_exists('wc_get_cart_url') ? wc_get_cart_url() : WC()->cart->get_cart_url();
											echo $cart_link; ?>" title="<?php esc_html_e('View your shopping cart', 'soledad'); ?>"><?php penci_fawesome_icon('fas fa-shopping-cart'); ?><span><?php echo sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count()); ?></span></a>
			<?php

			$fragments['.shoping-cart-icon a.cart-contents'] = ob_get_clean();

			return $fragments;
		}
	}

	/**
	 * Unhook the WooCommerce wrappers and add new Woocommerce wrappers
	 *
	 * @since 2.2
	 */
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	if (! function_exists('penci_woocommerce_custom_wrapper_start')) {
		add_action('woocommerce_before_main_content', 'penci_woocommerce_custom_wrapper_start', 10);
		function penci_woocommerce_custom_wrapper_start()
		{
			$sidebar_class = '';
			$right_sidebar = '';
			if ((is_shop() && get_theme_mod('penci_woo_shop_enable_sidebar')) || ((is_product_category() || is_product_tag()) && get_theme_mod('penci_woo_cat_enable_sidebar')) || (is_product() && get_theme_mod('penci_woo_single_enable_sidebar'))) {
				$sidebar_class = ' penci_sidebar';
				$right_sidebar = ' right-sidebar';
				if (get_theme_mod('penci_woo_left_sidebar')):
					$right_sidebar = ' left-sidebar';
				endif;
			}
			echo '<div class="container' . $sidebar_class . $right_sidebar . '"><div id="main"><div class="theiaStickySidebar">';
		}
	}

	if (! function_exists('penci_woocommerce_custom_wrapper_end')) {
		add_action('woocommerce_after_main_content', 'penci_woocommerce_custom_wrapper_end', 10);
		function penci_woocommerce_custom_wrapper_end()
		{
			echo '</div></div>';
		}
	}

	/**
	 * Hook to change products per page in shop page & categories page
	 *
	 * @since 2.2
	 */
	if (! function_exists('penci_custom_products_per_page')) {
		function penci_custom_products_per_page($options)
		{
			$options = 24;
			if (get_theme_mod('penci_woo_post_per_page')) {
				$options = absint(get_theme_mod('penci_woo_post_per_page'));
			}

			return $options;
		}

		add_filter('loop_shop_per_page', 'penci_custom_products_per_page', 10, 1);
	}

	/**
	 * WooCommerce Unhook sidebar
	 *
	 * @since 2.2
	 */
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

	if (! function_exists('penci_woocommerce_add_sidebar_custom') && function_exists('is_shop') && function_exists('is_product_category') && function_exists('is_product_tag') && function_exists('is_product')) {
		function penci_woocommerce_add_sidebar_custom()
		{
			if ((is_shop() && get_theme_mod('penci_woo_shop_enable_sidebar')) || ((is_product_category() || is_product_tag()) && get_theme_mod('penci_woo_cat_enable_sidebar')) || (is_product() && get_theme_mod('penci_woo_single_enable_sidebar'))):
				add_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
			endif;
		}

		add_action('template_redirect', 'penci_woocommerce_add_sidebar_custom');
	}

	/**
	 * Change default placeholder image woocommerce
	 *
	 * @since 2.2
	 */
	if (! function_exists('penci_change_placeholder_thumbnail')) {
		add_action('init', 'penci_change_placeholder_thumbnail');
		function penci_change_placeholder_thumbnail()
		{
			if (! function_exists('penci_custom_woocommerce_placeholder_img_src')) {
				add_filter('woocommerce_placeholder_img_src', 'penci_custom_woocommerce_placeholder_img_src');
				function penci_custom_woocommerce_placeholder_img_src($src)
				{
					$src = get_template_directory_uri() . '/images/no-image-product.jpg';

					return $src;
				}
			}
		}
	}

	/**
	 * Define image sizes for woocommerce
	 *
	 * @since 2.2
	 */
	if (! function_exists('penci_woocommerce_image_dimensions')) {
		function penci_woocommerce_image_dimensions()
		{
			global $pagenow;

			if (! isset($_GET['activated']) || $pagenow != 'themes.php') {
				return;
			}
			$catalog   = array(
				'width'  => '600',    // px
				'height' => '732',    // px
				'crop'   => 1        // true
			);
			$single    = array(
				'width'  => '600',    // px
				'height' => '732',    // px
				'crop'   => 1        // true
			);
			$thumbnail = array(
				'width'  => '150',    // px
				'height' => '183',    // px
				'crop'   => 1        // false
			);

			// Image sizes
			update_option('shop_catalog_image_size', $catalog);        // Product category thumbs
			update_option('shop_single_image_size', $single);        // Single product image
			update_option('shop_thumbnail_image_size', $thumbnail);    // Image gallery thumbs
		}

		add_action('after_switch_theme', 'penci_woocommerce_image_dimensions', 1);
	}

	/**
	 * Change breadcrum markup for woocommerce
	 *
	 * @since 2.2
	 */
	if (! function_exists('penci_custom_woocommerce_breadcrumbs')) {
		add_filter('woocommerce_breadcrumb_defaults', 'penci_custom_woocommerce_breadcrumbs');
		function penci_custom_woocommerce_breadcrumbs()
		{
			$home = penci_get_setting('penci_trans_home');
			return array(
				'delimiter'   => penci_icon_by_ver('fas fa-angle-right'),
				'wrap_before' => '<div class="container penci-breadcrumb penci-woo-breadcrumb">',
				'wrap_after'  => '</div>',
				'before'      => '<span>',
				'after'       => '</span>',
				'home'        => $home,
			);
		}
	}

	/**
	 * Remove breadcrum when breadcrum is disable in customize
	 *
	 * @since 2.2
	 */
	if (! function_exists('penci_custom_remove_wc_breadcrumbs')) {
		add_action('init', 'penci_custom_remove_wc_breadcrumbs');
		function penci_custom_remove_wc_breadcrumbs()
		{
			if (get_theme_mod('penci_woo_disable_breadcrumb')):
				remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			endif;
		}
	}


	/**
	 * Custom numbers related products for Woocommerce
	 *
	 * @since 2.2
	 */
	if (! function_exists('penci_custom_number_related_products_args')) {
		add_filter('woocommerce_output_related_products_args', 'penci_custom_number_related_products_args');
		function penci_custom_number_related_products_args($args)
		{
			$number = 4;
			if (get_theme_mod('penci_woo_number_related_products')):
				$number = absint(get_theme_mod('penci_woo_number_related_products'));
			endif;

			$args['posts_per_page'] = $number; // 4 related products

			return $args;
		}
	}

	if (! function_exists('penci_soledad_time_link')) :
		/**
		 * Gets a nicely formatted string for the published date.
		 */
		function penci_soledad_time_link($single = null)
		{
			$get_the_date = get_the_date(DATE_W3C);
			$get_the_time = get_the_time(get_option('date_format'));
			$get_the_datem = get_the_modified_date(DATE_W3C);
			$get_the_timem = get_the_modified_date(get_option('date_format'));
			$classes = 'published';
			if ($single == null || (is_single() && ! get_theme_mod('penci_single_publishmodified'))) {
				if (get_theme_mod('penci_show_modified_date')) {
					$get_the_date = $get_the_datem;
					$get_the_time = $get_the_timem;
				}
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
				if (get_the_time('U') !== get_the_modified_time('U')) {
					if (get_theme_mod('penci_show_modified_date')) {
						$classes = 'updated';
					}
					$time_string = '<time class="entry-date ' . $classes . '" datetime="%1$s">%2$s</time>';
				}

				printf(
					$time_string,
					$get_the_date,
					$get_the_time
				);
			} else if (is_single() && get_theme_mod('penci_single_publishmodified')) {
				if ($get_the_time == $get_the_timem) {
					$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
					printf(
						$time_string,
						$get_the_date,
						$get_the_time
					);
				} else {
					$time_string = '<strong>%1$s</strong> <time class="entry-date published" datetime="%2$s">%3$s</time></span><span><strong>%4$s</strong> <time class="entry-date modified" datetime="%5$s">%6$s</time>';
					printf(
						$time_string,
						penci_get_setting('penci_trans_published'),
						$get_the_date,
						$get_the_time,
						penci_get_setting('penci_trans_modifiedat'),
						$get_the_datem,
						$get_the_timem
					);
				}
			}
		}
	endif;

	if (! function_exists('penci_soledad_meta_schema')) {
		/**
		 * Gets a nicely formatted string for the published date.
		 */
		function penci_soledad_meta_schema()
		{
			if (! get_theme_mod('penci_schema_hentry')) {
			?>
				<div class="penci-hide-tagupdated">
					<span class="author-italic author vcard"><?php echo penci_get_setting('penci_trans_by'); ?> <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span>
					<?php penci_soledad_time_link() ?>
				</div>
	<?php
			}
		}
	}

	if (! function_exists('penci_get_the_title')) {
		function penci_get_the_title($post = 0)
		{

			$post = get_post($post);
			$title = isset($post->post_title) ? $post->post_title : '';

			return $title;
		}
	}

	if (! function_exists('penci_soledad_social_share')) {
		function penci_soledad_social_share($pos = '')
		{


			$list_social = array(
				'facebook',
				'twitter',
				'pinterest',
				'linkedin',
				'tumblr',
				/* 'messenger', */
				'vk',
				'ok',
				'reddit',
				'stumbleupon',
				'whatsapp',
				'telegram',
				'line',
				'pocket',
				'skype',
				'viber',
				'email'
			);

			$option_prefix = 'penci__hide_share_';

			$output = '';

			foreach ($list_social as $k => $social_key) {
				$list_social_item = penci_get_setting($option_prefix . $social_key);
				if ($list_social_item) {
					continue;
				}

				$link     = get_permalink();
				$text     = penci_get_the_title();
				$img_link = get_the_post_thumbnail_url();

				switch ($social_key) {
					case 'facebook':
						$facebook_share  = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink();
						$output .= '<a class="post-share-item post-share-facebook" aria-label="Share on Facebook" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($facebook_share) . '">' . penci_icon_by_ver('fab fa-facebook-f') . '<span class="dt-share">' . esc_html__('Facebook', 'soledad') . '</span></a>';
						break;
					case 'twitter':
						$twitter_text = 'Check out this article';
						if (get_theme_mod('penci_post_twitter_share_text')) {
							$twitter_text = do_shortcode(get_theme_mod('penci_post_twitter_share_text'));
						}
						$twitter_text = trim($twitter_text);

						$twitter_share   = 'https://twitter.com/intent/tweet?text=' . rawurlencode($twitter_text) . ':%20' . rawurlencode($text) . '%20-%20' . get_the_permalink();
						$output .= '<a class="post-share-item post-share-twitter" aria-label="Share on Twitter" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($twitter_share) . '">' . penci_icon_by_ver('fab fa-twitter') . '<span class="dt-share">' . esc_html__('Twitter', 'soledad') . '</span></a>';

						break;
					case 'pinterest':

						if ('single' == $pos) {
							$output .=  '<a class="post-share-item post-share-pinterest" aria-label="Pin to Pinterest" data-pin-do="none" ' . penci_reltag_social_icons() . ' onclick="var e=document.createElement(\'script\');';
							$output .=  'e.setAttribute(\'type\',\'text/javascript\');';
							$output .=  'e.setAttribute(\'charset\',\'UTF-8\');';
							$output .=  'e.setAttribute(\'src\',\'//assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);';
							$output .=  'document.body.appendChild(e);';
							$output .=  '">';
							$output .= penci_icon_by_ver('fab fa-pinterest') . '<span class="dt-share">' . esc_html__('Pinterest', 'soledad') . '</span></a>';
						} else {
							$output .= '<a class="post-share-item post-share-pinterest" aria-label="Pin to Pinterest" data-pin-do="none" ' . penci_reltag_social_icons() . ' target="_blank" href="';
							$output .= 'https://www.pinterest.com/pin/create/button/?url=' . urlencode($link);
							if (has_post_thumbnail()) {
								$output .= '&media=' . urlencode($img_link);
							}
							if ($text) {
								$output .= '&description=' . urlencode($text);
							}
							$output .= '">' . penci_icon_by_ver('fab fa-pinterest') . '<span class="dt-share">' . esc_html__('Pinterest', 'soledad') . '</span></a>';
						}

						break;

					case 'linkedin':
						$link = htmlentities(add_query_arg(array(
							'url'   => rawurlencode($link),
							'title' => rawurlencode($text),
						), 'https://www.linkedin.com/shareArticle?mini=true'));

						$output .= '<a class="post-share-item post-share-linkedin" aria-label="Share on LinkedIn" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-linkedin-in') . '<span class="dt-share">' . esc_html__('Linkedin', 'soledad') . '</span></a>';
						break;

					case 'tumblr':
						$link = htmlentities(add_query_arg(array(
							'url'  => rawurlencode($link),
							'name' => rawurlencode($text),
						), 'https://www.tumblr.com/share/link'));
						$output .= '<a class="post-share-item post-share-tumblr" aria-label="Share on Tumblr" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-tumblr') . '<span class="dt-share">' . esc_html__('Tumblr', 'soledad') . '</span></a>';
						break;

					case 'messenger':
						$link = htmlentities(add_query_arg(array(
							'link'  => rawurlencode($link),
							'redirect_uri' => rawurlencode($text),
						), 'https://www.facebook.com/dialog/send?app_id=5303202981&display=popup'));
						$output .= '<a class="post-share-item post-share-messenger show-on-mobile" aria-label="Share on Messenger" target="_blank" ' . penci_reltag_social_icons() . ' href="fb-messenger://share?app_id=5303202981&display=popup&link=' . rawurlencode($link) . '&redirect_uri=' . rawurlencode($link) . '">' . penci_svg_social('messenger') . '<span class="dt-share">' . esc_html__('Messenger', 'soledad') . '</span></a>';
						$output .= '<a class="post-share-item post-share-messenger show-on-desktop" aria-label="Share on Messenger" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_svg_social('messenger') . '<span class="dt-share">' . esc_html__('Messenger', 'soledad') . '</span></a>';
						break;

					case 'vk':
						$link = 'https://vk.com/share.php?url=' . get_the_permalink();
						$output .= '<a class="post-share-item post-share-vk" aria-label="Share on VK" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-vk') . '<span class="dt-share">' . esc_html__('VK', 'soledad') . '</span></a>';
						break;

					case 'ok':
						$link = 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=' . $link . '&amp;description=' . $text . '&amp;media=' . $img_link;
						$output .= '<a class="post-share-item post-share-ok" aria-label="Share on Odnoklassniki" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-odnoklassniki') . '<span class="dt-share">' . esc_html__('Odnoklassniki', 'soledad') . '</span></a>';
						break;

					case 'reddit':
						$link = htmlentities(add_query_arg(array(
							'url'   => rawurlencode($link),
							'title' => rawurlencode($text),
						), 'https://reddit.com/submit'));
						$output .= '<a class="post-share-item post-share-reddit" aria-label="Share on Reddit" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-reddit-alien') . '<span class="dt-share">' . esc_html__('Reddit', 'soledad') . '</span></a>';
						break;

					case 'stumbleupon':
						$link = htmlentities(add_query_arg(array(
							'url'   => rawurlencode($link),
							'title' => rawurlencode($text),
						), 'https://www.stumbleupon.com/submit'));
						$output .= '<a class="post-share-item post-share-stumbleupon" aria-label="Share on Stumbleupon" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-stumbleupon') . '<span class="dt-share">' . esc_html__('Stumbleupon', 'soledad') . '</span></a>';
						break;

					case 'email':
						$link = esc_url('mailto:?subject=' . $text . '&BODY=' . $link);
						$output .= '<a class="post-share-item post-share-email" target="_blank" aria-label="Share via Email" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fas fa-envelope') . '<span class="dt-share">' . esc_html__('Email', 'soledad') . '</span></a>';
						break;

					case 'telegram':
						$link = htmlentities(add_query_arg(array(
							'url'  => rawurlencode($link),
							'text' => rawurlencode($text),
						), 'https://telegram.me/share/url'));
						$output .= '<a class="post-share-item post-share-telegram" aria-label="Share on Telegram" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-telegram') . '<span class="dt-share">' . esc_html__('Telegram', 'soledad') . '</span></a>';
						break;

					case 'whatsapp':
						$link = htmlentities(add_query_arg(array(
							'text' => rawurlencode($text) . ' %0A%0A ' . rawurlencode($link),
						), 'https://api.whatsapp.com/send'));
						$output .= '<a class="post-share-item post-share-whatsapp" aria-label="Share on Whatsapp" target="_blank" ' . penci_reltag_social_icons() . ' href="' . ($link) . '">' . penci_icon_by_ver('fab fa-whatsapp') . '<span class="dt-share">' . esc_html__('Whatsapp', 'soledad') . '</span></a>';
						break;

					case 'line':
						$line_share  = 'https://line.me/R/msg/text/?' . rawurlencode($text) . '%20' . rawurlencode($link);
						$icon_line = penci_svg_social('line');
						$output .= '<a class="post-share-item post-share-line" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($line_share) . '">' . $icon_line . '<span class="dt-share">' . esc_html__('LINE', 'soledad') . '</span></a>';
						break;

					case 'pocket':
						$link = 'https://getpocket.com/save?title=' . $text . '&amp;url=' . $link;
						$output .= '<a class="post-share-item post-share-pocket" aria-label="Share on Pocket" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-get-pocket') . '<span class="dt-share">' . esc_html__('Pocket', 'soledad') . '</span></a>';
						break;

					case 'skype':
						$link = 'https://web.skype.com/share?url=' . $link . '&text=' . $text;
						$output .= '<a class="post-share-item post-share-skype" aria-label="Share on Skype" target="_blank" ' . penci_reltag_social_icons() . ' href="' . esc_url($link) . '">' . penci_icon_by_ver('fab fa-skype') . '<span class="dt-share">' . esc_html__('Skype', 'soledad') . '</span></a>';
						break;

					case 'viber':
						$link = 'viber://forward?text=' . rawurlencode($text) . '%20' . rawurlencode($link);
						$output .= '<a class="post-share-item post-share-viber" aria-label="Share on Viber" target="_blank" ' . penci_reltag_social_icons() . ' href="' . ($link) . '">' . penci_svg_social('viber') . '<span class="dt-share">' . esc_html__('Viber', 'soledad') . '</span></a>';
						break;

					default:
						$output .= '';
						break;
				}
			}


			if ($output) {
				if ('single' == $pos) {
					echo '<div class="list-posts-share">';
				}
				echo $output;

				if ('single' == $pos) {
					echo '</div>';
				}
			}
		}
	}

	if (! function_exists('penci_get_single_style')) {
		function penci_get_single_style()
		{
			static $single_style;
			$single_style = 'style-1';

			$style_psingle   = get_post_meta(get_the_ID(), 'penci_single_style', true);
			if ($style_psingle) {
				$single_style = $style_psingle;

				return $single_style;
			}

			$style          = get_theme_mod('penci_single_style');
			$enable_style2  = get_theme_mod('penci_enable_single_style2');

			if (! get_theme_mod('penci_single_style') && $enable_style2) {
				$single_style = 'style-2';
			} elseif ($style) {
				$single_style = $style;
			}

			return $single_style;
		}
	}

	if (! function_exists('penci_get_primary_cat_id')) {
		function penci_get_primary_cat_id($taxonomy_name = 'category')
		{
			if (! function_exists('yoast_get_primary_term_id') && ! class_exists('RankMath')) {
				return '';
			}
			$primary_term_id = '';
			// Get primary cat from Yoast
			if (function_exists('yoast_get_primary_term_id')) {
				$primary_term_id = yoast_get_primary_term_id($taxonomy_name, get_the_id());
			}
			// Get primary cat from Rank Math
			if (class_exists('RankMath')) {
				$primary_term_id = get_post_meta(get_the_id(), 'rank_math_primary_category', true);
			}

			return $primary_term_id;
		}
	}

	if (! function_exists('penci_get_wpseo_primary_term')) {
		function penci_get_wpseo_primary_term($taxonomy_name = 'category')
		{
			$primary_term_id = penci_get_primary_cat_id($taxonomy_name);
			if ($primary_term_id) {
				$term = get_term($primary_term_id, $taxonomy_name);

				if (is_wp_error($term)) {
					return '';
				}

				// Primary category
				$category_display = $term->name;
				$category_link    = get_category_link($term->term_id);

				return '<span><a class="crumb" href="' . esc_url($category_link) . '">' . $category_display . '</a></span>' . penci_icon_by_ver('fas fa-angle-right');
			}
		}
	}

	/**
	 * Exclude specific categories from latest posts on Homepage
	 *
	 * @since 2.4
	 */
	if (! function_exists('penci_exclude_specific_categories_display_on_home2')) {
		function penci_exclude_specific_categories_display_on_home2($query)
		{

			$feat_query = penci_global_query_featured_slider();

			if (get_theme_mod('penci_exclude_featured_cat') && $feat_query && $query->is_main_query() & is_home()) {

				$list_post_ids = array();
				if ($feat_query->have_posts()) {
					while ($feat_query->have_posts()) : $feat_query->the_post();
						$list_post_ids[] = get_the_ID();
					endwhile;
					wp_reset_postdata();
				}

				if (! $list_post_ids) {
					return $query;
				}

				$query->set('post__not_in', $list_post_ids);
			}
			return $query;
		}

		add_action('pre_get_posts', 'penci_exclude_specific_categories_display_on_home2');
	}

	/**
	 * Get query for related posts of current posts
	 * 
	 * Return $array
	 */
	if (! function_exists('penci_get_query_related_posts')) {
		function penci_get_query_related_posts($id, $based, $orderby, $order, $numbers)
		{

			$return = array();

			$categories = get_the_category($id);
			$primary_catid = penci_get_primary_cat_id();
			if ('primary_cat' == $based && $primary_catid) {
				$term               = get_term($primary_catid);
				if (! is_wp_error($term)) {
					$categories = array($term);
				}
			}

			if ('tags' == $based):
				$categories = wp_get_post_terms($id, 'post_tag', array('fields' => 'ids'));
			endif;

			if ($categories) {
				if ($based == 'tags') {
					$return = array(
						'post_type'      => 'post',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => $numbers,
						'tax_query'      => array(
							array(
								'taxonomy' => 'post_tag',
								'terms'    => $categories
							),
						),
						'post__not_in'        => array($id),
						'orderby'             => $orderby,
						'order'               => $order
					);
				} else {
					$category_ids = array();
					$featured_cat = '';
					/* Get featured category when slider is enabled */
					if (get_theme_mod('penci_featured_slider') && (get_theme_mod('penci_featured_slider_filter_type') != 'tags')):
						$featured_cat = get_theme_mod('penci_featured_cat');
					endif;

					foreach ($categories as $individual_category) {
						/* Remove featured slider categories to related posts */
						$term_related = $individual_category->term_id;
						if (! get_theme_mod('penci_post_related_exclusive_cat') || (get_theme_mod('penci_post_related_exclusive_cat') && ($term_related != $featured_cat))) {
							$category_ids[] = $term_related;
						}
					}

					$return = array(
						'category__in'        => $category_ids,
						'post__not_in'        => array($id),
						'posts_per_page'      => $numbers,
						'ignore_sticky_posts' => 1,
						'orderby'             => $orderby,
						'order'               => $order
					);
				}
			}

			return $return;
		}
	}

	/**
	 * Get class for detect sidebar use for single posts page.
	 * 
	 * Return $string
	 */
	if (! function_exists('penci_get_posts_sidebar_class')) {
		function penci_get_posts_sidebar_class()
		{
			$sidebar_customize = get_theme_mod("penci_single_layout") ? get_theme_mod("penci_single_layout") : 'right-sidebar';
			$sidebar_opts = get_post_meta(get_the_ID(), 'penci_post_sidebar_display', true);
			$sidebar_pos = $sidebar_opts ? $sidebar_opts : $sidebar_customize;

			$sidebar_position = '';
			if ($sidebar_pos == 'left') {
				$sidebar_position = 'left-sidebar';
			} elseif ($sidebar_pos == 'right') {
				$sidebar_position = 'right-sidebar';
			} elseif ($sidebar_pos == 'two') {
				$sidebar_position = 'two-sidebar';
			}

			return $sidebar_position;
		}
	}

	/**
	 * Apply logo image to WP Block Embed
	 * 
	 * Return $string
	 */
	add_filter('get_site_icon_url', 'penci_custom_wp_block_embedded_icon');
	function penci_custom_wp_block_embedded_icon($url)
	{
		$icon = get_theme_mod('penci_favicon');
		if ($icon) {
			return $icon;
		} else {
			return $url;
		}
	}

	function penci_custom_login_logo_url($url)
	{
		if (get_theme_mod('activate_white_label')) {
			return get_bloginfo('url');
		} else {
			return $url;
		}
	}
	add_filter('login_headerurl', 'penci_custom_login_logo_url', 10, 1);

	/**
	 * Check if single has sidebar or not
	 * 
	 * Return $string
	 */
	if (! function_exists('penci_single_sidebar_return')) {
		function penci_single_sidebar_return()
		{

			$single_sidebar = true;
			$sidebar_old = get_theme_mod("penci_sidebar_posts");
			$sidebar_customize = get_theme_mod("penci_single_layout");
			$sidebar_opts = get_post_meta(get_the_ID(), 'penci_post_sidebar_display', true);

			if ($sidebar_opts == 'no' || $sidebar_opts == 'small_width') {
				$single_sidebar = false;
			} elseif (! $sidebar_opts) {
				if ($sidebar_customize == 'no' || $sidebar_customize == 'small_width') {
					$single_sidebar = false;
				} elseif (! get_theme_mod("penci_single_layout")) {
					if (! penci_get_setting('penci_sidebar_posts')) {
						$single_sidebar = false;
					}
				}
			}

			return $single_sidebar;
		}
	}

	/**
	 * Get inline-ads markup
	 *
	 */
	if (!function_exists('penci_get_markup_infeed_ad')) {
		function penci_get_markup_infeed_ad($args)
		{

			$defaults = array(
				'wrapper'     => 'div',
				'classes'      => 'penci-infeed-ads',
				'fullwidth'	 => '',
				'order_ad'   => 3,
				'order_post' => '',
				'code'       => '',
				'echo'       => false
			);

			$parse = wp_parse_args($args, $defaults);

			$before = $after = $order_ad = $order_post = $code = '';
			extract($parse);

			if (($order_post % $order_ad != 0) || ! $code) {
				return;
			}

			if ('full' == $fullwidth) {
				$classes = $classes . ' penci-infeed-fullwidth-ads';
				$wrapper = 'div';
			}

			$output = '<' . $wrapper . ' class="' . $classes . '">';
			$output .= '<div class="penci-inner-infeed-data">';
			$output .= do_shortcode($code);
			$output .= '</div>';
			$output .= '</' . $wrapper . '>';

			if (! $parse['echo']) {
				return $output;
			}

			echo $output;
		}
	}

	/**
	 * Check showing reading time or not
	 *
	 * $option - the option to passed show/hide reading time
	 */
	if (!function_exists('penci_isshow_reading_time')) {
		function penci_isshow_reading_time($option)
		{
			$return = false;
			$post_id = get_the_ID();
			if ($post_id) {
				$default_reading = get_theme_mod('penci_readtime_default') ? get_theme_mod('penci_readtime_default') : '';
				$reading_time = get_post_meta($post_id, 'penci_reading_time', true);
				if (($reading_time || $default_reading) && ! $option) {
					$return = true;
				}
			}

			return $return;
		}
	}

	/**
	 * Get reading time data
	 *
	 */
	if (! function_exists('penci_reading_time')) {
		function penci_reading_time($echo = true)
		{
			$return = get_theme_mod('penci_readtime_default') ? get_theme_mod('penci_readtime_default') : '';
			$post_id = get_the_ID();
			if ($post_id) {
				$reading_time = get_post_meta($post_id, 'penci_reading_time', true);
				if ($reading_time) {
					$return = $reading_time;
				}
			}

			if ($return && penci_get_setting('penci_trans_read')) {
				$return = $return . ' ' . penci_get_setting('penci_trans_read');
			}

			if ($echo == false) {
				return $return;
			}

			echo $return;
		}
	}

	/*
 * run do_shortcode for get_theme_mod
 */
	if (! function_exists('penci_theme_mod')) {
		function penci_theme_mod($option)
		{
			if (! get_theme_mod($option)) {
				return false;
			} else {
				return do_shortcode(get_theme_mod($option));
			}
		}
	}

	/**
	 * Check if single has layout smaller content
	 * 
	 * Return $string
	 */
	if (! function_exists('penci_single_smaller_content_enable')) {
		function penci_single_smaller_content_enable()
		{

			$single_smaller_content = false;
			$sidebar_customize = get_theme_mod("penci_single_layout");
			$sidebar_opts = get_post_meta(get_the_ID(), 'penci_post_sidebar_display', true);

			if ($sidebar_opts == 'small_width') {
				$single_smaller_content = true;
			} elseif (! $sidebar_opts) {
				if ($sidebar_customize == 'small_width') {
					$single_smaller_content = true;
				}
			}

			return $single_smaller_content;
		}
	}

	if (! function_exists('penci_get_query_featured_slider')) {
		function penci_get_query_featured_slider()
		{

			if (!get_theme_mod('penci_exclude_featured_cat')) {
				$feat_query = penci__query_featured_slider();
			} else {
				$feat_query = penci_global_query_featured_slider();
				if (! $feat_query) {
					$feat_query = penci__query_featured_slider();
				}
			}
			return $feat_query;
		}
	}

	if (! function_exists('penci_global_query_featured_slider')) {
		function penci_global_query_featured_slider()
		{
			$feat_query = array();
			if (isset($GLOBALS['penci_query_featured_slider']) && $GLOBALS['penci_query_featured_slider']) {
				$feat_query = $GLOBALS['penci_query_featured_slider'];
			}
			return $feat_query;
		}
	}

	if (! function_exists('penci__query_featured_slider')):
		function penci__query_featured_slider()
		{
			$feat_query = array();
			if (get_theme_mod('penci_featured_slider')) {
				$slider_style = get_theme_mod('penci_featured_slider_style') ? get_theme_mod('penci_featured_slider_style') : 'style-1';

				if (in_array($slider_style, array('style-31', 'style-32'))) {
					return array();
				}

				$featured_cat = get_theme_mod('penci_featured_cat');
				$number       = get_theme_mod('penci_featured_slider_slides');

				if (! $number) {
					$number = 6;
					if (in_array($slider_style, array('style-7', 'style-8', 'style-10', 'style-19', 'style-23', 'style-24', 'style-25'))) {
						$number = 8;
					} elseif (in_array($slider_style, array('style-17', 'style-18', 'style-20', 'style-21', 'style-26', 'style-27'))) {
						$number = 10;
					} elseif (in_array($slider_style, array('style-22', 'style-28'))) {
						$number = 14;
					} elseif ($number < 3 && $slider_style == 'style-37') {
						$number = 6;
					}
				}
				$featured_args = array('posts_per_page' => $number, 'post_type' => 'post', 'post_status' => 'publish');

				if (! get_theme_mod('penci_featured_tags') || get_theme_mod('penci_featured_slider_filter_type') != 'tags') {
					if ($featured_cat && '0' != $featured_cat):
						$featured_args['cat'] = $featured_cat;
					endif;
				} elseif (get_theme_mod('penci_featured_tags') && get_theme_mod('penci_featured_slider_filter_type') == 'tags') {
					$list_tag = get_theme_mod('penci_featured_tags');
					$list_tag_trim = str_replace(' ', '', $list_tag);
					$list_tags = explode(',', $list_tag_trim);
					$featured_args['tax_query'] = array(
						array(
							'taxonomy' => 'post_tag',
							'field'    => 'slug',
							'terms'    => $list_tags
						),
					);
				}

				$orderby = get_theme_mod('featured_slider_orderby');
				$order   = get_theme_mod('featured_slider_order');

				$featured_args['orderby'] = $orderby ? $orderby : 'date';
				$featured_args['order']   = $order ? $order : 'DESC';

				$feat_query = new WP_Query($featured_args);
			}

			return $feat_query;
		}
	endif;

	if (! function_exists('penci_set_query_featured_slider')):
		function penci_set_query_featured_slider()
		{

			$query = array();
			if (get_theme_mod('penci_exclude_featured_cat')) {
				$query = penci__query_featured_slider();
			}

			$GLOBALS['penci_query_featured_slider'] = $query;
		}
		add_action('init', 'penci_set_query_featured_slider');
	endif;


	if (! function_exists('penci_reltag_social_icons')):
		function penci_reltag_social_icons()
		{
			$dataref = get_theme_mod('penci_rel_type_social') ? get_theme_mod('penci_rel_type_social') : 'noreferrer';
			$data_return = str_replace('_', ' ', $dataref);
			if ('none' != $data_return) {
				$return = ' rel="' . $data_return . '"';
			} else {
				$return = '';
			}

			return $return;
		}
	endif;

	if (! is_admin()) {
		require get_template_directory() . '/inc/video-format.php';
		new Penci_Sodedad_Video_Format;
	}
	include(trailingslashit(get_template_directory()) . 'inc/excerpt.php');
	include(trailingslashit(get_template_directory()) . 'inc/instagram/instagram.php');
	include(trailingslashit(get_template_directory()) . 'inc/global-js.php');
	include(trailingslashit(get_template_directory()) . 'soledad_vc.php');

	// Visual Composer add on
	if (defined('WPB_VC_VERSION')) {
		include(trailingslashit(get_template_directory()) . 'inc/js_composer/js_composer.php');
		include(trailingslashit(get_template_directory()) . 'inc/js_composer/soledad_vc.php');
	}

	if (defined('ELEMENTOR_VERSION')) {
		require get_template_directory() . '/inc/elementor/elementor.php';
	}
	// Function work with elementor, vc, widgets
	require get_template_directory() . '/inc/js_composer/inc/helper.php';

	require get_template_directory() . '/inc/json-schema-validar.php';
	require get_template_directory() . '/inc/dashboard/class-penci-dashboard.php';
	new Penci_Soledad_Dashboard();

	if (function_exists('register_block_type')) {
		require get_template_directory() . '/inc/gutenberg/gutenberg.php';
	}


	define('THEME_DIR', get_template_directory());
	define('THEME_URI', get_template_directory_uri());

	define('BLOCKS_URI', THEME_URI . '/blocks');
	define('BLOCKS_DIR', THEME_DIR . '/blocks');
	require_once(BLOCKS_DIR . '/lth-blocks.php');

	function lth_theme_styles()
	{
		wp_enqueue_style('bootstrap', THEME_URI . '/css/bootstrap.min.css', false, 'all');
		wp_enqueue_style('fancybox', THEME_URI . '/css/jquery.fancybox.min.css', false, 'all');
		wp_enqueue_style('swiper', THEME_URI . '/css/swiper-bundle.min.css', false, 'all');
		wp_enqueue_style('custom', THEME_URI . '/css/custom.css', false, 'all');
	}
	add_action('wp_enqueue_scripts', 'lth_theme_styles');

	/**
	 * Add js
	 * 
	 * @author LTH
	 * @since 2020
	 */
	function lth_theme_scripts()
	{
		wp_enqueue_script('fancybox', THEME_URI . '/js/jquery.fancybox.min.js', false, 'all');
		wp_enqueue_script('swiper', THEME_URI . '/js/swiper-bundle.min.js', false, 'all');
		wp_enqueue_script('custom', THEME_URI . '/js/custom.js', false, 'all');
	}
	add_action('wp_enqueue_scripts', 'lth_theme_scripts', 99);

	require_once(THEME_DIR . '/BFI_Thumb.php');
	function lth_custom_img($thumb_size, $image_width, $image_height)
	{
		global $post;
		$params = array('width' => $image_width, 'height' => $image_height, 'crop' => true);
		$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID, ''), $thumb_size);
		$custom_img_src = bfi_thumb($imgsrc[0], $params);
		return $custom_img_src;

		///// gọi hình ảnh (đặt code ở vị trí muốn hiển thị ảnh)
		/* <img src="<?php echo lth_custom_img('full', 300, 300);?>"> */
	}



	/**
	 * Remove Item Menu Admin
	 */
	add_action('admin_init', 'remove_menu_pages');
	function remove_menu_pages()
	{
		remove_menu_page('edit.php?post_type=acf-field-group');
		remove_menu_page('acf-options');
		remove_menu_page('edit.php?post_type=lazyblocks');
	}

	/**
	 * Lấy URL của ảnh mặc định từ thư mục wp-content/uploads.
	 *
	 * @param string $image_filename Tên file ảnh mặc định (ví dụ: 'default-thumbnail.jpg'
	 * hoặc '2025/07/default-thumbnail.jpg' nếu có thư mục tháng/năm).
	 * @param string $fallback_url   URL dự phòng nếu ảnh mặc định không tồn tại.
	 * @return string                URL của ảnh mặc định hoặc URL dự phòng.
	 */
	function get_default_thumbnail_url($image_filename = 'default-thumbnail.jpg', $fallback_url = 'https://via.placeholder.com/227x146?text=No+Image')
	{
		// Lấy thông tin về thư mục uploads
		$upload_dir = wp_get_upload_dir();
		$upload_baseurl = $upload_dir['baseurl']; // Đường dẫn URL
		$upload_basedir = $upload_dir['basedir']; // Đường dẫn vật lý trên server

		// Đường dẫn đầy đủ tới file ảnh mặc định
		$default_image_url = esc_url($upload_baseurl . '/' . $image_filename);
		$default_image_filepath = $upload_basedir . '/' . $image_filename;

		// Kiểm tra xem file ảnh có tồn tại trên server không
		if (file_exists($default_image_filepath)) {
			return $default_image_url; // Trả về URL của ảnh mặc định
		} else {
			return esc_url($fallback_url); // Trả về URL dự phòng nếu ảnh mặc định không tồn tại
		}
	}
