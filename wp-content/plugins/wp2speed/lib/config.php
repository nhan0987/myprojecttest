<?php
$penlazy = get_theme_mod( 'penci_speed_disablelazyimg' ) ? 0 : 1;
return array(
	'debug'=> 1,
	'test'=> 0,
	//'fix_js_deps'=> 0,
	'minify_merge'=> 0,	//minify can err
	
	//default =1: because separate load js may not wrap in document ready
	'merge_js'=> isset($_GET['merge_js'])? (int)$_GET['merge_js']:1,	//isset($_GET['merge_js'])? (int)$_GET['merge_js']:1,
	'merge_css'=> isset($_GET['merge_css'])? (int)$_GET['merge_css']:1,//wp_is_mobile()? 0 : 
	//'inline_css'=> 1,	//0=no when exist critical css
	'merge_inline'=>0,
	'dynamic_content'=> 0,	//not recommend @deprecated
	'purge_transient'=> 0,
	'lazyload'=> $penlazy,
	'lazy_class'=> 'lazy',
	//'lazy_fix'=>0,
	'same_css_lang'=>1,
	//'fetch_css'=>0,
	'logo_base64'=>1,
	'yt_thumb_size'=> 'maxresdefault',	//hqdefault|sddefault|maxresdefault
	'server_cache'=> 0,//v1
	'license_key'=> 'AKfycbwDhi-zgHe8aufOZAUbSzIrWGCf_RsMU0nMsDpecnfnZ9BxJO7t',
	'trial'=> 0,
	'hide_plugin'=> 0,
	'update_plugin'=> 0,
);