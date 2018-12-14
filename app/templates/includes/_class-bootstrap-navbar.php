<?php

/**
 * Bootstrap NavBar Walker
 *
 * @package ThemePlate
 * @since 0.1.0
 */

if ( ! class_exists( 'Bootstrap_NavBar' ) ) {
	if ( class_exists( 'ThemePlate_NavWalker' ) ) {
		class Bootstrap_NavBar extends ThemePlate_NavWalker {
			public $class = array(
				'sub-menu' => 'dropdown-menu',
				'has-sub'  => 'dropdown',
				'active'   => 'active',
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
	} else {
		class Bootstrap_NavBar extends Walker_Nav_Menu {}
	}
}
