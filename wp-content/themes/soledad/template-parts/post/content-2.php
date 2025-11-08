
<div class="col-span-1">
    <div class="grid grid-cols-12 gap-2">
        
            <?php if (has_post_thumbnail()) { ?>
                <div class="content-image col-span-4">
                    <a href="<?php the_permalink(); ?>" title="" class="image test">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>"  alt="<?php the_title(); ?>">
                    </a>
                </div>
            <?php } else {

                $default_thumbnail_src = get_default_thumbnail_url('default-images.png');
            ?>
                <div class="content-image col-span-4">
                    <a href="<?php the_permalink(); ?>" title="" class="image">
                        <img src="<?php echo $default_thumbnail_src; ?>" width="227" height="146" alt="<?php the_title(); ?> - Ảnh mặc định">
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="content-box w-64 col-span-8">
                <h3 class="content-name">
                    <a href="<?php the_permalink(); ?>" title="" class="name-news__mains titles-bold__alls fs-17s mb-10s">
                        <p><?php the_title(); ?></p>
                    </a>
                </h3>

                <p class="content-days">
                    <?php the_time('d/m/Y '); ?>
                </p>

            </div>
        
    </div>
</div>