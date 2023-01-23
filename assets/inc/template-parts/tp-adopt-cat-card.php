<?php
    global $post;

    $catdescription = get_field('cat_description');
    $status = get_field('cat_status');
    $application_required = get_field('application_required');
    $age = get_field('age');
    $gender = get_field('gender');
    $date = get_field('date_cat_went_missing');

    $breed = get_field('breed');
    $location = clean_google_address(get_field('location'));
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gallery_tiles');
    $slider = get_field('cat_gallery');
    $has_friend = get_field('has_friend');
?>
<article class="cell cards__item">
                <!-- CARD -->
                    <a class="card" href="<?php the_permalink(); ?>">
                        <?php if ($has_friend): ?>
                            <span class="card__flag">I come with a Friend</span>
                        <?php elseif ($status['value'] == 'adopted'): ?>
                            <span class="card__flag"><?php echo $status['label']; ?></span>
                        <?php elseif ($status['value'] == 'found' || $status['value'] == 'lost' && $date) : ?>
                            <span class="card__flag"><?php echo $date; ?></span>
                        <?php elseif ($application_required): ?>
                            <span class="card__flag">Apply Now</span>
                        <?php endif; ?>
                        <?php if (isset($slider[0]['url'])) : ?>
                                            <?php $slide = array_shift($slider); ?>
                                            <img src="<?php echo $slide['sizes']['gallery_tiles']; ?>" alt="<?php echo $slide['alt']; ?>" class="gallery__img">
                                        <?php else : ?>
                                            <img src="<?php echo $image[0]; ?>" alt="<?php echo $image['alt']; ?>" class="gallery__img">
                                        <?php endif; ?>
                        <div class="card__body">
                        <?php if ($status['value'] == 'found'): ?>
                            <h5 class="card__title"><?php echo $location['suburb'] ?></h5>
                        <?php elseif ($status['value'] == 'lost'): ?>
                            <h5 class="card__title"><?php echo $location['suburb'] ?></h5>
                            <?php if ($age): ?>
                                <p class="card__txt"><?php echo strtolower($age['label']); ?> old <?php echo strtolower($gender).' '.strtolower($breed['label']); ?></p>
                            <?php endif; ?>
                        <?php else : ?>
                            <h5 class="card__title"><?php echo $post->post_title; ?></h5>
                            <?php if ($age): ?>
                                <p class="card__txt"><?php echo strtolower($age['label']); ?> old <?php echo strtolower($gender).' '.strtolower($breed['label']); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>

                        </div>
                        </a>
                <!-- CARD END -->
</article>