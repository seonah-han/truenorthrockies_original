<?php
/**
* Sponsored Post Widget
*/

class pm_sponsored extends WP_Widget {

  /**
  * Register widget with WordPress
  */

  function __construct() {
    parent::__construct(
      'pm_sponsored',
      esc_html__( 'Purism: Sponsored Post', 'purism' ),
      array( 'description' => esc_html__( 'Creates a Sponsored Post consisting of a title, image, description and link.', 'purism' ), ) // Args
    );
    add_action('admin_enqueue_scripts', array($this, 'sponsored_assets'));
  }

  /**
  * Back-end widget assets
  */

  public function sponsored_assets() {
    wp_enqueue_script('media-upload');
    wp_enqueue_media();
    wp_enqueue_script('pm-media-upload', get_template_directory_uri() . '/dist/js/pm-media-upload.min.js', array( 'jquery' ), '', true );
    $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
    wp_localize_script( 'pm-media-upload', 'object_name', $translation_array );
  }

  /**
  * Front-end display of widget
  */

  public function widget( $args, $instance ) {
    $title          = apply_filters( 'widget_title', $instance['title'] );
    $headline       = '<h3>' . esc_html( $instance['headline'] ) . '</h3>';
    $image          = '<img src="' . esc_url( $instance['image_url'] ) . '" alt="' . esc_attr( $instance['image_alt'] ) . '">';
    $post         = pm_language_object_id( $instance['post'], 'post' );
    $text_block   = '<p>' . wp_kses( $instance['text']  , array( 'br' => '' ) ) . '</p>';
    $link_intern  = '<a class="btn btn-color more-link" href="' . esc_url( get_post_permalink( $post ) ) .'">' . esc_html__( 'Read more', 'purism' ) . '</a>';

    echo $args['before_widget'];
    if ( !empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    echo '<div class="sponsored-widget">';
    echo ( !empty( $instance['image_url']) ) ? $image  : null;
    echo ( !empty( $instance['headline']) ) ? $headline  : null;
    echo ( !empty( $instance['text']) ) ? $text_block  : null;
    echo ( !empty( $post ) ) ? $link_intern  : null;
    echo '</div>';
    echo $args['after_widget'];
  }

  /**
  * Back-end widget form
  */

  public function form( $instance ) {

    $image = get_template_directory_uri() . '/dist/images/placeholder.jpg';

    $defaults = array(
      'title'     => esc_attr__( 'Sponsored Post', 'purism' ),
      'headline'  => '',
      'image_url' => '',
      'image_alt' => '',
      'text'      => '',
      'post'      => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'image_alt' ) ); ?>"><?php esc_html_e( 'Image Alternativtext (alt):', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_alt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_alt' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['image_alt'] ); ?>"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php esc_html_e( 'Image:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="hidden" value="<?php echo esc_url( $instance['image_url'] ); ?>"/>
    </p>
    <p>
      <img class="widefat" src="<?php if( $instance['image_url'] ) { echo esc_url( $instance['image_url'] ); } else { echo esc_url( $image ); } ?>" height="auto">
    </p>
    <p>
      <input type="button" value="<?php esc_html_e( 'Upload Image', 'purism' ); ?>" class="button pm_upload_image_button"/>
      <input type="button" value="<?php esc_html_e( 'Remove Image', 'purism' ); ?>" class="button pm_remove_image_button"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'headline' ) ); ?>"><?php esc_html_e( 'Headline:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'headline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'headline' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['headline'] ); ?>"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'purism' ); ?></label>
      <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" rows="5"><?php echo esc_html( $instance['text'] ); ?></textarea>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id('post') ); ?>"><?php esc_html_e( 'Link to Post:', 'purism' ); ?> </label><br>

      <?php
      $selected = pm_language_object_id( $instance['post'], 'post' );

      $args = array(
        'post_type'   => 'post',
        'post_status' => 'publish',
      );
      $query = null;
      $query = new WP_Query( $args );
      ?>

      <?php if( $query->have_posts() ) : ?>

        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post' ) ); ?>">
          <option value="" <?php selected( $instance['post'], '' ); ?>><?php esc_html_e( 'None', 'purism' ); ?></option>
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <option value="<?php the_id(); ?>" <?php selected( $selected, get_the_id() ); ?>><?php the_title(); ?></option>
          <?php endwhile; ?>
        </select>

      <?php endif; ?>

      <?php wp_reset_postdata(); ?>
    </p>
    <?php
  }

  /**
  * Sanitize widget form values as they are saved
  */

  public function update( $new_instance, $old_instance ) {
    $instance               = $old_instance;
    $instance['title']      = sanitize_text_field( $new_instance['title'] );
    $instance['headline']   = sanitize_text_field( $new_instance['headline'] );
    $instance['image_url']  = sanitize_text_field( $new_instance['image_url'] );
    $instance['image_alt']  = sanitize_text_field( $new_instance['image_alt'] );
    $instance['text']       = $new_instance['text'];
    $instance['post']       = sanitize_text_field( $new_instance['post'] );

    return $instance;
  }
}
