<?php
if ( post_password_required() ) :
  return;
endif;
?>

<div id="comments" class="comments">

  <div class="feature-title">
    <h2><span><?php comments_number( esc_html__( 'No Comments', 'purism' ), esc_html__( '1 Comment', 'purism' ), esc_html__( '% Comments', 'purism' ) ); ?></span></h2>
  </div>

  <?php if ( have_comments() ) : ?>

    <ul class="comments-list">
      <?php
      wp_list_comments( array(
        'style'       => 'ul',
        'short_ping'  => true,
        'avatar_size' => 60,
        'max_depth'		=> 5,
        'callback'		=> 'pm_comments',
      ) );
      ?>
    </ul>

    <?php
    $allowed_html =	array(
      'i' => array(
        'class' => array(),
      ),
    );

    the_comments_navigation( array(
      'prev_text' => wp_kses( __( 'Older Comments <i class="fa fa-angle-double-right"></i>', 'purism' ),  $allowed_html ),
      'next_text' => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Newer Comments', 'purism' ), $allowed_html ),
      )
    ); ?>

  <?php endif; ?>

  <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'purism' ); ?></p>
  <?php endif; ?>

  <?php
  comment_form( array(
    'title_reply'			      => esc_html__( 'Leave a Reply', 'purism' ),
    'cancel_reply_link'     => esc_html__( 'Cancel Reply', 'purism' )
    )
  ); ?>

</div>
