<?php

/**
 * Register theme features
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_setup' ) ) {
	function <%= opts.functionPrefix %>_setup() {
		// Make theme available for Translation
		load_theme_textdomain( '<%= opts.projectSlug %>', <%= opts.constantPrefix %>_PATH . 'languages' );
		// Add theme support for Post Formats
		add_theme_support( 'post-formats', array( 'link', 'image', 'quote', 'video', 'audio' ) );
		// Add theme support for Featured Images
		add_theme_support( 'post-thumbnails' );
		// Add theme support for Automatic Feed Links
		add_theme_support( 'automatic-feed-links' );
		// Add theme support for HTML5 Semantic Markup
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		// Add theme support for document Title tag
		add_theme_support( 'title-tag' );

		// Add theme image sizes
		add_image_size( 'max', 1920, 1080 );
	}
	add_action( 'after_setup_theme', '<%= opts.functionPrefix %>_setup' );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_credit' ) ) {
	function <%= opts.functionPrefix %>_credit() {
		$theme = wp_get_theme( <%= opts.constantPrefix %>_BASE );

		return sprintf(
			'<a href="%1$s" target="_blank">%2$s %3$s</a> %4$s <span class="dashicons dashicons-heart"></span> by <a href="%5$s" target="_blank">%6$s</a>.',
			$theme->get( 'ThemeURI' ),
			$theme->get( 'Name' ),
			$theme->get( 'Version' ),
			__( 'designed and developed with', '<%= opts.projectSlug %>' ),
			$theme->get( 'AuthorURI' ),
			$theme->get( 'Author' )
		);
	}
	// Add to the admin footer
	add_filter( 'admin_footer_text', '<%= opts.functionPrefix %>_credit' );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_updates' ) ) {
	function <%= opts.functionPrefix %>_updates( $value ) {
		unset( $value->response[ get_stylesheet() ] );
		return $value;
	}
	// Disable update notification from WordPress.org repository theme
	add_filter( 'pre_set_site_transient_update_themes', '<%= opts.functionPrefix %>_updates' );
}
