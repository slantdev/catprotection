<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<section class="banner banner--interior">
	    
	    <?php 

			//$term = get_queried_object();
			$terms = get_the_terms( $post->ID, 'product_cat' );
	        
	        foreach ($terms  as $term  ) {
	            $product_cat_id = $term;
	            break;
	        }

	        $image = get_field('banner', $product_cat_id);	

	        if ( $image ) { ?>
	            <figure class="banner__img"><img src="<?php echo $image['sizes']['banner_interior']; ?>" alt="<?php echo $image['alt']; ?>"></figure>

	        <?php } else {
	            $backgroundImg = get_field('placeholder_image', 'options'); ?>
	            
	            <figure class="banner__img"><img src="<?php echo $backgroundImg['sizes']['banner_interior']; ?>" alt="Cat Protection"></figure>                

	        <?php } 
	    ?>      
             

	</section>

	<section class="sub-nav">
	    <nav class="grid-container">
	        <div class="grid-x">

	            <?php
	            wp_nav_menu(
	                array(
	                    'theme_location' => 'shop-secondary-navigation',
	                    'menu'           => '',
	                    'orderby'        => 'menu_order',
	                    'container' => false,
						'menu_class' => 'cell auto sub-nav__items',
						'li_class'  => 'sub-nav__item',
						'a_class'  => 'sub-nav__link'
	                )
	            );
	            ?>  

	            <form role="search" method="get" class="cell shrink search sub-nav__search woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	                <input type="text" class="search__input" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
	                <button type="submit" class="search__button">Search</button>
	                <input type="hidden" name="post_type" value="product" />
	            </form>

	        </div>
	    </nav>
	</section>

	<section class="shop shop-product">	                
	    <article class="grid-container">		

			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
		?>

	    </article>
	</section>	

	<?php get_template_part( 'assets/inc/template-parts/popup' ); ?>    
       
	<?php get_template_part( 'assets/inc/template-parts/footer-nav' ); ?>                           


<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
