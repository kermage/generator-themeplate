<?php

/**
 * Setup meta boxes
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

if( ! function_exists( '<%= opts.functionPrefix %>_add_meta_box' ) ) {
    function <%= opts.functionPrefix %>_add_meta_box( $meta_box ) {
        if ( ! is_array( $meta_box ) )
            return false;
        
        if ( $meta_box['screen'] == 'post' )
            $meta_box['id'] =  $meta_box['id'] . '_post';
        
        add_meta_box( $meta_box['id'], $meta_box['title'], '<%= opts.functionPrefix %>_create_meta_box', $meta_box['screen'], $meta_box['context'], $meta_box['priority'], $meta_box );
    }
}

if( ! function_exists( '<%= opts.functionPrefix %>_create_meta_box' ) ) {
    function <%= opts.functionPrefix %>_create_meta_box( $post, $meta_box ) {
        if ( ! is_array( $meta_box ) )
            return false;
        
        if ( isset( $meta_box['args']['description'] ) && $meta_box['args']['description'] != '' )
            echo '<p>' . $meta_box['args']['description'] . '</p>';
        
        $fields = $meta_box['args']['fields'];
        wp_nonce_field( basename(__FILE__), '<%= opts.functionPrefix %>_meta_box_nonce' );
        
        if ( sizeof( $fields ) ) {
            echo '<table class="<%= opts.functionPrefix %>-meta-table">';
            
            foreach ( $fields as $id => $field ) {
                $meta = get_post_meta( $post->ID, $id, true );
                echo '<tr><th><label for="' . $id . '"><strong>' . $field['name'] . '</strong>
                    <span>' . $field['desc'] . '</span></label></th>';
                
                switch ( $field['type'] ) {
                    default:
                    case 'text':
                        echo '<td><input type="text" name="<%= opts.functionPrefix %>_meta[' . $id . ']" id="' . $id . '" value="' . ( $meta ? $meta : $field['std'] ) . '" size="30" /></td>';
                        break;
                        
                    case 'textarea' :
                        echo '<td><textarea name="<%= opts.functionPrefix %>_meta[' . $id . ']" id="' . $id . '" rows="4" cols="2">' . ( $meta ? $meta : $field['std'] ) . '</textarea></td>';
                        break;
                        
                    case 'select' :
                        echo '<td><select name="<%= opts.functionPrefix %>_meta[' . $id . ']" id="' . $id . '">';
                        foreach( $field['options'] as $option ) {
                            echo'<option';
                            if ( $meta ) {
                                if ( $meta == $option ) echo ' selected="selected"';
                            } else {
                                if ( $field['std'] == $option ) echo ' selected="selected"';
                            }
                            echo'>' . $option . '</option>';
                        }
                        echo '</select></td>';
                        break;
                        
                    case 'radio' :
                        echo '<td>';
                        foreach( $field['options'] as $option ) {
                            echo '<label class="radio-label"><input type="radio" name="<%= opts.functionPrefix %>_meta[' . $id . ']" value="' . $option . '" class="radio"';
                            if ( $meta ) {
                                if ( $meta == $option ) echo ' checked="yes"';
                            } else {
                                if ( $field['std'] == $option ) echo ' checked="yes"';
                            }
                            echo ' /> ' . $option . '</label> ';
                        }
                        echo '</td>';
                        break;
                        
                    case 'checkbox' :
                        echo '<td>';
                        $val = '';
                        if ( $meta ) {
                            if ( $meta == 'on' )
                                $val = ' checked="yes"';
                        } else {
                            if( $field['std'] == 'on' )
                                $val = ' checked="yes"';
                        }
                        echo '<input type="hidden" name="<%= opts.functionPrefix %>_meta[' . $id . ']" value="off" /><input type="checkbox" id="' . $id . '" name="<%= opts.functionPrefix %>_meta[' . $id . ']" value="on"' . $val . ' /> ';
                        echo '</td>';
                        break;

                    case 'color':
                        echo '<td><input type="text" name="<%= opts.functionPrefix %>_meta[' . $id . ']" id="' . $id . '" class="wp-color-picker" value="' . ( $meta ? $meta : $field['std'] ) . '" data-default-color="' . $field['std'] . '" /></td>';
                        break;

                    case 'file':
                        echo '<td><input type="text" name="<%= opts.functionPrefix %>_meta[' . $id . ']" id="' . $id . '" value="' . ( $meta ? $meta : $field['std'] ) . '" size="30" /><input type="button" class="button" id="' . $id . '_button" value="Browse" /></td>';
                        break;
                }
                echo '</tr>';
            }
            echo '</table>';
        }
    }
}

if( ! function_exists( '<%= opts.functionPrefix %>_save_meta_box' ) ) {
    function <%= opts.functionPrefix %>_save_meta_box( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
        
        if ( ! isset( $_POST['<%= opts.functionPrefix %>_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['<%= opts.functionPrefix %>_meta_box_nonce'], basename( __FILE__ ) ) )
            return;
        
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) )
                return;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
        }
        
        foreach( $_POST['<%= opts.functionPrefix %>_meta'] as $key => $val ) {
            update_post_meta( $post_id, $key, $val );
        }
    }
    add_action( 'save_post', '<%= opts.functionPrefix %>_save_meta_box' );
}
