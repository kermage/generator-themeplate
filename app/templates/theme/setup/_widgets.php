<?php

/**
 * Register widget areas
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_widgets_init' ) ) {
	function <%= opts.functionPrefix %>_widgets_init() {
		register_sidebar( array(
			'id'            => 'sidebar',
			'name'          => __( 'Sidebar Area', '<%= opts.projectSlug %>' ),
			'description'   => __( 'Add widgets here to appear in sidebar.', '<%= opts.projectSlug %>' ),
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<section class="widget %2$s">',
			'after_widget'  => '</section>',
		) );
		register_sidebars( 3, array(
			'id'            => 'footer',
			/* translators: count */
			'name'          => __( 'Footer Area %d', '<%= opts.projectSlug %>' ),
			'description'   => __( 'Add widgets here to appear in footer.', '<%= opts.projectSlug %>' ),
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'before_widget' => '<section class="widget %2$s">',
			'after_widget'  => '</section>',
		) );

		$widgets = glob( <%= opts.constantPrefix %>_THEME_PATH . 'widgets/class-*-widget.php' );

		foreach ( $widgets as $widget ) {
			$name = basename( $widget, '.php' );
			$name = str_replace( array( 'class-', '-widget' ), array( '', '_Widget' ), $name );
			$name = ucfirst( $name );

			require_once $widget;

			if ( class_exists( '<%= opts.classPrefix %>_' . $name ) ) {
				register_widget( '<%= opts.classPrefix %>_' . $name );
			}
		}
	}
	add_action( 'widgets_init', '<%= opts.functionPrefix %>_widgets_init' );
}
