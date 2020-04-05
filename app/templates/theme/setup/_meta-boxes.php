<?php

/**
 * Register meta boxes
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

ThemePlate()->post_meta( array(
	'id'          => 'field',
	'title'       => __( 'ThemePlate Fields', '<%= opts.projectSlug %>' ),
	'description' => __( 'All available types.', '<%= opts.projectSlug %>' ),
	'fields'      => array(
		'text'     => array(
			'title'       => __( 'Text', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter a text.', '<%= opts.projectSlug %>' ),
			'type'        => 'text',
		),
		'date'     => array(
			'title'       => __( 'Date', '<%= opts.projectSlug %>' ),
			'description' => __( 'Set a date.', '<%= opts.projectSlug %>' ),
			'type'        => 'date',
		),
		'time'     => array(
			'title'       => __( 'Time', '<%= opts.projectSlug %>' ),
			'description' => __( 'Set a time.', '<%= opts.projectSlug %>' ),
			'type'        => 'time',
		),
		'email'    => array(
			'title'       => __( 'Email', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter an email.', '<%= opts.projectSlug %>' ),
			'type'        => 'email',
		),
		'url'      => array(
			'title'       => __( 'URL', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter a url.', '<%= opts.projectSlug %>' ),
			'type'        => 'url',
		),
		'link'     => array(
			'title'       => __( 'Link', '<%= opts.projectSlug %>' ),
			'description' => __( 'Select a link.', '<%= opts.projectSlug %>' ),
			'type'        => 'link',
		),
		'textarea' => array(
			'title'       => __( 'Textarea', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter in a textarea.', '<%= opts.projectSlug %>' ),
			'type'        => 'textarea',
		),
		'selects'  => array(
			'title'       => __( 'Selects', '<%= opts.projectSlug %>' ),
			'description' => __( 'Basic and Advanced select.', '<%= opts.projectSlug %>' ),
			'type'        => 'group',
			'fields'      => array(
				'basic'    => array(
					'title'       => __( 'Basic', '<%= opts.projectSlug %>' ),
					'description' => __( 'Single and Multiple select.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'style'       => 'boxed',
					'fields'      => array(
						'single'   => array(
							'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select a value.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'One', 'Two', 'Three' ),
							'type'        => 'select',
						),
						'multiple' => array(
							'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select values.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'One', 'Two', 'Three', 'Four', 'Five', 'Six' ),
							'type'        => 'select',
							'multiple'    => true,
						),
					),
				),
				'advanced' => array(
					'title'       => __( 'Advanced', '<%= opts.projectSlug %>' ),
					'description' => __( 'Single and Multiple select.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'style'       => 'boxed',
					'fields'      => array(
						'single'   => array(
							'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select a value.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'One', 'Two', 'Three' ),
							'type'        => 'select2',
						),
						'multiple' => array(
							'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select values.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'One', 'Two', 'Three', 'Four', 'Five', 'Six' ),
							'type'        => 'select2',
							'multiple'    => true,
						),
					),
				),
			),
		),
		'choices'  => array(
			'title'       => __( 'Choices', '<%= opts.projectSlug %>' ),
			'description' => __( 'Single and Multiple choices.', '<%= opts.projectSlug %>' ),
			'type'        => 'group',
			'style'       => 'boxed',
			'fields'      => array(
				'radios'     => array(
					'title'       => __( 'Radios', '<%= opts.projectSlug %>' ),
					'description' => __( 'Inline and List radio.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'fields'      => array(
						'inline' => array(
							'title'       => __( 'Inline', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select from radio.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'First', 'Second', 'Third' ),
							'type'        => 'radio',
						),
						'list'   => array(
							'title'       => __( 'List', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select from radio.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'Fourth', 'Fifth', 'Sixth' ),
							'type'        => 'radiolist',
						),
					),
				),
				'checkboxes' => array(
					'title'       => __( 'Checkboxes', '<%= opts.projectSlug %>' ),
					'description' => __( 'Inline and List checkbox.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'fields'      => array(
						'inline' => array(
							'title'       => __( 'Inline', '<%= opts.projectSlug %>' ),
							'description' => __( 'Check a box.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'Uno', 'Dos', 'Tres' ),
							'type'        => 'checkbox',
						),
						'list'   => array(
							'title'       => __( 'List', '<%= opts.projectSlug %>' ),
							'description' => __( 'Check a box.', '<%= opts.projectSlug %>' ),
							'options'     => array( 'Uno', 'Dos', 'Tres' ),
							'type'        => 'checklist',
						),
					),
				),
			),
		),
		'color'    => array(
			'title'       => __( 'Color', '<%= opts.projectSlug %>' ),
			'description' => __( 'Select a color.', '<%= opts.projectSlug %>' ),
			'type'        => 'color',
		),
		'files'    => array(
			'title'       => __( 'Files', '<%= opts.projectSlug %>' ),
			'description' => __( 'Single and Multiple file.', '<%= opts.projectSlug %>' ),
			'type'        => 'group',
			'fields'      => array(
				'single'   => array(
					'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
					'description' => __( 'Select a file.', '<%= opts.projectSlug %>' ),
					'type'        => 'file',
				),
				'multiple' => array(
					'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
					'description' => __( 'Select files.', '<%= opts.projectSlug %>' ),
					'type'        => 'file',
					'multiple'    => true,
				),
			),
		),
		'number'   => array(
			'title'       => __( 'Number', '<%= opts.projectSlug %>' ),
			'description' => __( 'Set a number.', '<%= opts.projectSlug %>' ),
			'type'        => 'number',
		),
		'range'    => array(
			'title'       => __( 'Range', '<%= opts.projectSlug %>' ),
			'description' => __( 'Set a range.', '<%= opts.projectSlug %>' ),
			'type'        => 'range',
		),
		'editor'   => array(
			'title'       => __( 'Editor', '<%= opts.projectSlug %>' ),
			'description' => __( 'Enter in an editor.', '<%= opts.projectSlug %>' ),
			'type'        => 'editor',
		),
		'objects'  => array(
			'title'  => __( 'Objects', '<%= opts.projectSlug %>' ),
			'type'   => 'group',
			'style'  => 'boxed',
			'fields' => array(
				'post' => array(
					'title'       => __( 'Posts', '<%= opts.projectSlug %>' ),
					'description' => __( 'Single and Multiple post.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'style'       => 'boxed',
					'fields'      => array(
						'single'   => array(
							'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select a post.', '<%= opts.projectSlug %>' ),
							'type'        => 'post',
							'options'     => 'post',
						),
						'multiple' => array(
							'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select posts.', '<%= opts.projectSlug %>' ),
							'type'        => 'post',
							'options'     => 'post',
							'multiple'    => true,
						),
					),
				),
				'page' => array(
					'title'       => __( 'Pages', '<%= opts.projectSlug %>' ),
					'description' => __( 'Single and Multiple page.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'style'       => 'boxed',
					'fields'      => array(
						'single'   => array(
							'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select a page.', '<%= opts.projectSlug %>' ),
							'type'        => 'page',
							'options'     => 'page',
						),
						'multiple' => array(
							'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select pages.', '<%= opts.projectSlug %>' ),
							'type'        => 'page',
							'options'     => 'page',
							'multiple'    => true,
						),
					),
				),
				'user' => array(
					'title'       => __( 'Users', '<%= opts.projectSlug %>' ),
					'description' => __( 'Single and Multiple user.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'style'       => 'boxed',
					'fields'      => array(
						'single'   => array(
							'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select a user.', '<%= opts.projectSlug %>' ),
							'type'        => 'user',
							'options'     => 'administrator',
						),
						'multiple' => array(
							'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select users.', '<%= opts.projectSlug %>' ),
							'type'        => 'user',
							'options'     => 'administrator',
							'multiple'    => true,
						),
					),
				),
				'term' => array(
					'title'       => __( 'Terms', '<%= opts.projectSlug %>' ),
					'description' => __( 'Single and Multiple term.', '<%= opts.projectSlug %>' ),
					'type'        => 'group',
					'style'       => 'boxed',
					'fields'      => array(
						'single'   => array(
							'title'       => __( 'Single', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select a term.', '<%= opts.projectSlug %>' ),
							'type'        => 'term',
							'options'     => 'category',
						),
						'multiple' => array(
							'title'       => __( 'Multiple', '<%= opts.projectSlug %>' ),
							'description' => __( 'Select terms.', '<%= opts.projectSlug %>' ),
							'type'        => 'term',
							'options'     => 'category',
							'multiple'    => true,
						),
					),
				),
			),
		),
		'html'     => array(
			'type'    => 'html',
			'default' => '
				<div style="background-color: #d32f2f; padding: 1rem; border-radius: 0.25rem;">
					<p style="color: #fff; text-align: center;">Display custom content using an <code>html</code> field.</p>
				</div>
			',
		),
	),
) );
