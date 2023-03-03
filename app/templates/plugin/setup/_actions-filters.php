<?php

/**
 * Actions and Filters
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

// Number of revisions to keep
if ( ! function_exists( '<%= opts.functionPrefix %>_keep_revisions' ) ) {
	function <%= opts.functionPrefix %>_keep_revisions() {
		return 30;
	}
	add_filter( 'wp_revisions_to_keep', '<%= opts.functionPrefix %>_keep_revisions' );
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
