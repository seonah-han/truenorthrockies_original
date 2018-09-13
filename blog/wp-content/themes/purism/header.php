<?php
$default_logo 				= get_template_directory_uri() . '/dist/images/logo-purism.gif';
$default_logo_header	= get_template_directory_uri() . '/dist/images/logo-purism-header.gif';
$header_logo 					= get_theme_mod( 'pm_header_logo', $default_logo_header );
$header_navbar_logo 	= get_theme_mod( 'pm_navbar_logo', $default_logo );
$header_logo_slogan 	= get_theme_mod( 'pm_header_logo_slogan', get_bloginfo( 'description' ) );
$menu_cart						= get_theme_mod( 'pm_header_cart', true );
$menu_social 					= get_theme_mod( 'pm_header_social', false );
$menu_search 					= get_theme_mod( 'pm_header_search', true );
$sticky_navbar_logo		= get_theme_mod( 'pm_sticky_navbar_logo', 'sticky' );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php if ( has_nav_menu( 'primary' ) && $menu_search ) : ?>
		<div class="nav-search"><?php get_search_form(); ?><span class="close-search-overlay"><i></i></span></div>
	<?php endif; ?>

	<?php if( $menu_social ) : ?>
		<div class="nav-features">
			<?php pm_social_links(); ?>
		</div>
	<?php endif; ?>

	<header class="site-header">

		<?php if ( has_nav_menu( 'primary' ) || ( $header_navbar_logo !== '' && $sticky_navbar_logo !== 'no' ) ) : ?>
			<div class="primary-nav-wrapper">
				<nav class="primary-nav">
					<div class="container">
						<div class="navbar-wrapper">

							<?php if( $header_navbar_logo !== '' && $sticky_navbar_logo !== 'no' ) : ?>
								<div class="navbar-header">
									<a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo esc_url( $header_navbar_logo ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a>
								</div>
							<?php endif; ?>

							<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<div class="nav-menu">
									<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary', 'menu_class' => 'primary-menu' ) ); ?>
								</div>
							<?php endif; ?>

							<div class="nav-menu-mobile"></div>

						</div>
					</div>
				</nav>
			</div>
		<?php endif; ?>

		<?php if( $header_logo !== '' || $header_logo_slogan !== '' ) : ?>
			<div class="header-title-wrapper">
				<div class="container">
					<div class="header-title">
						<div>
							<div>

								<?php if( $header_logo !== '' ) : ?>
									<h2><a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a></h2>
								<?php endif; ?>

								<?php if( $header_logo_slogan ) : ?>
									<p><?php echo esc_html( $header_logo_slogan ); ?></p>
								<?php endif; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</header>
