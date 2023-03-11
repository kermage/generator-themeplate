<?php

/**
 * Enqueue scripts and styles
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_scripts_styles_early' ) ) {
	function <%= opts.functionPrefix %>_scripts_styles_early() {
		$suffix = ( SCRIPT_DEBUG || <%= opts.constantPrefix %>_THEME_DEBUG ) ? '' : '.min';
		$theme  = wp_get_theme( <%= opts.constantPrefix %>_THEME_BASE );

		// Deregister the jquery version bundled with WordPress
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate' );
		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header
		wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery' . $suffix . '.js', array(), '3.6.4', false );
		wp_register_script( 'jquery-migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate' . $suffix . '.js', array(), '3.4.1', false );
		wp_add_inline_script( 'jquery', 'jQuery.noConflict();' );

		// jQuery
		wp_enqueue_script( 'jquery' );
		// Google Fonts
		wp_enqueue_style( '<%= opts.functionPrefix %>-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,600,800&display=swap', array(), $theme->get( 'Version' ) );
		<%_ if ( opts.fontawesome ) { _%>
		// Font Awesome
		wp_enqueue_script( '<%= opts.functionPrefix %>-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js', array(), '5.15.4', false );
		wp_add_inline_script( '<%= opts.functionPrefix %>-fontawesome', 'FontAwesomeConfig = { searchPseudoElements: true };' );
		<%_ } _%>
	}
	add_action( 'wp_enqueue_scripts', '<%= opts.functionPrefix %>_scripts_styles_early', 5 );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_scripts_styles_late' ) ) {
	function <%= opts.functionPrefix %>_scripts_styles_late() {
		$suffix = ( SCRIPT_DEBUG || <%= opts.constantPrefix %>_THEME_DEBUG ) ? '' : '.min';
		$theme  = wp_get_theme( <%= opts.constantPrefix %>_THEME_BASE );

		// Site scripts and styles
		wp_enqueue_style( '<%= opts.functionPrefix %>-style', <%= opts.constantPrefix %>_THEME_URL . 'assets/css/<%= opts.projectSlug %>' . $suffix . '.css', array(), $theme->get( 'Version' ) );
		wp_enqueue_script( '<%= opts.functionPrefix %>-script', <%= opts.constantPrefix %>_THEME_URL . 'assets/js/<%= opts.projectSlug %>' . $suffix . '.js', array(), $theme->get( 'Version' ), true );

		$<%= opts.functionPrefix %>_options = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);
		wp_localize_script( '<%= opts.functionPrefix %>-script', '<%= opts.functionPrefix %>_options', apply_filters( '<%= opts.functionPrefix %>_localize_script', $<%= opts.functionPrefix %>_options ) );
	}
	add_action( 'wp_enqueue_scripts', '<%= opts.functionPrefix %>_scripts_styles_late', 20 );
}

// Async Scripts
if ( ! function_exists( '<%= opts.functionPrefix %>_async_scripts' ) ) {
	function <%= opts.functionPrefix %>_async_scripts( $tag, $handle ) {
		// Add script handles
		$scripts = array();

		if ( in_array( $handle, $scripts, true ) ) {
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
			<%_ if ( opts.fontawesome ) { _%>
			'<%= opts.functionPrefix %>-fontawesome',
			<%_ } _%>
		);

		if ( in_array( $handle, $scripts, true ) ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}

		return $tag;
	}
	add_filter( 'script_loader_tag', '<%= opts.functionPrefix %>_defer_scripts', 10, 2 );
}
