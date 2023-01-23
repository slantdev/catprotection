<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_title( '<h1 class="shop-product__title entry-title">', '</h1>' );

// get product_tags of the current product
$current_tags = get_the_terms( get_the_ID(), 'product_tag' );

//only start if we have some tags
if ( $current_tags && ! is_wp_error( $current_tags ) ) {

	$count == 0;

		//for each tag we create a list item
		foreach ($current_tags as $tag) {

			if ( $count < 1) {
			echo $count;
					$tag_title = $tag->name; // tag name
					//$tag_link = get_term_link( $tag );// tag archive link

					echo '<div class="shop-product__tag">'.$tag_title.'</div>';

			}

				$count++;
		}
}
