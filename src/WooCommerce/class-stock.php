<?php
/**
 *
 * Filter might affect:
 *
 * @see wc_reduce_stock_levels() // no need to further reduce stock when we're at zero.
 * @see wc_increase_stock_levels() // called by wc_maybe_increase_stock_levels() ... behaviour is correct.
 * @see wc_maybe_adjust_line_item_product_stock()
 * @see wc_restock_refunded_items()
 *
 * @package brianhenryie/bh-wc-restock-refunded-items-only-when-in-stock
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce;

use WC_Data;

/**
 * $item->get_meta( '_reduced_stock', true );
 * $item->get_meta( '_restock_refunded_items'
 * $value = apply_filters( $hook_prefix . $key, $value, $this );
 */
class Stock {

	/**
	 * Filter the `_reduced_stock` order item meta key to prevent putting items back into stock when their stock
	 *  is 0.
	 *
	 * Returning an empty string passes all the tests.
	 *
	 * @see WC_Order_Item
	 * @see WC_Data::get_meta()
	 *
	 * @hooked woocommerce_line_item_get__reduced_stock ?
	 * @hooked woocommerce_order_item_get__reduced_stock ?
	 *
	 * @param string  $value Existing stock value. Empty string|int as string.
	 * @param WC_Data $item The order item product we're checking the stock of.
	 *
	 * @return string
	 */
	public function filter_reduced_stock_meta( $value, WC_Data $item ): ?string {

		if ( ! ( $item instanceof \WC_Order_Item_Product ) ) {
			return $value;
		}

		$product = $item->get_product();

		if ( ! ( $product instanceof \WC_Product ) ) {
			return $value;
		}

		if ( 0 !== $product->get_stock_quantity() ?? 0 ) {
			return $value;
		}

		return '';
	}

}
