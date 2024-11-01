<?php
/**
 * @package     Splitit_WooCommerce_Plugin
 *
 * File - create-log-table.php
 * Function for create checkout data table
 */

require_once dirname( __DIR__ ) . '/classes/class-splitit-flexfields-payment-plugin-log.php';

function splitit_flexfields_payment_plugin_create_log_create_order_data_with_ipn() {
	global $wpdb;

	$log_data = array(
		'user_id' => null,
		'method'  => __( 'splitit_flexfields_payment_plugin_create_log_create_order_data_with_ipn() Splitit', 'splitit_ff_payment' ),
	);

	if ( is_multisite() ) {
		$sites = get_sites();
		foreach ( $sites as $site ) {
			switch_to_blog( $site->blog_id );

			$table_name = $wpdb->prefix . 'splitit_order_data_with_ipn';

			$charset_collate = $wpdb->get_charset_collate();

			$sql = '';
			if ( $wpdb->get_var( "show tables like '$table_name'" ) != $table_name ) {

				SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'Create_splitit_order_data_with_ipn_table: ' . $table_name, 'info' );

				$sql = 'CREATE TABLE ' . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`user_id` int(11) DEFAULT 0,
					`shipping_method_cost` varchar(255) DEFAULT NULL,
					`shipping_method_title` varchar(255) DEFAULT NULL,
					`shipping_method_id` varchar(255) DEFAULT NULL,
					`coupon_amount` varchar(255) DEFAULT NULL,
					`coupon_code` varchar(255) DEFAULT NULL,
					`tax_amount` varchar(255) DEFAULT NULL,
					`set_shipping_total` varchar(255) DEFAULT NULL,
					`set_discount_total` varchar(255) DEFAULT NULL,
					`set_discount_tax` varchar(255) DEFAULT NULL,
					`set_cart_tax` varchar(255) DEFAULT NULL,
					`set_shipping_tax` varchar(255) DEFAULT NULL,
					`set_total` varchar(255) DEFAULT NULL,
					`wc_cart` TEXT,
					`get_packages` TEXT,
					`chosen_shipping_methods_data` TEXT,
					`ipn` varchar(255) DEFAULT NULL,
					`session_id` varchar(255) DEFAULT NULL,
					`user_data` TEXT,
					`cart_items` TEXT,
					`updated_at` datetime NOT NULL,
					PRIMARY KEY (`id`)
				) $charset_collate;";

				SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'create_splitit_order_data_with_ipn_table sql: ' . $sql, 'info' );
			}

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta( $sql );

			if ( $wpdb->last_error ) {
				SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'create_splitit_order_data_with_ipn_table Error: ' . $wpdb->last_error, 'error' );
			} else {
				if ( '' !== $sql ) {
					SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'splitit_order_data_with_ipn_table successfully created', 'info' );
				}
			}

			restore_current_blog();
		}
	} else {
		$table_name = $wpdb->prefix . 'splitit_order_data_with_ipn';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = '';
		if ( $wpdb->get_var( "show tables like '$table_name'" ) != $table_name ) {

			SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'Create_splitit_order_data_with_ipn_table: ' . $table_name, 'info' );

			$sql = 'CREATE TABLE ' . $table_name . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) DEFAULT 0,
				`shipping_method_cost` varchar(255) DEFAULT NULL,
				`shipping_method_title` varchar(255) DEFAULT NULL,
				`shipping_method_id` varchar(255) DEFAULT NULL,
				`coupon_amount` varchar(255) DEFAULT NULL,
				`coupon_code` varchar(255) DEFAULT NULL,
				`tax_amount` varchar(255) DEFAULT NULL,
				`set_shipping_total` varchar(255) DEFAULT NULL,
				`set_discount_total` varchar(255) DEFAULT NULL,
				`set_discount_tax` varchar(255) DEFAULT NULL,
				`set_cart_tax` varchar(255) DEFAULT NULL,
				`set_shipping_tax` varchar(255) DEFAULT NULL,
				`set_total` varchar(255) DEFAULT NULL,
				`wc_cart` TEXT,
				`get_packages` TEXT,
				`chosen_shipping_methods_data` TEXT,
				`ipn` varchar(255) DEFAULT NULL,
				`session_id` varchar(255) DEFAULT NULL,
				`user_data` TEXT,
				`cart_items` TEXT,
				`updated_at` datetime NOT NULL,
				PRIMARY KEY (`id`)
			) $charset_collate;";

			SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'create_splitit_order_data_with_ipn_table sql: ' . $sql, 'info' );
		}

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		if ( $wpdb->last_error ) {
			SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'create_splitit_order_data_with_ipn_table Error: ' . $wpdb->last_error, 'error' );
		} else {
			if ( '' !== $sql ) {
				SplitIt_FlexFields_Payment_Plugin_Log::save_log_info( $log_data, 'splitit_order_data_with_ipn_table successfully created', 'info' );
			}
		}
	}
}
