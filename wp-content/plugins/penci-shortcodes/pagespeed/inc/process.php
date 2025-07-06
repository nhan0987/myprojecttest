<?php

namespace Soledad\PageSpeed;

/**
 * Soledad PageSpeed processing setup for JS and CSS optimizations.
 *
 * @author  asadkn
 * @modified pencidesign
 * @since   1.0.0
 */
class Process {
	/**
	 * Init happens too early around plugins_loaded
	 */
	public function init() {
		// Setup at init but before template_redirect.
		set_theme_mod( 'penci_speed_delay_css_type', 'onload' );
		add_action( 'init', [ $this, 'setup' ] );
	}

	/**
	 * Setup filters for processing
	 *
	 * @since 1.1.0
	 */
	public function setup() {
		if ( $this->should_process() ) {

			// Load integrations.
			if ( class_exists( '\Elementor\Plugin', false ) ) {
				new Integrations\Elementor;
			}

			if ( class_exists( 'Vc_Manager' ) ) {
				new Integrations\Wpbakery;
			}

			// Check lazy images load
			add_action( 'wp_enqueue_scripts', function () {
				if ( ! $this->should_optimize_css() ) {
					return false;
				}
				wp_dequeue_script( 'pc-lazy' );
				if ( get_theme_mod( 'penci_speed_disable_first_screen', false ) ) {
					wp_enqueue_script( 'pc-lazy' );
				}
			}, 99 );

			/**
			 * Process HTML for inline and local stylesheets.
			 *
			 * wp_ob_end_flush_all() will take care of flushing it.
			 *
			 * Note: Autoptimize starts at priority 2 so we use 3 to process BEFORE AO.
			 */
			add_action( 'template_redirect', function () {
				if ( ! apply_filters( 'soledad_pagespeed/should_process', true ) ) {
					return false;
				}

				// Can't go in should_process() as that's too early.
				if ( function_exists( '\amp_is_request' ) && \amp_is_request() ) {
					return false;
				}

				if ( ( function_exists( 'is_penci_amp' ) && is_penci_amp() ) || ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ) {
					return false;
				}

				// Shouldn't process feeds, embeds (iframe), or robots.txt request.
				if ( \is_feed() || \is_embed() || \is_robots() ) {
					return false;
				}

				ob_start( [ $this, 'process_markup' ] );
			}, - 999 );

			// DEBUG: Devs if your output is disappearing - which you need for debugging,
			// uncomment below and comment the init action above.
			// add_action('template_redirect', function() { ob_start(); }, -999);
			// add_action('shutdown', function() {
			// 	$content = ob_get_clean();
			// 	echo $this->process_markup($content);
			// }, -10);
		}
	}

	/**
	 * Should any processing be done at all.
	 *
	 * @return boolean
	 */
	public function should_process() {

		if ( is_admin() ) {
			return false;
		}

		if ( function_exists( 'is_customize_preview' ) && is_customize_preview() ) {
			return false;
		}

		if ( isset( $_GET['nosoledad_pagespeed'] ) ) {
			return false;
		}

		if ( Util\is_elementor() ) {
			return false;
		}

		// WPBakery Page Builder. vc_is_page_editable() isn't reliable at all hooks.
		if ( ! empty( $_GET['vc_editable'] ) ) {
			return false;
		}

		if ( ! get_theme_mod( 'penci_speed_disable_cssjs', false ) && is_user_logged_in() ) {
			return false;
		}

		return true;
	}

	/**
	 * Should the CSS be optimized.
	 *
	 * @return boolean
	 */
	public function should_optimize_css() {
		$valid = get_theme_mod( 'penci_speed_remove_css' ) || get_theme_mod( 'penci_speed_optimize_css' );

		return apply_filters( 'soledad_pagespeed/should_optimize_css', $valid );
	}

	/**
	 * Process DOM Markup provided with the html.
	 *
	 * @param string $html
	 *
	 * @return string
	 */
	public function process_markup( $html ) {
		do_action( 'soledad_pagespeed/process_markup', $this );

		if ( ! $this->is_valid_markup( $html ) ) {
			return $html;
		}

		$dom = null;

		if ( $this->should_optimize_css() ) {
			// fix google fonts character
			$html = str_replace( '&#038;', '&', $html );

			// progress
			$dom      = $this->get_dom( $html );
			$optimize = new OptimizeCss( $dom, $html );
			$html     = $optimize->process();
		}

		$html = $this->hpp_defer_media( $html );

		if ( $this->should_optimize_js() ) {
			$optimize_js = new OptimizeJs( $html );
			$html        = $optimize_js->process();
		}

		// Add delay load JS and extras as needed.
		$html = Plugin::delay_load()->render( $html );

		// Failed at processing DOM, return original.
		if ( ! $dom ) {
			return $html;
		}

		return $html;
	}

	public function is_valid_markup( $html ) {
		if ( stripos( $html, '<html' ) === false ) {
			return false;
		}

		return true;
	}

	/**
	 * Get DOM object for the provided HTML.
	 *
	 * @param string $html
	 *
	 * @return boolean|\DOMDocument
	 */
	protected function get_dom( $html ) {
		if ( ! $html ) {
			return false;
		}

		$libxml_previous = libxml_use_internal_errors( true );
		$dom             = new \DOMDocument();
		$result          = $dom->loadHTML( $html );

		libxml_clear_errors();
		libxml_use_internal_errors( $libxml_previous );

		if ( $result ) {
			$dom->xpath = new \DOMXPath( $dom );
		}

		return $result ? $dom : false;
	}

	public function hpp_defer_media( $str ) {
		if ( ( stripos( $str, '<img' ) !== false || stripos( $str, '<iframe' ) !== false ) && apply_filters( 'hpp_should_defer_media_in_text', true, $str ) ) {
			$str = $this->hpp_defer_imgs( $str );
			//should after to prevent duplicate lazy
			if ( stripos( $str, '<iframe' ) !== false ) {
				$str = $this->hpp_lazy_video( $str, 2, 0 );
			}
		}

		return $str;
	}

	public function hpp_defer_imgs( $str ) {
		if ( get_theme_mod( 'penci_speed_disable_lazy', false ) ) {
			return $str;
		}
		$str0 = $str;
		if ( ! isset( $GLOBALS['hpp_tags'] ) ) {
			$GLOBALS['hpp_tags'] = [];
		}
		$tags = &$GLOBALS['hpp_tags'];
		$str  = preg_replace_callback( '#<(img|iframe)(((?!>).)*)\s+?src=(((?!;base64,).)*?)>#si', function ( $m ) use ( &$tags ) {
			#$tags[$m[0]] = 1;
			if ( strpos( $m[0], ' data-src=' ) !== false || ( isset( $tags[ $m[0] ] ) && ! $tags[ $m[0] ] ) ) {
				return $m[0];
			}
			$tag           = '<' . $m[1] . $m[2] . ' src=' . $m[4] . '>';
			$tags[ $m[0] ] = ! apply_filters( 'hpp_disallow_lazyload', false, $tag );
			$w             = $this->hpp_getAttr( $m[4] . ' ' . $m[2], 'width', 3 );
			$h             = $this->hpp_getAttr( $m[4] . ' ' . $m[2], 'height', 2 );

			return $tags[ $m[0] ] ? '<' . $m[1] . $m[2] . ( $m[1] == 'img' ? ' src="' . $this->hpp_b64holder( '"', $w, $h ) . '"' : ' class="penci-lazy"' ) . ' data-src=' . $m[4] . '>' : $tag;
		}, $str );
		if ( $str === null ) {
			return $str0;
		}
		$class = 'penci-lazy';
		$str   = preg_replace_callback( '#<(img)(((?!>).)*)\s+?class=(\'|")(((?! ' . $class . ' ).)*?)>#si', function ( $m ) use ( $class, &$tags ) {
			if ( isset( $tags[ $m[0] ] ) && ! $tags[ $m[0] ] ) {
				return $m[0];
			}
			$tag = '<' . $m[1] . $m[2] . ' class=' . $m[4] . ' ' . $m[5] . '>';

			return 1 || $tags[ $m[0] ] ? '<' . $m[1] . $m[2] . ' class=' . $m[4] . ' ' . $class . ' ' . $m[5] . '>' : $tag;
		}, $str );

		$str = preg_replace_callback( '#<(img)(((?! class=).)*?)>#si', function ( $m ) use ( $class, &$tags ) {
			if ( isset( $tags[ $m[0] ] ) && ! $tags[ $m[0] ] ) {
				return $m[0];
			}
			$tag = '<' . $m[1] . ' ' . $m[2] . '>';

			return 1 || $tags[ $m[0] ] ? '<' . $m[1] . ' class=" ' . $class . ' "' . $m[2] . '>' : $tag;
		}, $str );

		$str = preg_replace_callback( '#<(img|iframe)(((?!>).)*)\s+?srcset=(((?!;base64,).)*?)>#si', function ( $m ) use ( &$tags ) {
			if ( isset( $tags[ $m[0] ] ) && ! $tags[ $m[0] ] ) {
				return $m[0];
			}

			return '<' . $m[1] . $m[2] . ' data-srcset=' . $m[4] . '>';
		}, $str );


		return $str;
	}

	public function hpp_getAttr( $tag, $attr, $val = '' ) {
		if ( is_array( $attr ) ) {
			$atts = [];
			foreach ( $attr as $k => $v ) {
				$atts[ $k ] = $this->hpp_getAttr( $tag, $k, $v );
			}

			return $atts;
		}
		if ( strpos( $tag, " {$attr}=" ) !== false ) {
			$ar = explode( ' ' . $attr . '=', $tag );
			$ar = explode( '"', $ar[1] );
			$ar = explode( "'", trim( $ar[0] ) ? $ar[0] : $ar[1] );

			return trim( $ar[0] );
		}

		return $val;
	}

	public function hpp_b64holder( $wrap = '"', $width = '0', $height = '0' ) {
		if ( $width == '' ) {
			$width = '3';
		}
		if ( $height == '' ) {
			$height = '2';
		}
		if ( $wrap == '"' ) {
			return "data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20" . $width . "%20" . $height . "'%3E%3C/svg%3E";
		} else {
			return 'data:image/svg+xml,%3Csvg%20xmlns="http://www.w3.org/2000/svg"%20viewBox="0%200%20' . $width . '%20' . $height . '"%3E%3C/svg%3E';
		}
	}

	public function hpp_lazy_video( $str, $mt = 2, $fallback = 1 ) {
		if ( ! get_theme_mod( 'penci_speed_disable_lazy', false ) || stripos( $str, '<iframe' ) === false || ! apply_filters( 'hpp_allow_lazy_video', 1, $str ) ) {
			return $str;
		}
		#$str = html_entity_decode($str);
		preg_match_all( '#<iframe(((?!>).)*)(\s+?)(src|data-src)=.*?>(.*?)<\/iframe>#si', $str, $m ); #_print($m);die; //<iframe(.*?)>(.*)?<\/iframe>|(((?!hqp'.rand().').)*?)>(((?!>).)*)
		$class = 'penci-lazy';
		foreach ( $m[0] as $txt ) {
			//way 2
			if ( $mt == 2 ) {
				$v = $this->hpp_get_embed_video_url( $txt );
				if ( ! empty( $v ) ) {
					$at      = $this->hpp_getAttr( $txt, [ 'width' => '3', 'height' => '2' ] );
					$replace = '<iframe title="" class="penci-lazy" data-src="' . $v['url'] . '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					$str     = str_ireplace( $txt, $replace, $str );
				} elseif ( $fallback ) {
					$mt = 1;
				}
			}
			//method 1
			if ( $mt == 1 ) {
				$str = str_ireplace( $txt, $this->hpp_defer_imgs( $txt ), $str );
			}
		}

		return $str;
	}

	public function hpp_get_embed_video_url( $str ) {
		$r    = array();
		$size = 'maxresdefault';
		//youtube
		if ( strpos( $str, 'youtube.com/watch?v=' ) !== false ) {
			preg_match( '#youtube.com\/watch\?v=(.+?)("|\')#', $str, $m );
			$m        = explode( '&', $m[1] );
			$id       = $m[0];
			$r['url'] = 'https://www.youtube.com/embed/' . $id;
			$s        = $this->hpp_curl_get( $r['url'] );
			preg_match_all( '#(https:\/\/(.*?).ytimg.com/(.*?))\"#', $s, $m );
			$r['thumb'] = trim( $m[1][ count( $m[1] ) - 1 ], '\\' );
		} elseif ( strpos( $str, 'youtube.com/embed/' ) !== false ) {
			preg_match( '#youtube.com/embed/(.+?)("|\')#', $str, $m );
			$m1   = explode( '?', $m[1] );
			$id   = $m1[0];
			$lang = 'en';
			if ( $id == 'videoseries' ) {
				$s = $this->hpp_curl_get( 'https://www.youtube.com/embed/' . $m[1] );
				preg_match_all( '#"VIDEO_ID":"(.*?)"|ytimg.com\/(\w+?)\/#', $s, $m );
				if ( ! empty( $m[1][1] ) ) {
					$id = $m[1][1];
				}
				if ( ! empty( $m[2][0] ) ) {
					$lang = $m[2][0];
				}
			} else {
				$s = $this->hpp_curl_get( 'https://www.youtube.com/embed/' . $id );
			}
			$r['url'] = 'https://www.youtube.com/embed/' . $id;
			preg_match_all( '#(https:\/\/(.*?).ytimg.com/(.*?))\"#', $s, $m );
			$r['thumb'] = trim( $m[1][ count( $m[1] ) - 1 ], '\\' );
		}
		if ( isset( $r['thumb'] ) && strpos( $r['thumb'], '"' ) !== false ) {
			$tmp        = explode( '"', $r['thumb'] );
			$r['thumb'] = $tmp[0];
		}

		return $r;
	}

	public function hpp_curl_get( $url, $opts = array(), $refresh_cookie = false, $code = 0 ) {
		if ( isset( $opts[ CURLOPT_HTTPHEADER ] ) ) {
			$opts[ CURLOPT_HTTPHEADER ] = [
				'User-Agent: ' . $this->hpp_user_agent()
			];
		}
		$ch = curl_init( $url );//hpp_fix_resource_url($url)
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $ch, CURLOPT_REFERER, home_url( '/' ) ); //important for embed youtube
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 0 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 540 ); //timeout in seconds

		if ( is_array( $opts ) && count( $opts ) ) {
			curl_setopt_array( $ch, $opts );
		}
		//cookie
		if ( $refresh_cookie ) {
			curl_setopt( $ch, CURLOPT_COOKIESESSION, true );
		}

		$resp = curl_exec( $ch );
		if ( $code && curl_getinfo( $ch, CURLINFO_HTTP_CODE ) != 200 ) {
			$resp = '';
		}
		curl_close( $ch );

		return $resp;
	}

	public function hpp_user_agent() {
		$agents = array(
			'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2',
			'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
			'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
			'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
			'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14',
			'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A'
		);

		$chose = rand( 0, 5 );

		return $agents[ $chose ];
	}

	/**
	 * Should the JS be optimized.
	 *
	 * @return boolean
	 */
	public function should_optimize_js() {
		$valid = true;

		return apply_filters( 'soledad_pagespeed/should_optimize_js', $valid );
	}

	/**
	 * Conditions test to see if current page matches in the provided valid conditions.
	 *
	 * @param array $enable_on
	 *
	 * @return boolean
	 */
	public function check_enabled( array $enable_on ) {
		if ( in_array( 'all', $enable_on ) ) {
			return true;
		}

		$conditions = [
			'pages'      => 'is_page',
			'posts'      => 'is_single',
			'archives'   => 'is_archive',
			'archive'    => 'is_archive', // Alias
			'categories' => 'is_category',
			'tags'       => 'is_tag',
			'search'     => 'is_search',
			'404'        => 'is_404',
			'home'       => function () {
				return is_home() || is_front_page();
			},
		];

		$satisfy = false;
		foreach ( $enable_on as $key ) {
			if ( ! isset( $conditions[ $key ] ) || ! is_callable( $conditions[ $key ] ) ) {
				continue;
			}

			$satisfy = call_user_func( $conditions[ $key ] );

			// Stop going further in loop once satisfied.
			if ( $satisfy ) {
				break;
			}
		}

		return $satisfy;
	}
}
