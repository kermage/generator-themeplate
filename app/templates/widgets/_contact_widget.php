<?php

/**
 * <%= opts.themeName %> Contact widget
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

class <%= opts.classPrefix %>_Contact_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => '<%= opts.functionPrefix %>_contact', 'description' => __( 'Display contact information.', '<%= opts.functionPrefix %>' ) );
		parent::__construct( '<%= opts.functionPrefix %>_contact', '<%= opts.themeName %>: Contact', $widget_ops );
	}

	function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['contact_title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['contact_title'] ). $args['after_title'];
		}
		?>
			<div class="contact-wrap">
				<?php if ( isset($instance['contact_text'] ) && $instance['contact_text'] ) : ?>
					<p><?php echo $instance['contact_text']; ?></p>
				<?php endif; ?>
				<?php if ( isset($instance['contact_number'] ) && $instance['contact_number'] ) : ?>
					<span class="number"><?php echo $instance['contact_number']; ?></span>
				<?php endif; ?>
				<?php if ( isset($instance['contact_email'] ) && $instance['contact_email'] ) : ?>
					<a href="mailto:<?php echo $instance['contact_email']; ?>" class="email"><?php echo $instance['contact_email']; ?></a>
				<?php endif; ?>
				<?php if ( isset($instance['contact_address'] ) && $instance['contact_address'] ) : ?>
					<span class="address"><?php echo $instance['contact_address']; ?></span>
				<?php endif; ?>
			</div>
		<?php
		echo $args['after_widget'];
	}

	function form( $instance ) {
		$defaults = array( 'contact_title' => '', 'contact_text' => '', 'contact_number' => '', 'contact_email' => '', 'contact_address' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_title' ) ); ?>"><?php _e( 'Title:', '<%= opts.functionPrefix %>' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'contact_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_title' ) ); ?>" value="<?php echo esc_attr( $instance['contact_title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_text' ) ); ?>"><?php _e( 'Contact Text:', '<%= opts.functionPrefix %>' ); ?></label>
			<textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id( 'contact_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_text' ) ); ?>"><?php echo $instance['contact_text']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_number' ) ); ?>"><?php _e( 'Contact Number:', '<%= opts.functionPrefix %>' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'contact_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_number' ) ); ?>" value="<?php echo esc_attr( $instance['contact_number'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>"><?php _e( 'Email Address:', '<%= opts.functionPrefix %>' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_email' ) ); ?>" value="<?php echo esc_attr( $instance['contact_email'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_address' ) ); ?>"><?php _e( 'Site Address:', '<%= opts.functionPrefix %>' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'contact_address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_address' ) ); ?>" value="<?php echo esc_attr( $instance['contact_address'] ); ?>" />
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['contact_title'] = $new_instance['contact_title'];
		$instance['contact_text'] = $new_instance['contact_text'];
		$instance['contact_number'] = $new_instance['contact_number'];
		$instance['contact_email'] = $new_instance['contact_email'];
		$instance['contact_address'] = $new_instance['contact_address'];
		return $instance;
	}
}
