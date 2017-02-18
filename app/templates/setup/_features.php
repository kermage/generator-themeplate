<?php

/**
 * Register theme features
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_setup' ) ) {
	function <%= opts.functionPrefix %>_setup() {
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
	}
	add_action( 'after_setup_theme', '<%= opts.functionPrefix %>_setup' );
}

if( ! function_exists( '<%= opts.functionPrefix %>_credit' ) ) {
	function <%= opts.functionPrefix %>_credit() {
		return sprintf(
		   '<a href="%1$s" target="_blank">%2$s %3$s</a> %4$s <span class="dashicons dashicons-heart"></span> by <a href="%5$s" target="_blank">%6$s</a>.',
			THEME_URI,
			THEME_NAME,
			THEME_VERSION,
			__( 'designed and developed with', '<%= opts.functionPrefix %>' ),
			AUTHOR_URI,
			THEME_AUTHOR
		);
	}
	// Add to the admin footer
	add_filter( 'admin_footer_text', '<%= opts.functionPrefix %>_credit' );
}
