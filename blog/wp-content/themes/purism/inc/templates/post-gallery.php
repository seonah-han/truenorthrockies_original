<?php
$gallery_images = get_post_meta( $post->ID, '_format_gallery_images', true );
?>

<?php if( $gallery_images ) : ?>
	<div class="post-gallery">
		<div class="gallery-slider">

			<?php foreach( $gallery_images as $gallery_image ) : ?>
				<?php $background_image = wp_get_attachment_image_src( $gallery_image, 'pm-full-thumb' ); ?>
				<?php $the_caption = get_post_field( 'post_excerpt', $gallery_image ); ?>
				<div class="gallery-image" <?php echo 'style="background-image:url(' . $background_image[0] . ')"'; ?>></div>
			<?php endforeach; ?>
			
		</div>
	</div>
<?php endif; ?>
