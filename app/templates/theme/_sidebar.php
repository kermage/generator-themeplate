<?php

/**
 * The template containing the sidebar area
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

?>

<aside class="sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- .sidebar -->
