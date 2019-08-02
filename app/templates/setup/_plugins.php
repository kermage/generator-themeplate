<?php

/**
 * Require Plugins
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// TGM Plugin Activation
require_once <%= opts.constantPrefix %>_INCLUDES . 'class-tgm-plugin-activation.php';

if ( ! function_exists( '<%= opts.functionPrefix %>_plugins' ) ) {
	function <%= opts.functionPrefix %>_plugins() {
		$plugins = array(
			array(
				'name'             => 'ThemePlate',
				'slug'             => 'themeplate',
				'required'         => true,
				'source'           => 'https://github.com/kermage/ThemePlate/releases/download/v3.6.0/themeplate.zip',
				'force_activation' => true,
			),
			array(
				'name'   => 'Augment Types',
				'slug'   => 'augment-types',
				'source' => 'https://github.com/kermage/augment-types/releases/download/v1.5.0/augment-types.zip',
			),
			array(
				'name' => 'Enable Media Replace',
				'slug' => 'enable-media-replace',
			),
			array(
				'name' => 'Regenerate Thumbnails',
				'slug' => 'regenerate-thumbnails',
			),
			array(
				'name' => 'ShortPixel Image Optimizer',
				'slug' => 'shortpixel-image-optimizer',
			),
			array(
				'name' => 'W3 Total Cache',
				'slug' => 'w3-total-cache',
			),
			array(
				'name' => 'Wordfence Security',
				'slug' => 'wordfence',
			),
			array(
				'name' => 'Yoast SEO',
				'slug' => 'wordpress-seo',
			),
		);

		$config = array(
			'id'           => '<%= opts.functionPrefix %>-tgmpa',
			'menu'         => '<%= opts.functionPrefix %>-plugins',
			'parent_slug'  => '<%= opts.functionPrefix %>-options',
			'dismissable'  => false,
			'is_automatic' => true,
		);

		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', '<%= opts.functionPrefix %>_plugins' );
}
