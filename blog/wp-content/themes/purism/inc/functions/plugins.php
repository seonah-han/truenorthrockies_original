<?php

/**
* Register required plugins
*/

require_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';

function pm_register_required_plugins() {

	$plugins = array(
		array(
			'name'     				=> 'Contact Form 7',
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
		),
		array(
			'name'     				=> 'WP Instagram Widget',
			'slug'     				=> 'wp-instagram-widget',
			'required' 				=> false,
		),

		array(
			'name'     				=> 'Vafpress Post Formats UI',
			'slug'     				=> 'vafpress-post-formats-ui-develop',
			'source'   				=> 'http://assets.egotype.design/vafpress-post-formats-ui-develop.zip',
			'required' 				=> true,
			'version' 				=> '1.5',
			'external_url' 		=> 'https://github.com/vafour/vafpress-post-formats-ui',
		),
		array(
			'name'     				=> 'Egotype Shortcodes',
			'slug'     				=> 'egotype-shortcodes',
			'source'   				=> 'http://assets.egotype.design/egotype-shortcodes.zip',
			'required' 				=> false,
			'version' 				=> '1.0',
		),
		array(
			'name' 					=> 'WooCommerce',
			'slug' 					=> 'woocommerce',
			'required'			=> false
		),
		array(
			'name'					=> 'YITH Woocommerce Quick View',
			'slug'					=> 'yith-woocommerce-quick-view',
			'required'			=> false
		),
		array(
			'name'					=> 'YITH Woocommerce Wishlist',
			'slug'					=> 'yith-woocommerce-wishlist',
			'required'			=> false
		),
		array(
			'name'          => 'One Click Demo Import',
			'slug'          => 'one-click-demo-import',
			'required'      => false,
		),
	);

	$config = array(
		'id'           => 'purism',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'pm_register_required_plugins' );
