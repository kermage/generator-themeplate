<?php

/**
 * <%= opts.themeName %> About widget
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

class <%= opts.classPrefix %>_About_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array( 'classname' => '<%= opts.functionPrefix %>_about', 'description' => __( 'Display site logo and info.', '<%= opts.projectSlug %>' ) );
		parent::__construct( '<%= opts.functionPrefix %>_about', '<%= opts.themeName %>: About', $widget_ops );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
			<?php if ( isset($instance['logo_url'] ) && $instance['logo_url'] ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url($instance['logo_url']); ?>" alt="<?php bloginfo( 'name' ); ?> Logo"/>
				</a>
			<?php endif; ?>

			<?php if ( isset($instance['info_text'] ) && $instance['info_text'] ) : ?>
				<p><?php echo $instance['info_text']; ?></p>
			<?php endif; ?>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$defaults = array( 'logo_url' => '', 'info_text' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>"><?php _e( 'Logo URL:', '<%= opts.projectSlug %>' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_url' ) ); ?>" value="<?php echo esc_attr( $instance['logo_url'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'info_text' ) ); ?>"><?php _e( 'Info Text:', '<%= opts.projectSlug %>' ); ?></label>
			<textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id( 'info_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'info_text' ) ); ?>"><?php echo $instance['info_text']; ?></textarea>
		</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['logo_url'] = $new_instance['logo_url'];
		$instance['info_text'] = $new_instance['info_text'];
		return $instance;
	}
}
