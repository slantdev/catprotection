<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php 
    $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
	$size = 'gallery_tiles';	            
    $image = wp_get_attachment_image_src($thumbnail_id, $size);	
?>

<a href="<?php echo get_category_link( $category ); ?>" class="cell shop-category__item">
    <figure class="shop-category__figure">
        <img src="<?php echo $image[0]; ?>" class="shop-category__img" alt="<?php echo $term->name; ?>">
        <figcaption class="shop-category__name"><?php echo $category->name; ?></figcaption>
    </figure>
</a>