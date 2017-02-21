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
			'id'            => 'sidebar',
			'name'          => __( 'Sidebar Area', '<%= opts.functionPrefix %>' ),
			'description'   => __( 'Add widgets here to appear in sidebar.', '<%= opts.functionPrefix %>' ),
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<section class="widget %2$s">',
			'after_widget'  => '</section>'
		) );
		register_sidebars( 3, array(
			'id'            => 'footer',
			'name'          => __( 'Footer Area %d', '<%= opts.functionPrefix %>' ),
			'description'   => __( 'Add widgets here to appear in footer.', '<%= opts.functionPrefix %>' ),
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'before_widget' => '<section class="widget %2$s">',
			'after_widget'  => '</section>'
		) );

		$widgets = glob( THEME_PATH . 'widgets/*_widget.php' );
		foreach( $widgets as $widget ) {
			require_once $widget;
			if( class_exists( '<%= opts.classPrefix %>_' . basename( $widget, '.php' ) ) )
				register_widget( '<%= opts.classPrefix %>_' . basename( $widget, '.php' ) );
		}
	}
	add_action( 'widgets_init', '<%= opts.functionPrefix %>_widgets_init' );
}
