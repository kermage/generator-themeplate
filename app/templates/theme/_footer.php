<?php

/**
 * The template for displaying the footer
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

$theme = wp_get_theme( <%= opts.constantPrefix %>_THEME_BASE );

?>

		</div><!-- .site-content -->

		<?php get_sidebar( 'footer' ); ?>

		<footer class="site-footer">
			<div class="container">
				<nav class="sitelinks">
					<?php <%= opts.functionPrefix %>_footer_menu(); ?>
				</nav>

				<div class="copyright">
					<small>Copyright &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.</small>
					<span>Designed and developed by <a href="<?php echo esc_url( $theme->get( 'AuthorURI' ) ); ?>"><?php echo esc_html( $theme->get( 'Author' ) ); ?></a>.</span>
				</div>
			</div>
		</footer><!-- .site-footer -->

		<?php wp_footer(); ?>
	</body>
</html>

<!-- A generator-themeplate project - https://github.com/kermage/generator-themeplate -->
