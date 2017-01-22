<?php

/**
 * Bootstrap Nav Walker
 *
 * @package ThemePlate
 * @since 0.1.0
 */

if( ! class_exists( 'Bootstrap_Nav_Walker' ) ) {
	class Bootstrap_Nav_Walker extends Walker {
		public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= '<ul class="dropdown-menu">';
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= '</ul>';
		}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes = preg_replace( '/current[-_](menu|page)[-_](item|parent|ancestor)|(menu|page)[-_\w+]+/', '', $classes );
			if ( $args->walker->has_children ) $classes[] = 'dropdown';
			if ( $item->current ) $classes[] = 'active';
			$classes = join( ' ', array_filter( $classes ) );
			$output .= '<li' . ( ( $classes ) ? ' class="' . esc_attr( $classes ) . '"' : '' ) . '>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';

			if ( $args->walker->has_children ) {
				$atts['href']          = '#';
				$atts['data-toggle']   = 'dropdown';
				$atts['class']         = 'dropdown-toggle';
				$atts['aria-haspopup'] = 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

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
