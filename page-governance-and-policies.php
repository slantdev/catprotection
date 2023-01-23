<?php get_header(); ?>

<section class="banner banner--interior">
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <?php
            if ( has_post_thumbnail( $post )) {
                $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner_interior' ); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection"></figure>

            <?php } else {
                $backgroundImg = get_field('placeholder_image', 'options'); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>                

            <?php }
        ?>

    <?php endwhile;
    endif; ?>
</section>

<section class="sub-nav">
    <nav class="grid-container">
        <div class="grid-x">

            <?php 
                wp_nav_menu( array(
                  'menu'     => 'main-navigation',
                  'sub_menu' => true,
                  'menu_class' => 'sub-nav__items',
                  'li_class'  => 'sub-nav__item',
                  'a_class'  => 'sub-nav__link'                      
                ) ); 
            ?>

        </div>
    </nav>
</section>

<section class="cards">
    <div class="grid-container">
        <div class="cell">
             <h2 class="cards__title"><?php the_title(); ?></h2>
        </div>

        <section class="grid-x grid-margin-x medium-up-3">

            <?php

                $args = array( 'post_type' => 'policies', 'posts_per_page' => -1,'post_status' => 'publish');

                $loop = new WP_Query( $args );

                if ($loop->have_posts()) :

                    while ( $loop->have_posts() ) : $loop->the_post(); 
                            
                           // $date = get_field('policies_date');
                            //$date = new DateTime($date);                            
                            $image = get_field('tile_image');
                            $header = get_field('tile_header');
                            $link = get_field('tile_link');
                            $linktext = get_field('tile_link_text');

                        ?>

                        <article class="cell cards__item">
                            <a href="<?php echo $link; ?>" class="card card--news" target="_blank">
                                <!-- <span class="card__flag"><?php // $date->format('M Y'); ?></span> -->

                                <img src="<?php echo $image['sizes']['gallery_tiles']; ?>" alt="" class="card__img" />

                                <div class="card__body">
                                    <h5 class="card__title"><?php echo $header; ?></h5>
                                    <p class="card__txt"><?php echo get_excerpt(); ?></p>
                                    <span class="card__link"><?php echo $linktext; ?></span>
                                </div>
                            </a>
                        </article>

                    <?php endwhile;
                else : ?>
                    <article class="cell cards__item">
                        Governance and Policies Not found
                    </article>
                <?php endif;

                wp_reset_query();

                ?>            

        </section>        
    </div>
</section>

<?php get_template_part( 'assets/inc/template-parts/popup' ); ?>


<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>


<?php get_footer(); ?>
