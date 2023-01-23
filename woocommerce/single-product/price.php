<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'shop-product__price' ) );?>"><?php echo $product->get_price_html(); ?></p>

<?php 
$categ = $product->get_categories();
$term = get_term_by ( 'name' , strip_tags($categ), 'product_cat' );
$local_pickup = get_term_meta($term->term_id,'_wc_local_pickup_plus_local_pickup_product_cat_availability',true);

if($local_pickup == 'required'):
?>

<p style="color: #000040;font-weight: 600;">Please note that this product isn't available for delivery - Pick-up in store only</p>
<div class="pickup-modal">
	<div>
		<p>MEOW! This product is ONLY available for pick up from our shelter.</p>
		<button class="button cancel">
			Cancel
		</button>
		<button class="button submit">
			Yes, I will pick this up
		</button>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
	const form = document.querySelector('form.cart');
	const quantity = form.querySelector('input.qty');
	const add = form.querySelector('.single_add_to_cart_button');
	const modal = document.querySelector('.pickup-modal');
	const submit = modal.querySelector('.submit');
	const cancel = modal.querySelector('.cancel');

  form.addEventListener('submit', (event) => {
		event.preventDefault();
		modal.classList.add('active');
	});

	submit.addEventListener('click', () => {
		window.location = '/cart/?add-to-cart='+add.value+'&quantity='+quantity.value;
	})

	cancel.addEventListener('click', () => {
		modal.classList.remove('active');
	})
});
</script>
<?php 
endif;
