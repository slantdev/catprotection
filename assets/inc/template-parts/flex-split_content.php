<div class="two-col two-col--alt">
    
    <?php if( have_rows('split_content') ): ?>

        <?php while( have_rows('split_content') ): the_row(); 

            // vars
            $mediachoice = get_sub_field('single_image_or_slider');
            $image = get_sub_field('image');
            $slider = get_sub_field('slider');
            $text = get_sub_field('text');
            $layout = get_sub_field('layout');
            $bg = get_sub_field('background');
            $display_vid = get_sub_field('display_video_link');
            $video_link = get_sub_field('video_link');
            $read_more = get_sub_field('read_more');
            $text_cont = get_sub_field('text_cont');

            ?>

            <?php if( $layout['value'] == 'left' ): ?>

                <section class="two-col__item <?php if( $bg ): ?>solid-bg<?php endif; ?>">
                    <div class="grid-container">
                        <div class="grid-x grid-margin-x">
                            <article class="cell medium-5 two-col__column ">
                                <?php if( $mediachoice['value'] == 'single' ): ?>
                                    <figure class="two-col__img"><img src="<?php echo $image['sizes']['gallery_tiles']; ?>" alt="<?php echo $image['alt']; ?>"></figure>
                                <?php elseif( $mediachoice['value'] == 'slider' ): ?>
                                    <?php if( $slider ): ?>
                                       <div class="slider-col-gallery">        
                                            <?php foreach( $slider as $slide ): ?>
                                                <div class="slider-col-gallery__item">
                                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif;                     
                                endif; ?>
                            </article>
                            <article class="cell medium-5 medium-offset-1 two-col__column">
                                <?php echo $text; ?>
                                <?php if ($read_more) {
                                    echo '<div class="two-col__read-more read-more">';
                                    echo '<div class="read-more__content">'. apply_filters('the_content', $text_cont) . '</div>';
                                    echo '<a href="" title="" class="read-more__link"><span class="read-more__txt">Read More</span></a>';
                                    echo '</div>';
                                } ?>

                                <?php if( $display_vid ): ?>
                                   <a data-fancybox href="<?php echo $video_link; ?>" class="button">
                                        Watch Video
                                    </a>                                        
                                <?php endif; ?>                                
                            </article>
                        </div>
                    </div>
                </section>                            

            <?php elseif( $layout['value'] == 'right' ): ?>

                <section class="two-col__item <?php if( $bg ): ?>solid-bg<?php endif; ?>">
                    <div class="grid-container">
                        <div class="grid-x grid-margin-x">                                
                            <article class="cell medium-5 medium-offset-1 small-order-1 medium-order-2 two-col__column ">
                                <?php if( $mediachoice['value'] == 'single' ): ?>
                                    <figure class="two-col__img"><img src="<?php echo $image['sizes']['gallery_tiles']; ?>" alt="<?php echo $image['alt']; ?>"></figure>
                                <?php elseif( $mediachoice['value'] == 'slider' ): ?>
                                    <?php if( $slider ): ?>
                                       <div class="slider-col-gallery">        
                                            <?php foreach( $slider as $slide ): ?>
                                                <div class="slider-col-gallery__item">
                                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif;                     
                                endif; ?>
                            </article>
                            <article class="cell medium-5 small-order-2 medium-order-1 two-col__column">
                                <?php echo $text; ?>
                                <?php if ($read_more) {
                                    echo '<div class="two-col__read-more read-more">';
                                    echo '<div class="read-more__content">'. apply_filters('the_content', $text_cont) . '</div>';
                                    echo '<a href="" title="" class="read-more__link"><span class="read-more__txt">Read More</span></a>';
                                    echo '</div>';
                                } ?>

                                <?php if( $display_vid ): ?>
                                   <a data-fancybox href="<?php echo $video_link; ?>" class="button">
                                        Watch Video
                                    </a>                                        
                                <?php endif; ?>                                
                            </article> 
                        </div>
                    </div>
                </section>                            

            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>

</div>   
