<section class="quote">
    <blockquote class="quote__inner">
        <?php 
            $quote = get_sub_field('quote');
            $author_name = get_sub_field('author_name');
            $author_title = get_sub_field('author_title');
            $img = get_sub_field('image'); 
        ?>
        <q><?php echo $quote; ?></q>
        <footer class="quote__author">
            <small class="quote__author--name"><?php echo $author_name; ?></small>
            <small class="quote__author--title"><?php echo $author_title; ?></small>
        </footer>
    </blockquote>
    <figure class="quote__img"><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"></figure>
</section>