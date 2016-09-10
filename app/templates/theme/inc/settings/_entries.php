<?php

/**
 * Register settings
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_settings' ) ) {
    function <%= opts.functionPrefix %>_settings() {
        register_setting( '<%= opts.functionPrefix %>', '<%= opts.functionPrefix %>' );
        $prefix = '<%= opts.functionPrefix %>_';
    }
    add_action( 'admin_init', '<%= opts.functionPrefix %>_settings' );
}
