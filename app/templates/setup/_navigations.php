<?php

/**
 * Register navigation menus
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_navigations' ) ) {
	function <%= opts.functionPrefix %>_navigations() {
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', '<%= opts.functionPrefix %>' ),
			'footer'  => __( 'Footer Menu', '<%= opts.functionPrefix %>' )
		) );
	}
	add_action( 'after_setup_theme', '<%= opts.functionPrefix %>_navigations' );
}

// Primary Menu
if( ! function_exists( '<%= opts.functionPrefix %>_primary_menu' ) ) {
	function <%= opts.functionPrefix %>_primary_menu() {
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			<% if ( opts.bootstrap ) { %>'menu_class'      => 'nav navbar-nav',
			'walker'          => new Bootstrap_NavBar(),<% } %>
			'depth'           => 0
		) );
	}
}

// Footer Menu
if( ! function_exists( '<%= opts.functionPrefix %>_footer_menu' ) ) {
	function <%= opts.functionPrefix %>_footer_menu() {
		wp_nav_menu( array(
			'theme_location' => 'footer',
			'depth'          => 1
		) );
	}
}
