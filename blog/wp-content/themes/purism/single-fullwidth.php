<?php
/*
* Template Name: Full Width Featured Image
* Template Post Type: post
*/

get_header();  ?>


<?php
$field_post_sidebar = get_post_meta( $post->ID, 'pm_field_post_sidebar' , true );
$related_posts 			= get_theme_mod( 'pm_related_posts', true );

$sidebar = 'sidebar-1';
$sidebar_type = '';
?>

<?php get_header(); ?>

<div class="content-wrapper">
	<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $field_post_sidebar == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php if( get_post_format() ) : ?>

				<div class="container-fluid">
					<div class="post-media-fw">
						<?php get_template_part( 'inc/templates/post', get_post_format() ); ?>
					</div>
				</div>

			<?php else : ?>

				<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), 'pm-fullwidth-thumb' ); ?>

				<?php if( $thumbnail[0] != '' ) : ?>
					<div class="container-fluid">
						<div class="post-img-fw" style="background-image: url(<?php echo $thumbnail[0]; ?>)"></div>
					</div>
				<?php endif; ?>

			<?php endif; ?>


			<div class="container">
				<div class="row">

					<main id="main" class="site-main">

						<?php pm_set_views( get_the_ID() ); ?>

						<div class="post-standard">
							<?php get_template_part( 'content', 'fullwidth' ); ?>
						</div>

						<?php if( $related_posts ) : ?>
							<?php pm_related_posts(); ?>
						<?php endif; ?>

						<?php if ( comments_open() || get_comments_number() ) : ?>
							<?php comments_template(); ?>
						<?php endif; ?>

					</main>

					<?php if ( is_active_sidebar( $sidebar ) && $field_post_sidebar !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
					<?php endif; ?>

				</div>
			</div>

		<?php	endwhile; ?>

	</div>
</div>

<?php get_footer(); ?>
