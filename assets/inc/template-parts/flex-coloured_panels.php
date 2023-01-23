<?php
	global $post;
	$coloured_panels_title = get_sub_field('coloured_panels_title');
	$coloured_panels_text = get_sub_field('coloured_panels_text');
	$coloured_panels_align = get_sub_field('coloured_panels_text_alignment');
?>


<section class="cards cards--coloured-panels">
    <div class="grid-container">

        <div class="grid-x">
            <div class="cell" style="text-align: <?php echo $coloured_panels_align; ?>">
				<h2 class="cards__title"><?php echo $coloured_panels_title; ?></h2>
				<?php if( $coloured_panels_text ): ?>
					<?php echo $coloured_panels_text; ?>
				<?php endif; ?>
            </div>
        </div>

        <?php $count = 0; while(have_rows('coloured_panels_tile')) : the_row(); $count++; endwhile; ?>
        <?php if( $count ) : ?>
        <section class="grid-x grid-margin-x medium-up-<?php echo ($count % 3 == 0) ? '3': '2'; ?>">

				<?php $index = 0; while( have_rows('coloured_panels_tile') ): the_row(); $index++;

		            $scheme = get_sub_field('coloured_panel_scheme');
					$title = get_sub_field('coloured_panel_title');
		            $text = get_sub_field('coloured_panel_text');
		            $link = get_sub_field('coloured_panel_link');
					$linkAsButton = get_sub_field('coloured_panel_link_as_button');
		            $image = get_sub_field('coloured_panel_image');

					?>

                    <article class="cell cards__item">
						<?php if( $link && !$linkAsButton ): ?>
							<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="card <?php if ($scheme && $scheme != 'none' ) { echo $scheme; } else { echo ' card--coloured-panels'; } ?>">
						<?php else: ?>
							<div class="card <?php if ($scheme && $scheme != 'none' ) { echo $scheme; } else { echo 'card--coloured-panels'; } ?>">
						<?php endif; ?>

							<h2 class="card__title"><?php echo $title; ?></h2>
							<?php if( $text ): ?>
								<div class="card__desc">
									<?php echo $text; ?>
								</div>
							<?php endif; ?>
							<?php if( $image ): ?>
								<div class="card__award-badge">
									<img src="<?php echo $image['url']; ?>"/>
								</div>
							<?php endif; ?>
							<?php if( $link && $linkAsButton ): ?>
								<div class="card__footer">
									<?php if($index == 1 && $post->ID == 42541): ?>
										<select id="donate-select" style="width: 234px; color: #000040;">
											<option value="">Donate to...</option>
											<option value="https://www.catprotection.com.au/meowrychristmastoby/">a kitten like Toby</option>
											<option value="https://www.catprotection.com.au/meowrychristmasharry/">an adult cat like Harry</option>
											<option value="https://www.catprotection.com.au/meowrychristmasagatha/">a senior cat like Agatha</option>
										</select>
										<script>
										jQuery(document).ready(function() {
											var select = jQuery('#donate-select');
											if(select.length) {
												var button = select.closest('.card').find('.button');
												button.on('click', function(event){
													event.preventDefault();
													if(select.val()) {
														window.location = select.val();
													}
												});
											}
										});
										</script>
									<?php endif; ?>
									<a href="<?php echo $link['url']; ?>" class="button card__button"><?php echo $link['title']; ?></a>
								</div><?php 
							endif; ?>

						<?php if( $link && !$linkAsButton ): ?>
							</a>
						<?php else: ?>
							</div>
						<?php endif; ?>

					</article>

				<?php endwhile; ?>

			</section>

		<?php endif; ?>

    </div>
</section>
