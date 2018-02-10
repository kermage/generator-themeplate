<?php

/**
 * The template for displaying the header
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body(); ?>

		<a class="screen-reader-text" href="#site-content"><?php _e( 'Skip to content', '<%= opts.projectSlug %>' ); ?></a>

		<header class="site-header" role="banner">
			<div class="branding">
				<div class="container">

					<?php if ( is_front_page() ) : ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
					<?php else : ?>
						<p class="site-title"><strong>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php bloginfo( 'name' ); ?>
							</a>
						</strong></p>
					<?php endif; ?>

					<p class="tagline">
						<?php bloginfo( 'description' ); ?>
					</p>

				</div>
			</div><!-- .branding -->

			<div class="navbar">
				<div class="container">
					<nav class="sitenav" role="navigation">
						<?php <%= opts.functionPrefix %>_primary_menu(); ?>
					</nav>
				</div>
			</div><!-- .navbar -->
		</header><!-- .site-header -->

		<div id="site-content">
