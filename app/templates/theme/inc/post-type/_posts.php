<?php

/**
 * Register custom post types
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// Register Custom Post Type
if( ! function_exists( '<%= opts.functionPrefix %>_portfolio_cpt' ) ) {
    function <%= opts.functionPrefix %>_portfolio_cpt() {
        $labels = array(
            'name'                  => _x( 'Portfolio', 'Post Type General Name', '<%= opts.functionPrefix %>' ),
            'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', '<%= opts.functionPrefix %>' ),
            'menu_name'             => __( 'Portfolio', '<%= opts.functionPrefix %>' ),
            'name_admin_bar'        => __( 'Portfolio', '<%= opts.functionPrefix %>' ),
            'parent_item_colon'     => __( 'Parent Item:', '<%= opts.functionPrefix %>' ),
            'all_items'             => __( 'All Items', '<%= opts.functionPrefix %>' ),
            'add_new_item'          => __( 'Add New Item', '<%= opts.functionPrefix %>' ),
            'add_new'               => __( 'Add New', '<%= opts.functionPrefix %>' ),
            'new_item'              => __( 'New Item', '<%= opts.functionPrefix %>' ),
            'edit_item'             => __( 'Edit Item', '<%= opts.functionPrefix %>' ),
            'update_item'           => __( 'Update Item', '<%= opts.functionPrefix %>' ),
            'view_item'             => __( 'View Item', '<%= opts.functionPrefix %>' ),
            'search_items'          => __( 'Search Item', '<%= opts.functionPrefix %>' ),
            'not_found'             => __( 'Not found', '<%= opts.functionPrefix %>' ),
            'not_found_in_trash'    => __( 'Not found in Trash', '<%= opts.functionPrefix %>' )
        );
        $args = array(
            'label'                 => __( '<%= opts.functionPrefix %>_portfolio', '<%= opts.functionPrefix %>' ),
            'labels'                => $labels,
            'description'           => __( 'Portfolio', '<%= opts.functionPrefix %>' ),
            'public'                => true,
            'show_ui'               => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-media-document',
            'capability_type'       => 'post',
            'hierarchical'          => false,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'           => true,
            'rewrite'               => array( 'slug' => 'portfolio' )
        );
        register_post_type( '<%= opts.functionPrefix %>_portfolio', $args );
    }
    add_action( 'init', '<%= opts.functionPrefix %>_portfolio_cpt' );
}
