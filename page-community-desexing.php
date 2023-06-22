<?php get_header(); ?>

<?php $page_options = get_field('page_options'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    if (has_post_thumbnail($post)) {
      $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner_interior');
    } else {
      $backgroundImg = get_field('placeholder_image', 'options');
    }
    ?>
    <section class="relative bg-cover xl:min-h-[500px] mt-0 lg:mt-[100px] xl:mt-[6.25rem] bg-[15%_top] md:bg-[left_top] lg:bg-[center_center]" style="background-image: url(<?php echo $backgroundImg[0]; ?>)">
      <div class="container mx-auto">
        <div class="w-full flex justify-end items-center">
          <div class="w-full lg:w-1/2 text-white px-4 pt-72 pb-8 lg:py-32 xl:py-36 xl:pl-24 xl:pr-24">
            <h2 class="text-white text-3xl lg:text-4xl xl:text-5xl tracking-normal mb-4 xl:mb-8">Did You Know?</h2>
            <h3 class="text-white normal-case text-xl xl:text-3xl tracking-normal">Desexed cats</h3>
            <div class="prose text-lg xl:text-[22px] text-white marker:text-white">
              <ul class="ml-0 pl-6">
                <li>Are generally healthier and live longer, happier lives.</li>
                <li>Are less likely to roam & be injured.</li>
                <li>Help prevent unwanted litters.</li>
                <li>Help reduce territorial behaviours.</li>
              </ul>
              <p class="text-lg xl:text-[22px] leading-normal font-semibold">And that one single unspayed or un-desexed female cat and her offspring can produce more than 400,000 cats in their lifetime?</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="py-12">
      <div class="container mx-auto max-w-[76.25rem] px-4">
        <div class="prose prose-2xl max-w-none text-left md:text-center mx-auto">
          <h1 class="text-3xl xl:text-4xl font-normal text-[#2e2356] tracking-wider">The Cat Protection Society offer a Community Desexing and Last Litter Program.</h1>
          <p class="text-[#2e2356] text-lg xl:text-xl leading-normal">With the goal of helping to reduce cat overpopulation and the associated environmental and societal issues, whilst ensuring that every cat has the opportunity for a healthy, loving, and safe home, The Cat Protection Society offer a <strong>Community Desexing</strong> and <strong>Last Litter Program.</strong></p>
          <p class="text-lg xl:text-xl text-[#6B7D82] tracking-[-0.015em]">Our <strong class="text-[#6B7D82]">Community Desexing Program</strong> is available to cat owners in financial need who would like to desex their female or male cat.</p>
          <p class="text-lg xl:text-xl text-[#6B7D82] tracking-[-0.02em]">Our <strong class="text-[#6B7D82]">Last Litter Program</strong> is available to cat owners with a pregnant mother cat or cat who has recently given birth to a litter of kittens.</p>
        </div>
      </div>
    </section>
    <section class="pb-16 lg:pb-24">
      <div class="container mx-auto max-w-[76.25rem] px-4">
        <h2 class="text-3xl text-left md:text-center font-normal text-[#2e2356] tracking-wider mb-4">Please select from the following:</h2>
        <div class="grid grid-cols-1 gap-y-2 md:grid-cols-3">
          <div class="relative min-h-[360px] xl:min-h-[500px]">
            <img src="/wp-content/uploads/2023/06/male-cat.jpeg" alt="" class="object-cover h-full w-full">
            <div class="absolute w-full inset-0 bg-gradient-to-t from-black/80 to-transparent via-black/20 flex items-end">
              <div class="p-5 text-center w-full">
                <h2 class="text-white normal-case tracking-wide mb-4 text-2xl md:text-xl lg:text-2xl leading-tight">I have a male cat</h2>
                <div>
                  <a class="button mb-0" href="https://catprotection.com.au/fundeddesexing/">Select</a>
                </div>
              </div>
            </div>
          </div>
          <div class="relative min-h-[360px] xl:min-h-[500px]">
            <img src="/wp-content/uploads/2023/06/female-cat.jpeg" alt="" class="object-cover h-full w-full">
            <div class="absolute w-full inset-0 bg-gradient-to-t from-black/80 to-transparent via-black/20 flex items-end">
              <div class="p-5 text-center w-full">
                <h2 class="text-white normal-case tracking-wide mb-4 text-2xl md:text-xl lg:text-2xl leading-tight">I have a female cat who is not pregnant</h2>
                <div>
                  <a class="button mb-0" href="https://catprotection.com.au/fundeddesexing/">Select</a>
                </div>
              </div>
            </div>
          </div>
          <div class="relative min-h-[360px] xl:min-h-[500px]">
            <img src="/wp-content/uploads/2023/06/pregnant-cat4-1.jpeg" alt="" class="object-cover h-full w-full">
            <div class="absolute w-full inset-0 bg-gradient-to-t from-black/80 to-transparent via-black/20 flex items-end">
              <div class="p-6 text-center w-full">
                <h2 class="text-white normal-case tracking-wide mb-4 text-2xl md:text-xl lg:text-2xl leading-tight">I have a female cat who is pregnant or who has recently given birth to a litter of kittens</h2>
                <div>
                  <a class="button mb-0" href="https://catprotection.com.au/vet-clinic/last-litter/">Select</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endwhile;
endif; ?>

<?php get_template_part('assets/inc/template-parts/popup'); ?>

<?php get_template_part('assets/inc/template-parts/footer-nav'); ?>


<?php get_footer(); ?>