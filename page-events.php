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

<section class="cards cards--news">
    <div class="grid-container">

        <div class="grid-x">
            <div class="cell">
                <h2 class="cards__title text-center">Events</h2>
            </div>
        </div>

        <section class="grid-x grid-margin-x medium-up-3">
    
            <?php global $post; 
            $args = array('numberposts'=>-1, 'category_name' => 'event');

            $custom_posts = get_posts($args);

            foreach($custom_posts as $post) : setup_postdata($post); ?>

                <article class="cell cards__item">
                    <a href="<?php the_permalink(); ?>" class="card card--news">
                        <?php
                        foreach((get_the_category()) as $category) { ?>
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
                            <span class="card__link" title="">Read more</span>
                        </div>
                    </a>
                </article>
            
            <?php endforeach; ?>              

        </section>
    </div>
</section>

<?php get_template_part( 'assets/inc/template-parts/popup' ); ?>


<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>


<?php get_footer(); ?>
