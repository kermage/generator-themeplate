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

if( ! function_exists( '<%= opts.functionPrefix %>_add_settings' ) ) {
    function <%= opts.functionPrefix %>_add_settings( $param ) {
        if ( ! is_array( $param ) )
            return false;
        
        add_settings_section(
            $param['id'],
            $param['title'],
            $param['callback'],
            '<%= opts.functionPrefix %>'
        );
        
        foreach ( $param['fields'] as $id => $field ) {
            add_settings_field(
                $id,
                $field['name'],
                '<%= opts.functionPrefix %>_create_settings',
                '<%= opts.functionPrefix %>',
                $param['id'],
                array(
                    'label_for' => $id,
                    'type'      => $field['type'],
                    'options'   => $field['options']
                )
            );
        }
    }
}

if( ! function_exists( '<%= opts.functionPrefix %>_create_settings' ) ) {
    function <%= opts.functionPrefix %>_create_settings( $param ) {
        if ( ! is_array( $param ) )
            return false;
        
        $id = $param['label_for'];
        $setting = get_option( '<%= opts.functionPrefix %>' );
        $setting = $setting[$id];
        
        switch ( $param['type'] ) {
            default:
            case 'text':
                echo '<input type="text" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" value="' . $setting . '" />';
                break;
                
            case 'textarea':
                echo '<textarea name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" rows="4">' . $setting . '</textarea>';
                break;
                
            case 'select' :
                echo '<select name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '">';
                foreach( $param['options'] as $value => $option ) {
                    echo '<option value="' . ( $value + 1 ) . '"' . selected( $setting, ( $value + 1 ), false ) . '>' . $option . '</option>';
                }
                echo '</select>';
                break;
                
            case 'radio' :
                foreach( $param['options'] as $value => $option ) {
                    echo '<label><input type="radio" name="<%= opts.functionPrefix %>[' . $id . ']" value="' . ( $value +  1 ) . '"' . checked( $setting, ( $value +  1 ), false ) . ' /> ' . $option . '</label>';
                }
                break;
                
            case 'checkbox' :
                echo '<input type="checkbox" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" value="1" ' . checked( $setting, 1, false ) . ' />';
                break;
        }
    }
}
