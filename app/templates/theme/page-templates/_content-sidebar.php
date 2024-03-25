<?php

/**
 * Template Name: Content - Sidebar
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

get_header();

?>

	<div class="content-sidebar container">
		<main class="content">

			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

		</main><!-- .content -->

		<?php get_sidebar(); ?>

	</div><!-- .content-sidebar.container -->

<?php

get_footer();
