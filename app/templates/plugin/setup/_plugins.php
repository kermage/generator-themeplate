<?php

/**
 * Require Plugins
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

// TGM Plugin Activation
require_once <%= opts.constantPrefix %>_PLUGIN_PATH . 'includes/class-tgm-plugin-activation.php';

if ( ! function_exists( '<%= opts.functionPrefix %>_plugins' ) ) {
	function <%= opts.functionPrefix %>_plugins() {
		$plugins = array(
			array(
				'name'             => 'ThemePlate',
				'slug'             => 'themeplate',
				'required'         => true,
				'source'           => 'https://github.com/kermage/ThemePlate/releases/download/v3.19.0/themeplate.zip',
				'force_activation' => true,
			),
			array(
				'name' => 'Augment Types',
				'slug' => 'augment-types',
			),
			array(
				'name' => 'Enable Media Replace',
				'slug' => 'enable-media-replace',
			),
			array(
				'name' => 'Regenerate Thumbnails Advanced',
				'slug' => 'regenerate-thumbnails-advanced',
			),
			array(
				'name' => 'Safe SVG',
				'slug' => 'safe-svg',
			),
			array(
				'name' => 'ShortPixel Image Optimizer',
				'slug' => 'shortpixel-image-optimiser',
			),
			array(
				'name' => 'UpdraftPlus - Backup/Restore',
				'slug' => 'updraftplus',
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
				'name' => 'WP Mail SMTP by WPForms',
				'slug' => 'wp-mail-smtp',
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
			'dismissable'  => true,
			'is_automatic' => true,
		);

		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', '<%= opts.functionPrefix %>_plugins' );
}
