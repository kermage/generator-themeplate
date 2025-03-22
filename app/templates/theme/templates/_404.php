<?php

/**
 * The template for displaying 404
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

get_header();

?>

	<div class="content-sidebar container">
		<main class="content">
			<?php dynamic_sidebar( 'error404' ); ?>
		</main><!-- .content -->

		<?php get_sidebar(); ?>
	</div><!-- .container -->

<?php

get_footer();
