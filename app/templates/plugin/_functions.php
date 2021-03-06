<?php

/**
 * Plugin Name: <%= opts.projectName %>
 * Plugin URI:  <%= opts.projectURI %>
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

/*
 * ==================================================
 * Global constants
 * ==================================================
 */
// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
define( '<%= opts.constantPrefix %>_PLUGIN_FILE', __FILE__ );
define( '<%= opts.constantPrefix %>_PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( '<%= opts.constantPrefix %>_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// phpcs:enable

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


/*
 * ==================================================
 * Setup Plugin
 * ==================================================
 */

if ( class_exists( 'ThemePlate' ) ) :
	ThemePlate( array(
		'title' => '<%= opts.projectName %>',
		'key'   => '<%= opts.functionPrefix %>',
	) );
	require_once 'setup/post-types.php';
	require_once 'setup/settings.php';
	require_once 'setup/meta-boxes.php';
endif;

require_once 'setup/plugins.php';
require_once 'setup/hooks.php';
require_once 'setup/actions-filters.php';


/*
 * ==================================================
 * Extra custom functions
 * ==================================================
 */

