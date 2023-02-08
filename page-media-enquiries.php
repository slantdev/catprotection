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
  <nav class="grid-container">
    <div class="grid-x">

      <?php
      wp_nav_menu(array(
        'menu'     => 'main-navigation',
        'sub_menu' => true,
        'menu_class' => 'sub-nav__items',
        'li_class'  => 'sub-nav__item',
        'a_class'  => 'sub-nav__link'
      ));
      ?>

    </div>
  </nav>
</section>

<section class="grid-container content contact-us">
  <div class="grid-x">
    <article class="cell large-10">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </article>
  </div>
</section>

<?php get_template_part('assets/inc/template-parts/popup'); ?>


<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>