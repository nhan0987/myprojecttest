
<div class="item">
    <div class="content">
        <div class="content-header">
            <?php if (has_post_thumbnail()) { ?>
                <div class="content-image">
                    <a href="<?php the_permalink(); ?>" title="" class="image">
                        <img src="<?php echo lth_custom_img('full', 100, 70);?>" width="100" height="70" alt="<?php the_title(); ?>">
                    </a>
                </div>
            <?php } ?>

            <div class="content-box">
                <h3 class="content-name">
                    <a href="<?php the_permalink(); ?>" title="" class="name-news__mains titles-bold__alls fs-17s mb-10s">
                        <?php the_title(); ?>
                    </a> 
                </h3>

                <p class="content-days">
                    <img src="<?php echo ASSETS_URI ?>/images/icon-calendar-2.svg" alt="Icon">
                    <?php the_time('d/m/Y'); ?>
                </p>
            </div>
        </div>
    </div>
</div>