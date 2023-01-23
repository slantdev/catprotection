<section class="gallery">
    <div class="gallery__inner">
        <section class="fw-slider-gallery">

            <?php
                $images = get_sub_field('images');
            ?>

            <?php foreach( $images as $image ): ?>

                <article class="">                       
                    <figure class="gallery__figure">
                        <img src="<?php echo $image['sizes']['gallery_tiles']; ?>" alt="" class="gallery__img">
                    </figure>
                </article> 
                                       
            <?php endforeach; ?>                    

        </section>
    </div>

</section>