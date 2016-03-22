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
 * Version:           0.9.1
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

}

if ( ! is_admin() ) {

	add_action(
		'wp_head',
		function () {
			echo "
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '" . get_option( 'google_analytics_tracking_id' ) . "', 'auto');
  ga('set', 'anonymizeIp', true);
  ga('send', 'pageview');
</script>
";
		}
	);

}
