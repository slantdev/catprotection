<section class="fw_banner">
    <blockquote class="fw_banner__inner">
        <?php 
            $banner_text = get_sub_field('banner_text');
            $banner_link = get_sub_field('banner_link');
            $banner_link_text = get_sub_field('banner_link_text');
            $img = get_sub_field('image'); 
        ?>

        <p><?php echo $banner_text; ?></p>

        <?php if ($banner_link): ?>
            <a href="<?php echo $banner_link['url']; ?>" class="button"><?php echo $banner_link_text; ?></a>
        <?php endif; ?>

    </blockquote>
    <figure class="fw_banner__img"><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"></figure>
</section>