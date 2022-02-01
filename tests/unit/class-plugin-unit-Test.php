<?php
/**
 * Tests for the root plugin file.
 *
 * @package BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock;

use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Includes\BH_WC_Restock_Refunded_Items_Only_When_In_Stock;

/**
 * Class Plugin_WP_Mock_Test
 */
class Plugin_Unit_Test extends \Codeception\Test\Unit {

	protected function setup() : void {
		parent::setUp();
		\WP_Mock::setUp();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
		parent::tearDown();
	}

	/**
	 * Verifies the plugin initialization.
	 * Verifies the plugin does not output anything to screen.
	 */
	public function test_plugin_include() {

		// Prevents code-coverage counting, and removes the need to define the WordPress functions that are used in that class.
		\Patchwork\redefine(
			array( BH_WC_Restock_Refunded_Items_Only_When_In_Stock::class, '__construct' ),
			function() {}
		);

		$plugin_root_dir = dirname( __DIR__, 2 ) . '/src';

		\WP_Mock::userFunction(
			'plugin_dir_path',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => $plugin_root_dir . '/',
			)
		);
		\WP_Mock::userFunction(
			'plugin_basename',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => 'bh-wc-restock-refunded-items-only-when-in-stock/bh-wc-restock-refunded-items-only-when-in-stock.php',
			)
		);

		\WP_Mock::userFunction(
			'register_activation_hook'
		);

		\WP_Mock::userFunction(
			'register_deactivation_hook'
		);

		ob_start();

		include $plugin_root_dir . '/bh-wc-restock-refunded-items-only-when-in-stock.php';

		$printed_output = ob_get_contents();

		ob_end_clean();

		$this->assertEmpty( $printed_output );

		$this->assertArrayHasKey( 'bh_wc_restock_refunded_items_only_when_in_stock', $GLOBALS );

		$this->assertInstanceOf( BH_WC_Restock_Refunded_Items_Only_When_In_Stock::class, $GLOBALS['bh_wc_restock_refunded_items_only_when_in_stock'] );

	}

}
