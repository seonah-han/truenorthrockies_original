<?php
$instagram_username = get_theme_mod( 'pm_instagram_username', '' );
$instagram_footer 	= get_theme_mod( 'pm_instagram_footer', false );
$instagram_number		= get_theme_mod( 'pm_instagram_number', 6 );
$instagram_title 		= get_theme_mod( 'pm_instagram_title', esc_html__( 'Follow @instagram', 'purism' ) );
$footer_logo_url 		= get_theme_mod( 'pm_footer_logo_url', get_template_directory_uri() . '/dist/images/logo-purism-footer.png' );
$default_copyright 	= wp_kses( sprintf( __( '&copy; %s - All rights reserved. Designed by <a href="%s">%s</a>.', 'purism' ), date('Y'),  home_url('/'),  get_bloginfo() ), array(
												'a' => array(
													'href' => array(),
													'title' => array(),
													'target' => array(),
												),
												'br' => array(),
											));
$footer_copyright 	= get_theme_mod( 'pm_footer_copyright', $default_copyright);
$footer_features 		= get_theme_mod( 'pm_footer_order' , array( 'instagram', 'info' ));
$scroll_top 				= get_theme_mod( 'pm_effects_scroll_top', true );
?>

<footer id="footer" class="footer">

	<?php if ( $footer_features && is_array( $footer_features ) ) : ?>

		<?php foreach( $footer_features as $footer_feature ) : ?>

			<?php if( $footer_feature == 'instagram' && $instagram_footer && $instagram_username !== '' && function_exists( 'wpiw_widget' ) ) : ?>
				<div class="footer-instagram instagram">

					<?php $args = array(
						'title' => '',
						'username' => $instagram_username,
						'size' => 'small',
						'number' => absint( $instagram_number ),
						'target' => '_blank',
						'link' => $instagram_title,
					); ?>

					<?php if ( function_exists( 'wpiw_widget' ) ) : ?>
						<?php the_widget( 'null_instagram_widget', $args ); ?>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<?php if ( $footer_feature == 'info' && ( $footer_logo_url !== '' || $footer_copyright !== '' || has_nav_menu( 'footer_menu' ) ) ) : ?>
				<div class="footer-feature footer-info">
					<div class="container">
						<div class="footer-wrapper">

							<div class="footer-left">

								<?php if( $footer_logo_url !== '' ) : ?>
									<a class="footer-logo" href="<?php echo esc_url( home_url('/') ); ?>">
										<img src="<?php echo esc_url( $footer_logo_url ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) );?>">
									</a>
								<?php endif; ?>

								<?php if ( $footer_copyright !== '' ) : ?>
									<p class="footer-copyright">
										<?php $allowed_html =	array(
											'a' => array(
												'href' => array(),
												'title' => array(),
												'target' => array(),
											),
											'br' => array(),
										);
										echo wp_kses( $footer_copyright, $allowed_html ); ?>
									</p>
								<?php endif; ?>

							</div>

							<div class="footer-right">
								<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
									<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'footer_menu', 'menu_class' => 'footer-menu', 'depth' => 1 ) ); ?>
								<?php endif; ?>
							</div>

						</div>
					</div>
				</div>

			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</footer>

<?php if( $scroll_top ) : ?>
	<button class="scroll-top btn btn-color">
		<i class="fa fa-angle-up"></i>
	</button>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
