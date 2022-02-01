<?php
/**
 * Happy path.
 *
 * @package brianhenryie/bh-wc-restock-refunded-items-only-when-in-stock
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce;

use Codeception\TestCase\WPTestCase;

/**
 * @coversNothing
 */
class Stock_WPUnit_Integration extends WPTestCase {

	public function test_restore_stock(): void {

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
		$order->set_status( 'pending' ); // Default, but to be clear.
		$order->save();

		// At this stage the stock should be 4, still.
		$product = wc_get_product( $product_id );
		assert( 4 === $product->get_stock_quantity() );

		$order->set_status( 'on-hold' );
		$order->save();

		// Setting it to on-hold should reserve the stock.
		$product = wc_get_product( $product_id );
		assert( 0 === $product->get_stock_quantity() );

		$order->set_status( 'pending' );
		$order->save();

		// Setting it to pending normally restores the stock.
		$product = wc_get_product( $product_id );
		$this->assertEquals( 0, $product->get_stock_quantity() );

	}

}
