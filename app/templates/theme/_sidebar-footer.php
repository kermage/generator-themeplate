<?php

/**
 * The template containing the footer areas
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if ( ! is_active_sidebar( 'footer' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
	return;
}

?>

<div class="footer">
	<div class="container">
		<?php dynamic_sidebar( 'footer' ); ?>
		<?php dynamic_sidebar( 'footer-2' ); ?>
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>
</div><!-- .footer -->
