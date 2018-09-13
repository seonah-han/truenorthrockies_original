<?php
$field_post_sidebar = get_post_meta( $post->ID, 'pm_field_post_sidebar' , true );
$related_posts 			= get_theme_mod( 'pm_related_posts', true );

$sidebar = 'sidebar-1';
$sidebar_type = '';

if( $field_post_sidebar == 'sidebar-shop' ) {
	$sidebar = 'sidebar-2';
	$sidebar_type = 'shop';
}
?>

<?php get_header(); ?>
<div class="content-wrapper">
	<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $field_post_sidebar == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">
		<div class="container">
			<div class="row">

				<main id="main" class="site-main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php pm_set_views(get_the_ID()); ?>

						<div class="post-standard">
							<?php get_template_part('content'); ?>
						</div>

						<?php if( $related_posts ) : ?>
							<?php pm_related_posts(); ?>
						<?php endif; ?>

						<?php if ( comments_open() || get_comments_number() ) : ?>
							<?php comments_template(); ?>
						<?php endif; ?>

					<?php endwhile; ?>

				</main>

				<?php if ( is_active_sidebar( $sidebar ) && $field_post_sidebar !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
