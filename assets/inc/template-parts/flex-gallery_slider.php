<?php if (!get_field('looking_to_adopt_hide_from_site', 'options')) { ?>
  <section class="gallery">
    <div class="gallery__inner">
      <h2 class="gallery__heading text-center"><?php echo the_field('looking_to_adopt_header', 'options'); ?></h2>

      <section class="slider-gallery">

        <?php

        $args = array(
          'post_type' => 'cats', 'posts_per_page' => -1, 'post_status'    => 'publish',
          'meta_query' => array(array(
            'key' => 'cat_status',
            'value' => array('notadopted', 'adopted', 'permanentfosterhome'),
            'compare'  => 'IN'
          ))
        );

        $loop = new WP_Query($args);

        if ($loop->have_posts()) :

          $counter = 0;

          while ($loop->have_posts()) : $loop->the_post(); ?>

            <?php
            $status = get_field('cat_status');
            $application_required = get_field('application_required');
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gallery_tiles');
            $slider = get_field('cat_gallery');
            $has_friend = get_field('has_friend');
            ?>

            <?php if ($counter % 8 == 0) :
              echo $counter > 0 ? "</div></article>" : ""; // close div if it's not the first
              echo "<article class='slider-gallery__item'><div class='grid-x small-up-2 large-up-4 gallery__items'>";
            endif;
            ?>
            <a href="<?php the_permalink(); ?>" class="cell gallery__item">
              <figure class="gallery__figure">
                <?php if ($has_friend) : ?>
                  <span class="card__flag">I come with a Friend</span>
                <?php elseif ($status['value'] == 'adopted') : ?>
                  <span class="card__flag"><?php echo $status['label']; ?></span>
                <?php elseif ($status['value'] == 'permanentfosterhome') : ?>
                  <span class="card__flag bg-brand-orange"><?php echo $status['label']; ?></span>
                <?php elseif ($status['value'] == 'found' || $status['value'] == 'lost' && $date) : ?>
                  <span class="card__flag"><?php echo $date; ?></span>
                <?php elseif ($application_required) : ?>
                  <span class="card__flag">Apply Now</span>
                <?php endif; ?>
                <figcaption class="gallery__name"><?php the_title(); ?></figcaption>

                <?php if ($slider) : ?>
                  <?php $slide = array_shift($slider); ?>
                  <img src="<?php echo $slide['sizes']['slider_images']; ?>" alt="<?php echo $slide['alt']; ?>" class="gallery__img">
                <?php else : ?>
                  <img src="<?php echo $image[0]; ?>" alt="<?php echo $image['alt']; ?>" class="gallery__img">
                <?php endif; ?>
              </figure>
            </a>


        <?php $counter++;
          endwhile;

        endif;

        wp_reset_query();

        ?>

      </section>
    </div>

  </section>
<?php } ?>