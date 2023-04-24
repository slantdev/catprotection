<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<section class="banner banner--interior">

  <?php

  $term = get_queried_object();
  $image = get_field('banner', $term);
  $shopimage = get_field('shop_banner', 'options');
  $backgroundImg = get_field('placeholder_image', 'options');

  if (is_shop()) {
    if ($shopimage) { ?>
      <figure class="banner__img"><img src="<?php echo $shopimage['sizes']['banner_interior']; ?>" alt="<?php echo $image['alt']; ?>"></figure>

    <?php } else { ?>
      <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>
    <?php }
  } elseif (is_product_category()) {
    if ($image) { ?>
      <figure class="banner__img"><img src="<?php echo $image['sizes']['banner_interior']; ?>" alt="<?php echo $image['alt']; ?>"></figure>

    <?php } else { ?>
      <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>
  <?php }
  }
  ?>

</section>

<section class="sub-nav">
  <nav class="grid-container">
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

<section class="grid-container content content--shop topsectionheader container mx-auto px-4 lg:px-6 xl:px-[1.875rem] max-w-[76.25rem]">
  <div class="flex flex-col md:flex-row md:justify-between">
    <div class="w-full md:w-2/3">
      <h1 class="woocommerce-products-header__title page-title mb-4"><?php woocommerce_page_title(); ?></h1>
      <?php if (is_shop()) { ?>
        <div class="prose text-gray-500 max-w-screen-md">
          <?php the_field('intro_text', 'options'); ?>
        </div>
      <?php } ?>

      <?php if (is_product_category()) {
        $term_object = get_queried_object();
        //preint_r($term_object);
        if (category_description()) { ?>
          <div class="prose text-gray-500 max-w-screen-md"><?php echo $term_object->description; ?></div>
        <?php } ?>
      <?php } ?>
    </div>
    <!-- <div>
      <div class="sorting mt-4 md:mt-0"></div>
    </div> -->
  </div>
</section>

<section class="shop-products">
  <?php if (is_shop()) : ?>
    <article class="grid-container container mx-auto px-2 lg:px-6 xl:px-[1.875rem] max-w-[76.25rem]">
      <?php echo do_shortcode('[products paginate="true" limit="16"]') ?>
    </article>
  <?php else : ?>
    <article class="grid-container container mx-auto px-2 lg:px-6 xl:px-[1.875rem] max-w-[76.25rem]">
      <?php
      if (woocommerce_product_loop()) {

        /**
         * Hook: woocommerce_before_shop_loop.
         *
         * @hooked woocommerce_output_all_notices - 10
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        do_action('woocommerce_before_shop_loop');

        woocommerce_product_loop_start();

        if (wc_get_loop_prop('total')) {
          while (have_posts()) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             *
             * @hooked WC_Structured_Data::generate_product_data() - 10
             */
            do_action('woocommerce_shop_loop');

            wc_get_template_part('content', 'product');
          }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');
      } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action('woocommerce_no_products_found');
      }

      /**
       * Hook: woocommerce_after_main_content.
       *
       * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
       */
      do_action('woocommerce_after_main_content');
      ?>
    </article>
  <?php endif; ?>
</section>

<?php get_template_part('assets/inc/template-parts/popup'); ?>


<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>

<script>
  jQuery(document).ready(function($) {
    $('.shop-parent-nav').addClass('current-menu-item');
  });
</script>


<?php get_footer('shop');
