<?php

/**
 * Clean Navbar Walker
 *
 * @package ThemePlate
 * @since 0.1.0
 */

if ( ! class_exists( 'Clean_Navbar' ) ) {
	if ( class_exists( 'ThemePlate\NavWalker' ) ) {
		class Clean_Navbar extends ThemePlate\NavWalker {
			public $classes = array(
				'sub-menu' => 'dropdown-menu',
				'has-sub'  => 'dropdown',
				'active'   => 'active',
				'item'     => 'nav-item',
			);

			public function link_attributes( $atts, $menu_item, $args, $depth ) {
				if ( ! $args->walker instanceof $this ) {
					return $atts;
				}

				$atts['class'] = 'nav-link';

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

		add_filter( 'nav_menu_submenu_css_class', function( $classes, $args ) {
			if ( ! $args->walker instanceof Clean_Navbar ) {
				return array( 'sub-menu' );
			}

			return array( 'dropdown-menu' );
		}, PHP_INT_MAX, 2 );

		add_filter( 'nav_menu_css_class', function( $classes, $menu_item, $args ) {
			if ( ! $args->walker instanceof Clean_Navbar ) {
				return array( '' );
			}

			return array( 'nav-item' );
		}, PHP_INT_MAX, 3 );

		add_filter( 'nav_menu_item_id', function() {
			return '';
		} );

		add_filter( 'nav_menu_link_attributes', function( $atts, $menu_item, $args ) {
			if ( ! $args->walker instanceof Clean_Navbar ) {
				return $atts;
			}

			$atts['class'] = 'nav-link';

			if ( $args->walker->has_children ) {
				$atts['class']        .= ' dropdown-toggle';
				$atts['data-toggle']   = 'dropdown';
				$atts['aria-haspopup'] = 'true';
			}

			return $atts;
		}, PHP_INT_MAX, 3 );

		add_filter( 'wp_nav_menu_args', function( $args ) {
			if ( 'wp_page_menu' === $args['fallback_cb'] ) {
				$args['fallback_cb'] = function( $args ) {
					$texts = array(
						'Click here',
						'to add',
						'a menu',
					);

					$nav_menu = '<ul><li class="nav-item">' . implode( '</li><li class="nav-item">', array_map( function( $text ) {
						return '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link">' . $text . '</a>';
					}, $texts ) ) . '</li></ul>';

					if ( $args['echo'] ) {
						echo $nav_menu;
					} else {
						return $nav_menu;
					}
				};
			}

			if ( '<ul id="%1$s" class="%2$s">%3$s</ul>' === $args['items_wrap'] ) {
				$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
			}

			return $args;
		}, PHP_INT_MAX, 2 );
	}
}
