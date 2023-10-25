<?php

/**
 * Compatibility
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

function <%= opts.functionPrefix %>_upgrade_message() {
	$theme = wp_get_theme( <%= opts.constantPrefix %>_THEME_BASE );

	$requirement = sprintf(
		/* translators: 1. PHP version, 2. WordPress version */
		__( '<strong>%1$s</strong> requires at least PHP version <strong>%2$s</strong> and WordPress version <strong>%3$s</strong>.', '<%= opts.projectSlug %>' ),
		$theme->get( 'Name' ),
		<%= opts.constantPrefix %>_THEME_REQUIRES['PHP'],
		<%= opts.constantPrefix %>_THEME_REQUIRES['WP']
	);

	$installed = sprintf(
		/* translators: 1. PHP version, 2. WP version */
		__( 'Site is running at PHP version <strong>%1$s</strong> and WordPress version <strong>%2$s</strong>.', '<%= opts.projectSlug %>' ),
		PHP_VERSION,
		$GLOBALS['wp_version']
	);

	return sprintf(
		/* translators: 1. requirement message, 2. installed message */
		__( '<p>%1$s</p><p>%2$s</p><p>Please upgrade and try again.</p>', '<%= opts.projectSlug %>' ),
		$requirement,
		$installed
	);
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::error( <%= opts.functionPrefix %>_upgrade_message() );
}

function <%= opts.functionPrefix %>_notice() {
	wp_admin_notice( <%= opts.functionPrefix %>_upgrade_message(), array( 'type' => 'error', 'paragraph_wrap' => false ) );
}

function <%= opts.functionPrefix %>_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', '<%= opts.functionPrefix %>_notice' );
}
add_action( 'after_switch_theme', '<%= opts.functionPrefix %>_switch_theme' );

function <%= opts.functionPrefix %>_customize() {
	wp_die( <%= opts.functionPrefix %>_upgrade_message(), '', array( 'back_link' => true ) );
}
add_action( 'load-customize.php', '<%= opts.functionPrefix %>_customize' );

function <%= opts.functionPrefix %>_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( <%= opts.functionPrefix %>_upgrade_message() );
	}
}
add_action( 'template_redirect', '<%= opts.functionPrefix %>_preview' );
