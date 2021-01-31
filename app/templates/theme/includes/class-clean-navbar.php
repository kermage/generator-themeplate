<?php

/**
 * Clean Navbar Walker
 *
 * @package ThemePlate
 * @since 0.1.0
 */

if ( ! class_exists( 'Clean_Navbar' ) ) {
	if ( class_exists( 'ThemePlate_NavWalker' ) ) {
		class Clean_Navbar extends ThemePlate_NavWalker {
			public $class = array(
				'sub-menu' => 'dropdown-menu',
				'has-sub'  => 'dropdown',
				'active'   => 'active',
				'item'     => 'nav-item',
			);

			public function attributes( $item, $args ) {
				$atts = array(
					'class' => 'nav-link',
				);

				if ( $args->walker->has_children ) {
					$atts['class']        .= ' dropdown-toggle';
					$atts['data-toggle']   = 'dropdown';
					$atts['aria-haspopup'] = 'true';
				}

				return $atts;
			}
		}
	} else {
		class Clean_Navbar extends Walker_Nav_Menu {}
	}
}
