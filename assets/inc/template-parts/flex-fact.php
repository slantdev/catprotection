<section class="fact">
    <blockquote class="fact__inner">
        <?php 
            $fact = get_sub_field('fact');
            $btn_text = get_sub_field('btn_text');
            $btn_link = get_sub_field('btn_link');
            $img = get_sub_field('image'); 
        ?>
        
        <?php echo $fact; ?>
        <p></p>

        <footer>
            <a href="<?php echo $btn_link; ?>" class="button fact__button"><?php echo $btn_text; ?></a>
        </footer>
    </blockquote>
    <figure class="fact__img"><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"></figure>
</section>