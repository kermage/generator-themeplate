<?php

/**
 * Register custom post types
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

ThemePlate()->post_type( array(
	'name'        => 'portfolio',
	'plural'      => __( 'Portfolio', '<%= opts.projectSlug %>' ),
	'singular'    => __( 'Portfolio', '<%= opts.projectSlug %>' ),
	'description' => __( 'Portfolio', '<%= opts.projectSlug %>' ),
	'args'        => array(
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-media-document',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	),
) );

ThemePlate()->taxonomy( array(
	'name'        => 'portfolio-cat',
	'plural'      => __( 'Categories', '<%= opts.projectSlug %>' ),
	'singular'    => __( 'Category', '<%= opts.projectSlug %>' ),
	'description' => __( 'Portfolio Category', '<%= opts.projectSlug %>' ),
	'type'        => 'portfolio',
	'args'        => array(
		'hierarchical' => true,
	),
) );

ThemePlate()->taxonomy( array(
	'name'        => 'portfolio-tag',
	'plural'      => __( 'Tags', '<%= opts.projectSlug %>' ),
	'singular'    => __( 'Tag', '<%= opts.projectSlug %>' ),
	'description' => __( 'Portfolio Tag', '<%= opts.projectSlug %>' ),
	'type'        => 'portfolio',
) );
