<?php
	$inline_cta_title = get_sub_field('inline_cta_title');
	$inline_cta_button_text = get_sub_field('inline_cta_button_text');
	$inline_cta_button_link = get_sub_field('inline_cta_button_link');
?>

<section class="inline-cta">
    <div class="grid-container">
        <div class="grid-x">
            <div class="cell">
				<?php if( $inline_cta_title ): ?>
					<p class="inline-cta__title"><?php echo $inline_cta_title; ?></p>
				<?php endif; ?>	
				<?php if( $inline_cta_button_link ): ?>
					<a href="<?php echo $inline_cta_button_link['url']; ?>" target="<?php echo $inline_cta_button_link['target']; ?>" class="button inline-cta__button"><?php echo $inline_cta_button_text; ?></a>
				<?php endif; ?>	                        
            </div>
        </div>        	        
    </div>
</section>