<?php
$sidebar_shop = get_theme_mod( 'pm_sidebar_shop', 'sidebar-shop' );

$sidebar = 'sidebar-1';
$sidebar_type = '';

if( $sidebar_shop == 'sidebar-shop' ) {
	$sidebar = 'sidebar-2';
	$sidebar_type = 'shop';
}
?>

<?php get_header(); ?>

<?php if( !is_singular() ) : ?>
	<div class="page-header">
		<div class="container">
			<div class="page-header-wrapper">
				<?php pm_shop_title(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="content-wrapper">
	<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $sidebar_shop == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">
		<div class="container">
			<div class="row">

				<main id="main" class="site-main">
					<div>
						<?php pm_shop_content(); ?>
					</div>
				</main>

				<?php if ( is_active_sidebar( $sidebar ) && $sidebar_shop !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
