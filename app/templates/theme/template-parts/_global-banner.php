<?php

/**
 * The template for displaying the banner
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( is_single() || is_404() ) {
	return;
}

if ( is_archive() ) {
	$<%= opts.functionPrefix %>_heading = get_the_archive_title();
} else {
	$<%= opts.functionPrefix %>_heading = single_post_title( '', false );
}

if ( empty( $<%= opts.functionPrefix %>_heading ) ) {
	return;
}

?>

<div class="banner">
	<div class="container">
		<h1><?php echo esc_html( $<%= opts.functionPrefix %>_heading ); ?></h1>
	</div>
</div><!-- .banner -->
