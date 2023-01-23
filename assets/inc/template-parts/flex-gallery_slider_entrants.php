<section class="gallery-entrant">
    <div class="gallery-entrant__inner">
        <h2 class="gallery-entrant__heading text-center">Entrants Gallery</h2>

        <section class="cards">
          <div class="grid-container">
            <article class="grid-x grid-margin-x medium-up-2">
            </article>
          </div>
        </section>

        <?php //if( $counter >= $posts_per_page ):?>
        <div class="text-center"><a href="#" id="load-more" class="button gallery-entrant__button">Load More</a></div>
      <?php //endif;?>
    </div>



<script>
    var urlAJAX = '<?php echo admin_url('admin-ajax.php'); ?>';
    var page = 1;

    jQuery(document).ready(function($){

        loadMoreCats(page++);

        jQuery(document).on( 'click', 'a#load-more', function (e) {
            e.preventDefault();

            loadMoreCats(page++);
        });
    });

    function loadMoreCats(page){
        jQuery.ajax({
          type: "GET",
          url: '<?php echo admin_url('admin-ajax.php'); ?>',
          data: {
            page : page,
            action: 'load_more_cats'
          },
          dataType: 'json',
          success: function( data ) {
            for (i = 0; i < data.posts.length; i++) {
              var post = data.posts[i];

              jQuery('.gallery-entrant article').append('<div class="cell cards__item"><div class="card card--entrant"></div></div>');

              jQuery('.gallery-entrant article .cards__item:last-child .card--entrant').append('<div class="card__share share"></div>');
              jQuery('.gallery-entrant article .cards__item:last-child .card__share').append('<a href="https://www.facebook.com/sharer/sharer.php?u='+post.permalink+'" target="_blank" class="share__icon share__icon--facebook" onclick=\'FB.AppEvents.logEvent("entrantShared")\'>Facebook</a>');
              jQuery('.gallery-entrant article .cards__item:last-child .card__share').append('<a href="'+post.permalink+'" class="share__icon share__icon--email share-email">Email</a>');

              jQuery('.gallery-entrant article .cards__item:last-child .card--entrant').append('<div class="card__flag" id="vote-count-'+post.postID+'">'+post.votes+' Vote</div>');
              if( parseInt( post.votes ) != 1){
                jQuery('#vote-count-'+post.postID).append('s');
              }

              if(post.images.length > 0){
                jQuery('.gallery-entrant article .cards__item:last-child .card--entrant').append('<div class="slider-card-gallery"></div>');
                for (j = 0; j < post.images.length; j++) {
                  var image = post.images[j];

                  jQuery('.gallery-entrant article .cards__item:last-child .slider-card-gallery').append('<div class="slider-card-gallery__item"><img src="'+image.sizes.slider_entrants_thumbnails+'" alt="'+image.alt+'" /></div>');
                }
              }

              jQuery('.gallery-entrant article .cards__item:last-child .card--entrant').append('<div class="card__body"></div>');
              jQuery('.gallery-entrant article .cards__item:last-child .card__body').append('<h2 class="card__title"><span>'+post.title+'</span> <span>'+post.age.label+'</span></h2>');
              jQuery('.gallery-entrant article .cards__item:last-child .card__body').append('<div class="card__year">Adopted '+post.year+'</div>');
              jQuery('.gallery-entrant article .cards__item:last-child .card__body').append('<p>'+post.description+'</p>');
              if(post.readMore){
                jQuery('.gallery-entrant article .cards__item:last-child .card__body').append('<div class="two-col__read-more"></div>');
                jQuery('.gallery-entrant article .cards__item:last-child .two-col__read-more').append('<div class="read-more__content">'+post.readMore+'</div>');
                jQuery('.gallery-entrant article .cards__item:last-child .two-col__read-more').append('<a href="" title="" class="read-more__link"><span class="read-more__txt">Read More</span></a>');
              }

               jQuery('.gallery-entrant article .cards__item:last-child .card--entrant').append('<div class="card__footer"></div>');
               jQuery('.gallery-entrant article .cards__item:last-child .card__footer').append('<form method="post" class="voting-form"></form>');
               jQuery('.gallery-entrant article .cards__item:last-child .voting-form').append('<input type="hidden" name="postID" value="'+post.postID+'"/>');
               jQuery('.gallery-entrant article .cards__item:last-child .voting-form').append('<input type="submit" value="Vote for me" class="button card__button" />');
            }

            if (jQuery('.skills_section').hasClass('slick-initialized')) {
              jQuery('.slider-card-gallery').slick('destroy');
            }

            jQuery('.slider-card-gallery').not('.slick-initialized').slick( getSliderCardSettings() );

            if(!data.morePosts){
              jQuery('#load-more').hide();
            }
          }
        });
    }

    function getSliderCardSettings(){
      return {
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '0',
        draggable: false,
        ussCSS: true,
        arrows: false,
        dots: true,
        adaptiveHeight: false,
        speed: 800,
        fade: false,
        cssEase: 'cubic-bezier(.13,.33,.51,.93)',
        mobileFirst: true,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 20000,
        useTransform: false,

        responsive: [
        {
          breakpoint: 768,
          settings: {
            dots: true,
            arrows: false,
            slidesToShow: 1,
          }
        }
        ]
      }
    }
</script>

</section>