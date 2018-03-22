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
			'description' => __( 'All available types.', '<%= opts.projectSlug %>' ),
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
				'selects' => array(
					'name'     => __( 'Selects', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Basic and Advanced select.', '<%= opts.projectSlug %>' ),
					'type'     => 'group',
					'fields'   => array(
						'basic' => array(
							'name'     => __( 'Basic', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Single and Multiple select.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'style'    => 'boxed',
							'fields'   => array(
								'single' => array(
									'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select a value.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'One', 'Two', 'Three' ),
									'type'     => 'select'
								),
								'multiple' => array(
									'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select values.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'One', 'Two', 'Three', 'Four', 'Five', 'Six' ),
									'type'     => 'select',
									'multiple' => true
								)
							)
						),
						'advanced' => array(
							'name'     => __( 'Advanced', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Single and Multiple select.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'style'    => 'boxed',
							'fields'   => array(
								'single' => array(
									'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select a value.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'One', 'Two', 'Three' ),
									'type'     => 'select2'
								),
								'multiple' => array(
									'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select values.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'One', 'Two', 'Three', 'Four', 'Five', 'Six' ),
									'type'     => 'select2',
									'multiple' => true
								)
							)
						)
					)
				),
				'choices' => array(
					'name'     => __( 'Choices', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Single and Multiple choices.', '<%= opts.projectSlug %>' ),
					'type'     => 'group',
					'style'    => 'boxed',
					'fields'   => array(
						'radios' => array(
							'name'     => __( 'Radios', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Inline and List radio.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'fields'   => array(
								'inline' => array(
									'name'     => __( 'Inline', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select from radio.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'First', 'Second', 'Third' ),
									'type'     => 'radio'
								),
								'list' => array(
									'name'     => __( 'List', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select from radio.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'Fourth', 'Fifth', 'Sixth' ),
									'type'     => 'radiolist'
								)
							)
						),
						'checkboxes' => array(
							'name'     => __( 'Checkboxes', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Inline and List checkbox.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'fields'   => array(
								'inline' => array(
									'name'     => __( 'Inline', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Check a box.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'Uno', 'Dos', 'Tres' ),
									'type'     => 'checkbox'
								),
								'list' => array(
									'name'     => __( 'List', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Check a box.', '<%= opts.projectSlug %>' ),
									'options'  => array( 'Uno', 'Dos', 'Tres' ),
									'type'     => 'checklist'
								)
							)
						)
					)
				),
				'color' => array(
					'name'     => __( 'Color', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Select a color.', '<%= opts.projectSlug %>' ),
					'type'     => 'color'
				),
				'files' => array(
					'name'     => __( 'Files', '<%= opts.projectSlug %>' ),
					'desc'     => __( 'Single and Multiple file.', '<%= opts.projectSlug %>' ),
					'type'     => 'group',
					'fields'   => array(
						'single' => array(
							'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Select a file.', '<%= opts.projectSlug %>' ),
							'type'     => 'file'
						),
						'multiple' => array(
							'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Select files.', '<%= opts.projectSlug %>' ),
							'type'     => 'file',
							'multiple' => true
						)
					)
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
				'objects' => array(
					'name'     => __( 'Objects', '<%= opts.projectSlug %>' ),
					'type'     => 'group',
					'style'    => 'boxed',
					'fields'   => array(
						'post' => array(
							'name'     => __( 'Posts', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Single and Multiple post.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'style'    => 'boxed',
							'fields'   => array(
								'single' => array(
									'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select a post.', '<%= opts.projectSlug %>' ),
									'type'     => 'post',
									'options'  => 'post'
								),
								'multiple' => array(
									'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select posts.', '<%= opts.projectSlug %>' ),
									'type'     => 'post',
									'options'  => 'post',
									'multiple' => true
								)
							)
						),
						'page' => array(
							'name'     => __( 'Pages', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Single and Multiple page.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'style'    => 'boxed',
							'fields'   => array(
								'single' => array(
									'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select a page.', '<%= opts.projectSlug %>' ),
									'type'     => 'page',
									'options'  => 'page'
								),
								'multiple' => array(
									'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select pages.', '<%= opts.projectSlug %>' ),
									'type'     => 'page',
									'options'  => 'page',
									'multiple' => true
								)
							)
						),
						'user' => array(
							'name'     => __( 'Users', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Single and Multiple user.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'style'    => 'boxed',
							'fields'   => array(
								'single' => array(
									'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select a user.', '<%= opts.projectSlug %>' ),
									'type'     => 'user',
									'options'  => 'administrator'
								),
								'multiple' => array(
									'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select users.', '<%= opts.projectSlug %>' ),
									'type'     => 'user',
									'options'  => 'administrator',
									'multiple' => true
								)
							)
						),
						'term' => array(
							'name'     => __( 'Terms', '<%= opts.projectSlug %>' ),
							'desc'     => __( 'Single and Multiple term.', '<%= opts.projectSlug %>' ),
							'type'     => 'group',
							'style'    => 'boxed',
							'fields'   => array(
								'single' => array(
									'name'     => __( 'Single', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select a term.', '<%= opts.projectSlug %>' ),
									'type'     => 'term',
									'options'  => 'category'
								),
								'multiple' => array(
									'name'     => __( 'Multiple', '<%= opts.projectSlug %>' ),
									'desc'     => __( 'Select terms.', '<%= opts.projectSlug %>' ),
									'type'     => 'term',
									'options'  => 'category',
									'multiple' => true
								)
							)
						)
					)
				),
				'html' => array(
					'type'     => 'html',
					'std'      => '
						<div style="background-color: #d32f2f; padding: 1rem; border-radius: 0.25rem;">
							<p style="color: #fff; text-align: center;">Display custom content using an <code>html</code> field.</p>
						</div>
					'
				)
			)
		) );
	}
	add_action( 'init', '<%= opts.functionPrefix %>_meta_boxes' );
}
