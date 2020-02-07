<?php

/**
 * Theme Hooks
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

require_once <%= opts.constantPrefix %>_INCLUDES . 'google-tracking-codes.php';

if ( ! function_exists( '<%= opts.functionPrefix %>_add_ga' ) ) {
	function <%= opts.functionPrefix %>_add_ga() {
		global $<%= opts.functionPrefix %>_options;

		$tid = $<%= opts.functionPrefix %>_options['google_analytics'];

		if ( $tid ) {
			themeplate_google_analytics_gtag( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_ga', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_head' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_head() {
		global $<%= opts.functionPrefix %>_options;

		$tid = $<%= opts.functionPrefix %>_options['google_tagmanager'];

		if ( $tid ) {
			themeplate_google_tag_head( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_gtm_head', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_body' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_body() {
		global $<%= opts.functionPrefix %>_options;

		$tid = $<%= opts.functionPrefix %>_options['google_tagmanager'];

		if ( $tid ) {
			themeplate_google_tag_body( $tid );
		}
	}
	add_action( 'wp_body_open', '<%= opts.functionPrefix %>_add_gtm_body', 5 );
}
