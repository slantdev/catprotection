<section class="cards cards--download">
    <div class="grid-container">

        <div class="grid-x">
            <div class="cell">
				
                <h2 class="cards__title"><?php echo the_sub_field('just_for_fun_title'); ?></h2>

				<?php if( the_sub_field('just_for_fun_text') ): ?>
					<?php echo the_sub_field('just_for_fun_text'); ?>
				<?php endif; ?>	                
            </div>
        </div>        	

		<?php if( have_rows('just_for_fun_tile') ): ?>

	        <section class="grid-x grid-margin-x medium-up-3">

				<?php while( have_rows('just_for_fun_tile') ): the_row(); 

					$icon = get_sub_field('tile_icon');
		            $header = get_sub_field('tile_header');	
		            $link = get_sub_field('tile_link');
		            $linktext = get_sub_field('tile_link_text');

					?>       

                    <article class="cell cards__item">
					
						<div class="card card--download">
							<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" class="card__img">
							<div class="card__body">
								<h2 class="card__title"><?php echo $header; ?></h2>
								<a download target="_blank" href="<?php echo $link; ?>" class="card__button button button--download"><?php echo $linktext; ?></a>
							</div>
						</div>
					</article>

				<?php endwhile; ?>

			</section>

		<?php endif; ?>	        

    </div>
</section>