<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * frontend-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 * @subpackage BH_WC_Restock_Refunded_Items_Only_When_In_Stock/includes
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Includes;

use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\WooCommerce\Stock;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * frontend-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 * @subpackage BH_WC_Restock_Refunded_Items_Only_When_In_Stock/includes
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class BH_WC_Restock_Refunded_Items_Only_When_In_Stock {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the frontend-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->define_woocommerce_hooks();

	}

	/**
	 * Hook the filter to the WC_Data meta function.
	 */
	protected function define_woocommerce_hooks(): void {

		$object_type = 'order_item';

		$hook_prefix = 'woocommerce_' . $object_type . '_get_';
		$key         = '_reduced_stock';

		$filter_name = $hook_prefix . $key;

		$order = new Stock();

		add_filter( $filter_name, array( $order, 'filter_reduced_stock_meta' ), 10, 2 );

	}

}
