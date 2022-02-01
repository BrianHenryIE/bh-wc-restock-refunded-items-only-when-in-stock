<?php

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce;

use Codeception\TestCase\WPTestCase;

/**
 * @coversDefaultClass \BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce\Stock
 */
class Stock_WPUnit_Test extends WPTestCase {

	/**
	 * @covers ::filter_reduced_stock_meta
	 */
	public function test_filter(): void {

		$stock = new Stock();

		$product = new \WC_Product();
		$product->set_manage_stock( true );
		$product->set_stock_quantity( 0 );
		$product_id = $product->save();

		$item = new \WC_Order_Item_Product();
		$item->set_product( $product );
		$item->set_quantity( 4 );
		$item->save();

		$result = $stock->filter_reduced_stock_meta( '4', $item );

		$this->assertEquals( '', $result );
	}

}
