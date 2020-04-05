<?php

/**
 * Register settings
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

ThemePlate()->settings( array(
	'id'          => 'google',
	'title'       => __( 'Google Codes', '<%= opts.projectSlug %>' ),
	'description' => __( 'Enter the tracking IDs to use in site.', '<%= opts.projectSlug %>' ),
	'context'     => 'side',
	'fields'      => array(
		'analytics'  => array(
			'title'       => __( 'Analytics', '<%= opts.projectSlug %>' ),
			'description' => __( 'UA-XXXXX-Y', '<%= opts.projectSlug %>' ),
			'type'        => 'text',
		),
		'tagmanager' => array(
			'title'       => __( 'Tag Manager', '<%= opts.projectSlug %>' ),
			'description' => __( 'GTM-XXXX', '<%= opts.projectSlug %>' ),
			'type'        => 'text',
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
			'title'      => __( 'Service', '<%= opts.projectSlug %>' ),
			'type'       => 'group',
			'repeatable' => true,
			'fields'     => array(
				'provider' => array(
					'title'   => __( 'Provider', '<%= opts.projectSlug %>' ),
					'type'    => 'select',
					'options' => array(
						'facebook'    => 'Facebook',
						'twitter'     => 'Twitter',
						'instagram'   => 'Instagram',
						'linkedin'    => 'LinkedIn',
						'youtube'     => 'Youtube',
						'pinterest'   => 'Pinterest',
						'google-plus' => 'Google+',
					),
				),
				'link'     => array(
					'title' => __( 'Link', '<%= opts.projectSlug %>' ),
					'type'  => 'url',
				),
			),
		),
	),
) );
