<?php

/**
 * Actions and Filters
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

add_action( 'after_switch_theme', 'flush_rewrite_rules' );

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Remove JPEG compression.
if ( ! function_exists( '<%= opts.functionPrefix %>_jpeg_quality' ) ) {
	function <%= opts.functionPrefix %>_jpeg_quality() {
		return 100;
	}
	add_filter( 'jpeg_quality', '<%= opts.functionPrefix %>_jpeg_quality' );
}

// Allow SVG upload
if ( ! function_exists( '<%= opts.functionPrefix %>_mime_types' ) ) {
	function <%= opts.functionPrefix %>_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter( 'upload_mimes', '<%= opts.functionPrefix %>_mime_types' );
}

// Add SVG as image
if ( ! function_exists( '<%= opts.functionPrefix %>_ext_types' ) ) {
	function <%= opts.functionPrefix %>_ext_types( $mimes ) {
		$mimes['image'][] = 'svg';
		return $mimes;
	}
	add_filter( 'ext2type', '<%= opts.functionPrefix %>_ext_types' );
};

// Custom excerpt length
if ( ! function_exists( '<%= opts.functionPrefix %>_excerpt_length' ) ) {
	function <%= opts.functionPrefix %>_excerpt_length( $length ) {
		return 50;
	}
	add_filter( 'excerpt_length', '<%= opts.functionPrefix %>_excerpt_length' );
}

// Custom excerpt read more
if ( ! function_exists( '<%= opts.functionPrefix %>_excerpt_string' ) ) {
	function <%= opts.functionPrefix %>_excerpt_string( $more ) {
		return '&hellip;';
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
