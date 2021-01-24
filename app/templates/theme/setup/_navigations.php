<?php

/**
 * Register navigation menus
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_navigations' ) ) {
	function <%= opts.functionPrefix %>_navigations() {
		<%_ if ( 'bootstrap' === opts.framework ) { _%>
		// Bootstrap Nav Walker
		require_once <%= opts.constantPrefix %>_THEME_PATH . 'includes/class-bootstrap-navbar.php';

		<%_ } _%>
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', '<%= opts.projectSlug %>' ),
			'footer'  => __( 'Footer Menu', '<%= opts.projectSlug %>' ),
		) );
	}
	add_action( 'after_setup_theme', '<%= opts.functionPrefix %>_navigations' );
}

// Primary Menu
if ( ! function_exists( '<%= opts.functionPrefix %>_primary_menu' ) ) {
	function <%= opts.functionPrefix %>_primary_menu() {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			<%_ if ( 'bootstrap' === opts.framework ) { _%>
			'menu_class'     => 'nav navbar-nav',
			'walker'         => new Bootstrap_NavBar(),
			<%_ } _%>
			'depth'          => 0,
		) );
	}
}

// Footer Menu
if ( ! function_exists( '<%= opts.functionPrefix %>_footer_menu' ) ) {
	function <%= opts.functionPrefix %>_footer_menu() {
		wp_nav_menu( array(
			'theme_location' => 'footer',
			'depth'          => 1,
		) );
	}
}
