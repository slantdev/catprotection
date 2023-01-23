<?php get_header(); ?>

<section class="banner banner--interior">
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <?php 
            if ( has_post_thumbnail( $post )) {  
                $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner_interior' ); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection"></figure>

            <?php } else {
                $backgroundImg = get_field('placeholder_image', 'options'); ?>
                
                <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['hd']; ?>" alt="Cat Protection"></figure>                

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

<section class="grid-container content">
    <div class="grid-x">
        <article class="cell large-10">

            <?php echo the_field('text'); ?>

        </article>
    </div>
</section>

<section class="booking">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">

            <article class="cell medium-4 booking__info">
                <h3><?php echo the_field('clinic_address_heading'); ?></h3>
                <address class="booking__address">
                    <?php echo the_field('clinic_address'); ?>
                </address>
                <h3><?php echo the_field('clinic_hours_heading'); ?></h3>
                <div class="booking__times">
                    <?php echo the_field('clinic_hours'); ?>
                </div>
                <a href="tel:+61<?php echo str_replace(' ', '', get_field('clinic_telephone')); ?>" class="booking__tel">Book <?php echo the_field('clinic_telephone'); ?></a>
            </article>
            <article class="cell medium-8">
                <div class="booking__map">
                    <figure class=""><?php echo the_field('google_map'); ?></figure>
                </div>
            </article>
        
        </div>
    </div>
</section>

<?php
    if( have_rows( 'content_block' ) ): ?>

        <?php while( have_rows( 'content_block' ) ): the_row();
            get_template_part( 'assets/inc/template-parts/flex-' . get_row_layout() );
        endwhile; ?>

    <?php endif;
?>  

<?php get_template_part( 'assets/inc/template-parts/popup' ); ?>    

           
<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>                           


<?php get_footer(); ?>
