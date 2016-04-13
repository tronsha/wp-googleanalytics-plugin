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
<th scope="row"><label for="google_analytics_tracking_id">Tracking ID:</label></th>
<td><input type="text" id="google_analytics_tracking_id" name="google_analytics_tracking_id" value="<?php echo get_option( 'google_analytics_tracking_id' ); ?>" /> <a href="https://support.google.com/analytics/answer/1032385" target="_blank"><sup>?</sup></a></td>
</tr>
<tr>
<th scope="row"><label for="google_analytics_opt_out">User Opt-out:</label></th>
<td><input type="checkbox" id="google_analytics_opt_out" name="google_analytics_opt_out" value="1"<?php checked( get_option( 'google_analytics_opt_out' ), 1 ); ?> /></td>
</tr>
</table>
<?php submit_button(); ?>
</form>
</div>
