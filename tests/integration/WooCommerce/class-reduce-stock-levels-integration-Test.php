<?php
/**
 * @see wc_reduce_stock_levels()
 *
 * @package brianhenryie/bh-wc-restock-refunded-items-only-when-in-stock
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce;

/**
 * @coversNothing
 */
class Reduce_Stock_Levels_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Result here is -4 which might not be correct, but at least isn't putting it in stock.
	 */
	public function test_out_of_stock(): void {

		$product = new \WC_Product();
		$product->set_stock_quantity( 4 );
		$product->set_manage_stock( true );
		$product_id = $product->save();

		$line_item = new \WC_Order_Item_Product();
		$line_item->set_product( $product );
		$line_item->set_quantity( 4 );
		$line_item->save();

		$order = new \WC_Order();
		$order->add_item( $line_item );
		$order->set_status( 'processing' );
		$order_id = $order->save();

		$product = wc_get_product( $product_id );
		assert( 0 === $product->get_stock_quantity() );

		wc_reduce_stock_levels( $order_id );

		$product = wc_get_product( $product_id );
		$this->assertEquals( -4, $product->get_stock_quantity() );

	}

	/**
	 * Don't do anything!
	 */
	public function test_still_in_stock(): void {

		$product = new \WC_Product();
		$product->set_stock_quantity( 40 );
		$product->set_manage_stock( true );
		$product_id = $product->save();

		$line_item = new \WC_Order_Item_Product();
		$line_item->set_product( $product );
		$line_item->set_quantity( 4 );
		$line_item->save();

		// Item meta "_reduced_stock" gets set when order status changes to paid.
		$order = new \WC_Order();
		$order->add_item( $line_item );
		$order->set_status( 'processing' );
		$order_id = $order->save();

		$product = wc_get_product( $product_id );
		assert( 36 === $product->get_stock_quantity() );

		wc_reduce_stock_levels( $order_id );

		// Doesn't do anything because the `_reduced_stock` meta key says it has already been reduced.
		$product = wc_get_product( $product_id );
		$this->assertEquals( 36, $product->get_stock_quantity() );

	}


}
