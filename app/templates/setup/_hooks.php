<?php

/**
 * Theme Hooks
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

function wp_body() {
	do_action( 'wp_body' );
}

require_once THEME_INC . 'google-tracking-codes.php';

if ( ! function_exists( '<%= opts.functionPrefix %>_add_ga' ) ) {
	function <%= opts.functionPrefix %>_add_ga() {
		$tid = get_option( '<%= opts.functionPrefix %>-options' )['google_analytics'];
		if ( $tid ) {
			// themeplate_google_analytics( $tid );
			// themeplate_google_analytics_async( $tid );
			themeplate_google_analytics_gtag( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_ga', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_head' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_head() {
		$tid = get_option( '<%= opts.functionPrefix %>-options' )['google_tagmanager'];
		if ( $tid ) {
			themeplate_google_tag_head( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_gtm_head', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_body' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_body() {
		$tid = get_option( '<%= opts.functionPrefix %>-options' )['google_tagmanager'];
		if ( $tid ) {
			themeplate_google_tag_body( $tid );
		}
	}
	add_action( 'wp_body', '<%= opts.functionPrefix %>_add_gtm_body', 5 );
}
