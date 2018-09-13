<?php
$layout_blog 					= get_theme_mod('pm_layout_blog', 'standard' );
$layout_standard_blog = get_theme_mod( 'pm_layout_standard_blog', true );
$sidebar_blog 				= get_theme_mod( 'pm_sidebar_blog', 'sidebar' );

$sidebar = 'sidebar-1';
$sidebar_type = '';

if( $sidebar_blog == 'sidebar-shop' ) {
	$sidebar = 'sidebar-2';
	$sidebar_type = 'shop';
}
?>

<?php get_header(); ?>

<div class="page-header">
	<div class="container">
		<?php pm_page_title(); ?>
	</div>
</div>

<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $sidebar_blog == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">
	<div class="container">
		<div class="row">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="list">
							<div class="post-list">
								<?php get_template_part( 'content', 'list' ); ?>
							</div>
						</div>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>

				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

			</main>

			<?php if ( is_active_sidebar( $sidebar ) && $sidebar_blog !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
			<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer(); ?>
