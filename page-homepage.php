<?php get_header(); ?>

<section class="banner banner--home">

    <?php
        $hero_img = get_field('hero_fallback_image');
        $hero_vid_mp4 = get_field('video_background_-_mp4');
        $hero_vid_webm = get_field('video_background_-_webm');
        $hero_vid_ogv = get_field('video_background_-_ogv');
    ?>

    <figure class="banner__img">
        <img src="<?php echo $hero_img['url']; ?>" data-object-fit="cover" alt="">
        <video playsinline autoplay muted loop id="bg-video" data-object-fit="cover" width="100%">
            <source src="<?php echo $hero_vid_mp4['url']; ?>" />
            <source src="<?php echo $hero_vid_webm['url']; ?>" />
            <source src="<?php echo $hero_vid_ogv['url']; ?>" />
        </video>
    </figure>

    <div class="text-center banner__content">
        <section class="slider-banner">

            <?php

            // check if the repeater field has rows of data
            if (have_rows('hero_slides')):

                // loop through the rows of data
                while (have_rows('hero_slides')) : the_row();

                    // vars
                    $header = get_sub_field('slide_header');
                    $text = get_sub_field('slide_text');
                    $button_text = get_sub_field('button_text');
                    $button_type = get_sub_field('button_type');
                    $button_link = get_permalink(get_sub_field('button_link'));
                    $button_video_link = get_sub_field('button_video_link');
                ?>
                    <article class="slider-banner__item">
                        <h1 class="slider-banner__heading"><?php echo $header; ?></h1>
                        <p class="slider-banner__desc"><?php echo $text; ?></p>

                        <?php if (get_sub_field('display_button')): ?>
                            <?php if ($button_type['value'] == 'contentlink'): ?>
                                <a href="<?php echo $button_link; ?>" class="button slider-banner__button">
                                    <?php echo $button_text; ?>
                                </a>
                            <?php elseif ($button_type['value'] == 'video'): ?>
                               <a data-fancybox href="<?php echo $button_video_link; ?>" class="button slider-banner__button">
                                    <?php echo $button_text; ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </article>

                <?php endwhile;

            else :

                // no rows found

            endif;

            ?>

        </section>
    </div>

</section>

<?php
    if (have_rows('content_block')): ?>

        <?php while (have_rows('content_block')): the_row();
            get_template_part('assets/inc/template-parts/flex-' . get_row_layout());
        endwhile; ?>

    <?php endif;
?>

<?php get_template_part('assets/inc/template-parts/popup'); ?>

<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>
