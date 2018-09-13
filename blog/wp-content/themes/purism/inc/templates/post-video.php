<?php
$video_url = get_post_meta( $post->ID, '_format_video_embed', true );
?>

<div class="post-video">
	<?php if( wp_oembed_get( $video_url ) ) : ?>
		<?php echo wp_oembed_get( esc_url( $video_url ) ); ?>
	<?php else : ?>
		<?php echo esc_url(  $video_url ); ?>
	<?php endif; ?>
</div>
