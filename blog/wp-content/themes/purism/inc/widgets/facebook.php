<?php
/**
* Facebook Widget
*/

class pm_facebook extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	function __construct() {
		parent::__construct(
			'pm_facebook',
			esc_html__( 'Purism: Facebook Like Box', 'purism' ),
			array( 'description' => esc_html__( 'Enables you to display the Facebook Like Box in your sidebar.', 'purism' ), )
		);
	}

	/**
	* Front-end display of widget
	*/
	public function widget( $args, $instance ) {

		$title = apply_filters('widget_title', $instance['title']);

		echo $args['before_widget'];
		if ( !empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<div class="facebook-widget">
			<div class="fb-page" data-href="<?php echo esc_url( $instance['url'] ); ?>" data-tabs="<?php echo esc_attr( $instance['tabs'] ); ?>" data-width="<?php echo esc_html( $instance['width'] ); ?>" data-height="<?php echo esc_html( $instance['height'] ); ?>" data-small-header="<?php if( $instance['small_header'] ) { echo 'true'; } else { echo 'false'; } ?>" data-adapt-container-width="true" data-hide-cover="<?php if( $instance['hide_cover'] ) { echo 'true'; } else { echo 'false'; } ?>" data-show-facepile="<?php if( $instance['show_facepile'] ) { echo 'true'; } else { echo 'false'; } ?>"></div>
		</div>

		<?php
		echo $args['after_widget'];
	}

	/**
	* Back-end widget form
	*/
	public function form( $instance ) {

		$defaults = array(
			'title' 				=> esc_attr__( 'Find us on Facebook', 'purism' ),
			'url' 					=> '',
			'width' 				=> '360',
			'height' 				=> '500',
			'tabs' 					=> '',
			'small_header' 	=> 0,
			'hide_cover' 		=> 0,
			'show_facepile' => 0
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Facebook URL:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['url'] ); ?>"><small><?php esc_html_e( 'The URL of the Facebook Page i.e. https://www.facebook.com/egotypes', 'purism' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e( 'Width:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['width'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Height:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['height'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tabs' ) ); ?>"><?php esc_html_e( 'Tabs:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tabs' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tabs' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tabs'] ); ?>">
			<small><?php esc_html_e( 'Tabs to render i.e. timeline, events, messages. Use a comma-separated list to add multiple tabs, i.e. timeline, events.', 'purism' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>"><?php esc_html_e( 'Small Header:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'small_header' ) ); ?>" type="checkbox" <?php checked( $instance['small_header'] ); ?>>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>"><?php esc_html_e( 'Hide Cover:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_cover' ) ); ?>" type="checkbox" <?php checked( $instance['hide_cover'] ); ?>>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>"><?php esc_html_e( 'Show Facepile:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_facepile' ) ); ?>" type="checkbox" <?php checked( $instance['show_facepile'] ); ?>>
		</p>

		<?php
	}

	/**
	* Sanitize widget form values as they are saved
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 					= sanitize_text_field( $new_instance['title'] );
		$instance['url'] 						= sanitize_text_field( $new_instance['url'] );
		$instance['width'] 					= sanitize_text_field( $new_instance['width'] );
		$instance['height'] 				= sanitize_text_field( $new_instance['height'] );
		$instance['tabs'] 					= sanitize_text_field( $new_instance['tabs'] );
		$instance['small_header'] 	= ( ! empty( $new_instance['small_header'] ) ) ? 1 : 0;
		$instance['hide_cover'] 		= ( ! empty( $new_instance['hide_cover'] ) ) ? 1 : 0;
		$instance['show_facepile'] 	= ( ! empty( $new_instance['show_facepile'] ) ) ? 1 : 0;

		return $instance;
	}
}
