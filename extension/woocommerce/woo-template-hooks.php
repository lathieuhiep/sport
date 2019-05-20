<?php

/**
 * Shop WooCommerce Hooks
 */

/**
 * Layout
 *
 * @see sport_get_cart()
 * @see sport_woo_before_main_content()
 * @see sport_woo_before_shop_loop_open()
 * @see sport_woo_before_shop_loop_close()
 * @see sport_woo_before_shop_loop_item()
 * @see sport_woo_after_shop_loop_item()
 * @see sport_woo_product_thumbnail_open()
 * @see sport_woo_product_thumbnail_close()
 * @see sport_woo_get_product_title()
 * @see sport_woo_after_shop_loop_item_title()
 * @see sport_woo_loop_add_to_cart_open()
 * @see sport_woo_loop_add_to_cart_close()
 * @see sport_woo_get_sidebar()
 * @see sport_woo_after_main_content()
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'sport_get_cart_item', 'sport_get_cart', 5 );

add_action( 'woocommerce_before_main_content', 'sport_woo_before_main_content', 10 );

add_action( 'woocommerce_before_shop_loop', 'sport_woo_before_shop_loop_open',  5 );
add_action( 'woocommerce_before_shop_loop', 'sport_woo_before_shop_loop_close',  35 );

add_action( 'woocommerce_before_shop_loop_item_title', 'sport_woo_product_thumbnail_open', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'sport_woo_product_thumbnail_close', 15 );

add_action( 'woocommerce_shop_loop_item_title', 'sport_woo_get_product_title', 10 );

add_action( 'woocommerce_after_shop_loop_item_title', 'sport_woo_after_shop_loop_item_title', 15 );

add_action( 'woocommerce_after_shop_loop_item', 'sport_woo_loop_add_to_cart_open', 4 );
add_action( 'woocommerce_after_shop_loop_item', 'sport_woo_loop_add_to_cart_close', 12 );

add_action ( 'woocommerce_before_shop_loop_item', 'sport_woo_before_shop_loop_item', 5 );
add_action ( 'woocommerce_after_shop_loop_item', 'sport_woo_after_shop_loop_item', 15 );

add_action( 'sport_woo_sidebar', 'sport_woo_get_sidebar', 10 );

add_action( 'woocommerce_after_main_content', 'sport_woo_after_main_content', 10 );


/**
 * Single Product
 *
 * @see sport_woo_before_single_product()
 * @see sport_woo_before_single_product_summary_open_warp()
 * @see sport_woo_before_single_product_summary_open()
 * @see sport_woo_before_single_product_summary_close()
 * @see sport_woo_before_single_product_entry_summary_open()
 * @see sport_woo_before_single_product_entry_summary_close()
 * @see sport_post_type_gallery_product_cate()
 * @see sport_woo_after_single_product_summary_close_warp()
 * @see sport_woo_after_single_product()
 *
 */

add_action( 'woocommerce_before_single_product', 'sport_woo_before_single_product', 5 );

add_action( 'woocommerce_before_single_product_summary', 'sport_woo_before_single_product_summary_open_warp',  1 );

add_action( 'woocommerce_before_single_product_summary', 'sport_woo_before_single_product_summary_open', 5 );

add_action( 'woocommerce_before_single_product_summary', 'sport_woo_before_single_product_summary_close', 30 );

add_action( 'woocommerce_before_single_product_summary', 'sport_woo_before_single_product_entry_summary_open', 35 );

add_action( 'woocommerce_after_single_product_summary', 'sport_woo_before_single_product_entry_summary_close', 2 );

add_action( 'woocommerce_after_single_product_summary', 'sport_post_type_gallery_product_cate', 3 );

add_action( 'woocommerce_after_single_product_summary', 'sport_woo_after_single_product_summary_close_warp', 5 );

add_action( 'woocommerce_after_single_product', 'sport_woo_after_single_product', 30 );

