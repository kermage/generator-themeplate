<?php

/**
 * Template Name: Full Width Page
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

get_header();

?>

	<main class="content">

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

	</main><!-- .content -->

<?php

get_footer();
