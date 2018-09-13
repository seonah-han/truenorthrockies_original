<?php

/**
* WPML Language Object ID
*/

function pm_language_object_id( $id, $post_type ) {
	if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
		global $sitepress;
		$sitepress->switch_lang(ICL_LANGUAGE_CODE, false);
		$result = icl_object_id( $id, $post_type, false, ICL_LANGUAGE_CODE );
	} else {
		$result = $id;
	}
	return $result;
}

/**
* Read more link
*/

if ( ! function_exists( 'pm_read_more' ) ) {
	function pm_read_more( $text = '' ) {
		$url = get_permalink();
		if ( $text == '' ) {
			$text = esc_html__( 'Read more', 'purism' );
		}

		echo '<a href="' . esc_url( $url ) . '" class="more-link btn btn-color">'. $text . '</a>';
	}
}

/**
* Page titles
*/

if ( ! function_exists( 'pm_page_title' ) ) {
	function pm_page_title() {

		if ( is_archive() ) {

			if ( is_category() ) {

				$subtitle = esc_html__( 'Posts by category', 'purism' );
				$title = single_cat_title( '', false );
				$description = get_the_archive_description();

			} elseif ( is_tag() ) {

				$subtitle = esc_html__( 'Posts by tag', 'purism' );
				$title = single_tag_title( '', false );
				$description = get_the_archive_description();

			} elseif ( is_author() ) {

				$subtitle = esc_html__( 'Posts by author', 'purism' );
				$title = get_the_author( '', false );
				$description = '<p>' . get_the_archive_description() . '</p>';
				$social = pm_author_social();

			} elseif ( is_year() ) {

				$subtitle = esc_html__( 'Posts by year', 'purism' );
				$title = get_the_date( 'Y' );

			} elseif ( is_month() ) {

				$subtitle = esc_html__( 'Posts by month', 'purism' );
				$title = get_the_date( 'F Y' );

			} elseif ( is_day() ) {

				$subtitle = esc_html__( 'Posts by day','purism' );
				$title = get_the_time( get_option( 'date_format' ) );

			} else {
				$title = get_the_archive_title();
			}

		} elseif ( is_search() ) {

			$subtitle = esc_html__( 'Search Results for', 'purism' );
			$title = get_search_query();

		} elseif ( is_404() ) {

			$subtitle = '404';
			$title = esc_html__( 'Ooops, Page not found.', 'purism' );

		} elseif ( is_page() ) {
			$title = get_the_title();
		}

		if ( isset( $title ) ) {
			if ( isset( $subtitle ) ) {
				echo '<p class="sub-title">' . esc_html( $subtitle ) . '</p>';
			}

			echo '<h1>' . esc_html( $title ) . '</h1>';
			if( isset ( $description ) ) {
				echo $description;
			}

			if ( isset( $social ) ) {
				echo '<p class="social-links">' . $social . '</p>';
			}
		}
	}
}

/**
* Post Categories
*/

if ( ! function_exists( 'pm_post_cat' ) ) {
	function pm_post_cat( $sep ) {
		$first_cat = 1;
		$cat = '';
		foreach( ( get_the_category() ) as $category ) {
			if ( $first_cat == 1 ) {
				$cat = $cat . '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_attr__( 'Posts by category %s', 'purism' ), $category->name ) . '" ' . '>'  . esc_html( $category->name ) . '</a>';
				$first_cat = 0;
			} else {
				$cat = $cat . '<span class="separator">' . esc_html( $sep ) . '</span>' . '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_attr__( 'Posts by category %s', 'purism' ), $category->name ) . '" ' . '>' . esc_html( $category->name ) . '</a>';
			}
		}
		if( !empty ( $cat ) ) {
			echo '<p class="post-category">' . $cat . '</p>';
		}
	}
}

/**
* Post Date
*/

if ( ! function_exists( 'pm_post_date' ) ) {
	function pm_post_date() {
		?>
		<span class="meta-info"><?php esc_html_e('Posted on', 'purism'); ?> </span><span class="date"><a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) );  ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
		<?php
	}
}

/**
* Post Author
*/

if ( ! function_exists( 'pm_post_author' ) ) {
	function pm_post_author() {
		?>
		<span class="meta-info"> <?php esc_html_e( 'by', 'purism' ); ?> </span><span class="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
		<?php
	}
}

/**
* Posts Pagination
*/
if ( ! function_exists( 'pm_posts_pagination' ) ) {
	function pm_posts_pagination() {
		$allowed_html =	array(
			'i' => array(
				'class' => array(),
			),
		);

		the_posts_navigation( array(
			'prev_text' => wp_kses( __( 'Older Posts <i class="fa fa-angle-double-right"></i>', 'purism'),  $allowed_html ),
			'next_text' => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Newer Posts', 'purism'),  $allowed_html ),
			)
		);
	}
}

/**
* Post Comments, Likes, Views
*/

// Get Comments
if ( ! function_exists( 'pm_post_comments' ) ) {
	function pm_post_comments() {
		if ( comments_open() ) :
			echo '<div class="post-comments">';
			comments_popup_link( '0 Comments', '1 Comment', '% Comments', '', '');
			echo '</div>';
		endif;
	}
}

// Get Likes
if ( ! function_exists( 'pm_get_likes' ) ) {
	function pm_get_likes( $post_id ) {
		$output = '';
		$post_id_class = 'pm-like-' . $post_id;
		$like_count = get_post_meta( $post_id, "_post_like_count", true );
		$like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
		$output = '<span class="' . esc_attr( $post_id_class ) . '" >' . esc_html( $like_count ) . '</span>';
		return pm_format_count( $output );
	}
}

if ( ! function_exists( 'pm_post_likes' ) ) {
	function pm_post_likes() {
		$post_id = get_the_ID();
		$output = '';
		$post_id_class = 'pm-like-' . $post_id;
		$like_count = get_post_meta( $post_id, "_post_like_count", true );
		$like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
		$output = ( $like_count == 1 ) ? '<span class="' . esc_attr( $post_id_class ) . '" >' . esc_html( $like_count ) . ' ' . esc_html__( 'Like', 'purism' ) . '</span>' : '<span class="' . esc_attr( $post_id_class ) . '" >' . esc_html( $like_count ) . ' ' .  esc_html__( 'Likes', 'purism' ) . '</span>';
		echo '<div class="post-likes">';
		echo $output;
		echo '</div>';
	}
}

// Get Views
if ( ! function_exists( 'pm_get_views' ) ) {
	function pm_get_views( $postID ){
		$post_id_class = 'pm-view-' . $postID;
		$count_key = 'post_views_count';
		$count = get_post_meta( $postID, $count_key, true );
		$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
		$output = $count;
		return pm_format_count( $output );
	}
}

if ( ! function_exists( 'pm_post_views' ) ) {
	function pm_post_views() {
		$count = pm_get_views( get_the_ID() );

		echo '<div class="post-views">';
		printf( _n( '%s View', '%s Views', $count, 'purism' ), number_format_i18n( $count ) );
		echo '</div>';
	}
}

// Set Views
if ( ! function_exists( 'pm_set_views' ) ) {
	function pm_set_views( $postID ) {
		$count_key = 'post_views_count';
		$count = get_post_meta( $postID, $count_key, true );
		if( $count == '' ) {
			$count = 0;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
		} else {
			$count++;
			update_post_meta( $postID, $count_key, $count );
		}
	}
}

/**
* Social Buttons
*/

if ( ! function_exists( 'pm_social_links' ) ) {
	function pm_social_links() { ?>
		<div class="social-links">
			<?php if( get_theme_mod( 'pm_social_facebook' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_facebook') ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_google' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_google' ) ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_twitter' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_twitter' ) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_instagram' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_instagram' ) ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_behance' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_behance' ) ); ?>" target="_blank"><i class="fa fa-behance"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_pinterest' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_pinterest' ) ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod('pm_social_tumblr')) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_tumblr' ) ); ?>.tumblr.com/" target="_blank"><i class="fa fa-tumblr"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod('pm_social_bloglovin')) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_bloglovin' ) ); ?>" target="_blank"><i class="fa fa-heart"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod('pm_social_flickr')) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_flickr' ) ); ?>" target="_blank"><i class="fa fa-flickr"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod('pm_social_xing')) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_xing' ) ); ?>" target="_blank"><i class="fa fa-xing"></i></a>
			<?php endif; ?>
			<?php if(get_theme_mod( 'pm_social_github' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_github' ) ); ?>" target="_blank"><i class="fa fa-github"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_youtube' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_youtube' ) ); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_vimeo' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_vimeo' ) ); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_dribbble' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_dribbble' ) ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_soundcloud' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_soundcloud' ) ); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_linkedin' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_linkedin' ) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			<?php endif; ?>
			<?php if( get_theme_mod( 'pm_social_rss' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'pm_social_rss' ) ); ?>" target="_blank"><i class="fa fa-rss"></i></a>
			<?php endif; ?>
		</div>
		<?php
	}
}

/**
* Share Buttons
*/

if ( ! function_exists( 'pm_share_buttons' ) ) {
	function pm_share_buttons() {

		$url = rawurlencode( get_permalink() );
		$title = rawurlencode( get_the_title() );
		$thumbnail = rawurlencode( get_the_post_thumbnail_url() );
		?>

		<div class="post-share">
			<span class="title-share"><?php esc_html_e( 'Share:' , 'purism' );?></span>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( 'http://www.facebook.com/sharer.php?u=' . $url ); ?>"><i class="fa fa-facebook"></i></a>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( 'https://twitter.com/share?text=' . $title . '&amp;url=' . $url ); ?>"><i class="fa fa-twitter"></i></a>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( 'https://plus.google.com/share?url=' . $url ); ?>"><i class="fa fa-google-plus"></i></a>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( 'https://pinterest.com/pin/create/bookmarklet/?media=' . $thumbnail . '&amp;description=' . $title . '&amp;url=' . $url );?>"><i class="fa fa-pinterest"></i></a>
		</div>

		<?php
	}
}

/**
* Author Meta
*/

if ( ! function_exists( 'pm_author_profile' ) ) {
	function pm_author_profile() { ?>
		<div class="post-author-profile">
			<div class="post-author-img">
				<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
			</div>
			<div class="post-author-content">
				<span class="author"><?php the_author_posts_link(); ?></span>
				<p><?php echo get_the_author_meta('description'); ?></p>
				<?php if ( pm_author_social() ) : ?>
					<p class="social-links"><?php echo pm_author_social(); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

/**
* Author Meta Social
*/

if ( ! function_exists( 'pm_author_social' ) ) {
	function pm_author_social() {
		$author_social = null;
		if( get_the_author_meta( 'url' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'url' ) ) . '" target="_blank"><i class="fa fa-globe"></i></a>';
		endif;
		if( get_the_author_meta( 'facebook' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'facebook' ) ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
		endif;
		if( get_the_author_meta( 'google' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'google' ) ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
		endif;
		if( get_the_author_meta( 'twitter' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'twitter' ) ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
		endif;
		if( get_the_author_meta( 'instagram' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'instagram' ) ) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
		endif;
		if(get_the_author_meta( 'behance' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'behance' ) ) . '" target="_blank"><i class="fa fa-behance"></i></a>';
		endif;
		if( get_the_author_meta( 'pinterest' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'pinterest' ) ) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
		endif;
		if( get_the_author_meta( 'tumblr' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'tumblr' ) ) . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
		endif;
		if( get_the_author_meta( 'bloglovin' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'bloglovin' ) ) . '" target="_blank"><i class="fa fa-heart"></i></a>';
		endif;
		if( get_the_author_meta( 'flickr' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'flickr' ) ) . '" target="_blank"><i class="fa fa-flickr"></i></a>';
		endif;
		if( get_the_author_meta( 'xing' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'xing' ) ) . '" target="_blank"><i class="fa fa-xing"></i></a>';
		endif;
		if( get_the_author_meta( 'github' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'github' ) ) . '" target="_blank"><i class="fa fa-github"></i></a>';
		endif;
		if( get_the_author_meta( 'youtube' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'youtube' ) ) . '" target="_blank"><i class="fa fa-youtube-play"></i></a>';
		endif;
		if( get_the_author_meta( 'vimeo' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'vimeo' ) ) . '" target="_blank"><i class="fa fa-vimeo-square"></i></a>';
		endif;
		if( get_the_author_meta( 'dribbble' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'dribbble' ) ) . '" target="_blank"><i class="fa fa-dribbble"></i></a>';
		endif;
		if( get_the_author_meta( 'soundcloud' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'soundcloud' ) ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a>';
		endif;
		if( get_the_author_meta( 'linkedin' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'linkedin' ) ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
		endif;
		if( get_the_author_meta( 'rss' ) ) :
			$author_social .= '<a href="' . esc_url( get_the_author_meta( 'rss' ) ) . '" target="_blank"><i class="fa fa-rss"></i></a>';
		endif;

		return $author_social;
	}
}

/**
* Custom Comment List
*/

if ( ! function_exists( 'pm_comments' ) ) {
	function pm_comments( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="thecomment">

				<div class="author-img">
					<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>

				<div class="comment-text">

					<span class="author"><?php echo get_comment_author_link(); ?></span>
					<span class="date"><?php printf( esc_html__( '%1$s at %2$s', 'purism' ), get_comment_date(),  get_comment_time() ); ?></span>

					<?php if( $comment->comment_approved == '0' ) : ?>
						<p class="comment-info"><span class="fa fa-info-circle"></span> <?php esc_html_e( 'Comment awaiting approval', 'purism' ); ?></p>
					<?php endif; ?>
					<?php comment_text(); ?>

					<?php if( comments_open() || is_user_logged_in() ) : ?>
						<span class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'purism' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), $comment->comment_ID ); ?>
							<?php edit_comment_link( esc_html__( 'Edit', 'purism' ) ); ?>
						</span>
					<?php endif; ?>
				</div>

			</div>

		<?php
	}
}

/**
* Featured Post Slider
*/

if ( ! function_exists( 'pm_featured_slider' ) ) {
	function pm_featured_slider() {

		$post_category 	= get_theme_mod( 'pm_post_category' , true );
		$post_date 			= get_theme_mod( 'pm_post_date' , true );

		// Get Settings
		$layout_slider 		= get_theme_mod( 'pm_layout_slider' , 'single' );
		$slider_number 		= get_theme_mod( 'pm_slider_number', 3 );
		$slider_video 		= get_theme_mod( 'pm_slider_video' , true );
		$slider_autoplay 	= get_theme_mod( 'pm_slider_autoplay' , true );
		$slider_fade 			= get_theme_mod( 'pm_slider_fade' , true );
		$slider_excerpt 	= get_theme_mod( 'pm_slider_excerpt' , true );
		$key 							= 'pm_field_post_feat_blog';

		$args = array(
			'posts_per_page' => $slider_number,
			'ignore_sticky_posts' => true,
			'meta_query'  => array(
				array(
					'key'     => $key,
					'value'   => '1',
					'compare' => 'LIKE',
				),
			),
		);

		$feat_query  = new WP_Query( $args );
		$feat_count;
		$feat_count = $feat_query->post_count;

		// Slider Settings
		$slider_autoplay = $slider_autoplay ? 'true' : 'false';
		$autoplay = 'data-autoplay="' . esc_attr( $slider_autoplay ) . '"';
		$slider_fade = $slider_fade ? 'true' : 'false';
		$fade = 'data-fade="' . esc_attr( $slider_fade ) . '"';
		$settings = ' ' . $autoplay . ' ' . $fade;

		// Slider Layout
		if ( $layout_slider == 'multiple' ) {
			$slider_type = ' mode-multiple';
			$class = 'container-fluid';
		} else {
			$slider_type = ' mode-single';
			$class = 'container-fluid';
		}

		// Query
		$args = array(
			'posts_per_page' => $slider_number,
			'ignore_sticky_posts' => true,
			'meta_query'  => array(
				array(
					'key'     => $key,
					'value'   => '1',
					'compare' => 'LIKE',
				),
			),
		);

		$feat_query  = new WP_Query( $args );
		$feat_count = $feat_query->post_count;
		?>

		<?php if( $feat_count > 0 ): ?>

			<?php
			if( $feat_count > 1 ) {
				$feat_type = 'featured-slider ' . $slider_type;
			} else {
				$feat_type = 'featured';
			}
			?>

			<div class="<?php echo esc_attr( $class ); ?>">
				<div class="featured-content">
					<div class="<?php echo esc_attr( $feat_type ); ?>"<?php echo $settings; ?>>

						<?php if ( $feat_query->have_posts() ) : ?>
							<?php while ( $feat_query->have_posts() ) : $feat_query->the_post(); ?>

								<?php
								if ( $layout_slider == 'boxed' ) {
									$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), 'pm-full-thumb' );
								} else {
									$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), 'pm-fullwidth-thumb' );
								}

								$jarallax = 'jarallax ';
								$background = '';
								$format = get_post_format();
								if ( in_array( $format, array('video') ) && $slider_video && !wp_is_mobile() && $layout_slider !== 'multiple' ) {
									$video_url = get_post_meta( get_the_ID(), '_format_video_embed', true );
									if ( $video_url !== '' ) {
										$jarallax = 'slide-embed-video ';
										$background = ' data-video="' . esc_url( $video_url ) . '"';
									}
								}
								?>

								<div <?php post_class( $jarallax . 'featured-post' ); ?>
									<?php if( $thumbnail[0] != '') {
										echo 'style="background-image:url(' . $thumbnail[0] . ')"';
									}
									echo $background; ?>>

									<div class="overlay">
										<div class="overlay-inner">

											<?php if( $post_category ) : ?>
												<?php pm_post_cat( '|' ); ?>
											<?php endif; ?>

											<h2><?php the_title(); ?></h2>

										</div>
									</div>

									<a href="<?php the_permalink(); ?>" class="featured-link"></a>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>

						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php
	}
}

/**
* Promo Count
*/

if ( ! function_exists( 'pm_featured_promo' ) ) {
	function pm_featured_promo() {

		$count = 0;

		for ( $i=1; $i <= 3; $i++ ) :

			$promo_link = get_theme_mod( 'pm_promo_link_' . $i, 'page' );

			if( $promo_link == 'page' ) {
				$promo_href = get_theme_mod( 'pm_promo_page_' . $i, '' );
				if( $promo_href != '') {
					$promo_image = wp_get_attachment_image_src( get_post_thumbnail_ID( $promo_href ), 'pm-large-thumb' );
					$promo_image = $promo_image[0];
					$promo_title = get_the_title( $promo_href );
				} else {
					$promo_image = '';
					$promo_title = '';
				}
			} else {
				$promo_image = get_theme_mod( 'pm_promo_image_' . $i, '' );
				$promo_title = get_theme_mod( 'pm_promo_title_' . $i, '' );
			}

			if( $promo_title != '' || $promo_image  != '' ) :
				$count = $count + 1;
			endif;

		endfor;

		$featured_slider = get_theme_mod( 'pm_featured_slider' , true );
		$promo	= get_theme_mod( 'pm_promo', false );
		$layout = get_theme_mod( 'pm_layout_promo_featured' , 'fullwidth' );

		if( $layout == 'fullwidth') :
			$container_class = 'container-fluid';
		else:
			$container_class = 'container';
		endif;

		$args = array(
			'ignore_sticky_posts' => true,
			'meta_query'  => array(
				array(
					'key'     => 'pm_field_post_feat_blog',
					'value'   => '1',
					'compare' => 'LIKE',
				),
			),
		);

		$feat_query  = new WP_Query( $args );
		$feat_count = $feat_query->post_count;

		if( ( $featured_slider && $feat_count != 0 )  && ( $promo && $count != 0 ) ) {
			?>
			<div class="<?php echo esc_attr( $container_class ); ?> featured-promo featured-promo-area promo-items-<?php echo $count; ?>">
				<div class="featured-wrapper">
					<?php	echo pm_featured_slider(); ?>
				</div>
				<div class="promo-wrapper">
					<?php	echo pm_promo_posts(); ?>
				</div>
			</div>
			<?php
		} elseif ( ( $featured_slider && $feat_count != 0 ) && ( !$promo || $count == 0 ) ) { ?>
			<div class="<?php echo esc_attr( $container_class ); ?> featured-promo featured-area">
				<div class="featured-wrapper">
					<?php	echo pm_featured_slider(); ?>
				</div>
			</div>
			<?php
		} elseif ( (!$featured_slider || $feat_count == 0 ) && ( $promo && $count != 0 )  ) { ?>
			<div class="<?php echo esc_attr( $container_class ); ?> featured-promo promo-area promo-items-<?php echo $count; ?>">
				<div class="promo-wrapper">
					<?php	echo pm_promo_posts(); ?>
				</div>
			</div>
			<?php
		}
	}
}

/**
* Promo Posts
*/

if ( ! function_exists( 'pm_promo_posts' ) ) {
	function pm_promo_posts() {
		?>
		<div class="promo">

			<?php	$count = 1; ?>
			<?php for ( $i=1; $i <= 3; $i++ ) : ?>

				<?php
				$promo_link = get_theme_mod( 'pm_promo_link_' . $i, 'page' );
				$promo_target = get_theme_mod( 'pm_promo_target_' . $i, false );

				if( $promo_link == 'page' ) {
					$promo_href = get_theme_mod( 'pm_promo_page_' . $i, '' );
					$promo_href_link = get_permalink( $promo_href );
					if( $promo_href != '') {
						$promo_image = wp_get_attachment_image_src( get_post_thumbnail_ID( $promo_href ), 'pm-fullwidth-thumb' );
						$promo_image = $promo_image[0];
						$promo_title = get_the_title( $promo_href );
					} else {
						$promo_image = '';
						$promo_title = '';
					}
				} else {
					$promo_href = get_theme_mod( 'pm_promo_url_' . $i, '' );
					$promo_href_link = $promo_href;
					$promo_image = get_theme_mod( 'pm_promo_image_' . $i, '' );
					$promo_title = get_theme_mod( 'pm_promo_title_' . $i, '' );
				}
				?>

				<?php if( $promo_title != '' || $promo_image  != '' ) : ?>
					<div class="promo-grid">
						<div class="promo-item" <?php if( $promo_image != '' ) : echo 'style="background-image:url(' . $promo_image . ')"'; endif; ?>>

							<?php if( $promo_href_link != ''  ) :
								$target = '';
								if( $promo_target ) :
									$target = ' target="_blank"';
								endif;
								echo '<a class="promo-link" href="' . esc_url( $promo_href_link ) . '"'. $target . ' ></a>';
							endif; ?>

							<?php if( $promo_title != '' ) : ?>
								<div class="overlay">
									<div class="overlay-inner">
										<h2><?php echo esc_html( $promo_title ); ?></h2>
									</div>
								</div>
							<?php endif ?>

						</div>
					</div>

				<?php endif; ?>
			<?php endfor; ?>
		</div>

		<?php
	}
}

/**
* Popular Posts
*/

if ( ! function_exists( 'pm_popular_posts_settings' ) ) {
	function pm_popular_posts_settings( $title = '', $number = null , $filter = '' ) {

		$post_date = get_theme_mod( 'pm_post_date' , true );

		$args = array(
			'posts_per_page' 			=> $number,
			'meta_key' 						=> $filter,
			'orderby' 						=> 'meta_value_num',
			'order' 							=> 'DESC',
			'ignore_sticky_posts' => true
		);

		$popular = new WP_Query( $args );
		?>

		<?php if ( $popular->have_posts()) : ?>
			<div class="popular-posts">

				<?php if ( $title != '' ) : ?>
					<div class="feature-title" ><h2><span><?php echo esc_html( $title ); ?></span></h2></div>
				<?php endif; ?>

				<div class="popular">

					<?php while ( $popular->have_posts() ) : $popular->the_post(); ?>
						<div class="popular-grid">
							<article <?php post_class(); ?>>

								<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-img">
										<a href="<?php the_permalink();?>"><?php the_post_thumbnail('pm-large-thumb'); ?></a>
									</div>
								<?php endif; ?>

								<div class="post-header">
									<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
									<?php if( $post_date ) : ?>
										<p class="posted-info">
											<?php pm_post_date(); ?>
										</p>
									<?php endif; ?>
								</div>

							</article>
						</div>
					<?php endwhile; ?>

				</div>
			</div>
			<?php wp_reset_postdata(); ?>

		<?php endif ?>
		<?php
	}
}

if ( ! function_exists( 'pm_popular_posts' ) ) {
	function pm_popular_posts( ) {

		if ( is_page() ) {
			$id = get_the_ID();
			$popular_posts_title 	= get_post_meta( $id, 'pm_field_popular_title', true );
			$popular_posts_number = get_post_meta( $id, 'pm_field_popular_number', true );
			$popular_posts_filter = get_post_meta( $id, 'pm_field_popular_filter', true );
		} else {
			$popular_posts_number = get_theme_mod( 'pm_popular_number', 3 );
			$popular_posts_title 	= get_theme_mod( 'pm_popular_title', esc_html__( 'Popular Posts' , 'purism') );
			$popular_posts_filter = get_theme_mod( 'pm_popular_filter', 'post_views_count' );
		}

		pm_popular_posts_settings( $popular_posts_title, $popular_posts_number , $popular_posts_filter );
	}
}

/**
* Related Posts
*/

if ( ! function_exists( 'pm_related_posts' ) ) {
	function pm_related_posts() {
		$post_id 							= get_the_ID();
		$post_date 						= get_theme_mod( 'pm_post_date' , true );
		$related_posts_number = get_theme_mod( 'pm_related_posts_number', 3 );
		$related_posts_order 	= get_theme_mod( 'pm_related_posts_order', 'rand' );
		$related_posts_number = get_theme_mod( 'pm_related_posts_number', 3 );
		$related_posts_title 	= get_theme_mod( 'pm_related_title', esc_html__( 'You May also Like' , 'purism') );
		$categories = get_the_category( $post_id );

		if ( $categories ) {

			$category_ids = array();

			foreach( $categories as $category ) $category_ids[] = $category->term_id;

			$args = array(
				'category__in'    => $category_ids,
				'post__not_in'    => array( $post_id ),
				'posts_per_page'  => $related_posts_number,
				'orderby' 				=> $related_posts_order,
			);

			$related = new WP_Query( $args );
			$related_count = $related->post_count;

			if( $related_count > 3 ) {
				$related_type = 'related-slider';
			} else {
				$related_type = 'related';
			}
			?>

			<?php if ( $related->have_posts()) : ?>

				<div class="related-posts">

					<?php if ( $related_posts_title != '' ) : ?>
						<div class="feature-title" ><h2><span><?php echo esc_html( $related_posts_title ); ?></span></h2></div>
					<?php endif; ?>

					<div class="<?php echo esc_attr( $related_type ) ?>">
						<?php while ( $related->have_posts() ) : $related->the_post(); ?>

							<div class="related-grid">
								<article <?php post_class(); ?>>

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="post-img">
											<a href="<?php the_permalink();?>"><?php the_post_thumbnail('pm-large-thumb'); ?></a>
										</div>
									<?php endif; ?>

									<div class="post-header">
										<h5><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
										<?php if( $post_date ) : ?>
											<p class="posted-info">
												<?php pm_post_date(); ?>
											</p>
										<?php endif; ?>
									</div>

								</article>
							</div>

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>

			<?php endif; ?>
			<?php
		}
	}
}

/**
* Get locale for Facebook SDK
*/

if ( ! function_exists( 'pm_get_locale' ) ) {
	function pm_get_locale() {

		$locale = get_locale();

		if( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $locale ) ) {
			$locale = str_replace( '-', '_', $locale );
		} elseif ( preg_match( '#^[a-z]{2}$#', $locale ) ) {
			$locale .= '_'. mb_strtoupper( $locale, 'UTF-8' );
		}

		if ( empty( $locale ) ) {
			$locale = 'en_US';
		}
		return $locale;
	}
}
