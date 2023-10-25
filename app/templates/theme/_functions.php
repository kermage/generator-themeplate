<?php

/**
 * <%= opts.projectName %> functions and definitions
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

/* generator-themeplate v<%= opts.generatorVersion %> */

// Accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * ==================================================
 * Global constants
 * ==================================================
 */
// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
define( '<%= opts.constantPrefix %>_THEME_BASE',  basename( __DIR__ ) );
define( '<%= opts.constantPrefix %>_THEME_URL',   get_theme_root_uri( <%= opts.constantPrefix %>_THEME_BASE ) . '/' . <%= opts.constantPrefix %>_THEME_BASE . '/' );
define( '<%= opts.constantPrefix %>_THEME_PATH',  get_theme_root( <%= opts.constantPrefix %>_THEME_BASE ) . '/' . <%= opts.constantPrefix %>_THEME_BASE . '/' );
define( '<%= opts.constantPrefix %>_THEME_DEBUG', true );

define( '<%= opts.constantPrefix %>_THEME_REQUIRES', array(
	'PHP' => '7.4',
	'WP'  => '6.4',
) );
// phpcs:enable

// Check if PHP and WordPress installed versions met the requirements
if ( version_compare( PHP_VERSION, <%= opts.constantPrefix %>_THEME_REQUIRES['PHP'], '<' ) || version_compare( $GLOBALS['wp_version'], <%= opts.constantPrefix %>_THEME_REQUIRES['WP'], '<' ) ) {
	require_once <%= opts.constantPrefix %>_THEME_PATH . 'includes/compatibility.php';
	return;
}

// Better move this folder (<%= opts.projectSlug %>) to the plugins directory, then remove these lines after
if ( file_exists( <%= opts.constantPrefix %>_THEME_PATH . '<%= opts.projectSlug %>/<%= opts.projectSlug %>.php' ) ) {
	function <%= opts.functionPrefix %>_stock_notice() {
		wp_admin_notice(
			sprintf(
				'Better move <strong>%s</strong> to <strong>%s</strong>.',
				wp_normalize_path( <%= opts.constantPrefix %>_PLUGIN_PATH ),
				wp_normalize_path( WP_PLUGIN_DIR )
			),
			array( 'type' => 'info' )
		);
	}

	add_action( 'admin_notices', '<%= opts.functionPrefix %>_stock_notice' );
	require_once '<%= opts.projectSlug %>/<%= opts.projectSlug %>.php';
}


/*
 * ==================================================
 * Setup Theme
 * ==================================================
 */

require_once 'setup/features.php';
require_once 'setup/navigations.php';
require_once 'setup/widgets.php';
require_once 'setup/scripts-styles.php';
require_once 'setup/actions-filters.php';


/*
 * ==================================================
 * Extra custom functions
 * ==================================================
 */

