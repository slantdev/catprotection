<?php get_header(); ?>

<?php $is_donation = get_field('use_salesforce_form'); ?>
<?php $is_membership = get_field('use_salesforce_membership_form'); ?>
<?php $mobile_hero = get_field('mobile_hero_background'); ?>
<?php $page_options = get_field('page_options'); ?>

<section class="banner banner--interior<?php echo ($is_donation) ? ' donations-banner' : ''; ?>">

    <?php if($mobile_hero) : ?>
    <figure class="banner__img mobile">
        <?php echo $page_options['header_link'] ? '<a href="'.$page_options['header_link'].'">' : null; ?>
        <img src="<?php echo $mobile_hero['sizes']['banner_interior_mobile']; ?>" alt="Cat Protection">
        <?php echo $page_options['header_link'] ? '</a>' : null; ?>
    </figure>
    <?php endif; ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
            if (has_post_thumbnail($post)) {
                $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner_interior'); ?>

                <figure class="banner__img">
                    <?php echo $page_options['header_link'] ? '<a href="'.$page_options['header_link'].'">' : null; ?>
                    <img src="<?php echo $backgroundImg[0]; ?>" alt="Cat Protection">
                    <?php echo $page_options['header_link'] ? '</a>' : null; ?>
                </figure>

            <?php
            } else {
                $backgroundImg = get_field('placeholder_image', 'options'); ?>

                <figure class="banner__img">
                    <?php echo $page_options['header_link'] ? '<a href="'.$page_options['header_link'].'">' : null; ?>
                    <img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection">
                    <?php echo $page_options['header_link'] ? '</a>' : null; ?>
                </figure>

            <?php
            }
        ?>

    <?php endwhile; endif; ?>

    <?php if($is_donation): ?>
        <?php if($is_membership): ?>
              <?php // get_template_part('assets/inc/template-parts/tp-salesforce_membership_form'); ?>
        <?php else: ?>
              <?php set_query_var('form_id', get_field('salesforce_form_id')); ?>
              <?php get_template_part('assets/inc/template-parts/tp-salesforce_form'); ?>
        <?php endif; ?>
    <?php endif; ?>

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

<?php if (have_rows('content_block')): ?>

        <?php while (have_rows('content_block')): the_row(); ?>
            <?php if(get_sub_field('anchor')): ?>
                <?php get_template_part('assets/inc/template-parts/flex-anchor'); ?>
            <?php endif; ?>

            <?php get_template_part('assets/inc/template-parts/flex-' . get_row_layout()); ?>

        <?php endwhile; ?>

<?php endif; ?>
<?php if($is_donation): ?>
    <?php if($is_membership): ?>
            <?php get_template_part('assets/inc/template-parts/tp-salesforce_membership_form'); ?>
    <?php endif; ?>
<?php endif; ?>
<?php if($is_donation): ?>
<?php
    $button_link = get_field('button_link');
    $button_text = get_field('button_text');
    $deposit_details = get_field('deposit_details');
    $payment_details = get_field('payment_details');
    $contact_details = get_field('contact_details');
    $donate_title = get_field('donate_online_title');
    $mail_title = get_field('donate_mail_title');
    $phone_title = get_field('donate_phone_title');

?>
<section class="donations">
    <div class="donations__inner">
        <div class="grid-container">

            <div class="grid-x">
                <div class="cell">
                    <h2 class="cards__title text-center">Donation Options</h2>
                </div>
            </div>

            <section class="grid-x grid-margin-x large-up-3">

                <article class="cell cards__item">
                    <div class="card card--news">
                        <h3><?php echo $donate_title; ?></h3>

                        <div class="button-group">
                            <a href="<?php echo $button_link; ?>" class="button button-group__button anchor"><?php echo $button_text; ?></a>
                        </div>
                        <?php echo $payment_details; ?>

                    </div>
                </article>

                <article class="cell cards__item">
                    <div class="card card--news">
                        <h3><?php echo $mail_title; ?></h3>

                        <?php echo $deposit_details; ?>
                    </div>
                </article>

                <article class="cell cards__item">
                    <div class="card card--news">
                        <h3><?php echo $phone_title; ?></h3>

                        <?php echo $contact_details; ?>
                    </div>
                </article>

            </section>

        </div>
    </div>
</section>
<?php endif; ?>

<?php get_template_part('assets/inc/template-parts/popup'); ?>

<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>
