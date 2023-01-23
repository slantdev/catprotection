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

<?php 
    $secondary_text = get_field('secondary_text');
?>
<section class="grid-container content contact-us">
    <div class="grid-x">
        <article class="cell large-10">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </article>
    </div>
    <div class="grid-x ">
        <article class="cell large-10">
            <div class="grid-x grid-margin-x contact-us__map">
                <article class="cell large-5 contact-us__map-left">
                <?php if( $secondary_text ): ?>
                    <?php echo $secondary_text; ?>
                <?php endif; ?>
                </article>
                <article class="cell large-6 large-offset-1">
                    <div class="embed-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3156.115795752107!2d145.10087151819516!3d-37.71695974497535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad648650bdf0923%3A0xc26fdbb071ef1160!2s200+Elder+St%2C+Greensborough+VIC+3088!5e0!3m2!1sen!2sau!4v1557359850142!5m2!1sen!2sau" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </article>
            </div>
        </article>
    </div>
    <div class="grid-x">
        <article class="cell large-10">
            <?php gravity_form(1, true, false, false, '', true, 12); ?>
        </article>
    </div>
</section>

<?php get_template_part( 'assets/inc/template-parts/popup' ); ?>    

          
<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>                           


<?php get_footer(); ?>