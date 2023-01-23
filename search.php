<?php get_header(); ?>

<?php 
    $hero = get_field('banner', 'options'); 
    $mobilebanner = get_field('mobile_banner', 'options'); 
?>

<section class="mobilehero border">
    <div class="hero" style="background: url('<?php echo $mobilebanner['sizes']['mobilehero']; ?>') no-repeat; background-position: center; background-size: cover;"></div>
</section>

<section class="hero tablet" style="background: url('<?php echo $hero['sizes']['hero']; ?>') no-repeat; background-position: <?php echo $bgposition['value']; ?> center; background-size: cover;">
</section>

<section class="grid-container content searchresults">
    <div class="grid-x">
        <article class="cell large-10">
              <?php
              $s=get_search_query();
              $args = array(
              's' =>$s );
              
              // The Query
              $the_query = new WP_Query( $args );
              if ( $the_query->have_posts() ) {
                      echo ("<h1>Search Results for: ".get_query_var('s')."</h1>");

                      echo ("<ul class='searchresults'>");

                      while ( $the_query->have_posts() ) {
                         $the_query->the_post();
                               ?>
                                  <li>
                                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                  </li>
                               <?php
                      }
                  }else{
              ?>
                      <h1>Nothing Found</h1>
                      <div class="alert alert-info">
                        <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                      </div>


              <?php 
                echo ("</ul>");
              } ?>
        </article>
    </div>
</section>
            
 <?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>                           
 

<?php get_footer(); ?>
