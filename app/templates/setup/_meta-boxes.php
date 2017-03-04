<?php

/**
 * Register meta boxes
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_meta_boxes' ) ) {
	function <%= opts.functionPrefix %>_meta_boxes() {
		ThemePlate()->post_meta( array(
			'id'          => 'page',
			'title'       => __( 'Page Settings', '<%= opts.functionPrefix %>' ),
			'description' => __( 'Various options to create different page layouts and styles.', '<%= opts.functionPrefix %>' ),
			'screen'      => 'page',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'notitle' => array(
					'name'     => __( 'Disable Page Title', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Select to disable page title.', '<%= opts.functionPrefix %>' ),
					'type'     => 'checkbox',
					'std'      => ''
				),
				'layout' => array(
					'name'     => __( 'Preferred Layout', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Select preferred layout.', '<%= opts.functionPrefix %>' ),
					'type'     => 'radio',
					'std'      => 'Content Left; Sidebar Right',
					'options'  => array( 'Content Left; Sidebar Right', 'Content Right; Sidebar Left', 'Fullwidth Page' )
				),
				'template' => array(
					'name'     => __( 'Page Template', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Select page template.', '<%= opts.functionPrefix %>' ),
					'type'     => 'select',
					'std'      => '',
					'options'  => array( 'Header; Footer', 'No Header; Footer', 'Header; No Footer', 'No Header; No Footer' ),
					// 'multiple' => true
				),
				'background' => array(
					'name'     => __( 'Background Color', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Select background color.', '<%= opts.functionPrefix %>' ),
					'type'     => 'color',
					'std'      => '#ffffff'
				)
			)
		) );

		ThemePlate()->post_meta( array(
			'id'          => 'link',
			'title'       => __( 'Link Post Settings', '<%= opts.functionPrefix %>' ),
			'description' => '',
			'screen'      => 'post',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'url' => array(
					'name'     => __( 'The Link', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Insert the URL.', '<%= opts.functionPrefix %>' ),
					'type'     => 'text',
					'std'      => ''
				)
			)
		) );

		ThemePlate()->post_meta( array(
			'id'          => 'quote',
			'title'       => __( 'Quote Post Settings', '<%= opts.functionPrefix %>' ),
			'description' => '',
			'screen'      => 'post',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'quote' => array(
					'name'     => __( 'Quotation', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Input the quote.', '<%= opts.functionPrefix %>' ),
					'type'     => 'textarea',
					'std'      => ''
				),
				'cite' => array(
					'name'     => __( 'Citation', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Source of the quotation.', '<%= opts.functionPrefix %>' ),
					'type'     => 'text',
					'std'      => ''
				)
			)
		) );

		ThemePlate()->post_meta( array(
			'id'          => 'portfolio',
			'title'       => __( 'Portfolio Settings', '<%= opts.functionPrefix %>' ),
			'description' => '',
			'screen'      => 'portfolio',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'project' => array(
					'name'     => __( 'Project File', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Select portfolio project file.', '<%= opts.functionPrefix %>' ),
					'type'     => 'file',
					'std'      => '',
					// 'multiple' => true
				),
				'date' => array(
					'name'     => __( 'Project Date', '<%= opts.functionPrefix %>' ),
					'desc'     => __( 'Select portfolio project date.', '<%= opts.functionPrefix %>' ),
					'type'     => 'date',
					'std'      => ''
				)
			)
		) );
	}
	add_action( 'add_meta_boxes', '<%= opts.functionPrefix %>_meta_boxes' );
}
