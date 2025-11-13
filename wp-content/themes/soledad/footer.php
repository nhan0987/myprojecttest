<?php
/**
 * This is footer template of Soledad theme
 *
 * @package Wordpress
 * @since   1.0
 */

$penci_hide_footer = '';
$hide_fwidget = get_theme_mod( 'penci_footer_widget_area' );
$footer_layout = 'style-4';
// $footer_layout = get_theme_mod( 'penci_footer_widget_area_layout' ) ? get_theme_mod( 'penci_footer_widget_area_layout' ) : 'style-1';
$penci_footer_width = get_theme_mod( 'penci_footer_width' );



if ( is_page() ) {
	$penci_hide_footer = get_post_meta( get_the_ID(), 'penci_page_hide_footer', true );

	$pmeta_page_footer = get_post_meta( get_the_ID(), 'penci_pmeta_page_footer', true );
	if ( isset( $pmeta_page_footer['penci_footer_style'] ) && $pmeta_page_footer['penci_footer_style'] ) {
		$footer_layout =  $pmeta_page_footer['penci_footer_style'];
	}

	if ( isset( $pmeta_page_footer['penci_hide_fwidget'] ) ) {
		if ( 'yes' == $pmeta_page_footer['penci_hide_fwidget'] ) {
			$hide_fwidget = true;
		} elseif ( 'no' == $pmeta_page_footer['penci_hide_fwidget'] ) {
			$hide_fwidget = false;
		}
	}

	if ( isset( $pmeta_page_footer['penci_footer_width'] ) && $pmeta_page_footer['penci_footer_width'] ) {
		$penci_footer_width =  $pmeta_page_footer['penci_footer_width'];
	}
} else if( is_single() ){
	$penci_hide_footer = penci_is_hide_footer();
}

$footer_logo_url = esc_url( home_url('/') );
if( get_theme_mod('penci_custom_url_logo_footer') ) {
	$footer_logo_url = get_theme_mod('penci_custom_url_logo_footer');
}

$footer_layout = 'style-4';
?>



<?php
if( ( function_exists('is_shop') && is_shop() ) || ( function_exists('is_product_category') && is_product_category() ) || ( function_exists('is_product_tag') && is_product_tag() ) || ( function_exists('is_product') && is_product() ) ) {
	echo '</div>';
}
?>

<?php if( ! $penci_hide_footer ): ?>
<div class="clear-footer">
	<div class="relative">
				<div class="absolute left-1/2 -translate-x-1/2 w-[90%] max-w-6xl px-3 lg:px-5 py-3  shadow-lg text-white text-sm lg:text-lg flex flex-col lg:flex-row justify-between gap-2 md:gap-0 bg-[radial-gradient(60.29%_710.16%_at_53.55%_99.55%,#FFD45C_0%,#9E5625_100%)] z-[100] rounded-[1rem] lg:rounded-[13.6rem]">
				
				<div class="flex items-center gap-2"><i class="location-icons w-[24px]! h-[24px]! lg:w-[40px]! lg:h-[40px]!"></i>123 Beverly Hill, Long Biên, Hà Nội</div>
				<div class="flex items-center gap-2"><i class="email-icons w-[24px]! h-[24px]! lg:w-[40px]! lg:h-[40px]!"></i>Email: contact@stnd.vn</div>
				<div class="flex items-center gap-2"><i class="telephone-icons w-[24px]! h-[24px]! lg:w-[40px]! lg:h-[40px]!"></i>Hotline: 0989 666 888</div>
				</div>
			</div>
</div>

<?php if ( get_theme_mod( 'penci_footer_adsense' ) ): echo '<div class="container penci-google-adsense penci-google-adsense-footer">'. do_shortcode( get_theme_mod( 'penci_footer_adsense' ) ) .'</div>'; endif; ?>

<?php 
$footerreorder = get_theme_mod('penci_footer_order_sections') ? get_theme_mod('penci_footer_order_sections') : 'widgets-instagram-signupform-footersocial';
$social_end_array = array( 'widgets-instagram-signupform-footersocial', 'widgets-signupform-instagram-footersocial', 'instagram-widgets-signupform-footersocial', 'instagram-signupform-widgets-footersocial', 'signupform-widgets-instagram-footersocial', 'signupform-instagram-widgets-footersocial' );
$footerreorder_array = explode( '-', $footerreorder );
if( ! empty( $footerreorder_array ) ) {
	foreach( $footerreorder_array as $ftsec ) {
		if ( $ftsec == 'widgets' && ! $hide_fwidget ) :
		?>
		<?php if( ( in_array( $footer_layout, array( 'style-2', 'style-3', 'style-8', 'style-9', 'style-10' ) ) && ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ) ) || ( in_array( $footer_layout, array( 'style-1', 'style-5', 'style-6', 'style-7' ) ) && ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) ) || ( $footer_layout == 'style-4' && ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) ) ): ?>

			

			<div id="widget-area" class="rounded-t-[2rem]" <?php if( get_theme_mod( 'penci_footer_widget_bg_image' ) ): echo ' class="penci-lazy" data-src="'. get_theme_mod( 'penci_footer_widget_bg_image' ) .'"'; endif; ?>>

				

				<div class="max-w-7xl mx-auto<?php echo esc_attr( $penci_footer_width ? ' container-' . $penci_footer_width : '' ) ?> grid grid-cols-2 lg:grid-cols-4 pt-4 pb-4">
					<?php if( in_array( $footer_layout, array( 'style-1', 'style-5', 'style-6', 'style-7' ) ) ){ ?>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?>">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?>">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?> last">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php } elseif( in_array( $footer_layout, array( 'style-2', 'style-3', 'style-8', 'style-9', 'style-10' ) ) ) { ?>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?>">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?> last">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					<?php } elseif( $footer_layout == 'style-4' ) { ?>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?> col-span-2 lg:col-span-1 flex flex-col items-center ">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?> flex flex-col items-center ">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?> flex flex-col items-center ">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
						<div class="footer-widget-wrapper footer-widget-<?php echo $footer_layout; ?> last col-span-2 lg:col-span-1 flex flex-col items-center">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php
		endif;
		if ( $ftsec == 'instagram' && is_active_sidebar( 'footer-instagram' ) ) :
		?>
			<div class="footer-instagram footer-instagram-html<?php if( get_theme_mod('penci_footer_insta_title_overlay') ): echo ' penci-insta-title-overlay'; endif; ?>">
				<?php dynamic_sidebar( 'footer-instagram' ); ?>
			</div>
		<?php
		endif;
		if ( $ftsec == 'signupform' && is_active_sidebar( 'footer-signup-form' ) ) :
		?>
			<div class="footer-subscribe">
				<?php dynamic_sidebar( 'footer-signup-form' ); ?>
			</div>
		<?php
		endif;
		if ( $ftsec == 'footersocial' && ! get_theme_mod( 'penci_footer_social' ) && ! in_array( $footerreorder, $social_end_array ) ) :
		?>
			<div class="penci-footer-social-media penci-footer-social-moved<?php if( get_theme_mod( 'penci_footer_social_around' ) ): echo ' footer-social-remove-circle'; endif; if( get_theme_mod( 'penci_footer_social_drop_line' ) ): echo ' footer-social-drop-line'; endif; if( get_theme_mod( 'penci_footer_disable_radius_social' ) ): echo ' footer-social-remove-radius'; endif; if( get_theme_mod( 'penci_footer_social_remove_text' ) ): echo ' footer-social-remove-text'; endif; ?>">
				<div class="container<?php echo esc_attr( $penci_footer_width ? ' container-' . $penci_footer_width : '' ); ?>">
					<div class="footer-socials-section<?php if( get_theme_mod( 'penci_footer_brand_social' ) && ! get_theme_mod( 'penci_footer_social_around' ) ){ echo ' penci-social-colored'; } elseif( get_theme_mod( 'penci_footer_brand_social' ) && get_theme_mod( 'penci_footer_social_around' ) ){ echo ' penci-social-textcolored'; } ?>">
						<ul class="footer-socials">
							<?php 
							$social_data = penci_social_media_array();
							foreach( $social_data as $name => $sdata ){
								if( $sdata[0] ){
									$icon_html = penci_icon_by_ver( $sdata[1] );
									if( in_array( $name, penci_social_penci_icons_array() ) ){
										$icon_html = penci_svg_social( $sdata[1] );
									}
									?>
									<li><a href="<?php echo esc_url( do_shortcode( $sdata[0] ) ); ?>" aria-label="<?php echo ucwords( $name ); ?>" <?php echo penci_reltag_social_icons(); ?> target="_blank"><?php echo $icon_html; ?><span><?php echo ucwords( $name ); ?></span></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		<?php
		endif;
	}
}
?>
<footer id="footer-section" class="penci-footer-social-media penci-lazy<?php if( get_theme_mod( 'penci_footer_social_around' ) ): echo ' footer-social-remove-circle'; endif; if( get_theme_mod( 'penci_footer_social_drop_line' ) ): echo ' footer-social-drop-line'; endif; if( get_theme_mod( 'penci_footer_disable_radius_social' ) ): echo ' footer-social-remove-radius'; endif; if( get_theme_mod( 'penci_footer_social_remove_text' ) ): echo ' footer-social-remove-text'; endif; ?>"<?php if( get_theme_mod( 'penci_footer_copyright_bg_image' ) ): echo ' data-src="'. get_theme_mod( 'penci_footer_copyright_bg_image' ) .'"'; endif; ?> <?php if( ! get_theme_mod('penci_schema_wpfoot') ): ?>itemscope itemtype="https://schema.org/WPFooter"<?php endif; ?>>
	<div class="container<?php echo esc_attr( $penci_footer_width ? ' container-' . $penci_footer_width : '' ); ?>">
		<?php if ( ! get_theme_mod( 'penci_footer_social' ) && in_array( $footerreorder, $social_end_array ) ) : ?>
			<div class="footer-socials-section<?php if( get_theme_mod( 'penci_footer_brand_social' ) && ! get_theme_mod( 'penci_footer_social_around' ) ){ echo ' penci-social-colored'; } elseif( get_theme_mod( 'penci_footer_brand_social' ) && get_theme_mod( 'penci_footer_social_around' ) ){ echo ' penci-social-textcolored'; } ?>">
				<ul class="footer-socials">
					<?php 
					$social_data = penci_social_media_array();
					foreach( $social_data as $name => $sdata ){
						if( $sdata[0] ){
							$icon_html = penci_icon_by_ver( $sdata[1] );
							if( in_array( $name, penci_social_penci_icons_array() ) ){
								$icon_html = penci_svg_social( $sdata[1] );
							}
							?>
							<li><a href="<?php echo esc_url( do_shortcode( $sdata[0] ) ); ?>" aria-label="<?php echo ucwords( $name ); ?>" <?php echo penci_reltag_social_icons(); ?> target="_blank"><?php echo $icon_html; ?><span><?php echo ucwords( $name ); ?></span></a></li>
							<?php
						}
					}
					?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'penci_related_post_popup' ) ) : ?><div class="penci-flag-rlt-popup"></div><?php endif; ?>
		<?php if ( ( get_theme_mod( 'penci_footer_logo' ) && ! get_theme_mod( 'penci_hide_footer_logo' ) ) || get_theme_mod( 'penci_footer_copyright' ) || ! get_theme_mod( 'penci_go_to_top' ) || get_theme_mod( 'penci_footer_menu' ) ) : ?>
			<div class="footer-logo-copyright<?php if ( ! get_theme_mod( 'penci_footer_logo' ) || get_theme_mod( 'penci_hide_footer_logo' ) ) : echo ' footer-not-logo'; endif; ?><?php if ( get_theme_mod( 'penci_go_to_top' ) ) : echo ' footer-not-gotop'; endif; ?>">
				<?php if ( get_theme_mod( 'penci_footer_logo' ) && ! get_theme_mod( 'penci_hide_footer_logo' ) ) : ?>
					<div id="footer-logo">
						<a href="<?php echo $footer_logo_url; ?>">
							<?php if( ! get_theme_mod('penci_disable_lazyload_layout') ){ ?>
							<img class="penci-lazy" src="<?php echo get_template_directory_uri(); ?>/images/penci-holder.png" data-src="<?php echo esc_url( get_theme_mod( 'penci_footer_logo' ) ); ?>" alt="<?php esc_html_e( 'Footer Logo', 'soledad' ); ?>" />
							<?php } else { ?>
							<img src="<?php echo esc_url( get_theme_mod( 'penci_footer_logo' ) ); ?>" alt="<?php esc_html_e( 'Footer Logo', 'soledad' ); ?>" />
							<?php } ?>
						</a>
					</div>
				<?php endif; ?>

				<?php if( get_theme_mod( 'penci_footer_menu' ) ): ?>
					<div class="footer-menu-wrap" role="navigation" <?php if( ! get_theme_mod('penci_schema_sitenav') ): ?>itemscope itemtype="https://schema.org/SiteNavigationElement"<?php endif; ?>>
					<?php
					/**
					 * Display main navigation
					 */
					wp_nav_menu( array(
						'container'      => false,
						'theme_location' => 'footer-menu',
						'menu_class'     => 'footer-menu'
					) );
					?>
					</div>
				<?php endif; /* End check if enable footer menu */?>

				<?php if ( penci_get_setting( 'penci_footer_copyright' ) ) : ?>
					<div id="footer-copyright">
						<p><?php echo penci_get_setting( 'penci_footer_copyright' ); ?></p>
					</div>
				<?php endif; ?>
				<?php if ( ! get_theme_mod( 'penci_go_to_top' ) ) : ?>
					<div class="go-to-top-parent"><a href="#" class="go-to-top"><span><?php penci_fawesome_icon('fas fa-angle-up'); ?> <br><?php echo penci_get_setting( 'penci_trans_back_to_top' ); ?></span></a></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'penci_go_to_top_floating' ) ) : ?>
			<div class="penci-go-to-top-floating"><?php penci_fawesome_icon('fas fa-angle-up'); ?></div>
		<?php endif; ?>
	</div>
</footer>

<?php endif; //Hide footer  ?>
</div><!-- End .wrapper-boxed -->
<?php
/* Vertical Mobile Nav */
get_template_part( 'template-parts/header/vertical-nav' );
/* Menu Hamburger */
if ( get_theme_mod( 'penci_menu_hbg_show' ) && ! get_theme_mod( 'penci_vertical_nav_show' ) ) {
	get_template_part( 'template-parts/menu-hamburger' );
}
?>
<?php
/* Get menu related posts popup */
if( is_singular( 'post' ) && get_theme_mod('penci_related_post_popup') ):
get_template_part( 'inc/templates/related_posts-popup' );
endif; ?>

<?php
$gprd_desc       = penci_get_setting( 'penci_gprd_desc' );
$gprd_accept     = penci_get_setting( 'penci_gprd_btn_accept' );
$gprd_rmore      = penci_get_setting( 'penci_gprd_rmore' );
$gprd_rmore_link = penci_get_setting( 'penci_gprd_rmore_link' );
$penci_gprd_text = penci_get_setting( 'penci_gprd_policy_text' );
if ( get_theme_mod( 'penci_enable_cookie_law' ) && $gprd_desc && $gprd_accept ) :
	?>
	<div class="penci-wrap-gprd-law penci-wrap-gprd-law-close penci-close-all">
		<div class="penci-gprd-law">
			<p>
				<?php if ( $gprd_desc ): echo $gprd_desc; endif; ?>
				<?php if ( $gprd_accept ): echo '<a class="penci-gprd-accept" href="#">' . $gprd_accept . '</a>'; endif; ?>
				<?php if ( $gprd_rmore ): echo '<a class="penci-gprd-more" href="' . $gprd_rmore_link . '">' . $gprd_rmore . '</a>'; endif; ?>
			</p>
		</div>
		<?php if ( ! get_theme_mod( 'penci_show_cookie_law' ) ): ?>
			<a class="penci-gdrd-show" href="#"><?php echo $penci_gprd_text; ?></a>
		<?php endif; ?>
	</div>

<?php endif; ?>

<?php /* Login/register popup */
if( get_theme_mod( 'penci_tblogin' ) ){
echo penci_soledad_login_register_popup(); 
}
?>

<?php wp_footer(); ?>

<?php if( get_theme_mod('penci_footer_analytics') ):
echo get_theme_mod('penci_footer_analytics');
endif; ?>

</body>
</html>