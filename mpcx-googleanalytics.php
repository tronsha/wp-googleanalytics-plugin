<?php
/**
 * @link              https://github.com/tronsha/wp-googleanalytics-plugin
 * @since             1.0.0
 * @package           wp-googleanalytics-plugin
 *
 * @wordpress-plugin
 * Plugin Name:       MPCX Google Analytics
 * Plugin URI:        https://github.com/tronsha/wp-googleanalytics-plugin
 * Description:       Just Another Google Analytics Plugin
 * Version:           0.1.0
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-googleanalytics-plugin/master/LICENSE
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function mpcx_google_analytics_register_setting() {
	register_setting(
		'mpcx_google_analytics',
		'google_analytics_id'
	);
}

function mpcx_google_analytics_add_options_page() {
	add_options_page(
		'Google Analytics',
		'Google Analytics',
		'manage_options',
		'googleanalytics',
		'mpcx_google_analytics_admin_options'
	);
}

function mpcx_google_analytics_admin_options() {
	include plugin_dir_path( __FILE__ ) . 'admin/options.php';
}

if ( is_admin() ) {
	add_action( 'admin_init', 'mpcx_google_analytics_register_setting' );
	add_action( 'admin_menu', 'mpcx_google_analytics_add_options_page' );
}

if ( ! is_admin() ) {
}
