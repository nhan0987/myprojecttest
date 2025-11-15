<?php

/**
 * @block-slug  :   lth-categories
 * @block-output:   lth_categories_output
 * @block-attributes: get from attributes.php
 */

// filter for Frontend output.
add_filter('lazyblock/lth-categories/frontend_callback', 'lth_categories_output_fe', 10, 2);

if (!function_exists('lth_categories_output_fe')) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function lth_categories_output_fe($output, $attributes) {
        ob_start();
?>
    <section class="lth-categories">
        <div class="module module_categories">
            <?php if ($attributes['title'] || $attributes['description'] || $attributes['categories']) : ?>
                <div class="module_header title-box">
                    <?php if (isset($attributes['title'])) : ?>
                        <h2 class="title">
                            <?php if ($attributes['url']) : ?> 
                                <a href="<?php echo esc_url($attributes['url']); ?>" title="">
                            <?php endif; ?>
                                <?php echo wpautop(esc_html($attributes['title'])); ?>
                            <?php if ($attributes['url']) : ?> 
                                </a>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($attributes['description']) : ?>
                        <div class="infor">
                            <?php echo wpautop(esc_html($attributes['description'])); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="module_content">
                <?php if ($attributes['categories_style'] == 'grid-01') { ?>
                    <div class="grid grid-cols-2 xl:grid-cols-3 gap-2 xl:gap-5!">
                        <?php foreach( $attributes['items'] as $index => $inner ) {
                            
                            $item_classes = 'item';
                            $image_zoom_container_classes = 'image-zoom-container';
                            $btn_view_more_larger_classes = '';
                            if ( $index == 0 ) {
                                $item_classes .= ' col-span-2 lg:col-span-1';
                                $image_zoom_container_classes .= ' image-zoom-container-full';
                                $btn_view_more_larger_classes .= ' btn-view-more-larger';
                            }

                        ?>
                            
                                <div class="<?php echo esc_attr( $item_classes ); ?>">
                                    <div class="content">
                                        <div class="content-header">
                                            <?php if (!empty($inner['item_image']['url'])) {?>
                                            <div class="content-image <?php echo esc_attr( $image_zoom_container_classes ); ?>">
                                                <a href="<?php echo get_category_link($inner['item']); ?>">
                                                    <img class="zoom-image" src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="<?php echo esc_attr($inner['item_title']); ?>">
                                                </a>
                                            </div>
                                            <?php } ?>
                                            <div class="content-box">
                                                <a class="btn-view-more <?php echo esc_attr( $btn_view_more_larger_classes ); ?> absolute translate-x-[140px] translate-y-[-44px] xl:translate-x-[272px]! xl:translate-y-[-54px]!" href="<?php echo get_category_link($inner['item']); ?>">
                                                    <span>Xem dịch vụ</span><i class="arrow-right-icons"></i> 
                                                </a>
                                                <h3 class="content-name capitalize ">
                                                    <a href="<?php echo get_category_link($inner['item']); ?>">
                                                        <?php echo wpautop($inner['item_title']); ?>
                                                    </a>
                                                </h3>
                                                <div class="content-excerpt">
                                                    <?php echo wpautop($inner['item_text']); ?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($attributes['categories_style'] == 'grid-02') { ?>
                    <div class="grid grid-cols-2 xl:grid-cols-3 gap-2 xl:gap-5! underline-01">
                        <?php foreach( $attributes['items'] as $index => $inner ) {
                            
                            $item_classes = 'item';
                            $image_zoom_container_classes = 'image-zoom-container';
                        
                            if ( $index == 0 ) {
                                $item_classes .= ' col-span-2 lg:col-span-1';
                                $image_zoom_container_classes .= ' image-zoom-container-full';                           
                            }
                            $has_mobile_title = false;
                            if(!empty($inner['item_mobile_title'])){
                                $has_mobile_title = true;
                            }

                            $title_classes = $has_mobile_title ? 'hidden xl:inline' : 'inline';
                            $items_count = "+".strip_tags($inner['item_count'])." căn hộ";

                        ?>
                            
                                <div class="<?php echo esc_attr( $item_classes ); ?>">
                                    <div class="content">
                                        <div class="content-header">
                                            <?php if (!empty($inner['item_image']['url'])) {?>
                                            <div class="content-image <?php echo esc_attr( $image_zoom_container_classes ); ?> relative">
                                                <a href="<?php echo get_category_link($inner['item']); ?>">
                                                    <img class="zoom-image" src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="<?php echo esc_attr($inner['item_title']); ?>">
                                                </a>
                                                <span class="absolute font-medium text-sm rounded-2xl bg-[#232D3980] border border-solid border-[#FFF2C652] backdrop-blur-sm py-[2px]! px-[6px]! text-white top-0 left-0 translate-y-[18px] translate-x-[14px]"><?php echo esc_attr($items_count); ?></span>
                                            </div>
                                            <?php } ?>
                                            <h3 class="content-name absolute translate-y-[-29px] capitalize font-medium text-sm xl:font-semibold! xl:text-base!">
                                                <a href="<?php echo get_category_link($inner['item']); ?>" class="<?php echo esc_attr( $title_classes ); ?>">
                                                    <?php echo wpautop($inner['item_title']); ?>
                                                </a>
                                                <?php if($has_mobile_title) {?>
                                                <a href="<?php echo get_category_link($inner['item']); ?>" class="inline xl:hidden">
                                                    <?php echo wpautop($inner['item_mobile_title']); ?>
                                                </a>
                                                <?php }?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($attributes['categories_style'] == 'grid-03') { ?>
                    <div class="grid grid-cols-2 gap-2 xl:gap-5! underline-01">
                        <?php foreach( $attributes['items'] as $index => $inner ) {
                            
                            $item_classes = 'item';
                            $image_zoom_container_classes = 'image-zoom-container';
                        
                            if ( $index == 0 ) {
                                $item_classes .= ' col-span-1';
                            }

                            $has_mobile_title = false;
                            if(!empty($inner['item_mobile_title'])){
                                $has_mobile_title = true;
                            }

                            $title_classes = $has_mobile_title ? 'hidden xl:inline' : 'inline';
                            $items_count = "+".strip_tags($inner['item_count'])." căn hộ";
                        ?>
                            
                                <div class="<?php echo esc_attr( $item_classes ); ?>">
                                    <div class="content">
                                        <div class="content-header">
                                            <?php if (!empty($inner['item_image']['url'])) {?>
                                            <div class="content-image <?php echo esc_attr( $image_zoom_container_classes ); ?> relative">
                                                <a href="<?php echo get_category_link($inner['item']); ?>">
                                                    <img class="zoom-image" src="<?php echo esc_url( $inner['item_image']['url'] ); ?>" alt="<?php echo esc_attr($inner['item_title']); ?>">
                                                </a>
                                                <span class="absolute font-medium text-sm rounded-2xl bg-[#232D3980] border border-solid border-[#FFF2C652] backdrop-blur-sm py-[2px]! px-[6px]! text-white top-0 left-0 translate-y-[18px] translate-x-[14px]"><?php echo esc_attr($items_count); ?></span>
                                            </div>
                                            <?php } ?>
                                            <h3 class="content-name absolute translate-y-[-29px] capitalize font-medium text-sm xl:font-semibold! xl:text-base!">
                                                <a href="<?php echo get_category_link($inner['item']); ?>" class="<?php echo esc_attr( $title_classes ); ?>">
                                                    <?php echo wpautop($inner['item_title']); ?>
                                                </a>
                                                <?php if($has_mobile_title) {?>
                                                <a href="<?php echo get_category_link($inner['item']); ?>" class="inline xl:hidden">
                                                    <?php echo wpautop($inner['item_mobile_title']); ?>
                                                </a>
                                                <?php }?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($attributes['categories_style'] == 'list-01'){ ?>

                    <ul class="py-4 list-none">
                        <?php foreach( $attributes['items'] as $inner ) { ?>
                            <li class="list-none"><a href="<?php echo get_category_link($inner['item']); ?>" ><?php echo wpautop($inner['item_title']); ?></a></li>
                        <?php }?>
                    </ul>

                <?php }  ?>
            </div>
        </div>
    </section>
<?php
        return ob_get_clean();
    }
endif;
?>