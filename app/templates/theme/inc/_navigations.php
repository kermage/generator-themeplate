<?php

/**
 * Output navigation menus
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// Primary Menu
if( ! function_exists( '<%= opts.functionPrefix %>_primary_menu' ) ) {
    function <%= opts.functionPrefix %>_primary_menu() {
        wp_nav_menu( array(
            'theme_location'    => 'primary',
            'menu'              => '',
            'container'         => false,
            'depth'             => 0
        ) );
    }
}

// Footer Menu
if( ! function_exists( '<%= opts.functionPrefix %>_footer_menu' ) ) {
    function <%= opts.functionPrefix %>_footer_menu() {
        wp_nav_menu( array(
            'theme_location'    => 'footer',
            'menu'              => '',
            'container'         => false,
            'depth'             => 1
        ) );
    }
}

if( ! class_exists( '<%= opts.classPrefix %>_nav_walker' ) ) {
    class <%= opts.classPrefix %>_nav_walker extends Walker_Nav_Menu {
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }
        
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "$indent</ul>\n";
        }
        
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            if( in_array( 'menu-item-has-children', (array) $classes ) ) $classes[] = 'has-sub';
            if( in_array( 'current-menu-item', (array) $classes ) ) $classes[] = 'active';
            $classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', '', $classes );
            $classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );
            $classes = preg_replace( '/\s\s+/', '', join( ' ', $classes ) );
            $output .=  $indent . '<li' . ( ( $classes ) ? ' class="' . $classes . '"' : '' ) . '>';
            
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
            $output .= "</li>\n";
        }
    }
}

if( ! function_exists( '<%= opts.functionPrefix %>_walker' ) ) {
    function <%= opts.functionPrefix %>_walker( $args ) {
        return array_merge( $args, array(
            'walker' => new <%= opts.classPrefix %>_nav_walker()
        ) );
    }
    add_filter( 'wp_nav_menu_args', '<%= opts.functionPrefix %>_walker' );
}
