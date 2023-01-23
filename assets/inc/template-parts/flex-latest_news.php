<section class="cards cards--news cards--home">
    <div class="grid-container">

        <div class="grid-x">
            <div class="cell">
                <h2 class="cards__title text-center">Latest</h2>
            </div>
        </div>

        <section class="grid-x grid-margin-x medium-up-3">
    
        <?php

            $args = array( 'post_type' => 'post', 'posts_per_page' => 3,'post_status'    => 'publish');

            $loop = new WP_Query( $args );

            if ($loop->have_posts()) :

                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <article class="cell cards__item">
                        <a href="<?php the_permalink(); ?>" class="card card--news">
                            <?php foreach((get_the_category()) as $category) { ?>
                            <span class="card__flag"><?php echo $category->cat_name . ' '; ?></span>
                            <?php } ?>

                            <?php if ( get_field('post_thumbnail_image')) {  
                                $url = get_field('post_thumbnail_image'); ?>                        
                                <img src="<?php echo $url['sizes']['gallery_tiles']; ?>" alt="" class="card__img" />
                            <?php } else {
                                $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery_tiles' ); ?>
                                <img src="<?php echo $url[0]; ?>" alt="" class="card__img" />
                            <?php } ?>                            

                            <div class="card__body">
                                <h5 class="card__title"><?php echo the_title(); ?></h5>
                                <p class="card__txt"><?php echo get_excerpt(); ?></p>
                                <span class="card__link">Read more</span>
                            </div>
                        </a>
                    </article>

                <?php endwhile;

            endif;

            wp_reset_query();

            ?>              

        </section>
    </div>
</section>