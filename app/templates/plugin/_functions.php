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
 *
 * Requires at least: 6.0
 * Tested up to:      6.0
 * Requires PHP:      7.4
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
define( '<%= opts.constantPrefix %>_PLUGIN_FILE', __FILE__ );
define( '<%= opts.constantPrefix %>_PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( '<%= opts.constantPrefix %>_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// phpcs:enable

function <%= opts.functionPrefix %>_options( $key = '', $default = false ) {
	if ( class_exists( 'ThemePlate' ) && ThemePlate::is_initialized() ) {
		$value = ThemePlate()->get_option( $key );

		if ( ! $value ) {
			$value = $default;
		}

		return $value;
	}

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

