<?php
    $top_padding = get_sub_field('top_padding');
    $bottom_padding = get_sub_field('bottom_padding');
    $has_button = get_sub_field('add_a_button');
    $align = get_sub_field('alignment');
    $image = get_sub_field('image');
    $id = get_sub_field('anchor');
?>

<section id="<?php echo $id; ?>" class="grid-container content text-<?php echo $align; ?> <?php if ($top_padding == true): ?>content--padding-reduced-top <?php endif; ?> <?php if ($bottom_padding == true): ?>content--padding-reduced-bottom <?php endif; ?>">
    <div class="grid-x grid-margin-x align-middle">
        <?php if($image && $align != 'left'): ?>
            <figure class="cell <?php echo $align == 'right' ? 'large-shrink' : 'large-12'; ?>">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            </figure>
        <?php endif; ?>
        <article class="cell large-auto text-<?php echo $align; ?>">

			<?php the_sub_field('text'); ?>

			<?php if ($has_button): ?>
			<?php if (have_rows('create_button')): ?>
                <div class="button-group align-<?php echo $align; ?>">

				<?php while (have_rows('create_button')): the_row();

                    $internallink = get_sub_field('page_link');
                    $externallink = get_sub_field('external_link');
                    $email_link = get_sub_field('email_link');
                    $anchor_link = get_sub_field('anchor_link');
                    $linktype = get_sub_field('internal_or_external_link');
                    $link_text = get_sub_field('button_text');
                    $class = "";
                    ?>
                    <?php
                    if ($linktype['value'] == 'external') {
                        $link_url = $externallink;
                        $link_external = ' target="_blank"';
                    } else {
                        $link_url = $internallink;
                        $link_external = '';
                    }
                    if ($linktype['value'] == 'email') {
                        $link_url = 'mailto:'.$email_link;
                    }
                    if ($linktype['value'] == 'anchor') {
                        $link_url = '#'.$anchor_link;
                        $class = "anchor";
                    }
                    ?>
                    <a href="<?php echo $link_url; ?>" class="button button-group__button <?php echo $class; ?>"<?php echo $link_external; ?>><?php echo $link_text; ?></a>

				<?php endwhile; ?>

				</div>

			<?php endif; ?>
			<?php endif; ?>
        </article>
        <?php if($image && $align == 'left'): ?>
            <figure class="cell large-shrink">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            </figure>
        <?php endif; ?>
    </div>
</section>
