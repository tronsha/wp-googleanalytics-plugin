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
<?php wp_nonce_field( 'update-options' ); ?>
<?php settings_fields( 'mpcx_google_analytics' ); ?>
<table class="form-table">
<tr>
<th scope="row"><label for="google_analytics_id">Google Analytics ID:</label></th>
<td><input type="text" id="google_analytics_id" name="google_analytics_id" value="<?php echo get_option( 'google_analytics_id' ); ?>"></td>
</tr>
</table>
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>">
</p>
</form>
</div>
