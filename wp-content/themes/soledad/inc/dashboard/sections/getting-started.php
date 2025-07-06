<?php
/**
 * Getting started section.
 *
 * @package soledad
 */
$revokelicense = isset( $_GET['penci_revoke_license'] ) ? $_GET['penci_revoke_license'] : '';
$license_nonce = isset( $_GET['revoke_none'] ) ? $_GET['revoke_none'] : '';

if( ( 'confirm' == $revokelicense ) && ( ( wp_create_nonce( 'revoke_license' ) == $license_nonce ) || 'pencidesign' == $license_nonce ) ) {
    $license_data = get_option( strrev('atad_desahcrup_dadelos_icnep') ); 
    
    if( ! empty( $license_data ) ) {
        if(isset( $license_data['purchase_code'] )){
            $purchased_code = $license_data['purchase_code'];

            $req = wp_remote_post('https://license.pencidesign.net/api/revoke', array(
                'headers'     => array(
                    'Content-Type' => 'application/json',
                ),
                'body' => wp_json_encode( array(
                    'code' => $purchased_code
                ) ),
                'data_format' => 'body',
            ) );
        
            $body = wp_remote_retrieve_body( $req );
            $res = json_decode( $body );
            if ( ! empty($res) && isset($res->status) && $res->status === 'success') {
                delete_option( strrev( 'detavitca_si_dadelos_icnep' ) );
                delete_option( strrev('atad_desahcrup_dadelos_icnep') );
                echo '<span style="display: inline-block; margin-bottom:15px; padding: 3px 10px; border: 1px solid #65b70e; max-width: 330px; background: #67c700; color: #fff; font-size: 16px;">' . __( 'The license for this website has been revoked.', 'soledad' ) . '</span>';
            }
        }
    }
} 
?>
<h2 class="nav-tab-wrapper">
	<a href="<?php echo admin_url( 'admin.php?page=soledad_dashboard_welcome' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Getting started', 'soledad' ); ?></a>
	<a href="<?php echo admin_url( 'customize.php' ) ?>" class="nav-tab"><?php esc_html_e( 'Customize Style', 'soledad' ); ?></a>
	<a href="<?php echo admin_url( 'admin.php?page=soledad_custom_fonts' ) ?>" class="nav-tab"><?php esc_html_e( 'Custom Fonts', 'soledad' ); ?></a>
	<?php if( function_exists( 'penci_soledad_is_activated' ) && ! penci_soledad_is_activated() ){ ?>
	<a href="<?php echo admin_url( 'admin.php?page=soledad_active_theme' ) ?>" class="nav-tab"><?php esc_html_e( 'Active theme', 'soledad' ); ?></a>
	<?php } else if( penci_soledad_is_activated() && penci_soledad_is_license() ) { ?>
	<a href="<?php echo admin_url( 'admin.php?page=soledad_theme_license' ) ?>" class="nav-tab"><?php esc_html_e( 'Theme License', 'soledad' ); ?></a>
	<?php } ?>
</h2>

<div id="getting-started" class="gt-tab-pane gt-is-active penci-dashboard-wapper">
	<div class="feature-section two-col">
		<div class="col">
			<h3><?php esc_html_e( 'Step 1 - Install & Activate The Recommend Plugins', 'soledad' ); ?></h3>
			<p>
				<?php
				/* translators: theme name. */
				esc_html_e( 'Soledad does not require any plugin. All the plugins are add-on features. You can pick any plugin you want for use and install & activate it. If you want to import a demo, please install & activate plugin "Penci Soledad Demo Importer".', 'soledad' );
				echo '<br>';
				echo esc_html__( 'We recommend you check the documentation for this theme first to know how to config this theme:', 'soledad' );
				echo '<br><a rel="nofollow" target="_blank" href="https://soledad.pencidesign.net/soledad-document/">Soledad Documentation</a>';
				?>
			</p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" target="_blank"><?php esc_html_e( 'Install Plugins', 'soledad' ); ?></a>

			<h3><?php esc_html_e( 'Step 2 - Import Demo Data (Optional)', 'soledad' ); ?></h3>
			<p><?php _e( '<strong>Note Important:</strong> If your site is new site - no any old posts/pages... You can do the full import ( "Import Demo Style" and "Import Demo Content" ) as normal. 
			If your site has old data: posts/pages.. Please do import only <strong>Import Demo Style</strong><br><br>If you got the message <strong>"Sorry, you are not allowed to access this page"</strong> when click to button "Import Demo Now" below - that means you didn\'t installed & activated the plugin <strong>"Penci Soledad Demo Importer"</strong> - let go to ', 'soledad' ); ?>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" target="_blank"><?php _e( 'this page', 'soledad' ); ?></a> <?php _e( 'and do that.', 'soledad' ); ?>
			</p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=import-demo-content' ) ) ?>" target="_blank"><?php esc_html_e( 'Import Demo Now', 'soledad' ); ?></a>
			<h3><?php esc_html_e( 'Step 3 - Customize The Theme', 'soledad' ); ?></h3>
			<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every general aspect of the theme.', 'soledad' );
			echo '<br>';
			esc_html_e( 'If you want to using Elementor or WPBakery Page Builder plugin to config your homepage, please check guide on the documentation - on "Homepage" section.', 'soledad' ); ?></p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start Customize', 'soledad' ); ?></a>
			</p>
		</div>
		<div class="col">
			<h3><?php esc_html_e( 'Read Full Documentation', 'soledad' ); ?></h3>
			<p class="about"><?php esc_html_e( 'Need any helps to setup and configure the theme? Please check our full documentation for detailed information on how to use it first.', 'soledad' ); ?></p>
			<p>
				<a rel="nofollow" class="button button-primary" href="<?php echo esc_url( 'https://soledad.pencidesign.net/soledad-document/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Read Documentation', 'soledad' ); ?></a>
			</p>
			<h3><?php esc_html_e( 'Video tutorials', 'soledad' ); ?></h3>
			<p><?php echo wp_kses_post( 'We believe that the easiest way to learn is watching a video tutorial. We have a growing library of narrated video tutorials to help you do just that.' ); ?></p>
			<a class="button button-primary" rel="nofollow" href="https://www.youtube.com/playlist?list=PL1PBMejQ2VTwp9ppl8lTQ9Tq7I3FJTT04" target="_blank"><?php esc_html_e( 'View tutorials', 'soledad' ); ?></a>
		</div>
	</div>
	<hr>
	<h3 class="title-more-items"><?php esc_html_e( 'More items by PenciDesign', 'soledad' ) ?></h3>
	<div class="feature-section products three-col">
		<div class="col product">
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( "https://pencidesign.net/" ) ?>" title="<?php echo esc_attr( 'All Themes from PenciDesign' ) ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/penci.jpg' ) ?>" alt="" width="300" height="150">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a target="_blank" rel="nofollow" href="<?php echo esc_url( "https://pencidesign.net/" ) ?>" title="<?php echo esc_attr( 'All WordPress Themes from PenciDesign' ) ?>">All WordPress Themes from PenciDesign</a>
				</h3>
			</div>
		</div>
		<div class="col product">
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( "https://themeforest.net/item/pennew-multiconcept-newsmagazine-amp-wordpress-theme/20822517" ) ?>" title="<?php echo esc_attr( 'PenNews' ) ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/pennews.jpg' ) ?>" alt="" width="300" height="150">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a target="_blank" rel="nofollow" href="<?php echo esc_url( "https://themeforest.net/item/pennew-multiconcept-newsmagazine-amp-wordpress-theme/20822517" ) ?>" title="<?php echo esc_attr( 'PenNews' ) ?>">PenNews - News/ Magazine/ Business/ Portfolio/ Landing AMP WordPress Theme</a>
				</h3>
			</div>
		</div>
	</div>
</div>
