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

require_once( THEME_INC . 'google-codes.php' );

if ( ! function_exists( '<%= opts.functionPrefix %>_add_ga' ) ) {
	function <%= opts.functionPrefix %>_add_ga() {
		$tid = get_option( '<%= opts.functionPrefix %>-options' )['google_analytics'];
		if ( $tid ) {
			// <%= opts.functionPrefix %>_google_analytics( $tid );
			// <%= opts.functionPrefix %>_google_analytics_async( $tid );
			<%= opts.functionPrefix %>_google_analytics_gtag( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_ga', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_header' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_header() {
		$tid = get_option( '<%= opts.functionPrefix %>-options' )['google_tagmanager'];
		if ( $tid ) {
			<%= opts.functionPrefix %>_google_tag_header( $tid );
		}
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_gtm_header', 10 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_footer' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_footer() {
		$tid = get_option( '<%= opts.functionPrefix %>-options' )['google_tagmanager'];
		if ( $tid ) {
			<%= opts.functionPrefix %>_google_tag_footer( $tid );
		}
	}
	add_action( 'wp_body', '<%= opts.functionPrefix %>_add_gtm_footer', 5 );
}
