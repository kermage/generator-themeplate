<?php

/**
 * Register custom post types
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_post_types' ) ) {
	function <%= opts.functionPrefix %>_post_types() {
		ThemePlate()->post_type( array(
			'name'        => 'portfolio',
			'plural'      => __( 'Portfolio', '<%= opts.functionPrefix %>' ),
			'singular'    => __( 'Portfolio', '<%= opts.functionPrefix %>' ),
			'description' => __( 'Portfolio', '<%= opts.functionPrefix %>' ),
			'args' => array(
				'public'              => true,
				// 'exclude_from_search' => false,
				// 'publicly_queryable'  => true,
				// 'show_ui'             => true,
				// 'show_in_nav_menus'   => true,
				// 'show_in_menu'        => true,
				// 'show_in_admin_bar'   => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-media-document',
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'editor', 'thumbnail' ),
				'has_archive'         => true,
				'rewrite'             => array( 'slug' => 'portfolio', 'with_front' => false )
			)
		) );

		ThemePlate()->taxonomy( array(
			'name'        => 'portfolio-cat',
			'plural'      => __( 'Categories', '<%= opts.functionPrefix %>' ),
			'singular'    => __( 'Category', '<%= opts.functionPrefix %>' ),
			'description' => __( 'Portfolio Category', '<%= opts.functionPrefix %>' ),
			'type'        => 'portfolio',
			'args' => array(
				'public'             => true,
				// 'show_ui'            => true,
				// 'show_in_menu'       => true,
				// 'show_in_nav_menus'  => true,
				// 'show_tagcloud'      => true,
				// 'show_in_quick_edit' => true,
				'show_admin_column'  => true,
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'portfolio-cat' )
			)
		) );

		ThemePlate()->taxonomy( array(
			'name'        => 'portfolio-tag',
			'plural'      => __( 'Tags', '<%= opts.functionPrefix %>' ),
			'singular'    => __( 'Tag', '<%= opts.functionPrefix %>' ),
			'description' => __( 'Portfolio Tag', '<%= opts.functionPrefix %>' ),
			'type'        => 'portfolio',
			'args' => array(
				'public'             => true,
				// 'show_ui'            => true,
				// 'show_in_menu'       => true,
				// 'show_in_nav_menus'  => true,
				// 'show_tagcloud'      => true,
				// 'show_in_quick_edit' => true,
				'show_admin_column'  => true,
				'hierarchical'       => false,
				'rewrite'            => array( 'slug' => 'portfolio-tag' )
			)
		) );
	}
	add_action( 'init', '<%= opts.functionPrefix %>_post_types' );
}
