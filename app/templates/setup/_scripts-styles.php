<?php

/**
 * Enqueue scripts and styles
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_scripts_styles' ) ) {
	function <%= opts.functionPrefix %>_scripts_styles() {
		$suffix = ( WP_DEBUG || SCRIPT_DEBUG || THEME_DEBUG ) ? '' : '.min';

		// Deregister the jquery version bundled with WordPress
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate' );
		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header
		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-2.2.4' . $suffix . '.js', array(), '2.2.4', false );
		wp_register_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-1.4.1' . $suffix . '.js', array(), '1.4.1', false );
		wp_add_inline_script( 'jquery', 'jQuery.noConflict();' );

		// Google Fonts
		wp_enqueue_style( '<%= opts.functionPrefix %>-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,600,800' );
		// Font Awesome
		wp_enqueue_script( '<%= opts.functionPrefix %>-fontawesome', 'https://use.fontawesome.com/releases/v5.0.6/js/all.js', array(), '5.0.6', false );<% if ( opts.bootstrap ) { %>
		wp_add_inline_script( '<%= opts.functionPrefix %>-fontawesome', 'FontAwesomeConfig = { searchPseudoElements: true };' );
		// Bootstrap
		wp_enqueue_script( '<%= opts.functionPrefix %>-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap' . $suffix . '.js', array(), '4.0.0', true );<% } %>

		// Site scripts and styles
		wp_enqueue_style( '<%= opts.functionPrefix %>-style', THEME_URL . 'assets/css/<%= opts.projectSlug %>' . $suffix . '.css', array(), THEME_VERSION, false );
		wp_enqueue_script( '<%= opts.functionPrefix %>-script', THEME_URL . 'assets/js/<%= opts.projectSlug %>' . $suffix . '.js', array(), THEME_VERSION, true );

		$<%= opts.functionPrefix %>_options = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( '<%= opts.functionPrefix %>-script', '<%= opts.functionPrefix %>_options', apply_filters( '<%= opts.functionPrefix %>_localize_script', $<%= opts.functionPrefix %>_options ) );
	}
	add_action( 'wp_enqueue_scripts', '<%= opts.functionPrefix %>_scripts_styles', 20 );
}

// Async Scripts
if ( ! function_exists( '<%= opts.functionPrefix %>_async_scripts' ) ) {
	function <%= opts.functionPrefix %>_async_scripts( $tag, $handle ) {
		// Add script handles
		$scripts = array();

		if ( in_array( $handle, $scripts ) ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}

		return $tag;
	}
	add_filter( 'script_loader_tag', '<%= opts.functionPrefix %>_async_scripts', 10, 2 );
}

// Defer Scripts
if ( ! function_exists( '<%= opts.functionPrefix %>_defer_scripts' ) ) {
	function <%= opts.functionPrefix %>_defer_scripts( $tag, $handle ) {
		// Add script handles
		$scripts = array(
			'<%= opts.functionPrefix %>-fontawesome'
		);

		if ( in_array( $handle, $scripts ) ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}

		return $tag;
	}
	add_filter( 'script_loader_tag', '<%= opts.functionPrefix %>_defer_scripts', 10, 2 );
}
