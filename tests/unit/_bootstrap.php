<?php
/**
 * PHPUnit bootstrap file for WP_Mock.
 *
 * @package           BH_WC_Restock_Refunded_Items_Only_When_In_Stock
 */

WP_Mock::setUsePatchwork( true );
WP_Mock::bootstrap();

global $plugin_root_dir;
require_once $plugin_root_dir . '/autoload.php';
