<?php

/**
 * Register custom post types
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

ThemePlate()->post_type( array(
	'name'        => 'portfolio',
	'plural'      => __( 'Portfolio', '<%= opts.projectSlug %>' ),
	'singular'    => __( 'Portfolio', '<%= opts.projectSlug %>' ),
	'description' => __( 'Portfolio', '<%= opts.projectSlug %>' ),
	'args'        => array(
		'public'          => true,
		// 'exclude_from_search' => false,
		// 'publicly_queryable'  => true,
		// 'show_ui'             => true,
		// 'show_in_nav_menus'   => true,
		// 'show_in_menu'        => true,
		// 'show_in_admin_bar'   => true,
		'menu_position'   => 5,
		'menu_icon'       => 'dashicons-media-document',
		'capability_type' => 'post',
		'hierarchical'    => false,
		'supports'        => array( 'title', 'editor', 'thumbnail' ),
		// 'taxonomies'          => array( 'category', 'post_tag' ),
		'has_archive'     => true,
		'rewrite'         => array(
			'slug'       => 'portfolio',
			'with_front' => false,
		),
	),
) );

ThemePlate()->taxonomy( array(
	'name'        => 'portfolio-cat',
	'plural'      => __( 'Categories', '<%= opts.projectSlug %>' ),
	'singular'    => __( 'Category', '<%= opts.projectSlug %>' ),
	'description' => __( 'Portfolio Category', '<%= opts.projectSlug %>' ),
	'type'        => 'portfolio',
	'args'        => array(
		'public'            => true,
		// 'show_ui'            => true,
		// 'show_in_menu'       => true,
		// 'show_in_nav_menus'  => true,
		// 'show_tagcloud'      => true,
		// 'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'portfolio-cat' ),
	),
) );

ThemePlate()->taxonomy( array(
	'name'        => 'portfolio-tag',
	'plural'      => __( 'Tags', '<%= opts.projectSlug %>' ),
	'singular'    => __( 'Tag', '<%= opts.projectSlug %>' ),
	'description' => __( 'Portfolio Tag', '<%= opts.projectSlug %>' ),
	'type'        => 'portfolio',
	'args'        => array(
		'public'            => true,
		// 'show_ui'            => true,
		// 'show_in_menu'       => true,
		// 'show_in_nav_menus'  => true,
		// 'show_tagcloud'      => true,
		// 'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'rewrite'           => array( 'slug' => 'portfolio-tag' ),
	),
) );
