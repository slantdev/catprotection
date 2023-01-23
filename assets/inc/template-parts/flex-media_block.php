<section class="grid-container video-content">
    <div class="grid-x">
        <article class="cell large-10">

        	<?php $mediatype = get_sub_field('media_type'); ?>
            
			<?php if( $mediatype['value'] == 'video' ):
		        $placeholder = get_sub_field('video_placeholder_image');
		        $youtube_id = get_sub_field('youtube_video_id');		        
			?>

				<div class="embed-container">
                    <?php if ( ! empty( $youtube_id ) ) { ?>

			            <figure class="video-in-page">
			                <a href="" class="video-in-page__button">play</a>                        
                        	<img src="<?php echo $placeholder['sizes']['hd']; ?>" data-video="https://www.youtube.com/embed/<?php echo $youtube_id; ?>?autoplay=1" data-object-fit="cover" />
                        </figure>
                        <div class="videoembed"></div>
                    <?php } else { ?>
                        <img class="placeholder" src="<?php echo $placeholder['sizes']['hd']; ?>" data-object-fit="cover" />
                    <?php } ?>						
				</div>

			<?php elseif( $mediatype['value'] == 'image' ):
		        $image = get_sub_field('image');			
		    ?>

			    <figure class="inline-image">
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="video-in-page__thumbnail-img">
			    </figure>
			<?php endif; ?>
           
        </article>
    </div>
</section>