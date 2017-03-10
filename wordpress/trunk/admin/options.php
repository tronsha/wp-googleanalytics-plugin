<?php
/**
 * @link    https://github.com/tronsha/wp-googleanalytics-plugin
 * @since   1.0.0
 * @package wp-googleanalytics-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>

<div class="wrap">
<h1>Google Analytics</h1>
<form method="post" action="options.php">
<?php settings_fields( 'mpcx_googleanalytics' ); ?>
	<table class="form-table">
		<tr>
			<th scope="row">
				<label for="google_analytics_tracking_id"><?php _e( 'Tracking ID', 'mpcx-googleanalytics' ); ?>:</label>
			</th>
			<td>
				<input type="text" id="google_analytics_tracking_id" name="google_analytics_tracking_id" value="<?php echo get_option( 'google_analytics_tracking_id' ); ?>"/>
				<a href="https://support.google.com/analytics/answer/1032385" target="_blank"><sup>?</sup></a>
				<p class="description" id="google_analytics_tracking_id-description"><?php _e( 'Enter your Google Analytics Tracking ID', 'mpcx-googleanalytics' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="google_analytics_display_features"><?php _e( 'Remarketing', 'mpcx-googleanalytics' ); ?>:</label>
			</th>
			<td>
				<input type="checkbox" id="google_analytics_display_features" name="google_analytics_display_features" value="1"<?php checked( get_option( 'google_analytics_display_features' ), 1 ); ?> />
				<a href="https://support.google.com/analytics/answer/2444872" target="_blank"><sup>?</sup></a>
				<p class="description" id="google_analytics_display_features-description"><?php printf( __( 'Select the checkbox if you want to enable remarketing and advertising reporting.', 'mpcx-googleanalytics' ) ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="google_analytics_opt_out"><?php _e( 'User Opt-out', 'mpcx-googleanalytics' ); ?>:</label>
			</th>
			<td>
				<input type="checkbox" id="google_analytics_opt_out" name="google_analytics_opt_out" value="1"<?php checked( get_option( 'google_analytics_opt_out' ), 1 ); ?> />
				<p class="description" id="google_analytics_opt_out-description"><?php printf( __( 'Select the checkbox if you want to use the shortcode %s.', 'mpcx-googleanalytics' ), '<strong>[gaoptout /]</strong>' ); ?></p>
			</td>
		</tr>
	</table>
<?php submit_button(); ?>
</form>
</div>
