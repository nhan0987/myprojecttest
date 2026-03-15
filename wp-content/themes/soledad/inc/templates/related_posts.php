<?php
/**
 * Related post template
 * Render list related posts
 *
 * @since 1.0
 */
$data_auto = 'true';
$auto = get_theme_mod( 'penci_post_related_autoplay' );
if( $auto == false ): $data_auto = 'false'; endif;

$sidebar_opts = get_post_meta( get_the_ID(), 'penci_post_sidebar_display', true );

$orig_post = $post;
global $post;
$numbers_related = get_theme_mod('penci_numbers_related_post');
if ( !isset( $numbers_related ) || $numbers_related < 1 ): $numbers_related = 10; endif;

$orderby_post = 'date';
if( get_theme_mod('penci_related_orderby') && get_theme_mod('penci_related_orderby') != 'date' ):
	$orderby_post = get_theme_mod('penci_related_orderby');
endif;

$related_order_post  = get_theme_mod('penci_related_sort_order');
$related_order_post   = $related_order_post ? $related_order_post : 'DESC';
$related_title_length = get_theme_mod( 'penci_related_posts_title_length' ) ? get_theme_mod( 'penci_related_posts_title_length' ) : 8;
$penci_related_by = get_theme_mod('penci_related_by');

$args = penci_get_query_related_posts( get_the_ID(), $penci_related_by, $orderby_post, $related_order_post, $numbers_related );

if ( ! empty( $args ) ) {

	$my_query = new wp_query( $args );
	if ( $my_query->have_posts() ) {
		$data_loop = '';
		$number_posts_display = $my_query->post_count;
		if( $number_posts_display < 4 ):
		$data_loop = ' data-loop="false"';
		endif;
		?>
		<div class="post-related<?php if( get_theme_mod('penci_post_related_grid') ): echo ' penci-posts-related-grid'; endif; ?>">
		<div class="dash-07">
			<div class="title-box">
				<h2 class="title">
					<p><?php echo penci_get_setting( 'penci_post_related_text' ); ?></p>
				</h2>
				<div class="infor">
					<p><?php echo penci_get_setting( 'penci_post_related_infor' ); ?></p>
				</div>
			</div>
		</div>
		<?php if( ! get_theme_mod('penci_post_related_grid') ) { $lazy_class = 'owl-lazy'; ?>
			<div class="penci-owl-carousel penci-owl-carousel-slider penci-related-carousel" data-lazy="true"<?php echo $data_loop; ?> data-item="3" data-desktop="3" data-tablet="2" data-tabsmall="2" data-auto="<?php echo $data_auto; ?>" data-speed="300"<?php if( ! get_theme_mod('penci_post_related_dots') ){ echo ' data-dots="true"'; } if( ! get_theme_mod('penci_post_related_arrows') ){ echo ' data-nav="false"'; } ?>>
		<?php } else { 
			$lazy_class = 'penci-lazy'; 
		?>
			<div class="cut-the-lower-left-corner swiper related-posts-slider ">
				
					<div class="swiper-wrapper gap-7">
						<?php } ?>
						<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
								<div class="swiper-slide item w-[14.375rem]! xl:w-[14.375rem]!">
									<div class="grid grid-cols-1 pt-2 pb-2 xl:p-2 gap-2 xl:gap-0!">
										<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>

												<div class="content-image image-zoom-container xl:col-span-1 pr-2 xl:pr-0">
													
													<a style="background-image: url('<?php echo penci_get_featured_image_size( get_the_ID(), penci_featured_images_size() ); ?>');" href="<?php the_permalink(); ?>" title="<?php echo wp_strip_all_tags( get_the_title() ); ?>">
														<img decoding="async" class="zoom-image" src="<?php echo penci_get_featured_image_size( get_the_ID(), penci_featured_images_size() ); ?>" alt="<?php echo wp_strip_all_tags(get_the_title() ); ?>">
													</a>
													
												</div>

												<?php if( has_post_thumbnail() && get_theme_mod('penci_post_related_icons') ): ?>
													<?php if ( has_post_format( 'video' ) ) : ?>
														<?php penci_fawesome_icon('fas fa-play'); ?>
													<?php endif; ?>
													<?php if ( has_post_format( 'audio' ) ) : ?>
														<?php penci_fawesome_icon('fas fa-music'); ?>
													<?php endif; ?>
													<?php if ( has_post_format( 'link' ) ) : ?>
														<?php penci_fawesome_icon('fas fa-link'); ?>
													<?php endif; ?>
													<?php if ( has_post_format( 'quote' ) ) : ?>
														<?php penci_fawesome_icon('fas fa-quote-left'); ?>
													<?php endif; ?>
													<?php if ( has_post_format( 'gallery' ) ) : ?>
														<?php penci_fawesome_icon('far fa-image'); ?>
													<?php endif; ?>
												<?php endif; ?>
											</a>
										<?php endif; ?>
											<div class="content-box col-span-1">
												<p class="content-days absolute translate-x-[7.375rem] translate-y-[-2.5625rem] xl:translate-x-[0px]! xl:translate-y-[-1.3125rem]! text-base! xl:text-xs! text-gray-400">
													<?php penci_soledad_time_link(); ?>
												</p>
												<h3 class="content-name line-clamp-2">
													<a href="<?php the_permalink(); ?>" title="<?php echo wp_strip_all_tags(get_the_title() ); ?>">
														<p class="text-sm! font-semibold text-black hover:text-[#FEC769]"><?php echo get_the_title() ?></p>
													</a>
												</h3>
											</div>
										
									</div>
								</div>
						<?php
						endwhile; 
						?>
				

					</div>
				<div class="swiper-pagination"></div>
				
			</div>

			<div class="swiper-button-next swiper-arrow swiper-next "></div>
			<div class="swiper-button-prev swiper-arrow swiper-prev"></div>

			

	
	</div>

		<?php
	}
}
$post = $orig_post;
wp_reset_postdata();
?>