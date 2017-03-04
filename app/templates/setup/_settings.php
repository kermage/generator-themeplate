<?php

/**
 * Register settings
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_settings' ) ) {
	function <%= opts.functionPrefix %>_settings() {
		ThemePlate()->settings( array(
			'id'          => 'general',
			'title'       => __( 'General', '<%= opts.functionPrefix %>' ),
			'description' => __( 'Description', '<%= opts.functionPrefix %>' ),
			'context'     => 'normal',
			'fields'      => array(
				'description' => array(
					'name'     => __( 'Description', '<%= opts.functionPrefix %>' ),
					'type'     => 'text'
				),
				'copyright' => array(
					'name'     => __( 'Copyright', '<%= opts.functionPrefix %>' ),
					'type'     => 'textarea'
				),
				'template' => array(
					'name'     => __( 'Default Template', '<%= opts.functionPrefix %>' ),
					'type'     => 'select',
					'options'  => array( 'Header; Footer', 'No Header; Footer', 'Header; No Footer', 'No Header; No Footer' )
					// 'multiple' => true
				),
				'layout' => array(
					'name'     => __( 'Default Layout', '<%= opts.functionPrefix %>' ),
					'type'     => 'radio',
					'options'  => array( 'Content Left; Sidebar Right', 'Content Right; Sidebar Left', 'Fullwidth Page' )
				),
				'disable' => array(
					'name'     => __( 'Disable Titles', '<%= opts.functionPrefix %>' ),
					'type'     => 'checkbox'
				),
				'color' => array(
					'name'     => __( 'Accent Color', '<%= opts.functionPrefix %>' ),
					'type'     => 'color'
				),
				'logo' => array(
					'name'     => __( 'Site Logo', '<%= opts.functionPrefix %>' ),
					'type'     => 'file'
				),
				'date' => array(
					'name'     => __( 'Date', '<%= opts.functionPrefix %>' ),
					'type'     => 'date'
				),
				'time' => array(
					'name'     => __( 'Time', '<%= opts.functionPrefix %>' ),
					'type'     => 'time'
				),
				'number' => array(
					'name'     => __( 'Number', '<%= opts.functionPrefix %>' ),
					'type'     => 'number'
				)
			)
		) );
	}
	add_action( 'admin_init', '<%= opts.functionPrefix %>_settings' );
}
