<?php

/**
 * Output navigation menus
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// Primary Menu
if( ! function_exists( '<%= opts.functionPrefix %>_primary_menu' ) ) {
	function <%= opts.functionPrefix %>_primary_menu() {
		wp_nav_menu( array(
			'theme_location'	=> 'primary',
			'menu'				=> '',
			'container'			=> false,
			'menu_id'			=> '<%= opts.functionPrefix %>-primary-nav',
			'depth'				=> 0
		) );
	}
}

// Footer Menu
if( ! function_exists( '<%= opts.functionPrefix %>_footer_menu' ) ) {
	function <%= opts.functionPrefix %>_footer_menu() {
		wp_nav_menu( array(
			'theme_location'	=> 'footer',
			'menu'				=> '',
			'container'			=> false,
			'menu_id'			=> '<%= opts.functionPrefix %>-site-links',
			'depth'				=> 1
		) );
	}
}
