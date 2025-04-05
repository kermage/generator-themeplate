<?php

/**
 * Filter query templates
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

if ( ! function_exists( '<%= opts.functionPrefix %>_query_templates' ) ) {
	function <%= opts.functionPrefix %>_query_templates( $templates ) {
		$type = str_replace( '_template_hierarchy', '', current_filter() );

		if ( file_exists( <%= opts.constantPrefix %>_THEME_PATH . "templates/{$type}.php" ) ) {
			$index = array_search( "{$type}.php", $templates, true );

			if ( false !== $index ) {
				array_splice( $templates, $index, 0, "templates/{$type}.php" );
			} else {
				array_unshift( $templates, "templates/{$type}.php" );
			}
		}

		return $templates;
	}
}

foreach ( glob( <%= opts.constantPrefix %>_THEME_PATH . 'templates/*.php' ) as $template ) {
	$base = basename( $template, '.php' );

	add_filter( "{$base}_template_hierarchy", '<%= opts.functionPrefix %>_query_templates' );
}
