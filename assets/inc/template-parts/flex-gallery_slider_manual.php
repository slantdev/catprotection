<?php
$gallery_items = get_sub_field('gallery_items');
?>
<section class="gallery">
  <div class="gallery__inner">
    <?php if(get_sub_field('title')): ?>
      <h2 class="gallery__heading text-center"><?php echo get_sub_field('title'); ?></h2>
    <?php endif; ?>
    <section class="slider-gallery">
      <?php
        $counter = 0;
        foreach ($gallery_items as $item): 
      ?>
        <?php 
          if ($counter % 8 == 0) :
            echo $counter > 0 ? "</div></article>" : ""; // close div if it's not the first
            echo "<article class='slider-gallery__item'><div class='grid-x small-up-2 large-up-4 gallery__items'>";
          endif;
        ?>
        <a href="<?php echo $item['image']['url']; ?>" class="cell gallery__item" data-fancybox>
          <figure class="gallery__figure">
            <figcaption class="gallery__name">View</figcaption>
            <img src="<?php echo $item['image']['sizes']['gallery_tiles']; ?>" alt="<?php echo $item['image']['alt']; ?>" class="gallery__img">
          </figure>
        </a>
      <?php 
        $counter++;
        endforeach;
      ?>
    </section>
  </div>
</section>

