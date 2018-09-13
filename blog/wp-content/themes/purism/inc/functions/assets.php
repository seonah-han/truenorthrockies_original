<?php

/**
* Enqueue scripts and Styles.
*/

function pm_scripts() {
	$assets     = array(
		'css'        			=> '/style.css',
		'pm-js'        		=> '/dist/js/pm-custom.js',
		'shop-css'        => '/dist/css/pm-shop.css',
	);
	$version = wp_get_theme()->get('Version');

	wp_register_script( 'pm-js', get_template_directory_uri() . $assets['pm-js'], array( 'jquery' ), $version, true);

	$translation_array = array(
		'url' 			=> esc_url( get_theme_mod( 'pm_mailchimp_url' ) ),
		'm_submit' 	=> esc_html( get_theme_mod( 'pm_mailchimp_m_submit' ) ),
		'm_0' 			=> esc_html( get_theme_mod( 'pm_mailchimp_m_0' ) ),
		'm_1' 			=> esc_html( get_theme_mod( 'pm_mailchimp_m_1' ) ),
		'm_2' 			=> esc_html( get_theme_mod( 'pm_mailchimp_m_2' ) ),
		'm_3' 			=> esc_html( get_theme_mod( 'pm_mailchimp_m_3' ) ),
		'm_4' 			=> esc_html( get_theme_mod( 'pm_mailchimp_m_4' ) ),
		'm_5' 			=> esc_html( get_theme_mod( 'pm_mailchimp_m_5' ) )
	);
	wp_localize_script( 'pm-js', 'object', $translation_array );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/dist/js/jquery.easing.1.3.min.js', array( 'jquery' ), '1.3.0', true );
	wp_enqueue_script( 'jarallax', get_template_directory_uri() . '/dist/js/jarallax.min.js', array(), '1.7.3', true );
	wp_enqueue_script( 'jarallax-video', get_template_directory_uri() . '/dist/js/jarallax-video.min.js', array(), '1.2.1', true );
	wp_enqueue_script( 'jquery-ajaxchimp', get_template_directory_uri() . '/dist/js/jquery.ajaxchimp.min.js', array( 'jquery' ), '1.3.0', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/dist/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/dist/js/jquery.slicknav.min.js', array( 'jquery' ), '1.0.10', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/dist/js/slick.min.js', array(), '1.6.0', true );
	wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/dist/js/waypoint.js', array(), '1.6.0', true );
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/dist/js/jquery.fitvids.js', array( 'jquery' ), '1.1.1', true );
	wp_enqueue_script( 'pm-js' );

	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/dist/css/normalize.css', array(), '7.0.0', 'all' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/dist/css/font-awesome.min.css', array(), '4.7.0', 'all' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/dist/css/magnific-popup.css', array(), '1.1.0', 'all' );
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/dist/css/slick.css', array(), '1.0.10', 'all' );
	wp_enqueue_style( 'slicknav-css', get_template_directory_uri() . '/dist/css/slicknav.min.css', array(), '1.6.0', 'all' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/dist/css/magnific-popup.css', array(), '1.1.0', 'all' );
	wp_enqueue_style( 'pm-css', get_template_directory_uri() . $assets['css'], false, $version );

	if( PM_WOOCOMMERCE ) {
		wp_enqueue_style( 'shop-css', get_template_directory_uri() . $assets['shop-css'], false, $version );
	}
}
add_action( 'wp_enqueue_scripts', 'pm_scripts' );


/**
* Footer Scripts
*/

function pm_footer_scripts(){
  ?>
	<?php if ( is_active_widget( false, false, 'pm_facebook', true ) ) : ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.async = true; js.src = "//connect.facebook.net/<?php echo esc_js( pm_get_locale() ); ?>/sdk.js#xfbml=1&version=v2.9";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
	<?php endif; ?>
  <?php
}

add_action( 'wp_footer', 'pm_footer_scripts' );


/**
* Enqueue Admin Styles
*/

function pm_admin_style() {
	wp_enqueue_style( 'pm-admin-styles', get_template_directory_uri().'/dist/css/pm-admin.css' );
}
add_action('admin_enqueue_scripts', 'pm_admin_style');

/**
* Enqueue Add Editor Styles
*/

function pm_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/dist/css/pm-editor-styles.css');
}

add_action( 'admin_init', 'pm_add_editor_styles' );
