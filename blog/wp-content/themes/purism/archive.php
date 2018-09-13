<?php
$layout_archive 					= get_theme_mod( 'pm_layout_archive', 'standard' );
$layout_standard_archive 	= get_theme_mod( 'pm_layout_standard_archive', true );
$sidebar_archive 					= get_theme_mod( 'pm_sidebar_archive', 'sidebar' );

$sidebar = 'sidebar-1';
$sidebar_type = '';

if( $sidebar_archive == 'sidebar-shop' ) {
	$sidebar = 'sidebar-2';
	$sidebar_type = 'shop';
}
?>

<?php get_header(); ?>

<div class="container">
	<div class="page-header">
		<div class="page-header-wrapper">
			<?php pm_page_title(); ?>
		</div>
	</div>
</div>

<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $sidebar_archive == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">
	<div class="container">
		<div class="row">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php $current = $wp_query->current_post + 1; ?>

						<?php if( $layout_archive == 'standard') : ?>

							<div class="post-standard">
								<?php get_template_part('content'); ?>
							</div>

						<?php else : ?>

							<?php if ( $current == 1 ) : ?>

								<?php if ( $layout_standard_archive && !is_paged() ) : ?>
									<div class="post-standard">
										<?php get_template_part('content'); ?>
									</div>
								<?php endif; ?>

								<div class="<?php echo esc_attr( $layout_archive ); ?>">

								<?php if ( ! $layout_standard_archive || is_paged() ) : ?>
									<div class="post-<?php echo esc_attr( $layout_archive ); ?>">
										<?php get_template_part( 'content', $layout_archive ); ?>
									</div>
								<?php endif; ?>

							<?php else : ?>

								<div class="post-<?php echo esc_attr( $layout_archive ); ?>">
									<?php get_template_part( 'content', $layout_archive ); ?>
								</div>

							<?php endif; ?>

							<?php if ( $current == ( $wp_query->post_count ) ) : ?></div>
							<?php endif; ?>

						<?php endif; ?>

					<?php endwhile; ?>

					<?php pm_posts_pagination(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</main>

			<?php if ( is_active_sidebar( $sidebar ) && $sidebar_archive !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
			<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer(); ?>
