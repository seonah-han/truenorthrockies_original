<?php
/**
* Page Teaser
*/

class pm_teaser extends WP_Widget {

  /**
  * Register widget with WordPress
  */

  function __construct() {
    parent::__construct(
      'pm_teaser',
      esc_html__( 'Purism: Page Teaser', 'purism' ),
      array( 'description' => esc_html__( 'Creates a Page Teaser consisting of a title, subtitle, image, signature, description and link.', 'purism' ), ) // Args
    );
    add_action('admin_enqueue_scripts', array( $this, 'teaser_assets' ) );
  }

  /**
  * Back-end widget assets
  */

  public function teaser_assets() {
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
    $title        = apply_filters('widget_title', $instance['title']);
    $page         = pm_language_object_id( $instance['page'], 'page' );
    $headline     = '<h3>' . $instance['headline'] . '</h3>';
    $subline      = '<h4>' . $instance['subline'] . '</h4>';
    $image_round  = $instance['image_round'];
    if( $image_round ) {
      $class = 'class="img-circle" ';
    }  else {
      $class = '';
    }
    $image        = '<img ' . $class . 'src="' . esc_url( $instance['image_url'] ) . '" alt="' . esc_attr( $instance['image_alt'] ) . '">';
    $text_block   = '<p>' . wp_kses( $instance['text'] , array( 'br' => '' ) ) . '</p>';
    $signature    = '<img class="signature" src="' . esc_url( $instance['signature_url'] ) . '" alt="' . esc_attr( $instance['signature_alt'] ) . '">';
    $link_intern  = '<a class="btn btn-color" href="' . esc_url( get_permalink( $page ) ) .'">' . esc_html( $instance['link_text'] ) . '</a>';
    $link_extern  = '<a class="btn btn-color" href="' . esc_url( $instance['url'] ) . '" target="_blank">' . esc_html( $instance['link_text'] ) . '</a>';

    echo $args['before_widget'];
    if ( !empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    echo '<div class="teaser-widget">';
    echo ( !empty( $instance['image_url']) ) ? $image  : null;
    echo ( !empty( $instance['headline']) ) ? $headline  : null;
    echo ( !empty( $instance['subline']) ) ? $subline  : null;
    echo ( !empty( $instance['text']) ) ? $text_block  : null;
    echo ( !empty( $instance['signature_url']) ) ? $signature  : null;
    echo ( !empty( $page ) && !empty( $instance['link_text'] ) ) ? $link_intern  : null;
    echo ( !empty( $instance['url']) && !empty( $instance['link_text'] ) ) ? $link_extern  : null;
    echo '</div>';
    echo $args['after_widget'];
  }

  /**
  * Back-end widget form
  */

  public function form( $instance ) {
    $image = get_template_directory_uri() . '/dist/images/placeholder.jpg';
    $signature = get_template_directory_uri() . '/dist/images/signature-placeholder.png';

    $defaults = array(
      'title'         => esc_attr__( 'Teaser', 'purism' ),
      'headline'      => '',
      'subline'       => '',
      'image_url'     => '',
      'image_alt'     => '',
      'image_round'   => '',
      'signature_url' => '',
      'signature_alt' => '',
      'text'          => '',
      'page'          => '-1',
      'link_text'     => '',
      'url'           => '',
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
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="hidden" value="<?php echo esc_attr( $instance['image_url'] ); ?>"/>
    </p>
    <p>
      <img class="widefat" src="<?php if( $instance['image_url'] ) { echo esc_url( $instance['image_url']); } else { echo esc_url( $image ); } ?>" height="auto">
    </p>
    <p>
      <input type="button" value="<?php esc_attr_e( 'Upload Image', 'purism' ); ?>" class="button pm_upload_image_button"/>
      <input type="button" value="<?php esc_attr_e( 'Remove Image', 'purism' ); ?>" class="button pm_remove_image_button"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'image_round' ) ); ?>"><?php esc_html_e( 'Image Circle:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_round' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_round' ) ); ?>" type="checkbox" <?php checked( $instance['image_round'] ); ?>>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'headline' ) ); ?>"><?php esc_html_e( 'Headline:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'headline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'headline' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['headline'] ); ?>"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'subline' ) ); ?>"><?php esc_html_e( 'Subline:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subline' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['subline'] ); ?>"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'purism' ); ?></label>
      <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" rows="5"><?php echo esc_html( $instance['text'] ); ?></textarea>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'signature_alt' ) ); ?>"><?php esc_html_e( 'Alt Text:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'signature_alt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'signature_alt' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['signature_alt'] ); ?>"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'signature_url' ) ); ?>"><?php esc_html_e( 'Signature:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'signature_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'signature_url' ) ); ?>" type="hidden" value="<?php echo esc_url( $instance['signature_url'] ); ?>"/>
    </p>
    <p>
      <img class="widefat" src="<?php if( $instance['signature_url'] ) { echo esc_url( $instance['signature_url'] ); } else { echo esc_url( $signature ); } ?>" height="auto">
    </p>
    <p>
      <input type="button" value="<?php esc_attr_e( 'Upload Signature', 'purism' ); ?>" class="button pm_upload_image_button"/>
      <input type="button" value="<?php esc_attr_e( 'Remove Signature', 'purism' ); ?>" class="button pm_remove_signature_button"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>"><?php esc_html_e( 'Link Text:', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['link_text'] ); ?>"/>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id('page') ); ?>"><?php esc_html_e( 'Link (intern):', 'purism' ); ?> </label><br>
      <?php
      $selected = pm_language_object_id( $instance['page'], 'page' );
      $args = array(
        'id'                => $this->get_field_id('page'),
        'name'              => $this->get_field_name('page'),
        'show_option_none'  =>  esc_html__('None', 'purism'),
        'option_none_value' => '-1',
        'selected'          => $selected,
        'class'             => 'widefat',
      );
      wp_dropdown_pages( $args );

      ?>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Link (extern):', 'purism' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['url'] ); ?>"/>
    </p>

    <?php
  }

  /**
  * Sanitize widget form values as they are saved
  */

  public function update( $new_instance, $old_instance ) {
    $instance                   = $old_instance;
    $instance['title']          = sanitize_text_field( $new_instance['title'] );
    $instance['headline']       = sanitize_text_field( $new_instance['headline'] );
    $instance['subline']        = sanitize_text_field( $new_instance['subline'] );
    $instance['image_url']      = sanitize_text_field( $new_instance['image_url'] );
    $instance['image_alt']      = sanitize_text_field( $new_instance['image_alt'] );
    $instance['image_round']    = ( !empty( $new_instance['image_round'] ) ) ? 1 : 0;
    $instance['signature_url']  = sanitize_text_field( $new_instance['signature_url'] );
    $instance['signature_alt']  = sanitize_text_field( $new_instance['signature_alt'] );
    $instance['text']           = $new_instance['text'];
    $instance['page']           = $new_instance['page'];
    $instance['link_text']      = sanitize_text_field( $new_instance['link_text'] );
    $instance['url']            = sanitize_text_field( $new_instance['url'] );
    return $instance;
  }
}
