<?php
$post_category 	= get_theme_mod( 'pm_post_category', true );
$post_date 			= get_theme_mod( 'pm_post_date', true );
$post_excerpt 	= get_theme_mod( 'pm_excerpt', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( has_post_thumbnail() ) : ?>
		<?php
		$background_image = wp_get_attachment_image_src( get_post_thumbnail_ID(), 'pm-large-thumb' );
		$style = ' style="background-image:url(' . $background_image[0] . ')"';
		?>

		<div class="post-img"<?php echo $style; ?>>
			<a href="<?php the_permalink(); ?>"></a>
		</div>
	<?php endif; ?>

	<div class="post-content">

		<div class="post-header">

			<?php if( $post_category ) : ?>
				<?php pm_post_cat( '|' ); ?>
			<?php endif; ?>

			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<?php if( $post_date ) : ?>
				<p class="posted-info">
					<?php pm_post_date(); ?>
				</p>
			<?php endif; ?>

		</div>

		<?php if( $post_excerpt ): ?>
			<div class="post-entry post-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

	</div>
</article>
