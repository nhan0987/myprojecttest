<?php
$sidebar_enable = penci_single_sidebar_return();
$sidebar_position = penci_get_posts_sidebar_class();
$sidebar_small_width = penci_single_smaller_content_enable();

// Check layout magazine
$single_magazine = ' container-single penci-single-style-3 penci-single-smore container-single-fullwidth hentry ';
if( get_theme_mod( 'penci_home_layout' ) == 'magazine-1' || get_theme_mod( 'penci_home_layout' ) == 'magazine-2' ) {
	$single_magazine .= ' container-single-magazine';
}

// Check class main content
$class_container_single = ' container-single penci-single-style-3 penci-single-smore';
if ( $sidebar_enable ){
	$class_container_single .= ' penci_sidebar';
	$class_container_single .= ' ' . $sidebar_position;

	$single_magazine .= ' ' . $sidebar_position;
} else {
	$class_container_single .= ' penci_is_nosidebar';
	$single_magazine .= ' penci_is_nosidebar';
}

if( $sidebar_small_width ) {
	$class_container_single .= ' penci-single-smaller-width';
}

if( ! get_theme_mod( 'penci_disable_lightbox_single' ) ){
	$class_container_single .= ' penci-enable-lightbox';
}

if( ! get_theme_mod( 'penci_disable_lightbox_single' ) ){
	$class_container_single .= ' penci-enable-lightbox';
}
$post_format = get_post_format();

$post_format = get_post_format();
$show_post_format = true;
if( get_theme_mod( 'penci_post_thumb' ) && ! in_array( $post_format, array( 'link', 'quote','gallery','video' ) )  ) {
	$class_container_single .= ' penci-single-pheader-noimg';
	$show_post_format = false;
}

$postID = get_the_ID();
$current_permalink = get_permalink( $postID );
$current_title = get_the_title( $postID );
$infinite_load  = get_theme_mod( 'penci_loadnp_posts' ) ? get_theme_mod( 'penci_loadnp_posts' ) : false;
$prev_post_id = $prev_post_url = $prev_post_title = $wrap_inficlass = $flag_infi = '';
$data_infiads = get_theme_mod( 'penci_loadnp_ads' ) ? '<div class="penci-single-infiads">' . get_theme_mod( 'penci_loadnp_ads' ) . '</div>' : '';
if( get_theme_mod( 'penci_loadnp_posts' ) ){
	$prev_post = penci_get_next_prev_posts();
	$flag_infi = 'no_data';
	if( ! empty( $prev_post ) && $prev_post != null && $prev_post != '' ) {
		$prev_post_id = $prev_post->ID;
		$prev_post_url = get_permalink( $prev_post_id );
		$prev_post_title = get_the_title( $prev_post_id );
		$wrap_inficlass = ' penci-single-infiscroll';
		$flag_infi = 'has_data';
	}
}
?>
<div class="penci-single-wrapper<?php echo $wrap_inficlass; ?>"<?php if( get_theme_mod( 'penci_loadnp_posts' ) && $data_infiads ) echo ' data-infiads="' . htmlentities( $data_infiads ) . '"'; ?>>
	<div class="penci-single-block<?php if( $flag_infi == 'no_data' ){ echo ' penci-single-infiblock-end'; } ?> xl:max-w-7xl! max-w-[23.4375rem] mx-auto px-3! 2xl:px-0!"<?php if( get_theme_mod( 'penci_loadnp_posts' ) ): ?> data-prev-url="<?php echo esc_url( $prev_post_url );?>" data-current-url="<?php echo esc_url( $current_permalink );?>" data-post-title="<?php echo esc_attr( $current_title );?>" data-edit-post="<?php echo get_edit_post_link( $postID ); ?>" data-postid="<?php echo $postID; ?><?php endif; ?>">
		
		<div class="penci-single-pheader <?php echo ( $single_magazine );?>">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					if( ! get_theme_mod( 'penci_move_title_bellow' ) ) {
						get_template_part( 'template-parts/single', 'breadcrumb' );
						
					}
					
				endwhile;
			endif;
			?>
		</div>

		<div class="flex flex-wrap lg:flex-nowrap gap-2 justify-around">
			<div class="basis-[60rem] " >

				<!-- entry header -->
				<?php get_template_part( 'template-parts/single', 'entry-header' ); ?>

				<div class="flex flex-wrap w-full gap-6">
					<!-- time box -->
					<?php if (! get_theme_mod('penci_single_meta_date')) : ?>
						
							<!-- <span class="material-symbols-outlined">calendar_today</span> -->
							<!-- <?php penci_soledad_time_link('single'); ?> -->
						<div class="date-badge flex-none w-[82px]">
							<span class="day-month"><?php echo get_the_date('d/m'); ?></span>
							<span class="year"><?php echo get_the_date('Y'); ?></span>

							
						</div>

						<div class="flex-1">
							<!-- title box -->
							<h1 class="post-title single-post-title entry-title mb-0! font-bold! text-[20px] lg:text-[32px]!"><?php the_title(); ?></h1>
							<!-- <?php get_template_part( 'template-parts/single', 'post-format' ); ?> -->
						</div>

						

						
					<?php endif; ?>

					<div class="w-full h-0"></div>

					<div class="flex-none w-[82px] hidden lg:flex justify-center">
						<button id="toc-toggle" class="mt-6! w-12 h-12 bg-white border border-gray-200 rounded-full! hidden lg:flex items-center justify-center hover:bg-gray-50 transition-all ">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							</svg>
						</button>

						<!-- Sidebar mục lục - Đã chuyển sang bên TRÁI -->
						<div id="toc-sidebar" class="fixed top-0 left-0 z-40 w-80 h-full bg-white shadow-2xl p-8! pt-16! overflow-y-auto border-r">
							<div class="flex items-center justify-between mb-2 border-b! border-gray-300! pb-4!">
								<h3 class="text-lg! font-bold text-[#232D39] uppercase">Mục lục bài viết</h3>
								<button id="toc-close" class="text-gray-400! hover:text-red-500! mb-[0.5rem]!">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
									</svg>
								</button>
							</div>
							<!-- Danh sách các tiêu đề sẽ được tự động thêm vào đây -->
							<ul id="toc-list" class="space-y-3">
								<!-- JS sẽ render nội dung vào đây -->
							</ul>
						</div>

						<!-- Lớp phủ mờ khi mở Sidebar -->
						<div id="toc-overlay" class="fixed inset-0 bg-black/30 z-30 hidden"></div>
					</div>
					
					<div id="main"<?php if ( get_theme_mod( 'penci_sidebar_sticky' ) ): ?> class="penci-main-sticky-sidebar "<?php endif; ?> class="flex-1">
						
						<div class="theiaStickySidebar">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php penci_set_post_views( $post->ID ); ?>
								<?php get_template_part( 'template-parts/single', 'content-main' ); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>

					<div class="w-full ">

						<!-- tag box -->

						<?php if ( ! get_theme_mod( 'penci_post_tags' ) && has_tag() ) : ?>
							<?php if ( is_single() ) : ?>
								<div class="post-tags">
									
									<?php the_tags( null,"", "" ); ?>
								</div>
								
							<?php endif; ?>
							
						<?php endif; ?>
						
						<!-- meta box -->
						<?php
						get_template_part( 'template-parts/single', 'meta-comment' );
						?>

						
						<!-- related box -->
						<?php 
							$reorder = get_theme_mod('penci_single_ordersec') ? get_theme_mod('penci_single_ordersec') : 'author-postnav-related-comments';
							$reorderarray = explode( '-', $reorder );
							if( !empty( $reorderarray ) ) {
								foreach( $reorderarray as $sec ) {
							?>

							<?php if ( $sec == 'author' && ! get_theme_mod( 'penci_post_author' ) ) : ?>
								<?php get_template_part( 'inc/templates/about_author' ); ?>
							<?php endif; ?>

							<?php if ( $sec == 'postnav' && ! get_theme_mod( 'penci_post_nav' ) ) : ?>
								<?php get_template_part( 'inc/templates/post_pagination' ); ?>
							<?php endif; ?>

							<?php if ( $sec == 'related' && ! get_theme_mod( 'penci_post_related' ) ) : ?>
								<?php get_template_part( 'inc/templates/related_posts' ); ?>
							<?php endif; ?> 
							
							<?php if ( $sec == 'comments' && ! get_theme_mod( 'penci_post_hide_comments' ) ) : ?>
								<?php comments_template( '', true ); ?>
							<?php endif; ?>
							
						<?php } } ?>
					</div>
				</div>
				<?php get_template_part( 'template-parts/single', 'sidebar' ); ?>
			</div>
			<div class="basis-[18.5rem] text-white">test2test2</div>
		</div>
		<?php do_action( 'penci_action_after_post_content' ); ?>
		
	</div>
</div>
<?php if( get_theme_mod( 'penci_loadnp_posts' ) && $flag_infi != 'no_data' ){ ?>
	<div class="penci-ldsingle"><div class="penci-ldspinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>
<?php } ?>
<?php get_footer(); ?>