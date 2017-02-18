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
define( 'THEME_NAME',       wp_get_theme()->get( 'Name' ) );
define( 'THEME_VERSION',    wp_get_theme()->get( 'Version' ) );
define( 'THEME_URI',        wp_get_theme()->get( 'ThemeURI' ) );
define( 'THEME_AUTHOR',     wp_get_theme()->get( 'Author' ) );
define( 'AUTHOR_URI',       wp_get_theme()->get( 'AuthorURI' ) );
define( 'PARENT_THEME',     wp_get_theme()->get( 'Template' ) );
define( 'THEME_URL',        get_stylesheet_directory_uri() . '/' );
define( 'THEME_PATH',       get_stylesheet_directory() . '/' );
define( 'THEME_INC',        THEME_PATH . 'includes/' );
define( 'THEME_DEBUG',      true );

/* ==================================================
Setup Theme
================================================== */
require_once( 'setup/plugins.php' );
require_once( 'setup/features.php' );
require_once( 'setup/navigations.php' );
require_once( 'setup/widgets.php' );
require_once( 'setup/scripts-styles.php' );
require_once( 'setup/settings.php' );
require_once( 'setup/post-types.php' );
require_once( 'setup/meta-boxes.php' );

/* ==================================================
Extra custom functions
================================================== */
require_once( THEME_INC . 'cleanup.php' );

