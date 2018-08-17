<?php

/**
 * The template for displaying pages
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

get_header(); ?>

	<main class="content container">

		<?php if ( ! is_front_page() ) : ?>
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

	</main><!-- .content -->

<?php get_footer();
