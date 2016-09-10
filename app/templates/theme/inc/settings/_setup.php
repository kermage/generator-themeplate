<?php

/**
 * Setup settings
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_settings_menu' ) ) {
    function <%= opts.functionPrefix %>_settings_menu() {
        add_options_page(
            // Page Title
            '<%= opts.themeName %> Settings',
            // Menu Title
            '<%= opts.themeName %>',
            // Capability
            'edit_theme_options',
            // Menu Slug
            '<%= opts.functionPrefix %>-settings',
            // Content Function
            '<%= opts.functionPrefix %>_settings_page'
        );
    }
    add_action( 'admin_menu', '<%= opts.functionPrefix %>_settings_menu' );
}

if( ! function_exists( '<%= opts.functionPrefix %>_settings_page' ) ) {
    function <%= opts.functionPrefix %>_settings_page() {
        ?>
        <div class="wrap">
            <h1><%= opts.themeName %> Settings</h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields( '<%= opts.functionPrefix %>' );
                    do_settings_sections( '<%= opts.functionPrefix %>' );
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
