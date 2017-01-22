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
define( 'THEME_INC',        THEME_PATH . 'inc/' );
define( 'THEME_DEBUG',      true );

/* ==================================================
Setup Theme
================================================== */
require_once( 'theme/features.php' );
require_once( 'theme/navigations.php' );
require_once( 'theme/widgets.php' );
require_once( 'theme/scripts-styles.php' );

/* ==================================================
Register settings
================================================== */
require_once( THEME_INC . 'settings/setup.php' );
require_once( THEME_INC . 'settings/entries.php' );

/* ==================================================
Register custom post types
================================================== */
require_once( THEME_INC . 'post-type/setup.php' );
require_once( THEME_INC . 'post-type/entries.php' );

/* ==================================================
Register meta boxes
================================================== */
require_once( THEME_INC . 'meta-box/setup.php' );
require_once( THEME_INC . 'meta-box/entries.php' );

/* ==================================================
Cleanup WordPress markup
================================================== */
require_once( THEME_INC . 'cleanup.php' );

