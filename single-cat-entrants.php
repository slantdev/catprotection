<?php get_header(); ?>

<section class="banner banner--interior">
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <?php
            if ( has_post_thumbnail( $post )) {

                $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner_interior' ); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection"></figure>

            <?php } else {
                $backgroundImg = get_field('placeholder_competition_image', 'options'); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>

            <?php }
        ?>

    <?php endwhile;
    endif; ?>
</section>

<section class="gallery-entrant">
    <div class="gallery-entrant__inner">

        <section class="cards">
          <div class="grid-container">
            <article class="grid-x grid-margin-x medium-up-2">

              <?php $age = get_field('age'); ?>
              <?php $year = get_field('year_adopted'); ?>
              <?php $description = get_field('description'); ?>
              <?php $readMore = get_field('read_more'); ?>
              <?php $voteCount = get_field('vote_count'); ?>
              <?php $images = get_field('images_entrants'); ?>

              <?php if(!$voteCount) $voteCount = 0; ?>

              <div class="cell cards__item" style="width: 100%;">
                <div class="card card--entrant">
                  <div class="card__share share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="share__icon share__icon--facebook" onclick='FB.AppEvents.logEvent("entrantShared")'>Facebook</a>
                    <!-- <a href="<?php // echo get_permalink(); ?>" class="share__icon share__icon--email share-email">Email</a> -->
                  </div>

                  <div class="card__flag" id="vote-count-<?php echo $post->ID; ?>"><?php echo $voteCount; ?> Vote<?php if(intval($voteCount) !== 1): ?>s<?php endif; ?></div>

                  <?php if( $images ): ?>
                      <div class="slider-card-gallery">
                          <?php foreach( $images as $image ): ?>
                              <div class="slider-card-gallery__item">
                                 <img src="<?php echo $image['sizes']['slider_entrants_images']; ?>" alt="<?php echo $image['alt']; ?>" />
                              </div>
                          <?php endforeach; ?>
                      </div>
                  <?php endif; ?>

                  <div class="card__body">
                    <h2 class="card__title"><span><?php the_title(); ?></span> <span><?php echo $age['label']; ?></span></h2>

                    <div class="card__year">Adopted <?php echo $year; ?></div>

                    <p><?php echo $description; ?></p>

                    <?php if ($readMore): ?>
                    <div class="two-col__read-more">
                        <div class="read-more__content"><?php echo apply_filters('the_content', $readMore); ?></div>
                        <a href="" title="" class="read-more__link"><span class="read-more__txt">Read More</span></a>
                    </div>
                    <?php endif; ?>
                  </div>

                  <div class="card__footer">
                     <form method="post" class="voting-form">
                      <input type="hidden" name="postID" value="<?php $post->ID; ?>"/>
                      <a class="button button--ghost button--form-back" href="/could-your-cat-be-crowned-our-famous-feline-of-cpsv/" style="margin-bottom: 0;">Return to Entrant Gallery</a>
                      <input type="submit" value="Vote for me" class="button card__button" />
                    </form> 
                  </div>
                  
                </div>
              </div>
            </article>
          </div>
        </section>
    </div>
    <script>
    	var urlAJAX = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
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