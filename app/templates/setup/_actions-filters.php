<?php

/**
 * Actions and Filters
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Allow SVG upload
if( ! function_exists( '<%= opts.functionPrefix %>_mime_types' ) ) {
	function <%= opts.functionPrefix %>_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter( 'upload_mimes', '<%= opts.functionPrefix %>_mime_types' );
}

// Custom excerpt length
if( ! function_exists( '<%= opts.functionPrefix %>_excerpt_length' ) ) {
	function <%= opts.functionPrefix %>_excerpt_length( $length ) {
		return 50;
	}
	add_filter( 'excerpt_length', '<%= opts.functionPrefix %>_excerpt_length' );
}

// Custom excerpt read more
if ( ! function_exists( '<%= opts.functionPrefix %>_excerpt_string' ) ) {
	function <%= opts.functionPrefix %>_excerpt_string( $more ) {
		return ' . . .';
	}
	add_filter( 'excerpt_more', '<%= opts.functionPrefix %>_excerpt_string' );
}

// Number of revisions to keep
if ( ! function_exists( '<%= opts.functionPrefix %>_keep_revisions' ) ) {
	function <%= opts.functionPrefix %>_keep_revisions( $num, $post ) {
		$num = 10;
		return $num;
	}
	add_filter( 'wp_revisions_to_keep', '<%= opts.functionPrefix %>_keep_revisions', 10, 2 );
}
