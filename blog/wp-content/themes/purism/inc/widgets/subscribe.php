<?php

/**
* Mailchimp Subscribe Form
*/

class pm_subscribe extends WP_Widget {

  /**
  * Register widget with WordPress
  */

  function __construct() {
    parent::__construct(
      'pm_subscribe',
      esc_html__( 'Purism: MailChimp Subscription Form', 'purism' ),
      array( 'description' => esc_html__( 'Displays the MailChimp Subscribe Form.', 'purism' ), ) // Args
    );
  }

  /**
  * Front-end display of widget
  */

  public function widget( $args, $instance ) {

    $title          = apply_filters( 'widget_title', $instance['title'] );
    $info           = '<p class="subscribe-info">' . esc_html( $instance['info'] ) . '</p>';
    $mailchimp_url  = get_theme_mod( 'pm_mailchimp_url', '' );

    echo $args['before_widget'];
    if ( !empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    echo '<div class="subscribe-widget">';
    echo ( !empty( $instance['info'] ) ) ? $info  : null;
    ?>

    <?php if ( $mailchimp_url !== '') : ?>
      <div class="subscribe-form">
        <form class="mc-form">

          <input type="email" id="<?php echo esc_attr($this->id); ?>-email" class="form-control"
          name="email"
          placeholder="<?php esc_attr_e( 'Enter your Email here...', 'purism' ); ?>">
          <button type="submit" class="btn btn-color mc-form-submit">
            <?php esc_html_e( 'Subscribe', 'purism' ); ?>
          </button>

          <div class="message-newsletter">
            <label for="<?php echo esc_attr($this->id); ?>-email" class="message-text"></label>
          </div>

        </form>
      </div>
    <?php endif; ?>

    <?php
    echo '</div>';
    echo $args['after_widget'];

  }

  /**
  * Back-end widget form
  */

  public function form( $instance ) {
    $defaults = array(
      'title' => esc_attr__( 'Newsletter', 'purism' ),
      'info'  => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'info' ) ); ?>"><?php esc_html_e( 'Info:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'info' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'info' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['info'] ); ?>"/>
    </p>
    <p><?php esc_html_e( 'MailChimp URL can be configured in Wordpress Customizer.', 'purism' ); ?></p>

    <?php
  }

  /*
  * Sanitize widget form values as they are saved
  */

  public function update( $new_instance, $old_instance ) {
    $instance           = $old_instance;
    $instance['title']  = sanitize_text_field( $new_instance['title'] );
    $instance['info']   = sanitize_text_field( $new_instance['info'] );
    return $instance;
  }
}
