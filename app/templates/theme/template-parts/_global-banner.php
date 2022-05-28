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
	$heading = get_the_archive_title();
} else {
	$heading = single_post_title( '', false );
}

if ( empty( $heading ) ) {
	return;
}

?>

<div class="banner">
	<div class="container">
		<h1><?php echo esc_html( $heading ); ?></h1>
	</div>
</div><!-- .banner -->
