<?php

/**
 * Register meta boxes
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_meta_boxes' ) ) {
	function <%= opts.functionPrefix %>_meta_boxes() {
		ThemePlate()->post_meta( array(
			'id'          => 'page',
			'title'       => __( 'Page Settings', '<%= opts.projectSlug %>' ),
			'description' => __( 'Various options to create different page layouts and styles.', '<%= opts.projectSlug %>' ),
			'screen'      => 'page',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'notitle' => array(
					'name'     => __( 'Disable Page Title', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select to disable page title.', '<%= opts.projectSlug %>' ),
					'type'     => 'checkbox',
					'std'      => ''
				),
				'layout' => array(
					'name'     => __( 'Preferred Layout', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select preferred layout.', '<%= opts.projectSlug %>' ),
					'type'     => 'radio',
					'std'      => 'Content Left; Sidebar Right',
					'options'  => array( 'Content Left; Sidebar Right', 'Content Right; Sidebar Left', 'Fullwidth Page' )
				),
				'template' => array(
					'name'     => __( 'Page Template', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select page template.', '<%= opts.projectSlug %>' ),
					'type'     => 'select',
					'std'      => '',
					'options'  => array( 'Header; Footer', 'No Header; Footer', 'Header; No Footer', 'No Header; No Footer' ),
					// 'multiple' => true
				),
				'background' => array(
					'name'     => __( 'Background Color', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select background color.', '<%= opts.projectSlug %>' ),
					'type'     => 'color',
					'std'      => '#ffffff'
				)
			)
		) );

		ThemePlate()->post_meta( array(
			'id'          => 'link',
			'title'       => __( 'Link Post Settings', '<%= opts.projectSlug %>' ),
			'description' => '',
			'screen'      => 'post',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'url' => array(
					'name'     => __( 'The Link', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Insert the URL.', '<%= opts.projectSlug %>' ),
					'type'     => 'text',
					'std'      => ''
				)
			)
		) );

		ThemePlate()->post_meta( array(
			'id'          => 'quote',
			'title'       => __( 'Quote Post Settings', '<%= opts.projectSlug %>' ),
			'description' => '',
			'screen'      => 'post',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'quote' => array(
					'name'     => __( 'Quotation', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Input the quote.', '<%= opts.projectSlug %>' ),
					'type'     => 'textarea',
					'std'      => ''
				),
				'cite' => array(
					'name'     => __( 'Citation', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Source of the quotation.', '<%= opts.projectSlug %>' ),
					'type'     => 'text',
					'std'      => ''
				)
			)
		) );

		ThemePlate()->post_meta( array(
			'id'          => 'portfolio',
			'title'       => __( 'Portfolio Settings', '<%= opts.projectSlug %>' ),
			'description' => '',
			'screen'      => 'portfolio',
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				'project' => array(
					'name'     => __( 'Project File', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select portfolio project file.', '<%= opts.projectSlug %>' ),
					'type'     => 'file',
					'std'      => '',
					// 'multiple' => true
				),
				'date' => array(
					'name'     => __( 'Project Date', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select portfolio project date.', '<%= opts.projectSlug %>' ),
					'type'     => 'date',
					'std'      => ''
				)
			)
		) );
	}
	add_action( 'add_meta_boxes', '<%= opts.functionPrefix %>_meta_boxes' );
}
