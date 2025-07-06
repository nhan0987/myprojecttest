<?php
$wp_customize->add_section( 'pencidesign_new_section_topbar', array(
	'title'    => esc_html__( 'General Settings', 'soledad' ),
	'priority' => 1,
	'panel'      => 'penci_topbar_panel',
	'description'      => __( 'Please check <a target="_blank" href="https://imgresources.s3.amazonaws.com/topbar.png">this image</a> to know what is TopBar', 'soledad' ),
) );

$wp_customize->add_section( 'pencidesign_topbar_section_fontsize', array(
	'title'    => esc_html__( 'Font Size', 'soledad' ),
	'priority' => 1,
	'panel'      => 'penci_topbar_panel'
) );

$wp_customize->add_section( 'pencidesign_topbar_section_colors', array(
	'title'    => esc_html__( 'Colors', 'soledad' ),
	'priority' => 1,
	'panel'      => 'penci_topbar_panel'
) );

/* General Settings */
$wp_customize->add_setting( 'penci_top_bar_show', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_show', array(
	'label'    => 'Enable Top Bar',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_show',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_hmobile', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_top_bar_hmobile', array(
	'label'    => 'Hide Top Bar on Mobile',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_hmobile',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_full_width', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_full_width', array(
	'label'    => 'Use Full Width Container for Top Bar',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_full_width',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_1400', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_top_bar_1400', array(
	'label'    => 'Use Container 1400px for Top Bar',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_1400',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_topbar_ordersec', array(
	'default'           => 'toptext-topposts-topmenu-topsocial',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_topbar_ordersec', array(
	'label'       => 'Re-order elements on Topbar',
	'section'     => 'pencidesign_new_section_topbar',
	'settings'    => 'penci_topbar_ordersec',
	'description' => '',
	'type'        => 'select',
	'choices'     => array(
		'toptext-topposts-topmenu-topsocial' => 'Custom Text - Top Posts - Topbar Menu - Social Icons',
		'toptext-topposts-topsocial-topmenu' => 'Custom Text - Top Posts - Social Icons - Topbar Menu',
		'toptext-topsocial-topposts-topmenu' => 'Custom Text - Social Icons - Top Posts - Topbar Menu',
		'toptext-topsocial-topmenu-topposts' => 'Custom Text - Social Icons - Topbar Menu - Top Posts',
		'toptext-topmenu-topsocial-topposts' => 'Custom Text - Topbar Menu - Social Icons - Top Posts',
		'toptext-topmenu-topposts-topsocial' => 'Custom Text - Topbar Menu - Top Posts - Social Icons',
		'topposts-toptext-topmenu-topsocial' => 'Top Posts - Custom Text - Topbar Menu - Social Icons',
		'topposts-toptext-topsocial-topmenu' => 'Top Posts - Custom Text - Social Icons - Topbar Menu',
		'topposts-topsocial-toptext-topmenu' => 'Top Posts - Social Icons - Custom Text - Topbar Menu',
		'topposts-topsocial-topmenu-toptext' => 'Top Posts - Social Icons - Topbar Menu - Custom Text',
		'topposts-topmenu-topsocial-toptext' => 'Top Posts - Topbar Menu - Social Icons - Custom Text',
		'topposts-topmenu-toptext-topsocial' => 'Top Posts - Topbar Menu - Custom Text - Social Icons',
		'topmenu-toptext-topsocial-topposts' => 'Topbar Menu - Custom Text - Social Icons - Top Posts',
		'topmenu-toptext-topposts-topsocial' => 'Topbar Menu - Custom Text - Top Posts - Social Icons',
		'topmenu-topsocial-toptext-topposts' => 'Topbar Menu - Social Icons - Custom Text - Top Posts',
		'topmenu-topsocial-topposts-toptext' => 'Topbar Menu - Social Icons - Top Posts - Custom Text',
		'topmenu-topposts-toptext-topsocial' => 'Topbar Menu - Top Posts - Custom Text - Social Icons',
		'topmenu-topposts-topsocial-toptext' => 'Topbar Menu - Top Posts - Social Icons - Custom Text',
		'topsocial-toptext-topposts-topmenu' => 'Social Icons - Custom Text - Top Posts - Topbar Menu',
		'topsocial-toptext-topmenu-topposts' => 'Social Icons - Custom Text - Topbar Menu - Top Posts',
		'topsocial-topposts-topmenu-toptext' => 'Social Icons - Top Posts - Topbar Menu - Custom Text',
		'topsocial-topposts-toptext-topmenu' => 'Social Icons - Top Posts - Custom Text - Topbar Menu',
		'topsocial-topmenu-toptext-topposts' => 'Social Icons - Topbar Menu - Custom Text - Top Posts',
		'topsocial-topmenu-topposts-toptext' => 'Social Icons - Topbar Menu - Top Posts - Custom Text',
	)
) ) );

$wp_customize->add_setting( 'penci_tbctext_heading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_tbctext_heading', array(
	'label'    => esc_html__( 'Topbar Current Date/Custom Text', 'soledad' ),
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbctext_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_tbtext_enable', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tbtext_enable', array(
	'label'    => 'Show Topbar Custom Text',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbtext_enable',
	'type'     => 'checkbox',
) ) );
$wp_customize->add_setting( 'penci_tbtext_mobile', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tbtext_mobile', array(
	'label'    => 'Hide Topbar Custom Text on Mobile',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbtext_mobile',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_tb_date_text', array(
	'default'           => "[penci_date format='l, F j Y'] - Welcome",
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tb_date_text', array(
	'label'       => 'Custom Text',
	'section'     => 'pencidesign_new_section_topbar',
	'settings'    => 'penci_tb_date_text',
	'description' => "If you want to show today's date - you can use shortcode <strong>[penci_date format='l, F j Y']</strong> - inside the custom text. Change format 'l, F j Y' to the date format you want. You can check more about date/time format <a href='https://wordpress.org/support/article/formatting-date-and-time/' target='_blank'>here</a>",
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_tbtoppost_heading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_tbtoppost_heading', array(
	'label'    => esc_html__( 'Top Posts/News Ticker', 'soledad' ),
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbtoppost_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_toppost_enable', array(
	'default'           => true,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_toppost_enable', array(
	'label'    => 'Show "Top Posts" Section',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_toppost_enable',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_toppost_mobile', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_toppost_mobile', array(
	'label'    => 'Show "Top Posts" on Mobile',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_toppost_mobile',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_toppost_width', array(
	'default' => '420',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'penci_toppost_width_mobile', array(
	'default' => '',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'penci_toppost_width', array(
	'description' => __( 'Custom Max-Width for "Top Posts"', 'soledad' ),
	'section' => 'pencidesign_new_section_topbar',
	'settings' => array(
		'desktop' => 'penci_toppost_width',
		'mobile' => 'penci_toppost_width_mobile',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 100,
			'max' => 800,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
		'mobile' => array(
			'min' => 50,
			'max' => 480,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_custom_text', array(
	'default'           => esc_html__( 'Top Posts', 'soledad' ),
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_custom_text', array(
	'label'       => 'Custom "Top Posts" Text',
	'section'     => 'pencidesign_new_section_topbar',
	'settings'    => 'penci_top_bar_custom_text',
	'description' => 'If you want hide Top Posts text, let empty this',
	'type'        => 'text',
) ) );

$wp_customize->add_setting( 'penci_top_bar_custom_style', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_top_bar_custom_style', array(
	'label'    => 'Style for "Top Posts" Text',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_custom_style',
	'type'     => 'select',
	'choices'  => array(
		''      => 'Default Style',
		'nticker-style-2'   => 'Style 2',
		'nticker-style-3'  => 'Style 3',
		'nticker-style-4' => 'Style 4'
	)
) ) );

$wp_customize->add_setting( 'penci_top_bar_animation', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_top_bar_animation', array(
	'label'    => '"Top Posts" Transition Animation',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_animation',
	'type'     => 'select',
	'choices'  => array(
		''  => 'Slide In Up',
		'slideInRight'  => 'Fade In Right',
		'fadeIn'  => 'Fade In',
	)
) ) );

$wp_customize->add_setting( 'penci_top_bar_top_posts_lowcase', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_top_posts_lowcase', array(
	'label'    => 'Disable Uppercase for "Top Posts" text',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_top_posts_lowcase',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_display_by', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_display_by', array(
	'label'    => 'Display Top Posts By',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_display_by',
	'type'     => 'select',
	'choices'  => array(
		''      => 'Recent Posts',
		'all'   => 'Popular Posts All Time',
		'week'  => 'Popular Posts Once Weekly',
		'month' => 'Popular Posts Once Month'
	)
) ) );

$wp_customize->add_setting( 'penci_top_bar_filter_by', array(
	'default'           => 'category',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_filter_by', array(
	'label'    => 'Filter Topbar By',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_filter_by',
	'type'     => 'radio',
	'choices'  => array(
		'category' => 'Category',
		'tags'     => 'Tags'
	)
) ) );

$wp_customize->add_setting( 'penci_top_bar_category', array(
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Category_Control( $wp_customize, 'top_bar_category', array(
	'label'       => 'Select "Top Posts" Category',
	'section'     => 'pencidesign_new_section_topbar',
	'settings'    => 'penci_top_bar_category',
	'description' => 'This option just apply when you select "Filter Topbar by" Category above',
) ) );

$wp_customize->add_setting( 'penci_top_bar_tags', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_textarea_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_tags', array(
	'label'       => 'Fill List Tags for Filter by Tags on "Top Post"',
	'section'     => 'pencidesign_new_section_topbar',
	'settings'    => 'penci_top_bar_tags',
	'description' => 'This option just apply when you select "Filter Topbar by" Tags above. And please fill list featured tags slug here, check <a rel="nofollow" href="https://soledad.pencidesign.net/soledad-document/images/tags.png" target="_blank">this image</a> to know what is tags slug. Example for multiple tags slug, fill:  tag-1, tag-2, tag-3',
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_top_bar_title_length', array(
	'default' => '8',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_title_length', array(
	'description' => __( 'Words Length for Post Titles on Top Posts', 'soledad' ),
	'section' => 'pencidesign_new_section_topbar',
	'settings' => array(
		'desktop' => 'penci_top_bar_title_length',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => '',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_off_uppercase', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_off_uppercase', array(
	'label'    => 'Turn Off Uppercase Post Titles',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_off_uppercase',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_posts_autoplay', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_posts_autoplay', array(
	'label'    => 'Disable Auto Play',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_posts_autoplay',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_auto_time', array(
	'default' => '3000',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_auto_time', array(
	'description' => __( 'Autoplay Timeout', 'soledad' ),
	'sub_description' => __( '1000 = 1 second', 'soledad' ),
	'section' => 'pencidesign_new_section_topbar',
	'settings' => array(
		'desktop' => 'penci_top_bar_auto_time',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 100,
			'max' => 8000,
			'step' => 100,
			'edit' => true,
			'unit' => '',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_auto_speed', array(
	'default' => '300',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_auto_speed', array(
	'description' => __( 'Autoplay Speed', 'soledad' ),
	'sub_description' => __( '1000 = 1 second', 'soledad' ),
	'section' => 'pencidesign_new_section_topbar',
	'settings' => array(
		'desktop' => 'penci_top_bar_auto_speed',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 10,
			'max' => 5000,
			'step' => 10,
			'edit' => true,
			'unit' => '',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_posts_per_page', array(
	'default' => '10',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_posts_per_page', array(
	'description' => __( 'Amount of Posts Display on Top Posts', 'soledad' ),
	'section' => 'pencidesign_new_section_topbar',
	'settings' => array(
		'desktop' => 'penci_top_bar_posts_per_page',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => '',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_tbmenu_heading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_tbmenu_heading', array(
	'label'    => esc_html__( 'Topbar Menu', 'soledad' ),
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbmenu_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_top_bar_enable_menu', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_enable_menu', array(
	'label'       => 'Show Topbar Menu',
	'section'     => 'pencidesign_new_section_topbar',
	'description' => 'If you enable topbar menu, you need go to Dashboard > Appearance > Menus > create/select a menu for your topbar > scroll down and check to "Topbar Menu" at the bottom',
	'settings'    => 'penci_top_bar_enable_menu',
	'type'        => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_tbmenu_mobile', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tbmenu_mobile', array(
	'label'    => 'Hide Topbar Menu on Mobile',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbmenu_mobile',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_off_uppercase_menu', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_off_uppercase_menu', array(
	'label'    => 'Turn Off Uppercase on Topbar Menu',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_off_uppercase_menu',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_tbsocial_heading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_tbsocial_heading', array(
	'label'    => esc_html__( 'Social Media / Login & Register Popup', 'soledad' ),
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbsocial_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_top_bar_hide_social', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_hide_social', array(
	'label'    => 'Hide Social Icons on Top Bar',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_hide_social',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_top_bar_brand_social', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_bar_brand_social', array(
	'label'    => 'Enable Use Brand Colors for Social Icons on Top Bar',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_top_bar_brand_social',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_tblogin', array(
	'default'           => '',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblogin', array(
	'label'    => 'Display Login/Register?',
	'section'  => 'pencidesign_new_section_topbar',
	'description'  => __( 'Note that: By default, the register form is disabled, if you want to enable it, please go to Dashboard > Settings > General > on "Membership" check to "Anyone can register" - check <a href="https://imgresources.s3.amazonaws.com/register.png" target="_blank">this image</a> for more.<br>And if you want to add captcha for Login/Register form, you can use <a href="https://wordpress.org/plugins/login-security-recaptcha/" target="_blank">this plugin</a> - this theme supports Google reCaptcha v2 from this plugin.', 'soledad' ),
	'settings' => 'penci_tblogin',
	'type'     => 'select',
	'choices'  => array(
		''          => 'None',
		'left'      => 'On the left social icons',
		'right'  	=> 'On the right social icons',
	)
) ) );

$wp_customize->add_setting( 'penci_tblogin_text', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblogin_text', array(
	'label'    => 'Add Login Text',
	'section'  => 'pencidesign_new_section_topbar',
	'description'  => __( 'Text beside the icon, leave it empty to disable', 'soledad' ),
	'settings' => 'penci_tblogin_text',
	'type'     => 'text',
) ) );

$wp_customize->add_setting( 'penci_tbsocial_mobile', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tbsocial_mobile', array(
	'label'    => 'Hide Social Icons & Login on Mobile',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tbsocial_mobile',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_tblogin_titleupper', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblogin_titleupper', array(
	'label'    => 'Turn off uppercase for titles on login/register popup',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tblogin_titleupper',
	'type'     => 'checkbox',
) ) );

$wp_customize->add_setting( 'penci_tblogin_submitupper', array(
	'default'           => false,
	'sanitize_callback' => 'penci_sanitize_checkbox_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblogin_submitupper', array(
	'label'    => 'Turn off uppercase for submit buttons on login/register popup',
	'section'  => 'pencidesign_new_section_topbar',
	'settings' => 'penci_tblogin_submitupper',
	'type'     => 'checkbox',
) ) );

/* Font Size */
$wp_customize->add_setting( 'penci_topbar_ctsize', array(
	'default' => '13',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'penci_topbar_ctsize', array(
	'description' => __( 'Font Size for General Text on Topbar', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_topbar_ctsize',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_top_post_size', array(
	'default' => '12',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_top_post_size', array(
	'description' => __( 'Font Size for "Top Posts" text', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_top_bar_top_post_size',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_top_post_size_title', array(
	'default' => '12',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_top_post_size_title', array(
	'description' => __( 'Font Size for Post Titles on "Top Posts"', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_top_bar_top_post_size_title',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_menu_level_one', array(
	'default' => '11',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_menu_level_one', array(
	'description' => __( 'Font Size for Topbar Menu Level 1', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_top_bar_menu_level_one',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_sub_menu_size', array(
	'default' => '11',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_sub_menu_size', array(
	'description' => __( 'Font Size for Sub-menu on Topbar Menu', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_top_bar_sub_menu_size',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 50,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_top_bar_social_size', array(
	'default' => '13',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'top_bar_social_size', array(
	'description' => __( 'Font Size for Social Icons on Topbar', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_top_bar_social_size',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_lgpop_form_heading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_lgpop_form_heading', array(
	'label'    => esc_html__( 'Login/Register Popup Form', 'soledad' ),
	'section'  => 'pencidesign_topbar_section_fontsize',
	'settings' => 'penci_lgpop_form_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_tbpop_title_size', array(
	'default' => '24',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'penci_tbpop_title_size_mobile', array(
	'default' => '22',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'penci_tbpop_title_size', array(
	'description' => __( 'Font Size for Titles', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_tbpop_title_size',
		'mobile' => 'penci_tbpop_title_size_mobile',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
		'mobile' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		)
	)
) ) );

$wp_customize->add_setting( 'penci_tbpop_inputfs', array(
	'default' => '14',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'penci_tbpop_inputfs', array(
	'description' => __( 'Font Size for Input Fields', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_tbpop_inputfs',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_tbpop_submitfs', array(
	'default' => '14',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'penci_tbpop_submitfs', array(
	'description' => __( 'Font Size for Submit Buttons', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_tbpop_submitfs',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

$wp_customize->add_setting( 'penci_tbpop_textfs', array(
	'default' => '',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Penci_Range_Slider_Control( $wp_customize, 'penci_tbpop_textfs', array(
	'description' => __( 'Font Size for Text/Links', 'soledad' ),
	'section' => 'pencidesign_topbar_section_fontsize',
	'settings' => array(
		'desktop' => 'penci_tbpop_textfs',
	),
	'choices' => array(
		'desktop' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
			'edit' => true,
			'unit' => 'px',
		),
	),
) ) );

/* Colors */
$wp_customize->add_setting( 'penci_top_bar_bg', array(
	'default'           => '#313131',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_bg', array(
	'label'    => 'Top Bar Background Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_bg',
) ) );

$wp_customize->add_setting( 'penci_topbar_ct_color', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_topbar_ct_color', array(
	'label'    => '"Current Date/Custom Text" Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_topbar_ct_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_top_posts_bg', array(
	'default'           => '#6eb48c',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_top_posts_bg', array(
	'label'    => '"Top Posts" Background Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_top_posts_bg',
) ) );

$wp_customize->add_setting( 'penci_top_bar_top_posts_color', array(
	'default'           => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_top_posts_color', array(
	'label'    => '"Top Posts" Text Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_top_posts_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_button_color', array(
	'default'           => '#999999',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_button_color', array(
	'label'    => 'Next/Prev Posts Top Bar Button Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_button_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_button_hover_color', array(
	'default'           => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_button_hover_color', array(
	'label'    => 'Next/Prev Posts Top Bar Button Hover Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_button_hover_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_title_color', array(
	'default'           => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_title_color', array(
	'label'    => 'Top Bar Posts Title Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_title_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_title_hover_color', array(
	'default'           => '#6eb48c',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_title_hover_color', array(
	'label'    => 'Top Bar Post Titles Hover Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_title_hover_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_menu_color', array(
	'default'           => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_menu_color', array(
	'label'    => 'Top Bar Menu Text Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_menu_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_menu_hover_color', array(
	'default'           => '#6eb48c',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_menu_hover_color', array(
	'label'    => 'Top Bar Menu Text Hover Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_menu_hover_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_menu_border', array(
	'default'           => '#414141',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_menu_border', array(
	'label'    => 'Top Bar Menu Border Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_menu_border',
) ) );

$wp_customize->add_setting( 'penci_top_bar_menu_dropdown_bg', array(
	'default'           => '#313131',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_menu_dropdown_bg', array(
	'label'    => 'Top Bar Menu Dropdown Background Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_menu_dropdown_bg',
) ) );

$wp_customize->add_setting( 'penci_top_bar_social_color', array(
	'default'           => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_social_color', array(
	'label'    => 'Top Bar Social Icons Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_social_color',
) ) );

$wp_customize->add_setting( 'penci_top_bar_social_hover_color', array(
	'default'           => '#6eb48c',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_social_hover_color', array(
	'label'    => 'Top Bar Social Icons Hover Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_top_bar_social_hover_color',
) ) );

$wp_customize->add_setting( 'penci_lgpop_form_cheading', array(
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_lgpop_form_cheading', array(
	'label'    => esc_html__( 'Login/Register Popup', 'soledad' ),
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_lgpop_form_cheading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_tblgc_icon_text', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_icon_text', array(
	'label'    => 'Top Bar Login Icon & Text Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_icon_text',
) ) );

$wp_customize->add_setting( 'penci_tblgc_icon_htext', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_icon_htext', array(
	'label'    => 'Top Bar Login Icon & Text Hover Color',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_icon_htext',
) ) );

$wp_customize->add_setting( 'penci_tblgpop_cloading', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgpop_cloading', array(
	'label'    => 'Color for Popup Loading Icon',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgpop_cloading',
) ) );

$wp_customize->add_setting( 'penci_tblgpop_bg', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgpop_bg', array(
	'label'    => 'Background Color for Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgpop_bg',
) ) );

$wp_customize->add_setting( 'penci_tblgpop_bgimgage', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_tblgpop_bgimgage', array(
	'label'    => 'Background Image for Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgpop_bgimgage',
) ) );

$wp_customize->add_setting( 'penci_tblgpop_bg_repeat', array(
	'default'           => 'no-repeat',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblgpop_bg_repeat', array(
	'label'    => 'Background Image Repeat for Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgpop_bg_repeat',
	'type'     => 'select',
	'choices'  => array(
		'no-repeat' => 'No Repeat',
		'repeat'    => 'Repeat'
	)
) ) );

$wp_customize->add_setting( 'penci_tblgpop_bg_attachment', array(
	'default'           => 'fixed',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblgpop_bg_attachment', array(
	'label'    => 'Background Image Attachment for Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgpop_bg_attachment',
	'type'     => 'select',
	'choices'  => array(
		'fixed'  => 'Fixed',
		'scroll' => 'Scroll',
		'local'  => 'Local'
	)
) ) );

$wp_customize->add_setting( 'penci_tblgpop_bg_size', array(
	'default'           => 'auto',
	'sanitize_callback' => 'penci_sanitize_choices_field'
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_tblgpop_bg_size', array(
	'label'    => 'Background Image Size for Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgpop_bg_size',
	'type'     => 'select',
	'choices'  => array(
		'auto'  => 'Auto',
		'cover' => 'Cover'
	)
) ) );

$wp_customize->add_setting( 'penci_tblgc_close', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_close', array(
	'label'    => 'Color for Close Button on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_close',
) ) );

$wp_customize->add_setting( 'penci_tblgc_titles', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_titles', array(
	'label'    => 'Color for Titles on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_titles',
) ) );

$wp_customize->add_setting( 'penci_tblgc_inputs', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_inputs', array(
	'label'    => 'Text Color for Input Fields on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_inputs',
) ) );

$wp_customize->add_setting( 'penci_tblgc_inputs_borders', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_inputs_borders', array(
	'label'    => 'Borders Color for Input Fields on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_inputs_borders',
) ) );

$wp_customize->add_setting( 'penci_tblgc_submit', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_submit', array(
	'label'    => 'Color for Submit Buttons on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_submit',
) ) );

$wp_customize->add_setting( 'penci_tblgc_submit_bg', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_submit_bg', array(
	'label'    => 'Background Color for Submit Buttons on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_submit_bg',
) ) );

$wp_customize->add_setting( 'penci_tblgc_hsubmit', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_hsubmit', array(
	'label'    => 'Hover Color for Submit Buttons on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_hsubmit',
) ) );

$wp_customize->add_setting( 'penci_tblgc_submit_hbg', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_submit_hbg', array(
	'label'    => 'Hover Background Color for Submit Buttons on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_submit_hbg',
) ) );

$wp_customize->add_setting( 'penci_tblgc_text', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_text', array(
	'label'    => 'Text Color on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_text',
) ) );

$wp_customize->add_setting( 'penci_tblgc_links', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_tblgc_links', array(
	'label'    => 'Links Color on Popup Form',
	'section'  => 'pencidesign_topbar_section_colors',
	'settings' => 'penci_tblgc_links',
) ) );