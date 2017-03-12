<?php

/**
 * Register navigation menus
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

require_once( THEME_INC . 'nav-walker.php' );
<% if ( opts.bootstrap ) { %>require_once( THEME_INC . 'bootstrap-walker.php' );<% } %>

if( ! function_exists( '<%= opts.functionPrefix %>_navigations' ) ) {
	function <%= opts.functionPrefix %>_navigations() {
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', '<%= opts.functionPrefix %>' ),
			'footer'  => __( 'Footer Menu', '<%= opts.functionPrefix %>' )
		) );
	}
	add_action( 'after_setup_theme', '<%= opts.functionPrefix %>_navigations' );
}

// Default Walker
if( ! function_exists( '<%= opts.functionPrefix %>_walker' ) ) {
	function <%= opts.functionPrefix %>_walker( $args ) {
		$args['container'] = false;
		if ( empty( $args['walker'] ) ) {
			$args['walker'] = new <%= opts.classPrefix %>_Nav_Walker();
		}
		$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		return $args;
	}
	add_filter( 'wp_nav_menu_args', '<%= opts.functionPrefix %>_walker' );
}

// Primary Menu
if( ! function_exists( '<%= opts.functionPrefix %>_primary_menu' ) ) {
	function <%= opts.functionPrefix %>_primary_menu() {
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			<% if ( opts.bootstrap ) { %>'menu_class'      => 'nav navbar-nav',
			'walker'          => new Bootstrap_Nav_Walker(),<% } %>
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
