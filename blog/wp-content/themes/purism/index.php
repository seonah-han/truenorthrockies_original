<?php
$layout_blog 					= get_theme_mod( 'pm_layout_blog', 'standard' );
$layout_standard_blog = get_theme_mod( 'pm_layout_standard_blog', true );
$sidebar_blog 				= get_theme_mod( 'pm_sidebar_blog', 'sidebar' );
$promo 								= get_theme_mod( 'pm_promo', false );
$popular_posts 				= get_theme_mod( 'pm_popular_posts' , false );
$featured_slider 			= get_theme_mod( 'pm_featured_slider' , true );
$content_features 		= get_theme_mod( 'pm_blog_order' , array( 'featured_promo', 'newsletter', 'popular', 'posts' ) );
$mailchimp_footer 		= get_theme_mod( 'pm_mailchimp_footer', false );
$mailchimp_title 			= get_theme_mod( 'pm_mailchimp_title', esc_html__( 'Weekly Newsletter', 'purism' ) );
$mailchimp_url  			= get_theme_mod( 'pm_mailchimp_url', '' );

$sidebar = 'sidebar-1';
$sidebar_type = '';

if( $sidebar_blog == 'sidebar-shop' ) {
	$sidebar = 'sidebar-2';
	$sidebar_type = 'shop';
}
?>

<?php get_header(); ?>
<?php  if ( $content_features && is_array( $content_features ) ) : ?>

	<div class="content-wrapper">
		<?php foreach( $content_features as $content_feature ) : ?>

			<?php if( $content_feature == 'featured_promo' && ( $featured_slider || $promo ) ) : ?>
				<?php pm_featured_promo(); ?>
			<?php endif; ?>

			<?php if ( $content_feature == 'newsletter' && $mailchimp_footer ) : ?>
				<div class="subscribe-wrapper">
					<div class="container">
						<div class="pm-subscribe">

							<?php if ( $mailchimp_title !== '' ) : ?>
								<div class="subscribe-info">
									<h3><i class="fa fa-envelope-o"></i><?php echo esc_html( $mailchimp_title ); ?></h3>
								</div>
							<?php endif; ?>

							<?php if ( $mailchimp_url !== '' ) : ?>
								<div class="subscribe-form">
									<form class="mc-form">
										<div class="input-group">
											<input type="email" id="email" class="form-control form-control-light" name="email" placeholder="<?php esc_attr_e( 'Enter your Email here...', 'purism' ); ?>">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-color mc-form-submit"><?php esc_html_e( 'Subscribe', 'purism' ); ?></button>
											</span>
										</div>

										<div class="message-newsletter">
											<label class="message-text" for="email"></label>
										</div>

									</form>
								</div>
							<?php endif; ?>

						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $content_feature == 'popular' && $popular_posts ) : ?>
				<div class="popular-wrapper">
					<div class="container">
						<?php	echo pm_popular_posts(); ?>
					</div>
				</div>
			<?php	endif; ?>

			<?php if ( $content_feature == 'posts' ) : ?>
				<div id="primary" class="content-area<?php if ( ! is_active_sidebar( $sidebar ) || $sidebar_blog == 'nosidebar' ) : ?> content-fullwidth<?php endif; ?>">
					<div class="container">
						<div class="blog-posts">
							<div class="row">
								<main id="main" class="site-main">

									<?php if ( have_posts() ) : ?>
										<?php while ( have_posts() ) : the_post(); ?>

											<?php $current = $wp_query->current_post + 1; ?>

											<?php if( $layout_blog == 'standard') : ?>

												<div class="post-standard">
													<?php get_template_part('content'); ?>
												</div>

											<?php else : ?>

												<?php if ( $current == 1 ) : ?>

													<?php if ( $layout_standard_blog && !is_paged() ) : ?>
														<div class="post-standard">
															<?php get_template_part('content'); ?>
														</div>
													<?php endif; ?>

													<div class="<?php echo esc_attr( $layout_blog ); ?>">

														<?php if ( ! $layout_standard_blog || is_paged() ) : ?>
															<div class="post-<?php echo esc_attr( $layout_blog ); ?>">
																<?php get_template_part( 'content', $layout_blog ); ?>
															</div>
														<?php endif; ?>

													<?php else : ?>

														<div class="post-<?php echo esc_attr( $layout_blog ); ?>">
															<?php get_template_part( 'content', $layout_blog ); ?>
														</div>

													<?php endif; ?>

													<?php if ( $current == ($wp_query->post_count) ) : ?></div>
													<?php endif; ?>

												<?php endif; ?>

											<?php endwhile; ?>

											<?php pm_posts_pagination(); ?>

										<?php else : ?>

											<?php get_template_part( 'content', 'none' ); ?>

										<?php endif; ?>

									</main>

									<?php if ( is_active_sidebar( $sidebar ) && $sidebar_blog !== 'nosidebar' ) : get_sidebar( $sidebar_type ); ?>
									<?php endif; ?>

								</div>
							</div>
						</div>

					</div>
				<?php	endif; ?>

			<?php	endforeach; ?>
		</div>

	<?php	endif; ?>

	<?php get_footer(); ?>
