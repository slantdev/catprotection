<?php get_header(); ?>
<?php
$image_post = false;
$status = get_field('cat_status');

if ('found' == $status['value']) {
    $image_post =    get_page_by_path('adoption/found-cats');
} elseif ('lost' ==  $status['value']) {
    $image_post =    get_page_by_path('adoption/lost-cats');
} else {
    $image_post =    get_page_by_path('adoption/cats-for-adoption');
}
?>
<section class="banner banner--interior">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
            if (has_post_thumbnail($image_post)) {
                $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($image_post->ID), 'banner_interior'); ?>

                <figure class="banner__img 1" ><img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection"></figure>

            <?php
            } else {
                $backgroundImg = get_field('placeholder_image', 'options'); ?>
                <figure class="banner__img <?php echo $status['value']; ?>"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>

            <?php
            }
        ?>

    <?php endwhile;
    endif; ?>
</section>

<section class="sub-nav">
    <nav class="grid-container">
        <div class="grid-x">

            <?php
            wp_nav_menu(
        array(
                    'theme_location' => 'adopt-secondary-navigation',
                    'menu'           => '',
                    'menu_class'     => 'sub-nav__items',
                    'orderby'        => 'menu_order',
                    'container' => false,
                    'li_class'  => 'sub-nav__item',
                    'a_class'  => 'sub-nav__link'
                )
    );
            ?>

        </div>
    </nav>
</section>

<section class="grid-container content content--padding-reduced-bottom">
    <div class="grid-x">
        <article class="cell large-10">
            <?php
                if ('found' == $status['value']) {
                    the_field('cats_for_found_text', 'options');
                } elseif ('lost' ==  $status['value']) {
                    the_field('cats_for_lost_text', 'options');
                } elseif ('adopted' ==  $status['value']) {
                    the_field('cats_for_adopted_text', 'options');
                } else {
                    the_field('cats_for_adoption_text', 'options');
                }
            ?>
            <?php  ?>
        </article>
    </div>
</section>

<div class="two-col two-col--alt">

    <?php
                $id = get_field('id');
                $gender = get_field('gender');
                $breed = get_field('breed');
                $age = get_field('age');
                $catdescription = get_field('cat_description');
                $status = get_field('cat_status');
                $application_required = get_field('application_required');
                $slider = get_field('cat_gallery');
                $dab_number = get_field('dab_number');
                $microchip_number = get_field('microchip_number');
                $has_friend = get_field('has_friend');
                $address = clean_google_address(get_field('location'));
                $impounded = get_field('impounded');
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gallery_tiles');
            ?>

            <section class="two-col-gallery">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">

                        <article class="cell medium-5">

                            <?php if ($slider): ?>
                               <div class="slider-col-gallery">
                                    <?php foreach ($slider as $slide): ?>
                                        <div class="slider-col-gallery__item">
                                            <img src="<?php echo $slide['url']; ?>" alt="<?php echo $slide['alt']; ?>" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <figure class="two-col__img"><img src="<?php echo $image[0]; ?>" alt="<?php echo $image['alt']; ?>"></figure>
                            <?php endif; ?>

                        </article>

                        <article class="cell medium-6 medium-offset-1 align-self-middle">

                            <h2><?php the_title(); ?></h2>

                            <table class="id-table">
                                <?php if ($id): ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">ID:</strong></td>
                                    <td class="id-table__cell"><?php echo $id; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if ($gender): ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Gender:</strong></td>
                                    <td class="id-table__cell"><?php echo $gender; ?></td>
                                </tr>
                                <?php endif; ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Breed:</strong></td>
                                    <td class="id-table__cell"><?php echo $breed['label']; ?></td>
                                </tr>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Age:</strong></td>
                                    <td class="id-table__cell"><?php echo $age['label']; ?></td>
                                </tr>
                                <?php if ($dab_number): ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Source No:</strong></td>
                                    <td class="id-table__cell"><?php echo $dab_number; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if ($microchip_number): ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Microchip No:</strong></td>
                                    <td class="id-table__cell"><?php echo $microchip_number; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if ($address && strlen($address['suburb']) > 2): ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Suburb:</strong></td>
                                    <td class="id-table__cell"><?php echo $address['suburb']; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if ($impounded): ?>
                                <tr class="id-table__row">
                                    <td class="id-table__cell"><strong class="id-table__heading">Impounded:</strong></td>
                                    <td class="id-table__cell"><?php echo $impounded; ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>

                            <?php if ($has_friend): ?>
                                <p class="has-friend">Please note: I come with a friend</p>
                            <?php endif; ?>

                            <p><?php echo $catdescription; ?></p>

                            <?php if ($application_required) : ?>
                            <a class="button two-col-gallery__button" href="/adoption/adoption-online/?cat=<?php echo $post->ID; ?>" target="_blank">Submit an Adoption Application</a>
                            <?php elseif('notadopted' == $status['value']): ?>
                            <a class="button two-col-gallery__button" href="/adoption/adoption-online/ " target="_blank">Submit an Adoption Application</a>
                            <?php endif; ?>

                        </article>

                    </div>


                </div>
            </section>

</div>
<?php if (!get_field('looking_to_adopt_hide_from_site', 'options')) { ?>
<section class="gallery">
    <div class="gallery__inner">
        <h2 class="gallery__heading text-center"><?php echo the_field('looking_to_adopt_header', 'options'); ?></h2>

        <section class="slider-gallery">

                <?php

                    $args = array( 'post_type' => 'cats', 'posts_per_page' => -1,'post_status'    => 'publish',
                    'meta_query' => array( array(
                        'key' => 'cat_status',
                        'value' => array('notadopted','adopted'),
                        'compare'	=> 'IN'
                    )));

                    $loop = new WP_Query($args);

                    if ($loop->have_posts()) :

                        $counter = 0;

                        while ($loop->have_posts()) : $loop->the_post(); ?>

                            <?php
                                    $status = get_field('cat_status');
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gallery_tiles');
                                    $slider = get_field('cat_gallery');
                                ?>

                                <?php if ($counter % 8 == 0) :
                                    echo $counter > 0 ? "</div></article>" : ""; // close div if it's not the first
                                    echo "<article class='slider-gallery__item'><div class='grid-x small-up-2 large-up-4 gallery__items'>";
                                endif;
                                ?>
                                <a href="<?php the_permalink(); ?>" class="cell gallery__item">
                                    <figure class="gallery__figure">
                                        <?php if ($status['value'] == 'adopted'): ?>
                                            <span class="card__flag"><?php echo $status['label']; ?></span>
                                        <?php endif; ?>
                                        <figcaption class="gallery__name"><?php the_title(); ?></figcaption>

                                        <?php if (isset($slider[0]['url'])) : ?>
                                            <?php $slide = array_shift($slider); ?>
                                            <img src="<?php echo $slide['sizes']['slider_images']; ?>" alt="<?php echo $slide['alt']; ?>" class="gallery__img">
                                        <?php else : ?>
                                            <img src="<?php echo $image[0]; ?>" alt="<?php echo $image['alt']; ?>" class="gallery__img">
                                        <?php endif; ?>
                                    </figure>
                                </a>


                        <?php $counter++; endwhile;

                    endif;

                    wp_reset_query();

                ?>

        </section>
    </div>

</section>
<?php } ?>
<?php get_template_part('assets/inc/template-parts/popup'); ?>

<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>