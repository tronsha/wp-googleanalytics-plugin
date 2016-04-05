<?php
/**
 * @link              https://github.com/tronsha/wp-googleanalytics-plugin
 * @since             1.0.0
 * @package           wp-googleanalytics-plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Google Analytics
 * Plugin URI:        https://github.com/tronsha/wp-googleanalytics-plugin
 * Description:       Google Analytics with Anonymize IP.
 * Version:           1.0.7
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-googleanalytics-plugin/master/LICENSE
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

register_activation_hook(
	__FILE__,
	function () {
		add_option( 'google_analytics_tracking_id', 'UA-0000000-0' );
	}
);

register_deactivation_hook(
	__FILE__,
	function () {
		delete_option( 'google_analytics_tracking_id' );
	}
);

if ( is_admin() ) {

	add_action(
		'admin_init',
		function () {
			register_setting(
				'mpcx_googleanalytics',
				'google_analytics_tracking_id'
			);
		}
	);

	add_action(
		'admin_menu',
		function () {
			add_options_page(
				'Google Analytics',
				'Google Analytics',
				'manage_options',
				'googleanalytics',
				function () {
					include plugin_dir_path( __FILE__ ) . 'admin/options.php';
				}
			);
		}
	);

	add_filter(
		'plugin_action_links',
		function ( $actions, $plugin_file ) {
			static $plugin;
			if ( ! isset( $plugin ) ) {
				$plugin = plugin_basename( __FILE__ );
			}
			if ( $plugin == $plugin_file ) {
				$settings = array( 'settings' => '<a href="options-general.php?page=googleanalytics">' . __( 'Settings', 'General' ) . '</a>' );
				$actions  = array_merge( $settings, $actions );
			}

			return $actions;
		},
		10,
		5
	);

}

if ( ! is_admin() ) {

	add_action(
		'wp_head',
		function () {
			$trackingId = get_option( 'google_analytics_tracking_id' );
			if ( empty( $trackingId ) === false && $trackingId !== 'UA-0000000-0' ) {
				$optoutJs = file_get_contents( plugin_dir_path( __FILE__ ) . 'public/js/optout.js' );
				echo "<script>\n" . str_replace( 'UA-0000000-0', $trackingId, $optoutJs ) . "</script>\n";
				$analyticsJs = file_get_contents( plugin_dir_path( __FILE__ ) . 'public/js/analytics.js' );
				echo "<script>\n" . str_replace( 'UA-0000000-0', $trackingId, $analyticsJs ) . "</script>\n";
			}
		}
	);

	add_shortcode(
		'gaoptout',
		function () {
			return '<a href="javascript:gaOptout()">' . __('Click here to opt-out of Google Analytics', 'mpcx-googleanalytics') . '</a>';
		}
	);

}
