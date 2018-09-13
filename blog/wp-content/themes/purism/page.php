<?php
$field_page_sidebar 	= get_post_meta( $post->ID, 'pm_field_page_sidebar' , 'sidebar' );
$pm_popular_posts 		= get_post_meta( $post->ID, 'pm_field_popular', true );
$page_content_shares 	= get_theme_mod( 'pm_page_content_shares' , true );

$sidebar = 'sidebar-1';
$sidebar_type = '';

if( $field_page_sidebar == 'sidebar-shop' ) {
	$sidebar = 'sidebar-2';
	$sidebar_type = 'shop';
}
?>

<?php get_header(); ?>

<div class="content-wrapper">

	<?php if ( $pm_popular_posts == 'top' ) : ?>
		<div class="popular-wrapper">
			<div class="container">
				<?php	echo pm_popular_posts(); ?>
			</div>
		</div>
	<?php endif; ?>

	<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $field_page_sidebar == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">
		<div class="container">

			<div class="row">
				<main id="main" class="site-main">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php if( has_post_thumbnail() ) : ?>
								<div class="post-img">
									<?php the_post_thumbnail( 'pm-full-thumb' ); ?>
								</div>
							<?php endif; ?>

							<div class="post-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</div>

							<div class="post-entry">
								<?php
								the_content( esc_html__( 'Read more', 'purism' ));
								$defaults = array(
									'before'           => '<p class="post-nav">' . esc_html__( 'Pages:', 'purism'),
									'after'            => '</p>',
								);
								wp_link_pages($defaults);
								?>
							</div>

							<?php if( $page_content_shares && !pm_is_shop() ) : ?>
								<div class="post-meta meta-bottom">
									<div class="box-full">
										<?php pm_share_buttons(); ?>
									</div>
								</div>
							<?php endif; ?>

						</article>

						<?php
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php	endwhile; ?>

				</main>

				<?php if ( is_active_sidebar( $sidebar ) && $field_page_sidebar !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
				<?php endif; ?>

			</div>

		</div>
	</div>

	<?php if ( $pm_popular_posts == 'bottom' ) : ?>
		<div class="popular-wrapper">
			<div class="container">
				<?php	echo pm_popular_posts(); ?>
			</div>
		</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>
