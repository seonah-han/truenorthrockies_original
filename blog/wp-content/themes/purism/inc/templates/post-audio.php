<?php
$audio_url = get_post_meta( $post->ID, '_format_audio_embed', true );
?>

<div class="post-audio">
	<?php if( wp_oembed_get( $audio_url ) ) : ?>
		<?php echo wp_oembed_get( esc_url( $audio_url ) ); ?>
	<?php else : ?>
		<?php echo esc_url( $audio_url ); ?>
	<?php endif; ?>
</div>
