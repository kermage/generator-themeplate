<?php

/**
 * Enqueue scripts and styles
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_scripts_styles_registration' ) ) {
	function <%= opts.functionPrefix %>_scripts_styles_registration() {
		$suffix = ( SCRIPT_DEBUG || <%= opts.constantPrefix %>_THEME_DEBUG ) ? '' : '.min';
		$theme  = wp_get_theme( <%= opts.constantPrefix %>_THEME_BASE );

		// Deregister the jquery version bundled with WordPress
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate' );
		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header
		wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery' . $suffix . '.js', array(), '3.7.1', false );
		wp_register_script( 'jquery-migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate' . $suffix . '.js', array(), '3.4.1', false );

		// Google Fonts
		wp_register_style( '<%= opts.functionPrefix %>-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,600,800&display=swap', array(), $theme->get( 'Version' ) );
		<%_ if ( opts.fontawesome ) { _%>
		// Font Awesome
		wp_register_script( '<%= opts.functionPrefix %>-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js', array(), '6.4.2', array( 'strategy' => 'defer', 'in_footer' => false ) );
		<%_ } _%>
	}
	add_action( 'init', '<%= opts.functionPrefix %>_scripts_styles_registration' );
}

if ( ! function_exists( '<%= opts.functionPrefix %>_scripts_styles_early' ) ) {
	function <%= opts.functionPrefix %>_scripts_styles_early() {
		$suffix = ( SCRIPT_DEBUG || <%= opts.constantPrefix %>_THEME_DEBUG ) ? '' : '.min';
		$theme  = wp_get_theme( <%= opts.constantPrefix %>_THEME_BASE );

		// jQuery
		wp_enqueue_script( 'jquery' );
		wp_add_inline_script( 'jquery', 'jQuery.noConflict();' );
		// Google Fonts
		wp_enqueue_style( '<%= opts.functionPrefix %>-fonts' );
		<%_ if ( opts.fontawesome ) { _%>
		// Font Awesome
		wp_enqueue_script( '<%= opts.functionPrefix %>-fontawesome' );
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
