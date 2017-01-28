<?php

/**
 * Setup custom post types
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_add_post_type' ) ) {
	function <%= opts.functionPrefix %>_add_post_type( $param ) {
		$plural = $param['plural'];
		$singular = $param['singular'];
		$args = $param['args'];

		$labels = array(
			'name'                  => _x( $plural, 'Post Type General Name', '<%= opts.functionPrefix %>' ),
			'singular_name'         => _x( $singular, 'Post Type Singular Name', '<%= opts.functionPrefix %>' ),
			'add_new'               => __( 'Add New ' . $singular, '<%= opts.functionPrefix %>' ),
			'add_new_item'          => __( 'Add New ' . $singular, '<%= opts.functionPrefix %>' ),
			'edit_item'             => __( 'Edit ' . $singular, '<%= opts.functionPrefix %>' ),
			'new_item'              => __( 'New ' . $singular, '<%= opts.functionPrefix %>' ),
			'view_item'             => __( 'View ' . $singular, '<%= opts.functionPrefix %>' ),
			'update_item'           => __( 'Update ' . $singular, '<%= opts.functionPrefix %>' ),
			'search_items'          => __( 'Search ' . $singular, '<%= opts.functionPrefix %>' ),
			'not_found'             => __( $singular . ' not found', '<%= opts.functionPrefix %>' ),
			'not_found_in_trash'    => __( $singular . ' not found in Trash', '<%= opts.functionPrefix %>' ),
			'parent_item_colon'     => __( 'Parent ' . $singular . ':', '<%= opts.functionPrefix %>' ),
			'all_items'             => __( 'All ' . $plural, '<%= opts.functionPrefix %>' ),
			'archives'              => __( $singular . ' Archives', '<%= opts.functionPrefix %>' ),
			'insert_into_item'      => __( 'Insert into ' . $singular, '<%= opts.functionPrefix %>' ),
			'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular, '<%= opts.functionPrefix %>' ),
			'featured_image'        => __( $singular . ' Featured Image', '<%= opts.functionPrefix %>' ),
			'set_featured_image'    => __( 'Set ' . $singular . ' Featured Image', '<%= opts.functionPrefix %>' ),
			'remove_featured_image' => __( 'Remove ' . $singular . ' Featured Image', '<%= opts.functionPrefix %>' ),
			'use_featured_image'    => __( 'Use as ' . $singular . ' Featured Image', '<%= opts.functionPrefix %>' ),
			'menu_name'             => __( $plural, '<%= opts.functionPrefix %>' ),
			'name_admin_bar'        => __( $plural, '<%= opts.functionPrefix %>' )
		);
		$defaults = array(
			'label'         => __( $plural, '<%= opts.functionPrefix %>' ),
			'labels'        => $labels,
			'description'   => __( $param['description'], '<%= opts.functionPrefix %>' )
		);

		register_post_type( $param['name'], wp_parse_args( $args, $defaults ) );
	}
}

if( ! function_exists( '<%= opts.functionPrefix %>_add_taxonomy' ) ) {
	function <%= opts.functionPrefix %>_add_taxonomy( $param ) {
		$plural = $param['plural'];
		$singular = $param['singular'];
		$args = $param['args'];

		$labels = array(
			'name'                          => _x( $plural, 'Taxonomy General Name', '<%= opts.functionPrefix %>' ),
			'singular_name'                 => _x( $singular, 'Taxonomy Singular Name', '<%= opts.functionPrefix %>' ),
			'menu_name'                     => __( $plural, '<%= opts.functionPrefix %>' ),
			'all_items'                     => __( 'All ' . $plural, '<%= opts.functionPrefix %>' ),
			'edit_item'                     => __( 'Edit ' . $singular, '<%= opts.functionPrefix %>' ),
			'view_item'                     => __( 'View ' . $singular, '<%= opts.functionPrefix %>' ),
			'update_item'                   => __( 'Update ' . $singular, '<%= opts.functionPrefix %>' ),
			'add_new_item'                  => __( 'Add New ' . $singular, '<%= opts.functionPrefix %>' ),
			'new_item_name'                 => __( 'New ' . $singular . ' Name', '<%= opts.functionPrefix %>' ),
			'parent_item'                   => __( 'Parent ' . $singular, '<%= opts.functionPrefix %>' ),
			'parent_item_colon'             => __( 'Parent ' . $singular . ':', '<%= opts.functionPrefix %>' ),
			'search_items'                  => __( 'Search ' . $singular, '<%= opts.functionPrefix %>' ),
			'popular_items'                 => __( 'Popular ' . $singular, '<%= opts.functionPrefix %>' ),
			'separate_items_with_commas'    => __( 'Separate ' . $plural . ' with commas', '<%= opts.functionPrefix %>' ),
			'add_or_remove_items'           => __( 'Add or remove ' . $plural, '<%= opts.functionPrefix %>' ),
			'choose_from_most_used'         => __( 'Choose from the most used ' . $singular, '<%= opts.functionPrefix %>' ),
			'not_found'                     => __( $singular . ' not found', '<%= opts.functionPrefix %>' )
		);
		$defaults = array(
			'label'         => __( $plural, '<%= opts.functionPrefix %>' ),
			'labels'        => $labels,
			'description'   => __( $param['description'], '<%= opts.functionPrefix %>' )
		);

		register_taxonomy( $param['name'], $param['type'], wp_parse_args( $args, $defaults ) );
	}
}
