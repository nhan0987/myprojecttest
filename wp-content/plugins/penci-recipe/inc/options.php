<?php
add_action( 'init', function () {
	require_once( dirname( __DIR__ ) . '/inc/helper.php' );
	if ( class_exists( 'SoledadFW\Customizer\CustomizerOptionAbstract' ) ) {
		require_once( dirname( __DIR__ ) . '/inc/sections/panel.php' );
		require_once( dirname( __DIR__ ) . '/inc/sections/settings.php' );
		\SoledadFW\RecipeCustomizer::getInstance();
	} else {
		require_once( dirname( __DIR__ ) . '/inc/customize.php' );
	}
} );
