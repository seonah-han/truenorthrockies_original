<?php
/**
* Social Media Widget
*/

class pm_social extends WP_Widget {

  /*
  * Register widget with WordPress
  */
  function __construct() {
    parent::__construct(
      'pm_social',
      esc_html__( 'Purism: Social Media Links', 'purism' ),
      array( 'description' => esc_html__( 'Enables you to display the Social Media Icons in your sidebar.', 'purism' ), )
    );
  }

  /*
  * Front-end display of widget
  */
  public function widget( $args, $instance ) {
    $title              = apply_filters('widget_title', $instance['title']);
    $facebook_profile   = '<a href="' . esc_url( $instance['facebook'] ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
    $google_profile     = '<a href="' . esc_url( $instance['google'] ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
    $twitter_profile    = '<a href="' . esc_url( $instance['twitter'] ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
    $instagram_profile  = '<a href="' . esc_url( $instance['instagram'] ) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
    $behance_profile    = '<a href="' . esc_url( $instance['behance'] ) . '" target="_blank"><i class="fa fa-behance"></i></a>';
    $pinterest_profile  = '<a href="' . esc_url( $instance['pinterest'] ) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
    $tumblr_profile     = '<a href="' . esc_url( $instance['tumblr'] ) . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
    $bloglovin_profile  = '<a href="' . esc_url( $instance['bloglovin'] ) . '" target="_blank"><i class="fa fa-heart"></i></a>';
    $flickr_profile     = '<a href="' . esc_url( $instance['flickr'] ) . '" target="_blank"><i class="fa fa-flickr"></i></a>';
    $xing_profile       = '<a href="' . esc_url( $instance['xing'] ) . '" target="_blank"><i class="fa fa-xing"></i></a>';
    $github_profile     = '<a href="' . esc_url( $instance['github'] ) . '" target="_blank"><i class="fa fa-github"></i></a>';
    $youtube_profile    = '<a href="' . esc_url( $instance['youtube'] ) . '" target="_blank"><i class="fa fa-youtube"></i></a>';
    $vimeo_profile      = '<a href="' . esc_url( $instance['vimeo'] ) . '" target="_blank"><i class="fa fa-vimeo"></i></a>';
    $dribbble_profile   = '<a href="' . esc_url( $instance['dribbble'] ) . '" target="_blank"><i class="fa fa-dribbble"></i></a>';
    $soundcloud_profile = '<a href="' . esc_url( $instance['soundcloud'] ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a>';
    $linkedin_profile   = '<a href="' . esc_url( $instance['linkedin'] ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
    $rss_profile        = '<a href="' . esc_url( $instance['rss'] ) . '" target="_blank"><i class="fa fa-rss"></i></a>';

    echo $args['before_widget'];
    if ( !empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    echo '<div class="social-widget social-links">';
    echo ( !empty($instance['facebook'] ) ) ? $facebook_profile : null;
    echo ( !empty($instance['google'] ) ) ? $google_profile : null;
    echo ( !empty($instance['twitter'] ) ) ? $twitter_profile : null;
    echo ( !empty($instance['instagram'] ) ) ? $instagram_profile : null;
    echo ( !empty($instance['behance'] ) ) ? $behance_profile : null;
    echo ( !empty($instance['pinterest'] ) ) ? $pinterest_profile : null;
    echo ( !empty($instance['tumblr'] ) ) ? $tumblr_profile : null;
    echo ( !empty($instance['bloglovin'] ) ) ? $bloglovin_profile : null;
    echo ( !empty($instance['flickr'] ) ) ? $flickr_profile : null;
    echo ( !empty($instance['xing'] ) ) ? $xing_profile : null;
    echo ( !empty($instance['github'] ) ) ? $github_profile : null;
    echo ( !empty($instance['youtube'] ) ) ? $youtube_profile : null;
    echo ( !empty($instance['vimeo'] ) ) ? $vimeo_profile : null;
    echo ( !empty($instance['dribbble'] ) ) ? $dribbble_profile : null;
    echo ( !empty($instance['soundcloud'] ) ) ? $soundcloud_profile : null;
    echo ( !empty($instance['linkedin'] ) ) ? $linkedin_profile : null;
    echo ( !empty($instance['rss'] ) ) ? $rss_profile : null;
    echo '</div>';
    echo $args['after_widget'];
  }

  /**
  * Back-end widget form
  */
  public function form( $instance ) {
    $defaults = array(
      'title'       => esc_attr__( 'Follow me on', 'purism' ),
      'facebook'    => '',
      'google'      => '',
      'twitter'     => '',
      'instagram'   => '',
      'behance'     => '',
      'pinterest'   => '',
      'tumblr'      => '',
      'bloglovin'   => '',
      'flickr'      => '',
      'xing'        => '',
      'github'      => '',
      'youtube'     => '',
      'vimeo'       => '',
      'dribbble'    => '',
      'soundcloud'  => '',
      'linkedin'    => '',
      'rss'         => '',
    );
    $instance = wp_parse_args( ( array ) $instance, $defaults );
    ?>
    <p><?php esc_html_e( 'Enter the URL of your social media account.', 'purism' ); ?></p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>"><?php esc_html_e( 'Google+:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id(' google' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['google'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>"><?php esc_html_e( 'Behance:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('behance') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['behance'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e( 'Tumblr:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tumblr'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>"><?php esc_html_e( 'Bloglovin:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bloglovin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['bloglovin'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>"><?php esc_html_e( 'Flickr:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['flickr'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>"><?php esc_html_e( 'Xing:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'xing' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['xing'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>"><?php esc_html_e( 'Github:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['github'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Youtube:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e( 'Vimeo:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vimeo'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e( 'Dribbble:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['dribbble'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>"><?php esc_html_e( 'Soundcloud:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['soundcloud'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php esc_html_e( 'RSS:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['rss'] ); ?>">
    </p>
    <?php
  }

  /*
  * Sanitize widget form values as they are saved
  */

  public function update( $new_instance, $old_instance ) {

    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
    $instance['google'] = sanitize_text_field( $new_instance['google'] );
    $instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
    $instance['instagram'] = sanitize_text_field( $new_instance['instagram'] );
    $instance['behance'] = sanitize_text_field( $new_instance['behance'] );
    $instance['pinterest'] = sanitize_text_field( $new_instance['pinterest'] );
    $instance['tumblr'] = sanitize_text_field( $new_instance['tumblr'] );
    $instance['bloglovin'] = sanitize_text_field( $new_instance['bloglovin'] );
    $instance['flickr'] = sanitize_text_field( $new_instance['flickr'] );
    $instance['xing'] = sanitize_text_field( $new_instance['xing'] );
    $instance['github'] = sanitize_text_field( $new_instance['github'] );
    $instance['youtube'] = sanitize_text_field( $new_instance['youtube'] );
    $instance['vimeo'] = sanitize_text_field( $new_instance['vimeo'] );
    $instance['dribbble'] = sanitize_text_field( $new_instance['dribbble'] );
    $instance['soundcloud'] = sanitize_text_field( $new_instance['soundcloud'] );
    $instance['linkedin'] = sanitize_text_field( $new_instance['linkedin'] );
    $instance['rss'] = sanitize_text_field( $new_instance['rss'] );

    return $instance;
  }
}
