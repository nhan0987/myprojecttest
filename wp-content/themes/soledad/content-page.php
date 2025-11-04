<?php
/**
 * This is content page will display in loop of page.php file
 * Don't edit this file, let create child theme and override it
 *
 * @since 1.0
 */

$pagetitle = get_post_meta( $post->ID, 'penci_page_display_title', true );
$sharebox = get_post_meta( $post->ID, 'penci_page_sharebox', true );
$block_style = get_theme_mod('penci_blockquote_style') ? get_theme_mod('penci_blockquote_style') : 'style-1';

$show_page_title = penci_is_pageheader();
$flag_ptitle = true;
if( get_theme_mod( 'penci_page_hide_ptitle' ) ){
	$flag_ptitle = false;
}
if( $pagetitle == 'yes' ){
	$flag_ptitle = true;
} else if( $pagetitle == 'no' ){
	$flag_ptitle = false;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	
	
	<?php penci_soledad_meta_schema(); ?>

	<?php 
		if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() && ! get_theme_mod( 'penci_page_hide_featured_image' ) ) : 
			$thumb_alt = $thumb_title_html = '';
			$thumb_id = get_post_thumbnail_id( get_the_ID() );
			$thumb_alt = penci_get_image_alt( $thumb_id, get_the_ID() );
			$thumb_title_html = penci_get_image_title( $thumb_id );
	?>

		<?php if( ! $show_page_title ): ?>
			<?php if( get_the_title() && $flag_ptitle ): ?>
				<div class="penci-page-header mx-4 md:mx-0 flex justify-center items-center" style="background-image: url(<?php echo penci_get_featured_image_size( get_the_ID(), 'penci-full-thumb' ); ?>);">
					<h1 class="entry-title "><?php the_title(); ?></h1>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	 <!-- <div class="post-image">
		<?php if( ! get_theme_mod( 'penci_disable_lazyload_single' ) ) {?>
			
			<img class="attachment-penci-full-thumb size-penci-full-thumb penci-lazy wp-post-image" src="<?php echo get_template_directory_uri() . '/images/penci-holder.png'; ?>" alt="<?php echo $thumb_alt; ?>"<?php echo $thumb_title_html; ?> data-src="<?php echo penci_get_featured_image_size( get_the_ID(), 'penci-full-thumb' ); ?>">
		<?php } else {  ?>
			<?php the_post_thumbnail( 'penci-full-thumb' ); ?>
		<?php }?>
	</div> -->
	<?php endif; ?> 

	<div class="post-entry <?php echo 'blockquote-'. $block_style; ?><?php if( get_theme_mod( 'penci_page_comments' ) && get_theme_mod( 'penci_page_share' ) ): echo ' page-has-margin'; endif; ?>">
		<div class="inner-post-entry entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>
	</div>

	<?php if ( ! get_theme_mod( 'penci_page_share' ) && ( 'no' != $sharebox ) ) : ?>
		<div class="tags-share-box hide-tags page-share<?php if( ! comments_open() || get_theme_mod( 'penci_page_comments' ) ): echo ' has-line'; endif; ?>">
			<div class="post-share">
				<span class="share-title"><?php echo penci_get_setting( 'penci_trans_share' ); ?></span>
				<div class="list-posts-share">
					<?php penci_soledad_social_share( );  ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( ! get_theme_mod( 'penci_page_comments' ) ) : ?>
		<?php comments_template( '', true ); ?>
	<?php endif; ?>

</article>