<?php

/**
 * Actions and Filters
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

// Allow SVG upload
if ( ! function_exists( '<%= opts.functionPrefix %>_mime_types' ) ) {
	function <%= opts.functionPrefix %>_mime_types( $mimes ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
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
}

// Correctly identify SVGs
if ( ! function_exists( '<%= opts.functionPrefix %>_type_svg' ) ) {
	function <%= opts.functionPrefix %>_type_svg( $data = null, $file = null, $filename = null ) {
		$ext = isset( $data['ext'] ) ? $data['ext'] : '';

		if ( strlen( $ext ) < 1 ) {
			$exploded = explode( '.', $filename );
			$ext      = strtolower( end( $exploded ) );
		}

		if ( 'svg' === $ext ) {
			$data['type'] = 'image/svg+xml';
			$data['ext']  = 'svg';
		} elseif ( 'svgz' === $ext ) {
			$data['type'] = 'image/svg+xml';
			$data['ext']  = 'svgz';
		}

		return $data;
	}
	add_filter( 'wp_check_filetype_and_ext', '<%= opts.functionPrefix %>_type_svg', 10, 3 );
}

// Number of revisions to keep
if ( ! function_exists( '<%= opts.functionPrefix %>_keep_revisions' ) ) {
	function <%= opts.functionPrefix %>_keep_revisions( $num, $post ) {
		return 30;
	}
	add_filter( 'wp_revisions_to_keep', '<%= opts.functionPrefix %>_keep_revisions', 10, 2 );
}

// Remove WP icon from the admin bar.
if ( ! function_exists( '<%= opts.functionPrefix %>_remove_wp_icon' ) ) {
	function <%= opts.functionPrefix %>_remove_wp_icon() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'wp-logo' );
	}
	add_action( 'wp_before_admin_bar_render', '<%= opts.functionPrefix %>_remove_wp_icon' );
}

// Makes WordPress-generated emails appear 'from' the site name.
if ( ! function_exists( '<%= opts.functionPrefix %>_mail_from_name' ) ) {
	function <%= opts.functionPrefix %>_mail_from_name() {
		return get_option( 'blogname' );
	}
	add_filter( 'wp_mail_from_name', '<%= opts.functionPrefix %>_mail_from_name' );
}

// Makes WordPress-generated emails appear 'from' the site admin email address.
if ( ! function_exists( '<%= opts.functionPrefix %>_wp_mail_from' ) ) {
	function <%= opts.functionPrefix %>_wp_mail_from() {
		return get_option( 'admin_email' );
	}
	add_filter( 'wp_mail_from', '<%= opts.functionPrefix %>_wp_mail_from' );
}
