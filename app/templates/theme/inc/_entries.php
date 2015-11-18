<?php

/**
 * Register meta boxes
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_page_meta_boxes' ) ) {
	function <%= opts.functionPrefix %>_page_meta_boxes() {
		$prefix = '<%= opts.functionPrefix %>_';
		
		$meta_boxes = array(
			$prefix . 'meta_box_page' => array(
				'title'			=> __( 'Page Settings', '<%= opts.functionPrefix %>' ),
				'description'	=> __( 'Various options to create different page layouts and styles.', '<%= opts.functionPrefix %>' ),
				'screen'		=> 'page',
				'context'		=> 'normal',
				'priority'		=> 'high',
				'fields'		=> array(
					$prefix . 'disable_title' => array(
						'name'		=> __( 'Disable Page Title', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Select to disable page title.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'checkbox',
						'std'		=> ''
					),
					$prefix . 'preferred_layout' => array(
						'name'		=> __( 'Preferred Layout', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Select preferred layout.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'radio',
						'std' 		=> 'Content Left; Sidebar Right',
						'options'	=> array( 'Content Left; Sidebar Right', 'Content Right; Sidebar Left', 'Fullwidth Page' )
					),
					$prefix . 'page_template' => array(
						'name'		=> __( 'Page Template', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Select page template.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'select',
						'std' 		=> 'Header; Footer',
						'options' => array( 'Header; Footer', 'No Header; Footer', 'Header; No Footer', 'No Header; No Footer' )
					),
					$prefix . 'bg_color' => array(
						'name'		=> __( 'Background Color', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Select background color.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'color',
						'std'		=> '#ffffff'
					)
				)
			),
			
			$prefix . 'meta_box_link' => array(
				'title'			=> __( 'Link Post Settings', '<%= opts.functionPrefix %>' ),
				'description'	=> '',
				'screen'		=> 'post',
				'context'		=> 'normal',
				'priority'		=> 'high',
				'fields'		=> array(
					$prefix . 'link_url' => array(
						'name'		=> __( 'The Link', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Insert the URL.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'text',
						'std'		=> ''
					)
				)
			),
			
			$prefix . 'meta_box_quote' => array(
				'title'			=> __( 'Quote Post Settings', '<%= opts.functionPrefix %>' ),
				'description'	=> '',
				'screen'		=> 'post',
				'context'		=> 'normal',
				'priority'		=> 'high',
				'fields'		=> array(
					$prefix . 'quote_quote' => array(
						'name'		=> __( 'Quotation', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Input the quote.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'textarea',
						'std' 		=> ''
					),
					$prefix . 'quote_cite' => array(
						'name'		=> __( 'Citation', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Source of the quotation.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'text',
						'std' 		=> ''
					)
				)
			),
			
			$prefix . 'meta_box_portfolio' => array(
				'title'			=> __( 'Portfolio Settings', '<%= opts.functionPrefix %>' ),
				'description'	=> '',
				'screen'		=> '<%= opts.functionPrefix %>_portfolio',
				'context'		=> 'normal',
				'priority'		=> 'high',
				'fields'		=> array(
					$prefix . 'portfolio_project' => array(
						'name'		=> __( 'Project File', '<%= opts.functionPrefix %>' ),
						'desc'		=> __( 'Select portfolio project file.', '<%= opts.functionPrefix %>' ),
						'type'		=> 'file',
						'std' 		=> ''
					)
				)
			)
		);
		<%= opts.functionPrefix %>_add_meta_box( $meta_boxes );
	}
	add_action( 'add_meta_boxes', '<%= opts.functionPrefix %>_page_meta_boxes' );
}
