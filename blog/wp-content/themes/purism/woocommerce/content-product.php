<?php
/**
* The template for displaying product content within loops
*
* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
* @version 3.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_category = get_theme_mod( 'pm_product_category' , true );

$id = get_the_id();
?>
<li <?php post_class(); ?>>
	<article>
		<div class="product-img-wrapper">
			<a href="<?php echo get_the_permalink(); ?>" class="woocommerce-LoopProduct-link">
				<?php wc_get_template( 'loop/sale-flash.php' ); ?>
				<?php echo woocommerce_get_product_thumbnail(); ?>
			</a>

			<div class="product-buttons">
				<?php echo do_shortcode( '[yith_quick_view product_id="'. $id . '" label=" "]') ; ?>
				<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="'. $id . '" label="" browse_wishlist_text=""]') ; ?>
			</div>
		</div>

		<?php
		echo '<h2 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">' . get_the_title() . '</a></h2>';

		echo '<div class="product-meta">';

		if( $product_category ) :
			echo pm_product_cat('|');
		endif;

		wc_get_template( 'loop/rating.php' );
		wc_get_template( 'loop/price.php' );
		echo '</div>';
		echo '<div class="product-buttons product-add-to-cart">';
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
		?>
	</article>
</li>
