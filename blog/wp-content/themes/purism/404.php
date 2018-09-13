<?php get_header(); ?>

<div class="container">
	<div class="page-header">
		<div class="page-header-wrapper">
			<?php pm_page_title(); ?>
		</div>
	</div>
</div>

<div id="primary" class="content-area content-fullwidth">
	<div class="container">
		<div class="row">
			<main id="main" class="site-main">
				<div class="error-content">
					<?php get_template_part( 'content', 'none' ); ?>
				</div>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>
