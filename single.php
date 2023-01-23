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

<section class="grid-container content content--padding-reduced-bottom">
    <div class="grid-x">
        <article class="cell large-10">

            <h1><?php the_title(); ?></h1>

        </article>
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

