<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<div class="no-content">
		<h2><?php esc_html_e( 'Nothing found', 'purism' ); ?></h2>
		<p>
			<?php esc_html_e( 'Ready to publish your first post?', 'purism' ); ?>
			<a href="<?php esc_url( admin_url( 'post-new.php' ) ); ?>"><?php esc_html_e( 'Get started here', 'purism' ); ?></a>
		</p>
	</div>

<?php elseif ( is_home() && !current_user_can( 'publish_posts' ) ) : ?>

	<div class="no-content">
		<h2><?php esc_html_e( 'Nothing found', 'purism' ); ?></h2>
		<p>
			<?php esc_html_e( 'Sorry, no posts were found.', 'purism' ); ?>
		</p>
	</div>

<?php elseif ( is_search() ) : ?>

	<div class="no-content">
		<h2><?php esc_html_e( 'Nothing found', 'purism' ); ?></h2>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'purism'); ?></p>
		<?php get_search_form(); ?>
	</div>

<?php	else : ?>

	<div class="no-content">
		<p><?php esc_html_e( 'The page you are looking for has not been found.', 'purism' ); ?></p>
		<?php get_search_form(); ?>
	</div>

<?php endif; ?>
