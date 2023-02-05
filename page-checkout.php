<?php get_header(); ?>

<section class="banner banner--interior">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php
      if (has_post_thumbnail($post)) {
        $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner_interior'); ?>

        <figure class="banner__img"><img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection"></figure>

      <?php } else {
        $backgroundImg = get_field('placeholder_image', 'options'); ?>

        <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>

      <?php }
      ?>

  <?php endwhile;
  endif; ?>
</section>

<section class="sub-nav">
  <nav class="grid-container container mx-auto px-4 lg:px-6 xl:px-[1.875rem] max-w-[76.25rem]">
    <div class="grid-x">

      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'shop-secondary-navigation',
          'menu'           => '',
          'orderby'        => 'menu_order',
          'container' => false,
          'menu_class' => 'cell auto sub-nav__items',
          'li_class'  => 'sub-nav__item',
          'a_class'  => 'sub-nav__link'
        )
      );
      ?>

      <form role="search" method="get" class="cell shrink search sub-nav__search woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="text" class="search__input" placeholder="<?php echo esc_attr_x('Search Products&hellip;', 'placeholder', 'woocommerce'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'woocommerce'); ?>" />
        <button type="submit" class="search__button">Search</button>
        <input type="hidden" name="post_type" value="product" />
      </form>

    </div>
  </nav>
</section>

<section class="shop shop-cart">

  <article class="grid-container container mx-auto px-4 lg:px-6 xl:px-[1.875rem] max-w-[76.25rem]">
    <section class="grid-x">
      <article class="cell">

        <?php echo do_shortcode('[woocommerce_checkout]'); ?>

      </article>
    </section>
  </article>

</section>

<?php get_template_part('assets/inc/template-parts/popup'); ?>

<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>