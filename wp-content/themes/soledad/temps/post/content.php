
<div class="item">
    <div class="content">
        <div class="content-header">
            <?php if (has_post_thumbnail()) { ?>
                <div class="content-image">
                    <a href="<?php the_permalink(); ?>" title="" class="image">
                        <img src="<?php echo lth_custom_img('full', 580, 372);?>" width="580" height="372" alt="<?php the_title(); ?>">
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
                    <?php the_time('d '); ?><?php echo __('Tháng '); ?><?php the_time('m, Y'); ?>
                </p>

                <div class="content-excerpt">
                    <?php wpautop(the_excerpt()); ?>
                </div>
            </div>
        </div>
    </div>
</div>