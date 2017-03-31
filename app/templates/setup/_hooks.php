<?php

/**
 * Theme Hooks
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

require_once( THEME_INC . 'google-codes.php' );

if ( ! function_exists( '<%= opts.functionPrefix %>_add_ga' ) ) {
	function <%= opts.functionPrefix %>_add_ga() {
		<%= opts.functionPrefix %>_google_analytics( 'UA-XXXXX-Y' );
		// <%= opts.functionPrefix %>_google_analytics_async( 'UA-XXXXX-Y' );
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_ga', 10 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_header' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_header() {
		<%= opts.functionPrefix %>_google_tag_header( 'GTM-XXXX' );
	}
	add_action( 'wp_head', '<%= opts.functionPrefix %>_add_gtm_header', 10 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_add_gtm_footer' ) ) {
	function <%= opts.functionPrefix %>_add_gtm_footer() {
		<%= opts.functionPrefix %>_google_tag_footer( 'GTM-XXXX' );
	}
	add_action( 'wp_footer', '<%= opts.functionPrefix %>_add_gtm_footer', 10 );
}
