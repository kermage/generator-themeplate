<?php

/**
 * Custom Nav Walker
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! class_exists( '<%= opts.classPrefix %>_nav_walker' ) ) {
	class <%= opts.classPrefix %>_nav_walker extends Walker_Nav_Menu {
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= '<ul class="sub-menu">';
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= '</ul>';
		}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			if( in_array( 'menu-item-has-children', (array) $classes ) ) $classes[] = 'has-sub';
			if( in_array( 'current-menu-item', (array) $classes ) ) $classes[] = 'active';
			$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', '', $classes );
			$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );
			$classes = preg_replace( '/\s\s+/', '', join( ' ', $classes ) );
			$output .= '<li' . ( ( $classes ) ? ' class="' . $classes . '"' : '' ) . '>';

			$attributes = ! empty( $item->attr_title )      ? ' title="'            . esc_attr( $item->attr_title   ) . '"' : '';
			$attributes .= ! empty( $item->target )         ? ' target="'           . esc_attr( $item->target       ) . '"' : '';
			$attributes .= ! empty( $item->xfn )            ? ' rel="'              . esc_attr( $item->xfn          ) . '"' : '';
			$attributes .= ! empty( $item->url )            ? ' href="'             . esc_attr( $item->url          ) . '"' : '';
			$description = ! empty( $item->description )    ? '<span class="desc">' . esc_attr( $item->description  ) . '</span>' : '';

			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$description,
				$args->link_after,
				$args->after
			);

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= '</li>';
		}
	}
}
