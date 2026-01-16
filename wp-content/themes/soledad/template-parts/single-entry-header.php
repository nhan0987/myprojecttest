<?php
$style_cscount = get_theme_mod('penci_single_style_cscount');
$style_cscount = $style_cscount ? $style_cscount : 's1';
$single_style  = penci_get_single_style();
$move_title_bellow   = get_theme_mod('penci_move_title_bellow');
?>
<div class="header-standard header-classic single-header flex flex-col gap-2">


	<h1 class="post-title single-post-title entry-title mb-0!"><?php the_title(); ?></h1>
	<?php penci_soledad_meta_schema(); ?>
	<?php $hide_readtime = get_theme_mod('penci_single_hreadtime'); ?>
	<?php if (! get_theme_mod('penci_single_meta_author') || ! get_theme_mod('penci_single_meta_date') || ! get_theme_mod('penci_single_meta_comment') || get_theme_mod('penci_single_show_cview') || penci_isshow_reading_time($hide_readtime)) : ?>
		<div class="post-box-meta-single flex gap-2! xl:gap-1">
			<?php if (! get_theme_mod('penci_single_meta_date')) : ?>
				<div class="flex items-center gap-1!"><span class="material-symbols-outlined">calendar_today</span><?php penci_soledad_time_link('single'); ?></div>
			<?php endif; ?>
			<?php if (! get_theme_mod('penci_single_meta_author')) : ?>
				<span class="author-post byline flex items-center gap-1!">
					<span class="author vcard"><?php echo penci_get_setting('penci_trans_by'); ?> 
					<!-- <a class="author-url url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> -->
					<a class="author-url url fn n" href="#"><?php the_author(); ?></a>
				</span>
			</span>
			<?php endif; ?>
			<?php if (! get_theme_mod('penci_post_cat')) : ?>
				<span class="cat"><?php penci_category(''); ?></span>
			<?php endif; ?>

			<?php if (! get_theme_mod('penci_single_meta_comment') && 's1' != $style_cscount) : ?>
				<span><?php comments_number('0 ' . penci_get_setting('penci_trans_comment'), '1 ' . penci_get_setting('penci_trans_comment'), '% ' . penci_get_setting('penci_trans_comments')); ?></span>
			<?php endif; ?>
			<?php if (get_theme_mod('penci_single_show_cview')) : ?>
				<span><i class="penci-post-countview-number"><?php echo penci_get_post_views(get_the_ID()); ?></i> <?php echo penci_get_setting('penci_trans_text_views'); ?></span>
			<?php endif; ?>
			<?php if (penci_isshow_reading_time($hide_readtime)): ?>
				<span class="single-readtime"><?php penci_reading_time(); ?></span>
			<?php endif; ?>
			<?php
			if (get_the_post_thumbnail_caption() && get_theme_mod('penci_post_thumb_caption') && in_array($single_style, array('style-5', 'style-6', 'style-8')) && ! $move_title_bellow) {
				echo '<span class="penci-featured-caption penci-fixed-caption penci-caption-relative">' . get_the_post_thumbnail_caption() . '</span>';
			}
			?>
		</div>
		<div class="flex flex-wrap gap-2 items-center">
			<span class="font-normal font-base">Chia sẻ: </span> 
			<i class="stnd-images-icons facebook-icons w-[2rem]! h-[2rem]!">&nbsp;</i> 
			<i class="stnd-images-icons youtube-icons w-[2rem]! h-[2rem]!">&nbsp;</i> 
			<i class="stnd-images-icons tiktok-black-icons w-[2rem]! h-[2rem]!">&nbsp;</i> 
			<i class="stnd-images-icons linkedin-icons w-[2rem]! h-[2rem]!">&nbsp;</i>
		</div>
	<?php endif; ?>

	<div class="font-bold"><?php echo the_excerpt() ?></div>
	
	<?php
	$recipe_title  = get_post_meta(get_the_ID(), 'penci_recipe_title', true);
	if (has_shortcode(get_the_content(), 'penci_recipe') || $recipe_title) {
		do_action('penci_recipes_action_hook');
	} ?>
</div>