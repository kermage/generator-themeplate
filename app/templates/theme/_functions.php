<?php

/**
 * <%= opts.themeName %> functions and definitions
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

/* ==================================================
Global constants
================================================== */
// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
define( '<%= opts.constantPrefix %>_NAME',         wp_get_theme()->get( 'Name' ) );
define( '<%= opts.constantPrefix %>_VERSION',      wp_get_theme()->get( 'Version' ) );
define( '<%= opts.constantPrefix %>_URI',          wp_get_theme()->get( 'ThemeURI' ) );
define( '<%= opts.constantPrefix %>_AUTHOR',       wp_get_theme()->get( 'Author' ) );
define( '<%= opts.constantPrefix %>_AUTHOR_URI',   wp_get_theme()->get( 'AuthorURI' ) );
define( '<%= opts.constantPrefix %>_PARENT_THEME', wp_get_theme()->get( 'Template' ) );
define( '<%= opts.constantPrefix %>_URL',          get_stylesheet_directory_uri() . '/' );
define( '<%= opts.constantPrefix %>_PATH',         get_stylesheet_directory() . '/' );
define( '<%= opts.constantPrefix %>_INCLUDES',     <%= opts.constantPrefix %>_PATH . 'includes/' );
define( '<%= opts.constantPrefix %>_DEBUG',        true );
// phpcs:enable

/* ==================================================
Setup Theme
================================================== */

if ( class_exists( 'ThemePlate' ) ) :
	ThemePlate( array(
		'title' => '<%= opts.themeName %>',
		'key'   => '<%= opts.functionPrefix %>',
	) );
	require_once 'setup/post-types.php';
	require_once 'setup/settings.php';
	require_once 'setup/meta-boxes.php';
endif;

require_once 'setup/plugins.php';
require_once 'setup/features.php';
require_once 'setup/navigations.php';
require_once 'setup/widgets.php';
require_once 'setup/scripts-styles.php';
require_once 'setup/actions-filters.php';
require_once 'setup/hooks.php';

/* ==================================================
Extra custom functions
================================================== */

