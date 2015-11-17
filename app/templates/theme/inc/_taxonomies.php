<?php

/**
 * Register custom taxonomies
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// Register Custom Taxonomy
if( ! function_exists( '<%= opts.functionPrefix %>_portfolio_tax' ) ) {
	function <%= opts.functionPrefix %>_portfolio_tax() {
		$labels = array(
			'name'							=> _x( 'Categories', 'Taxonomy General Name', '<%= opts.functionPrefix %>' ),
			'singular_name'					=> _x( 'Portfolio Item', 'Taxonomy Singular Name', '<%= opts.functionPrefix %>' ),
			'menu_name'						=> __( 'Categories', '<%= opts.functionPrefix %>' ),
			'all_items'						=> __( 'All Categories', '<%= opts.functionPrefix %>' ),
			'parent_item'					=> __( 'Parent Item', '<%= opts.functionPrefix %>' ),
			'parent_item_colon'				=> __( 'Parent Item:', '<%= opts.functionPrefix %>' ),
			'new_item_name'					=> __( 'New Categories Name', '<%= opts.functionPrefix %>' ),
			'add_new_item'					=> __( 'Add New Category', '<%= opts.functionPrefix %>' ),
			'edit_item'						=> __( 'Edit Category', '<%= opts.functionPrefix %>' ),
			'update_item'					=> __( 'Update Category', '<%= opts.functionPrefix %>' ),
			'view_item'						=> __( 'View Category', '<%= opts.functionPrefix %>' ),
			'separate_items_with_commas'	=> __( 'Separate items with commas', '<%= opts.functionPrefix %>' ),
			'add_or_remove_items'			=> __( 'Add or remove categories', '<%= opts.functionPrefix %>' ),
			'choose_from_most_used'			=> __( 'Choose from the most used', '<%= opts.functionPrefix %>' ),
			'popular_items'					=> __( 'Popular Categories', '<%= opts.functionPrefix %>' ),
			'search_items'					=> __( 'Search Categories', '<%= opts.functionPrefix %>' ),
			'not_found'						=> __( 'Not Found', '<%= opts.functionPrefix %>' )
		);
		$args = array(
			'labels'						=> $labels,
			'public'						=> true,
			'show_ui'						=> true,
			'show_admin_column'				=> true,
			'hierarchical'					=> true,
			'rewrite'						=> array( 'slug' => 'portfolio-cat' )
		);
		register_taxonomy( 'portfolio_cat', array( '<%= opts.functionPrefix %>_portfolio' ), $args );
		
		$labels = array(
			'name'							=> _x( 'Tags', 'Taxonomy General Name', '<%= opts.functionPrefix %>' ),
			'singular_name'					=> _x( 'Portfolio Item', 'Taxonomy Singular Name', '<%= opts.functionPrefix %>' ),
			'menu_name'						=> __( 'Tags', '<%= opts.functionPrefix %>' ),
			'all_items'						=> __( 'All Tags', '<%= opts.functionPrefix %>' ),
			'parent_item'					=> __( 'Parent Item', '<%= opts.functionPrefix %>' ),
			'parent_item_colon'				=> __( 'Parent Item:', '<%= opts.functionPrefix %>' ),
			'new_item_name'					=> __( 'New Tags Name', '<%= opts.functionPrefix %>' ),
			'add_new_item'					=> __( 'Add New Tag', '<%= opts.functionPrefix %>' ),
			'edit_item'						=> __( 'Edit Tag', '<%= opts.functionPrefix %>' ),
			'update_item'					=> __( 'Update Tag', '<%= opts.functionPrefix %>' ),
			'view_item'						=> __( 'View Tag', '<%= opts.functionPrefix %>' ),
			'separate_items_with_commas'	=> __( 'Separate items with commas', '<%= opts.functionPrefix %>' ),
			'add_or_remove_items'			=> __( 'Add or remove tags', '<%= opts.functionPrefix %>' ),
			'choose_from_most_used'			=> __( 'Choose from the most used', '<%= opts.functionPrefix %>' ),
			'popular_items'					=> __( 'Popular Tags', '<%= opts.functionPrefix %>' ),
			'search_items'					=> __( 'Search Tags', '<%= opts.functionPrefix %>' ),
			'not_found'						=> __( 'Not Found', '<%= opts.functionPrefix %>' )
		);
		$args = array(
			'labels'						=> $labels,
			'public'						=> true,
			'show_ui'						=> true,
			'show_admin_column'				=> true,
			'hierarchical'					=> false,
			'rewrite'						=> array( 'slug' => 'portfolio-tag' )
		);
		register_taxonomy( 'portfolio_tag', array( '<%= opts.functionPrefix %>_portfolio' ), $args );
	}
	add_action( 'init', '<%= opts.functionPrefix %>_portfolio_tax' );
}
