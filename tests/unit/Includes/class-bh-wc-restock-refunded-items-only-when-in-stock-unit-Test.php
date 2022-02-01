<?php
/**
 * @package BH_WC_Restock_Refunded_Items_Only_When_In_Stock_Unit_Name
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Includes;

use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Admin\Admin;
use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Frontend\Frontend;
use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce\Stock;
use WP_Mock\Matcher\AnyInstance;

/**
 * Class BH_WC_Restock_Refunded_Items_Only_When_In_Stock_Unit_Test
 *
 * @coversDefaultClass \BH_WC_Restock_Refunded_Items_Only_When_In_Stock\Includes\BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 */
class BH_WC_Restock_Refunded_Items_Only_When_In_Stock_Unit_Test extends \Codeception\Test\Unit {

	protected function setup(): void {
		parent::setup();
		\WP_Mock::setUp();
	}

	protected function tearDown(): void {
		parent::tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * @covers ::define_woocommerce_hooks
	 */
	public function test_woocommerce_hooks() {

		\WP_Mock::expectFilterAdded(
			'woocommerce_order_item_get__reduced_stock',
			array( new AnyInstance( Stock::class ), 'filter_reduced_stock_meta' ),
			10,
			2
		);

		new BH_WC_Restock_Refunded_Items_Only_When_In_Stock();
	}

}
