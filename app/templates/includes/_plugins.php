<?php

/**
 * Require Plugins
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// TGM Plugin Activation
require_once( THEME_INC . 'class-tgm-plugin-activation.php' );

if( ! function_exists( '<%= opts.functionPrefix %>_plugins' ) ) {
	function <%= opts.functionPrefix %>_plugins() {
		$plugins = array(
			array(
				'name'             => 'ThemePlate',
				'slug'             => 'themeplate',
				'required'         => true,
				'source'           => 'https://github.com/kermage/ThemePlate/archive/master.zip',
				'force_activation' => true
			)
		);

		$config = array(
			'id'           => '<%= opts.functionPrefix %>-tgmpa',
			'menu'         => '<%= opts.functionPrefix %>-plugins',
			'parent_slug'  => '<%= opts.functionPrefix %>-settings',
			'dismissable'  => false,
			'is_automatic' => true
		);

		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', '<%= opts.functionPrefix %>_plugins' );
}
