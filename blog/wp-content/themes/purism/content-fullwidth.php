<?php
$post_summary 						= get_theme_mod( 'pm_post_summary' , 'excerpt' );
$post_category 						= get_theme_mod( 'pm_post_category' , true );
$post_date 								= get_theme_mod( 'pm_post_date' , true );
$post_author 							= get_theme_mod( 'pm_post_author' , true );
$post_author_description	= get_theme_mod( 'pm_post_author_description' , true );
$post_comments 						= get_theme_mod( 'pm_post_comments' , true );
$post_views 							= get_theme_mod( 'pm_post_views' , true );
$post_likes 							= get_theme_mod( 'pm_post_likes' , true );
$post_shares 							= get_theme_mod( 'pm_post_shares' , true );
$post_tags 								= get_theme_mod( 'pm_post_tags' , true );
$post_embed 							= get_theme_mod( 'pm_standard_post_embed' , true );
$post_excerpt 						= get_theme_mod( 'pm_excerpt', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-header">

		<?php if( $post_category ) : ?>
			<?php pm_post_cat('|'); ?>
		<?php endif; ?>

		<?php if( is_single() ) : ?>
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>

		<?php if( $post_date || $post_author ) : ?>
			<p class="posted-info">
				<?php if( $post_date ) : ?>
					<?php pm_post_date(); ?>
				<?php endif; ?>

				<?php if( $post_author ) : ?>
					<?php pm_post_author(); ?>
				<?php endif; ?>
			</p>
		<?php endif; ?>

	</div>

	<?php if( $post_summary == 'excerpt' && !is_single() ) : ?>
		<?php if( $post_excerpt ): ?>
			<div class="post-entry post-excerpt">
				<?php the_excerpt(); ?>
				<?php pm_read_more(); ?>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="post-entry">
			<?php
			the_content( esc_html__( 'Read more', 'purism' ) );
			$defaults = array(
				'before'           => '<p class="post-nav">' . esc_html__( 'Pages:', 'purism'),
				'after'            => '</p>',
			);
			wp_link_pages($defaults);
			?>
		</div>
	<?php endif; ?>

	<?php if( is_single() && has_tag() &&  $post_tags ) : ?>
		<div class="post-tags">
			<?php the_tags('',''); ?>
		</div>
	<?php endif; ?>

	<?php if( $post_shares || $post_comments || $post_views || $post_likes ) : ?>
		<div class="post-meta meta-bottom">

			<div class="box-left">
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

			<div class="box-right">
				<div class="meta-group">
					<?php if( is_single() && $post_likes  ) : ?>
						<?php echo pm_get_simple_likes_button( get_the_ID() ); ?>
					<?php endif; ?>
					<?php if( $post_shares ) : ?>
						<?php if( is_single() && $post_likes ) : ?>
							<span class="separator">|</span>
						<?php endif; ?>
						<?php pm_share_buttons(); ?>
					<?php endif; ?>
				</div>
			</div>

		</div>
	<?php endif; ?>

	<?php if( is_single() && $post_author_description && get_the_author_meta('description') ) : ?>
		<?php pm_author_profile(); ?>
	<?php endif; ?>

</article>
