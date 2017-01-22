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

        <%= opts.functionPrefix %>_add_settings( array(
            'id'        => $prefix . 'general',
            'title'     => __( 'General', '<%= opts.functionPrefix %>' ),
            'callback'  => '',
            'fields'    => array(
                $prefix . 'description' => array(
                    'name'      => __( 'Description', '<%= opts.functionPrefix %>' ),
                    'type'      => 'text'
                ),
                $prefix . 'copyright' => array(
                    'name'      => __( 'Copyright', '<%= opts.functionPrefix %>' ),
                    'type'      => 'textarea'
                ),
                $prefix . 'template' => array(
                    'name'      => __( 'Default Template', '<%= opts.functionPrefix %>' ),
                    'type'      => 'select',
                    'options'   => array( 'Header; Footer', 'No Header; Footer', 'Header; No Footer', 'No Header; No Footer' )
                ),
                $prefix . 'layout' => array(
                    'name'      => __( 'Default Layout', '<%= opts.functionPrefix %>' ),
                    'type'      => 'radio',
                    'options'   => array( 'Content Left; Sidebar Right', 'Content Right; Sidebar Left', 'Fullwidth Page' )
                ),
                $prefix . 'disable' => array(
                    'name'      => __( 'Disable Titles', '<%= opts.functionPrefix %>' ),
                    'type'      => 'checkbox'
                ),
                $prefix . 'color' => array(
                    'name'      => __( 'Accent Color', '<%= opts.functionPrefix %>' ),
                    'type'      => 'color'
                ),
                $prefix . 'logo' => array(
                    'name'      => __( 'Site Logo', '<%= opts.functionPrefix %>' ),
                    'type'      => 'file'
                ),
                $prefix . 'date' => array(
                    'name'      => __( 'Date', '<%= opts.functionPrefix %>' ),
                    'type'      => 'date'
                ),
                $prefix . 'time' => array(
                    'name'      => __( 'Time', '<%= opts.functionPrefix %>' ),
                    'type'      => 'time'
                ),
                $prefix . 'number' => array(
                    'name'      => __( 'Number', '<%= opts.functionPrefix %>' ),
                    'type'      => 'number'
                )
            )
        ) );
    }
    add_action( 'admin_init', '<%= opts.functionPrefix %>_settings' );
}
