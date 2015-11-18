<?php

/**
 * Enqueue scripts and styles
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_scripts_styles' ) ) {
	function <%= opts.functionPrefix %>_scripts_styles() {
		// Site scripts and styles
		wp_enqueue_style( '<%= opts.functionPrefix %>-style', THEME_URL . 'css/<%= opts.projectSlug %>.css', array(), THEME_VERSION, false );
		wp_enqueue_script( '<%= opts.functionPrefix %>-script', THEME_URL . 'js/<%= opts.projectSlug %>.js', array(), THEME_VERSION, true );
		// Deregister the jquery version bundled with WordPress
		wp_deregister_script( 'jquery' );
		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header
		wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array(), '2.1.4', false );
	}
	add_action( 'wp_enqueue_scripts', '<%= opts.functionPrefix %>_scripts_styles' );
}

if( ! function_exists( '<%= opts.functionPrefix %>_admin_scripts_styles' ) ) {
	function <%= opts.functionPrefix %>_admin_scripts_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_style( '<%= opts.functionPrefix %>-metabox-style', THEME_URL . 'css/admin/metabox.css', array(), THEME_VERSION, false );
		wp_enqueue_script( '<%= opts.functionPrefix %>-metabox-script', THEME_URL . 'js/admin/metabox.js', array(), THEME_VERSION, true );
	}
	add_action( 'admin_enqueue_scripts', '<%= opts.functionPrefix %>_admin_scripts_styles' );
}
