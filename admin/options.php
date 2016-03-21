<?php
/**
 * @link    https://github.com/tronsha/wp-googleanalytics-plugin
 * @since   1.0.0
 * @package wp-googleanalytics-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<div class="wrap">
	<h2>Google Analytics</h2>

	<form method="post" action="options.php">
		<?php wp_nonce_field( 'update-options' ); ?>
		<?php settings_fields( 'mpcx_googleanalytics' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					Google Analytics ID:
				</th>
				<td>
					<input type="text" name="google_analytics_id" value="<?php echo get_option( 'google_analytics_id' ); ?>">
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update"/>

		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>">
		</p>
	</form>
</div>
