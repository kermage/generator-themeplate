<?php

/**
 * Plugin Name: <%= opts.themeName %>
 * Plugin URI:  <%= opts.themeURI %>
 * Author:      <%= opts.authorName %>
 * Author URI:  <%= opts.authorURI %>
 * Description: <%= opts.description %>
 * Version:     0.1.0
 * License:     <%= opts.license %>
 * License URI: <%= opts.licenseURI %>
 * Text Domain: <%= opts.projectSlug %>
 * Tags:        generator-themeplate, translation-ready, accessibility-ready
 */


/* generator-themeplate v<%= opts.generatorVersion %> */

/* ==================================================
Global constants
================================================== */
// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
define( '<%= opts.constantPrefix %>_PLUGIN_FILE', __FILE__ );
define( '<%= opts.constantPrefix %>_PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( '<%= opts.constantPrefix %>_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// phpcs:enable

/* ==================================================
Setup Plugin
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
require_once 'setup/hooks.php';

/* ==================================================
Extra custom functions
================================================== */

