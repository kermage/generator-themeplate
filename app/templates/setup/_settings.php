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
				'analytics'  => array(
					'name' => __( 'Analytics', '<%= opts.projectSlug %>' ),
					'desc' => __( 'UA-XXXXX-Y', '<%= opts.projectSlug %>' ),
					'type' => 'text',
				),
				'tagmanager' => array(
					'name' => __( 'Tag Manager', '<%= opts.projectSlug %>' ),
					'desc' => __( 'GTM-XXXX', '<%= opts.projectSlug %>' ),
					'type' => 'text',
				),
			),
		) );

		ThemePlate()->settings( array(
			'id'          => 'social',
			'title'       => __( 'Social Profiles', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter the links to the associated service.', '<%= opts.projectSlug %>' ),
			'context'     => 'normal',
			'fields'      => array(
				'profiles' => array(
					'name'       => __( 'Service', '<%= opts.projectSlug %>' ),
					'type'       => 'group',
					'repeatable' => true,
					'fields'     => array(
						'provider' => array(
							'name'    => __( 'Provider', '<%= opts.projectSlug %>' ),
							'type'    => 'select',
							'options' => array(
								'facebook'  => 'Facebook',
								'twitter'   => 'Twitter',
								'instagram' => 'Instagram',
								'linkedin'  => 'LinkedIn',
							),
						),
						'link'     => array(
							'name' => __( 'Link', '<%= opts.projectSlug %>' ),
							'type' => 'url',
						),
					),
				),
			),
		) );
	}
	add_action( 'init', '<%= opts.functionPrefix %>_settings' );
}
