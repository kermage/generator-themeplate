<?php

/**
 * The template containing the sidebar area
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

?>

<aside class="sidebar">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- .sidebar -->
