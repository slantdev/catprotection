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

<?php if( get_field('select_secondary_navigation') ): ?>
    <section class="sub-nav">
        <nav class="grid-container">
            <div class="grid-x">

                <?php get_template_part( 'assets/inc/template-parts/secondary-nav' ); ?>

            </div>
        </nav>
    </section>
<?php endif; ?>

<section class="grid-container content">
    <div class="grid-x">
        <article class="cell large-10">            
            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

            <?php gravity_form(2, false, false, false, '', true, 12); ?>
        </article>
    </div>
</section>

<?php get_template_part( 'assets/inc/template-parts/popup' ); ?>    

          
<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>                           


<?php get_footer(); ?>
