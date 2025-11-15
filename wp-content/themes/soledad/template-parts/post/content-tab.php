
    <div class="grid grid-cols-10 xl:grid-cols-1 pt-2 pb-2 xl:p-2 gap-2 xl:gap-0!">
            
            <?php if (has_post_thumbnail()) { ?>
                <div class="content-image image-zoom-container col-span-4 xl:col-span-1 pr-2 xl:pr-0">
                    <a href="<?php the_permalink(); ?>" title="" class="image">
                        <img class="zoom-image"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>"  alt="<?php the_title(); ?>">
                    </a>
                    
                </div>
            <?php } else {

                $default_thumbnail_src = get_default_thumbnail_url('default-images.png');
            ?>
                <div class="content-image  col-span-4 lg:col-span-1 pr-2 md:pr-0 xl:h-[150px]">
                    <a href="<?php the_permalink(); ?>" title="" class="images">
                        <img  src="<?php echo $default_thumbnail_src; ?>" width="227" height="146" alt="<?php the_title(); ?> - Ảnh mặc định">
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="content-box col-span-6 xl:col-span-1">
                <p class="content-days absolute translate-x-[-75px] translate-y-[83px] xl:translate-x-[0px]! xl:translate-y-[-21px]!">
                    <?php the_time('d/m/Y '); ?>
                </p>
                <h3 class="content-name line-clamp-2">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="name-news__mains titles-bold__alls fs-17s mb-10s">
                        <p><?php the_title(); ?></p>
                    </a>
                </h3>

                <!-- <div class="content-excerpt line-clamp-1">
                    <?php wpautop(the_excerpt()); ?>
                </div> -->
            </div>
        
    </div>
