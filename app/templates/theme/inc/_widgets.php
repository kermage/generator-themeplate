<?php

/**
 * Register widget areas
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_widgets_init' ) ) {
	function <%= opts.functionPrefix %>_widgets_init() {
		register_sidebar( array(
			'id'			=> 'sidebar-1',
			'name'			=> __( 'Sidebar Area', '<%= opts.functionPrefix %>' ),
			'description'	=> __( 'Add widgets here to appear in sidebar.', '<%= opts.functionPrefix %>' ),
			'class'			=> 'widget-sidebar',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>'
		) );
	}
	add_action( 'widgets_init', '<%= opts.functionPrefix %>_widgets_init' );
}
