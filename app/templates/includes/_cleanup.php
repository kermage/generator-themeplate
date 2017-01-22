<?php

/**
 * Cleanup WordPress markup
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_markup_cleaner' ) ) {
	function <%= opts.functionPrefix %>_markup_cleaner() {
		// Cleanup wp_head()
		add_action( 'init', '<%= opts.functionPrefix %>_cleanup_head' );
		// Remove the WordPress version from RSS feeds
		add_filter( 'the_generator', '__return_false' );
		// Remove injected recent comments sidebar widget style
		add_action( 'widgets_init', '<%= opts.functionPrefix %>_remove_recent_comments_style', 1 );
		// Remove tag cloud inline style
		add_filter( 'wp_generate_tag_cloud', '<%= opts.functionPrefix %>_remove_tag_cloud_inline_style' );
		// Remove injected gallery shortcode style
		add_filter( 'use_default_gallery_style', '__return_false' );
		// Remove automatic paragraph tags
		// remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'shortcode_unautop', 100 );
		// remove_filter( 'the_excerpt', 'wpautop' );
		add_filter( 'the_excerpt', 'shortcode_unautop', 100 );
		// Remove unnecessary body and post classes
		add_filter( 'body_class', '<%= opts.functionPrefix %>_clean_body_class' );
		add_filter( 'post_class', '<%= opts.functionPrefix %>_clean_post_class' );
	}
	add_action( 'after_setup_theme','<%= opts.functionPrefix %>_markup_cleaner' );
}

if( ! function_exists( '<%= opts.functionPrefix %>_cleanup_head' ) ) {
	function <%= opts.functionPrefix %>_cleanup_head() {
		// Display the link to the Really Simple Discovery service endpoint.
		remove_action( 'wp_head', 'rsd_link' );
		// Display the link to the Windows Live Writer manifest file.
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// Display relational links for the posts adjacent to the current post for single post pages.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		// Output rel=canonical for singular queries.
		remove_action( 'wp_head', 'rel_canonical', 10, 0 );
		// Inject rel=shortlink into head if a shortlink is defined for the current page.
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		// Display the XHTML generator that is generated on the wp_head hook
		remove_action( 'wp_head', 'wp_generator' );
		// Emoji support detection script and styles
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji ');
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji ');
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		// Query strings from static resources
		add_filter( 'style_loader_src', '<%= opts.functionPrefix %>_remove_query_strings', 15, 1 );
		add_filter( 'script_loader_src', '<%= opts.functionPrefix %>_remove_query_strings', 15, 1 );
		// Output of <link> and <script> tags
		add_filter( 'style_loader_tag', '<%= opts.functionPrefix %>_clean_style_tag' );
		add_filter( 'script_loader_tag', '<%= opts.functionPrefix %>_clean_script_tag' );
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_remove_query_strings' ) ) {
	function <%= opts.functionPrefix %>_remove_query_strings( $src ) {
		return remove_query_arg( 'ver', $src );
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_clean_style_tag' ) ) {
	function <%= opts.functionPrefix %>_clean_style_tag( $input ) {
		preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
		// Only display media if it is meaningful
		$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
		return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_clean_script_tag' ) ) {
	function <%= opts.functionPrefix %>_clean_script_tag( $input ) {
		$input = str_replace( "type='text/javascript' ", '', $input );
		return str_replace( "'", '"', $input );
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_remove_recent_comments_style' ) ) {
	function <%= opts.functionPrefix %>_remove_recent_comments_style() {
		global $wp_widget_factory;
		if( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_clean_body_class' ) ) {
	function <%= opts.functionPrefix %>_clean_body_class( $classes ) {
		$match = '/((postid|attachmentid|page-id|parent-pageid|category|tag|term)-\d+$|(attachment|page-parent|page-child)$)/';
		foreach ( $classes as $key => $value ) {
			if( preg_match( $match, $value ) ) unset( $classes[$key] );
		}
		return $classes;
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_clean_post_class' ) ) {
	function <%= opts.functionPrefix %>_clean_post_class( $classes ) {
		$match = '/(post-\d+$|(type|status|category|tag)-[\w-]+$)/';
		foreach ( $classes as $key => $value ) {
			if( preg_match( $match, $value ) ) unset( $classes[$key] );
		}
		return $classes;
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_remove_tag_cloud_inline_style' ) ) {
	function <%= opts.functionPrefix %>_remove_tag_cloud_inline_style( $tag_string ) {
		return preg_replace( "/style='font-size:.+pt;'/", '', $tag_string );
	}
}
