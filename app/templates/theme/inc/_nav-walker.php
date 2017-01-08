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
			$classes = join( ' ', array_filter( $classes ) );
			$output .= '<li' . ( ( $classes ) ? ' class="' . esc_attr( $classes ) . '"' : '' ) . '>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$output .= $args->before;
			$output .= '<a'. $attributes .'>';
			$output .= $args->link_before . $item->title . $args->link_after;
			$output .= '</a>';
			$output .= $args->after;
		}

		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= '</li>';
		}
	}
}
