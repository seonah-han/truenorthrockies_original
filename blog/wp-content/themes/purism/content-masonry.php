<?php
$post_category 	= get_theme_mod( 'pm_post_category', true );
$post_date 			= get_theme_mod( 'pm_post_date', true );
$post_comments 	= get_theme_mod( 'pm_post_comments', true );
$post_views 		= get_theme_mod( 'pm_post_views', true );
$post_likes 		= get_theme_mod( 'pm_post_likes', true );
$post_excerpt 	= get_theme_mod( 'pm_excerpt', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( has_post_thumbnail() ) : ?>
		<div class="post-img">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pm-full-thumb'); ?></a>
		</div>
	<?php endif; ?>

	<div class="post-header">

		<?php if( $post_category ) : ?>
			<?php pm_post_cat('|'); ?>
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
			<?php pm_read_more(); ?>
		</div>
	<?php endif; ?>

	<?php if( $post_comments || $post_views || $post_likes ) : ?>
		<div class="post-meta meta-bottom">

			<div class="box-full">
				<div class="meta-group">

					<?php if( $post_comments ) : ?>
						<?php pm_post_comments(); ?>
					<?php endif; ?>

					<?php if( $post_views ) : ?>
						<?php if( $post_comments && comments_open() ) : ?>
							<span class="separator">|</span>
						<?php endif; ?>
						<?php pm_post_views(); ?>
					<?php endif; ?>

					<?php if( $post_likes ) : ?>
						<?php if( ( $post_comments && comments_open() ) || $post_views ) : ?>
							<span class="separator">|</span>
						<?php endif; ?>
						<?php pm_post_likes(); ?>
					<?php endif; ?>
					
				</div>
			</div>

		</div>
	<?php endif; ?>

</article>
