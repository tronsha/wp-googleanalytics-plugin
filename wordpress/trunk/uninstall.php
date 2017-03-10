<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'google_analytics_tracking_id' );
delete_option( 'google_analytics_display_features' );
delete_option( 'google_analytics_opt_out' );
