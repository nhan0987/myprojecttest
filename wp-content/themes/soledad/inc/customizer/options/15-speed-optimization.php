<?php
/* Add Sections */
$wp_customize->add_section( 'penci_section_speed_general', array(
	'title'    => esc_html__( 'General & Lazyload', 'soledad' ),
	'priority' => 5,
	'panel'      => 'penci_speed_section_panel',
	'description'      => __( 'To use options here in the right way - please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">this guide</a> first - on <strong>Speed Optimization</strong> section', 'soledad' ),
) );
$wp_customize->add_section( 'penci_section_speed_css', array(
	'title'    => esc_html__( 'Optimize CSS', 'soledad' ),
	'priority' => 10,
	'panel'      => 'penci_speed_section_panel',
	'description'      => __( 'To use options here in the right way - please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">this guide</a> first - on <strong>Speed Optimization</strong> section', 'soledad' ),
) );

$wp_customize->add_section( 'penci_section_speed_javascript', array(
	'title'    => esc_html__( 'Optimize JavaScript', 'soledad' ),
	'priority' => 15,
	'description'      => __( 'To use options here in the right way - please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">this guide</a> first - on <strong>Speed Optimization</strong> section', 'soledad' ),
	'panel'      => 'penci_speed_section_panel'
) );

$wp_customize->add_section( 'penci_section_speed_html', array(
	'title'    => esc_html__( 'Optimize HTML', 'soledad' ),
	'priority' => 20,
	'description'      => __( 'To use options here in the right way - please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">this guide</a> first - on <strong>Speed Optimization</strong> section', 'soledad' ),
	'panel'      => 'penci_speed_section_panel'
) );

/* General & Lazyload */
$wp_customize->add_setting( 'penci_speed_disable_emoji', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_disable_emoji', array(
	'label'    => 'Disable Emoji and Smilies',
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_speed_disable_emoji',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_remove_query_string', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_remove_query_string', array(
	'label'    => 'Remove query strings from static resource',
	'description'  => __( 'Remove query strings for non-login & non-administrator users', 'soledad' ),
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_speed_remove_query_string',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_remove_wlwmanifest', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_remove_wlwmanifest', array(
	'label'    => 'Remove wlwmanifest Link',
	'description'  => __( 'If you do not use Windows Live Writer, you can disable it.', 'soledad' ),
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_speed_remove_wlwmanifest',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_remove_xml_rsd', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_remove_xml_rsd', array(
	'label'    => 'Remove XML-RPC and RSD Link',
	'description'  => __( 'Check <a href="https://codex.wordpress.org/XML-RPC_Support" target="_blank">this post</a> and <a target="_blank" href="https://developer.wordpress.org/reference/functions/rsd_link/">this post</a> to understand what is it. In most cases, its not needed, so if you dont need it, you can remove it.', 'soledad' ),
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_speed_remove_xml_rsd',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_rweather_icons', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_rweather_icons', array(
	'label'    => 'Disable Weather font icons',
	'description'  => __( 'If you do not use Weather widgets, you can disable weather icons loads to your site.', 'soledad' ),
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_speed_rweather_icons',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_add_more_preload', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_add_more_preload', array(
	'label'       => 'Add More Preload Key Request Resources Outside The Theme',
	'section'     => 'penci_section_speed_general',
	'settings'    => 'penci_speed_add_more_preload',
	'description' => __( "By default, we added preload for all the resources from the theme. But, in some case, you are using some plugins come with their resources created render-blocking issues. You can add preload here to remove those render-blockings. Example guide:<br> <strong>&lt;link rel='preload' href='URL_RESOURCE' as='font' crossorigin='anonymous'&gt;</strong>", "soledad" ),
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_section_speed_lazy_heading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_section_speed_lazy_heading', array(
	'label'    => esc_html__( 'Lazyload Images', 'soledad' ),
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_section_speed_lazy_heading',
	'description' => __( "This theme supports lazyload images from itself. But, if you want to use lazyload images from another plugin - let disable the lazyload images below to get it works.", "soledad" ),
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_topbar_mega_disable_lazy', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'topbar_mega_disable_lazy', array(
	'label'    => 'Disable LazyLoad Images on Category Mega Menu',
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_topbar_mega_disable_lazy',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_disable_lazyload_slider', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_lazyload_slider', array(
	'label'    => 'Disable Lazy Load Images on Sliders',
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_disable_lazyload_slider',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_disable_lazyload_layout', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_lazyload_layout', array(
	'label'    => 'Disable Lazyload Images on All Posts Layouts & Widgets',
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_disable_lazyload_layout',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_disable_lazyload_single', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_lazyload_single', array(
	'label'    => 'Disable Lazyload Images on Single Posts',
	'section'  => 'penci_section_speed_general',
	'settings' => 'penci_disable_lazyload_single',
	'type'     => 'checkbox',
) ) );


/* CSS Options */
$wp_customize->add_setting( 'penci_spcss_render', array(
	'default'           => 'inline',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_spcss_render', array(
	'label'    => 'Render Customizer CSS Method',
	'section'  => 'penci_section_speed_css',
	'settings' => 'penci_spcss_render',
	'description'      => __( 'Render Customizer CSS in a separate file can help you to improve performance dramatically.', 'soledad' ),
	'type'     => 'select',
	'choices'  => array(
		'inline'  => esc_html__( 'Inline CSS', 'soledad' ),
		'separate_file'  => esc_html__( 'Separate CSS File', 'soledad' ),
	)
) ) );

$wp_customize->add_control( new Penci_Custom_Button_Control( $wp_customize, 'penci_render_separate_css', array(
	'section' => 'penci_section_speed_css',
	'data_type' => 'render_separate_css',
	'nonce' => esc_html( wp_create_nonce( 'penci_render_separate_css_file' ) ),
	'label' => __( 'Regenerate CSS File', 'soledad' ),
	'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
	'active_callback' => 'penci_activate_separate_css_file_callback',
) ) );

$wp_customize->add_setting( 'penci_speed_css_minify', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_css_minify', array(
	'label'    => 'Minify CSS from the Theme',
	'section'  => 'penci_section_speed_css',
	'settings' => 'penci_speed_css_minify',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_remove_gutenbergcss', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_remove_gutenbergcss', array(
	'label'    => 'Remove Gutenberg Styles',
	'section'  => 'penci_section_speed_css',
	'description' => __( 'Use with caution. This will remove styles for Gutenberg editor from the <head> - only activate it if you and all your website users editors are using the Classic Editor', 'soledad' ),
	'settings' => 'penci_speed_remove_gutenbergcss',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_preload_font_icons', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_preload_font_icons', array(
	'label'    => 'Preload Font Icons Stylesheet from The Theme',
	'section'  => 'penci_section_speed_css',
	'settings' => 'penci_preload_font_icons',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_move_icons', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_move_icons', array(
	'label'    => 'Move Font Icons Stylesheet to Footer',
	'section'  => 'penci_section_speed_css',
	'description'      => __( 'If your icons can\'t be load when use preload option above, you can select to move it to footer to remove render-blocking issue. This option just applies if you don\'t enable preload for Font Icons above.', 'soledad' ),
	'settings' => 'penci_speed_move_icons',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_preload_google_fonts', array(
	'default'           => true,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_preload_google_fonts', array(
	'label'    => 'Preload Google Fonts from The Theme',
	'section'  => 'penci_section_speed_css',
	'settings' => 'penci_preload_google_fonts',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_preload_all_stylesheets', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_preload_all_stylesheets', array(
	'label'    => 'Preload all other stylesheets - except main stylesheet from the theme & Elementor & WPBakery Page Builder',
	'section'  => 'penci_section_speed_css',
	'description'  => __( 'This option will help you add preload for all other stylesheets from plugins you\'re using to help you can remove issues with render-blocking.', 'soledad' ),
	'settings' => 'penci_preload_all_stylesheets',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_preload_exclude_name', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_preload_exclude_name', array(
	'label'       => 'Exclude CSS name(s) you don\'t want to add preload',
	'section'     => 'penci_section_speed_css',
	'settings'    => 'penci_preload_exclude_name',
	'description' => __( "When you use preload all other stylesheets option above - If you don't want to add preload for some specific CSS files, you can write CSS name here, separated by commas.<br>Example: <strong>css-name-a, css-name-b</strong><br><strong>The CSS name</strong> is \$handle string use inside <a href='https://developer.wordpress.org/reference/functions/wp_enqueue_style/' target='_blank'>wp_enqueue_style</a> function", "soledad" ),
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_preload_include_name', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_preload_include_name', array(
	'label'       => 'Requirement stylesheets to add preload',
	'section'     => 'penci_section_speed_css',
	'settings'    => 'penci_preload_include_name',
	'description' => __( "You can manage to add stylesheets you want to get preload here, use CSS name(s) & separated by commas. This option can be override stylesheets we've exclude by default when you check on <strong>Preload all other stylesheets</strong><br>Here is CSS names excluded when you check on 'Preload all other stylesheets' above: <strong>penci-main-style, elementor-frontend, js_composer_front, penci-soledad-rtl-style</strong>", "soledad" ),
	'type'        => 'textarea',
) ) );

/* Javascript Options */
$wp_customize->add_setting( 'penci_speed_js_minify', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_js_minify', array(
	'label'    => 'Minify JS from the Theme',
	'section'  => 'penci_section_speed_javascript',
	'settings' => 'penci_speed_js_minify',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_move_jquery_footer', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_move_jquery_footer', array(
	'label'    => 'Move jQuery to Footer',
	'section'  => 'penci_section_speed_javascript',
	'description' => __( "Use with caution. This option can help you remove render-blocking issue with jQuery, but if you have any jQuery codes put above the footer, it can cause an error. So, let test this option before use it. After check to this option, if you get any issue with javascript, let disable it.", "soledad" ),
	'settings' => 'penci_speed_move_jquery_footer',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_remove_jquery_migrate', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_remove_jquery_migrate', array(
	'label'    => 'Remove jQuery Migrate',
	'section'  => 'penci_section_speed_javascript',
	'settings' => 'penci_speed_remove_jquery_migrate',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_lazy_adsense', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_lazy_adsense', array(
	'label'    => 'Lazy Load Google Adsense?',
	'section'  => 'penci_section_speed_javascript',
	'settings' => 'penci_speed_lazy_adsense',
	'description' => __( '<strong>Important:</strong> don\'t include any kind of <br><strong style="word-break: break-all;">&lt;script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"&gt;</strong> tag to maximize your site speed. This option will load that script dinamically. Check more how to use it <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">here</a> - on <strong>Speed Optimization</strong> section', 'soledad' ),
	'type'     => 'select',
	'choices'  => array(
		''  => esc_html__( 'Don\'t use', 'soledad' ),
		'method1'  => esc_html__( 'Load Ads JS after complete loading your main web page', 'soledad' ),
		'method2'  => esc_html__( 'Load Ads unit once user scroll your web page', 'soledad' ),
	)
) ) );

$wp_customize->add_setting( 'penci_speed_add_defer', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_add_defer', array(
	'label'    => 'Load deferred for JS files from the theme',
	'section'  => 'penci_section_speed_javascript',
	'settings' => 'penci_speed_add_defer',
	'description' => __( "This option will help you add defer='defer' attr to JS files from the theme", "soledad" ),
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_add_more_defer', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_add_more_defer', array(
	'label'       => 'Manually add JS name(s) to load defer="defer"',
	'section'     => 'penci_section_speed_javascript',
	'settings'    => 'penci_speed_add_more_defer',
	'description' => __( "You can manage to add JS you want to load defer='defer' here, use JS name(s) & separated by commas.<br>Example: <strong>js-name-a, js-name-b</strong><br><strong>The JS name</strong> is \$handle string use inside <a href='https://developer.wordpress.org/reference/functions/wp_enqueue_script/' target='_blank'>wp_enqueue_script</a> function", "soledad" ),
	'type'        => 'textarea',
) ) );

/* HTML Optimize */
$wp_customize->add_setting( 'penci_speed_html_minify', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_html_minify', array(
	'label'    => 'Minify HTML',
	'section'  => 'penci_section_speed_html',
	'description' => __( "Minify HTML won't apply for admin users logged in, so let check how it works without logged in.", "soledad" ),
	'settings' => 'penci_speed_html_minify',
	'type'     => 'checkbox',
) ) );