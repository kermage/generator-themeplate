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
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<nav class="<%= opts.functionPrefix %>-nav-wrap" role="navigation">
			<?php <%= opts.functionPrefix %>_primary_menu(); ?>
		</nav>
