
    <div class="flex flex-nowrap gap-2! xl:gap-4!">
        
            <?php if (has_post_thumbnail()) { ?>
                <div class="content-image cut-the-top-left-corner-23-container">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img class="w-full! h-full! object-cover zoom-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>"  alt="<?php the_title(); ?>">
                    </a>
                    <div class="content-days right-0 bottom-0 absolute bg-white">
                        <?php the_time('d/m/Y '); ?>
                    </div>
                </div>
            <?php } else {

                $default_thumbnail_src = get_default_thumbnail_url('default-images.png');
            ?>
                <div class="content-image cut-the-top-left-corner-23-container">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img class="w-full! h-full! object-cover zoom-image" src="<?php echo $default_thumbnail_src; ?>" width="227" height="146" alt="<?php the_title(); ?>">
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="content-box">
                <h3 class="content-name">
                    <a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
                        <p class="line-clamp-2 xl:line-clamp-none"><?php echo the_title(); ?></p>
                    </a>
                </h3>

                <div class="content-excerpt ">
                    <a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
                        <?php echo the_excerpt();?>
                    </a>
                </div>
            </div>
        
    </div>
