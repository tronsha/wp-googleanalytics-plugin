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
 * Version:           1.1.6
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * Text Domain:       mpcx-googleanalytics
 * Domain Path:       /languages/
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-googleanalytics-plugin/master/LICENSE
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

load_plugin_textdomain( 'mpcx-googleanalytics', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

register_activation_hook(
	__FILE__,
	function () {
		add_option( 'google_analytics_tracking_id', 'UA-0000000-0' );
		add_option( 'google_analytics_display_features', '' );
		add_option( 'google_analytics_opt_out', '' );
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
			register_setting(
				'mpcx_googleanalytics',
				'google_analytics_display_features'
			);
			register_setting(
				'mpcx_googleanalytics',
				'google_analytics_opt_out'
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
				$settings = array( 'settings' => '<a href="options-general.php?page=googleanalytics">' . __( 'Settings', 'mpcx-googleanalytics' ) . '</a>' );
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
			if ( false === empty( $trackingId ) && 'UA-0000000-0' !== $trackingId && 'UA-XXXXX-Y' !== $trackingId ) {
				if ( '1' === get_option( 'google_analytics_opt_out' ) ) {
					$optoutJs = file_get_contents( plugin_dir_path( __FILE__ ) . 'public/js/optout.js' );
					echo "<script>\n" . str_replace( 'UA-XXXXX-Y', $trackingId, $optoutJs ) . "</script>\n";
				}
				$analyticsJs = file_get_contents( plugin_dir_path( __FILE__ ) . 'public/js/analytics.js' );
				if ( '1' !== get_option( 'google_analytics_display_features' ) ) {
					$analyticsJs = str_replace( "  ga('require', 'displayfeatures');\n", '', $analyticsJs );
				}
				echo "<!-- Google Analytics -->\n";
				echo "<script>\n" . str_replace( 'UA-XXXXX-Y', $trackingId, $analyticsJs ) . "</script>\n";
				echo "<!-- End Google Analytics -->\n";
			}
		}
	);

	add_shortcode(
		'gaoptout',
		function ( $att = array(), $content = null ) {
			$text = empty( $content ) ? __( 'Click here to opt-out of Google Analytics', 'mpcx-googleanalytics' ) : $content;

			return '<a href="javascript:gaOptout()">' . $text . '</a>';
		}
	);

}
