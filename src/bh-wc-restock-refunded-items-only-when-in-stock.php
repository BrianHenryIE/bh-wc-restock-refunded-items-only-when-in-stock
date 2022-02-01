<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 *
 * @wordpress-plugin
 * Plugin Name:       Restock Refunded Items Only When In Stock
 * Plugin URI:        http://github.com/BrianHenryIE/bh-wc-restock-refunded-items-only-when-in-stock/
 * Description:       Without this, when a product's stock is at zero, and an order is refuned/on-hold changes to pending/cancelled, and stock is restored, out of stock items sometimes get put back into stock. Bad!
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Author:            BrianHenryIE
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wc-restock-refunded-items-only-when-in-stock
 * Domain Path:       /languages
 */

namespace BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock;

use BrianHenryIE\WC_Restock_Refunded_Items_Only_When_In_Stock\Includes\BH_WC_Restock_Refunded_Items_Only_When_In_Stock;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

define( 'BH_WC_RESTOCK_REFUNDED_ITEMS_ONLY_WHEN_IN_STOCK_VERSION', '1.0.0' );
define( 'BH_WC_RESTOCK_REFUNDED_ITEMS_ONLY_WHEN_IN_STOCK_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function instantiate_bh_wc_restock_refunded_items_only_when_in_stock(): BH_WC_Restock_Refunded_Items_Only_When_In_Stock {

	$plugin = new BH_WC_Restock_Refunded_Items_Only_When_In_Stock();

	return $plugin;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and frontend-facing site hooks.
 */
$GLOBALS['bh_wc_restock_refunded_items_only_when_in_stock'] = instantiate_bh_wc_restock_refunded_items_only_when_in_stock();
