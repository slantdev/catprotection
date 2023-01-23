<?php
    $top_padding = get_sub_field('top_padding');
    $bottom_padding = get_sub_field('bottom_padding');
    $heading = get_sub_field('heading');
    $q_a_markers = get_sub_field('q_a_markers');
?>
<section class="grid-container content <?php if ($top_padding == true): ?>content--padding-reduced-top <?php endif; ?> <?php if ($bottom_padding == true): ?>content--padding-reduced-bottom <?php endif; ?>">
    <div class="grid-x">
        <article class="cell large-10">

            <h1><?php echo $heading; ?></h1>

        </article>
    </div>
</section>

<section class="grid-container">
    <div class="grid-x">
        <article class="cell">

                <?php if (have_rows('accordion')): $counter = 0 ?>

                    <ul class="accordion<?php if ($q_a_markers == true) { ?> accordion--nomarkers<?php } ?>" data-accordion data-multi-expand="true" data-allow-all-closed="true">

                    <?php while (have_rows('accordion')): the_row();

                        $title = get_sub_field('title');
                        $description = get_sub_field('description');

                        ?>

                        <li class="accordion__item" data-accordion-item>
                            <a href="#" class="accordion__title">
                                <?php echo $title; ?>
                            </a>
                            <div class="accordion__content" data-tab-content>
                                <?php echo $description; ?>
                            </div>
                        </li>

                    <?php $counter++; endwhile; ?>

                    </ul>

                <?php endif; ?>

        </article>
    </div>
</section>