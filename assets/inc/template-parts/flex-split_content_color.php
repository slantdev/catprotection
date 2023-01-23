<?php
/**
 * TODO
 * set heading to white h1..h6
 * <p> color blue
 */

?>
<div class="two-col two-col--color">

    <?php if( have_rows('split_content_color') ): ?>

        <?php while( have_rows('split_content_color') ): the_row();

            $image = get_sub_field('image');
            $text = get_sub_field('text');
            $tile_color = get_sub_field('tile_color');
            $layout = get_sub_field('layout');

            ?>

            <section class="two-col__item">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x align-center">
                        <div class="cell medium-6 large-5">
                            <figure class="two-col__img">
                                <img src="<?php echo $image['sizes']['gallery_tiles']; ?>" alt="<?php echo $image['alt']; ?>">
                            </figure>
                        </div>
                        <div class="cell medium-6 large-5">
                            <div class="two-col__text" style="background-color: #<?php echo $tile_color; ?>;">
                                <div>
                                    <?php echo $text; ?>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endwhile; ?>

    <?php endif; ?>

</div>
