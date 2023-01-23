<?php get_header(); ?>

<section class="banner banner--interior">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
            if (has_post_thumbnail($post)) {
                $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner_interior'); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection"></figure>

            <?php
            } else {
                $backgroundImg = get_field('placeholder_image', 'options'); ?>

                <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>

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
                wp_nav_menu(array(
                  'menu'     => 'main-navigation',
                  'sub_menu' => true,
                  'menu_class' => 'cell auto sub-nav__items',
                  'li_class'  => 'sub-nav__item',
                  'a_class'  => 'sub-nav__link'
                ));
            ?>

            <form role="search" method="get" class="cell shrink search sub-nav__search woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" class="search__input" placeholder="<?php echo esc_attr_x('Search Products&hellip;', 'placeholder', 'woocommerce'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'woocommerce'); ?>" />
                <button type="submit" class="search__button">Search</button>
                <input type="hidden" name="post_type" value="product" />
            </form>

        </div>
    </nav>
</section>

<section class="grid-container content">
    <div class="grid-x">
        <article class="cell large-10">

            <?php the_field('intro_text'); ?>

        </article>
    </div>
</section>

<section class="shop-category">

    <article class="grid-container">
        <div class="grid-x grid-margin-x grid-margin-y small-up-2 large-up-4 gallery__items">

		<?php $terms = get_field('select_product_category');

        if ($terms): ?>

			<?php foreach ($terms as $term):
                $thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
                $size = 'gallery_tiles';
                $image = wp_get_attachment_image_src($thumbnail_id, $size);
            ?>

            <a href="<?php echo get_category_link($term); ?>" class="cell shop-category__item">
                <figure class="shop-category__figure">
                    <img src="<?php echo $image[0]; ?>" class="shop-category__img" alt="<?php echo $term->name; ?>">
                    <figcaption class="shop-category__name"><?php echo $term->name; ?></figcaption>
                </figure>
            </a>

			<?php endforeach; ?>

		<?php endif; ?>

        </div>
    </article>

</section>

<?php get_template_part('assets/inc/template-parts/popup'); ?>


<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>
