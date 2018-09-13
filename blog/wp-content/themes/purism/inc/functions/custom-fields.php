<?php

/**
* Assign menus after import
*/

function pm_after_import() {

	// Assign menus to their locations.
	$main_menu 	= get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$footer_menu 	= get_term_by( 'name', 'Footer Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'primary'   	=> $main_menu->term_id,
		'footer_menu' => $footer_menu->term_id,
	));

	$blog_page_id  = get_page_by_title( 'Home' );

	update_option( 'page_on_front', '' );
	update_option( 'page_for_posts', $blog_page_id->ID );
	update_option( 'show_on_front', 'page' );
}

add_action( 'pt-ocdi/after_import', 'pm_after_import' );

/**
* Add custom user contact methods
*/

if ( ! function_exists( 'pm_social_accounts' ) ) {
	function pm_social_accounts() {
		return array(
			'facebook'    => esc_html__( 'Facebook', 'purism' ),
			'google' 	  	=> esc_html__( 'Google Plus', 'purism'),
			'twitter'     => esc_html__( 'Twitter', 'purism'),
			'instagram'   => esc_html__( 'Instagram', 'purism'),
			'behance' 	  => esc_html__( 'Behance', 'purism'),
			'pinterest'   => esc_html__( 'Pinterest', 'purism'),
			'tumblr'   	  => esc_html__( 'Tumblr', 'purism'),
			'bloglovin'   => esc_html__( 'Bloglovin', 'purism'),
			'flickr'      => esc_html__( 'Flickr', 'purism'),
			'xing'        => esc_html__( 'Xing', 'purism'),
			'github'      => esc_html__( 'Github', 'purism'),
			'youtube'     => esc_html__( 'Youtube', 'purism'),
			'vimeo'       => esc_html__( 'Vimeo', 'purism'),
			'dribbble'    => esc_html__( 'Dribbble', 'purism'),
			'soundcloud'  => esc_html__( 'Soundcloud', 'purism'),
			'linkedin'    => esc_html__( 'LinkedIn', 'purism'),
			'rss'         => esc_html__( 'RSS', 'purism'),
		);
	}
}

function pm_contacts( $contacts ) {
	$pm_contacts = pm_social_accounts();
	$contacts = array_merge( $contacts, $pm_contacts );
	return $contacts;
}

add_filter('user_contactmethods','pm_contacts');

/**
* Add Views to column in WP-Admin
*/

function pm_posts_column_views( $defaults ) {
	$defaults['post-views'] = esc_html__( 'Views', 'purism' );
	$defaults['post-likes'] = esc_html__( 'Likes', 'purism' );
	return $defaults;
}

function pm_posts_custom_column_views( $column_name, $id ) {
	if( $column_name === 'post-views' ) {
		echo pm_get_views( get_the_ID() );
	} elseif( $column_name === 'post-likes' ){
		echo pm_get_likes( get_the_ID() );
	}
}

add_filter('manage_posts_columns', 'pm_posts_column_views');
add_action('manage_posts_custom_column', 'pm_posts_custom_column_views',5,2);

/**
* Add Post Likes & Views Meta Box
*/

function pm_post_like_meta() {
	add_meta_box(
		'pm_post_like_meta',
		esc_html__( 'Likes & Views', 'purism' ),
		'pm_post_like_meta_content',
		'post',
		'side',
		'high'
	);
}

function pm_post_like_meta_content( $post ) {
	echo '<p>';
	echo '<span class="dashicons dashicons-visibility"></span> ';
	echo pm_get_views( get_the_ID() ) . ' ' . esc_html__( 'Views', 'purism' );
	echo '</p>';
	echo '<p>';
	echo '<span class="dashicons dashicons-heart"></span> ';
	echo pm_get_likes( get_the_ID() ) . ' ' . esc_html__( 'Likes', 'purism' );
	echo '<p>';
}

add_action( 'add_meta_boxes', 'pm_post_like_meta' );

/**
* Add Page Layout Sidebar Meta Box
*/

function pm_page_side_meta() {
	add_meta_box(
		'pm_page_side_meta',
		esc_html__( 'Layout Settings', 'purism' ),
		'pm_page_side_meta_content',
		'page',
		'side',
		'low'
	);
}

function pm_page_side_meta_content( $post ) {

	wp_nonce_field( 'pm_page_side_nonce_action', 'pm_page_side_nonce' );
	$field_page_sidebar = get_post_meta( $post->ID, 'pm_field_page_sidebar', true );
	?>

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="pm_field_page_sidebar"><?php esc_html_e( 'Sidebar', 'purism' ); ?></label></p>
	<select class="widefat" name="pm_field_page_sidebar" id="pm_field_page_sidebar">
		<option value="sidebar" <?php selected( $field_page_sidebar, 'sidebar' ); ?>><?php esc_html_e( 'Sidebar', 'purism' ); ?></option>
		<option value="sidebar-shop" <?php selected( $field_page_sidebar, 'sidebar-shop' ); ?>><?php esc_html_e( 'Shop Sidebar', 'purism' ); ?></option>
		<option value="nosidebar" <?php selected( $field_page_sidebar, 'nosidebar' ); ?>><?php esc_html_e( 'No Sidebar', 'purism' ); ?></option>
	</select>

	<?php
}

function pm_page_side_meta_save( $post_id ) {

	if ( ! isset( $_POST['pm_page_side_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['pm_page_side_nonce'] , 'pm_page_side_nonce_action' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if( isset( $_POST["pm_field_page_sidebar"] ) ) {
		$pm_field_page_sidebar = sanitize_text_field( $_POST['pm_field_page_sidebar'] );
		update_post_meta( $post_id, 'pm_field_page_sidebar', $pm_field_page_sidebar );
	}
}

add_action( 'add_meta_boxes', 'pm_page_side_meta' );
add_action( 'save_post', 'pm_page_side_meta_save' );

/**
* Add Page Popular Posts Meta Box
*/

function pm_popular_meta() {
	add_meta_box(
		'pm_popular_meta',
		esc_html__( 'Popular Posts', 'purism' ),
		'pm_popular_meta_content',
		'page',
		'side',
		'low'
	);
}

function pm_popular_meta_content($post) {

	wp_nonce_field( 'pm_popular_nonce_action', 'pm_popular_nonce' );
	$field_page_popular = get_post_meta( $post->ID, 'pm_field_popular', true );
	$field_page_popular_title = get_post_meta( $post->ID, 'pm_field_popular_title', true );
	$field_page_popular_number = get_post_meta( $post->ID, 'pm_field_popular_number', true );
	$field_page_popular_number = ! ( empty( $field_page_popular_number )  ||  $field_page_popular_number > 6 || $field_page_popular_number < 1 ) ? $field_page_popular_number : 3;
	$field_page_popular_filter = get_post_meta( $post->ID, 'pm_field_popular_filter', true );
	?>

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="pm_field_popular"><?php esc_html_e( 'Show', 'purism' ); ?></label></p>
	<select class="widefat" name="pm_field_popular" id="pm_field_popular">
		<option value="none" <?php selected( $field_page_popular, 'none' ); ?>><?php esc_html_e( 'None', 'purism' ); ?></option>
		<option value="top" <?php selected( $field_page_popular, 'top' ); ?>><?php esc_html_e( 'on Top', 'purism' ); ?></option>
		<option value="bottom" <?php selected( $field_page_popular, 'bottom' ); ?>><?php esc_html_e( 'on Bottom', 'purism' ); ?></option>
	</select>

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="pm_field_popular_title"><?php esc_html_e( 'Title', 'purism' ); ?></label></p>
	<input class="widefat" id="pm_field_popular_title" name="pm_field_popular_title" type="text" value="<?php echo esc_attr( $field_page_popular_title ); ?>">

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="pm_field_popular_number"><?php esc_html_e( 'Number of Posts (max. 6)', 'purism' ); ?></label></p>
	<input class="widefat" id="pm_field_popular_number" name="pm_field_popular_number" type="number" min="1" max="6" step="1" value="<?php echo esc_attr( $field_page_popular_number ); ?>">

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="pm_field_popular_filter"><?php esc_html_e( 'Filter by', 'purism' ); ?></label></p>
	<select class="widefat" name="pm_field_popular_filter" id="pm_field_popular_filter">
		<option value="post_views_count" <?php selected( $field_page_popular_filter, 'post_views_count' ); ?>><?php esc_html_e( 'Views', 'purism' ); ?></option>
		<option value="_post_like_count" <?php selected( $field_page_popular_filter, '_post_like_count' ); ?>><?php esc_html_e( 'Likes', 'purism' ); ?></option>
	</select>

	<?php
}

function pm_popular_meta_save( $post_id ) {

	if ( ! isset( $_POST['pm_popular_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['pm_popular_nonce'], 'pm_popular_nonce_action' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( isset( $_POST["pm_field_popular"] ) ) {
		$pm_field_popular = sanitize_text_field( $_POST['pm_field_popular'] );
		update_post_meta( $post_id, 'pm_field_popular', $pm_field_popular );
	}

	if ( isset( $_POST["pm_field_popular_title"] ) ) {
		$pm_field_popular_title = sanitize_text_field( $_POST['pm_field_popular_title'] );
		update_post_meta( $post_id, 'pm_field_popular_title', $pm_field_popular_title );
	}

	if ( isset( $_POST["pm_field_popular_number"] ) ) {
		update_post_meta( $post_id, 'pm_field_popular_number', $_POST['pm_field_popular_number'] );
	}

	if ( isset( $_POST["pm_field_popular_filter"] ) ) {
		$pm_field_popular_filter = sanitize_text_field( $_POST["pm_field_popular_filter"] );
		update_post_meta( $post_id, 'pm_field_popular_filter', $pm_field_popular_filter );
	}
}

add_action( 'add_meta_boxes', 'pm_popular_meta' );
add_action( 'save_post', 'pm_popular_meta_save' );

/**
* Add Post Layout Meta Box
*/

function pm_post_side_meta() {
	add_meta_box(
		'pm_post_side_meta',
		esc_html__( 'Layout Settings', 'purism' ),
		'pm_post_side_meta_content',
		'post',
		'side',
		'low'
	);
}

function pm_post_side_meta_content( $post ) {

	wp_nonce_field( 'pm_post_side_nonce_action', 'pm_post_side_nonce' );
	$field_post_sidebar = get_post_meta( $post->ID, 'pm_field_post_sidebar', true );
	?>

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="pm_field_post_sidebar"><?php esc_html_e( 'Sidebar', 'purism' ); ?></label></p>
	<select class="widefat" name="pm_field_post_sidebar" id="pm_field_post_sidebar">
		<option value="sidebar" <?php selected( $field_post_sidebar, 'sidebar' ); ?>><?php esc_html_e( 'Sidebar', 'purism' ); ?></option>
		<option value="sidebar-shop" <?php selected( $field_post_sidebar, 'sidebar-shop' ); ?>><?php esc_html_e( 'Shop Sidebar', 'purism' ); ?></option>
		<option value="nosidebar" <?php selected( $field_post_sidebar, 'nosidebar' ); ?>><?php esc_html_e( 'No Sidebar', 'purism' ); ?></option>
	</select>

	<?php
}

function pm_post_side_meta_save($post_id){

	if ( ! isset( $_POST['pm_post_side_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['pm_post_side_nonce'], 'pm_post_side_nonce_action' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if( isset( $_POST["pm_field_post_sidebar"] ) ){
		$pm_field_post_sidebar = sanitize_text_field( $_POST["pm_field_post_sidebar"] );
		update_post_meta( $post_id, 'pm_field_post_sidebar', $pm_field_post_sidebar );
	}
}

add_action( 'add_meta_boxes', 'pm_post_side_meta' );
add_action( 'save_post', 'pm_post_side_meta_save' );

/**
* Add Post Featured Post Slider Meta Box
*/

function pm_post_feat_meta() {
	add_meta_box(
		'pm_post_feat_meta',
		esc_html__( 'Featured Post' , 'purism' ),
		'pm_post_feat_meta_content',
		'post',
		'side',
		'low'
	);
}

function pm_post_feat_meta_content( $post ) {

	wp_nonce_field( 'pm_post_feat_nonce_action', 'pm_post_feat_nonce' );
	$field_post_feat_blog = get_post_meta( $post->ID, 'pm_field_post_feat_blog', true );
	?>

	<p class="post-attributes-label-wrapper">
		<label class="selectit"><input type="checkbox" name="pm_field_post_feat_blog" id="pm_field_post_feat_blog" value="1" <?php if ( isset ( $field_post_feat_blog) ) checked( $field_post_feat_blog, '1' ); ?> /> <?php esc_html_e( 'Blog Page Slider', 'purism' ); ?></label>
	</p>

	<?php
}

function pm_post_feat_meta_save( $post_id ){

	if ( ! isset( $_POST['pm_post_feat_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['pm_post_feat_nonce'], 'pm_post_feat_nonce_action') ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if( isset( $_POST[ 'pm_field_post_feat_blog' ] ) ) {
		update_post_meta( $post_id, 'pm_field_post_feat_blog', '1' );
	} else {
		update_post_meta( $post_id, 'pm_field_post_feat_blog', '' );
	}
}

add_action( 'add_meta_boxes', 'pm_post_feat_meta' );
add_action( 'save_post', 'pm_post_feat_meta_save' );

/**
* Dashboard RSS Meta Box
*/

function pm_dashboard_news_meta() {
	add_meta_box( 'pm_dashboard_rss', esc_html__( 'Purism News' , 'purism' ), 'pm_dashboard_news_meta_content', 'dashboard', 'normal', 'high' );
}

function pm_dashboard_news_meta_content( $post ) {

	echo '<div class="rss-widget">';

	$rss = fetch_feed( 'http://rss.egotype.design/purism-feed.xml' );

	if ( is_wp_error( $rss ) ) {
		$error = $rss->get_error_message();
		echo '<p>' . esc_html( $error ) . '</p>';
	} else {

		$maxitems = $rss->get_item_quantity(3);
		$rss_items = $rss->get_items( 0, $maxitems) ;
		$image = $rss->get_image_url();
		$image_alt = $rss->get_image_title();

		if ( $maxitems == 0 ) {
			echo '<p>' . esc_html__( 'No News.', 'purism' ) . '</p>';
		} else {

			echo '<p><img src="' . esc_url( $image ) . '" width="100" alt="' . esc_attr( $image_alt ) . '" ></p>';
			echo '<ul>';

			foreach ( $rss_items as $item ) {

				$link = $item->get_permalink();
				$title = $item->get_title();
				$date = $item->get_date('d.m.Y');
				$content = $item->get_content();
				$content = apply_filters( 'the_content', $content );

				echo '<li>';
				echo '<a class="rsswidget" href="' . esc_url( $link ) . '">' . esc_html( $title ) . '</a>';
				echo '<span class="rss-date">' . esc_html( $date ) . '</span>';
				echo '<div class="rssSummary">' . $content . '</div>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}
	echo "</div>";
}

add_action('wp_dashboard_setup', 'pm_dashboard_news_meta' );

/**
* Styleeditor Dropdown
*/

function pm_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}

add_filter('mce_buttons_2', 'pm_mce_buttons_2');

// Add Styles to Dropdown

function pm_mce_before_init_insert_formats( $init_array ) {
  $style_formats = array(
    array(
      'title' => esc_html__('Lead','purism'),
      'items' => array(
        array(
          'title' => esc_html__('Simple','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Left','purism'),
              'block' => 'p',
              'classes' => 'lead lead-simple lead-color lead-left',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Right','purism'),
              'block' => 'p',
              'classes' => 'lead lead-simple lead-color lead-right',
              'wrapper' => false,
            ),
          ),
        ),
        array(
          'title' => esc_html__('Border','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Left','purism'),
              'block' => 'p',
              'classes' => 'lead lead-border lead-color lead-left',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Right','purism'),
              'block' => 'p',
              'classes' => 'lead lead-border lead-color lead-right',
              'wrapper' => false,
            ),
          ),
        ),
        array(
          'title' => esc_html__('Background','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Left','purism'),
              'block' => 'p',
              'classes' => 'lead lead-background lead-color lead-left',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Right','purism'),
              'block' => 'p',
              'classes' => 'lead lead-background lead-color lead-right',
              'wrapper' => false,
            ),
          ),
        ),
      ),
    ),
    array(
      'title' => esc_html__('Separators','purism'),
      'items' => array(
        array(
          'title' => esc_html__('Normal','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Solid','purism'),
              'selector' => 'hr',
              'classes' => 'hr-normal hr-solid',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Double','purism'),
              'selector' => 'hr',
              'classes' => 'hr-normal hr-double',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Dashed','purism'),
              'selector' => 'hr',
              'classes' => 'hr-normal hr-dashed',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Dotted','purism'),
              'selector' => 'hr',
              'classes' => 'hr-normal hr-dotted',
              'wrapper' => false,
            ),
          ),
        ),
        array(
          'title' => esc_html__('Thick','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Solid','purism'),
              'selector' => 'hr',
              'classes' => 'hr-thick hr-solid',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Double','purism'),
              'selector' => 'hr',
              'classes' => 'hr-thick hr-double',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Dashed','purism'),
              'selector' => 'hr',
              'classes' => 'hr-thick hr-dashed',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Dotted','purism'),
              'selector' => 'hr',
              'classes' => 'hr-thick hr-dotted',
              'wrapper' => false,
            ),
          ),
        ),
      ),
    ),
    array(
      'title' => esc_html__('Buttons','purism'),
      'items' => array(
        array(
          'title' => esc_html__('Large','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Default','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-lg btn-default',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Color','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-lg btn-color',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Success','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-lg btn-success',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Info','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-lg btn-info',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Warning','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-lg btn-warning',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Danger','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-lg btn-danger',
              'wrapper' => false,
            ),
          ),
        ),
        array(
          'title' => esc_html__('Medium','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Default','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-md btn-default',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Color','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-md btn-color',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Success','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-md btn-success',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Info','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-md btn-info',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Warning','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-md btn-warning',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Danger','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-md btn-danger',
              'wrapper' => false,
            ),
          ),
        ),
        array(
          'title' => esc_html__('Small','purism'),
          'items' => array(
            array(
              'title' => esc_html__('Default','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-sm btn-default',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Color','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-sm btn-color',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Success','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-sm btn-success',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Info','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-sm btn-info',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Warning','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-sm btn-warning',
              'wrapper' => false,
            ),
            array(
              'title' => esc_html__('Danger','purism'),
              'selector' => 'a',
              'classes' => 'btn btn-sm btn-danger',
              'wrapper' => false,
            ),
          ),
        ),
      ),
    ),
    array(
      'title' => esc_html__('Drop Cap','purism'),
      'items' => array(
				array(
					'title' => esc_html__('Simple','purism'),
					'block' => 'p',
					'classes' => 'dc dc-simple dc-color',
					'wrapper' => false,
				),
				array(
					'title' => esc_html__( 'Border','purism' ),
					'block' => 'p',
					'classes' => 'dc dc-border dc-color',
					'wrapper' => false,
				),
				array(
					'title' => esc_html__( 'Background', 'purism' ),
					'block' => 'p',
					'classes' => 'dc dc-background dc-color',
					'wrapper' => false,
        ),
      ),
    ),

  );
  $init_array['style_formats'] = json_encode( $style_formats );
  return $init_array;
}

add_filter( 'tiny_mce_before_init', 'pm_mce_before_init_insert_formats' );
