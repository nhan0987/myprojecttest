<?php
/**
 * This template will display category page
 *
 * @package Wordpress
 * @since 1.0
 */

get_header();

$term = get_queried_object();
$add_page = get_field('add_page', $term);
$two_sidebar_class = '';

if (!$add_page) {
	/* Sidebar position */
	$sidebar_position = penci_get_sidebar_position_archive();

	$category_oj  = get_queried_object();
	$fea_cat_id   = $category_oj->term_id;
	$cat_meta     = get_option( "category_$fea_cat_id" );
	$sidebar_opts = isset( $cat_meta['cat_sidebar_display'] ) ? $cat_meta['cat_sidebar_display'] : '';

	if( $sidebar_opts == 'left' ) {
		$sidebar_position = 'left-sidebar';
	} elseif( $sidebar_opts == 'right' ) {
		$sidebar_position = 'right-sidebar';
	}elseif( $sidebar_opts == 'two' ) {
		$sidebar_position = 'two-sidebar';
	}

	$show_sidebar = false;
	if( ( penci_get_setting( 'penci_sidebar_archive' ) && $sidebar_opts != 'no' ) || $sidebar_opts == 'left' || $sidebar_opts == 'right' || $sidebar_opts == 'two' ){
		$show_sidebar = true;
	} else {
		/* Use $template to detect sidebar for category - use this value for load correct sidebar in content templates */
		$template = 'no-sidebar';
	}

	/* Categories layout */
	$layout_this = get_theme_mod( 'penci_archive_layout' );
	if ( ! isset( $layout_this ) || empty( $layout_this ) ): $layout_this = 'standard'; endif;

	$category_oj = get_queried_object();
	$fea_cat_id = $category_oj->term_id;
	$cat_meta   = get_option( "category_$fea_cat_id" );
	$cat_layout = isset( $cat_meta['cat_layout'] ) ? $cat_meta['cat_layout'] : '';
	if( $cat_layout != '' ):
		$layout_this = $cat_layout;
	endif;

	$class_layout = '';
	if( $layout_this == 'classic' ): $class_layout = ' classic-layout'; endif;
	$two_sidebar_class = '';
	if( 'two-sidebar' == $sidebar_position ): $two_sidebar_class = ' two-sidebar'; endif;
	?>



		<?php if( ! get_theme_mod( 'penci_disable_breadcrumb' ) ): ?>
			<?php
			$yoast_breadcrumb = '';
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				$yoast_breadcrumb = yoast_breadcrumb( '<div class="max-w-sm xl:max-w-7xl mx-auto penci-breadcrumb'. $two_sidebar_class .'">', '</div>', false );
			}

			if( $yoast_breadcrumb ){
				echo $yoast_breadcrumb;
			}else{ ?>
			<div class="max-w-sm xl:max-w-7xl mx-auto penci-breadcrumb<?php echo $two_sidebar_class; ?>">
				<span><a class="crumb" href="<?php echo esc_url( home_url('/') ); ?>"><?php echo penci_get_setting( 'penci_trans_home' ); ?></a></span><?php penci_fawesome_icon('fas fa-angle-right'); ?>
				<?php
				$parent_ID = penci_get_category_parent_id( $fea_cat_id );
				if( $parent_ID ):
				echo penci_get_category_parents( $parent_ID );
				endif;
				?>
				<span><?php single_cat_title('', true); ?></span>
			</div>
			<?php } ?>
		<?php endif; ?>

		<div class="max-w-7xl mx-auto<?php echo esc_attr( $class_layout ); if ( $show_sidebar ) : ?> penci_sidebar <?php echo esc_attr( $sidebar_position ); ?><?php endif; ?>">
			<div id="main" class="penci-layout-<?php echo esc_attr( $layout_this ); ?><?php if ( get_theme_mod( 'penci_sidebar_sticky' ) ): ?> penci-main-sticky-sidebar<?php endif; ?>">
				<div class="theiaStickySidebar">
					
					<div class="penci-page-header-background">
						<div class="title-bar penci-page-header">
							
							<h1 class="entry-title"><?php printf( esc_html__( '%s', 'soledad' ), single_cat_title( '', false ) ); ?></h1>
						</div>
					</div>	

					<?php if ( category_description() ) : // Show an optional category description ?>
						<div class="post-entry penci-category-description"><?php echo do_shortcode( category_description() ); ?></div>
					<?php endif; ?>

					<?php echo penci_render_google_adsense( 'penci_archive_ad_above' ); ?>

					<?php if ( have_posts() ) : ?>
						<?php
						$class_grid_arr = array(
							'mixed',
							'mixed-2',
							'overlay-grid',
							'overlay-list',
							'photography',
							'grid',
							'grid-2',
							'list',
							'boxed-1',
							'boxed-2',
							'boxed-3',
							'standard-grid',
							'standard-grid-2',
							'standard-list',
							'standard-boxed-1',
							'classic-grid',
							'classic-grid-2',
							'classic-list',
							'classic-boxed-1',
							'magazine-1',
							'magazine-2'
						);
						if( in_array( $layout_this, $class_grid_arr ) ) {
							echo '<ul class="penci-wrapper-data penci-grid">';
						}elseif( in_array( $layout_this, array( 'masonry', 'masonry-2' ) ) ) {
							echo '<div class="penci-wrap-masonry"><div class="penci-wrapper-data masonry penci-masonry">';
						}elseif( get_theme_mod( 'penci_archive_nav_ajax' ) || get_theme_mod( 'penci_archive_nav_scroll' ) ) {
							echo '<div class="penci-wrapper-data">';
						}
						 /* The loop */
						$infeed_ads = get_theme_mod( 'penci_infeedads_archi_code' ) ? get_theme_mod( 'penci_infeedads_archi_code' ) : '';
						$infeed_num = get_theme_mod( 'penci_infeedads_archi_num' ) ? get_theme_mod( 'penci_infeedads_archi_num' ) : 3;
						$infeed_full = get_theme_mod( 'penci_infeedads_archi_layout' ) ? get_theme_mod( 'penci_infeedads_archi_layout' ) : '';
						while ( have_posts() ) : the_post();
							include( locate_template( 'content-' . $layout_this . '.php' ) );
						endwhile;

						if( in_array( $layout_this, $class_grid_arr ) ) {
							echo '</ul>';
						}elseif( in_array( $layout_this, array( 'masonry', 'masonry-2' ) ) ) {
							echo '</div></div>';
						}elseif( get_theme_mod( 'penci_archive_nav_ajax' ) || get_theme_mod( 'penci_archive_nav_scroll' ) ) {
							echo '</div>';
						}
						 penci_soledad_archive_pag_style( $layout_this );
						?>
					<?php endif; wp_reset_postdata(); /* End if of the loop */ ?>

					<?php echo penci_render_google_adsense( 'penci_archive_ad_below' ); ?>

				</div>
			</div>

			<?php
			if ( $show_sidebar ){
				get_sidebar();

				$category_layout_sidebar = get_theme_mod( 'penci_two_sidebar_archive' );
				if( $sidebar_opts ){
					$category_layout_sidebar = $sidebar_opts;
				}

				if ( 'two' == $category_layout_sidebar ) {
					get_sidebar( 'left' );
				}
			}
			?>
		</div>
<?php } else {
	if( ! get_theme_mod( 'penci_disable_breadcrumb' ) ): ?>
		<?php
		$yoast_breadcrumb = '';
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$yoast_breadcrumb = yoast_breadcrumb( '<div class="container penci-breadcrumb'. $two_sidebar_class .'">', '</div>', false );
		}

		if( $yoast_breadcrumb ){
			echo $yoast_breadcrumb;
		}else{ ?>
		<div class="container penci-breadcrumb<?php echo $two_sidebar_class; ?>">
			<span><a class="crumb" href="<?php echo esc_url( home_url('/') ); ?>"><?php echo penci_get_setting( 'penci_trans_home' ); ?></a></span><?php penci_fawesome_icon('fas fa-angle-right'); ?>
			<?php
			$parent_ID = penci_get_category_parent_id( $term->term_id );
			if( $parent_ID ):
			echo penci_get_category_parents( $parent_ID );
			endif;
			?>
			<span><?php single_cat_title('', true); ?></span>
		</div>
		<?php } ?>
	<?php endif; ?>
	<?php 
	
	$description =  $term->description;
	
	?>

	<?php
	// --- VÒNG LẶP 1: LẤY ẢNH NỀN (CHẠY "ÂM THẦM") ---
	$header_style = ''; // Khởi tạo rỗng

	// (Giả sử biến $add_page đã có ID của Page nhé!)
	if ( ! empty( $add_page ) ) { 
		// Dùng 1 tên biến query riêng cho Vòng 1
		$args_for_image = new WP_Query(array(
			'post_type'      => 'page',
			'posts_per_page' => 1,
			'p'              => $add_page,
		));

		// Chạy Vòng 1 chỉ để lấy link ảnh
		while ($args_for_image->have_posts()) : $args_for_image->the_post();
			$preview_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			
			// "Điều kiện vàng" của Oniichan
			if ( ! empty( $preview_image_url ) ) {
				$header_style = 'style="background-image: url(' . esc_url( $preview_image_url ) . ');"';
			}
		endwhile; 
		
		// Rất quan trọng: Reset query của Vòng 1
		wp_reset_query();
	}
	// --- KẾT THÚC VÒNG 1 ---


	// --- BƯỚC 2: IN RA CỤC HTML (HEADER) ---
	// (Code này không đổi, nó dùng $header_style lấy từ Vòng 1)
	?>
	<div class="penci-page-header penci-page-header-category  mx-auto justify-center items-center flex flex-col" <?php echo $header_style; ?>>
		<h1 class="entry-title"><?php printf( esc_html__( '%s', 'soledad' ), single_cat_title( '', false ) ); ?></h1>
		<span class="entry-description"> <?php echo $description; // (Biến $description này phải được lấy từ trước đó) ?></span>
	</div>
	<?php
	// --- KẾT THÚC BƯỚC 2 ---


	// --- BƯỚC 3: IN RA NỘI DUNG PAGE (THE_CONTENT) ---
	// (Chạy lại Vòng lặp y hệt Vòng 1, nhưng lần này để in 'the_content')
	if ( ! empty( $add_page ) ) { 
		// Dùng 1 tên biến query khác cho Vòng 2 (cho an toàn)
		$args_for_content = new WP_Query(array(
			'post_type'      => 'page',
			'posts_per_page' => 1,
			'p'              => $add_page,
		));

		// Chạy Vòng 2
		while ($args_for_content->have_posts()) : $args_for_content->the_post();
			
			// Oniichan muốn 'the_content()' hiển thị ở đây
			// In ra toàn bộ nội dung của trang "Giới thiệu"
			the_content(); 
			
		endwhile; 
		
		// Reset query của Vòng 2
		wp_reset_query();
	}
	// --- KẾT THÚC BƯỚC 3 ---
} ?>

<?php get_footer(); ?>