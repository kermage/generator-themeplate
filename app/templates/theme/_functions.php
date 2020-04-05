<?php

/**
 * <%= opts.themeName %> functions and definitions
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

/* generator-themeplate v<%= opts.generatorVersion %> */

/* ==================================================
Global constants
================================================== */
// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
define( '<%= opts.constantPrefix %>_NAME',         wp_get_theme( basename( __DIR__ ) )->get( 'Name' ) );
define( '<%= opts.constantPrefix %>_VERSION',      wp_get_theme( basename( __DIR__ ) )->get( 'Version' ) );
define( '<%= opts.constantPrefix %>_URI',          wp_get_theme( basename( __DIR__ ) )->get( 'ThemeURI' ) );
define( '<%= opts.constantPrefix %>_AUTHOR',       wp_get_theme( basename( __DIR__ ) )->get( 'Author' ) );
define( '<%= opts.constantPrefix %>_AUTHOR_URI',   wp_get_theme( basename( __DIR__ ) )->get( 'AuthorURI' ) );
define( '<%= opts.constantPrefix %>_PARENT_THEME', wp_get_theme( basename( __DIR__ ) )->get( 'Template' ) );
define( '<%= opts.constantPrefix %>_URL',          get_theme_root_uri( basename( __DIR__ ) ) . '/' . basename( __DIR__ ) . '/' );
define( '<%= opts.constantPrefix %>_PATH',         get_theme_root( basename( __DIR__ ) ) . '/' . basename( __DIR__ ) . '/' );
define( '<%= opts.constantPrefix %>_INCLUDES',     <%= opts.constantPrefix %>_PATH . 'includes/' );
define( '<%= opts.constantPrefix %>_DEBUG',        true );
// phpcs:enable

require_once '<%= opts.projectSlug %>/<%= opts.projectSlug %>.php';

/* ==================================================
Setup Theme
================================================== */

$<%= opts.functionPrefix %>_options = get_option( '<%= opts.functionPrefix %>-options' );

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

function <%= opts.functionPrefix %>_options( $key = '', $default = false ) {
	$options = get_option( '<%= opts.functionPrefix %>-options', $default );
	$value   = $default;

	if ( empty( $key ) ) {
		$value = $options;
	} elseif ( is_array( $options ) && array_key_exists( $key, $options ) && false !== $options[ $key ] ) {
		$value = $options[ $key ];
	}

	return $value;
}

