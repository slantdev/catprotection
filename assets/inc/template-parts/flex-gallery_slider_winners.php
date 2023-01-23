<?php
global $post;
$permalink = get_permalink();
$permalinkParent = get_permalink($post->post_parent);
$winnersCategory = get_sub_field('winners_category');
$galleryhash = 'CPSV';
$galleryname = "CPSV CHOICE";
if($winnersCategory === 'most-popular'){
    $galleryhash = 'winners';
    $galleryname = "Winners";
}    
?>
<?php if($galleryhash == 'winners'): ?>
<section class="inline-cta">
    <div class="grid-container">
        <div class="grid-x">
            <div class="cell">
				<a class="button button--ghost button--form-back winners-gallery get-scroll-id" href="#<?php echo $galleryhash; ?>" style="margin-bottom: 0;"><?php echo $galleryname; ?> Gallery</a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="gallery-entrant gallery-entrant--winner" id="<?php echo $galleryhash; ?>">
    <div class="gallery-entrant__inner">
        <h2 class="gallery-entrant__heading text-center"><?php echo $galleryname; ?> Gallery</h2>

        <?php
        $permalink = get_permalink();
        if($winnersCategory === 'most-popular'){
            $posts_per_page = 12; // 
            $args = array( 'post_type' => 'cat-entrants', 'posts_per_page' => $posts_per_page, 'post_status' => 'publish', 'meta_key' => 'vote_count', 'orderby' => array('meta_value_num' => 'DESC', 'post_modified' => 'DESC') );
        }else{
            $posts_per_page = 2;
            $args = array( 'post_type' => 'cat-entrants', 'posts_per_page' => $posts_per_page, 'post_status' => 'publish', 'meta_key' => 'favourited', 'meta_compare' => '=', 'meta_value' => 1, 'orderby' => array('post_modified' => 'DESC') );

        }
    	$loop = new WP_Query( $args );

        if ($loop->have_posts()) :
            $oldpost = $post;
        ?>

        <section class="cards">
          <div class="grid-container">
            <article class="grid-x grid-margin-x medium-up-2">
                <?php while ( $loop->have_posts() ) : $loop->the_post();
                    $postID = get_the_ID();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'gallery_tiles' );
                    $age = get_field('age');
                    $year = get_field('year_adopted');
                    $description = get_field('description');
                    $readMore = get_field('read_more');
                    $images = get_field('images_entrants');

                    $tableVotes = $wpdb->prefix.'votes';
    				$sql = 'SELECT COUNT(post_id) AS count FROM '.$tableVotes.' WHERE post_id = %s';
    				$votes = $wpdb->get_row(
    					$wpdb->prepare(
    						$sql,
    						$postID
    					)
    				);
                ?>
                <div class="cell cards__item">
                    <div class="card card--entrant">
                        <div class="card__share share">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr( get_permalink($postID) ); ?>" target="_blank" class="share__icon share__icon--facebook" onclick="FB.AppEvents.logEvent('entrantShared')">Facebook</a>
                            <!-- <a href="<?php // echo esc_attr( get_permalink($postID) ); ?>" class="share__icon share__icon--email share-email">Email</a> -->
                        </div>
                        <?php if($winnersCategory === 'most-popular') : ?>
                        <div class="card__flag" id="vote-count-<?php echo $postID; ?>"><?php echo $votes->count; ?> Votes</div>
                        <?php endif; ?>
                        <div class="slider-card-gallery">
                            <?php foreach( $images as $image ) : ?>
                            <div class="slider-card-gallery__item">
                                <img src="<?php echo $image['sizes']['slider_entrants_images']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <div class="card__body">
                            <h2 class="card__title"><span><?php echo get_the_title(); ?></span> <span><?php echo $age['label']; ?></span></h2>
                            <div class="card__year">Adopted <?php echo $year; ?></div>
                            <p><?php echo $description; ?></p>
                        </div>
                        <div class="card__footer">
                            <?php if($winnersCategory === 'most-popular') : ?>
                            <img src="/site/wp-content/uploads/2019/09/most-popular-badge.png" style="width: 25%;">
                            <?php else : ?>
                            <img src="/site/wp-content/uploads/2019/09/cpsv-choice-badge.png" style="width: 25%;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </article>
          </div>
        </section>
        <?php $post = $oldpost; ?>
    <?php endif; ?>

    <!-- <div class="grid-container">
        <div class="grid-x">
            <div class="cell text-center ">
				<a class="button button--ghost button--form-back " href="#<?php // echo $galleryhash; ?>">Back to Categories</a>
                <?php // if( $posts_per_page > 2 ) : ?>
                <a class="button button--back-to-top " href="<?php // echo $permalink; ?>">Back to Top</a>
                <?php  // endif; ?>
            </div>
        </div>
    </div> -->

    </div>
</section>