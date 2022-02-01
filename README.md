[![WordPress tested 5.9](https://img.shields.io/badge/WordPress-v5.8%20tested-0073aa.svg)](https://wordpress.org/plugins/bh-wc-restock-refunded-items-only-when-in-stock) [![PHPCS WPCS](https://img.shields.io/badge/PHPCS-WordPress%20Coding%20Standards-8892BF.svg)](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) [![PHPUnit ](.github/coverage.svg)](https://brianhenryie.github.io/bh-wc-restock-refunded-items-only-when-in-stock/)

# Restock Refunded Items Only When In Stock (WooCommerce)

When an order is refunded, cancelled, or an on-hold order loses its on-hold status, WooCommerce automatically restocks the items that were in the order. That's great, usually, but when an item is out of stock, it can cause problems where no stock is available to fulfill an order that is subsequently placed. i.e. a product's stock is 0, an order is refunded, then its stock is set to 1 by WooCommerce, someone buys it, customer service load increases.

This plugin changes WooCommerce behaviour so when a product's stock is 0, it is not restocked.

It filters `WC_Order_Item_Product::get_meta('_reduced_stock')` and by setting that to `''`, we get the desired result.

`WC_Order_Item_Product::get_meta('_reduced_stock')` is called only by these functions:
* `wc_reduce_stock_levels()`
* `wc_increase_stock_levels()` (called by `wc_maybe_increase_stock_levels()`)
* `wc_maybe_adjust_line_item_product_stock()`
* `wc_restock_refunded_items()`

Behaviour is verified by integration tests.

[Download from releases](https://github.com/BrianHenryIE/bh-wc-restock-refunded-items-only-when-in-stock/releases).