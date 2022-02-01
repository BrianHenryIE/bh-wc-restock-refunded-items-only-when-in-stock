<?php
/**
 * Class Plugin_Test. Tests the root plugin setup.
 *
 * @package BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock;

use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Includes\BH_WC_Restock_Refunded_Items_Only_When_In_Stock;

/**
 * Verifies the plugin has been instantiated and added to PHP's $GLOBALS variable.
 */
class Plugin_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Test the main plugin object is added to PHP's GLOBALS and that it is the correct class.
	 */
	public function test_plugin_instantiated() {

		$this->assertArrayHasKey( 'bh_wc_restock_refunded_items_only_when_in_stock', $GLOBALS );

		$this->assertInstanceOf( BH_WC_Restock_Refunded_Items_Only_When_In_Stock::class, $GLOBALS['bh_wc_restock_refunded_items_only_when_in_stock'] );
	}

}
