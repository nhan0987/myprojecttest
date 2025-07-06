

<div class="post-content">	
	<?php if (has_post_thumbnail()) { ?>
        <div class="content-image">
            <div class="image">
                <img src="<?php echo lth_custom_img('full', 770, 420);?>" width="770" height="420" alt="<?php the_title(); ?>">
            </div>
        </div>
    <?php } ?>

    <p class="content-days">
        <img src="<?php echo ASSETS_URI ?>/images/icon-calendar-2.svg" alt="Icon">
        <?php the_time('d/m/Y'); ?>
    </p>

	<h1 class="title">
		<?php the_title(); ?>
	</h1>

	<div class="content-excerpt">
        <?php wpautop(the_excerpt()); ?>
    </div>

    <div class="content">
    	<?php the_content(); ?>
    </div>
</div>