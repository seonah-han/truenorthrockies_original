<?php if( has_post_thumbnail() ) : ?>
	<div class="post-img">
		<?php if( is_single() ) : ?>
			<?php the_post_thumbnail( 'pm-full-thumb' ); ?>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'pm-full-thumb' ); ?></a>
		<?php endif; ?>
	</div>
<?php endif; ?>
