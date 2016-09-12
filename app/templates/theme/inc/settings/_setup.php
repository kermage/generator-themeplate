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
        wp_enqueue_media();
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
                    'options'   => $field['options'],
                    'multiple'  => $field['multiple']
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
                echo '<select name="<%= opts.functionPrefix %>[' . $id . ']' . ( $param['multiple'] ? '[]' : '' ) . '" id="' . $id . '" ' . ( $param['multiple'] ? 'multiple="multiple"' : '' ) . '>';
                foreach( $param['options'] as $value => $option ) {
                    echo '<option value="' . ( $value + 1 ) . '"';
                    if ( in_array( ( $value + 1 ), (array) $setting ) ) echo ' selected="selected"';
                    else selected( $setting, ( $value + 1 ) );
                    echo '>' . $option . '</option>';
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
                
            case 'color':
                echo '<input type="text" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" class="wp-color-picker" value="' . $setting . '" />';
                break;
                
            case 'file':
                echo '<input type="hidden" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" value="' . $setting . '" /><div id="' . $id . '_files">';
                if ( $setting ) {
                    $files = explode( ',', $setting );
                    foreach( $files as $file ) {
                        echo '<p>' . basename( get_attached_file( $file ) ) . '</p>';
                    }
                }
                echo '</div><input type="button" class="button" id="' . $id . '_button" value="' . ( $setting ? 'Re-select' : 'Select' ) . '" ' . ( $param['multiple'] ? 'multiple' : '' ) . '/> <input type="' . ( $setting ? 'button' : 'hidden' ) . '" class="button" id="' . $id . '_remove" value="Remove" />';
                break;
                
            case 'date':
                echo '<input type="date" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" value="' . $setting . '" />';
                break;
                
            case 'time':
                echo '<input type="time" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" value="' . $setting . '" />';
                break;
                
            case 'number':
                echo '<input type="number" name="<%= opts.functionPrefix %>[' . $id . ']" id="' . $id . '" value="' . $setting . '"';
                if ( is_array( $param['options'] ) ) foreach( $param['options'] as $option => $value ) echo $option . '="' . $value . '"';
                echo ' />';
                break;
        }
    }
}
