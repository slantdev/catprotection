<?php get_header(); ?>

<?php 
    $hero = get_field('banner', 'options'); 
    $mobilebanner = get_field('mobile_banner', 'options'); 
?>

<!-- <section class="mobilehero border">
    <div class="hero" style="background: url('<?php echo $mobilebanner['sizes']['mobilehero']; ?>') no-repeat; background-position: center; background-size: cover;"></div>
    <div class="row">
        <div class="columns text-center">
            <h1>Page not found</h1>
        </div>
    </div>  
</section>

<section class="hero tablet" style="background: url('<?php echo $hero['sizes']['hero']; ?>') no-repeat; background-position: <?php echo $bgposition['value']; ?> center; background-size: cover;">

    <div class="middle text-center">
        <h1>Page not found</h1>
    </div>  
</section> -->


<section class="grid-container content pagenotfound">
    <div class="grid-x">
        <article class="cell large-12 text-center align-self-middle">
            <h2>Sorry, we could not find what you were looking for.</h2>
            <p>Please try searching below or continue to the <a href="/">home page</a>.</p>
        </article>
    </div>
</section>

           
<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>                           


<?php get_footer(); ?>
