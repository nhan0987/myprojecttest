<?php
/* Add Sections */
$wp_customize->add_section( 'penci_section_speed_optimizer', array(
	'title'    => esc_html__( 'PageSpeed Optimizer', 'soledad' ),
	'priority' => 1,
	'panel'      => 'penci_speed_section_panel',
	'description'      => __( 'To use options here in the right way - please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">this guide</a> first - on <strong>Speed Optimization</strong> section', 'soledad' ),
) );

/* Speed Optimizer */
$wp_customize->add_setting( 'penci_enable_spoptimizer', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_enable_spoptimizer', array(
	'label'    => 'Enable Page Speed Optimizer',
	'section'  => 'penci_section_speed_optimizer',
	'settings' => 'penci_enable_spoptimizer',
	'description'      => __( '<strong style="color: #ff0000;">IMPORTANT: This option only works for websites that has activated the theme and doesn\'t work on the localhost server.</strong> Please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">this video tutorial</a> to know how to do this in the right way. All options below just work when you activate this option.', 'soledad' ),
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_showbg', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_showbg', array(
	'label'    => 'Show Background Image In Preview on Google Page Speed',
	'section'  => 'penci_section_speed_optimizer',
	'description'      => __( 'For more information about this option - please check <a target="_blank" href="https://soledad.pencidesign.net/soledad-document/#speed-optimization">here</a>', 'soledad' ),
	'settings' => 'penci_speed_showbg',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_disablelazyimg', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_disablelazyimg', array(
	'label'    => 'Disable Render "base64" for Images from PageSpeed Optimizer',
	'section'  => 'penci_section_speed_optimizer',
	'settings' => 'penci_speed_disablelazyimg',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_disablelazyvideo', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_disablelazyvideo', array(
	'label'    => 'Disable lazyload iframe from PageSpeed Optimizer',
	'section'  => 'penci_section_speed_optimizer',
	'settings' => 'penci_speed_disablelazyvideo',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_disable_delaygajs', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_disable_delaygajs', array(
	'label'    => 'Disable Delay Loading for Google Analytics Javascript',
	'description' => __( 'By default, we\'ve delayed the loading for Google Analytics Javascript - it can help you increase the Google Page Speed scores because Google Analytics Javascript will delay until the website ready for interactive by users. But, if someone accesses your site and leaves fast after that, Google Analytics can\'t catch data of this user because at this time, Google Analytics Javascript doesn\'t load yet. And maybe you will see the data from Google Analytics drop with before. If you don\'t want to delay Google Analytics Javascript, you can use this option.', 'soledad' ),
	'section'  => 'penci_section_speed_optimizer',
	'settings' => 'penci_speed_disable_delaygajs',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_speed_excludelazyload', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_excludelazyload', array(
	'label'       => 'Exclude CSS Classes of Images/Iframes from Lazy Load of Penci Speed Optimizer',
	'section'     => 'penci_section_speed_optimizer',
	'settings'    => 'penci_speed_excludelazyload',
	'description' => __( 'In order to exclude images/iframes from lazy loading, please add their CSS classes( without the dots ) to the exclusion list - separated by commas.<br>E.g: <strong>class-a, class-b, class-c</strong>', 'soledad' ),
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_speed_criticalcss', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_criticalcss', array(
	'label'       => 'Additional CSS for Critical CSS',
	'section'     => 'penci_section_speed_optimizer',
	'settings'    => 'penci_speed_criticalcss',
	'description' => __( 'Just apply when "Enable Page Speed Optimizer" is enabled. It helps you can add custom CSS to Critical CSS', 'soledad' ),
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_speed_cdnbase', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_speed_cdnbase', array(
	'label'    => 'Custom CDN base to load Merge files',
	'section'  => 'penci_section_speed_optimizer',
	'description' => __( 'If you\'re using a CDN service, you can use this option to loads merge files via CDN URL. Fill your CDN url here. E.g: https://cdn.domain.com', 'soledad' ),
	'settings' => 'penci_speed_cdnbase',
	'type'     => 'text',
) ) );