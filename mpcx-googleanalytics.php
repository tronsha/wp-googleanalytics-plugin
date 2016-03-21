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

function mpcx_google_analytics_activate() {
	add_option('google_analytics_id', 'UA-0000000-0');
}

function mpcx_google_analytics_deactive() {
	delete_option('google_analytics_id');
}

function mpcx_google_analytics_admin_options() {
	include plugin_dir_path( __FILE__ ) . 'admin/options.php';
}

function mpcx_google_analytics_get_option() {
	return get_option('google_analytics_id');
}

function mpcx_google_analytics_output() {
	$id = mpcx_google_analytics_get_option();
	echo "
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '" . $id . "', 'auto');
  ga('set', 'anonymizeIp', true);
  ga('send', 'pageview');
</script>
";
}

register_activation_hook(__FILE__, 'mpcx_google_analytics_activate');
register_deactivation_hook(__FILE__, 'mpcx_google_analytics_deactive');

if ( is_admin() ) {
	add_action( 'admin_init', 'mpcx_google_analytics_register_setting' );
	add_action( 'admin_menu', 'mpcx_google_analytics_add_options_page' );
}

if ( ! is_admin() ) {
	add_action('wp_head', 'mpcx_google_analytics_output');
}
