<?php

/**
 * Actions and Filters
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

add_action( 'after_switch_theme', 'flush_rewrite_rules' );

// Move all scripts to footer
if ( ! function_exists( '<%= opts.functionPrefix %>_scripts_to_footer' ) ) {
	function <%= opts.functionPrefix %>_scripts_to_footer() {
		remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
		remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
		remove_action( 'wp_head', 'wp_print_scripts' );
	}
	add_action( 'wp_enqueue_scripts', '<%= opts.functionPrefix %>_scripts_to_footer' );
}

// Remove JPEG compression.
if ( ! function_exists( '<%= opts.functionPrefix %>_jpeg_quality' ) ) {
	function <%= opts.functionPrefix %>_jpeg_quality() {
		return 100;
	}
	add_filter( 'jpeg_quality', '<%= opts.functionPrefix %>_jpeg_quality' );
}

// Custom excerpt length
if ( ! function_exists( '<%= opts.functionPrefix %>_excerpt_length' ) ) {
	function <%= opts.functionPrefix %>_excerpt_length( $length ) {
		return 50;
	}
	add_filter( 'excerpt_length', '<%= opts.functionPrefix %>_excerpt_length' );
}

// Custom excerpt read more
if ( ! function_exists( '<%= opts.functionPrefix %>_excerpt_string' ) ) {
	function <%= opts.functionPrefix %>_excerpt_string( $more ) {
		return '&hellip;';
	}
	add_filter( 'excerpt_more', '<%= opts.functionPrefix %>_excerpt_string' );
}

// Re-add underline and justify buttons in the editor
if ( ! function_exists( '<%= opts.functionPrefix %>_editor_buttons' ) ) {
	function <%= opts.functionPrefix %>_editor_buttons( $buttons ) {
		$temp    = array_merge( array_slice( $buttons, 0, 3, true ), array( 4 => 'underline' ), array_slice( $buttons, 3, count( $buttons ) - 1, true ) );
		$buttons = $temp;
		$temp    = array_merge( array_slice( $buttons, 0, 9, true ), array( 10 => 'alignjustify' ), array_slice( $buttons, 9, count( $buttons ) - 1, true ) );
		$buttons = $temp;

		return $buttons;
	}
	add_filter( 'mce_buttons', '<%= opts.functionPrefix %>_editor_buttons' );
}

// Replace WP login screen logo.
if ( ! function_exists( '<%= opts.functionPrefix %>_login_logo' ) ) {
	function <%= opts.functionPrefix %>_login_logo() {
		?>
		<style type="text/css">
			body.login h1 a {
				background-image: url( <?php echo esc_html( <%= opts.constantPrefix %>_URL ); ?>screenshot.png );
				background-position: center;
				background-size: 440px 330px;
				width: 320px;
				height: 120px;
				box-shadow: 0 1px 3px rgba( 0, 0, 0, .13 );
			}
		</style>
		<?php
	}
	add_action( 'login_enqueue_scripts', '<%= opts.functionPrefix %>_login_logo' );
}

// Link WP login logo to homepage.
if ( ! function_exists( '<%= opts.functionPrefix %>_login_headerurl' ) ) {
	function <%= opts.functionPrefix %>_login_headerurl() {
		return home_url();
	}
	add_filter( 'login_headerurl', '<%= opts.functionPrefix %>_login_headerurl' );
}

// Use the site title instead of 'WordPress'.
if ( ! function_exists( '<%= opts.functionPrefix %>_login_headertext' ) ) {
	function <%= opts.functionPrefix %>_login_headertext() {
		return get_option( 'blogname' );
	}
	add_filter( 'login_headertext', '<%= opts.functionPrefix %>_login_headertext' );
}

// Set default embed size.
if ( ! function_exists( '<%= opts.functionPrefix %>_embed_defaults' ) ) {
	function <%= opts.functionPrefix %>_embed_defaults( $attr ) {
		return array(
			'width'  => '1280',
			'height' => '720',
		);
	}
	add_filter( 'embed_defaults', '<%= opts.functionPrefix %>_embed_defaults' );
}
