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
			'id'          => 'field',
			'title'       => __( 'ThemePlate Fields', '<%= opts.projectSlug %>' ),
			'description' => __( 'All available fields.', '<%= opts.projectSlug %>' ),
			'fields'      => array(
				'text' => array(
					'name'     => __( 'Text', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Enter a text.', '<%= opts.projectSlug %>' ),
					'type'     => 'text'
				),
				'date' => array(
					'name'     => __( 'Date', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Set a date.', '<%= opts.projectSlug %>' ),
					'type'     => 'date'
				),
				'time' => array(
					'name'     => __( 'Time', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Set a time.', '<%= opts.projectSlug %>' ),
					'type'     => 'time'
				),
				'email' => array(
					'name'     => __( 'Email', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Enter an email.', '<%= opts.projectSlug %>' ),
					'type'     => 'email'
				),
				'url' => array(
					'name'     => __( 'URL', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Enter a url.', '<%= opts.projectSlug %>' ),
					'type'     => 'url'
				),
				'textarea' => array(
					'name'     => __( 'Textarea', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Enter in a textarea.', '<%= opts.projectSlug %>' ),
					'type'     => 'textarea'
				),
				'select' => array(
					'name'     => __( 'Select', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a value.', '<%= opts.projectSlug %>' ),
					'options'   => array( 'One', 'Two', 'Three'),
					'type'     => 'select'
				),
				'radio' => array(
					'name'     => __( 'Radio', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select from radio.', '<%= opts.projectSlug %>' ),
					'options'   => array( 'First', 'Second', 'Third'),
					'type'     => 'radio'
				),
				'checkbox' => array(
					'name'     => __( 'Checkbox', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Check a box.', '<%= opts.projectSlug %>' ),
					'options'   => array( 'Uno', 'Dos', 'Tres'),
					'type'     => 'checkbox'
				),
				'color' => array(
					'name'     => __( 'Color', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a color.', '<%= opts.projectSlug %>' ),
					'type'     => 'color'
				),
				'file' => array(
					'name'     => __( 'File', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a file.', '<%= opts.projectSlug %>' ),
					'type'     => 'file'
				),
				'number' => array(
					'name'     => __( 'Number', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Set a number.', '<%= opts.projectSlug %>' ),
					'type'     => 'number'
				),
				'range' => array(
					'name'     => __( 'Range', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Set a range.', '<%= opts.projectSlug %>' ),
					'type'     => 'range'
				),
				'editor' => array(
					'name'     => __( 'Editor', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Enter in an editor.', '<%= opts.projectSlug %>' ),
					'type'     => 'editor'
				),
				'post' => array(
					'name'     => __( 'Post', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a post.', '<%= opts.projectSlug %>' ),
					'type'     => 'post',
					'options'  => 'post'
				),
				'page' => array(
					'name'     => __( 'Page', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a page.', '<%= opts.projectSlug %>' ),
					'type'     => 'page',
					'options'  => 'page'
				),
				'user' => array(
					'name'     => __( 'User', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a user.', '<%= opts.projectSlug %>' ),
					'type'     => 'user',
					'options'  => 'administrator'
				),
				'term' => array(
					'name'     => __( 'Term', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a term.', '<%= opts.projectSlug %>' ),
					'type'     => 'term',
					'options'  => 'category'
				)
			)
		) );
	}
	add_action( 'init', '<%= opts.functionPrefix %>_meta_boxes' );
}
