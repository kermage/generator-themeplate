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
		// Register Navigation Menus
		register_nav_menus( array(
			'primary'	=> __( 'Primary Menu', '<%= opts.functionPrefix %>' ),
			'footer'	=> __( 'Footer Menu', '<%= opts.functionPrefix %>' )
		) );
	}
	add_action( 'after_setup_theme', '<%= opts.functionPrefix %>_setup' );
}
