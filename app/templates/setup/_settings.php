<?php

/**
 * Register settings
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_settings' ) ) {
	function <%= opts.functionPrefix %>_settings() {
		ThemePlate()->settings( array(
			'id'          => 'google',
			'title'       => __( 'Google Codes', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter the tracking IDs to use in site.', '<%= opts.projectSlug %>' ),
			'context'     => 'normal',
			'fields'      => array(
				'analytics' => array(
					'name'     => __( 'Analytics', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'UA-XXXXX-Y', '<%= opts.projectSlug %>' ),
					'type'     => 'text'
				),
				'tagmanager' => array(
					'name'     => __( 'Tag Manager', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'GTM-XXXX', '<%= opts.projectSlug %>' ),
					'type'     => 'text'
				)
			)
		) );

		ThemePlate()->settings( array(
			'id'          => 'general',
			'title'       => __( 'General', '<%= opts.projectSlug %>' ),
			'description' => __( 'Description', '<%= opts.projectSlug %>' ),
			'context'     => 'normal',
			'fields'      => array(
				'description' => array(
					'name'     => __( 'Description', '<%= opts.projectSlug %>' ),
					'type'     => 'text'
				),
				'copyright' => array(
					'name'     => __( 'Copyright', '<%= opts.projectSlug %>' ),
					'type'     => 'textarea'
				),
				'template' => array(
					'name'     => __( 'Default Template', '<%= opts.projectSlug %>' ),
					'type'     => 'select',
					'options'  => array( 'Header; Footer', 'No Header; Footer', 'Header; No Footer', 'No Header; No Footer' )
					// 'multiple' => true
				),
				'layout' => array(
					'name'     => __( 'Default Layout', '<%= opts.projectSlug %>' ),
					'type'     => 'radio',
					'options'  => array( 'Content Left; Sidebar Right', 'Content Right; Sidebar Left', 'Fullwidth Page' )
				),
				'disable' => array(
					'name'     => __( 'Disable Titles', '<%= opts.projectSlug %>' ),
					'type'     => 'checkbox'
				),
				'color' => array(
					'name'     => __( 'Accent Color', '<%= opts.projectSlug %>' ),
					'type'     => 'color'
				),
				'logo' => array(
					'name'     => __( 'Site Logo', '<%= opts.projectSlug %>' ),
					'type'     => 'file'
				),
				'date' => array(
					'name'     => __( 'Date', '<%= opts.projectSlug %>' ),
					'type'     => 'date'
				),
				'time' => array(
					'name'     => __( 'Time', '<%= opts.projectSlug %>' ),
					'type'     => 'time'
				),
				'number' => array(
					'name'     => __( 'Number', '<%= opts.projectSlug %>' ),
					'type'     => 'number'
				)
			)
		) );
	}
	add_action( 'admin_init', '<%= opts.functionPrefix %>_settings' );
}
