<?php

/**
 * The template for displaying the footer
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

?>

		</div><!-- .site-content -->

		<?php get_sidebar( 'footer' ); ?>

		<footer class="site-footer">
			<div class="container">
				<nav class="sitelinks">
					<?php <%= opts.functionPrefix %>_footer_menu(); ?>
				</nav>

				<div class="copyright">
					Copyright &copy; <%= new Date().getFullYear() %> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.
					<span>Designed and developed by <a href="<?php echo esc_html( '<%= opts.authorURI %>' ); ?>"><?php echo esc_html( '<%= opts.authorName %>' ); ?></a>.</span>
				</div>
			</div>
		</footer><!-- .site-footer -->

		<?php wp_footer(); ?>
	</body>
</html>

<!-- A generator-themeplate project -->
