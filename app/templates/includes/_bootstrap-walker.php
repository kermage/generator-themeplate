<?php

/**
 * Bootstrap Nav Walker
 *
 * @package ThemePlate
 * @since 0.1.0
 */

if( ! class_exists( 'Bootstrap_Nav_Walker' ) ) {
	class Bootstrap_Nav_Walker extends <%= opts.classPrefix %>_Nav_Walker {
		public $class = array(
			'sub-menu' => 'dropdown-menu',
			'has-sub'  => 'dropdown',
			'active'   => 'active'
		);

		public function attributes( $item, $args ) {
			$atts = array();

			if ( $args->walker->has_children ) {
				$atts['href']          = '#';
				$atts['data-toggle']   = 'dropdown';
				$atts['class']         = 'dropdown-toggle';
				$atts['aria-haspopup'] = 'true';
			}

			return $atts;
		}
	}
}
