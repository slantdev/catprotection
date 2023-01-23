<section class="cards cards--donate">
    <div class="grid-container">

        <div class="grid-x">
            <div class="cell">
				<h2 class="cards__title"><?php echo the_sub_field('donate_title'); ?></h2>

				<?php if( the_sub_field('donate_text') ): ?>
					<?php echo the_sub_field('donate_text'); ?>
				<?php endif; ?>	                
            </div>
        </div>        	

		<?php if( have_rows('donation_tile') ): ?>

	        <section class="grid-x grid-margin-x medium-up-3">

				<?php while( have_rows('donation_tile') ): the_row(); 

		            $amount = get_sub_field('donation_amount');	
		            $text = get_sub_field('donation_text');	
		            $link = get_sub_field('donation_link');

					?>       

                    <article class="cell cards__item">

						<a href="<?php echo $link; ?>" class="card card--donate">
							<h2 class="card__amount">$<?php echo $amount; ?></h2>
							<div class="card__desc"><?php echo $text; ?></div>
						</a>

					</article>

				<?php endwhile; ?>

			</section>

		<?php endif; ?>	        

    </div>
</section>