<?php

/**
 * Theme Hooks
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

require_once <%= opts.constantPrefix %>_PLUGIN_PATH . 'includes/google-tracking-codes.php';

if ( ! function_exists( '<%= opts.functionPrefix %>_add_ga' ) ) {
	function <%= opts.functionPrefix %>_add_ga() {
		$tid = <%= opts.functionPrefix %>_options( 'google_analytics' );

		if ( $tid ) {
			themeplate_google_analytics_gtag( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_ga', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_head' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_head() {
		$tid = <%= opts.functionPrefix %>_options( 'google_tagmanager' );

		if ( $tid ) {
			themeplate_google_tag_head( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_gtm_head', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_body' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_body() {
		$tid = <%= opts.functionPrefix %>_options( 'google_tagmanager' );

		if ( $tid ) {
			themeplate_google_tag_body( $tid );
		}
	}
	add_action( 'wp_body_open', '<%= opts.functionPrefix %>_add_gtm_body', 5 );
}
